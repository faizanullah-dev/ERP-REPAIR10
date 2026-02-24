@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'UserCheckIn') }} {{ $usercheckin->id }}</h3>
                    @can('view-'.str_slug('UserCheckIn'))
                        <a class="btn btn-success pull-right" href="{{ url('/userCheckIn/user-check-in') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $usercheckin->id }}</td>
                            </tr>
                            <tr><th> User Id </th><td> {{ $usercheckin->user_id }} </td></tr><tr><th> Date </th><td> {{ $usercheckin->date }} </td></tr><tr><th> Check In </th><td> {{ $usercheckin->check_in }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

