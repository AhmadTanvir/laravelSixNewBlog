@extends('welcome')

@section('content')
    <div class="container">
      <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
       	<a href="{{ url('/') }}" class="btn btn-danger" style="text-decoration: none; border-radius: 3px">All Post</a>
        <hr>
        <div>
            <p>Category Name: {{ $post->name }}</p>
            <h3>{{ $post->title }}</h3>
            <img src="{{ url($post->image) }}" alt="">
            <p>{{ $post->details }}</p>
        </div>
      </div>
    </div>
    </div>
@endsection