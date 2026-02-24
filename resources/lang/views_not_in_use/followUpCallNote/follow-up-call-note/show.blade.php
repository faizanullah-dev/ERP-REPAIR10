@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'FollowUpCallNote') }} {{ $followupcallnote->id }}</h3>
                    @can('view-'.str_slug('FollowUpCallNote'))
                        <a class="btn btn-success pull-right" href="{{ url('/followUpCallNote/follow-up-call-note') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $followupcallnote->id }}</td>
                            </tr>
                            <tr><th> Lead </th><td> {{ $followupcallnote->getLead->title }} </td></tr>
                            <tr><th> Mark </th><td> {{ $followupcallnote->mark }} </td></tr>
                            <tr><th> Description </th><td> {{ strip_tags($followupcallnote->description) }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

