@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'EmailBranding') }} {{ $emailbranding->id }}</h3>
                    @can('view-'.str_slug('EmailBranding'))
                        <a class="btn btn-success pull-right" href="{{ url('/emailBranding/email-branding') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $emailbranding->id }}</td>
                            </tr>
                            <tr><th> Description </th><td> {{ $emailbranding->description }} </td></tr><tr><th> Name </th><td> {{ $emailbranding->name }} </td></tr><tr><th> Designation </th><td> {{ $emailbranding->designation }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

