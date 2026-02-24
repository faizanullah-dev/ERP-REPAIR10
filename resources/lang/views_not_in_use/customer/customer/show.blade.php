@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Customer') }} {{ $customer->id }}</h3>
                    @can('view-'.str_slug('Customer'))
                        <a class="btn btn-success pull-right" href="{{ url('/customer/customer') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $customer->id }}</td>
                                </tr>
                                <tr>
                                    <th> Name </th>
                                    <td>{{ $customer->first_name.' '.$customer->last_name ??"Not Avalible"}}</td>
                                </tr>
                                <tr>
                                    <th>Primary Email </th>
                                    <td>{{ $customer->email ??"Not Avalible"}}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $customer->profile->address??"Not Avalible"}}</td>
                                </tr>
                                <tr>
                                    <th>City</th>
                                    <td>{{ $customer->profile->city??"Not Avalible"}}</td>
                                </tr>
                                <tr>
                                    <th>State</th>
                                    <td>{{ $customer->profile->state??"Not Avalible"}}</td>
                                </tr>
                                <tr>
                                    <th>Zip</th>
                                    <td>{{ $customer->profile->zip??"Not Avalible"}}</td>
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <td>{{ $customer->profile->country??"Not Avalible"}}</td>
                                </tr>
                                <tr>
                                    <th>Phone Numbers</th>
                                        <td>
                                            @foreach($customer->customerPhones as $key=>$item)
                                                {{ $item->phone ??"Not Avalible"}}<br>
                                            @endforeach
                                        </td>
                                </tr>
                                <tr>
                                    <th> Company </th>
                                    <td>{{ $customer->company ??"Not Avalible"}}</td>
                                </tr>
                                <tr>
                                    <th> Customer Type</th>
                                    <td> {{ $customer->CustomerType->name??"Not Avalible" }}</td>
                                </tr>
                                <tr>
                                    <th> Salesman </th>
                                    <td> {{ $customer->salesman->name ??'Not Avalible'}}</td>
                                </tr>
                                <tr>
                                    <th> Referral Source </th>
                                    <td> {{ $customer->referralSource->name ??'Not Avalible'}}</td>
                                </tr>
                                <tr>
                                    <th> Customer Note </th>
                                    <td>{{ $customer->customer_note ??"Not Avalible"}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

