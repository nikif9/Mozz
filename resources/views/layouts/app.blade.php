<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog Admin Panel')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">Blog Admin Panel</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                @auth
                    @if(Auth::user()->roles->pluck('name')->contains('administrator'))
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.posts.index') }}">Posts</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.categories.index') }}">Categories</a></li>
                    @elseif(Auth::user()->roles->pluck('name')->contains('moderator'))
                        <li class="nav-item"><a class="nav-link" href="{{ route('moderator.posts.index') }}">Posts</a></li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" 
                           onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endauth
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                @endguest
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
