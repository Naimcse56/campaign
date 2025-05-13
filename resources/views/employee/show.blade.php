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
                <li class="breadcrumb-item active" aria-current="page">Employee Information</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col col-lg-10 mx-auto">        
        <h6 class="mb-0 text-uppercase">{{$employee->user->name}} Details</h6>
        <hr/>
        <div class="card">
            <div class="card shadow-sm border-0 overflow-hidden">
                <div class="card-body">
                    <div class="profile-avatar text-center">
                        <img src="{{showDefaultImage('storage/'.$employee->user->avatar)}}" class="rounded-circle shadow" width="120" height="120" alt="">
                    </div>
                    <div class="d-flex align-items-center justify-content-around mt-5 gap-3">
                        <div class="text-center">
                            <h4 class="mb-0">45</h4>
                            <p class="mb-0 text-secondary">Total Projects</p>
                        </div>
                        <div class="text-center">
                            <h4 class="mb-0">15</h4>
                            <p class="mb-0 text-secondary">Total Project Valuation</p>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <h4 class="mb-1">{{$employee->user->name}} ({{$employee->employee_id}})</h4>
                        <p class="mb-0 text-secondary">{{$employee->user->email}}</p>
                    </div>
                    <hr>
                    <div class="text-start">
                        <h5 class="">Address</h5>
                        <p class="mb-0">
                            {{$employee->address}}
                        </p>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-top">
                        Department
                        <span>{{$employee->department->name}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-top">
                        Designation
                        <span>{{$employee->designation->name}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-top">
                        Mobile
                        <span>{{$employee->user->mobile}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                        Login Access
                        @if ($employee->user->login_access)
                            <span class="badge bg-success rounded-pill">Permitted</span>
                        @else
                            <span class="badge bg-danger rounded-pill">Denied</span>
                        @endif
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                        Status
                        @if ($employee->is_active)
                            <span class="badge bg-success rounded-pill">Active</span>
                        @else
                            <span class="badge bg-danger rounded-pill">In Active</span>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--end breadcrumb-->
@endsection
