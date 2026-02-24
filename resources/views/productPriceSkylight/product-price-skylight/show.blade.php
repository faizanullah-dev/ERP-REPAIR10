@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ProductPriceSkylight') }} {{ $productpriceskylight->id }}</h3>
                    @can('view-'.str_slug('ProductPriceSkylight'))
                        <a class="btn btn-success pull-right" href="{{ url('/productPriceSkylight/product-price-skylight') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $productpriceskylight->id }}</td>
                            </tr>
                            <tr><th> Product Price Calculator Id </th><td> {{ $productpriceskylight->product_price_calculator_id }} </td></tr><tr><th> Size </th><td> {{ $productpriceskylight->size }} </td></tr><tr><th> Qunatity </th><td> {{ $productpriceskylight->qunatity }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

