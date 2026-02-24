@extends('layouts.master')
@section('content')
    <section class="map_view_lead">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="row">
{{--                            <div class="col-md-6">--}}
{{--                                <div class="logoBtn_drop_wrapper map_search form-group" style="position: relative; ">--}}
{{--                                <a href="{{url('lead/lead')}}" class="btn border_btns borderRadius">View List</a>--}}
{{--                                    <div class="dropdown">--}}
{{--                                        <button type="button" class="btn button_drop  dropdown-toggle green_btn borderRadius "    id="viwDropButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" > <i class="fa fa-eye"></i> </button>--}}
{{--                                        <div class="dropdown-menu" aria-labelledby="viwDropButton">--}}
{{--                                            <div class=" " >--}}
{{--                                                <a href="{{url('lead/lead')}}" class="btn border_btns borderRadius">List View</a>--}}
{{--                                            </div>--}}
{{--                                            <div class=" " >--}}
{{--                                                <a href="{{url('calender_task_view')}}" class="btn border_btns borderRadius">Calender View</a>--}}
{{--                                            </div>--}}
{{--                                            <div class=" " >--}}
{{--                                                <a href="{{url('lead_card_view')}}" class="btn border_btns borderRadius">Card View</a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <input id="map-search" class="controls form-control clr_input_fields borderRadius " type="text" placeholder="Enter an address"  style="position: absolute; left: 50px; top: 0px;" >--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="col-md-12">
                                <div class="white-box-header">
                                    <div class="white-box-header-left">
                                        <h3 class="box-title">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Map ') }}</h3>
                                    </div>
                                    <div class="white-box-header-right">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="logoBtn_drop_wrapper form-group">
                                    <div class="button_logo">
                                        <form>
{{--                                        @can('delete-'.str_slug('Lead'))--}}
{{--                                            <button type="button" class="btn green_btn borderRadius delete_inbox_email" data-notification-id="" id="btn-delete-multiple" data-toggle="tooltip" data-placement="top" title="Delete" > <i class="fa-regular fa-trash-can"></i> </button>--}}
{{--                                        @endcan--}}
{{--                                        @can('view-usersmailboxconfiguration')--}}
{{--                                            <button type="button" class="btn green_btn borderRadius add_job_note_modal_btn" data-toggle="tooltip" data-placement="top" title="Emails" > <i class="fa-solid fa-envelopes-bulk"></i> </button>--}}
{{--                                        @endcan--}}
{{--                                        @can('add-'.str_slug('Task'))--}}
{{--                                            <button type="button" class="btn green_btn borderRadius add_task_modal_btn" data-toggle="tooltip" data-placement="top" title="Add Task" > <i class="fa-solid fa-list-check"></i> </button>--}}
{{--                                        @endcan--}}
{{--                                        @can('add-'.str_slug('JobNote'))--}}
{{--                                            <button type="button" class="btn green_btn borderRadius add_jobnote_btn" data-toggle="tooltip" data-placement="top" title="Job Note" > <i class="fa-regular fa-clipboard"></i> </button>--}}
{{--                                        @endcan--}}
{{--                                        @can('add-'.str_slug('Estimate'))--}}
{{--                                            <button type="button" class="btn green_btn borderRadius add_estimate_proposal_btn" data-toggle="tooltip" data-placement="top" title="Estimate Proposal" > <i class="fa-solid fa-briefcase"></i> </button>--}}
{{--                                        @endcan--}}
{{--                                        @can('add-'.str_slug('Material'))--}}
{{--                                            <button type="button" class="btn green_btn borderRadius add_material_btn" data-toggle="tooltip" data-placement="top" title="Material" > <i class="fa-solid fa-cubes-stacked"></i> </button>--}}
{{--                                        @endcan--}}
                                            <input id="map-search" class="controls form-control clr_input_fields borderRadius " type="text" placeholder="Enter an address"  style="position: absolute; left: 50px; top: 0px;" >
                                        </form>
                                    </div>
                                    <div class="logobtn_right_box">
                                        <div class="view_type_box" >
                                            <a href="{{ url('lead_card_view?lead_card_view_status=unarchive') }}" class="btn green_btn {{ Request::is('lead_card_view') ? 'active' : '' }}"><img class="img-fluid" src="{{ asset('/website/images').'/cards-blank.svg' }} " ></a>
                                            <a href="{{ url('lead/lead') }}" class="btn green_btn {{ Request::is('lead/lead') ? 'active' : '' }}"><i class="fa-solid fa-list"></i></a>
                                            <a href="{{ url('map_view_lead') }}" class="btn green_btn {{ Request::is('map_view_lead') ? 'active' : '' }}"><i class="fa-solid fa-location-dot"></i></a>
                                            <a href="{{ url('calender_task_view') }}" class="btn green_btn {{ Request::is('calender_task_view') ? 'active' : '' }}"><i class="fa-solid fa-calendar"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <form method="get" action="{{url('map_view_lead')}}" id="filter-form">
                                    <div class="filter_inputs_btns_wrapper">
                                        <input type="hidden" name="lead_filter" value="yes">
                                        <div class="  filter_inputs_parent">
                                            <label for="Select Category" class="form-label input_labels p-18">Select Category</label>
                                            <select class="form-control borderRadius select_category_initialize" data-placeholder="Select Category" id="categoryFilter" name="category_id" >
                                                <option value=""></option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}" {{  request()->get('category_id') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @php
                                            if (request()->get('duration_starts') && request()->get('duration_ends')) {
                                                $yearEstimation = (object) [
                                                    'year' => request()->get('duration_starts')
                                                ];
                                                $durationEnds = request()->get('duration_ends');
                                            } else {
                                                $durationEnds = now()->endOfYear()->format('Y-m-d');
                                            }
                                        @endphp
                                        <div class="filter_inputs_parent">
                                            <label for="duration_starts" class="form-label input_labels p-18">To </label>
                                            <input class="form-control clr_input_fields "  name="duration_starts" value="{{ request()->get('duration_starts') ?? $yearEstimation->year . '-01-01' }}" type="date" id="duration_starts"  required   >
                                        </div>
                                        <div class="filter_inputs_parent">
                                            <label for="duration_ends" class="form-label input_labels p-18">From </label>
                                            <input class="form-control clr_input_fields " name="duration_ends" type="date" value="{{ request()->get('duration_ends') ?? $yearEstimation->year . '-12-31' }}"   id="duration_ends" required  >
                                        </div>
{{--                                        <div class="  filter_inputs_parent filter_btns_parent">--}}
{{--                                            <div class="reset_apply_btn">--}}
{{--                                                <a href="{{ url('map_view_lead') }}" class="btn border_btns borderRadius">Reset</a>--}}
{{--                                                <button type="submit" class="btn border_btns borderRadius">Apply</button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <div class=" filter_inputs_parent filter_btns_parent">
                                            <div class="reset_apply_btn">
                                                <button type="submit" class="btn blue_btn ">Apply <i class="fa-solid fa-check"></i></button>
                                                <a href="{{ url('map_view_lead') }}" class="btn gray_btn ">Reset <img class="img-fluid" src="{{ asset('/website/images').'/recycle.svg' }} " ></a>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                        <div class="row user-view-head">
                            <div class="col-md-4">
                                <div class="item-card-view">
                                    <h4>Won</h4>
                                    <ul>
                                        <li> {{ $lead->where('lead_status', 'won')->count() }} </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="item-card-view">
                                    <h4> Pending </h4>
                                    <ul>
                                        <li> {{ $lead->where('lead_status', 'pending')->count() }} </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="item-card-view">
                                    <h4>Lost</h4>
                                    <ul>
                                        <li> {{ $lead->where('lead_status', 'lost')->count() }} </li>
                                    </ul>
                                </div>
                            </div>
                        <div class="col-md-12">
                        <div id="map" style="position: static; overflow:visible "></div>
                    </div>
                </div>
            </div>

            </div>
        </div>
    </section>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{env('googleAPI')}}&libraries=places&callback=initMap" async defer></script>
<script>

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: 41.8719, lng: 12.5674 },
            zoom: 3
        });
        var currentInfoWindow = null;
        var input = document.getElementById('map-search');
        var searchBox = new google.maps.places.SearchBox(input);
        map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
        });
        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();
            if (places.length == 0) {
                return;
            }
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                if (place.geometry.viewport) {
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });
        @foreach($lead as $key => $item)
        (function() {
            var markerLocation = {lat: parseFloat("{{ $item->latitude ?? '' }}"), lng: parseFloat("{{ $item->longitude ?? '' }}")};
            var content =
                '<div class="modal-content map_modal_conent">' +
                '<h2>Job Info</h2>' +
                '<p>Title: {{$item->title}}</p>' +
                '<p>Customer : {{$item->customer->name??''}} </p>' +
                '<p>Category : {{$item->category->name??''}} </p>' +
                '<p>Job ID   : {{$item->lead_number??''}}    </p>' +
                '<p>Contact Person   : {{$item->contact_person??''}}    </p>' +
                '<p>Stage   : {{$item->getStage->name??''}}    </p>' +
                '<p>Lead Price   : ${{ number_format((float)($item->lead_price ?? 0), 2) }}</p>' +
                '<p>Lead Date   : {{ \Carbon\Carbon::parse($item->lead_date ?? '')->format('m-d-Y') }} </p>' +

                '<p>Lead Status   : {{$item->lead_status??''}}    </p>' +
                '<a class="wt-btn btn green_btn borderRadius add_task_modal_btn " href="{{ url('view_lead/'.$item->id)}}"> {{$item->title}} </a>' +
                '</div>';
            var marker = new google.maps.Marker({
                position: markerLocation,
                map: map,
                title: "{{ $item->title }}",
                @if($item->lead_status == 'won')
                    icon: { url: "http://maps.google.com/mapfiles/ms/icons/green-dot.png", scaledSize: new google.maps.Size(50, 50), },
                @elseif($item->lead_status == 'lost')
                    icon: { url: "http://maps.google.com/mapfiles/ms/icons/red-dot.png", scaledSize: new google.maps.Size(50, 50), },
                @elseif($item->lead_status == 'pending')
                    icon: { url: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png", scaledSize: new google.maps.Size(50, 50), },
                @endif
            });
            google.maps.event.addListener(marker, 'click', (function(marker, content) {
                return function() {
                    if (currentInfoWindow) {
                        currentInfoWindow.close();
                    }
                    currentInfoWindow = new google.maps.InfoWindow({
                        content: content
                    });
                    currentInfoWindow.open(map, marker);
                }
            })(marker, content));
        })();
        @endforeach
    }
    $(document).ready(function () {

        $('.select_category_initialize').select2({
            placeholder: function() {
                return $(this).data('placeholder');
            },
            allowClear: true,
        });

        // loadGoogleMapsAPI(); // Call this function to load the Google Maps API
        $("#filter-form").validate({
            rules: {
                duration_starts: { // Rule for the duration_starts input field
                    required: true
                },
                duration_ends: { // Rule for the duration_ends input field
                    required: true
                },
            },
            messages: {
                duration_starts: { // Message for the duration_starts input field
                    required: "Please select the start date"
                },
                duration_ends: { // Message for the duration_ends input field
                    required: "Please select the end date"
                },
            },
            errorElement: "span",
            errorPlacement: function (error, element) {
                error.addClass("invalid-feedback");
                element.closest(".filter_inputs_parent").append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass("is-invalid").addClass("is-valid");
            }
        });
    });
</script>

@endpush
