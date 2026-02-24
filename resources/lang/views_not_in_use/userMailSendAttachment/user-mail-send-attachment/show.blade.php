@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'UserMailSendAttachment') }} {{ $usermailsendattachment->id }}</h3>
                    @can('view-'.str_slug('UserMailSendAttachment'))
                        <a class="btn btn-success pull-right" href="{{ url('/userMailSendAttachment/user-mail-send-attachment') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $usermailsendattachment->id }}</td>
                            </tr>
                            <tr><th> User Mail Send Id </th><td> {{ $usermailsendattachment->user_mail_send_id }} </td></tr><tr><th> Name </th><td> {{ $usermailsendattachment->name }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

