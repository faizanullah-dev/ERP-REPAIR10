@extends('layouts.master')

@push('css')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"  />

<style>
    ::-webkit-scrollbar-track { border-radius: 10px; background-color: #F3F3F3; }
    ::-webkit-scrollbar { width: 10px; background-color: #F3F3F3; }
    ::-webkit-scrollbar-thumb { border-radius: 10px; background-color: #74C911; }
    h6 { color: #4D4D4D; font-family: 'Rajdhani-Medium'; font-size: 13px; font-weight: 600; }
    .proposal_sec { padding: 10px; color: #000;}
    .proposal_sec .proposal-header { margin-bottom: 30px; }
    .proposal_sec .proposal-header h3 { font-size: 24px; margin-bottom: 30px; }
    .proposal_sec .proposal-options { display: flex; gap: 30px; }
    .proposal_sec .proposal-options .proposal-card { padding: 25px; width: 300px; cursor: pointer; transition: box-shadow 0.3s ease; border-radius: 15px; background: #FFF; box-shadow: 0px 0px 17px 0px rgba(0, 0, 0, 0.06); margin-bottom: 10px; }
    .proposal_sec .proposal-options .proposal-card img { width: 100%; height: auto; border-radius: 10px; margin-bottom: 10px; }
    .proposal_sec .proposal-options .proposal-card .proposal-title { margin: 0px; color: #4D4D4D; font-family: 'Rajdhani-Medium'; font-size: 13px; font-weight: 600; }
    .proposal_sec .proposal-options .proposal-card .proposal_them_box { width: 100%; height: 330px; border: 1px dashed #B4B4B4; background: #FFF; position: relative; margin-bottom: 20px; }

    .proposal_sec .customize-proposal .editor-panel h4 {  margin-bottom: 20px; line-height: 30px; }
    .proposal_sec .customize-proposal .editor-panel .preview-section { overflow-y: auto; height: 300px; display: flex; flex-direction: row; flex-wrap: wrap; row-gap: 20px; column-gap: 20px; align-items: start; }
    .proposal_sec .customize-proposal .editor-panel .preview-section img { height: 100px; object-fit: contain;border-radius: 5px; border: 1px solid #D4D4D4; background: #FFF; padding: 5px; }
    .proposal_sec .btn-add-page { background-color: var(--green_74C911); color: white; padding: 10px 20px; font-size: 15px; border-radius: 5px;  }
    .proposal_sec .bottom_btns{text-align: center;}
    .proposal_sec .btn-add-page i { color: white; }
    .proposal_sec .back-button-container { text-align: right; }
    .proposal_sec .back-button-container  .back-button { background-color: #6DC747; color: white; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease; margin-bottom: 20px; }
    .proposal_sec .back-button-container  .back-button i { font-size: 20px; color: white; }
    .proposal_sec .proposal-pages { width: 100%; height: 1135px; margin: 0 auto; overflow-y: scroll; padding-right: 15px; padding-left: 10px; position: relative; }

    .proposal_sec .left_box { border-radius: 10px; background: #FFF; box-shadow: 0px 0px 17px 0px rgba(0, 0, 0, 0.06);padding: 15px; display: flex; flex-direction: column; row-gap: 20px; margin-bottom: 25px; }
    .proposal_sec .left_box .left_box_title { border-bottom: 1px solid #E4E4E4; padding-bottom: 10px; color: #4D4D4D; font-size: 17px !IMPORTANT; font-style: normal; font-weight: 600; line-height: normal; text-transform: capitalize; margin-bottom: 20px; }

    .proposal_sec .text-widget #add-text { border-radius: 5px; background: #74C911; border-color: #74C911; font-size: 20px; padding: 5px 15px; }
    .proposal_sec  .form-control { border-radius: 5px; border: 1px solid #EEE; background: #FFF; font-size: 20px; padding: 5px 15px; height: unset; }
    .proposal_sec .text-widget #font-size { width: 80px; }
    .proposal_sec .text-widget .font-controls { display: flex; flex-direction: row; column-gap: 10px; margin-bottom: 10px; }
    .proposal_sec .text-widget .text-style-buttons { display: flex; flex-direction: row; flex-wrap: wrap; column-gap: 2%; border-radius: 5px; border: 1px solid #EEE; background: #FFF; padding: 10px; row-gap: 10px; }
    .proposal_sec .text-widget .text-style-buttons .btn { width: 18%; color: #959595; box-shadow: unset;  padding: 5px; }
    .proposal_sec .text-widget .text-style-buttons .btn * { color: #959595; font-size: 20px; line-height: 28px;}
    .proposal_sec .text-widget .text-style-buttons .btn.active * { color: #74C911; }

    .proposal_sec .image_widget .btn { width: 100%; height: 120px; border-radius: 5px; border: 1px dashed #B4B4B4; background: #FFF; display: flex; align-items: center; justify-content: center; }

    .proposal_sec .columns_widget span { color: #4D4D4D; font-size: 11px; font-style: normal; font-weight: 600; line-height: normal; text-transform: capitalize; }
    .proposal_sec .columns_widget .col-md-4 { padding: 0px 5px; }
    .proposal_sec .columns_widget .row { margin: 0px -5px; width: 100%; }
    .proposal_sec .columns_widget .columns_layout_box { position: relative; margin-bottom: 15px; }
    .proposal_sec .columns_widget .columns_layout_box .columns_layout_card { width: 100%; height: 103px; border-radius: 5px; border: 1px solid #EEE; background: #FFF; position: relative; margin-bottom: 10px; padding: 15px; }
    .proposal_sec .columns_widget .columns_layout_box label { width: 100%; margin: 0px; }
    .proposal_sec .columns_widget .columns_layout_box input { position: absolute; left: 0; top: 0; width: 100%; height: 100%; opacity: 0; z-index: 1; cursor: pointer; margin: 0px; }
    .proposal_sec .columns_widget .columns_layout_box input:checked + label .columns_layout_card { border-color: #74C911; }
    .proposal_sec .columns_widget .columns_layout_box input:checked + label span { color: #74C911; }
    .proposal_sec .columns_widget .columns_layout_box .columns_layout_card .columns_line { width: calc(100% - 30px); height: 1px; background-color: #ccc; position: absolute; top: 15px; left: 0; right: 0; margin: 0 auto; }
    .proposal_sec .columns_widget .columns_layout_box .columns_layout_card .footer_line { bottom: 15px; top: unset; }
    .proposal_sec .columns_widget .columns_layout_box input:checked + label .columns_layout_card .columns_line { background-color: #74C911; }
    .proposal_sec .columns_widget .columns_layout_box .columns_layout_card .columns_two { height: calc(100% - 30px); width: 1px; }
    .proposal_sec .columns_widget .columns_layout_box .columns_layout_card .top_line {width: 1px;height: calc(50% - 20px);}
    .proposal_sec .columns_widget .columns_layout_box .columns_layout_card .right_line { width: calc(50% - 20px); top: 50%; left: unset; right: 15px; }
    .proposal_sec .columns_widget .columns_layout_box .columns_layout_card .bottom_line { width: 1px; height: calc(50% - 20px); top: unset; bottom: 15px; }
    .proposal_sec .columns_widget .columns_layout_box .columns_layout_card .left_line { width: calc(50% - 20px); top: 50%; left: 15px; right: unset; }

    .proposal_sec .green_btn  ,  .proposal_sec .green_btn *{color: #fff;}
    .proposal_sec .green_btn:hover {background-color: var(--green_74C911);box-shadow: unset;}

    .proposal_sec .selected_page{border: 2px dashed #74C911;}
    .proposal_sec .remove-btn { border-radius: 50%; background-color: red; color: white; border: none; padding: 5px; position: absolute; right: -10px; top: -10px; width: 20px; height: 20px; line-height: unset; display: flex; align-items: center; justify-content: center; }
    .proposal_sec .remove-btn i { color: white; font-size: 10px; line-height: 1; }
    /*.proposal_sec .custom-text-box { border: 1px dashed transparent; border-radius: 2px; transition: 0.2s ease all; }*/
    /*.proposal_sec .custom-text-box:hover { border: 1px dashed rgb(200, 200, 200); border-radius: 2px; }*/
    /*.proposal_sec .custom-text-box .remove-btn , .proposal_sec  .image-container .remove-btn{ opacity: 0; }*/
    /*.proposal_sec .custom-text-box:hover .remove-btn , .proposal_sec .image-container:hover .remove-btn{ opacity: 1; }*/
    /*.proposal_sec .custom-text-box:hover .ui-resizable-handle.ui-resizable-se , .proposal_sec .image-container:hover .ui-resizable-handle.ui-resizable-se { opacity: 1; }*/
    /*.proposal_sec .custom-text-box .ui-resizable-handle.ui-resizable-se , .proposal_sec .image-container  .ui-resizable-handle.ui-resizable-se{ opacity: 0; border-radius: 5px; background: #74C911; display: inline-flex; padding: 10px; align-items: flex-start; gap: 10px; bottom: -10px; right: -10px; }*/


    .proposal_sec .proposal-pages .ui-draggable .remove-btn { opacity: 0; }
    .proposal_sec .proposal-pages .ui-draggable:hover .remove-btn { opacity: 1; }
    .proposal_sec .proposal-pages .ui-draggable:hover .ui-resizable-handle.ui-resizable-se  { opacity: 1; }
    .proposal_sec .proposal-pages .ui-draggable .ui-resizable-handle.ui-resizable-se { opacity: 0; border-radius: 5px; background: #74C911; display: inline-flex; padding: 10px; align-items: flex-start; gap: 10px; bottom: -10px; right: -10px; }

    .proposal_sec ul { list-style: disc; }
    .proposal_sec .table-panel .table-panel-input {display: flex;align-items: center;column-gap: 10px;margin-bottom: 10px;}
    .proposal_sec .customize-proposal .editor-panel .preview-section .preview-box input {display: none;}
    .proposal_sec .customize-proposal .editor-panel .preview-section .preview-box input:checked + label img {border-color: green;}
    /*.proposal_sec .customize-proposal .left_right_box{display: flex;column-gap: 15px;}*/
    .proposal_sec .text-widget .text-style-buttons input {min-height: 40px;}

</style>
@endpush

@section('content')
<section class="proposal_sec">
    <div class="container-fluid">
        <form action="{{ route('store_customize_proposals') }}" method="post" class="row" id="proposalForm">
            @csrf
            <input type="hidden" id="description" name="description">
            <input type="hidden" name="proposal_id" id="proposal_id">
            <div class="col-md-12">
                <div class="theme-selection">
                    <div class="proposal-header">
                        <h3>Proposals</h3>
                        <h5>Select Proposal Theme</h5>
                    </div>
                    <div class="proposal-options">
                        <div class="proposal-card" id="blank-page">
                            <div class="proposal_them_box default_proposal_them_box"></div>
                            <h6 class="proposal-title">Blank Page</h6>
                        </div>
                        <div class="proposal-card" id="design1">
                            <div class="proposal_them_box default_proposal_them_box">
                                <div style="position: absolute; width: 0; height: 0; border-style: solid;top: 0; left: 0; border-width: 180px 180px 0 0; border-color: #000 transparent transparent transparent;"></div>
                                <div style="position: absolute; width: 0; height: 0; border-style: solid;bottom: 0; right: 0; border-width: 0 0 180px 180px; border-color: transparent transparent #ff6600 transparent;"></div>
                            </div>
                            <h6 class="proposal-title">Design 1</h6>
                        </div>
                        @foreach($proposals as $proposal)
                        <div class="proposal-card" id="">
                            <div class="proposal_them_box dynamic_proposal_them_box" data-proposal-id="{{ $proposal->id }}" data-html="{{ $proposal->description }}">
                                <img src="{{asset('website')}}/{{$proposal->screen_shot}}">
                            </div>
                            <h6 class="proposal-title">{{ $proposal->name??"Not Available" }}</h6>
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
                                    <div class=" filter_inputs_parent">
                                        <label for="Select Category" class="form-label input_labels p-18">Name</label>
                                        <input class="form-control" name="name" placeholder="Proposal name here...">
                                    </div>
                                    <div class=" filter_inputs_parent">
                                        <label for="Select Category" class="form-label input_labels p-18">Select Lead</label>
                                        <select class="form-control clr_input_fields borderRadius select2 select_lead" id="leadFilter" name="lead_id">
                                            <option value="" selected disabled>Select Lead</option>
                                            @foreach($leads as $lead)
                                            <option value="{{$lead->id}}">{{$lead->title??""}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <a class="btn borderRadius view_btn job_insurance_for_lead" lead-id="" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample"><i class="fas fa-house-damage"></i></a>
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
                                            <input class="form-control" type="number" id="table-rows" placeholder="Rows" min="1" value="0">
                                            <input class="form-control" type="number" id="table-cols" placeholder="Cols" min="1" value="0">
                                        </div>
                                        <button type="button" class="btn btn-block green_btn" id="add-table">Add Table</button>
                                    </div>
                                    <div class="signature_box">
                                        <h5 class="left_box_title">Signature & Checkbox</h5>
                                        <button type="button" class="btn green_btn btn-block" id="signatureBox">Add Signature Box</button>
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
                                    <input type="hidden" name="screen_shot" id="screen_shot">
                                    <div class="preview-section" id="preview-section"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="back-button-container">
                                <button type="button" id="back-button" class="back-button"><i class="fa fa-arrow-left"></i></button>
                            </div>
                            <div class="proposal-pages" id="proposal-pages"></div>
                            <div class="bottom_btns">
                                <button type="button" class="btn btn-add-page" id="add-page"><i class="fa fa-plus"></i> Add More Pages</button>
                                <button type="submit" class="btn green_btn" id="save-pdf">Save Proposal</button>
                                <button type="submit" class="btn green_btn" id="send-email">Send Email</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<div class="offcanvas Job_Insurance_offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
</div>
@endsection
@push('js')
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.4.2/mammoth.browser.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    $(document).ready(function () {
        $('.select_lead').on('change', function () {
            let lead_id = $(this).val();
            $('.job_insurance_for_lead').attr('lead-id', lead_id);
        });
        $(document).on('click', '.job_insurance_for_lead', function (e) {
            e.preventDefault();
            var lead_id = $(this).attr('lead-id');
            if (!lead_id) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please select a lead first!',
                });
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
        $('#proposalForm').on('submit', function() {
            var htmlContent = $('#proposal-pages').html();
            $('#description').val(htmlContent);
            updatePagePreview($(selectedPage).attr('id'), $(selectedPage).index());
        });
        let pageCount = 0;
        let imageUrl = '';
        let isBold = false;
        let isItalic = false;
        let isUnderline = false;
        let html = '';
        let selectedTextBox = null;
        let selectedPage = null;
        function createNewPage() {
            const newPageId = `proposal-page-${pageCount}`;
            const newPage = $(`<div class="proposal-page" id="${newPageId}" style="background: #FFF; box-shadow: 0px 0px 17px 0px rgba(0, 0, 0, 0.06); height: 1115px; max-width: 900px; min-width: 990px; margin: 0 auto 20px; position: relative; overflow: hidden;">
            ${html}
            <div class="proposal-page-row" style="width: 100%; height: 100%; position: relative"></div>
        </div>`);
            $('#proposal-pages').append(newPage);
            html2canvas(newPage[0], { scale: 0.1 }).then(function (canvas) {
                const imgData = canvas.toDataURL('image/png');
                const previewImage = $(`<div class="preview-box preview-${pageCount}">
                <input type="checkbox" class="page-preview-checkbox" id="preview-${pageCount}" data-page-id="${newPageId}" checked>
                <label for="preview-${pageCount}"><img src="${imgData}" alt="Page Preview ${pageCount}">
                <h6>Page ${pageCount}</h6><label>
            </div>`);
                $('#preview-section').append(previewImage);
            });
            pageCount++;
        }
        $(document).on('change', '.page-preview-checkbox' , function () {
            const pageId = $(this).data('page-id');
            if ($(this).is(':checked')) {
                $(`#${pageId}`).show();
            } else {
                $(`#${pageId}`).hide();
            }
        });
        function updatePagePreview(pageId, previewIndex) {
            const pageElement = $(`#${pageId}`);
            html2canvas(pageElement[0], { scale: 0.1 }).then(function (canvas) {
                const imgData = canvas.toDataURL('image/png');
                $('#preview-section img').eq(previewIndex).attr('src', imgData);
                $('#screen_shot').val(imgData);
            });
        }
        $(document).on('change', 'input[name="layout"]', function () {
            if (selectedPage) {
                const currentPage = $(selectedPage);
                currentPage.find('.proposal-page-row').empty();
                if ($(this).is('#add-blank')) {
                    currentPage.find('.proposal-page-row').append('<div class="col-md-12"></div>');
                } else if ($(this).is('#add-HeaderFooter')) {
                    currentPage.find('.proposal-page-row').append(`
                <div style="border-bottom: 2px solid #E4E4E4;width: 94%;height:135px; margin: 0 auto;"></div>
                <div style="height: calc(100% - 270px);"></div>
                <div style="border-top: 2px solid #E4E4E4;width: 94%;height:135px ;margin: 0 auto;"></div>
            `);
                } else if ($(this).is('#add-columns-2')) {
                    currentPage.find('.proposal-page-row').append(`
                <div style="width: 50%;height: 100%;border-right: 2px solid #E4E4E4;"></div>
                <div style="width: 50%;height: 100%;"></div>
            `);
                } else if ($(this).is('#add-columns-4')) {
                    currentPage.find('.proposal-page-row').append(`
                <div style="width: calc(50% - 2px);height: calc(50% - 2px);float: left;border-right: 2px solid #E4E4E4;border-bottom: 2px solid #E4E4E4;"></div>
                <div style="width: 50%;height: calc(50% - 2px);float: left;border-bottom: 2px solid #E4E4E4;"></div>
                <div style="width: calc(50% - 2px);float: left;height: 50%;border-right: 2px solid #E4E4E4;"></div>
                <div style="width: 50%;height: 50%;"></div>
            `);
                }
                updatePagePreview(currentPage.attr('id'), currentPage.index());
            } else {
                console.log('No page selected.');
            }
        });

        $('.default_proposal_them_box').on('click', function () {
            html = $(this).html();
            console.log(html)
            $('.theme-selection').hide();
            $('.customize-proposal').show();
            $('#proposal-pages').empty();
            createNewPage();
            $('.proposal-page').first().click();
        });

        $('.dynamic_proposal_them_box').on('click', function () {
            // html = $(this).html();
            html = $(this).data('html');
            console.log(html)
            $('.theme-selection').hide();
            $('.customize-proposal').show();
            $('#proposal-pages').html(html);
            // createNewPage();
            $('.proposal-page').first().click();
            var proposalId= $(this).attr('data-proposal-id');
            $('#proposal_id').val(proposalId);
        });

        $('#back-button').on('click', function () {
            $('.theme-selection').show();
            $('.customize-proposal').hide();
            $('#proposal-pages').empty();
            $('#preview-section').empty();
            pageCount = 0;
        });
        $('#add-page').on('click', function () {
            updatePagePreview($(selectedPage).attr('id'), $(selectedPage).index());
            createNewPage();
        });
        function initDragAndDrop(container) {
            $(container).find('.custom-text-box').draggable({
                containment: ".proposal-page"
            }).resizable({
                minHeight: 30,
                minWidth: 100
            });
            $(container).find('.image-container').draggable({
                containment: ".proposal-page"
            }).resizable({
                minHeight: 30,
                minWidth: 100
            });
        }
        $('#add-text').click(function () {
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
                    'background': '#fff',
                    'position': 'absolute',
                    'top': '20px',
                    'left': '20px',
                    'padding': '5px',
                }
            });
            const removeBtn = $('<button>', {
                class: 'remove-text-box remove-btn',
                html: '<i class="fa fa-remove"></i>',
                type: 'button'
            });
            textBox.append(removeBtn);
            // textBox.draggable({ containment: selectedPage }).resizable({
            //     minHeight: 30,
            //     minWidth: 30
            // });
            $(selectedPage).find('.proposal-page-row').append(textBox);
            updatePagePreview($(selectedPage).attr('id'), $(selectedPage).index());
        });
        $('#font-family').on('change', function () {
            console.log('Selected TextBox:', selectedTextBox);
            if (selectedTextBox) {
                $(selectedTextBox).css('font-family', $(this).val());
                console.log('Font Family Applied:', $(this).val());
            }
            updatePagePreview($(selectedPage).attr('id'), $(selectedPage).index());
        });
        $('#font-size').on('input', function () {
            console.log('Selected TextBox:', selectedTextBox);
            if (selectedTextBox) {
                $(selectedTextBox).css('font-size', $(this).val() + 'px');
                console.log('Font Size Applied:', $(this).val());
            }
            updatePagePreview($(selectedPage).attr('id'), $(selectedPage).index());
        });
        $('#text-color-picker').on('input', function () {
            const selectedColor = $(this).val();
            console.log('Selected TextBox:', selectedTextBox);
            if (selectedTextBox) {
                $(selectedTextBox).css('color', selectedColor);
                console.log('Text Color Applied:', selectedColor);
            }
            updatePagePreview($(selectedPage).attr('id'), $(selectedPage).index());
        });
        $(document).on('click', '.proposal-page', function () {
            if (selectedPage) {
                $(selectedPage).removeClass('selected_page');
            }
            selectedPage = this;
            $(selectedPage).addClass('selected_page');
        });
        $(document).on('click', '.custom-text-box', function (e) {
            e.stopPropagation();
            if (selectedTextBox) {
                $(selectedTextBox).css({
                    'border': '1px dashed transparent'
                });
            }
            selectedTextBox = this;
            console.log('Selected TextBox:', selectedTextBox);
            $(selectedTextBox).css({
                'border': '1px dashed #C8C8C8'
            });
            updatePagePreview($(selectedPage).attr('id'), $(selectedPage).index());
        });
        $(document).on('click', function (event) {
            if (!$(event.target).closest('.editor-panel button, .editor-panel input, .editor-panel select').length) {
                if (selectedTextBox) {
                    $(selectedTextBox).css({
                        'border': '1px dashed transparent'
                    });
                    selectedTextBox = null;
                }
            }
        });
        $('#bold-text').on('click', function () {
            if (selectedTextBox) {
                isBold = !isBold;
                $(selectedTextBox).css('font-weight', isBold ? 'bold' : 'normal');
                $(this).toggleClass('active', isBold);
            }
            updatePagePreview($(selectedPage).attr('id'), $(selectedPage).index());
        });
        $('#italic-text').on('click', function () {
            if (selectedTextBox) {
                isItalic = !isItalic;
                $(selectedTextBox).css('font-style', isItalic ? 'italic' : 'normal');
                $(this).toggleClass('active', isItalic);
            }
            updatePagePreview($(selectedPage).attr('id'), $(selectedPage).index());
        });
        $('#underline-text').on('click', function () {
            if (selectedTextBox) {
                isUnderline = !isUnderline;
                $(selectedTextBox).css('text-decoration', isUnderline ? 'underline' : 'none');
                $(this).toggleClass('active', isUnderline);
            }
            updatePagePreview($(selectedPage).attr('id'), $(selectedPage).index());
        });
        function setAlignment(alignment) {
            if (selectedTextBox) {
                $(selectedTextBox).css('text-align', alignment);
            }
            updatePagePreview($(selectedPage).attr('id'), $(selectedPage).index());
        }
        $('#align-left').click(() => setAlignment('left'));
        $('#align-center').click(() => setAlignment('center'));
        $('#align-right').click(() => setAlignment('right'));
        $('#numbered-list').click(function () {
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
            updatePagePreview($(selectedPage).attr('id'), $(selectedPage).index());
        });
        $('#bulleted-list').click(function () {
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
            updatePagePreview($(selectedPage).attr('id'), $(selectedPage).index());
        });
        $('#add-image').on('click', function () {
            $('#upload-image').click();
        });
        $('#upload-image').on('change', function () {
            const file = this.files[0];
            const reader = new FileReader();
            if (!file) {
                console.error("No file selected.");
                return;
            }
            if (!file.type.startsWith('image/')) {
                console.error("Selected file is not an image.");
                return;
            }
            reader.onload = function (e) {
                const imageUrl = e.target.result;
                if (!selectedPage) {
                    console.error("No page selected to append the image.");
                    return;
                }
                const topPosition = 20;
                const leftPosition = 20;
                const imageContainer = $(`
            <div class="image-container" style="position: absolute; top: ${topPosition}px; left: ${leftPosition}px; min-height: 30px; min-width: 100px; background-color: #fff;">
                <img src="${imageUrl}" style="width: 100%; height: 100%; object-fit: cover;" />
            </div>
        `);
                const removeBtn = $('<button>', {
                    class: 'remove-image-box remove-btn',
                    html: '<i class="fa fa-remove"></i>',
                    type: 'button'
                });
                imageContainer.append(removeBtn);
                // imageContainer.draggable({
                //     containment: selectedPage
                // }).resizable({
                //     minHeight: 30,
                //     minWidth: 100
                // });
                $(selectedPage).append(imageContainer);
                updatePagePreview($(selectedPage).attr('id'), $(selectedPage).index());
            };
            reader.onerror = function (error) {
                console.error("Error reading file: ", error);
            };
            reader.readAsDataURL(file);
            $(this).val('');
        });
        $('#word-file-input').on('change', function (event) {
            var file = event.target.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function (event) {
                    var arrayBuffer = reader.result;
                    mammoth.convertToHtml({ arrayBuffer: arrayBuffer })
                        .then(function (result) {
                            var htmlContent = result.value;
                            var pages = htmlContent.split('<div style="page-break-after: always;"></div>'); // Adjust this if needed
                            pages.forEach(function (pageHtml, index) {
                                var editableContent = $('<div>', {
                                    class: 'editable-word-content',
                                    contenteditable: 'true',
                                    html: pageHtml,
                                });
                                // Make sure images are responsive
                                editableContent.find('img').css({
                                    maxWidth: '100%', // Ensure images don't exceed the width of the container
                                    height: 'auto' // Maintain aspect ratio
                                });
                                editableContent.css({
                                    position: 'absolute',
                                    top: index * 100 + 'px', // Stack pages vertically
                                    left: '0px',
                                    width: '100%',
                                    zIndex: 1000,
                                    backgroundColor: '#fff',
                                    padding: '10px',
                                });
                                editableContent.draggable({
                                    containment: 'parent',
                                }).resizable({
                                    handles: 'n, e, s, w, ne, nw, se, sw',
                                    resize: function(event, ui) {
                                        // Resize images on container resize
                                        $(this).find('img').css({
                                            maxWidth: '100%', // Ensure images adapt to new width
                                            height: 'auto' // Maintain aspect ratio
                                        });
                                    }
                                });
                                console.log("Selected Page:", selectedPage);
                                if (selectedPage) {
                                    $(selectedPage).append(editableContent);
                                    // Measure height
                                    var contentHeight = editableContent.outerHeight();
                                    console.log("Height of the editable content:", contentHeight + "px");

                                    // Update page preview (if applicable)
                                    updatePagePreview($(selectedPage).attr('id'), $(selectedPage).index());
                                } else {
                                    console.log("No valid selectedPage found.");
                                }
                            });
                        })
                        .catch(function (err) {
                            console.log("Error parsing Word document: ", err);
                        });
                };
                reader.readAsArrayBuffer(file);
            }
        });
        $('#add-table').on('click', function () {
            if (!selectedPage) {
                console.error("No page selected to add the table.");
                return;
            }

            const numRows = parseInt($('#table-rows').val());
            const numCols = parseInt($('#table-cols').val());

            if (numRows < 1 || numCols < 1) {
                console.error("Invalid number of rows or columns.");
                return;
            }
            const table = $('<table>', {
                class: 'custom-table',
                css: {
                    'border-collapse': 'collapse',
                    'width': '100%',
                    'height': '100%',
                    'border': '1px solid #e0e0e0',
                    'background-color': '#fff'
                }
            });
            for (let i = 0; i < numRows; i++) {
                const row = $('<tr>');
                if (i % 2 === 0) {
                    row.css('background-color', '#f9f9f9');
                } else {
                    row.css('background-color', '#e0e0e0');
                }
                for (let j = 0; j < numCols; j++) {
                    const cell = $('<td>', {
                        text: 'Text',
                        css: {
                            'border': '1px solid #e0e0e0',
                            'padding': '5px',
                            'text-align': 'center',
                            'color': '#000'
                        },
                        contenteditable: 'true',
                        tabindex: 0
                    });
                    cell.on('click', function() {
                        console.log('Cell clicked');
                        $(this).focus();
                    });
                    row.append(cell);
                }
                table.append(row);
            }
            const removeButton = $('<button>', {
                class: 'remove-table-btn remove-btn',
                html: '<i class="fa fa-remove"></i>',
                type: 'button'
            });
            removeButton.on('click', function () {
                tableContainer.remove();
            });
            const tableContainer = $('<div>', {
                class: 'table-container',
                css: {
                    'position': 'absolute',
                    'top': '20px',
                    'left': '20px',
                    'width': 'auto',
                    'min-width': 'calc(100% - 40px)',
                }
            });
            tableContainer.append(removeButton);
            tableContainer.append(table);
            const selectedPageWidth = $(selectedPage).width();
            // tableContainer.draggable({
            //     containment: selectedPage
            // }).resizable({
            //     minHeight: 100,
            //     minWidth: 200,
            //     maxWidth: selectedPageWidth
            // });
            $(selectedPage).find('.proposal-page-row').append(tableContainer);
            updatePagePreview($(selectedPage).attr('id'), $(selectedPage).index());
        });
        $('#signatureBox').on('click', function () {
            const signatureBox = $('<div>', {
                class: 'signature-box',
                // contenteditable: 'true',
                // text: 'Enter your text',
                css: {
                    'width': 'calc(50% - 40px)',
                    'height': '200px',
                    'border': '2px solid black',
                    'background': '#fff',
                    'position': 'absolute',
                    'top': '20px',
                    'left': '20px',
                    'padding': '5px',
                }
            });
            const removeBtn = $('<button>', {
                class: 'remove-signature-box remove-btn',
                html: '<i class="fa fa-remove"></i>',
                type: 'button'
            });
            signatureBox.append(removeBtn);
            // signatureBox.draggable({ containment: selectedPage }).resizable({
            //     minHeight: 30,
            //     minWidth: 30
            // });
            $(selectedPage).find('.proposal-page-row').append(signatureBox);
            updatePagePreview($(selectedPage).attr('id'), $(selectedPage).index());
        });
        $('#add-checkbox').on('click', function () {
            if (!selectedPage) {
                console.error("No page selected to add the checkbox.");
                return;
            }
            const checkboxContainer = $('<div>', {
                class: 'checkbox-container',
                css: {
                    'position': 'absolute',
                    'top': '20px',
                    'left': '20px',
                    'padding': '5px',
                    'background':'#fff'
                }
            });
            const checkboxId = 'custom-checkbox-' + new Date().getTime();
            const checkbox = $('<input>', {
                type: 'checkbox',
                id: checkboxId,
                class: 'custom-checkbox',
                css: {
                    'margin': '0px',
                    'width':'20px',
                    'height':'20px'
                },
            });
            const label = $('<label>', {
                text: 'Checkbox Label',
                css: {
                    'margin-left': '5px',
                    'margin-bottom':'0px',
                    'font-size':'20px'
                },
                class: 'custom-label'
            }).on('click', function() {
                const currentLabel = $(this);
                const input = $('<input>', {
                    type: 'text',
                    value: currentLabel.text(),
                    css: {
                        'margin': '0px'
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
                type: 'button'
            });
            checkboxContainer.append(checkbox).append(label).append(removeBtn);
            // checkboxContainer.draggable({
            //     containment: selectedPage
            // }).resizable({
            //     minHeight: 30,
            //     minWidth: 100
            // });

            $(selectedPage).find('.proposal-page-row').append(checkboxContainer);
            updatePagePreview($(selectedPage).attr('id'), $(selectedPage).index());
        });
        // $('#save-pdf').on('click', function () {
        //     const element = document.getElementById('proposal-pages');
        //     const options = {
        //         margin: 0,
        //         filename: 'proposal.pdf',
        //         jsPDF: { unit: 'px', format: [900, 1115], orientation: 'portrait' }
        //     };
        //
        //     html2pdf().set(options).from(element).save();
        // });
        // $('#save-pdf').on('click', function () {
        //     const element = document.getElementById('proposal-pages');
        //
        //     // Set the scale to improve quality in the PDF
        //     html2canvas(element, { scale: 2 }).then(function (canvas) {
        //         const imgData = canvas.toDataURL('image/png'); // Get the canvas image data
        //
        //         // Create a new jsPDF instance
        //         const { jsPDF } = window.jspdf;
        //         const pdf = new jsPDF({
        //             orientation: 'portrait',
        //             unit: 'px',
        //             format: [900, 1115] // Custom size
        //         });
        //
        //         // Add the image to the PDF
        //         pdf.addImage(imgData, 'PNG', 0, 0, 900, 1115); // Adjust width and height accordingly
        //
        //         // Save the PDF
        //         pdf.save('proposal.pdf');
        //     });
        // });
        $(document).on('click', '.remove-btn', function (event) {
            event.preventDefault();  // Prevents any default behavior, such as form submission.
            $(this).parent().remove();  // Removes the closest element with class 'signature-box'.
        });
        // For dynamically created textBox
        function makeElementDraggableAndResizable(element, options = {}) {
            element.draggable({
                containment: options.containment || 'parent'
            }).resizable({
                minHeight: options.minHeight || 30,
                minWidth: options.minWidth || 30,
                maxWidth: options.maxWidth || null
            });
        }

        $(document).on('DOMNodeInserted', '.custom-text-box', function () {
            makeElementDraggableAndResizable($(this), { containment: selectedPage });
        });

        // For dynamically created imageContainer
        $(document).on('DOMNodeInserted', '.image-container', function () {
            makeElementDraggableAndResizable($(this), { containment: selectedPage, minWidth: 100 });
        });

        // For dynamically created checkboxContainer
        $(document).on('DOMNodeInserted', '.checkbox-container', function () {
            makeElementDraggableAndResizable($(this), { containment: selectedPage, minWidth: 100 });
        });

    // For dynamically created signatureBox
        $(document).on('DOMNodeInserted', '.signature-box', function () {
            makeElementDraggableAndResizable($(this), { containment: selectedPage });
        });

        // For dynamically created tableContainer
        $(document).on('DOMNodeInserted', '.table-container', function () {
            makeElementDraggableAndResizable($(this), {
                containment: selectedPage,
                minHeight: 100,
                minWidth: 200,
                maxWidth: selectedPageWidth
            });
        });
    });
</script>
@endpush