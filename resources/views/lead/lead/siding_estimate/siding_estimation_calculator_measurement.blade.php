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
        .tab-content .tab-pane.show {
            opacity: 1;
        }
    </style>
@endpush


@section('content')
    <section class="tabs_sec">
        <div class="container-fluid">
            {{--        <div class="row">--}}
            <div class="white-box">
                <ul class="nav nav-tabs" id="chimneyTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="measurementTab" data-bs-toggle="tab" href="#measurementContent" role="tab" aria-controls="measurementContent" aria-selected="true">Measurement</a>
                    </li>
                    @if(isset($lead->sidingEstimateCalculator) && $lead->sidingEstimateCalculator)
{{--                        @if(auth()->user()->hasRole('user') || auth()->user()->hasRole('staff'))--}}
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="chimneyTab" data-bs-toggle="tab" href="#replacementContent" role="tab" aria-controls="replacementContent" aria-selected="false">Replacement ( <span id="replacement_recommended_price_global"></span> )</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="linerTab" data-bs-toggle="tab" href="#overExistingContent" role="tab" aria-controls="overExistingContent" aria-selected="false">Over Existing ( <span id="over_recommended_price_global"></span> )</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="linerTab" data-bs-toggle="tab" href="#gutterContent" role="tab" aria-controls="gutterContent" aria-selected="false">Gutter ( <span id="gutter_recommended_price_global"></span> ) ( <span id="gutter_recommended_price2_global"></span> )</a>
                            </li>

{{--                        @else--}}
{{--                            <li class="nav-item" role="presentation">--}}
{{--                                <a class="nav-link " id="replacementTab" data-bs-toggle="tab" href="#replacementContent" role="tab" aria-controls="replacementContent" aria-selected="false">Replacement</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item" role="presentation">--}}
{{--                                <a class="nav-link" id="overExistingTab" data-bs-toggle="tab" href="#overExistingContent" role="tab" aria-controls="overExistingContent" aria-selected="false">Over Existing</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item" role="presentation">--}}
{{--                                <a class="nav-link" id="gutterTab" data-bs-toggle="tab" href="#gutterContent" role="tab" aria-controls="gutterContent" aria-selected="false">Gutter</a>--}}
{{--                            </li>--}}
{{--                        @endif--}}
                    @endif
                </ul>
                {{--            @if(isset($lead->sidingEstimateCalculator) && $lead->sidingEstimateCalculator)--}}
                {{--                @if(auth()->user()->hasRole('user') || auth()->user()->hasRole('staff'))--}}
                {{--                    <div class="col-md-12">--}}
                {{--                        <div class="table_top_btn">--}}
                {{--                            <a href="{{url('siding_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->sidingEstimateCalculator->id}}/replacement" class="btn btn_green">Replacement ({{ $lead->sidingEstimateCalculator->sideEstimateCalculatorReplacement->recommended_price??"0" }})</a>--}}
                {{--                            <a href="{{url('siding_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->sidingEstimateCalculator->id}}/over_existing" class="btn btn_green">Over Existing ({{ $lead->sidingEstimateCalculator->storeSidingOverExisting->recommended_price??"0" }})</a>--}}
                {{--                            <a href="{{url('siding_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->sidingEstimateCalculator->id}}/gutters" class="btn btn_green">Gutter ({{ $lead->sidingEstimateCalculator->storeSidingEstimateCalculatorGutter->recommended_price??"0" }}) ({{ $lead->sidingEstimateCalculator->storeSidingEstimateCalculatorGutter->recommended_price_two??"0" }})</a>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                @else--}}
                {{--                    <div class="col-md-10">--}}
                {{--                        <div class="table_top_btn">--}}
                {{--                            <span class="btn btn_green">Replacement ({{ $lead->sidingEstimateCalculator->sideEstimateCalculatorReplacement->recommended_price??"0" }})</span>--}}
                {{--                            <span class="btn btn_green">Over Existing ({{ $lead->sidingEstimateCalculator->storeSidingOverExisting->recommended_price??"0" }})</span>--}}
                {{--                            <span class="btn btn_green">Gutter ({{ $lead->sidingEstimateCalculator->storeSidingEstimateCalculatorGutter->recommended_price??"0" }}) ({{ $lead->sidingEstimateCalculator->storeSidingEstimateCalculatorGutter->recommended_price_two??"0" }})</span>--}}
                {{--                            <a href="{{url('siding_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->sidingEstimateCalculator->id}}/replacement" class="btn btn_green">Replacement ({{ $lead->sidingEstimateCalculator->sideEstimateCalculatorReplacement->recommended_price??"0" }})</a>--}}
                {{--                            <a href="{{url('siding_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->sidingEstimateCalculator->id}}/over_existing" class="btn btn_green">Over Existing ({{ $lead->sidingEstimateCalculator->storeSidingOverExisting->recommended_price??"0" }})</a>--}}
                {{--                            <a href="{{url('siding_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->sidingEstimateCalculator->id}}/gutters" class="btn btn_green">Gutter ({{ $lead->sidingEstimateCalculator->storeSidingEstimateCalculatorGutter->recommended_price??"0" }}) ({{ $lead->sidingEstimateCalculator->storeSidingEstimateCalculatorGutter->recommended_price_two??"0" }})</a>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    <div class="col-md-2">--}}
                {{--                        <a class="btn btn-success pull-right" href="javascript:window.history.back();">--}}
                {{--                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back--}}
                {{--                        </a>--}}
                {{--                    </div>--}}
                {{--                @endif--}}
                {{--            @endif--}}
                <div class="tab-content mt-2" id="chimneyTabsContent">
                    <div class="tab-pane fade show active" id="measurementContent" role="tabpanel" aria-labelledby="measurementTab">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="upper_box">
                                        <h3>Side Estimation Calculator</h3>
                                        <div class="forms_button_container">
                                            @if(auth()->user()->can('add-sidingestimatecalculator'))
                                                @if(!isset($lead->sidingEstimateCalculator))
                                                    <button class="btn btn-success pull-right clear_fields">Clear</button>
                                                @endif
                                                {{--                                            <button class="btn btn-success pull-right add_base_value">Add Base Value</button>--}}
                                            @endif
                                            <div class="lead_back_btn">
                                                <a class="btn secondary_btn" href="{{ url('view_lead/' . $lead->id) }}"><i class="icon-arrow-left-circle" aria-hidden="true"></i> Back To Lead</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <form class="" action="{{ route('store_siding_estimation_calculator') }}" method="post">
                                        @csrf
                                        <input class="d_clear" type="hidden" name="lead_id" value="{{$lead->id??"0"}}">
                                        <input class="d_clear" type="hidden" name="siding_estimate_calculator_id" @if(isset($lead->sidingEstimateCalculator->id) && $lead->sidingEstimateCalculator->id) value="{{$lead->sidingEstimateCalculator->id??"0"}}" @else value="0" @endif >

                                        @if(isset($lead->sidingEstimateCalculator) && isset($lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels))
                                            {{--  labels starts--}}
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td>Lead Name:</td>
                                                    <td colspan="">{{$lead->lead_number??"000"}}</td>
                                                    <td colspan="2" class="no-border">{{$lead->title??""}}</td>
                                                    <td colspan="">Date:</td>
                                                    <td colspan="3" class="green">{!! \Carbon\Carbon::parse($lead->lead_date ?? '')->format('m-d-Y') ?? "000" !!}</td>
                                                </tr>
                                                <tr>
                                                    <td><input class="form-control" type="text" id="home_style" required name="labels[home_style][name]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','home_style')->first()->name??'Home Style'}}" readonly></td>
                                                    <td colspan=""><input class="form-control" type="text" id="home_style_value" name="labels[home_style][value]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','home_style')->first()->value??''}}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                                    <td><input class="form-control" type="text" id="stories" name="labels[stories][name]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','stories')->first()->name??'Stories'}}" readonly></td>
                                                    <td colspan="" class="green"><input class="form-control" type="number" min="0" id="stories_value" name="labels[stories][value]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','stories')->first()->value??'0'}}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                                    <td><input class="form-control" type="text" id="layers" name="labels[layers][name]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','layers')->first()->name??'Layers'}}" readonly></td>
                                                    <td class="green" colspan="3"><input class="form-control" type="number" min="0" id="layers_value" name="labels[layers][value]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','layers')->first()->value??'0'}}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                                </tr>
                                                <tr>
                                                    <td><input class="form-control" type="text" id="windows" name="labels[windows][name]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','windows')->first()->name??'Windows'}}" readonly></td>
                                                    <td class="green"><input class="form-control" type="number" min="0" id="windows_value" name="labels[windows][value]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','windows')->first()->value??'0'}}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                                    <td><input class="form-control" type="text" id="lights" name="labels[lights][name]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','lights')->first()->name??'Lights'}}" readonly></td>
                                                    <td class="green"><input class="form-control" type="number" min="0" id="lights_value" name="labels[lights][value]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','lights')->first()->value??'0'}}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                                    <td><input class="form-control" type="text" id="soffit_overhang" name="labels[soffit_overhang][name]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','soffit_overhang')->first()->name??'Soffit Overhang'}}" readonly></td>
                                                    <td colspan="" class="green"><input class="form-control" type="number" min="0" id="soffit_overhang_value" name="labels[soffit_overhang][value]"value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','soffit_overhang')->first()->value??'0'}}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                                    <td><input class="form-control" type="text" id="facia_inches" name="labels[facia_inches][name]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','facia_inches')->first()->name??'Facia Inches'}}" readonly></td>
                                                    <td colspan="" class="green"><input class="form-control" type="number" min="0" id="facia_inches_value" name="labels[facia_inches][value]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','facia_inches')->first()->value??'0'}}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                                </tr>
                                                <tr>
                                                    <td><input class="form-control" type="text" id="doors" name="labels[doors][name]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','doors')->first()->name??'Doors'}}" readonly></td>
                                                    <td class="green"><input class="form-control" type="number" min="0" id="doors_value" name="labels[doors][value]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','doors')->first()->value??'0'}}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                                    <td><input class="form-control" type="text" id="outlets" name="labels[outlets][name]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','outlets')->first()->name??'Outlets'}}" readonly></td>
                                                    <td class="green"><input class="form-control" type="number" min="0" id="outlets_value" name="labels[outlets][value]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','outlets')->first()->value??'0'}}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                                    <td><input class="form-control" type="text" id="rakes_overhang" name="labels[rakes_overhang][name]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','rakes_overhang')->first()->name??'Rakes Overhang'}}" readonly></td>
                                                    <td colspan="" class="no-border"><input class="form-control" type="number" id="rakes_overhang_value" name="labels[rakes_overhang][value]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','rakes_overhang')->first()->value??'0'}}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                                    <td><input class="form-control" type="text" id="rakes_inches" name="labels[rakes_inches][name]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','rakes_inches')->first()->name??'Rakes Inches'}}" readonly></td>
                                                    <td colspan="" class="no-border"><input class="form-control" type="number" id="rakes_inches_value" name="labels[rakes_inches][value]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','rakes_inches')->first()->value??'0'}}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                                </tr>
                                                <tr>
                                                    <td><input class="form-control" type="text" id="plywood" name="labels[plywood][name]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','plywood')->first()->name??'Plywood'}}" readonly></td>
                                                    <td class="green"><input class="form-control" type="number" min="0" id="plywood_value" name="labels[plywood][value]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','plywood')->first()->value??'0'}}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                                    <td><input class="form-control" type="text" id="cover_porch" name="labels[cover_porch][name]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','cover_porch')->first()->name??'Cover Porch'}}" readonly></td>
                                                    <td colspan="" class="no-border"><input class="form-control" type="number" min="0" id="cover_porch_value" name="labels[cover_porch][value]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','cover_porch')->first()->value??'0'}}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                                    {{--                                <td colspan="2" class="no-border"></td>--}}
                                                    <td><input class="form-control" type="text" id="shatter" name="labels[shatter][name]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','shatter')->first()->name??'Shatter'}}" readonly></td>
                                                    <td colspan="" class="no-border"><input class="form-control" type="number" id="shatter_value" name="labels[shatter][value]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','shatter')->first()->value??'0'}}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>

                                                    <td><input class="form-control" type="text" id="azeck_wood" name="labels[azeck_wood][name]" value="Azeck/Wood" readonly></td>
                                                    <td colspan="" class="no-border">
                                                        <select class="form-control" name="labels[azeck_wood][value]" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif>
                                                            {{--                                                <option value="{{ $formData['labels']['azeck_base']['value'] ?? 0 }}" @if($formData['labels']['azeck_base']['value'] == $lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section', 'azeck_wood')->first()->value) selected @endif>Azeck</option>--}}
                                                            {{--                                                <option value="{{ $formData['labels']['wood_base']['value'] ?? 0 }}" @if($formData['labels']['wood_base']['value'] == $lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section', 'azeck_wood')->first()->value) selected @endif>Wood</option>--}}
                                                            <option value="{{ $sidingBaseValues['azeck'] ?? 0 }}"
                                                                    @if(isset($lead->sidingEstimateCalculator) &&
                                                                        isset($lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels) &&
                                                                        ($label = $lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section', 'azeck_wood')->first()) &&
                                                                        $sidingBaseValues['azeck'] == $label->value)
                                                                        selected
                                                                    @endif>
                                                                Azeck
                                                            </option>
                                                            <option value="{{ $sidingBaseValues['wood'] ?? 0 }}"
                                                                    @if(isset($lead->sidingEstimateCalculator) &&
                                                                        isset($lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels) &&
                                                                        ($label = $lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section', 'azeck_wood')->first()) &&
                                                                        $sidingBaseValues['wood'] == $label->value)
                                                                        selected
                                                                    @endif>
                                                                Wood
                                                            </option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><input class="form-control" type="text" id="gutter" name="labels[gutter][name]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','gutter')->first()->name??'Gutter'}}" readonly></td>
                                                    <td colspan="7" class="no-border"><input class="form-control" type="number" min="0" id="gutter_value" name="labels[gutter][value]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','gutter')->first()->value??'0'}}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                                </tr>
                                                {{--                                    <tr>--}}
                                                {{--                                        <td><input class="form-control " type="text" id="miscellaneous" name="labels[miscellaneous][name]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','miscellaneous')->first()->name??'Miscellaneous'}}" readonly></td>--}}
                                                {{--                                        <td colspan="7" class="no-border"><input class="form-control" type="number" min="0" id="gutter_value" name="labels[miscellaneous][value]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','miscellaneous')->first()->value??'0'}}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>--}}
                                                {{--                                    </tr>--}}
                                            </table>
                                            {{--  labels ends--}}
                                            <table class="table table-bordered">
                                                <tbody>
                                                <tr>
                                                    <td style="font-size: 24px; font-weight: bold; color: black;">Soffit</td>
                                                    <td class="orange">
                                                        <select id="soffit" class="form-control" name="soffit">
                                                            <option value="aluminum" {{ isset( $lead->sidingEstimateCalculator) &&  $lead->sidingEstimateCalculator->soffit == 'aluminum' ? 'selected' : '' }} @if(!auth()->user()->can('edit-sidingestimatecalculator')) disabled @endif>Aluminum</option>
                                                            <option value="azeck" {{ isset( $lead->sidingEstimateCalculator) &&  $lead->sidingEstimateCalculator->soffit == 'azeck' ? 'selected' : '' }} @if(!auth()->user()->can('edit-sidingestimatecalculator')) disabled @endif>Azeck</option>
                                                        </select>
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Eaves</td>
                                                    <td class="orange"> <input id="eaves_value_eave" type="number" class="form-control" name="soffit_eave" value="{{ $lead->sidingEstimateCalculator->soffit_eave??"" }}" step="0.01" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                                    <td class="orange"> <input id="eaves_with_soffit_overhang" type="number" class="form-control" name="soffit_eave_total" min="0" value="{{ $lead->sidingEstimateCalculator->soffit_eave_total??"" }}" readonly></td>
                                                    <td class="orange"> <input id="eaves_with_soffit_overhang_divide" type="number" class="form-control" name="soffit_eave_percent" min="0" value="{{ $lead->sidingEstimateCalculator->soffit_eave_percent??"" }}" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>Rakes</td>
                                                    <td class="orange"> <input id="rakes_value" type="number" class="form-control" name="soffit_rakes" value="{{ $lead->sidingEstimateCalculator->soffit_rakes??"" }}" min="0" step="0.01" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                                    <td class="orange"> <input id="rakes_with_rakes_overhang" type="number" class="form-control" name="soffit_rakes_total" value="{{ $lead->sidingEstimateCalculator->soffit_rakes_total??"" }}" min="0" readonly></td>
                                                    <td class="orange"> <input id="rakes_with_rakes_overhang_divide" type="number" class="form-control" name="soffit_rakes_percent" value="{{ $lead->sidingEstimateCalculator->soffit_rakes_percent??"" }}" min="0" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>Porch</td>
                                                    <td class="orange"> <input id="porch_value" type="number" class="form-control" name="soffit_porch" value="{{ $lead->sidingEstimateCalculator->soffit_porch??"" }}" min="0" step="0.01" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                                    <td class="orange"> <input id="porch_with_cover_porch" type="number" class="form-control" name="soffit_porch_total" value="{{ $lead->sidingEstimateCalculator->soffit_porch_total??"" }}" min="0" readonly></td>
                                                    <td class="orange"> <input id="porch_with_cover_porch_divide" type="number" class="form-control" name="soffit_porch_percent" value="{{ $lead->sidingEstimateCalculator->soffit_porch_percent??"" }}" min="0" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"></td>
                                                    <td class="orange"> <input id="total_sum_divide" type="number" class="form-control" name="soffit_total_sum" value="{{ $lead->sidingEstimateCalculator->soffit_total_sum??"" }}" min="0" readonly></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        @else
                                            {{--  labels starts--}}
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td>Lead Name:</td>
                                                    <td colspan="">{{$lead->lead_number??"000"}}</td>
                                                    <td colspan="2" class="no-border">{{$lead->title??""}}</td>
                                                    <td colspan="">Date:</td>
                                                    <td colspan="3" class="green">{!! \Carbon\Carbon::parse($lead->lead_date ?? '000')->format('m-d-Y') !!}</td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input class="form-control d_clear" type="text" id="home_style" required name="labels[home_style][name]" value="Home Style" readonly>
                                                    </td>
                                                    <td colspan=""><input class="form-control" type="text" id="home_style_value" name="labels[home_style][value]" placeholder="Type Here..." value="{{ $formData['labels']['home_style']['value'] ?? 0 }}"></td>
                                                    <td><input class="form-control d_clear" type="text" id="stories" name="labels[stories][name]" value="Stories" readonly></td>
                                                    <td colspan="" class="green"><input class="form-control" type="number" min="0" id="stories_value" name="labels[stories][value]" value="{{ $formData['labels']['stories']['value'] ?? 0 }}" ></td>
                                                    <td><input class="form-control d_clear" type="text" id="layers" name="labels[layers][name]" value="Layers" readonly></td>
                                                    <td colspan="3" class="green"><input class="form-control" type="number" min="0" id="layers_value" name="labels[layers][value]" value="{{ $formData['labels']['layers']['value'] ?? 0 }}" ></td>
                                                </tr>
                                                <tr>
                                                    <td><input class="form-control d_clear" type="text" id="windows" name="labels[windows][name]" value="Windows" readonly></td>
                                                    <td class="green"><input class="form-control" type="number" min="0" id="windows_value" name="labels[windows][value]" value="{{ $formData['labels']['windows']['value'] ?? 0 }}"></td>
                                                    <td><input class="form-control d_clear" type="text" id="lights" name="labels[lights][name]" value="Lights" readonly></td>
                                                    <td class="green"><input class="form-control" type="number" min="0" id="lights_value" name="labels[lights][value]" value="{{ $formData['labels']['lights']['value'] ?? 0 }}"></td>
                                                    <td><input class="form-control d_clear" type="text" id="soffit_overhang" name="labels[soffit_overhang][name]" value="Soffit Overhang" readonly></td>
                                                    <td colspan="" class="green"><input class="form-control" type="number" min="0" id="soffit_overhang_value" name="labels[soffit_overhang][value]" value="{{ $formData['labels']['soffit_overhang']['value'] ?? 0 }}"></td>
                                                    <td><input class="form-control d_clear" type="text" id="facia_inches" name="labels[facia_inches][name]" value="Facia Inches" readonly></td>
                                                    <td colspan="" class="green"><input class="form-control" type="number" min="0" id="facia_inches_value" name="labels[facia_inches][value]" value="{{ $formData['labels']['facia_inches']['value'] ?? 0 }}" ></td>
                                                </tr>
                                                <tr>
                                                    <td><input class="form-control d_clear" type="text" id="doors" name="labels[doors][name]" value="Doors" readonly></td>
                                                    <td class="green"><input class="form-control" type="number" min="0" id="doors_value" name="labels[doors][value]" value="{{ $formData['labels']['doors']['value'] ?? 0 }}" ></td>
                                                    <td><input class="form-control d_clear" type="text" id="outlets" name="labels[outlets][name]" value="Outlets" readonly></td>
                                                    <td class="green"><input class="form-control" type="number" min="0" id="outlets_value" name="labels[outlets][value]" value="{{ $formData['labels']['outlets']['value'] ?? 0 }}"></td>
                                                    <td><input class="form-control d_clear" type="text" id="rakes_overhang" name="labels[rakes_overhang][name]" value="Rakes Overhang" readonly></td>
                                                    <td colspan="" class="no-border"><input class="form-control" type="number" id="rakes_overhang_value" name="labels[rakes_overhang][value]" value="{{ $formData['labels']['rakes_overhang']['value'] ?? 0 }}"></td>
                                                    <td><input class="form-control d_clear" type="text" id="rakes_inches" name="labels[rakes_inches][name]" value="Rake Inches" readonly></td>
                                                    <td colspan="" class="no-border"><input class="form-control" type="number" id="rakes_inches_value" name="labels[rakes_inches][value]" value="{{ $formData['labels']['rakes_inches']['value'] ?? 0 }}"></td>
                                                </tr>
                                                <tr>
                                                    <td><input class="form-control d_clear" type="text" id="plywood" name="labels[plywood][name]" value="Plywood" readonly></td>
                                                    <td class="green"><input class="form-control" type="number" min="0" id="plywood_value" name="labels[plywood][value]" value="{{ $formData['labels']['plywood']['value'] ?? 0 }}"></td>
                                                    <td><input class="form-control d_clear" type="text" id="cover_porch" name="labels[cover_porch][name]" value="Cover Porch" readonly></td>
                                                    <td colspan="" class="no-border"><input class="form-control" type="number" min="0" id="cover_porch_value" name="labels[cover_porch][value]" value="{{ $formData['labels']['cover_porch']['value'] ?? 0 }}"></td>
                                                    <td><input class="form-control d_clear" type="text" id="shatter" name="labels[shatter][name]" value="Shatters" readonly></td>
                                                    <td colspan="" class="no-border"><input class="form-control" type="number" min="0" id="shatter_value" name="labels[shatter][value]" value="{{ $formData['labels']['shatter']['value'] ?? 0 }}" ></td>
                                                    <td><input class="form-control" type="text" id="azeck_wood" name="labels[azeck_wood][name]" value="Azeck/Wood" readonly></td>
                                                    <td colspan="" class="no-border">
                                                        <select class="form-control" name="labels[azeck_wood][value]" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif>
                                                            <option value="{{ $sidingBaseValues['azeck'] ?? 0 }}">Azeck</option>
                                                            <option value="{{ $sidingBaseValues['wood'] ?? 0 }}">Wood</option>
                                                        </select>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><input class="form-control d_clear" type="text" id="gutter" name="labels[gutter][name]" value="Gutters" readonly></td>
                                                    <td colspan="7" class="no-border"><input class="form-control" type="number" min="0" id="gutter_value" name="labels[gutter][value]" value="{{ $formData['labels']['gutter']['value'] ?? 0 }}"></td>

                                                </tr>
                                                {{--                                    <tr>--}}
                                                {{--                                        <td><input class="form-control d_clear" type="text" id="miscellaneous" name="labels[miscellaneous][name]" value="Miscellaneous" readonly></td>--}}
                                                {{--                                        <td colspan="7" class="no-border"><input class="form-control" type="number" min="0" id="miscellaneous" name="labels[miscellaneous][value]" value="{{ $formData['labels']['miscellaneous']['value'] ?? 0 }}"></td>--}}
                                                {{--                                    </tr>--}}
                                            </table>
                                            <table class="table table-bordered">
                                                <tbody>
                                                <tr>
                                                    <td style="font-size: 24px; font-weight: bold; color: black;">Soffit</td>
                                                    <td class="orange">
                                                        <select id="soffit" class="form-control" name="soffit">
                                                            <option value="aluminum" {{ ($formData['soffit'] ?? '') == 'aluminum' ? 'selected' : '' }}>Aluminum</option>
                                                            <option value="azeck"    {{ ($formData['soffit'] ?? '') == 'azeck' ? 'selected' : '' }}>Azeck</option>
                                                        </select>
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Eaves</td>
                                                    <td class="orange"> <input id="eaves_value_eave" type="number" class="form-control" name="soffit_eave" value="{{ $formData['soffit_eave'] ?? 0 }}" min="0" step="0.01"></td>
                                                    <td class="orange"> <input id="eaves_with_soffit_overhang" type="number" class="form-control" name="soffit_eave_total" min="0" value="{{ $formData['soffit_eave_total'] ?? 0 }}" readonly></td>
                                                    <td class="orange"> <input id="eaves_with_soffit_overhang_divide" type="number" class="form-control" name="soffit_eave_percent" min="0" value="{{ $formData['soffit_eave_percent'] ?? 0 }}" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>Rakes</td>
                                                    <td class="orange"> <input id="rakes_value" type="number" class="form-control" name="soffit_rakes" value="{{ $formData['soffit_rakes'] ?? 0 }}" min="0" step="0.01"></td>
                                                    <td class="orange"> <input id="rakes_with_rakes_overhang" type="number" class="form-control" name="soffit_rakes_total" value="{{ $formData['soffit_rakes_total'] ?? 0 }}" min="0" readonly></td>
                                                    <td class="orange"> <input id="rakes_with_rakes_overhang_divide" type="number" class="form-control" name="soffit_rakes_percent" value="{{ $formData['soffit_rakes_percent'] ?? 0 }}" min="0" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>Porch</td>
                                                    <td class="orange"> <input id="porch_value" type="number" class="form-control" name="soffit_porch" value="{{ $formData['soffit_porch'] ?? 0 }}" min="0" step="0.01"></td>
                                                    <td class="orange"> <input id="porch_with_cover_porch" type="number" class="form-control" name="soffit_porch_total" value="{{ $formData['soffit_porch_total'] ?? 0 }}" min="0" readonly></td>
                                                    <td class="orange"> <input id="porch_with_cover_porch_divide" type="number" class="form-control" name="soffit_porch_percent" value="{{ $formData['soffit_porch_percent'] ?? 0 }}" min="0" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"></td>
                                                    <td class="orange"> <input id="total_sum_divide" type="number" class="form-control" name="soffit_total_sum" value="{{ $formData['soffit_total_sum'] ?? 0 }}" min="0" readonly></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        @endif
                                        <br>



                                        @if(isset($lead->sidingEstimateCalculator) && isset($lead->sidingEstimateCalculator->sidingEstimateCalculatorEaveRakes))
                                            {{--eave rakes starts--}}
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Letter</th>
                                                    <th>Eave</th>
                                                    <th></th>
                                                    <th colspan="">Rakes</th>
                                                    <th></th>
                                                    <th>Eave Final Rakes</th>
                                                    <th>Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($lead->sidingEstimateCalculator->sidingEstimateCalculatorEaveRakes as $letter)
                                                    <tr>
                                                        <td>{{ $letter->section ?? ''}}</td>
                                                        <td class="green"><input class="form-control eave" type="number" name="eave_rakes[{{$letter->section}}][eave][]" value="{{$letter->eave??'0'}}" min="0" step="0.01" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                                        <td class="green">X</td>
                                                        <td colspan="" class="green"><input class="form-control rakes" type="number" name="eave_rakes[{{$letter->section}}][rakes][]" value="{{$letter->rakes??'0'}}" min="0" step="0.01" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                                        <td class="green">X</td>
                                                        <td class="green"><input class="form-control eave_final_rakes" type="number" name="eave_rakes[{{$letter->section}}][eave_final_rakes][]" value="{{$letter->eave_final_rakes??'0'}}" min="0" step="0.01" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                                        <td class="green"><input class="form-control calculate-final-value-eave-rakes" type="number" name="eave_rakes[{{$letter->section}}][eave_final_rakes_total][]" readonly value="{{$letter->eave_final_rakes_total??'0'}}" min="0"></td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="3">SUBTOTAL</td>
                                                    <td colspan="3"></td>
                                                    <td><input id="sub_total_eave_rakes" type="number" class="form-control" name="eave_rakes_subtotal" min="0" value="{{$lead->sidingEstimateCalculator->eave_rakes_subtotal??'0'}}" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">WASTE (%)</td>
                                                    <td class="green"><input id="waste_eave_rakes" type="number" class="form-control" name="waste_eave_rakes" min="0" step="0.01" value="{{$lead->sidingEstimateCalculator->waste_eave_rakes??'10'}}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                                    <td colspan="2"></td>
                                                    <td class="green"><input id="sub_total_with_waste" type="number" class="form-control" name="waste_percent_eave_rakes" min="0" value="{{$lead->sidingEstimateCalculator->waste_percent_eave_rakes??'0'}}" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6">TOTAL</td>
                                                    <td class="no-border"> <input id="total_eave_rakes" type="number" class="form-control" name="eave_rakes_total" min="0" value="{{$lead->sidingEstimateCalculator->eave_rakes_total??'0'}}"  readonly></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6"></td>
                                                    <td class="no-border"> <input id="divide_total_eave_rakes" type="number" class="form-control" name="eave_rakes_total_percent" value="{{$lead->sidingEstimateCalculator->eave_rakes_total_percent??'0'}}" min="0" readonly></td>
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
                                                        <td class="green"><input class="form-control eave" type="number" name="eave_rakes[{{$letter}}][eave][]"  value="{{ $formData['eave_rakes'][$letter]['eave'][0] ?? 0 }}" min="0" step="0.01"></td>
                                                        <td class="green">X</td>
                                                        <td colspan="4" class="green"><input class="form-control rakes" type="number" name="eave_rakes[{{$letter}}][rakes][]" value="{{ $formData['eave_rakes'][$letter]['rakes'][0] ?? 0 }}" min="0" step="0.01"></td>
                                                        <td class="green">X</td>
                                                        <td class="green"><input class="form-control eave_final_rakes" type="number" name="eave_rakes[{{$letter}}][eave_final_rakes][]"  value="{{ $formData['eave_rakes'][$letter]['eave_final_rakes'][0] ?? 0 }}" min="0" step="0.01"></td>
                                                        <td class="green"><input class="form-control calculate-final-value-eave-rakes" type="number" name="eave_rakes[{{$letter}}][eave_final_rakes_total][]" readonly  value="{{ $formData['eave_rakes'][$letter]['eave_final_rakes_total'][0] ?? 0 }}" min="0"></td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="3">SUBTOTAL</td>
                                                    <td colspan="3"></td>
                                                    <td><input id="sub_total_eave_rakes" type="number" class="form-control" name="eave_rakes_subtotal" min="0"  value="{{ $formData['eave_rakes_subtotal'] ?? 0 }}" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">WASTE (%)</td>
                                                    <td class="green"><input id="waste_eave_rakes" type="number" class="form-control" name="waste_eave_rakes" min="0" step="0.01" value="{{ $formData['waste_eave_rakes'] ?? 0 }}"></td>
                                                    <td colspan="2"></td>
                                                    <td class="green"><input id="sub_total_with_waste" type="number" class="form-control" name="waste_percent_eave_rakes" min="0" value="{{ $formData['waste_percent_eave_rakes'] ?? 0 }}" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6">TOTAL</td>
                                                    <td class="no-border"> <input id="total_eave_rakes" type="number" class="form-control" name="eave_rakes_total" min="0" value="{{ $formData['eave_rakes_total'] ?? 0 }}" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6"></td>
                                                    <td class="no-border"> <input id="divide_total_eave_rakes" type="number" class="form-control" name="eave_rakes_total_percent" value="{{ $formData['eave_rakes_total_percent'] ?? 0 }}" readonly></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            {{--eave rakes ends--}}
                                        @endif
                                        <br>
                                        @if(isset($lead->sidingEstimateCalculator) && isset($lead->sidingEstimateCalculator->sidingEstimateCalculatorGuttersDownspouts))

                                            {{-- guarders starts--}}
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Letter</th>
                                                    <th>Gutters</th>
                                                    <th>Downspouts</th>
                                                    <th>G. Guards</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    function generateLettersFlatArea($start, $end) {
                                                        return range($start, $end);
                                                    }
                                                    $letters = generateLettersFlatArea('A', 'I');
                                                @endphp
                                                @foreach ($lead->sidingEstimateCalculator->sidingEstimateCalculatorGuttersDownspouts as $index => $item)
                                                    <tr>
                                                        <td>{{ $letters[$index] }}</td>
                                                        <td class="green"><input class="form-control siding_gutters" type="number" name="downspouts[gutters][]" value="{{ $item->gutters ?? '' }}" min="0" step="0.01" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                                        <td class="green"><input class="form-control downspouts" type="number" name="downspouts[downspouts][]" value="{{ $item->downspouts ?? '' }}" min="0" step="0.01" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                                        <td class="green"><input class="form-control guards" type="number" name="downspouts[guards][]" value="{{ $item->guards ?? '' }}" min="0" step="0.01" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                                    </tr>
                                                    <div style="display: none;">
                                                        <input class="d_clear" type="hidden" name="downspouts[letters][]" value="{{ $letters[$index] }}">
                                                    </div>
                                                @endforeach
                                                <tr>
                                                    <td>TOTAL</td>
                                                    <td class="orange"> <input id="total_gutters" type="text" class="form-control" name="gutters_total" min="0" value="0" readonly></td>
                                                    <td class="orange"> <input id="total_downspouts" type="number" class="form-control" name="downspout_total" min="0" value="0" readonly></td>
                                                    <td class="orange"> <input id="total_guards" type="number" class="form-control" name="guards_total" min="0" value="0" readonly></td>

                                                </tr>
                                                <tr>
                                                    <td style="font-size: 24px; font-weight: bold; color: black;"></td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        @else
                                            {{-- FLATAREA starts--}}
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Letter</th>
                                                    <th>Gutters</th>
                                                    <th>G. Guards</th>
                                                    <th>Downspouts</th>
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
                                                    $letters = generateLettersFlatArea('A', 'I');
                                                @endphp
                                                @foreach ($letters as $index => $letter)
                                                    <tr>
                                                        <td>{{ $letter }}</td>
                                                        <td class="green">
                                                            <input class="form-control siding_gutters" type="number" name="downspouts[gutters][]" value="{{ $formData['downspouts']['gutters'][$index] ?? 0 }}" min="0" step="0.01">
                                                        </td>
                                                        <td class="green">
                                                            <input class="form-control downspouts" type="number" name="downspouts[downspouts][]" value="{{ $formData['downspouts']['downspouts'][$index] ?? 0 }}" min="0" step="0.01">
                                                        </td>
                                                        <td class="green">
                                                            <input class="form-control guards" type="number" name="downspouts[guards][]" value="{{ $formData['downspouts']['guards'][$index] ?? 0 }}" min="0" step="0.01">
                                                        </td>
                                                    </tr>
                                                    <input class="d_clear" type="hidden" name="downspouts[letters][]" value="{{ $letter }}">
                                                @endforeach

                                                <tr>
                                                    <td>TOTAL</td>
                                                    <td class="orange"> <input id="total_gutters" type="text" class="form-control" name="gutters_total" min="0" value="{{ $formData['gutters_total'] ?? 0 }}" readonly></td>
                                                    <td class="orange"> <input id="total_downspouts" type="text" class="form-control" name="downspout_total" min="0" value="{{ $formData['downspout_total'] ?? 0 }}" readonly></td>
                                                    <td class="orange"> <input id="total_guards" type="text" class="form-control" name="guards_total" min="0" value="{{ $formData['guards_total'] ?? 0 }}" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 24px; font-weight: bold; color: black;"></td>
                                                </tr>
{{--                                                <tr>--}}
{{--                                                    <td style="font-size: 24px; font-weight: bold; color: black;">Soffit</td>--}}
{{--                                                    <td class="orange">--}}
{{--                                                        <select id="soffit" class="form-control" name="soffit">--}}
{{--                                                            <option value="aluminum" {{ ($formData['soffit'] ?? '') == 'aluminum' ? 'selected' : '' }}>Aluminum</option>--}}
{{--                                                            <option value="azeck"    {{ ($formData['soffit'] ?? '') == 'azeck' ? 'selected' : '' }}>Azeck</option>--}}
{{--                                                        </select>--}}
{{--                                                    </td>--}}
{{--                                                    <td></td>--}}
{{--                                                    <td></td>--}}
{{--                                                </tr>--}}
{{--                                                <tr>--}}
{{--                                                    <td>Eaves</td>--}}
{{--                                                    <td class="orange"> <input id="eaves_value_eave" type="number" class="form-control" name="soffit_eave" value="{{ $formData['soffit_eave'] ?? 0 }}" min="0" step="0.01"></td>--}}
{{--                                                    <td class="orange"> <input id="eaves_with_soffit_overhang" type="number" class="form-control" name="soffit_eave_total" min="0" value="{{ $formData['soffit_eave_total'] ?? 0 }}" readonly></td>--}}
{{--                                                    <td class="orange"> <input id="eaves_with_soffit_overhang_divide" type="number" class="form-control" name="soffit_eave_percent" min="0" value="{{ $formData['soffit_eave_percent'] ?? 0 }}" readonly></td>--}}
{{--                                                </tr>--}}
{{--                                                <tr>--}}
{{--                                                    <td>Rakes</td>--}}
{{--                                                    <td class="orange"> <input id="rakes_value" type="number" class="form-control" name="soffit_rakes" value="{{ $formData['soffit_rakes'] ?? 0 }}" min="0" step="0.01"></td>--}}
{{--                                                    <td class="orange"> <input id="rakes_with_rakes_overhang" type="number" class="form-control" name="soffit_rakes_total" value="{{ $formData['soffit_rakes_total'] ?? 0 }}" min="0" readonly></td>--}}
{{--                                                    <td class="orange"> <input id="rakes_with_rakes_overhang_divide" type="number" class="form-control" name="soffit_rakes_percent" value="{{ $formData['soffit_rakes_percent'] ?? 0 }}" min="0" readonly></td>--}}
{{--                                                </tr>--}}
{{--                                                <tr>--}}
{{--                                                    <td>Porch</td>--}}
{{--                                                    <td class="orange"> <input id="porch_value" type="number" class="form-control" name="soffit_porch" value="{{ $formData['soffit_porch'] ?? 0 }}" min="0" step="0.01"></td>--}}
{{--                                                    <td class="orange"> <input id="porch_with_cover_porch" type="number" class="form-control" name="soffit_porch_total" value="{{ $formData['soffit_porch_total'] ?? 0 }}" min="0" readonly></td>--}}
{{--                                                    <td class="orange"> <input id="porch_with_cover_porch_divide" type="number" class="form-control" name="soffit_porch_percent" value="{{ $formData['soffit_porch_percent'] ?? 0 }}" min="0" readonly></td>--}}
{{--                                                </tr>--}}
{{--                                                <tr>--}}
{{--                                                    <td colspan="3"></td>--}}
{{--                                                    <td class="orange"> <input id="total_sum_divide" type="number" class="form-control" name="soffit_total_sum" value="{{ $formData['soffit_total_sum'] ?? 0 }}" min="0" readonly></td>--}}
{{--                                                </tr>--}}
                                                </tbody>
                                            </table>
                                            {{-- FLATAREA ends--}}
                                        @endif
                                        <br>
                                        <table class="table table-bordered">
                                            {{--                        <tr>--}}
                                            {{--                            <td>Total SQ</td>--}}
                                            {{--                            <td class="green"><input class="form-control" type="number" id="total_sq" name="total_sq" readonly @if(isset($lead->roofEstimateCalculator) && $lead->roofEstimateCalculator)  value="{{$lead->roofEstimateCalculator->total_sq??'0'}}" @else value="0" @endif min="0"></td>--}}
                                            {{--                        </tr>--}}
                                            <tr>
                                                <td>NOTE:</td>
                                                <td class="no-border"><input class="form-control" type="text" id="note" name="note" @if(isset($lead->sidingEstimateCalculator) && $lead->sidingEstimateCalculator)  value="{!!  $lead->sidingEstimateCalculator->note??'' !!}"   @endif placeholder="Enter Any Notes" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                            </tr>
                                        </table>
                                        @if(auth()->user()->can('add-sidingestimatecalculator'))
                                            <button type="submit" class="green_btn borderRadius btn-submit btn">Submit</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade " id="replacementContent" role="tabpanel" aria-labelledby="replacementTab">
                        <div id="replacement_data"></div>
                    </div>
                    <div class="tab-pane fade" id="overExistingContent" role="tabpanel" aria-labelledby="overExistingTab">
                        <div id="over_existing_data"></div>
                    </div>
                    <div class="tab-pane fade" id="gutterContent" role="tabpanel" aria-labelledby="gutterTab">
                        <div id="gutter_data"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('js')
    <script>
        $(document).ready(function(){
            $('.clear_fields').click(function() {
                $('input').not('.d_clear, [name="_token"], [name="csrf-token"]').val('');
            });
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
            // $('#total_eave_rakes').val(total.toFixed(2));
        }//ends updateTotals
        $(document).on('input', '.eave, .rakes, .eave_final_rakes, #waste_eave_rakes', function() {
            updateTotals();
            calculateTotalSQ()
            calculateSubtotalWithWaste()
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
            const wastePercentage = parseFloat($('#waste_eave_flat_area').val()) || 0;
            const total = subtotal * (1 + (wastePercentage / 100));
            $('#total_eave_flat_area').val(total.toFixed(2));
        }//ends updateTotalsFlatArea
        $(document).on('input', '.eave_flat_area, .rakes_flat_area, #waste_eave_flat_area', function() {
            updateTotalsFlatArea();
            calculateTotalSQ()
        });
        function updateTotalsGuttersSection() {
            let subTotalGutters = 0;
            let subTotalDownspouts = 0;
            let subTotalGuards = 0;
            $('table.table tbody tr').each(function() {
                const gutters = parseFloat($(this).find('.siding_gutters').val()) || 0;
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
        $(document).on('input', '.siding_gutters, .downspouts, .guards', function() {
            updateTotalsGuttersSection();
            calculateTotalSQ();
        });
        function calculateTotalSQ() {
            var total_eave_rakes =  $('#total_eave_rakes').val() / 100;
            $('#total_sq').val(total_eave_rakes.toFixed(2));
        }//ends calculateTotalSQ
        function calculateSubtotalWithWaste() {
            var subTotal = parseFloat($('#sub_total_eave_rakes').val()) || 0;
            var waste = parseFloat($('#waste_eave_rakes').val()) || 0;
            var result = (subTotal * waste) / 100;
            $('#sub_total_with_waste').val(result);
            var updatedWasteTotal = parseFloat($('#sub_total_with_waste').val()) || 0;
            var sumtotal = subTotal + updatedWasteTotal;
            var roundedTotal = Math.round(sumtotal);
            $('#total_eave_rakes').val(roundedTotal);
            var sumtotaldivide = (subTotal + updatedWasteTotal) / 100;
            var roundedDivideTotal = Math.round(sumtotaldivide);
            $('#divide_total_eave_rakes').val(roundedDivideTotal);
        }
        $('#waste_eave_rakes').on('input', calculateSubtotalWithWaste);
        // $('#waste_eave_rakes').on('ready', calculateSubtotalWithWaste);
        $('#sub_total_eave_rakes').on('input', calculateSubtotalWithWaste);
        $(document).ready(function() {
            // Function to calculate totals
            function calculateTotals() {
                var totalGutters = 0;
                var totalDownspouts = 0;
                var totalGuards = 0;

                // Iterate over each row in the tbody
                $('tbody tr').each(function() {
                    // Get the values from the input fields, defaulting to 0 if empty
                    var gutterVal = parseFloat($(this).find('.siding_gutters').val()) || 0;
                    var downspoutVal = parseFloat($(this).find('.downspouts').val()) || 0;
                    var guardVal = parseFloat($(this).find('.guards').val()) || 0;

                    // Accumulate the totals
                    totalGutters += gutterVal;
                    totalDownspouts += downspoutVal;
                    totalGuards += guardVal;
                });

                // Update the total fields with the calculated values
                $('#total_gutters').val(totalGutters.toFixed(2));
                $('#total_downspouts').val(totalDownspouts.toFixed(2));
                $('#total_guards').val(totalGuards.toFixed(2));
            }

            // Bind the calculateTotals function to the keyup event of the relevant input fields
            $('input.siding_gutters, input.downspouts, input.guards').on('keyup', function() {
                calculateTotals();
            });

            // Initial calculation to set the totals when the page loads
            calculateTotals();
        });

        $(document).ready(function() {
            function calculate() {
                var firstInputEaves = parseFloat($('#soffit_overhang_value').val());
                var secondInputEaves = parseFloat($('#eaves_value_eave').val());
                var firstInputRakes = parseFloat($('#rakes_overhang_value').val());
                var secondInputRakes = parseFloat($('#rakes_value').val());
                var firstInputPorch = parseFloat($('#cover_porch_value').val());
                var secondInputPorch = parseFloat($('#porch_value').val());
                var resultEaves = parseFloat((firstInputEaves * secondInputEaves) / 144);
                var resultRakes = parseFloat((firstInputRakes * secondInputRakes) / 144);
                var resultPorch = parseFloat((firstInputPorch * secondInputPorch) / 144);
                var totalResultEaves = parseFloat(resultEaves / 12);
                var totalResultRakes = parseFloat(resultRakes / 12);
                var totalResultPorch = parseFloat(resultPorch / 12);
                var sumResultTotal = parseFloat(totalResultEaves + totalResultRakes + totalResultPorch);
                $('#eaves_with_soffit_overhang').val(resultEaves.toFixed(10));
                $('#rakes_with_rakes_overhang').val(resultRakes.toFixed(10));
                $('#porch_with_cover_porch').val(resultPorch.toFixed(10));
                $('#eaves_with_soffit_overhang_divide').val(totalResultEaves.toFixed(1));
                $('#rakes_with_rakes_overhang_divide').val(totalResultRakes.toFixed(1));
                $('#porch_with_cover_porch_divide').val(totalResultPorch.toFixed(1));
                $('#total_sum_divide').val(sumResultTotal.toFixed(1));
            }
            // $('input').on('input', function() {
            //     calculate();
            //
            // });
            $('#soffit_overhang_value, #eaves_value_eave,#rakes_overhang_value, #rakes_value,#cover_porch_value, #porch_value').on('input', calculate);
            // calculate();
        });
        $(document).ready(function () {
            $(document).on('click', '.add_base_value', function () {
                $.ajax({
                    url: '/get_siding_base_value',
                    type: 'GET',
                    success: function (response) {
                        if (response.siding) {
                            let sidingData;
                            try {
                                sidingData = JSON.parse(response.siding);
                            } catch (error) {
                                console.error("Failed to parse siding JSON:", error);
                                return;
                            }

                            // Populate "labels" fields
                            if (sidingData.labels) {
                                for (const [key, value] of Object.entries(sidingData.labels)) {
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
                            if (sidingData.eave_rakes) {
                                for (const [letter, values] of Object.entries(sidingData.eave_rakes)) {
                                    $(`input[name='eave_rakes[${letter}][eave][]']`).val(values.eave[0] || 0);
                                    $(`input[name='eave_rakes[${letter}][rakes][]']`).val(values.rakes[0] || 0);
                                    $(`input[name='eave_rakes[${letter}][eave_final_rakes][]']`).val(values.eave_final_rakes[0] || 0);
                                    $(`input[name='eave_rakes[${letter}][eave_final_rakes_total][]']`).val(values.eave_final_rakes_total[0] || 0);
                                }
                            }

                            // Populate "flat_area" fields
                            if (sidingData.flat_area) {
                                for (const [letter, values] of Object.entries(sidingData.flat_area)) {
                                    $(`input[name='flat_area[${letter}][eave][]']`).val(values.eave[0] || 0);
                                    $(`input[name='flat_area[${letter}][rakes][]']`).val(values.rakes[0] || 0);
                                    $(`input[name='flat_area[${letter}][eave_rakes_total][]']`).val(values.eave_rakes_total[0] || 0);
                                }
                            }

                            // Populate "downspouts" fields
                            if (sidingData.downspouts) {
                                sidingData.downspouts.siding_gutters?.forEach((value, index) => {
                                    $(`input[name='downspouts[gutters][]']`).eq(index).val(value || 0);
                                });
                                sidingData.downspouts.downspouts?.forEach((value, index) => {
                                    $(`input[name='downspouts[downspouts][]']`).eq(index).val(value || 0);
                                });
                                sidingData.downspouts.guards?.forEach((value, index) => {
                                    $(`input[name='downspouts[guards][]']`).eq(index).val(value || 0);
                                });
                            }

                            // Populate total and calculated fields
                            $('#sub_total_eave_rakes').val(sidingData.eave_rakes_subtotal || 0);
                            $('#waste_eave_rakes').val(sidingData.waste_eave_rakes || 0);
                            $('#sub_total_with_waste').val(sidingData.waste_percent_eave_rakes || 0);
                            $('#total_eave_rakes').val(sidingData.eave_rakes_total || 0);
                            $('#sub_total_flat_area').val(sidingData.eave_rakes_flat_area_sub_total || 0);
                            $('#total_eave_flat_area').val(sidingData.eave_rakes_flat_area_total || 0);
                            $('#sub_total_gutters').val(sidingData.gutter_sub_total || 0);
                            $('#sub_total_downspouts').val(sidingData.downspout_sub_total || 0);
                            $('#sub_total_guards').val(sidingData.guards_sub_total || 0);
                            $('#total_all').val(sidingData.total_all_downspouts || 0);
                            $('#total_gutters').val(sidingData.gutters_total || 0);
                            $('#total_downspouts').val(sidingData.downspout_total || 0);
                            $('#total_guards').val(sidingData.guards_total || 0);
                            $('#flat_waste_eave_rakes').val(sidingData.eave_rakes_flat_area_waste || 0);
                            $('#flat_sub_total_with_waste').val(sidingData.eave_rakes_total_flat_area_waste || 0);
                            $('#divide_total_eave_rakes').val(sidingData.eave_rakes_total_percent || 0);
                            $('#eaves_value_eave').val(sidingData.soffit_eave || 0);
                            $('#rakes_value').val(sidingData.soffit_rakes || 0);
                            $('#porch_value').val(sidingData.soffit_porch || 0);
                            $('#eaves_with_soffit_overhang').val(sidingData.soffit_eave_total || 0);
                            $('#eaves_with_soffit_overhang_divide').val(sidingData.soffit_eave_percent || 0);
                            $('#rakes_with_rakes_overhang').val(sidingData.soffit_rakes_total || 0);
                            $('#rakes_with_rakes_overhang_divide').val(sidingData.soffit_rakes_percent || 0);
                            $('#porch_with_cover_porch').val(sidingData.soffit_porch_total || 0);

                            $('#porch_with_cover_porch_divide').val(sidingData.soffit_porch_percent || 0);
                            $('#total_sum_divide').val(sidingData.soffit_total_sum || 0);
                        } else {
                            console.error("Siding key is not present in the response.");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error loading siding base value:", error);
                    }
                });
            });
        });

        $(document).ready(function () {
            $.ajax({
                url: '{{url("get_siding_content_replacement")}}',
                type: 'GET',
                data:{
                    lead_id: {{$lead->id??''}},
                    siding_estimate_calculator_id: {{$lead->sidingEstimateCalculator->id??'null'}}
                },
                success: function (response) {
                    if (response) {
                        $('#replacement_data').html(response);
                        console.log('Received Data:', response)

                    } else {
                        console.error("Siding key is not present in the response.");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error loading siding base value:", error);
                }
            });

            $.ajax({
                url: '{{url("get_siding_content_over_existing")}}',
                type: 'GET',
                data:{
                    lead_id: {{$lead->id??''}},
                    side_estimate_calculator_id: {{$lead->sidingEstimateCalculator->id??'null'}}
                },
                success: function (response) {
                    if (response) {
                        $('#over_existing_data').html(response);
                        console.log('Received Data:', response)

                    } else {
                        console.error("Siding key is not present in the response.");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error loading siding base value:", error);
                }
            });
            $.ajax({
                url: '{{url("get_siding_content_gutter")}}',
                type: 'GET',
                data:{
                    lead_id: {{$lead->id??''}},
                    siding_estimate_calculator_id: {{$lead->sidingEstimateCalculator->id??'null'}}
                },
                success: function (response) {
                    if (response) {
                        $('#gutter_data').html(response);
                        console.log('Received Data:', response)

                    } else {
                        console.error("Siding key is not present in the response.");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error loading siding base value:", error);
                }
            });
        });
    </script>
@endpush
