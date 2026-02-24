@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ReceivePayment') }} {{ $receivepayment->id }}</h3>
                    @can('view-'.str_slug('ReceivePayment'))
                        <a class="btn btn-success pull-right" href="{{ url('/receivePayment/receive-payment') }}">
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
                                <td>{{ $receivepayment->id }}</td>
                            </tr>
                            <tr><th> Lead </th><td> {{ $receivepayment->getLead->title??"Not Available" }} </td></tr>
                            <tr><th> Payment Type </th><td> {{ $receivepayment->getPaymentType->name??"Not Available" }} </td></tr>
                            <tr><th> Reference Number </th><td> {{ $receivepayment->Reference_number??"Not Available" }} </td></tr>
                            <tr><th> Amount </th><td> {{ $receivepayment->amount??"Not Available" }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

