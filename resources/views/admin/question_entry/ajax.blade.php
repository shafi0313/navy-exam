@php $x = 1 @endphp
@foreach ($inputs as $input)
    <tr>
        <td>{{ $x++ }}</td>
        <td><input type="hidden" name="exam_id[]" value="{{ $input->exam_id }}">{!! $input->ques !!}</td>
        <td>{{ ucfirst(preg_replace('/[^a-z]/', ' ', $input->type)) }}</td>
        <td>{{ $input->mark }}</td>
        <td>
            <div class="form-button-action">
                <a href="{{ route('admin.question.edit', $input->id) }}" data-toggle="tooltip" title=""
                    class="btn btn-link btn-primary btn-lg" data-original-title="Show">
                    Edit
                </a>
                <form action="{{ route('admin.question.destroy', $input->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" data-toggle="tooltip" title="" class="btn btn-link btn-danger"
                        data-original-title="Remove">
                        <i class="fa fa-times"></i>
                    </button>
                </form>
            </div>
        </td>
    </tr>
@endforeach
<style>
    p {
        font-size: 14px;
        line-height: 0;
        margin-bottom: 0;
    }
</style>
