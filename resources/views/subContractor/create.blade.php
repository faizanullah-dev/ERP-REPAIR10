@extends('layouts.master')

@section('content')
    <section class="staff_create_form_sec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <h3 class="box-title pull-left"> Add a Sub Contractor </h3>
                        <div class="clearfix"></div>
                        <hr>
                        <form method="POST" action="{{ url('store_subcontractor') }}" accept-charset="UTF-8"
                              class="form-horizontal" enctype="multipart/form-data" id="staff-form">
                            {{ csrf_field() }}

                            @include ('subContractor.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection