@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Create New {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Appointment') }}</h3>
                    @can('view-'.str_slug('Appointment'))
                    <a  class="btn btn-success pull-right" href="{{url('/appointment/appointment')}}"><i class="icon-arrow-left-circle"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Appointment') }}</a>
                    @endcan

                    <div class="clearfix"></div>
                    <hr>
                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form method="POST" action="{{ url('/appointment/appointment') }}" accept-charset="UTF-8"
                          class="form-horizontal" id="MyAppointment" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @include ('appointment.appointment.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
