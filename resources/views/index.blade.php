@extends('layouts.app')
@section('content')


@guest
    <div class="landing-bann row align-items-center" id="ScrollspyHome">
        
        <h1 class="title text-center mt-5" style="font-family: 'Dancing Script', cursive;">Warung Ibu Ida.</h1>
    </div>    
@endguest

@if (Auth::check() && auth()->user()->role === 'admin')
    <div class="container-fluid py-5 px-5 mt-5" >
        <div class="row justify-content-center">
            <div class="col-sm-3">
                <a href="{{ route('historySales') }}" class="" style="text-decoration: none;">
                    <div class="card p-5 border-0" style="background-color: #7f2020; color:#FBF5A7;">
                        <div class="card-body d-flex justify-content-between">
                            <div class="d-flex gap-3 align-items-center">
                                <h3 class="card-title fw-bold">New Order</h3>
                            </div>
                            <span class="badge rounded-pill fs-4 fw-bold" style="background-color:#FEFDDF; color:#7f2020">{{$newOrderCount}}</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-3">
                <a href="{{ route('products') }}" class="" style="text-decoration: none;">
                    <div class="card p-5 border-0" style="background-color: #D2DE32; color: #7f2020;">
                        <div class="card-body">
                            <h3 class="card-title fw-bold">Data Product</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-3">
                <a href="{{ route('orderHistory') }}" class="" style="text-decoration: none;">
                    <div class="card p-5 border-0" style="background-color: #069A8E; color:#FBF5A7;">
                        <div class="card-body">
                            <h3 class="card-title fw-bold">Order History</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-3">
                <a href="#" class="" data-bs-toggle="modal" data-bs-target="#staticCategory" style="text-decoration: none;">
                    <div class="card p-5 border-0" style="background-color: #F1F1B0; color:#7f2020;">
                        <div class="card-body">
                            <h3 class="card-title fw-bold">Product Categories</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    {{-- modal category --}}
    <div class="modal fade" id="staticCategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Product Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3">
                    <a href="#" class="btn p-2 rounded-3 fw-bold" data-bs-toggle="modal" data-bs-target="#AddCategory" style="background-color: #e6f082; color: #7f2020"><i class="fa-solid fa-circle-plus"></i></a>
                    <table id="myTable" class="table table-bordered w-100 mt-3">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category as $cat)
                                <tr>
                                    <td>{{ $cat->id_category }}</td>
                                    <td>{{ $cat->name_category }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- modal add category --}}
    <div class="modal fade" id="AddCategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCategory" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addCategory">Product Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3">
                    <form action="{{ route('storeCategories') }}" method="post">
                        @csrf
                        <div class="input-group input-group-lg mb-3 ">
                            <span class="input-group-text border-1" id="inputGroup-sizing-lg">Category</span>
                            <input type="text" name="name_category" class="form-control border-1" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                        </div>
                        <hr>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn fw-bold" style="background-color: #E6F082; color:#7f2020">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="products rounded-5 p-5 mt-5" id="ScrollspyProducts">
    @if (!Auth::check() || (Auth::check() && auth()->user()->role === 'user'))
        <h2 class="title-prod text-center mb-5" style="font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; font-size: 3rem">
            Product Best Seller
        </h2>
        <div class="row justify-content-center g-4">

            <div class="col-12 col-md-6 col-lg-3">
                <div class="card-prod card p-4 h-100">

                    <div class="img-prod rounded-3 p-2" style="background-color:#FEFDDF">
                        <img src="{{ asset('img/pict3.png') }}"
                            class="img-set card-img-top">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            Card title
                        </h5>
                        <p class="card-text">
                            Some quick example text.
                        </p>
                        <div class="d-flex justify-content-end">
                            <a href="#" class="btn direct">
                                <i class="fa-solid fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card-prod card p-4 h-100">
                    <div class="img-prod rounded-3 p-2" style="background-color:#FEFDDF">
                        <img src="{{ asset('img/pict2.png') }}"
                            class="img-set card-img-top">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            Card title
                        </h5>
                        <p class="card-text">
                            Some quick example text.
                        </p>
                        <div class="d-flex justify-content-end">
                            <a href="#" class="btn direct">
                                <i class="fa-solid fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card-prod card p-4 h-100">
                    <div class="img-prod rounded-3 p-2" style="background-color:#FEFDDF">
                        <img src="{{ asset('img/pict4.png') }}"
                            class="img-set card-img-top">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            Card title
                        </h5>
                        <p class="card-text">
                            Some quick example text.
                        </p>
                        <div class="d-flex justify-content-end">
                            <a href="#" class="btn direct">
                                <i class="fa-solid fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-5">
            <a href="{{ route('products') }}"
            class="btn-prod rounded-pill fw-bold p-3">
                View Menus <i class="fa-solid fa-angle-right fa-lg"></i>
            </a>
        </div>
    @else
        <h2 class="mb-5 text-warning fw-bold" style="font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; font-size: 1.5rem">
            Recent Transaction..
        </h2>
        @foreach($sale as $sale)
            <div class="card border-0 shadow-lg mb-4 p-4 rounded-4 w-75 justify-content-center mx-auto">
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
                                Rp {{ number_format($sale->total_price,2,',','.') }}
                            </h6>
                        </div>

                        <div class="col-md-2">
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
                        <div class="col-md-3 text-end">
                            <a href="#"
                            class="btn btn-outline-success rounded-pill"
                            data-bs-toggle="modal"
                            data-bs-target="#detailModal{{ $sale->id_sale }}">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            @if($sale->status == 'Processing')
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
                        <h6>Transaction Date: {{ $sale->created_at->format('d M Y') }}</h6>
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
</div>

@if (!Auth::check() || (Auth::user()->role === 'user'))
    <div class="about p-5" id="ScrollspyAbout">
        <h1 class="text-center fw-bold" style="font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">You can reach out us at..</h1>
        <div class="d-flex justify-content-center mt-5 w-100 gap-5 p-5 rounded-5">
            <div class="card card-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.613315541235!2d106.81191931225698!3d-6.570390493395543!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5ae0d5127e1%3A0x7e203c80069d2efb!2sWoodfire%20Bogor!5e0!3m2!1sen!2sid!4v1781592789637!5m2!1sen!2sid"
                    width="800"
                    height="500"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            <div>
                <h4 class="fw-bold">Contact us:</h4>
                <h4><i class="fa-solid fa-phone"></i>+62812-9077-4810</h4>
                <h4><i class="fa-solid fa-envelope"></i> Email: IdaStore@gmail.com</h4>
            </div>
        </div>
    </div>    
@endif

@endsection

