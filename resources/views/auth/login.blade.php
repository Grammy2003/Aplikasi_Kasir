@extends('layouts.app')

@section('content')
<head>
    <style>
        nav {
            display: none;
        }

        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to right, #e0f2f1, #e3f2fd);
            overflow: hidden;
            font-family: 'Segoe UI', sans-serif;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100vh;
        }

        .card {
            width: 450px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            background: white;
            z-index: 1;
        }

        .card-header {
            background-color: #2e7d32;
            color: white;
            font-weight: bold;
            text-align: center;
            font-size: 1.3rem;
            padding: 15px;
        }

        .card-body {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            border-radius: 5px;
            padding: 10px;
            font-size: 1rem;
            width: 100%;
        }

        .input-group {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-group .toggle-password {
            position: absolute;
            right: 10px;
            border: none;
            background: none;
            cursor: pointer;
            font-size: 18px;
            color: #555;
        }

        .input-group .toggle-password:hover {
            color: #000;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-primary {
            background-color: #388e3c;
            border: none;
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            transition: background 0.3s ease;
            width: 100%;
            color: white;
        }

        .btn-primary:hover {
            background-color: #2e7d32;
        }

        .auth-links {
            text-align: center;
            margin-top: 15px;
            font-size: 0.9rem;
        }

        .auth-links a {
            color: #004d40;
            font-weight: bold;
            text-decoration: none;
            margin: 0 5px;
        }

        .auth-links a:hover {
            color: #00695c;
            text-decoration: underline;
        }

        /* ANIMASI BUAH & SAYUR (emoji) */
        .fruit-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
            pointer-events: none;
        }

        .fruit {
            position: absolute;
            font-size: 2.5rem;
            animation: floatEmoji 30s linear infinite;
            opacity: 0.6;
        }

        @keyframes floatEmoji {
            0% {
                transform: translateY(100vh) translateX(0) rotate(0deg);
                opacity: 0.5;
            }
            100% {
                transform: translateY(-120vh) translateX(30vw) rotate(360deg);
                opacity: 0.8;
            } 
        }
    </style>

    <!-- Font Awesome untuk toggle password -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" crossorigin="anonymous"></script>
</head>

<!-- ANIMASI BACKGROUND EMOJI BUAH & SAYUR -->
<div class="fruit-background">
    <div class="fruit" style="left: 5%; animation-delay: 0s;">🍎</div>
    <div class="fruit" style="left: 20%; animation-delay: 5s;">🥕</div>
    <div class="fruit" style="left: 35%; animation-delay: 2s;">🍌</div>
    <div class="fruit" style="left: 50%; animation-delay: 4s;">🥦</div>
    <div class="fruit" style="left: 70%; animation-delay: 1s;">🍇</div>
    <div class="fruit" style="left: 85%; animation-delay: 3s;">👍</div>
</div>

<!-- FORM LOGIN -->
<div class="container">
    <div class="row justify-content-start">
        <div class="col-md-8">
            <div class="card">
                <img src="{{ asset('assets/img/Storeg.png') }}" alt="Logo" class="img-fluid" style="max-width: 80%; display: block; margin: 10px auto;">

                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <div class="input-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                       name="password" required>
                                <button type="button" class="toggle-password" onclick="togglePassword()">
                                    <i id="eyeIcon" class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group remember-me">
                            <input class="form-check-input" type="checkbox" name="remember"
                                   id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>

                        <div class="auth-links">
                            <br>
                            <a href="{{ route('register') }}">Register</a> |
                            <a href="{{ route('login') }}">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toggle Password JS -->
<script>
    function togglePassword() {
        let passwordField = document.getElementById("password");
        let eyeIcon = document.getElementById("eyeIcon");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }
</script>

@endsection
