<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ICA FDDS</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <a class="navbar-brand d-flex " href="#">
                    <img class=" col-sm-1 rounded-circle img-fluid" style="width: 550px; object-fit: contain;" src="/storage/image/logo.jpg" alt="Responsive image">
                    <h4 class="my-auto">ICA FACULTY DIGITAL DOCUMENT SYSTEM</h4>
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav mr-3">
                            <li class="nav-item dropdown ml-5">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa fa-user-circle fa-lg" aria-hidden="true"></i>
                                    {{ Auth::user()->name }} {{ Auth::user()->lname }}
                                </a>

                                
                                    
                                

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                   <a class="dropdown-item" href="/home"><i class="fas fa-home pr-2"></i><strong>Dashboard</strong></a>
                                    @can('manage-users')<a class="dropdown-item" href="{{ route('admin.users.index') }}"><i class="fa fa-users pr-2" aria-hidden="true"></i>Users Management</a>@endcan
                                    <a class="dropdown-item" href="{{ route('certificates.certificate.index') }}"><i class="fa fa-certificate pr-2" aria-hidden="true"></i>Certificates</a>
                                    <a class="dropdown-item" href="{{ route('trainings.training.index') }}"><i class="fab fa-leanpub pr-2"></i> Trainings</a>
                                    <a class="dropdown-item" href="{{ route('designations.designation.index') }}"> <i class="fas fa-award pr-2"></i> Designations</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="fas fa-sign-out-alt pr-2"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                    </ul>
                </div>
        </nav>

        <main class="py-4">
            <div class="container">
                
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>