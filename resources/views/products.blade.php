@extends('layouts.app')
@section('content')

<div class="landing-prod rounded-5 p-5 mt-5">
    @if (!Auth::check())
        <a href="{{ route('index') }}"><i class="fa-solid fa-arrow-left fa-2x" style="color:#FEFDDF;"></i></a>
    @endif
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
                    <a href="{{ route('extensions') }}" class="product-link">
                        <img src="{{ asset('img/extension.png') }}" 
                            class="product-img img-fluid">
                    </a>
                    <h5 class="product-title">Extension</h5>
                </div>
            </div>
            <div class="col-auto">
                <div class="product-item text-center">
                    <a href="{{ route('drink') }}" class="product-link">
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
        <div class="d-flex justify-content-between px-5 mt-5">
            <h6 class="fw-bold" style="color: #FBF5A7; font-size: 1.5rem">New Release..</h6>
            <form action="{{ route('products') }}" method="GET" class="d-flex mb-2">
                <input
                    type="text"
                    name="search"
                    class="form-control rounded-pill me-2 py-4 border-0 px-4" style="width: 500px"
                    placeholder="Search products..."
                    value="{{ request('search') }}">
                <button type="submit"
                    class="btn rounded-circle px-4"
                    style="color:#7F2020; background:#FBF5A7">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        @if ($products->isEmpty())
            <div class="d-flex justify-content-center align-items-center p-3 mt-5">
                <div class="text-center">
                    <i class="fa-solid fa-circle-exclamation fa-3x p-2" style="color: #ffffff"></i>
                    <h2 class="text-center text-white">No products available.</h2>
                </div>
            </div>
        @endif
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
            <div class="col-12 col-md-4 mt-3 col-lg-3">
                <div class="card card-prod p-2 h-70" @if ((Auth::check() && Auth::user()->role === 'user'))
                                                        style="border-radius: 25px 25px 100px 100px;"
                                                     @else
                                                        style="border-radius: 35px; cursor: pointer;"
                                                     @endif>
                    <div class="img-prod bg-white rounded-5 p-4" >
                        <img src="{{  Storage::url('products/'.$pr->image_product) }}" class="img-set rounded-5 card-img-top ">
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title fw-bold text-truncate" >{{$pr->name_product}}</h3>
                            <div class="ms-3">
                                <h6 class="fw-bold text-white rounded-pill px-3 py-2" style="background-color: #717f20">Rp {{number_format($pr->price_product, 0, ',', '.')}}</h6>
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

            {{-- delete confirm --}}
            <div class="modal fade" id="confirmDelete{{ $pr->id_product }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content p-4">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$pr->id_product}}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5>Really want to delete {{$pr->name_product}} from your store?</h5>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('deleteProduct', ['idProduct' => $pr->id_product]) }}" method="POST" enctype="">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger me-3"><i class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            {{-- edit --}}
            <div class="modal fade" id="edit{{ $pr->id_product }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$pr->name_product}}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    <div class="modal-body">
                        <form action="{{ route('updateProduct', ['idProduct' => $pr->id_product]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
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

        @if ($products->count() > 0)
            <nav aria-label="Page navigation example" class="mt-5">
                <ul class="pagination justify-content-center">
                    @if ($products->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link">&laquo;</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link text-danger" href="{{ $products->previousPageUrl() }}">
                                &laquo;
                            </a>
                        </li>
                    @endif
                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                            <li class="page-item {{ $products->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link
                                    {{ $products->currentPage() == $i ? 'bg-warning border-warning text-white' : 'text-danger' }}"
                                    href="{{ $products->url($i) }}">
                                    {{ $i }}
                                </a>
                            </li>
                        @endfor
                    @if ($products->hasMorePages())
                        <li class="page-item">
                            <a class="page-link text-danger" 
                            href="{{ $products->nextPageUrl() }}">
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
</div>


@endsection