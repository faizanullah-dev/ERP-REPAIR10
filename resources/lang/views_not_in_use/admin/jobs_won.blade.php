@extends('layouts.master')

@push('css')

<link href="{{asset('plugins/components/morrisjs/morris.css')}}" rel="stylesheet">

@endpush

@section('content')
<section class="jobs_won pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card border-0 px-3 py-3 borderRadius20 box-shadow-card">
                    <div class="card-headerr bg-white">
                        <h5>Sales Performance Report</h5>
                    </div>
                    <div class="hr-line mt-2"></div>
                    <div class="report_tabs">
                        <ul>
                            <li class="borderRadius"><a href="">Jobs Won</a></li>
                            <li class="borderRadius"><a href="">Performance(#)</a></li>
                            <li class="borderRadius"><a href="">By Salesman</a></li>
                            <li class="borderRadius"><a href="">Summary</a></li>
                            <li class="borderRadius"><a href="">Job Listing(#)</a></li>
                        </ul>
                    </div>
                    <div class="white-box">
                        <div id="morris-area-chart"
                            style="position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg
                                height="342" version="1.1" width="672" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                style="overflow: hidden; position: relative; left: -0.5px;">
                                <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël  2.1.2</desc>
                                <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><text
                                    x="32.84765625" y="303" text-anchor="end" font-family="sans-serif"
                                    font-size="12px" stroke="none" fill="#888888"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                    font-weight="normal">
                                    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0</tspan>
                                </text>
                                <path fill="none" stroke="#e0e0e0" d="M45.34765625,303H647" stroke-width="0.5"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text
                                    x="32.84765625" y="233.5" text-anchor="end" font-family="sans-serif"
                                    font-size="12px" stroke="none" fill="#888888"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                    font-weight="normal">
                                    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">75</tspan>
                                </text>
                                <path fill="none" stroke="#e0e0e0" d="M45.34765625,233.5H647" stroke-width="0.5"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text
                                    x="32.84765625" y="164" text-anchor="end" font-family="sans-serif"
                                    font-size="12px" stroke="none" fill="#888888"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                    font-weight="normal">
                                    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">150</tspan>
                                </text>
                                <path fill="none" stroke="#e0e0e0" d="M45.34765625,164H647" stroke-width="0.5"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text
                                    x="32.84765625" y="94.5" text-anchor="end" font-family="sans-serif"
                                    font-size="12px" stroke="none" fill="#888888"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                    font-weight="normal">
                                    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">225</tspan>
                                </text>
                                <path fill="none" stroke="#e0e0e0" d="M45.34765625,94.5H647" stroke-width="0.5"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text
                                    x="32.84765625" y="25" text-anchor="end" font-family="sans-serif"
                                    font-size="12px" stroke="none" fill="#888888"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                    font-weight="normal">
                                    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">300</tspan>
                                </text>
                                <path fill="none" stroke="#e0e0e0" d="M45.34765625,25H647" stroke-width="0.5"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="647"
                                    y="315.5" text-anchor="middle" font-family="sans-serif" font-size="12px"
                                    stroke="none" fill="#888888"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                    font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2016
                                    </tspan>
                                </text><text x="546.7703763264492" y="315.5" text-anchor="middle"
                                    font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                    font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2015
                                    </tspan>
                                </text><text x="446.5407526528982" y="315.5" text-anchor="middle"
                                    font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                    font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2014
                                    </tspan>
                                </text><text x="346.31112897934736" y="315.5" text-anchor="middle"
                                    font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                    font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2013
                                    </tspan>
                                </text><text x="245.80690359710178" y="315.5" text-anchor="middle"
                                    font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                    font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2012
                                    </tspan>
                                </text><text x="145.5772799235509" y="315.5" text-anchor="middle"
                                    font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                    font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2011
                                    </tspan>
                                </text><text x="45.34765625" y="315.5" text-anchor="middle" font-family="sans-serif"
                                    font-size="12px" stroke="none" fill="#888888"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                    font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2010
                                    </tspan>
                                </text>
                                <path fill="#11d3f2" stroke="none"
                                    d="M45.34765625,256.6666666666667C70.40506216838773,238.13333333333335,120.51987400516316,186.00833333333333,145.5772799235509,182.53333333333333C170.63468584193862,179.05833333333334,220.74949767871405,221.92617419060647,245.80690359710178,228.86666666666667C270.93295994266316,235.82617419060648,321.185072633786,249.7325125398997,346.31112897934736,238.13333333333333C371.36853489773506,226.565845873233,421.4833467345105,140.2541666666667,446.5407526528982,136.20000000000002C471.598158571286,132.14583333333334,521.7129704080614,213.80833333333334,546.7703763264492,205.7C571.827782244837,197.59166666666667,621.9425940816122,104.92500000000001,647,71.33333333333334L647,303L45.34765625,303Z"
                                    fill-opacity="0"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0;"></path>
                                <path fill="none" stroke="#00bbd9"
                                    d="M45.34765625,256.6666666666667C70.40506216838773,238.13333333333335,120.51987400516316,186.00833333333333,145.5772799235509,182.53333333333333C170.63468584193862,179.05833333333334,220.74949767871405,221.92617419060647,245.80690359710178,228.86666666666667C270.93295994266316,235.82617419060648,321.185072633786,249.7325125398997,346.31112897934736,238.13333333333333C371.36853489773506,226.565845873233,421.4833467345105,140.2541666666667,446.5407526528982,136.20000000000002C471.598158571286,132.14583333333334,521.7129704080614,213.80833333333334,546.7703763264492,205.7C571.827782244837,197.59166666666667,621.9425940816122,104.92500000000001,647,71.33333333333334"
                                    stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                <circle cx="45.34765625" cy="256.6666666666667" r="3" fill="#00bbd9"
                                    stroke="#00bbd9" stroke-width="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                <circle cx="145.5772799235509" cy="182.53333333333333" r="3" fill="#00bbd9"
                                    stroke="#00bbd9" stroke-width="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                <circle cx="245.80690359710178" cy="228.86666666666667" r="3" fill="#00bbd9"
                                    stroke="#00bbd9" stroke-width="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                <circle cx="346.31112897934736" cy="238.13333333333333" r="3" fill="#00bbd9"
                                    stroke="#00bbd9" stroke-width="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                <circle cx="446.5407526528982" cy="136.20000000000002" r="3" fill="#00bbd9"
                                    stroke="#00bbd9" stroke-width="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                <circle cx="546.7703763264492" cy="205.7" r="3" fill="#00bbd9" stroke="#00bbd9"
                                    stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                </circle>
                                <circle cx="647" cy="71.33333333333334" r="3" fill="#00bbd9" stroke="#00bbd9"
                                    stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                </circle>
                                <path fill="#f8c77a" stroke="none"
                                    d="M45.34765625,228.86666666666667C70.40506216838773,224.23333333333335,120.51987400516316,208.01666666666668,145.5772799235509,210.33333333333334C170.63468584193862,212.65,220.74949767871405,258.9674874601003,245.80690359710178,247.4C270.93295994266316,235.80082079343367,321.185072633786,128.1059279525764,346.31112897934736,117.66666666666669C371.36853489773506,107.2559279525764,421.4833467345105,152.41666666666669,446.5407526528982,164C471.598158571286,175.58333333333334,521.7129704080614,210.33333333333334,546.7703763264492,210.33333333333334C571.827782244837,210.33333333333334,621.9425940816122,175.58333333333334,647,164L647,303L45.34765625,303Z"
                                    fill-opacity="0"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0;"></path>
                                <path fill="none" stroke="#ffb136"
                                    d="M45.34765625,228.86666666666667C70.40506216838773,224.23333333333335,120.51987400516316,208.01666666666668,145.5772799235509,210.33333333333334C170.63468584193862,212.65,220.74949767871405,258.9674874601003,245.80690359710178,247.4C270.93295994266316,235.80082079343367,321.185072633786,128.1059279525764,346.31112897934736,117.66666666666669C371.36853489773506,107.2559279525764,421.4833467345105,152.41666666666669,446.5407526528982,164C471.598158571286,175.58333333333334,521.7129704080614,210.33333333333334,546.7703763264492,210.33333333333334C571.827782244837,210.33333333333334,621.9425940816122,175.58333333333334,647,164"
                                    stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                <circle cx="45.34765625" cy="228.86666666666667" r="3" fill="#ffb136"
                                    stroke="#ffb136" stroke-width="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                <circle cx="145.5772799235509" cy="210.33333333333334" r="3" fill="#ffb136"
                                    stroke="#ffb136" stroke-width="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                <circle cx="245.80690359710178" cy="247.4" r="3" fill="#ffb136" stroke="#ffb136"
                                    stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                </circle>
                                <circle cx="346.31112897934736" cy="117.66666666666669" r="3" fill="#ffb136"
                                    stroke="#ffb136" stroke-width="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                <circle cx="446.5407526528982" cy="164" r="3" fill="#ffb136" stroke="#ffb136"
                                    stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                </circle>
                                <circle cx="546.7703763264492" cy="210.33333333333334" r="3" fill="#ffb136"
                                    stroke="#ffb136" stroke-width="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                <circle cx="647" cy="164" r="3" fill="#ffb136" stroke="#ffb136" stroke-width="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                <path fill="#5c32c7" stroke="none"
                                    d="M45.34765625,284.4666666666667C70.40506216838773,270.5666666666667,120.51987400516316,234.65833333333336,145.5772799235509,228.86666666666667C170.63468584193862,223.075,220.74949767871405,245.07382580939353,245.80690359710178,238.13333333333333C270.93295994266316,231.17382580939352,321.185072633786,181.3860921112631,346.31112897934736,173.26666666666668C371.36853489773506,165.16942544459647,421.4833467345105,166.3166666666667,446.5407526528982,173.26666666666668C471.598158571286,180.2166666666667,521.7129704080614,235.8166666666667,546.7703763264492,228.86666666666667C571.827782244837,221.91666666666669,621.9425940816122,145.4666666666667,647,117.66666666666669L647,303L45.34765625,303Z"
                                    fill-opacity="0"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0;"></path>
                                <path fill="none" stroke="#4a23ad"
                                    d="M45.34765625,284.4666666666667C70.40506216838773,270.5666666666667,120.51987400516316,234.65833333333336,145.5772799235509,228.86666666666667C170.63468584193862,223.075,220.74949767871405,245.07382580939353,245.80690359710178,238.13333333333333C270.93295994266316,231.17382580939352,321.185072633786,181.3860921112631,346.31112897934736,173.26666666666668C371.36853489773506,165.16942544459647,421.4833467345105,166.3166666666667,446.5407526528982,173.26666666666668C471.598158571286,180.2166666666667,521.7129704080614,235.8166666666667,546.7703763264492,228.86666666666667C571.827782244837,221.91666666666669,621.9425940816122,145.4666666666667,647,117.66666666666669"
                                    stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                <circle cx="45.34765625" cy="284.4666666666667" r="3" fill="#4a23ad"
                                    stroke="#4a23ad" stroke-width="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                <circle cx="145.5772799235509" cy="228.86666666666667" r="3" fill="#4a23ad"
                                    stroke="#4a23ad" stroke-width="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                <circle cx="245.80690359710178" cy="238.13333333333333" r="3" fill="#4a23ad"
                                    stroke="#4a23ad" stroke-width="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                <circle cx="346.31112897934736" cy="173.26666666666668" r="3" fill="#4a23ad"
                                    stroke="#4a23ad" stroke-width="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                <circle cx="446.5407526528982" cy="173.26666666666668" r="3" fill="#4a23ad"
                                    stroke="#4a23ad" stroke-width="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                <circle cx="546.7703763264492" cy="228.86666666666667" r="3" fill="#4a23ad"
                                    stroke="#4a23ad" stroke-width="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                <circle cx="647" cy="117.66666666666669" r="3" fill="#4a23ad" stroke="#4a23ad"
                                    stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                </circle>
                            </svg>
                            <div class="morris-hover morris-default-style"
                                style="left: 574px; top: 66px; display: none;">
                                <div class="morris-hover-row-label">2016</div>
                                <div class="morris-hover-point" style="color: #00bbd9">
                                    iPhone:
                                    250
                                </div>
                                <div class="morris-hover-point" style="color: #ffb136">
                                    iPad:
                                    150
                                </div>
                                <div class="morris-hover-point" style="color: #4a23ad">
                                    iPod Touch:
                                    200
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
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
                                <button class="btn border_btns borderRadius">Reset</button>
                                <button class="btn border_btns borderRadius">Apply</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bottom-para mt-3 p-3">
                    <p class="p-16">The graph represents the no. of jobs that were moved to <span
                            class="green_text p-16">"Signed Contract"</span> Stage (i.e. Jobs Won) in a specific time
                        frame for the Company.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Salesman / Customer Rep & Job Rep / Estimator -->
<section class="customer_job_report mt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 px-3 py-3 borderRadius20 box-shadow-card">
                    <div class="card-headerr white-bg border-0">
                        <h5>Salesman / Customer Rep & Job Rep / Estimator</h5>
                    </div>
                    <div class="hr-line mt-2"></div>
                    <div class="card-body table_div">
                        <p class="p-18">Duration: 01/01/2022 - 09/07/2022</p>

                        <div class="table_wrapper_div table-responsive">
                            <table class="table table-borderless main_table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Sales Person</th>
                                        <th scope="col">Lead(#)</th>
                                        <th scope="col">Amount
                                            <table class="nested_table">
                                                <thead>
                                                    <tr>
                                                        {{--<th>Birds / Jobs</th>--}}
                                                        <th>Total Amount Job</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </th>
                                        <th scope="col">Awarded Jobs
                                            <table class="nested_table">
                                                <thead>
                                                    <tr>
                                                        <th>Jobs(#)</th>
                                                        <th>Total Amount Job</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </th>
                                        <th scope="col">Change Orders
                                            <table class="nested_table">
                                                <thead>
                                                    <tr>
                                                        <th>Change Orders(#)</th>
                                                        <th>Total Charge Order Amount</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </th>
                                        <th scope="col">Total Sales $</th>
                                    </tr>
                                    {{--<tr>--}}
                                        {{--<th scope="col">#</th>--}}
                                        {{--<th scope="col">Sales Person</th>--}}
                                        {{--<th scope="col">Lead(#)</th>--}}
                                        {{--<th scope="col">Birds--}}
                                            {{--<table class="nested_table">--}}
                                                {{--<thead>--}}
                                                    {{--<tr>--}}
                                                        {{--<th>Birds / Jobs</th>--}}
                                                        {{--<th>Total Amount Job</th>--}}
                                                    {{--</tr>--}}
                                                {{--</thead>--}}
                                            {{--</table>--}}
                                        {{--</th>--}}
                                        {{--<th scope="col">Awarded Jobs--}}
                                            {{--<table class="nested_table">--}}
                                                {{--<thead>--}}
                                                    {{--<tr>--}}
                                                        {{--<th>Jobs(#)</th>--}}
                                                        {{--<th>Total Amount Job</th>--}}
                                                    {{--</tr>--}}
                                                {{--</thead>--}}
                                            {{--</table>--}}
                                        {{--</th>--}}
                                        {{--<th scope="col">Change Orders--}}
                                            {{--<table class="nested_table">--}}
                                                {{--<thead>--}}
                                                    {{--<tr>--}}
                                                        {{--<th>Change Orders(#)</th>--}}
                                                        {{--<th>Total Charge Order Amount</th>--}}
                                                    {{--</tr>--}}
                                                {{--</thead>--}}
                                            {{--</table>--}}
                                        {{--</th>--}}
                                        {{--<th scope="col">Total Sales $</th>--}}
                                    {{--</tr>--}}
                                </thead>
                                <tbody>
                                   @forelse($users as $key => $user)
                                    <tr>
                                        <th class="align-middle" scope="row">{{++$key}}</th>
                                        <td class="align-middle">{{$user->name??""}}</td>
                                        <td class="align-middle">{{$user->leads->count()??""}}</td>
                                        <td class="align-middle">
                                            <table class="nested_table">
                                                <tbody>
                                                    <tr>
                                                        {{--<td>94/54</td>--}}
                                                        <td>{{$user->leads->sum('lead_price')??""}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td class="align-middle">
                                            <table class="nested_table">
                                                <tbody>
                                                    <tr>
                                                        <td>25</td>
                                                        <td>$658,888.00</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td class="align-middle">
                                            <table class="nested_table">
                                                <tbody>
                                                    <tr>
                                                        <td>25</td>
                                                        <td>$658,888.00</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td class="align-middle">$658,888.00</td>
                                    </tr>
                                   @empty
                                    <tr>
                                        <th class="align-middle" scope="row">1</th>
                                        <td class="align-middle">Francesca Metts</td>
                                        <td class="align-middle">85</td>
                                        <td class="align-middle">
                                            <table class="nested_table">
                                                <tbody>
                                                <tr>
                                                    <td>94/54</td>
                                                    <td>$658,888.00</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td class="align-middle">
                                            <table class="nested_table">
                                                <tbody>
                                                <tr>
                                                    <td>25</td>
                                                    <td>$658,888.00</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td class="align-middle">
                                            <table class="nested_table">
                                                <tbody>
                                                <tr>
                                                    <td>25</td>
                                                    <td>$658,888.00</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td class="align-middle">$658,888.00</td>
                                    </tr>
                                   @endforelse
                                    {{--<tr>--}}
                                        {{--<th class="align-middle" scope="row">1</th>--}}
                                        {{--<td class="align-middle">Francesca Metts</td>--}}
                                        {{--<td class="align-middle">85</td>--}}
                                        {{--<td class="align-middle">--}}
                                            {{--<table class="nested_table">--}}
                                                {{--<tbody>--}}
                                                    {{--<tr>--}}
                                                        {{--<td>94/54</td>--}}
                                                        {{--<td>$658,888.00</td>--}}
                                                    {{--</tr>--}}
                                                {{--</tbody>--}}
                                            {{--</table>--}}
                                        {{--</td>--}}
                                        {{--<td class="align-middle">--}}
                                            {{--<table class="nested_table">--}}
                                                {{--<tbody>--}}
                                                    {{--<tr>--}}
                                                        {{--<td>25</td>--}}
                                                        {{--<td>$658,888.00</td>--}}
                                                    {{--</tr>--}}
                                                {{--</tbody>--}}
                                            {{--</table>--}}
                                        {{--</td>--}}
                                        {{--<td class="align-middle">--}}
                                            {{--<table class="nested_table">--}}
                                                {{--<tbody>--}}
                                                    {{--<tr>--}}
                                                        {{--<td>25</td>--}}
                                                        {{--<td>$658,888.00</td>--}}
                                                    {{--</tr>--}}
                                                {{--</tbody>--}}
                                            {{--</table>--}}
                                        {{--</td>--}}
                                        {{--<td class="align-middle">$658,888.00</td>--}}
                                    {{--</tr>--}}
                                    {{--<tr>--}}
                                        {{--<th class="align-middle" scope="row">1</th>--}}
                                        {{--<td class="align-middle">Francesca Metts</td>--}}
                                        {{--<td class="align-middle">85</td>--}}
                                        {{--<td class="align-middle">--}}
                                            {{--<table class="nested_table">--}}
                                                {{--<tbody>--}}
                                                    {{--<tr>--}}
                                                        {{--<td>94/54</td>--}}
                                                        {{--<td>$658,888.00</td>--}}
                                                    {{--</tr>--}}
                                                {{--</tbody>--}}
                                            {{--</table>--}}
                                        {{--</td>--}}
                                        {{--<td class="align-middle">--}}
                                            {{--<table class="nested_table">--}}
                                                {{--<tbody>--}}
                                                    {{--<tr>--}}
                                                        {{--<td>25</td>--}}
                                                        {{--<td>$658,888.00</td>--}}
                                                    {{--</tr>--}}
                                                {{--</tbody>--}}
                                            {{--</table>--}}
                                        {{--</td>--}}
                                        {{--<td class="align-middle">--}}
                                            {{--<table class="nested_table">--}}
                                                {{--<tbody>--}}
                                                    {{--<tr>--}}
                                                        {{--<td>25</td>--}}
                                                        {{--<td>$658,888.00</td>--}}
                                                    {{--</tr>--}}
                                                {{--</tbody>--}}
                                            {{--</table>--}}
                                        {{--</td>--}}
                                        {{--<td class="align-middle">$658,888.00</td>--}}
                                    {{--</tr>--}}
                                    {{--<tr>--}}
                                        {{--<th class="align-middle" scope="row">1</th>--}}
                                        {{--<td class="align-middle">Francesca Metts</td>--}}
                                        {{--<td class="align-middle">85</td>--}}
                                        {{--<td class="align-middle">--}}
                                            {{--<table class="nested_table">--}}
                                                {{--<tbody>--}}
                                                    {{--<tr>--}}
                                                        {{--<td>94/54</td>--}}
                                                        {{--<td>$658,888.00</td>--}}
                                                    {{--</tr>--}}
                                                {{--</tbody>--}}
                                            {{--</table>--}}
                                        {{--</td>--}}
                                        {{--<td class="align-middle">--}}
                                            {{--<table class="nested_table">--}}
                                                {{--<tbody class="nested_table">--}}
                                                    {{--<tr>--}}
                                                        {{--<td>25</td>--}}
                                                        {{--<td>$658,888.00</td>--}}
                                                    {{--</tr>--}}
                                                {{--</tbody>--}}
                                            {{--</table>--}}
                                        {{--</td>--}}
                                        {{--<td class="align-middle">--}}
                                            {{--<table class="nested_table">--}}
                                                {{--<tbody class="nested_table">--}}
                                                    {{--<tr>--}}
                                                        {{--<td>25</td>--}}
                                                        {{--<td>$658,888.00</td>--}}
                                                    {{--</tr>--}}
                                                {{--</tbody>--}}
                                            {{--</table>--}}
                                        {{--</td>--}}
                                        {{--<td class="align-middle">$658,888.00</td>--}}
                                    {{--</tr>--}}
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection