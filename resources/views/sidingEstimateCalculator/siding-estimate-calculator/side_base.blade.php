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
                            <a class="nav-link" id="replacementTab" data-bs-toggle="tab" href="#replacementContent" role="tab" aria-controls="replacementContent" aria-selected="false">Replacement</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="overExistingTab" data-bs-toggle="tab" href="#overExistingContent" role="tab" aria-controls="overExistingContent" aria-selected="false">Over Existing</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="gutterTab" data-bs-toggle="tab" href="#gutterContent" role="tab" aria-controls="gutterContent" aria-selected="false">Gutter</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-12">
                    <div class="tab-content">
                        <div class="tab-pane active" id="measurementContent" role="tabpanel" aria-labelledby="measurementTab">
                            <div class="back_button_flex_between">
                                <h3> Measurement </h3>
                                <div class="lead_back_btn">
                                    <a class="btn secondary_btn" href="{{ url('sidingEstimateCalculator/siding-estimate-calculator') }}"><i class="icon-arrow-left-circle" aria-hidden="true"></i> Back </a>
                                </div>
                            </div>
                            <form class="" action="{{ route('store_siding') }}" method="post">
                                @csrf
                                    {{--  labels starts--}}
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>
                                                <input class="form-control" type="text" id="home_style" name="labels[home_style][name]" value="Home Style" readonly>
                                            </td>
                                            <td colspan=""><input class="form-control" type="text" id="home_style_value" name="labels[home_style][value]" value="{{ $formData['labels']['home_style']['value'] ?? 0 }}" placeholder="Type Here..."></td>
                                            <td><input class="form-control" type="text" id="stories" name="labels[stories][name]" value="Stories" readonly></td>
                                            <td colspan="" class="green"><input class="form-control" type="number" min="0" id="stories_value" name="labels[stories][value]" value="{{ $formData['labels']['stories']['value'] ?? 0 }}"></td>
                                            <td><input class="form-control" type="text" id="layers" name="labels[layers][name]" value="Layers" readonly></td>
                                            <td class="green" colspan="3"><input class="form-control" type="number" min="0" id="layers_value" name="labels[layers][value]" value="{{ $formData['labels']['layers']['value'] ?? 0 }}"></td>
                                        </tr>
                                        <tr>
                                            <td><input class="form-control" type="text" id="windows" name="labels[windows][name]" value="Windows" readonly></td>
                                            <td class="green"><input class="form-control" type="number" min="0" id="windows_value" name="labels[windows][value]" value="{{ $formData['labels']['windows']['value'] ?? 0 }}"></td>
                                            <td><input class="form-control" type="text" id="lights" name="labels[lights][name]" value="Lights" readonly></td>
                                            <td class="green"><input class="form-control" type="number" min="0" id="lights_value" name="labels[lights][value]" value="{{ $formData['labels']['lights']['value'] ?? 0 }}"></td>
                                            <td><input class="form-control" type="text" id="soffit_overhang" name="labels[soffit_overhang][name]" value="Soffit Overhang" readonly></td>
                                            <td colspan="" class="green"><input class="form-control" type="number" min="0" id="soffit_overhang_value" name="labels[soffit_overhang][value]" value="{{ $formData['labels']['soffit_overhang']['value'] ?? 0 }}"></td>
                                            <td><input class="form-control" type="text" id="facia_inches" name="labels[facia_inches][name]" value="Facia Inches" readonly></td>
                                            <td colspan="" class="green"><input class="form-control" type="number" min="0" id="facia_inches_value" name="labels[facia_inches][value]" value="{{ $formData['labels']['facia_inches']['value'] ?? 0 }}"></td>
                                        </tr>

                                        <tr>
                                            <td><input class="form-control" type="text" id="doors" name="labels[doors][name]" value="Doors" readonly></td>
                                            <td class="green"><input class="form-control" type="number" min=0" name="labels[doors][value]" value="{{ $formData['labels']['doors']['value'] ?? 0 }}"></td>

                                            <td><input class="form-control" type="text" id="outlets" name="labels[outlets][name]" value="Outlets" readonly></td>
                                            <td class="green"><input class="form-control" type="number" min="0" id="outlets_value" name="labels[outlets][value]" value="{{ $formData['labels']['outlets']['value'] ?? 0 }}"></td>
                                            <td><input class="form-control" type="text" id="rakes_overhang" name="labels[rakes_overhang][name]" value="Rakes Overhang" readonly></td>
                                            <td colspan="" class="no-border"><input class="form-control" type="number" min="0" id="rakes_overhang_value" name="labels[rakes_overhang][value]" value="{{ $formData['labels']['rakes_overhang']['value'] ?? 0 }}"></td>
                                            <td><input class="form-control" type="text" id="rakes_inches" name="labels[rakes_inches][name]" value="Rake Inches" readonly></td>
                                            <td colspan="" class="no-border"><input class="form-control" type="number" id="rakes_inches_value" name="labels[rakes_inches][value]" value="{{ $formData['labels']['rakes_inches']['value'] ?? 0 }}"></td>
                                        </tr>
                                        <tr>
                                            <td><input class="form-control" type="text" id="plywood" name="labels[plywood][name]" value="Plywood" readonly></td>
                                            <td class="green"><input class="form-control" type="number" min="0" id="plywood_value" name="labels[plywood][value]" value="{{ $formData['labels']['plywood']['value'] ?? 0 }}"></td>
                                            <td><input class="form-control" type="text" id="cover_porch" name="labels[cover_porch][name]" value="Cover Porch" readonly></td>
                                            <td colspan="" class="no-border"><input class="form-control" type="number" min="0" id="cover_porch_value" name="labels[cover_porch][value]" value="{{ $formData['labels']['cover_porch']['value'] ?? 0 }}"></td>
                                            <td><input class="form-control" type="text" id="shatter" name="labels[shatter][name]" value="Shatters" readonly></td>
                                            <td colspan="3" class="no-border"><input class="form-control" type="number" id="shatter_value" name="labels[shatter][value]" value="{{ $formData['labels']['shatter']['value'] ?? 0 }}"></td>
                                        </tr>
                                        <tr>
                                            <td><input class="form-control" type="text" id="gutter" name="labels[gutter][name]" value="Gutters" readonly></td>
                                            <td colspan="" class="no-border"><input class="form-control" type="number" min="0" id="gutter_value" name="labels[gutter][value]" value="{{ $formData['labels']['gutter']['value'] ?? 0 }}"></td>
{{--                                            <td><input class="form-control" type="text" id="azeck_base" name="labels[azeck_base][name]" value="Azeck" readonly></td>--}}
{{--                                            <td colspan="" class="no-border"><input class="form-control" type="number" min="0" id="azeck_value" name="labels[azeck_base][value]" value="{{ $formData['labels']['azeck_base']['value'] ?? 0 }}"></td>--}}
{{--                                            <td><input class="form-control" type="text" id="wood_base" name="labels[wood_base][name]" value="Wood" readonly></td>--}}
{{--                                            <td colspan="3" class="no-border"><input class="form-control" type="number" min="0" id="wood_value" name="labels[wood_base][value]" value="{{ $formData['labels']['wood_base']['value'] ?? 0 }}"></td>--}}
                                        </tr>


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
                                        <td class="orange"> <input id="eaves_value_eave" type="number" class="form-control" name="soffit_eave" value="{{ $formData['soffit_eave'] ?? 0 }}" min="0"></td>
                                        <td class="orange"> <input id="eaves_with_soffit_overhang" type="number" class="form-control" name="soffit_eave_total" min="0" value="{{ $formData['soffit_eave_total'] ?? 0 }}" readonly></td>
                                        <td class="orange"> <input id="eaves_with_soffit_overhang_divide" type="number" class="form-control" name="soffit_eave_percent" min="0" value="{{ $formData['soffit_eave_percent'] ?? 0 }}" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Rakes</td>
                                        <td class="orange"> <input id="rakes_value" type="number" class="form-control" name="soffit_rakes" value="{{ $formData['soffit_rakes'] ?? 0 }}" min="0"></td>
                                        <td class="orange"> <input id="rakes_with_rakes_overhang" type="number" class="form-control" name="soffit_rakes_total" value="{{ $formData['soffit_rakes_total'] ?? 0 }}" min="0" readonly></td>
                                        <td class="orange"> <input id="rakes_with_rakes_overhang_divide" type="number" class="form-control" name="soffit_rakes_percent" value="{{ $formData['soffit_rakes_percent'] ?? 0 }}" min="0" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Porch</td>
                                        <td class="orange"> <input id="porch_value" type="number" class="form-control" name="soffit_porch" value="{{ $formData['soffit_porch'] ?? 0 }}" min="0"></td>
                                        <td class="orange"> <input id="porch_with_cover_porch" type="number" class="form-control" name="soffit_porch_total" value="{{ $formData['soffit_porch_total'] ?? 0 }}" min="0" readonly></td>
                                        <td class="orange"> <input id="porch_with_cover_porch_divide" type="number" class="form-control" name="soffit_porch_percent" value="{{ $formData['soffit_porch_percent'] ?? 0 }}" min="0" readonly></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="orange"> <input id="total_sum_divide" type="number" class="form-control" name="soffit_total_sum" value="{{ $formData['soffit_total_sum'] ?? 0 }}" min="0" readonly></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <br>
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
                                                <td colspan="" class="green"><input class="form-control rakes" type="number" name="eave_rakes[{{$letter}}][rakes][]" value="{{ $formData['eave_rakes'][$letter]['rakes'][0] ?? 0 }}" min="0" step="0.01"></td>
                                                <td class="green">X</td>
                                                <td class="green"><input class="form-control eave_final_rakes" type="number" name="eave_rakes[{{$letter}}][eave_final_rakes][]" value="{{ $formData['eave_rakes'][$letter]['eave_final_rakes'][0] ?? 0 }}" min="0" step="0.01"></td>
                                                <td class="green"><input class="form-control calculate-final-value-eave-rakes" type="number" name="eave_rakes[{{$letter}}][eave_final_rakes_total][]" readonly value="{{ $formData['eave_rakes'][$letter]['eave_final_rakes_total'][0] ?? 0 }}" min="0"></td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3">SUBTOTAL</td>
                                            <td colspan="3"></td>
                                            <td><input id="sub_total_eave_rakes" type="number" class="form-control" name="eave_rakes_subtotal" min="0" value="{{ $formData['eave_rakes_subtotal'] ?? 0 }}" readonly></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">WASTE (%)</td>
                                            <td class="green"><input id="waste_eave_rakes" type="number" class="form-control" name="waste_eave_rakes" min="0" value="{{ $formData['waste_eave_rakes'] ?? 0 }}" step="0.01"></td>
                                            <td colspan="2"></td>
                                            <td class="green"><input id="sub_total_with_waste" type="number" class="form-control" name="waste_percent_eave_rakes" min="0" value="{{ $formData['waste_percent_eave_rakes'] ?? 0 }}" readonly></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">TOTAL</td>
                                            <td colspan="3"></td>
                                            <td class="no-border"> <input id="total_eave_rakes" type="number" class="form-control" name="eave_rakes_total" min="0" value="{{ $formData['eave_rakes_total'] ?? 0 }}" readonly></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"></td>
                                            <td class="no-border"> <input id="divide_total_eave_rakes" type="number" class="form-control" name="eave_rakes_total_percent" value="{{ $formData['eave_rakes_total_percent'] ?? 0 }}" min="0" readonly></td>
                                        </tr>

                                        </tbody>
                                    </table>
                                    {{--eave rakes ends--}}
                                <br>
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
                                            $letters = generateLettersFlatArea('A', 'I'); // Generate letters from A to I
                                        @endphp
                                        @foreach ($letters as $index => $letter)
                                            <tr>
                                                <td>{{ $letter }}</td>
                                                <td class="green">
                                                    <input class="form-control gutters" type="number" name="downspouts[gutters][]" value="{{ $formData['downspouts']['gutters'][$index] ?? 0 }}" min="0" step="0.01">
                                                </td>
                                                <td class="green">
                                                    <input class="form-control downspouts" type="number" name="downspouts[downspouts][]" value="{{ $formData['downspouts']['downspouts'][$index] ?? 0 }}" min="0" step="0.01">
                                                </td>
                                                <td class="green">
                                                    <input class="form-control guards" type="number" name="downspouts[guards][]" value="{{ $formData['downspouts']['guards'][$index] ?? 0 }}" min="0" step="0.01">
                                                </td>
                                            </tr>
                                            <div style="display: none;">
                                                <input type="hidden" name="downspouts[letters][]" value="{{ $letter }}">
                                            </div>
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

                                        </tbody>
                                    </table>
                                    {{-- FLATAREA ends--}}
                                <button type="submit" class="green_btn borderRadius btn-submit">Submit</button>
                            </form>
                        </div>

                        <div class="tab-pane" id="replacementContent" role="tabpanel" aria-labelledby="replacementTab">
                            <form action="{{ route('store_side_base_replacement') }}" class="row" method="post">
                                @csrf
                                <div class="col-md-12">
                                    <h3>Side Estimation Calculator (Repalcement)</h3>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th colspan="3">Recommended Price</th>
                                            <th colspan="2" class="text-right"><input class="form-control" type="text" name="recommended_price" id="replacement_recommended_price" value="" readonly></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                        </tr>
                                        <tr>
                                            <td>Siding Price</td>
                                            <td></td>
                                            {{--                        <td><input type="text" name="siding_price_value" id="siding_price_value"></td>--}}
                                            <td>Price Per SQ</td>
                                            <td><input class="form-control" type="text" name="price_per_sq_value" id="replacement_price_per_sq_value" value="" readonly ></td>

                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>

                                        </tr>
                                        <tr>
                                            <td>SQ</td>

                                            <td><input class="form-control" type="text" name="siding_sq_value" id="replacement_siding_sq_value" value="" readonly></td>
                                            <td>Price Per SQ</td>

                                        </tr>
                                        <tr>
                                            <td>Soffit</td>
                                            <td><input class="form-control" type="text" name="siding_soffit_value" id="replacement_siding_soffit_value" value="" readonly></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Additional layer</td>
                                            <td><input class="form-control" type="text" name="additional_layer_value" id="replacement_additional_layer_value" value="" readonly></td>
                                            <td><input class="form-control" type="text" name="replacement[additional_layer]" id="replacement_additional_layer_per_sq_value" value="{{ $sideBaseValue['side_replacement']['additional_layer']??"" }}" ></td>
                                        </tr>
                                        <tr>
                                            <td>Windows / Doors</td>
                                            <td><input class="form-control" type="text" name="window_door_value" id="replacement_window_door_value" readonly value=""></td>
                                            <td><input class="form-control" type="text" name="replacement[window]" id="replacement_window_door_per_sq_value" value="{{ $sideBaseValue['side_replacement']['window']??"" }}" ></td>
                                        </tr>
                                        <tr>
                                            <td>Aluminium Trim</td>
                                            <td><input class="form-control" type="text" name="aluminium_trim_value" id="replacement_aluminium_trim_value" value=""  readonly></td>
                                            <td><input class="form-control" type="text" name="replacement[aluminium_trim]" id="replacement_aluminium_trim_per_sq_value" value="{{ $sideBaseValue['side_replacement']['aluminium_trim']??"" }}"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Azeck</td>
                                            <td><input class="form-control" type="text" name="azeck_value_replacement" id="replacement_azeck_wood_value" value="" readonly></td>
                                            <td><input class="form-control" type="text" name="replacement[azeck]" id="replacement_azeck_wood_per_sq_value" value="{{ $sideBaseValue['side_replacement']['azeck']??"" }}"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Wood</td>
                                            <td><input class="form-control" type="text" name="wood_value_replacement" id="replacement_azeck_wood_value" value="" readonly></td>
                                            <td><input class="form-control" type="text" name="replacement[wood]" id="replacement_azeck_wood_per_sq_value" value="{{ $sideBaseValue['side_replacement']['wood']??"" }}"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Shatters</td>
                                            <td><input class="form-control" type="text" name="shutter_value" id="replacement_shutter_value" value="" readonly></td>
                                            <td><input class="form-control" type="text" name="replacement[shatters]" id="replacement_shutter_per_sq_value" value="{{ $sideBaseValue['side_replacement']['shatters']??"" }}"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Plywood</td>
                                            <td><input class="form-control" type="text" name="plywood_value" id="replacement_plywood_value" value="" readonly></td>
                                            <td><input class="form-control" type="text" name="replacement[plywood]" id="replacement_plywood_per_sq_value" value="{{ $sideBaseValue['side_replacement']['plywood']??"" }}" ></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Miselanies</td>
                                            <td></td>
                                            <td><input class="form-control" type="text" name="miscellaneous" id="replacement_miscellaneous" value="" readonly @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                            <td></td>
                                        </tr>
                                        <tr class="bg-project">
                                            <td colspan="3">PROJECT COST</td>
                                            <td colspan="2"><input class="form-control" type="text" name="project_cost" id="replacement_project_cost" value="" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Materials</td>
                                            <td></td>
                                            <td><input class="form-control" type="text" name="replacement[material_value]" id="replacement_material_value" value="{{ $sideBaseValue['side_replacement']['material_value']??"" }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                            <td><input class="form-control" type="text" name="total_material_value" id="replacement_total_material_value" value="" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Labor</td>
                                            <td></td>
                                            <td><input class="form-control" type="text" name="replacement[labor_value]" id="replacement_labor_value" value="{{ $sideBaseValue['side_replacement']['labor_value']??"" }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                            <td><input class="form-control" type="text" name="total_labor_value" id="replacement_total_labor_value" value="" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Dumpster%</td>
                                            <td></td>
                                            <td><input class="form-control" type="text" name="replacement[dumpster_value]" id="replacement_dumpster_value" value="{{ $sideBaseValue['side_replacement']['dumpster_value']??"" }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                            <td><input class="form-control" type="text" name="total_dumpster_value" id="replacement_total_dumpster_value" value="" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Permit / Warranty%</td>
                                            <td></td>
                                            <td><input class="form-control" type="text" name="replacement[permit_warranty_value]" id="replacement_permit_warranty_value" value="{{ $sideBaseValue['side_replacement']['permit_warranty_value']??"" }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                            <td><input class="form-control" type="text" name="total_permit_warranty_value" id="replacement_total_permit_warranty_value" value="" readonly></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="bg-total">
                                            <td colspan="3">Total</td>
                                            <td></td>
                                            {{--                        <td colspan="2"><input class="form-control" type="text" name="total_cost" id="total_cost" value="0.00" readonly></td>--}}
                                        </tr>
                                        <tr>
                                            <td>Margin Profit</td>
                                            <td></td>
                                            <td></td>
                                            <td><input class="form-control" type="text" name="replacement[margin_profit]" id="replacement_margin_profit_value" value="{{ $sideBaseValue['side_replacement']['margin_profit']??"" }}" ></td>
                                        </tr>
                                        <tr>
                                            <td>Super%</td>
                                            <td><input class="form-control" type="text" name="replacement[super_value]" id="replacement_super_value" value="{{ $sideBaseValue['side_replacement']['super_value']??"" }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                            <td></td>
                                            <td><input class="form-control" type="text" name="total_super_value" id="replacement_total_super_value" value="" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Sales%</td>
                                            <td><input class="form-control" type="text" name="replacement[sales_value]" id="replacement_sales_value" value="{{ $sideBaseValue['side_replacement']['sales_value']??"" }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>

                                            <td></td>
                                            <td><input class="form-control" type="text" name="total_sales_value" id="replacement_total_sales_value" value="" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Direct Cost</td>

                                            <td></td>
                                            <td></td>
                                            <td><input class="form-control" type="text" name="direct_cost_value" id="replacement_direct_cost_value" value="" readonly></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="bg-net-profit">
                                            <td colspan="3">Net Profit</td>
                                            <td colspan="2"><input class="form-control" type="text" name="net_profit" id="replacement_net_profit" value="" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>%</td>
                                            <td></td>
                                            <td><input class="form-control" type="text" name="sub_total_value" id="replacement_sub_total_value" value="" readonly></td>
                                            <td><input class="form-control" type="text" name="total_sub_total_value" id="replacement_total_sub_total_value" value="" readonly></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <button type="submit" class="green_btn borderRadius btn-submit">Submit</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="overExistingContent" role="tabpanel" aria-labelledby="overExistingTab">
                            <form action="{{ route('store_side_base_over_existing') }}" class="row" method="post">
                                @csrf
                                <div class="col-md-12">
                                    <h3>Side Estimation Calculator (Over Existing)</h3>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th colspan="3">Recommended Price</th>
                                            <th colspan="2" class="text-right"><input class="form-control" type="text" name="recommended_price" id="over_recommended_price" value="{{ $sidingEstimateCalculator->storeSidingOverExisting->recommended_price??'0' }}" readonly></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>

                                        </tr>
                                        <tr>
                                            <td>Siding Price</td>
                                            <td></td>
                                            <td>Price Per SQ</td>
                                            <td><input class="form-control" type="text" name="price_per_sq_value" id="price_per_sq_value" value="0.00" readonly ></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>SQ</td>
                                            <td><input class="form-control" type="text" name="siding_sq_value" id="over_siding_sq_value" value="" readonly></td>
                                            <td>Price Per SQ</td>
                                        </tr>
                                        <tr>
                                            <td>Soffit</td>
                                            <td><input class="form-control" type="text" name="siding_soffit_value" id="over_siding_soffit_value" value="" readonly></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Additional layer</td>
                                            <td><input class="form-control" type="text" name="additional_layer_value" id="over_additional_layer_value" value="" readonly></td>
                                            <td><input class="form-control" type="text" name="existing[additional_layer]" id="additional_layer_per_sq_value" value="{{ $sideBaseValue['side_over_existing']['additional_layer']??"" }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Windows / Doors</td>
                                            <td><input class="form-control" type="text" name="window_door_value" id="over_window_door_value" readonly value=""></td>
                                            <td><input class="form-control" type="text" name="existing[window]" id="window_door_per_sq_value" value="{{ $sideBaseValue['side_over_existing']['window']??"" }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Aluminium Trim</td>
                                            <td><input class="form-control" type="text" name="aluminium_trim_value" id="over_aluminium_trim_value"value=""  readonly></td>
                                            <td><input class="form-control" type="text" name="existing[aluminium]" id="over_aluminium_trim_per_sq_value" value="{{ $sideBaseValue['side_over_existing']['aluminium']??"" }}"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Azeck</td>
                                            <td><input class="form-control" type="text" name="azeck_value_existing" id="over_azeck_wood_value" value="" readonly></td>
                                            <td><input class="form-control" type="text" name="existing[azeck]" id="over_azeck_wood_per_sq_value" value="{{ $sideBaseValue['side_over_existing']['azeck']??"" }}"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Wood</td>
                                            <td><input class="form-control" type="text" name="wood_value_existing" id="over_azeck_wood_value" value="" readonly></td>
                                            <td><input class="form-control" type="text" name="existing[wood]" id="over_azeck_wood_per_sq_value" value="{{ $sideBaseValue['side_over_existing']['wood']??"" }}"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Shatters</td>
                                            <td><input class="form-control" type="text" name="shutter_value" id="over_shutter_value" value="" readonly></td>
                                            <td><input class="form-control" type="text" name="existing[shatters]" id="over_shutter_per_sq_value" value="{{ $sideBaseValue['side_over_existing']['shatters']??"" }}"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Plywood</td>
                                            <td><input class="form-control" type="text" name="plywood_value" id="over_plywood_value" value="" readonly></td>
                                            <td><input class="form-control" type="text" name="existing[plywood]" id="over_plywood_per_sq_value"  value="{{ $sideBaseValue['side_over_existing']['plywood']??"" }}"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Miselanies</td>
                                            <td></td>
                                            <td><input class="form-control" type="text" name="miselanies" id="over_miselanies" readonly @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                            <td></td>
                                        </tr>
                                        <tr class="bg-project">
                                            <td colspan="3">PROJECT COST</td>
                                            <td colspan="2"><input class="form-control" type="text" name="project_cost" id="over_project_cost" value="0.00" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Materials</td>
                                            <td></td>
                                            <td><input class="form-control" type="text" name="existing[material_value]" id="over_material_value" value="{{ $sideBaseValue['side_over_existing']['material_value']??"" }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                            <td><input class="form-control" type="text" name="total_material_value" id="over_total_material_value" value="" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Labor</td>
                                            <td></td>
                                            <td><input class="form-control" type="text" name="existing[labor_value]" id="over_labor_value" value="{{ $sideBaseValue['side_over_existing']['labor_value']??"" }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                            <td><input class="form-control" type="text" name="total_labor_value" id="over_total_labor_value" value=""  readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Dumpster%</td>
                                            <td></td>
                                            <td><input class="form-control" type="text" name="existing[dumpster_value]" id="over_dumpster_value" value="{{ $sideBaseValue['side_over_existing']['dumpster_value']??"" }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                            <td><input class="form-control" type="text" name="total_dumpster_value" id="over_total_dumpster_value" value="" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Permit / Warranty%</td>
                                            <td></td>
                                            <td><input class="form-control" type="text" name="existing[permit_warranty_value]" id="over_permit_warranty_value" value="{{ $sideBaseValue['side_over_existing']['permit_warranty_value']??"" }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                            <td><input class="form-control" type="text" name="total_permit_warranty_value" id="over_total_permit_warranty_value" value="" readonly></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="bg-total">
                                            <td colspan="3">Total</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Margin Profit</td>
                                            <td></td>
                                            <td></td>
                                            <td><input class="form-control" type="text" name="existing[margin_profit]" id="over_margin_profit_value" value="{{ $sideBaseValue['side_over_existing']['margin_profit']??"" }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Super%</td>
                                            <td><input class="form-control" type="text" name="existing[super_value]" id="over_super_value" value="{{ $sideBaseValue['side_over_existing']['super_value']??"" }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>
                                            <td></td>
                                            <td><input class="form-control" type="text" name="total_super_value" id="over_total_super_value" value="" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Sales%</td>
                                            <td><input class="form-control" type="text" name="existing[sales_value]" id="over_sales_value" value="{{ $sideBaseValue['side_over_existing']['sales_value']??"" }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif></td>

                                            <td></td>
                                            <td><input class="form-control" type="text" name="total_sales_value" id="over_total_sales_value" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Direct Cost</td>
                                            <td></td>
                                            <td></td>
                                            <td><input class="form-control" type="text" name="direct_cost_value" id="over_direct_cost_value" value="" readonly></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="bg-net-profit">
                                            <td colspan="3">Net Profit</td>
                                            <td colspan="2"><input class="form-control" type="text" name="net_profit" id="over_net_profit" value="" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>%</td>
                                            <td></td>
                                            <td><input class="form-control" type="text" name="sub_total_value" id="over_sub_total_value" value="" readonly></td>
                                            <td><input class="form-control" type="text" name="total_sub_total_value" id="over_total_sub_total_value" value="" readonly></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <button type="submit" class="green_btn borderRadius btn-submit">Submit</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="gutterContent" role="tabpanel" aria-labelledby="gutterTab">
                            <form action="{{ route('store_side_base_gutter') }}" class="row" method="post">
                                @csrf
                                <div class="col-md-12">
                                    <h3>Side Estimation Calculator (Gutters)</h3>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered table-custom">
                                        <thead>
                                        <tr>
                                            <th colspan="3">Recommended Price</th>
                                            <td class="highlight">
                                                <input  class="form-control " type="text" name="recommended_price" id="gutter_recommended_price" value="" readonly>
                                            </td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Gutters</td>
                                            <td>
                                                <input class="form-control " type="text" name="gutter_sub_total" id="gutter_sub_total" value="" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control " type="text" min="0" name="gutter[gutter_per_sq_price]" id="gutter_per_sq_price" value="{{ $sideBaseValue['side_gutter']['gutter_per_sq_price']??"" }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif>
                                            </td>
                                            <td>
                                                <input class="form-control " type="text" min="0" name="gutter_sq_total_price" id="gutter_sq_total_price" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Downspouts</td>
                                            <td>
                                                <input class="form-control " type="text" name="downspouts_sub_total" id="gutter_downspouts_sub_total" value="" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control " type="text" min="0" name="gutter[downspouts_per_sq_price]" id="gutter_downspouts_per_sq_price" value="{{ $sideBaseValue['side_gutter']['downspouts_per_sq_price']??"" }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif>
                                            </td>
                                            <td>
                                                <input class="form-control " type="text" min="0" name="downspouts_sq_total_price" id="gutter_downspouts_sq_total_price" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Gutter Guards</td>
                                            <td>
                                                <input class="form-control " type="text" name="guards_sub_total" id="gutter_guards_sub_total" value="" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control " type="text" min="0" name="gutter[guards_per_sq_price]" id="gutter_guards_per_sq_price" value="{{ $sideBaseValue['side_gutter']['guards_per_sq_price']??"" }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif>
                                            </td>
                                            <td>
                                                <input class="form-control " type="text" min="0" name="guards_sq_total_price" id="gutter_guards_sq_total_price" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Miscellaneous</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input  class="form-control " type="text" name="miscellaneous_one" readonly @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif>
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
                                                <input  class="form-control " min="0" type="text" name="project_cost" id="gutter_project_cost" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Margin Profit</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input  class="form-control " min="0" type="text" name="gutter[margin_profit_one]" id="gutter_margin_profit" value="{{ $sideBaseValue['side_gutter']['margin_profit_one']??"" }}" >
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Super</td>
                                            <td>
                                                <input  class="form-control " min="0" type="text" name="gutter[super_percentage]" id="gutter_super_percentage" value="{{ $sideBaseValue['side_gutter']['super_percentage']??"" }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif>
                                            </td>
                                            <td></td>
                                            <td>
                                                <input  class="form-control " min="0" type="text" name="super_total" id="gutter_super_total" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sales</td>
                                            <td>
                                                <input  class="form-control " min="0" type="text" name="gutter[sales_percentage]" id="gutter_sales_percentage" value="{{ $sideBaseValue['side_gutter']['sales_percentage']??"" }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif>
                                            </td>
                                            <td></td>
                                            <td>
                                                <input  class="form-control " min="0" type="text" name="sales_total" id="gutter_sales_total" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr class="highlight-red">
                                            <td>Direct Cost</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input  class="form-control " min="0" type="text" name="direct_cost" id="gutter_direct_cost" value="" readonly>
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
                                                <input  class="form-control " min="0" type="text" name="net_profit" id="gutter_net_profit" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Margin %</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input  class="form-control " min="0" type="text" name="margin_percentage" id="gutter_margin_percentage" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Net Profit %</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input  class="form-control " min="0" type="text" name="net_profit_percentage" id="gutter_net_profit_percentage" value="" readonly>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered table-custom">
                                        <thead>
                                        <tr>
                                            <th colspan="3">Recommended Price</th>
                                            <td class="highlight">
                                                <input  class="form-control " type="text" name="recommended_price_two" id="gutter_recommended_price2" value="" readonly>
                                            </td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Gutters</td>
                                            <td>
                                                <input class="form-control " type="text" name="gutter_sub_total_two" id="gutter_sub_total2" value="" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control " type="text" min="0" name="gutter[gutter_per_sq_price_two]" id="gutter_per_sq_price2" value="{{ $sideBaseValue['side_gutter']['gutter_per_sq_price_two']??"" }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif>
                                            </td>
                                            <td>
                                                <input class="form-control " type="text" min="0" name="gutter_sq_total_price_two" id="gutter_sq_total_price2" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Downspouts</td>
                                            <td>
                                                <input class="form-control " type="text" name="downspouts_sub_total_two" id="gutter_downspouts_sub_total2" value="" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control " type="text" min="0" name="gutter[downspouts_per_sq_price_two]" id="gutter_downspouts_per_sq_price2" value="{{ $sideBaseValue['side_gutter']['downspouts_per_sq_price_two']??"" }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif>
                                            </td>
                                            <td>
                                                <input class="form-control " type="text" min="0" name="downspouts_sq_total_price_two" id="gutter_downspouts_sq_total_price2" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Gutter Guards</td>
                                            <td>
                                                <input class="form-control " type="text" name="guards_sub_total_two" id="gutter_guards_sub_total2" value="" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control " type="text" min="0" name="gutter[guards_per_sq_price_two]" id="gutter_guards_per_sq_price2" value="{{ $sideBaseValue['side_gutter']['guards_per_sq_price_two']??"" }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif>
                                            </td>
                                            <td>
                                                <input class="form-control " type="text" min="0" name="guards_sq_total_price_two" id="gutter_guards_sq_total_price2" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Miscellaneous</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input  class="form-control " type="text" name="miscellaneous_two" readonly>
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
                                                <input  class="form-control " min="0" type="text" name="project_cost_two" id="gutter_project_cost2" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Margin Profit</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input  class="form-control " min="0" type="text" name="gutter[margin_profit_two]" id="gutter_margin_profit2" value="{{ $sideBaseValue['side_gutter']['margin_profit_two']??"" }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Super</td>
                                            <td>
                                                <input  class="form-control " min="0" type="text" name="gutter[super_percentage_two]" id="gutter_super_percentage2" value="{{ $sideBaseValue['side_gutter']['super_percentage_two']??"" }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif>
                                            </td>
                                            <td></td>
                                            <td>
                                                <input  class="form-control " min="0" type="text" name="super_total_two" id="gutter_super_total2" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sales</td>
                                            <td>
                                                <input  class="form-control " min="0" type="text" name="gutter[sales_percentage_two]" id="gutter_sales_percentage2" value="{{ $sideBaseValue['side_gutter']['sales_percentage_two']??"" }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif>
                                            </td>
                                            <td></td>
                                            <td>
                                                <input  class="form-control " min="0" type="text" name="sales_total_two" id="gutter_sales_total2" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr class="highlight-red">
                                            <td>Direct Cost</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input  class="form-control " min="0" type="text" name="direct_cost_two" id="gutter_direct_cost2" value="" readonly>
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
                                                <input  class="form-control " min="0" type="text" name="net_profit_two" id="gutter_net_profit2" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Margin %</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input  class="form-control " min="0" type="text" name="margin_percentage_two" id="gutter_margin_percentage2" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Net Profit %</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input  class="form-control " min="0" type="text" name="net_profit_percentage_two" id="gutter_net_profit_percentage2" value="" readonly>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
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
            // Function to calculate totals and update the total fields
            function calculateTotals() {
                var totalGutters = 0;
                var totalDownspouts = 0;
                var totalGuards = 0;
                // Loop through each row (excluding the last "Total" row)
                $('tbody tr').each(function() {
                    var gutterVal = parseFloat($(this).find('.gutters').val()) || 0;
                    var downspoutVal = parseFloat($(this).find('.downspouts').val()) || 0;
                    var guardVal = parseFloat($(this).find('.guards').val()) || 0;

                    totalGutters += gutterVal;
                    totalDownspouts += downspoutVal;
                    totalGuards += guardVal;
                });
                $('#total_gutters').val(totalGutters.toFixed(2)); // Show up to 2 decimal places
                $('#total_downspouts').val(totalDownspouts.toFixed(2));
                $('#total_guards').val(totalGuards.toFixed(2));
            }

            // Calculate totals initially and on input change
            calculateTotals();

            // Bind input change event to recalculate totals
            $('input[type=number]').on('input', function() {
                calculateTotals();
            });
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
                $('#eaves_with_soffit_overhang_divide').val(totalResultEaves.toFixed(2));
                $('#rakes_with_rakes_overhang_divide').val(totalResultRakes.toFixed(2));
                $('#porch_with_cover_porch_divide').val(totalResultPorch.toFixed(2));
                $('#total_sum_divide').val(sumResultTotal.toFixed(2));
            }
            $('#soffit_overhang_value, #eaves_value_eave').on('input', calculate);
            $('#rakes_overhang_value, #rakes_value').on('input', calculate);
            $('#cover_porch_value, #porch_value').on('input', calculate);
        });

        $(document).on('change', '#siding_estimate_calculator_lead_id', function() {
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
    </script>
@endpush
