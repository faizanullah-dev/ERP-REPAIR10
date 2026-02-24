@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'CustomerReferral') }} {{ $customerreferral->id }}</h3>
                    @can('view-'.str_slug('CustomerReferral'))
                        <a class="btn btn-success pull-right" href="{{ url('/customerReferral/customer-referral') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $customerreferral->id }}</td>
                            </tr>
                            <tr><th> First Name </th><td> {{ $customerreferral->first_name }} </td></tr><tr><th> Last Name </th><td> {{ $customerreferral->last_name }} </td></tr><tr><th> Phone </th><td> {{ $customerreferral->phone }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

