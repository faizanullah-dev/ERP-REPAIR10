@extends('layouts.master')

@push('css')
@endpush

@section('content')
    <section class="user_profile_section cost_of_lead pt-3" id="lead-calendar-type">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 box-shadow-card px-3 py-3 borderRadius20">
                        <div class="card-body">
                            <form action="{{ route('store_calendar_types') }}" method="post" class="form-horizontal">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="mb-4">Calendar Type</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" name="calendar_type" value="1" id="start-from-monday" @if(App\CommonSetting::first()->calendar == 1) checked @endif />
                                            <label class="form-check-label" for="start-from-monday"> Start from Monday </label>
                                        </div>
                                        <label for="start-from-monday">
                                            <img src="{{asset('/website/images')}}/c1.jpg" class="mt-2 img-fluid lead-ct" />
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" name="calendar_type" value="2" id="work-week-only"
                                                   @if(App\CommonSetting::first()->calendar == 2) checked @endif />

                                            <label class="form-check-label" for="work-week-only"> Work Week Only </label>
                                        </div>
                                        <label for="work-week-only">
                                            <img src="{{asset('/website/images')}}/c2.jpg" class="mt-2 img-fluid lead-ct" />
                                        </label>
                                    </div>
                                    <div class="col-md-6 mt-4">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" name="calendar_type" value="3" id="start-from-sunday"
                                                   @if(App\CommonSetting::first()->calendar == 3) checked @endif />
                                            <label class="form-check-label" for="start-from-sunday"> Start from Sunday </label>
                                        </div>
                                        <label for="start-from-sunday">
                                            <img src="{{asset('/website/images')}}/c3.jpg" class="mt-2 img-fluid lead-ct" />
                                        </label>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mt-4">
                                            <input type="submit" class="btn green_btn" value="Save">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
@endpush
