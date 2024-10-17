<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Register</title>
    <style>
         body {
            background-color: #fafafa; 
            font-family: 'Montserrat', sans-serif; 
        }

        .instagram-login-card {
            padding: 20px; 
            margin-top: 50px; 
            border: none; 
            border-radius: 10px; 
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); 
            text-align: center; 
        }

        .form-control {
            background-color: #fafafa; 
            border: 1px solid #dbdbdb; 
            font-size: 14px; 
        }

        .btn-success {
            background-color: #3897f0;
            border: none; 
        }
        .btn-success:hover {
            background-color: #2a88d0; 
        }
        .card-title {
            font-size: 1.5rem; 
            margin-bottom: 20px; 
            color: #262626; 
            text-align: center;
        }
        .login-link {
            margin-top: 20px; 
            text-align: center; 
        }
        .login-link a {
            color: #0095f6; 
            text-decoration: none; 
        }
        .logo {
            display: block; 
            margin: 0 auto 20px auto; 
        }
        .register-image {
            width: 50%; 
            height: auto; 
            max-width: 100px;
            margin: 0 auto 15px auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card instagram-login-card mx-auto">
                    <img src="{{ asset('asset/register.PNG') }}" alt="Logo" class="register-image"> 
                    <p class="card-title">Register terlebih dahulu</p>
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
                                placeholder="Konfirmasi Password" required>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Register</button>
                    </form>
                    <div class="login-link">
                        <p>Sudah punya? <a href="{{ route('login') }}">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
{{-- ada 3 akun nalen@gmail.com, hendra@gmail.com, ugik@gmail.com, semua memiliki password yang sama : password --}}