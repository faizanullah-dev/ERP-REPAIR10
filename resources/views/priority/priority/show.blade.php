@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Priority') }} {{ $priority->id }}</h3>
                    @can('view-'.str_slug('Priority'))
                        <a class="btn btn-success pull-right" href="{{ url('/priority/priority') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="left_align_text_tabel">

                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $priority->id }}</td>
                            </tr>
                            <tr>
                                <th> Name </th>
                                <td> {{ $priority->name??"Not Available" }} </td>
                            </tr>
                            <tr>
                                <th> Status </th>
                                <td>
                                    @if($priority->status == 1)
                                        <badge class="badge badge-success">Active</badge>
                                    @else
                                        <badge class="badge badge-warning">Inactive</badge>
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection

