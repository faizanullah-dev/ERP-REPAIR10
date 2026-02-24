{{--@extends('layouts.master')--}}

{{--@section('content')--}}
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
{{--                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'UsersMailboxConfiguration') }} {{ $usersmailboxconfiguration->id }}</h3>--}}
{{--                    @can('view-'.str_slug('UsersMailboxConfiguration'))--}}
{{--                        <a class="btn btn-success pull-right" href="{{ url('/usersMailboxConfiguration/users-mailbox-configuration') }}">--}}
{{--                        <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>--}}
{{--                    @endcan--}}
                    <div class="clearfix"></div>
                    <hr>
                    <div class="left_align_text_tabel">
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                                <tr>
                                    <th> User  </th>
                                    <td> @if(isset($usersmailboxconfiguration->user->name) && $usersmailboxconfiguration->user->name == 'User') Admin @else {{ $usersmailboxconfiguration->user->name ??'not available' }} @endif </td>
                                </tr>
                                <tr>
                                    <th> Mail Host </th>
                                    <td> {{ $usersmailboxconfiguration->mail_host ??'not available' }} </td>
                                </tr>
                                <tr>
                                    <th> Mail Port </th>
                                    <td> {{ $usersmailboxconfiguration->mail_port ??'not available' }} </td>
                                </tr>
                                <tr>
                                    <th> Mail Encryption Type </th>
                                    <td> {{ $usersmailboxconfiguration->mail_encryption_type ??'not available' }} </td>
                                </tr>
                                <tr>
                                    <th> Mail User Name </th>
                                    <td> {{ $usersmailboxconfiguration->mail_username ?? 'not available' }} </td>
                                </tr>
                                <tr>
                                    <th> Mail Protocol </th>
                                    <td> {{ $usersmailboxconfiguration->mail_protocol ?? 'not available' }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--@endsection--}}

