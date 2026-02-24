@extends('layouts.master')

@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet"
          type="text/css"/>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ProductCategory') }}</h3>
                    @can('add-'.str_slug('ProductCategory'))
                        {{--<a class="btn btn-success pull-right" href="{{ url('/productCategory/product-category/create') }}">--}}
                            {{--<i class="icon-plus"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ProductCategory') }}--}}
                        {{--</a>--}}

                        <a class="btn btn-success pull-right" data-bs-toggle="modal" data-bs-target="#addProductCategory" href="#">
                            <i class="icon-plus"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ProductCategory') }}
                        </a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th><th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($productcategory as $item)
                                <tr>
                                    <td>{{ $loop->iteration??$item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @if($item->status == 0)
                                            <badge class="badge badge-warning">Inactive</badge>
                                        @else
                                            <badge class="badge badge-success">Active</badge>
                                        @endif
                                    </td>
                                    <td class="btn_td">
                                        @can('view-'.str_slug('ProductCategory'))
                                            <a href="javascript:void(0)"
                                               title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ProductCategory') }}" class="view_product_category" data-id="{{ $item->id }}">
                                                <button class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye clr-white" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                        @endcan

                                        @can('edit-'.str_slug('ProductCategory'))
                                            <a data-edit-id="{{ $item->id }}" class="btn-edit-modal" xhref="{{ url('/productCategory/product-category/' . $item->id . '/edit') }}"
                                               title="Edit {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ProductCategory') }}">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil-square-o clr-white" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                        @endcan

                                        @can('delete-'.str_slug('ProductCategory'))
                                            <form method="POST"
                                                  action="{{ url('/productCategory/product-category' . '/' . $item->id) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ProductCategory') }}"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o clr-white" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        @endcan


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $productcategory->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--View Modal--}}
    <div id="viewModalDiv"></div>

    <div id="addProductCategory" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content my-0">
                <div class="modal-header">
                    <h5 class="modal-title">Create New {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'ProductCategory') }}</h5>
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

                    <form method="POST" action="{{ url('/productCategory/product-category') }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @include ('productCategory.product-category.form')
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div id="editProductCategory" class="modal fade" tabindex="-1" aria-hidden="true"></div>
@endsection

@push('js')
    <script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>

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

    <script>
        $(document).on('click', '.btn-edit-modal', function (e) {
            var id = $(this).data('edit-id');
            $.ajax({
                url: "{{route('edit_product_category_modal')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id':id,
                },
                success: function (result) {
                    $('#editProductCategory').html(result);
                    $('#editProductCategory').modal('show');
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
    </script>

    <script>
        $(document).on('click', '.view_product_category', function (e) {
            var id = $(this).data('id');
            $.ajax({
                url: "{{url('view_product_category_modal')}}",
                type: 'get',
                data: {
                    'id':id,
                },
                success: function (result) {
                    $('#viewModalDiv').html(result);
                    $('#viewModal').modal('show');
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
    </script>
@endpush
