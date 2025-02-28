@extends('layouts.app')

@section('title', 'update review')


@section('content')
    
    
    <!-- account-form section -->
    <section class="account-form">
        <form action="{{route('user.edit_review_update', $review->id)}}" method="post">
            @csrf  
            @method('PUT')
            <h3>edit your review</h3>
            <p>review title <span>*</span></p>
            <input type="text" name="title" class="box" required maxlength="50"
             placeholder="enter review title" value="{{$review->title}}">
             @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror    
            <p>review description <span>*</span></p>
            <textarea name="description" class="box" placeholder="enter review description" 
            maxlength="1000" cols="30" rows="10">{{$review->description}}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror    
            <p>review rating <span>*</span></p>
            <select name="rating" id="rating" class="box" required>
                <option value="1" {{$review->rating == 1 ? 'selected' : ''}}>1</option>
                <option value="2" {{$review->rating == 2 ? 'selected' : ''}}>2</option>
                <option value="3" {{$review->rating == 3 ? 'selected' : ''}}>3</option>
                <option value="4" {{$review->rating == 4 ? 'selected' : ''}}>4</option>
                <option value="5" {{$review->rating == 5 ? 'selected' : ''}}>5</option>
            </select>
            <input type="submit" value="update review" class="btn">
            <a href="{{route('user.view_post', $review->post->id)}}" class="option-btn">go back</a>
        </form>
    </section>
@endsection