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
                <ul>
                    <li><h3><a href="{{ route('index') }}"><div class="circle__block"></div>FreshNews</a></h3></li>
                </ul>
                <ul class="search__tags">
            <form method="POST" action="{{ route('tag_search')}}">
                @csrf
                <li> 
                    <input type="text" name="search" placeholder="Пошук...">
                </li>
            </form>
        </ul>
                <ul class="nav__nav">
                    @if( auth()->check() )
                        <li>
                            <a href="{{route('profile', auth()->id())}}" style="color:orange;">{{ auth()->user()->name }}</a>
                        </li>
                        <li>
                            <a href="{{ route('auth.logout')}}">Logout</a>
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
    <main class="main__content" style="padding-top: 0px">
        
        <div class="main__container">
            <div class="main__blocks">
                <div class="aside__block">
                @if(auth()->check())
                    <p class="upload__image"><a href="{{ route('create_image') }}">Upload News</a></p>
                @endif
                <div class="tags__list">
                    <h4>Тематика</h4>
                @foreach ($all_tags as $tag)
                    <a href="{{ route('tag', $tag->name )}}"><p>{{ $tag->name }} ({{$tag->images_count}})</p></a>
                @endforeach
                </div>
                </div>
                <div class="main__block">
                @yield('content')
            </div>
        </div>
    </main>
</body>
</html>