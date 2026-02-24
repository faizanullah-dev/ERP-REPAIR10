@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'EmailTemplateVariable') }} {{ $emailtemplatevariable->id }}</h3>
                    @can('view-'.str_slug('EmailTemplateVariable'))
                        <a class="btn btn-success pull-right" href="{{ url('/emailTemplateVariable/email-template-variable') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $emailtemplatevariable->id }}</td>
                            </tr>
                            <tr><th> Name </th><td> {{ $emailtemplatevariable->name??'' }} </td></tr><tr><th> Value </th><td> {{ $emailtemplatevariable->value??'' }} </td></tr><tr><th> Type </th><td> {{ $emailtemplatevariable->emailVariableType->name??'' }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

