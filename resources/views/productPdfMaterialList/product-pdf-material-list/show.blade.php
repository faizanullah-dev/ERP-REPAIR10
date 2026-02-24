@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ProductPdfMaterialList') }} {{ $productpdfmateriallist->id }}</h3>
                    @can('view-'.str_slug('ProductPdfMaterialList'))
                        <a class="btn btn-success pull-right" href="{{ url('/productPdfMaterialList/product-pdf-material-list') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $productpdfmateriallist->id }}</td>
                            </tr>
                            <tr><th> Product Price Pdf Measurement Id </th><td> {{ $productpdfmateriallist->product_price_pdf_measurement_id }} </td></tr><tr><th> Name </th><td> {{ $productpdfmateriallist->name }} </td></tr><tr><th> Unit </th><td> {{ $productpdfmateriallist->unit }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

