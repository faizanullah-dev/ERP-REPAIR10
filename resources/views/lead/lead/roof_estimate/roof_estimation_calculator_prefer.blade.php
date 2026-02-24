{{--@extends('layouts.master')--}}
{{--@push('css')--}}
{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">--}}
{{--    <style>--}}
{{--        .table-custom th, .table-custom td {--}}
{{--            vertical-align: middle;--}}
{{--            text-align: center;--}}
{{--        }--}}
{{--        .highlight {--}}
{{--            background-color: #ffff99;--}}
{{--        }--}}
{{--        .highlight-green {--}}
{{--            background-color: #ccffcc;--}}
{{--        }--}}
{{--        .highlight-yellow {--}}
{{--            background-color: #ffffcc;--}}
{{--        }--}}
{{--    </style>--}}
{{--@endpush--}}
{{--@section('content')--}}
    <section class="calculator_sec white-box">
        <div class="container-fluid">
            <form  class="row" action="{{route('store_roof_estimate_calculator_prefer')}}" id="store_roof_estimate_calculator_preferred" method="post">
                @csrf
                <input type="hidden" name="roof_estimate_calculator_id" value="{{$roofEstimateCalculator->id}}">
{{--                @if(isset($lead->roofEstimateCalculator) && $lead->roofEstimateCalculator)--}}
{{--                    <div class="col-md-10">--}}
{{--                        <div class="table_top_btn">--}}
{{--                            <a href="{{url('roof_estimation_calculator/' . $lead->roofEstimateCalculator->lead_id) }}" class="btn btn_green">Measurement</a>--}}
{{--                            <a href="{{url('roof_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->roofEstimateCalculator->id}}/system" class="btn btn_green">System  ( {{@$lead->roofEstimateCalculator->roofEstimateCalculatorSystem->recommended_price??'0'}} )</a>--}}
{{--                            <a href="{{url('roof_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->roofEstimateCalculator->id}}/under_fifteen_sq" class="btn btn_green">Under 15 SQ  ( {{@$lead->roofEstimateCalculator->roofEstimateCalculatorUnderFifteen->recommended_price??'0'}} )</a>--}}
{{--                            <a href="{{url('roof_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->roofEstimateCalculator->id}}/gutters" class="btn btn_green">Gutter  ( {{@$lead->roofEstimateCalculator->storeRoofEstimateCalculatorGutter->recommended_price??'0'}} )  ( {{@$lead->roofEstimateCalculator->storeRoofEstimateCalculatorGutter->recommended_price_two??'0'}} ) </a>--}}
{{--                            <a href="{{url('roof_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->roofEstimateCalculator->id}}/flat_roof" class="btn btn_green">Flat Roof  ( {{@$lead->roofEstimateCalculator->roofEstimateCalculatorFlatRoof->recommended_price??'0'}} )</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-2">--}}
{{--                        <a class="btn btn-success pull-right" href="{{ url('roof_estimation_calculator/' . $lead->id) }}">--}}
{{--                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                @endif--}}
                <div class="col-md-12">
                    <h2 class="text-center mb-4">Preferred</h2>
                </div>
                <div class="col-md-12">
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
                                <input  class="form-control only-numbers" type="text" name="recommended_price" id="prefer_recommended_price" value="{{$roofEstimateCalculator->roofEstimateCalculatorpreferred->recommended_price??"0"}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Roofing Price</td>
                            <td></td>
                            <td>Price per SQ</td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="roofing_price" id="prefer_roofing_price" value="{{$roofEstimateCalculator->roofEstimateCalculatorpreferred->roofing_price??"0"}}" readonly>
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
                            <td class="highlight-green" >
{{--                                <input  class="form-control only-numbers"  type="text" id="prefer_total_sq_c7" value="{{$roofEstimateCalculator->total_sq??'0'}}" name="total_sq" readonly>--}}
                                <input  class="form-control only-numbers"  type="text" id="prefer_total_sq_c7" value="{{$roofEstimateCalculator->eave_rakes_total_percent??'0'}}" name="total_sq" readonly>
                            </td>
                            <td>Price per SQ</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Additional layer</td>
                            <td class="highlight-green">
                                <input  class="form-control only-numbers"  type="text" id="prefer_additional_layer" value="{{ $additional_layer ??'0' }}" name="additional_layer" readonly @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                            </td>
                            <td><input  class="form-control only-numbers"  type="text" id="prefer_additional_layer_price_per_sq_d_8" value="{{$roofEstimateCalculator->roofEstimateCalculatorpreferred->additional_layer_price_per_sq??$additional_layer_price_per_sq??'0'}}" name="additional_layer_price_per_sq" readonly></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Step Charge</td>
                            <td class="highlight-green">
                                <input  class="form-control only-numbers"  type="text" id="prefer_step_charge" value="{{$stepCharge??'0'}}" name="step_charge" readonly @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                            </td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" id="prefer_step_charge_price_per_sq_d_9" value="{{$roofEstimateCalculator->roofEstimateCalculatorpreferred->stepChargePricePerSq??$stepChargePricePerSq??'0'}}" name="step_charge_price_per_sq" readonly>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Chimney</td>
                            <td>

                                <input  class="form-control only-numbers"  type="text" id="prefer_chimney_size" value="{{ $chimneySize }}" name="chimney_size" readonly @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                            </td>
                            <td >
                                <input  class="form-control only-numbers"  type="text" id="prefer_chimney_size_price_per_sq_d_10" value="{{$roofEstimateCalculator->roofEstimateCalculatorpreferred->chimneySizePricePerSq??$chimneySizePricePerSq??'0'}}" name="chimney_size_price_per_sq" readonly>
                            </td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Skylight</td>
                            <td>
                                <input class="form-control only-numbers" type="text" value="{{ $skyLightQuantity??"" }}" id="prefer_skylight_labour" name="skylight_labour" readonly @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                            </td>

                            <td>
                                <input class="form-control only-numbers" type="text" id="prefer_total_labour_skylight" value="" name="skylight_labour_final" readonly>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Siding / Azeck</td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="siding_azeck" id="prefer_siding_azeck" value="{{$roofEstimateCalculator->roofEstimateCalculatorpreferred->siding_azeck??"0"}}"  @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                            </td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="siding_azeck_price_per_sq" id="prefer_siding_azeck_price_per_sq_d_11" value="{{$roofEstimateCalculator->roofEstimateCalculatorpreferred->siding_azeck_price_per_sq??"0"}}">
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Plywood</td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" id="prefer_plywood" value="{{ $plywood??'0'}}" name="plywood" readonly @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                            </td>
                            <td >
                                <input  class="form-control only-numbers"  type="text" id="prefer_plywood_price_per_sq_d_12" value="{{$roofEstimateCalculator->roofEstimateCalculatorpreferred->plywoodPricePerSq??$plywoodPricePerSq??'0'}}" name="plywood_price_per_sq" readonly>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Skylight</td>
                            <td>
{{--                                <input  class="form-control only-numbers"  type="text" name="skylight_price" id="prefer_skylight_price" value="{{$roofEstimateCalculator->roofEstimateCalculatorpreferred->skylight_price??$skylight_price??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>--}}
                                <input  class="form-control only-numbers"  type="text" name="skylight_price" id="prefer_skylight_price" value="{{ $skyLightQuantity??"" }}" value="{{ $skyLightQuantity??"" }}" readonly @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                            </td>
                            <td>
{{--                                <input  class="form-control only-numbers"  type="text" name="skylight_price_price_per_sq" id="prefer_skylight_price_price_per_sq_d_13" value="{{$roofEstimateCalculator->roofEstimateCalculatorpreferred->skylight_price_price_per_sq??"0"}}">--}}
                                <input  class="form-control only-numbers"  type="text" name="skylight_price_price_per_sq" id="prefer_skylight_price_price_per_sq_d_13" value="{{ $skyLightPrice??"" }}" readonly>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Miscellaneous</td>
                            <td></td>
                            <td>
                                <input  class="form-control only-numbers" placeholder="Type Here..."  type="text" name="prefer_miscellaneous" id="prefer_miscellaneous" value="{{$roofEstimateCalculator->roofEstimateCalculatorpreferred->prefer_miscellaneous??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
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
                                <input  class="form-control "  type="text" name="materials_price_price_per_sq" id="prefer_materials_price_price_per_sq_d_15"  value="{{ $roofEstimateCalculator->roofEstimateCalculatorpreferred->materials_price_price_per_sq??$roofDataPrefer['materials_price_price_per_sq']??"0"}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                            </td>
                            <td>
                                <input  class="form-control "  type="text" name="materials_price_price_final" id="prefer_materials_price_price_final" min="0" value="{{ $roofEstimateCalculator->roofEstimateCalculatorpreferred->materials_price_price_final ?? '0'}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Labor</td>
                            <td></td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="labour_price_price_per_sq" id="prefer_labour_price_price_per_sq_d_16" value="{{$roofEstimateCalculator->roofEstimateCalculatorpreferred->labour_price_price_per_sq??$roofDataPrefer['labour_price_price_per_sq']??"0"}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                            </td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="labour_price_price_final" id="prefer_labour_price_price_final" min="0" value="{{$roofEstimateCalculator->roofEstimateCalculatorpreferred->labour_price_price_final??"0"}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Dumpster (%)</td>
                            <td></td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="dumpster_price_price_per_sq" id="prefer_dumpster_price_price_per_sq_d_17" value="{{$roofEstimateCalculator->roofEstimateCalculatorpreferred->dumpster_price_price_per_sq??$roofDataPrefer['dumpster_price_price_per_sq']??"0"}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                            </td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="dumster_price_price_final" id="prefer_dumster_price_price_final" value="{{$roofEstimateCalculator->roofEstimateCalculatorpreferred->dumster_price_price_final??"0"}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Permit / Warranty (%)</td>
                            <td></td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="permit_warranty_price_price_per_sq" id="prefer_permit_warranty_price_price_per_sq_d_18" value="{{$roofEstimateCalculator->roofEstimateCalculatorpreferred->permit_warranty_price_price_per_sq??$roofDataPrefer['permit_warranty_price_price_per_sq']??"0"}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                            </td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="permit_warranty_price_price_final" id="prefer_permit_warranty_price_price_final" value="{{$roofEstimateCalculator->roofEstimateCalculatorpreferred->permit_warranty_price_price_final??"0"}}" readonly>

                            </td>
                        </tr>
                        <tr>
                            <td class="highlight-yellow">Project Cost</td>
                            <td></td>
                            <td></td>
                            <td class="highlight-yellow">
                                <input  class="form-control only-numbers"  type="text" name="project_cost" id="prefer_project_cost_price_price_final" value="{{$roofEstimateCalculator->roofEstimateCalculatorpreferred->project_cost??"0"}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Margin Profit</td>
                            <td></td>
                            <td></td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="margin_profit" id="prefer_margin_profit_price_price_final" value="{{$roofEstimateCalculator->roofEstimateCalculatorpreferred->margin_profit??"0"}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Super(%)</td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="super_percentage" id="prefer_super_percentage" value="{{$roofEstimateCalculator->roofEstimateCalculatorpreferred->super_percentage??$roofDataPrefer['super_percentage']??"0"}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                            </td>
                            <td></td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="super_price_price_final" id="prefer_super_price_price_final" value="{{$roofEstimateCalculator->roofEstimateCalculatorpreferred->super_price_price_final??"0"}}" readonly>
                            </td>
                        </tr>

                        <tr>
                            <td>Sales(%)</td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="sales_percentage" id="prefer_sales_percentage" value="{{$roofEstimateCalculator->roofEstimateCalculatorpreferred->sales_percentage??$roofDataPrefer['sales_percentage']??"0"}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                            </td>
                            <td></td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="sales_price_price_final" id="prefer_sales_price_price_final" value="{{$roofEstimateCalculator->roofEstimateCalculatorpreferred->sales_price_price_final??"0"}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Directory(%)</td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="directory_percentage" id="prefer_directory_percentage" value="{{$roofEstimateCalculator->roofEstimateCalculatorpreferred->directory_percentage??$roofDataPrefer['directory_percentage']??"0"}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                            </td>
                            <td></td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="directory_price_price_final" id="prefer_directory_price_price_final" value="{{$roofEstimateCalculator->roofEstimateCalculatorpreferred->directory_price_price_final??"0"}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td class="highlight-yellow">Direct Cost</td>
                            <td></td>
                            <td></td>
                            <td class="highlight-yellow">
                                <input  class="form-control only-numbers"  type="text" name="directory_cost" id="prefer_directory_cost" value="{{$roofEstimateCalculator->roofEstimateCalculatorpreferred->directory_cost??"0"}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Net Profit</td>
                            <td></td>
                            <td></td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="net_profit" id="prefer_net_profit" value="{{$roofEstimateCalculator->roofEstimateCalculatorpreferred->net_profit??"0"}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Margin %</td>
                            <td></td>
                            <td></td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="margin_percentage" id="prefer_margin_percentage" value="{{$roofEstimateCalculator->roofEstimateCalculatorpreferred->margin_percentage??"0"}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Net Profit %</td>
                            <td></td>
                            <td></td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="net_profit_percentage" id="prefer_net_profit_percentage" value="{{$roofEstimateCalculator->roofEstimateCalculatorpreferred->net_profit_percentage??"0"}}" readonly>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
{{--                <div class="col-md-6">--}}

{{--                    <button type="submit" class="green_btn btn-block borderRadius btn-submit">Submit</button>--}}
{{--                </div>--}}
            </form>
        </div>
    </section>


{{--@endsection--}}
{{--@push('js')--}}
    <script>
        $(document).ready(function () {
            @php
                $roofDataPrefer = json_decode($roofBaseValuesPrefer->roof_prefer, true);
            @endphp

            var sq = $('#prefer_total_sq_c7').val();
            var layer = {{ $additional_layer }};
            var totalLayer = sq * layer;
            // if(totalLayer == '0'){
            //     totalLayer = layer;
            // }
            $('#prefer_additional_layer').val(totalLayer);
            var stepCharge = {{ $stepCharge }};
            var totalStepCharge = sq * stepCharge;
            // if(totalStepCharge == '0'){
            //     totalStepCharge = stepCharge;
            // }
            $('#prefer_step_charge').val(totalStepCharge);

            // // setTimeout(function() {
            //     // First run material calculations
            calculationAboutadditionalLayer();
            calculationAboutstep_chargePrefer();
            calculationAboutchimney_size();
            calculationSkylight();
            calculationAboutplywood();
            calculationAboutMaterialPrefer();
            calculationAboutLabourPrefer();
            calculationAboutDumpster();
            calculationAboutPermit();
            calculationAboutProjectCost();
            calculationAboutMarginProfit();
            calculationAboutSuper();
            calculationAboutSales();
            calculationAboutSkylight();
            calculationAboutDirectory();
            calculationAboutDirectoryCost();
            calculationAboutmarginProfit();
            calculationAboutNetProfit();
            calculationAboutNetProfitPercentage();
            calculationAboutRoofingPrice();
            // // }, 50);
            // calculationAboutchimney_size();
            $(document).on('input', '#prefer_materials_price_price_per_sq_d_15,#prefer_skylight_price_price_per_sq_d_13, #prefer_plywood_price_per_sq_d_12, #prefer_siding_azeck_price_per_sq_d_11,  #prefer_chimney_size_price_per_sq_d_10', function () {
                calculationAboutMaterialPrefer();
                // calculationAboutDumpster();
                // calculationAboutPermit();
                // calculationAboutProjectCost();
                // calculationAboutMarginProfit();
                // calculationAboutSkylight();
                // calculationAboutSuper();
                // calculationAboutSales();
                // calculationAboutDirectory();
                // // calculationAboutNetProfit();
                // calculationAboutDirectoryCost();
                // // calculationAboutmarginProfit();
                // calculationAboutNetProfitPercentage();
                // calculationAboutRoofingPrice();
            });
            function calculationAboutMaterialPrefer() {
                var totalsq = parseFloat($('#prefer_total_sq_c7').val()) || 0;
                var materials = parseFloat($('#prefer_materials_price_price_per_sq_d_15').val()) || 0;
                var chimney_size = parseFloat($('#prefer_chimney_size_price_per_sq_d_10').val()) || 0;
                var plywood_price = parseFloat($('#prefer_plywood_price_per_sq_d_12').val()) || 0;
                var siding_azeck = parseFloat($('#prefer_siding_azeck_price_per_sq_d_11').val()) || 0;
                var skylight_price = parseFloat($('#prefer_skylight_price_price_per_sq_d_13').val()) || 0;
                var multiply = (parseFloat(totalsq) * parseFloat(materials));
                var plus = parseFloat(multiply) + parseFloat(chimney_size) + parseFloat(plywood_price) + parseFloat(siding_azeck) + parseFloat(skylight_price);
                $('#prefer_materials_price_price_final').val(plus.toFixed(2));
                calculationAboutDumpster();
                calculationAboutPermit();
                calculationAboutProjectCost();
                calculationAboutMarginProfit();
                calculationAboutSuper();
                calculationAboutSales();
                calculationAboutDirectoryCost();
                calculationAboutNetProfit();
                calculationAboutSkylight();
                calculationAboutmarginProfit();
                calculationAboutNetProfitPercentage();
                calculationAboutRoofingPrice();
            }
            // calculationAboutMaterialPrefer();
            $(document).on('input', '#prefer_labour_price_price_per_sq_d_16, #prefer_plywood_price_per_sq_d_12,#prefer_chimney_size_price_per_sq_d_10, #prefer_step_charge_price_per_sq_d_9, #prefer_siding_azeck_price_per_sq_d_11, #prefer_additional_layer_price_per_sq_d_8', function () {
                // // calculationAboutMaterialPrefer();
                // calculationAboutLabourPrefer();
                // // calculationAboutPermit();
                // calculationAboutProjectCost()
                // calculationAboutMarginProfit();
                // calculationAboutSuper();
                // calculationAboutSales();
                // calculationAboutDirectory();
                // // calculationAboutmarginProfit();
                // calculationAboutDirectoryCost();
                // // calculationAboutNetProfit();
                // // calculationAboutNetProfitPercentage();
                // // calculationAboutRoofingPrice();
                // calculationAboutSkylight();

                calculationAboutLabourPrefer();
                calculationAboutProjectCost()
                calculationAboutMarginProfit();
                calculationAboutSuper();
                calculationAboutSales();
                calculationAboutmarginProfit();
                calculationAboutDirectoryCost();
                calculationAboutNetProfit();
                calculationAboutNetProfitPercentage()
                calculationAboutRoofingPrice()
                calculationAboutSkylight()
                calculationAboutMaterialPrefer()

            });
            function calculationAboutLabourPrefer() {
                var totalsq = parseFloat($('#prefer_total_sq_c7').val()) || 0;
                var labour = parseFloat($('#prefer_labour_price_price_per_sq_d_16').val()) || 0;
                var additional_layer = parseFloat($('#prefer_additional_layer_price_per_sq_d_8').val()) || 0;
                var step_charge = parseFloat($('#prefer_step_charge_price_per_sq_d_9').val()) || 0;
                var chimney_size = parseFloat($('#prefer_chimney_size_price_per_sq_d_10').val()) || 0;
                var siding_azeck = parseFloat($('#prefer_siding_azeck_price_per_sq_d_11').val()) || 0;
                var plywood_price = parseFloat($('#prefer_plywood_price_per_sq_d_12').val()) || 0;
                var skylightLabour = parseFloat($('#prefer_total_labour_skylight').val()) || 0;
                var multiply = totalsq * labour + additional_layer + step_charge + chimney_size + siding_azeck + plywood_price + skylightLabour;
                $('#prefer_labour_price_price_final').val(multiply.toFixed(2));
            }

            // calculationAboutLabourPrefer();
            $(document).on('input', '#prefer_dumpster_price_price_per_sq_d_17, #prefer_materials_price_price_final', function () {
                // calculationAboutMaterialPrefer()
                // calculationAboutDumpster();
                // calculationAboutProjectCost();
                // calculationAboutMarginProfit();
                // calculationAboutSuper();
                // calculationAboutSales();
                // calculationAboutDirectory();
                // // calculationAboutmarginProfit();
                // calculationAboutDirectoryCost();
                // // calculationAboutNetProfit();
                // // calculationAboutNetProfitPercentage();
                // // calculationAboutRoofingPrice()
                // calculationAboutSkylight();

                calculationAboutMaterialPrefer()
                calculationAboutLabourPrefer()
                calculationAboutDumpster();
                calculationAboutProjectCost()
                calculationAboutMarginProfit();
                calculationAboutSuper();
                calculationAboutSales();
                calculationAboutDirectoryCost();
                calculationAboutNetProfit();
                calculationAboutmarginProfit();
                calculationAboutNetProfitPercentage()
                calculationAboutRoofingPrice()
                calculationAboutSkylight()

            });

            function calculationAboutDumpster() {
                var materials_price = parseFloat($('#prefer_materials_price_price_final').val()) || 0;
                var dumpster_percentage = parseFloat($('#prefer_dumpster_price_price_per_sq_d_17').val()) || 0;
                var multiply = materials_price * (dumpster_percentage / 100);
                $('#prefer_dumster_price_price_final').val(multiply.toFixed(2));
            }

            // calculationAboutDumpster();
            $(document).on('input', '#prefer_permit_warranty_price_price_per_sq_d_18, #prefer_materials_price_price_final', function () {
                // calculationAboutMaterialPrefer();
                // calculationAboutPermit();
                // calculationAboutProjectCost();
                // calculationAboutMarginProfit();
                // calculationAboutSuper();
                // calculationAboutSales();
                // calculationAboutDirectory();
                // calculationAboutDirectoryCost();
                // // calculationAboutNetProfit();
                // // calculationAboutmarginProfit();
                // // calculationAboutNetProfitPercentage()
                // // calculationAboutRoofingPrice()
                // calculationAboutSkylight();

                calculationAboutPermit();
                calculationAboutProjectCost();
                calculationAboutMarginProfit();
                calculationAboutSuper();
                calculationAboutSales();
                calculationAboutDirectoryCost();
                calculationAboutNetProfit();
                calculationAboutmarginProfit();
                calculationAboutNetProfitPercentage();
                calculationAboutRoofingPrice();
                calculationAboutSkylight();
                calculationAboutMaterialPrefer();
                calculationAboutLabourPrefer();
            });

            $(document).on('input', '#prefer_miscellaneous', function () {
                // calculationAboutDumpster();
                // calculationAboutPermit();
                // calculationAboutProjectCost()
                // calculationAboutMarginProfit();
                // calculationAboutSuper();
                // calculationAboutSales();
                // calculationAboutDirectory();
                // calculationAboutNetProfit();
                // calculationAboutSkylight();
                // calculationAboutDirectoryCost();
                // calculationAboutmarginProfit();
                // calculationAboutNetProfitPercentage()
                // calculationAboutRoofingPrice();
                // calculationAboutMaterialPrefer();


                calculationAboutProjectCost();
                calculationAboutMarginProfit();
                calculationAboutSuper();
                calculationAboutSales();
                calculationAboutDirectory();
                calculationAboutDirectoryCost();
                calculationAboutNetProfit();
                calculationAboutSkylight();
            });

            function calculationAboutPermit() {
                var materials_price = parseFloat($('#prefer_materials_price_price_final').val()) || 0;
                var permit_warranty_price = parseFloat($('#prefer_permit_warranty_price_price_per_sq_d_18').val()) || 0;
                var multiply = materials_price * (permit_warranty_price / 100);
                $('#prefer_permit_warranty_price_price_final').val(multiply.toFixed(2));
            }
            // calculationAboutPermit();
            function calculationAboutProjectCost() {
                var materials_price_price_final = parseFloat($('#prefer_materials_price_price_final').val()) || 0;
                var labour_price_price_final = parseFloat($('#prefer_labour_price_price_final').val()) || 0;
                var dumster_price_price_final = parseFloat($('#prefer_dumster_price_price_final').val()) || 0;
                var permit_warranty_price_price_final = parseFloat($('#prefer_permit_warranty_price_price_final').val()) || 0;
                var prefer_miscellaneous = parseFloat($('#prefer_miscellaneous').val()) || 0;
                var addition = materials_price_price_final + labour_price_price_final + permit_warranty_price_price_final + dumster_price_price_final + prefer_miscellaneous;
                $('#prefer_project_cost_price_price_final').val(addition.toFixed(2));
            }
            // calculationAboutProjectCost();
            function calculationAboutMarginProfit() {
                var project_cost_price_price_final = parseFloat($('#prefer_project_cost_price_price_final').val()) || 0;
                var roofMarginProfit = {{$roofDataPrefer['margin_profit']??1}};
                var percentage = (project_cost_price_price_final / (roofMarginProfit / 100)) ;
                $('#prefer_margin_profit_price_price_final').val(percentage.toFixed(2));
            }
            // calculationAboutMarginProfit();
            $(document).on('input', '#prefer_super_percentage', function () {
                // calculationAboutSuper();
                // calculationAboutSales();
                // calculationAboutDirectory();
                // calculationAboutDirectoryCost();
                // calculationAboutNetProfit();
                // calculationAboutmarginProfit();
                // calculationAboutNetProfitPercentage()
                // calculationAboutRoofingPrice()
                // calculationAboutMaterialPrefer()

                calculationAboutSuper();
                calculationAboutSales();
                calculationAboutDirectoryCost();
                calculationAboutNetProfit();
                calculationAboutmarginProfit();
                calculationAboutNetProfitPercentage()
                calculationAboutRoofingPrice()
                calculationAboutMaterialPrefer()
                calculationAboutLabourPrefer()
                calculationAboutSkylight()
            });
            function calculationAboutSuper() {
                var margin_profit_price_price_final = parseFloat($('#prefer_margin_profit_price_price_final').val()) || 0;
                var super_percentage = parseFloat($('#prefer_super_percentage').val()) || 0;
                var super_percentage_final = margin_profit_price_price_final * (super_percentage / 100); // Convert percentage to decimal
                $('#prefer_super_price_price_final').val(super_percentage_final.toFixed(2));
            }
            // calculationAboutSuper();
            $(document).on('input', '#prefer_sales_percentage', function () {
                // calculationAboutSales();
                // calculationAboutDirectoryCost();
                // calculationAboutDirectory();
                // calculationAboutNetProfit();
                // calculationAboutmarginProfit();
                // calculationAboutNetProfitPercentage()
                // calculationAboutRoofingPrice()
                // calculationAboutSkylight()
                // calculationAboutMaterialPrefer()

                calculationAboutSales();
                calculationAboutDirectoryCost();
                calculationAboutNetProfit();
                calculationAboutmarginProfit();
                calculationAboutNetProfitPercentage()
                calculationAboutRoofingPrice()
                calculationAboutSkylight()
                calculationAboutMaterialPrefer()
                calculationAboutLabourPrefer()
            });
            function calculationAboutSales() {
                var margin_profit_price_price_final = parseFloat($('#prefer_margin_profit_price_price_final').val()) || 0;
                var sales_percentage = parseFloat($('#prefer_sales_percentage').val()) || 0;
                var sales_percentage_final = margin_profit_price_price_final * (sales_percentage / 100);
                $('#prefer_sales_price_price_final').val(sales_percentage_final.toFixed(2));
            }
            // calculationAboutSales()
            $(document).on('input', '#prefer_directory_percentage', function () {
                calculationAboutDirectory();
                // calculationAboutNetProfit();
                // calculationAboutmarginProfit();
                // calculationAboutNetProfitPercentage()
                // calculationAboutRoofingPrice()
                // calculationAboutSkylight()
                // calculationAboutMaterialPrefer()

                calculationAboutNetProfit();
                calculationAboutmarginProfit();
                calculationAboutNetProfitPercentage()
                calculationAboutRoofingPrice()
                calculationAboutSkylight()
                calculationAboutMaterialPrefer()
                calculationAboutLabourPrefer()

            });
            function calculationAboutDirectory() {
                var margin_profit_price_price_final = parseFloat($('#prefer_margin_profit_price_price_final').val()) || 0;
                var directory_percentage = parseFloat($('#prefer_directory_percentage').val()) || 0;
                var directory_percentage_final = margin_profit_price_price_final * (directory_percentage / 100);
                $('#prefer_directory_price_price_final').val(directory_percentage_final.toFixed(2));
            }
            // calculationAboutDirectory();
            function calculationAboutDirectoryCost() {
                var sales_price_price_final = parseFloat($('#prefer_sales_price_price_final').val()) || 0;
                var super_price_price_final = parseFloat($('#prefer_super_price_price_final').val()) || 0;
                var directory_cost = sales_price_price_final + super_price_price_final;
                $('#prefer_directory_cost').val(directory_cost.toFixed(2));
            }
            // calculationAboutDirectoryCost();
            function calculationAboutNetProfit() {
                var project_cost_price_price_final = parseFloat($('#prefer_project_cost_price_price_final').val()) || 0;
                var margin_profit_price_price_final = parseFloat($('#prefer_margin_profit_price_price_final').val()) || 0;
                var directory_cost = parseFloat($('#prefer_directory_cost').val()) || 0;
                var netprofit = margin_profit_price_price_final - project_cost_price_price_final - directory_cost;
                $('#prefer_net_profit').val(netprofit.toFixed(2));
            }
            // calculationAboutNetProfit();
            $(document).on('input', '#prefer_skylight_price', function () {
                // calculationAboutmarginProfit()
                // calculationAboutNetProfitPercentage()
                // calculationAboutRoofingPrice()
                // calculationAboutMaterialPrefer()
                // calculationAboutSkylight()


                calculationAboutSkylight()
                calculationAboutmarginProfit()
                calculationAboutNetProfitPercentage()
                calculationAboutRoofingPrice()
                calculationAboutMaterialPrefer()
                calculationAboutLabourPrefer()
            });
            function calculationAboutSkylight(){
                var skylight_price = parseFloat($('#prefer_skylight_price').val()) || 0;
                var margin_profit_price_price_final = parseFloat($('#prefer_margin_profit_price_price_final').val()) || 0;
                var totalRecommendedPrice = skylight_price + margin_profit_price_price_final;
                $('#prefer_recommended_price').val(totalRecommendedPrice.toFixed(2));
                $('#prefer_recommended_price_global').text(totalRecommendedPrice.toFixed(2));
            }//ends
            // calculationAboutSkylight()
            function calculationAboutmarginProfit(){
                var recommended_price = parseFloat($('#prefer_recommended_price').val()) || 0;
                var project_cost_price_price_final = parseFloat($('#prefer_project_cost_price_price_final').val()) || 0;
                var totalmargin = ((recommended_price - project_cost_price_price_final) / recommended_price) * 100;
                $('#prefer_margin_percentage').val(totalmargin.toFixed(2));
            }//ends
            // calculationAboutmarginProfit()
            function calculationAboutNetProfitPercentage(){
                var recommended_price = parseFloat($('#prefer_recommended_price').val()) || 0;
                var net_profit = parseFloat($('#prefer_net_profit').val()) || 0;
                var total_net_profit = (net_profit / recommended_price) * 100;
                $('#prefer_net_profit_percentage').val(total_net_profit.toFixed(2));
            }//ends
            // calculationAboutNetProfitPercentage()
            // function calculationAboutRoofingPrice(){
            //     var margin_profit_price_price_final = parseFloat($('#prefer_margin_profit_price_price_final').val()) || 0;
            //     var totalsq = parseFloat($('#prefer_total_sq_c7').val()) || 0;
            //     var totalRoofingPrice = margin_profit_price_price_final/ totalsq;
            //     $('#prefer_roofing_price').val(totalRoofingPrice.toFixed(2));
            // }//ends
            function calculationAboutRoofingPrice() {
                var margin_profit_price_price_final = parseFloat($('#prefer_margin_profit_price_price_final').val()) || 0;
                var totalsq = parseFloat($('#prefer_total_sq_c7').val()) || 0;

                // if (totalsq > 0) {
                    var totalRoofingPrice = margin_profit_price_price_final / totalsq;
                    $('#prefer_roofing_price').val(totalRoofingPrice.toFixed(2));
                // } else {
                //     $('#prefer_roofing_price').val('0.00'); // or handle the case where totalsq is zero appropriately
                // }
            }//ends calculationAboutRoofingPrice
            // calculationAboutRoofingPrice()
            $(document).on('input', '#prefer_plywood', function () {
                // calculationAboutMaterialPrefer()
                // calculationAboutplywood()
                // calculationAboutSkylight();

                calculationAboutplywood()
                calculationAboutSkylight()
                calculationAboutMaterialPrefer()
                calculationAboutLabourPrefer()
            });
            function calculationAboutplywood(){
                var plywood = parseFloat($('#prefer_plywood').val()) || 0;
                var total = plywood * {{$roofDataPrefer['plywood']??0}};
                $('#prefer_plywood_price_per_sq_d_12').attr('value',total.toFixed(2));
            }//ends
            // calculationAboutplywood()
            $(document).on('input', '#prefer_additional_layer', function () {
                // calculationAboutadditionalLayer()
                // calculationAboutMaterialPrefer()
                // calculationAboutSkylight()

                calculationAboutadditionalLayer()
                calculationAboutSkylight()
                calculationAboutMaterialPrefer()
                calculationAboutLabourPrefer()
            });
            function calculationAboutadditionalLayer(){
                var additional_layer = parseFloat($('#prefer_additional_layer').val()) || 0;
                // console.log('additional_layer', additional_layer);
                var total = additional_layer * {{$roofDataPrefer['additional_layer']??0}};
                $('#prefer_additional_layer_price_per_sq_d_8').val(total.toFixed(2));
            }//ends
            // calculationAboutadditionalLayer()
            $(document).on('input', '#prefer_step_charge', function () {
                // calculationAboutstep_chargePrefer()
                // calculationAboutMaterialPrefer()
                // calculationAboutSkylight()

                calculationAboutstep_chargePrefer()
                calculationAboutSkylight()
                calculationAboutMaterialPrefer()
                calculationAboutLabourPrefer()
            });
            function calculationAboutstep_chargePrefer(){
                var step_charge = parseFloat($('#prefer_step_charge').val()) || 0;
                var total = step_charge * {{$roofDataPrefer['step_charge']??0}};
                $('#prefer_step_charge_price_per_sq_d_9').val(total.toFixed(2));
            }//ends
            // calculationAboutstep_chargePrefer()
            $(document).on('input', '#prefer_chimney_size', function () {
                // calculationAboutMaterialPrefer()
                // calculationAboutchimney_size()
                // calculationAboutSkylight()

                calculationAboutchimney_size()
                calculationAboutSkylight()
                calculationAboutMaterialPrefer()
                calculationAboutLabourPrefer()
            });
            function calculationAboutchimney_size(){
                // var chimney_size = parseFloat($('#prefer_chimney_size').val()) || 0;
                var chimney_size = {{ $chimneySize??0 }};
                console.log('chimeny:', chimney_size);
                var total = chimney_size * {{$roofDataPrefer['chimney_size']??0}};
                console.log(chimney_size, total);
                $('#prefer_chimney_size_price_per_sq_d_10').val(total.toFixed(2));
            }//ends
            function calculationSkylight() {
                var skylight = parseFloat($('#prefer_skylight_labour').val()) || 0;
                var baseSkylight = {{$roofDataPrefer['skylight']??0}};
                var totalSkylight = (skylight  * baseSkylight);
                $('#prefer_total_labour_skylight').val(totalSkylight.toFixed(2));
            }
        });
        $(document).ready(function() {
            $('.only-numbers').on('keypress', function(event) {
                var charCode = (event.which) ? event.which : event.keyCode;
                if ((charCode < 48 || charCode > 57) && charCode !== 46) {
                    event.preventDefault();
                }
                if (charCode === 46 && $(this).val().indexOf('.') !== -1) {
                    event.preventDefault();
                }
            });
            $('.only-numbers').on('paste', function(event) {
                var pasteData = event.originalEvent.clipboardData.getData('text');
                if (!/^\d*\.?\d*$/.test(pasteData)) {
                    event.preventDefault();
                }
            });
        });
        $(document).ready(function() {
            storeData();
            $(document).on('keyup', '.form-control', function() {
                storeData();
            });
            function storeData() {
                var formData = $('#store_roof_estimate_calculator_preferred').serialize();
                $.ajax({
                    url: '{{ route("store_roof_estimate_calculator_prefer") }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log(response);
                        // console.log('Data submitted successfully:', response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', error);
                    }
                });
            }
        });
        {{--$(document).ready(function() {--}}
        {{--    var isAjaxInProgress = false;--}}

        {{--    // Handle form input and send AJAX request--}}
        {{--    $(document).on('keyup', '.form-control', function() {--}}
        {{--        var formData = $('#store_roof_estimate_calculator_preferred').serialize();--}}
        {{--    --}}
        {{--        isAjaxInProgress = true; // Set flag when AJAX starts--}}
        {{--    --}}
        {{--        $.ajax({--}}
        {{--            url: '{{ route("store_roof_estimate_calculator_prefer") }}',--}}
        {{--            type: 'POST',--}}
        {{--            data: formData,--}}
        {{--            success: function(response) {--}}
        {{--                // Handle success (if needed)--}}
        {{--                console.log('Form data saved successfully');--}}
        {{--            },--}}
        {{--            error: function(xhr) {--}}
        {{--                console.error('Error in saving data', xhr);--}}
        {{--            },--}}
        {{--            complete: function() {--}}
        {{--                isAjaxInProgress = false; // Reset flag when AJAX finishes--}}
        {{--            }--}}
        {{--        });--}}
        {{--    });--}}

        {{--    // Intercept page reload or navigation attempt--}}
        {{--    window.onbeforeunload = function() {--}}
        {{--        if (isAjaxInProgress) {--}}
        {{--            return 'Your changes are still being saved, please wait...';--}}
        {{--        }--}}

        {{--        // Add a 10-second delay before reloading the page--}}
        {{--        setTimeout(function() {--}}
        {{--            window.location.reload();--}}
        {{--        }, 10000); // 10000ms = 10 seconds--}}

        {{--        return null; // Prevent the default browser reload warning--}}
        {{--    };--}}
        {{--});--}}

    </script>
{{--@endpush--}}
