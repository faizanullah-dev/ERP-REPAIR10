@extends('layouts.new-master')

@push('css')
@endpush

@section('content')
    <section class="jobs_sec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="white_box_header">
                            <h4>Jobs - {{ ucfirst($jobStatus) }}</h4>
                        </div>
                        {{--                        <div class="jobs_filters">--}}
                        {{--                            <select class="form-control w-auto" id="show-entries">--}}
                        {{--                                <option value="10">Show 10</option>--}}
                        {{--                                <option value="20">Show 20</option>--}}
                        {{--                                <option value="50">Show 50</option>--}}
                        {{--                            </select>--}}
                        {{--                            <input type="text" class="form-control w-25" id="search" placeholder="Search">--}}
                        {{--                        </div>--}}
                        <div class="row">
                            @forelse($jobs as $job)
                                <div class="col-md-4 ">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-header-left">
                                                <div class="card-header-img">
                                                    <img src="{{ asset('/website/images').'/by_default_two.png' }} " >
                                                </div>
                                                <div>
                                                    <a href="{{url('sub_contractor_jobs_details')}}/{{$job->id}}">             <h5 class="card-title">{{ $job->getLead->title ?? 'N/A' }}</h5></a>
                                                </div>
                                            </div>
                                            <div>
                                                <button class="btn btn-{{ $job->job_status == 'active' ? 'complete' : 'success' }}">
                                                    {{ ucfirst($job->job_status) }}
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <p>
                                                <span>Category:</span> {{ $job->getLead->category->name ?? 'N/A' }}
                                            </p>
                                            <p>
                                                <span>Lead Number:</span> {{ $job->getLead->lead_number ?? 'N/A' }}
                                            </p>
                                            <p>
                                                <span>Lead address:</span>
                                                @if(isset($job->getLead) && $job->getLead->customer && $job->getLead->customer->profile)
                                                    {{$job->getLead->customer->profile->address}}
                                                @else
                                                    Not Available
                                                @endif
                                            </p>
                                            <p class="job_description">
                                                <span>Description:</span> {{ strip_tags($job->getLead->description ?? 'No Description') }}
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center">No jobs found.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
@endpush
