@extends('layouts.app')

@section('title', 'view post')


@section('content')
    
    <!-- view-post section -->
    <section class="view-post">
        <div class="heading"><h1>post details</h1> <a href="{{url('/')}}"
        class="inline-option-btn" style="margin-top: 0;">all posts</a></div>
        
        <div class="row">
            <div class="col">
                <img src="{{asset('uploaded_files/' .$post->image)}}" class="image" alt="">
                <h3 class="title">{{$post->title}}</h3>
            </div>

            <div class="col">
                <div class="flex">
                    <div class="total_reviews">
                    <h3>{{$average}} <i class="fas fa-star"></i></h3>
                    <p>{{$post->reviews_count}} reviews</p>
                    </div>
                </div>
            </div>
        </div>
    </section> 

@endsection
