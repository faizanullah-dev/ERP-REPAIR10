@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'SidingEstimateCalculator') }} {{ $sidingestimatecalculator->id }}</h3>
                    @can('view-'.str_slug('SidingEstimateCalculator'))
                        <a class="btn btn-success pull-right" href="{{ url('/sidingEstimateCalculator/siding-estimate-calculator') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $sidingestimatecalculator->id }}</td>
                            </tr>
                            <tr><th> Lead Id </th><td> {{ $sidingestimatecalculator->lead_id }} </td></tr><tr><th> Waste Percent Eave Rakes </th><td> {{ $sidingestimatecalculator->waste_percent_eave_rakes }} </td></tr><tr><th> Waste Eave Rakes </th><td> {{ $sidingestimatecalculator->waste_eave_rakes }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

