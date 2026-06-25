@extends('layouts.app')
@section('content')

<div class="landing-prod p-5">
    @if (!Auth::check() || (Auth::check() && auth()->user()->role === 'user'))
        <div class="row justify-content-center gx-3 gy-4">
            <div class="col-auto">
                <div class="product-item text-center">
                    <a href="{{ route('primary') }}" class="product-link">
                        <img src="{{ asset('img/bahan_dapur.png') }}" 
                            class="product-img img-fluid">
                    </a>
                    <h5 class="product-title">Sembako</h5>
                </div>
            </div>
            <div class="col-auto">
                <div class="product-item text-center">
                    <a href="#" class="product-link">
                        <img src="{{ asset('img/extension.png') }}" 
                            class="product-img img-fluid">
                    </a>
                    <h5 class="product-title">Extension</h5>
                </div>
            </div>
            <div class="col-auto">
                <div class="product-item text-center">
                    <a href="#" class="product-link">
                        <img src="{{ asset('img/pict.png') }}" 
                            class="product-img img-fluid">
                    </a>
                    <h5 class="product-title">Minuman</h5>
                </div>
            </div>
            <div class="col-auto">
                <div class="product-item text-center">
                    <a href="{{ route('snack') }}" class="product-link">
                        <img src="{{ asset('img/cart.png') }}" 
                            class="product-img img-fluid">
                    </a>
                    <h5 class="product-title">Snack</h5>
                </div>
            </div>
        </div>
        <div class=" mt-5">
            <h5 class="title-prod release">
                New Release...
            </h5>
        </div>
    @endif

    @if (Auth::check() && auth()->user()->role === 'admin')
        <div class="container-fluid " style="background-color: #7f2020">
            <div class="d-flex justify-content-between">
                <a href="{{ route('index') }}"><i class="fa-solid fa-arrow-left fa-2x" style="color: #e6f082"></i></a>
                <a href="#" class="btn p-3 rounded-4 fw-bold" data-bs-toggle="modal" data-bs-target="#AddProduct" style="background-color: #e6f082; color: #7f2020"><i class="fa-solid fa-circle-plus me-2"></i>Add Product</a>
            </div>
        </div>
    @endif
    <div class="modal fade" id="AddProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('storeProduct') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Product Name</label>
                                <input type="text" name="name_product" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Category</label>
                                <select 
                                    name="id_category"
                                    class="form-select">
                                    <option selected disabled>Choose Category</option>
                                    @foreach($category as $cat)
                                        <option value="{{ $cat->id_category }}">
                                            {{ $cat->name_category }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Price</label>
                                <input 
                                    type="number"
                                    name="price_product"
                                    class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Stock</label>
                                <input 
                                    type="number"
                                    name="stock_product"
                                    class="form-control">

                            </div>
                            <div class="col-md-6">
                                <label class="form-label">
                                    Product Image
                                </label>
                                <input 
                                    type="file"
                                    name="image_product"
                                    class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Description</label>
                                <textarea
                                    name="description"
                                    class="form-control"
                                    rows="3">
                                </textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <button class="btn fw-bold" style="background:#E6F082;color:#7f2020">Save Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center p-5">
        @foreach ($products as $pr)
            <div class="col-12 col-md-4 mt-5 col-lg-3">
                <div class="card card-prod p-4 h-100">
                    <div class="img-prod rounded-3 p-2" style="background-color:#FEFDDF">
                        <img src="{{  Storage::url('products/'.$pr->image_product) }}" class="img-set card-img-top">
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">{{$pr->name_product}}</h3>
                        <h5 class="fw-bold">Rp. {{number_format($pr->price_product, 2, ',', '.')}}</h5>
                        <div class="d-flex justify-content-end">
                            @if (Auth::user()->role === 'admin')
                                <a href="#" class="btn btn-warning me-3" data-bs-toggle="modal" data-bs-target="#EditProduct{{ $pr->id_product }}">
                                    <i class="fa-solid fa-arrows-rotate"></i>
                                </a>
                                <a href="#" class="btn btn-danger me-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $pr->id_product }}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            @endif
                            <a href="#" class="btn direct" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $pr->id_product }}">
                                <i class="fa-solid fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- detail --}}
            <div class="modal fade" id="staticBackdrop{{ $pr->id_product }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$pr->name_product}}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    <div class="modal-body">
                        <img src="{{  Storage::url('products/'.$pr->image_product) }}" class="img-set card-img-top">
                        <h2 class="fw-bold">Rp. {{number_format($pr->price_product, 2, ',', '.')}}</h2>
                        <p class="card-text text-truncate">{{$pr->description}}</p>
                    </div>
                    <div class="modal-footer d-block">
                        @if (Auth::user()->role === 'user')
                            <button type="button" class="btn w-100 p-3" style="background-color: #7f2020; color: #E6F082">Add to Cart<i class="fa-solid fa-cart-shopping mx-2"></i></button>
                        @endif
                    </div>
                    </div>
                </div>
            </div>
            {{-- edit --}}
            <div class="modal fade" id="EditProduct{{ $pr->id_product }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$pr->name_product}}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    <div class="modal-body">
                        <form action="{{ route('updateProduct') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Product Name</label>
                                    <input type="text" name="name_product" class="form-control" value="{{ old('name_product', $pr->name_product) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Category</label>
                                    <select 
                                        name="id_category"
                                        class="form-select">
                                        <option selected disabled>Choose Category</option>
                                        @foreach($category as $cat)
                                            <option value="{{ $cat->id_category }}" {{ $cat->id_category == $pr->id_category ? 'selected' : '' }}>
                                                {{ $cat->name_category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Price</label>
                                    <input 
                                        type="number"
                                        name="price_product"
                                        class="form-control" value="{{ old('price_product', $pr->price_product) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Stock</label>
                                    <input 
                                        type="number"
                                        name="stock_product"
                                        class="form-control" value="{{ old('stock_product', $pr->stock_product) }}">

                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">
                                        Product Image
                                    </label>
                                    <input 
                                        type="file"
                                        name="image_product"
                                        class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Description</label>
                                    <textarea
                                        name="description"
                                        class="form-control"
                                        rows="3">{{ old('description', $pr->description) }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-4">
                                <button class="btn fw-bold" style="background:#E6F082;color:#7f2020">Save Product</button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


@endsection