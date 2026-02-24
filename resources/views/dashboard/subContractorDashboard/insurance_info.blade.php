@extends('layouts.new-master')

@push('css')
@endpush

@section('content')
    <section class="insurance_info_sec form_sec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <h4 class="page-title">Insurance Info</h4>
                    </div>
                    <div class="white-box">
                        <form class="row insurance-form" data-type="workers_compensation" data-subcontractor-id="{{ $subcontractor->id }}">
                            @csrf
                            <div class="col-md-12">
                                <div class="form_top_box">
                                    <h4>Workers Company</h4>
                                    <button class="btn btn_primary" type="button">Edit <i class="fa-regular fa-edit"></i></button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Insurance Company Info</label>
                                    <input type="text" class="form-control" name="workers_compensation_insurance_company_info" value="{{$subcontractor->subContractorInsuranceInfo->workers_compensation_insurance_company_info??''}}" id="workersCompany" placeholder="Enter Insurance Company Info" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Contact Name</label>
                                    <input type="text" class="form-control" name="workers_compensation_contact_name" value="{{$subcontractor->subContractorInsuranceInfo->workers_compensation_contact_name??''}}" id="workersContactName" placeholder="Enter Contact Name" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" name="workers_compensation_phone" value="{{$subcontractor->subContractorInsuranceInfo->workers_compensation_phone??''}}" id="workersPhone" placeholder="Enter Phone" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="workers_compensation_email" value="{{$subcontractor->subContractorInsuranceInfo->workers_compensation_email??''}}" id="workersEmail" placeholder="Enter Email" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Insurance Carrier</label>
                                    <input type="text" class="form-control" name="workers_compensation_insurance_carrier" value="{{$subcontractor->subContractorInsuranceInfo->workers_compensation_insurance_carrier??''}}" id="workersCarrier" placeholder="Enter Insurance Carrier" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="file-upload-container">
                                        <div class="file-upload-box" id="fileUploadContainer1">
                                            <div class="file-upload-message" id="uploadMessage1">
                                                <i class="fa-regular fa-file-lines"></i>
                                                Add Attachment
                                            </div>
                                            <input type="file" class="custom-file-input" name="workers_compensation_attachment" id="fileInput1">
                                        </div>
                                        <ul class="file-name" id="fileName1"></ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Policy Effective</label>
                                    <input type="date" class="form-control" name="workers_compensation_policy_eff" value="{{$subcontractor->subContractorInsuranceInfo->workers_compensation_policy_eff??''}}" id="insurancePolicyEff" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Policy Expiry</label>
                                    <input type="date" class="form-control" name="workers_compensation_policy_exp" value="{{$subcontractor->subContractorInsuranceInfo->workers_compensation_policy_exp??''}}" id="insurancePolicyExp" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-buttons">
{{--                                    <button class="btn btn_primary" type="submit">Save <i class="fa-regular fa-circle-check"></i></button>--}}
                                    <button class="btn btn_secondary" type="button">Cancel <i class="fa-solid fa-xmark"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="white-box">
                        <form class="row insurance-form" data-type="general_liability" data-subcontractor-id="{{ $subcontractor->id }}">
                            @csrf
                            <div class="col-md-12">
                                <div class="form_top_box">
                                    <h4>General Liability</h4>
                                    <button class="btn btn_primary" type="button">Edit <i class="fa-regular fa-edit"></i></button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Insurance Company Info</label>
                                    <input type="text" class="form-control" name="general_liability_insurance_company_info" value="{{$subcontractor->subContractorInsuranceInfo->general_liability_insurance_company_info??''}}" id="generalCompany" placeholder="Enter Insurance company Info" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Contact Name</label>
                                    <input type="text" class="form-control" name="general_liability_contact_name" value="{{$subcontractor->subContractorInsuranceInfo->general_liability_contact_name??''}}" id="generalContactName" placeholder="Enter Contact Name" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" name="general_liability_phone" value="{{$subcontractor->subContractorInsuranceInfo->general_liability_phone??''}}" id="generalPhone" placeholder="Enter Phone" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="general_liability_email" value="{{$subcontractor->subContractorInsuranceInfo->general_liability_email??''}}" id="generalEmail" placeholder="Enter Email" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Insurance Carrier</label>
                                    <input type="text" class="form-control" name="general_liability_insurance_carrier" value="{{$subcontractor->subContractorInsuranceInfo->general_liability_insurance_carrier??''}}" id="generalCarrier" placeholder="Enter Insurance Carrier" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="file-upload-container">
                                        <div class="file-upload-box" id="fileUploadContainer2">
                                            <div class="file-upload-message" id="uploadMessage2">
                                                <i class="fa-regular fa-file-lines"></i>
                                                Add Attachment
                                            </div>
                                            <input type="file" class="custom-file-input" name="general_liability_attachment" id="fileInput2">
                                        </div>
                                        <ul class="file-name" id="fileName2"></ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Policy Effective</label>
                                    <input type="date" class="form-control" name="general_liability_policy_eff" value="{{$subcontractor->subContractorInsuranceInfo->general_liability_policy_eff??''}}" id="generalPolicyEff" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Policy Expiry</label>
                                    <input type="date" class="form-control" name="general_liability_policy_exp" value="{{$subcontractor->subContractorInsuranceInfo->general_liability_policy_exp??''}}" id="generalPolicyExp" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-buttons">
{{--                                    <button class="btn btn_primary" type="submit">Save <i class="fa-regular fa-circle-check"></i></button>--}}
                                    <button class="btn btn_secondary" type="button">Cancel <i class="fa-solid fa-xmark"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="white-box">
                        <form class="row insurance-form" data-type="auto" data-subcontractor-id="{{ $subcontractor->id }}">
                            @csrf
                            <div class="col-md-12">
                                <div class="form_top_box">
                                    <h4>Auto</h4>
                                    <button class="btn btn_primary" type="button">Edit <i class="fa-regular fa-edit"></i></button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Insurance Company Info</label>
                                    <input type="text" class="form-control" name="auto_insurance_company_info" value="{{$subcontractor->subContractorInsuranceInfo->auto_insurance_company_info??''}}" id="autoCompany" placeholder="Enter Insurance company Info" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Contact Name</label>
                                    <input type="text" class="form-control" name="auto_contact_name" value="{{$subcontractor->subContractorInsuranceInfo->auto_contact_name??''}}" id="autoContactName" placeholder="Enter Contact Name" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" name="auto_phone" value="{{$subcontractor->subContractorInsuranceInfo->auto_phone??''}}" id="autoPhone" placeholder="Enter Phone" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="auto_email" value="{{$subcontractor->subContractorInsuranceInfo->auto_email??''}}" id="autoEmail" placeholder="Enter Email" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Insurance Carrier</label>
                                    <input type="text" class="form-control" name="auto_insurance_carrier" value="{{$subcontractor->subContractorInsuranceInfo->auto_insurance_carrier??''}}" id="autoCarrier" placeholder="Enter Insurance Carrier" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="file-upload-container">
                                        <div class="file-upload-box" id="fileUploadContainer3">
                                            <div class="file-upload-message" id="uploadMessage3">
                                                <i class="fa-regular fa-file-lines"></i>
                                                Add Attachment
                                            </div>
                                            <input type="file" class="custom-file-input" id="fileInput3" name="auto_attachment">
                                        </div>
                                        <ul class="file-name" id="fileName3"></ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Policy Effective</label>
                                    <input type="date" class="form-control" name="auto_policy_eff" value="{{$subcontractor->subContractorInsuranceInfo->auto_policy_eff??''}}" id="autoPolicyEff" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Policy Expiry</label>
                                    <input type="date" class="form-control" name="auto_policy_exp" value="{{$subcontractor->subContractorInsuranceInfo->auto_policy_exp??''}}" id="autoPolicyExp" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-buttons">
{{--                                    <button class="btn btn_primary" type="submit">Save <i class="fa-regular fa-circle-check"></i></button>--}}
                                    <button class="btn btn_secondary" type="button">Cancel <i class="fa-solid fa-xmark"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
{{--                    <div class="white-box">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-12">--}}
{{--                            <div class="table-responsive">--}}
{{--                                <table class="table table-borderless subContractor-dataTable">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th>Description</th>--}}
{{--                                        <th>Policy EFF</th>--}}
{{--                                        <th>Policy EXP</th>--}}
{{--                                        <th>Attachment Date</th>--}}
{{--                                        <th>Same Agency</th>--}}
{{--                                        <th>Actions</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @if(isset($subcontractor->subContractorInsuranceInfo) && $subcontractor->subContractorInsuranceInfo->workers_compensation_insurance_company_info)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{$subcontractor->subContractorInsuranceInfo->workers_compensation_insurance_company_info??''}}</td>--}}
{{--                                            <td>{{$subcontractor->subContractorInsuranceInfo->workers_compensation_policy_eff??''}}</td>--}}
{{--                                            <td>{{$subcontractor->subContractorInsuranceInfo->workers_compensation_policy_exp??''}}</td>--}}
{{--                                            <td>{{$subcontractor->subContractorInsuranceInfo->workers_compensation_attachment_date??''}}</td>--}}
{{--                                            <td><input type="checkbox" name="insurance_type" data-subcontractor-id="{{$subcontractor->id}}" data-type="workers_compensation" value="1" @if(isset($subcontractor->subContractorRecurringEmail) &&--}}
{{--               $subcontractor->subContractorRecurringEmail->isNotEmpty() &&--}}
{{--               $subcontractor->subContractorRecurringEmail->first()->insurance_type == 'workers_compensation' &&--}}
{{--               $subcontractor->subContractorRecurringEmail->first()->same_agency == 1)--}}
{{--                                                    checked--}}
{{--                                                        @endif></td>--}}
{{--                                            <td class="btn_td">--}}
{{--                                                @if(!empty($subcontractor->subContractorInsuranceInfo->workers_compensation_attachment))--}}
{{--                                                    <a href="{{ asset('website')}}/{{$subcontractor->subContractorInsuranceInfo->workers_compensation_attachment}}"--}}
{{--                                                       class="btn view_btn btn-sm"--}}
{{--                                                       target="_blank">--}}
{{--                                                        <i class="fa-solid fa-file-pdf"></i>--}}
{{--                                                    </a>--}}
{{--                                                @else--}}
{{--                                                    <span class="btn view_btn btn-sm disabled">--}}
{{--                                                                <i class="fa-solid fa-file-pdf"></i>--}}
{{--                                                            </span>--}}
{{--                                                @endif--}}
{{--                                                <a href="javascript:void(0);" data-subcontractor-id="{{$subcontractor->id}}" data-type="workers_compensation" class="btn view_btn btn-sm upload-attachment-btn">--}}
{{--                                                    <i class="fa-solid fa-upload"></i>--}}
{{--                                                </a>--}}
{{--                                                <a href="javascript:void(0);" data-subcontractor-id="{{$subcontractor->id}}" data-type="workers_compensation" data-expiry-date="{{$subcontractor->subContractorInsuranceInfo->workers_compensation_policy_exp??''}}" class="btn view_btn btn-sm schedule-email-btn">--}}
{{--                                                    <i class="fa-solid fa-envelope"></i>--}}
{{--                                                </a>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endif--}}
{{--                                    @if(isset($subcontractor->subContractorInsuranceInfo) && $subcontractor->subContractorInsuranceInfo->general_liability_insurance_company_info)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{$subcontractor->subContractorInsuranceInfo->general_liability_insurance_company_info??''}}</td>--}}
{{--                                            <td>{{$subcontractor->subContractorInsuranceInfo->general_liability_policy_eff??''}}</td>--}}
{{--                                            <td>{{$subcontractor->subContractorInsuranceInfo->general_liability_policy_exp??''}}</td>--}}
{{--                                            <td>{{$subcontractor->subContractorInsuranceInfo->general_liability_attachment_date??''}}</td>--}}
{{--                                            <td><input type="checkbox" name="insurance_type" data-subcontractor-id="{{$subcontractor->id}}" data-type="general_liability" value="1" @if(isset($subcontractor->subContractorRecurringEmail) &&--}}
{{--               $subcontractor->subContractorRecurringEmail->isNotEmpty() &&--}}
{{--               $subcontractor->subContractorRecurringEmail->first()->insurance_type == 'general_liability' &&--}}
{{--               $subcontractor->subContractorRecurringEmail->first()->same_agency == 1)--}}
{{--                                                    checked--}}
{{--                                                        @endif></td>--}}
{{--                                            <td class="btn_td">--}}
{{--                                                @if(!empty($subcontractor->subContractorInsuranceInfo->general_liability_attachment))--}}
{{--                                                    <a href="{{ asset('website') }}/{{$subcontractor->subContractorInsuranceInfo->general_liability_attachment}}"--}}
{{--                                                       class="btn view_btn btn-sm"--}}
{{--                                                       target="_blank">--}}
{{--                                                        <i class="fa-solid fa-file-pdf"></i>--}}
{{--                                                    </a>--}}
{{--                                                @else--}}
{{--                                                    <span class="btn view_btn btn-sm disabled">--}}
{{--                                                                <i class="fa-solid fa-file-pdf"></i>--}}
{{--                                                            </span>--}}
{{--                                                @endif--}}
{{--                                                <a href="javascript:void(0);" data-subcontractor-id="{{$subcontractor->id}}" data-type="general_liability" class="btn view_btn btn-sm upload-attachment-btn">--}}
{{--                                                    <i class="fa-solid fa-upload"></i>--}}
{{--                                                </a>--}}
{{--                                                <a href="javascript:void(0);" data-subcontractor-id="{{$subcontractor->id}}" data-type="general_liability" data-expiry-date="{{$subcontractor->subContractorInsuranceInfo->general_liability_policy_exp??''}}" class="btn view_btn btn-sm schedule-email-btn">--}}
{{--                                                    <i class="fa-solid fa-envelope"></i>--}}
{{--                                                </a>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endif--}}
{{--                                    @if(isset($subcontractor->subContractorInsuranceInfo) && $subcontractor->subContractorInsuranceInfo->auto_insurance_company_info)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{$subcontractor->subContractorInsuranceInfo->auto_insurance_company_info??''}}</td>--}}
{{--                                            <td>{{$subcontractor->subContractorInsuranceInfo->auto_policy_eff??''}}</td>--}}
{{--                                            <td>{{$subcontractor->subContractorInsuranceInfo->auto_policy_exp??''}}</td>--}}
{{--                                            <td>{{$subcontractor->subContractorInsuranceInfo->auto_attachment_date??''}}</td>--}}
{{--                                            <td><input type="checkbox" name="insurance_type" data-subcontractor-id="{{$subcontractor->id}}" data-type="auto" value="1" @if(isset($subcontractor->subContractorRecurringEmail) &&--}}
{{--               $subcontractor->subContractorRecurringEmail->isNotEmpty() &&--}}
{{--               $subcontractor->subContractorRecurringEmail->first()->insurance_type == 'auto' &&--}}
{{--               $subcontractor->subContractorRecurringEmail->first()->same_agency == 1)--}}
{{--                                                    checked--}}
{{--                                                        @endif></td>--}}
{{--                                            <td class="btn_td">--}}
{{--                                                @if(!empty($subcontractor->subContractorInsuranceInfo->auto_attachment))--}}
{{--                                                    <a href="{{ asset('website') }}/{{$subcontractor->subContractorInsuranceInfo->auto_attachment}}"--}}
{{--                                                       class="btn view_btn btn-sm"--}}
{{--                                                       target="_blank">--}}
{{--                                                        <i class="fa-solid fa-file-pdf"></i>--}}
{{--                                                    </a>--}}
{{--                                                @else--}}
{{--                                                    <span class="btn view_btn btn-sm disabled">--}}
{{--                                                                <i class="fa-solid fa-file-pdf"></i>--}}
{{--                                                            </span>--}}
{{--                                                @endif--}}
{{--                                                <a href="javascript:void(0);" data-subcontractor-id="{{$subcontractor->id}}" data-type="auto" class="btn view_btn btn-sm upload-attachment-btn">--}}
{{--                                                    <i class="fa-solid fa-upload"></i>--}}
{{--                                                </a>--}}
{{--                                                <a href="javascript:void(0);" data-subcontractor-id="{{$subcontractor->id}}" data-type="auto" data-expiry-date="{{$subcontractor->subContractorInsuranceInfo->auto_policy_exp??''}}" class="btn view_btn btn-sm schedule-email-btn">--}}
{{--                                                    <i class="fa-solid fa-envelope"></i>--}}
{{--                                                </a>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endif--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </section>

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
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('form').each(function () {
                $(this).find('input').prop('readonly', true);
                $(this).find('[type="date"]').prop('disabled', true);
                $(this).find('.form-buttons').hide();
            });
            $('form .btn:contains("Edit")').on('click', function () {
                const $form = $(this).closest('form');
                $form.find('input').prop('readonly', false);
                $form.find('[type="date"]').prop('disabled', false);
                $form.find('.form-buttons').show();
                $(this).prop('disabled', true);
            });
            $('form .btn:contains("Cancel")').on('click', function () {
                const $form = $(this).closest('form');
                $form.find('input').prop('readonly', true);
                $form.find('[type="date"]').prop('disabled', true);
                $form.find('.form-buttons').hide();
                $form.find('.btn:contains("Edit")').prop('disabled', false);
                // $form[0].reset();
            });
        });
        $(document).ready(function () {
            function handleFileInputChange(inputId, fileNameId, messageId) {
                $(inputId).on('change', function (event) {
                    let files = event.target.files;
                    let fileNames = [];
                    for (let i = 0; i < files.length; i++) {
                        fileNames.push(files[i].name);
                    }
                    if (files.length > 0) {
                        // $(messageId).hide();
                        $(fileNameId).html(fileNames.map((name, index) =>
                            `<li>${name} <span class="remove-btn" data-file-index="${index}"><i class="fa-solid fa-xmark"></i></span></li>`
                        ).join(''));
                    } else {
                        // $(messageId).show();
                        $(fileNameId).empty();
                    }
                });
            }
            handleFileInputChange('#fileInput1', '#fileName1', '#uploadMessage1');
            handleFileInputChange('#fileInput2', '#fileName2', '#uploadMessage2');
            handleFileInputChange('#fileInput3', '#fileName3', '#uploadMessage3');
            $('#fileUploadContainer1').on('click', function () {
                $('#fileInput1').click();
            });
            $('#fileUploadContainer2').on('click', function () {
                $('#fileInput2').click();
            });
            $('#fileUploadContainer3').on('click', function () {
                $('#fileInput3').click();
            });
            $(document).on('click', '.remove-btn', function () {
                const fileIndex = $(this).data('file-index');
                const fileInput = $(this).closest('form').find('input[type="file"]');
                const files = Array.from(fileInput[0].files);
                files.splice(fileIndex, 1);
                fileInput[0].files = new FileListItems(files);
                $(this).parent().remove();
                if (files.length === 0) {
                    $(this).closest('.file-upload-box').find('.file-upload-message').show();
                }
            });
        });
        function FileListItems(files) {
            const b = new ClipboardEvent('').clipboardData || new DataTransfer();
            files.forEach(f => b.items.add(f));
            return b.files;
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
                $('#sendContractModal').modal('show');
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
    </script>
@endpush
