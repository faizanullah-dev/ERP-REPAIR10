@extends('layouts.master')
@php
    use Illuminate\Support\Str;
@endphp
@push('css')
    <style>
        .text-container {
            max-height: 100px; /* Set the desired maximum height */
            overflow-y: scroll;
            border: 1px solid #ccc; /* Optional: Add a border for styling */
            padding: 5px; /* Optional: Add padding for better appearance */
        }
    </style>
@endpush
@section('content')
    <div id="taf-tabs">
        <div class="row">
            <div class="col-md-6">
                <label class="fs-3 fw-bold">Campaign Name: </label>
                <span>{{ $campaign->name ?? "Not Available" }}</span>
            </div>
            <div class="col-md-6">
                <label class="fs-3 fw-bold">Stage Name: </label>
                <span>{{ $campaign->getStages->name ?? "Not Available" }}</span>
            </div>
            <div class="col-md-6">
                <label class="fs-3 fw-bold">Status: </label>
                <span> @if($campaign->status == 1) Active @else Inactive @endif </span>
            </div>
            <div class="col-md-6">
                <label class="fs-3 fw-bold">Play or Resume Status: </label>
                <span> @if($campaign->play_or_resume == 1) Active @else Inactive @endif </span>
            </div>
            <div class="col-md-12">
                <div class="day_box_wrapper">
                    @php
                        $maxAddedDay = $campaignDetails->max('day');
                    @endphp
                    @for ($i = 1; $i <= max($maxAddedDay, 30); $i++)
                        @php
                            $dayDetails = $campaignDetails->where('day', $i);
                        @endphp
                        <div class="day_box">
                            <div class="white-box">
                                <h3 class="box-title">Day# {{ $i }} </h3>
                                <div class="table-responsive compaign_show_table">
                                    <table class="table color-table">
                                        <!-- <thead style="background-color: #74c911;">
                                            <tr>
                                                <th>#</th>
                                                <th style="width: 50px;" >Time</th>
                                                <th style="width: 110px;" >Message Type</th>
                                                <th style="width: 150px;" >Subject</th>
                                                <th>Note</th>
                                            </tr>
                                        </thead> -->
                                        @forelse($dayDetails as $key => $detail)
                                            @if($detail->email_template_id != null)
                                                <tbody>
                                                <tr>
                                                    <th>#</th>
                                                    <td>{{ $loop->iteration }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Time</th>
                                                    <td>{{ $detail->time ?? "" }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Message Type</th>
                                                    <td>{{ $detail->message_type ?? "Not Available" }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Subject</th>
                                                    <td>{{ $detail->emailTemplate->subject ?? "Not Available" }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Attachments</th>
                                                    <td>
                                                        @if($detail->emailTemplate && $detail->emailTemplate->images->isNotEmpty())
                                                            @foreach($detail->emailTemplate->images as $image)
                                                                <img src="{{ asset('website/' . $image->name) }}" alt="Attachment" style="max-width: 100px; margin: 5px;">
                                                            @endforeach
                                                        @else
                                                            <span>No Attachments Available</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Note</th>
                                                    <td>{!! $detail->emailTemplate->body ?? "Not Available" !!}</td>
                                                </tr>
                                                </tbody>
                                            @else
                                                <tbody>
                                                <tr>
                                                    <th>#</th>
                                                    <td>{{ $loop->iteration }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Time</th>
                                                    <td>{{ $detail->time ?? "" }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Message Type</th>
                                                    <td>{{ $detail->message_type ?? "Not Available" }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Subject</th>
                                                    <td>{{ $detail->subject ?? "Not Available" }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Attachments</th>
                                                    <td>
                                                        @if($detail->campaignAttachment && $detail->campaignAttachment->isNotEmpty())
                                                            @foreach($detail->campaignAttachment as $image)
                                                                <img src="{{ asset('website/' . $image->name) }}" alt="Attachment" style="max-width: 100px; margin: 5px;">
                                                            @endforeach
                                                        @else
                                                            <span>No Attachments Available</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Note</th>
                                                    <td>{!! $detail->message ?? "Not Available" !!}</td>
                                                </tr>
                                                </tbody>
                                            @endif
                                        @empty
                                            <tr>
                                                <td class="no_details" colspan="5">No Details Available</td>
                                            </tr>
                                        @endforelse
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
@endsection
