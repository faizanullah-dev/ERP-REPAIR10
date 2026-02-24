@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ProductPricingPriceList') }} {{ $productpricingpricelist->id }}</h3>
                    @can('view-'.str_slug('ProductPricingPriceList'))
                        <a class="btn btn-success pull-right" href="{{ url('/productPricingPriceList/product-pricing-price-list') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $productpricingpricelist->id }}</td>
                            </tr>
                            <tr><th> Product Pricing Calculator Id </th><td> {{ $productpricingpricelist->product_pricing_calculator_id }} </td></tr><tr><th> Estimated Total </th><td> {{ $productpricingpricelist->estimated_total }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

