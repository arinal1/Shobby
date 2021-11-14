<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Shobby</title>
    <link href="https://ol.binus.ac.id/images/favicon.ico" rel="Shortcut Icon" type="image/png" media="screen">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>

@section('login-modal-title', 'Login')

<body>
    @section('navbar')
        <nav class="navbar navbar-expand-md opaque-navbar">
            <div class="container">
                <a class="navbar-brand" href="/"> <img src="https://ol.binus.ac.id/images/logo.png" alt="logo"></a>
                @if (Auth::check())
                    <div class="nav-item dropdown">
                        <img src="{{ asset('img/person-circle.svg') }}" class="profile-picture">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @if (Auth::user()->hasRole('user'))
                                <li><a class="dropdown-item" href="{{ route('transactions') }}">Daftar Transaksi</a></li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </div>
                @else
                    <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="modal"
                        data-bs-target="#loginModal">Login</button>
                @endif

            </div>
        </nav>
        <div class="modal" id="loginModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@yield("login-modal-title")</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('login') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="mb-3">
                                <label><strong>Email</strong></label>
                                <input type="text" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="mb-3">
                                <label><strong>Password</strong></label>
                                <input type="password" name="password" class="form-control" placeholder="Password"
                                    required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @show

    @yield('content')

    <script src="https://code.jquery.com/jquery-latest.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    @yield('script')
</body>

</html>
