@extends('layouts.adminLayout')

@section('main')
<div class="d-flex">
		<div class="container-fluid w-50">
    <div class="card shadow mb-4">
		<div class="card-header py-3">
		  <h6 class="m-0 font-weight-bold text-warning">Create Music Genre</h6>
		</div>
		<div class="card-body">
		  	<div>
		  		<input name="music_genre" id="music_genre" placeholder="For example: rock, rap, techno..." type="text" class="form-control">
		  	</div>
		  		<br>
		  	<div>
		  		<button id="music_genre_button" class="btn btn-warning">save</button>
		  	</div>
		</div>
	</div>
	</div>
	<div class="container-fluid w-50">
    <div class="card shadow mb-4">
		<div class="card-header py-3">
		  <h6 class="m-0 font-weight-bold text-warning">Create Post</h6>
		</div>
		<form action="javascript:void(0);" id="create_post_form" method="POST">
			@csrf
			<div class="card-body">
				<div>
					{{-- GENRE GOES HERE --}}
			  		<select class="form-control" name="genre_id" id="get_genre_select">
			  			
			  		</select>
		  		</div>
		  			<br>
			  	<div>
					<input type="file" name="post_image" class="form-control">
			  	</div>
			  		<br>
			  	<div>
			  		<input name="post_title" id="text" placeholder="Post title..." type="text" class="form-control">
			  	</div>
			  		<br>
			  	<div>
			  		<textarea name="post_desc" class="form-control" id="" cols="30" rows="1" placeholder="Your post description..."></textarea>
			  	</div>
			  		<br>
			  			<label for="isMusicRoomTitle">Allow Music Room Title :</label>
					  	<select name="post_musicroom" class="form-control w-50" id="isMusicRoomTitle">
					  		<option value="0" selected>No</option>
					  		<option value="1">Yes</option>
					  	</select>
			  		<br>
			  	<div>
			  		<button id="instrument_model_button" class="btn btn-warning">save</button>
			  	</div>
			</div>
		</form>
	</div>
	</div>
</div>
@endsection
@section('script')
<script>
getGenres();
$('#music_genre_button').on('click',function(){
	let music_genre = $('#music_genre').val();

	$.ajax({
		type:'POST',
		url:'{{ route('add_music_genre') }}',
		data:{
			_token:"{{ csrf_token() }}",
			music_genre:music_genre
		},
		success:function(){
			getGenres();
		}
	}).fail(function(){
		console.log('problem with route = create_music_genre');
	});
});

function getGenres() {
	$.ajax({
		type:'GET',
		url:'{{ route('get_genres') }}',
		success:function(data){
			$('#get_genre_select').html(data);
		}
	}).fail(function(){
		console.log('problem with route = get_genres');
	});
}

$('#create_post_form').on('submit',function(){
	let data = new FormData($(this)[0]);
	$.ajax({
		type:'POST',
		url:'{{ route('add_post') }}',
		processData: false,
        contentType: false,
        cache: false,
		data:data,
		success:function(data){
			if(data === 1){
				alert('ok!');
			}
		}
	}).fail(function(){
		console.log('problem with route = add_post');
	});
});
</script>
@endsection