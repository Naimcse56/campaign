@extends('layouts.app')
@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Human Resource</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">New Employee</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col col-lg-9 mx-auto">
        
        <h6 class="mb-0 text-uppercase">New Employee Information</h6>
        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="border p-3 rounded">
                   <form class="row g-3" action="{{route('employee.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <label class="form-label" for="department_id">Department</label>
                            <select class="form-select single-select" id="department_id" name="department_id" required>
                                @foreach ($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="designation_id">Designation</label>
                            <select class="form-select single-select" id="designation_id" name="designation_id" required>
                                @foreach ($designations as $designation)
                                    <option value="{{$designation->id}}">{{$designation->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="name">Full Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="employee_id">Employee ID</label>
                            <input type="text" class="form-control" name="employee_id" id="employee_id" value="">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="password">Password</label>
                            <input type="text" class="form-control" name="password" id="password" value="{{date('dYm')}}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="mobile">Mobile</label>
                            <input type="text" class="form-control" name="mobile" id="mobile" value="">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="login_access">Login Access</label>
                            <select class="form-select single-select" id="login_access" name="login_access" required>
                                <option value="0" selected>No Login</option>
                                <option value="1">Can Login</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="formFile">Avatar</label>
                            <input class="form-control" type="file" id="formFile" name="file" accept=".jpg, .png, image/jpeg, image/png">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="is_active">Status</label>
                            <select class="form-select single-select" id="is_active" name="is_active" required>
                                <option value="1" selected>Active</option>
                                <option value="0">In Active</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" type="text" id="address" name="address"></textarea>
                        </div>
                        <div class="col-md-12">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                   </form>
                </div>
             </div>
        </div>
    </div>
</div>
<!--end breadcrumb-->
@endsection
@push('scripts')

@endpush
