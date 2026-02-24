@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ProductPricePdfMeasurement') }} {{ $productpricepdfmeasurement->id }}</h3>
                    @can('view-'.str_slug('ProductPricePdfMeasurement'))
                        <a class="btn btn-success pull-right" href="{{ url('/productPricePdfMeasurement/product-price-pdf-measurement') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $productpricepdfmeasurement->id }}</td>
                            </tr>
                            <tr><th> Product Pricing Calculator Id </th><td> {{ $productpricepdfmeasurement->product_pricing_calculator_id }} </td></tr><tr><th> Note </th><td> {{ $productpricepdfmeasurement->note }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

