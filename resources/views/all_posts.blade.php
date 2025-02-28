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
                        <img src="{{asset('/uploaded_files/'. $post->image)}}" class="image" alt="">
                        <h3 class="title">{{$post->title}}</h3>

                        <p class="total_reviews"> <i class="fas fa-star"></i> <span>{{$post->reviews_count}}</span></p>
                        <a href="{{route('user.view_post', $post->id)}}" class="inline-btn">view post</a>
                    </div>
                @endforeach
            @else
                <p class="empty">no posts added yet!</p>
            @endif
        </div>
    </section> 
    
    @if($posts->isNotEmpty())
    <div class="page">
        {!!$posts->onEachSide(1)->links()!!}
    </div>
    @endif
@endsection