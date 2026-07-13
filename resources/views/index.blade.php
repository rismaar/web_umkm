@extends('layouts.app')
@section('content')



@if (!Auth::check() || (Auth::check() && auth()->user()->role === 'user'))
    <div class="landing-bann py-5">
        <div class="container">

            <div class="row align-items-center min-vh-75">

                <!-- LEFT -->
                <div class="col-lg-6">

                    <h1 class="display-1 fw-bold title"
                        style="font-family:'Dancing Script',cursive; line-height:1;">
                        Warung <br> Ibu Ida.
                    </h1>

                    <p class="lead mt-4 text-secondary">
                        Belanja kebutuhan harian menjadi lebih mudah,
                        cepat, aman, dan terpercaya.
                    </p>

                    <div class="mt-4">
                        <a href="{{ route('products') }}"
                            class="btn btn-lg px-5 me-3"
                            style="background:#8B1E1E;color:white;border-radius:50px;">
                            Shop Now
                        </a>

                        <a href="#ScrollspyProducts"
                            class="btn btn-outline-dark btn-lg px-5 rounded-pill">
                            Explore
                        </a>
                    </div>
                    <div class="row text-center mt-5">

                        <div class="col-6 col-md-3">
                            <i class="fa-solid fa-truck fa-2x mb-3"
                                style="color:#430763"></i>

                            <h6 class="fw-bold">Fast Delivery</h6>

                            <small class="text-muted">
                                Pengiriman cepat
                            </small>
                        </div>

                        <div class="col-6 col-md-3">
                            <i class="fa-solid fa-tag fa-2x mb-3 text-warning"></i>

                            <h6 class="fw-bold">Affordable</h6>

                            <small class="text-muted">
                                Harga bersahabat
                            </small>
                        </div>

                        <div class="col-6 col-md-3 mt-4 mt-md-0">
                            <i class="fa-solid fa-star fa-2x mb-3"
                                style="color:#d8db00"></i>

                            <h6 class="fw-bold">Best Quality</h6>

                            <small class="text-muted">
                                Produk berkualitas
                            </small>
                        </div>

                        <div class="col-6 col-md-3 mt-4 mt-md-0">
                            <i class="fa-solid fa-shop fa-2x mb-3 text-primary"></i>
                            <h6 class="fw-bold">Trusted</h6>
                            <small class="text-muted">
                                Toko terpercaya
                            </small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{ asset('img/bg.png') }}"
                        class="img-fluid"
                        style="max-width:800px;">
                </div>
            </div>
        </div>
    </div>
@endif
        


@if (Auth::check() && auth()->user()->role === 'admin')
    <div class="container-fluid py-5 px-5 mt-5" >
        <div class="row justify-content-center">
            <div class="col-sm-3">
                <a href="{{ route('historySales') }}" style="text-decoration: none;">
                    <div class="card border-0 p-5" style="background-color: #FFEF5F; color:#7F2020; border-radius: 30px">
                        <div class="card-body d-flex justify-content-between">
                            <div class="d-flex gap-3 align-items-center">
                                <h3 class="card-title fw-bold "><i class="fa-solid fa-cart-shopping me-2"></i>New Order</h3>
                            </div>
                            <span class="badge rounded-pill fs-4 fw-bold" style="background-color:#FEFDDF; color:#7f2020">{{$newOrderCount}}</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-3">
                <a href="{{ route('products') }}" class="" style="text-decoration: none;">
                    <div class="card p-5 border-0" style="background-color: #D2DE32; color: #7f2020; border-radius: 30px"" >
                        <div class="card-body">
                            <h3 class="card-title fw-bold">Data Product</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-3">
                <a href="{{ route('orderHistory') }}" class="" style="text-decoration: none;">
                    <div class="card p-5 border-0" style="background-color: #5A7ACD; color:#FFEF5F; border-radius: 30px"">
                        <div class="card-body">
                            <h3 class="card-title fw-bold">Order History</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-3">
                <a href="#" class="" data-bs-toggle="modal" data-bs-target="#staticCategory" style="text-decoration: none;">
                    <div class="card p-5 border-0" style="background-color: #F1F1B0; color:#092a7d; border-radius: 30px"">
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
    @if (!Auth::check() || (Auth::check() && Auth::user()->role === 'user'))
        <h2 class="fw-bold title-prod mb-4" style="font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; font-size: 1.5rem">
                Shop by Category
            </h2>
        <div class="row text-center">
            @foreach($category as $cat)
            <div class="col-md-3">
                <div class="card py-3 border-0 rounded-5">
                    <div class="card-body">
                        <div class="rounded-circle d-flex justify-content-center align-items-center mx-auto mb-3 shadow-lg"
                            style="width:120px;height:120px; background-color: #7f2020">
                        @switch($cat->name_category)
                            @case('Sembako')
                                <img src="{{ asset('img/bahan_dapur.png') }}" class="product-img img-fluid">
                                @break
                            @case('Snack')
                                <img src="{{ asset('img/cart.png') }}" class="product-img img-fluid">
                                @break
                            @case('Extensions')
                                <img src="{{ asset('img/extension.png') }}" class="product-img img-fluid">
                                @break
                            @case('Drink')
                                <img src="{{ asset('img/pict.png') }}" class="product-img img-fluid">
                                @break
                        @endswitch
                        </div>
                        <h5>{{ $cat->name_category }}</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-between py-5">
            <h2 class="title-prod text-center" style="font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; font-size: 1.5rem">
                Weekly best selling items
            </h2>
            <a href="{{ route('products') }}"
                class="btn bg-white rounded-pill fw-bold text-decoration-none d-inline-flex align-items-center gap-2 px-4"
                style="font-size:1rem; color:#7F2020;">
                    See More
                    <span class="rounded-circle d-flex justify-content-center align-items-center"
                        style="width:35px; height:35px; background-color: #bddd09da">
                        <i class="fa-solid fa-arrow-right text-white mt-1"></i>
                    </span>
            </a>
        </div>
        
        <div class="row justify-content-center g-4">
            @foreach ($bestProducts as $pr)
                <div class="col-12 col-md-4 mt-5 col-lg-3">
                    <div class="card card-prod p-2 rounded-5 h-70">
                        <div class="img-prod bg-white rounded-5 p-3 position-relative" >
                            <span class="badge position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill shadow" style="background-color: #5A7ACD">
                                <i class="fa-solid fa-star me-2" style="color: #ffff00"></i>Best Seller
                            </span>
                            <img src="{{  Storage::url('products/'.$pr->image_product) }}" class="img-set rounded-5 card-img-top">
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title fw-bold text-truncate" >{{$pr->name_product}}</h3>
                                <div class="ms-3">
                                    <h6 class="fw-bold text-white rounded-pill px-3 py-2" style="background-color: #717f20">Rp. {{number_format($pr->price_product, 0, ',', '.')}}</h6>
                                </div>
                            </div>
                            <p class="fw-bold">{{$pr->description}}</p>
                            @if(Auth::check() && (Auth::user()->role === 'admin'))
                                <p class="fw-bold">Stock: {{$pr->stock_product}}</p>
                            @endif
                            <div class="d-flex">
                                @if (Auth::check() && (Auth::user()->role === 'admin'))
                                    <button type="button" class="btn me-3" style="background-color: #FFFAF3; color:#7f2020" data-bs-toggle="modal" data-bs-target="#edit{{ $pr->id_product }}"><i class="fa-solid fa-arrows-rotate"></i></button>
                                    <a href="#" class="btn btn-danger me-3" data-bs-toggle="modal" data-bs-target="#confirmDelete{{ $pr->id_product }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                @endif
                            </div>
                            @if (Auth::check() && (Auth::user()->role === 'user'))
                                <form action="{{ route('addtoCart', ['idProduct' => $pr->id_product]) }}" method="POST" class="w-100">
                                    @csrf
                                    <button type="submit" class="btn w-100 text-white py-3 fw-bold" style="background-color: #717f20; border-radius: 0px 0px 100px 100px; transition:cubic-bezier(1, 0, 0, 1)"><i class="fa-solid fa-plus fa-lg"></i></button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif ((Auth::check() && auth()->user()->role === 'user'))
        <div class="d-flex justify-content-between">
            <h2 class="title-prod text-center" style="font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; font-size: 2rem">
                Weekly best selling items
            </h2>
            <a href="{{ route('products') }}"
                class="btn bg-white rounded-pill fw-bold text-decoration-none d-inline-flex align-items-center gap-2 px-4"
                style="font-size:1rem; color:#7F2020;">
                    See More
                    <span class="rounded-circle d-flex justify-content-center align-items-center"
                        style="width:35px; height:35px; background-color: #bddd09da">
                        <i class="fa-solid fa-arrow-right text-white mt-1"></i>
                    </span>
            </a>
        </div>
        <div class="row justify-content-center g-4">
            @foreach ($bestProducts as $pr)
                <div class="col-12 col-md-4 mt-5 col-lg-3">
                    <div class="card card-prod p-2 h-70" style="border-radius: 25px 25px 100px 100px;">
                        <div class="img-prod position-relative" >
                            <span class="badge position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill shadow" style="background-color: #5A7ACD">
                                <i class="fa-solid fa-star me-2" style="color: #ffff00"></i>Best Seller
                            </span>
                            <img src="{{  Storage::url('products/'.$pr->image_product) }}" class="img-set rounded-4 card-img-top shadow-lg">
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title fw-bold text-truncate" >{{$pr->name_product}}</h3>
                                <div class="ms-3">
                                    <h6 class="fw-bold text-white rounded-pill px-3 py-2" style="background-color: #717f20">Rp. {{number_format($pr->price_product, 0, ',', '.')}}</h6>
                                </div>
                            </div>
                            <p class="fw-bold">{{$pr->description}}</p>
                            @if(Auth::check() && (Auth::user()->role === 'admin'))
                                <p class="fw-bold">Stock: {{$pr->stock_product}}</p>
                            @endif
                            <div class="d-flex">
                                @if (Auth::check() && (Auth::user()->role === 'admin'))
                                    <button type="button" class="btn me-3" style="background-color: #FFFAF3; color:#7f2020" data-bs-toggle="modal" data-bs-target="#edit{{ $pr->id_product }}"><i class="fa-solid fa-arrows-rotate"></i></button>
                                    <a href="#" class="btn btn-danger me-3" data-bs-toggle="modal" data-bs-target="#confirmDelete{{ $pr->id_product }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                @endif
                            </div>
                            @if (Auth::check() && (Auth::user()->role === 'user'))
                                <form action="{{ route('addtoCart', ['idProduct' => $pr->id_product]) }}" method="POST" class="w-100">
                                    @csrf
                                    <button type="submit" class="btn w-100 text-white py-4 fw-bold" style="background-color: #717f20; border-radius: 0px 0px 100px 100px; transition:cubic-bezier(1, 0, 0, 1)"><i class="fa-solid fa-plus fa-2x"></i></button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif (Auth::check() && auth()->user()->role === 'admin')
        <h2 class="mb-5 text-warning fw-bold" style="font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; font-size: 1.5rem">
            Recent Transaction..
        </h2>
        @foreach($sale as $sale)
            <div class="card border-0 shadow-lg mb-4 p-4 rounded-4 w-50 justify-content-center mx-auto">
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
                                class="btn rounded-pill" style="background-color: #5A7ACD; color: white"
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
</div>



@if (!Auth::check() || (Auth::user()->role === 'user'))
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-md-6">
            <img src="{{ asset('img/store.png') }}"
            class="img-fluid">
        </div>

            <div class="col-md-6">
                <h2 class="fw-bold" style="font-family: 'Dancing Script', cursive; font-size: 3rem;">
                About Warung Ibu Ida
                </h2>
                <p>
                Warung Ibu Ida menyediakan berbagai kebutuhan sehari-hari mulai dari sembako,
                minuman, snack, hingga kebutuhan rumah tangga dengan harga terjangkau dan
                pelayanan terbaik.
                </p>
            </div>
        </div>
    </div>
    <div class="about p-5 rounded-5" id="ScrollspyAbout">
        <h1 class="text-center fw-bold" style="font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">You can reach out us at..</h1>
        <div class="d-flex justify-content-center mt-5 w-100 gap-5 p-5 rounded-5">
            <div class="card card-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.515413167111!2d106.79509701225706!3d-6.582666093383381!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c4342fcb5a85%3A0xc819ef0d110b3254!2sGg.%20Lb.%20Pilar%2C%20Kota%20Bogor%2C%20Jawa%20Barat!5e0!3m2!1sen!2sid!4v1783566702796!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin">
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
                <h4><i class="fa-brands fa-whatsapp me-2"></i>+62851-5725-5981</h4>
                <h4><i class="fa-solid fa-envelope"></i> Email: IdaStore@gmail.com</h4>
                <h4><i class="fa-regular fa-clock me-2"></i>06.00 - 21.00 WIB</h4>
            </div>
        </div>
    </div>    
@endif

@endsection

