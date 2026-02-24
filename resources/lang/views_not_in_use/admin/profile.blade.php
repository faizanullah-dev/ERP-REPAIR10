@extends('layouts.master')

@push('css')
<link href="{{ asset('plugins/components/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet">

<style>

</style>
@endpush

@section('content')
    <section class="user_profile_section pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form id="" action="{{route('profile_update')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="card border-0 box-shadow-card px-3 py-3 borderRadius20">
                            <div class="card-headerr">
                                <h5>Profile</h5>
                                {{--<a href="" class="button borderRadius">Edit <span class="btn_icon"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a>--}}
                                {{--<i class="fa fa-info-circle"></i>--}}
                                <hr>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="profile_img_box">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail">
                                                    @if(auth()->user()->profile->pic != null)
                                                        <img src="{{asset('storage/uploads/users/'.auth()->user()->profile->pic)}}" alt="profile pic">
                                                    @else
                                                        <img src="{{asset('storage/uploads/users/no_avatar.jpg')}}" alt="profile pic">
                                                    @endif
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail"
                                                     style="max-width: 200px; max-height: 200px;"></div>
                                                <div>
                                                <span class="btn btn-default btn-file">
                                                    <span class="fileinput-new">Upload Photo</span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input id="pic" name="pic_file" type="file" accept="image/*" class="form-control"/>
                                                </span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="profile_details_box">
                                            <div class="row">
                                                <div class="heading mt-5 mb-5">
                                                    <h5>Customer Information</h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="first-name" class="form-label input_labels p-18">First Name</label>
                                                        <input type="text" placeholder="Mr.Khan" class="form-control clr_input_fields borderRadius" name="first_name" value="{{auth()->user()->first_name??""}}" id="first-name">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="last-name" class="form-label input_labels p-18">Last Name</label>
                                                        <input type="text" placeholder="Mr.Khan" class="form-control clr_input_fields borderRadius" name="last_name"  value="{{auth()->user()->last_name??""}}" id="last-name">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label input_labels p-18">Email</label>
                                                        <input type="email" placeholder="abc@company.com" class="form-control clr_input_fields borderRadius" name="email" value="{{auth()->user()->email??""}}" id="email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="date-of-birth" class="form-label input_labels p-18">Date Of Birth</label>
                                                        <input type="date" placeholder="Mr.Khan" class="form-control clr_input_fields borderRadius" name="dob"  value="{{auth()->user()->profile->dob??""}}" id="date-of-birth">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="phone" class="form-label input_labels p-18">Phone</label>
                                                        <input type="tel" placeholder="+61 123 4567 890" class="form-control clr_input_fields borderRadius" name="phone" value="{{auth()->user()->profile->phone??""}}" id="phone">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="address" class="form-label input_labels p-18">Address</label>
                                                        <input type="text" placeholder="Abc address" class="form-control clr_input_fields borderRadius" name="address" value="{{auth()->user()->profile->address??""}}" id="address">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <input type="submit"  class="btn btn-primary"  value="Submit" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
<script src="{{ asset('plugins/components/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>


@endpush
