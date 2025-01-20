<header class="header">
    <section class="flex">
        <a href="{{url('/')}}" class="logo">Logo.</a>
        <nav class="navbar">
            <a href="{{url('/')}}" class="far fa-eye"></a>
            <a href="{{url('/login')}}" class="fas fa-arrow-right-to-bracket"></a>
            <a href="{{url('/register')}}" class="far fa-registered"></a>
            @auth
                <a href="#" class="far fa-user" id="user-btn"></a>
            @endauth
        </nav>
        @auth
            <div class="profile">
                @if(Auth::user()->image != '')
                    <img src="{{asset('uploaded_files/'. Auth::user()->image)}}" class="image" alt="">
                @endif
                <p>{{Auth::user()->name}}</p>
               <a href="{{route('user.edit_profile', Auth::user()->id)}}" class="btn">update profile</a> 
               <a href="{{route('user.logout')}}" class="logout-btn" onclick="return confirm('logout from this website?')">logout</a> 
            </div>
        @endauth
    </section>
</header>