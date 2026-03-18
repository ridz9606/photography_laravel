<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Photography By Monali</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('website/css/bootstrap.min.css') }}">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Work+Sans:wght@400;500&display=swap" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset("website/img/studio.png") }}');
            background-size: cover;
            background-position: center;
            font-family: 'Work Sans', sans-serif;
        }
        .login-card {
            border: none;
            border-radius: 20px;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }
        .btn-primary {
            background-color: #E7B894;
            border-color: #E7B894;
            color: #000;
            font-weight: 600;
            padding: 12px;
            border-radius: 10px;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color: #d4a37a;
            border-color: #d4a37a;
            transform: translateY(-2px);
        }
        .form-control {
            border-radius: 10px;
            padding: 12px;
            border: 1px solid #ddd;
        }
        .brand-text {
            font-family: 'Playfair Display', serif;
            color: #333;
            font-weight: 600;
        }
    </style>
</head>

<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">
    <div class="card login-card p-5 text-center" style="max-width:450px; width:100%;">

        <img src="{{ asset('website/img/image1.png') }}" style="width:140px;" class="mx-auto mb-3">
        <h3 class="brand-text mb-4">Welcome Back</h3>
        <p class="text-muted mb-4">Please enter your details to login</p>

        <form method="post" action="{{ url('/login') }}">
            @csrf
            <div class="mb-3 text-start">
                <label class="form-label ms-1">Email Address</label>
                <input type="email" name="email" class="form-control"
                       placeholder="example@mail.com" required>
            </div>

            <div class="mb-4 text-start">
                <label class="form-label ms-1">Password</label>
                <input type="password" name="password" class="form-control"
                       placeholder="••••••••" required>
            </div>

            <button type="submit" name="login" class="btn btn-primary w-100 mb-3">
                Login to Account
            </button>
        </form>

        <p class="mt-2 mb-0">
            Don’t have an account?
            <button onclick="window.location='{{ url('registration') }}'" class="btn btn-link fw-bold p-0 text-decoration-none" style="color: #E7B894;">Create Account</button>
        </p>

    </div>
</div>

</body>
</html>
