@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'MaterialListing') }} {{ $materiallisting->id }}</h3>
                    @can('view-'.str_slug('MaterialListing'))
                        <a class="btn btn-success pull-right" href="{{ url('/materialListing/material-listing') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $materiallisting->id }}</td>
                            </tr>
                            <tr><th> Lead Id </th><td> {{ $materiallisting->lead_id }} </td></tr><tr><th> Material Id </th><td> {{ $materiallisting->material_id }} </td></tr><tr><th> Quantity </th><td> {{ $materiallisting->quantity }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

