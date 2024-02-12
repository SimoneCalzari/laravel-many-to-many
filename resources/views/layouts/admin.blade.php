<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Boolfolio</title>

    <!-- Fontawesome 6 cdn -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'
        integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=='
        crossorigin='anonymous' referrerpolicy='no-referrer' />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body class="vh-100">
    <div id="app" class="h-100 d-flex flex-column">
        <!-- HEADER PRINCIPALE -->
        <header class="navbar navbar-dark  bg-dark flex-md-nowrap p-2 shadow">
            <!-- CONTENUTO HEADER FISSO -->
            <div class="row justify-content-between">
                <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/">BoolFolio</a>
                <button class="navbar-toggler position-absolute d-md-none collapsed" type="button"
                    data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <!-- /CONTENUTO HEADER FISSO -->
            <!-- HAMBURGER DELLA NAV BAR PER TABLET E MOBILE -->
            <div class="navbar-nav">
                <div class="nav-item text-nowrap me-2">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
            <!-- /HAMBURGER DELLA NAV BAR PER TABLET E MOBILE -->
        </header>
        <!-- /HEADER PRINCIPALE -->
        <!-- CONTAINER NAVBAR E MAIN -->
        <div class="container-fluid flex-grow-1 overflow-hidden">
            <div class="row h-100">
                <!-- NAVBAR PER MODALITA DESKTOP E MAGGIORI -->
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark navbar-dark sidebar collapse h-100">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-secondary' : '' }}"
                                    href="{{ route('admin.dashboard') }}">
                                    <i class="fa-solid fa-tachometer-alt fa-lg fa-fw"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.projects.index' ? 'bg-secondary' : '' }}"
                                    href="{{ route('admin.projects.index') }}">
                                    <i class="fa-solid fa-folder fa-lg fa-fw"></i> Projects
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.types.index' ? 'bg-secondary' : '' }}"
                                    href="{{ route('admin.types.index') }}">
                                    <i class="fa-solid fa-list fa-lg fa-fw"></i> Types
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.technologies.index' ? 'bg-secondary' : '' }}"
                                    href="{{ route('admin.technologies.index') }}">
                                    <i class="fa-solid fa-microchip fa-lg fa-fw"></i> Technologies
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- /NAVBAR PER MODALITA DESKTOP E MAGGIORI -->
                <!-- MAIN -->
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 overflow-auto h-100 py-3">
                    @yield('content')
                </main>
                <!-- /MAIN -->
            </div>
        </div>
        <!-- /CONTAINER NAVBAR E MAIN -->
    </div>
</body>

</html>
