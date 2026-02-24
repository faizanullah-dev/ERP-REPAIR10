@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'SidingEstimateCalculatorEaveRake') }} {{ $sidingestimatecalculatoreaverake->id }}</h3>
                    @can('view-'.str_slug('SidingEstimateCalculatorEaveRake'))
                        <a class="btn btn-success pull-right" href="{{ url('/sidingEstimateCalculatorEaveRake/siding-estimate-calculator-eave-rake') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $sidingestimatecalculatoreaverake->id }}</td>
                            </tr>
                            <tr><th> Siding Estimate Calculator Id </th><td> {{ $sidingestimatecalculatoreaverake->siding_estimate_calculator_id }} </td></tr><tr><th> Section </th><td> {{ $sidingestimatecalculatoreaverake->section }} </td></tr><tr><th> Eave </th><td> {{ $sidingestimatecalculatoreaverake->eave }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

