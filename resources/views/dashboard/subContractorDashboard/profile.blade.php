@extends('layouts.new-master')

@push('css')

@endpush

@section('content')
    <section class="profile_section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="white-box-header">
                            <h4>Profile Settings</h4>
                        </div>
                        <form id="" action="{{url('update_subcontractor_profile')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Information</h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name" class="control-label">First Name *</label>
                                        <input class="form-control" placeholder="Enter First Name" name="first_name" type="text" id="first_name" required value="{{$subcontractor->first_name??''}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name" class="control-label">Last Name</label>
                                        <input class="form-control" placeholder="Enter Last Name" name="last_name" type="text" id="last_name" value="{{$subcontractor->last_name??''}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="control-label">Title *</label>
                                        <input class="form-control" placeholder="Enter Title" name="title" type="text" id="title" required value="{{$subcontractor->profile->title??''}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="control-label">Email</label>
                                        <input class="form-control" placeholder="Enter Email" name="email" type="text" id="email" value="{{$subcontractor->email??''}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone" class="control-label">Phone</label>
                                        <input class="form-control" placeholder="Enter Phone" name="phone" type="text" id="phone" value="{{$subcontractor->profile->phone??''}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password" class="control-label">Password</label>
                                        <input class="form-control" placeholder="Enter Password" name="password" type="password" id="password">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="notes" class="control-label">Notes</label>
                                        <textarea class="form-control" placeholder="Enter Notes" rows="10" name="notes" id="notes">{{$subcontractor->profile->notes??''}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit"  class="btn btn btn_primary" >
                                            Update <i class="fa fa-check"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')

@endpush
