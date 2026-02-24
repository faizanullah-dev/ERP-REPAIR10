@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'SubContractorInvoiceAttachment') }} {{ $subcontractorinvoiceattachment->id }}</h3>
                    @can('view-'.str_slug('SubContractorInvoiceAttachment'))
                        <a class="btn btn-success pull-right" href="{{ url('/subContractorInvoiceAttachment/sub-contractor-invoice-attachment') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $subcontractorinvoiceattachment->id }}</td>
                            </tr>
                            <tr><th> Invoice Id </th><td> {{ $subcontractorinvoiceattachment->invoice_id }} </td></tr><tr><th> Product Name </th><td> {{ $subcontractorinvoiceattachment->product_name }} </td></tr><tr><th> Quantity </th><td> {{ $subcontractorinvoiceattachment->quantity }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

