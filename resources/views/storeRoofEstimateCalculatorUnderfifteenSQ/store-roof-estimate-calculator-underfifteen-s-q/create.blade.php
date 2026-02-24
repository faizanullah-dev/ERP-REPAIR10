@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Create New {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'StoreRoofEstimateCalculatorUnderfifteenSQ') }}</h3>
                    @can('view-'.str_slug('StoreRoofEstimateCalculatorUnderfifteenSQ'))
                    <a  class="btn btn-success pull-right" href="{{url('/storeRoofEstimateCalculatorUnderfifteenSQ/store-roof-estimate-calculator-underfifteen-s-q')}}"><i class="icon-arrow-left-circle"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'StoreRoofEstimateCalculatorUnderfifteenSQ') }}</a>
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

                    <form method="POST" action="{{ url('/storeRoofEstimateCalculatorUnderfifteenSQ/store-roof-estimate-calculator-underfifteen-s-q') }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @include ('storeRoofEstimateCalculatorUnderfifteenSQ.store-roof-estimate-calculator-underfifteen-s-q.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
