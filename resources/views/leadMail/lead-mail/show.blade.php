@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'LeadMail') }} {{ $leadmail->id }}</h3>
                    @can('view-'.str_slug('LeadMail'))
                        <a class="btn btn-success pull-right" href="{{ url('/leadMail/lead-mail') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $leadmail->id }}</td>
                            </tr>
                            <tr><th> Lead Id </th><td> {{ $leadmail->lead_id }} </td></tr><tr><th> User Id </th><td> {{ $leadmail->user_id }} </td></tr><tr><th> Subject </th><td> {{ $leadmail->subject }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

