@extends('layouts.master')

@push('css')
<link href="{{asset('plugins/components/morrisjs/morris.css')}}" rel="stylesheet">
@endpush

@section('content')
<section class="performance_section pt-3">
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
                        <h3 class="box-title">Bar Chart</h3>
                        <div id="morris-bar-chart"
                            style="position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg
                                height="342" version="1.1" width="1426" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                style="overflow: hidden; position: relative; left: -0.5px;">
                                <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël
                                    2.1.2</desc>
                                <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><text
                                    x="32.84765625" y="303" text-anchor="end" font-family="sans-serif"
                                    font-size="12px" stroke="none" fill="#888888"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                    font-weight="normal">
                                    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0</tspan>
                                </text>
                                <path fill="none" stroke="#e0e0e0" d="M45.34765625,303H1401" stroke-width="0.5"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text
                                    x="32.84765625" y="233.5" text-anchor="end" font-family="sans-serif"
                                    font-size="12px" stroke="none" fill="#888888"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                    font-weight="normal">
                                    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">25</tspan>
                                </text>
                                <path fill="none" stroke="#e0e0e0" d="M45.34765625,233.5H1401" stroke-width="0.5"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text
                                    x="32.84765625" y="164" text-anchor="end" font-family="sans-serif"
                                    font-size="12px" stroke="none" fill="#888888"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                    font-weight="normal">
                                    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">50</tspan>
                                </text>
                                <path fill="none" stroke="#e0e0e0" d="M45.34765625,164H1401" stroke-width="0.5"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text
                                    x="32.84765625" y="94.50000000000003" text-anchor="end" font-family="sans-serif"
                                    font-size="12px" stroke="none" fill="#888888"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                    font-weight="normal">
                                    <tspan dy="4.000000000000028"
                                        style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">75</tspan>
                                </text>
                                <path fill="none" stroke="#e0e0e0" d="M45.34765625,94.50000000000003H1401"
                                    stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                </path><text x="32.84765625" y="25" text-anchor="end" font-family="sans-serif"
                                    font-size="12px" stroke="none" fill="#888888"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                    font-weight="normal">
                                    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">100</tspan>
                                </text>
                                <path fill="none" stroke="#e0e0e0" d="M45.34765625,25H1401" stroke-width="0.5"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text
                                    x="1304.167689732143" y="315.5" text-anchor="middle" font-family="sans-serif"
                                    font-size="12px" stroke="none" fill="#888888"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                    font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2012
                                    </tspan>
                                </text><text x="1110.5030691964287" y="315.5" text-anchor="middle"
                                    font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                    font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2011
                                    </tspan>
                                </text><text x="916.8384486607143" y="315.5" text-anchor="middle"
                                    font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                    font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2010
                                    </tspan>
                                </text><text x="723.173828125" y="315.5" text-anchor="middle"
                                    font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                    font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2009
                                    </tspan>
                                </text><text x="529.5092075892858" y="315.5" text-anchor="middle"
                                    font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                    font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2008
                                    </tspan>
                                </text><text x="335.84458705357144" y="315.5" text-anchor="middle"
                                    font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                    font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2007
                                    </tspan>
                                </text><text x="142.17996651785714" y="315.5" text-anchor="middle"
                                    font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                    font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2006
                                    </tspan>
                                </text>
                                <rect x="69.55573381696428" y="25" width="46.41615513392858" height="278" rx="0"
                                    ry="0" fill="#2ecc71" stroke="none" fill-opacity="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                <rect x="118.97188895089286" y="52.80000000000001" width="46.41615513392858"
                                    height="250.2" rx="0" ry="0" fill="#0283cc" stroke="none" fill-opacity="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                <rect x="168.38804408482144" y="136.20000000000002" width="46.41615513392858"
                                    height="166.79999999999998" rx="0" ry="0" fill="#e74a25" stroke="none"
                                    fill-opacity="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                <rect x="263.22035435267856" y="94.50000000000003" width="46.41615513392858"
                                    height="208.49999999999997" rx="0" ry="0" fill="#2ecc71" stroke="none"
                                    fill-opacity="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                <rect x="312.6365094866071" y="122.30000000000001" width="46.41615513392858"
                                    height="180.7" rx="0" ry="0" fill="#0283cc" stroke="none" fill-opacity="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                <rect x="362.0526646205357" y="191.8" width="46.41615513392858"
                                    height="111.19999999999999" rx="0" ry="0" fill="#e74a25" stroke="none"
                                    fill-opacity="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                <rect x="456.88497488839283" y="164" width="46.41615513392858" height="139" rx="0"
                                    ry="0" fill="#2ecc71" stroke="none" fill-opacity="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                <rect x="506.3011300223214" y="191.8" width="46.41615513392858"
                                    height="111.19999999999999" rx="0" ry="0" fill="#0283cc" stroke="none"
                                    fill-opacity="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                <rect x="555.71728515625" y="219.60000000000002" width="46.41615513392858"
                                    height="83.39999999999998" rx="0" ry="0" fill="#e74a25" stroke="none"
                                    fill-opacity="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                <rect x="650.5495954241071" y="94.50000000000003" width="46.41615513392858"
                                    height="208.49999999999997" rx="0" ry="0" fill="#2ecc71" stroke="none"
                                    fill-opacity="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                <rect x="699.9657505580357" y="122.30000000000001" width="46.41615513392858"
                                    height="180.7" rx="0" ry="0" fill="#0283cc" stroke="none" fill-opacity="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                <rect x="749.3819056919642" y="191.8" width="46.41615513392858"
                                    height="111.19999999999999" rx="0" ry="0" fill="#e74a25" stroke="none"
                                    fill-opacity="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                <rect x="844.2142159598213" y="164" width="46.41615513392858" height="139" rx="0"
                                    ry="0" fill="#2ecc71" stroke="none" fill-opacity="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                <rect x="893.6303710937499" y="191.8" width="46.41615513392858"
                                    height="111.19999999999999" rx="0" ry="0" fill="#0283cc" stroke="none"
                                    fill-opacity="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                <rect x="943.0465262276784" y="219.60000000000002" width="46.41615513392858"
                                    height="83.39999999999998" rx="0" ry="0" fill="#e74a25" stroke="none"
                                    fill-opacity="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                <rect x="1037.8788364955356" y="94.50000000000003" width="46.41615513392858"
                                    height="208.49999999999997" rx="0" ry="0" fill="#2ecc71" stroke="none"
                                    fill-opacity="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                <rect x="1087.2949916294642" y="122.30000000000001" width="46.41615513392858"
                                    height="180.7" rx="0" ry="0" fill="#0283cc" stroke="none" fill-opacity="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                <rect x="1136.7111467633927" y="191.8" width="46.41615513392858"
                                    height="111.19999999999999" rx="0" ry="0" fill="#e74a25" stroke="none"
                                    fill-opacity="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                <rect x="1231.54345703125" y="25" width="46.41615513392858" height="278" rx="0"
                                    ry="0" fill="#2ecc71" stroke="none" fill-opacity="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                <rect x="1280.9596121651787" y="52.80000000000001" width="46.41615513392858"
                                    height="250.2" rx="0" ry="0" fill="#0283cc" stroke="none" fill-opacity="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                                <rect x="1330.375767299107" y="191.8" width="46.41615513392858"
                                    height="111.19999999999999" rx="0" ry="0" fill="#e74a25" stroke="none"
                                    fill-opacity="1"
                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                            </svg>
                            <div class="morris-hover morris-default-style"
                                style="left: 1277.67px; top: 127px; display: none;">
                                <div class="morris-hover-row-label">2012</div>
                                <div class="morris-hover-point" style="color: #2ecc71">
                                    A:
                                    100
                                </div>
                                <div class="morris-hover-point" style="color: #0283cc">
                                    B:
                                    90
                                </div>
                                <div class="morris-hover-point" style="color: #e74a25">
                                    C:
                                    40
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
@endsection

@push('js')
<!--Morris JavaScript -->
<script src="{{asset('plugins/components/raphael/raphael-min.js')}}"></script>
<script src="{{asset('plugins/components/morrisjs/morris.js')}}"></script>
<script src="{{asset('js/morris-data.js')}}"></script>
@endpush