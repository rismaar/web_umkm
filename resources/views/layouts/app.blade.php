<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <title>Document</title>
    @vite(['resources/css/app.css'])
</head>

<body>
    <ul id="nav" class="navigation nav p-4 justify-content-between sticky-top">
        <div class="d-flex mt-2">
            <li class="nav-item">
                <h3 class="title-nav">Warung Ibu Ida.</h3>
            </li>
        </div>
        <div class="d-flex mt-2">
            @if (Auth::check() && auth()->user()->role === 'user')
                <li class="nav-item">
                    <a class="nav nav-tool btn rounded-pill fw-bold text-decoration-none p-2 px-4 border-0" href="{{ route('index') }}#ScrollspyHome" style="background-color: #7F2020; color: #FBF5A7">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav nav-tool btn rounded-pill fw-bold text-decoration-none p-2 px-4 border-0" href="{{ route('products') }}#ScrollspyProducts" style="background-color: #7F2020; color: #FBF5A7">Products</a>
                </li>
            @endif
        </div>
        <div class="d-flex mt-2">
            @if (auth()->check() && auth()->user()->role === 'user')
                <li class="nav-item">
                    <a class="nav text-decoration-none" style="color: #7F2020" href="#"><i class="fa-solid fa-cart-shopping fa-2x mx-2"></i></a>
                </li>
            @endif
             @if (Auth::check())
                @if (auth()->user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav text-decoration-none" style="color: #7F2020" href="#"><i class="fa-solid fa-bell fa-2x"></i></a>
                    </li>
                @endif
                <div class="dropdown dropup nav-item">
                    <button class="btn p-0 border-0 bg-transparent text-warning"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                        <i class="fa-solid fa-user fa-2x" style="color: #7F2020"></i>
                    </button>
                    <ul class="dropdown-menu border-0 dropdown-menu-end" style="background-color: #7F2020">
                        <li class="dropdown-item" style="color: #FBF5A7">
                            <b>{{ auth()->user()->name }}</b>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="dropdown-item" type="submit" style="color: #FBF5A7">
                                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endif
            @if(!Auth::check())
                <li class="nav-item">
                    <a class="nav nav-tool btn rounded-pill fw-bold text-decoration-none p-2 px-4 border-0" href="{{ route('regist') }}" style="background-color: #7F2020; color: #FBF5A7">Sign Up</a>
                </li>
            @endif
        </div>
    </ul>
    <main>
        @yield('content')
    </main>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script>
        $(document).ready(function(){
            $('#myTable').DataTable();
        });
    </script>
</body>
</html>