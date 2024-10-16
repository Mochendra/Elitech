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
    }

    .main-content {
        flex: 1;
        padding: 20px;
        overflow-y: auto;
    }
</style>
    </style>
</head>

<body>
    <div class="sidebar">
        <header class="bg-light p-3">
            <h3 class="text-center">Instagram Bro</h3>
        </header>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('feed.index') }}">Feed</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('posts.posts') }}">Posts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('settings.settings') }}">Settings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/archives/' . Auth::user()->id) }}">Archives</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profile.show', ['username' => Auth::user()->id]) }}">Profil Saya</a>
            </li>
            <!-- Form untuk logout -->
            <div class="logout-container" style="position: absolute; bottom: 20px; left: 20px;">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf <!-- Tambahkan token CSRF -->
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
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>

</html>
