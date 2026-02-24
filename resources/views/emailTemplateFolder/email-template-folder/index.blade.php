@extends('layouts.master')

@push('css')
@endpush

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box email_template_box" style="padding: 0; box-shadow: none;">
                    <div class="row">
                        <div class="col-md-12 mb-4 pb-3 d-flex align-items-end justify-content-between">
                            <h3 class="box-title pull-left m-0">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'EmailTemplateFolder') }}</h3>
                            @can('add-'.str_slug('EmailTemplateFolder'))
                                {{--<a class="btn btn-success pull-right" href="{{ url('/emailTemplateFolder/email-template-folder/create') }}">--}}
                                    {{--<i class="icon-plus"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'EmailTemplateFolder') }}--}}
                                {{--</a>--}}
                                <a class="btn btn-success pull-right" data-bs-toggle="modal" data-bs-target="#addEmailTemplateFolder" href="#">
                                    <i class="icon-plus"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'EmailTemplateFolder') }}
                                </a>
                            @endcan
                        </div>
                        @foreach($emailtemplatefolder as $item)
                            <div class="col-md-3">
                                <div class="custom_icon flex-column">
                                    <div class="custom_icon_anchor justify-content-between mb-4 pb-2">
                                        <a href="{{ url('email_template_listing')}}/{{ $item->id }}">
                                            {{--<i class="fa-solid fa-folder"></i>--}}
                                            <img src="{{ asset('website/images') }}/email_fold.svg" class="img-fluid" style="width: 80px;"></img>
                                        </a>
                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
{{--                                                @can('view-'.str_slug('EmailTemplateFolder'))--}}
{{--                                                    <li>--}}
{{--                                                        <a data-view-id="{{ $item->id }}" class="dropdown-item btn-view-modal" xhref="{{ url('/emailTemplateFolder/email-template-folder/' . $item->id) }}" title="View Email Template Folder">--}}
{{--                                                            <i class="fa fa-eye" aria-hidden="true"></i> View--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}
{{--                                                @endcan--}}
                                                @can('edit-'.str_slug('EmailTemplateFolder'))
                                                    <li>
                                                        <a data-edit-id="{{ $item->id }}" class="dropdown-item btn-edit-modal" title="Edit Email Template Folder" xhref="{{ url('/emailTemplateFolder/email-template-folder/' . $item->id . '/edit') }}">
                                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                        </a>
                                                    </li>
                                                @endcan
                                                @can('delete-'.str_slug('EmailTemplateFolder'))
                                                    <li>
                                                        <form method="POST" action="{{ url('/emailTemplateFolder/email-template-folder/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                            {{ method_field('DELETE') }}
                                                            {{ csrf_field() }}
                                                            <button type="submit" class="dropdown-item" title="Delete Email Template Folder" onclick="return confirm('Confirm delete?')">
                                                                <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                            </button>
                                                        </form>
                                                    </li>
                                                @endcan
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="custom_icon_img">
                                        <p>{{ $item->name }}</p>
                                        <span>Created Date: {{ $item->created_at->format('m-d-Y') }}</span>
                                        <span>No of templates:{{ $item->emailTemplates->count()??"0" }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="pagination-wrapper"> {!! $emailtemplatefolder->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="addEmailTemplateFolder" class="modal fade" tabindex="-1"  aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content my-0">
                <div class="modal-header">
                    <h5 class="modal-title">Create New {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'EmailTemplateFolder') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> × </button>
                </div>
                <div class="modal-body">

                    <div class="clearfix"></div>
                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form method="POST" action="{{ url('/emailTemplateFolder/email-template-folder') }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @include ('emailTemplateFolder.email-template-folder.form')
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div id="editEmailTemplateFolder" class="modal fade" tabindex="-1" aria-hidden="true"></div>

    <div id="viewEmailTemplateFolder" class="modal fade lead-view-modal" tabindex="-1" aria-hidden="true"></div>
@endsection

@push('js')
<script>
    $(document).on('click', '.btn-edit-modal', function (e) {
        var id = $(this).data('edit-id');
        $.ajax({
            url: "{{route('edit_email_template_folder_modal')}}",
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                'id':id,
            },
            success: function (result) {
                $('#editEmailTemplateFolder').html(result);
                $('#editEmailTemplateFolder').modal('show');
                //$(".select2-material").select2();
            },
            error: function (e) {
                console.log(e.status);
            }
        });
    });

    $(document).on('click', '.btn-view-modal', function (e) {
        var id = $(this).data('view-id');
        $.ajax({
            url: "{{route('view_email_template_folder_modal')}}",
            type: 'get',
            data: {
                'id':id,
            },
            success: function (result) {
                $('#viewEmailTemplateFolder').html(result);
                $('#viewEmailTemplateFolder').modal('show');
            },
            error: function (e) {
                console.log(e.status);
            }
        });
    });
</script>
@endpush
