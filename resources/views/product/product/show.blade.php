@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Product') }} {{ $product->id }}</h3>
                    @can('view-'.str_slug('Product'))
                        <a class="btn btn-success pull-right" href="{{ url('/product/product') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="left_align_text_tabel">
                        <div class="table-responsive">
                            <table class="table table">
                                <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $product->id }}</td>
                                </tr>
                                <tr>
                                    <th> Product Category </th>
                                    <td> {{ $product->productCategory->name }} </td>
                                </tr>
                                <tr>
                                    <th> Sub Category </th>
                                    <td> {{ $product->sub_category }} </td>
                                </tr>
                                <tr>
                                    <th> Price </th>
                                    <td>{{ number_format($product->price ?? 0, 2) }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

