@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'RoofEstimateSkylight') }} {{ $roofestimateskylight->id }}</h3>
                    @can('view-'.str_slug('RoofEstimateSkylight'))
                        <a class="btn btn-success pull-right" href="{{ url('/roofEstimateSkylight/roof-estimate-skylight') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $roofestimateskylight->id }}</td>
                            </tr>
                            <tr><th> Roof Estimate Calculator Id </th><td> {{ $roofestimateskylight->roof_estimate_calculator_id }} </td></tr><tr><th> Size </th><td> {{ $roofestimateskylight->size }} </td></tr><tr><th> Quantity </th><td> {{ $roofestimateskylight->quantity }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

