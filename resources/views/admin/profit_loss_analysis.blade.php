@extends('layouts.master')

@push('css')
<link href="{{asset('plugins/components/morrisjs/morris.css')}}" rel="stylesheet">
@endpush

@section('content')
<section class="target_table pt-3">
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
                            <li class="borderRadius"><a href="">Company Performance</a></li>
                            <li class="borderRadius"><a href="">Profit / Loss Analysis</a></li>
                        </ul>
                        <a href="" class="button create_btn borderRadius ml-auto">Advance Search</a>
                    </div>
                    <div class="table-wrapper">
                    <table class="table table-borderless staff">
								<thead>
									<tr>
									<th scope="col">#</th>
									<th scope="col">Customer Job/ID</th>
                                    <th scope="col">Job Start Date</th>
									<th scope="col">Total Job Price $1,390,796.33</th>
									<th scope="col">Change Order $133,168.15</th>
                                    <th scope="col">Total $1,523,964.48</th>
									<th scope="col">Payment Received $1,313,347.01</th>
                                    <th scope="col">Total Credits $1,160.00</th>
									<th scope="col">Total Refunds $0.00</th>
                                    <th scope="col">Amount Owed $209,457.47</th>
									</tr>
								</thead>
								<tbody>
									<tr>
									<th class="align-middle" scope="row">0221</th>
									<td class="align-middle">
                                        <p>Gabriel Torres / 2209-3526933-02</p>
                                        <p>Job #: 22-140B</p>
                                        <p>Trade Type: GUTTERS</p>
                                        <p>Work Type: 5in Gutters</p>
                                        <p>Estimator: Manny Tenecota</p>
                                        <p>Salesman / Customer Rep: Manny Tenecota</p>
                                    </td>
									<td class="align-middle">09/06/2022</td>
									<td class="align-middle">$3,250.00</td>
									<td class="align-middle">$0.00</td>
									<td class="align-middle">$3,250.00</td>
                                    <td class="align-middle">$1,000.00</td>
									<td class="align-middle">$0.00</td>
                                    <td class="align-middle">$0.00</td>
									<td class="align-middle">$2,250.00</td>
									</tr>
                                    <tr>
									<th class="align-middle" scope="row">0221</th>
									<td class="align-middle">
                                        <p>Gabriel Torres / 2209-3526933-02</p>
                                        <p>Job #: 22-140B</p>
                                        <p>Trade Type: GUTTERS</p>
                                        <p>Work Type: 5in Gutters</p>
                                        <p>Estimator: Manny Tenecota</p>
                                        <p>Salesman / Customer Rep: Manny Tenecota</p>
                                    </td>
									<td class="align-middle">09/06/2022</td>
									<td class="align-middle">$3,250.00</td>
									<td class="align-middle">$0.00</td>
									<td class="align-middle">$3,250.00</td>
                                    <td class="align-middle">$1,000.00</td>
									<td class="align-middle">$0.00</td>
                                    <td class="align-middle">$0.00</td>
									<td class="align-middle">$2,250.00</td>
									</tr>
                                    <tr>
									<th class="align-middle" scope="row">0221</th>
									<td class="align-middle">
                                        <p>Gabriel Torres / 2209-3526933-02</p>
                                        <p>Job #: 22-140B</p>
                                        <p>Trade Type: GUTTERS</p>
                                        <p>Work Type: 5in Gutters</p>
                                        <p>Estimator: Manny Tenecota</p>
                                        <p>Salesman / Customer Rep: Manny Tenecota</p>
                                    </td>
									<td class="align-middle">09/06/2022</td>
									<td class="align-middle">$3,250.00</td>
									<td class="align-middle">$0.00</td>
									<td class="align-middle">$3,250.00</td>
                                    <td class="align-middle">$1,000.00</td>
									<td class="align-middle">$0.00</td>
                                    <td class="align-middle">$0.00</td>
									<td class="align-middle">$2,250.00</td>
									</tr>
									
								</tbody>
							</table>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-6">
                <div class="card border-0 px-3 py-3 borderRadius20 box-shadow-card">
                    <div class="card-body bg-white">
                        <div class="report_form_fields">
                            <div class="mb-3">
                                <label for="duration-type" class="form-label input_labels p-18">Duration
                                    Type</label>
                                <input type="text" placeholder="Abc address"
                                    class="form-control clr_input_fields borderRadius" id="duration-type">
                            </div>
                            <div class="mb-3">
                                <label for="select-duration" class="form-label input_labels p-18">Select
                                    Duration</label>
                                <input type="date" placeholder="Abc address"
                                    class="form-control clr_input_fields borderRadius" id="select-duration">
                            </div>
                            <div class="mb-3">
                                <label for="user" class="form-label input_labels p-18">User</label>
                                <input type="text" placeholder="Abc address"
                                    class="form-control clr_input_fields borderRadius" id="user">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label input_labels p-18">Divisions</label>
                                <input type="text" placeholder="Abc address"
                                    class="form-control clr_input_fields borderRadius" id="address">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label input_labels p-18">Customer Type</label>
                                <input type="text" placeholder="Abc address"
                                    class="form-control clr_input_fields borderRadius" id="address">
                            </div>
                            <div class="mb-3">
                                <p>User</p>
                                <div class="mb-3">
                                    <input type="checkbox" class="form-check-input" id="leads">
                                    <label for="leads" class="form-label input_labels p-18">Salesman / Customer
                                        Rep</label>
                                </div>
                                <div class="mb-3">
                                    <input type="checkbox" class="form-check-input" id="leads">
                                    <label for="leads" class="form-label input_labels p-18">Select User</label>
                                </div>
                            </div>
                            <div class="reset_apply_btn">
                                <button class="btn border_btns">Reset</button>
                                <button class="btn border_btns">Apply</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bottom-para mt-3 p-3">
                    <p class="p-16">The graph represents the no. of jobs that were moved to <span
                            class="green_text p-16">"Signed Contract"</span> Stage (i.e. Jobs Won) in a specific time
                        frame for the Company.</p>
                </div>
            </div> -->
        </div>
    </div>
</section>
@endsection

@push('js')
<!--Morris JavaScript -->
<!-- <script src="{{asset('plugins/components/raphael/raphael-min.js')}}"></script>
<script src="{{asset('plugins/components/morrisjs/morris.js')}}"></script>
<script src="{{asset('js/morris-data.js')}}"></script> -->
@endpush