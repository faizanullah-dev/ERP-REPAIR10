@extends('layouts.master')

@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{asset('plugins/components/morrisjs/morris.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <style>
        .page-wrapper badge:is(.badge) { text-transform: capitalize; }
        .morris-default-style:is(.morris-hover) { padding: 0; border-radius: 0; background: transparent; font-family: 'Rajdhani-Semibold'; }

        .tabChart circle { stroke-width: 3px; }
        .tabChart [id^=barChart] rect { rx: 4px; ry: 4px; }
        .tabChart text[text-anchor="middle"] { transform: translate(0, 5px); }
        .tabChart path:not([stroke-width="2"]) { stroke: #D4D4D4; stroke-width: 1.5px; stroke-dasharray: 5, 5; }
        .tabChart path[stroke-width="2"] { stroke-width: 2.5px; filter: drop-shadow(2px 2px 5px rgba(0, 0, 0, .7)); }
        .tabChart .form-check label { margin-top: 5px; font-size: 14px; margin-left: 5px; line-height: normal; font-family: 'Rajdhani-Semibold'; }

        .tabChart:has([value="lineChartMonthly"]:checked) #barChartMonthly:has(svg),
        .tabChart:has([value="barChartMonthly"]:checked) #lineChartMonthly:has(svg),
        .tabChart:has([value="lineChartCategory"]:checked) #barChartCategory:has(svg),
        .tabChart:has([value="barChartCategory"]:checked) #lineChartCategory:has(svg) {
            display: none;
        }

        .tabChart #lineChartCategory text[text-anchor="middle"] { transform: translate(0, 40px); }
        .tabChart #lineChartCategory text[text-anchor="middle"]:nth-child(13) { transform: translate(-14px, 40px); }

        .tooltip-bullet { top: -2px; width: 8px; height: 8px; margin-right: 8px; position: relative; border-radius: 50%; }
        .tooltip-custom { min-width: 75px; font-size: 14px; color: #4A4A4A; display: flex ; align-items: center; border-radius: 5px; background: #fff; padding: 7px 7px 5px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); }
    </style>
@endpush

@section('content')
    <section class="sub_contractor_view">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title pull-left ps-0">Sub Contractor Overview</h3>
                        <a class="btn btn-success pull-right" href="{{url('/sub_contractor')}}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back
                        </a>
                        <div class="clearfix"></div>
                        <hr>
                        <h5>Compnay Details</h5>
                        <div class="table-responsive">
                            <table class="table table">
                                <tbody>
                                <tr>
                                    <td> Company Name: </td>
                                    <th> {{$subcontractor->subContractorCompany->name??''}} </th>
                                    <td> Address: </td>
                                    <th> {{$subcontractor->subContractorCompany->address??''}} </th>
                                </tr>
                                <tr>
                                    <td> City: </td>
                                    <th> {{$subcontractor->subContractorCompany->city??''}} </th>
                                    <td> State: </td>
                                    <th> {{$subcontractor->subContractorCompany->state??''}} </th>
                                </tr>
                                <tr>
                                    <td> ZIP Code: </td>
                                    <th> {{$subcontractor->subContractorCompany->zip_code??''}} </th>
                                    <td> Phone: </td>
                                    <th> {{$subcontractor->subContractorCompany->phone??''}} </th>
                                </tr>
                                <tr>
                                    <td> Email: </td>
                                    <th> {{$subcontractor->subContractorCompany->email??''}} </th>
                                    <td> Corporation: </td>
                                    <th> {{$subcontractor->subContractorCompany->corporation??''}} </th>
                                </tr>
                                <tr>
                                    <td> Trades: </td>
                                    <th>
                                        @php
                                            $tradeIds = json_decode($subcontractor->subContractorCompany->trades ?? '[]', true) ?? [];

                                            $tradeNames = $allTrades
                                                ->whereIn('id', $tradeIds)
                                                ->pluck('name')
                                                ->filter()
                                                ->values()
                                                ->toArray();

                                        @endphp

                                        @foreach($tradeNames as $trade)
                                            <span class='badge badge-primary'>
                                                    {{ $trade }}
                                                </span>
                                        @endforeach
                                    </th>
                                    <td> Website: </td>
                                    <th> {{$subcontractor->subContractorCompany->website??''}} </th>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <h5>Contact Details</h5>
                        <div class="table-responsive">
                            <table class="table table">
                                <tbody>
                                <tr>
                                    <td> Title: </td>
                                    <th colspan="3"> {{$subcontractor->profile->title??''}} </th>
                                </tr>
                                <tr>
                                    <td> First Name: </td>
                                    <th> {{$subcontractor->first_name??''}} </th>
                                    <td> Last Name: </td>
                                    <th> {{$subcontractor->last_name??''}} </th>
                                </tr>
                                <tr>
                                    <td> Email: </td>
                                    <th> {{$subcontractor->email??''}} </th>
                                    <td> Phone: </td>
                                    <th> {{$subcontractor->profile->phone??''}} </th>
                                </tr>
                                <tr>
                                    <td> Notes: </td>
                                    <th colspan="3"> {{$subcontractor->profile->notes??''}} </th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <h3 class="box-title ps-0">Summary</h3>
                        <form>
                            <div class="row mb-3 align-items-end">
                                <div class="col">
                                    <label for="fromDate" class="form-label">From</label>
                                    <input type="date" class="form-control" id="fromDate" placeholder="MM/DD/YYYY">
                                </div>
                                <div class="col">
                                    <label for="toDate" class="form-label">To</label>
                                    <input type="date" class="form-control" id="toDate" placeholder="MM/DD/YYYY">
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-apply" id="">Apply <i class="fa-solid fa-check"></i> </button>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-secondary btn-reset" id="">Reset <i class="fa-solid fa-arrows-spin"></i> </button>
                                </div>
                            </div>
                        </form>
                        <div class="row mb-3 total-deduct-net">
                            <div class="col">
                                <label for="totalPay" class="form-label">Total Pay:</label>
                                <div id="totalPay" class="fw-bold">$100000.00</div>
                            </div>
                            <div class="col">
                                <label for="deductions" class="form-label">Deductions:</label>
                                <div id="deductions" class="fw-bold">$1250.00</div>
                            </div>
                            <div class="col">
                                <label for="netPay" class="form-label">Net Pay:</label>
                                <div id="netPay" class="fw-bold clr-green">$98750.00</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active" id="insurance-tab" data-bs-toggle="pill" href="#insurance">Insurance Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="work-orders-tab" data-bs-toggle="pill" href="#work-orders">Work Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="jobs-tab" data-bs-toggle="pill" href="#jobs">Jobs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="finances-tab" data-bs-toggle="pill" href="#finances">Finances</a>
                            </li>
                        </ul>


                        <div class="tab-content mt-3">
                            <div class="tab-pane active" id="insurance">
                                <!-- Workers Company Section -->
                                <div class="mb-4 tab-item">
                                    <form class="insurance-form" data-type="workers_compensation" data-subcontractor-id="{{ $subcontractor->id }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <h5>Workers Company</h5>
                                                    <button class="btn btn-green btn-edit" type="button">Edit <i class="fa-regular fa-pen-to-square"></i> </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="workersCompany" class="form-label">Insurance Company Info</label>
                                                <input type="text" class="form-control" name="workers_compensation_insurance_company_info" value="{{$subcontractor->subContractorInsuranceInfo->workers_compensation_insurance_company_info??''}}" id="workersCompany" placeholder="Enter Insurance company Info" readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="workersContactName" class="form-label">Contact Name</label>
                                                <input type="text" class="form-control" name="workers_compensation_contact_name" value="{{$subcontractor->subContractorInsuranceInfo->workers_compensation_contact_name??''}}" id="workersContactName" placeholder="Enter Contact Name" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="workersPhone" class="form-label">Phone</label>
                                                <input type="text" class="form-control" name="workers_compensation_phone" value="{{$subcontractor->subContractorInsuranceInfo->workers_compensation_phone??''}}" id="workersPhone" placeholder="Enter Phone" readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="workersEmail" class="form-label">Email</label>
                                                <input type="email" class="form-control" name="workers_compensation_email" value="{{$subcontractor->subContractorInsuranceInfo->workers_compensation_email??''}}" id="workersEmail" placeholder="Enter Email" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="workersCarrier" class="form-label">Insurance Carrier</label>
                                                <input type="text" class="form-control" name="workers_compensation_insurance_carrier" value="{{$subcontractor->subContractorInsuranceInfo->workers_compensation_insurance_carrier??''}}" id="workersCarrier" placeholder="Enter Insurance Carrier" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="insurancePolicyEff" class="form-label">Policy EFF</label>
                                                <input type="date" class="form-control" name="workers_compensation_policy_eff" value="{{$subcontractor->subContractorInsuranceInfo->workers_compensation_policy_eff??''}}" id="insurancePolicyEff" readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="insurancePolicyExp" class="form-label">Policy EXP</label>
                                                <input type="date" class="form-control" name="workers_compensation_policy_exp" value="{{$subcontractor->subContractorInsuranceInfo->workers_compensation_policy_exp??''}}" id="insurancePolicyExp" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="insuranceAttachment" class="form-label">Attachment</label>
                                                <input type="file" class="form-control" name="workers_compensation_attachment" id="insuranceAttachment" disabled>
                                            </div>
                                        </div>

                                        <div class="row btn-save-cancel">
                                            <div class="col-md-12">
                                                <div class="d-flex mt-2">
                                                    <button class="btn btn-green me-2" type="submit">
                                                        Save Changes <i class="fa-regular fa-circle-check"></i>
                                                    </button>
                                                    <button class="btn btn-gray btn-cancel" type="button">
                                                        Cancel <i class="fa-solid fa-xmark"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- General Liability Section -->
                                <div class="mb-4 tab-item">
                                    <form class="insurance-form" data-type="general_liability" data-subcontractor-id="{{ $subcontractor->id }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <h5>General Liability</h5>
                                                    <button class="btn btn-green btn-edit" type="button">Edit <i class="fa-regular fa-pen-to-square"></i> </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="generalCompany" class="form-label">Insurance Company Info</label>
                                                <input type="text" class="form-control" name="general_liability_insurance_company_info" value="{{$subcontractor->subContractorInsuranceInfo->general_liability_insurance_company_info??''}}" id="generalCompany" placeholder="Enter Insurance company Info" readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="generalContactName" class="form-label">Contact Name</label>
                                                <input type="text" class="form-control" name="general_liability_contact_name" value="{{$subcontractor->subContractorInsuranceInfo->general_liability_contact_name??''}}" id="generalContactName" placeholder="Enter Contact Name" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="generalPhone" class="form-label">Phone</label>
                                                <input type="text" class="form-control" name="general_liability_phone" value="{{$subcontractor->subContractorInsuranceInfo->general_liability_phone??''}}" id="generalPhone" placeholder="Enter Phone" readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="generalEmail" class="form-label">Email</label>
                                                <input type="email" class="form-control" name="general_liability_email" value="{{$subcontractor->subContractorInsuranceInfo->general_liability_email??''}}" id="generalEmail" placeholder="Enter Email" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="generalCarrier" class="form-label">Insurance Carrier</label>
                                                <input type="text" class="form-control" name="general_liability_insurance_carrier" value="{{$subcontractor->subContractorInsuranceInfo->general_liability_insurance_carrier??''}}" id="generalCarrier" placeholder="Enter Insurance Carrier" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="generalPolicyEff" class="form-label">Policy EFF</label>
                                                <input type="date" class="form-control" name="general_liability_policy_eff" value="{{$subcontractor->subContractorInsuranceInfo->general_liability_policy_eff??''}}" id="generalPolicyEff" readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="generalPolicyExp" class="form-label">Policy EXP</label>
                                                <input type="date" class="form-control" name="general_liability_policy_exp" value="{{$subcontractor->subContractorInsuranceInfo->general_liability_policy_exp??''}}" id="generalPolicyExp" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="generalAttachment" class="form-label">Attachment</label>
                                                <input type="file" class="form-control" name="general_liability_attachment" id="generalAttachment" disabled>
                                            </div>
                                        </div>

                                        <div class="row btn-save-cancel">
                                            <div class="col-md-12">
                                                <div class="d-flex mt-2">
                                                    <button class="btn btn-green me-2" type="submit">
                                                        Save Changes <i class="fa-regular fa-circle-check"></i>
                                                    </button>
                                                    <button class="btn btn-gray btn-cancel" type="button">
                                                        Cancel <i class="fa-solid fa-xmark"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Auto Section -->
                                <div class="mb-5 tab-item">
                                    <form class="insurance-form" data-type="auto" data-subcontractor-id="{{ $subcontractor->id }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <h5>Auto</h5>
                                                    <button class="btn btn-green btn-edit" type="button">Edit <i class="fa-regular fa-pen-to-square"></i> </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="autoCompany" class="form-label">Insurance Company Info</label>
                                                <input type="text" class="form-control" name="auto_insurance_company_info" value="{{$subcontractor->subContractorInsuranceInfo->auto_insurance_company_info??''}}" id="autoCompany" placeholder="Enter Insurance company Info" readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="autoContactName" class="form-label">Contact Name</label>
                                                <input type="text" class="form-control" name="auto_contact_name" value="{{$subcontractor->subContractorInsuranceInfo->auto_contact_name??''}}" id="autoContactName" placeholder="Enter Contact Name" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="autoPhone" class="form-label">Phone</label>
                                                <input type="text" class="form-control" name="auto_phone" value="{{$subcontractor->subContractorInsuranceInfo->auto_phone??''}}" id="autoPhone" placeholder="Enter Phone" readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="autoEmail" class="form-label">Email</label>
                                                <input type="email" class="form-control" name="auto_email" value="{{$subcontractor->subContractorInsuranceInfo->auto_email??''}}" id="autoEmail" placeholder="Enter Email" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="autoCarrier" class="form-label">Insurance Carrier</label>
                                                <input type="text" class="form-control" name="auto_insurance_carrier" value="{{$subcontractor->subContractorInsuranceInfo->auto_insurance_carrier??''}}" id="autoCarrier" placeholder="Enter Insurance Carrier" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="autoPolicyEff" class="form-label">Policy EFF</label>
                                                <input type="date" class="form-control " name="auto_policy_eff" id="autoPolicyEff"
                                                       value="{{($subcontractor->subContractorInsuranceInfo->auto_policy_eff) ?? '' }}" readonly></div>
                                            <div class="col-md-6 mb-3">
                                                <label for="autoPolicyExp" class="form-label">Policy EXP</label>
                                                <input type="date" class="form-control" name="auto_policy_exp" value="{{$subcontractor->subContractorInsuranceInfo->auto_policy_exp??''}}" id="autoPolicyExp" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="autoAttachment" class="form-label">Attachment</label>
                                                <input type="file" class="form-control" name="auto_attachment" id="autoAttachment" disabled>
                                            </div>
                                        </div>

                                        <div class="row btn-save-cancel">
                                            <div class="col-md-12">
                                                <div class="d-flex mt-2">
                                                    <button class="btn btn-green me-2" type="submit">
                                                        Save Changes <i class="fa-regular fa-circle-check"></i>
                                                    </button>
                                                    <button class="btn btn-gray btn-cancel" type="button">
                                                        Cancel <i class="fa-solid fa-xmark"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="mt-4 row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-borderless subContractor-dataTable">
                                                <thead>
                                                <tr>
                                                    <th>Description</th>
                                                    <th>Policy EFF</th>
                                                    <th>Policy EXP</th>
                                                    <th>Attachment Date</th>
                                                    <th>Same Agency</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(isset($subcontractor->subContractorInsuranceInfo) && $subcontractor->subContractorInsuranceInfo->workers_compensation_insurance_company_info)
                                                    @php
                                                        $expiryDate = \Carbon\Carbon::parse($subcontractor->subContractorInsuranceInfo->workers_compensation_policy_exp);
                                                        $isExpiringSoon = $expiryDate->diffInDays(now()) <= 30;
                                                    @endphp
                                                    <tr @if($isExpiringSoon) style="background-color: #ffdddd;" @endif>
                                                        <td>{{$subcontractor->subContractorInsuranceInfo->workers_compensation_insurance_company_info??''}}</td>
                                                        <td>{{ \Carbon\Carbon::parse($subcontractor->subContractorInsuranceInfo->workers_compensation_policy_eff)->format('m-d-y') ?? '' }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($subcontractor->subContractorInsuranceInfo->workers_compensation_policy_exp)->format('m-d-y') ?? '' }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($subcontractor->subContractorInsuranceInfo->workers_compensation_attachment_date)->format('m-d-y') ?? '' }}</td>
                                                        <td><input type="checkbox" name="insurance_type" data-subcontractor-id="{{$subcontractor->id}}" data-type="workers_compensation" value="1" @if(isset($subcontractor->subContractorRecurringEmail) &&
                                                               $subcontractor->subContractorRecurringEmail->isNotEmpty() &&
                                                               $subcontractor->subContractorRecurringEmail->first()->insurance_type == 'workers_compensation' &&
                                                               $subcontractor->subContractorRecurringEmail->first()->same_agency == 1) checked @endif>
                                                        </td>
                                                        <td class="btn_td">
                                                            @if(!empty($subcontractor->subContractorInsuranceInfo->workers_compensation_attachment))
                                                                <a href="{{ asset('website')}}/{{$subcontractor->subContractorInsuranceInfo->workers_compensation_attachment}}"
                                                                   class="btn view_btn btn-sm"
                                                                   target="_blank">
                                                                    <i class="fa-solid fa-file-pdf"></i>
                                                                </a>
                                                            @else
                                                                <span class="btn view_btn btn-sm disabled">
                                                                <i class="fa-solid fa-file-pdf"></i>
                                                            </span>
                                                            @endif
                                                            <a href="javascript:void(0);" data-subcontractor-id="{{$subcontractor->id}}" data-type="workers_compensation" class="btn view_btn btn-sm upload-attachment-btn">
                                                                <i class="fa-solid fa-upload"></i>
                                                            </a>
                                                            <a href="javascript:void(0);" data-subcontractor-id="{{$subcontractor->id}}" data-type="workers_compensation" data-expiry-date="{{$subcontractor->subContractorInsuranceInfo->workers_compensation_policy_exp??''}}" class="btn view_btn btn-sm schedule-email-btn">
                                                                <i class="fa-solid fa-envelope"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if(isset($subcontractor->subContractorInsuranceInfo) && $subcontractor->subContractorInsuranceInfo->general_liability_insurance_company_info)
                                                    @php
                                                        $expiryDate = \Carbon\Carbon::parse($subcontractor->subContractorInsuranceInfo->general_liability_policy_exp);
                                                        $isExpiringSoon = $expiryDate->diffInDays(now()) <= 30;
                                                    @endphp
                                                    <tr @if($isExpiringSoon) style="background-color: #ffdddd;" @endif>
                                                        <td>{{$subcontractor->subContractorInsuranceInfo->general_liability_insurance_company_info??''}}</td>
                                                        <td>{{ \Carbon\Carbon::parse($subcontractor->subContractorInsuranceInfo->general_liability_policy_eff)->format('m-d-y') ?? '' }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($subcontractor->subContractorInsuranceInfo->general_liability_policy_exp)->format('m-d-y') ?? '' }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($subcontractor->subContractorInsuranceInfo->general_liability_attachment_date)->format('m-d-y') ?? '' }}</td>
                                                        <td><input type="checkbox" name="insurance_type" data-subcontractor-id="{{$subcontractor->id}}" data-type="general_liability" value="1" @if(isset($subcontractor->subContractorRecurringEmail) &&
                                                               $subcontractor->subContractorRecurringEmail->isNotEmpty() &&
                                                               $subcontractor->subContractorRecurringEmail->first()->insurance_type == 'general_liability' &&
                                                               $subcontractor->subContractorRecurringEmail->first()->same_agency == 1) checked @endif>
                                                        </td>
                                                        <td class="btn_td">
                                                            @if(!empty($subcontractor->subContractorInsuranceInfo->general_liability_attachment))
                                                                <a href="{{ asset('website') }}/{{$subcontractor->subContractorInsuranceInfo->general_liability_attachment}}"
                                                                   class="btn view_btn btn-sm"
                                                                   target="_blank">
                                                                    <i class="fa-solid fa-file-pdf"></i>
                                                                </a>
                                                            @else
                                                                <span class="btn view_btn btn-sm disabled">
                                                                <i class="fa-solid fa-file-pdf"></i>
                                                            </span>
                                                            @endif
                                                            <a href="javascript:void(0);" data-subcontractor-id="{{$subcontractor->id}}" data-type="general_liability" class="btn view_btn btn-sm upload-attachment-btn">
                                                                <i class="fa-solid fa-upload"></i>
                                                            </a>
                                                            <a href="javascript:void(0);" data-subcontractor-id="{{$subcontractor->id}}" data-type="general_liability" data-expiry-date="{{$subcontractor->subContractorInsuranceInfo->general_liability_policy_exp??''}}" class="btn view_btn btn-sm schedule-email-btn">
                                                                <i class="fa-solid fa-envelope"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if(isset($subcontractor->subContractorInsuranceInfo) && $subcontractor->subContractorInsuranceInfo->auto_insurance_company_info)
                                                    @php
                                                        $expiryDate = \Carbon\Carbon::parse($subcontractor->subContractorInsuranceInfo->auto_policy_exp);
                                                        $isExpiringSoon = $expiryDate->diffInDays(now()) <= 30;
                                                    @endphp
                                                    <tr @if($isExpiringSoon) style="background-color: #ffdddd;" @endif>
                                                        <td>{{$subcontractor->subContractorInsuranceInfo->auto_insurance_company_info??''}}</td>
                                                        <td>{{ \Carbon\Carbon::parse($subcontractor->subContractorInsuranceInfo->auto_policy_eff)->format('m-d-y') ?? '' }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($subcontractor->subContractorInsuranceInfo->auto_policy_exp)->format('m-d-y') ?? '' }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($subcontractor->subContractorInsuranceInfo->auto_attachment_date)->format('m-d-y') ?? '' }}</td>
                                                        <td><input type="checkbox" name="insurance_type" data-subcontractor-id="{{$subcontractor->id}}" data-type="auto" value="1" @if(isset($subcontractor->subContractorRecurringEmail) &&
                                                               $subcontractor->subContractorRecurringEmail->isNotEmpty() &&
                                                               $subcontractor->subContractorRecurringEmail->first()->insurance_type == 'auto' &&
                                                               $subcontractor->subContractorRecurringEmail->first()->same_agency == 1) checked @endif>
                                                        </td>
                                                        <td class="btn_td">
                                                            @if(!empty($subcontractor->subContractorInsuranceInfo->auto_attachment))
                                                                <a href="{{ asset('website') }}/{{$subcontractor->subContractorInsuranceInfo->auto_attachment}}"
                                                                   class="btn view_btn btn-sm"
                                                                   target="_blank">
                                                                    <i class="fa-solid fa-file-pdf"></i>
                                                                </a>
                                                            @else
                                                                <span class="btn view_btn btn-sm disabled">
                                                                <i class="fa-solid fa-file-pdf"></i>
                                                            </span>
                                                            @endif
                                                            <a href="javascript:void(0);" data-subcontractor-id="{{$subcontractor->id}}" data-type="auto" class="btn view_btn btn-sm upload-attachment-btn">
                                                                <i class="fa-solid fa-upload"></i>
                                                            </a>
                                                            <a href="javascript:void(0);" data-subcontractor-id="{{$subcontractor->id}}" data-type="auto" data-expiry-date="{{$subcontractor->subContractorInsuranceInfo->auto_policy_exp??''}}" class="btn view_btn btn-sm schedule-email-btn">
                                                                <i class="fa-solid fa-envelope"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="work-orders">
                                <div class="mb-4">
                                    <form>
                                        <div class="row mb-3 align-items-end">
                                            <div class="col">
                                                <label for="toWorkDate" class="form-label">From</label>
                                                <input type="date" class="form-control" id="fromWorkDate" placeholder="MM/DD/YYYY">
                                            </div>
                                            <div class="col">
                                                <label for="fromWorkDate" class="form-label">To</label>
                                                <input type="date" class="form-control" id="toWorkDate" placeholder="MM/DD/YYYY">
                                            </div>
                                            <div class="col-auto">
                                                <button type="button" class="btn btn-apply" id="applyFilterBtn"> Apply <i class="fa-solid fa-check"></i> </button>
                                            </div>
                                            <div class="col-auto">
                                                <button type="button" class="btn btn-secondary btn-reset" id="resetFilterBtn"> Reset <i class="fa-solid fa-arrows-spin"></i> </button>
                                            </div>
                                            <div class="col-auto">
{{--                                                <button type="button" class="btn btn-green send-contract-btn"  data-subcontractor-id="{{$subcontractor->id}}" data-toggle="modal" data-target="#sendContractModal"> Send Contract <i class="fa-solid fa-file-import"></i> </button>--}}
                                                <a href="{{url('sub_contractor_proposal_send')}}/{{$subcontractor->id}}" class="btn btn-green send-contract-btn"  > Send Contract <i class="fa-solid fa-file-import"></i> </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="mt-4 row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-borderless subContractor_work_order_tbl">
                                                <thead>
                                                <tr>
                                                    <th>Project Name</th>
                                                    <th>Project Address</th>
                                                    <th>Project Date</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody id="tableBody">
                                                @foreach($subcontractor->subContractorProposal->where('status', 'required')->sortByDesc('created_at') as $key => $contractor)
                                                    <tr class="tableRow" data-project-date="{{ \Carbon\Carbon::parse($contractor->created_at)->format('m/d/y') }}">
                                                    <td>{{ $contractor->getLead->title ?? "Not Available" }}</td>
                                                        <td>{{ $contractor->getLead->address ?? "Not Available" }}</td>
                                                        <td>{{ $contractor->created_at->format('m-d-Y') ?? "Not Available" }}</td>
                                                        @if($contractor->status == 'signed')
                                                            <td>
                                                                <badge class="badge badge-success"> Signed </badge>
                                                            </td>
                                                        @else
                                                            <td>
                                                                <badge class="badge badge-warning"> Required </badge>
                                                            </td>
                                                        @endif
                                                        <td class="btn_td">
                                                            {{--                                                            <a href="javascript:void(0);" class="btn view_btn btn-sm" download="PDF">--}}
                                                            {{--                                                                <i class="fa-solid fa-file-pdf"></i>--}}
                                                            {{--                                                            </a>--}}
                                                            <!-- For regular download -->
                                                            <!-- Regular PDF Download -->


                                                            <a href="{{ route('viewSubContractorPdf', ['id' => $contractor->proposal_template_id, 'lead_id' => $contractor->lead_id])  }}"
                                                               class="pdf-link"
                                                               data-fancybox="gallery"
                                                               data-type="iframe"
                                                               data-caption="Proposal Preview">
                                                                <i class="fa-solid fa-file-pdf"></i>
                                                            </a>
                                                            <!-- Download link -->
                                                            <a href="#" class="work-download-btn"
                                                               data-url="{{ route('viewSubContractorPdf', ['id' => $contractor->proposal_template_id, 'lead_id' => $contractor->lead_id]) }}?download=1"
                                                               title="Download as PDF">
                                                                <i class="fas fa-download"></i>
                                                            </a>




                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="jobs">
                                <div class="mb-4">
                                    <form>
                                        <div class="row mb-3 align-items-end">
                                            <div class="col">
                                                <label for="fromJobDate" class="form-label">From</label>
                                                <input type="date" class="form-control" id="fromJobDate" placeholder="MM/DD/YYYY">
                                            </div>
                                            <div class="col">
                                                <label for="toJobDate" class="form-label">To</label>
                                                <input type="date" class="form-control" id="toJobDate" placeholder="MM/DD/YYYY">
                                            </div>
                                            <div class="col-auto">
                                                <button type="button" class="btn btn-apply" id="applyJobFilterBtn"> Apply <i class="fa-solid fa-check"></i> </button>
                                            </div>
                                            <div class="col-auto">
                                                <button type="button" class="btn btn-secondary btn-reset" id="resetJobFilterBtn"> Reset <i class="fa-solid fa-arrows-spin"></i> </button>
                                            </div>
                                            {{--                                            <div class="col-auto">--}}
                                            {{--                                                <button type="button" class="btn btn-green"> Send Contract <i class="fa-solid fa-file-import"></i> </button>--}}
                                            {{--                                            </div>--}}
                                        </div>
                                    </form>
                                </div>
                                <div class="mt-4 row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-borderless subContractor-dataTable">
                                                <thead>
                                                <tr>
                                                    <th>Job Name</th>
                                                    <th>Job Address</th>
                                                    <th>Job Date</th>
                                                    <th>Status</th>
{{--                                                    <th>Actions</th>--}}
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($jobs as $job)
                                                    <tr class="tableRowJob" data-project-date="{{ $job->created_at }}">
                                                        <td>{{ $job->name??"Not Available" }}</td>
                                                        <td>{{ $job->getLead->address??"Not Available" }}</td>
                                                        <td>{{ $job->created_at->format('m-d-Y')??"Not Available" }}</td>
                                                        @if($job->job_status == 'active')
                                                            <td>
                                                                <badge class="badge badge-secondary"> Active </badge>
                                                            </td>
                                                        @else
                                                            <td>
                                                                <badge class="badge badge-success"> Completed </badge>
                                                            </td>
                                                        @endif
{{--                                                        <td class="btn_td">--}}
                                                            {{--                                                            <a href="javascript:void(0);" class="btn view_btn btn-sm" download="PDF">--}}
                                                            {{--                                                                <i class="fa-solid fa-file-pdf"></i>--}}
                                                            {{--                                                            </a>--}}
                                                            {{--                                                            <a href="https://docs.google.com/gview?url={{ route('viewProposalPdf', ['filename' => $contractor->description]) }}&embedded=true"--}}
                                                            {{--                                                               data-fancybox="gallery"--}}
                                                            {{--                                                               data-type="iframe"--}}
                                                            {{--                                                               data-caption="Proposal PDF">--}}
                                                            {{--                                                                <i class="fa-solid fa-file-pdf"></i>--}}
                                                            {{--                                                            </a>--}}

                                                            {{--                                                            <a href="https://docs.google.com/gview?url={{ route('viewSubContractorPdf', ['filename' => $contractor->getProposal->description]) }}&embedded=true"--}}
                                                            {{--                                                               data-fancybox="gallery"--}}
                                                            {{--                                                               data-type="iframe"--}}
                                                            {{--                                                               data-caption="Proposal PDF">--}}
                                                            {{--                                                                --}}{{--                                                    <img src="{{ asset('website/' . ($value->getProposalTemplates->screen_shot ?? '')) }}" alt="Proposal Screenshot" class="img-fluid">--}}
                                                            {{--                                                                <img src="{{ asset('website/images/pdf.png') }}" alt="PDF File" class="file-icon">--}}
                                                            {{--                                                                <span>View Proposal</span>--}}
                                                            {{--                                                            </a>--}}

                                                            {{--                                                            --}}{{-- Download PDF --}}
                                                            {{--                                                            <a href="{{ route('viewSubContractorPdf', ['filename' => $contractor->getProposal->description]) }}" download class="download-btn" title="Download as PDF">--}}
                                                            {{--                                                                <i class="fas fa-download"></i> Download--}}
                                                            {{--                                                            </a>--}}

                                                            {{--                                                            {{ json_encode($contractor) }}--}}

{{--                                                           updated--}}
{{--                                                            <a href="https://docs.google.com/gview?url={{ route('viewJoblPdf', ['filename' => $contractor->description]) }}&embedded=true"--}}
{{--                                                               data-fancybox="gallery"--}}
{{--                                                               data-type="iframe"--}}
{{--                                                               data-caption="Proposal PDF">--}}
{{--                                                                <i class="fa-solid fa-file-pdf"></i>--}}
{{--                                                            </a>--}}

{{--                                                            <a href="{{ route('viewJoblPdf', ['filename' => $contractor->description]) }}" download class="download-btn" title="Download as PDF">--}}

{{--                                                                <i class="fas fa-download"></i>--}}
{{--                                                            </a>--}}
{{--                                                        </td>--}}
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="finances">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h3 class="box-title">Monthly Payment</h3>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="form-check d-flex align-items-center mb-0" style="min-width: 100px;">
                                                    <input class="form-check-input" type="radio" name="monthlyChart" value="barChartMonthly" id="barChartInputMonthly" checked>
                                                    <label class="form-check-label mb-0" for="barChartInputMonthly">Bar Chart</label>
                                                </div>
                                                <div class="form-check d-flex align-items-center mb-0" style="min-width: 100px;">
                                                    <input class="form-check-input" type="radio" name="monthlyChart" value="lineChartMonthly" id="lineChartInputMonthly">
                                                    <label class="form-check-label mb-0" for="lineChartInputMonthly">Line Chart</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="barChartMonthly"></div>
                                        <div id="lineChartMonthly"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h3 class="box-title">Main Categories</h3>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="form-check d-flex align-items-center mb-0" style="min-width: 100px;">
                                                    <input class="form-check-input" type="radio" name="categoryChart" value="barChartCategory" id="barChartInputCategory" checked>
                                                    <label class="form-check-label mb-0" for="barChartInputCategory">Bar Chart</label>
                                                </div>
                                                <div class="form-check d-flex align-items-center mb-0" style="min-width: 100px;">
                                                    <input class="form-check-input" type="radio" name="categoryChart" value="lineChartCategory" id="lineChartInputCategory">
                                                    <label class="form-check-label mb-0" for="lineChartInputCategory">Line Chart</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="barChartCategory"></div>
                                        <div id="lineChartCategory"></div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <form>
                                        <div class="row mb-3 align-items-end">
                                            <div class="col">
                                                <label for="toFinDate" class="form-label">To</label>
                                                <input type="date" class="form-control" id="toFinDate" placeholder="MM/DD/YYYY">
                                            </div>
                                            <div class="col">
                                                <label for="fromFinDate" class="form-label">From</label>
                                                <input type="date" class="form-control" id="fromFinDate" placeholder="MM/DD/YYYY">
                                            </div>
                                            <div class="col-auto">
                                                <button type="button" class="btn btn-apply"> Apply <i class="fa-solid fa-check"></i> </button>
                                            </div>
                                            <div class="col-auto">
                                                <button type="button" class="btn btn-secondary btn-reset"> Reset <i class="fa-solid fa-arrows-spin"></i> </button>
                                            </div>
                                            <div class="col-auto">
                                                <button type="button" class="btn btn-green" data-toggle="modal" data-target="#createInvoiceModal">
                                                    Create Invoice <i class="fa-solid fa-file-import"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="mt-4 row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-borderless subContractor-dataTable">
                                                <thead>
                                                <tr>
                                                    <th>Invoice Number</th>
                                                    <th>Job Name</th>
                                                    <th>Price</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th>Created By</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($invoices as $invoice)
                                                    <tr>
                                                        <td>{{$invoice->invoice_unique_id??''}}</td>
                                                        <td>{{$invoice->getJob->name??''}}</td>
                                                        <td>${{$invoice->total}}</td>
                                                        <td class="status">
                                                            {{--                                                    <badge class="badge badge-success"> {{$invoice->status}} </badge>--}}
                                                            <div class="dropdown ">
                                                                @if($invoice->status == 'pending' && $invoice->created_by != auth()->user()->id)
                                                                    <button class="btn dropdown-toggle" type="button" id="statusDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <span class="
                                                                    @if($invoice->status == 'pending')
                                                                        text-warning
                                                                    @endif
                                                                        ">
                                                                    {{ ucfirst($invoice->status) }}
                                                                </span>
                                                                    </button>
                                                                    <div class="dropdown-menu" aria-labelledby="statusDropdown">
                                                                        <a class="dropdown-item text-success" href="javascript:void(0);" onclick="confirmPaymentAction('{{ url('change_invoice_status/' . $invoice->id . '/approved') }}','You are approving this transaction. Do you want to continue?', '{{ $invoice->id }}', '{{ $invoice->total }}', 'approved','{{ $invoice->lead_id }}','{{$invoice->job_id}}')">Approved</a>
                                                                        <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="confirmPaymentAction('{{ url('subContractorReceiveable/sub-contractor-receiveable/' . $invoice->id . '/rejected') }}','Are you sure you want to reject this invoice? Once rejected, no further changes can be made.', '{{ $invoice->id }}','{{ $invoice->total }}','rejected',{{ $invoice->lead_id }},'{{$invoice->job_id}}')">Rejected</a>
                                                                    </div>
                                                                @else
                                                                    <button class="btn" type="button" >
                                                                <span class="
                                                                     @if($invoice->status == 'approved')
                                                                      text-success
                                                                     @elseif($invoice->status == 'rejected')
                                                                      text-danger
                                                                     @elseif($invoice->status == 'pending')
                                                                      text-warning
                                                                     @endif
                                                                ">
                                                                 {{ ucfirst($invoice->status) }}
                                                                </span>
                                                                    </button>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td>{{$invoice->created_at->format('m-d-Y')}}</td>
                                                        <td>@if($invoice->creator->hasRole('user')) MJT Roofing LLC @else {{$invoice->getSubContractor->subContractorCompany->name??''}} @endif</td>
                                                        <td class="btn_td">
                                                            <button type="button" class="btn view_subcontractor_invoice" data-invoice-id="{{$invoice->id}}" data-bs-toggle="modal">
                                                                <i class="fa-solid fa-eye"></i>
                                                            </button>
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
            </div>
        </div>


    </section>

    {{--    SEND CONTRACT MODAL--}}
    <div class="modal fade" id="sendContractModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Send Contract to Subcontractor</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('/subContractorProposal/sub-contractor-proposal') }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="sub_contractor_id" id="contractSubcontractorId">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Select Lead</label>
                                    <select name="lead_id" id="leadSelect" class="form-control select2 select_contractor_modal_global" data-placeholder="Select Lead" required>
                                        @foreach($leads as $lead)
                                            <option value="{{ $lead->id }}">{{ $lead->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label f>Select Work Order</label>
                                    <select  name="proposal_template_id"  id="proposalSelect" class="form-control select2 select_contractor_modal_global" data-placeholder="Select Work Order" required>
                                        @foreach($proposals as $proposal)
                                            <option value="{{ $proposal->id }}">{{ $proposal->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Email Subject</label>
                                    <input class="form-control" name="email_subject" placeholder="Enter email subject" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn d-block mx-auto btn-green">Send Contract</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--    SEND CONTRACT MODAL--}}
    {{--UPLOAD ATTACHMENT MODAL--}}
    <div class="modal fade" id="uploadAttachmentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Attachment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="attachmentUploadForm" method="POST" action="{{url('upload_insurance_attachment')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="subcontractor_id" id="modalSubcontractorId">
                    <input type="hidden" name="insurance_type" id="modalInsuranceType">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="attachmentFile" class="form-label">Select File</label>
                            <input class="form-control" type="file" name="attachment" id="attachmentFile" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--UPLOAD ATTACHMENT MODAL--}}
    {{--SCHEDULE EMAIL MODAL--}}
    <div id="email_div"></div>
    {{--SCHEDULE EMAIL MODAL--}}


    <!-- Create Invoice Modal -->
    <div id="createInvoiceModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Invoice</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{url('subContractorInvoice/sub-contractor-invoice')}}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="subcontractor_id" value="{{$subcontractor->id}}">
                        <input type="hidden" name="bill_from" value="MJT Roofing LLC">
                        <input type="hidden" name="address" value="{{$subcontractor->profile->address??''}}">
                        <input type="hidden" name="sub_total" id="subTotalInput" value="0">
                        <input type="hidden" name="tax_total" id="taxAmountInput" value="0">
                        <input type="hidden" name="total_amount" id="totalAmountInput" value="0">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Bill To</label>
                                    <select name="bill_to" class="form-control custom_modal_select2" data-placeholder="Select Bill To" readonly="">
                                        <option value="{{$subcontractor->id}}">{{$subcontractor->first_name??''}} {{$subcontractor->last_name??''}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Lead</label>
                                    <select name="lead_id" id="subcontractor_lead_id" class="form-control custom_modal_select2" data-placeholder="Select Lead" required>
                                        @foreach($jobLeads as $lead)
                                            <option value="{{$lead->lead_id}}" data-subcontractor-id="{{$subcontractor->id}}">{{$lead->getLead->title??''}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Job/Task</label>
                                    <select name="job_id" id="subcontractor_job_id" class="form-control custom_modal_select2 select_invoice_modal_global" data-placeholder="Select Job/Task" required>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table class="table ">
                                    <thead>
                                    <tr>
                                        <th>Tax</th>
                                        <th>Product Name</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="productRows">
                                    <tr class="product-row">
                                        <td class="text-center align-middle">
                                            <input type="checkbox" class="row-tax">
                                        </td>
                                        <td>
                                            <input type="text" name="products[]" class="form-control product-name" required placeholder="Product Name">
                                        </td>
                                        <td>
                                            <input type="number" name="quantities[]" class="form-control quantity" min="1" required placeholder="Qty">
                                        </td>
                                        <td>
                                            <input type="number" name="unit_prices[]" class="form-control unit-price" min="0" placeholder="Rate">
                                        </td>
                                        <td>
                                            <input type="hidden" name="row_taxes[]" class="row-tax-amount" value="0">
                                            <input type="number" name="amounts[]" class="form-control amount" readonly placeholder="Total">
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary btn-sm add-product-row">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-end fw-bold">Sub Total:</td>
                                        <td><span id="subTotalText">$0.00</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="text-end fw-bold">Tax:</td>
                                        <td><span id="taxAmountText">$0.00</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="text-end fw-bold">Total:</td>
                                        <td><span id="totalAmountText">$0.00</span></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn d-block mx-auto btn-green">Create</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- View Invoice Modal (Static) -->
    <div id="invoice_details"></div>
    <div id="confirmPaymentModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content shadow-lg rounded-3">
                <!-- Modal Header -->
                <div class="modal-header bg-gradient-primary text-white">
                    <h5 class="modal-title fw-bold">Confirm Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-remove"></i></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form method="POST" action="{{ url('subContractorReceiveable/sub-contractor-receiveable') }}" accept-charset="UTF-8"
                          class="form-horizontal" id="confirm_payment_form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="lead_id" id="lead_id" >
                        <input type="hidden" name="job_id" id="receive_job_id" >
                        <input type="hidden" name="invoice_id" id="receive_invoice_id">
                        <input type="hidden" name="amount" id="invoice_amount">
                        <input type="hidden" name="status" id="invoice_status">

                        {{--                        <input type="hidden" name="date" id="current_date">--}}
                        <div class="form-group">
                            <label for="payment_type" class="control-label">{{ 'Payment Type' }} *</label>
                            <select class="select2-receive form-control clr_input_fields select2" name="payment_type" id="payment_type" required>
                                <option value="" selected disabled>Select Payment Type</option>
                                @foreach($paymenttypes as $paymenttype)
                                    <option value="{{$paymenttype->id}}" @if(isset($receivepayment) && $paymenttype->id == $receivepayment->payment_type) selected @endif>{{ $paymenttype->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">{{ 'Date' }} *</label>
                            <input type="date" name="date" class="form-control" value="{{ $yearEstimation->year . '-01-01' ?? '' }}"  required>
                        </div>
                        <div class="">
                            <button type="submit" class="btn d-block mx-auto btn-green">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <!--Morris JavaScript -->
    <script src="{{asset('plugins/components/raphael/raphael-min.js')}}"></script>
    <script src="{{asset('plugins/components/morrisjs/morris.js')}}"></script>
    <script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>



        $(document).ready(function () {
            var taxRate = 0;
            $(document).on('change', '#subcontractor_lead_id', function () {
                var leadId = $(this).val();
                var subcontractorId = $(this).find('option:selected').data('subcontractor-id');

                if (leadId) {
                    $.ajax({
                        url: '{{url("get_lead_job")}}',
                        type: 'GET',
                        data: {
                            lead_id: leadId,
                            subcontractor_id: subcontractorId
                        },
                        success: function (response) {
                            console.log('Response:', response);

                            // Update taxRate from response.lead.tax
                            if (response.lead && typeof response.lead.tax !== 'undefined') {
                                taxRate = parseFloat(response.lead.tax) || 0;
                            }
                            console.log('lead taxRate' , taxRate)

                            var $jobSelect = $('#subcontractor_job_id');
                            $jobSelect.empty().append('<option value=""></option>');

                            if (response.task && response.task.length) {
                                $.each(response.task, function (key, job) {
                                    $jobSelect.append('<option value="' + job.id + '">' + job.name + '</option>');
                                });
                            } else {
                                console.log('No jobs found');
                            }

                            calculateTotals(); // recalc totals with updated taxRate
                        }
                    });
                } else {
                    $('#subcontractor_job_id').empty().append('<option value=""></option>');
                    taxRate = 0;
                    calculateTotals();
                }
            });

            function calculateAmount(row) {
                const qty = parseFloat(row.find('.quantity').val()) || 0;
                const price = parseFloat(row.find('.unit-price').val()) || 0;
                const amount = qty * price;
                row.find('.amount').val(amount.toFixed(2));
            }

            function calculateTotals() {
                let subTotal = 0,
                    taxTotal = 0;

                $('#productRows .product-row').each(function () {
                    const row = $(this);
                    const amount = parseFloat(row.find('.amount').val()) || 0;
                    const taxApplied = row.find('.row-tax').is(':checked');
                    let rowTax = 0;
                    subTotal += amount;

                    if (taxApplied) {
                        rowTax = (amount * taxRate / 100);
                        taxTotal += rowTax;
                    }

                    row.find('.row-tax-amount').val(rowTax.toFixed(2));
                });

                const total = subTotal + taxTotal;

                $('#subTotalText').text(`$${subTotal.toFixed(2)}`);
                $('#taxAmountText').text(`$${taxTotal.toFixed(2)}`);
                $('#totalAmountText').text(`$${total.toFixed(2)}`);

                // update hidden inputs
                $('#subTotalInput').val(subTotal.toFixed(2));
                $('#taxAmountInput').val(taxTotal.toFixed(2));
                $('#totalAmountInput').val(total.toFixed(2));
            }


            $('#productRows').on('input', '.quantity, .unit-price', function () {
                const row = $(this).closest('.product-row');
                calculateAmount(row);
                calculateTotals();
            });

            $('#productRows').on('change', '.row-tax', function () {
                calculateTotals();
            });

            $('#productRows').on('click', '.add-product-row', function () {
                const newRow = `
        <tr class="product-row">
            <td class="text-center align-middle">
                <input type="checkbox" class="row-tax">
            </td>
            <td>
                <input type="text" name="products[]" class="form-control product-name" required placeholder="Product Name">
            </td>
            <td>
                <input type="number" name="quantities[]" class="form-control quantity" min="1" required placeholder="Qty">
            </td>
            <td>
                <input type="number" name="unit_prices[]" class="form-control unit-price" min="0" placeholder="Price">
            </td>
            <td>
                 <input type="hidden" name="row_taxes[]" class="row-tax-amount" value="0">
                <input type="number" name="amounts[]" class="form-control amount" readonly placeholder="Amount">
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm remove-row">
                    <i class="fa fa-minus"></i>
                </button>
            </td>
        </tr>`;
                $('#productRows').append(newRow);
            });

            $('#productRows').on('click', '.remove-row', function () {
                $(this).closest('tr').remove();
                calculateTotals();
            });

            // Initial calculation on page load
            calculateTotals();
        });
        $(document).ready(function () {
            $('#applyFilterBtn').on('click', function () {
                var fromDate = $('#fromWorkDate').val();
                var toDate = $('#toWorkDate').val();
                if (fromDate && toDate) {
                    var from = new Date(fromDate).setHours(0, 0, 0, 0);
                    var to = new Date(toDate).setHours(23, 59, 59, 999);
                    $('.tableRow').each(function () {
                        var projectDate = new Date($(this).attr('data-project-date'));
                        if (projectDate >= from && projectDate <= to) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                }
            });
            //Job Filter
            $('#applyJobFilterBtn').on('click', function () {
                var fromDate = $('#fromJobDate').val();
                var toDate = $('#toJobDate').val();
                if (fromDate && toDate) {
                    var from = new Date(fromDate).setHours(0, 0, 0, 0);
                    var to = new Date(toDate).setHours(23, 59, 59, 999);
                    $('.tableRowJob').each(function () {
                        var projectDate = new Date($(this).attr('data-project-date'));
                        if (projectDate >= from && projectDate <= to) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                }
            });

            $('#resetFilterBtn').on('click', function () {
                $('#fromWorkDate').val('');
                $('#toWorkDate').val('');
                $('.tableRow').show();
            });
            $('#resetJobFilterBtn').on('click', function () {
                $('#fromJobDate').val('');
                $('#toJobDate').val('');
                $('.tableRowJob').show();
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            Fancybox.bind('[data-fancybox="gallery"]', {
                content: {
                    type: 'iframe',
                    attr: {
                        style: 'width: 80%; height: 80%;',
                        scrolling: 'auto',
                        allow: 'autoplay; fullscreen',
                        allowfullscreen: true
                    }
                },
                Toolbar: {
                    display: {
                        left: [],
                        middle: [],
                        right: ['close']
                    }
                },
                on: {
                    error: () => {
                        alert('Error loading content. Please try again.');
                    }
                }
            });
        });
        $(function () {
            $('.subContractor-dataTable').DataTable({
                'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': [-1]
                }],
                "dom": '<"top"r>t<"bottom"ip><"clear">',
            });
        });

        $(function () {
            $('.subContractor_work_order_tbl').DataTable({
                ordering: false,
                dom: '<"top"r>t<"bottom"ip><"clear">'
            });

        });

        $(document).on('click', '.tab-content #insurance button', function () {
            let inputs = $(this).closest('.tab-item').find('input');
            let isEditButton = $(this).hasClass('btn-edit');
            let isCancelButton = $(this).hasClass('btn-cancel');
            inputs.each(function() {
                if (isEditButton) {
                    if ($(this).attr('type') !== 'file') {
                        if ($(this).attr('readonly')) {
                            $(this).removeAttr('readonly');
                        } else {
                            $(this).attr('readonly', true);
                        }
                    }
                    if ($(this).attr('type') === 'file') {
                        $(this).prop('disabled', false);
                    }
                }
                if (isCancelButton) {
                    if ($(this).attr('type') !== 'file') {
                        $(this).attr('readonly', true);
                    }
                    if ($(this).attr('type') === 'file') {
                        $(this).prop('disabled', true);
                    }
                }
            });
        });
        $(document).on('click','#finances-tab',function(){
            //Monthly Chart
            let barSVGMonthly = $('#barChartMonthly svg');
            if(!barSVGMonthly.length > 0){
                monthlyBarChart();
            }
            let lineSVG = $('#lineChartMonthly svg');
            if(!lineSVG.length > 0){
                monthlyLineChart();
            }
            //Category Chart
            let barSVGCategory = $('#barChartCategory svg');
            if(!barSVGCategory.length > 0){
                categoryBarChart();
            }
            let lineSVGCategory = $('#lineChartCategory svg');
            if(!lineSVGCategory.length > 0){
                categoryLineChart();

                //AddClass
                $('#finances').addClass('tabChart');
            }
        });
        //Monthlu Payment Chart
        function monthlyBarChart() {
            var data = [
                {y: 'Jan', a: 12},
                {y: 'Feb', a: 15},
                {y: 'Mar', a: 18},
                {y: 'Apr', a: 5},
                {y: 'May', a: 10},
                {y: 'Jun', a: 23},
                {y: 'Jul', a: 12},
                {y: 'Aug', a: 22},
                {y: 'Sep', a: 5},
                {y: 'Oct', a: 20},
                {y: 'Nov', a: 34},
                {y: 'Dec', a: 20}
            ];
            //Bar Chart
            var barConfig = {
                element: 'barChartMonthly',
                data: data,
                xkey: 'y',
                ykeys: ['a'],
                labels: true,
                barColors: ['#223274'],
                fillOpacity: 0.6,
                hideHover: 'auto',
                resize: true,
                xLabelAngle: 360,
                barSizeRatio: 0.4,
                hoverCallback: function (index, options, content, row) {
                    return "<div class='tooltip-custom'><span class='tooltip-bullet' style='background: #223274;'></span> " + row.y + ": " + row.a + "</div>";
                },
            };
            //Render the bar chart
            Morris.Bar(barConfig);
        }
        function monthlyLineChart() {
            var data = [
                {y: 'Jan', a: 10},
                {y: 'Feb', a: 15},
                {y: 'Mar', a: 20},
                {y: 'Apr', a: 12},
                {y: 'May', a: 18},
                {y: 'Jun', a: 25},
                {y: 'Jul', a: 30},
                {y: 'Aug', a: 24},
                {y: 'Sep', a: 18},
                {y: 'Oct', a: 15},
                {y: 'Nov', a: 20},
                {y: 'Dec', a: 10}
            ];
            //Line Chart
            var lineConfig = {
                element: 'lineChartMonthly',
                data: data,
                xkey: 'y',
                ykeys: ['a'],
                labels: ['Value'],
                lineColors: ['#223274'],
                pointSize: 7,
                pointFillColors: ['#fff'],
                pointStrokeColors: ['#223274'],
                lineWidth: 2,
                ymax: 40,
                ymin: 0,
                hideHover: 'auto',
                resize: true,
                xLabelAngle: 0,
                hoverCallback: function (index, options, content, row) {
                    return "<div class='tooltip-custom'><span class='tooltip-bullet' style='background: #223274;'></span> " + row.y + ": " + row.a + "</div>";
                },
                parseTime: false
            };
            //Render the line chart
            Morris.Line(lineConfig);
        }
        //Main Category Chart
        function categoryBarChart() {
            var data = [
                {y: 'Metal Roofing', a: 18},
                {y: 'Plywood', a: 58},
                {y: 'Roofing', a: 29},
                {y: 'Wood Shakes', a: 8},
                {y: 'Green Roofing', a: 25}
            ];
            //Bar Chart
            var barConfig = {
                element: 'barChartCategory',
                data: data,
                xkey: 'y',
                ykeys: ['a'],
                labels: true,
                barColors: ['#478500'],
                fillOpacity: 0.6,
                hideHover: 'auto',
                resize: true,
                xLabelAngle: 0,
                barSizeRatio: 0.8,
                hoverCallback: function (index, options, content, row) {
                    return "<div class='tooltip-custom'><span class='tooltip-bullet' style='background:#478500;'></span> " + row.y + ": " + row.a + "</div>";
                },
            };
            //Render the bar chart
            Morris.Bar(barConfig);
        }
        function categoryLineChart() {
            var data = [
                {y: 'Metal Roofing', a: 40},
                {y: 'Plywood', a: 33},
                {y: 'Roofing', a: 48},
                {y: 'Wood Shakes', a: 30},
                {y: 'Green Roofing', a: 50}
            ];

            //Line Chart
            var lineConfig = {
                element: 'lineChartCategory',
                data: data,
                xkey: 'y',
                ykeys: ['a'],
                labels: ['Value'],
                lineColors: ['#478500'],
                pointSize: 7,
                pointFillColors: ['#fff'],
                pointStrokeColors: ['#223274'],
                lineWidth: 2,
                ymax: 70,
                ymin: 0,
                hideHover: 'auto',
                resize: true,
                xLabelAngle: 90,
                hoverCallback: function (index, options, content, row) {
                    return "<div class='tooltip-custom'><span class='tooltip-bullet' style='background: #478500;'></span> " + row.y + ": " + row.a + "</div>";
                },
                parseTime: false
            };

            //Render the line chart
            Morris.Line(lineConfig);
        }
    </script>
    <script>
        $(document).ready(function() {
            // Get CSRF token from the form (assuming you have a hidden _token field)
            function getCsrfToken(form) {
                return form.find('input[name="_token"]').val();
            }
            // Real-time update on field change
            $('.insurance-form').on('change', 'input:not([type="file"])', function() {
                const form = $(this).closest('form');
                updateInsuranceData(form);
            });
            // File input change handler
            $('.insurance-form').on('change', 'input[type="file"]', function() {
                const form = $(this).closest('form');
                updateInsuranceData(form);
            });
            // Function to handle AJAX update
            function updateInsuranceData(form) {
                const formData = new FormData(form[0]);
                const insuranceType = form.data('type');
                const subcontractorId = form.data('subcontractor-id');

                // Add additional data to FormData
                formData.append('insurance_type', insuranceType);
                formData.append('subcontractor_id', subcontractorId);
                // Add CSRF token directly to FormData (alternative to headers)
                formData.append('_token', getCsrfToken(form));
                $.ajax({
                    url: "{{ url('subcontractors/update-insurance') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,  // Required for file uploads
                    contentType: false, // Required for file uploads
                    success: function(response) {

                    },
                    error: function(xhr) {

                    }
                });
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            // Handle upload button click
            $('.upload-attachment-btn').on('click', function () {
                const subcontractorId = $(this).data('subcontractor-id');
                const insuranceType = $(this).data('type');

                // Set values in modal
                $('#modalSubcontractorId').val(subcontractorId);
                $('#modalInsuranceType').val(insuranceType);
                // Show modal
                $('#uploadAttachmentModal').modal('show');
            });
            $('#uploadAttachmentModal').on('hidden.bs.modal', function() {
                $('#attachmentUploadForm')[0].reset();
                $('#attachmentUploadForm button[type="submit"]').prop('disabled', false).html('Upload');
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.send-contract-btn').on('click', function () {
                const subcontractorId = $(this).data('subcontractor-id');
                $('#contractSubcontractorId').val(subcontractorId);
                // $('#sendContractModal').modal('show');
            });

            $('.schedule-email-btn').on('click', function () {
                const subcontractorId = $(this).data('subcontractor-id');
                const insuranceType = $(this).data('type');
                const policyExp = $(this).data('expiry-date');
                $.ajax({
                    url: '{{ url("get_recurring_email_schedule") }}',
                    method: 'GET',
                    data: {
                        subcontractorId: subcontractorId,
                        insuranceType: insuranceType,
                        policyExp: policyExp
                    },
                    success: function(response) {
                        $('#email_div').html(response);
                        $('#scheduleEmailModal').modal('show');
                        $('#emailSubcontractorId').val(subcontractorId);
                        $('#emailInsuranceType').val(insuranceType);
                        $('#emailExpiryDate').val(policyExp);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('change', 'input[name="insurance_type"]', function() {
                const isChecked = $(this).is(':checked');
                const subcontractorId = $(this).data('subcontractor-id');
                const insuranceType = $(this).data('type');
                const value = $(this).val();

                const data = {
                    subcontractor_id: subcontractorId,
                    type: insuranceType,
                    value: isChecked ? value : 0,
                    _token: '{{ csrf_token() }}'
                };

                // AJAX request
                $.ajax({
                    url: '{{ url("update_insurance_agency_status") }}',
                    method: 'POST',
                    data: data,
                    success: function(response) {
                        console.log('Success:', response);
                        if (response.message == 'success') {
                            Swal.fire('Success')
                        } else {
                            Swal.fire('No Schedule Found Against This Insurance Type');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
        $(document).on('click', '.work-download-btn', function (e) {
            e.preventDefault();
            let url = $(this).data('url');
            let a = document.createElement('a');
            a.href = url;
            a.setAttribute('download', '');
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        });
    </script>

    <script>
        $(document).on('click', '.view_subcontractor_invoice', function(){
            var id = $(this).data('invoice-id');
            $.ajax({
                url: '{{ url("get_subcontractor_invoice") }}',
                method: 'GET',
                data: {
                    id: id
                },
                success: function(response) {
                    $('#invoice_details').html(response);
                    $('#viewInvoiceModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });

        function confirmPaymentAction(url, message, invoiceId, amount, actionType, leadId, jobId) {
            Swal.fire({
                title: 'Are you sure?',
                text: message,
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log('Action Type:', actionType); // Debugging action type
                    $('#receive_invoice_id').val(invoiceId);
                    $('#invoice_amount').val(amount);
                    $('#lead_id').val(leadId);
                    $('#receive_job_id').val(jobId);
                    $('#invoice_status').val(actionType);
                    const today = new Date();
                    const formattedDate = today.toISOString().split('T')[0];
                    $('#current_date').val(formattedDate);

                    if (actionType === 'approved') {
                        console.log('Opening modal...');
                        $('#confirmPaymentModal').modal('show');
                    }
                    else if (actionType === 'rejected') {

                        $.ajax({
                            url: '{{ url("subContractorReceiveable/sub-contractor-receiveable") }}',
                            method: 'POST',
                            data: {
                                status: actionType,
                                invoice_id: invoiceId,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Status Updated',
                                    confirmButtonText: 'OK',
                                    showConfirmButton: true
                                }).then(() => {
                                    location.reload();
                                });

                            },
                            error: function(xhr, status, error) {
                                console.error('Error:', error);
                            }
                        });
                    }
                    else {
                        console.log('Redirecting to:', url);
                        window.location.href = url;
                    }
                }
            });
        }
        $(document).ready(function() {
            // Iterate over each input with class 'date_format'
            $('.date_format').each(function() {
                var dateInput = $(this);
                var dateValue = dateInput.val();

                // Check if the value is not empty
                if (dateValue) {
                    // Parse the date in yyyy-mm-dd format
                    var date = new Date(dateValue);

                    // Format the date as mm-dd-yy
                    var formattedDate = (date.getMonth() + 1).toString().padStart(2, '0') +
                        '-' + date.getDate().toString().padStart(2, '0') +
                        '-' + date.getFullYear().toString().slice(-2); // m-d-yy

                    // Set the formatted value back to the input
                    dateInput.val(formattedDate);
                }
            });
        });

    </script>

@endpush
