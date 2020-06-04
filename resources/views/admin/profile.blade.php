@extends('layouts.adminLayout')

@section('main')
	<div class="container-fluid ">
    <div class="card shadow mb-4">
		<div class="card-header py-3">
		  <h6 class="m-0 font-weight-bold text-warning">Profile</h6>
		</div>
		<div class="card-body">
			<form id="profile_form" action="javascript:void(0);">
				@csrf
		  	<div>
		  		<input name="category_name" id="profile_image" type="file" class="form-control w-50">
		  		<img src="" style="float: right;margin-right: 15%;" alt="img">
		  	</div>
		  	<br>
		  	<div>
		  		<button id="create_category_button" class="btn btn-warning">save</button>
		  	</div>
		  	</form>
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
$('#profile_form').on('submit',function(){
	$.ajax({
	   type: "POST",
	   url: "",
	   data:  new FormData($('#profile_form')[0]),
	   contentType: false,
	         cache: false,
	   processData:false,
	});
});
</script>
@endsection