@extends('layouts.master')

@push('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush

@section('content')
    <section class="proposal_sec">
        <div class="container-fluid">
            <form action="{{ route('store_customize_proposals') }}" method="post" class="row" id="proposalForm">
                @csrf
                <input type="hidden" id="description" name="description">
                <input type="hidden" name="proposal_id" id="proposal_id">
                <input type="hidden" name="page_template" id="page_template">
                <input type="hidden" name="screen_shot"  class="edit_screenshot" id="screen_shot">
                <div class="col-md-12">
                    <div class="theme-selection">
                        <div class="proposal-header">
                            <h3>{{$proposalTypeName->type}}</h3>
                            <h5>Select {{$proposalTypeName->type}} Theme</h5>
                        </div>
                        <div class="proposal-options">
                            <div class="proposal-card" id="blank-page">
                                <div class="proposal_them_box default_proposal_them_box"></div>
                                <h6 class="proposal-title">Blank Page</h6>
                            </div>
                            <div class="proposal-card" id="design1">
                                <div class="proposal_them_box default_proposal_them_box">
                                    <div style="position: absolute; width: 0; height: 0; border-style: solid;top: 0; left: 0; border-width: 140px 140px 0 0; border-color: #000 transparent transparent transparent;"></div>
                                    <div style="position: absolute; width: 0; height: 0; border-style: solid;bottom: 0; right: 0; border-width: 0 0 140px 140px; border-color: transparent transparent #ff6600 transparent;"></div>
                                </div>
                                <h6 class="proposal-title">Design 1</h6>
                            </div>
                        </div>
                        <div class="proposal-header">
                            <h5>Select {{$proposalTypeName->type}} Template</h5>
                        </div>
                        <div class="proposal-options proposal-template-options">
                            @foreach($proposals as $proposal)
                                <div class="proposal-card" id="proposal-{{ $proposal->id }}" data-proposal-id="{{ $proposal->id ?? '' }}" data-order-index="{{ $proposal->order_index ?? '' }}">
                                    <div class="proposal_them_box">
                                        <div class="proposal_them_img_box">
                                            @if($proposal->screen_shot)
                                                <img src="{{asset('website')}}/{{ $proposal->screen_shot ?? '' }}" loading="lazy" alt="Proposal Screenshot">
                                            @endif
                                        </div>
                                    </div>
                                    <h6 class="proposal-title">{{ $proposal->name ?? 'Not Available' }}</h6>
                                    <div class="proposal_box_btns">
                                        <button type="button" class="btn remove-proposal-box" data-id="{{ $proposal->id }}" aria-label="Remove">
                                            <i class="fa fa-remove"></i>
                                        </button>
                                        <button class="btn edit-proposal-box dynamic_proposal_them_box" type="button" aria-label="Edit" ><i class="fa-solid fa-pen"></i></button>
                                        <button type="button" class="btn duplicate-proposal-box"  aria-label="Duplicate">
                                            <i class="fa fa-copy"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="customize-proposal" style="display: none;">
                        <div class="row">
                            <div class="col-md-3 ">
                                <div class="editor-panel">
                                    <h4>Customize Proposals</h4>
                                    <div>
                                        <div class="form-group">
                                            <label class="form-label">Select Proposal Type</label>
                                            <select class="form-control   normal_select_disable" id="" name="proposal_type">
                                                @foreach ($proposalTypes as $proposalType)
                                                    <option value="{{ $proposalType->id }}" {{ $proposalType->id == $id ? 'selected' : '' }}>
                                                        {{ $proposalType->type ?? $proposalType->title ?? $proposalType->id }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label  class="form-label">Name</label>
                                            <input class="form-control proposals_name" name="name" placeholder="Proposal name here..." required>
                                        </div>

                                        <div class="form-group">
                                            <label  class="form-label">Select Lead</label>
                                            <select class="form-control select2 select_lead" id="leadFilter" name="lead_id">
                                                <option value="" selected disabled>Select Lead</option>
                                                @foreach($leads as $lead)
                                                    <option value="{{$lead->id}}">{{$lead->title??""}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <a class="btn green_btn  job_insurance_for_lead" data-lead-id="" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample"><i class="fas fa-house-damage"></i></a>
                                        </div>
                                    </div>
                                    <div class="left_box widget_box">
                                        <div class="text-widget">
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
                                            <div class="form-group">
                                                <label  class="form-label">Select Color</label>
                                                <input type="color" class="form-control" id="text-color-picker" value="#000000">
                                            </div>
                                            <div class="form-group">
                                                <label  class="form-label">Select Background Color</label>
                                                <input type="color" class="form-control"  id="background-color-picker" value="#ffffff">
                                            </div>
                                            <div class="text-style-buttons">
                                                <button type="button" id="bold-text" class="btn"><strong>B</strong></button>
                                                <button type="button" id="italic-text" class="btn"><em>I</em></button>
                                                <button type="button" id="underline-text" class="btn"><u>U</u></button>
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
                                                <select class="form-control select2" id="variable-selector">
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
                            <div class="col-md-9">
                                <div class="back-button-container">
                                    <button type="button" id="back-button" class="btn btn-success pull-right back-button"><i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</button>
                                </div>

                                <div class="proposal-pages" id="proposal-pages"></div>
                                <div class="bottom_btns">
                                    <button type="button" class="btn green_btn btn-add-page" id="add-page"><i class="fa fa-plus"></i> Add More Pages</button>
                                    <button type="submit" class="btn green_btn" id="save-pdf">Save Proposal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <div class="offcanvas Job_Insurance_offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel"></div>
@endsection

@push('js')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        $(document).ready(function () {
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
            let cursor = null;
            let cursorX = 50;
            let cursorY = 50;
            function initElementSortable(container) {
                $(container).sortable({
                    items: '.custom-text-box, .image-container, .table-container, .signature-box, .checkbox-container , .product-table-container',
                    placeholder: 'sortable-placeholder',
                    cursor: 'move',
                    opacity: 0.8,
                    tolerance: 'pointer',
                    distance: 5,
                    start: function (event, ui) {
                        ui.placeholder.height(ui.item.height());
                        ui.item.addClass('sortable-element');
                        if (ui.item.hasClass('custom-text-box')) {
                            ui.item.attr('contenteditable', 'false');
                        }
                    },
                    stop: function (event, ui) {
                        ui.item.removeClass('sortable-element');
                        if (ui.item.hasClass('custom-text-box')) {
                            ui.item.attr('contenteditable', 'true');
                            if (ui.item[0] === selectedTextBox) {
                                ui.item.focus();
                            }
                        }
                    }
                });
            }
            $(document).on('click','.default_proposal_them_box', function () {

                html = $(this).html();
                // console.log("HTML Content:", html);
                $('.theme-selection').hide();
                $('.customize-proposal').show();
                $('#proposal-pages').empty();

                $('.proposal-page').first().click();
                $('#proposal_id').val('');
                $('#description').val('');
                $('.proposals_name').val('');
                $('#page_template').val(html);
                createNewPage();
                // console.log("HTML Content:", html);
                setTimeout(() => {
                    $('.proposal-page').first().click();
                    initElementSortable('#proposal-pages .proposal-page.selected_page');
                }, 300);


            });
            $(document).on('click', '.dynamic_proposal_them_box',function () {
                const proposalId = $(this).closest('.proposal-card').data('proposal-id');
                $('.preloader').show();
                $('.preloader').css({'opacity': '1'});
                $('body').css('overflow-y', 'hidden');
                $.ajax({
                    url: "{{ url('customize_proposals_edit') }}/" + proposalId,

                    type: 'GET',
                    success: function(response) {
                        // console.log(response);
                        $('#proposal_id').val(response.proposals.id);
                        $('.proposals_name').val(response.proposals.name);
                        $('#proposal-pages').html(response.description);
                        $('#preview-section').html(response.proposals.preview_image_screenshoot);
                        $('.edit_preview').val(response.proposals.preview_image_screenshoot);
                        $('#page_template').val(response.proposals.page_template);
                        $('.edit_screenshot').val(response.proposals.screen_shot);
                        $('.theme-selection').hide();
                        $('.customize-proposal').show();
                        $('#proposal-pages .proposal-page').removeClass('selected_page');
                        $('#proposal-pages .proposal-page').first().addClass('selected_page').click();
                        $('#proposal-pages').find('.image-container, .custom-text-box, .table-container, .signature-box, .checkbox-container').each(function() {
                            destroyIfExists($(this));
                        });
                        $('#proposal-pages').find('.ui-resizable-handle').remove()
                        initializeDraggableResizable();
                        $('.preloader').hide();
                        $('body').css('overflow-y', 'auto');
                        $('.preloader').css({'opacity': '0'});
                        $('#proposal-pages .proposal-page').each(function(index) {
                            if (!$(this).find('.generate_preview').length) {
                                const newPageId = $(this).data('page-id'); // Assuming each page has a page id
                                $(this).append(`<button type="button" class="btn green_btn generate_preview" data-page-id="${newPageId}">Generate Preview</button>`);
                            }
                        });
                        $('#proposal-pages .proposal-page').each(function () {
                            initElementSortable(this);
                        });

                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
            });
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
            <div class="proposal-page-row" style="width: 100%; height: calc(100% - 20px ); position: relative;padding: 140px 20px 20px;"></div>
            <div class="page-number" style="text-align: center; font-weight: bold;">
                <h5 style="margin: 0px;">${pageCount}</h5>
            </div>
            <button type="button" class="btn green_btn generate_preview" data-page-id="${newPageId}">Generate Preview</button>
        </div>
    `);

                const signaturePage = $('.signature-page'); // Change this selector to correctly target your signature page
                if (signaturePage.length) {
                    signaturePage.before(newPage);

                } else {
                    $('#proposal-pages').append(newPage);
                }

                const $newRow = newPage.find('.proposal-page-row');
                if ($newRow.length) {
                    initElementSortable($newRow); // Initialize sortable on new page's row
                } else {
                    console.error('No .proposal-page-row found in the new page.');
                }

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
                const pageId = $(this).data('page-id');
                console.log(pageId);
                $('.preloader').css({'display': 'flex'});
                $('.preloader').css({'opacity': '1'});
                $('body').css('overflow-y','hidden');


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
                //             // didClose: () => {
                //             //     $('#progress-bar').width('0%');
                //             //     $('#progress-text').text('0%');
                //             // }
                //         });

                generatePreviewForPage(pageId);
            });
            function generatePreviewForPage(pageId) {
                $('.generate_preview').hide();
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
                        // xhr: function () {
                        //     var xhr = new window.XMLHttpRequest();
                        //     xhr.upload.addEventListener('progress', function (e) {
                        //         if (e.lengthComputable) {
                        //             var percent = (e.loaded / e.total) * 100;
                        //             $('#progress-bar').width(percent + '%');
                        //             $('#progress-text').text(Math.round(percent) + '%');
                        //             if (percent === 100) {
                        //                 Swal.close();
                        //                 $('.generate_preview').show();
                        //             }
                        //         }
                        //     }, false);
                        //     return xhr;
                        // },
                        success: function(response) {
                            if (response.success) {
                                const imgPath = response.imagePath;
                                const imgPathFull = "{{ asset('website') }}/" + response.imagePath;
                                const pageIndex = parseInt(pageId.replace('proposal-page-', ''), 10);

                                // Check for existing preview box with either ID format
                                let previewBox = $(`#preview-box-${pageIndex}`);
                                if (previewBox.length === 0) {
                                    previewBox = $(`#preview-box-proposal-page-${pageIndex}`);
                                }

                                if (previewBox.length) {
                                    // Update existing preview box image
                                    previewBox.find('img').attr('src', imgPathFull);
                                } else {
                                    // Create a new preview box
                                    const newPreviewBox = `
                            <div class="preview-box preview-${pageId}" id="preview-box-${pageIndex}">
                                <input type="checkbox" class="page-preview-checkbox" id="preview-${pageIndex}" data-page-id="${pageId}" checked="">
                                <label for="preview-${pageIndex}">
                                    <img src="${imgPathFull}"  loading="lazy"  alt=""  style="width: 100%; max-width: 200px; margin-bottom: 10px;">
                                    <h6>Page ${pageIndex}</h6>
                                </label>
                                <button type="button" class="remove-page-btn remove-btn" data-page-id="${pageId}">
                                    <i class="fa fa-remove"></i>
                                </button>
                            </div>
                        `;

                                    let inserted = false;
                                    $('#preview-section .preview-box').each(function () {
                                        // Parse the index from the preview box ID, handling both formats
                                        let existingIndex = parseInt($(this).attr('id').replace('preview-box-', ''), 10);
                                        if (isNaN(existingIndex)) {
                                            existingIndex = parseInt($(this).attr('id').replace('preview-box-proposal-page-', ''), 10);
                                        }
                                        if (pageIndex < existingIndex) {
                                            $(this).before(newPreviewBox);
                                            inserted = true;
                                            return false; // Break the loop
                                        }
                                    });

                                    if (!inserted) {
                                        $('#preview-section').append(newPreviewBox);
                                    }
                                }

                                // Update hidden input fields
                                $('#preview_image_screenshoot').val($('#preview-section').html());
                                const firstImageSrc = $('#preview-section img').first().attr('src');
                                const cleanedSrc = firstImageSrc.replace(new URL(firstImageSrc).origin + "/", '').replace(/^website\//, '');
                                $('#screen_shot').val(cleanedSrc);
                                $('.preloader').hide();
                                $('body').css('overflow-y', 'auto');
                                $('.preloader').css({'opacity': '0'});
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
            $(document).on('change', '.select_lead', function () {
                let lead_id = $(this).val();
                $('.job_insurance_for_lead').data('lead-id', lead_id);
            });
            $(document).on('click', '.job_insurance_for_lead', function (e) {
                e.preventDefault();
                var lead_id = $(this).data('lead-id');
                if (!lead_id) {
                    Swal.fire({ icon: 'error', title: 'Oops...', text: 'Please select a lead first!' });
                    $('#offcanvasExample').offcanvas('hide');
                }
                $.ajax({
                    type: 'get',
                    url: "{{ url('photos_for_custom_proposal') }}/" + lead_id,
                    success: function (result) {
                        $('#offcanvasExample').html(result);
                        $('#offcanvasExample').offcanvas('show');
                    }
                });
            });
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

                    proposalPage.find('.custom-text-box').resizable({
                        minHeight: 30,
                        minWidth: 30,
                        stop: updatePreviewOnInteraction
                    });

                    proposalPage.find('.image-container').resizable({
                        minHeight: 30,
                        minWidth: 100,
                        stop: updatePreviewOnInteraction
                    });

                    proposalPage.find('.table-container').resizable({
                        minHeight: 50,
                        minWidth: 50,
                        stop: updatePreviewOnInteraction
                    });

                    proposalPage.find('.signature-box').resizable({
                        minHeight: 30,
                        minWidth: 30,
                        stop: updatePreviewOnInteraction
                    });

                    proposalPage.find('.checkbox-container').resizable({
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
            $(document).on('click', '.proposal-page', function (e) {
                // Prevent triggering when clicking on existing elements
                if ($(e.target).hasClass('custom-text-box') ||
                    $(e.target).closest('.custom-text-box, .image-container, .table-container, .checkbox-container').length > 0) {
                    return;
                }

                // Set selected page
                if (selectedPage) {
                    $(selectedPage).removeClass('selected_page');
                }
                selectedPage = this;
                $(selectedPage).addClass('selected_page');

                // Get click position relative to page
                const pageRect = this.getBoundingClientRect();
                const clickX = e.clientX - pageRect.left;
                const clickY = e.clientY - pageRect.top;

                // Position cursor at click location
                // positionCursor(clickX, clickY, selectedPage);

                // Add visual feedback
                $(selectedPage).addClass('page-focused');

            });
            function showCursorIndicator(x, y) {
                // Remove existing indicator
                $('.cursor-indicator').remove();

                // Create new indicator
                const indicator = $('<div>', {
                    class: 'cursor-indicator',
                    css: {
                        'position': 'absolute',
                        'top': y + 'px',
                        'left': x + 'px',
                        'width': '3px',
                        'height': '30px',
                        'background': '#74c911',
                        'z-index': '1000',
                        'animation': 'blink 1s infinite',
                        'pointer-events': 'none'
                    }
                });

                $(selectedPage).append(indicator);

                // Remove after 2 seconds
                setTimeout(() => {
                    indicator.fadeOut(500, function() {
                        $(this).remove();
                    });
                }, 2000);
            }
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

                if (!cursor) {
                    console.warn("Cursor not defined.");
                }

                const textBox = $('<div>', {
                    class: 'custom-text-box',
                    contenteditable: 'true',
                    text: 'Enter your text',
                    css: {
                        'font-family': $('#font-family').val() || 'Arial',
                        'font-size': ($('#font-size').val() || '16') + 'px',
                        'color': $('#text-color-picker').val() || '#000000',
                        'background': $('#background-color-picker').val() || '#ffffff',
                        'padding': '5px',
                        'z-index': '2',
                        'width': 'calc(100% - 20px)',
                        'max-width': 'calc(100% - 20px)',
                        'position': 'relative',
                        'min-height': '30px',
                        'cursor': 'text',
                        'white-space': 'pre-wrap',
                        'overflow-wrap': 'break-word',
                        // 'margin-bottom': '25px',
                        'margin': '30px 0px',

                    }
                });

                const removeBtn = $('<button>', {
                    class: 'remove-text-box remove-btn',
                    html: '<i class="fa fa-remove"></i>',
                    type: 'button',
                    css: {
                        'opacity': '0',
                        'position': 'absolute',
                        'top': '5px',
                        'right': '5px'
                    }
                });

                textBox.append(removeBtn);

                const $row = $(selectedPage).find('.proposal-page-row');
                if ($row.length) {
                    $row.append(textBox);
                } else {
                    console.error('No .proposal-page-row found in selectedPage.');
                    return;
                }

                $('.text-cursor').hide();
                setTimeout(() => {
                    textBox.focus();
                    const range = document.createRange();
                    const selection = window.getSelection();
                    range.selectNodeContents(textBox[0]);
                    selection.removeAllRanges();
                    selection.addRange(range);
                }, 100);

                // textBox.resizable({
                //     handles: 'e',
                //     minHeight: 30,
                //     resize: function (event, ui) {
                //         ui.size.height = ui.originalSize.height;
                //     }
                // });
                textBox.resizable({
                    minHeight: 30,
                    minWidth: 100,
                    stop: function () { }
                });

                cursorY += 50;
            });
            $(document).on('input focus', '.custom-text-box', function () {
                const $this = $(this);

                if ($this.find('.remove-btn').length === 0) {
                    const removeBtn = $('<button>', {
                        class: 'remove-text-box remove-btn',
                        html: '<i class="fa fa-remove"></i>',
                        type: 'button',
                        css: {
                            'opacity': '0',
                            'position': 'absolute',
                            'top': '5px',
                            'right': '5px'
                        }
                    });
                    $this.append(removeBtn);
                }

                if (!$this.hasClass('ui-resizable')) {
                    $this.resizable({
                        handles: 'e',
                        minHeight: 30,
                        resize: function (event, ui) {
                            ui.size.height = ui.originalSize.height;
                        }
                    });
                }
            });


            // Prevent sortable from interfering with text editing
            // $(document).on('mousedown', '.custom-text-box', function (e) {
            //     if (!$(e.target).is('.remove-btn, .ui-resizable-handle')) {
            //         e.stopPropagation();
            //     }
            // });
            $(document).on('keydown', '.custom-text-box', function (e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    document.execCommand('insertLineBreak');
                }
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
                        // 'position': 'absolute',
                        // 'top': cursorY + 'px',
                        // 'left': cursorX + 'px',
                        'padding': '5px',
                        'z-index': '2',
                        'user-select': 'none',         // 🔒 No text selection
                        'cursor': 'move',              // ✋ Drag cursor
                        'margin': '30px 0px',
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
                // variableBox.draggable({
                //     containment: selectedPage,
                //     stop: function () { }
                // });
                $('.text-cursor').hide();

                $(selectedPage).find('.proposal-page-row').append(variableBox);
                // updateSelectedPagePreview();
                cursorY += 50;

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
            // $(document).on('input focus', '.custom-text-box', function () {
            //     const $this = $(this);
            //
            //     if ($this.find('.remove-btn').length === 0) {
            //         const removeBtn = $('<button>', {
            //             class: 'remove-text-box remove-btn',
            //             html: '<i class="fa fa-remove"></i>',
            //             type: 'button',
            //             css: {
            //                 'opacity': '0',
            //                 'position': 'absolute',
            //                 'top': '5px',
            //                 'right': '5px'
            //             }
            //         });
            //         $this.append(removeBtn);
            //     }
            //
            //     if (!$this.hasClass('ui-resizable')) {
            //         $this.resizable({
            //             handles: 'e',
            //             minHeight: 30,
            //             resize: function (event, ui) {
            //                 ui.size.height = ui.originalSize.height;
            //             }
            //         });
            //     }
            // });
            $(document).on('click', '.custom-text-box', function (e) {
                e.stopPropagation();

                // Update border for previously selected text box
                if (selectedTextBox) {
                    $(selectedTextBox).css('border', '2px dashed transparent');
                }
                selectedTextBox = this;
                $(selectedTextBox).css('border', '2px dashed #C8C8C8');

                // Focus the element
                $(this).focus();

                // Skip if clicking on button or resizable handle
                if (e.target.classList.contains('remove-text-box') || e.target.classList.contains('ui-resizable-handle') || $(e.target).parents('.remove-text-box, .ui-resizable-handle').length) {
                    return;
                }

                // Place cursor at click position
                const selection = window.getSelection();
                selection.removeAllRanges();
                const range = document.createRange();

                // Try to get the exact caret position from click
                if (document.caretRangeFromPoint) { // Supported in most modern browsers
                    const caretRange = document.caretRangeFromPoint(e.clientX, e.clientY);
                    if (caretRange) {
                        range.setStart(caretRange.startContainer, caretRange.startOffset);
                        range.collapse(true);
                        selection.addRange(range);
                        return;
                    }
                }

                // Fallback: Place cursor at the end of the first text node or div
                let targetNode = null;
                let offset = 0;
                const textNodes = Array.from(this.childNodes).filter(node => node.nodeType === Node.TEXT_NODE);
                if (textNodes.length > 0) {
                    targetNode = textNodes[0]; // Use first text node
                    offset = targetNode.length; // Place at end
                } else {
                    targetNode = this; // Fallback to div
                    offset = 0;
                }

                range.setStart(targetNode, offset);
                range.collapse(true);
                selection.addRange(range);
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
                            const topPosition = cursorX;
                            const leftPosition = cursorY;
                            const uniqueId = `imageUpload_${Date.now()}_${Math.floor(Math.random() * 1000000)}`;
                            const img = new Image();
                            img.onload = function () {
                                const imageWidth = img.width;
                                const imageHeight = img.height;
                                const imageContainer = $(`
                        <div class="image-container" style="width: ${imageWidth}px; height: ${imageHeight}px;min-height: 30px; min-width: 100px; background-color: #fff; z-index: 1;margin: 30px 0px;">
                            <img src="${imagePath}"  loading="lazy"  style="width:100%; height: 100%; object-fit: cover;" data-image="${imagePath}" alt="Uploaded image"/>
                            <div class="edit_image" style="opacity: 0;">
                                <input type="file" id="${uniqueId}" class="image-url-input" style="width: 85%; display: none;" accept="image/*" aria-label="Upload new image" />
                                <label class="edit-icon" for="${uniqueId}"><i class="fa fa-edit"></i></label>
                            </div>
                            <button class="remove-image-box remove-btn" type="button" aria-label="Remove image" style="opacity: 0;"><i class="fa fa-remove"></i></button>
                        </div>
                    `);
                                imageContainer.resizable({
                                    minHeight: 30,
                                    minWidth: 100,
                                    stop: function () { }
                                });

                                $(selectedPage).find('.proposal-page-row').append(imageContainer);
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
                        // 'position': 'absolute',
                        // 'top': cursorY + 'px',
                        // 'left': cursorX + 'px',
                        'width': 'calc(100% - 40px)',
                        'min-width': numCols * 50,
                        'min-height': numRows * 50,
                        'margin': '30px 0px',


                    }
                }).append(removeButton, currentTable, addRowButton);

                $(selectedPage).find('.proposal-page-row').append(tableContainer);

                // Initialize draggable and resizable functionality
                tableContainer.resizable({
                    minHeight: 50,
                    minWidth: 50,
                    stop: function () {  }

                });
                $('.text-cursor').hide();

                // Set the height of the table container based on the number of rows
                tableContainer.height(numRows * 50); // Set the container height based on the row count
                // updateSelectedPagePreview();
                cursorY += 50;

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
                        'top': cursorY + 'px',
                        'left': cursorX + 'px',
                        'padding': '5px',
                        // 'overflow': 'hidden',
                        'boxSizing': 'border-box',
                        'z-index': '2',
                        'margin': '30px 0px',
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
                signatureBox.resizable({
                    minHeight: 30,
                    minWidth: 30,
                    stop: function () { }

                });

                // Append the signature box to the selected page
                $(selectedPage).find('.proposal-page-row').append(signatureBox);
                $('.text-cursor').hide();

                // Update the page preview
                // updateSelectedPagePreview();
                cursorY += 50;

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
                        // 'position': 'absolute',
                        // 'top': cursorY + 'px',
                        // 'left': cursorX + 'px',
                        'padding': '5px',
                        'background': backgroundColor,
                        'color': textColor,
                        'z-index': '2',
                        'margin': '30px 0px',
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
                checkboxContainer.resizable({
                    minHeight: 30,
                    minWidth: 100,
                    stop: function () {  }
                });
                $('.text-cursor').hide();


                $(selectedPage).find('.proposal-page-row').append(checkboxContainer);
                // updateSelectedPagePreview();
                cursorY += 50;

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
            <img src="${imageUrl}"  loading="lazy"  style="width: 100%; height: 100%; object-fit: cover;" data-image="${imageUrl}" alt="Selected image"/>
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
                // imageContainer.draggable({
                //     containment: selectedPage,
                //     stop: function () {  }
                //
                // }).resizable({
                //     minHeight: 30,
                //     minWidth: 100,
                //     stop: function () {  }
                // });

                // Append the image container to the selected page
                $(selectedPage).find('.proposal-page-row').append(imageContainer);
                // updateSelectedPagePreview();

                // Optional cleanup if file input is used
                if (typeof fileInput !== 'undefined') {
                    fileInput.remove();
                }
                $('.Job_Insurance_offcanvas').offcanvas('hide');

            });
            $(document).on('click', '#save-pdf', function(event) {
                $('.preloader').css({'display': 'flex'});
                $('.preloader').css({'opacity': '1'});
                $('body').css('overflow-y','hidden');


                // event.preventDefault(); // Prevent form submission
                if ($('.signature-page').length === 0) {
                    console.log('yes');
                    const signatureId = 'signature-' + new Date().getTime();
                    const signatureBox = $('<div>', {
                        class: 'signature-box',
                        'data-id': signatureId,
                        css: {
                            'width': 'calc(50% - 40px)',
                            'height': '200px',
                            'border': '2px solid black',
                            'background': '#fff',
                            'position': 'absolute',
                            'top': '20px',
                            'left': '0',
                            'right': '0',
                            'padding': '5px',
                            'boxSizing': 'border-box',
                            'z-index': '2',
                            'margin': '30px auto',

                        }
                    });
                    const canvas = $('<canvas>', {
                        class: 'signature-canvas',
                        css: {
                            'width': '100%',
                            'height': 'calc(100% - 30px)'
                        }
                    });
                    signatureBox.append(canvas);
                    const clearBtn = $('<button>', {
                        class: 'clear-signature-btn',
                        text: 'Clear Signature',
                        type: 'button'
                    }).on('click', function () {
                        const ctx = canvas[0].getContext('2d');
                        ctx.clearRect(0, 0, canvas[0].width, canvas[0].height); // Clear the canvas
                    });
                    signatureBox.append(clearBtn);
                    const signaturePage = $(`
            <div class="signature-page" style="background: #FFF; box-shadow: 0px 0px 17px 0px rgba(0, 0, 0, 0.06); height: 1115px; max-width: 900px; min-width: 990px; margin: 20px auto 20px; position: relative; overflow: hidden;">
                ${html}
                <div class="signature-section" style="position: absolute; top: 40%; width: 100%; text-align: center;">
                    <h3 for="signature">Signature</h3>
                    ${signatureBox.prop('outerHTML')}
                </div>
            </div>
        `);


                    $('#proposal-pages').append(signaturePage);
                }
                var htmlContent = $('#proposal-pages').html();
                $('#description').val(htmlContent);
                // $('#proposalForm').off('submit').submit();
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
        <div class="product-table-container" style="  border-collapse: collapse; width: 100%;   background-color: #fff;  position: relative; margin: 30px 0px;"  >
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

                // tableContainer.css({
                //     top: cursorY + 'px',
                //     left: cursorX + 'px'
                // });
                // $(".proposal-page-row").append(tableContainer);
                $(selectedPage).find('.proposal-page-row').append(tableContainer);

                tableContainer.resizable({
                    minWidth: 300,
                    minHeight: tableContainer.find("table").outerHeight(),
                    resize: function(event, ui) {
                        let tableHeight = ui.element.find("table").outerHeight() + 20
                        ;
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
            $('.select_variable_initialize').select2({
                placeholder: "-- Select Variable --",
                allowClear: true,
                width: '100%',
            });
        });
        $(document).ready(function () {
            $(".proposal-template-options").sortable({
                items: ".proposal-card",
                cursor: "move",
                update: function(event, ui) {
                    const newOrder = $(this).sortable("toArray", { attribute: 'data-proposal-id' });
                    console.log(newOrder);
                    $.ajax({
                        url: "{{ route('update_proposal_order', ['id' => $id]) }}",
                        method: "POST",
                        data: {
                            order: newOrder,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            console.log("Order updated successfully", response);
                        },
                        error: function(xhr, status, error) {
                            console.error("Error updating order:", error);
                        }
                    });
                }
            });
            $(".proposal-template-options .proposal-card").each(function() {
                $(this).css({
                    cursor: "move"
                });
            });
        });
        $(document).on('click', '.duplicate-proposal-box', function(event) {
            event.preventDefault();
            const proposalId = $(this).closest('.proposal-card').data('proposal-id');

            Swal.fire({
                title: "Do you want to duplicate this proposal?",
                showDenyButton: true,
                confirmButtonText: "Duplicate",
                denyButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('.preloader').css({'display': 'flex', 'opacity': '1'});
                    $('body').css('overflow-y', 'hidden');
                    $.ajax({
                        url: "{{ url('customize_proposals_duplicate') }}/" + proposalId,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                const newProposal = response.proposal;
                                const newProposalCard = `
                            <div class="proposal-card" id="proposal-${newProposal.id}" data-proposal-id="${newProposal.id}" data-order-index="${newProposal.order_index}">
                                <div class="proposal_them_box">
                                    <div class="proposal_them_img_box">
                                        ${newProposal.screen_shot ? `<img src="{{ asset('website') }}/${newProposal.screen_shot}"  loading="lazy"  alt="Proposal Screenshot">` : ''}
                                    </div>
                                </div>
                                <h6 class="proposal-title">${newProposal.name || 'Not Available'}</h6>
                                <div class="proposal_box_btns">
                                    <button type="button" class="btn remove-proposal-box" data-id="${newProposal.id}" aria-label="Remove">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                    <button class="btn edit-proposal-box dynamic_proposal_them_box" type="button" aria-label="Edit">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button type="button" class="btn duplicate-proposal-box" data-id="${newProposal.id}" aria-label="Duplicate">
                                        <i class="fa fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                        `;
                                $('.proposal-template-options').append(newProposalCard);
                                $(".proposal-template-options").sortable("refresh");
                                $('.proposal-template-options .proposal-card').css({ cursor: "move" });
                                Swal.fire("Duplicated!", "The proposal has been duplicated.", "success");
                                $('.preloader').hide();
                                $('body').css('overflow-y', 'auto');
                                $('.preloader').css({'opacity': '0'});
                            } else {
                                Swal.fire("Error!", response.message || "Failed to duplicate the proposal.", "error");
                            }
                        },
                        error: function(xhr) {
                            const message = xhr.responseJSON?.message || "There was an error duplicating the proposal.";
                            Swal.fire("Error!", message, "error");
                            $('.preloader').hide();
                            $('body').css('overflow-y', 'auto');
                            $('.preloader').css({'opacity': '0'});
                        }
                    });
                } else if (result.isDenied) {
                    Swal.fire("Proposal not duplicated", "", "info");
                }
            });
        });
        $(window).on('load', function() {
            $('.top_navbar .sidebar-toggle .sidebartoggler').click();

        });
        // function goFullScreen() {
        //     const elem = document.documentElement;
        //     if (elem.requestFullscreen) {
        //         elem.requestFullscreen().then(() => {
        //             document.getElementById('fullscreenPrompt').style.display = 'none';
        //         }).catch(err => {
        //             console.error(`Failed to enter full-screen: ${err.message}`);
        //         });
        //     } else if (elem.mozRequestFullScreen) { // Firefox
        //         elem.mozRequestFullScreen().catch(err => {
        //             console.error(`Failed to enter full-screen: ${err.message}`);
        //         });
        //     } else if (elem.webkitRequestFullscreen) { // Chrome, Safari, Opera
        //         elem.webkitRequestFullscreen().catch(err => {
        //             console.error(`Failed to enter full-screen: ${err.message}`);
        //         });
        //     } else if (elem.msRequestFullscreen) { // IE/Edge
        //         elem.msRequestFullscreen().catch(err => {
        //             console.error(`Failed to enter full-screen: ${err.message}`);
        //         });
        //     }
        // }

        // Optional: Try auto-triggering after a short delay (may still fail in some browsers)
        // window.onload = function() {
        //     setTimeout(() => {
        //         try {
        //             goFullScreen();
        //         } catch (err) {
        //             console.error(`Auto full-screen failed: ${err.message}`);
        //         }
        //     }, 1000); // Delay to see if it helps (usually won't)
        // };
        $(document).ready(function () {
            $('.normal_select_disable').each(function () {
                var selectElement = $(this);

                // When the select element is loaded, perform the same logic
                var selectedOption = selectElement.find('option:selected');
                var selectedOptionVal = selectedOption.val();
                var inputName = selectElement.attr('name');

                // Create the hidden input with the selected value
                var input = $('<input>').attr('type', 'hidden')
                    .attr('name', inputName)
                    .val(selectedOptionVal);

                // Disable the select element by removing its name and preventing interactions
                selectElement.removeAttr('name');
                selectElement.css('pointer-events', 'none');

                // Append the hidden input after the select element
                selectElement.after(input);
            });
        });
    </script>
@endpush

