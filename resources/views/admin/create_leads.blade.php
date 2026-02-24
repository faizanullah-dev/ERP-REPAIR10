@extends('layouts.master')

@push('css')
    <style>

    </style>
@endpush

@section('content')
<section class="staff_table pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card-headerr">
                    <h5>Create Leads</h5>
                    <a href="#" class="button create_btn borderRadius">Create</a>
                    <i class="fa fa-info-circle"></i>
                    <hr>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Customer Information</h5>
                            <form class="mt-5">
                                <div class="col-md-6 residential_commercial w-100">
                                    <div class="mb-3">
                                        <input type="checkbox" class="form-check-input" id="leads">
                                        <label for="leads" class="form-label input_labels p-18">Residentail</label>
                                    </div>
                                    <div class="mb-3">
                                        <input type="checkbox" class="form-check-input" id="leads">
                                        <label for="leads" class="form-label input_labels p-18">Commercial</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="customer-name" class="form-label input_labels p-18">Customer Name</label>
                                        <input type="text" placeholder="Mr.Khan" class="form-control clr_input_fields borderRadius" id="customer-name">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="company-name" class="form-label input_labels p-18">Company Name</label>
                                        <input type="text" placeholder="abc@company.com" class="form-control clr_input_fields borderRadius" id="company-name">
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label input_labels p-18">Email</label>
                                        <input type="email" placeholder="+61 123 4567 890" class="form-control clr_input_fields borderRadius" id="email">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label input_labels p-18">Phone</label>
                                        <input type="tel" placeholder="Abc address" class="form-control clr_input_fields borderRadius" id="phone">
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="salesman-customer-rep" class="form-label input_labels p-18">Salesman / Customer Rep</label>
                                        <input type="text" placeholder="Unassigned" class="form-control clr_input_fields borderRadius" id="salesman-customer-rep">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="referred" class="form-label input_labels p-18">Referred By</label>
                                        <input type="text" placeholder="None" class="form-control clr_input_fields borderRadius" id="referred">
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="call-center" class="form-label input_labels p-18">Call Center Rep</label>
                                        <input type="text" placeholder="Unassigned" class="form-control clr_input_fields borderRadius" id="call-center">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="custom" class="form-label input_labels p-18">Custom</label>
                                        <input type="text" placeholder="Enter Custom" class="form-control clr_input_fields borderRadius" id="custom">
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-5">
                                    <button type="submit" class="btn green_btn borderRadius w-100 submit_btn large_green_btn create_btn">Create</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                        <h5>Customer Address</h5>
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label input_labels p-18">Address</label>
                                        <input type="text" placeholder="Mr.Khan" class="form-control clr_input_fields borderRadius" id="name">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="mb-3">
                                    <label for="city" class="form-label input_labels p-18">City</label>
                                        <input type="text" placeholder="Mr.Khan" class="form-control clr_input_fields borderRadius" id="city">
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="state" class="form-label input_labels p-18">State</label>
                                        <input type="text" placeholder="+61 123 4567 890" class="form-control clr_input_fields borderRadius" id="state">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="zip" class="form-label input_labels p-18">Zip</label>
                                        <input type="text" placeholder="Abc address" class="form-control clr_input_fields borderRadius" id="zip">
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="country" class="form-label input_labels p-18">Country</label>
                                        <input type="text" placeholder="Unassigned" class="form-control clr_input_fields borderRadius" id="country">
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="call-center" class="form-label input_labels p-18">Customer Note</label>
                                        <textarea class="form-control borderRadius clr_textarea_fields" placeholder="Enter note..." id="exampleFormControlTextarea1" rows="15"></textarea>
                                    </div>
                                    </div>
                                </div>
                                
                                
                                <!-- <div class="col-md-6">
                                    <button type="submit" class="btn green_btn borderRadius w-100 submit_btn p-20">Create</button>
                                </div> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection