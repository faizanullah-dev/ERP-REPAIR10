{{--@extends('layouts.master')--}}
{{--@push('css')--}}
{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">--}}
{{--    <style>--}}
{{--        .table-custom th, .table-custom td {--}}
{{--            vertical-align: middle;--}}
{{--            text-align: center;--}}
{{--        }--}}
{{--        .highlight {--}}
{{--            background-color: #system_ffff99;--}}
{{--        }--}}
{{--        .highlight-green {--}}
{{--            background-color: #system_ccffcc;--}}
{{--        }--}}
{{--        .highlight-yellow {--}}
{{--            background-color: #system_ffffcc;--}}
{{--        }--}}
{{--    </style>--}}
{{--@endpush--}}
{{--@section('content')--}}
    <section class="calculator_sec white-box">
        <div class="container-fluid">
            <form  class="row" action="{{route('store_roof_estimate_calculator_system')}}" id="store_roof_estimate_calculator_system" method="post">
                @csrf
                <input type="hidden" name="roof_estimate_calculator_id" value="{{$roofEstimateCalculator->id}}">
{{--                @if(isset($lead->roofEstimateCalculator) && $lead->roofEstimateCalculator)--}}
{{--                    <div class="col-md-10">--}}
{{--                        <div class="table_top_btn">--}}
{{--                            <a href="{{url('roof_estimation_calculator/' . $lead->roofEstimateCalculator->lead_id) }}" class="btn btn_green">Measurement</a>--}}
{{--                            <a href="{{url('roof_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->roofEstimateCalculator->id}}/preferred" class="btn btn_green">Preferred  ( {{@$lead->roofEstimateCalculator->roofEstimateCalculatorpreferred->recommended_price??'0'}} ) </a>--}}
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
                    <h2 class="text-center mb-4">System</h2>
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
                                <input  class="form-control only-numbers"   type="text" name="recommended_price" id="system_recommended_price" value="{{$roofEstimateCalculator->RoofEstimateCalculatorSystem->recommended_price??'0'}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Roofing Price</td>
                            <td></td>
                            <td>Price per SQ</td>
                            <td>
                                <input  class="form-control only-numbers"   type="text" name="roofing_price" id="system_roofing_price" value="{{$roofEstimateCalculator->RoofEstimateCalculatorSystem->roofing_price??'0'}}" readonly>
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
{{--                                <input  class="form-control only-numbers"  type="text" id="system_total_sq_c7" value="{{$roofEstimateCalculator->RoofEstimateCalculatorSystem->total_sq??$roofEstimateCalculator->total_sq??'0'}}" name="total_sq" readonly>--}}
                                <input  class="form-control only-numbers"  type="text" id="system_total_sq_c7" value="{{$roofEstimateCalculator->eave_rakes_total_percent??'0'}}" name="total_sq" readonly>
                            </td>
                            <td>Price per SQ</td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Additional layer</td>
                            <td class="highlight-green">
                                <input  class="form-control only-numbers"  type="text" id="system_additional_layer" value="{{ $additional_layer ??"0" }}" name="additional_layer" readonly @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                            </td>
                            <td><input  class="form-control only-numbers"  type="text" id="system_additional_layer_price_per_sq_d_8" value="{{$roofEstimateCalculator->RoofEstimateCalculatorSystem->additional_layer_price_per_sq??$additional_layer_price_per_sq??"0"}}" name="additional_layer_price_per_sq" readonly></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Step Charge</td>
                            <td class="highlight-green">
                                <input  class="form-control only-numbers"  type="text" id="system_step_charge" value="{{ $stepCharge??"0"}}" name="step_charge" readonly @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                            </td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" id="system_step_charge_price_per_sq_d_9" value="{{$roofEstimateCalculator->RoofEstimateCalculatorSystem->step_charge_price_per_sq??$stepChargePricePerSq??"0"}}" name="step_charge_price_per_sq" readonly>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Chimney</td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" id="system_chimney_size" value="{{ $chimneySize??"0"}}" name="chimney_size" readonly @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                            </td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" id="system_chimney_size_price_per_sq_d_10" value="{{$roofEstimateCalculator->RoofEstimateCalculatorSystem->chimney_size_price_per_sq??$chimneySizePricePerSq??"0"}}" name="chimney_size_price_per_sq" readonly>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Skylight</td>
                            <td>
                                <input class="form-control only-numbers" type="text" value="{{ $skyLightQuantity??"" }}" id="system_skylight_labour" name="skylight_labour" readonly @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                            </td>
                            <td>
                                <input class="form-control only-numbers" type="text" id="system_total_labour_skylight" value="" name="skylight_labour_final" readonly>
                            </td>
                            <td>
                            </td>
                        </tr>
                        <tr>
                            <td>Siding / Azeck</td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="siding_azeck" id="system_siding_azeck" value="{{ $roofEstimateCalculator->RoofEstimateCalculatorSystem->siding_azeck??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                            </td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="siding_azeck_price_per_sq" id="system_siding_azeck_price_per_sq_d_11" value="{{$roofEstimateCalculator->RoofEstimateCalculatorSystem->siding_azeck_price_per_sq??'0'}}">
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Plywood</td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" id="system_plywood" value="{{ $plywood??"0"}}" name="plywood" readonly @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                            </td>
                            <td >
                                <input  class="form-control only-numbers"  type="text" id="system_plywood_price_per_sq_d_12" value="{{$roofEstimateCalculator->RoofEstimateCalculatorSystem->plywood_price_per_sq??$plywoodPricePerSq??"0"}}" name="plywood_price_per_sq" readonly>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Skylight</td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="skylight_price" id="system_skylight_price" value="{{ $skyLightQuantity??'0'}}" readonly @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                            </td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="skylight_price_price_per_sq" id="system_skylight_price_price_per_sq_d_13" value="{{$skyLightPrice??'0'}}" readonly>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Miscellaneous</td>
                            <td></td>
                            <td>
                                <input  class="form-control only-numbers" placeholder="Type Here..." type="text" name="system_miscellaneous" id="system_miscellaneous" value="{{$roofEstimateCalculator->RoofEstimateCalculatorSystem->system_miscellaneous??0}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
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
                                <input  class="form-control only-numbers"  type="text" name="materials_price_price_per_sq" id="system_materials_price_price_per_sq_d_15"  value="{{$roofEstimateCalculator->RoofEstimateCalculatorSystem->materials_price_price_per_sq??$roofDataSystem['materials_price_price_per_sq']??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                            </td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="materials_price_price_final" id="system_materials_price_price_final" min="0" value="{{$roofEstimateCalculator->RoofEstimateCalculatorSystem->materials_price_price_final??'0'}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Labor</td>
                            <td></td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="labour_price_price_per_sq" id="system_labour_price_price_per_sq_d_16" value="{{$roofEstimateCalculator->RoofEstimateCalculatorSystem->labour_price_price_per_sq??$roofDataSystem['labour_price_price_per_sq']??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                            </td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="labour_price_price_final" id="system_labour_price_price_final" min="0" value="{{$roofEstimateCalculator->RoofEstimateCalculatorSystem->labour_price_price_final??'0'}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Dumpster (%)</td>
                            <td></td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="dumpster_price_price_per_sq" id="system_dumpster_price_price_per_sq_d_17" value="{{$roofEstimateCalculator->RoofEstimateCalculatorSystem->dumpster_price_price_per_sq??$roofDataSystem['dumpster_price_price_per_sq']??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                            </td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="dumster_price_price_final" id="system_dumster_price_price_final" value="{{$roofEstimateCalculator->RoofEstimateCalculatorSystem->dumster_price_price_final??'0'}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Permit / Warranty (%)</td>
                            <td></td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="permit_warranty_price_price_per_sq" id="system_permit_warranty_price_price_per_sq_d_18" value="{{$roofEstimateCalculator->RoofEstimateCalculatorSystem->permit_warranty_price_price_per_sq??$roofDataSystem['permit_warranty_price_price_per_sq']??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                            </td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="permit_warranty_price_price_final" id="system_permit_warranty_price_price_final" value="{{$roofEstimateCalculator->RoofEstimateCalculatorSystem->permit_warranty_price_price_final??'0'}}" readonly>

                            </td>
                        </tr>


                        <tr>
                            <td class="highlight-yellow">Project Cost</td>
                            <td></td>
                            <td></td>
                            <td class="highlight-yellow">
                                <input  class="form-control only-numbers"  type="text" name="project_cost" id="system_project_cost_price_price_final" value="{{$roofEstimateCalculator->RoofEstimateCalculatorSystem->project_cost??'0'}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Margin Profit</td>
                            <td></td>
                            <td></td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="margin_profit" id="system_margin_profit_price_price_final" value="{{$roofEstimateCalculator->RoofEstimateCalculatorSystem->margin_profit??'0'}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Super(%)</td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="super_percentage" id="system_super_percentage" value="{{$roofEstimateCalculator->RoofEstimateCalculatorSystem->super_percentage??$roofDataSystem['super_percentage']??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                            </td>
                            <td></td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="super_price_price_final" id="system_super_price_price_final" value="{{$roofEstimateCalculator->RoofEstimateCalculatorSystem->super_price_price_final??'0'}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Sales(%)</td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="sales_percentage" id="system_sales_percentage" value="{{$roofEstimateCalculator->RoofEstimateCalculatorSystem->sales_percentage??$roofDataSystem['sales_percentage']??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                            </td>
                            <td></td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="sales_price_price_final" id="system_sales_price_price_final" value="{{$roofEstimateCalculator->RoofEstimateCalculatorSystem->sales_price_price_final??'0'}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td class="highlight-yellow">Direct Cost</td>
                            <td></td>
                            <td></td>
                            <td class="highlight-yellow">
                                <input  class="form-control only-numbers"  type="text" name="directory_cost" id="system_directory_cost" value="{{$roofEstimateCalculator->RoofEstimateCalculatorSystem->directory_cost??'0'}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Net Profit</td>
                            <td></td>
                            <td></td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="net_profit" id="system_net_profit" value="{{$roofEstimateCalculator->RoofEstimateCalculatorSystem->net_profit??'0'}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Margin %</td>
                            <td></td>
                            <td></td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="margin_percentage" id="system_margin_percentage" value="{{$roofEstimateCalculator->RoofEstimateCalculatorSystem->margin_percentage??'0'}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Net Profit %</td>
                            <td></td>
                            <td></td>
                            <td>
                                <input  class="form-control only-numbers"  type="text" name="net_profit_percentage" id="system_net_profit_percentage" value="{{$roofEstimateCalculator->RoofEstimateCalculatorSystem->net_profit_percentage??'0'}}" readonly>
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
                $roofDataSystem = json_decode($roofBaseValuesSystem->roof_system, true);
            @endphp

            var sq = $('#system_total_sq_c7').val();
            var layer = {{ $additional_layer }};
            var totalLayer = sq * layer;
            // if(totalLayer == '0'){
            //     totalLayer = layer;
            // }
            $('#system_additional_layer').val(totalLayer);
            var stepCharge = {{ $stepCharge }};
            var totalStepCharge = sq * stepCharge;
            // if(totalStepCharge == '0'){
            //     totalStepCharge = stepCharge;
            // }
            $('#system_step_charge').val(totalStepCharge);

            // setTimeout(function() {
                // calculationAboutDirectoryCost();
                // calculationAboutNetProfitPercentage();
                // calculationAboutRoofingPrice();
                // calculationAboutplywood();
                // calculationAboutstep_charge();
                // calculationAboutadditionalLayer();
                // calculationAboutchimney_size();
                //
                // calculationAboutSuper();
                // calculationAboutSales();
                // calculationAboutNetProfit();
                //
                // calculationSkylight();
                // calculationAboutMaterial();
                // calculationAboutLabour();
                // calculationAboutDumpster();
                // calculationAboutPermit();
                // calculationAboutProjectCost();
                // calculationAboutMarginProfit();
                // calculationAboutSkylight();
                // calculationAboutmarginProfit();

                // calculationSkylight();
                // calculationAboutMaterial();
                // calculationAboutDumpster();
                // calculationAboutPermit();
                // calculationAboutProjectCost()
                // calculationAboutMarginProfit();
                // calculationAboutSuper();
                // calculationAboutSales();
                // calculationAboutNetProfit();
                // calculationAboutSkylight();
                // calculationAboutDirectoryCost();
                // calculationAboutmarginProfit();
                // calculationAboutLabour();
                // calculationAboutNetProfitPercentage()
                // calculationAboutRoofingPrice()


                calculationAboutadditionalLayer();
                calculationAboutstep_charge();
                calculationAboutchimney_size();
                calculationAboutRoofingPrice();
                calculationSkylight();
                calculationAboutplywood();
                calculationAboutMaterial();
                calculationAboutLabour();
                calculationAboutDumpster();
                calculationAboutPermit();
                calculationAboutProjectCost()
                calculationAboutMarginProfit();
                calculationAboutSuper();
                calculationAboutSales();
                calculationAboutNetProfit();
                calculationAboutSkylight();
                calculationAboutDirectoryCost();
                calculationAboutmarginProfit();
                calculationAboutNetProfitPercentage()
                calculationAboutRoofingPrice()
            // }, 50);

            $(document).on('input', '#system_materials_price_price_per_sq_d_15,#system_skylight_price_price_per_sq_d_13, #system_plywood_price_per_sq_d_12, #system_siding_azeck_price_per_sq_d_11,  #system_chimney_size_price_per_sq_d_10', function () {
                calculationAboutMaterial();
                calculationAboutLabour();
            });

            function calculationAboutMaterial() {
                var totalsq = parseFloat($('#system_total_sq_c7').val()) || 0;
                var materials = parseFloat($('#system_materials_price_price_per_sq_d_15').val()) || 0;
                var chimney_size = parseFloat($('#system_chimney_size_price_per_sq_d_10').val()) || 0;
                var plywood_price = parseFloat($('#system_plywood_price_per_sq_d_12').val()) || 0;
                var siding_azeck = parseFloat($('#system_siding_azeck_price_per_sq_d_11').val()) || 0;
                var skylightPrice = parseFloat($('#system_skylight_price_price_per_sq_d_13').val()) || 0;
                var multiply = totalsq * materials + chimney_size + plywood_price + siding_azeck + skylightPrice;
                $('#system_materials_price_price_final').val(multiply.toFixed(2));
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
            // calculationAboutMaterial();
            $(document).on('input', '#system_labour_price_price_per_sq_d_16, #system_plywood_price_per_sq_d_12,#system_chimney_size_price_per_sq_d_10, #system_step_charge_price_per_sq_d_9, #system_siding_azeck_price_per_sq_d_11, #system_additional_layer_price_per_sq_d_8', function () {
                calculationAboutLabour();
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
                calculationAboutMaterial()

            });
            function calculationAboutLabour() {
                var totalsq = parseFloat($('#system_total_sq_c7').val()) || 0;
                var labour = parseFloat($('#system_labour_price_price_per_sq_d_16').val()) || 0;
                var additional_layer = parseFloat($('#system_additional_layer_price_per_sq_d_8').val()) || 0;
                var step_charge = parseFloat($('#system_step_charge_price_per_sq_d_9').val()) || 0;
                var chimney_size = parseFloat($('#system_chimney_size_price_per_sq_d_10').val()) || 0;
                var siding_azeck = parseFloat($('#system_siding_azeck_price_per_sq_d_11').val()) || 0;
                var plywood_price = parseFloat($('#system_plywood_price_per_sq_d_12').val()) || 0;
                var laboutSkylight = parseFloat($('#system_total_labour_skylight').val()) || 0;
                var multiply = totalsq * labour + additional_layer + step_charge + chimney_size + siding_azeck + plywood_price + laboutSkylight ;
                $('#system_labour_price_price_final').val(multiply.toFixed(2));
            }
            // calculationAboutLabour();
            $(document).on('input', '#system_dumpster_price_price_per_sq_d_17, #system_materials_price_price_final', function () {
                calculationAboutMaterial()
                calculationAboutLabour()
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
                var materials_price = parseFloat($('#system_materials_price_price_final').val()) || 0;
                var dumpster_percentage = parseFloat($('#system_dumpster_price_price_per_sq_d_17').val()) || 0;
                var multiply = materials_price * (dumpster_percentage / 100);
                $('#system_dumster_price_price_final').val(multiply.toFixed(2));
            }
            // calculationAboutDumpster();

            $(document).on('input', '#system_permit_warranty_price_price_per_sq_d_18, #system_materials_price_price_final', function () {
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
                calculationAboutMaterial();
                calculationAboutLabour();

            });
            $(document).on('input', '#system_miscellaneous', function () {
                // calculationAboutMaterial();
                // calculationAboutDumpster();
                // calculationAboutPermit();
                calculationAboutProjectCost();
                calculationAboutMarginProfit();
                calculationAboutSuper();
                calculationAboutSales();
                calculationAboutDirectoryCost();
                calculationAboutNetProfit();
                calculationAboutSkylight();
                // calculationAboutmarginProfit();
                // calculationAboutNetProfitPercentage();
                // calculationAboutRoofingPrice();
                // calculationAboutLabour();
            });
            function calculationAboutPermit() {
                var materials_price = parseFloat($('#system_materials_price_price_final').val()) || 0;
                var permit_warranty_price = parseFloat($('#system_permit_warranty_price_price_per_sq_d_18').val()) || 0;
                var multiply = materials_price * (permit_warranty_price / 100);
                $('#system_permit_warranty_price_price_final').val(multiply.toFixed(2));
            }
            // calculationAboutPermit();
            function calculationAboutProjectCost() {
                var materials_price_price_final = parseFloat($('#system_materials_price_price_final').val()) || 0;
                var labour_price_price_final = parseFloat($('#system_labour_price_price_final').val()) || 0;
                var dumster_price_price_final = parseFloat($('#system_dumster_price_price_final').val()) || 0;
                var permit_warranty_price_price_final = parseFloat($('#system_permit_warranty_price_price_final').val()) || 0;
                var system_miscellaneous = parseFloat($('#system_miscellaneous').val()) || 0;
                var addition = materials_price_price_final + labour_price_price_final+ permit_warranty_price_price_final + dumster_price_price_final + system_miscellaneous;
                $('#system_project_cost_price_price_final').val(addition.toFixed(2));
            }
            // calculationAboutProjectCost();

            function calculationAboutMarginProfit() {
                var project_cost_price_price_final = parseFloat($('#system_project_cost_price_price_final').val()) || 0;
                var percentage = (project_cost_price_price_final / ({{$roofDataSystem['margin_profit'] ?? 1 }} / 100 )); // Divide by 0.80 to get 100%
                $('#system_margin_profit_price_price_final').val(percentage.toFixed(2));
            }//ends calculationAboutMarginProfit

            // calculationAboutMarginProfit();

            $(document).on('input', '#system_super_percentage', function () {
                calculationAboutSuper();
                calculationAboutSales();
                calculationAboutDirectoryCost();
                calculationAboutNetProfit();
                calculationAboutmarginProfit();
                calculationAboutNetProfitPercentage()
                calculationAboutRoofingPrice()
                calculationAboutMaterial()
                calculationAboutLabour()
                calculationAboutSkylight()
            });
            function calculationAboutSuper() {
                var margin_profit_price_price_final = parseFloat($('#system_margin_profit_price_price_final').val()) || 0;
                var super_percentage = parseFloat($('#system_super_percentage').val()) || 0;
                var super_percentage_final = margin_profit_price_price_final * (super_percentage / 100); // Convert percentage to decimal
                $('#system_super_price_price_final').val(super_percentage_final.toFixed(2));
            }

            // calculationAboutSuper();



            $(document).on('input', '#system_sales_percentage', function () {
                calculationAboutSales();
                calculationAboutDirectoryCost();
                calculationAboutNetProfit();
                calculationAboutmarginProfit();
                calculationAboutNetProfitPercentage()
                calculationAboutRoofingPrice()
                calculationAboutSkylight()
                calculationAboutMaterial()
                calculationAboutLabour()

            });
            function calculationAboutSales() {
                var margin_profit_price_price_final = parseFloat($('#system_margin_profit_price_price_final').val()) || 0;
                var sales_percentage = parseFloat($('#system_sales_percentage').val()) || 0;
                var sales_percentage_final = margin_profit_price_price_final * (sales_percentage / 100);
                $('#system_sales_price_price_final').val(sales_percentage_final.toFixed(2));
            }
            // calculationAboutSales()

            $(document).on('input', '#system_directory_percentage', function () {
                calculationAboutNetProfit();
                calculationAboutmarginProfit();
                calculationAboutNetProfitPercentage()
                calculationAboutRoofingPrice()
                calculationAboutSkylight()
                calculationAboutMaterial()
                calculationAboutLabour()

            });

            function calculationAboutDirectoryCost() {
                var sales_price_price_final = parseFloat($('#system_sales_price_price_final').val()) || 0;
                var super_price_price_final = parseFloat($('#system_super_price_price_final').val()) || 0;
                var directory_cost = sales_price_price_final + super_price_price_final;
                $('#system_directory_cost').val(directory_cost.toFixed(2));
            }
            // calculationAboutDirectoryCost();

            function calculationAboutNetProfit() {
                var project_cost_price_price_final = parseFloat($('#system_project_cost_price_price_final').val()) || 0;
                var margin_profit_price_price_final = parseFloat($('#system_margin_profit_price_price_final').val()) || 0;
                var directory_cost = parseFloat($('#system_directory_cost').val()) || 0;
                var netprofit = margin_profit_price_price_final - project_cost_price_price_final - directory_cost;
                $('#system_net_profit').val(netprofit.toFixed(2));
            }
            // calculationAboutNetProfit();

            $(document).on('input', '#system_skylight_price', function () {
                calculationAboutSkylight()
                calculationAboutmarginProfit()
                calculationAboutNetProfitPercentage()
                calculationAboutRoofingPrice()
                calculationAboutMaterial()
                calculationAboutLabour()
            });
            function calculationAboutSkylight(){
                var skylight_price = parseFloat($('#system_skylight_price').val()) || 0;
                var margin_profit_price_price_final = parseFloat($('#system_margin_profit_price_price_final').val()) || 0;
                var totalRecommendedPrice = skylight_price + margin_profit_price_price_final;
                $('#system_recommended_price').val(totalRecommendedPrice.toFixed(2));
                $('#system_recommended_price_global').text(totalRecommendedPrice.toFixed(2));
            }//ends
            // calculationAboutSkylight()

            function calculationAboutmarginProfit(){
                var recommended_price = parseFloat($('#system_recommended_price').val()) || 0;
                var project_cost_price_price_final = parseFloat($('#system_project_cost_price_price_final').val()) || 0;
                var totalmargin = ((recommended_price - project_cost_price_price_final) / recommended_price) * 100;
                $('#system_margin_percentage').val(totalmargin.toFixed(2));
            }//ends
            // calculationAboutmarginProfit()

            function calculationAboutNetProfitPercentage(){
                var recommended_price = parseFloat($('#system_recommended_price').val()) || 0;
                var net_profit = parseFloat($('#system_net_profit').val()) || 0;
                var total_net_profit = (net_profit / recommended_price) * 100;
                $('#system_net_profit_percentage').val(total_net_profit.toFixed(2));
            }//ends
            // calculationAboutNetProfitPercentage()

            function calculationAboutRoofingPrice(){
                var margin_profit_price_price_final = parseFloat($('#system_margin_profit_price_price_final').val()) || 0;
                var totalsq = parseFloat($('#system_total_sq_c7').val()) || 0;
                var totalRoofingPrice = margin_profit_price_price_final/ totalsq;
                $('#system_roofing_price').val(totalRoofingPrice.toFixed(2));
            }//ends
            // calculationAboutRoofingPrice()
            $(document).on('input', '#system_plywood', function () {
                calculationAboutplywood()
                calculationAboutSkylight()
                calculationAboutMaterial()
                calculationAboutLabour()
            });
            function calculationAboutplywood(){
                var plywood = parseFloat($('#system_plywood').val()) || 0;
                var total = plywood * {{$roofDataSystem['plywood'] ?? 0}};
                $('#system_plywood_price_per_sq_d_12').val(total.toFixed(2));
            }//ends
            // calculationAboutplywood()
            $(document).on('input', '#system_additional_layer', function () {
                calculationAboutadditionalLayer()
                calculationAboutSkylight()
                calculationAboutMaterial()
                calculationAboutLabour()
            });
            function calculationAboutadditionalLayer(){
                var additional_layer = parseFloat($('#system_additional_layer').val()) || 0;
                var total = additional_layer * {{$roofDataSystem['additional_layer'] ?? 0}};
                $('#system_additional_layer_price_per_sq_d_8').val(total.toFixed(2));
            }//ends
            // calculationAboutadditionalLayer()

            $(document).on('input', '#system_step_charge', function () {
                calculationAboutstep_charge()
                calculationAboutSkylight()
                calculationAboutMaterial()
                calculationAboutLabour()
            });
            function calculationAboutstep_charge(){
                var step_charge = parseFloat($('#system_step_charge').val()) || 0;
                var total = step_charge * {{$roofDataSystem['step_charge']??0}};
                $('#system_step_charge_price_per_sq_d_9').val(total.toFixed(2));
            }//ends
            // calculationAboutstep_charge()

            $(document).on('input', '#system_chimney_size', function () {
                calculationAboutchimney_size()
                calculationAboutSkylight()
                calculationAboutMaterial()
                calculationAboutLabour()
            });
            function calculationAboutchimney_size(){
                var chimney_size = parseFloat($('#system_chimney_size').val()) || 0;
                var total = chimney_size * {{$roofDataSystem['chimney_size']??0}};
                $('#system_chimney_size_price_per_sq_d_10').val(total.toFixed(2));
            }//ends
            // calculationAboutchimney_size()
            function calculationSkylight() {
                var skylight = parseFloat($('#system_skylight_labour').val()) || 0;
                var baseSkylight = {{$roofDataSystem['skylight']??0}};
                var totalSkylight = (skylight  * baseSkylight);
                $('#system_total_labour_skylight').val(totalSkylight.toFixed(2));
            }
        });

        $(document).ready(function() {
            $('.only-numbers').on('keypress', function(event) {
                var charCode = (event.which) ? event.which : event.keyCode;
                // Allow numbers (0-9), and the decimal point (.)
                if ((charCode < 48 || charCode > 57) && charCode !== 46) {
                    event.preventDefault();
                }
                // Ensure only one decimal point is allowed
                if (charCode === 46 && $(this).val().indexOf('.') !== -1) {
                    event.preventDefault();
                }
            });

            $('.only-numbers').on('paste', function(event) {
                var pasteData = event.originalEvent.clipboardData.getData('text');
                // Check if the pasted data is a valid number (including decimals)
                if (!/^\d*\.?\d*$/.test(pasteData)) {
                    event.preventDefault();
                }
            });
        });
        $(document).ready(function(){
            storeData();
        $(document).on('keyup', '.form-control', function() {
            storeData();
        });
            function storeData(){
                var formData = $('#store_roof_estimate_calculator_system').serialize();
                console.log(formData)
            $.ajax({
                url: '{{ route("store_roof_estimate_calculator_system") }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr) {
                    console.error(xhr);
                }
            });
            }
        });
    </script>
{{--@endpush--}}
