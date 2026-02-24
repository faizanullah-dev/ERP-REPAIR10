@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'TermAndCondition') }} {{ $termandcondition->id }}</h3>
                    @can('view-'.str_slug('TermAndCondition'))
                        <a class="btn btn-success pull-right" href="{{ url('/termAndCondition/term-and-condition') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $termandcondition->id }}</td>
                            </tr>
                            <tr><th> Description </th><td> {{ $termandcondition->description }} </td></tr>
                            <tr><th> Status </th><td>@if($termandcondition->status == 1 ?? '') <badge class='badge badge-success'>Active</badge> @else <badge class='badge badge-info'>Inactive</badge> @endif</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

