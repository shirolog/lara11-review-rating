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
                        <h3>{{$average}}</h3>

                        @php 
                            $width = ($average*100) / 5
                        @endphp
                        <div class="stars">
                            <div class="stars-full" style="width: {{ $width }}%;">★★★★★</div>
                            <div class="stars-empty">★★★★★</div>
                        </div>
                        <p>{{$post->reviews_count}} reviews</p>
                    </div>

                    <div class="total-rating">
                        <p>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span>{{$rating_5}}</span>
                        </p>
                        <p>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span>{{$rating_4}}</span>
                        </p>
                        <p>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span>{{$rating_3}}</span>
                        </p>
                        <p>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span>{{$rating_2}}</span>
                        </p>
                        <p>
                            <i class="fas fa-star"></i>
                            <span>{{$rating_1}}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section> 

    <!-- reviews-container section -->
    <section class="reviews-container">
        <div class="heading"><h1>user's reviews</h1> <a href="{{route('user.add_view', $post->id)}}"
        class="inline-btn" style="margin-top: 0;">add review</a></div>

        <div class="box-container">
            @if($reviews->isNotEmpty())
                @foreach($reviews as $review)
                    <div class="box" @if($review->user_id == Auth::id()) style="order:-1;" @endif>
                        <div class="user">
                            @if($review->user->image != '')
                                <img src="{{ asset('uploaded_files/' . $review->user->image) }}" class="image" alt="">
                            @else
                                <h3>{{ substr($review->user->name, 0, 1) }}</h3>
                            @endif
                            
                            <div>
                                <p>{{ $review->user->name }}</p>
                                <span>{{ $review->updated_at }}</span>
                            </div>
                        </div>
                            <div class="ratings">
                                @if($review->rating == 1)
                                    <p style="background: var(--red);"><i class="fas fa-star"></i>
                                    <span>{{$review->rating}}</span></p>
                                @endif

                                @if($review->rating == 2)
                                    <p style="background: var(--orange);"><i class="fas fa-star"></i>
                                    <span>{{$review->rating}}</span></p>
                                @endif

                                @if($review->rating == 3)
                                    <p style="background: var(--orange);"><i class="fas fa-star"></i>
                                    <span>{{$review->rating}}</span></p>
                                @endif

                                @if($review->rating == 4)
                                    <p style="background: var(--main-color);"><i class="fas fa-star"></i>
                                    <span>{{$review->rating}}</span></p>
                                @endif

                                @if($review->rating == 5)
                                    <p style="background: var(--main-color);"><i class="fas fa-star"></i>
                                    <span>{{$review->rating}}</span></p>
                                @endif
                            </div>

                            <h3 class="title">{{$review->title}}</h3>

                            @if($review->description != '')
                                <p class="description">{{$review->description}}</p>
                            @endif

                            @if($review->user_id == Auth::id())
                                <form action="{{route('user.view_post_destroy', $review->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <div class="flex-btn">
                                    <a href="{{route('user.edit_review', $review->id)}}" class="inline-option-btn">edit review</a>
                                    <input type="submit" class="inline-delete-btn" value="delete review" onclick="return confirm('delete this review?');">
                                </div>   
                                </form>
                            @endif
                    </div>
                @endforeach
            @else
                <p class="empty">No reviews added yet!</p>
            @endif

        </div>
    </section> 

    @if($reviews->isNotEmpty())
    <div class="page">
        {!!$reviews->onEachSide(1)->links()!!}
    </div>
    @endif
@endsection
