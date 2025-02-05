@extends('layouts.app')

@section('title', 'login')


@section('content')
    
    
    <!-- account-form section -->
    <section class="account-form">
        <form action="{{route('user.authenticate')}}" method="post">
            @csrf
            <h3>welcome back!</h3>
            <p>your email <span>*</span></p>
            <input type="email" name="email" class="box" required maxlength="50" placeholder="enter your email">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror    
            <p>your password <span>*</span></p>
            <input type="password" name="password" class="box" required maxlength="50" placeholder="enter your password">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            @if(session('warning'))
                <span class="text-danger">{{ session('warning') }}</span>
            @endif
            <p class="link">don't have an account? <a href="{{url('/register')}}">register now</a></p>
            <input type="submit" class="btn" value="register now">
        </form>
    </section> 
@endsection