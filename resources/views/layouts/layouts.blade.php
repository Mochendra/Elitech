<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>@yield('title')</title>
    <style>
        body {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            min-width: 250px;
            background: #f8f9fa;
            height: 100%;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
        }

        .main-content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .nav-link {
            display: flex;
            align-items: center;
        }

        .nav-link i {
            margin-right: 10px;
        }

        .logout-container {
            position: absolute;
            bottom: 20px;
            left: 20px;
        }

   
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #343a40;
         
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 10px;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn {
            border-radius: 5px;
            padding: 10px;
            font-size: 1rem;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
            transition: background-color 0.3s;
        }

      
        .form-text {
            font-size: 0.9rem;
            color: #6c757d;
         
        }
        .custom-file-label::after {
    content: "Browse"; 
}

.custom-file-label {
    overflow: hidden;
}
        /*  */
    </style>
</head>

<body>
    <div class="sidebar">
        <header class="bg-light p-3">
            <h3 class="text-center">Instagram Bro</h3>
        </header>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('feed.index') }}">
                    <i class="fas fa-home"></i> Feed
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('posts.posts') }}">
                    <i class="fas fa-image"></i> Posts
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('settings.settings') }}">
                    <i class="fas fa-cog"></i> Settings
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/archives/' . Auth::user()->id) }}">
                    <i class="fas fa-archive"></i> Archives
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profile.show', ['username' => Auth::user()->id]) }}">
                    <i class="fas fa-user"></i> Profil Saya
                </a>
            </li>

            <div class="logout-container">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </ul>
    </div>

    <div class="main-content">
        <main class="container mt-4">
            @yield('content')
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>


</html>
