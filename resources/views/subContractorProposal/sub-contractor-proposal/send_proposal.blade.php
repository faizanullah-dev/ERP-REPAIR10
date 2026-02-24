@extends('layouts.master')

@push('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"  />
@endpush

@section('content')
    <section class="proposal_sec tabs_sec">
        <div class="container-fluid">
            <form action="{{ url('subContractorProposal/sub-contractor-proposal') }}" method="post" class="row" id="proposalForm">
                @csrf
                <input type="hidden" name="sub_contractor_id" id="contractSubcontractorId" value="{{ $id ?? '' }}">
                <input type="hidden" id="description" name="description">
                <input type="hidden" name="proposal_template_id" id="proposal_id">
                <input type="hidden" name="screen_shot" id="screen_shot">
                <input type="hidden" name="status" id="proposalStatus" value="required">
                <div class="col-md-12">
                    <div class="theme-selection">
                        <h3>Work Order Templates</h3>
                        <div class="proposal-options">
                            @foreach($proposalTemplate as $proposal)
                                <div class="proposal-card" data-proposal-id="{{ $proposal->id ?? '' }}">
                                    <div class="proposal_them_box">
                                        <div class="proposal_them_img_box">
                                            @if($proposal->screen_shot)
                                                <img src="{{ asset('website') }}/{{ $proposal->screen_shot ?? '' }}" alt="Proposal Screenshot">
                                            @endif
                                        </div>
                                    </div>
                                    <h6 class="proposal-title">{{ $proposal->name ?? 'Not Available' }}</h6>
                                    <div class="proposal_box_btns">
                                        <button class="btn edit-proposal-box dynamic_proposal_them_box" type="button" aria-label="Edit" ><i class="fa-solid fa-pen"></i></button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="customize-proposal row" style="display: none;">
                        <div class="col-md-12">
                            <div class="back-button-container">
                                <button type="button" id="back-button" class="btn btn-success pull-right back-button"><i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</button>
                            </div>
                            <div class="customize-proposal-header">
                                <div class="customize-proposal-header-left">
                                    <div class="form-group">
                                        <label for="leadFilter" class="form-label">Select Lead <span class="required_star">*</span></label>
                                        <select class="form-control select2 select_lead" id="leadFilter" name="lead_id" required>
                                            <option value="" selected disabled>Select Lead</option>
                                            @foreach($leads as $lead)
                                                <option value="{{ $lead->id }}">{{ $lead->title ?? "" }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Email Subject <span class="required_star">*</span></label>
                                        <input class="form-control" type="text" name="email_subject" placeholder="Enter email subject" required>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="customize-proposal-inner-left">
                                <div class="editor-panel">
                                    <h4>Customize Contract</h4>
                                    <div>
                                        {{--                                                    <div class="form-group">--}}
                                        {{--                                                        <label class="form-label">Select Proposal Type</label>--}}
                                        {{--                                                        <select class="form-control select2" id="" name="proposal_type">--}}
                                        {{--                                                            <option value="" selected disabled>Select Proposal Type</option>--}}
                                        {{--                                                            @foreach ($proposalTypes as $proposalType)--}}
                                        {{--                                                                <option value="{{ $proposalType->id }}" {{ $proposalType->id == $id ? 'selected' : '' }}>--}}
                                        {{--                                                                    {{ $proposalType->type ?? $proposalType->title ?? $proposalType->id }}--}}
                                        {{--                                                                </option>--}}
                                        {{--                                                            @endforeach--}}
                                        {{--                                                        </select>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                <div class="form-group">--}}
                                        {{--                                                    <label  class="form-label">Name</label>--}}
                                        {{--                                                    <input class="form-control proposals_name" name="name" placeholder="Proposal name here..." required>--}}
                                        {{--                                                </div>--}}

                                        {{--                                                <div class="form-group">--}}
                                        {{--                                                    <label  class="form-label">Select Lead</label>--}}
                                        {{--                                                    <select class="form-control select2 select_lead" id="leadFilter" name="lead_id">--}}
                                        {{--                                                        <option value="" selected disabled>Select Lead</option>--}}
                                        {{--                                                        @foreach($leads as $lead)--}}
                                        {{--                                                            <option value="{{$lead->id}}">{{$lead->title??""}}</option>--}}
                                        {{--                                                        @endforeach--}}
                                        {{--                                                    </select>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="form-group">--}}
                                        {{--                                                    <a class="btn green_btn  job_insurance_for_lead" data-lead-id="" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample"><i class="fas fa-house-damage"></i></a>--}}
                                        {{--                                                </div>--}}
                                    </div>
                                    <div class="left_box widget_box">
                                        <div class="text-widget">
                                            {{--                                            <label for="word-file-input" class="btn green_btn" >Import Word</label>--}}
                                            {{--                                            <input type="file" id="word-file-input" accept=".doc,.docx" style="display: none;" />--}}
                                            <h5 class="left_box_title">Text</h5>
                                            <div class="font-controls">
                                                <button type="button" class="btn green_btn" id="add-text">T</button>
                                                <select id="font-family" class="form-control font-family-select">
                                                    <option value="Arial">Arial</option>
                                                    <option value="Times New Roman">Times New Roman</option>
                                                    <option value="Helvetica">Helvetica</option>
                                                    <option value="Georgia">Georgia</option>
                                                    <option value="Courier New">Courier New</option>
                                                    <option value="Verdana">Verdana</option>
                                                    <option value="Tahoma">Tahoma</option>
                                                    <option value="Trebuchet MS">Trebuchet MS</option>
                                                    <option value="Impact">Impact</option>
                                                    <option value="Comic Sans MS">Comic Sans MS</option>
                                                    <option value="Calibri">Calibri</option>
                                                    <option value="Cambria">Cambria</option>
                                                    <option value="Garamond">Garamond</option>
                                                    <option value="Baskerville">Baskerville</option>
                                                    <option value="Lucida Console">Lucida Console</option>
                                                    <option value="Arial Black">Arial Black</option>
                                                    <option value="Palatino Linotype">Palatino Linotype</option>
                                                    <option value="Segoe UI">Segoe UI</option>
                                                    <option value="Arial Unicode MS">Arial Unicode MS</option>
                                                    <option value="Frank Ruhl Libre">Frank Ruhl Libre</option>
                                                    <option value="Droid Sans">Droid Sans</option>
                                                    <option value="Helvetica Neue">Helvetica Neue</option>
                                                    <option value="Futura">Futura</option>
                                                    <option value="Optima">Optima</option>
                                                    <option value="Lucida Grande">Lucida Grande</option>
                                                    <option value="Symbol">Symbol</option>
                                                    <option value="Wingdings">Wingdings</option>
                                                    <option value="Lucida Sans Unicode">Lucida Sans Unicode</option>
                                                    <option value="Arial MT">Arial MT</option>
                                                </select>
                                                <select id="font-size" class="form-control font-size-select">
                                                    <option value="8">8</option>
                                                    <option value="10">10</option>
                                                    <option value="12">12</option>
                                                    <option value="14">14</option>
                                                    <option value="16">16</option>
                                                    <option value="18">18</option>
                                                    <option value="20" selected>20</option>
                                                    <option value="24">24</option>
                                                    <option value="28">28</option>
                                                    <option value="32">32</option>
                                                    <option value="36">36</option>
                                                    <option value="40">40</option>
                                                    <option value="48">48</option>
                                                    <option value="56">56</option>
                                                    <option value="64">64</option>
                                                </select>
                                            </div>
                                            <div class="text-style-buttons">
                                                <input type="color"  id="text-color-picker" value="#000000">
                                                <button type="button" id="bold-text" class="btn"><strong>B</strong></button>
                                                <button type="button" id="italic-text" class="btn"><em>I</em></button>
                                                <button type="button" id="underline-text" class="btn"><u>U</u></button>
                                                <input type="color"  id="background-color-picker" value="#ffffff">
                                                <button type="button" id="numbered-list" class="btn"><i class="fa fa-list-ol"></i></button>
                                                <button type="button" id="bulleted-list" class="btn"><i class="fa fa-list-ul"></i></button>
                                                <button type="button" id="align-left" class="btn"><i class="fa fa-align-left"></i></button>
                                                <button type="button" id="align-center" class="btn"><i class="fa fa-align-center"></i></button>
                                                <button type="button" id="align-right" class="btn"><i class="fa fa-align-right"></i></button>
                                            </div>
                                        </div>
                                        <div class="image_widget">
                                            <h5 class="left_box_title">Image</h5>
                                            <input type="file" style="display: none" id="upload-image" class="form-control mb-2" accept="image/*">
                                            <label id="add-image" class="btn btn-success">
                                                <i class="fa fa-image"></i>
                                            </label>
                                        </div>
                                        <div class="table-panel">
                                            <h5 class="left_box_title">Table</h5>
                                            <div class="table-panel-input">
                                                <input class="form-control" type="number" id="table-rows" placeholder="Rows" min="0" max="20" value="">
                                                <input class="form-control" type="number" id="table-cols" placeholder="Cols" min="0" max="20" value="">
                                            </div>
                                            <button type="button" class="btn btn-block green_btn" id="add-table">Add Table</button>
                                            <button type="button" class="btn btn-block green_btn" id="add-product">Add Product Table</button>
                                        </div>
                                        <div class="table-panel">
                                            <h5 class="left_box_title">Variable</h5>
                                            <div class="table-panel-input">
                                                <select class="form-control select2 select_variable_initialize" id="variable-selector">
                                                    <option></option>
                                                    @foreach($variables as $variable)
                                                        <option>{{ $variable->value ?? "" }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="button" class="btn green_btn btn-block" id="add-variable">Add Variable</button>
                                        </div>
                                        <div class="signature_box">
                                            <h5 class="left_box_title">Checkbox</h5>
                                            {{--                                            <button type="button" class="btn green_btn btn-block" id="signatureBox">Add Signature Box</button>--}}
                                            <button type="button" class="btn green_btn btn-block" id="add-checkbox">Add Checkbox</button>
                                        </div>
                                        <div class="columns_widget">
                                            <h5 class="left_box_title">Columns</h5>
                                            <div class="btn-group row" data-toggle="buttons">
                                                <div class="col-md-4">
                                                    <div class="columns_layout_box">
                                                        <input type="radio" name="layout" id="add-blank" autocomplete="off" checked>
                                                        <label for="add-blank" class="active">
                                                            <div class="columns_layout_card"></div>
                                                            <span>Blank</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="columns_layout_box">
                                                        <input type="radio" name="layout" id="add-HeaderFooter" autocomplete="off">
                                                        <label for="add-HeaderFooter" class="">
                                                            <div class="columns_layout_card">
                                                                <div class="columns_line header_line"></div>
                                                                <div class="columns_line footer_line"></div>
                                                            </div>
                                                            <span>Header & Footer</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="columns_layout_box">
                                                        <input type="radio" name="layout" id="add-columns-2" autocomplete="off">
                                                        <label for="add-columns-2" class="">
                                                            <div class="columns_layout_card">
                                                                <div class="columns_line columns_two"></div>
                                                            </div>
                                                            <span>2 Columns</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="columns_layout_box">
                                                        <input type="radio" name="layout" id="add-columns-4" autocomplete="off">
                                                        <label for="add-columns-4" class="">
                                                            <div class="columns_layout_card">
                                                                <div class="columns_line top_line"></div>
                                                                <div class="columns_line right_line"></div>
                                                                <div class="columns_line bottom_line"></div>
                                                                <div class="columns_line left_line"></div>
                                                            </div>
                                                            <span>4 Columns</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="left_box preview_box">
                                        <h5 class="left_box_title">Preview</h5>
                                        <input type="hidden" class="preview_image edit_preview" name="preview_image_screenshoot" id="preview_image_screenshoot">
                                        <div class="preview-section" id="preview-section"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="customize-proposal-inner-right">
                                <div class="proposal-pages" id="proposal-pages"></div>
                            </div>
                            <div class="bottom_btns">
                                <button type="button" class="btn btn-green" id="contract-preview-btn">Preview</button>
                                <button type="submit" class="btn btn-green" >Send Contract</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewModalLabel">Preview Proposal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="preview-modal-body">
                    <!-- Pages will be displayed here -->
                    <div id="preview-section-modal"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas Job_Insurance_offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel"></div>
@endsection

@push('js')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.4.2/mammoth.browser.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#proposalForm").validate({
                rules: {
                    lead_id: {
                        required: true
                    },
                    email_subject: {
                        required: true,
                        minlength: 3
                    }
                },
                messages: {
                    lead_id: {
                        required: "Please select a lead."
                    },
                    email_subject: {
                        required: "Please enter an email subject.",
                        minlength: "Email subject must be at least 3 characters long."
                    }
                },
                errorElement: "label",
                errorPlacement: function (error, element) {
                    error.addClass("invalid-feedback");
                    if (element.hasClass("select_lead")) {
                        // Ensure the select2-container exists before inserting error
                        let select2Container = element.next(".select2-container");
                        if (select2Container.length) {
                            error.insertAfter(select2Container);
                        } else {
                            error.insertAfter(element);
                        }
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function (element) {
                    if ($(element).hasClass("select_lead")) {
                        let select2Selection = $(element).next(".select2-container").find(".select2-selection");
                        if (select2Selection.length) {
                            select2Selection.addClass("is-invalid").removeClass("is-valid");
                        }
                    } else {
                        $(element).addClass("is-invalid").removeClass("is-valid");
                    }
                },
                unhighlight: function (element) {
                    if ($(element).hasClass("select_lead")) {
                        let select2Selection = $(element).next(".select2-container").find(".select2-selection");
                        if (select2Selection.length) {
                            select2Selection.removeClass("is-invalid").addClass("is-valid");
                        }
                    } else {
                        $(element).removeClass("is-invalid").addClass("is-valid");
                    }
                },
                invalidHandler: function (event, validator) {
                    if (validator.numberOfInvalids()) {
                        let firstError = validator.errorList[0].element;
                        let scrollTarget = $(firstError).hasClass("select_lead")
                            ? $(firstError).next(".select2-container")
                            : $(firstError);

                        // Check if scrollTarget exists before scrolling
                        if (scrollTarget.length) {
                            $('html, body').animate({
                                scrollTop: scrollTarget.offset().top - 100
                            }, 500);
                        }
                    }
                },
                submitHandler: function (form) {
                    console.log("Form is valid, submitting...");

                    // Safely get HTML content
                    let htmlContent = $('#proposal-pages').html() || '';
                    $('#description').val(htmlContent);

                    // Ensure proposalStatus is set
                    let $proposalStatus = $("#proposalStatus");
                    if (!$proposalStatus.val()) {
                        $proposalStatus.val("required"); // Default to "required" if not set
                    }

                    form.submit(); // Explicitly submit the form
                }
            });
            let pageCount =  0;
            let imageUrl = '';
            let isBold = false;
            let isItalic = false;
            let isUnderline = false;
            let html = '';
            let selectedTextBox = null;
            let selectedPage = null;
            let debounceTimeout;
            let currentTable = null;
            function createNewPage() {
                $('.preloader').css({'display': 'flex'});
                $('.preloader').css({'opacity': '1'});
                $('body').css('overflow-y','hidden');
                let pageCount = $('.proposal-page').length || 0;
                html = $('#page_template').val();

                pageCount = pageCount === 0 ? 1 : pageCount + 1;
                const newPageId = `proposal-page-${pageCount}`;

                const newPage = $(`
            <div class="proposal-page" id="${newPageId}" style="background: #FFF; box-shadow: 0px 0px 17px 0px rgba(0, 0, 0, 0.06); height: 1115px; max-width: 900px; min-width: 990px; margin: 0 auto 20px; position: relative; overflow: hidden;">
                ${html}
                <div class="proposal-page-row" style="width: 100%; height: calc(100% - 20px ); position: relative"></div>
                <div class="page-number" style="text-align: center; font-weight: bold;">
                    <h5 style="margin: 0px;">${pageCount}</h5>
                </div>
                <button type="button" class="btn green_btn generate_preview" data-page-id="${newPageId}">Generate Preview</button>
            </div>
        `);

                $('#proposal-pages').append(newPage);
                setTimeout(() => {
                    $('#proposal-pages').animate({
                        scrollTop: $('#proposal-pages')[0].scrollHeight
                    }, 500);
                    // generateSinglePreview(newPage, pageCount)// Generate preview
                    $('.preloader').hide();
                    $('body').css('overflow-y', 'auto');
                    $('.preloader').css({'opacity': '0'});
                }, 200);



            }
            $(document).on('click', '.generate_preview', function() {
                const pageId = $(this).data('page-id')
                $('.generate_preview').hide();
                $('.preloader').css({'display': 'flex'});
                $('.preloader').css('opacity','0.5');
                $('body').addClass('preload');

                //         Swal.fire({
        //             title: 'Processing, please wait...',
        //             html: `
        //     <div id="progress-container" style="width: 100%; height: 30px; background-color: #74C911;">
        //         <div id="progress-bar" style="height: 100%; width: 0%; background-color: #74C911;"></div>
        //     </div>
        //     <span id="progress-text">0%</span>
        // `,
        //             didOpen: () => {
        //                 Swal.showLoading();
        //             },
        //             allowOutsideClick: false,
        //             didClose: () => {
        //                 $('#progress-bar').width('0%');
        //                 $('#progress-text').text('0%');
        //             }
        //         });
                generatePreviewForPage(pageId);

            });
            function generatePreviewForPage(pageId) {
                const pageElement = $(`#${pageId}`);
                if (pageElement.length === 0) {
                    console.error("Page not found:", pageId);
                    return;
                }


                html2canvas(pageElement[0], {
                    scale: 0.5,
                    useCORS: true,
                    allowTaint: false
                }).then(canvas => {
                    const imgData = canvas.toDataURL("image/webp");
                    const formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('image', imgData);
                    formData.append('page_index', pageId.replace('proposal-page-', ''));

                    $.ajax({
                        url: "{{ route('upload_proposal_screen_shot') }}",
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.success) {
                                const imgPath = response.imagePath;
                                const imgPathFull = "{{ asset('website') }}/" + response.imagePath;
                                const previewBox = $(`#preview-box-${pageId.replace('proposal-page-', '')}`);

                                if (previewBox.length) {
                                    previewBox.find('img').attr('src', imgPathFull);
                                } else {
                                    const newPreviewBox = `
                            <div class="preview-box preview-${pageId}" id="preview-box-${pageId}">
                                <input type="checkbox" class="page-preview-checkbox" id="preview-${pageId}" data-page-id="${pageId}" checked=""/>
                                <label for="preview-${pageId}">
                                    <img src="${imgPathFull}" style="width: 100%; max-width: 200px; margin-bottom: 10px;">
                                    <h6>Page ${pageId.replace('proposal-page-', '')}</h6>
                                </label>
                                <button type="button" class="remove-page-btn remove-btn" data-page-id="${pageId}">
                                    <i class="fa fa-remove"></i>
                                </button>
                            </div>
                        `;
                                    // $('#preview-section').append(newPreviewBox);
                                    let inserted = false;
                                    $('#preview-section .preview-box').each(function () {
                                        const existingIndex = parseInt($(this).attr('id').replace('preview-box-', ''));
                                        if (pageCount < existingIndex) {
                                            $(this).before(newPreviewBox);
                                            inserted = true;
                                            return false;
                                        }
                                    });

                                    if (!inserted) {
                                        $('#preview-section').append(newPreviewBox);
                                    }

                                    $('#preview_image_screenshoot').val($('#preview-section').html());
                                    const firstImageSrc = $('#preview-section img').first().attr('src');
                                    const cleanedSrc = firstImageSrc.replace(new URL(firstImageSrc).origin + "/", '').replace(/^website\//, '');
                                    $('#screen_shot').val(cleanedSrc);
                                    $('.preloader').hide().css('opacity','0');
                                    $('body').removeClass('preload');

                                }
                            } else {
                                console.error("Image upload failed.");
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error during image upload:", error);
                        }
                    });
                }).catch(error => {
                    console.error("Error generating preview:", error);
                });
            }
            function updateSelectedPagePreview(pageId) {
                clearTimeout(debounceTimeout);
                debounceTimeout = setTimeout(function() {
                    if (pageId) {
                        updatePagePreview(pageId);
                    }
                }, 200);
            }
            function generateSinglePreview(pageElement, pageCount) {
                const originalConsoleLog = console.log;
                console.log = function() {};

                html2canvas(pageElement[0], {
                    scale: 0.5,
                    useCORS: true,
                    allowTaint: false
                }).then(canvas => {
                    const imgData = canvas.toDataURL("image/webp");
                    const formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('image', imgData);
                    formData.append('page_index', pageCount);  // Sending page index

                    $.ajax({
                        url: "{{ route('upload_proposal_screen_shot') }}",
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        xhr: function () {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener('progress', function (e) {
                                if (e.lengthComputable) {
                                    var percent = (e.loaded / e.total) * 100;
                                    $('#progress-bar').width(percent + '%');
                                    $('#progress-text').text(Math.round(percent) + '%');
                                }
                            }, false);
                            return xhr;
                        },
                        success: function (response) {
                            Swal.close();
                            if (response.success) {
                                const imgPath = response.imagePath;
                                // alert(imgPath)
                                // console.log(imgPath);
                                const imgPathFull = "{{ asset('website') }}/" + response.imagePath;

                                const newPreviewBox = `
                        <div class="preview-box preview-${pageCount}" id="preview-box-${pageCount}">
                            <input type="checkbox" class="page-preview-checkbox" id="preview-${pageCount}" data-page-id="proposal-page-${pageCount}" checked=""/>
                            <label for="preview-${pageCount}">
                                <img src="${imgPathFull}" style="width: 100%; max-width: 200px; margin-bottom: 10px;">
                                <h6>Page ${pageCount}</h6>
                            </label>
                            <button type="button" class="remove-page-btn remove-btn" data-page-id="proposal-page-${pageCount}">
                                <i class="fa fa-remove"></i>
                            </button>
                        </div>
                    `;

                                let inserted = false;
                                $('#preview-section .preview-box').each(function () {
                                    const existingIndex = parseInt($(this).attr('id').replace('preview-box-', ''));
                                    if (pageCount < existingIndex) {
                                        $(this).before(newPreviewBox);
                                        inserted = true;
                                        return false;
                                    }
                                });

                                if (!inserted) {
                                    $('#preview-section').append(newPreviewBox);
                                }

                                $('#preview_image_screenshoot').val($('#preview-section').html());
                                const firstImageSrc = $('#preview-section img').first().attr('src');
                                const cleanedSrc = firstImageSrc.replace(new URL(firstImageSrc).origin + "/", '').replace(/^website\//, '');
                                $('#screen_shot').val(cleanedSrc);
                                // alert($('#screen_shot').val())
                                //
                                // console.log($('#screen_shot').val());
                                $('.preloader').hide();
                                $('body').css('overflow-y', 'auto');
                                $('.preloader').css({'opacity': '0'});
                            } else {
                                console.error("Image upload failed.");
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error("An error occurred during the image upload:", error);
                        }
                    });
                }).catch(error => {
                    console.error("Error generating preview:", error);
                });
                console.log = originalConsoleLog;

            }
            function updatePagePreview(pageId) {
                const pageElement = $(`#${pageId}`);

                if (pageElement.length === 0) {
                    console.error("Page not found:", pageId);
                    return;
                }

                html2canvas(pageElement[0], {
                    scale: 0.5,
                    useCORS: true,
                    allowTaint: false
                }).then(canvas => {
                    const imgData = canvas.toDataURL("image/webp");  // Change to WebP
                    const formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('image', imgData);
                    formData.append('page_index', pageId.replace('proposal-page-', ''));

                    $.ajax({
                        url: "{{ route('upload_proposal_screen_shot') }}",
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            if (response.success) {
                                const imgPath = response.imagePath;
                                // alert(imgPath)
                                // console.log(imgPath);
                                const imgPathFull = "{{ asset('website') }}/" + response.imagePath;
                                const previewBox = $(`#preview-box-${pageId.replace('proposal-page-', '')}`);

                                if (previewBox.length) {
                                    previewBox.find('img').attr('src', imgPathFull);
                                } else {
                                    console.error("Preview box not found for:", pageId);
                                }

                                $('#preview_image_screenshoot').val($('#preview-section').html());
                                const firstImageSrc = $('#preview-section img').first().attr('src');
                                const cleanedSrc = firstImageSrc.replace(new URL(firstImageSrc).origin + "/", '').replace(/^website\//, '');
                                $('#screen_shot').val(cleanedSrc);
                            } else {
                                console.error("Image upload failed.");
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error("An error occurred during the image upload:", error);
                        }
                    });
                }).catch(error => {
                    console.error("Error generating preview:", error);
                });

            }
            $(document).on('click', '.remove-page-btn', function () {
                if ($('#preview-section .preview-box').length > 1) {
                    const pageId = $(this).data('page-id');
                    removePage(pageId);

                    $('#preview_image_screenshoot').val($('#preview-section').html());

                    const firstImageSrc = $('#preview-section .preview-box img').first().attr('src') || '';
                    if (firstImageSrc) {
                        const cleanedSrc = firstImageSrc.replace(new URL(firstImageSrc).origin + "/", '').replace(/^website\//, '');
                        $('#screen_shot').val(cleanedSrc);
                    }
                }
            });
            function removePage(pageId) {
                $(`#${pageId}`).remove();
                $(`#editor-${pageId}`).remove();
                $(`.preview-box input[data-page-id="${pageId}"]`).closest('.preview-box').remove();
            }
            // $(document).on('change', '.select_lead', function () {
            //     let lead_id = $(this).val();
            //     $('.job_insurance_for_lead').data('lead-id', lead_id);
            // });
            {{--$(document).on('click', '.job_insurance_for_lead', function (e) {--}}
            {{--    e.preventDefault();--}}
            {{--    var lead_id = $(this).data('lead-id');--}}
            {{--    if (!lead_id) {--}}
            {{--        Swal.fire({ icon: 'error', title: 'Oops...', text: 'Please select a lead first!' });--}}
            {{--        $('#offcanvasExample').offcanvas('hide');--}}
            {{--    }--}}
            {{--    $.ajax({--}}
            {{--        type: 'get',--}}
            {{--        url: "{{ url('photos_for_custom_proposal') }}/" + lead_id,--}}
            {{--        success: function (result) {--}}
            {{--            $('#offcanvasExample').html(result);--}}
            {{--            $('#offcanvasExample').offcanvas('show');--}}
            {{--        }--}}
            {{--    });--}}
            {{--});--}}
            $(document).on('change', '.proposal_sec .customize-proposal .editor-panel .preview-section .page-preview-checkbox', function () {
                const pageId = $(this).data('page-id');
                if ($(this).is(':checked')) {
                    $(this).attr('checked', 'checked');
                    $(`#${pageId}`).show();
                } else {
                    $(this).removeAttr('checked');
                    $(`#${pageId}`).hide();
                }
            });
            $(document).on('change', 'input[name="layout"]', function () {
                if (selectedPage) {
                    const currentPage = $(selectedPage);
                    const pageRow = currentPage.find('.proposal-page-row');

                    pageRow.find('.layout-content').remove();
                    if ($(this).is('#add-blank')) {
                        pageRow.append('<div class="layout-content col-md-12"></div>');
                    } else if ($(this).is('#add-HeaderFooter')) {
                        pageRow.append(`
                <div class="layout-content">
                    <div style="border-bottom: 2px solid #E4E4E4; width: 94%; height: 135px; margin: 0 auto;"></div>
                    <div style="height: calc(100% - 270px);"></div>
                    <div style="border-top: 2px solid #E4E4E4; width: 94%; height: 135px; margin: 0 auto;"></div>
                </div>
            `);
                    } else if ($(this).is('#add-columns-2')) {
                        pageRow.append(`
                <div class="layout-content" style="display: flex; height: 100%;">
                    <div style="width: 50%; height: 100%; border-right: 2px solid #E4E4E4;"></div>
                    <div style="width: 50%; height: 100%;"></div>
                </div>
            `);
                    }else if ($(this).is('#add-columns-4')) {
                        currentPage.find('.proposal-page-row').append(`
                <div style="width: calc(50% - 2px);height: calc(50% - 2px);float: left;border-right: 2px solid #E4E4E4;border-bottom: 2px solid #E4E4E4;"></div>
                <div style="width: 50%;height: calc(50% - 2px);float: left;border-bottom: 2px solid #E4E4E4;"></div>
                <div style="width: calc(50% - 2px);float: left;height: 50%;border-right: 2px solid #E4E4E4;"></div>
                <div style="width: 50%;height: 50%;"></div>
            `);
                    }

                    // updateSelectedPagePreview();
                }
            });
            function initializeDraggableResizable() {
                $('.proposal-page').each(function() {
                    const proposalPage = $(this);

                    function updatePreviewOnInteraction() {
                        // updateSelectedPagePreview();
                    }

                    proposalPage.find('.custom-text-box').draggable({
                        containment: proposalPage,
                        stop: updatePreviewOnInteraction
                    }).resizable({
                        minHeight: 30,
                        minWidth: 30,
                        stop: updatePreviewOnInteraction
                    });

                    proposalPage.find('.image-container').draggable({
                        containment: proposalPage,
                        stop: updatePreviewOnInteraction
                    }).resizable({
                        minHeight: 30,
                        minWidth: 100,
                        stop: updatePreviewOnInteraction
                    });

                    proposalPage.find('.table-container').draggable({
                        containment: proposalPage,
                        stop: updatePreviewOnInteraction
                    }).resizable({
                        minHeight: 50,
                        minWidth: 50,
                        stop: updatePreviewOnInteraction
                    });

                    proposalPage.find('.signature-box').draggable({
                        containment: proposalPage,
                        stop: updatePreviewOnInteraction
                    }).resizable({
                        minHeight: 30,
                        minWidth: 30,
                        stop: updatePreviewOnInteraction
                    });

                    proposalPage.find('.checkbox-container').draggable({
                        containment: proposalPage,
                        stop: updatePreviewOnInteraction
                    }).resizable({
                        minHeight: 30,
                        minWidth: 100,
                        stop: updatePreviewOnInteraction
                    });
                });
            }
            function destroyIfExists(element) {
                if (element.data('ui-draggable')) {
                    element.draggable('destroy');
                }
                if (element.data('ui-resizable')) {
                    element.resizable('destroy');
                }
            }
            $(document).on('click','#back-button', function () {
                $('.theme-selection').show();
                $('.customize-proposal').hide();
                $('#proposal-pages').empty();
                $('#preview-section').empty();
                pageCount = 0;
            });
            $(document).on('click', '#add-page',function () {
                createNewPage();

            });
            $(document).on('click', '.proposal-page', function () {
                if (selectedPage) {
                    $(selectedPage).removeClass('selected_page');
                }
                selectedPage = this;
                $(selectedPage).addClass('selected_page');

            });
            function initDragAndDrop(container) {
                $(container).find('.custom-text-box').draggable({
                    containment: ".proposal-page",
                    stop: function () {  }
                }).resizable({
                    minHeight: 30,
                    minWidth: 100,
                    stop: function () {  }
                });
                $(container).find('.image-container').draggable({
                    containment: ".proposal-page",
                    stop: function () { }
                }).resizable({
                    minHeight: 30,
                    minWidth: 100,
                    stop: function () {   }
                });
            }
            $(document).on('click', '#add-text', function () {
                if (!selectedPage) {
                    console.error("No page selected to add the text box.");
                    return;
                }


                const textBox = $('<div>', {
                    class: 'custom-text-box',
                    contenteditable: 'true',
                    text: 'Enter your text',
                    css: {
                        'font-family': $('#font-family').val(),
                        'font-size': $('#font-size').val() + 'px',
                        'color': $('#text-color-picker').val(),
                        'background': $('#background-color-picker').val(),
                        'position': 'absolute',
                        'top': '20px',
                        'left': '20px',
                        'padding': '5px',
                        'z-index': '2',
                    }
                });

                const removeBtn = $('<button>', {
                    class: 'remove-text-box remove-btn',
                    html: '<i class="fa fa-remove"></i>',
                    type: 'button',
                    css: {
                        'opacity': '0',
                    }
                });

                textBox.append(removeBtn);
                textBox.draggable({ containment: selectedPage ,             stop: function () {  }
                }).resizable({
                    minHeight: 30,
                    minWidth: 30,
                    stop: function () {  }
                });

                $(selectedPage).find('.proposal-page-row').append(textBox);

                // updateSelectedPagePreview();
            });
            $(document).on('click', '#add-variable', function () {
                if (!selectedPage) {
                    console.error("No page selected to add the variable.");
                    return;
                }

                const selectedVariable = $('#variable-selector').val();
                if (!selectedVariable) {
                    alert("Please select a variable.");
                    return;
                }

                const variableBox = $('<div>', {
                    class: 'custom-text-box',
                    text: selectedVariable,
                    css: {
                        'font-family': $('#font-family').val(),
                        'font-size': $('#font-size').val() + 'px',
                        'color': $('#text-color-picker').val(),
                        'background': $('#background-color-picker').val(),
                        'position': 'absolute',
                        'top': '20px',
                        'left': '20px',
                        'padding': '5px',
                        'z-index': '2',
                        'user-select': 'none',         // 🔒 No text selection
                        'cursor': 'move',              // ✋ Drag cursor
                    }
                });

                const removeBtn = $('<button>', {
                    class: 'remove-text-box remove-btn',
                    html: '<i class="fa fa-remove"></i>',
                    type: 'button',
                    css: {
                        'opacity': '0',
                    }
                });

                variableBox.append(removeBtn);
                variableBox.draggable({
                    containment: selectedPage,
                    stop: function () { }
                });

                $(selectedPage).find('.proposal-page-row').append(variableBox);
                // updateSelectedPagePreview();
            });
            $(document).on('change', '#font-family', function () {
                if (selectedTextBox) {
                    $(selectedTextBox).css('font-family', $(this).val());
                    // updateSelectedPagePreview();
                }
            });
            $(document).on('input', '#font-size', function () {
                if (selectedTextBox) {
                    $(selectedTextBox).css('font-size', $(this).val() + 'px');
                    // updateSelectedPagePreview();
                }
            });
            $(document).on('input', '#text-color-picker', function () {
                if (selectedTextBox) {
                    const selectedColor = $(this).val();
                    $(selectedTextBox).find('.custom-label').css('color', selectedColor);
                    $(selectedTextBox).css('color', selectedColor);
                    // updateSelectedPagePreview();
                }
            });
            $(document).on('input', '#background-color-picker', function () {
                if (selectedTextBox) {
                    const selectedBackgroundColor = $(this).val();
                    $(selectedTextBox).css('background', selectedBackgroundColor);
                    // updateSelectedPagePreview();
                }
            });
            $(document).on('input focus', '.custom-text-box', function () {
                const $this = $(this);
                if ($this.find('.remove-btn').length === 0) {
                    const removeBtn = $('<button>', {
                        class: 'remove-text-box remove-btn',
                        html: '<i class="fa fa-remove"></i>',
                        type: 'button',
                        css: { 'opacity': '0' }
                    });
                    $this.append(removeBtn);
                }
                if (!$this.hasClass('ui-resizable')) {
                    $this.resizable({
                        handles: "se" // southeast corner
                    });
                }
            });
            $(document).on('click', '.custom-text-box', function (e) {
                e.stopPropagation();
                if (selectedTextBox) {
                    $(selectedTextBox).css({
                        'border': '2px dashed transparent'
                    });
                }
                selectedTextBox = this;
                $(selectedTextBox).css({
                    'border': '2px dashed #C8C8C8'
                });
            });
            $(document).on('click', function (event) {
                if (!$(event.target).closest('.editor-panel button, .editor-panel input, .editor-panel select').length) {
                    if (selectedTextBox) {
                        $(selectedTextBox).css({
                            'border': '2px dashed transparent'
                        });
                        selectedTextBox = null;
                    }
                }
            });
            $(document).on('click', '#bold-text' ,function () {
                if (selectedTextBox) {
                    // Toggle bold state
                    isBold = !isBold;

                    // Apply bold styling only to the <td> (not affecting any <input> inside)
                    $(selectedTextBox).css('font-weight', isBold ? 'bold' : 'normal');
                    // console.log('Bold applied to:', selectedTextBox); // Log bold application
                    $(this).toggleClass('active', isBold);
                    // updateSelectedPagePreview();
                } else {
                    // console.log('No cell selected'); // Log if no cell is selected
                }
            });
            $(document).on('click', '#italic-text' ,function () {
                if (selectedTextBox) {
                    isItalic = !isItalic;
                    $(selectedTextBox).css('font-style', isItalic ? 'italic' : 'normal');
                    $(this).toggleClass('active', isItalic);
                    // updateSelectedPagePreview();
                }
            });
            $(document).on('click', '#underline-text',function () {
                if (selectedTextBox) {
                    isUnderline = !isUnderline;
                    $(selectedTextBox).css('text-decoration', isUnderline ? 'underline' : 'none');
                    $(this).toggleClass('active', isUnderline);
                    // updateSelectedPagePreview();
                }
            });
            function setAlignment(alignment) {
                if (selectedTextBox) {
                    $(selectedTextBox).css('text-align', alignment);
                    // updateSelectedPagePreview();
                }
            }
            $(document).on('click', '#align-left', function () {
                setAlignment('left');
            });
            $(document).on('click', '#align-center', function () {
                setAlignment('center');
            });
            $(document).on('click', '#align-right', function () {
                setAlignment('right');
            });
            $(document).on('click', '#numbered-list', function () {
                if (selectedTextBox) {
                    const text = $(selectedTextBox).text().trim();
                    $(selectedTextBox).html(`<ol><li>${text}</li></ol>`);
                    $(selectedTextBox).resizable("destroy");
                    $(selectedTextBox).resizable({
                        minHeight: 30,
                        minWidth: 100,
                        containment: ".proposal-page"
                    });
                }
            });
            $(document).on('click', '#bulleted-list', function () {
                if (selectedTextBox) {
                    const text = $(selectedTextBox).text().trim();
                    $(selectedTextBox).html(`<ul><li>${text}</li></ul>`);
                    $(selectedTextBox).resizable("destroy");
                    $(selectedTextBox).resizable({
                        minHeight: 30,
                        minWidth: 100,
                        containment: ".proposal-page"
                    });
                }
            });
            $(document).on('click', '#add-image', function () {
                $('#upload-image').click();
            });
            $(document).on('change', '#upload-image', function () {
                const file = this.files[0];
                if (!file) {
                    console.error("No file selected.");
                    return;
                }
                if (!file.type.startsWith('image/')) {
                    console.error("Selected file is not an image.");
                    return;
                }

                // Show Swal with progress bar
                Swal.fire({
                    title: 'Processing please wait...',
                    html: `
            <div id="progress-container" style="width: 100%; height: 30px; background-color: #74C911;">
                <div id="progress-bar" style="height: 100%; width: 0%; background-color: #74C911;"></div>
            </div>
            <span id="progress-text">0%</span>
        `,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                    allowOutsideClick:false,  // Allow closing when clicking outside
                    didClose: () => {
                        // Reset progress when modal is closed
                        $('#progress-bar').width('0%');
                        $('#progress-text').text('0%');
                    }
                });

                const formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('image', file);

                $.ajax({
                    url: "{{ route('upload_proposal_image') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    xhr: function () {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function (e) {
                            if (e.lengthComputable) {
                                var percent = (e.loaded / e.total) * 100;
                                $('#progress-bar').width(percent + '%');
                                $('#progress-text').text(Math.round(percent) + '%');
                            }
                        }, false);
                        return xhr;
                    },
                    success: function (response) {
                        if (response.success) {
                            const imagePath = response.imagePath;
                            const topPosition = 20;
                            const leftPosition = 20;
                            const uniqueId = `imageUpload_${Date.now()}_${Math.floor(Math.random() * 1000000)}`;
                            const img = new Image();
                            img.onload = function () {
                                const imageWidth = img.width;
                                const imageHeight = img.height;
                                const imageContainer = $(`
                        <div class="image-container" style="width: ${imageWidth}px; height: ${imageHeight}px; position: absolute; top: ${topPosition}px; left: ${leftPosition}px; min-height: 30px; min-width: 100px; background-color: #fff; z-index: 1;">
                            <img src="${imagePath}" style="width:100%; height: 100%; object-fit: cover;" data-image="${imagePath}" alt="Uploaded image"/>
                            <div class="edit_image" style="opacity: 0;">
                                <input type="file" id="${uniqueId}" class="image-url-input" style="width: 85%; display: none;" accept="image/*" aria-label="Upload new image" />
                                <label class="edit-icon" for="${uniqueId}"><i class="fa fa-edit"></i></label>
                            </div>
                            <button class="remove-image-box remove-btn" type="button" aria-label="Remove image" style="opacity: 0;"><i class="fa fa-remove"></i></button>
                        </div>
                    `);
                                imageContainer.draggable({
                                    containment: selectedPage,
                                    stop: function () { }
                                }).resizable({
                                    minHeight: 30,
                                    minWidth: 100,
                                    stop: function () { }
                                });

                                $(selectedPage).append(imageContainer);
                                Swal.close();
                            };
                            img.src = imagePath;
                        } else {
                            console.error("Image upload failed.");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("An error occurred during the image upload:", error);
                    }
                });

                $(this).val(''); // Clear the file input
            });
            $(document).on('change', '.image-url-input', function () {
                const fileInput = this;
                const file = fileInput.files[0];

                if (!file) return;

                if (!file.type.startsWith('image/')) {
                    console.error("Selected file is not an image.");
                    return;
                }

                // Show Swal with progress bar
                Swal.fire({
                    title: 'Processing please wait...',
                    html: `
            <div id="progress-container" style="width: 100%; height: 30px; background-color: #74C911;">
                <div id="progress-bar" style="height: 100%; width: 0%; background-color: #74C911;"></div>
            </div>
            <span id="progress-text">0%</span>
        `,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                    allowOutsideClick: false,
                    didClose: () => {
                        $('#progress-bar').width('0%');
                        $('#progress-text').text('0%');
                    }
                });

                const formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('image', file);

                $.ajax({
                    url: "{{ route('upload_proposal_image') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    xhr: function () {
                        const xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function (e) {
                            if (e.lengthComputable) {
                                const percent = (e.loaded / e.total) * 100;
                                $('#progress-bar').width(percent + '%');
                                $('#progress-text').text(Math.round(percent) + '%');
                            }
                        }, false);
                        return xhr;
                    },
                    success: function (response) {
                        if (response.success) {
                            const imagePath = response.imagePath;

                            // update the preview in the corresponding image container
                            $(fileInput).closest('.image-container').find('img')
                                .attr('src', imagePath)
                                .attr('data-image', imagePath);

                            // updateSelectedPagePreview();
                            Swal.close();
                        } else {
                            console.error("Image upload failed.");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("An error occurred during the image upload:", error);
                    }
                });

                $(fileInput).val(''); // Clear the file input
            });
            $(document).on('click', '#add-table',function () {
                if (!selectedPage) {
                    console.error("No page selected to add the table.");
                    return;
                }

                let numRows = parseInt($('#table-rows').val()) || 0;
                let numCols = parseInt($('#table-cols').val()) || 0;

                // Set maximum limit for rows and columns to 20
                if (numRows < 1 || numRows > 20 || numCols < 1 || numCols > 20) {
                    alert("Please enter a valid number of rows and columns (between 1 and 20).");
                    return;
                }

                // Create the table
                currentTable = $('<table>', {
                    class: 'custom-table',
                    css: {
                        'border-collapse': 'collapse',
                        'width': '100%',
                        'height': '100%',
                        'border': '1px solid #e0e0e0',
                        'background-color': '#fff'
                    }
                });

                // Add initial rows and cells to the table
                for (let i = 0; i < numRows; i++) {
                    const row = $('<tr>');
                    row.css('background-color', i % 2 === 0 ? '#ffffff' : '#e9ecf1');

                    for (let j = 0; j < numCols; j++) {
                        const cell = $('<td>', {
                            text: 'Text',
                            css: {
                                'border': '1px solid #e0e0e0',
                                'padding': '5px',
                                'text-align': 'left',
                                'color': '#000'
                            },
                            tabindex: 0
                        });
                        row.append(cell);
                    }

                    // Add the "Remove" button in the last cell
                    const removeCell = $('<td class="remove_button_td" style="width: 0;height: 0;border: none;">');
                    const removeButton = $('<button>', {
                        class: 'remove-row-btn',
                        html: '<i class="fa fa-minus"></i>', // Font Awesome icon for remove
                        css: {
                            'color': '#ff0000',
                            'cursor': 'pointer',
                            'position': 'absolute', // Absolute positioning
                            'top': '5px',           // Adjust top position
                            'right': '5px',         // Adjust right position
                            'border': 'none',       // Optional: remove default border
                            'background': 'transparent', // Optional: remove background
                            'opacity': 0            // Set opacity to 0 (fully transparent)
                        }
                    });

                    removeCell.append(removeButton); // Append the Remove button to the cell
                    row.append(removeCell); // Append the cell with the Remove button to the row

                    currentTable.append(row); // Add the row to the table
                }

                // Create the remove button for the table
                const removeButton = $('<button>', {
                    class: 'remove-table-btn remove-btn',
                    html: '<i class="fa fa-remove"></i>',
                    type: 'button',
                    css: {
                        'opacity': '0',
                    }
                });

                removeButton.on('click', function () {
                    currentTable.closest('.table-container').remove();
                    currentTable = null;
                });

                // Create "+ Row" button
                const addRowButton = $('<button>', {
                    html: '<i class="fa fa-plus"></i>', // Font Awesome icon for remove
                    type: 'button',
                    class: 'add-row-btn',
                    css: {
                        'margin-top': '10px',
                        'opacity': '0'
                    }
                });

                // Container for the table and buttons
                const tableContainer = $('<div>', {
                    class: 'table-container',
                    css: {
                        'position': 'absolute',
                        'top': '20px',
                        'left': '20px',
                        'width': 'calc(100% - 40px)',
                        'min-width': numCols * 50,
                        'min-height': numRows * 50

                    }
                }).append(removeButton, currentTable, addRowButton);

                $(selectedPage).find('.proposal-page-row').append(tableContainer);

                // Initialize draggable and resizable functionality
                tableContainer.draggable({
                    containment: selectedPage,
                    stop: function () { }

                }).resizable({
                    minHeight: 50,
                    minWidth: 50,
                    stop: function () {  }

                });

                // Set the height of the table container based on the number of rows
                tableContainer.height(numRows * 50); // Set the container height based on the row count
                // updateSelectedPagePreview();

            });
            $(document).on('click', '.remove-row-btn', function () {
                $(this).closest('tr').remove(); // Remove the row on button click
            });
            $(document).on('click', '.add-row-btn', function () {
                const currentTableContainer = $(this).closest('.table-container'); // Find the closest table container
                const currentTable = currentTableContainer.find('table'); // Find the closest table

                const numCols = currentTable.find('tr').first().children('th, td').length - 1; // Count columns excluding the last one
                const rowIndex = currentTable.find('tr').length; // Current row count

                // Check if the number of rows has reached the limit
                if (rowIndex >= 20) {
                    alert("Maximum row limit of 20 reached.");
                    return; // Exit function if limit is reached
                }

                const row = $('<tr>').css('background-color', rowIndex % 2 === 0 ? '#ffffff' : '#e9ecf1');

                // Loop through the number of columns to create cells for the new row
                for (let j = 0; j < numCols; j++) {
                    const cell = $('<td>', {
                        text: 'Text',
                        css: {
                            'border': '1px solid #e0e0e0',
                            'padding': '5px',
                            'text-align': 'left',
                            'color': '#000'
                        },
                        tabindex: 0 // Make cell focusable
                    });
                    row.append(cell); // Append each cell to the row
                }

                // Add the "Remove" button in the last cell
                const removeCell = $('<td class="remove_button_td" style="width: 0;height: 0;border: none;">'); // Create a cell for the Remove button
                const removeButton = $('<button>', {
                    class: 'remove-row-btn',
                    html: '<i class="fa fa-minus"></i>', // Font Awesome icon for remove
                    css: {
                        'color': '#ff0000',
                        'cursor': 'pointer',
                        'position': 'absolute', // Absolute positioning
                        'top': '5px',           // Adjust top position
                        'right': '5px',         // Adjust right position
                        'border': 'none',       // Optional: remove default border
                        'background': 'transparent', // Optional: remove background
                        'opacity': 0            // Set opacity to 0 (fully transparent)
                    }
                });

                removeCell.append(removeButton); // Append the Remove button to the cell
                row.append(removeCell); // Append the cell with the Remove button to the row

                currentTable.append(row); // Append the row to the closest table

                // Set height of the table container, e.g., to 50px more than its current height
                currentTableContainer.height(currentTableContainer.height() + 50); // Increase container height by 50px
                // updateSelectedPagePreview();
            });
            $(document).on('click', '.custom-table tr td:not(.remove_button_td)', function () {
                const targetCell = $(this);

                if (targetCell.find('input').length === 0) {
                    // Reset previous selection's border and font weight if necessary
                    if (selectedTextBox && selectedTextBox !== targetCell[0]) {
                        // console.log("Resetting previous cell", selectedTextBox);
                        $(selectedTextBox).css({
                            'border': 'none',
                            'font-weight': 'normal' // Reset font weight
                        });
                    }

                    // Set the new selected cell and apply border style
                    selectedTextBox = targetCell[0]; // Store the raw DOM element
                    $('.custom-table tr td:not(.remove_button_td)').css('border', '1px solid rgb(224, 224, 224)'); // Highlight the selected cell
                    $(selectedTextBox).css('border', '2px dashed #C8C8C8'); // Highlight the selected cell
                    // console.log('Selected TextBox:', selectedTextBox); // Log the selected cell for debugging
                } else {
                    // console.log("Clicked on an input element inside the td.");

                }



                // Only allow editing if the cell doesn't already contain an input field
                if (targetCell.find('input').length === 0) {
                    const input = $('<input>', {
                        type: 'text',
                        value: targetCell.text(),
                        css: {
                            'width': '100%',
                            'box-sizing': 'border-box',
                            'padding': '5px',
                            'border': 'none',
                            'outline': 'none',
                            'background-color': 'transparent',
                            'font-weight': isBold ? 'bold' : 'normal', // Set font weight based on isBold
                            'font-size': '14px'
                        }
                    });

                    // Add input field and focus it
                    targetCell.empty().append(input);
                    input.focus(); // Automatically focus the input field

                    input.on('blur keydown', function(e) {
                        if (e.type === 'blur' || e.key === 'Enter') {
                            const newValue = $(this).val().trim() || targetCell.text().trim();
                            targetCell.text(newValue);
                            $(targetCell).css('border', '1px solid rgb(224, 224, 224)');
                        } else if (e.key === 'Escape') {
                            targetCell.text(targetCell.text().trim());
                            $(targetCell).css('border', '1px solid rgb(224, 224, 224)');

                        }
                    });


                }
                // updateSelectedPagePreview();
            });
            $(document).on('click', '.proposal-page', function(e) {
                // updateSelectedPagePreview();
            });
            $(document).on('click', '#signatureBox',function () {
                const signatureId = 'signature-' + new Date().getTime();
                // Create the signature box
                const signatureBox = $('<div>', {
                    class: 'signature-box',
                    'data-id': signatureId, // Add the unique data-id
                    css: {
                        'width': 'calc(50% - 40px)',
                        'height': '200px',
                        'border': '2px solid black',
                        'background': '#fff',
                        'position': 'absolute',
                        'top': '20px',
                        'left': '20px',
                        'padding': '5px',
                        // 'overflow': 'hidden',
                        'boxSizing': 'border-box',
                        'z-index': '2',
                    }
                });

                // Create a canvas element for signature drawing
                const canvas = $('<canvas>', {
                    class: 'signature-canvas',
                    css: {
                        'width': '100%',
                        'height': 'calc(100% - 30px)'
                    }
                });

                // Append the canvas to the signature box
                signatureBox.append(canvas);

                // Create the remove button
                const removeBtn = $('<button>', {
                    class: 'remove-signature-box remove-btn',
                    html: '<i class="fa fa-remove"></i>', // Font Awesome icon for remove
                    type: 'button',
                    css: {
                        'opacity': '0',
                    }
                }).on('click', function () {
                    signatureBox.remove(); // Remove the signature box on click
                });

                // Append the remove button to the signature box
                signatureBox.append(removeBtn);

                // Create a save button
                // const saveBtn = $('<button>', {
                //     class: 'save-signature-btn',
                //     text: 'Save Signature',
                //     type: 'button'
                // }).on('click', function () {
                //     const dataURL = canvas[0].toDataURL(); // Get the signature as a data URL
                //     console.log(dataURL); // Log the data URL, can be sent to server
                // });

                // Append the save button to the signature box
                // signatureBox.append(saveBtn);

                // Create the clear button
                const clearBtn = $('<button>', {
                    class: 'clear-signature-btn',
                    text: 'Clear Signature',
                    type: 'button'
                }).on('click', function () {
                    const ctx = canvas[0].getContext('2d');
                    ctx.clearRect(0, 0, canvas[0].width, canvas[0].height); // Clear the canvas
                });

                // Append the clear button to the signature box
                signatureBox.append(clearBtn);

                // Make the signature box draggable and resizable
                signatureBox.draggable({ containment: selectedPage,                    stop: function () {  }}).resizable({
                    minHeight: 30,
                    minWidth: 30,
                    stop: function () { }

                });

                // Append the signature box to the selected page
                $(selectedPage).find('.proposal-page-row').append(signatureBox);

                // Update the page preview
                // updateSelectedPagePreview();
            });
            $(document).on('click','#add-checkbox', function () {
                if (!selectedPage) {
                    console.error("No page selected to add the checkbox.");
                    return;
                }

                const backgroundColor = $('#background-color-picker').val();
                const textColor = $('#text-color-picker').val();

                const checkboxContainer = $('<div>', {
                    class: 'checkbox-container',
                    css: {
                        'position': 'absolute',
                        'top': '20px',
                        'left': '20px',
                        'padding': '5px',
                        'background': backgroundColor,
                        'color': textColor,
                        'z-index': '2',
                    }
                });

                const checkboxId = 'custom-checkbox-' + new Date().getTime();
                const checkbox = $('<input>', {
                    type: 'checkbox',
                    id: checkboxId,
                    class: 'custom-checkbox',
                    css: {
                        'margin': '0px',
                        'width': '20px',
                        'height': '20px'
                    },
                });

                const label = $('<label>', {
                    text: 'Checkbox Label',
                    class: 'custom-label',
                    css: {
                        'margin-left': '5px',
                        'margin-bottom': '0px',
                        'font-size': '20px',
                        'color': textColor // Apply text color to label initially
                    }
                }).on('click', function() {
                    const currentLabel = $(this);
                    const input = $('<input>', {
                        type: 'text',
                        value: currentLabel.text(),
                        css: {
                            'margin': '0px',
                            'color': textColor, // Apply text color to input
                            'font-size': '20px' // Ensure font size matches label
                        }
                    });

                    input.on('blur', function() {
                        currentLabel.text($(this).val()).show();
                        $(this).remove();
                    });
                    input.on('keypress', function(e) {
                        if (e.which === 13) {
                            currentLabel.text($(this).val()).show();
                            $(this).remove();
                        }
                    });

                    currentLabel.hide();
                    $(this).after(input);
                    input.focus();
                });

                const removeBtn = $('<button>', {
                    class: 'remove-checkbox remove-btn',
                    html: '<i class="fa fa-remove"></i>',
                    type: 'button',
                    css: {
                        'opacity': '0',
                    }
                });

                checkboxContainer.append(checkbox, label, removeBtn);
                checkboxContainer.draggable({
                    containment: selectedPage,
                    stop: function () {  }

                }).resizable({
                    minHeight: 30,
                    minWidth: 100,
                    stop: function () {  }
                });

                $(selectedPage).find('.proposal-page-row').append(checkboxContainer);
                // updateSelectedPagePreview();
            });
            $(document).on('click', '.checkbox-container', function (e) {
                e.stopPropagation();
                if (selectedTextBox) {
                    $(selectedTextBox).css({
                        'border': '2px dashed transparent'
                    });
                }
                selectedTextBox = this;
                $(selectedTextBox).css({
                    'border': '2px dashed #C8C8C8'
                });
            });
            $(document).on('click', '.proposal_sec .proposal-pages .remove-btn', function (e) {
                e.stopPropagation(); // Prevent event bubbling
                $(this).parent().remove(); // Remove the signature box containing this button
            });
            $(document).on('click','.Job_Insurance_offcanvas img[data-id]' , function () {
                const imageUrl = $(this).attr('src'); // Get the src attribute of the clicked image
                // console.log("Image source:", imageUrl);
                const topPosition = 20;
                const leftPosition = 20;
                const uniqueId = `imageUpload_${Date.now()}_${Math.floor(Math.random() * 1000000)}`; // Enhanced unique ID

                const imageContainer = $(`
        <div class="image-container" style="position: absolute; top: ${topPosition}px; left: ${leftPosition}px; min-height: 30px; min-width: 100px; background-color: #fff; z-index: 1;">
            <img src="${imageUrl}" style="width: 100%; height: 100%; object-fit: cover;" data-image="${imageUrl}" alt="Selected image"/>
            <div class="edit_image" >
                <input type="file" id="${uniqueId}" class="image-url-input" style="display: none;" accept="image/*" aria-label="Upload new image" />
                <label class="edit-icon" for="${uniqueId}" style="cursor: pointer;"><i class="fa fa-edit"></i></label>
            </div>
            <button class="remove-image-box remove-btn" type="button" aria-label="Remove image" style="opacity: 0; ">
                <i class="fa fa-remove"></i>
            </button>
        </div>
    `);



                // Make the image container draggable and resizable
                imageContainer.draggable({
                    containment: selectedPage,
                    stop: function () {  }

                }).resizable({
                    minHeight: 30,
                    minWidth: 100,
                    stop: function () {  }
                });

                // Append the image container to the selected page
                $(selectedPage).append(imageContainer);
                // updateSelectedPagePreview();

                // Optional cleanup if file input is used
                if (typeof fileInput !== 'undefined') {
                    fileInput.remove();
                }
                $('.Job_Insurance_offcanvas').offcanvas('hide');

            });
            $(document).on('click', '.remove-proposal-box',function(event) {
                event.preventDefault();
                const proposalId = $(this).data('id');
                Swal.fire({
                    title: "Do you want to delete this proposal?",
                    showDenyButton: true,
                    confirmButtonText: "Delete",
                    denyButtonText: `Don't delete`
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('customize_proposals_delete', '') }}/" + proposalId,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire("Deleted!", "The proposal has been deleted.", "success").then(() => {
                                    location.reload();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire("Error!", "There was an error deleting the proposal.", "error");
                            }

                        });
                    } else if (result.isDenied) {
                        Swal.fire("Proposal not deleted", "", "info");
                    }
                });
            });
            $(document).on('keydown', 'form input', function (event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                }
            });
            function createTable() {
                let tableID = "product-table-" + Date.now();

                let tableContainer = $(`
        <div class="product-table-container" style="  border-collapse: collapse; width: 100%;   background-color: #fff;  position: relative;  ">
            <button class="product-remove-table remove-btn " type="button" style=" cursor: pointer;">
                <i class="fa fa-times" ></i>
            </button>
            <table id="${tableID}" class="custom-table" style="width: 100%; border-collapse: collapse;">
                <tbody>
                    <tr class="product-row">
                        <td style="border: 1px solid #e0e0e0; padding: 5px;"><input type="text" class="product-name" placeholder="Product Name" style="width: 100%; border: none; color: #000;"></td>
                        <td style="border: 1px solid #e0e0e0; padding: 5px;"><input type="number" class="qty" value="1" min="1" style="min-width:60px;width: 100%; border: none; color: #000;"></td>
                        <td style="border: 1px solid #e0e0e0; padding: 5px;"><input type="number" class="price" value="1" min="1" step="1" style="min-width:60px;width: 100%;  border: none; color: #000;"></td>
                        <td class="total" style="border: 1px solid #e0e0e0; padding: 5px;">0.00</td>
                        <td style="width: 0;height: 0;border: none;"><button class="product-remove-row" type="button" style="color: rgb(255, 0, 0); cursor: pointer; position: absolute; top: 5px; right: 5px; border: none; background: transparent; opacity: 0;"><i class="fa fa-minus"></i></button></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td style="border: 1px solid #e0e0e0; pointer-events: none;"></td>
                        <td style="border: 1px solid #e0e0e0; pointer-events: none;"></td>
                        <td style="border: 1px solid #e0e0e0; padding: 5px; pointer-events: none;font-size: 22px;font-weight: bold;"><strong>Subtotal:</strong></td>
                        <td colspan="2" class="subtotal" style="border: 1px solid #e0e0e0; padding: 5px; pointer-events: none;font-size: 25px;">0.00</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #e0e0e0; pointer-events: none;"></td>
                        <td style="border: 1px solid #e0e0e0; pointer-events: none;"></td>
                        <td style="border: 1px solid #e0e0e0; padding: 5px;  pointer-events: none; font-size: 22px;font-weight: bold;"><strong>Total:</strong></td>
                        <td colspan="2" class="grand-total" style="border: 1px solid #e0e0e0; padding: 5px;  pointer-events: none;font-size: 25px;">0.00</td>
                    </tr>
                </tfoot>
            </table>
                    <button class="add-product-row-btn" style="margin-top: 10px; opacity: 0;" type="button"><i class="fa fa-plus"></i> </button>
        </div>
    `);

                $(".proposal-page-row").append(tableContainer);
                tableContainer.draggable({ containment: ".proposal-page-row" }).resizable({
                    minWidth: 300,
                    minHeight: tableContainer.find("table").outerHeight(),
                    resize: function(event, ui) {
                        let tableHeight = ui.element.find("table").outerHeight() + 20;
                        ui.element.css("min-height", tableHeight);
                    }
                });

                updateTotals(tableContainer.find("table"));
            }
            function updateTotals(table) {
                let subtotal = 0;
                table.find(".product-row").each(function () {
                    let qty = parseFloat($(this).find(".qty").val()) || 0;
                    let price = parseFloat($(this).find(".price").val()) || 0;
                    let total = qty * price;
                    $(this).find(".total").text(total.toFixed(2));
                    subtotal += total;
                });

                table.find(".subtotal, .grand-total").text(subtotal.toFixed(2));
            }
            $(document).on("click", ".product-remove-table", function () {
                $(this).closest(".product-table-container").remove();
            });
            $(document).on("click", ".add-product-row-btn", function () {
                let table = $(this).siblings("table");
                let rowIndex = table.find("tbody tr").length;

                let backgroundColor = rowIndex % 2 === 0 ? "#ffffff" : "#e9ecf1";

                let newRow = $(`
        <tr class="product-row" style="background-color: ${backgroundColor};">
            <td style="border: 1px solid #e0e0e0; padding: 5px;">
                <input type="text" class="product-name" placeholder="Product Name"
                    style="width: 100%; border: none; color: #000;background-color: ${backgroundColor};">
            </td>
            <td style="border: 1px solid #e0e0e0; padding: 5px;">
                <input type="number" class="qty" value="1" min="1"
                    style="min-width:60px;width: 100%;  border: none; color: #000;background-color: ${backgroundColor};">
            </td>
            <td style="border: 1px solid #e0e0e0; padding: 5px;">
                <input type="number" class="price" value="1" min="1" step="1"
                    style="min-width:60px;width: 100%;  border: none; color: #000;background-color: ${backgroundColor};">
            </td>
            <td class="total" style="border: 1px solid #e0e0e0; padding: 5px;">0.00</td>
            <td style="width: 0;height: 0;border: none;">
                <button class="product-remove-row" type="button"
                    style="color: rgb(255, 0, 0); cursor: pointer; position: absolute; top: 5px; right: 5px; border: none; background: transparent; opacity: 0;">
                    <i class="fa fa-minus"></i>
                </button>
            </td>
        </tr>
    `);

                table.find("tbody").append(newRow);
                updateTotals(table);
            });
            $(document).on("input", ".product-row .qty, .product-row .price", function () {
                let table = $(this).closest("table");
                updateTotals(table);
            });
            $(document).on("click", ".product-remove-row", function () {
                let table = $(this).closest("table");
                if (table.find(".product-row").length > 1) {
                    $(this).closest("tr").remove();
                    updateTotals(table);
                } else {
                    alert("At least one product row must remain!");
                }
            });
            $(document).on("click","#add-product", createTable);

        });
        $(document).ready(function () {
            function loadProposals(lead_id) {
                $.ajax({
                    type: 'get',
                    url: "{{ url('photos_for_custom_proposal') }}/" + lead_id,
                    success: function (result) {
                        $('#offcanvasExample').html(result).offcanvas('show');
                    },
                    error: function () {
                        Swal.fire({ icon: 'error', title: 'Error', text: 'There was an issue retrieving photos.' });
                    }
                });
            }
            function updateTotals(table) {
                let subtotal = 0;
                table.find(".product-row").each(function () {
                    let qty = parseFloat($(this).find(".qty").val()) || 0;
                    let price = parseFloat($(this).find(".price").val()) || 0;
                    let total = qty * price;
                    $(this).find(".total").text(total.toFixed(2));
                    subtotal += total;
                });

                table.find(".subtotal, .grand-total").text(subtotal.toFixed(2));
            }
            $(document).on('change', '.select_lead',function () {
                // const lead_id = $(this).val();
                // $('.job_insurance_for_lead').attr('lead-id', lead_id);
                $(this).valid(); // Trigger validation on change
            });
            // $(document).on('click', '.job_insurance_for_lead', function (e) {
            //     e.preventDefault();
            //     const lead_id = $(this).attr('lead-id');
            //     if (!lead_id) {
            //         Swal.fire({ icon: 'error', title: 'Oops...', text: 'Please select a lead first!' });
            //         $('#offcanvasExample').offcanvas('hide');
            //         return;
            //     }
            //     loadProposals(lead_id);
            // });
            function initializeDraggableResizable() {
                $('.proposal-page').each(function() {
                    const proposalPage = $(this);

                    function updatePreviewOnInteraction() {
                        // updateSelectedPagePreview();
                    }

                    proposalPage.find('.custom-text-box').draggable({
                        containment: proposalPage,
                        stop: updatePreviewOnInteraction
                    }).resizable({
                        minHeight: 30,
                        minWidth: 30,
                        stop: updatePreviewOnInteraction
                    });

                    proposalPage.find('.image-container').draggable({
                        containment: proposalPage,
                        stop: updatePreviewOnInteraction
                    }).resizable({
                        minHeight: 30,
                        minWidth: 100,
                        stop: updatePreviewOnInteraction
                    });

                    proposalPage.find('.table-container').draggable({
                        containment: proposalPage,
                        stop: updatePreviewOnInteraction
                    }).resizable({
                        minHeight: 50,
                        minWidth: 50,
                        stop: updatePreviewOnInteraction
                    });

                    proposalPage.find('.signature-box').draggable({
                        containment: proposalPage,
                        stop: updatePreviewOnInteraction
                    }).resizable({
                        minHeight: 30,
                        minWidth: 30,
                        stop: updatePreviewOnInteraction
                    });

                    proposalPage.find('.checkbox-container').draggable({
                        containment: proposalPage,
                        stop: updatePreviewOnInteraction
                    }).resizable({
                        minHeight: 30,
                        minWidth: 100,
                        stop: updatePreviewOnInteraction
                    });
                });
            }
            $(document).on('click', '.dynamic_proposal_them_box', function () {
                const proposalId = $(this).closest('.proposal-card').data('proposal-id');
                var id = $(this).closest('.proposal-card').data('lead-id');
                $('.preloader').css({'display': 'flex'});
                $('.preloader').css('opacity','1');
                $('body').addClass('preload');

                $.ajax({
                    url: '/customize_proposals_edit/' + proposalId,
                    data: { lead_id: id },
                    type: 'GET',
                    success: function(response) {
                        let updatedDescription = response.description;
                        Object.keys(response.variables).forEach(key => {
                            let placeholder = `%{${key}}%`; // Create the placeholder dynamically
                            let value = response.variables[key]; // Get the corresponding value
                            let regex = new RegExp(placeholder, "g"); // Create a regex for global replacement
                            updatedDescription = updatedDescription.replace(regex, value);
                        });
                        $('#proposal-pages').html(updatedDescription);

                        // $('#proposal-pages').html(response.description);
                        $('.theme-selection').hide();
                        $('.customize-proposal').show();
                        // $('.ui-resizable-handle').remove();
                        // $('.remove-btn , .edit_image').remove();
                        $('#proposal_id').val(response.proposals.id);
                        initializeDraggableResizable();
                        $('#prefered').text('Preferred: ' +  response.variables.roof_prefered_recommended_price || 0);
                        $('#system').text('System: ' +  response.variables.roof_system_recommended_price || 0);
                        $('#under_15_sq').text('Under 15 sq: ' +  response.variables.roof_under_15_sq_recommended_price || 0);
                        $('#gutter').text(`Gutter: ${
                            response.variables.roof_gutter_recommended_price ?
                                `(${response.variables.roof_gutter_recommended_price})` : '(0)'
                        } ${
                            response.variables.roof_gutter_recommended_price2 ?
                                `(${response.variables.roof_gutter_recommended_price2})` : '(0)'
                        }`);
                        $('#flat_roof').text('Flat Roof: ' +  response.variables.roof_flat_area_recommended_price || 0);

                        $('#replacement').text('Replacement: ' +  response.variables.siding_replacement_recommended_price || 0);
                        $('#over_existing').text('Over Existing: ' +  response.variables.siding_over_existing_recommended_price || 0);
                        $('#side_gutter').text(`Gutter: ${
                            response.variables.siding_gutter_recommended_price ?
                                `(${response.variables.siding_gutter_recommended_price})` : '(0)'
                        } ${
                            response.variables.siding_gutter_recommended_price2 ?
                                `(${response.variables.siding_gutter_recommended_price2})` : '(0)'
                        }`);

                        $('#chimney_chimney').text('Chimney: ' +  response.variables.chimney_chimney_recommended_price || 0);
                        $('#chimney_liner').text('Liner: ' +  response.variables.chimney_liner_recommended_price || 0);

                        // $('#description').val(response.description);

                        //$('.selected_page').removeClass();
                        $('.checkbox-container input[type="checkbox"]').prop('disabled', true);
                        $('.preloader').hide().css('opacity','0');
                        $('body').removeClass('preload');

                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
            });
            $(document).on('click', '.signed_proposal_them_box', function () {
                const proposalId = $(this).closest('.proposal-card').attr('data-proposal-id');
                $('.preloader').css({'display': 'flex'});
                $('.preloader').css('opacity','1');
                $('body').addClass('preload');

                $.ajax({
                    url: '/customize_signature_proposals/' + proposalId,
                    type: 'GET',
                    success: function(response) {
                        $('#proposal-pages').html(response.customer_description);
                        $('.theme-selection').hide();
                        $('.customize-proposal').show();
                        // $('.ui-resizable-handle').remove();
                        // $('.remove-btn , .edit_image').remove();
                        $('#proposal_id').val(response.proposals.proposal_template_id);

                        // Parse and handle signature data
                        let signatureData = [];
                        try {
                            signatureData = JSON.parse(response.proposals.signature);
                            console.log("Signature Data Parsed:", signatureData);
                        } catch (error) {
                            console.error("Error parsing signature JSON:", error);
                        }

                        // Initialize signature boxes
                        $('.signature-box').each(function () {
                            let signatureBox = $(this);
                            let signatureId = signatureBox.attr('data-id');

                            let matchedSignature = signatureData.find(sig => sig.id === signatureId);

                            if (matchedSignature) {
                                initializeCanvas(signatureBox, matchedSignature);
                            }
                        });

                        function initializeCanvas(signatureBox, matchedSignature) {
                            const canvas = signatureBox.find('.signature-canvas')[0];
                            if (!canvas || !matchedSignature) return;

                            const ctx = canvas.getContext('2d');
                            canvas.width = canvas.clientWidth;
                            canvas.height = canvas.clientHeight;

                            const signatureImage = "/storage/" + matchedSignature.path;

                            if (signatureImage) {
                                const img = new Image();
                                img.src = signatureImage;
                                img.onload = function () {
                                    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                                };
                            }

                            let isDrawing = false;
                            let lastX = 0;
                            let lastY = 0;

                            function startDrawing(e) {
                                isDrawing = true;
                                [lastX, lastY] = [e.offsetX, e.offsetY];
                            }

                            function stopDrawing() {
                                isDrawing = false;
                            }

                            function draw(e) {
                                if (!isDrawing) return;
                                ctx.strokeStyle = '#000';
                                ctx.lineWidth = 2;
                                ctx.beginPath();
                                ctx.moveTo(lastX, lastY);
                                ctx.lineTo(e.offsetX, e.offsetY);
                                ctx.stroke();
                                [lastX, lastY] = [e.offsetX, e.offsetY];
                            }

                            canvas.addEventListener('mousedown', startDrawing);
                            canvas.addEventListener('mouseup', stopDrawing);
                            canvas.addEventListener('mousemove', draw);
                        }

                        // Disable checkbox container inputs
                        $('.checkbox-container input[type="checkbox"]').prop('disabled', true);
                        $('.preloader').hide().css('opacity','0');
                        $('body').removeClass('preload');

                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
            });
            $(document).on('click', '.draft_proposal_them_box', function () {
                const proposalId = $(this).closest('.proposal-card').attr('data-proposal-draft-id');
                $('.preloader').css({'display': 'flex'});
                $('.preloader').css('opacity','0.5');
                $('body').addClass('preload');


                $.ajax({
                    url: '/user_draft_proposals/' + proposalId,
                    type: 'GET',
                    success: function(response) {
                        $('#proposal-pages').html(response.customer_description);
                        $('.theme-selection').hide();
                        $('.customize-proposal').show();

                        // $('.ui-resizable-handle').remove();
                        // $('.remove-btn , .edit_image').remove();
                        $('#proposal_id').val(response.proposals.proposal_template_id);

                        function initializeCanvas() {
                            const canvas = document.querySelector('.signature-canvas');
                            const ctx = canvas.getContext('2d');
                            canvas.width = canvas.clientWidth;
                            canvas.height = canvas.clientHeight;
                            const signatureImage = "{{ asset('website/customer_proposal_signature') }}/" + response.proposals.signature;

                            if (signatureImage !== "{{ asset('website/customer_proposal_signature') }}/") {
                                const img = new Image();
                                img.src = signatureImage;
                                img.onload = function () {
                                    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);  // Draw the image on the canvas
                                };
                            }

                            let isDrawing = false;
                            let lastX = 0;
                            let lastY = 0;
                            function startDrawing(e) {
                                isDrawing = true;
                                [lastX, lastY] = [e.offsetX, e.offsetY];
                            }

                            function stopDrawing() {
                                isDrawing = false;
                            }

                            function draw(e) {
                                if (!isDrawing) return;
                                ctx.strokeStyle = '#000';
                                ctx.lineWidth = 2;
                                ctx.beginPath();
                                ctx.moveTo(lastX, lastY);
                                ctx.lineTo(e.offsetX, e.offsetY);
                                ctx.stroke();
                                [lastX, lastY] = [e.offsetX, e.offsetY];
                            }

                            canvas.addEventListener('mousedown', startDrawing);
                            canvas.addEventListener('mouseup', stopDrawing);
                            canvas.addEventListener('mousemove', draw);
                        }
                        initializeCanvas();
                        $('.checkbox-container input[type="checkbox"]').prop('disabled', true);
                        $('.preloader').hide().css('opacity','0');
                        $('body').removeClass('preload');

                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
            });
            // $(document).on('click', '.image-container', function () {
            //     var This = $(this);
            //     var lead_id = $('.select_lead').val();
            //
            //     if (!lead_id) {
            //         Swal.fire({ icon: 'error', title: 'Oops...', text: 'Please select a lead first!' });
            //         $('#offcanvasExample').offcanvas('hide');
            //         return;
            //     }
            //
            //     loadProposals(lead_id);
            //     This.addClass('image-container-selected');
            // });
            $(document).on('click', '.Job_Insurance_offcanvas img[data-id]', function () {
                const imageUrl = $(this).attr('src');
                console.log("Image source:", imageUrl);
                $('.image-container-selected').find('img').attr('src', imageUrl);
                $('.Job_Insurance_offcanvas').offcanvas('hide');
                $('.image-container-selected').removeClass('image-container-selected');
            });
            $(document).on('click', '.custom-table td', function () {
                var cell = $(this);
                if (!cell.find('input').length) {
                    var val = cell.text().trim();
                    var isBold = cell.css('font-weight') === '700' || cell.css('font-weight') === 'bold'; // Check if bold
                    var input = $('<input>', {
                        value: val,
                        css: {
                            width: '100%',
                            'box-sizing': 'border-box',
                            padding: '5px',
                            border: 'none',
                            outline: 'none',
                            'background-color': 'transparent',
                            'font-weight': isBold ? 'bold' : 'normal',
                            'font-size': '14px'
                        }
                    });

                    cell.empty().append(input);
                    input.focus().on('blur keydown', function (e) {
                        if (e.type === 'blur' || e.key === 'Enter') {
                            cell.text($(this).val());
                        }
                    });
                }
            });
            $(document).on('click', '.custom-label', function () {
                const currentLabel = $(this);
                console.log('yes')
                const textColor = currentLabel.css('color');
                const input = $('<input>', {
                    type: 'text',
                    value: currentLabel.text().trim(),
                    css: {
                        'margin': '0px',
                        'color': textColor,
                        'font-size': '20px',
                        'width': 'auto',
                        'border': 'none',
                        'outline': 'none',
                        'display': 'inline-block',
                        'background': 'transparent'
                    }
                });
                currentLabel.hide();
                $(currentLabel).after(input);
                input.focus();
                input.on('blur keydown', function (e) {
                    if (e.type === 'blur' || e.key === 'Enter') {
                        const newText = $(this).val().trim() || currentLabel.text().trim();
                        currentLabel.text(newText).show();
                        input.remove();
                    }
                });
            });
            // $(document).on('click', '#save-pdf', function (e) {
            //     e.preventDefault(); // Prevent default action
            //     $("#proposalStatus").val("sent");
            //     // $("#proposalForm").valid(); // Trigger validation
            // });
            $(document).on('click', '.draft_proposal_them_box', function () {
                var proposal_draft = $(this).closest('.proposal-card').attr('data-proposal-draft-id');
                $('#proposal_draft_id').val(proposal_draft);
            });
            $(document).on("click", ".calculators_card_val", function () {
                let cloned = $(this).clone();

                cloned
                    .removeClass('calculators_card_val')
                    .addClass('calculators-draggable-text')
                    .css({
                        position: 'absolute',
                        top: 10,
                        left: 10,
                        zIndex: 1000,
                        fontSize: '20px',
                        color: 'black',
                        background: 'white',
                    });

                $(".selected_page").append(cloned);

                cloned.draggable({
                    containment: ".selected_page",
                    cursor: "move"
                });
            });
        });
        $(document).on('click', '#contract-preview-btn', function() {
            // Get the HTML content from the proposal pages
            var proposalPagesHtml = $('.proposal-pages').html();

            // Clear any previous content in the preview section
            $('#preview-section-modal').empty();

            // Append the proposal pages content to the modal's preview section
            $('#preview-section-modal').html(proposalPagesHtml);

            // Show the modal
            $('#previewModal').modal('show');
        });

    </script>
@endpush
