<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="{{ asset('images/logo/music_logo.png') }}" type="image/png" > 
        
        <title>
            @yield('title','Music Room')
        </title>
        <!-- Fonts -->
        {{-- <link rel="stylesheet" href="{{ asset('fonts/Manrope-Bold.tff') }}"> --}}
        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/layoutClient.css') }}">
        @yield('link')
    </head>
    <body>
        <div class="before-head">
            <div class="first">
                <a href="">home</a> |
                <a href="" class="inst">instruments</a>
            </div>
            <button  class="fb-button"><b class="fab fa-facebook-f pr-1">f</b></button>
             @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}" >Home</a>
                    @else
                        <a href="{{ route('login') }}" >Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
        <nav class="navbar navbar-dark bg-dark">
            <div class="logo">
                <img src="{{ asset('images/logo/music_logo.png') }}" width="120" alt="Music Room logo">
            </div>
            <div class="container w-100 h-100 my_cont">
                <div class="row w-100 h-100">
                    <div class="navbarmenu_div align-middle h-100 d-flex justify-content-center align-items-center">
                        <p onclick="window.location ='/'" class="navbar-item mt-3" style="text-decoration: @yield('nav_menu_music','none') white;">Music</p>
                    </div>
                    <div class="navbarmenu_div align-middle h-100 d-flex justify-content-center align-items-center">
                        <p class="navbar-item mt-3 text-warning" style="text-decoration: @yield('nav_menu_shop','none') gold;">Shop</p>
                    </div>
                    <div class="navbarmenu_div align-middle h-100 d-flex justify-content-center align-items-center">
                        <p  class="navbar-item mt-3" style="text-decoration: @yield('nav_menu_news','none') white;">News</p>
                    </div>
                    <div class="navbarmenu_div align-middle h-100 d-flex justify-content-center align-items-center">
                        <p  class="navbar-item mt-3" style="text-decoration: @yield('nav_menu_event','none') white;">Event</p>
                    </div>
                    @auth
                    <div class="align-middle h-100 d-flex justify-content-right align-items-center">
                        <a href="" >{{ Auth::user()->name }}</a>
                        {{-- <img src="" alt="123"> --}}
                    </div>
                    @endauth
                </div>
            </div>
        </nav>
       <!--  <div class="d-flex">
           <div class="music_info d-flex">
       
               <div class="img" style="background-image:url('{{ asset('images/infoImage/beatles.jpg') }}');">
                   {{-- <img height="85" width="85" src="{{ asset('images/infoImage/beatles.jpg') }}" alt="there is no image!"> --}}
               </div>
               <div class="text">
                   <h5>the beatles</h5>
                   <p> The Most Music Votes Deserved!</p>
               </div>
       
           </div>
       
       
           <div class="music_add">
       
               <div style="background-image:url('{{ asset('images/addImages/images.png') }}');">
                   {{-- <img src="{{ asset('addImages/addPic.png') }}" height="100" alt="123"> --}}
               </div>
       
           </div>
       </div> -->
        <main>
            @yield('main')
        </main>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        @yield('script')
    </body>
</html>