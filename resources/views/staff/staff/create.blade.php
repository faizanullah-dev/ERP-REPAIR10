@extends('layouts.master')

@section('content')
    <section class="staff_create_form_sec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                       <div class="row">
                           <div class="col-md-12">
                               <div class="white-box-header">
                                   <div class="white-box-header-left">
                                       <h3 class="box-title">Create New Staff</h3>
                                   </div>
                               </div>
                           </div>
                           <div class="col-md-12">
                               @if ($errors->any())
                                   <ul class="alert alert-danger">
                                       @foreach ($errors->all() as $error)
                                           <li>{{ $error }}</li>
                                       @endforeach
                                   </ul>
                               @endif
                               <form method="POST" action="{{ url('/staff/staff') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="staff-form">
                                   {{ csrf_field() }}
                                   @include ('staff.staff.form')
                               </form>
                           </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
