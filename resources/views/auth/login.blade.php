<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
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

        .btn-login {
            background-color: #3897f0;
            border: none;
        }

        .btn-login:hover {
            background-color: #2a88d0;
        }

        .login-image {
            width: 100%;
            height: auto;
            max-width: 300px;
            margin: 0 auto 15px auto;
        }
    </style>
</head>

<body>
    <div class="card instagram-login-card mx-auto" style="width: 400px;">
        <div class="card-body">
            <img src="{{ asset('asset/login.jpg') }}" alt="Logo" class="login-image">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <button type="submit" class="btn btn-login btn-block">Login</button>
            </form>
            <div class="login-link mt-3">
                <p>Belum memiliki akun? <a href="{{ route('register') }}">Register</a></p>
            </div>
        </div>
    </div>
</body>

</html>
{{-- ada 3 akun nalen@gmail.com, hendra@gmail.com, ugik@gmail.com, semua memiliki password yang sama : password --}}