@extends('layouts.master')

@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet"
          type="text/css"/>
@endpush

@section('content')
    <section class="templates_section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="templates-button_flex">
                            <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Templates') }}</h3>
                            <a class="btn btn-success pull-right" href="#!">
                                 Create {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Template') }}<i class="icon-plus"></i>
                            </a>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table" id="myTable">
                                <thead>
                                <tr>
                                    <th>Template Name</th>
                                    <th>Created On</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @for($i=0;$i<10;$i++)
                                    <tr>
                                        <td>Template 01</td>
                                        <td>12-04-2025</td>
                                        <td class="btn_td">
                                            @can('view-'.str_slug('Product'))
                                                <a href="#!"
                                                   title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Template') }}">
                                                    <button class="btn btn-info btn-sm">
                                                        <i class="fa fa-eye clr-white" aria-hidden="true"></i>
                                                    </button>
                                                </a>
                                            @endcan

                                            @can('edit-'.str_slug('Product'))
                                                <a data-edit-id="" class="btn-edit-modal" xhref=""
                                                   title="Edit {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Template') }}">
                                                    <button class="btn btn-primary btn-sm">
                                                        <i class="fa fa-pencil-square-o clr-white" aria-hidden="true"></i>
                                                    </button>
                                                </a>
                                            @endcan

                                            @can('delete-'.str_slug('Product'))
                                                <form method="POST"
                                                      action=""
                                                      accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                            title="Delete {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Template') }}"
                                                            onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o clr-white" aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@push('js')
    <script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- start - This is for export functionality only -->
    <!-- end - This is for export functionality only -->
    <script>
        $(document).ready(function () {

            @if(\Session::has('message'))
            $.toast({
                heading: 'Success!',
                position: 'top-center',
                text: '{{session()->get('message')}}',
                loaderBg: '#ff6849',
                icon: 'success',
                hideAfter: 3000,
                stack: 6
            });
            @endif
        })

        $(function () {
            $('#myTable').DataTable({
                'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': [-1] /* 1st one, start by the right */
                }]
            });

        });

    </script>
@endpush
