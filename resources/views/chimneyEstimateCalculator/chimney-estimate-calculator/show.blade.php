@extends('layouts.master')

@section('content')

        <div class="container-fluid">
            <!-- .row -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ChimneyEstimateCalculator') }} {{ $chimneyestimatecalculator->id }}</h3>
                        @can('view-'.str_slug('ChimneyEstimateCalculator'))
                            <a class="btn btn-success pull-right" href="{{ url('/chimneyEstimateCalculator/chimney-estimate-calculator') }}">
                                <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                        @endcan
                        <div class="clearfix"></div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table">
                                <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $chimneyestimatecalculator->id }}</td>
                                </tr>
                                <tr><th> Lead Id </th><td> {{ $chimneyestimatecalculator->lead_id }} </td></tr><tr><th> Sub Total Bricks Rows </th><td> {{ $chimneyestimatecalculator->sub_total_bricks_rows }} </td></tr><tr><th> Waste Bricks Rows </th><td> {{ $chimneyestimatecalculator->waste_bricks_rows }} </td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

