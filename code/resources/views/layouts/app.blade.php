<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Whatching') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/custom.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <!-- Scripts -->
    <script src="https://cdn.rawgit.com/showdownjs/showdown/1.5.1/dist/showdown.min.js"></script>
    <script src="/js/app.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Whatching') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li><a href="{{route('homepage')}}"><i class="fa fa-newspaper-o"></i>&nbsp; Feed</a></li>
                            <li><a href="{{route('usersList')}}"><i class="fa fa-users"></i>&nbsp; Community</a></li>



                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                   <i class="fa fa-user"></i>&nbsp; {{ Auth::user()->name }} <span class="caret"></span> <span class="badge" style="background:#c0392b;color:white;">{{Auth::user()->pendingSuggestions->count()}}</span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                <li><a href="{{route('userProfile', ['id' => Auth::id()])}}"><i class="fa fa-th-large"></i>&nbsp; Dashboard</a></li>
                                  <li><a href="/suggestions"><i class="fa fa-thumbs-up"></i>&nbsp; My suggestions <span class="badge" style="background:#c0392b;color:white;">{{Auth::user()->pendingSuggestions->count()}}</span></a></li>
                                    <li>

                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-times"></i>&nbsp; Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>

                        @endif
                    </ul>
                    <form class="navbar-form navbar-right">
                      <div class="form-group input-group ui-widget">
                      @if (!Auth::guest())
                        <span class="input-group-addon" id="basic-addon"><span class="fa fa-search"></span> </span>
                        <input type="text" id="search-bar" name="search" class="form-control" placeholder="Search..." aria-describedby="basic-addon" />
                      @endif
                      </div>
                    </form>
                </div>
            </div>
        </nav>
        @yield('content')


<!--
      <div class="col-md-12 footer">
          <div class="container text-center">

            <p>
              Made with love mainly in the middle of a night of december.
            </p>

          </div>
      </div>
    -->

    </div>

</body>
</html>
