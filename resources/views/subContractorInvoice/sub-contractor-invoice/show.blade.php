@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'SubContractorInvoice') }} {{ $subcontractorinvoice->id }}</h3>
                    @can('view-'.str_slug('SubContractorInvoice'))
                        <a class="btn btn-success pull-right" href="{{ url('/subContractorInvoice/sub-contractor-invoice') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $subcontractorinvoice->id }}</td>
                            </tr>
                            <tr><th> Invoice Unique Id </th><td> {{ $subcontractorinvoice->invoice_unique_id }} </td></tr><tr><th> Lead Id </th><td> {{ $subcontractorinvoice->lead_id }} </td></tr><tr><th> Job Id </th><td> {{ $subcontractorinvoice->job_id }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

