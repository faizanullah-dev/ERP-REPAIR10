@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'RoofEstimateCalculatorLabel') }} {{ $roofestimatecalculatorlabel->id }}</h3>
                    @can('view-'.str_slug('RoofEstimateCalculatorLabel'))
                        <a class="btn btn-success pull-right" href="{{ url('/roofEstimateCalculatorLabel/roof-estimate-calculator-label') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $roofestimatecalculatorlabel->id }}</td>
                            </tr>
                            <tr><th> Name </th><td> {{ $roofestimatecalculatorlabel->name }} </td></tr><tr><th> Value </th><td> {{ $roofestimatecalculatorlabel->value }} </td></tr><tr><th> Roof Estimate Calculator Id </th><td> {{ $roofestimatecalculatorlabel->roof_estimate_calculator_id }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

