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
                <div class="white-box">
                    <ul class="nav nav-tabs" id="chimneyTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="measurementTab" data-bs-toggle="tab" href="#measurementContent" role="tab" aria-controls="measurementContent" aria-selected="true">Measurement</a>
                        </li>
                        @if(isset($lead->chimneyEstimateCalculator) && $lead->chimneyEstimateCalculator)
{{--                            @if(auth()->user()->hasRole('user') || auth()->user()->hasRole('staff'))--}}
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="chimneyTab" data-bs-toggle="tab" href="#chimneyContent" role="tab" aria-controls="chimneyContent" aria-selected="false">Chimney (<span id="chimney_recommended_price_global"></span>)</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="linerTab" data-bs-toggle="tab" href="#linerContent" role="tab" aria-controls="linerContent" aria-selected="false">Liner (<span id="liner_recommended_price_global"></span>)</a>
                                </li>

{{--                            @else--}}
{{--                                <li class="nav-item" role="presentation">--}}
{{--                                    <a class="nav-link " id="chimneyTab" data-bs-toggle="tab" href="#chimneyContent" role="tab" aria-controls="chimneyContent" aria-selected="false">Chimney</a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item" role="presentation">--}}
{{--                                    <a class="nav-link" id="linerTab" data-bs-toggle="tab" href="#linerContent" role="tab" aria-controls="linerContent" aria-selected="false">Liner</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
                        @endif
                    </ul>
                    <div class="tab-content mt-2" id="chimneyTabsContent">
                        <div class="tab-pane fade show active" id="measurementContent" role="tabpanel" aria-labelledby="measurementTab">
                            <div class="container-fluid">
                                <div class="row">
{{--                                    @if(isset($lead->chimneyEstimateCalculator) && $lead->chimneyEstimateCalculator)--}}
{{--                                        @if(auth()->user()->hasRole('user') || auth()->user()->hasRole('staff'))--}}
{{--                                            <div class="col-md-12">--}}
{{--                                                <div class="table_top_btn">--}}
{{--                                                    <a href="{{url('chimney_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->chimneyEstimateCalculator->id}}/chimney" class="btn btn_green">Chimney ( {{ $lead->chimneyEstimateCalculator->storeChimney->recommended_price??'0'}} )</a>--}}
{{--                                                    <a href="{{url('chimney_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->chimneyEstimateCalculator->id}}/liner" class="btn btn_green">Liner ({{ $lead->chimneyEstimateCalculator->storeLiner->recommended_price??'0' }} )</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        @else--}}
{{--                                            <div class="col-md-10">--}}
{{--                                                <div class="table_top_btn">--}}
{{--                                                    --}}{{--                            <span class="btn btn_green">Chimney ( {{ $lead->chimneyEstimateCalculator->storeChimney->recommended_price??'0'}} )</span>--}}
{{--                                                    --}}{{--                            <span class="btn btn_green">Liner ({{ $lead->chimneyEstimateCalculator->storeLiner->recommended_price??'0' }} )</span>--}}
{{--                                                    <a href="{{url('chimney_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->chimneyEstimateCalculator->id}}/chimney" class="btn btn_green">Chimney ( {{ $lead->chimneyEstimateCalculator->storeChimney->recommended_price??'0'}} )</a>--}}
{{--                                                    <a href="{{url('chimney_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->chimneyEstimateCalculator->id}}/liner" class="btn btn_green">Liner ({{ $lead->chimneyEstimateCalculator->storeLiner->recommended_price??'0' }} )</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-2">--}}
{{--                                                <a class="btn btn-success pull-right" href="javascript:window.history.back();">--}}
{{--                                                    <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
{{--                                    @endif--}}
                                    <div class="col-md-12">
                                        <div class="upper_box">
                                            <h3>Chimney Estimation Calculator (Measurement)</h3>
                                            <div class="forms_button_container">
                                                @if(auth()->user()->can('add-chimneyestimatecalculator'))
                                                    @if(!isset($lead->chimneyEstimateCalculator))
                                                        <button class="btn btn-success pull-right clear_fields">Clear</button>
                                                    @endif
                                                    {{--                                                <button class="btn btn-success pull-right add_chimney_value">Add Base Value</button>--}}
                                                @endif
                                                <div class="lead_back_btn">
                                                    <a class="btn secondary_btn" href="{{ url('view_lead/' . $lead->id) }}"><i class="icon-arrow-left-circle" aria-hidden="true"></i> Back To Lead</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <form class="" action="{{ route('store_chimney_estimation_calculator') }}" method="post">
                                            @csrf
                                            <input class="d_clear" type="hidden" name="lead_id" value="{{$lead->id??"0"}}">
                                            <input class="d_clear" type="hidden" name="chimney_estimate_calculator_id" @if(isset($lead->chimneyEstimateCalculator->id) && $lead->chimneyEstimateCalculator->id) value="{{$lead->chimneyEstimateCalculator->id??"0"}}" @else value="0" @endif >
                                            @if(isset($lead->chimneyEstimateCalculator) && isset($lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels))
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td>Lead Name:</td>
                                                        <td width="200">{{$lead->lead_number??"000"}}</td>
                                                        <td colspan="2" class="no-border">{{$lead->title??""}}</td>
                                                        <td colspan="">Date:</td>
                                                        <td width="200" class="green">{!! \Carbon\Carbon::parse($lead->lead_date ?? '000')->format('m-d-Y') !!}</td>

                                                    </tr>
                                                    <tr>
                                                        <td colspan="">
                                                            <input class="form-control" type="text" id="home_style" required name="labels[home_style][name]" value="Home Style" readonly>
                                                        </td>
                                                        <td colspan="2">
                                                            <select class="form-control" id="home_style_value" name="labels[home_style][value]" readonly required>
                                                                <option value="ranch" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'home_style')->first()->value == 'ranch' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>Ranch</option>
                                                                <option value="cape" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'home_style')->first()->value == 'cape' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>Cape</option>
                                                                <option value="colonial" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'home_style')->first()->value == 'colonial' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>Colonial</option>
                                                                <option value="victorian" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'home_style')->first()->value == 'victorian' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>Victorian</option>
                                                            </select>
                                                        </td>
                                                        <td><input class="form-control" type="text" id="stories" name="labels[stories][name]" value="Stories" readonly required></td>
                                                        <td colspan="2" class="green">
                                                            <select class="form-control" id="home_style_value" name="labels[stories][value]" required>
                                                                <option value="0" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'stories')->first()->value == '0' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>0</option>
                                                                <option value="1" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'stories')->first()->value == '1' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>1</option>
                                                                <option value="2" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'stories')->first()->value == '2' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>2</option>
                                                                <option value="3" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'stories')->first()->value == '3' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>3</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><input required class="form-control" type="text" id="windows" name="labels[flu_size][name]" value="Flu Sizes" readonly></td>
                                                        <td class="green" colspan="2">
                                                            <select class="form-control" id="home_style_value" name="labels[flu_size][value]" required>
                                                                <option value="8x8"    {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size')->first()->value == '8x8' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>8x8</option>
                                                                <option value="8x12"   {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size')->first()->value == '8x12' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>8x12</option>
                                                                <option value="10x10"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size')->first()->value == '10x10' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>10x10</option>
                                                                <option value="10x12"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size')->first()->value == '10x12' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>10x12</option>
                                                                <option value="12x12"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size')->first()->value == '12x12' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>12x12</option>
                                                                <option value="12x16"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size')->first()->value == '12x16' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>12x16</option>
                                                                <option value="13x13"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size')->first()->value == '13x13' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>13x13</option>
                                                                <option value="16x16"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size')->first()->value == '16x16' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>16x16</option>
                                                                <option value="16x20"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size')->first()->value == '16x20' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>16x20</option>
                                                                <option value="20x20"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size')->first()->value == '20x20' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>20x20</option>
                                                                <option value="20x24"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size')->first()->value == '20x24' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>20x24</option>
                                                                <option value="24x24"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size')->first()->value == '24x24' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>24x24</option>
                                                                <option value="0"      {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size')->first()->value == '0' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>0</option>
                                                            </select>
                                                        </td>
                                                        <td><input class="form-control" type="text" id="soffit_overhang" required name="labels[pitch][name]" value="Pitch" readonly></td>
                                                        <td colspan="2" class="green">
                                                            <select class="form-control" id="home_style_value" name="labels[pitch][value]" required>
                                                                <option value="0"    {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'pitch')->first()->value == '0' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>0</option>
                                                                <option value="4"   {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'pitch')->first()->value == '4' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>4</option>
                                                                <option value="6"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'pitch')->first()->value == '6' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>6</option>
                                                                <option value="8"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'pitch')->first()->value == '8' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>8</option>
                                                                <option value="10"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'pitch')->first()->value == '10' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>10</option>
                                                                <option value="12"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'pitch')->first()->value == '12' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>12</option>
                                                                <option value="14"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'pitch')->first()->value == '14' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>14</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><input class="form-control" type="text" id="doors" required name="labels[flu_size_one][name]" value="Flu Sizes" readonly></td>
                                                        <td class="green">
                                                            <select class="form-control" id="home_style_value" name="labels[flu_size_one][value]" required>
                                                                <option value="8x8"    {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_one')->first()->value == '8x8' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>8x8</option>
                                                                <option value="8x12"   {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_one')->first()->value == '8x12' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>8x12</option>
                                                                <option value="10x10"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_one')->first()->value == '10x10' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>10x10</option>
                                                                <option value="10x12"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_one')->first()->value == '10x12' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>10x12</option>
                                                                <option value="12x12"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_one')->first()->value == '12x12' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>12x12</option>
                                                                <option value="12x16"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_one')->first()->value == '12x16' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>12x16</option>
                                                                <option value="13x13"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_one')->first()->value == '13x13' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>13x13</option>
                                                                <option value="16x16"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_one')->first()->value == '16x16' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>16x16</option>
                                                                <option value="16x20"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_one')->first()->value == '16x20' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>16x20</option>
                                                                <option value="20x20"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_one')->first()->value == '20x20' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>20x20</option>
                                                                <option value="20x24"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_one')->first()->value == '20x24' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>20x24</option>
                                                                <option value="24x24"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_one')->first()->value == '24x24' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>24x24</option>
                                                                <option value="0"      {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_one')->first()->value == '0' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>0</option>
                                                            </select>
                                                        </td>
                                                        <td><input class="form-control" type="text" id="outlets" required name="labels[flu_size_two][name]" value="Flu Sizes" readonly></td>
                                                        <td class="green">
                                                            <select class="form-control" id="home_style_value" name="labels[flu_size_two][value]" required>
                                                                <option value="8x8"    {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_two')->first()->value == '8x8' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>8x8</option>
                                                                <option value="8x12"   {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_two')->first()->value == '8x12' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>8x12</option>
                                                                <option value="10x10"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_two')->first()->value == '10x10' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>10x10</option>
                                                                <option value="10x12"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_two')->first()->value == '10x12' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>10x12</option>
                                                                <option value="12x12"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_two')->first()->value == '12x12' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>12x12</option>
                                                                <option value="12x16"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_two')->first()->value == '12x16' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>12x16</option>
                                                                <option value="13x13"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_two')->first()->value == '13x13' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>13x13</option>
                                                                <option value="16x16"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_two')->first()->value == '16x16' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>16x16</option>
                                                                <option value="16x20"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_two')->first()->value == '16x20' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>16x20</option>
                                                                <option value="20x20"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_two')->first()->value == '20x20' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>20x20</option>
                                                                <option value="20x24"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_two')->first()->value == '20x24' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>20x24</option>
                                                                <option value="24x24"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_two')->first()->value == '24x24' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>24x24</option>
                                                                <option value="0"      {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_two')->first()->value == '0' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>0</option>
                                                            </select>
                                                        </td>
                                                        {{--                                    <td class="green"><input class="form-control" type="number" required min="1" id="outlets_value" name="labels[flu_size_two][value]" value="{{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'size_two')->first()->value }}"></td>--}}
                                                        <td><input class="form-control" type="text" id="rakes_overhang" required name="labels[dificut][name]" value="Difficulty" readonly></td>
                                                        <td colspan="" class="no-border">
                                                            <select class="form-control" id="home_style_value" name="labels[dificut][value]" required>
                                                                <option value="0" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'dificut')->first()->value == '0' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>0</option>
                                                                <option value="1" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'dificut')->first()->value == '1' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>1</option>
                                                                <option value="2" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'dificut')->first()->value == '2' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>2</option>
                                                                <option value="3" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'dificut')->first()->value == '3' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>3</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><input class="form-control" type="text" id="plywood" required name="labels[flu_size_three][name]" value="Sizes" readonly></td>
                                                        <td class="green">
                                                            <select class="form-control" id="home_style_value" name="labels[flu_size_three][value]" required>
                                                                <option value="8x8"    {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_three')->first()->value == '8x8' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>8x8</option>
                                                                <option value="8x12"   {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_three')->first()->value == '8x12' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>8x12</option>
                                                                <option value="10x10"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_three')->first()->value == '10x10' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>10x10</option>
                                                                <option value="10x12"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_three')->first()->value == '10x12' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>10x12</option>
                                                                <option value="12x12"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_three')->first()->value == '12x12' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>12x12</option>
                                                                <option value="12x16"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_three')->first()->value == '12x16' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>12x16</option>
                                                                <option value="13x13"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_three')->first()->value == '13x13' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>13x13</option>
                                                                <option value="16x16"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_three')->first()->value == '16x16' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>16x16</option>
                                                                <option value="16x20"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_three')->first()->value == '16x20' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>16x20</option>
                                                                <option value="20x20"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_three')->first()->value == '20x20' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>20x20</option>
                                                                <option value="20x24"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_three')->first()->value == '20x24' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>20x24</option>
                                                                <option value="24x24"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_three')->first()->value == '24x24' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>24x24</option>
                                                                <option value="0"      {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_three')->first()->value == '0' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>0</option>
                                                            </select>
                                                        </td>
                                                        {{--                                    <td class="green" colspan="2"><input class="form-control" type="number" required min="1" id="plywood_value" name="labels[flu_size_three][value]" value="{{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'size_three')->first()->value }}"></td>--}}
                                                        <td><input class="form-control" type="text" id="cover_porch" required name="labels[chimney_cap_one][name]" value="Chimney Cap" readonly></td>
                                                        <td colspan="2" class="no-border">
                                                            <select class="form-control" id="home_style_value" name="labels[chimney_cap_one][value]" required>
                                                                <option value="0" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'chimney_cap_one')->first()->value == '0' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>0</option>
                                                                <option value="1" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'chimney_cap_one')->first()->value == '1' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>1</option>
                                                                <option value="2" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'chimney_cap_one')->first()->value == '2' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>2</option>
                                                                <option value="3" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'chimney_cap_one')->first()->value == '3' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>3</option>
                                                                <option value="4" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'chimney_cap_one')->first()->value == '4' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>4</option>
                                                            </select>
                                                        </td>
                                                        <input type="hidden" name="labels[chimney_cap_two][name]" value="Chimney Cap" readonly>
                                                        <td colspan="2" class="no-border">
                                                            <select class="form-control" id="home_style_value" name="labels[chimney_cap_two][value]" required>
                                                                <option value="120" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'chimney_cap_two')->first()->value == '120' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>Copper</option>
                                                                <option value="200" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'chimney_cap_two')->first()->value == '200' ? 'selected' : '0' }} @if(!auth()->user()->can('edit-chimneyestimatecalculator')) disabled @endif>Stainless</option>
                                                                {{--                                        <option value="120">Copper</option>--}}
                                                                {{--                                        <option value="200">Stainless</option>--}}
                                                            </select>
                                                        </td>
                                                    </tr>
{{--                                                    <tr>--}}
{{--                                                        <td><input class="form-control" type="text" id="miscellaneous" required name="labels[miscellaneous][name]" value="Miscellaneous" readonly></td>--}}
{{--                                                        <td colspan="5"><input class="form-control" type="number" min="0" id="miscellaneous" name="labels[miscellaneous][value]" value="{{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'miscellaneous')->first()->value??"" }}"  @if(!auth()->user()->can('edit-chimneyestimatecalculator')) readonly @endif></td>--}}
{{--                                                    </tr>--}}
                                                </table>
                                                {{--  labels ends--}}
                                            @else
                                                {{--  labels starts--}}
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td>Lead Name:</td>
                                                        <td width="200">{{$lead->lead_number??"000"}}</td>
                                                        <td colspan="2" class="no-border">{{$lead->title??""}}</td>
                                                        {{--                                    <td colspan="" class="no-border"></td>--}}
                                                        {{--                                    <td class="no-border"></td>--}}
                                                        <td>Date:</td>
                                                        <td width="200" class="green">
                                                            {{ \Carbon\Carbon::parse($lead->lead_date ?? '000')->format('m-d-Y') }}
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input class="form-control d_clear" type="text" id="home_style" required name="labels[home_style][name]" value="Home Style" readonly>
                                                        </td>
                                                        <td colspan="2">
                                                            <select class="form-control" id="home_style_value" name="labels[home_style][value]" required>
                                                                <option value="ranch" {{ ($formData['labels']['home_style']['value'] ?? '') === 'ranch' ? 'selected' : '' }}>Ranch</option>
                                                                <option value="cape" {{ ($formData['labels']['home_style']['value'] ?? '') === 'cape' ? 'selected' : '' }}>Cape</option>
                                                                <option value="colonial" {{ ($formData['labels']['home_style']['value'] ?? '') === 'colonial' ? 'selected' : '' }}>Colonial</option>
                                                                <option value="victorian" {{ ($formData['labels']['home_style']['value'] ?? '') === 'victorian' ? 'selected' : '' }}>Victorian</option>
                                                            </select>
                                                        </td>
                                                        <td><input class="form-control d_clear" type="text" id="stories" required name="labels[stories][name]" value="Stories" readonly></td>
                                                        <td colspan="2" class="green">
                                                            <select class="form-control" id="stories_value" name="labels[stories][value]" required>
                                                                <option value="0" {{ ($formData['labels']['stories']['value'] ?? '') == '0' ? 'selected' : '' }}>0</option>
                                                                <option value="1" {{ ($formData['labels']['stories']['value'] ?? '') == '1' ? 'selected' : '' }}>1</option>
                                                                <option value="2" {{ ($formData['labels']['stories']['value'] ?? '') == '2' ? 'selected' : '' }}>2</option>
                                                                <option value="3" {{ ($formData['labels']['stories']['value'] ?? '') == '3' ? 'selected' : '' }}>3</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><input required class="form-control d_clear" type="text" id="windows" name="labels[flu_size][name]" value="Flu Sizes" readonly></td>
                                                        <td colspan="2" class="green">
                                                            <select class="form-control" id="home_style_value" name="labels[flu_size][value]" required>
                                                                @foreach (['8x8', '8x12', '10x10', '10x12', '12x12', '12x16', '13x13', '16x16', '16x20', '20x20', '20x24', '24x24', '0'] as $size)
                                                                    <option value="{{ $size }}" {{ ($formData['labels']['flu_size']['value'] ?? '') == $size ? 'selected' : '' }}>{{ $size }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td><input class="form-control d_clear" type="text" id="soffit_overhang" required name="labels[pitch][name]" value="Pitch" readonly></td>
                                                        <td colspan="2" class="green">
                                                            <select class="form-control" id="home_style_value" name="labels[pitch][value]" required>
                                                                <option value="0" {{ ($formData['labels']['pitch']['value'] ?? '') == '0' ? 'selected' : '' }}>0</option>
                                                                <option value="4" {{ ($formData['labels']['pitch']['value'] ?? '') == '4' ? 'selected' : '' }}>4</option>
                                                                <option value="6" {{ ($formData['labels']['pitch']['value'] ?? '') == '6' ? 'selected' : '' }}>6</option>
                                                                <option value="8" {{ ($formData['labels']['pitch']['value'] ?? '') == '8' ? 'selected' : '' }}>8</option>
                                                                <option value="10" {{ ($formData['labels']['pitch']['value'] ?? '') == '10' ? 'selected' : '' }}>10</option>
                                                                <option value="12" {{ ($formData['labels']['pitch']['value'] ?? '') == '12' ? 'selected' : '' }}>12</option>
                                                                <option value="14" {{ ($formData['labels']['pitch']['value'] ?? '') == '14' ? 'selected' : '' }}>14</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><input class="form-control d_clear" type="text" id="doors" required name="labels[flu_size_one][name]" value="Flu Sizes" readonly></td>
                                                        <td class="green">
                                                            <select class="form-control" id="home_style_value" name="labels[flu_size_one][value]" required>
                                                                @foreach (['8x8', '8x12', '10x10', '10x12', '12x12', '12x16', '13x13', '16x16', '16x20', '20x20', '20x24', '24x24', '0'] as $size)
                                                                    <option value="{{ $size }}" {{ ($formData['labels']['flu_size_one']['value'] ?? '') == $size ? 'selected' : '' }}>{{ $size }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        {{--                                <td colspan="2" class="no-border"></td>--}}
                                                        <td><input class="form-control d_clear" type="text" id="outlets" required name="labels[flu_size_two][name]" value="Flu Sizes" readonly></td>
                                                        <td class="green">
                                                            <select class="form-control" id="home_style_value" name="labels[flu_size_two][value]" required>
                                                                @foreach (['8x8', '8x12', '10x10', '10x12', '12x12', '12x16', '13x13', '16x16', '16x20', '20x20', '20x24', '24x24', '0'] as $size)
                                                                    <option value="{{ $size }}" {{ ($formData['labels']['flu_size_two']['value'] ?? '') == $size ? 'selected' : '' }}>{{ $size }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        {{--                                <td colspan="2" class="no-border"></td>--}}
                                                        {{--                                <td></td>--}}
                                                        <td><input class="form-control d_clear" type="text" id="rakes_overhang" required name="labels[dificut][name]" value="Difficulty" readonly></td>
                                                        <td class="no-border">
                                                            <select class="form-control" id="home_style_value" name="labels[dificut][value]" required>
                                                                <option value="0" {{ ($formData['labels']['dificut']['value'] ?? '') == '0' ? 'selected' : '' }}>0</option>
                                                                <option value="1" {{ ($formData['labels']['dificut']['value'] ?? '') == '1' ? 'selected' : '' }}>1</option>
                                                                <option value="2" {{ ($formData['labels']['dificut']['value'] ?? '') == '2' ? 'selected' : '' }}>2</option>
                                                                <option value="3" {{ ($formData['labels']['dificut']['value'] ?? '') == '3' ? 'selected' : '' }}>3</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><input class="form-control d_clear" type="text" id="plywood" required name="labels[flu_size_three][name]" value="Flu Sizes" readonly></td>
                                                        <td class="green">
                                                            <select class="form-control" id="home_style_value" name="labels[flu_size_three][value]" required>
                                                                @foreach (['8x8', '8x12', '10x10', '10x12', '12x12', '12x16', '13x13', '16x16', '16x20', '20x20', '20x24', '24x24', '0'] as $size)
                                                                    <option value="{{ $size }}" {{ ($formData['labels']['flu_size_three']['value'] ?? '') == $size ? 'selected' : '' }}>{{ $size }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        {{--                                <td colspan="2" class="no-border"></td>--}}
                                                        {{--                                <td></td>--}}
                                                        {{--                                <td></td>--}}
                                                        {{--                                <td></td>--}}
                                                        {{--                                <td colspan="2" class="no-border"></td>--}}
                                                        <td colspan="2"><input class="form-control d_clear" type="text" id="cover_porch" required name="labels[chimney_cap_one][name]" value="Chimney Cap" readonly></td>
                                                        <td class="no-border">
                                                            <select class="form-control" id="home_style_value" name="labels[chimney_cap_one][value]" required>
                                                                <option value="0" {{ ($formData['labels']['chimney_cap_one']['value'] ?? '') == '0' ? 'selected' : '' }}>0</option>
                                                                <option value="1" {{ ($formData['labels']['chimney_cap_one']['value'] ?? '') == '1' ? 'selected' : '' }}>1</option>
                                                                <option value="2" {{ ($formData['labels']['chimney_cap_one']['value'] ?? '') == '2' ? 'selected' : '' }}>2</option>
                                                                <option value="3" {{ ($formData['labels']['chimney_cap_one']['value'] ?? '') == '3' ? 'selected' : '' }}>3</option>
                                                                <option value="4" {{ ($formData['labels']['chimney_cap_one']['value'] ?? '') == '4' ? 'selected' : '' }}>4</option>
                                                            </select>
                                                        </td>
                                                        <input class="d_clear" type="hidden" name="labels[chimney_cap_two][name]" value="Chimney Cap" readonly>
                                                        <td class="no-border">
                                                            <select class="form-control" id="home_style_value" name="labels[chimney_cap_two][value]" required>
                                                                <option value="120" {{ ($formData['labels']['chimney_cap_two']['value'] ?? '') == 'copper' ? 'selected' : '' }}>Copper</option>
                                                                <option value="200" {{ ($formData['labels']['chimney_cap_two']['value'] ?? '') == 'stainless' ? 'selected' : '' }}>Stainless</option>
                                                            </select>
                                                        </td>
                                                    </tr>
{{--                                                    <tr>--}}
{{--                                                        <td><input class="form-control d_clear" type="text" id="miscellaneous" required name="labels[miscellaneous][name]" value="Miscellaneous" readonly></td>--}}
{{--                                                        <td colspan="5"><input class="form-control" type="number" min="0" id="miscellaneous" name="labels[miscellaneous][value]" placeholder="Type Here...."></td>--}}
{{--                                                    </tr>--}}
                                                </table>
                                            @endif

                                            @if(isset($lead->chimneyEstimateCalculator) && isset($lead->chimneyEstimateCalculator->chimneyEstimateCalculatorBricksRows))
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Letter</th>
                                                        <th>Bricks</th>
                                                        <th></th>
                                                        <th colspan="4">Rows</th>
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
                                                    @foreach ($lead->chimneyEstimateCalculator->chimneyEstimateCalculatorBricksRows as $index => $item)
                                                        <tr>
                                                            <td>{{ $letters[$index]  }}</td>
                                                            <td class="green"><input class="form-control bricks" type="number" name="bricks_rows[{{$item->section}}][bricks][]" value="{{ $item->bricks ?? '' }}" min="0" step="0.01" @if(!auth()->user()->can('edit-chimneyestimatecalculator')) readonly @endif></td>
                                                            <td class="green">X</td>
                                                            <td colspan="4" class="green"><input class="form-control rows" type="number" name="bricks_rows[{{$item->section}}][rows][]" value="{{ $item->rows ?? '' }}" min="0" step="0.01" @if(!auth()->user()->can('edit-chimneyestimatecalculator')) readonly @endif></td>
                                                            <td class="green"><input class="form-control calculate-final-value-bricks-rows" type="number" name="bricks_rows[{{$item->section}}][total_bricks_rows][]" readonly value="{{ $item->total_bricks_rows ?? '' }}" min="0" @if(!auth()->user()->can('edit-chimneyestimatecalculator')) readonly @endif></td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="5">SubTotal</td>

                                                        {{--                                    <td colspan="4"></td>--}}
                                                        <td colspan="2"><input id="sub_total_bricks_rows" type="number" class="form-control" name="sub_total_bricks_rows" value="{{$lead->chimneyEstimateCalculator->sub_total_bricks_rows??''}}" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5">Waste (%)</td>
                                                        <td class="green" colspan="2"><input id="waste_bricks_rows" type="number" class="form-control" name="waste_bricks_rows" min="0" value="{{$lead->chimneyEstimateCalculator->waste_bricks_rows??'10'}}" step="0.01" @if(!auth()->user()->can('edit-chimneyestimatecalculator')) readonly @endif></td>
                                                        <td class="green" colspan="2"><input id="sub_total_with_waste" type="number" class="form-control" name="total_waste_bricks_rows" value="{{$lead->chimneyEstimateCalculator->total_waste_bricks_rows??''}}" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5">Total Bricks</td>
                                                        <td class="no-border" colspan="2"><input id="total_brick_rows" type="number" class="form-control" name="total_bricks_rows" value="{{$lead->chimneyEstimateCalculator->total_bricks_rows??''}}" readonly></td>
                                                    </tr>
                                                    {{--                                <tr>--}}
                                                    {{--                                    <td></td>--}}
                                                    {{--                                    <td></td>--}}
                                                    {{--                                    <td colspan="4"></td>--}}
                                                    {{--                                    <td></td>--}}
                                                    {{--                                    <td></td>--}}
                                                    {{--                                </tr>--}}
                                                    </tbody>
                                                </table>
                                            @else
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Letter</th>
                                                        <th>Bricks</th>
                                                        <th></th>
                                                        <th colspan="4">Rows</th>
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
                                                            <td class="green"><input class="form-control bricks" type="number" name="bricks_rows[{{$letter}}][bricks][]" value="{{ $formData['bricks_rows'][$letter]['bricks'][0] ?? 0 }}" min="0" step="0.01"></td>
                                                            <td class="green">X</td>
                                                            <td colspan="4" class="green"><input class="form-control rows" type="number" name="bricks_rows[{{$letter}}][rows][]" value="{{ $formData['bricks_rows'][$letter]['rows'][0] ?? 0 }}" min="0" step="0.01"></td>
                                                            <td class="green"><input class="form-control calculate-final-value-bricks-rows" type="number" name="bricks_rows[{{$letter}}][total_bricks_rows][]" readonly value="{{ $formData['bricks_rows'][$letter]['total_bricks_rows'][0] ?? 0 }}" min="0"></td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td>SubTotal</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="4"></td>
                                                        <td><input id="sub_total_bricks_rows" type="number" class="form-control" name="sub_total_bricks_rows" min="0" value="{{ $formData['sub_total_bricks_rows'] ?? 0 }}" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Waste (%)</td>
                                                        <td></td>
                                                        <td colspan="4"></td>
                                                        <td class="green"><input id="waste_bricks_rows" type="number" class="form-control" name="waste_bricks_rows" min="0" value="{{ $formData['waste_bricks_rows'] ?? 0 }}" step="0.01"></td>
                                                        <td class="green"><input id="sub_total_with_waste" type="number" class="form-control" name="total_waste_bricks_rows" min="0" value="{{ $formData['total_waste_bricks_rows'] ?? 0 }}" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Bricks</td>
                                                        <td></td>
                                                        <td colspan="4"></td>
                                                        <td></td>
                                                        <td class="no-border"><input id="total_brick_rows" type="number" class="form-control" name="total_bricks_rows" min="0" value="{{ $formData['total_bricks_rows'] ?? 0 }}" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="4"></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            @endif
                                            <br>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td>Notes:</td>
                                                    <td class="no-border"><input class="form-control" type="text" id="note" name="notes" @if(isset($lead->chimneyEstimateCalculator) && $lead->chimneyEstimateCalculator)  value="{!!  $lead->chimneyEstimateCalculator->notes??'' !!}" @endif placeholder="Enter Any Notes" @if(!auth()->user()->can('edit-chimneyestimatecalculator')) readonly @endif></td>
                                                </tr>
                                            </table>
                                            @if(auth()->user()->can('add-chimneyestimatecalculator'))
                                                <button type="submit" class="btn green_btn borderRadius btn-submit">Submit</button>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="chimneyContent" role="tabpanel" aria-labelledby="chimneyTab">
                            <div id="chimney_data"></div>
                        </div>
                        <div class="tab-pane fade" id="linerContent" role="tabpanel" aria-labelledby="linerTab">
                            <div id="liner_data"></div>
                        </div>

                    </div>
                </div>
            </div>
        </section>



{{--    <section class="white-box">--}}

{{--    </section>--}}

@endsection
@push('js')
    <script>
        $(document).ready(function(){
            $('.clear_fields').click(function() {
                $('input').not('.d_clear, [name="_token"], [name="csrf-token"]').val('');
            });
        });
        $(document).ready(function() {
            function calculateRowTotal(bricks, rows) {
                return bricks * rows;
            }
            function updateTotals() {
                let subtotal = 0;
                $('table.table tbody tr').each(function() {
                    const bricks = parseFloat($(this).find('.bricks').val()) || 0;
                    const rows = parseFloat($(this).find('.rows').val()) || 0;
                    const rowTotal = calculateRowTotal(bricks, rows);
                    $(this).find('.calculate-final-value-bricks-rows').val(rowTotal);
                    subtotal += rowTotal;
                });
                $('#sub_total_bricks_rows').val(subtotal);
                const wastePercentage = parseFloat($('#waste_bricks_rows').val()) || 0;
                const total = subtotal * (1 + (wastePercentage / 100));
                $('#total_brick_rows').val(total.toFixed(2));
            }
            function calculateSubtotalWithWaste() {
                const subTotal = parseFloat($('#sub_total_bricks_rows').val()) || 0;
                const waste = parseFloat($('#waste_bricks_rows').val()) || 0;
                const result = (subTotal * waste) / 100;
                $('#sub_total_with_waste').val(result);
                const updatedWasteTotal = parseFloat($('#sub_total_with_waste').val()) || 0;
                const sumtotal = subTotal + updatedWasteTotal;
                const roundedTotal = Math.round(sumtotal);
                $('#total_bricks_rows').val(roundedTotal);
                const sumtotaldivide = (subTotal + updatedWasteTotal) / 100;
                const roundedDivideTotal = Math.round(sumtotaldivide);
                $('#divide_total_eave_rakes').val(roundedDivideTotal);
            }
            $(document).on('input', '.bricks, .rows, #waste_bricks_rows', function() {
                updateTotals();
                calculateSubtotalWithWaste();
            });
            updateTotals();
            calculateSubtotalWithWaste();
        });
        $(document).ready(function () {
            $(document).on('click', '.add_chimney_value', function () {
                $.ajax({
                    url: '/get_chimney_base_value',
                    type: 'GET',
                    success: function (response) {
                        if (response.chimney) {
                            console.log('Received Data:', response.chimney)
                            let chimneyData;
                            try {
                                chimneyData = JSON.parse(response.chimney);
                            } catch (error) {
                                console.error("Failed to parse chimney JSON:", error);
                                return;
                            }
                            // Populate "labels" fields
                            if (chimneyData.labels) {
                                for (const [key, value] of Object.entries(chimneyData.labels)) {
                                    $(`[name='labels[${key}][name]']`).val(value.name || '');
                                    $(`[name='labels[${key}][value]']`).each(function () {
                                        if ($(this).is('select')) {
                                            const optionExists = $(this).find(`option[value='${value.value}']`).length > 0;
                                            if (optionExists) {
                                                $(this).val(value.value);
                                            } else {
                                                console.warn(`Value '${value.value}' not found for '${key}'.`);
                                            }
                                        } else {
                                            $(this).val(value.value || '');
                                        }
                                    });
                                }
                            }
                            // Populate "bricks_rows" fields
                            if (chimneyData.bricks_rows) {
                                for (const [letter, values] of Object.entries(chimneyData.bricks_rows)) {
                                    $(`input[name='bricks_rows[${letter}][bricks][]']`).val(values.bricks[0] || 0);
                                    $(`input[name='bricks_rows[${letter}][rows][]']`).val(values.rows[0] || 0);
                                    $(`input[name='bricks_rows[${letter}][total_bricks_rows][]']`).val(values.total_bricks_rows[0] || 0);
                                }
                            }
                            // Populate totals and calculated fields
                            $('#sub_total_bricks_rows').val(chimneyData.sub_total_bricks_rows || 0);
                            $('#waste_bricks_rows').val(chimneyData.waste_bricks_rows || 0);
                            $('#sub_total_with_waste').val(chimneyData.total_waste_bricks_rows || 0);
                            $('#total_brick_rows').val(chimneyData.total_bricks_rows || 0);
                        } else {
                            console.error("Chimney key is not present in the response.");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error loading chimney base value:", error);
                    }
                });
            });
        });
        {{--document.querySelector('.btn-submit').addEventListener('click', function(event) {--}}
                {{--    event.preventDefault(); // Prevent the form from submitting normally--}}

                {{--    var leadId = {{ $lead->id }};--}}
                {{--    var chimneyEstimateId = {{ $lead->chimneyEstimateCalculator->id }};--}}

                {{--    // Construct the URL to trigger the calculation--}}
                {{--    var url = "{{ url('chimney_estimation_calculator_screen') }}/" + leadId + "/" + chimneyEstimateId + "/chimney";--}}

                {{--    // Perform AJAX request to fetch updated data--}}
                {{--    fetch(url)--}}
                {{--        .then(response => response.text())  // Get the response as HTML--}}
                {{--        .then(data => {--}}
                {{--            // Extract recommended_price from the response--}}
                {{--            var parser = new DOMParser();--}}
                {{--            var doc = parser.parseFromString(data, 'text/html');--}}

                {{--            // Assume the recommended price is in an element with id 'recommended_price'--}}
                {{--            var recommendedPrice = doc.querySelector('#recommended_price').value;--}}

                {{--            console.log('Recommended Price:', recommendedPrice);  // Log the recommended price--}}
                {{--            document.getElementById('recommended_price').value = recommendedPrice;  // Update the input field--}}
                {{--        })--}}
                {{--        .catch(error => console.error('Error:', error));--}}
                {{--});--}}
        {{--    window.onload = function() {--}}
        {{--    console.log("Page loaded");--}}

        {{--    $.ajax({--}}
        {{--        url: '{{ url("chimney_estimation_calculator_screen") }}/{{ $lead->id }}/{{ $lead->chimneyEstimateCalculator->id }}/chimney',--}}
        {{--        type: 'GET',--}}
        {{--        success: function (response) {--}}
        {{--            var Response = response;--}}
        {{--            console.log("Response Data:", response);--}}

        {{--            // 1. Calculate multiplied values for stories, pitch, difficulty, and cap--}}
        {{--            function calculateMultiplyValues() {--}}
        {{--                var storiesVal = parseFloat($(Response).find('#stories_value').val()) || 0;--}}
        {{--                var pitchVal = parseFloat($(Response).find('#pitch_value').val()) || 0;--}}
        {{--                var difficultyVal = parseFloat($(Response).find('#dificultie_value').val()) || 0;--}}
        {{--                var capVal = parseFloat($(Response).find('#cap_value').val()) || 0;--}}
        {{--                var capValue = parseFloat($(Response).find('#total_cap_value').val()) || 0;--}}

        {{--                console.log("Stories Value:", storiesVal);--}}
        {{--                console.log("Pitch Value:", pitchVal);--}}
        {{--                console.log("Difficulty Value:", difficultyVal);--}}
        {{--                console.log("Cap Value:", capVal);--}}
        {{--                console.log("Cap Value (total):", capValue);--}}

        {{--                var totalStoriesVal = storiesVal * 250;--}}
        {{--                var totalPitchVal = pitchVal * 50;--}}
        {{--                var totalDifficultyVal = difficultyVal * 150;--}}
        {{--                var totalCapVal = capVal * capValue;--}}

        {{--                $(Response).find('#total_stories_value').val(totalStoriesVal.toFixed(2));--}}
        {{--                $(Response).find('#total_pitch_value').val(totalPitchVal.toFixed(2));--}}
        {{--                $(Response).find('#total_dificultie_value').val(totalDifficultyVal.toFixed(2));--}}
        {{--                $(Response).find('#total_cap_value').val(totalCapVal.toFixed(2));--}}
        {{--            }--}}

        {{--            // 2. Calculate multiplied sum values for bricks, stories, pitch, difficulty, and cap--}}
        {{--            function calculateMultiplySumValues() {--}}
        {{--                var totalBricksVal = parseFloat($(Response).find('#bricks_value').val()) || 0;--}}
        {{--                var totalStoriesVal = parseFloat($(Response).find('#total_stories_value').val()) || 0;--}}
        {{--                var totalPitchVal = parseFloat($(Response).find('#total_pitch_value').val()) || 0;--}}
        {{--                var totalDifficultyVal = parseFloat($(Response).find('#total_dificultie_value').val()) || 0;--}}
        {{--                var totalCapVal = parseFloat($(Response).find('#total_cap_value').val()) || 0;--}}
        {{--                var materialVal = parseFloat($(Response).find('#material_value').val()) || 0;--}}
        {{--                var laborVal = parseFloat($(Response).find('#labor_value').val()) || 0;--}}

        {{--                console.log("Total Bricks Value:", totalBricksVal);--}}
        {{--                console.log("Material Value:", materialVal);--}}
        {{--                console.log("Labor Value:", laborVal);--}}

        {{--                var multiplyBricksVal1 = totalBricksVal * materialVal;--}}
        {{--                var multiplyBricksVal2 = totalBricksVal * laborVal;--}}
        {{--                var sumMaterialTotalVal = totalStoriesVal + totalCapVal;--}}
        {{--                var sumLaborTotalVal = totalStoriesVal + totalPitchVal + totalDifficultyVal + totalCapVal;--}}

        {{--                var totalMaterialMultiSumVal = multiplyBricksVal1 + sumMaterialTotalVal;--}}
        {{--                var totalLaborMultiSumVal = multiplyBricksVal2 + sumLaborTotalVal;--}}

        {{--                $(Response).find('#total_material_value').val(totalMaterialMultiSumVal.toFixed(2));--}}
        {{--                $(Response).find('#total_labor_value').val(totalLaborMultiSumVal.toFixed(2));--}}
        {{--            }--}}

        {{--            // 3. Calculate dumpster and permit values--}}
        {{--            function calculateMultiplyDumsterPermitValues() {--}}
        {{--                var totalMaterialVal = parseFloat($(Response).find('#total_material_value').val()) || 0;--}}
        {{--                var totalDumsterVal = parseFloat($(Response).find('#dumpster_value').val()) || 0;--}}
        {{--                var totalPermitVal = parseFloat($(Response).find('#permit_warranty_value').val()) || 0;--}}

        {{--                console.log("Total Material Value:", totalMaterialVal);--}}
        {{--                console.log("Dumpster Value:", totalDumsterVal);--}}
        {{--                console.log("Permit Value:", totalPermitVal);--}}

        {{--                var TotalMultiplyDumsterVal = totalMaterialVal * (totalDumsterVal / 100);--}}
        {{--                var TotalMultiplyPermitVal = totalMaterialVal * (totalPermitVal / 100);--}}

        {{--                $(Response).find('#total_dumpster_value').val(TotalMultiplyDumsterVal.toFixed(2));--}}
        {{--                $(Response).find('#total_permit_warranty_value').val(TotalMultiplyPermitVal.toFixed(2));--}}
        {{--            }--}}

        {{--            // 4. Calculate sum of project cost--}}
        {{--            function calculateSumProjectCost() {--}}
        {{--                var materialTotalVal = parseFloat($(Response).find('#total_material_value').val()) || 0;--}}
        {{--                var laborTotalVal = parseFloat($(Response).find('#total_labor_value').val()) || 0;--}}
        {{--                var dumpsterTotalVal = parseFloat($(Response).find('#total_dumpster_value').val()) || 0;--}}
        {{--                var permitTotalVal = parseFloat($(Response).find('#total_permit_warranty_value').val()) || 0;--}}

        {{--                var totalSumVal = materialTotalVal + laborTotalVal + dumpsterTotalVal + permitTotalVal;--}}
        {{--                $(Response).find('#project_cost').val(totalSumVal.toFixed(2));--}}
        {{--            }--}}

        {{--            // 5. Calculate margin profit--}}
        {{--            function calculateMarginProfit() {--}}
        {{--                var projectCostVal = parseFloat($(Response).find('#project_cost').val()) || 0;--}}
        {{--                var totalProjectCostVal = (projectCostVal / 65) * 100;--}}
        {{--                $(Response).find('#margin_profit_value').val(totalProjectCostVal.toFixed(2));--}}
        {{--            }--}}

        {{--            // 6. Calculate total sales value--}}
        {{--            function calculateSalesTotal() {--}}
        {{--                var totalMarginValue = parseFloat($(Response).find('#margin_profit_value').val()) || 0;--}}
        {{--                var totalSalesValue = parseFloat($(Response).find('#sales_value').val()) || 0;--}}
        {{--                var totalProjectCostVal = (totalMarginValue * totalSalesValue) / 100;--}}
        {{--                $(Response).find('#total_sales_value').val(totalProjectCostVal.toFixed(2));--}}
        {{--            }--}}

        {{--            // 7. Calculate direct cost total--}}
        {{--            function calculateDirectCostTotalSum() {--}}
        {{--                var totalSalesVal = parseFloat($(Response).find('#total_sales_value').val()) || 0;--}}
        {{--                var totalProjectCostVal = totalSalesVal;--}}
        {{--                $(Response).find('#direct_cost').val(totalProjectCostVal.toFixed(2));--}}
        {{--            }--}}

        {{--            // 8. Calculate net profit total--}}
        {{--            function calculateNetProfitTotal() {--}}
        {{--                var projectCostTotalVal = parseFloat($(Response).find('#project_cost').val()) || 0;--}}
        {{--                var marginTotalVal = parseFloat($(Response).find('#margin_profit_value').val()) || 0;--}}
        {{--                var directCostTotalVal = parseFloat($(Response).find('#direct_cost').val()) || 0;--}}
        {{--                var netProfitTotal = marginTotalVal - projectCostTotalVal - directCostTotalVal;--}}
        {{--                $(Response).find('#net_profit').val(netProfitTotal.toFixed(2));--}}
        {{--            }--}}

        {{--            // 9. Calculate margin percentage--}}
        {{--            function calculateMarginPercent() {--}}
        {{--                var projectCostTotalVal = parseFloat($(Response).find('#project_cost').val()) || 0;--}}
        {{--                var recommendedMarginPercent = (projectCostTotalVal / 65) * 100;--}}
        {{--                $(Response).find('#margin_percent').val(recommendedMarginPercent.toFixed(2));--}}
        {{--            }--}}

        {{--            // 10. Calculate total profit margin (profit based on the cost)--}}
        {{--            function calculateProfitMargin() {--}}
        {{--                var netProfitVal = parseFloat($(Response).find('#net_profit').val()) || 0;--}}
        {{--                var projectCostVal = parseFloat($(Response).find('#project_cost').val()) || 0;--}}
        {{--                var profitMarginVal = (netProfitVal / projectCostVal) * 100;--}}
        {{--                $(Response).find('#profit_margin').val(profitMarginVal.toFixed(2));--}}
        {{--            }--}}

        {{--            // 11. Calculate total estimated cost including all factors--}}
        {{--            function calculateTotalEstimatedCost() {--}}
        {{--                var totalSalesValue = parseFloat($(Response).find('#total_sales_value').val()) || 0;--}}
        {{--                var totalCapValue = parseFloat($(Response).find('#total_cap_value').val()) || 0;--}}
        {{--                var totalEstimatedCost = totalSalesValue + totalCapValue;--}}
        {{--                $(Response).find('#total_estimated_cost').val(totalEstimatedCost.toFixed(2));--}}
        {{--            }--}}

        {{--            // 12. Update all fields with final calculated values--}}
        {{--            function updateCalculatedFields() {--}}
        {{--                calculateMultiplyValues();--}}
        {{--                calculateMultiplySumValues();--}}
        {{--                calculateMultiplyDumsterPermitValues();--}}
        {{--                calculateSumProjectCost();--}}
        {{--                calculateMarginProfit();--}}
        {{--                calculateSalesTotal();--}}
        {{--                calculateDirectCostTotalSum();--}}
        {{--                calculateNetProfitTotal();--}}
        {{--                calculateMarginPercent();--}}
        {{--                calculateProfitMargin();--}}
        {{--                calculateTotalEstimatedCost();--}}
        {{--            }--}}

        {{--            // Call all functions to update the fields--}}
        {{--            updateCalculatedFields();--}}
        {{--        }--}}
        {{--    });--}}
        {{--};--}}
        $(document).ready(function () {
                $.ajax({
                    url: '{{url("get_chimney_content_chimney")}}',
                    type: 'GET',
                    data:{
                        lead_id: {{$lead->id??''}},
                        chimney_estimate_calculator_id: {{$lead->chimneyEstimateCalculator->id??'null'}}
                    },
                    success: function (response) {
                        if (response) {
                            $('#chimney_data').html(response);
                            console.log('Received Data:', response)

                        } else {
                            console.error("Chimney key is not present in the response.");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error loading chimney base value:", error);
                    }
                });

                $.ajax({
                    url: '{{url("get_chimney_content_liner")}}',
                    type: 'GET',
                    data:{
                        lead_id: {{$lead->id??''}},
                        chimney_estimate_calculator_id: {{$lead->chimneyEstimateCalculator->id??'null'}}
                    },
                    success: function (response) {
                        if (response) {
                            $('#liner_data').html(response);
                            console.log('Received Data:', response)

                        } else {
                            console.error("Chimney key is not present in the response.");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error loading chimney base value:", error);
                    }
                });
            });
    </script>
@endpush
