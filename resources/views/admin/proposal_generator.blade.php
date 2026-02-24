@extends('layouts.master')
@push('css')
    <link rel="stylesheet" href="{{asset('css/dashboard/proposal.css')}}">
@endpush
@section('content')
    <section class="proposal_sec proposal_generator_section">
        <div class="container-fluid">
            <div class="proposal-header">
                <div class="proposal-header-heading">
                    <h3><i class="fas fa-file-alt"></i> Proposal Types</h3>
                    <div class="back-button-container">
                        <a href="{{ url('dashboard') }}" class="btn secondary_btn back-button" data-tooltip="Return to Proposal Generator">
                            <i class="fas fa-arrow-left" aria-hidden="true"></i> Back
                        </a>
                    </div>
                </div>
            </div>
            <div class="proposal_type_wrapper">
                <div class="row ">
                    <div class="proposal-options">
                        @forelse($proposalTypes as $proposalType)
                            <a href="{{ url('customize_proposals/' . $proposalType->id) }}">
                                <div class="proposal-card " >
                                    <div class="proposal_them_box"></div>
                                    <h6 class="proposal-title"><i class="fa-regular fa-file"></i> {{ $proposalType->type ?? 'Not Available' }}</h6>
                                </div>
                            </a>
                        @empty
                            <div class="col-12 text-center">
                                <p>No Proposal Types Found.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
@endpush