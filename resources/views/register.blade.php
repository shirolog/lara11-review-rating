@extends('layouts.app')

@section('title', 'register')


@section('content')

        <!-- account-form section -->
        <section class="account-form">
            <form action="{{route('user.register_store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <h3>make your account!</h3>
                <p>your name </p>
                <input type="text" name="name" class="box" required maxlength="50" placeholder="enter your name">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <p>your email </p>
                <input type="email" name="email" class="box" required maxlength="50" placeholder="enter your email">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <p>your password </p>
                <input type="password" name="password" class="box" required maxlength="50" placeholder="enter your password">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <p>confirm password </p>
                <input type="password" name="password_confirmation" class="box" required maxlength="50" placeholder="confirm your password">
                @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <p>profile pic </p>
                <input type="file" name="image" class="box" accept="image/*">
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <p class="link">already have an account? <a href="{{url('/login')}}">login now</a></p>
                <input type="submit" class="btn" value="register now">
            </form>
        </section>     
@endsection