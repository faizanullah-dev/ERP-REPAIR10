@extends('layouts.master')
@push('css')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .green {
            background-color: #00FF00;
        }
        .orange {
            background-color: #FFA500;
        }
        .no-border {
            border: none !important;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid black !important;
        }
    </style>
@endpush
@section('content')
    <section class="tabs_sec">
        <div class="container-fluid">
            <div class="white-box">
            <div class="row">
                @if(isset($lead->roofEstimateCalculator) && $lead->roofEstimateCalculator)
                    @if(auth()->user()->hasRole('user') || auth()->user()->hasRole('staff'))
                        <div class="col-md-12">
                            {{-- <div class="table_top_btn">
                            <a href="{{url('roof_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->roofEstimateCalculator->id}}/preferred" class="btn btn_green">Preferred  ( {{@$lead->roofEstimateCalculator->roofEstimateCalculatorpreferred->recommended_price??'0'}} ) </a>
                            <a href="{{url('roof_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->roofEstimateCalculator->id}}/system" class="btn btn_green">System  ( {{@$lead->roofEstimateCalculator->roofEstimateCalculatorSystem->recommended_price??'0'}} )</a>
                            <a href="{{url('roof_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->roofEstimateCalculator->id}}/under_fifteen_sq" class="btn btn_green">Under 15 SQ  ( {{@$lead->roofEstimateCalculator->roofEstimateCalculatorUnderFifteen->recommended_price??'0'}} )</a>
                            <a href="{{url('roof_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->roofEstimateCalculator->id}}/gutters" class="btn btn_green">Gutter  ( {{@$lead->roofEstimateCalculator->storeRoofEstimateCalculatorGutter->recommended_price??'0'}} )  ( {{@$lead->roofEstimateCalculator->storeRoofEstimateCalculatorGutter->recommended_price_two??'0'}} ) </a>
                            <a href="{{url('roof_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->roofEstimateCalculator->id}}/flat_roof" class="btn btn_green">Flat Roof  ( {{@$lead->roofEstimateCalculator->roofEstimateCalculatorFlatRoof->recommended_price??'0'}} )</a>
                            </div> --}}
                            <ul class="nav nav-tabs" id="roofEstimationCalculator" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="measurementTab" data-bs-toggle="tab" href="#measurementContent" role="tab" aria-controls="measurementContent" aria-selected="true">Measurement</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="preferredTab" data-bs-toggle="tab" href="#preferredContent" role="tab" aria-controls="preferredContent" aria-selected="true">
                                        Preferred (<span id="prefer_recommended_price_global"></span>)
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="systemTab" data-bs-toggle="tab" href="#systemContent" role="tab" aria-controls="systemContent" aria-selected="false">
                                        System (<span id="system_recommended_price_global"></span>)
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="underFifteenTab" data-bs-toggle="tab" href="#underFifteenContent" role="tab" aria-controls="underFifteenContent" aria-selected="false">
                                        Under 15 SQ (<span id="under_fifteen_recommended_price_global"></span>)
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="guttersTab" data-bs-toggle="tab" href="#guttersContent" role="tab" aria-controls="guttersContent" aria-selected="false">
                                        Gutter (<span id="gutter_recommended_price_global"></span>) (<span id="gutter_recommended_price2_global"></span>)
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="flatRoofTab" data-bs-toggle="tab" href="#flatRoofContent" role="tab" aria-controls="flatRoofContent" aria-selected="false">
                                        Flat Roof (<span id="flat_recommended_price_global"></span>)
                                    </a>
                                </li>
                                </ul>


                        </div>
                    @else
                        <div class="col-md-10">
                               {{-- <div class="table_top_btn"> --}}
                                {{--                                <span class="btn btn_green">Preferred  ( {{@$lead->roofEstimateCalculator->roofEstimateCalculatorpreferred->recommended_price??'0'}} ) </span>--}}
                                {{--                                <span class="btn btn_green">System  ( {{@$lead->roofEstimateCalculator->roofEstimateCalculatorSystem->recommended_price??'0'}} )</span>--}}
                                {{--                                <span class="btn btn_green">Under 15 SQ  ( {{@$lead->roofEstimateCalculator->roofEstimateCalculatorUnderFifteen->recommended_price??'0'}} )</span>--}}
                                {{--                                <span class="btn btn_green">Gutter  ( {{@$lead->roofEstimateCalculator->storeRoofEstimateCalculatorGutter->recommended_price??'0'}} )  ( {{@$lead->roofEstimateCalculator->storeRoofEstimateCalculatorGutter->recommended_price_two??'0'}} ) </span>--}}
                                {{--                                <span class="btn btn_green">Flat Roof  ( {{@$lead->roofEstimateCalculator->roofEstimateCalculatorFlatRoof->recommended_price??'0'}} )</span>--}}
                              {{-- <a href="{{url('roof_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->roofEstimateCalculator->id}}/preferred" class="btn btn_green">Preferred  ( {{@$lead->roofEstimateCalculator->roofEstimateCalculatorpreferred->recommended_price??'0'}} ) </a>
                                <a href="{{url('roof_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->roofEstimateCalculator->id}}/system" class="btn btn_green">System  ( {{@$lead->roofEstimateCalculator->roofEstimateCalculatorSystem->recommended_price??'0'}} )</a>
                                <a href="{{url('roof_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->roofEstimateCalculator->id}}/under_fifteen_sq" class="btn btn_green">Under 15 SQ  ( {{@$lead->roofEstimateCalculator->roofEstimateCalculatorUnderFifteen->recommended_price??'0'}} )</a>
                                <a href="{{url('roof_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->roofEstimateCalculator->id}}/gutters" class="btn btn_green">Gutter  ( {{@$lead->roofEstimateCalculator->storeRoofEstimateCalculatorGutter->recommended_price??'0'}} )  ( {{@$lead->roofEstimateCalculator->storeRoofEstimateCalculatorGutter->recommended_price_two??'0'}} ) </a>
                                <a href="{{url('roof_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->roofEstimateCalculator->id}}/flat_roof" class="btn btn_green">Flat Roof  ( {{@$lead->roofEstimateCalculator->roofEstimateCalculatorFlatRoof->recommended_price??'0'}} )</a>
                                </div> --}}


                                <ul class="nav nav-tabs" id="roofEstimationCalculator" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="measurementTab" data-bs-toggle="tab" href="#measurementContent" role="tab" aria-controls="measurementContent" aria-selected="true">Measurement</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="preferredTab" data-bs-toggle="tab" href="#preferredContent" role="tab" aria-controls="preferredContent" aria-selected="true">
                                            Preferred ({{@$lead->roofEstimateCalculator->roofEstimateCalculatorpreferred->recommended_price??'0'}})
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="systemTab" data-bs-toggle="tab" href="#systemContent" role="tab" aria-controls="systemContent" aria-selected="false">
                                            System ({{@$lead->roofEstimateCalculator->roofEstimateCalculatorSystem->recommended_price??'0'}})
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="underFifteenTab" data-bs-toggle="tab" href="#underFifteenContent" role="tab" aria-controls="underFifteenContent" aria-selected="false">
                                            Under 15 SQ ({{@$lead->roofEstimateCalculator->roofEstimateCalculatorUnderFifteen->recommended_price??'0'}})
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="guttersTab" data-bs-toggle="tab" href="#guttersContent" role="tab" aria-controls="guttersContent" aria-selected="false">
                                            Gutter ({{@$lead->roofEstimateCalculator->storeRoofEstimateCalculatorGutter->recommended_price??'0'}})  ({{@$lead->roofEstimateCalculator->storeRoofEstimateCalculatorGutter->recommended_price_two??'0'}})
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="flatRoofTab" data-bs-toggle="tab" href="#flatRoofContent" role="tab" aria-controls="flatRoofContent" aria-selected="false">
                                            Flat Roof ({{@$lead->roofEstimateCalculator->roofEstimateCalculatorFlatRoof->recommended_price??'0'}})
                                        </a>
                                    </li>
                                </ul>

                        </div>
                        <div class="col-md-2">
                            <a class="btn btn-success pull-right" href="javascript:window.history.back();">
                                <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back
                            </a>
                        </div>
                    @endif
                @endif
                <div class="col-md-12">
                        <div class="tab-content mt-2">
                            <div class="tab-pane active" id="measurementContent" role="tabpanel" aria-labelledby="measurementTab">
                    <div class="upper_box">
                        <h3>Roof Estimation Calculator</h3>
                        <div class="forms_button_container">
                            @if(auth()->user()->can('add-roofestimatecalculator'))
                                @if(!isset($lead->roofEstimateCalculator))
                                    <button class="btn btn-success pull-right clear_fields">Clear</button>
                                @endif
                                {{--                            <button class="btn btn-success pull-right add_value">Add Base Value</button>--}}
                            @endif
                            <div class="lead_back_btn">
                                <a class="btn secondary_btn" href="{{ url('view_lead/' . $lead->id) }}"><i class="icon-arrow-left-circle" aria-hidden="true"></i> Back To Lead</a>
                            </div>
                        </div>
                    </div>
                    <form class="" action="{{ route('store_roof_estimation_calculator') }}" method="post" id="measurement_form">
                        {{--                        <form class="" action="{{ route('store_product_pricing_estimation_calculator') }}" method="post">--}}
                        @csrf
                        <input class="d_clear" type="hidden" name="lead_id" value="{{$lead->id??"0"}}">
                        <input class="d_clear" type="hidden" name="roof_estimate_calculator_id" @if(isset($lead->roofEstimateCalculator->id) && $lead->roofEstimateCalculator->id) value="{{$lead->roofEstimateCalculator->id??"0"}}" @else value="0" @endif >
                        <input class="d_clear" type="hidden" name="product_pricing_calculator_id" @if(isset($lead->roofEstimateCalculator->id) && $lead->roofEstimateCalculator->id) value="{{$lead->roofEstimateCalculator->id??"0"}}" @else value="0" @endif >

                        <div class="row">
                            <div class="col-lg-12">
                                @if(isset($lead->roofEstimateCalculator) && isset($lead->roofEstimateCalculator->roofEstimateCalculatorLabels))
                                    {{--  labels starts--}}
                                    <table class="table table-bordered">
                                        <tr>
                                            <td colspan="3">Customer Name:</td>
                                            <td colspan="">{{$lead->lead_number??"000"}}</td>
                                            <td colspan="2" class="no-border">{{$lead->title??""}}</td>
                                            <td colspan="">Date:</td>
                                            <td colspan="3" class="green">{{$lead->lead_date??"000"}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><input class="form-control" type="text" id="home_style" required name="labels[home_style][name]" readonly value="{{@$lead->roofEstimateCalculator->roofEstimateCalculatorLabels->where('section','home_style')->first()->name??'Home Style'}}" ></td>
                                            <td colspan=""><input class="form-control" type="text" min="0" id="home_style_value" name="labels[home_style][value]" value="{{@$lead->roofEstimateCalculator->roofEstimateCalculatorLabels->where('section','home_style')->first()->value??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif></td>
                                            <td><input class="form-control" type="text" id="stories" required name="labels[stories][name]" readonly value="{{@$lead->roofEstimateCalculator->roofEstimateCalculatorLabels->where('section','stories')->first()->name??'Stories'}}"></td>
                                            <td colspan="" class="green"><input class="form-control" type="number" min="0" id="stories_value" name="labels[stories][value]" value="{{@$lead->roofEstimateCalculator->roofEstimateCalculatorLabels->where('section','stories')->first()->value??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif></td>
                                            <td><input class="form-control" type="text" id="layers" required name="labels[layers][name]" readonly value="{{@$lead->roofEstimateCalculator->roofEstimateCalculatorLabels->where('section','layers')->first()->name??'Layers'}}"></td>
                                            <td class="green" colspan="3"><input class="form-control" type="number" min="0" id="layers_value" name="labels[layers][value]" value="{{@$lead->roofEstimateCalculator->roofEstimateCalculatorLabels->where('section','layers')->first()->value??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><input required class="form-control" type="text" id="chimneySizes" readonly name="labels[chimney_sizes][name]" value="Chimney Sizes"></td>
                                            <td colspan="2" class="green"><input class="form-control" type="number" min="0" id="chimney_sizes" name="labels[chimney_sizes][value]" value="{{@$lead->roofEstimateCalculator->roofEstimateCalculatorLabels->where('section','chimney_sizes')->first()->value??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif></td>
                                            <td colspan="2"><input class="form-control" type="text" id="pitch" required readonly name="labels[pitch][name]" value="Pitch"></td>
                                            <td colspan="3" class="green"><input class="form-control" type="number" min="0" id="pitch" step="0.01" name="labels[pitch][value]"value="{{@$lead->roofEstimateCalculator->roofEstimateCalculatorLabels->where('section','pitch')->first()->value??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif></td>
                                        </tr>
                                        <tr>
                                            <td><input class="form-control" type="text" id="pipe_boots" required readonly name="labels[pipe_boots][name]" value="Pipe Boots"></td>
                                            <td class="green"><input class="form-control" type="number" min="0" id="pipe_boots_value" name="labels[pipe_boots][value]" value="{{@$lead->roofEstimateCalculator->roofEstimateCalculatorLabels->where('section','pipe_boots')->first()->value??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif></td>
                                            <td><input class="form-control" type="text" id="bathroom_vent" readonly required name="labels[bathroom_vent][name]" value="Bathroom Vent"></td>
                                            <td class="no-border"><input class="form-control" type="number" id="bathroom_vent_value" min="0" name="labels[bathroom_vent][value]" value="{{@$lead->roofEstimateCalculator->roofEstimateCalculatorLabels->where('section','bathroom_vent')->first()->value??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif></td>
                                            {{--                                    <td><input class="form-control" type="text" id="skyLights" required name="labels[sky_light_one][name]" value="SkyLights"></td>--}}
                                            {{--                                    <td ><input class="form-control price-input" type="text" name="labels[size_three][name]"></td>--}}
                                            {{--                                    <td class="no-border"><input class="form-control" required type="number" id="skyLights_value" name="labels[sky_light_one][value]" value="{{@$lead->roofEstimateCalculator->roofEstimateCalculatorLabels->where('section','sky_light_one')->first()->value??'1'}}"></td>--}}
                                            {{--                                    <input type="hidden" name="labels[sky_light_two][name]" value="SkyLights">--}}
                                            {{--                                    <td class="no-border"><input class="form-control" required type="number" id="skyLights_value" name="labels[sky_light_two][value]" value="{{@$lead->roofEstimateCalculator->roofEstimateCalculatorLabels->where('section','sky_light_two')->first()->value??'1'}}"></td>--}}
                                            {{--                                    <input type="hidden" name="labels[sky_light_three][name]" value="SkyLights">--}}
                                            {{--                                    <td class="no-border"><input class="form-control" required type="number" id="skyLights_value" name="labels[sky_light_three][value]" value="{{@$lead->roofEstimateCalculator->roofEstimateCalculatorLabels->where('section','sky_light_three')->first()->value??'1'}}"></td>--}}
                                            {{--                                    <input type="hidden" name="labels[sky_light_four][name]" value="SkyLights">--}}
                                            {{--                                    <td class="no-border"><input class="form-control" required type="number" id="skyLights_value" name="labels[sky_light_four][value]" value="{{@$lead->roofEstimateCalculator->roofEstimateCalculatorLabels->where('section','sky_light_four')->first()->value??'1'}}"></td>--}}
                                            {{--                                    <input type="hidden" name="labels[sky_light_five][name]" value="SkyLights">--}}
                                            {{--                                    <td class="no-border"><input class="form-control" required type="number" id="skyLights_value" name="labels[sky_light_five][value]" value="{{@$lead->roofEstimateCalculator->roofEstimateCalculatorLabels->where('section','sky_light_five')->first()->value??'1'}}"></td>--}}
                                        </tr>
                                        <tr>
                                            <td><input class="form-control" type="text" id="sizes" required name="labels[sizes][name]" value="Sizes" readonly></td>
                                            <td class="green">
                                                {{--                                        <input class="form-control" type="number" required min="1" id="sizes_value" name="labels[size_one][value]" value="{{@$lead->roofEstimateCalculator->roofEstimateCalculatorLabels->where('section','size_one')->first()->value??'1'}}">--}}
                                                <select class="form-select" aria-label="Default select example" name="labels[sizes][value]">
                                                    <option selected value="4" {{ $lead->roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'sizes')->first()->value == '4' ? 'selected' : '' }} @if(!auth()->user()->can('edit-roofestimatecalculator')) disabled @endif>4</option>
                                                    <option value="3" {{ $lead->roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'sizes')->first()->value == '3' ? 'selected' : '' }} @if(!auth()->user()->can('edit-roofestimatecalculator')) disabled @endif>3</option>
                                                    <option value="2" {{ $lead->roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'sizes')->first()->value == '2' ? 'selected' : '' }} @if(!auth()->user()->can('edit-roofestimatecalculator')) disabled @endif>2</option>
                                                    <option value="1.5" {{ $lead->roofEstimateCalculator->roofEstimateCalculatorLabels->where('section', 'sizes')->first()->value == '1.5' ? 'selected' : '' }} @if(!auth()->user()->can('edit-roofestimatecalculator')) disabled @endif>1 1/2</option>
                                                </select>
                                            </td>
                                            <td><input class="form-control" type="text" id="sizes" required name="labels[plywood_size][name]" value="Sizes" readonly></td>
                                            <td class="green"><input class="form-control" type="number" min="0" id="sizes_value" name="labels[plywood_size][value]" value="{{@$lead->roofEstimateCalculator->roofEstimateCalculatorLabels->where('section','plywood_size')->first()->value??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif></td>
                                            {{--                                    <td><input class="form-control" type="text" id="sizes" required name="labels[size_three][name]" value="Sizes">--}}
                                            {{--                                        <button type="button"--}}
                                            {{--                                                class="btn btn-success borderRadius add_size_modal_btn"--}}
                                            {{--                                                data-toggle="modal"--}}
                                            {{--                                                data-target="#addSizeModal">Add Size--}}
                                            {{--                                        </button>--}}
                                            {{--                                    </td>--}}
                                            {{--                                    <td ><input class="form-control size-input" type="text" name="labels[size_three][name]"></td>--}}
                                            {{--                                    <td><input class="form-control size-input" type="text" name="labels[size_three][name]"></td>--}}
                                            {{--                                    <td ><input class="form-control price-input" type="text" name="labels[size_three][name]"></td>--}}
                                        </tr>
                                        <tr>
                                            <td colspan="3"><input class="form-control" type="text" id="plywood" required readonly name="labels[plywood][name]" value="{{@$lead->roofEstimateCalculator->roofEstimateCalculatorLabels->where('section','plywood')->first()->name??'Plywood'}}"></td>
                                            <td class="green"><input class="form-control" type="number" min="0" id="plywood_value" name="labels[plywood][value]" value="{{@$lead->roofEstimateCalculator->roofEstimateCalculatorLabels->where('section','plywood')->first()->value??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif></td>
                                            {{--                                                <td><input class="form-control" type="text" id="skylight_price" required name="labels[skylight_price][name]" value="Skylight Price"></td>--}}
                                            {{--                                                <td colspan="" class="no-border"><input class="form-control" type="number" required min="1" id="skylight_price_value" name="labels[skylight_price][value]" value="{{@$lead->roofEstimateCalculator->roofEstimateCalculatorLabels->where('section','skylight_price')->first()->value??'1'}}"></td>--}}
                                            <td><input class="form-control" type="text" id="flat_areas" required readonly name="labels[flat_area][name]" value="Flat Areas"></td>
                                            <td colspan="3" class="no-border"><input class="form-control" min="0" type="number" id="flat_areas" name="labels[flat_area][value]" value="{{$lead->roofEstimateCalculator->roofEstimateCalculatorLabels->where('section','flat_area')->first()->value??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif></td>
                                        </tr>

                                        <tr>
                                            <td>
                                                @if(auth()->user()->can('add-roofestimatecalculator'))
                                                    <button type="button"
                                                            class="btn btn_green borderRadius add_size_modal_btn"
                                                            data-toggle="modal"
                                                            data-target="#addSizeModal">Add Size
                                                    </button>
                                                @endif
                                            </td>
                                            {{--                                    <td >--}}
                                            {{--                                    </td>--}}
                                        </tr>

                                    </table>
                                    <table class="table table-bordered" id="sizePriceTableBody">
                                        <thead>
                                        <tr>
                                            <th>Skylight Size</th>
                                            <th>Skylight Quantity</th>
                                            <th>Skylight Price</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($lead->roofEstimateCalculator->roofEstimateCalculatorSkylight  ?? []  as $index => $skylight)
                                            <tr>
                                                <input type="hidden" class="form-control d_clear" name="skylight[size_{{ $index }}][product_id][]" value="{{ $skylight->product->id??"" }}">
                                                <td><input class="form-control" value="{{ $skylight->product->sub_category??"" }}"></td>
                                                <td><input class="form-control" name="skylight[size_{{ $index }}][quantity][]" value="{{ $skylight->quantity }}"></td>
                                                <td><input class="form-control" name="skylight[size_{{ $index }}][price][]" value="{{ $skylight->price }}"></td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            {{--                                                <td id="sizePriceTableBody">--}}
                                            {{--                                                </td>--}}
                                        </tr>
                                        </tbody>
                                    </table>
                                    {{--  labels ends--}}
                                @else
                                    {{--  labels starts--}}
                                    <table class="table table-bordered" id="sizePriceTableBody">
                                        <tr>
                                            <td colspan="3">Customer Name:</td>
                                            <td colspan="">{{$lead->lead_number??"000"}}</td>
                                            <td colspan="2" class="no-border">{{$lead->title??""}}</td>
                                            <td colspan="">Date:</td>
                                            <td colspan="3" class="green">{{$lead->lead_date??"000"}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><input class="form-control d_clear" type="text" id="home_style" required name="labels[home_style][name]" value="Home Style" readonly></td>
                                            <td colspan=""><input class="form-control" type="text" id="home_style_value" name="labels[home_style][value]" value="{{ $formData['labels']['home_style']['value'] ?? 0 }}" placeholder="Type Here"></td>
                                            <td><input class="form-control d_clear" type="text" id="stories" required name="labels[stories][name]" value="Stories" readonly></td>
                                            <td colspan="" class="green"><input class="form-control" type="number" min="0" id="stories_value" name="labels[stories][value]" value="{{ $formData['labels']['stories']['value'] ?? 0 }}"></td>
                                            <td><input class="form-control d_clear" type="text" id="layers" required name="labels[layers][name]" value="Layers" readonly></td>
                                            <td class="green" colspan="3"><input class="form-control" type="number" min="0" id="layers_value" name="labels[layers][value]" value="{{ $formData['labels']['layers']['value'] ?? 0 }}"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><input required class="form-control d_clear" type="text" id="chimneySizes" name="labels[chimney_sizes][name]" value="Chimney Sizes" readonly></td>
                                            <td colspan="2" class="green"><input class="form-control" type="number" min="0" id="chimney_sizes" name="labels[chimney_sizes][value]" value="{{ $formData['labels']['chimney_sizes']['value'] ?? 0 }}"></td>
                                            <td colspan="2"><input class="form-control d_clear" type="text" id="pitch" required name="labels[pitch][name]" value="Pitch" readonly></td>
                                            <td colspan="3" class="green"><input class="form-control" type="number" min="0" id="pitch" name="labels[pitch][value]" value="{{ $formData['labels']['pitch']['value'] ?? 0 }}"></td>
                                        </tr>
                                        <tr>
                                            <td><input class="form-control d_clear" type="text" id="pipe_boots" required name="labels[pipe_boots][name]" value="Pipe Boots" readonly></td>
                                            <td class="green"><input class="form-control" type="number" min="0" id="pipe_boots_value" name="labels[pipe_boots][value]" value="{{ $formData['labels']['pipe_boots']['value'] ?? 0 }}"></td>
                                            <td><input class="form-control d_clear" type="text" id="bathroom_vent" required name="labels[bathroom_vent][name]" value="Bathroom Vent" readonly></td>
                                            <td class="no-border"><input class="form-control" type="number" min="0" id="bathroom_vent_value" name="labels[bathroom_vent][value]" value="{{ $formData['labels']['bathroom_vent']['value'] ?? 0 }}"></td>
                                            {{--                                    <td><input class="form-control" type="text" id="skylights" required name="labels[sky_light_one][name]" value="Skylights"></td>--}}
                                            {{--                                    <td class="no-border"><input class="form-control" required type="number" id="skyLights_value" name="labels[sky_light_one][value]" value="1"></td>--}}
                                            {{--                                    <input class="form-control" type="hidden" id="sizes" required name="labels[sky_light_two][name]" value="Skylights">--}}
                                            {{--                                    <td colspan="" class="no-border"><input class="form-control" required type="number" id="skyLights_value" name="labels[sky_light_two][value]" value="1"></td>--}}

                                            {{--                                    <input class="form-control" type="hidden" id="sizes" required name="labels[sky_light_three][name]" value="Skylights">--}}
                                            {{--                                    <td colspan="" class="no-border"><input class="form-control" required type="number" id="skyLights_value" name="labels[sky_light_three][value]" value="1"></td>--}}

                                            {{--                                    <input class="form-control" type="hidden" id="sizes" required name="labels[sky_light_four][name]" value="Skylights">--}}
                                            {{--                                    <td colspan="" class="no-border"><input class="form-control" required type="number" id="skyLights_value" name="labels[sky_light_four][value]" value="1"></td>--}}

                                            {{--                                    <input class="form-control" type="hidden" id="sizes" required name="labels[sky_light_five][name]" value="Skylights">--}}
                                            {{--                                    <td colspan="" class="no-border"><input class="form-control" required type="number" id="skyLights_value" name="labels[sky_light_five][value]" value="1"></td>--}}
                                        </tr>
                                        <tr>
                                            <td><input class="form-control d_clear" type="text" id="sizes" required name="labels[sizes][name]" value="Sizes" readonly></td>
                                            <td class="green">
                                                <select class="form-select" aria-label="Default select example" name="labels[sizes][value]">
                                                    <option value="4" {{ isset($formData['labels']['sizes']['value']) && $formData['labels']['sizes']['value'] == 4 ? 'selected' : '' }}>4</option>
                                                    <option value="3" {{ isset($formData['labels']['sizes']['value']) && $formData['labels']['sizes']['value'] == 3 ? 'selected' : '' }}>3</option>
                                                    <option value="2" {{ isset($formData['labels']['sizes']['value']) && $formData['labels']['sizes']['value'] == 2 ? 'selected' : '' }}>2</option>
                                                    <option value="1.5" {{ isset($formData['labels']['sizes']['value']) && $formData['labels']['sizes']['value'] == '1.5' ? 'selected' : '' }}>1 1/2</option>
                                                </select>
                                            </td>
                                            <td><input class="form-control d_clear" type="text" id="sizes" required name="labels[plywood_size][name]" value="Sizes" readonly></td>
                                            <td class="green"><input class="form-control" type="number" min="0" id="sizes_value" name="labels[plywood_size][value]" value="{{ $formData['labels']['plywood_size']['value'] ?? 0 }}"></td>
                                            {{--                                    <td><input class="form-control" type="text" id="sizes" required name="labels[size_three][name]" value="Sizes"></td>--}}
                                            {{--                                    <td class="no-border">--}}
                                            {{--                                        <select class="form-select" aria-label="Default select example" name="labels[size_three][value]" >--}}
                                            {{--                                            <option selected value="C04 fixed">C04 fixed</option>--}}
                                            {{--                                            <option value="C04 Fixed With solar blind">C04 Fixed With solar blind</option>--}}
                                            {{--                                            <option value="C04 Manual Vented">C04 Manual Vented</option>--}}
                                            {{--                                            <option value="C04 Manual vented with solar blind">C04 Manual vented with solar blind</option>--}}
                                            {{--                                            <option value="C04 Solar Vented">C04 Solar Vented</option>--}}
                                            {{--                                            <option value="C04 Solar Vented with solar blind">C04 Solar Vented with solar blind</option>--}}
                                            {{--                                            <option value="0">0</option>--}}
                                            {{--                                        </select>--}}
                                            {{--                                    </td>--}}
                                            {{--                                    <input class="form-control" type="hidden" id="sizes" required name="labels[size_four][name]" value="Sizes">--}}
                                            {{--                                    <td colspan="" class="no-border">--}}
                                            {{--                                        <select class="form-select" aria-label="Default select example" name="labels[size_four][value]">--}}
                                            {{--                                            <option selected value="C04 fixed">C04 fixed</option>--}}
                                            {{--                                            <option value="C04 Fixed With solar blind">C04 Fixed With solar blind</option>--}}
                                            {{--                                            <option value="C04 Manual Vented">C04 Manual Vented</option>--}}
                                            {{--                                            <option value="C04 Manual vented with solar blind">C04 Manual vented with solar blind</option>--}}
                                            {{--                                            <option value="C04 Solar Vented">C04 Solar Vented</option>--}}
                                            {{--                                            <option value="C04 Solar Vented with solar blind">C04 Solar Vented with solar blind</option>--}}
                                            {{--                                            <option value="0">0</option>--}}
                                            {{--                                        </select>--}}
                                            {{--                                    </td>--}}
                                            {{--                                    <input class="form-control" type="hidden" id="sizes" required name="labels[size_five][name]" value="Sizes">--}}
                                            {{--                                    <td colspan="" class="no-border">--}}
                                            {{--                                        <select class="form-select" aria-label="Default select example" name="labels[size_five][value]">--}}
                                            {{--                                            <option selected value="C04 fixed">C04 fixed</option>--}}
                                            {{--                                            <option value="C04 Fixed With solar blind">C04 Fixed With solar blind</option>--}}
                                            {{--                                            <option value="C04 Manual Vented">C04 Manual Vented</option>--}}
                                            {{--                                            <option value="C04 Manual vented with solar blind">C04 Manual vented with solar blind</option>--}}
                                            {{--                                            <option value="C04 Solar Vented">C04 Solar Vented</option>--}}
                                            {{--                                            <option value="C04 Solar Vented with solar blind">C04 Solar Vented with solar blind</option>--}}
                                            {{--                                            <option value="0">0</option>--}}
                                            {{--                                        </select>--}}
                                            {{--                                    </td>--}}
                                            {{--                                    <input class="form-control" type="hidden" id="sizes" required name="labels[size_six][name]" value="Sizes">--}}
                                            {{--                                    <td colspan="" class="no-border">--}}
                                            {{--                                        <select class="form-select" aria-label="Default select example" name="labels[size_six][value]">--}}
                                            {{--                                            <option selected value="C04 fixed">C04 fixed</option>--}}
                                            {{--                                            <option value="C04 Fixed With solar blind">C04 Fixed With solar blind</option>--}}
                                            {{--                                            <option value="C04 Manual Vented">C04 Manual Vented</option>--}}
                                            {{--                                            <option value="C04 Manual vented with solar blind">C04 Manual vented with solar blind</option>--}}
                                            {{--                                            <option value="C04 Solar Vented">C04 Solar Vented</option>--}}
                                            {{--                                            <option value="C04 Solar Vented with solar blind">C04 Solar Vented with solar blind</option>--}}
                                            {{--                                            <option value="0">0</option>--}}
                                            {{--                                        </select>--}}
                                            {{--                                    </td>--}}
                                            {{--                                    <input class="form-control" type="hidden" id="sizes" required name="labels[size_seven][name]" value="Sizes">--}}
                                            {{--                                    <td colspan="" class="no-border">--}}
                                            {{--                                        <select class="form-select" aria-label="Default select example" name="labels[size_seven][value]">--}}
                                            {{--                                            <option selected value="C04 fixed">C04 fixed</option>--}}
                                            {{--                                            <option value="C04 Fixed With solar blind">C04 Fixed With solar blind</option>--}}
                                            {{--                                            <option value="C04 Manual Vented">C04 Manual Vented</option>--}}
                                            {{--                                            <option value="C04 Manual vented with solar blind">C04 Manual vented with solar blind</option>--}}
                                            {{--                                            <option value="C04 Solar Vented">C04 Solar Vented</option>--}}
                                            {{--                                            <option value="C04 Solar Vented with solar blind">C04 Solar Vented with solar blind</option>--}}
                                            {{--                                            <option value="0">0</option>--}}
                                            {{--                                        </select>--}}
                                            {{--                                    </td>--}}
                                        </tr>
                                        <tr>
                                            <td colspan="3"><input class="form-control d_clear" type="text" id="plywood" required name="labels[plywood][name]" value="Plywood" readonly></td>
                                            <td class="green"><input class="form-control" type="number" min="0" id="plywood_value" name="labels[plywood][value]" value="{{ $formData['labels']['plywood']['value'] ?? 0 }}"></td>
                                            {{--                                                <td><input class="form-control" type="text" id="skylight_price" required name="labels[skylight_price][name]" value="Skylight Price"></td>--}}
                                            {{--                                                <td colspan="" class="no-border"><input class="form-control" type="number" required min="1" id="skylight_price_value" name="labels[skylight_price][value]" value="1"></td>--}}
                                            <td><input class="form-control d_clear" type="text" id="flat_area" required name="labels[flat_area][name]" value="Flat Areas" readonly></td>
                                            <td colspan="3" class="no-border"><input class="form-control" min="0" type="number" id="flat_area" name="labels[flat_area][value]" value="{{ $formData['labels']['flat_area']['value'] ?? 0 }}"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <button type="button"
                                                        class="btn btn_green borderRadius add_size_modal_btn"
                                                        data-toggle="modal"
                                                        data-target="#addSizeModal">Add Skylight
                                                </button>
                                            </td>
                                            {{--                                                <td id="sizePriceTableBody">--}}
                                            {{--                                                </td>--}}
                                        </tr>
                                    </table>
                                @endif
                            </div>
                            <div class="col-lg-12">
                                @if(isset($lead->roofEstimateCalculator) && isset($lead->roofEstimateCalculator->roofEstimateCalculatorEaveRakes))
                                    {{--eave rakes starts--}}
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Letter</th>
                                            <th>Eave</th>
                                            <th></th>
                                            <th colspan="4">Rakes</th>
                                            <th></th>
                                            <th>Eave Final Rakes</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($lead->roofEstimateCalculator->roofEstimateCalculatorEaveRakes as $letter)
                                            <tr>
                                                <td>{{ $letter->section ?? ''}}</td>
                                                <td class="green"><input class="form-control eave" type="number" name="eave_rakes[{{$letter->section}}][eave][]" value="{{$letter->eave??'0'}}" min="0" step="0.01" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif></td>
                                                <td class="green">X</td>
                                                <td colspan="4" class="green"><input class="form-control rakes" type="number" name="eave_rakes[{{$letter->section}}][rakes][]" value="{{$letter->rakes??'0'}}" min="0" step="0.01" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif></td>
                                                <td class="green">X</td>
                                                <td class="green"><input class="form-control eave_final_rakes" type="number" name="eave_rakes[{{$letter->section}}][eave_final_rakes][]" value="{{$letter->eave_final_rakes??'0'}}" min="0" step="0.01" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif></td>
                                                <td class="green"><input class="form-control calculate-final-value-eave-rakes" type="number" name="eave_rakes[{{$letter->section}}][eave_final_rakes_total][]" readonly value="{{$letter->eave_final_rakes_total??'0'}}" min="0" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif></td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td>SUBTOTAL</td>
                                            <td></td>
                                            <td></td>
                                            <td colspan="4"></td>
                                            <td></td>
                                            <td></td>
                                            <td><input id="sub_total_eave_rakes" type="number" class="form-control" name="eave_rakes_sub_total" value="{{ $lead->roofEstimateCalculator->eave_rakes_sub_total }}" min="0" readonly ></td>
                                        </tr>
                                        <tr>
                                            <td>WASTE (%)</td>
                                            <td></td>
                                            <td colspan="4"></td>
                                            <td class="green"><input id="waste_eave_rakes" type="number" class="form-control" name="eave_rakes_waste" min="0" value="{{ $lead->roofEstimateCalculator->eave_rakes_waste }}" step="0.01" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif></td>
                                            <td></td>
                                            <td></td>
                                            <td class="green"><input id="sub_total_with_waste" type="number" class="form-control" name="eave_rakes_total_waste" min="0" value="{{ $lead->roofEstimateCalculator->eave_rakes_total_waste }}" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>SQFT</td>
                                            <td></td>
                                            <td></td>
                                            <td colspan="4"></td>
                                            <td></td>
                                            <td></td>
                                            <td class="no-border"> <input id="total_eave_rakes" type="number" class="form-control" name="eave_rakes_total" min="0" value="{{ $lead->roofEstimateCalculator->eave_rakes_total }}" readonly></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td colspan="4"></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="no-border"> <input id="divide_total_eave_rakes" type="number" class="form-control" name="eave_rakes_total_percent" value="{{ $lead->roofEstimateCalculator->eave_rakes_total_percent }}" min="0" readonly></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    {{--eave rakes ends--}}
                                @else
                                    {{--eave rakes starts--}}
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Letter</th>
                                            <th>Eave</th>
                                            <th></th>
                                            <th colspan="4">Rakes</th>
                                            <th></th>
                                            <th>Eave Final Rakes</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            function generateLetters($start, $end) {
                                                $letters = [];
                                                for ($i = ord($start); $i <= ord($end); $i++) {
                                                    $letters[] = chr($i);
                                                }
                                                return $letters;
                                            }

                                            $letters = generateLetters('A', 'O');
                                        @endphp
                                        @foreach ($letters as $letter)
                                            <tr>
                                                <td>{{ $letter }}</td>
                                                <td class="green"><input class="form-control eave" type="number" name="eave_rakes[{{$letter}}][eave][]" value="{{ $formData['eave_rakes'][$letter]['eave'][0] ?? 0 }}" min="0" step="0.01"></td>
                                                <td class="green">X</td>
                                                <td colspan="4" class="green"><input class="form-control rakes" type="number" name="eave_rakes[{{$letter}}][rakes][]" value="{{ $formData['eave_rakes'][$letter]['rakes'][0] ?? 0 }}" min="0" step="0.01"></td>
                                                <td class="green">X</td>
                                                <td class="green"><input class="form-control eave_final_rakes" type="number" name="eave_rakes[{{$letter}}][eave_final_rakes][]" value="{{ $formData['eave_rakes'][$letter]['eave_final_rakes'][0] ?? 0 }}" min="0" step="0.01"></td>
                                                <td class="green">
                                                    <input class="form-control calculate-final-value-eave-rakes"
                                                           type="number"
                                                           name="eave_rakes[{{$letter->section??''}}][eave_final_rakes_total][]"
                                                           readonly
                                                           value="{{ number_format($letter->eave_final_rakes_total ?? 0, 2, '.', ' ') }}"
                                                           min="0"
                                                           step="0.01"
                                                           @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td>SUBTOTAL</td>
                                            <td></td>
                                            <td></td>
                                            <td colspan="4"></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input id="sub_total_eave_rakes"
                                                       type="number"
                                                       class="form-control"
                                                       name="eave_rakes_sub_total"
                                                       min="0"
                                                       value="{{$formData['eave_rakes_sub_total'] ?? 0 }}"
                                                       readonly step="0.01">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>WASTE (%)</td>
                                            <td></td>
                                            <td colspan="4"></td>
                                            <td class="green"><input id="waste_eave_rakes" type="number" class="form-control" name="eave_rakes_waste" min="0" value="{{ $formData['eave_rakes_waste'] ?? 0 }}" step="0.01"></td>
                                            <td></td>
                                            <td></td>
                                            <td class="green"><input id="sub_total_with_waste" type="number" class="form-control" name="eave_rakes_total_waste" min="0" value="{{ $formData['eave_rakes_total_waste'] ?? 0 }}" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>SQFT</td>
                                            <td></td>
                                            <td></td>
                                            <td colspan="4"></td>
                                            <td></td>
                                            <td></td>
                                            <td class="no-border"> <input id="total_eave_rakes" type="number" class="form-control" name="eave_rakes_total" min="0" value="{{ $formData['eave_rakes_total'] ?? 0 }}" readonly></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td colspan="4"></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="no-border"> <input id="divide_total_eave_rakes" type="number" class="form-control" name="eave_rakes_total_percent" value="{{ $formData['eave_rakes_total_percent'] ?? 0 }}" min="0" readonly></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    {{--eave rakes ends--}}
                                @endif
                                <br>

                                @if(isset($lead->roofEstimateCalculator) && isset($lead->roofEstimateCalculator->roofEstimateCalculatorFlatArea))
                                    {{-- FLATAREA starts--}}
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Flat Areas</th>
                                            <th>Eaves</th>
                                            <th class="no-border"></th>
                                            <th >Rakes</th>
                                            <th class="no-border"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($lead->roofEstimateCalculator->roofEstimateCalculatorFlatArea as $letter)
                                            <tr>
                                                <td>{{ $letter->section??"" }}</td>
                                                <td class="green"><input class="form-control eave_flat_area" type="number" name="flat_area[{{ $letter->section }}][eave][]" value="{{$letter->eave??'0'}}" min="0" step="0.01" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif></td>
                                                <td class="green">X</td>
                                                <td class="green"><input class="form-control rakes_flat_area" type="number" name="flat_area[{{ $letter->section }}][rakes][]" value="{{$letter->rakes??'0'}}" min="0" step="0.01" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif></td>
                                                <td class="green"><input class="form-control calculate-final-value-flat-area" type="number" name="flat_area[{{ $letter->section }}][eave_rakes_total][]" readonly value="{{$letter->eave_rakes_total??'0'}}" min="0" step="0.01" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif></td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td>SUBTOTAL</td>
                                            <td colspan="2"></td>
                                            <td></td>
                                            <td><input id="sub_total_flat_area" type="number" class="form-control" name="eave_rakes_flat_area_sub_total" min="0" value="{{ $lead->roofEstimateCalculator->eave_rakes_flat_area_sub_total }}" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>WASTE (%)</td>
                                            <td colspan="2"></td>
                                            <td class="green"><input id="flat_waste_eave_rakes" type="number" class="form-control" name="eave_rakes_flat_area_waste" min="0" value="{{ $lead->roofEstimateCalculator->eave_rakes_flat_area_waste }}" step="0.01" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif></td>
                                            <td class="green"><input id="flat_sub_total_with_waste" type="number" class="form-control" name="eave_rakes_total_flat_area_waste" min="0" value="{{ $lead->roofEstimateCalculator->eave_rakes_total_flat_area_waste }}" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>TOTAL</td>
                                            <td colspan="2"></td>
                                            <td></td>
                                            <td class="no-border"> <input id="total_eave_flat_area" type="number" class="form-control" name="eave_rakes_flat_area_total" min="0" value="{{ $lead->roofEstimateCalculator->eave_rakes_flat_area_total }}" readonly></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    {{-- FLATAREA ends--}}
                                @else
                                    {{-- FLATAREA starts--}}
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Flat Areas</th>
                                            <th>Eaves</th>
                                            <th class="no-border"></th>
                                            <th >Rakes</th>
                                            <th class="no-border"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            function generateLettersFlatArea($start, $end) {
                                                $letters = [];
                                                for ($i = ord($start); $i <= ord($end); $i++) {
                                                    $letters[] = chr($i);
                                                }
                                                return $letters;
                                            }

                                            $letters = generateLettersFlatArea('A', 'O');
                                        @endphp
                                        @foreach ($letters as $letter)
                                            <tr>
                                                <td>{{ $letter }}</td>
                                                <td class="green"><input class="form-control eave_flat_area" type="number" name="flat_area[{{ $letter }}][eave][]" value="{{ $formData['flat_area'][$letter]['eave'][0] ?? 0 }}" min="0" step="0.01" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif></td>
                                                <td class="green">X</td>
                                                <td class="green"><input class="form-control rakes_flat_area" type="number" name="flat_area[{{ $letter }}][rakes][]" value="{{ $formData['flat_area'][$letter]['rakes'][0] ?? 0 }}" min="0" step="0.01" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif></td>
                                                <td class="green"><input class="form-control calculate-final-value-flat-area" type="number" name="flat_area[{{ $letter }}][eave_rakes_total][]" readonly value="0{{ $formData['flat_area'][$letter]['eave_rakes_total'][0] ?? 0 }}" min="0" step="0.01" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif></td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td>SUBTOTAL</td>
                                            <td colspan="2"></td>
                                            <td></td>
                                            <td><input id="sub_total_flat_area" type="number" class="form-control" name="eave_rakes_flat_area_sub_total" value="0" min="0" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>WASTE (%)</td>
                                            <td colspan="2"></td>
                                            <td class="green"><input id="flat_waste_eave_rakes" type="text" class="form-control" name="eave_rakes_flat_area_waste" min="0" value="{{ $formData['eave_rakes_flat_area_waste'] ?? 0 }}" step="0.01"></td>
                                            <td class="green"><input id="flat_sub_total_with_waste" type="text" class="form-control" name="eave_rakes_total_flat_area_waste" min="0" value="{{ $formData['eave_rakes_total_flat_area_waste'] ?? 0 }}" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>TOTAL</td>
                                            <td colspan="2"></td>
                                            <td></td>
                                            <td class="no-border"> <input id="total_eave_flat_area" type="number" class="form-control" name="eave_rakes_flat_area_total" min="0" value="{{ $formData['eave_rakes_flat_area_total'] ?? 0 }}" readonly></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    {{-- FLATAREA ends--}}
                                @endif
                                <br>
                                @if(isset($lead->roofEstimateCalculator) && isset($lead->roofEstimateCalculator->roofEstimateCalculatorDownspouts))
                                    {{-- guarders starts--}}
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Letters</th>
                                            <th>Gutters</th>
                                            <th>Downspouts</th>
                                            <th>G. Guards</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($lead->roofEstimateCalculator->roofEstimateCalculatorDownspouts as $index)
                                            <tr>
                                                <td></td>
                                                <td class="green"><input class="form-control gutters" type="number" name="downspouts[gutters][]" value="{{$index->gutters??''}}" min="0" step="0.01" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif></td>
                                                <td class="green"><input class="form-control downspouts" type="number" name="downspouts[downspouts][]" value="{{$index->downspouts??''}}" min="0" step="0.01" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif></td>
                                                <td class="green"><input class="form-control guards" type="number" name="downspouts[guards][]" value="{{$index->guards??''}}" min="0" step="0.01" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif></td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td>sub total</td>
                                            <td class="orange"> <input class="form-control" type="number" id="sub_total_gutters" name="gutter_sub_total" readonly @if(isset($lead->roofEstimateCalculator) && $lead->roofEstimateCalculator)  value="{{$lead->roofEstimateCalculator->gutter_sub_total??'0'}}" @else value="0" @endif min="0"></td>
                                            <td class="orange" ><input class="form-control" type="number" id="sub_total_downspouts" name="downspout_sub_total" readonly @if(isset($lead->roofEstimateCalculator) && $lead->roofEstimateCalculator)  value="{{$lead->roofEstimateCalculator->downspout_sub_total??'0'}}" @else value="0" @endif min="0"></td>
                                            <td class="orange"><input class="form-control" type="number" id="sub_total_guards" name="guards_sub_total" readonly @if(isset($lead->roofEstimateCalculator) && $lead->roofEstimateCalculator)  value="{{$lead->roofEstimateCalculator->guards_sub_total??'0'}}" @else value="0" @endif min="0"></td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td colspan="3" class="orange"><input class="form-control" type="number" id="total_all" name="total_all_downspouts" readonly @if(isset($lead->roofEstimateCalculator) && $lead->roofEstimateCalculator)  value="{{$lead->roofEstimateCalculator->total_all_downspouts??'0'}}" @else value="0" @endif min="0"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    {{-- guarders ends--}}
                                @else
                                    {{-- guarders starts--}}
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Letters</th>
                                            <th>Gutters</th>
                                            <th>Downspouts</th>
                                            <th>G. Guards</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach (range(0, 4) as $index)
                                            <tr>
                                                <td></td>
                                                <td class="green"><input class="form-control gutters" type="number" name="downspouts[gutters][]" value="{{ $formData['downspouts']['gutters'][$index] ?? 0 }}" min="0" step="0.01"></td>
                                                <td class="green"><input class="form-control downspouts" type="number" name="downspouts[downspouts][]" value="{{ $formData['downspouts']['downspouts'][$index] ?? 0 }}" min="0" step="0.01"></td>
                                                <td class="green"><input class="form-control guards" type="number" name="downspouts[guards][]" value="{{ $formData['downspouts']['guards'][$index] ?? 0 }}" min="0" step="0.01"></td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td>sub total</td>
                                            <td class="orange"> <input class="form-control" type="number" id="sub_total_gutters" name="gutter_sub_total" readonly value="{{ $formDat['gutter_sub_total'] ?? 0 }}" min="0"></td>
                                            <td class="orange" ><input class="form-control" type="number" id="sub_total_downspouts" name="downspout_sub_total" readonly value="{{ $formDat['downspout_sub_total'] ?? 0 }}" min="0"></td>
                                            <td class="orange"><input class="form-control" type="number" id="sub_total_guards" name="guards_sub_total" readonly value="{{ $formDat['guards_sub_total'] ?? 0 }}" min="0"></td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td colspan="3" class="orange"><input class="form-control" type="number" id="total_all" name="total_all_downspouts" readonly value="{{ $formDat['total_all_downspouts'] ?? 0 }}" min="0"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    {{-- guarders ends--}}
                                @endif
                                <br>
                                <table class="table table-bordered">
                                    {{--                                    <tr>--}}
                                    {{--                                        <td>Total SQ</td>--}}
                                    {{--                                        <td class="green"><input class="form-control" type="number" id="total_sq" name="total_sq" readonly @if(isset($lead->roofEstimateCalculator) && $lead->roofEstimateCalculator)  value="{{$lead->roofEstimateCalculator->total_sq??'0'}}" @else value="0" @endif min="0"></td>--}}
                                    {{--                                    </tr>--}}
                                    <tr>
                                        <td>Notes:</td>
                                        <td class="no-border"><input class="form-control" type="text" id="note" name="note" @if(isset($lead->roofEstimateCalculator) && $lead->roofEstimateCalculator)  value="{!!  $lead->roofEstimateCalculator->note??'' !!}"   @endif placeholder="Enter Any Notes" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif></td>
                                    </tr>
                                </table>
                                @if(auth()->user()->can('add-roofestimatecalculator'))
                                    <button type="submit" class="btn green_btn borderRadius btn-submit calculator_submit_btn">Submit</button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>

                            <div class="tab-pane" id="preferredContent" role="tabpanel" aria-labelledby="preferredTab">
                            </div>

                            <div class="tab-pane" id="systemContent" role="tabpanel" aria-labelledby="systemTab">
                            </div>

                            <div class="tab-pane" id="underFifteenContent" role="tabpanel" aria-labelledby="underFifteenTab">
                            </div>

                            <div class="tab-pane" id="guttersContent" role="tabpanel" aria-labelledby="guttersTab">
                            </div>

                            <div class="tab-pane" id="flatRoofContent" role="tabpanel" aria-labelledby="flatRoofTab">
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="addSizeModal" tabindex="-1" role="dialog" aria-labelledby="addSizeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSizeModalLabel">Add Size</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="sizeDescription">Product</label>
                        <select class="form-control  borderRadius custom_modal_select2" data-placeholder="Select Product" aria-label="Default select example" id="sizeSelection" name="labels[size_one][value]" required>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->sub_category ?? "" }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sizeQuantity">Skylight Quantity <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Quantity.." id="sizeQuantity" required>
                        <span class="req_error" style="color: red; display: none;"></span> <!-- Error message will appear here -->
                    </div>
                    <div class="form-group">
                        <label for="sizePrice">Skylight Price</label>
                        <input type="text" class="form-control calculatedPrice" placeholder="Enter Price.." id="sizePrice" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="secondary_btn btn" data-dismiss="modal">Close</button>
                    <button type="button" class="green_btn btn" id="addSize" data-dismiss="modal">Add</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('.clear_fields').click(function() {
                $('input').not('.d_clear, [name="_token"], [name="csrf-token"]').val('');
            });
            var price = 0;
            $('#sizeSelection').on('change', function() {
                var id = $(this).val();
                $.ajax({
                    url: "{{ url('get_calculator_price') }}",
                    type: 'GET',
                    data: { id: id },
                    success: function(response) {
                        console.log(response);
                        if (response && response.price) {
                            price = parseFloat(response.price);
                            $('#sizePrice').val(response.price);
                            console.log("Price fetched successfully:", response.price);
                        } else {
                            console.error("Price fetching failed: No price found in the response.");
                            alert("Price fetching failed: No price found.");
                            $('#sizePrice').val('');
                            price = 0;
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("An error occurred during fetching the price:", error);
                    }
                });
            });
            $('#sizeQuantity').on('input', function() {
                var quantity = $(this).val();
                var finalQuantity = quantity * price;
                if (!isNaN(finalQuantity) && finalQuantity >= 0) {
                    $('.calculatedPrice').val(finalQuantity.toFixed(2));
                } else {
                    $('.calculatedPrice').val('0.00');
                }
            });
        });
        // function calculateRowTotal(eave, rakes, finalRakes) {
        //     return eave * rakes * finalRakes;
        // }//ends calculateRowTotal
        // function updateTotals() {
        //     let subtotal = 0;
        //     $('table.table tbody tr').each(function() {
        //         const eave = parseFloat($(this).find('.eave').val()) || 0;
        //         const rakes = parseFloat($(this).find('.rakes').val()) || 0;
        //         const finalRakes = parseFloat($(this).find('.eave_final_rakes').val()) || 0;
        //         const rowTotal = calculateRowTotal(eave, rakes, finalRakes);
        //         $(this).find('.calculate-final-value-eave-rakes').val(rowTotal);
        //         subtotal += rowTotal;
        //     });
        //     $('#sub_total_eave_rakes').val(subtotal);
        //     const wastePercentage = parseFloat($('#waste_eave_rakes').val()) || 0;
        //     const total = subtotal * (1 + (wastePercentage / 100));
        //     $('#total_eave_rakes').val(total.toFixed(2));
        // }//ends updateTotals
        // $(document).on('input', '.eave, .rakes, .eave_final_rakes, #waste_eave_rakes', function() {
        //     updateTotals();
        //     calculateTotalSQ()
        // });
        // $(document).ready(function() {
        //     updateTotals();
        //     updateTotalsFlatArea();
        //     updateTotalsGuttersSection();
        // });
        // function calculateRowTotalFlatArea(eave, rakes) {
        //     return eave * rakes;
        // }//ends calculateRowTotalFlatArea
        // function updateTotalsFlatArea() {
        //     let subtotal = 0;
        //     $('table.table tbody tr').each(function() {
        //         const eave = parseFloat($(this).find('.eave_flat_area').val()) || 0;
        //         const rakes = parseFloat($(this).find('.rakes_flat_area').val()) || 0;
        //         const rowTotal = calculateRowTotalFlatArea(eave, rakes);
        //         $(this).find('.calculate-final-value-flat-area').val(rowTotal);
        //         subtotal += rowTotal;
        //     });
        //     $('#sub_total_flat_area').val(subtotal);
        //     const wastePercentage = parseFloat($('#waste_eave_flat_area').val()) || 0;
        //     const total = subtotal * (1 + (wastePercentage / 100));
        //     $('#total_eave_flat_area').val(total.toFixed(2));
        // }//ends updateTotalsFlatArea
        // $(document).on('input', '.eave_flat_area, .rakes_flat_area, #waste_eave_flat_area', function() {
        //     updateTotalsFlatArea();
        //     calculateTotalSQ()
        // });
        // function updateTotalsGuttersSection() {
        //     let subTotalGutters = 0;
        //     let subTotalDownspouts = 0;
        //     let subTotalGuards = 0;
        //     $('table.table tbody tr').each(function() {
        //         const gutters = parseFloat($(this).find('.gutters').val()) || 0;
        //         const downspouts = parseFloat($(this).find('.downspouts').val()) || 0;
        //         const guards = parseFloat($(this).find('.guards').val()) || 0;
        //         subTotalGutters += gutters;
        //         subTotalDownspouts += downspouts;
        //         subTotalGuards += guards;
        //     });
        //     $('#sub_total_gutters').val(subTotalGutters);
        //     $('#sub_total_downspouts').val(subTotalDownspouts);
        //     $('#sub_total_guards').val(subTotalGuards);
        //     const totalAll = subTotalGutters + subTotalDownspouts + subTotalGuards;
        //     $('#total_all').val(totalAll);
        // }//ends updateTotalsGuttersSection
        // $(document).on('input', '.gutters, .downspouts, .guards', function() {
        //     updateTotalsGuttersSection();
        //     calculateTotalSQ()
        // });
        // function calculateTotalSQ() {
        //     var total_eave_rakes =  $('#total_eave_rakes').val() / 100;
        //     $('#total_sq').val(total_eave_rakes.toFixed(2));
        // }//ends calculateTotalSQ

        $(document).ready(function() {
            var rowCounter = 1;
            $('#addSize').on('click', function() {
                var size = $('#sizeSelection option:selected').text();
                var product = $('#sizeSelection option:selected').val();
                console.log(size);
                var quantity = $('#sizeQuantity').val();
                var price = $('#sizePrice').val();
                if (quantity.trim() === '') {
                    $('.req_error').text('Quantity is required').show(); // Show the error message
                    $('#sizeQuantity').focus();
                    return;
                }
                $('.req_error').hide();
                var newRow = `<tr>
                        <input type="hidden" class="form-control size-input d_clear" type="text" name="skylight[size_${rowCounter}][product_id][]" value="${product}" readonly>
                        <td><input class="form-control size-input" type="text" value="${size}" readonly></td>
                        <td><input class="form-control size-quantity" type="text" name="skylight[size_${rowCounter}][quantity][]" value="${quantity}" readonly></td>
                        <td><input class="form-control price-input" type="text" name="skylight[size_${rowCounter}][price][]" value="${price}" readonly></td>
                    </tr>`;
                $('#sizePriceTableBody').append(newRow);
                rowCounter++;
                $('#addSizeModal').hide('modal');
                resetFields();
            });

            function resetFields() {
                $('#sizeSelection').prop('selectedIndex', 0); // Reset the dropdown to the first option
                $('#sizeQuantity').val(''); // Clear the quantity field
                $('#sizePrice').val(''); // Clear the price field
            }
        });

        function calculateRowTotal(eave, rakes, finalRakes) {
            return eave * rakes * finalRakes;
        }//ends calculateRowTotal
        function updateTotals() {
            let subtotal = 0;
            $('table.table tbody tr').each(function() {
                const eave = parseFloat($(this).find('.eave').val()) || 0;
                const rakes = parseFloat($(this).find('.rakes').val()) || 0;
                const finalRakes = parseFloat($(this).find('.eave_final_rakes').val()) || 0;
                const rowTotal = calculateRowTotal(eave, rakes, finalRakes);
                $(this).find('.calculate-final-value-eave-rakes').val(rowTotal);
                subtotal += rowTotal;
            });
            $('#sub_total_eave_rakes').val(subtotal);
            const wastePercentage = parseFloat($('#waste_eave_rakes').val()) || 0;
            const total = subtotal * (1 + (wastePercentage / 100));
            $('#total_eave_rakes').val(total.toFixed(2));
        }//ends updateTotals

        $(document).on('input', '.eave, .rakes, .eave_final_rakes, #waste_eave_rakes,#divide_total_eave_rakes', function() {
            updateTotals();
            calculateTotalSQ()
            flatWastePercent()
            eaveRakesTotalPercent()
        });
        $(document).ready(function() {
            updateTotals();
            updateTotalsFlatArea();
            updateTotalsGuttersSection();
        });
        function calculateRowTotalFlatArea(eave, rakes) {
            return eave * rakes;
        }//ends calculateRowTotalFlatArea
        function updateTotalsFlatArea() {
            let subtotal = 0;
            $('table.table tbody tr').each(function() {
                const eave = parseFloat($(this).find('.eave_flat_area').val()) || 0;
                const rakes = parseFloat($(this).find('.rakes_flat_area').val()) || 0;
                const rowTotal = calculateRowTotalFlatArea(eave, rakes);
                $(this).find('.calculate-final-value-flat-area').val(rowTotal);
                subtotal += rowTotal;
            });
            $('#sub_total_flat_area').val(subtotal);
            // const wastePercentage = parseFloat($('#waste_eave_flat_area').val()) || 0;
            // const total = subtotal * (1 + (wastePercentage / 100));
            // $('#total_eave_flat_area').val(total.toFixed(2));
        }//ends updateTotalsFlatArea
        $(document).on('input', '.eave_flat_area, .rakes_flat_area, #waste_eave_flat_area,#waste_eave_rakes,#sub_total_eave_rakes,#flat_waste_eave_rakes,#sub_total_flat_area,#flat_sub_total_with_waste', function() {
            updateTotalsFlatArea();
            calculateTotalSQ()
            flatWastePercent()
            eaveRakesWastePercent()
            flatEaveRakesTotalPercent()
        });
        function updateTotalsGuttersSection() {
            let subTotalGutters = 0;
            let subTotalDownspouts = 0;
            let subTotalGuards = 0;
            $('table.table tbody tr').each(function() {
                const gutters = parseFloat($(this).find('.gutters').val()) || 0;
                const downspouts = parseFloat($(this).find('.downspouts').val()) || 0;
                const guards = parseFloat($(this).find('.guards').val()) || 0;
                subTotalGutters += gutters;
                subTotalDownspouts += downspouts;
                subTotalGuards += guards;
            });
            $('#sub_total_gutters').val(subTotalGutters);
            $('#sub_total_downspouts').val(subTotalDownspouts);
            $('#sub_total_guards').val(subTotalGuards);
            const totalAll = subTotalGutters + subTotalDownspouts + subTotalGuards;
            $('#total_all').val(totalAll);
        }//ends updateTotalsGuttersSection
        $(document).on('input', '.gutters, .downspouts, .guards', function() {
            updateTotalsGuttersSection();
            calculateTotalSQ()
            flatWastePercent()
        });
        function calculateTotalSQ() {
            var total_eave_rakes =  $('#total_eave_rakes').val() / 100;
            $('#total_sq').val(total_eave_rakes.toFixed(2));
        }//ends calculateTotalSQ
        function flatWastePercent(){
            var wasteVal = parseFloat($('#waste_eave_rakes').val()) || 0;
            var eaveRakesVal = parseFloat($('#sub_total_eave_rakes').val()) || 0;
            var totalVal = (eaveRakesVal * wasteVal) / 100;
            $('#sub_total_with_waste').val(totalVal.toFixed(2));
        }
        function eaveRakesWastePercent(){
            var subTotalVal = parseFloat($('#sub_total_flat_area').val()) || 0;
            var subWasteVal = parseFloat($('#flat_waste_eave_rakes').val()) || 0;
            var totalValans = (subTotalVal * subWasteVal) / 100;
            $('#flat_sub_total_with_waste').val(totalValans.toFixed(2));
        }
        function eaveRakesTotalPercent(){
            var totalValper = parseFloat($('#total_eave_rakes').val()) || 0;
            var AnswerVal = (totalValper) / 100;
            $('#divide_total_eave_rakes').val(AnswerVal.toFixed(2));
        }
        function flatEaveRakesTotalPercent(){
            var valValue1 = parseFloat($('#sub_total_flat_area').val()) || 0;
            var valValue2 = parseFloat($('#flat_sub_total_with_waste').val()) || 0;
            var AnswerVal3 = valValue1 + valValue2;
            $('#total_eave_flat_area').val(AnswerVal3.toFixed(2));
        }
        flatWastePercent();
        eaveRakesTotalPercent();
        eaveRakesWastePercent();
        flatEaveRakesTotalPercent();
        $(document).ready(function () {
            $(document).on('click', '.add_value', function () {
                $.ajax({
                    url: '{{url("get_roof_base_value")}}',
                    type: 'GET',
                    success: function (response) {
                        if (response.roof) {
                            let roofData;
                            try {
                                roofData = JSON.parse(response.roof);
                            } catch (error) {
                                console.error("Failed to parse roof JSON:", error);
                                return;
                            }
                            // Populate "labels" fields
                            // if (roofData.labels) {
                            //     for (const [key, value] of Object.entries(roofData.labels)) {
                            //         $(`input[name='labels[${key}][name]']`).val(value.name);
                            //         $(`input[name='labels[${key}][value]']`).val(value.value);
                            //     }
                            // }
                            if (roofData.labels) {
                                for (const [key, value] of Object.entries(roofData.labels)) {
                                    $(`[name='labels[${key}][name]']`).val(value.name);
                                    $(`[name='labels[${key}][value]']`).each(function () {
                                        if ($(this).is('select')) {
                                            $(this).val(value.value); // Set dropdown selected value
                                        } else {
                                            $(this).val(value.value); // Set input value
                                        }
                                    });
                                }
                            }
                            // Populate "eave_rakes" fields
                            if (roofData.eave_rakes) {
                                for (const [letter, values] of Object.entries(roofData.eave_rakes)) {
                                    if (values.eave) {
                                        $(`input[name='eave_rakes[${letter}][eave][]']`).val(values.eave[0]);
                                    }
                                    if (values.rakes) {
                                        $(`input[name='eave_rakes[${letter}][rakes][]']`).val(values.rakes[0]);
                                    }
                                    if (values.eave_final_rakes) {
                                        $(`input[name='eave_rakes[${letter}][eave_final_rakes][]']`).val(values.eave_final_rakes[0]);
                                    }
                                    if (values.eave_final_rakes_total) {
                                        $(`input[name='eave_rakes[${letter}][eave_final_rakes_total][]']`).val(values.eave_final_rakes_total[0]);
                                    }
                                }
                            }
                            // Populate "flat_area" fields
                            if (roofData.flat_area) {
                                for (const [letter, values] of Object.entries(roofData.flat_area)) {
                                    if (values.eave) {
                                        $(`input[name='flat_area[${letter}][eave][]']`).val(values.eave[0]);
                                    }
                                    if (values.rakes) {
                                        $(`input[name='flat_area[${letter}][rakes][]']`).val(values.rakes[0]);
                                    }
                                    if (values.eave_rakes_total) {
                                        $(`input[name='flat_area[${letter}][eave_rakes_total][]']`).val(values.eave_rakes_total[0]);
                                    }
                                }
                            }
                            // Populate "downspouts" fields
                            if (roofData.downspouts) {
                                roofData.downspouts.gutters?.forEach((value, index) => {
                                    $(`input[name='downspouts[gutters][]']`).eq(index).val(value);
                                });
                                roofData.downspouts.downspouts?.forEach((value, index) => {
                                    $(`input[name='downspouts[downspouts][]']`).eq(index).val(value);
                                });
                                roofData.downspouts.guards?.forEach((value, index) => {
                                    $(`input[name='downspouts[guards][]']`).eq(index).val(value);
                                });
                            }
                            // Populate totals and calculated fields
                            if (roofData.eave_rakes_sub_total) {
                                $('#sub_total_eave_rakes').val(roofData.eave_rakes_sub_total);
                            }
                            if (roofData.eave_rakes_waste) {
                                $('#waste_eave_rakes').val(roofData.eave_rakes_waste);
                            }
                            if (roofData.eave_rakes_total_waste) {
                                $('#sub_total_with_waste').val(roofData.eave_rakes_total_waste);
                            }
                            if (roofData.eave_rakes_total) {
                                $('#total_eave_rakes').val(roofData.eave_rakes_total);
                            }
                            if (roofData.eave_rakes_flat_area_sub_total) {
                                $('#sub_total_flat_area').val(roofData.eave_rakes_flat_area_sub_total);
                            }
                            if (roofData.eave_rakes_flat_area_total) {
                                $('#total_eave_flat_area').val(roofData.eave_rakes_flat_area_total);
                            }
                            if (roofData.gutter_sub_total) {
                                $('#sub_total_gutters').val(roofData.gutter_sub_total);
                            }
                            if (roofData.downspout_sub_total) {
                                $('#sub_total_downspouts').val(roofData.downspout_sub_total);
                            }
                            if (roofData.guards_sub_total) {
                                $('#sub_total_guards').val(roofData.guards_sub_total);
                            }
                            if (roofData.total_all_downspouts) {
                                $('#total_all').val(roofData.total_all_downspouts);
                            }
                            if (roofData.total_all_downspouts) {
                                $('#flat_waste_eave_rakes').val(roofData.eave_rakes_flat_area_waste);
                            }
                            if (roofData.total_all_downspouts) {
                                $('#flat_sub_total_with_waste').val(roofData.eave_rakes_total_flat_area_waste);
                            }
                            if (roofData.total_all_downspouts) {
                                $('#divide_total_eave_rakes').val(roofData.eave_rakes_total_percent);
                            }
                        } else {
                            console.error("Roof key is not present in the response.");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error loading roof base value:", error);
                    }
                });
            });
        });

        $(window).load(function (){
            @if(isset($lead->roofEstimateCalculator->id) && $lead->roofEstimateCalculator->id)
            $.ajax({
                url: '{{url("get_roof_content_preferred")}}',
                type: 'GET',
                data:{
                    lead_id: {{$lead->id??''}},
                    roof_estimate_calculator_id: {{$lead->roofEstimateCalculator->id??'null'}}
                },
                success: function (response) {
                    if (response) {
                        $('#preferredContent').html(response);
                        // console.log('Received Data:', response)

                    } else {
                        console.error("Roof key is not present in the response.");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error loading roof base value:", error);
                }
            });

            $.ajax({
                url: '{{url("get_roof_content_system")}}',
                type: 'GET',
                data:{
                    lead_id: {{$lead->id??''}},
                    roof_estimate_calculator_id: {{$lead->roofEstimateCalculator->id??'null'}}
                },
                success: function (response) {
                    if (response) {
                        $('#systemContent').html(response);
                        // console.log('Received Data:', response)

                    } else {
                        console.error("Roof key is not present in the response.");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error loading roof base value:", error);
                }
            });

            $.ajax({
                url: '{{url("get_roof_content_under_15_sq")}}',
                type: 'GET',
                data:{
                    lead_id: {{$lead->id??''}},
                    roof_estimate_calculator_id: {{$lead->roofEstimateCalculator->id??'null'}}
                },
                success: function (response) {
                    if (response) {
                        $('#underFifteenContent').html(response);
                        // console.log('Received Data:', response)

                    } else {
                        console.error("Roof key is not present in the response.");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error loading roof base value:", error);
                }
            });

            $.ajax({
                url: '{{url("get_roof_content_gutter")}}',
                type: 'GET',
                data:{
                    lead_id: {{$lead->id??''}},
                    roof_estimate_calculator_id: {{$lead->roofEstimateCalculator->id??'null'}}
                },
                success: function (response) {
                    if (response) {
                        $('#guttersContent').html(response);
                        // console.log('Received Data:', response)

                    } else {
                        console.error("Roof key is not present in the response.");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error loading roof base value:", error);
                }
            });

            $.ajax({
                url: '{{url("get_roof_content_flat_roof")}}',
                type: 'GET',
                data:{
                    lead_id: {{$lead->id??''}},
                    roof_estimate_calculator_id: {{$lead->roofEstimateCalculator->id??'null'}}
                },
                success: function (response) {
                    if (response) {
                        $('#flatRoofContent').html(response);
                        // console.log('Received Data:', response)

                    } else {
                        console.error("Roof key is not present in the response.");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error loading roof base value:", error);
                }
            });
            @endif
        });
    </script>
@endpush
