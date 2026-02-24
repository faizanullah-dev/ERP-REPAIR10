@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'SubContractorRecurringEmail') }} {{ $subcontractorrecurringemail->id }}</h3>
                    @can('view-'.str_slug('SubContractorRecurringEmail'))
                        <a class="btn btn-success pull-right" href="{{ url('/subContractorRecurringEmail/sub-contractor-recurring-email') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $subcontractorrecurringemail->id }}</td>
                            </tr>
                            <tr><th> Email Template Id </th><td> {{ $subcontractorrecurringemail->email_template_id }} </td></tr><tr><th> Subcontractor Id </th><td> {{ $subcontractorrecurringemail->subcontractor_id }} </td></tr><tr><th> Insurance Type </th><td> {{ $subcontractorrecurringemail->insurance_type }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

