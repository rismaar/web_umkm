@extends('layouts.app')
@section('content')

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-lg-3">
            <a href="{{ route('historySales') }}"
                class="btn rounded-pill"
                style="background:#7F2020;color:#E6F082;">
                <span class="rounded-circle d-inline-flex justify-content-center align-items-center me-2"
                    style="width:35px;height:35px;background:#bddd09;">
                    <i class="fa-solid fa-arrow-left text-white"></i>
                </span>
                View Order History
            </a>
        </div>
        <div class="col-lg-6">
            @if(empty(auth()->user()->address))
                <div class="card shadow border-0">
                    <div class="card-body">
                        <h5 class="fw-bold">Shipping Address</h5>
                        <form action="{{ route('saveAddress') }}" method="POST">
                            @csrf
                            <textarea
                                class="form-control mb-3"
                                name="address"
                                rows="3"
                                placeholder="Enter your complete address first..."
                                required></textarea>
                            <button class="btn " style="background:#7F2020;color:#E6F082">
                                Save Address
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@if ($items->isEmpty())
    <div class="d-flex justify-content-center align-items-center p-3 mt-5" style="height: 70vh">
        <div class="text-center">
            <i class="fa-solid fa-circle-exclamation fa-3x p-2" style="color: #7F2020"></i>
            <h2 class="text-center">Your cart is empty.</h2>
        </div>
    </div>
@endif

<div class="container w-100 py-5">
    <div class="row">
        <div class="col-lg-8">
            @php
                $amount = 0;
            @endphp
            @foreach($items as $item)
            @php
                $subtotal = $item->qty * $item->price;
                $ongkir = 10000;
                $amount += $subtotal;
                $total = $amount + $ongkir;
            @endphp
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <img
                                src="{{ Storage::url('products/'.$item->product->image_product) }}"
                                class="img-fluid rounded-3"
                                style="height:150px;width:100%;object-fit:cover;">
                        </div>
                        <div class="col-md-5">
                            <h4 class="fw-bold">
                                {{ $item->product->name_product }}
                            </h4>
                            <p class="text-muted mb-2">
                                {{ $item->product->description }}
                            </p>
                            <h5 class="fw-bold">
                                Rp {{ number_format($item->price,0,',','.') }}
                            </h5>
                        </div>
                        <div class="col-md-2">
                            <div class="d-flex align-items-center justify-content-center">
                                <form action="{{ route('decrease', $item->id_cartItem) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-outline-secondary">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>
                                </form>
                                <span class="mx-3 fw-bold fs-5">
                                    {{ $item->qty }}
                                </span>
                                <form action="{{ route('increase', $item->id_cartItem) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-outline-secondary">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-2 text-end">
                            <h5 class="fw-bold">
                                Rp {{ number_format($subtotal,0,',','.') }}
                            </h5>
                            <form action="{{ route('remove', $item->id_cartItem) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger mt-3">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @if ($items->isNotEmpty())
            <div class="col-lg-4">
                <div class="card shadow border-0 rounded-4 sticky-top">
                    <div class="card-body p-4">
                        <h4 class="fw-bold">
                            Order Summary
                        </h4>
                        <div class="d-flex justify-content-between">
                            <span>Total Items</span>
                            <span>{{ $items->sum('qty') }} Pcs</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Shipping Costs</span>
                            <span>Rp {{ number_format($ongkir,0,',','.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Total Spending</span>
                            <span>Rp {{ number_format($amount,0,',','.') }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5>Total</h5>
                            <h4 class="fw-bold">
                                Rp {{ number_format($total,0,',','.') }}
                            </h4>
                        </div>
                        <a
                            class="btn btn-lg w-100 mt-4 fw-bold" data-bs-toggle="modal" data-bs-target="#QRPayment"
                            style="background:#7F2020;color:#E6F082">
                            <i class="fa-solid fa-credit-card me-2"></i>
                            Payment
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<div class="modal fade" id="QRPayment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="{{ asset('img/qr.jpeg') }}" class="align-items-center" alt="QR Code" style="width: 100%; height: auto; object-fit: cover;">
            </div>
            <div class="modal-footer">
                @if(empty(auth()->user()->address))
                    <button
                        class="btn btn-secondary w-100 rounded-pill"
                        disabled>
                        Please fill in your shipping address first
                    </button>
                    @else
                    <form action="{{ route('checkout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-lg w-100 mt-4 " style="background:#7F2020;color:#E6F082">
                            <i class="fa-solid fa-credit-card me-2"></i>
                            Proceed to Payment
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection