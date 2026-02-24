@extends('layouts.master')

@push('css')
<style>

</style>
@endpush

@section('content')

    <!-- STAFF  TABLE -->
    <section class="create_staff_table pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-headerr">
                        <h5>Create Staff</h5>
                        <a href="" class="button create_btn borderRadius">Create</a>
                        <i class="fa fa-info-circle"></i>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="name" class="form-label input_labels p-18">Name</label>
                                            <input type="text" placeholder="Mr.Khan" class="form-control clr_input_fields borderRadius" id="name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="email" class="form-label input_labels p-18">Email</label>
                                            <input type="email" placeholder="abc@company.com" class="form-control clr_input_fields borderRadius" id="email">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label input_labels p-18">Phone</label>
                                            <input type="tel" placeholder="+61 123 4567 890" class="form-control clr_input_fields borderRadius" id="phone">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="address" class="form-label input_labels p-18">Address</label>
                                            <input type="text" placeholder="Abc address" class="form-control clr_input_fields borderRadius" id="address">
                                        </div>
                                    </div>
                                    <div class="mb-3 checkbox_btn_box col-md-12">
                                        <div class="single_checkbox_btn borderRadius">
                                            <input type="radio" class="form-check-input" name="staff_options" id="staff">
                                            <div class="green_circle"></div>
                                            <label for="staff" class="form-label input_labels p-18">Staff</label>
                                        </div>
                                        <div class="single_checkbox_btn borderRadius">
                                            <input type="radio" class="form-check-input" name="staff_options" id="sales-team">
                                            <div class="green_circle"></div>
                                            <label for="sales-team" class="form-label input_labels p-18">Sales Team</label>
                                        </div>
                                        <div class="single_checkbox_btn borderRadius">
                                            <input type="radio" class="form-check-input" name="staff_options" id="leads">
                                            <div class="green_circle"></div>
                                            <label for="leads" class="form-label input_labels p-18">Leads</label>
                                        </div>
                                        <div class="single_checkbox_btn borderRadius">
                                            <input type="radio" class="form-check-input" name="staff_options" id="target">
                                            <div class="green_circle"></div>
                                            <label for="target" class="form-label input_labels p-18">Target</label>
                                        </div>
                                        <div class="single_checkbox_btn borderRadius">
                                            <input type="radio" class="form-check-input" name="staff_options" id="work-type">
                                            <div class="green_circle"></div>
                                            <label for="work-type" class="form-label input_labels p-18">Work Type</label>
                                        </div>
                                        <div class="single_checkbox_btn borderRadius">
                                            <input type="radio" class="form-check-input" name="staff_options" id="Communication">
                                            <div class="green_circle"></div>
                                            <label for="Communication" class="form-label input_labels p-18">Communication</label>
                                        </div>
                                        <div class="single_checkbox_btn borderRadius">
                                            <input type="radio" class="form-check-input" name="staff_options" id="customer-manager">
                                            <div class="green_circle"></div>
                                            <label for="customer-manager" class="form-label input_labels p-18">Customer Manager</label>
                                        </div>
                                        <div class="single_checkbox_btn borderRadius">
                                            <input type="radio" class="form-check-input" name="staff_options" id="report">
                                            <div class="green_circle"></div>
                                            <label for="report" class="form-label input_labels p-18">Report</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn green_btn borderRadius w-100 submit_btn border-0 create_btn">Create</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection