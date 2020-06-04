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
                    @if($posts->votes) {{ $posts->votes }} @else 0 @endif
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