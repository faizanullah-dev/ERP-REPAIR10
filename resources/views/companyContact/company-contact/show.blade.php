@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'CompanyContact') }} {{ $companycontact->id }}</h3>
                    @can('view-'.str_slug('CompanyContact'))
                        <a class="btn btn-success pull-right" href="{{ url('/companyContact/company-contact') }}">
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
                                <td>{{ $companycontact->id }}</td>
                            </tr>
                            <tr><th> Category </th><td> {{ $companycontact->category->name }} </td></tr>
                            <tr><th> Company </th><td> {{ $companycontact->company }} </td></tr>
                            <tr><th> Name </th><td> {{ $companycontact->name }} </td></tr>
                            <tr><th> Address </th><td> {{ $companycontact->address }} </td></tr>
                            <tr><th> Email </th><td> {{ $companycontact->email }} </td></tr>
                            <tr><th> Phone </th><td> {{ $companycontact->phone }} </td></tr>
                            <tr><th> Insurance Start </th><td> {{ \Carbon\Carbon::parse($companycontact->insurance_start ?? '')->format('m-d-Y') ?? 'Not Available' }} </td></tr>
                            <tr><th> Insurance Expire </th><td> {{ \Carbon\Carbon::parse($companycontact->insurance_expire ?? '')->format('m-d-Y') ?? 'Not Available' }} </td></tr>
                            <tr><th> Total Paid </th><td> {{ number_format((float) str_replace(',', '', $companycontact->total_paid) ?? 0, 2, '.', ',') }} </td></tr>
                            <tr>
                                <th> Status </th>
                                <td>
                                    @if($companycontact->insurance_status == 'active' )
                                        <badge class="badge badge-success">Active</badge>
                                    @else
                                        <badge  class="badge badge-danger">Expire</badge>
                                    @endif
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

