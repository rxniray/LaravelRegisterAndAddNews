<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FreshNews</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" >
</head>
<body>
    <nav class="nav__header">
        <div class="nav__container">
            <div class="nav__block">
                <ul >
                    <li><h3><a href="{{ route('index') }}"><div class="circle__block"></div>FreshNews</a></h3></li>
                </ul>
                <ul class="nav__nav">
                    @if( auth()->check() )
                    <li>
                        <a href="{{route('profile', auth()->id())}}" style="color:orange;">{{ auth()->user()->name }}</a>
                    </li>
                    <li>
                        <a href="{{ route('auth.logout')}}" style="color:gray">Logout</a>
                    </li>
                    @else
                    <li><a href="{{route('auth.login')}}">Login</a></li>
                    <li><a href="{{ route('registration') }}">
                        Register
                    </a></li>
                @endif
            </ul>
            </div>
        </div>
    </nav>
    <main style="padding-top: 0px">
        @yield('content')
    </main>
</body>
</html>