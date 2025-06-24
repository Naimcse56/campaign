<div class="btn-group">
    <button type="button" class="btn btn-sm btn-outline-warning detail_info" data-route="{{ route('campaign.edit', $row->id) }}"><i class="lni lni-pencil"></i></button>
    <a class="btn btn-sm btn-outline-info" href="{{ route('campaign.show', $row->id) }}"><i class="lni lni-eye"></i></a>
    <button type="button" onclick="deleteData('Campaign', '{{ route('campaign.delete') }}', {{ $row->id }})" class="btn btn-sm btn-outline-danger">
        <i class="lni lni-trash"></i></button>
</div>
