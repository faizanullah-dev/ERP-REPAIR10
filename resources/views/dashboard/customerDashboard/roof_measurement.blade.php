@extends('layouts.master')

@push('css')
    <style>
        .measurement_card.hidden {
            display: none !important;
        }

        .no-results {
            text-align: center;
            padding: 40px;
            color: #666;
            font-size: 16px;
        }

        .no-results i {
            font-size: 48px;
            margin-bottom: 15px;
            color: #ccc;
        }
    </style>
@endpush

@section('content')
    <section class="roof_measurements">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                            <h4>Measurements</h4>

                        <div class="measurements_card_wrapper">
                            <div class="row" id="measurementsContainerRoof">
                                @for($i=1;$i<3;$i++)
                                    <div class="col-md-4">
                                        <div class="measurement_card" data-measurement="roof area">
                                            <h4>Roof Area</h4>
                                            <p class="p-16">Measurement: <span class="count">4182</span></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="measurement_card" data-measurement="siding area">
                                            <h4>Siding Area</h4>
                                            <p class="p-16">Measurement: <span class="count">4182</span></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="measurement_card" data-measurement="windows">
                                            <h4>Windows</h4>
                                            <p class="p-16">Measurement: <span class="count">4182</span></p>
                                        </div>
                                    </div>
                                @endfor
                            </div>

                            <div class="no-results" id="noResultsMessageRoof" style="display: none;">
                                <i class="fa fa-search"></i>
                                <p>No measurements found matching your search.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="white-box">
                            <h4>Documents</h4>

                        <div class="measurements_card_wrapper">
                            <div class="row" id="measurementsContainerDocuments">

                                <div class="col-md-12">
                                    <h6>Contracts</h6>
                                </div>
                                @foreach($lead->getProposal->whereNotNull('signature') as $value)
                                    <div class="col-md-4">
                                        <div class="measurement_card" data-measurement="roof area">
                                            <a href="https://docs.google.com/gview?url={{ route('viewProposalPdf', ['filename' => $value->customer_description]) }}&embedded=true"
                                               data-fancybox="gallery"
                                               data-type="iframe"
                                               data-caption="Proposal PDF">
                                            <i class="fa-solid fa-file-pdf"></i>
                                            <p class="p-16">View Proposal</p>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach

                                @foreach($lead->getFolderManagement->where('type', 'proposal') as $value)
                                    @foreach($value->files as $file)
                                        @php
                                            $extension = pathinfo($file->name, PATHINFO_EXTENSION);
                                        @endphp
                                        <div class="col-md-4">
                                            <div class="measurement_card" data-measurement="roof area">
                                                @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                                    <!-- Image Preview -->
                                                    <a href="{{ asset('website/lead_inner_proposal/' . $file->name) }}"
                                                       data-fancybox="gallery"
                                                       data-caption="{{ $value->title ?? '' }}">
                                                        <img src="{{ asset('website/lead_inner_proposal/' . $file->name) }}" alt="Proposal" class="img-fluid" width="32px">
                                                        <p class="p-16">{{ $value->title ?? "" }}</p>
                                                    </a>
                                                @elseif($extension == 'pdf')
                                                    <!-- PDF Preview -->
                                                    <a href="https://docs.google.com/gview?url={{ asset('website/lead_inner_proposal/' . $file->name) }}&embedded=true"
                                                       data-fancybox="gallery"
                                                       data-type="iframe"
                                                       data-caption="{{ $value->title ?? '' }}">
                                                        <i class="fa-solid fa-file-pdf"></i>
                                                        <p class="p-16">{{ $value->title ?? "" }}</p>
                                                    </a>
                                                @elseif(in_array($extension, ['doc', 'docx', 'xls', 'xlsx']))
                                                    <!-- Word/Excel Preview (inside Fancybox iframe) -->
                                                    <a href="https://view.officeapps.live.com/op/embed.aspx?src={{ asset('website/lead_inner_proposal/' . $file->name) }}"
                                                       data-fancybox="gallery"
                                                       data-type="iframe"
                                                       data-caption="{{ $value->title ?? '' }}">
                                                       @if($extension == 'doc' || $extension == 'docx')
                                                            <i class="fa-solid fa-file-word-o"></i>
                                                        @else
                                                            <i class="fa-solid fa-file-excel-o"></i>
                                                       @endif
                                                        <p class="p-16">{{ $value->title ?? "" }}</p>
                                                    </a>
                                                @else
                                                    <!-- Default File Icon -->
                                                    <a href="{{ asset('website/proposal/' . $file->name) }}" target="_blank">
                                                        <i class="fa-solid fa-file-o"></i>
                                                        <p class="p-16">{{ $value->title ?? "" }}</p>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach

                                <div class="col-md-12">
                                    <h6>Permits</h6>
                                </div>
                                @foreach($lead->getFolderManagement->where('type', 'permit') as $value)
                                    @foreach($value->files as $file)
                                        @php
                                            $extension = pathinfo($file->name, PATHINFO_EXTENSION);
                                        @endphp
                                        <div class="col-md-4">
                                            <div class="measurement_card" data-measurement="roof area">
                                                @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                                    <!-- Image Preview -->
                                                    <a href="{{ asset('website/permits/' . $file->name) }}"
                                                       data-fancybox="gallery"
                                                       data-caption="{{ $value->title ?? '' }}">
                                                        <img src="{{ asset('website/permits/' . $file->name) }}" alt="Permit Image" class="img-fluid" width="50">
                                                        <p class="p-16">{{ $value->title ?? "" }}</p>
                                                    </a>
                                                @elseif($extension == 'pdf')
                                                    <!-- PDF Preview -->
                                                    <a href="https://docs.google.com/gview?url={{ asset('website/permits/' . $file->name) }}&embedded=true"
                                                       data-fancybox="gallery"
                                                       data-type="iframe"
                                                       data-caption="{{ $value->title ?? '' }}">
                                                        <i class="fa-solid fa-file-pdf"></i>
                                                        <p class="p-16">{{ $value->title ?? "" }}</p>
                                                    </a>
                                                @elseif(in_array($extension, ['doc', 'docx', 'xls', 'xlsx']))
                                                    <!-- Word/Excel Preview (inside Fancybox iframe) -->
                                                    <a href="https://view.officeapps.live.com/op/embed.aspx?src={{ asset('website/permits/' . $file->name) }}"
                                                       data-fancybox="gallery"
                                                       data-type="iframe"
                                                       data-caption="{{ $value->title ?? '' }}">
                                                        @if($extension == 'doc' || $extension == 'docx')
                                                            <i class="fa-solid fa-file-word-o"></i>
                                                        @else
                                                            <i class="fa-solid fa-file-excel-o"></i>
                                                        @endif
                                                        <p class="p-16">{{ $value->title ?? "" }}</p>
                                                    </a>
                                                @else
                                                    <!-- Default File Icon -->
                                                    <a href="{{ asset('website/permits/' . $file->name) }}" target="_blank">
                                                        <i class="fa-solid fa-file-o"></i>
                                                        <p class="p-16">{{ $value->title ?? "" }}</p>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach

                                <div class="col-md-12">
                                    <h6>Warranties</h6>
                                </div>
                                @foreach($lead->getFolderManagement->where('type', 'warranties') as $value)
                                    @foreach($value->files as $file)
                                        @php
                                            $extension = pathinfo($file->name, PATHINFO_EXTENSION);
                                        @endphp
                                        <div class="col-md-4">
                                            <div class="measurement_card" data-measurement="roof area">
                                                @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                                    <!-- Image Preview -->
                                                    <a href="{{ asset('website/warranty/' . $file->name) }}"
                                                       data-fancybox="gallery"
                                                       data-caption="{{ $value->title ?? '' }}">
                                                        <img src="{{ asset('website/warranty/' . $file->name) }}" alt="Permit Image" class="img-fluid" width="50">
                                                        <p class="p-16">{{ $value->title ?? "" }}</p>
                                                    </a>
                                                @elseif($extension == 'pdf')
                                                    <!-- PDF Preview -->
                                                    <a href="https://docs.google.com/gview?url={{ asset('website/warranty/' . $file->name) }}&embedded=true"
                                                       data-fancybox="gallery"
                                                       data-type="iframe"
                                                       data-caption="{{ $value->title ?? '' }}">
                                                        <i class="fa-solid fa-file-pdf"></i>
                                                        <p class="p-16">{{ $value->title ?? "" }}</p>
                                                    </a>
                                                @elseif(in_array($extension, ['doc', 'docx', 'xls', 'xlsx']))
                                                    <!-- Word/Excel Preview (inside Fancybox iframe) -->
                                                    <a href="https://view.officeapps.live.com/op/embed.aspx?src={{ asset('website/warranty/' . $file->name) }}"
                                                       data-fancybox="gallery"
                                                       data-type="iframe"
                                                       data-caption="{{ $value->title ?? '' }}">
                                                        @if($extension == 'doc' || $extension == 'docx')
                                                            <i class="fa-solid fa-file-word-o"></i>
                                                        @else
                                                            <i class="fa-solid fa-file-excel-o"></i>
                                                        @endif
                                                        <p class="p-16">{{ $value->title ?? "" }}</p>
                                                    </a>
                                                @else
                                                    <!-- Default File Icon -->
                                                    <a href="{{ asset('website/warranty/' . $file->name) }}" target="_blank">
                                                        <i class="fa-solid fa-file-o"></i>
                                                        <p class="p-16">{{ $value->title ?? "" }}</p>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                                </div>



                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#searchInputRoof').on('input', function() {
                const search = $(this).val().toLowerCase();
                let count = 0;
                $('#measurementsContainerRoof .col-md-4').hide();
                $('#measurementsContainerRoof .measurement_card').each(function() {
                    const title = $(this).find('h4').text().toLowerCase();
                    const match = !search || title.includes(search);
                    if (match) {
                        $(this).closest('.col-md-4').show();
                        count++;
                    }
                });
                $('#noResultsMessageRoof').toggle(count === 0 && search.length > 0);
            });

            $('#entriesPerPageRoof').on('change', function() {
                const entriesPerPage = parseInt($(this).val());
                const allCols = $('#measurementsContainerRoof .col-md-4');
                allCols.hide();
                allCols.slice(0, entriesPerPage).show();
            });

            $('#searchInputDocuments').on('input', function() {
                const search = $(this).val().toLowerCase();
                let count = 0;
                $('#measurementsContainerDocuments .col-md-4').hide();
                $('#measurementsContainerDocuments .measurement_card').each(function() {
                    const title = $(this).find('p.p-16').text().toLowerCase();
                    const match = !search || title.includes(search);
                    if (match) {
                        $(this).closest('.col-md-4').show();
                        count++;
                    }
                });
                $('#noResultsMessageDocuments').toggle(count === 0 && search.length > 0);
            });

            $('#entriesPerPageDocuments').on('change', function() {
                const entriesPerPage = parseInt($(this).val());
                const allCols = $('#measurementsContainerDocuments .col-md-4');
                allCols.hide();
                allCols.slice(0, entriesPerPage).show();
            });
        });
    </script>
@endpush