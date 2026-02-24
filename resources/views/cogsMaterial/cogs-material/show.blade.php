@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'COGSMaterial') }} {{ $cogsmaterial->id }}</h3>
                    @can('view-'.str_slug('CogsMaterial'))
                        <a class="btn btn-success pull-right" href="{{ url('/cogsMaterial/cogs-material') }}">
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
                                <td>{{ $cogsmaterial->id }}</td>
                            </tr>
                            <tr><th> Name </th><td> {{ $cogsmaterial->name }} </td></tr><tr><th> Status </th><td>
                                    @if($cogsmaterial->status == 1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-warning">Inactive</span>
                                    @endif
                                </td></tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

