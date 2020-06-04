<option value="0" selected>empty</option>
@foreach ($instrument_category as $category)
	<option  value="{{ $category->instr_category_id }}">{{ $category->category_title }}</option>
@endforeach