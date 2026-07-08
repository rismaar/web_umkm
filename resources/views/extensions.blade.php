@extends('layouts.app')
@section('content')

<div class="landing-prod rounded-5 p-5 mt-5">
    <a href="{{ route('products') }}"><i class="fa-solid fa-arrow-left fa-2x" style="color:#FEFDDF;"></i></a>
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
        @if ($products->isEmpty())
            <div class="d-flex justify-content-center align-items-center p-3 mt-5">
                <div class="text-center">
                    <i class="fa-solid fa-circle-exclamation fa-3x p-2" style="color: #ffffff"></i>
                    <h2 class="text-center text-white">No products available.</h2>
                </div>
            </div>
        @endif
    </div>

    <div class="row justify-content-center">
        @foreach ($products as $pr)
            <div class="col-12 col-md-4 mt-5 col-lg-3">
                <div class="card card-prod rounded-5 p-2 h-70">
                    <div class="img-prod" >
                        <img src="{{  Storage::url('products/'.$pr->image_product) }}" class="img-set rounded-5 card-img-top shadow-lg">
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title fw-bold" >{{$pr->name_product}}</h3>
                            <h6 class="fw-bold text-white rounded-pill px-3 py-2" style="background-color: #7f2020">Rp. {{number_format($pr->price_product, 0, ',', '.')}}</h6>
                        </div>
                        <p class="fw-bold">{{$pr->description}}</p>
                        <div class="d-flex">
                            @if (Auth::check() && (Auth::user()->role === 'admin'))
                                <button type="button" class="btn me-3" style="background-color: #FFFAF3; color:#7f2020" data-bs-toggle="modal" data-bs-target="#edit{{ $pr->id_product }}"><i class="fa-solid fa-arrows-rotate"></i></button>
                                <a href="#" class="btn btn-danger me-3" data-bs-toggle="modal" data-bs-target="#confirmDelete{{ $pr->id_product }}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            @endif
                            @if (Auth::check() && (Auth::user()->role === 'user'))
                                <form action="{{ route('addtoCart', ['idProduct' => $pr->id_product]) }}" method="POST" class="w-100">
                                    @csrf
                                    <button type="submit" class="btn w-100 rounded-5 text-white p-3 fw-bold" style="background-color: #7f2020">Add to Cart<i class="fa-solid fa-cart-shopping mx-2"></i></button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- detail --}}
            <div class="modal fade" id="staticBackdrop{{ $pr->id_product }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content p-4">
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
                            @if (Auth::check() && (Auth::user()->role === 'user'))
                                <button type="button" class="btn w-100 p-3" style="background-color: #7f2020; color: #E6F082">Add to Cart<i class="fa-solid fa-cart-shopping mx-2"></i></button>
                            @endif
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