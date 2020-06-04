@extends('layouts.clientLayout')
@section('nav_menu_music','underline')
@section('link')
    <link rel="stylesheet" href="{{ asset('css/client/welcome.css') }}">
@endsection
@section('main')
<div class="d-flex">
    {{-- POST GOES HERE --}}
    <div id="post_output">
        @foreach ($post as $posts)
        <div class="musicroom_post">
            <div class="post-talk d-flex">
                @if ($posts->set_musicroom_title)
                    <div class="music_room">
                        @if (!$posts->admin)
                            {{ $posts->name }}
                        @else
                            Music Room
                        @endif
                    </div>
                @endif
                <div class="img_div">
                    <img src="{{ asset('images/postImage/') }}/{{ $posts->image_url }}" alt="123">
                    <div class="button_section d-flex">
                        <button class="btn btn-info vote">Vote</button>
                        <button class="btn btn-dark music_vote_count">
                          {{ $posts->votes }} 
                        </button>
                    </div>
                </div>
                <div class="text_div">
                    <h4>{{ $posts->text_header }}</h4>
                    <p>
                       {{ $posts->description }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div>
        <div class="tickets">
            <div class="music_room">
                 Music Room
            </div>
            <div>
                <a href="">
                    <img width="360" src="{{ asset('images/ticketImage/jazz.jpg') }}" alt="123">
                </a>
            </div>
        </div>
        <div class="tickets">
            <div class="music_room">
                 Music Room
            </div>
            <div>
                <a href="">
                    <img width="360" src="{{ asset('images/ticketImage/techno.jpg') }}" alt="123">
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
// get_post();
// setInterval(function(){
//     get_post();
// },3000);
// function get_post() {
//     $.ajax({
//         type:'GET',
//         url:'{{ route('get_post') }}',
//         success:function(data){
//             $('#post_output').html(data);
//         }
//     }).fail(function(){
//         console.log('problem with route = get_post');
//     });
// }
</script>
@endsection