@extends('layouts.app')
@section('content')

<div class="running-text">
    
</div>

@guest
    <div class="landing-bann row align-items-center" id="ScrollspyHome">
        <div class="col-lg-6 col-md-12">
            <h1 class="title text-center">Warung Ibu Ida.</h1>
        </div>

        <div class="col-lg-6 col-md-12 text-center">
            <img src="{{ asset('img/bg.png') }}" class="pict img-fluid" alt="">
        </div>
    </div>    
@endguest

@if (Auth::check() && auth()->user()->role === 'admin')
    <div class="container-fluid py-5 px-5" style="background-color: #FBF5A7">
        <div class="row justify-content-center">
            <div class="col-sm-3 mb-3">
                <a href="#" class="" style="text-decoration: none;">
                    <div class="card p-5 border-0" style="background-color: #7f2020; color: #e6f082;">
                        <div class="card-body">
                            <h3 class="card-title fw-bold">Order History</h3>
                            <p class="card-text">
                                With supporting text below as a natural lead-in to additional content.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-3">
                <a href="{{ route('products') }}" class="" style="text-decoration: none;">
                    <div class="card p-5 border-0" style="background-color: #E6F082; color: #7f2020;">
                        <div class="card-body">
                            <h3 class="card-title fw-bold">Data Product</h3>
                            <p class="card-text">
                                With supporting text below as a natural lead-in to additional content.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-3">
                <a href="#" class="" style="text-decoration: none;">
                    <div class="card p-5 border-0" style="background-color: #7f2020; color: #e6f082;">
                        <div class="card-body">
                            <h3 class="card-title fw-bold">New Order</h3>
                            <p class="card-text">
                                With supporting text below as a natural lead-in to additional content.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-3">
                <a href="#" class="" type="button" data-bs-toggle="modal" data-bs-target="#staticCategory" style="text-decoration: none;">
                    <div class="card p-5 border-0" style="background-color: #e6f082; color:#7f2020;">
                        <div class="card-body">
                            <h3 class="card-title fw-bold">Product Categories</h3>
                            <p class="card-text">
                                With supporting text below as a natural lead-in to additional content.
                            </p>
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

<div class="products p-5" id="ScrollspyProducts">
    <h2 class="title-prod text-center mb-5">
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
    <div class="d-flex justify-content-end mt-5">
        <a href="{{ route('products') }}"
           class="btn-prod rounded-4 fw-bold p-3">
            More <i class="fa-solid fa-angle-right fa-lg"></i>
        </a>
    </div>
</div>

@if (!Auth::check() || (Auth::user()->role === 'user'))
    <div class="about p-5" id="ScrollspyAbout">
        <h2 class="title-about text-center mb-5">About Us</h2>
        <div class="d-flex justify-content-between align-items-center">
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
            
        </div>
    </div>    
@endif

@endsection

