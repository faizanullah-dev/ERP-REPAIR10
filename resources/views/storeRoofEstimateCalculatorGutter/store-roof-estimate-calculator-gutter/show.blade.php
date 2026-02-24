@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'StoreRoofEstimateCalculatorGutter') }} {{ $storeroofestimatecalculatorgutter->id }}</h3>
                    @can('view-'.str_slug('StoreRoofEstimateCalculatorGutter'))
                        <a class="btn btn-success pull-right" href="{{ url('/storeRoofEstimateCalculatorGutter/store-roof-estimate-calculator-gutter') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $storeroofestimatecalculatorgutter->id }}</td>
                            </tr>
                            <tr><th> Roof Estimate Calculator Id </th><td> {{ $storeroofestimatecalculatorgutter->roof_estimate_calculator_id }} </td></tr><tr><th> Recommended Price </th><td> {{ $storeroofestimatecalculatorgutter->recommended_price }} </td></tr><tr><th> Gutter Sub Total </th><td> {{ $storeroofestimatecalculatorgutter->gutter_sub_total }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

