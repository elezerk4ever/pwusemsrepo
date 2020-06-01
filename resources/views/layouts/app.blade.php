<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="/js/all.min.js" defer></script>
    <script src="/js/jquery.min.js" defer></script>
    <script src="/js/file_name_revealer.js" defer></script>
    <script src="/js/delete.js" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="/css/all.min.css">
    <link rel="icon" href="/img/pwu-logo-icon.svg">
    <link rel="stylesheet" href="/css/inspire.css">
    <link rel="stylesheet" href="/css/loaders.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        th,td{
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary container-fluid mb-2">
            <a class="navbar-brand" href="/home">
                <img src="/img/pwu-logo.svg" alt="" width="30">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    @auth
                    @can('viewAny', \App\Program::class)
                    <li class="nav-item">
                        <a href="/home" class="nav-link">
                            <i class="fa fa-home"></i> Home
                        </a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="/home" class="nav-link">
                            <i class="fa fa-user"></i> Profile
                        </a>
                    </li>
                    @endcan
                    @can('viewAny', \App\Program::class)
                    <li class="nav-item">
                        <a href="{{route('programs.index')}}" class="nav-link"><i class="fa fa-chalkboard"></i> Programs</a>
                    </li>
                    @endcan
                    @can('viewAny', \App\Student::class)
                    <li class="nav-item">
                        <a href="{{route('students.index')}}" class="nav-link"><i class="fa fa-users"></i> Students</a>
                    </li>
                    @endcan
                    @can('viewAny', \App\Grade::class)
                    <li class="nav-item">
                        <a href="{{route('grades.index')}}" class="nav-link">
                            <i class="fa fa-file-import"></i>
                            Import Grades
                        </a>
                    </li>
                    @endcan
                    @can('viewAny', \App\Student::class)
                    <li class="nav-item">
                        <a href="{{route('students.export')}}" class="nav-link">
                            <i class="fa fa-file-export"></i>
                            Export Student Record
                        </a>
                    </li>
                    @endcan
                    @endauth
                </ul>
               
                <!-- Right Side Of Navbar -->
                
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                    
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        @can('viewAny', \App\Student::class)
                            <form class="form-inline my-2 my-lg-0" method="GET" action="{{route('searchs.index')}}">
                                @csrf
                            <div class="input-group">
                                <input class="form-control form-control-sm" type="search" placeholder="Student" aria-label="Search" name="keyword">
                                <button class="input-group-append btn btn-light btn-sm " type="submit"><i class="fa fa-search"></i></button>
                            </div>
                            </form>
                        @endcan
                    @can('viewAny', \App\Program::class)
                    <li class="nav-item">
                        <a href="{{route('archives.index')}}" class="nav-link" title="archives">
                            <i class="fa fa-archive"></i> Archives
                        </a>
                    </li>
                    @endcan
                    @can('viewAny', \App\Program::class)
                        <li class="nav-item">
                        <a href="{{route('bin.index')}}" class="nav-link" title="Bin">
                                <i class="fa fa-trash"></i> Bin
                            </a>
                        </li>
                    @endcan
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa fa-user-circle"></i>
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @can('viewAny', \App\Program::class)
                                    <a href="{{route('settings.index')}}" class="dropdown-item"><i class="fa fa-cog"></i> Setting</a>
                                @endcan
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                                 <i class="fa fa-sign-out-alt"></i>
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
                
            </div>
        </nav>
       
        <main class="container-fluid">
            @auth
            @can('viewAny', \App\Program::class)
            <nav class=" mt-2 d-print-none">
                <ul class="breadcrumb bg-light">
                    @if(Request::segment(1) != 'home')
                    <li>
                        <a href="{{route('home')}}" class="mr-2 text-dark"><i class="fa fa-home"></i></a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    @endif
                    @for($i = 1; $i <= count(Request::segments()); $i++)
                    <li>
                    <a href="{{$i == count(Request::segments()) ? '#' : '/'.Request::segment($i)}}" style="text-transform:capitalize" class="mx-1 text-dark">{{Request::segment($i)}}</a>
                      @if($i < count(Request::segments()) & $i > 0)
                      <i class="fa fa-angle-right"></i>
                      @endif
                    </li>
                    @endfor
                    </ul>
              </nav>
            @endcan
            @endauth
              @if ($errors)
                  @foreach ($errors->all() as $error)
                      <div class="alert alert-danger" role="alert">
                          {{$error}}
                      </div>
                  @endforeach
              @endif
              @if(session('error'))
                      <div class="alert alert-danger">
                          {{session('error')}}
                      </div>
              @endif
              @if(session('success'))
                      <div class="alert alert-success">
                          {{session('success')}}
                      </div>
              @endif
            @yield('content')
        </main>
    </div>
    <div class="container-fluid">
        
    </div>
     <div id="loaders">
         <img src="img/loaders.gif">
     </div>
     <script src="/js/loaders.js"></script>
</body>
</html>
