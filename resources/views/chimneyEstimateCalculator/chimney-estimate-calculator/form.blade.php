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
    <section class="white-box">
    <div class="container-fluid">
        <div class="row">
            @if(isset($lead->chimneyEstimateCalculator) && $lead->chimneyEstimateCalculator)
                <div class="col-md-12">
                    <div class="table_top_btn">
                        <a href="{{url('chimney_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->chimneyEstimateCalculator->id}}/chimney" class="btn btn_green">Chimney</a>
                        <a href="{{url('chimney_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->chimneyEstimateCalculator->id}}/liner" class="btn btn_green">Liner</a>
                    </div>
                </div>
            @endif
            <div class="col-md-12">
                <form action="{{ route('store_chimney_estimation_calculator') }}" method="post" id="chimney_form">
                    @csrf
                    <input type="hidden" name="lead_id" value="{{$lead->id??"0"}}">
                    <input type="hidden" name="chimney_estimate_calculator_id" @if(isset($lead->chimneyEstimateCalculator->id) && $lead->chimneyEstimateCalculator->id) value="{{$lead->chimneyEstimateCalculator->id??"0"}}" @else value="0" @endif >
                    @if(isset($lead->chimneyEstimateCalculator) && isset($lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels))
                        <table class="table table-bordered">
                            <tr>
                                <td>Lead Name:</td>
                                <td width="200">{{$lead->lead_number??"000"}}</td>
                                <td colspan="2" class="no-border">{{$lead->title??""}}</td>
                                <td colspan="">Date:</td>
                                <td width="200" class="green">{{$lead->lead_date??"000"}}</td>
                            </tr>
                            <tr>
                                <td colspan="">
                                    <input class="form-control" type="text" id="home_style" required name="labels[home_style][name]" value="Home Style" >
                                </td>
                                <td colspan="2">
                                    <select class="form-control select2" id="home_style_value" name="labels[home_style][value]" required>
                                        <option value="ranch" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'home_style')->first()->value == 'ranch' ? 'selected' : '0' }}>Ranch</option>
                                        <option value="cape" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'home_style')->first()->value == 'cape' ? 'selected' : '0' }}>Cape</option>
                                        <option value="colonial" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'home_style')->first()->value == 'colonial' ? 'selected' : '0' }}>Colonial</option>
                                        <option value="victorian" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'home_style')->first()->value == 'victorian' ? 'selected' : '0' }}>Victorian</option>
                                    </select>
                                </td>
                                <td><input class="form-control" type="text" id="stories" required name="labels[stories][name]" value="Stories"></td>
                                <td colspan="2" class="green">
                                    <select class="form-control select2" id="home_style_value" name="labels[stories][value]" required>
                                        <option value="0" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'stories')->first()->value == '0' ? 'selected' : '0' }}>0</option>
                                        <option value="1" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'stories')->first()->value == '1' ? 'selected' : '0' }}>1</option>
                                        <option value="2" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'stories')->first()->value == '2' ? 'selected' : '0' }}>2</option>
                                        <option value="3" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'stories')->first()->value == '3' ? 'selected' : '0' }}>3</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><input required class="form-control" type="text" id="windows" name="labels[flu_size][name]" value="Flu Sizes"></td>
                                <td class="green" colspan="2">
                                    <select class="form-control select2" id="home_style_value" name="labels[flu_size][value]" required>
                                        <option value="8x8"    {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size')->first()->value == '8x8' ? 'selected' : '0' }}>8x8</option>
                                        <option value="8x12"   {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size')->first()->value == '8x12' ? 'selected' : '0' }}>8x12</option>
                                        <option value="10x10"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size')->first()->value == '10x10' ? 'selected' : '0' }}>10x10</option>
                                        <option value="10x12"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size')->first()->value == '10x12' ? 'selected' : '0' }}>10x12</option>
                                        <option value="12x12"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size')->first()->value == '12x12' ? 'selected' : '0' }}>12x12</option>
                                        <option value="12x16"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size')->first()->value == '12x16' ? 'selected' : '0' }}>12x16</option>
                                        <option value="13x13"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size')->first()->value == '13x13' ? 'selected' : '0' }}>13x13</option>
                                        <option value="16x16"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size')->first()->value == '16x16' ? 'selected' : '0' }}>16x16</option>
                                        <option value="16x20"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size')->first()->value == '16x20' ? 'selected' : '0' }}>16x20</option>
                                        <option value="20x20"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size')->first()->value == '20x20' ? 'selected' : '0' }}>20x20</option>
                                        <option value="20x24"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size')->first()->value == '20x24' ? 'selected' : '0' }}>20x24</option>
                                        <option value="24x24"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size')->first()->value == '24x24' ? 'selected' : '0' }}>24x24</option>
                                        <option value="0"      {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size')->first()->value == '0' ? 'selected' : '0' }}>0</option>
                                    </select>
                                </td>
                                <td><input class="form-control" type="text" id="soffit_overhang" required name="labels[pitch][name]" value="Pitch"></td>
                                <td colspan="2" class="green">
                                    <select class="form-control select2" id="home_style_value" name="labels[pitch][value]" required>
                                        <option value="0"    {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'pitch')->first()->value == '0' ? 'selected' : '0' }}>0</option>
                                        <option value="4"   {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'pitch')->first()->value == '4' ? 'selected' : '0' }}>4</option>
                                        <option value="6"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'pitch')->first()->value == '6' ? 'selected' : '0' }}>6</option>
                                        <option value="8"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'pitch')->first()->value == '8' ? 'selected' : '0' }}>8</option>
                                        <option value="10"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'pitch')->first()->value == '10' ? 'selected' : '0' }}>10</option>
                                        <option value="12"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'pitch')->first()->value == '12' ? 'selected' : '0' }}>12</option>
                                        <option value="14"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'pitch')->first()->value == '14' ? 'selected' : '0' }}>14</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="form-control" type="text" id="doors" required name="labels[flu_size_one][name]" value="Flu Sizes"></td>
                                <td class="green">
                                    <select class="form-control select2" id="home_style_value" name="labels[flu_size_one][value]" required>
                                        <option value="8x8"    {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_one')->first()->value == '8x8' ? 'selected' : '0' }}>8x8</option>
                                        <option value="8x12"   {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_one')->first()->value == '8x12' ? 'selected' : '0' }}>8x12</option>
                                        <option value="10x10"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_one')->first()->value == '10x10' ? 'selected' : '0' }}>10x10</option>
                                        <option value="10x12"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_one')->first()->value == '10x12' ? 'selected' : '0' }}>10x12</option>
                                        <option value="12x12"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_one')->first()->value == '12x12' ? 'selected' : '0' }}>12x12</option>
                                        <option value="12x16"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_one')->first()->value == '12x16' ? 'selected' : '0' }}>12x16</option>
                                        <option value="13x13"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_one')->first()->value == '13x13' ? 'selected' : '0' }}>13x13</option>
                                        <option value="16x16"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_one')->first()->value == '16x16' ? 'selected' : '0' }}>16x16</option>
                                        <option value="16x20"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_one')->first()->value == '16x20' ? 'selected' : '0' }}>16x20</option>
                                        <option value="20x20"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_one')->first()->value == '20x20' ? 'selected' : '0' }}>20x20</option>
                                        <option value="20x24"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_one')->first()->value == '20x24' ? 'selected' : '0' }}>20x24</option>
                                        <option value="24x24"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_one')->first()->value == '24x24' ? 'selected' : '0' }}>24x24</option>
                                        <option value="0"      {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_one')->first()->value == '0' ? 'selected' : '0' }}>0</option>
                                    </select>
                                </td>
                                <td><input class="form-control" type="text" id="outlets" required name="labels[flu_size_two][name]" value="Flu Sizes"></td>
                                <td class="green">
                                    <select class="form-control select2" id="home_style_value" name="labels[flu_size_two][value]" required>
                                        <option value="8x8"    {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_two')->first()->value == '8x8' ? 'selected' : '0' }}>8x8</option>
                                        <option value="8x12"   {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_two')->first()->value == '8x12' ? 'selected' : '0' }}>8x12</option>
                                        <option value="10x10"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_two')->first()->value == '10x10' ? 'selected' : '0' }}>10x10</option>
                                        <option value="10x12"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_two')->first()->value == '10x12' ? 'selected' : '0' }}>10x12</option>
                                        <option value="12x12"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_two')->first()->value == '12x12' ? 'selected' : '0' }}>12x12</option>
                                        <option value="12x16"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_two')->first()->value == '12x16' ? 'selected' : '0' }}>12x16</option>
                                        <option value="13x13"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_two')->first()->value == '13x13' ? 'selected' : '0' }}>13x13</option>
                                        <option value="16x16"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_two')->first()->value == '16x16' ? 'selected' : '0' }}>16x16</option>
                                        <option value="16x20"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_two')->first()->value == '16x20' ? 'selected' : '0' }}>16x20</option>
                                        <option value="20x20"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_two')->first()->value == '20x20' ? 'selected' : '0' }}>20x20</option>
                                        <option value="20x24"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_two')->first()->value == '20x24' ? 'selected' : '0' }}>20x24</option>
                                        <option value="24x24"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_two')->first()->value == '24x24' ? 'selected' : '0' }}>24x24</option>
                                        <option value="0"      {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_two')->first()->value == '0' ? 'selected' : '0' }}>0</option>
                                    </select>
                                </td>
                                {{--                                    <td class="green"><input class="form-control" type="number" required min="1" id="outlets_value" name="labels[flu_size_two][value]" value="{{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'size_two')->first()->value }}"></td>--}}
                                <td><input class="form-control" type="text" id="rakes_overhang" required name="labels[dificut][name]" value="Difficulty"></td>
                                <td colspan="" class="no-border">
                                    <select class="form-control select2" id="home_style_value" name="labels[dificut][value]" required>
                                        <option value="0" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'dificut')->first()->value == '0' ? 'selected' : '0' }}>0</option>
                                        <option value="1" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'dificut')->first()->value == '1' ? 'selected' : '0' }}>1</option>
                                        <option value="2" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'dificut')->first()->value == '2' ? 'selected' : '0' }}>2</option>
                                        <option value="3" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'dificut')->first()->value == '3' ? 'selected' : '0' }}>3</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="form-control" type="text" id="plywood" required name="labels[flu_size_three][name]" value="Sizes"></td>
                                <td class="green">
                                    <select class="form-control select2" id="home_style_value" name="labels[flu_size_three][value]" required>
                                        <option value="8x8"    {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_three')->first()->value == '8x8' ? 'selected' : '0' }}>8x8</option>
                                        <option value="8x12"   {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_three')->first()->value == '8x12' ? 'selected' : '0' }}>8x12</option>
                                        <option value="10x10"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_three')->first()->value == '10x10' ? 'selected' : '0' }}>10x10</option>
                                        <option value="10x12"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_three')->first()->value == '10x12' ? 'selected' : '0' }}>10x12</option>
                                        <option value="12x12"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_three')->first()->value == '12x12' ? 'selected' : '0' }}>12x12</option>
                                        <option value="12x16"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_three')->first()->value == '12x16' ? 'selected' : '0' }}>12x16</option>
                                        <option value="13x13"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_three')->first()->value == '13x13' ? 'selected' : '0' }}>13x13</option>
                                        <option value="16x16"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_three')->first()->value == '16x16' ? 'selected' : '0' }}>16x16</option>
                                        <option value="16x20"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_three')->first()->value == '16x20' ? 'selected' : '0' }}>16x20</option>
                                        <option value="20x20"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_three')->first()->value == '20x20' ? 'selected' : '0' }}>20x20</option>
                                        <option value="20x24"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_three')->first()->value == '20x24' ? 'selected' : '0' }}>20x24</option>
                                        <option value="24x24"  {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_three')->first()->value == '24x24' ? 'selected' : '0' }}>24x24</option>
                                        <option value="0"      {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'flu_size_three')->first()->value == '0' ? 'selected' : '0' }}>0</option>
                                    </select>
                                </td>
                                {{--                                    <td class="green" colspan="2"><input class="form-control" type="number" required min="1" id="plywood_value" name="labels[flu_size_three][value]" value="{{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'size_three')->first()->value }}"></td>--}}
                                <td><input class="form-control" type="text" id="cover_porch" required name="labels[chimney_cap_one][name]" value="Chimney Cap"></td>
                                <td colspan="2" class="no-border">
                                    <select class="form-control select2" id="home_style_value" name="labels[chimney_cap_one][value]" required>
                                        <option value="0" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'chimney_cap_one')->first()->value == '0' ? 'selected' : '0' }}>0</option>
                                        <option value="1" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'chimney_cap_one')->first()->value == '1' ? 'selected' : '0' }}>1</option>
                                        <option value="2" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'chimney_cap_one')->first()->value == '2' ? 'selected' : '0' }}>2</option>
                                        <option value="3" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'chimney_cap_one')->first()->value == '3' ? 'selected' : '0' }}>3</option>
                                        <option value="4" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'chimney_cap_one')->first()->value == '4' ? 'selected' : '0' }}>4</option>
                                    </select>
                                </td>
                                <input type="hidden" name="labels[chimney_cap_two][name]" value="Chimney Cap">
                                <td colspan="2" class="no-border">
                                    <select class="form-control" id="home_style_value" name="labels[chimney_cap_two][value]" required>
                                        <option value="120" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'chimney_cap_two')->first()->value == '0' ? 'selected' : '0' }}>Copper</option>
                                        <option value="200" {{ $lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'chimney_cap_two')->first()->value == '1' ? 'selected' : '0' }}>Stainless</option>
                                        {{--                                        <option value="120">Copper</option>--}}
                                        {{--                                        <option value="200">Stainless</option>--}}
                                    </select>
                                </td>
                            </tr>
                        </table>
                        {{--  labels ends--}}
                    @else
                        <div class="d-flex flex-row justify-content-between">
                            <div class="form-group w-25">
                                <select name="lead_id" class="form-control select2" id="chimney_estimate_calculator_lead_id" required>
                                    <option value="" >Select Lead</option>
                                    @foreach($leads as $lead)
                                        <option value="{{$lead->id}}" @if(isset($chimneyestimatecalculator) && $chimneyestimatecalculator->lead_id == $lead->id) selected @endif>{{$lead->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="forms_button_container">
                                    <button type="button" class="btn btn-success pull-right add_chimney_value">Add Base Value</button>
                                    <div class="lead_back_btn">
                                        <a class="btn secondary_btn" href="{{ url('chimneyEstimateCalculator/chimney-estimate-calculator') }}"><i class="icon-arrow-left-circle" aria-hidden="true"></i> Back </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--  labels starts--}}
                        <table class="table table-bordered">
                            <tr>
                                <td>Lead Name:</td>
                                <td width="200" id="lead_number">{{$chimneyestimatecalculator->lead->lead_number??"000"}}</td>
                                <td colspan="2" class="no-border" id="Lead_title">{{$chimneyestimatecalculator->lead->title??""}}</td>
                                {{--                                    <td colspan="" class="no-border"></td>--}}
                                {{--                                    <td class="no-border"></td>--}}
                                <td>Date:</td>
                                <td width="200" class="green" id="lead_date" >{{$chimneyestimatecalculator->lead->lead_date??"000"}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="form-control" type="text" id="home_style" required name="labels[home_style][name]" value="Home Style" >
                                </td>
                                <td colspan="2">
                                    <select class="form-control select2" id="home_style_value" name="labels[home_style][value]" required>
                                        <option value="ranch">Ranch</option>
                                        <option value="cape">Cape</option>
                                        <option value="colonial">Colonial</option>
                                        <option value="victorian">Victorian</option>
                                    </select>
                                </td>
                                <td><input class="form-control" type="text" id="stories" required name="labels[stories][name]" value="Stories"></td>
                                <td colspan="2" class="green">
                                    <select class="form-control select2" id="home_style_value" name="labels[stories][value]" required>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><input required class="form-control" type="text" id="windows" name="labels[flu_size][name]" value="Flu Sizes"></td>
                                <td colspan="2" class="green">
                                    <select class="form-control select2" id="home_style_value" name="labels[flu_size][value]" required>
                                        <option value="8x8">8x8</option>
                                        <option value="8x8">8x12</option>
                                        <option value="8x12">10x10</option>
                                        <option value="10x12">10x12</option>
                                        <option value="12x12">12x12</option>
                                        <option value="12x16">12x16</option>
                                        <option value="13x13">13x13</option>
                                        <option value="16x16">16x16</option>
                                        <option value="16x20">16x20</option>
                                        <option value="20x20">20x20</option>
                                        <option value="20x24">20x24</option>
                                        <option value="24x24">24x24</option>
                                        <option value="0">0</option>
                                    </select>
                                </td>
                                <td><input class="form-control" type="text" id="soffit_overhang" required name="labels[pitch][name]" value="Pitch"></td>
                                <td colspan="2" class="green">
                                    <select class="form-control select2" id="home_style_value" name="labels[pitch][value]" required>
                                        <option value="0">0</option>
                                        <option value="4">4</option>
                                        <option value="6">6</option>
                                        <option value="8">8</option>
                                        <option value="10">10</option>
                                        <option value="12">12</option>
                                        <option value="14">14</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="form-control" type="text" id="doors" required name="labels[flu_size_one][name]" value="Flu Sizes"></td>
                                <td class="green">
                                    <select class="form-control select2" id="home_style_value" name="labels[flu_size_one][value]" required>
                                        <option value="8x8">8x8</option>
                                        <option value="8x8">8x12</option>
                                        <option value="8x12">10x10</option>
                                        <option value="10x12">10x12</option>
                                        <option value="12x12">12x12</option>
                                        <option value="12x16">12x16</option>
                                        <option value="13x13">13x13</option>
                                        <option value="16x16">16x16</option>
                                        <option value="16x20">16x20</option>
                                        <option value="20x20">20x20</option>
                                        <option value="20x24">20x24</option>
                                        <option value="24x24">24x24</option>
                                        <option value="0">0</option>
                                    </select>
                                </td>
                                {{--                                <td colspan="2" class="no-border"></td>--}}
                                <td><input class="form-control" type="text" id="outlets" required name="labels[flu_size_two][name]" value="Flu Sizes"></td>
                                <td class="green">
                                    <select class="form-control select2" id="home_style_value" name="labels[flu_size_two][value]" required>
                                        <option value="8x8">8x8</option>
                                        <option value="8x8">8x12</option>
                                        <option value="8x12">10x10</option>
                                        <option value="10x12">10x12</option>
                                        <option value="12x12">12x12</option>
                                        <option value="12x16">12x16</option>
                                        <option value="13x13">13x13</option>
                                        <option value="16x16">16x16</option>
                                        <option value="16x20">16x20</option>
                                        <option value="20x20">20x20</option>
                                        <option value="20x24">20x24</option>
                                        <option value="24x24">24x24</option>
                                        <option value="0">0</option>
                                    </select>
                                </td>
                                {{--                                <td colspan="2" class="no-border"></td>--}}
                                {{--                                <td></td>--}}
                                <td><input class="form-control" type="text" id="rakes_overhang" required name="labels[dificut][name]" value="Difficulty"></td>
                                <td class="no-border">
                                    <select class="form-control select2" id="home_style_value" name="labels[dificut][value]" required>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><input class="form-control" type="text" id="plywood" required name="labels[flu_size_three][name]" value="Flu Sizes"></td>
                                <td class="green">
                                    <select class="form-control select2" id="home_style_value" name="labels[flu_size_three][value]" required>
                                        <option value="8x8">8x8</option>
                                        <option value="8x8">8x12</option>
                                        <option value="8x12">10x10</option>
                                        <option value="10x12">10x12</option>
                                        <option value="12x12">12x12</option>
                                        <option value="12x16">12x16</option>
                                        <option value="13x13">13x13</option>
                                        <option value="16x16">16x16</option>
                                        <option value="16x20">16x20</option>
                                        <option value="20x20">20x20</option>
                                        <option value="20x24">20x24</option>
                                        <option value="24x24">24x24</option>
                                        <option value="0">0</option>
                                    </select>
                                </td>
                                {{--                                <td colspan="2" class="no-border"></td>--}}
                                {{--                                <td></td>--}}
                                {{--                                <td></td>--}}
                                {{--                                <td></td>--}}
                                {{--                                <td colspan="2" class="no-border"></td>--}}
                                <td colspan="2"><input class="form-control" type="text" id="cover_porch" required name="labels[chimney_cap_one][name]" value="Chimney Cap"></td>
                                <td class="no-border">
                                    <select class="form-control select2" id="home_style_value" name="labels[chimney_cap_one][value]" required>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </td>
                                <input type="hidden" name="labels[chimney_cap_two][name]" value="Chimney Cap">
                                <td class="no-border">
                                    <select class="form-control" id="home_style_value" name="labels[chimney_cap_two][value]" required>
                                        <option value="120">Copper</option>
                                        <option value="200">Stainless</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    @endif

                    @if(isset($lead->chimneyEstimateCalculator) && isset($lead->chimneyEstimateCalculator->chimneyEstimateCalculatorBricksRows))
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Letter</th>
                                <th>Bricks</th>
                                <th></th>
                                <th>Rows</th>
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
                                    <td class="green"><input class="form-control bricks" type="number" name="bricks_rows[bricks][]" value="{{ $item->bricks ?? '' }}" min="0"></td>
                                    <td class="green">X</td>
                                    <td class="green"><input class="form-control rows" type="number" name="bricks_rows[rows][]" value="{{ $item->rows ?? '' }}" min="0"></td>
                                    <td class="green"><input class="form-control calculate-final-value-bricks-rows" type="number" name="bricks_rows[total_bricks_rows][]" readonly value="{{ $item->total_bricks_rows ?? '' }}" min="0"></td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2">SubTotal</td>
{{--                                <td></td>--}}
{{--                                <td></td>--}}
                                <td colspan="2"></td>
                                <td><input id="sub_total_bricks_rows" type="number" class="form-control" name="sub_total_bricks_rows" value="{{$lead->chimneyEstimateCalculator->sub_total_bricks_rows??''}}" readonly></td>
                            </tr>
                            <tr>
                                <td colspan="2">Waste (%)</td>
{{--                                <td></td>--}}
{{--                                <td colspan="4"></td>--}}
                                <td colspan="2" class="green"><input id="waste_bricks_rows" type="number" class="form-control" name="waste_bricks_rows" min="0" value="{{$lead->chimneyEstimateCalculator->waste_bricks_rows??'10'}}"></td>
                                <td class="green"><input id="sub_total_with_waste" type="number" class="form-control" name="total_waste_bricks_rows" value="{{$lead->chimneyEstimateCalculator->total_waste_bricks_rows??''}}" readonly></td>
                            </tr>
                            <tr>
                                <td colspan="2">Total Bricks</td>
{{--                                <td></td>--}}
{{--                                <td colspan="4"></td>--}}
                                <td colspan="2"></td>
                                <td class="no-border"><input id="total_brick_rows" type="number" class="form-control" name="total_bricks_rows" value="{{$lead->chimneyEstimateCalculator->total_bricks_rows??''}}" readonly></td>
                            </tr>
                            <tr>
                                <td colspan="5"></td>
{{--                                <td></td>--}}
{{--                                <td></td>--}}
{{--                                <td></td>--}}
{{--                                <td></td>--}}
                            </tr>
                            </tbody>
                        </table>
                    @else
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Letter</th>
                                <th>Bricks</th>
                                <th></th>
                                <th>Rows</th>
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
                                    <td class="green"><input class="form-control bricks" type="number" name="bricks_rows[{{$letter}}][bricks][]" value="0" min="0"></td>
                                    <td class="green">X</td>
                                    <td class="green"><input class="form-control rows" type="number" name="bricks_rows[{{$letter}}][rows][]" value="0" min="0"></td>
                                    <td class="green"><input class="form-control calculate-final-value-bricks-rows" type="number" name="bricks_rows[{{$letter}}][total_bricks_rows][]" readonly value="1" min="0"></td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2">SubTotal</td>
{{--                                <td></td>--}}
{{--                                <td></td>--}}
                                <td colspan="2"></td>
                                <td><input id="sub_total_bricks_rows" type="number" class="form-control" name="sub_total_bricks_rows" min="0" value="0" readonly></td>
                            </tr>
                            <tr>
                                <td colspan="2">Waste (%)</td>
{{--                                <td></td>--}}
{{--                                <td colspan="4"></td>--}}
                                <td colspan="2" class="green"><input id="waste_bricks_rows" type="number" class="form-control" name="waste_bricks_rows" min="0" value="10"></td>
                                <td class="green"><input id="sub_total_with_waste" type="number" class="form-control" name="total_waste_bricks_rows" min="0" value="0" readonly></td>
                            </tr>
                            <tr>
                                <td colspan="2">Total Bricks</td>
{{--                                <td></td>--}}
{{--                                <td colspan="4"></td>--}}
                                <td colspan="2"></td>
                                <td class="no-border"><input id="total_brick_rows" type="number" class="form-control" name="total_bricks_rows" min="0" value="0" readonly></td>
                            </tr>
                            <tr>
                                <td colspan="5"></td>
{{--                                <td></td>--}}
{{--                                <td></td>--}}
{{--                                <td></td>--}}
{{--                                <td></td>--}}
                            </tr>
                            </tbody>
                        </table>
                    @endif
                    <br>
                    <table class="table table-bordered">
                        <tr>
                            <td>Notes:</td>
                            <td class="no-border"><input class="form-control" type="text" id="note" name="notes" @if(isset($lead->chimneyEstimateCalculator) && $lead->chimneyEstimateCalculator)  value="{!!  $lead->chimneyEstimateCalculator->notes??'' !!}"   @endif placeholder="Enter Any Notes"></td>
                        </tr>
                    </table>
                    <button type="submit" class="green_btn borderRadius btn-submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
    </section>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#chimney_form").validate({
                rules: {
                    lead_id: {
                        required: true,
                    },
                },
                messages: {
                    lead_id: {
                        required: "Please select a lead ID.",
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
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

        $(document).on('change', '#chimney_estimate_calculator_lead_id', function() {
            var leadId = $(this).val();
            $.ajax({
                url: '{{ url("lead_detail") }}/' + leadId,
                type: 'GET',
                success: function(response) {
                    if (response.lead) {
                        $('#lead_number').text(response.lead.lead_number ?? "000");
                        $('#Lead_title').text(response.lead.title ?? "");
                        $('#lead_date').text(response.lead.lead_date ?? "000");
                    }//ends if....
                },
                error: function(xhr) {
                    console.error(xhr);
                }
            });
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
    </script>
@endpush
