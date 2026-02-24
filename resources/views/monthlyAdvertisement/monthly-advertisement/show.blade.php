@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'MonthlyAdvertisement') }} {{ $monthlyadvertisement->id }}</h3>
                    @can('view-'.str_slug('MonthlyAdvertisement'))
                        <a class="btn btn-success pull-right" href="{{ url('/monthlyAdvertisement/monthly-advertisement') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $monthlyadvertisement->id }}</td>
                            </tr>
                            <tr><th> Advertisement Id </th><td> {{ $monthlyadvertisement->advertisement_id }} </td></tr><tr><th> Referral Source Id </th><td> {{ $monthlyadvertisement->referral_source_id }} </td></tr><tr><th> Price </th><td> {{ $monthlyadvertisement->price }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

