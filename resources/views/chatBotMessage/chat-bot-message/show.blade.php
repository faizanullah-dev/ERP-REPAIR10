@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ChatBotMessage') }} {{ $chatbotmessage->id }}</h3>
                    @can('view-'.str_slug('ChatBotMessage'))
                        <a class="btn btn-success pull-right" href="{{ url('/chatBotMessage/chat-bot-message') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $chatbotmessage->id }}</td>
                            </tr>
                            <tr><th> Chat Bot Room Id </th><td> {{ $chatbotmessage->chat_bot_room_id }} </td></tr><tr><th> Sender </th><td> {{ $chatbotmessage->sender }} </td></tr><tr><th> Message </th><td> {{ $chatbotmessage->message }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

