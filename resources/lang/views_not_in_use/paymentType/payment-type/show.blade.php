@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'PaymentType') }} {{ $paymenttype->id }}</h3>
                    @can('view-'.str_slug('PaymentType'))
                        <a class="btn btn-success pull-right" href="{{ url('/paymentType/payment-type') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $paymenttype->id }}</td>
                            </tr>
                            <tr>
                                <th> Name </th><td> {{ $paymenttype->name }} </td>
                            </tr>
                            <tr>
                                <th> Status </th><td>  @if($paymenttype->status == 1)
                                        <p class="badge badge-success">Active</p>
                                    @else
                                        <p class="badge badge-warning">Inactive</p>
                                    @endif </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

