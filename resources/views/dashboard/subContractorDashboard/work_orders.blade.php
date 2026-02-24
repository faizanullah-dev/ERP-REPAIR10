@extends('layouts.new-master')

@push('css')
@endpush

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="white_box_header">
                            <h4>Work Orders - {{ ucfirst($status) }}</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table dataTable">
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
                                @foreach($subcontractor->subContractorProposal->when($filterStatus, function ($query, $filterStatus) {
                                    return $query->where('status', $filterStatus);
                                }) as $key => $contractor)
                                    <tr class="tableRow" data-project-date="{{ $contractor->created_at }}">
                                        <td>{{ $contractor->getLead->title ?? "Not Available" }}</td>
                                        <td>{{ $contractor->getLead->address ?? "Not Available" }}</td>
                                        <td>
                                            {{ $contractor->getLead->lead_date
                                                ? \Carbon\Carbon::parse($contractor->getLead->lead_date)->format('m-d-Y')
                                                : 'Not Available' }}
                                        </td>

                                        <td>
                                            @if($contractor->status == 'signed')
                                                <badge class="badge badge-success">Signed</badge>
                                            @else
                                                <badge class="badge badge-warning">Required</badge>
                                            @endif
                                        </td>
                                        <td class="btn_td">
                                            @if($contractor->status == 'signed')
                                                <a href="https://docs.google.com/gview?url={{ route('viewSubContractorPdf', ['id' => $contractor->proposal_template_id, 'lead_id' => $contractor->lead_id]) }}&embedded=true" class="btn btn_primary" data-fancybox="gallery" data-type="iframe" data-caption="Proposal PDF" title="View Signed PDF">
                                                    <i class="fa-solid fa-file-pdf"></i>
                                                </a>
                                            @else

                                                <a href="{{ route('viewSubContractorPdf', ['id' => $contractor->proposal_template_id, 'lead_id' => $contractor->lead_id]) }}" class="btn btn_primary" title="View Contract">
                                                    <i class="fa-regular fa-file-lines"></i>
                                                    View Contract
                                                </a>
                                            @endif
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
    </section>
@endsection

@push('js')
@endpush
