@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ChatMessage') }} {{ $chatmessage->id }}</h3>
                    @can('view-'.str_slug('ChatMessage'))
                        <a class="btn btn-success pull-right" href="{{ url('/chatMessage/chat-message') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $chatmessage->id }}</td>
                            </tr>
                            <tr><th> Lead Id </th><td> {{ $chatmessage->lead_id }} </td></tr><tr><th> Sender Type </th><td> {{ $chatmessage->sender_type }} </td></tr><tr><th> Message </th><td> {{ $chatmessage->message }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

