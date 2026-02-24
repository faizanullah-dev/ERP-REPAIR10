@extends('layouts.master')
@push('css')
    {{--    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">--}}
    <style>
        .green {
            background-color: #00FF00;
        }
        .tabs_sec_extra .green_btn.borderRadius.btn-submit.btn{margin:auto;}
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
    <section class="white-box tabs_sec tabs_sec_extra">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" id="roofBase" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="measurementTab" data-bs-toggle="tab" href="#measurementContent" role="tab" aria-controls="measurementContent" aria-selected="true">Measurement</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="preferredTab" data-bs-toggle="tab" href="#preferredContent" role="tab" aria-controls="preferredContent" aria-selected="true"> Preferred </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="systemTab" data-bs-toggle="tab" href="#systemContent" role="tab" aria-controls="systemContent" aria-selected="false"> System </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="underFifteenTab" data-bs-toggle="tab" href="#underFifteenContent" role="tab" aria-controls="underFifteenContent" aria-selected="false"> Under 15 SQ </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="guttersTab" data-bs-toggle="tab" href="#guttersContent" role="tab" aria-controls="guttersContent" aria-selected="false"> Gutter </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="flatRoofTab" data-bs-toggle="tab" href="#flatRoofContent" role="tab" aria-controls="flatRoofContent" aria-selected="false"> Flat Roof </a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-12">
                    <div class="tab-content">
                        <div class="tab-pane active" id="measurementContent" role="tabpanel" aria-labelledby="measurementTab">
                            <div class="back_button_flex_between">
                            <h3> Measurement </h3>
                                <div class="lead_back_btn">
                                    <a class="btn secondary_btn" href="{{ url('roofEstimateCalculator/roof-estimate-calculator') }}"><i class="icon-arrow-left-circle" aria-hidden="true"></i> Back </a>
                                </div>
                            </div>
                            <form class="" action="{{route('store_roofing')}}" method="post">
                                @csrf
                                <div class="form-group w-25">
                                </div>
                                <table class="table table-bordered" id="">
                                    <tr>
                                        <td>
                                            <input class="form-control" type="text" id="home_style" required name="labels[home_style][name]" value="Home Style" readonly>
                                        </td>
                                        <td colspan=""><input class="form-control" type="text" min="0" required id="home_style_value" name="labels[home_style][value]" value="{{ $formData['labels']['home_style']['value'] ?? 0 }}" placeholder="Enter here..."></td>
                                        <td><input class="form-control" type="text" id="stories" name="labels[stories][name]" value="Stories" readonly></td>
                                        <td colspan="" class="green"><input class="form-control" type="number" min="0" id="stories_value" name="labels[stories][value]" value="{{ $formData['labels']['stories']['value'] ?? 0 }}"></td>
                                        <td><input class="form-control" type="text" id="layers" name="labels[layers][name]" value="Layers" readonly></td>
                                        <td class="green"><input class="form-control" type="number" min="0" id="layers_value" name="labels[layers][value]" value="{{ $formData['labels']['layers']['value'] ?? 0 }}"></td>
                                    </tr>
                                    <tr>
                                        <td><input class="form-control" type="text" id="chimney_sizes" name="labels[chimney_sizes][name]" value="Chimney Sizes" readonly></td>
                                        <td colspan="" class="no-border"><input class="form-control" type="number" min="0" id="chimney_sizes_value" name="labels[chimney_sizes][value]" value="{{ $formData['labels']['chimney_sizes']['value'] ?? 0 }}"></td>
                                        <td><input class="form-control" type="text" id="pitch" name="labels[pitch][name]" value="Pitch" readonly></td>
                                        <td colspan="" class="green"><input class="form-control" type="number" min="0" id="pitch_value" name="labels[pitch][value]" value="{{ $formData['labels']['pitch']['value'] ?? 0 }}"></td>
                                    </tr>
                                    <tr>
                                        <td><input class="form-control" type="text" id="pipe_boots" name="labels[pipe_boots][name]" value="Pipe Boots" readonly></td>
                                        <td class="green"><input class="form-control" type="number" min="0" id="pipe_boots_value" name="labels[pipe_boots][value]" value="{{ $formData['labels']['pipe_boots']['value'] ?? 0 }}"></td>
                                        <td><input class="form-control" type="text" id="bathroom_vent" name="labels[bathroom_vent][name]" value="Bathroom Vent" readonly></td>
                                        <td class="green"><input class="form-control" type="number" min="0" id="bathroom_vent_value" name="labels[bathroom_vent][value]" value="{{ $formData['labels']['bathroom_vent']['value'] ?? 0 }}"></td>
                                    </tr>
                                    <tr>
                                        <td><input class="form-control" type="text" id="sizes" name="labels[sizes][name]" value="Sizes" readonly></td>
                                        <td class="green">
                                            <select class="form-select" aria-label="Default select example" name="labels[sizes][value]">
                                                <option value="4" {{ ($formData['labels']['sizes']['value'] ?? '') == '4' ? 'selected' : '' }}>4</option>
                                                <option value="3" {{ ($formData['labels']['sizes']['value'] ?? '') == '3' ? 'selected' : '' }}>3</option>
                                                <option value="2" {{ ($formData['labels']['sizes']['value'] ?? '') == '2' ? 'selected' : '' }}>2</option>
                                                <option value="1.5" {{ ($formData['labels']['sizes']['value'] ?? '') == '1.5' ? 'selected' : '' }}>1/2</option>
                                            </select>
                                        </td>
                                        <td><input class="form-control" type="text" id="plywood" required name="labels[plywood][name]" value="Plywood" readonly></td>
                                        <td class="green"><input class="form-control" type="number" min="0" id="plywood_value" name="labels[plywood][value]" value="{{ $formData['labels']['plywood']['value'] ?? 0 }}"></td>
                                        <td><input class="form-control" type="text" id="plywood_size" name="labels[plywood_size][name]" value="Sizes" readonly></td>
                                        <td class="green"><input class="form-control" type="number" min="0" id="plywood_size_value" name="labels[plywood_size][value]" value="{{ $formData['labels']['plywood_size']['value'] ?? 0 }}"></td>
                                    </tr>
{{--                                    <tr>--}}
{{--                                        <td><input class="form-control" type="text" id="shingles" name="labels[shingles][name]" value="Shingles" readonly></td>--}}
{{--                                        <td colspan="5" class="no-border"><input class="form-control" min="0" type="number" id="shingles_value" name="labels[shingles][value]" value="{{ $formData['labels']['shingles']['value'] ?? 0 }}"></td>--}}
{{--                                    </tr>--}}
                                    <tr>
                                        <td><input class="form-control" type="text" id="flat_area" name="labels[flat_area][name]" value="Flat Area" readonly></td>
                                        <td colspan="5" class="no-border"><input class="form-control" min="0" type="number" id="flat_area_value" name="labels[flat_area][value]" value="{{ $formData['labels']['flat_area']['value'] ?? 0 }}"></td>
                                    </tr>

                                </table>
                                <br>
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
                                            <td class="green"><input class="form-control calculate-final-value-eave-rakes" type="number" name="eave_rakes[{{$letter}}][eave_final_rakes_total][]" readonly value="{{ $formData['eave_rakes'][$letter]['eave_final_rakes_total'][0] ?? 0 }}" min="0"></td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>SUBTOTAL</td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="4"></td>
                                        <td></td>
                                        <td></td>
                                        <td><input id="sub_total_eave_rakes" type="number" class="form-control" name="eave_rakes_sub_total" min="0" value="{{ $formData['eave_rakes_sub_total'] ?? 0 }}" readonly></td>
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
                                <br>
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
                                            <td class="green"><input class="form-control eave_flat_area" type="number" name="flat_area[{{ $letter }}][eave][]" value="{{ $formData['flat_area'][$letter]['eave'][0] ?? 0 }}" min="0" step="0.01"></td>
                                            <td class="green">X</td>
                                            <td class="green"><input class="form-control rakes_flat_area" type="number" name="flat_area[{{ $letter }}][rakes][]" value="{{ $formData['flat_area'][$letter]['rakes'][0] ?? 0 }}" min="0" step="0.01"></td>
                                            <td class="green"><input class="form-control calculate-final-value-flat-area" type="number" name="flat_area[{{ $letter }}][eave_rakes_total][]" readonly value="{{ $formData['flat_area'][$letter]['eave_rakes_total'][0] ?? 0 }}" min="0" step="0.01"></td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>SUBTOTAL</td>
                                        <td colspan="2"></td>
                                        <td></td>
                                        <td><input id="sub_total_flat_area" type="number" class="form-control" name="eave_rakes_flat_area_sub_total" value="{{ $formData['eave_rakes_flat_area_sub_total'] ?? 0 }}" min="0" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>WASTE (%)</td>
                                        <td colspan="2"></td>
                                        <td class="green"><input id="flat_waste_eave_rakes" type="number" class="form-control" name="eave_rakes_flat_area_waste" min="0" value="{{ $formData['eave_rakes_flat_area_waste'] ?? 0 }}" step="0.01"></td>
                                        <td class="green"><input id="flat_sub_total_with_waste" type="number" class="form-control" name="eave_rakes_total_flat_area_waste" min="0" value="{{ $formData['eave_rakes_total_flat_area_waste'] ?? 0 }}" readonly></td>
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
                                <br>
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
                                        <td class="orange"> <input class="form-control" type="number" id="sub_total_gutters" name="gutter_sub_total" readonly value="{{ $formDat['gutter_sub_total'] ?? 0 }}" min="0" step="0.01"></td>
                                        <td class="orange" ><input class="form-control" type="number" id="sub_total_downspouts" name="downspout_sub_total" readonly value="{{ $formDat['downspout_sub_total'] ?? 0 }}" min="0" step="0.01"></td>
                                        <td class="orange"><input class="form-control" type="number" id="sub_total_guards" name="guards_sub_total" readonly value="{{ $formDat['guards_sub_total'] ?? 0 }}" min="0" step="0.01"></td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td colspan="3" class="orange"><input class="form-control" type="number" id="total_all" name="total_all_downspouts" readonly value="{{ $formDat['total_all_downspouts'] ?? 0 }}" min="0"></td>
                                    </tr>
                                    </tbody>
                                </table>
                                {{-- guarders ends--}}
{{--                                <br>--}}
{{--                                <table class="table table-bordered">--}}
{{--                                    --}}{{--<tr>--}}
{{--                                    --}}{{--<td>Notes:</td>--}}
{{--                                    --}}{{--<td class="no-border"><input class="form-control" type="text" id="note" name="note" @if(isset($lead->roofEstimateCalculator) && $lead->roofEstimateCalculator)  value="{!!  $lead->roofEstimateCalculator->note??'' !!}"   @endif placeholder="Enter Any Notes"></td>--}}
{{--                                    --}}{{--</tr>--}}
{{--                                </table>--}}
                                <button type="submit" class="green_btn borderRadius btn-submit btn">Submit</button>

                            </form>
                        </div>

                        <div class="tab-pane" id="preferredContent" role="tabpanel" aria-labelledby="preferredTab">
                            <form class="row" action="{{ route('store_roof_base_prefer') }}" id="store_roof_estimate_calculator_preferred" method="post">
                                @csrf
                                <div class="col-md-12">
                                    <h3 class="mt-0 mb-4">Preferred</h3>
                                    <table class="table table-bordered table-custom">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Roof</th>
                                            <th></th>
                                            <th>Replacement</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Recommended Price</td>
                                            <td></td>
                                            <td></td>
                                            <td class="highlight">
                                                <input class="form-control only-numbers" type="text" name="recommended_price" id="prefer_recommended_price" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Roofing Price</td>
                                            <td></td>
                                            <td>Price per SQ</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="roofing_price" id="prefer_roofing_price" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>SQ</td>
                                            <td class="highlight-green">
                                                <input class="form-control only-numbers" type="text" id="prefer_total_sq_c7" value="" name="total_sq" readonly>
                                            </td>
                                            <td>Price per SQ</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Additional layer</td>
                                            <td class="highlight-green">
                                                <input class="form-control only-numbers" type="text" id="prefer_additional_layer" name=additional_layer" readonly>
                                            </td>
                                            <td><input class="form-control only-numbers" type="text" id="prefer_additional_layer_price_per_sq_d_8" value="{{ $roofBaseValue['roof_prefer']['additional_layer']??"" }}" name="prefer[additional_layer]" ></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Step Charge</td>
                                            <td class="highlight-green">
                                                <input class="form-control only-numbers" type="text" id="prefer_step_charge" value="" name="step_charge" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="prefer_step_charge_price_per_sq_d_9" value="{{ $roofBaseValue['roof_prefer']['step_charge']??"" }}" name="prefer[step_charge]" >
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Chimney</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="prefer_chimney_size" value="" name="chimney_size" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="prefer_chimney_size_price_per_sq_d_10" value="{{ $roofBaseValue['roof_prefer']['chimney_size']??"" }}" name="prefer[chimney_size]">
                                            </td>
                                            <td></td>
                                        </tr>

                                        <tr>
                                            <td>Skylight</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="prefer_skylight" value="" name="skylight" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="" value="{{ $roofBaseValue['roof_prefer']['skylight']??"" }}" name="prefer[skylight]">
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Siding / Azeck</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="siding_azeck" id="prefer_siding_azeck" value="" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="prefer[azeck]" id="prefer_siding_azeck_price_per_sq_d_11" value="{{ $roofBaseValue['roof_prefer']['azeck']??"" }}" readonly>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Plywood</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="prefer_plywood" value="" name="plywood" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="prefer_plywood_price_per_sq_d_12" value="{{ $roofBaseValue['roof_prefer']['plywood']??"" }}" name="prefer[plywood]">
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Skylight</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="skylight_price" id="prefer_skylight_price" value="" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="skylight_price_price_per_sq" id="prefer_skylight_price_price_per_sq_d_13" value="" readonly>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Miscellaneous</td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" placeholder="Type Here..." type="text" name="skylight_price_price_per_sq" id="prefer_skylight_price_price_per_sq_d_13" value="" readonly>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Project Cost</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Materials</td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="prefer[materials_price_price_per_sq]" id="prefer_materials_price_price_per_sq_d_15" value="{{ $roofBaseValue['roof_prefer']['materials_price_price_per_sq']??"" }}">
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="materials_price_price_final" id="prefer_materials_price_price_final" min="0" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Labor</td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="prefer[labour_price_price_per_sq]" id="prefer_labour_price_price_per_sq_d_16" value="{{ $roofBaseValue['roof_prefer']['labour_price_price_per_sq']??"" }}">
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="labour_price_price_final" id="prefer_labour_price_price_final" min="0" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Dumpster (%)</td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="prefer[dumpster_price_price_per_sq]" id="prefer_dumpster_price_price_per_sq_d_17" value="{{ $roofBaseValue['roof_prefer']['dumpster_price_price_per_sq']??"" }}">
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="dumster_price_price_final" id="prefer_dumster_price_price_final" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Permit / Warranty (%)</td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="prefer[permit_warranty_price_price_per_sq]" id="prefer_permit_warranty_price_price_per_sq_d_18" value="{{ $roofBaseValue['roof_prefer']['permit_warranty_price_price_per_sq']??"" }}">
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="permit_warranty_price_price_final" id="prefer_permit_warranty_price_price_final" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="highlight-yellow">Project Cost</td>
                                            <td></td>
                                            <td></td>
                                            <td class="highlight-yellow">
                                                <input class="form-control only-numbers" type="text" name="project_cost" id="prefer_project_cost_price_price_final" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Margin Profit</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="prefer[margin_profit]" value="{{ $roofBaseValue['roof_prefer']['margin_profit']??"" }}" id="prefer_margin_profit_price_price_final">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Super(%)</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="prefer[super_percentage]" id="prefer_super_percentage" value="{{ $roofBaseValue['roof_prefer']['super_percentage']??"" }}">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="super_price_price_final" id="prefer_super_price_price_final" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sales(%)</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="prefer[sales_percentage]" id="prefer_sales_percentage" value="{{ $roofBaseValue['roof_prefer']['sales_percentage']??"" }}">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="sales_price_price_final" id="prefer_sales_price_price_final" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Directory(%)</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="prefer[directory_percentage]" id="prefer_directory_percentage" value="{{ $roofBaseValue['roof_prefer']['directory_percentage']??"" }}">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="directory_price_price_final" id="prefer_directory_price_price_final" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="highlight-yellow">Direct Cost</td>
                                            <td></td>
                                            <td></td>
                                            <td class="highlight-yellow">
                                                <input class="form-control only-numbers" type="text" name="directory_cost" id="prefer_directory_cost" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Net Profit</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="net_profit" id="prefer_net_profit" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Margin %</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="margin_percentage" id="prefer_margin_percentage" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Net Profit %</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="net_profit_percentage" id="prefer_net_profit_percentage" value="" readonly>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <button type="submit" class="green_btn borderRadius btn-submit btn">Submit</button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="systemContent" role="tabpanel" aria-labelledby="systemTab">
                            <form class="row" action="{{ route('store_roof_base_system')}}" id="store_roof_estimate_calculator_system" method="post">
                                @csrf
                                <input type="hidden" name="roof_estimate_calculator_id" value="">

                                <div class="col-md-12">
                                    <h3 class="mt-0 mb-4">System</h3>
                                    <table class="table table-bordered table-custom">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Roof</th>
                                            <th></th>
                                            <th>Replacement</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Recommended Price</td>
                                            <td></td>
                                            <td></td>
                                            <td class="highlight">
                                                <input class="form-control only-numbers" type="text" name="recommended_price" id="system_recommended_price" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Roofing Price</td>
                                            <td></td>
                                            <td>Price per SQ</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="roofing_price" id="system_roofing_price" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>SQ</td>
                                            <td class="highlight-green">
                                                <input class="form-control only-numbers" type="text" id="system_total_sq_c7" value="" name="total_sq" readonly>
                                            </td>
                                            <td>Price per SQ</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Additional layer</td>
                                            <td class="highlight-green">
                                                <input class="form-control only-numbers" type="text" id="system_additional_layer" name="additional_layer" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="system_additional_layer_price_per_sq_d_8" value="{{ $roofBaseValue['roof_system']['additional_layer']??"" }}" name="system[additional_layer]" >
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Step Charge</td>
                                            <td class="highlight-green">
                                                <input class="form-control only-numbers" type="text" id="system_step_charge" value="" name="step_charge" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="system_step_charge_price_per_sq_d_9" value="{{ $roofBaseValue['roof_system']['step_charge']??"" }}" name="system[step_charge]" >
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Chimney</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="system_chimney_size" value="" name="chimney_size" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="system_chimney_size_price_per_sq_d_10" value="{{ $roofBaseValue['roof_system']['chimney_size']??"" }}" name="system[chimney_size]">
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Skylight</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="system_skylight" value="" name="skylight" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="" value="{{ $roofBaseValue['roof_system']['skylight']??"" }}" name="system[skylight]">
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Siding / Azeck</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="siding_azeck" id="system_siding_azeck" value="" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="system[siding_azeck]" id="system_siding_azeck_price_per_sq_d_11" value="{{ $roofBaseValue['roof_system']['siding_azeck']??"" }}" readonly>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Plywood</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="system_plywood" value="" name="plywood" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="system_plywood_price_per_sq_d_12" value="{{ $roofBaseValue['roof_system']['plywood']??"" }}" name="system[plywood]" >
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Skylight</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="skylight_price" id="system_skylight_price" value="" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="skylight_price_price_per_sq" id="system_skylight_price_price_per_sq_d_13" value="" readonly>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Miscellaneous</td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" placeholder="Type Here..." type="text" name="miscellaneous" id="system_miscellaneous" value="" readonly>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Project Cost</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Materials</td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="system[materials_price_price_per_sq]" id="system_materials_price_price_per_sq_d_15" value="{{ $roofBaseValue['roof_system']['materials_price_price_per_sq']??""}}">
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="materials_price_price_final" id="system_materials_price_price_final" min="0" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Labor</td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="system[labour_price_price_per_sq]" id="system_labour_price_price_per_sq_d_16" value="{{ $roofBaseValue['roof_system']['labour_price_price_per_sq']??""}}">
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="labour_price_price_final" id="system_labour_price_price_final" min="0" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Dumpster (%)</td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="system[dumpster_price_price_per_sq]" id="system_dumpster_price_price_per_sq_d_17" value="{{ $roofBaseValue['roof_system']['dumpster_price_price_per_sq']??""}}">
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="dumster_price_price_final" id="system_dumster_price_price_final" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Permit / Warranty (%)</td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="system[permit_warranty_price_price_per_sq]" id="system_permit_warranty_price_price_per_sq_d_18" value="{{ $roofBaseValue['roof_system']['permit_warranty_price_price_per_sq']??""}}">
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="permit_warranty_price_price_final" id="system_permit_warranty_price_price_final" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="highlight-yellow">Project Cost</td>
                                            <td></td>
                                            <td></td>
                                            <td class="highlight-yellow">
                                                <input class="form-control only-numbers" type="text" name="project_cost" id="system_project_cost_price_price_final" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Margin Profit</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="system[margin_profit]" id="system_margin_profit_price_price_final" value="{{ $roofBaseValue['roof_system']['margin_profit']??"" }}" >
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Super(%)</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="system[super_percentage]" id="system_super_percentage" value="{{ $roofBaseValue['roof_system']['super_percentage']??""}}">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="super_price_price_final" id="system_super_price_price_final" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sales(%)</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="system[sales_percentage]" id="system_sales_percentage" value="{{ $roofBaseValue['roof_system']['sales_percentage']??""}}">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="sales_price_price_final" id="system_sales_price_price_final" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="highlight-yellow">Direct Cost</td>
                                            <td></td>
                                            <td></td>
                                            <td class="highlight-yellow">
                                                <input class="form-control only-numbers" type="text" name="directory_cost" id="system_directory_cost" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Net Profit</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="net_profit" id="system_net_profit" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Margin %</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="margin_percentage" id="system_margin_percentage" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Net Profit %</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="net_profit_percentage" id="system_net_profit_percentage" value="" readonly>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <button type="submit" class="green_btn borderRadius btn-submit btn">Submit</button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="underFifteenContent" role="tabpanel" aria-labelledby="underFifteenTab">
                            <form class="row" action="{{ route('store_roof_base_under_sq') }}" id="store_roof_estimate_calculator_under_fifteen_sq" method="post">
                                @csrf
                                <input type="hidden" name="roof_estimate_calculator_id" value="">

                                <div class="col-md-12">
                                    <h3 class="mt-0 mb-4">Under 15 SQ</h3>
                                    <table class="table table-bordered table-custom">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Roof</th>
                                            <th></th>
                                            <th>Replacement</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Recommended Price</td>
                                            <td></td>
                                            <td></td>
                                            <td class="highlight">
                                                <input class="form-control only-numbers" type="text" name="recommended_price" id="under_fifteen_recommended_price" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Roofing Price</td>
                                            <td></td>
                                            <td>Price per SQ</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="roofing_price" id="under_fifteen_roofing_price" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>SQ</td>
                                            <td class="highlight-green">
                                                <input class="form-control only-numbers" type="text" id="under_fifteen_total_sq_c7" value="" name="total_sq" readonly>
                                            </td>
                                            <td>Price per SQ</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Additional layer</td>
                                            <td class="highlight-green">
                                                <input class="form-control only-numbers" type="text" id="under_fifteen_additional_layer" value="" name="additional_layer" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="under_fifteen_additional_layer_price_per_sq_d_8" value="{{ $roofBaseValue['roof_under_sq']['additional_layer']??"" }}" name="under_sq[additional_layer]" >
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Step Charge</td>
                                            <td class="highlight-green">
                                                <input class="form-control only-numbers" type="text" id="under_fifteen_step_charge" value="" name="step_charge" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="under_fifteen_step_charge_price_per_sq_d_9" value="{{ $roofBaseValue['roof_under_sq']['step_charge']??"" }}" name="under_sq[step_charge]" >
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Chimney</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="under_fifteen_chimney_size" value="" name="chimney_size" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="under_fifteen_chimney_size_price_per_sq_d_10" value="{{ $roofBaseValue['roof_under_sq']['chimney_size']??"" }}" name="under_sq[chimney_size]" >
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Skylight</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="under_sq_skylight" value="" name="skylight" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="" value="{{ $roofBaseValue['roof_under_sq']['skylight']??"" }}" name="under_sq[skylight]">
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Siding / Azeck</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="siding_azeck" id="under_fifteen_siding_azeck" value="" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="under_sq[siding_azeck]" id="under_fifteen_siding_azeck_price_per_sq_d_11" value="{{ $roofBaseValue['roof_under_sq']['siding_azeck']??"" }}" readonly>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Plywood</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="under_fifteen_plywood" value="" name="plywood" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="under_fifteen_plywood_price_per_sq_d_12" value="{{ $roofBaseValue['roof_under_sq']['plywood']??"" }}" name="under_sq[plywood]">
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Skylight</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="skylight_price" id="under_fifteen_skylight_price" value="" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="skylight_price_price_per_sq" id="under_fifteen_skylight_price_price_per_sq_d_13" value="" readonly>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Miscellaneous</td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" placeholder="Type Here..." type="text" name="miscellaneous" id="under_fifteen_miscellaneous" value="" readonly>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Project Cost</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Materials</td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="under_sq[materials_price_price_per_sq]" id="under_fifteen_materials_price_price_per_sq_d_15" value="{{ $roofBaseValue['roof_under_sq']['materials_price_price_per_sq']??"" }}">
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="materials_price_price_final" id="under_fifteen_materials_price_price_final" min="0" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Labor</td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="under_sq[labour_price_price_per_sq]" id="under_fifteen_labour_price_price_per_sq_d_16" value="{{ $roofBaseValue['roof_under_sq']['labour_price_price_per_sq']??"" }}">
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="labour_price_price_final" id="under_fifteen_labour_price_price_final" min="0" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Dumpster (%)</td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="under_sq[dumpster_price_price_per_sq]" id="under_fifteen_dumpster_price_price_per_sq_d_17" value="{{ $roofBaseValue['roof_under_sq']['dumpster_price_price_per_sq']??"" }}">
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="dumster_price_price_final" id="under_fifteen_dumster_price_price_final" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Permit / Warranty (%)</td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="under_sq[permit_warranty_price_price_per_sq]" id="under_fifteen_permit_warranty_price_price_per_sq_d_18" value="{{ $roofBaseValue['roof_under_sq']['permit_warranty_price_price_per_sq']??"" }}">
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="permit_warranty_price_price_final" id="under_fifteen_permit_warranty_price_price_final" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="highlight-yellow">Project Cost</td>
                                            <td></td>
                                            <td></td>
                                            <td class="highlight-yellow">
                                                <input class="form-control only-numbers" type="text" name="project_cost" id="under_fifteen_project_cost_price_price_final" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Margin Profit</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="under_sq[margin_profit]" id="under_fifteen_margin_profit_price_price_final" value="{{ $roofBaseValue['roof_under_sq']['margin_profit']??"" }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Super(%)</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="under_sq[super_percentage]" id="under_fifteen_super_percentage" value="{{ $roofBaseValue['roof_under_sq']['super_percentage']??"" }}">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="super_price_price_final" id="under_fifteen_super_price_price_final" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sales(%)</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="under_sq[sales_percentage]" id="under_fifteen_sales_percentage" value="{{ $roofBaseValue['roof_under_sq']['sales_percentage']??"" }}">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="sales_price_price_final" id="under_fifteen_sales_price_price_final" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="highlight-yellow">Direct Cost</td>
                                            <td></td>
                                            <td></td>
                                            <td class="highlight-yellow">
                                                <input class="form-control only-numbers" type="text" name="directory_cost" id="under_fifteen_directory_cost" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Net Profit</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="net_profit" id="under_fifteen_net_profit" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Margin %</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="margin_percentage" id="under_fifteen_margin_percentage" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Net Profit %</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="net_profit_percentage" id="under_fifteen_net_profit_percentage" value="" readonly>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <button type="submit" class="green_btn borderRadius btn-submit btn">Submit</button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="guttersContent" role="tabpanel" aria-labelledby="guttersTab">
                            <form action="{{ route('store_roof_base_gutter') }}" class="row" method="post" id="store_roof_estimate_calculator_gutters">
                                @csrf
                                <input type="hidden" name="roof_estimate_calculator_id" value="">

                                <div class="col-md-6">
                                    <table class="table table-bordered table-custom">
                                        <thead>
                                        <tr>
                                            <th colspan="3">Recommended Price</th>
                                            <td class="highlight">
                                                <input class="form-control only-numbers" type="text" name="recommended_price" id="gutter_recommended_price" value="" readonly>
                                            </td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Gutters</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="gutter_sub_total" id="gutter_sub_total" value="" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" min="0" name="gutter[gutter_per_sq_price]" id="gutter_per_sq_price" value="{{ $roofBaseValue['roof_gutter']['gutter_per_sq_price']??"" }}">
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" min="0" name="gutter_sq_total_price" id="gutter_sq_total_price" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Downspouts</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="downspouts_sub_total" id="gutter_downspouts_sub_total" value="" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" min="0" name="gutter[downspouts_per_sq_price]" id="gutter_downspouts_per_sq_price" value="{{ $roofBaseValue['roof_gutter']['downspouts_per_sq_price']??"" }}">
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" min="0" name="downspouts_sq_total_price" id="gutter_downspouts_sq_total_price" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Gutter Guards</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="guards_sub_total" id="gutter_guards_sub_total" value="" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" min="0" name="gutter[guards_per_sq_price]" id="gutter_guards_per_sq_price" value="{{ $roofBaseValue['roof_gutter']['guards_per_sq_price']??"" }}">
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" min="0" name="guards_sq_total_price" id="gutter_guards_sq_total_price" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Miscellaneous</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" placeholder="Type Here..." type="text" name="miscellaneous" id="gutter_miscellaneous" value="" readonly>
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
                                                <input class="form-control only-numbers" min="0" type="text" name="project_cost" id="gutter_project_cost" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Margin Profit</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" min="0" type="text" name="gutter[margin_profit]" id="gutter[margin_profit]" value="{{ $roofBaseValue['roof_gutter']['margin_profit']??"" }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Super (%)</td>
                                            <td>
                                                <input class="form-control only-numbers" min="0" type="text" name="gutter[super_percentage]" id="gutter_super_percentage" value="{{ $roofBaseValue['roof_gutter']['super_percentage']??"" }}">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" min="0" type="text" name="super_total" id="gutter_super_total" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sales (%)</td>
                                            <td>
                                                <input class="form-control only-numbers" min="0" type="text" name="gutter[sales_percentage]" id="gutter_sales_percentage" value="{{ $roofBaseValue['roof_gutter']['sales_percentage']??"" }}">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" min="0" type="text" name="sales_total" id="gutter_sales_total" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr class="highlight-red">
                                            <td>Direct Cost</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" min="0" type="text" name="direct_cost" id="gutter_direct_cost" value="" readonly>
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
                                                <input class="form-control only-numbers" min="0" type="text" name="net_profit" id="gutter_net_profit" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Margin %</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" min="0" type="text" name="margin_percentage" id="gutter_margin_percentage" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Net Profit %</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" min="0" type="text" name="net_profit_percentage" id="gutter_net_profit_percentage" value="" readonly>
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
                                                <input class="form-control only-numbers" type="text" name="recommended_price_two" id="gutter_recommended_price2" value="" readonly>
                                            </td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Gutters</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="gutter_sub_total_two" id="gutter_sub_total2" value="" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" min="0" name="gutter[gutter_per_sq_price_two]" id="gutter_per_sq_price2" value="{{ $roofBaseValue['roof_gutter']['gutter_per_sq_price_two']??"" }}">
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" min="0" name="gutter_sq_total_price_two" id="gutter_sq_total_price2" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Downspouts</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="downspouts_sub_total_two" id="gutter_downspouts_sub_total2" value="" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" min="0" name="gutter[downspouts_per_sq_price_two]" id="gutter_downspouts_per_sq_price2" value="{{ $roofBaseValue['roof_gutter']['downspouts_per_sq_price_two']??"" }}">
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" min="0" name="downspouts_sq_total_price_two" id="gutter_downspouts_sq_total_price2" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Gutter Guards</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="guards_sub_total_two" id="gutter_guards_sub_total2" value="" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" min="0" name="gutter[guards_per_sq_price_two]" id="gutter_guards_per_sq_price2" value="{{ $roofBaseValue['roof_gutter']['guards_per_sq_price_two']??"" }}">
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" min="0" name="guards_sq_total_price_two" id="gutter_guards_sq_total_price2" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Miscellaneous</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" placeholder="Type Here..." type="text" name="miscellaneous_two" id="gutter_miscellaneous2" value="" readonly>
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
                                                <input class="form-control only-numbers" min="0" type="text" name="project_cost_two" id="gutter_project_cost2" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Margin Profit</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" min="0" type="text" name="gutter[margin_profit_two]" id="gutter_margin_profit2" value="{{ $roofBaseValue['roof_gutter']['margin_profit_two']??"" }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Super (%)</td>
                                            <td>
                                                <input class="form-control only-numbers" min="0" type="text" name="gutter[super_percentage_two]" id="gutter_super_percentage2" value="{{ $roofBaseValue['roof_gutter']['super_percentage_two']??"" }}">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" min="0" type="text" name="super_total_two" id="gutter_super_total2" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sales (%)</td>
                                            <td>
                                                <input class="form-control only-numbers" min="0" type="text" name="gutter[sales_percentage_two]" id="gutter_sales_percentage2" value="{{ $roofBaseValue['roof_gutter']['sales_percentage_two']??"" }}">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" min="0" type="text" name="sales_total_two" id="gutter_sales_total2" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr class="highlight-red">
                                            <td>Direct Cost</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" min="0" type="text" name="direct_cost_two" id="gutter_direct_cost2" value="" readonly>
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
                                                <input class="form-control only-numbers" min="0" type="text" name="net_profit_two" id="gutter_net_profit2" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Margin %</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" min="0" type="text" name="margin_percentage_two" id="gutter_margin_percentage2" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Net Profit %</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" min="0" type="text" name="net_profit_percentage_two" id="gutter_net_profit_percentage2" value="" readonly>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="green_btn borderRadius btn-submit btn">Submit</button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="flatRoofContent" role="tabpanel" aria-labelledby="flatRoofTab">
                            <form class="row" action="{{ route('store_roof_base_flat_roof') }}" id="store_roof_estimate_calculator_flat_roof" method="post">
                                @csrf
                                <div class="col-md-12">
                                    <h3 class="mt-0 mb-4">Flat Roof</h3>
                                    <table class="table table-bordered table-custom">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Roof</th>
                                            <th></th>
                                            <th>Replacement</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Recommended Price</td>
                                            <td></td>
                                            <td></td>
                                            <td class="highlight">
                                                <input class="form-control only-numbers" type="text" name="recommended_price" id="flat_recommended_price" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Roofing Price</td>
                                            <td></td>
                                            <td>Price per SQ</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="roofing_price" id="flat_roofing_price" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>SQ</td>
                                            <td class="highlight-green">
                                                <input class="form-control only-numbers" type="text" id="flat_total_sq_c7" value="" name="total_sq" readonly>
                                            </td>
                                            <td>Price per SQ</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Additional layer</td>
                                            <td class="highlight-green">
                                                <input class="form-control only-numbers" type="text" id="flat_additional_layer" value="" name="additional_layer" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="flat_additional_layer_price_per_sq_d_8" value="{{ $roofBaseValue['roof_flat_roof']['additional_layer']??"" }}" name="flat_roof[additional_layer]" >
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Step Charge</td>
                                            <td class="highlight-green">
                                                <input class="form-control only-numbers" type="text" id="flat_step_charge" value="" name="step_charge" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="flat_step_charge_price_per_sq_d_9" value="{{ $roofBaseValue['roof_flat_roof']['step_charge']??"" }}" name="flat_roof[step_charge]">
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Chimney</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="flat_chimney_size" value="" name="chimney_size" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="flat_chimney_size_price_per_sq_d_10" value="{{ $roofBaseValue['roof_flat_roof']['chimney_size']??"" }}" name="flat_roof[chimney_size]" >
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Skylight</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="prefer_skylight" value="" name="skylight" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="" value="{{ $roofBaseValue['roof_flat_roof']['skylight']??"" }}" name="flat_roof[skylight]">
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Siding / Azeck</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="siding_azeck" id="flat_siding_azeck" value="" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="flat_roof[azeck]" id="flat_siding_azeck_price_per_sq_d_11" value="{{ $roofBaseValue['roof_flat_roof']['azeck']??"" }}" readonly>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Plywood</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="flat_plywood" value="" name="plywood" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" id="flat_plywood_price_per_sq_d_12" value="{{ $roofBaseValue['roof_flat_roof']['plywood']??"" }}" name="flat_roof[plywood]">
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Skylight</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="skylight_price" id="flat_skylight_price" value="" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="skylight_price_price_per_sq" id="flat_skylight_price_price_per_sq_d_13" value="" readonly>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Miscellaneous</td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" placeholder="Type Here..." type="text" name="miscellaneous" id="flat_miscellaneous" value="" readonly>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Project Cost</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Materials</td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="flat_roof[materials_price_price_per_sq]" id="flat_materials_price_price_per_sq_d_15" value="{{ $roofBaseValue['roof_flat_roof']['materials_price_price_per_sq']??"" }}">
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="materials_price_price_final" id="flat_materials_price_price_final" min="0" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Labor</td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="flat_roof[labour_price_price_per_sq]" id="flat_labour_price_price_per_sq_d_16" value="{{ $roofBaseValue['roof_flat_roof']['labour_price_price_per_sq']??"" }}">
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="labour_price_price_final" id="flat_labour_price_price_final" min="0" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Dumpster (%)</td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="flat_roof[dumpster_price_price_per_sq]" id="flat_dumpster_price_price_per_sq_d_17" value="{{ $roofBaseValue['roof_flat_roof']['dumpster_price_price_per_sq']??"" }}">
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="dumster_price_price_final" id="flat_dumster_price_price_final" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Permit / Warranty (%)</td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="flat_roof[permit_warranty_price_price_per_sq]" id="flat_permit_warranty_price_price_per_sq_d_18" value="{{ $roofBaseValue['roof_flat_roof']['permit_warranty_price_price_per_sq']??"" }}">
                                            </td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="permit_warranty_price_price_final" id="flat_permit_warranty_price_price_final" value="" readonly>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="highlight-yellow">Project Cost</td>
                                            <td></td>
                                            <td></td>
                                            <td class="highlight-yellow">
                                                <input class="form-control only-numbers" type="text" name="project_cost" id="flat_project_cost_price_price_final" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Margin Profit</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="flat_roof[margin_profit]" id="flat_margin_profit_price_price_final" value="{{ $roofBaseValue['roof_flat_roof']['margin_profit']??"" }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Super(%)</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="flat_roof[super_percentage]" id="flat_super_percentage" value="{{ $roofBaseValue['roof_flat_roof']['super_percentage']??"" }}">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="super_price_price_final" id="flat_super_price_price_final" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sales(%)</td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="flat_roof[sales_percentage]" id="flat_sales_percentage" value="{{ $roofBaseValue['roof_flat_roof']['sales_percentage']??"" }}">
                                            </td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="sales_price_price_final" id="flat_sales_price_price_final" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="highlight-yellow">Direct Cost</td>
                                            <td></td>
                                            <td></td>
                                            <td class="highlight-yellow">
                                                <input class="form-control only-numbers" type="text" name="directory_cost" id="flat_directory_cost" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Net Profit</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="net_profit" id="flat_net_profit" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Margin %</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="margin_percentage" id="flat_margin_percentage" value="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Net Profit %</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input class="form-control only-numbers" type="text" name="net_profit_percentage" id="flat_net_profit_percentage" value="" readonly>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <button type="submit" class="green_btn borderRadius btn-submit btn">Submit</button>
                                </div>
                            </form>
                            @csrf
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
    </script>
@endpush
