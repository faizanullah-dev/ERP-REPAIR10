@extends('layouts.master')

@push('css')

@endpush

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="white-box-header">
                                    <div class="white-box-header-left">
                                        <h3 class="box-title">Positions Block</h3>
                                    </div>
                                    <div class="white-box-header-right">
                                        <button type="button" class="btn blue_btn" data-bs-toggle="modal" data-bs-target="#addNewPosition">Add New Position <i class="icon-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">

                                        <table class="table scroll_tobdy_fixed_class scroll_tobdy_fixed_height_class" id="myTable">
                                            <thead>
                                            <tr>
                                                <th>Position</th>
                                                <th>Created On</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($positionblock as $position)
                                                <tr data-id="{{ $position->id }}">
                                                    <td class="position-name">{{ $position->name }}</td>
                                                    <td>{{ $position->created_at->format('m-d-Y') }}</td>
                                                    <td class="btn_td">
                                                        <button class="btn edit_btn btn-sm" data-id="{{ $position->id }}" data-name="{{ $position->name }}">
                                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        </button>
                                                        @can('delete-'.str_slug('positionBlock'))
                                                            <form method="POST"
                                                                  action="{{ url('/positionBlock/position-block' . '/' . $position->id) }}"
                                                                  accept-charset="UTF-8" style="display:inline" class="delete-form">
                                                                {{ method_field('DELETE') }}
                                                                {{ csrf_field() }}
                                                                <button type="button" class="btn delete_btn btn-sm" title="Delete {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'positionBlock') }}">
                                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                                </button>
                                                            </form>
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="modal" id="addNewPosition" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Position</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST"  action="{{ url('/positionBlock/position-block') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="form-label input_labels">Name<span class="text-danger">*</span></label>
                                    <input type="text"  name="name" class="form-control" placeholder="Enter Name" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="back_button_flex_between">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cancel <i class="fa-solid fa-xmark"></i></button>
                                    <button class="btn green_btn" type="submit">Submit <i class="fa-solid fa-check"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="editPositionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Position</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editPositionForm" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editPositionId" name="id">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label input_labels">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="editPositionName" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="back_button_flex_between">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel <i class="fa-solid fa-xmark"></i></button>
                                    <button class="btn green_btn" type="submit">Update <i class="fa-solid fa-check"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('js')
    <script>
        $(document).on('click', '.edit_btn', function () {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let updateUrl = '/positionBlock/position-block/' + id;
            $('#editPositionId').val(id);
            $('#editPositionName').val(name);
            $('#editPositionForm').attr('action', updateUrl);
            $('#editPositionModal').modal('show');
        });
        $(document).on('click', '.delete_btn', function (e) {
            e.preventDefault();
            let form = $(this).closest('form');

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

    </script>
@endpush
