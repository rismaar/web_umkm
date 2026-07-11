@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-5">
    @if($sales->isEmpty())
        <div class="text-center mt-5 align-items-center justify-content-center">
            <i class="fa-solid fa-box-open fa-5x text-secondary mb-3"></i>
            <h3>No Transaction Yet</h3>
            <p class="text-muted">
                Let's start shopping!
            </p>
            <a href="{{ route('products') }}"
                class="btn rounded-pill px-4"
                style="background:#7F2020;color:#FBF5A7">
                Browse Products
            </a>
        </div>
    @else
    <h6 class="fw-bold mb-5 text-center" style="color: #7F2020; font-size: 1.5rem">Transaction History</h6>
        @foreach($sales as $sale)
        <div class="card border-0 shadow-lg mb-4 p-4 rounded-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <small class="text-muted">
                            Invoice
                        </small>
                        <h6 class="fw-bold">
                            {{ $sale->invoice }}
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <small class="text-muted">
                            Date
                        </small>
                        <h6>
                            {{ $sale->created_at->format('d M Y') }}
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <small class="text-muted">
                            Total
                        </small>
                        <h6 class="fw-bold">
                            Rp {{ number_format($sale->total_price,0,',','.') }}
                        </h6>
                    </div>

                    <div class="col-md-2">
                         @if(Auth::user()->role == 'admin')
                            <form action="{{ route('updateStatus', $sale->id_sale) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status"
                                        class="form-select"
                                        onchange="this.form.submit()">
                                    <option value="Pending"
                                        {{ $sale->status == 'Pending' ? 'selected' : 'bg-secondary' }}>
                                        Pending
                                    </option>
                                    <option value="Processing"
                                        {{ $sale->status == 'Processing' ? 'selected' : 'bg-warning' }}>
                                        Processing
                                    </option>
                                    <option value="Completed"
                                        {{ $sale->status == 'Completed' ? 'selected' : 'bg-primary' }}>
                                        Completed
                                    </option>
                                    <option value="Cancelled"
                                        {{ $sale->status == 'Cancelled' ? 'selected' : 'bg-danger' }}>
                                        Cancelled
                                    </option>
                                </select>
                            </form>
                        @else
                            @switch($sale->status)
                                @case('Pending')
                                    <span class="badge bg-secondary">Pending</span>
                                    @break
                                @case('Processing')
                                    <span class="badge bg-warning text-dark">Processing</span>
                                    @break
                                @case('Completed')
                                    <span class="badge bg-primary">Completed</span>
                                    @break
                                @case('Cancelled')
                                    <span class="badge bg-danger">Cancelled</span>
                                    @break
                            @endswitch
                        @endif
                    </div>
                    <div class="col-md-3 text-end">
                        <a href="#"
                        class="btn  rounded-pill" style="background-color: #5A7ACD; color: white"
                        data-bs-toggle="modal"
                        data-bs-target="#detailModal{{ $sale->id_sale }}">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        @if(Auth::check() && Auth::user()->role === 'user' && $sale->status == 'Processing')
                            <form action="{{ route('received', $sale->id_sale) }}"
                                method="POST"
                                class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-success rounded-pill">
                                    <i class="fa-solid fa-box-open me-1"></i>
                                    Order Received
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="detailModal{{ $sale->id_sale }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content p-4">
                    <div class="modal-header">
                        <h1 class="modal-title fw-bold fs-5" id="staticBackdropLabel">{{$sale->invoice}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-between">
                            <h6>Transaction Date: {{ $sale->created_at->format('d M Y') }}</h6>
                            <div>
                                @switch($sale->status)
                                    @case('Pending')
                                        <span class="badge bg-secondary">Pending</span>
                                        @break
                                    @case('Processing')
                                        <span class="badge bg-warning text-dark">Processing</span>
                                        @break
                                    @case('Completed')
                                        <span class="badge bg-primary">Completed</span>
                                        @break
                                    @case('Cancelled')
                                        <span class="badge bg-danger">Cancelled</span>
                                        @break
                                @endswitch
                            </div>
                        </div>
                        <h6>Customer: {{ $sale->user->email }}</h6>
                        @foreach ($sale->details as $detail)
                            <div class="card shadow-sm border-0 rounded-4 mb-4">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            {{ $detail->product->name_product }}
                                        </div>
                                        <div class="col-md-5">
                                            <h5>
                                                Rp {{ number_format($detail->product->price_product, 0, ',', '.') }}
                                            </h5>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="d-flex align-items-center justify-content-center">
                                                {{ $detail->qty }}
                                            </div>
                                        </div>
                                        <div class="col-md-2 text-end">
                                            <h5>
                                                Rp {{ number_format($detail->product->price_product * $detail->qty, 0, ',', '.') }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <h5 class="fw-bold">
                            Total: Rp {{ number_format($sale->total_price, 0, ',', '.') }}
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endif

    @if ($sales->count() > 0)
        <nav aria-label="Page navigation example" class="mt-5">
            <ul class="pagination justify-content-center">
                @if ($sales->onFirstPage())
                    <li class="page-item disabled">
                        <a class="page-link">&laquo;</a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link text-danger" href="{{ $sales->previousPageUrl() }}">
                            &laquo;
                        </a>
                    </li>
                @endif
                @for ($i = 1; $i <= $sales->lastPage(); $i++)
                        <li class="page-item {{ $sales->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link
                                {{ $sales->currentPage() == $i ? 'bg-warning border-warning text-white' : 'text-danger' }}"
                                href="{{ $sales->url($i) }}">
                                {{ $i }}
                            </a>
                        </li>
                    @endfor
                @if ($sales->hasMorePages())
                    <li class="page-item">
                        <a class="page-link text-danger" 
                        href="{{ $sales->nextPageUrl() }}">
                            &raquo;
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <a class="page-link">&raquo;</a>
                    </li>
                @endif
            </ul>
        </nav>
    @endif
</div>



@endsection