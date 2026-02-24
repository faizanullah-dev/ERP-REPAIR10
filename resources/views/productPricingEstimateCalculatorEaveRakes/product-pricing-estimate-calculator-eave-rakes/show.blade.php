@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ProductPricingEstimateCalculatorEaveRake') }} {{ $productpricingestimatecalculatoreaverake->id }}</h3>
                    @can('view-'.str_slug('ProductPricingEstimateCalculatorEaveRake'))
                        <a class="btn btn-success pull-right" href="{{ url('/productPricingEstimateCalculatorEaveRakes/product-pricing-estimate-calculator-eave-rakes') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $productpricingestimatecalculatoreaverake->id }}</td>
                            </tr>
                            <tr><th> Product Pricing Estimate Calculator Id </th><td> {{ $productpricingestimatecalculatoreaverake->product_pricing_estimate_calculator_id }} </td></tr><tr><th> Eave </th><td> {{ $productpricingestimatecalculatoreaverake->eave }} </td></tr><tr><th> Rakes </th><td> {{ $productpricingestimatecalculatoreaverake->rakes }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

