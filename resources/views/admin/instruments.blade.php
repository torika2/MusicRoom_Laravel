@extends('layouts.adminLayout')

@section('main')
{{--  --}} {{--  --}}{{--  --}} {{--  --}}{{--  --}} {{--  --}}
<style>
	.added{
		font-size:12px;
	}
	.added:hover{
		opacity: 0.7;
		cursor: pointer;
	}
</style>
<div class="container-fluid w-50" style="float: left;">
    <div class="card shadow mb-4">
		<div class="card-header py-3">
		  <h6 class="m-0 font-weight-bold text-warning">Add Instrument Category</h6>
		</div>
		<div class="card-body">
		  	<div>
		  		<input name="category_name" id="create_category_input" placeholder="For example : strings, brass, keyboard, guitar...ect" type="text" class="form-control">
		  	</div>
		  	<br>
		  	<div>
		  		<button id="create_category_button" class="btn btn-warning">save</button>
		  	</div>
		</div>
	</div>
</div>
{{--  --}} {{--  --}}{{--  --}} {{--  --}}{{--  --}} {{--  --}}
<div class="container-fluid w-50" style="float: right;">
    <div class="card shadow mb-4">
		<div class="card-header py-3">
		  <h6 class="m-0 font-weight-bold text-warning">Add Instrument Model</h6>
		</div>
		<div class="card-body">
			<div>
		  		<select class="form-control" name="category_id" id="create_instrument_select2">
		  			{{-- <option value=""></option> --}}
		  		</select>
	  		</div>
		  	<div>
		  		<br>
		  	<div>
		  		<input name="instrument_model" id="instrument_model" placeholder="For example : fender, ibanez ,yamaha..." type="text" class="form-control">
		  	</div>
		  	</div>
		  	<br>
		  	<div>
		  		<button id="instrument_model_button" class="btn btn-warning">save</button>
		  	</div>
		</div>
	</div>
</div>

{{--  --}} {{--  --}}{{--  --}} {{--  --}}{{--  --}} {{--  --}}
<div class="container-fluid w-50"style="float: right;" >
    <div class="card shadow mb-4">
		<div class="card-header py-3">
		  <h6 class="m-0 font-weight-bold text-warning">Add Instrument</h6>
		</div>
		<form method="POST" action="javascript:void(0);" id="add_instrument_form" enctype="multipart/form-data">
			@csrf
		<div class="card-body">
		  	<div>
		  		<select class="form-control" name="instrument_category" id="get_instrument_select">
		  			{{-- <option value=""></option> --}}
		  		</select>
		  	</div>
		  		<br>
		  	<div>
		  		<select name="instrument_model_category" class="form-control" id="instrument_model_category">
		  			{{-- <option value=""></option> --}}
		  		</select>
		  	</div>
		  		<br>
		  	<div>
		  		<input name="instrument_name" id="instrument_name" placeholder="Instrument name..." type="text" class="form-control">
		  	</div>
		  		<br>
		  	<div>
		  		<input type="number" class="form-control" id="instrument_price" placeholder="Instrument price ..." name="instrument_price" step="0.01">
		  	</div>
		  		<br>
		  	<div>
		  		<textarea class="form-control" style="height: 100px;" name="instrument_desc" id="instrument_desc" cols="30" rows="10"></textarea>
		  	</div>
		  		<br>
			<div>
				<input type="file" name="instrument_image" id="instrument_image">
			</div>
			<div>
				<img id="yourImage" src="#" height="100">
			</div>
				<br>
		  	<div>
		  		<button type="submit" id="add_instrument_button" class="btn btn-warning">save</button>
		  	</div>
		</div>
		</form>
	</div>
</div>
{{--  --}} {{--  --}}{{--  --}} {{--  --}}{{--  --}} {{--  --}}
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>
 <div class="container-fluid">
          <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Instrument list</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
            	<th>Instrument Category</th>
            	<th>Model</th>
				<th>Name</th>
				<th>Description</th>
				<th>Is exist</th>
				<th >Price</th>
				<th colspan="3">Image</th>
            </tr>
          </thead>
          {{-- INSTRUMENT OUTPUT D1V --}}
          <tbody id="insturment_output">
          		
          </tbody>
        </table>
      </div>
    </div>
  </div>

	</div>
</div>
  <!-- Bootstrap core JavaScript-->
@endsection
@section('script')
<script>
getInstruments();
getInstrumentCategory();
$('#yourImage').hide();
$('#yourImage').ready(function(){
 $('#instrument_image').change(function(){
  if (this.files && this.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#yourImage').attr('src', e.target.result);
      };
      reader.readAsDataURL(this.files[0]);
      $('#yourImage').show();
    } else {
      removeUpload();
    }
  }); 
});

@foreach ($instruments as $instr)
	function showMore(id) {
		let text = "{{ $instr->instr_desc }}";
		let btag = document.getElementById('btag'+id);
		btag.innerHTML = text;
		document.getElementById('show'+id).style.visibility="hidden";
		document.getElementById('hide'+id).style.visibility="visible";
	}
@endforeach

function showLess(id) {
	@foreach ($instruments as $instr2)
		if(id === {{ $instr2->instr_id }}){
			let	text = "{{ $instr2->min_text }}";
			let btag = document.getElementById('btag'+id);
			btag.innerHTML = text;
			document.getElementById('show'+id).style.visibility="visible";
			document.getElementById('hide'+id).style.visibility="hidden";
		}
	@endforeach
}

function getInstruments() {
	$.ajax({
		type:'GET',
		url:'{{ route('get_all_insturment') }}',
		success:function(data){
			$('#insturment_output').html(data);
		}
	}).fail(function(){
		console.log('problem with route = get_all_insturment');
	});
}

function deleteInstrument(instr_id) {
	$.ajax({
		type:'POST',
		url:"{{ route('delete_instrument') }}",
		data:{
			_token:"{{ csrf_token() }}",
			instr_id:instr_id
		},
		success:function(){
			getInstruments();
		}
	}).fail(function(){
		console.log('problem with route = delete_instrument');
	});
}

$('#create_category_button').on('click',function(){
	let category_name = $('#create_category_input ').val();
	$.ajax({
		type:'POST',
		url:'{{ route('add_instrument_category') }}',
		data:{
			_token:'{{ csrf_token() }}',
			category_name:category_name
		},
		success:function(){
			getInstrumentCategory();
		}
	}).fail(function(){
		console.log('problem with route = add_instrument_category');
	});
});

function getInstrumentCategory() {
	$.ajax({
		type:'GET',
		url:'{{ route('get_instrument_category') }}',
		success:function(data){
			$('#get_instrument_select').html(data);
			$('#create_instrument_select2').html(data);
		}
	}).fail(function(){
		console.log('problem with route = get_instrument_category');
	});
}

$('#instrument_model_button').on('click',function(){
let category_id = $('#create_instrument_select2').val();
let instrument_model = $('#instrument_model').val();
	$.ajax({
		type:'POST',
		url:'{{ route('add_instrument_model') }}',
		data:{
			_token:'{{ csrf_token() }}',
			category_id:category_id,
			instrument_model:instrument_model
		},
		success:function(data){
			if(data == 3){
				alert('select is empty!');
			}else if(data == 1){
				alert('done');
			}else{
				console.log('something get wrong!');
			}
		}
	}).fail(function(){
		console.log('problem with route = add_instrument_model')
	});
});

$('#get_instrument_select').on('change',function(){
	let category_id = $('#get_instrument_select').val();
	$.ajax({
		type:'POST',
		url:'{{ route('get_instrument_model') }}',
		data:{
			_token:'{{ csrf_token() }}',
			category_id:category_id
		},
		success:function(data){
			$('#instrument_model_category').html(data);
		}
	}).fail(function(){
		console.log('problem with route = add_instrument_model')
	});
});


$('#add_instrument_form').on('submit',function(){
	let data = new FormData($(this)[0]);

	$.ajax({
		type:'POST',
		url:'{{ route('add_instrument') }}',
		processData: false,
        contentType: false,
        cache: false,
		data:data,
		success:function(data){
			getInstruments();
			$('#instrument_model_category').html(data);
		}
	}).fail(function(){
		console.log('problem with route = add_instrument_model')
	});
});
</script>
@endsection