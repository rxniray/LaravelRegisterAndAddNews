@extends('layouts.auth')
@section('content')
<h1 class="autor__posts-profile">News of <span>{{$user->name}}</span></h1>
<form class="autor__post-search-form" method="GET" action="{{ route('profile.search', $user->id) }}">
    @csrf
    <li>
        <input class="autor__post-search-input" type="text" name="search" placeholder="Пошук...">
    </li>
</form>
@if(auth()->check())
    <p class="upload__image-autor"><a href="{{ route('create_image') }}">Upload News</a></p>
@endif
<div class="prifile__post-row" style="display:flex;flex-wrap:wrap;margin:20px; justify-content: center;">
    @foreach ($images as $image)
        <div class= "post__block" style="margin:10px">
            <div class="post__block-content">
                <a href="{{ route('show_image', $image->id) }}">
                @if (strpos($image->name, '.mp4') !== false || strpos($image->name, '.avi') !== false || strpos($image->name, '.mov') !== false|| strpos($image->name, '.wmv') !== false || strpos($image->name, '.mkv') !== false)
                <video controlsList="nodownload">
                    <source src="{{ url('images/'.$image->name) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                @else
                    <img src="{{ url('images/'.$image->name) }}" >
                @endif
                </a>
                <h3><a href="{{ route('show_image', $image->id) }}">  {{ Str::limit($image->description, 100) }}</a></h3>
                <p><a href="{{ route('show_image', $image->id) }}"> {{ Str::limit($image->textnews, 200) }}</a></p>
            </div>
            <div class="manipulation__section">
                @if(auth()->id() == $image->user->id)
                <a class="edit__button" href="{{route('image.edit', $image->id)}}">Edit</a>
                <a class="delete__button"href="{{route('image.destroy.confirm', $image->id)}}">Delete</a>
                @if(session()->has('confirm'))
                    <p style="color: aliceblue; display: flex; gap: 10px; align-items: center;">
                        Are you sure? <a class="delete__button" href="{{route('image.destroy', $image->id)}}">Yes</a>
                    </p>
                @endif
                @endif
            </div>
        </div>
    @endforeach
</div>
<div class="pagination__block">
    {{ $images->links() }}       
</div>
@endsection