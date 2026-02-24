@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'SubContractorProposal') }} {{ $subcontractorproposal->id }}</h3>
                    @can('view-'.str_slug('SubContractorProposal'))
                        <a class="btn btn-success pull-right" href="{{ url('/subContractorProposal/sub-contractor-proposal') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $subcontractorproposal->id }}</td>
                            </tr>
                            <tr><th> Lead Id </th><td> {{ $subcontractorproposal->lead_id }} </td></tr><tr><th> Proposal Id </th><td> {{ $subcontractorproposal->proposal_id }} </td></tr><tr><th> Sub Contractor Id </th><td> {{ $subcontractorproposal->sub_contractor_id }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

