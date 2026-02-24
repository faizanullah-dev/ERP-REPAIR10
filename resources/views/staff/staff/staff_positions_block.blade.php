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
                                        <button type="button" class="btn blue_btn" data-bs-toggle="modal" data-bs-target="#addNewPosition">Add New Position<i class="icon-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table" id="myTable">
                                        <thead>
                                        <tr>
                                            <th>Position</th>
                                            <th>Created On</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
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
                    <h5 class="modal-title" >New Position</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="get"  action="" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="form-label input_labels">Name<span class="text-danger">*</span></label>
                                        <input type="text"  name="" class="form-control" placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cancel <i class="fa-solid fa-xmark"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="">
                                        <button class="btn green_btn" type="submit">Submit <i class="fa-solid fa-check"></i></button>
                                    </div>
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

@endpush
