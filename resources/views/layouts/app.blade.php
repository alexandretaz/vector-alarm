<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'VIP Card') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css
">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
                        {{ config('app.name', 'Vip Card') }}
                    </a>
                </div>
                <div class="collapse navbar-collapse" >
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav" id="app-navbar-collapse">
                        <li> <a href="{{route('users')}}">Usuários</a></li>
                        <li><a href="{{route('contracts')}}">Contratos</a></li>
                        <li><a href="{{route('home')}}">Central de Gerenciamento</a></li>
                        <li><a href="/chamados">Chamados</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                        @else
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/manifest.js') }}"></script>
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        var maxAlarm;
        var maxHelp;
        function check(){
            window.setTimeout(function(){
                $.ajax({
                    url: '/api/V1/lastcall/'+maxAlarm+'/'+maxHelp,
                    method:'get',
                    dataType:'json'
                }).done(function (data) {
                    console.dir(data);
                    $("#callNumbers").html(data.openCalls);
                    if(data.lastAlarm>maxAlarm || data.lastHelp>maxHelp){
                        new Audio('/alarm.mp3').play();
                        maxAlarm = data.lastAlarm;
                        maxHelp = data.lastHelp;
                        alert('Você tem novos chamados');
                    }
                });
            }, 1000);
            check();
        }

        $(document).on('ready', function(){
            $.ajax({
                url: '/api/V1/calls',
                method:'get',
                dataType:'json',
            }).done(function(data){
                console.dir(data);
                $("#callNumbers").html(data.openCalls);
                maxAlarm = data.lastAlarm;
                maxHelp = data.lastHelp;
                check();
            });



        });

    </script>
</body>
</html>
