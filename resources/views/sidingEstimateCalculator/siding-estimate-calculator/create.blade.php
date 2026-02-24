@extends('layouts.master')

@section('content')
    <section class="white-box">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Create New {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'SidingEstimateCalculator') }}</h3>
                    @can('view-'.str_slug('SidingEstimateCalculator'))
                    <a  class="btn btn-success pull-right" href="{{url('/sidingEstimateCalculator/siding-estimate-calculator')}}"><i class="icon-arrow-left-circle"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'SidingEstimateCalculator') }}</a>
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

                    <form method="POST" action="{{ url('/sidingEstimateCalculator/siding-estimate-calculator') }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @include ('sidingEstimateCalculator.siding-estimate-calculator.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
    </section>
@endsection
