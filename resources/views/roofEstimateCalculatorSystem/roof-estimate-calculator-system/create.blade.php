@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Create New {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'RoofEstimateCalculatorSystem') }}</h3>
                    @can('view-'.str_slug('RoofEstimateCalculatorSystem'))
                    <a  class="btn btn-success pull-right" href="{{url('/roofEstimateCalculatorSystem/roof-estimate-calculator-system')}}"><i class="icon-arrow-left-circle"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'RoofEstimateCalculatorSystem') }}</a>
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

                    <form method="POST" action="{{ url('/roofEstimateCalculatorSystem/roof-estimate-calculator-system') }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @include ('roofEstimateCalculatorSystem.roof-estimate-calculator-system.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
