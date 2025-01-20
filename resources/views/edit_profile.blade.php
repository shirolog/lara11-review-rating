@extends('layouts.app')

@section('title', 'update profile')


@section('content')

    
    <!-- account-form section -->
    <section class="account-form">
        <form action="{{route('user.profile_update', $user->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h3>update your profile!</h3>
            <p>your name </p>
            <input type="text" name="name" class="box"  maxlength="50" value="{{old('name', $user->name)}}" placeholder="enter your name">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <p>your email </p>
            <input type="email" name="email" class="box"  maxlength="50" value="{{old('name', $user->email)}}" placeholder="enter your email">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <p>old password</p>
            <input type="password" name="old_password" class="box"  maxlength="50" placeholder="enter your old password">
            @error('old_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <p>new password </p>
            <input type="password" name="new_password" class="box"  maxlength="50" placeholder="enter your new password">
            @error('new_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <p>confirm password </p>
            <input type="password" name="new_password_confirmation" class="box"  maxlength="50" placeholder="confirm your new password">
            @error('new_password_confirmation')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            @if(Auth::user()->image != '')
                <img src="{{asset('uploaded_files/'. $user->image)}}" class="image" alt="">
                <input type="submit" class="delete-btn" id="delete-img" data-id="{{$user->id}}" value="delete image">
            @endif
            <p>profie pic</p>
            <input type="file" name="image" class="box" accept="image/*">
            @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <input type="submit" class="btn" value="update now">
        </form>
    </section> 
@endsection

@section('script')
    <script type="text/javascript">
        $(document).on('click', '#delete-img', function(e){

        e.preventDefault();

        const deleteId = $(this).data('id');

        if(confirm('delete this image?')){

            deleteImg(deleteId);
        }
        });

        function deleteImg(deleteId) {
        $.ajax({
            url: '{{route("user.profile_img_destroy", ":id")}}'.replace(":id", deleteId),
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            },
            success: function(response) {
                if (response.status) {
                    window.location.href = '{{route("user.edit_profile", ":id")}}'.replace(":id", deleteId);
                }
            },
        });
 
        }
    </script>
@endsection