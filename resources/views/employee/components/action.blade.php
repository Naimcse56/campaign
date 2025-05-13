<div class="btn-group">
    <a href="{{route('employee.show', $row->id)}}" class="btn btn-sm btn-outline-info"><i class="lni lni-eye"></i></a>
    <a href="{{route('employee.edit', $row->id)}}" class="btn btn-sm btn-outline-warning"><i class="lni lni-pencil"></i></a>
    <button type="button" onclick="deleteData('Employee', '{{ route('employee.delete') }}', {{ $row->id }})" class="btn btn-sm btn-outline-danger"><i class="lni lni-trash"></i></button>
</div>