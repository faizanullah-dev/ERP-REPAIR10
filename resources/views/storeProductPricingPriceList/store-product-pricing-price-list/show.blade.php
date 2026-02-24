@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'StoreProductPricingPriceList') }} {{ $storeproductpricingpricelist->id }}</h3>
                    @can('view-'.str_slug('StoreProductPricingPriceList'))
                        <a class="btn btn-success pull-right" href="{{ url('/storeProductPricingPriceList/store-product-pricing-price-list') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $storeproductpricingpricelist->id }}</td>
                            </tr>
                            <tr><th> Produc Pricing Calculator Id </th><td> {{ $storeproductpricingpricelist->produc_pricing_calculator_id }} </td></tr><tr><th> Name </th><td> {{ $storeproductpricingpricelist->name }} </td></tr><tr><th> Quantity </th><td> {{ $storeproductpricingpricelist->quantity }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

