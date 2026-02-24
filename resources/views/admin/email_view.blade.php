@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'EmailTemplate') }} {{ $email->id }}</h3>
                    @can('view-'.str_slug('EmailTemplate'))
                        <a class="btn btn-success pull-right" href="{{ url('/emailTemplate/email-template') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr><th> FROM </th><td>{{ $email->from ??'' }}</td></tr>
                            <tr><th> TO </th><td>{{ $email->to ??''}}</td></tr>
                            <tr><th> CC </th><td>{{ $email->cc??'' }}</td></tr>
                            <tr><th> BCC </th><td>{{ $email->bcc??'' }}</td></tr>
                            <tr><th> SUBJECT </th><td>{{ $email->subject??'' }}</td></tr>
                            <tr><th> MESSAGE </th><td> {!! $email->message??'' !!}  </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

