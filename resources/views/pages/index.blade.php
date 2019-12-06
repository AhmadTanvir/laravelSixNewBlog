@extends('welcome')

@section('content')
	<div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        @foreach ($post as $row)
          <div class="post-preview">
            <a href="{{ url('view/posts', $row->id) }}">
              <img src="{{ url($row->image) }}" width="200" height="200" alt="">
              <h2 class="post-title">
                {{ $row->title }}
              </h2>
            </a>
            <p class="post-meta">Category
              <a href="#">{{ $row->name }}</a>
              on Slug {{ $row->slug }}</p>
          </div>
        @endforeach
        <hr>
        {{ $post->links() }}
        <!-- Pager -->
        <div class="clearfix">
          <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
        </div>
      </div>
    </div>
@endsection