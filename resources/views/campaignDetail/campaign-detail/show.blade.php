@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'CampaignDetail') }} {{ $campaigndetail->id }}</h3>
                    @can('view-'.str_slug('CampaignDetail'))
                        <a class="btn btn-success pull-right" href="{{ url('/campaignDetail/campaign-detail') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $campaigndetail->id }}</td>
                            </tr>
                            <tr><th> Day </th><td> {{ $campaigndetail->day }} </td></tr><tr><th> Time </th><td> {{ $campaigndetail->time }} </td></tr><tr><th> Message Type </th><td> {{ $campaigndetail->message_type }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

