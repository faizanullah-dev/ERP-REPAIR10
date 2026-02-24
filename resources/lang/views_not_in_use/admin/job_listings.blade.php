@extends('layouts.master')

@push('css')
    <style>

    </style>
@endpush

@section('content')
<section class="job_listings_section pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 px-3 py-3 borderRadius20 box-shadow-card">
                        <div class="card-headerr bg-white">
                            <h5>Sales Performance Report</h5>
                        </div>
                        <div class="hr-line mt-2"></div>
                        <div class="report_tabs">
                            <ul>
                                <li class="borderRadius"><a  href="">Jobs Won</a></li>
                                <li class="borderRadius"><a  href="">Performance(#)</a></li>
                                <li class="borderRadius"><a  href="">By Salesman</a></li>
                                <li class="borderRadius"><a  href="">Summary</a></li>
                                <li class="borderRadius"><a  href="">Job Listing(#)</a></li>
                            </ul>
                        </div>
                        <div class="form_div mt-3">
                            <div class="row">
                                <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="customer-name" class="form-label input_labels p-18">Users</label>
                                    <input type="text" placeholder="Mr.Khan" class="form-control clr_input_fields borderRadius" id="customer-name">
                                </div>
                                </div>
                                <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="company-name" class="form-label input_labels p-18">Users Type</label>
                                    <input type="text" placeholder="abc@company.com" class="form-control clr_input_fields borderRadius" id="company-name">
                                </div>
                                </div>
                                <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="customer-name" class="form-label input_labels p-18">Type</label>
                                    <input type="text" placeholder="Mr.Khan" class="form-control clr_input_fields borderRadius" id="customer-name">
                                </div>
                                </div>
                                <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="company-name" class="form-label input_labels p-18">Exclude Job Types</label>
                                    <input type="text" placeholder="abc@company.com" class="form-control clr_input_fields borderRadius" id="company-name">
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="customer-name" class="form-label input_labels p-18">Duration Type</label>
                                    <input type="text" placeholder="Mr.Khan" class="form-control clr_input_fields borderRadius" id="customer-name">
                                </div>
                                </div>
                                <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="company-name" class="form-label input_labels p-18">Select Duration</label>
                                    <input type="text" placeholder="abc@company.com" class="form-control clr_input_fields borderRadius" id="company-name">
                                </div>
                                </div>
                                <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="customer-name" class="form-label input_labels p-18">Select Trades</label>
                                    <input type="text" placeholder="Mr.Khan" class="form-control clr_input_fields borderRadius" id="customer-name">
                                </div>
                                </div>
                                <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="company-name" class="form-label input_labels p-18">Work Type</label>
                                    <input type="text" placeholder="abc@company.com" class="form-control clr_input_fields borderRadius" id="company-name">
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="customer-name" class="form-label input_labels p-18">Customer Type</label>
                                    <input type="text" placeholder="Mr.Khan" class="form-control clr_input_fields borderRadius" id="customer-name">
                                </div>
                                </div>
                                <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="company-name" class="form-label input_labels p-18">Divisions</label>
                                    <input type="text" placeholder="abc@company.com" class="form-control clr_input_fields borderRadius" id="company-name">
                                </div>
                                </div>
                                <div class="col-md-3 d-flex align-items-end">
                                <div class="reset_apply_btn mb-3">
                                    <button class="btn border_btns borderRadius">Reset</button>
                                    <button class="btn border_btns borderRadius">Apply</button>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="table_div mt-5">
                        <table class="table table-borderless staff">
								<thead>
									<tr>
									<th scope="col">Customer Information</th>
									<th scope="col">Description</th>
                                    <th scope="col">Types</th>
									</tr>
								</thead>
								<tbody>
									<tr>
									<th class="align-middle" scope="row">
                                        <p>Emmanuel Perez / 2209-3775310-01</p> 
                                        <p>guaradoai@yahoo.com</p> 
                                        <p>C-(860)617-1481</p>
                                    </th>
									<td class="align-middle">
                                        <p>Leak in celling over toilet that has been getting worse over time / roof is original 2006</p>
                                        <p>salesman / Customer Rep: Manny Tenecota</p>
                                        <p>Job Rep /  Estimator: Manny Tenecota</p>
                                        <p>Referred By: Truck And Sings</p>
                                    </td>
									<td class="align-middle">
                                    <p>Trade Type: ROOFING</p>
                                        <p>Last Modified 11 Minutes Ago</p>
                                        <p>Moved To Lead 11 Minutes Ago</p>
                                        <p>Creation Date: 09/06/2022, 3/53:40</p>
                                    </td>
									</tr>
                                    <tr>
									<th class="align-middle" scope="row">
                                        <p>Emmanuel Perez / 2209-3775310-01</p> 
                                        <p>guaradoai@yahoo.com</p> 
                                        <p>C-(860)617-1481</p>
                                    </th>
									<td class="align-middle">
                                        <p>Leak in celling over toilet that has been getting worse over time / roof is original 2006</p>
                                        <p>salesman / Customer Rep: Manny Tenecota</p>
                                        <p>Job Rep /  Estimator: Manny Tenecota</p>
                                        <p>Referred By: Truck And Sings</p>
                                    </td>
									<td class="align-middle">
                                    <p>Trade Type: ROOFING</p>
                                        <p>Last Modified 11 Minutes Ago</p>
                                        <p>Moved To Lead 11 Minutes Ago</p>
                                        <p>Creation Date: 09/06/2022, 3/53:40</p>
                                    </td>
									</tr>
                                    <tr>
									<th class="align-middle" scope="row">
                                        <p>Emmanuel Perez / 2209-3775310-01</p> 
                                        <p>guaradoai@yahoo.com</p> 
                                        <p>C-(860)617-1481</p>
                                    </th>
									<td class="align-middle">
                                        <p>Leak in celling over toilet that has been getting worse over time / roof is original 2006</p>
                                        <p>salesman / Customer Rep: Manny Tenecota</p>
                                        <p>Job Rep /  Estimator: Manny Tenecota</p>
                                        <p>Referred By: Truck And Sings</p>
                                    </td>
									<td class="align-middle">
                                    <p>Trade Type: ROOFING</p>
                                        <p>Last Modified 11 Minutes Ago</p>
                                        <p>Moved To Lead 11 Minutes Ago</p>
                                        <p>Creation Date: 09/06/2022, 3/53:40</p>
                                    </td>
									</tr>
									
								</tbody>
							</table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
@endsection