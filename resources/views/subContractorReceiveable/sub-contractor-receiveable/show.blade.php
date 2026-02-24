@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'SubContractorReceiveable') }} {{ $subcontractorreceiveable->id }}</h3>
                    @can('view-'.str_slug('SubContractorReceiveable'))
                        <a class="btn btn-success pull-right" href="{{ url('/subContractorReceiveable/sub-contractor-receiveable') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $subcontractorreceiveable->id }}</td>
                            </tr>
                            <tr><th> Invoice Id </th><td> {{ $subcontractorreceiveable->invoice_id }} </td></tr><tr><th> Lead Id </th><td> {{ $subcontractorreceiveable->lead_id }} </td></tr><tr><th> Payment Type </th><td> {{ $subcontractorreceiveable->payment_type }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

