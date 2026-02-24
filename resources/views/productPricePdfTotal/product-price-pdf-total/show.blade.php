@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ProductPricePdfTotal') }} {{ $productpricepdftotal->id }}</h3>
                    @can('view-'.str_slug('ProductPricePdfTotal'))
                        <a class="btn btn-success pull-right" href="{{ url('/productPricePdfTotal/product-price-pdf-total') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $productpricepdftotal->id }}</td>
                            </tr>
                            <tr><th> Product Price Pdf Measurement Id </th><td> {{ $productpricepdftotal->product_price_pdf_measurement_id }} </td></tr><tr><th> Name </th><td> {{ $productpricepdftotal->name }} </td></tr><tr><th> Value </th><td> {{ $productpricepdftotal->value }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

