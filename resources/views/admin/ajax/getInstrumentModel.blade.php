@foreach ($myInfo as $instrumentModel)
	<option value="{{ $instrumentModel->instr_model_id }}">{{ $instrumentModel->model_title }}</option>
@endforeach