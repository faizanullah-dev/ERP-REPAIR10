@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ProductPricingEstimateCalculatorDownspout') }} {{ $productpricingestimatecalculatordownspout->id }}</h3>
                    @can('view-'.str_slug('ProductPricingEstimateCalculatorDownspout'))
                        <a class="btn btn-success pull-right" href="{{ url('/productPricingEstimateCalculatorDownspouts/product-pricing-estimate-calculator-downspouts') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $productpricingestimatecalculatordownspout->id }}</td>
                            </tr>
                            <tr><th> Product Pricing Estimate Calculator Id </th><td> {{ $productpricingestimatecalculatordownspout->product_pricing_estimate_calculator_id }} </td></tr><tr><th> Gutters </th><td> {{ $productpricingestimatecalculatordownspout->gutters }} </td></tr><tr><th> Downspouts </th><td> {{ $productpricingestimatecalculatordownspout->downspouts }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

