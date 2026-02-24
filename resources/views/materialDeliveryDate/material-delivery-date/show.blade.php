@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'MaterialDeliveryDate') }} {{ $materialdeliverydate->id }}</h3>
                    @can('view-'.str_slug('MaterialDeliveryDate'))
                        <a class="btn btn-success pull-right" href="{{ url('/materialDeliveryDate/material-delivery-date') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $materialdeliverydate->id }}</td>
                            </tr>
                            <tr><th> Material Delivery Date </th>
                                <td> {{ \Carbon\Carbon::createFromFormat('Y-m-d', $materialdeliverydate->material_delivery_date)->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <th> Description </th>
                                <td> {!! $materialdeliverydate->description !!} </td>
                            </tr>
                            <tr>
                                <th> Material </th>
                                <td> {!! $materialdeliverydate->getMaterial->name  !!} </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

