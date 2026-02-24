@extends('layouts.master')

@push('css')
    <link href="{{ asset('plugins/components/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <style>
        /*#myTable_paginate { display: none; }*/
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Default {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Product') }}</h3>
                    <a class="btn btn-success pull-right" href="{{ url('/product/product') }}">
                        <i class="icon-arrow-left-circle"></i> Back
                    </a>
                    <div class="clearfix"></div>
                    <hr>
                    <form id="store_default_setting_product">
                        <div class="table-responsive">
                            <table class="table" id="myTable">
                                <thead>
                                <tr>
                                    <th style="pointer-events: none;">#</th>
                                    <th>Sub Category</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($product as $item)
                                    <tr>
                                        {{-- <td>{{ $loop->iteration??$item->id }}</td> --}}
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input default_product" type="checkbox" name="defaultProduct" value="{{ $item->id??"" }}" id="defaultProduct{{ $loop->iteration??$item->id }}" @if($item->status == 1) checked @endif>
                                            </div>
                                        </td>
                                        <td>{{ $item->sub_category??"" }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{--                        <div class="pagination-wrapper"> {!! $product->appends(['search' => Request::get('search')])->render() !!} </div>--}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-remove"></i></button>
                    <h4 class="modal-title" id="addCategoryModalLabel">Add Product Category</h4>
                </div>
                <form id="addCategoryForm" action="{{ route('store_default_setting_product') }}" method="POST">
                    @csrf
                    <input type="hidden" name="productId" id="productId">
                    <input type="hidden" name="isChecked" id="isChecked">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="productCategory">Select Product Categories <span class="text-danger">*</span></label>
                            <select id="productCategory" class="form-control" name="default_category[]" multiple="multiple" >
                                @foreach($getCategory as $category)
                                    <option value="{{ $category->id }}" >{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-green">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('plugins/components/datatables/jquery.dataTables.min.js') }}"></script>

    <script>
        $(function() {
            // Initialize DataTable
            $('#myTable').DataTable({
                'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': [-1]
                }]
            });

            // Initialize Select2
            $('#productCategory').select2({
                placeholder: "Select categories",
                allowClear: true
            });

            // Check if dropdown is empty
            if ($('#productCategory option').length === 0) {
                $('#productCategory').prop('disabled', true);
                Swal.fire({
                    icon: 'warning',
                    title: 'No Categories Available',
                    text: 'No active categories found. Please add categories first.',
                    confirmButtonText: 'OK'
                });
            }

            // Handle checkbox change
            $(document).on('change', '.default_product', function() {
                var productId = $(this).val();
                var isChecked = $(this).prop('checked');
                $.ajax({
                    url: '/get-product-categories/' + productId,
                    type: 'GET',
                    success: function (response) {
                        $('#productId').val(productId);
                        $('#isChecked').val(isChecked);
                        var $categorySelect = $('#productCategory');
                        $categorySelect.val(null).trigger('change');

                        if (response.categories && response.categories.length) {
                            $categorySelect.val(response.categories).trigger('change');
                        }

                        // $('#productCategory').val(null).trigger('change'); // Clear previous selections
                        $('#addCategoryModal').modal('show');
                    }
                });

            });

            // Handle form submission
            {{--$('#addCategoryForm').on('submit', function(e) {--}}
            {{--    e.preventDefault();--}}
            {{--    var $form = $(this);--}}
            {{--    var $submitButton = $form.find('button[type="submit"]');--}}
            {{--    var $productCategory = $('#productCategory');--}}
            {{--    var productCategoryValue = $productCategory.val();--}}
            {{--    if (!productCategoryValue || productCategoryValue.length === 0) {--}}
            {{--        Swal.fire({--}}
            {{--            icon: 'error',--}}
            {{--            title: 'Please Select a Category',--}}
            {{--            text: 'You must select at least one product category.',--}}
            {{--            confirmButtonText: 'OK'--}}
            {{--        });--}}
            {{--        return;--}}
            {{--    }--}}

            {{--    $submitButton.prop('disabled', true);--}}
            {{--    var formData = {--}}
            {{--        _token: '{{ csrf_token() }}',--}}
            {{--        productId: $('#productId').val(),--}}
            {{--        isChecked: $('#isChecked').val(),--}}
            {{--        default_category: productCategoryValue--}}
            {{--    };--}}

            {{--    --}}{{--$.ajax({--}}
            {{--    --}}{{--    url: "{{ route('store_default_setting_product') }}",--}}
            {{--    --}}{{--    type: 'POST',--}}
            {{--    --}}{{--    data: formData,--}}
            {{--    --}}{{--    success: function(response) {--}}
            {{--    --}}{{--        $('#addCategoryModal').modal('hide');--}}
            {{--    --}}{{--        Swal.fire({--}}
            {{--    --}}{{--            icon: 'success',--}}
            {{--    --}}{{--            title: 'Success!',--}}
            {{--    --}}{{--            text: response.message || 'Product categories updated successfully.',--}}
            {{--    --}}{{--            confirmButtonText: 'OK'--}}
            {{--    --}}{{--        });--}}
            {{--    --}}{{--        $('#addCategoryForm')[0].reset();--}}
            {{--    --}}{{--        $('#productCategory').val(null).trigger('change');--}}
            {{--    --}}{{--        $('#productId').val('');--}}
            {{--    --}}{{--        $('#isChecked').val('');--}}
            {{--    --}}{{--        history.replaceState(null, '', window.location.pathname);--}}
            {{--    --}}{{--    },--}}
            {{--    --}}{{--    error: function(xhr) {--}}
            {{--    --}}{{--        var errorMessage = xhr.responseJSON?.message || 'Something went wrong! Please try again.';--}}
            {{--    --}}{{--        if (xhr.responseJSON?.errors?.default_category) {--}}
            {{--    --}}{{--            errorMessage = xhr.responseJSON.errors.default_category[0];--}}
            {{--    --}}{{--        }--}}
            {{--    --}}{{--        Swal.fire({--}}
            {{--    --}}{{--            icon: 'error',--}}
            {{--    --}}{{--            title: 'Oops...',--}}
            {{--    --}}{{--            text: errorMessage,--}}
            {{--    --}}{{--            confirmButtonText: 'OK'--}}
            {{--    --}}{{--        });--}}
            {{--    --}}{{--    },--}}
            {{--    --}}{{--    complete: function() {--}}
            {{--    --}}{{--        $submitButton.prop('disabled', false);--}}
            {{--    --}}{{--    }--}}
            {{--    --}}{{--});--}}
            {{--});--}}
        });

    </script>
@endpush