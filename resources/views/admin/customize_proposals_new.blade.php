@extends('layouts.master')

@push('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/dashboard/proposal.css')}}">
@endpush

@section('content')
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <section class="proposal_sec">
        <div class="container-fluid">
            <form action="{{ route('store_customize_proposals') }}" method="post" class="row" id="proposalForm">
                @csrf
                <input type="hidden" id="description" name="description">
                <input type="hidden" name="proposal_id" id="proposal_id" value="">
                <input type="hidden" name="page_template" id="page_template">
                <input type="hidden" name="screen_shot" class="edit_screenshot" id="screen_shot">
                <div class="col-md-12">
                    <div class="theme-selection animate__animated animate__fadeIn">
                        <div class="proposal-header">
                            <div class="proposal-header-heading">
                                <h3><i class="fas fa-file-alt"></i> {{ $proposalTypeName->type }} Designer</h3>
                                <div class="back-button-container">
                                    <a href="{{ url('proposal_generator') }}" class="btn secondary_btn back-button" data-tooltip="Return to Proposal Generator">
                                        <i class="fas fa-arrow-left" aria-hidden="true"></i> Back
                                    </a>
                                </div>
                            </div>
                            <h5><i class="fas fa-palette"></i> Select {{ $proposalTypeName->type }} Theme</h5>
                        </div>
                        <div class="proposal-options">
                            <div class="proposal-card default_proposal_them_box" id="blank-page" data-tooltip="Start with a clean slate">
                                <div class="proposal_them_box">
                                </div>
                                <h6 class="proposal-title"><i class="fas fa-file-blank"></i> Blank Page</h6>
                            </div>
                            <div class="proposal-card default_proposal_them_box" id="design1" data-tooltip="Professional design with geometric elements">
                                <div class="proposal_them_box">
                                    <div style="position: absolute; width: 0; height: 0; border-style: solid; top: 0; left: 0; border-width: 140px 140px 0 0; border-color: #000 transparent transparent transparent;"></div>
                                    <div style="position: absolute; width: 0; height: 0; border-style: solid; bottom: 0; right: 0; border-width: 0 0 140px 140px; border-color: transparent transparent #ff6600 transparent;"></div>
                                </div>
                                <h6 class="proposal-title"><i class="fas fa-shapes"></i> Professional Design</h6>
                            </div>
                        </div>
                        <div class="proposal-header">
                            <h5><i class="fas fa-layer-group"></i> Select {{ $proposalTypeName->type }} Template</h5>
                        </div>
                        <div class="proposal-options proposal-template-options" data-id="{{$id}}">
                            @forelse($proposals as $proposal)
                                <div class="proposal-card animate__animated animate__fadeInUp" id="proposal-{{ $proposal->id }}" data-proposal-id="{{ $proposal->id ?? '' }}" data-order-index="{{ $proposal->order_index ?? '' }}" data-tooltip="Click to customize this template">
                                    <div class="proposal_them_box">
                                        <div class="proposal_them_img_box">
                                            @if($proposal->screen_shot)
                                                <img src="{{ asset('website') }}/{{ $proposal->screen_shot ?? '' }}" loading="lazy" alt="Proposal Screenshot">
                                            @else
                                                <div class="no-preview">
                                                    <i class="fas fa-image" style="font-size: 48px; color: #ccc;"></i>
                                                    <p>No Preview Available</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <h6 class="proposal-title">
                                        <i class="fas fa-file-contract"></i>
                                        {{ $proposal->name ?? 'Untitled Template' }}
                                    </h6>
                                    <div class="proposal_box_btns">
                                        <button type="button" class="btn remove-proposal-box" data-id="{{ $proposal->id }}" data-tooltip="Delete Template" aria-label="Remove">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <button class="btn edit-proposal-box dynamic_proposal_them_box" type="button" data-tooltip="Edit Template" aria-label="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn duplicate-proposal-box" data-tooltip="Duplicate Template" aria-label="Duplicate">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <p>No {{ $proposalTypeName->type }} Template Available.</p>
                            @endforelse
                        </div>
                    </div>
                    <div class="customize-proposal animate__animated animate__fadeIn" style="display: none;">
                        <div class="row">
                            <div class="col-xl-2 col-md-3">
                                <div class="editor-panel">
                                    <div class="back-button-container">
                                        <button type="button" id="back-button" class="btn secondary_btn back-button" data-tooltip="Return to template selection">
                                            <i class="fas fa-arrow-left" aria-hidden="true"></i> Back to Templates
                                        </button>
                                    </div>
                                    <h4>Proposal Editor</h4>
                                    <div class="editor-sections">
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-tag"></i> Proposal Type
                                            </label>
                                            <select class="form-control normal_select_disable" id="proposal_type" name="proposal_type" data-tooltip="This determines the category of your proposal">
                                                @foreach ($proposalTypes as $proposalType)
                                                    <option value="{{ $proposalType->id }}" {{ $proposalType->id == $id ? 'selected' : '' }}>
                                                        {{ $proposalType->type ?? $proposalType->title ?? $proposalType->id }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-signature"></i> Template Name
                                            </label>
                                            <input class="form-control proposals_name" name="name" placeholder="Enter Template Name" required data-tooltip="Give your proposal template a memorable name">
                                        </div>
                                        <div class="bottom_btns">
                                            <button type="button" class="btn green_btn" id="addPage" data-tooltip="Add a new page to your proposal">
                                                <i class="fas fa-plus"></i> Add New Page
                                            </button>
                                            <button type="button" class="btn green_btn add_attach_pdf">
                                                <i class="fas fa-plus"></i> Attach PDF
                                            </button>
                                            <button type="button" class="btn green_btn" id="openPageReorderBtn">
                                                <i class="fas fa-sort"></i> Reorder Pages
                                            </button>
                                            <button type="button" class="btn green_btn" id="fullPreviewBtn" data-tooltip="Preview all pages">
                                                <i class="fas fa-eye"></i> Preview Pages
                                            </button>
                                            <div class="form-group save-section">
                                                <button type="submit" class="btn green_btn save-btn" id="save-proposal" data-tooltip="Save your proposal template">
                                                    <i class="fas fa-save"></i> Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" class="preview_image edit_preview" name="preview_image_screenshoot" id="preview_image_screenshoot">
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <div class="editor-workspace">
                                    <div class="main" id="pages"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <div class="offcanvas Job_Insurance_offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel"></div>
    <div class="modal fade addElementsModal" id="addElementsModal" tabindex="-1" aria-labelledby="addElementsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addElementsModalLabel">
                        <i class="fas fa-plus-circle"></i> Add Element to Your Proposal
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit-element-id" value="">
                    <input type="hidden" id="edit-element-type" value="">
                    <div class="element-selection-intro">
                        <p class="text-muted">Choose the type of content you want to add to your proposal. .</p>
                        <button type="button" class="btn btn-secondary  back-to-options" style="display: none;">
                            <i class="fas fa-arrow-left"></i> Back to Elements
                        </button>
                    </div>
                    <div class="list-group mb-3" id="element-options">
                        <div class="row">
                            <div class="col-md-4">
                                <button type="button" class="list-group-item list-group-item-action add-element-option" data-type="text">
                                    <div class="element-option-content">
                                        <i class="fas fa-font element-icon"></i>
                                        <div class="element-details">
                                            <strong>Text</strong>
                                            <small>Add headings, paragraphs, or any text content</small>
                                        </div>
                                    </div>
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="list-group-item list-group-item-action add-element-option" data-type="image">
                                    <div class="element-option-content">
                                        <i class="fas fa-image element-icon"></i>
                                        <div class="element-details">
                                            <strong>Image</strong>
                                            <small>Upload and display images, logos, or graphics</small>
                                        </div>
                                    </div>
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="list-group-item list-group-item-action add-element-option" data-type="table">
                                    <div class="element-option-content">
                                        <i class="fas fa-table element-icon"></i>
                                        <div class="element-details">
                                            <strong>Table</strong>
                                            <small>Create structured data tables with rows and columns</small>
                                        </div>
                                    </div>
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="list-group-item list-group-item-action add-element-option" data-type="product-table">
                                    <div class="element-option-content">
                                        <i class="fas fa-shopping-cart element-icon"></i>
                                        <div class="element-details">
                                            <strong>Product Table</strong>
                                            <small>Pre-formatted table for products with pricing</small>
                                        </div>
                                    </div>
                                </button>
                            </div>
                            <div class="col-md-4 d-none">
                                <button type="button" class="list-group-item list-group-item-action add-element-option" data-type="lead-selector">
                                    <div class="element-option-content">
                                        <i class="fas fa-user-tie element-icon"></i>
                                        <div class="element-details">
                                            <strong>Lead Selector</strong>
                                            <small>Select a lead and add their images to the proposal</small>
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="element-form" id="text-form">
                        <div class="form-group">
                            <label><i class="fas fa-edit"></i> Text Content</label>
                            <div id="ckeditor-container">
                                <div id="text-editor-wrapper">
                                    <div id="text-content"></div>
                                </div>
                                <div id="custom-variable-dropdown">
                                    <input type="text" class="dropdown-search" placeholder="Search variables...">
                                    <ul class="dropdown-options">
                                        @foreach($variables as $variable)
                                            <li data-value="{{ $variable->value ?? '' }}" data-preview="{{ $variable->preview ?? $variable->value ?? '' }}">
                                                {{ $variable->value ?? '' }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn green_btn mt-4 add-text-element">
                            <i class="fas fa-plus"></i> Add Text Element
                        </button>
                    </div>
                    <div class="element-form" id="image-form">
                        <div class="form-group">
                            <label><i class="fas fa-upload"></i> Upload Image</label>
                            <input type="file" class="form-control" id="image-upload" accept="image/*">
                        </div>
                        <div class="form-group">
                            <img id="image-preview" src="" alt="Image Preview" style="display: none;">
                        </div>
                        <div class="alert alert-info" id="image-info" style="display: none;">
                            <i class="fas fa-info-circle"></i>
                            <strong>Image loaded successfully!</strong><br>
                        </div>
                        <button type="button" class="btn green_btn mt-4 add-image-element">
                            <i class="fas fa-plus"></i> Add Enhanced Image
                        </button>
                    </div>
                    <div class="element-form" id="table-form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fas fa-list"></i> Number of Rows</label>
                                    <input type="number" class="form-control" id="table-rows" min="1" value="2">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fas fa-columns"></i> Number of Columns</label>
                                    <input type="number" class="form-control" id="table-cols" min="1" value="2">
                                </div>
                            </div>
                        </div>
                        <div class="form-group d-none">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="table-headers" checked>
                                <label class="form-check-label" for="table-headers">
                                    <i class="fas fa-heading"></i> Include Headers
                                </label>
                            </div>
                        </div>
                        <div class="form-group d-none">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="table-equal-cells" checked>
                                <label class="form-check-label" for="table-equal-cells">
                                    <i class="fas fa-expand-arrows-alt"></i> Equal Cell Size (Text Wrapping - Wrap)
                                </label>
                                <small class="form-text text-muted">All cells will have equal width and height</small>
                            </div>
                        </div>
                        <div class="row d-none">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><i class="fas fa-font"></i> Font Family</label>
                                    <select class="form-control" id="table-font-family">
                                        <option value="Arial">Arial</option>
                                        <option value="Times New Roman">Times New Roman</option>
                                        <option value="Helvetica">Helvetica</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Verdana">Verdana</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><i class="fas fa-text-height"></i> Font Size</label>
                                    <input type="number" class="form-control" id="table-font-size" min="8" max="24" value="12">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><i class="fas fa-palette"></i> Text Color</label>
                                    <input type="color" class="form-control form-control-color" id="table-text-color" value="#000000">
                                </div>
                            </div>
                        </div>
                        <div id="table-preview-container"></div>
                        <button type="button" class="btn green_btn mt-4 add-table-element">
                            <i class="fas fa-plus"></i> Add Enhanced Table
                        </button>
                    </div>
                    <div class="element-form" id="product-table-form">
                        <div class="form-group">
                            <label><i class="fas fa-list"></i> Number of Rows</label>
                            <input type="number" class="form-control" id="product-table-rows" min="1" value="3">
                        </div>
                        <div class="form-group d-none">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="product-table-headers" checked>
                                <label class="form-check-label" for="product-table-headers">
                                    <i class="fas fa-heading"></i> Include Headers
                                </label>
                            </div>
                        </div>
                        <div id="product-table-preview-container"></div>
                        <button type="button" class="btn green_btn mt-4 add-product-table-element">
                            <i class="fas fa-plus"></i> Add Product Table
                        </button>
                    </div>
                    <div class="element-form" id="lead-selector-form">
                        <div class="form-group">
                            <label><i class="fas fa-users"></i> Select Lead</label>
                            <select class="form-control select2" id="lead-selector" name="lead_id">
                                <option value="" disabled selected>Choose a lead...</option>
                                @foreach($leads as $lead)
                                    <option value="{{ $lead->id }}" data-images="{{ json_encode($lead->images ?? []) }}">{{ $lead->title ?? 'Untitled Lead' }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Select a lead to see their available images</small>
                        </div>
                        <div class="form-group" id="lead-images-container" style="display: none;">
                            <label><i class="fas fa-images"></i> Lead Images</label>
                            <div id="lead-images-grid" class="images-grid"></div>
                            <small class="form-text text-muted">Click on an image to add it to your proposal</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade addAttachPdfModal" id="addAttachPdfModal" tabindex="-1" aria-labelledby="addAttachPdfModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAttachPdfModalLabel">
                        <i class="fas fa-plus-circle"></i> Add Attach PDF
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="" id="pdf-upload-form">
                        <div class="form-group">
                            <label><i class="fas fa-upload"></i> Select PDF File</label>
                            <input type="file" class="form-control" id="pdf-file-input" accept=".pdf" required>
                        </div>
                        <div class="form-group pdf-preview-container" id="pdf-preview-container" style="display: none;">
                            <label><i class="fas fa-eye"></i> PDF Preview</label>
                            <div id="pdf-info" class="alert alert-info">
                                <i class="fas fa-info-circle"></i>
                                <span id="pdf-details">PDF loaded successfully</span>
                            </div>
                            <div id="pdf-pages-preview" class="pdf-pages-grid"> </div>
                        </div>
                        <button type="button" class="btn green_btn mt-4" id="upload-pdf-pages">
                            <i class="fas fa-plus"></i> Append PDF Pages
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modernLayoutModal" id="modernLayoutModal" tabindex="-1" aria-labelledby="modernLayoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modernLayoutModalLabel">Select Layout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="display: flex; justify-content: space-around; align-items: center;">
                    <div>
                        <button type="button" class="btn layout-choice" data-cols="1" style="width: 120px; height: 80px;">
                            <div style="height: 60px; background: #eee; border-radius: 6px; display: flex; align-items: center; justify-content: center;"></div>
                            <div style="margin-top: 5px;">Full Column</div>
                        </button>
                    </div>
                    <div>
                        <button type="button" class="btn layout-choice" data-cols="2" style="width: 120px; height: 80px;">
                            <div style="height: 60px; display: flex;">
                                <div style="flex: 1; background: #eee; border-radius: 6px; margin-right: 2px;"></div>
                                <div style="flex: 1; background: #eee; border-radius: 6px;"></div>
                            </div>
                            <div style="margin-top: 5px;">Half Columns</div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade columnSettingsModal" id="columnSettingsModal" tabindex="-1" aria-labelledby="columnSettingsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="columnSettingsModalLabel">
                        <i class="fas fa-cog"></i> Column Settings
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label><i class="fas fa-align-left"></i> Content Alignment</label>
                        <select class="form-control" id="column-alignment">
                            <option value="left">Left</option>
                            <option value="center">Center</option>
                            <option value="right">Right</option>
                            <option value="justify">Justify</option>
                        </select>
                        <small class="form-text text-muted">This will align all content within this column</small>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-arrows-alt-v"></i> Vertical Alignment</label>
                        <select class="form-control" id="column-vertical-alignment">
                            <option value="top">Top</option>
                            <option value="middle">Middle</option>
                            <option value="bottom">Bottom</option>
                        </select>
                        <small class="form-text text-muted">Vertical alignment of content within the column</small>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-expand-arrows-alt"></i> Padding</label>
                        <input type="range" class="form-control-range" id="column-padding" min="5" max="50" value="15">
                        <small class="form-text text-muted">Adjust internal spacing: <span id="padding-value">15px</span></small>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-palette"></i> Background Color</label>
                        <input type="color" class="form-control form-control-color" id="column-bg-color" value="#ffffff">
                        <small class="form-text text-muted">Set column background color</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn green_btn" id="apply-column-settings">
                        <i class="fas fa-check"></i> Apply Settings
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade tableEditModal" id="tableEditModal" tabindex="-1" aria-labelledby="tableEditModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tableEditModalLabel">
                        <i class="fas fa-edit"></i> Edit Table Content
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="table-edit-container"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn green_btn" id="save-table-changes">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade fullPreviewModal" id="fullPreviewModal" tabindex="-1" aria-labelledby="fullPreviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fullPreviewModalLabel">
                        <i class="fas fa-eye"></i> Proposal Preview
                    </h5>
                    <div class="preview-controls">
                        <button type="button" class="btn btn-outline-light btn-sm" id="prevPage">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <span class="page-indicator mx-3">Page <span id="currentPageNum">1</span> of <span id="totalPagesNum">1</span></span>
                        <button type="button" class="btn btn-outline-light btn-sm" id="nextPage">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0" style="background: #f5f5f5;">
                    <div class="preview-container" id="previewContainer"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade pageReorderModal" id="pageReorderModal" tabindex="-1" tabindex="-1" aria-labelledby="pageReorderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-eye"></i> Reorder Pages
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div id="pageReorderContainer" class="pageReorderContainer"></div>
                    <button class="btn green_btn mt-4 " id="savePageOrder"> <i class="fas fa-save"></i> Save </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.4.0/purify.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="{{asset('js/proposal.js')}}"></script>
@endpush