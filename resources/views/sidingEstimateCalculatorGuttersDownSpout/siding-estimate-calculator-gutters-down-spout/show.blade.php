@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'SidingEstimateCalculatorGuttersDownSpout') }} {{ $sidingestimatecalculatorguttersdownspout->id }}</h3>
                    @can('view-'.str_slug('SidingEstimateCalculatorGuttersDownSpout'))
                        <a class="btn btn-success pull-right" href="{{ url('/sidingEstimateCalculatorGuttersDownSpout/siding-estimate-calculator-gutters-down-spout') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $sidingestimatecalculatorguttersdownspout->id }}</td>
                            </tr>
                            <tr><th> Siding Estimate Calculator Id </th><td> {{ $sidingestimatecalculatorguttersdownspout->siding_estimate_calculator_id }} </td></tr><tr><th> Section </th><td> {{ $sidingestimatecalculatorguttersdownspout->section }} </td></tr><tr><th> Gutters </th><td> {{ $sidingestimatecalculatorguttersdownspout->gutters }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

