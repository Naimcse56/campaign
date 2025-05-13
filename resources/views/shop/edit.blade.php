<div class="modal fade show" id="exampleLargeModal" tabindex="-1" style="display: block;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title">Edit Information</h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="row g-3" action="{{route('shop.update', $shop->id)}}" method="POST">
                @csrf
                <div class="col-12">
                    <label class="form-label" for="name">Shop Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$shop->name}}">
                </div>
                <div class="col-12">
                    <label class="form-label" for="address">Shop Address</label>
                    <input type="text" class="form-control" name="address" id="address" value="{{$shop->address}}">
                </div>
                <div class="col-12">
                    <label class="form-label" for="phone">Phone No.</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="{{$shop->phone}}">
                </div>
                <div class="col-12">
                    <label class="form-label" for="tin_no">TIN No.</label>
                    <input type="text" class="form-control" name="tin_no" id="tin_no" value="{{$shop->tin_no}}">
                </div>
                <div class="col-12">
                    <label class="form-label" for="is_active">Status</label>
                    <select class="form-select single-select" id="is_active" name="is_active" required>
                        <option value="1" @selected($shop->is_active == 1)>Active</option>
                        <option value="0" @selected($shop->is_active == 0)>In Active</option>
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