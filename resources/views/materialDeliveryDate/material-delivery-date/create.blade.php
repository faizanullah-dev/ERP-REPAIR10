@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Create New {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'MaterialDeliveryDate') }}</h3>
                    @can('view-'.str_slug('MaterialDeliveryDate'))
                    <a  class="btn btn-success pull-right" href="{{url('/materialDeliveryDate/material-delivery-date')}}"><i class="icon-arrow-left-circle"></i> Back {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'MaterialDeliveryDate') }}</a>
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

                    <form method="POST" action="{{ url('/materialDeliveryDate/material-delivery-date') }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data" novalidate>
                        {{ csrf_field() }}

                        @include ('materialDeliveryDate.material-delivery-date.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
