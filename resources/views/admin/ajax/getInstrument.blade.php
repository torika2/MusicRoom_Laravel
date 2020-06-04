@foreach ($instruments as $instr)
    <tr>
        <td>
            {{ $instr->category_title }}
        </td>
        <td>
            {{ $instr->model_title }}
        </td>
        <td>{{ $instr->instr_name }}</td>
        <td>
            <div id="btag{{ $instr->instr_id }}">
                {{ $instr->min_text }}
            </div>
            @if (strlen($instr->instr_desc) >= 40)
                <b class='added' id="show{{ $instr->instr_id }}" onclick="showMore({{ $instr->instr_id }})">Show more...</b>
                <b class='added' id="hide{{ $instr->instr_id }}" style="visibility: hidden;" onclick="showLess({{ $instr->instr_id }})">Show less...</b>
            @endif
        </td>
        <td>{{ $instr->instr_exist }}</td>
        <td>{{ $instr->instr_price }}$</td>
        <td><img src="{{ asset('images/instrumentImages') }}/{{ $instr->image_url }}" height="100"></td>
        <td>
            <button disabled="disable" class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit">save</button>
        </td>
        <td>
            <button onclick="deleteInstrument({{ $instr->instr_id }})" class="btn btn-danger btn-sm rounded-0" id="instrument_delete_button" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash" ></i></button>
        </td>
    </tr>
@endforeach