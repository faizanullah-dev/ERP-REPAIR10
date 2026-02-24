@extends('layouts.master')

@push('css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/dashboard/proposal.css')}}">
@endpush

@section('content')
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
<section class="proposal_sec tabs_sec">
    <div class="container-fluid">
        <form action="{{ route('store_leads_custom_proposal') }}" method="post" class="row" id="proposalForm">
            @csrf
            <input type="hidden" id="description" name="description">
            <input type="hidden" name="proposal_template_id" id="proposal_id">
            <input type="hidden" name="lead_id" value="{{ $selectedLeadId }}">
            <input type="hidden" name="screen_shot" id="screen_shot">
            <input type="hidden" name="status" id="proposalStatus" value="sent">
            <input type="hidden" name="proposal_id" id="proposal_draft_id">
            <div class="col-md-12">
                <div class="theme-selection animate__animated animate__fadeIn">
                    <div class="proposal-header">
                        <div class="proposal-header-heading">
                            <h3><i class="fas fa-file-alt"></i> Proposals</h3>
                            <div class="back-button-container">
                                <a href="{{ url('view_lead') }}/{{$selectedLeadId}}" class="btn secondary_btn back-button" data-tooltip="Return to Proposal Generator">
                                    <i class="fas fa-arrow-left" aria-hidden="true"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#proposals" aria-controls="proposals" role="tab" data-bs-toggle="tab">Template Proposals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#saved-proposals" aria-controls="saved-proposals" role="tab" data-bs-toggle="tab">Saved Proposals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#draft-proposals" aria-controls="draft-proposals" role="tab" data-bs-toggle="tab">Draft Proposals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#signed-proposals" aria-controls="signed-proposals" role="tab" data-bs-toggle="tab">Signed Proposals</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="proposals">
                            <div class="proposal-header">
                                <h5>Template Proposals</h5>
                            </div>
                            <div class="proposal-options">
                                @forelse($proposalTemplate as $proposal)
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
                                        <button class="btn edit-proposal-box dynamic_proposal_them_box" type="button" aria-label="Edit"><i class="fa-solid fa-pen"></i></button>
                                    </div>
                                </div>
                                @empty
                                <p>No Template Proposals Available.</p>
                                @endforelse
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="saved-proposals">
                            <div class="proposal-header">
                                <h5>Save Proposal</h5>
                            </div>
                            <div class="proposal-options">
                                @forelse($lead->getProposal as $value)
                                @if($value->status == 'save')
                                <div class="proposal-card" data-proposal-draft-id="{{ $value->id ?? '' }}">
                                    <div class="proposal_them_box">
                                        <div class="proposal_them_img_box">
                                            @if(isset($value->getProposalTemplates->screen_shot))
                                            <img src="{{ asset('website') }}/{{ $value->getProposalTemplates->screen_shot ?? '' }}" alt="Proposal Screenshot">
                                            @endif
                                        </div>
                                    </div>
                                    <h6 class="proposal-title">{{ $value->getProposalTemplates->name ?? 'Not Available' }}</h6>
                                    <div class="proposal_box_btns">
                                        <button class="btn edit-proposal-box draft_proposal_them_box" type="button" aria-label="Edit"><i class="fa-solid fa-pen"></i></button>
                                    </div>
                                </div>
                                @endif
                                @empty
                                <p>No Save Proposal Available.</p>
                                @endforelse
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="draft-proposals">
                            <div class="proposal-header">
                                <h5>Draft Proposal</h5>
                            </div>
                            <div class="proposal-options">
                                @forelse($lead->getProposal as $value)
                                @if($value->status == 'draft')
                                <div class="proposal-card" data-proposal-draft-id="{{ $value->id ?? '' }}">
                                    <div class="proposal_them_box">
                                        <div class="proposal_them_img_box">
                                            @if(isset($value->getProposalTemplates->screen_shot))
                                            <img src="{{ asset('website') }}/{{ $value->getProposalTemplates->screen_shot ?? '' }}" alt="Proposal Screenshot">
                                            @endif
                                        </div>
                                    </div>
                                    <h6 class="proposal-title">{{ $value->getProposalTemplates->name ?? 'Not Available' }}</h6>
                                    <div class="proposal_box_btns">
                                        <button class="btn edit-proposal-box draft_proposal_them_box" type="button" aria-label="Edit"><i class="fa-solid fa-pen"></i></button>
                                    </div>
                                </div>
                                @endif
                                @empty
                                <p>No Draft Proposal Available.</p>
                                @endforelse
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="signed-proposals">
                            <div class="proposal-header">
                                <h5>Signed Proposal</h5>
                            </div>
                            <div class="proposal-options">
                                @forelse($lead->getProposal as $value)
                                @if($value->signature)
                                <div class="proposal-card" data-proposal-id="{{ $value->id ?? '' }}">
                                    <div class="proposal_them_box">
                                        <div class="proposal_them_img_box">
                                            @if(isset($value->getProposalTemplates->screen_shot))
                                            <img src="{{ asset('website') }}/{{ $value->getProposalTemplates->screen_shot ?? '' }}" alt="Proposal Screenshot">
                                            @endif
                                        </div>
                                    </div>
                                    <h6 class="proposal-title">{{ $value->getProposalTemplates->name ?? 'Not Available' }}</h6>
                                    <div class="proposal_box_btns">
                                        <button class="btn edit-proposal-box signed_proposal_them_box" type="button" aria-label="Edit"><i class="fa-solid fa-pen"></i></button>
                                    </div>
                                </div>
                                @endif
                                @empty
                                <p>No Signed Proposal Available.</p>
                                @endforelse
                            </div>
                        </div>
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
                                        <label for="Select Category" class="form-label input_labels p-18">Select Lead*</label>
                                        <select class="form-control  select_lead" id="leadFilter" name="lead_id" disabled>
                                            <option value="" selected disabled>Select Lead</option>
                                            @foreach($leads as $lead)
                                            <option value="{{ $lead->id }}" {{ (isset($selectedLeadId) && $selectedLeadId == $lead->id) ? 'selected' : '' }}>
                                                {{ $lead->title ?? "" }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Email Subject*</label>
                                        <input class="form-control" name="email_subject" placeholder="Enter email subject" required>
                                    </div>
                                </div>
                                <div class="customize-proposal-header-right">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="proposalSaveSwitch">
                                        <label class="form-check-label" for="proposalSaveSwitch">Do you want to save</label>
                                    </div>
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
                        <div class="col-lg-10 col-md-9">
                            <div class="editor-workspace">
                                <div class="main" id="pages">
                                    <div class="page selected animate__animated animate__fadeIn" id="page-1" data-page-id="1" style="background: #fff; box-shadow:  0 2px 10px rgba(0, 0, 0, 0.1); width: 800px;height: 1000px; margin: 0 auto 30px; position: relative; overflow: hidden;  cursor: pointer;  transition: all 0.3s ease;">
                                        <div class="page_content" style="height: 100%;  position: relative;z-index: 1;"></div>
                                        <button type="button" class="btn btn-remove-page btn-sm" title="Remove Page" data-page-id="3" style="position: absolute; top: 10px; right: 10px; z-index: 10;opacity: 0;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
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