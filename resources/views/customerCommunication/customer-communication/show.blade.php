@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'CustomerCommunication') }} {{ $customercommunication->id }}</h3>
                    @can('view-'.str_slug('CustomerCommunication'))
                        <a class="btn btn-success pull-right" href="{{ url('/customerCommunication/customer-communication') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $customercommunication->id }}</td>
                            </tr>
                            <tr><th> User Id </th><td> {{ $customercommunication->user_id }} </td></tr><tr><th> Subject </th><td> {{ $customercommunication->subject }} </td></tr><tr><th> From </th><td> {{ $customercommunication->from }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

