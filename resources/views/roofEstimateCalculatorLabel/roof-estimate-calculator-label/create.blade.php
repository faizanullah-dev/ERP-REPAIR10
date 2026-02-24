@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Create New {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'RoofEstimateCalculatorLabel') }}</h3>
                    @can('view-'.str_slug('RoofEstimateCalculatorLabel'))
                    <a  class="btn btn-success pull-right" href="{{url('/roofEstimateCalculatorLabel/roof-estimate-calculator-label')}}"><i class="icon-arrow-left-circle"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'RoofEstimateCalculatorLabel') }}</a>
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

                    <form method="POST" action="{{ url('/roofEstimateCalculatorLabel/roof-estimate-calculator-label') }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @include ('roofEstimateCalculatorLabel.roof-estimate-calculator-label.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
