@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'CustomerPhone') }} {{ $customerphone->id }}</h3>
                    @can('view-'.str_slug('CustomerPhone'))
                        <a class="btn btn-success pull-right" href="{{ url('/customerPhone/customer-phone') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $customerphone->id }}</td>
                            </tr>
                            <tr><th> Customer Id </th><td> {{ $customerphone->customer_id }} </td></tr><tr><th> Phone Type Id </th><td> {{ $customerphone->phone_type_id }} </td></tr><tr><th> Phone </th><td> {{ $customerphone->phone }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

