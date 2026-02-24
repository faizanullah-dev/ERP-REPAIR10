@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ProductPricingEstimateCalculatorFlatArea') }} {{ $productpricingestimatecalculatorflatarea->id }}</h3>
                    @can('view-'.str_slug('ProductPricingEstimateCalculatorFlatArea'))
                        <a class="btn btn-success pull-right" href="{{ url('/productPricingEstimateCalculatorFlatArea/product-pricing-estimate-calculator-flat-area') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $productpricingestimatecalculatorflatarea->id }}</td>
                            </tr>
                            <tr><th> Product Pricing Estimate Calculator Id </th><td> {{ $productpricingestimatecalculatorflatarea->product_pricing_estimate_calculator_id }} </td></tr><tr><th> Eave </th><td> {{ $productpricingestimatecalculatorflatarea->eave }} </td></tr><tr><th> Rakes </th><td> {{ $productpricingestimatecalculatorflatarea->rakes }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

