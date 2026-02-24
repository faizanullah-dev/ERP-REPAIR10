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
    <section class="white-box tabs_sec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" id="roofBase" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="measurementTab" data-bs-toggle="tab" href="#measurementContent" role="tab" aria-controls="measurementContent" aria-selected="true">Measurement</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="chimneyTab" data-bs-toggle="tab" href="#chimneyContent" role="tab" aria-controls="chimneyContent" aria-selected="false">Chimney</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="linerTab" data-bs-toggle="tab" href="#linerContent" role="tab" aria-controls="linerContent" aria-selected="false">Liner</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="tab-content">
                        <div class="tab-pane active" id="measurementContent" role="tabpanel" aria-labelledby="measurementTab">
                            <div class="back_button_flex_between">
                                <h3> Measurement </h3>
                                <div class="lead_back_btn">
                                    <a class="btn secondary_btn" href="{{ url('chimneyEstimateCalculator/chimney-estimate-calculator') }}"><i class="icon-arrow-left-circle" aria-hidden="true"></i> Back </a>
                                </div>
                            </div>
                            <form method="POST" action="{{ url('calculatorBaseValue/calculator-base-value') }}" accept-charset="UTF-8"
                                  class="form-horizontal" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <table class="table table-bordered">
                                    <tr>
                                        <td colspan="">
                                            <input class="form-control" type="text" id="home_style" name="labels[home_style][name]" value="{{ $formData['labels']['home_style']['name'] ?? 'Home Style' }}" readonly>
                                        </td>
                                        <td colspan="2">
                                            <select class="form-control" id="" name="labels[home_style][value]">
                                                <option value="ranch" {{ ($formData['labels']['home_style']['value'] ?? '') == 'ranch' ? 'selected' : '' }}>Ranch</option>
                                                <option value="cape" {{ ($formData['labels']['home_style']['value'] ?? '') == 'cape' ? 'selected' : '' }}>Cape</option>
                                                <option value="colonial" {{ ($formData['labels']['home_style']['value'] ?? '') == 'colonial' ? 'selected' : '' }}>Colonial</option>
                                                <option value="victorian" {{ ($formData['labels']['home_style']['value'] ?? '') == 'victorian' ? 'selected' : '' }}>Victorian</option>
                                            </select>
                                        </td>
                                        <td><input class="form-control" type="text" id="stories" name="labels[stories][name]" value="{{ $formData['labels']['stories']['name'] ?? 'Stories' }}" readonly></td>
                                        <td colspan="2" class="green">
                                            <select class="form-control" id="" name="labels[stories][value]">
                                                <option value="0" {{ ($formData['labels']['stories']['value'] ?? '') == '0' ? 'selected' : '' }}>0</option>
                                                <option value="1" {{ ($formData['labels']['stories']['value'] ?? '') == '1' ? 'selected' : '' }}>1</option>
                                                <option value="2" {{ ($formData['labels']['stories']['value'] ?? '') == '2' ? 'selected' : '' }}>2</option>
                                                <option value="3" {{ ($formData['labels']['stories']['value'] ?? '') == '3' ? 'selected' : '' }}>3</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input required class="form-control" type="text" id="windows" name="labels[flu_size][name]" value="{{ $formData['labels']['flu_size']['name'] ?? 'Flu Sizes' }}" readonly></td>
                                        <td class="green" colspan="2">
                                            <select class="form-control" id="" name="labels[flu_size][value]">
                                                @foreach (['8x8', '8x12', '10x10', '10x12', '12x12', '12x16', '13x13', '16x16', '16x20', '20x20', '20x24', '24x24', '0'] as $size)
                                                    <option value="{{ $size }}" {{ ($formData['labels']['flu_size']['value'] ?? '') == $size ? 'selected' : '' }}>{{ $size }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input class="form-control" type="text" id="soffit_overhang" name="labels[pitch][name]" value="{{ $formData['labels']['pitch']['name'] ?? 'Pitch' }}" readonly></td>
                                        <td colspan="2" class="green">
                                            <select class="form-control" id="" name="labels[pitch][value]">
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
                                        <td><input class="form-control" type="text" id="doors" name="labels[flu_size_one][name]" value="{{ $formData['labels']['flu_size_one']['name'] ?? 'Flu Sizes' }}" readonly></td>
                                        <td class="green">
                                            <select class="form-control" id="" name="labels[flu_size_one][value]" >
                                                @foreach (['8x8', '8x12', '10x10', '10x12', '12x12', '12x16', '13x13', '16x16', '16x20', '20x20', '20x24', '24x24', '0'] as $size)
                                                    <option value="{{ $size }}" {{ ($formData['labels']['flu_size_one']['value'] ?? '') == $size ? 'selected' : '' }}>{{ $size }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input class="form-control" type="text" id="outlets" name="labels[flu_size_two][name]" value="{{ $formData['labels']['flu_size_two']['name'] ?? 'Flu Sizes' }}" readonly></td>
                                        <td class="green">
                                            <select class="form-control" id="" name="labels[flu_size_two][value]">
                                                @foreach (['8x8', '8x12', '10x10', '10x12', '12x12', '12x16', '13x13', '16x16', '16x20', '20x20', '20x24', '24x24', '0'] as $size)
                                                    <option value="{{ $size }}" {{ ($formData['labels']['flu_size_two']['value'] ?? '') == $size ? 'selected' : '' }}>{{ $size }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input class="form-control" type="text" id="rakes_overhang" name="labels[dificut][name]" value="{{ $formData['labels']['dificut']['name'] ?? 'Difficulty' }}" readonly></td>
                                        <td colspan="" class="no-border">
                                            <select class="form-control" id="" name="labels[dificut][value]">
                                                <option value="0" {{ ($formData['labels']['dificut']['value'] ?? '') == '0' ? 'selected' : '' }}>0</option>
                                                <option value="1" {{ ($formData['labels']['dificut']['value'] ?? '') == '1' ? 'selected' : '' }}>1</option>
                                                <option value="2" {{ ($formData['labels']['dificut']['value'] ?? '') == '2' ? 'selected' : '' }}>2</option>
                                                <option value="3" {{ ($formData['labels']['dificut']['value'] ?? '') == '3' ? 'selected' : '' }}>3</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input class="form-control" type="text" id="insulation" name="labels[flu_size_three][name]" value="{{ $formData['labels']['flu_size_three']['name'] ?? 'Flu Sizes' }}" readonly></td>
                                        <td colspan="2" class="green">
                                            <select class="form-control" id="" name="labels[flu_size_three][value]">
                                                @foreach (['8x8', '8x12', '10x10', '10x12', '12x12', '12x16', '13x13', '16x16', '16x20', '20x20', '20x24', '24x24', '0'] as $size)
                                                    <option value="{{ $size }}" {{ ($formData['labels']['flu_size_three']['value'] ?? '') == $size ? 'selected' : '' }}>{{ $size }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input class="form-control" type="text" id="chimney_cap" name="labels[chimney_cap_one][name]" value="{{ $formData['labels']['chimney_cap_one']['name'] ?? 'Chimney Cap' }}" readonly></td>
                                        <td class="green">
                                            <select class="form-control" id="" name="labels[chimney_cap_one][value]">
                                                <option value="0" {{ ($formData['labels']['chimney_cap_one']['value'] ?? '') == '0' ? 'selected' : '' }}>0</option>
                                                <option value="1" {{ ($formData['labels']['chimney_cap_one']['value'] ?? '') == '1' ? 'selected' : '' }}>1</option>
                                                <option value="2" {{ ($formData['labels']['chimney_cap_one']['value'] ?? '') == '2' ? 'selected' : '' }}>2</option>
                                                <option value="3" {{ ($formData['labels']['chimney_cap_one']['value'] ?? '') == '3' ? 'selected' : '' }}>3</option>
                                                <option value="4" {{ ($formData['labels']['chimney_cap_one']['value'] ?? '') == '4' ? 'selected' : '' }}>4</option>
                                            </select>
                                        </td>
                                        <td class="green">
                                            <select class="form-control" id="" name="labels[chimney_cap_two][value]" >
                                                <option value="copper" {{ ($formData['labels']['chimney_cap_two']['value'] ?? '') == 'copper' ? 'selected' : '' }}>Copper</option>
                                                <option value="stainless" {{ ($formData['labels']['chimney_cap_two']['value'] ?? '') == 'stainless' ? 'selected' : '' }}>Stainless</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
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
                                            <td class="green"><input class="form-control bricks" type="number" name="bricks_rows[{{$letter}}][bricks][]" value="{{ $formData['bricks_rows'][$letter]['bricks'][0] ?? 0 }}"  min="0"></td>
                                            <td class="green">X</td>
                                            <td class="green"><input class="form-control rows" type="number" name="bricks_rows[{{$letter}}][rows][]" value="{{ $formData['bricks_rows'][$letter]['rows'][0] ?? 0 }}" min="0"></td>
                                            <td class="green"><input class="form-control calculate-final-value-bricks-rows" type="number" name="bricks_rows[{{$letter}}][total_bricks_rows][]" readonly value="{{ $formData['bricks_rows'][$letter]['total_bricks_rows'][0] ?? 0 }}" min="0"></td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2">SubTotal</td>
                                        <td colspan="2"></td>
                                        <td><input id="sub_total_bricks_rows" type="number" class="form-control" name="sub_total_bricks_rows" min="0"  value="{{ $formData['sub_total_bricks_rows'] ?? 0 }}" readonly></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Waste (%)</td>
                                        <td colspan="2" class="green"><input id="waste_bricks_rows" type="text" class="form-control" name="waste_bricks_rows" value="{{ $formData['waste_bricks_rows'] ?? 0 }}"></td>
                                        <td class="green"><input id="sub_total_with_waste" type="number" class="form-control" name="total_waste_bricks_rows" min="0"  value="{{ $formData['total_waste_bricks_rows'] ?? 0 }}" readonly></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Total Bricks</td>
                                        <td colspan="2"></td>
                                        <td class="no-border"><input id="total_brick_rows" type="number" class="form-control" name="total_bricks_rows" min="0"  value="{{ $formData['total_bricks_rows'] ?? 0 }}" readonly></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <button type="submit" class="green_btn borderRadius btn-submit" onclick="this.disabled = true; this.form.submit();">Submit</button>
                            </form>
                        </div>
                        <div class="tab-pane" id="chimneyContent" role="tabpanel" aria-labelledby="chimneyTab">
                            <form action="{{ route('store_chimney_base_chimney') }}" class="row" method="post">
                                @csrf
                                <div class="col-md-12">
                                    <h3>Chimney Estimation Calculator (Chimney Rebuild)</h3>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th colspan="3">Recommended Price</th>
                                            <th colspan="2" class="text-right"><input class="form-control" type="text" name="recommended_price" id="chimney_recommended_price" value="" readonly></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                        </tr>
                                        <tr>
                                            <td>Chimney Price</td>
                                            <td></td>
                                            <td></td>
                                            <td><input class="form-control" type="text" name="chimney_price" id="chimney_price" value="" readonly ></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Bricks</td>
                                            <td><input class="form-control" type="text" name="bricks" id="bricks_value" value="" readonly></td>
                                            <td>Price Per SQ</td>
                                        </tr>
                                        <tr>
                                            <td>Stories</td>
                                            <td><input class="form-control" type="text" name="stories" id="stories_value" value="" readonly></td>
                                            <td><input class="form-control" type="text" name="chimney[stories]" id="total_stories_value" value="{{ $chimneyChimney->stories??"" }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Pitch</td>
                                            <td><input class="form-control" type="text" name="pitch" id="pitch_value" value="" readonly></td>
                                            <td><input class="form-control" type="text" name="chimney[pitch]" id="total_pitch_value" value="{{ $chimneyChimney->pitch??"" }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Difficulty</td>
                                            <td><input class="form-control" type="text" name="dificultie" id="dificultie_value" readonly value=""></td>
                                            <td><input class="form-control" type="text" name="chimney[difficulty]" id="total_dificultie_value" value="{{ $chimneyChimney->difficulty??"" }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Cap</td>
                                            <td><input  class="form-control" type="text" name="chimney_cap" id="cap_value" value="" readonly></td>
                                            <td><input class="form-control" type="text" name="chimney[cap]" id="total_cap_value" value="@if($formData['labels']['chimney_cap_two']['value'] == 'copper') 120 @elseif($formData['labels']['chimney_cap_two']['value'] == 'stainless') 200 @else 0 @endif" readonly></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Miscellaneous</td>
                                            <td></td>
                                            <td>
                                                <input  class="form-control only-numbers" placeholder="Type Here..." value="" type="number" name="miscellaneous" id="miscellaneous" readonly @if(!auth()->user()->can('edit-chimneyestimatecalculator')) readonly @endif>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-project" style="background-color: lightyellow;">Project Cost</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Materials</td>
                                            <td></td>
                                            <td><input class="form-control" type="text" name="chimney[material]" id="material_value" value="{{ $chimneyChimney->material??"" }}" @if(!auth()->user()->can('edit-chimneyestimatecalculator')) readonly @endif></td>
                                            <td><input class="form-control" type="text" name="total_material_value" id="total_material_value" readonly ></td>
                                        </tr>
                                        <tr>
                                            <td>Labor</td>
                                            <td></td>
                                            <td><input class="form-control" type="text" name="chimney[labor]" id="labor_value" value="{{ $chimneyChimney->labor??"" }}" @if(!auth()->user()->can('edit-chimneyestimatecalculator')) readonly @endif></td>
                                            <td><input class="form-control" type="text" name="total_labor_value" id="total_labor_value" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Dumpster%</td>
                                            <td></td>
                                            <td><input class="form-control" type="text" name="chimney[dumpster]" id="dumpster_value" value="{{ $chimneyChimney->dumpster??"" }}" @if(!auth()->user()->can('edit-chimneyestimatecalculator')) readonly @endif></td>
                                            <td><input class="form-control" type="text" name="total_dumpster_value" id="total_dumpster_value" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Permit / Warranty%</td>
                                            <td></td>
                                            <td><input class="form-control" type="text" name="chimney[permit_warranty]" id="permit_warranty_value" value="{{ $chimneyChimney->permit_warranty??"" }}" @if(!auth()->user()->can('edit-chimneyestimatecalculator')) readonly @endif></td>
                                            <td><input class="form-control" type="text" name="total_permit_warranty_value" id="total_permit_warranty_value" readonly></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="bg-project">
                                            <td colspan="3">PROJECT COST</td>
                                            <td colspan="2"><input class="form-control" type="text" name="project_cost" id="project_cost" value="" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Margin Profit</td>
                                            <td></td>
                                            <td></td>
                                            <td><input class="form-control" type="text" name="chimney[margin_profit]" id="margin_profit_value" value="{{ $chimneyChimney->margin_profit??"" }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Sales%</td>
                                            <td><input class="form-control" type="text" name="chimney[sales]" id="sales_value" value="{{ $chimneyChimney->sales??"" }}" @if(!auth()->user()->can('edit-chimneyestimatecalculator')) readonly @endif></td>
                                            <td></td>
                                            <td><input class="form-control" type="text" name="total_sales_value" id="total_sales_value" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Direct Cost</td>
                                            <td></td>
                                            <td></td>
                                            <td><input class="form-control" type="text" name="direct_cost" id="direct_cost" value="" readonly></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="bg-net-profit">
                                            <td colspan="3">Net Profit</td>
                                            <td colspan="2"><input class="form-control" type="text" name="net_profit" id="net_profit" value="" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Margin%</td>
                                            <td></td>
                                            <td></td>
                                            <td><input class="form-control" type="text" name="margin_percent" id="margin_value" value="" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Net Profit%</td>
                                            <td></td>
                                            <td></td>
                                            <td><input class="form-control" type="text" name="net_profit_percent" id="net_profit_value" value="" readonly></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <button type="submit" class="green_btn borderRadius btn-submit">Submit</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="linerContent" role="tabpanel" aria-labelledby="linerTab">
                            <form action="{{ route('store_chimney_margin_profit') }}" class="row" method="post">
                                @csrf
                                <input type="hidden" name="chimney_estimate_calculator_id" value="">
                                <div class="col-md-6">
                                    <table class="table table-bordered table-custom">
                                        <thead>
                                        <div class="col-md-12">
                                            <h3>Chimney Estimation Calculator (Liner)</h3>
                                        </div>
                                        <tr>
                                            <th colspan="3">Recommended Price</th>
                                            <td class="highlight">
                                                <input  class="form-control only-numbers" type="text" name="recommended_price" id="liner_recommended_price" value="" readonly>
                                            </td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="home_style" id="colonial" value="" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" min="0" name="home_style_value" id="colonial_value" value="" readonly>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="total" value="Total" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" min="0" name="total_value" id="total_value" value="" readonly>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Miscellaneous</td>
                                            <td>
                                                <input  class="form-control only-numbers" value="" type="number" name="miscellaneous" id="miscellaneous" readonly @if(!auth()->user()->can('edit-chimneyestimatecalculator')) readonly @endif>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="highlight-yellow">
                                            <td>Project Cost</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Materials</td>
                                            <td></td>
                                            <td>
                                                <input  class="form-control only-numbers" min="0" type="text" name="liner[material]" id="material" value="{{ $chimneyLiner->material??"" }}" @if(!auth()->user()->can('edit-chimneyestimatecalculator')) readonly @endif>

                                            </td>
                                            <td>
                                                <input  class="form-control only-numbers" min="0" type="text" name="total_material_value" id="liner_material_value" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Labor</td>
                                            <td></td>
                                            <td>
                                                <input  class="form-control only-numbers" min="0" type="text" name="liner[labor]" id="labor" value="{{ $chimneyLiner->labor??"" }}" @if(!auth()->user()->can('edit-chimneyestimatecalculator')) readonly @endif>

                                            </td>
                                            <td>
                                                <input  class="form-control only-numbers" min="0" type="text" name="total_labor_value" id="liner_labor_value" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Permit %</td>
                                            <td></td>
                                            <td>
                                                <input  class="form-control only-numbers" min="0" type="text" name="liner[permit_warranty]" id="permit" value="{{ $chimneyLiner->permit_warranty??"" }}" @if(!auth()->user()->can('edit-chimneyestimatecalculator')) readonly @endif>

                                            </td>
                                            <td>
                                                <input  class="form-control only-numbers" min="0" type="text" name="total_permit_warranty_value" id="permit_value" value="" readonly readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="highlight-yellow">
                                            <td>Project Cost</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input  class="form-control only-numbers" min="0" type="text" name="project_cost" id="liner_project_cost" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Margin Profit</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input  class="form-control only-numbers" min="0" type="text" name="liner[margin_profit]" id="margin_profit" value="{{ $chimneyLiner->margin_profit??"" }}" >
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sales %</td>
                                            <td>
                                                <input  class="form-control only-numbers" min="0" type="text" name="liner[sales]" id="sales_percentage" value="{{ $chimneyLiner->sales??"" }}" @if(!auth()->user()->can('edit-chimneyestimatecalculator')) readonly @endif>
                                            </td>
                                            <td></td>
                                            <td>
                                                <input  class="form-control only-numbers" min="0" type="text" name="total_sales_value" id="sales_total" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr class="highlight-red">
                                            <td>Direct Cost</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input  class="form-control only-numbers" min="0" type="text" name="direct_cost" id="direct_cost" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="highlight-blue">
                                            <td>Net Profit</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input  class="form-control only-numbers" min="0" type="text" name="net_profit" id="net_profit" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Margin %</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input  class="form-control only-numbers" min="0" type="text" name="margin_percent" id="margin_percentage" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Net Profit %</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input  class="form-control only-numbers" min="0" type="text" name="net_profit_percent" id="net_profit_percentage" value="" readonly>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <button type="submit" class="green_btn borderRadius btn-submit">Submit</button>
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
    <script>
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
    </script>
@endpush
