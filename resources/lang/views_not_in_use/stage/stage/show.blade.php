@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Stage') }} {{ $stage->id }}</h3>
                    @can('view-'.str_slug('Stage'))
                        <a class="btn btn-success pull-right" href="{{ url('/stage/stage') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $stage->id }}</td>
                            </tr>
                            <tr><th> Name </th><td> {{ $stage->name }} </td></tr>
                            <tr><th> Colour </th><td><span style="width: 20px; height: 20px; border-radius: 10px; display: block; margin: 0 auto; background-color: {{ $stage->colour_id }}"></span></td></tr>
                            <tr><th> Status </th>
                                <td>
                                    @if($stage->status==1)
                                        <badge class='badge badge-success'>Active</badge>
                                    @else
                                        <badge class='badge badge-warning'>InActive</badge>
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
@endsection

