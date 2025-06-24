<div class="modal fade show" id="exampleLargeModal" tabindex="-1" style="display: block;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" action="{{ route('campaign.update', $campaign->id) }}" method="POST">
                    @csrf
                    <div class="col-12">
                        <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" id="title" value="{{ $campaign->title }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="shop_id">Shop ID <span class="text-danger">*</span></label>
                        <select class="form-control" name="shop_id" id="shop_id">
                            <option value="">-- Select --</option>
                            @foreach ($shops as $item)
                                <option value="{{ $item->id }}" @selected($campaign->shop_id == $item->id)>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="start_date">Start Date </label>
                        <input type="date" class="form-control" name="start_date" id="start_date" value="">
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="end_date">End Date</label>
                        <input type="date" class="form-control" name="end_date" id="end_date" value="">
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="details">Details </label>
                        <textarea type="text" class="form-control" name="details" id="details">{{ $campaign->details }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="is_active">Status</label>
                        <select class="form-select single-select" id="is_active" name="is_active" required>
                            <option value="1" @selected($campaign->is_active == 1)>Active</option>
                            <option value="0" @selected($campaign->is_active == 0)>In Active</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
