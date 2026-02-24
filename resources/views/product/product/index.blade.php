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
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Product') }}</h3>
                    @can('add-'.str_slug('Product'))
                        {{--<a class="btn btn-success pull-right" href="{{ url('/product/product/create') }}">--}}
                            {{--<i class="icon-plus"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Product') }}--}}
                        {{--</a>--}}

                        <a class="btn btn-success pull-right" href="{{url('productTemplate/product-template')}}">
                            <i class="icon-plus"></i> {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Product Template') }}
                        </a>

                        <a class="btn btn-success pull-right" data-bs-toggle="modal" data-bs-target="#addProduct" href="#">
                            <i class="icon-plus"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Product') }}
                        </a>

{{--                        <a class="btn btn-green text-capitalize border-0 pull-right" href="{{route('default_product')}}" style="letter-spacing: 0;">--}}
{{--                            <i class="icon-plus"></i> Default {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Product') }}--}}
{{--                        </a>--}}
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Category</th>
                                <th>Sub Category</th>
                                <th>Default Category</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($product as $item)
                                <tr>
                                    <td>{{ $loop->iteration??$item->id }}</td>
                                    <td>{{ $item->productCategory->name??"" }}</td>
                                    <td>{{ $item->sub_category??"" }}</td>
                                    <td>{{ $item->category_names }}</td>
                                    <td>{{ number_format($item->price ?? 0, 2) }}</td>
                                    <td class="btn_td">
                                        @can('view-'.str_slug('Product'))
                                            <a href="{{ url('/product/product/' . $item->id) }}"
                                               title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Product') }}">
                                                <button class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye clr-white" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                        @endcan

                                        @can('edit-'.str_slug('Product'))
                                            <a data-edit-id="{{ $item->id }}" class="btn-edit-modal" xhref="{{ url('/product/product/' . $item->id . '/edit') }}"
                                               title="Edit {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Product') }}">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil-square-o clr-white" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                        @endcan

                                        @can('delete-'.str_slug('Product'))
                                            <form method="POST"
                                                  action="{{ url('/product/product' . '/' . $item->id) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="button" class="btn btn-danger btn-sm product_delete_btn_table"
                                                        title="Delete {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Product') }}">
                                                    <i class="fa fa-trash-o clr-white" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        @endcan


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
{{--                        <div class="pagination-wrapper"> {!! $product->appends(['search' => Request::get('search')])->render() !!} </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="addProduct" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content my-0">
                <div class="modal-header">
                    <h5 class="modal-title">Create New {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Product') }}</h5>
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

                    <form method="POST" action="{{ url('/product/product') }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @include ('product.product.form')
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div id="editProduct" class="modal fade" tabindex="-1" aria-hidden="true"></div>
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
                url: "{{route('edit_product_modal')}}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id':id,
                },
                success: function (result) {
                    $('#editProduct').html(result);
                    $('#editProduct').modal('show');
                },
                error: function (e) {
                    console.log(e.status);
                }
            });
        });
        $(document).on('click', '.product_delete_btn_table', function (e) {
            e.preventDefault();

            let form = $(this).closest('form');

            Swal.fire({
                title: 'Are you sure?',
                text: "This product will be deleted.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form[0].submit(); // Native submit
                }
            });
        });
    </script>
@endpush
