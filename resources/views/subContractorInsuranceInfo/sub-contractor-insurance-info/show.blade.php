@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'SubContractorInsuranceInfo') }} {{ $subcontractorinsuranceinfo->id }}</h3>
                    @can('view-'.str_slug('SubContractorInsuranceInfo'))
                        <a class="btn btn-success pull-right" href="{{ url('/subContractorInsuranceInfo/sub-contractor-insurance-info') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $subcontractorinsuranceinfo->id }}</td>
                            </tr>
                            <tr><th> Worker Compensation Insurance Company Info </th><td> {{ $subcontractorinsuranceinfo->worker_compensation_insurance_company_info }} </td></tr><tr><th> Workers Compensation Contact Name </th><td> {{ $subcontractorinsuranceinfo->workers_compensation_contact_name }} </td></tr><tr><th> Workers Compensation Phone </th><td> {{ $subcontractorinsuranceinfo->workers_compensation_phone }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

