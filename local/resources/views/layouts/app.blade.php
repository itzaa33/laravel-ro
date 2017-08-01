<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Css ทำเอง -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
<!-- template -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/prettyPhoto.css')}}" rel="stylesheet">
        <link href="{{asset('css/price-range.css')}}" rel="stylesheet">
        <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    	  <link href="{{asset('css/main.css')}}" rel="stylesheet">
    	  <link href="{{asset('css/responsive.css')}}" rel="stylesheet">
        <!-- thempbutton -->
        <link href="{{asset('css/slant.css')}}" rel="stylesheet">
        <link href="{{asset('css/gradient.css')}}" rel="stylesheet">

        <link rel="shortcut icon" href="images/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('images/ico/apple-touch-icon-144-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('images/ico/apple-touch-icon-114-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('images/ico/apple-touch-icon-72-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed" href="{{asset('images/ico/apple-touch-icon-57-precomposed.png')}}">


        <!-- ส่วนของ Bootstrap -->
        <script src="{{ asset('js/popupImage.js') }}"></script>


    <!-- bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css')}}" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="{{asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css')}}" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css')}}">
    <!-- popup Image -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

    <div class="header">
        <!-- <nav class="header-middle"> -->
            <div class="container">
              <div class="row">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                </div>






                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                  <!-- Branding Image -->
                  <div class="logo pull-left">
                    <a href="{{ url('/home') }}"><img src="{{asset('BG/logo.png')}}" alt="" width="100" ></a>
                    <!-- {{ config('app.name', 'Laravel') }} -->
                  </div>
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}"><font color="#1ed8e8"><i class="fa fa-lock"></i> Login</font></a></li>
                            <li><a href="{{ route('register') }}"><font color="#1ed8e8"><i class="fa fa-user"></i> Register</font></a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                  <font color="#1ed8e8">  {{ Auth::user()->name }} <span class="caret"></span></font>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <font color="#1ed8e8">
                                                     <i class="glyphicon glyphicon-log-out"></i>
                                            Logout
                                          </font>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
              </div>
          </div>
      <!-- </nav> -->
    </div>

    @yield('head_navbar')
    @yield('content')
    @yield('dow_navbar')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

</head>
</html>
