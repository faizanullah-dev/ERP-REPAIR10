@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'RoofEstimateCalculator') }} {{ $roofestimatecalculator->id }}</h3>
                    @can('view-'.str_slug('RoofEstimateCalculator'))
                        <a class="btn btn-success pull-right" href="{{ url('/roofEstimateCalculator/roof-estimate-calculator') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $roofestimatecalculator->id }}</td>
                            </tr>
                            <tr><th> Lead Id </th><td> {{ $roofestimatecalculator->lead_id }} </td></tr><tr><th> Sub Total Eave Rakes </th><td> {{ $roofestimatecalculator->sub_total_eave_rakes }} </td></tr><tr><th> Waste Eave Rakes </th><td> {{ $roofestimatecalculator->waste_eave_rakes }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

