@extends('layouts.app')

@section('title', 'add review')


@section('content')

    <!-- account-form section -->
    <section class="account-form">
        <form action="{{route('user.add_view_store', $post->id)}}" method="post">
            @csrf  
            <input type="hidden" name="post_id" value="{{$post->id}}">
            <h3>post your review</h3>
            <p>review title <span>*</span></p>
            <input type="text" name="title" class="box" required maxlength="50"
             placeholder="enter review title">
             @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror    
            <p>review description <span>*</span></p>
            <textarea name="description" class="box" placeholder="enter review description"
            maxlength="1000" cols="30" rows="10"></textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror    
            <p>review rating <span>*</span></p>
            <select name="rating" id="rating" class="box" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <input type="submit" value="submit review" class="btn">
            <a href="{{route('user.view_post', $post->id)}}" class="option-btn">go back</a>
        </form>
    </section> 
@endsection