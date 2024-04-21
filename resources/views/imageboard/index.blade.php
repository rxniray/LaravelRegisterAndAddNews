@extends('layouts/layout')
@section('content')

<div style="display:flex;flex-wrap:wrap; gap: 15px">
    @foreach ($images as $image)
        <div class= "post__block">
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
            <h3><a href="{{ route('show_image', $image->id) }}">  {{ Str::limit($image->description, 40) }}</a></h3>
            <p><a href="{{ route('show_image', $image->id) }}"> {{ Str::limit($image->textnews, 50) }}</a></p>
        </div>
    @endforeach
</div>

<div class="pagination__block">
    {{ $images->links() }}       
</div>
@endsection

