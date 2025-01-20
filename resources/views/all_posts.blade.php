@extends('layouts.app')

@section('title', 'all_posts')


@section('content')

    <!-- all-posts section -->
    <section class="all-posts">
        <div class="heading"><h1>all posts</h1></div>
        <div class="box-container">
            
            @if($posts->isNotEmpty())
                @foreach($posts as $post)
                    <div class="box">                        
                        <img src="{{asset('/uploaded_files/'. $post->image)}}" alt="">
                        <h3 class="title">{{$post->title}}</h3>
                        <p class="total_reviews">{{$post->reviews_count}}</p>
                        <a href="{{route('user.view_post', $post->id)}}" class="inline-btn">view post</a>
                    </div>
                @endforeach
            @else
                <p class="empty">no posts added yet!</p>
            @endif
        </div>
    </section> 

@endsection