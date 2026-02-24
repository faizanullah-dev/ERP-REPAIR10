@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'FolderManagementAttachment') }} {{ $foldermanagementattachment->id }}</h3>
                    @can('view-'.str_slug('FolderManagementAttachment'))
                        <a class="btn btn-success pull-right" href="{{ url('/folderManagementAttachment/folder-management-attachment') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $foldermanagementattachment->id }}</td>
                            </tr>
                            <tr><th> Folder Management Id </th><td> {{ $foldermanagementattachment->folder_management_id }} </td></tr><tr><th> Name </th><td> {{ $foldermanagementattachment->name }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

