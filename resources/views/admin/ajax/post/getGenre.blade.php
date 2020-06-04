<option selected>none</option>
@foreach ($musicGenre as $musicGenres)
	<option value="{{ $musicGenres->music_genre_id }}">{{ $musicGenres->title }}</option>
@endforeach