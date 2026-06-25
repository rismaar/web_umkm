<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    @vite(['resources/css/app.css'])
    <title>Registrasi</title>
</head>
<style>
</style>
<body class="bg-light d-flex p-5 vh-100">
<a href="{{ route('index') }}"><i class="fa-solid fa-arrow-left fa-2x" style="color: rgb(221, 123, 52);"></i></a>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="row bg-light shadow-lg rounded-5 w-100 overflow-hidden" style="width: 600px">
        <div class="col-md-6 d-flex align-items-center justify-content-center" style="background-color: #FBF5A7">
            <img src="{{ asset('img/store.png') }}" class="img-fluid mb-4 p-5" style="max-width: 100%;" alt="">
        </div>
        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center p-5">
            <i class="fa-solid fa-user fa-4x mb-3" style="color: rgb(221, 123, 52);"></i>
            <form action="{{ route('saveregist') }}" method="POST" class="w-75">
                @csrf
                @error('username')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control rounded-4" id="floatingName" placeholder="Name">
                    <label for="floatingName">Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="username" class="form-control rounded-4" id="floatingInput" placeholder="Username">
                    <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control rounded-4" id="floatingInput" placeholder="Email">
                    <label for="floatingInput">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control rounded-4" id="floatingPassword" placeholder="Password">
                    @error('password')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password_confirmation" class="form-control rounded-4" id="floatingConfirmPassword" placeholder="Confirm Password">
                    <label for="floatingConfirmPassword">Confirm Password</label>
                </div>
                <hr class="mt-4 mb-4">
                <button type="submit" class="btn btn-log w-100 rounded-4 fw-bold p-3">Sign Up</button>
                <a href="{{ route('login') }}" class="text-decoration-none mt-3 d-block text-center">Already have an account? Login</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>