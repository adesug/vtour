<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Light background color */
        }
        .login-container {
            max-width: 400px; /* Maximum width for the login form */
            margin: auto;
            padding: 2rem;
            background-color: white; /* White background for the form */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }
    </style>
</head>
<body>

<div class="login-container mt-5">
    <h2 class="text-center">Login</h2>
    <form action="{{route('login_proses')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Masukkan alamat email"  required>
            @error('email')
                <small class="text-danger">{{$message}}</small>                
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Masukkan password"  required>
            @error('password')
                <small class="text-danger">{{$message}}</small>                
            @enderror
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
        {{-- <div class="mt-3 text-center">
            <a href="#">Lupa password ?</a>
        </div>
        <div class="mt-3 text-center">
            <a href="registerPage.html">Register</a>
        </div> --}}
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if($message = Session::get('failed'))
    <script>
        Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "{{$message}}",
        // footer: '<a href="#">Why do I have this issue?</a>'
        });
    </script>
@endif
@if($message = Session::get('success'))
    <script>
        Swal.fire({
        icon: "success",
        title: "Berhasil...",
        text: "{{$message}}",
        // footer: '<a href="#">Why do I have this issue?</a>'
        });
    </script>
@endif
</body>
</html>
