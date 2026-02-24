{{--@extends('layouts.master')--}}
{{--@push('css')--}}
{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">--}}
{{--    <style>--}}
{{--        .table-custom th, .table-custom td {--}}
{{--            vertical-align: middle;--}}
{{--            text-align: center;--}}
{{--        }--}}
{{--        .highlight {--}}
{{--            background-color: #flat_ffff99;--}}
{{--        }--}}
{{--        .highlight-green {--}}
{{--            background-color: #flat_ccffcc;--}}
{{--        }--}}
{{--        .highlight-yellow {--}}
{{--            background-color: #flat_ffffcc;--}}
{{--        }--}}
{{--    </style>--}}
{{--@endpush--}}
{{--@section('content')--}}

<section class="calculator_sec white-box">
    <div class="container-fluid">
        <form class="row" action="{{route('store_roof_estimate_calculator_flat_roof')}}" id="store_roof_estimate_calculator_flat_roof" method="post">
            @csrf
            <input type="hidden" name="roof_estimate_calculator_id" value="{{$roofEstimateCalculator->id}}">
            {{--                @if(isset($lead->roofEstimateCalculator) && $lead->roofEstimateCalculator)--}}
            {{--                    <div class="col-md-10">--}}
            {{--                        <div class="table_top_btn">--}}
            {{--                            <a href="{{url('roof_estimation_calculator/' . $lead->roofEstimateCalculator->lead_id) }}" class="btn btn_green">Measurement</a>--}}
            {{--                            <a href="{{url('roof_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->roofEstimateCalculator->id}}/preferred" class="btn btn_green">Preferred  ( {{@$lead->roofEstimateCalculator->roofEstimateCalculatorpreferred->recommended_price??'0'}} ) </a>--}}
            {{--                            <a href="{{url('roof_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->roofEstimateCalculator->id}}/system" class="btn btn_green">System  ( {{@$lead->roofEstimateCalculator->roofEstimateCalculatorSystem->recommended_price??'0'}} )</a>--}}
            {{--                            <a href="{{url('roof_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->roofEstimateCalculator->id}}/under_fifteen_sq" class="btn btn_green">Under 15 SQ  ( {{@$lead->roofEstimateCalculator->roofEstimateCalculatorUnderFifteen->recommended_price??'0'}} )</a>--}}
            {{--                            <a href="{{url('roof_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->roofEstimateCalculator->id}}/gutters" class="btn btn_green">Gutter  ( {{@$lead->roofEstimateCalculator->storeRoofEstimateCalculatorGutter->recommended_price??'0'}} )  ( {{@$lead->roofEstimateCalculator->storeRoofEstimateCalculatorGutter->recommended_price_two??'0'}} ) </a>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                    <div class="col-md-2">--}}
            {{--                        <a class="btn btn-success pull-right" href="{{ url('roof_estimation_calculator/' . $lead->id) }}">--}}
            {{--                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back--}}
            {{--                        </a>--}}
            {{--                    </div>--}}
            {{--                @endif--}}
            <div class="col-md-12">
                <h2 class="text-center mb-4">Flat Roof</h2>
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
                            <input class="form-control only-numbers" type="text" name="recommended_price" id="flat_recommended_price" value="{{$roofEstimateCalculator->roofEstimateCalculatorFlatRoof->recommended_price??'0'}}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Roofing Price</td>
                        <td></td>
                        <td>Price per SQ</td>
                        <td>
                            <input  class="form-control only-numbers"   type="text" name="roofing_price" id="flat_roofing_price" value="{{$roofEstimateCalculator->roofEstimateCalculatorFlatRoof->roofing_price??'0'}}" readonly>
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
                            <input  class="form-control only-numbers"  type="text" id="flat_total_sq_c7" value="{{ $roofEstimateCalculator->eave_rakes_total_percent??"0" }}" name="total_sq" readonly>
                        </td>
                        <td>Price per SQ</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Additional layer</td>
                        <td class="highlight-green">
                            <input  class="form-control only-numbers"  type="text" id="flat_additional_layer" value="{{ $additional_layer??'0'}}" name="additional_layer" readonly @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                        </td>
                        <td><input  class="form-control only-numbers"  type="text" id="flat_additional_layer_price_per_sq_d_8" value="{{ $additional_layer_price_per_sq??'0'}}" name="additional_layer_price_per_sq" readonly></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Step Charge</td>
                        <td class="highlight-green">
                            <input  class="form-control only-numbers"  type="text" id="flat_step_charge" value="{{ $stepCharge??'0'}}" name="step_charge" readonly @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                        </td>
                        <td>
                            <input  class="form-control only-numbers"  type="text" id="flat_step_charge_price_per_sq_d_9" value="{{ $stepChargePricePerSq??'0'}}" name="step_charge_price_per_sq" readonly>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Chimney </td>
                        <td>
                            <input  class="form-control only-numbers"  type="text" id="flat_chimney_size" value="{{ $chimneySize??'0'}}" name="chimney_size" readonly @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                        </td>
                        <td >
                            <input  class="form-control only-numbers"  type="text" id="flat_chimney_size_price_per_sq_d_10" value="{{ $chimneySizePricePerSq??'0'}}" name="chimney_size_price_per_sq" readonly>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Skylight</td>
                        <td>
                            <input class="form-control only-numbers" type="text" value="{{ $skyLightQuantity??"" }}" id="flat_skylight_labour" name="skylight_labour" readonly @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                        </td>
                        <td>
                            <input class="form-control only-numbers" type="text" id="flat_total_labour_skylight" value="" name="skylight_labour_final" readonly>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>Siding / Azeck</td>
                        <td>
                            <input  class="form-control only-numbers"  type="text" name="siding_azeck" id="flat_siding_azeck" value="{{$roofEstimateCalculator->roofEstimateCalculatorFlatRoof->siding_azeck??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                        </td>
                        <td>
                            <input  class="form-control only-numbers"  type="text" name="siding_azeck_price_per_sq" id="flat_siding_azeck_price_per_sq_d_11" value="{{$roofEstimateCalculator->roofEstimateCalculatorFlatRoof->siding_azeck_price_per_sq_d_11??'0'}}">
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Plywood</td>
                        <td>
                            <input  class="form-control only-numbers"  type="text" id="flat_plywood" value="{{ $plywood??'0'}}" name="plywood" readonly @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                        </td>
                        <td >
                            <input  class="form-control only-numbers"  type="text" id="flat_plywood_price_per_sq_d_12" value="{{ $plywoodPricePerSq??'0'}}" name="plywood_price_per_sq" readonly>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Skylight</td>
                        <td>
                            <input  class="form-control only-numbers"  type="text" name="skylight_price" id="flat_skylight_price" value="{{ $skyLightQuantity??'0' }}" readonly @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                        </td>
                        <td>
                            <input  class="form-control only-numbers"  type="text" name="skylight_price_price_per_sq" id="flat_skylight_price_price_per_sq_d_13" value="{{ $skyLightPrice??'0'}}" readonly>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Miscellaneous</td>
                        <td></td>
                        <td>
                                <input  class="form-control only-numbers" placeholder="Type Here..."  type="text" name="flat_miscellaneous" id="flat_miscellaneous" value="{{$roofEstimateCalculator->roofEstimateCalculatorFlatRoof->flat_miscellaneous??0}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
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
                            <input  class="form-control only-numbers"  type="text" name="materials_price_price_per_sq" id="flat_materials_price_price_per_sq_d_15"  value="{{$roofEstimateCalculator->roofEstimateCalculatorFlatRoof->materials_price_price_per_sq??$roofDataFlat['materials_price_price_per_sq']??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                        </td>
                        <td>
                            <input  class="form-control only-numbers"  type="text" name="materials_price_price_final" id="flat_materials_price_price_final" min="0" value="{{$roofEstimateCalculator->roofEstimateCalculatorFlatRoof->materials_price_price_final??'0'}}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Labor</td>
                        <td></td>
                        <td>
                            <input  class="form-control only-numbers"  type="text" name="labour_price_price_per_sq" id="flat_labour_price_price_per_sq_d_16" value="{{$roofEstimateCalculator->roofEstimateCalculatorFlatRoof->labour_price_price_per_sq??$roofDataFlat['labour_price_price_per_sq']??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                        </td>
                        <td>
                            <input  class="form-control only-numbers"  type="text" name="labour_price_price_final" id="flat_labour_price_price_final" min="0" value="{{$roofEstimateCalculator->roofEstimateCalculatorFlatRoof->labour_price_price_final??'0'}}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Dumpster (%)</td>
                        <td></td>
                        <td>
                            <input  class="form-control only-numbers"  type="text" name="dumpster_price_price_per_sq" id="flat_dumpster_price_price_per_sq_d_17" value="{{$roofEstimateCalculator->roofEstimateCalculatorFlatRoof->dumpster_price_price_per_sq??$roofDataFlat['dumpster_price_price_per_sq']??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                        </td>
                        <td>
                            <input  class="form-control only-numbers"  type="text" name="dumster_price_price_final" id="flat_dumster_price_price_final" value="{{$roofEstimateCalculator->roofEstimateCalculatorFlatRoof->dumster_price_price_final??'0'}}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Permit / Warranty (%)</td>
                        <td></td>
                        <td>
                            <input  class="form-control only-numbers"  type="text" name="permit_warranty_price_price_per_sq" id="flat_permit_warranty_price_price_per_sq_d_18" value="{{$roofEstimateCalculator->roofEstimateCalculatorFlatRoof->permit_warranty_price_price_per_sq??$roofDataFlat['permit_warranty_price_price_per_sq']??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                        </td>
                        <td>
                            <input  class="form-control only-numbers"  type="text" name="permit_warranty_price_price_final" id="flat_permit_warranty_price_price_final" value="{{$roofEstimateCalculator->roofEstimateCalculatorFlatRoof->permit_warranty_price_price_final??'0'}}" readonly>
                        </td>
                    </tr>

                    <tr>
                        <td class="highlight-yellow">Project Cost</td>
                        <td></td>
                        <td></td>
                        <td class="highlight-yellow">
                            <input  class="form-control only-numbers"  type="text" name="project_cost" id="flat_project_cost_price_price_final" value="{{$roofEstimateCalculator->roofEstimateCalculatorFlatRoof->project_cost??'0'}}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Margin Profit</td>
                        <td></td>
                        <td></td>
                        <td>
                            <input  class="form-control only-numbers"  type="text" name="margin_profit" id="flat_margin_profit_price_price_final" value="{{$roofEstimateCalculator->roofEstimateCalculatorFlatRoof->margin_profit??'0'}}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Super(%)</td>
                        <td>
                            <input  class="form-control only-numbers"  type="text" name="super_percentage" id="flat_super_percentage" value="{{$roofEstimateCalculator->roofEstimateCalculatorFlatRoof->super_percentage??$roofDataFlat['super_percentage']??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                        </td>
                        <td></td>
                        <td>
                            <input  class="form-control only-numbers"  type="text" name="super_price_price_final" id="flat_super_price_price_final" value="{{$roofEstimateCalculator->roofEstimateCalculatorFlatRoof->super_price_price_final??'0'}}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Sales(%)</td>
                        <td>
                            <input  class="form-control only-numbers"  type="text" name="sales_percentage" id="flat_sales_percentage" value="{{$roofEstimateCalculator->roofEstimateCalculatorFlatRoof->sales_percentage??$roofDataFlat['sales_percentage']??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                        </td>
                        <td></td>
                        <td>
                            <input  class="form-control only-numbers"  type="text" name="sales_price_price_final" id="flat_sales_price_price_final" value="{{$roofEstimateCalculator->roofEstimateCalculatorFlatRoof->sales_price_price_final??'0'}}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td class="highlight-yellow">Direct Cost</td>
                        <td></td>
                        <td></td>
                        <td class="highlight-yellow">
                            <input  class="form-control only-numbers"  type="text" name="directory_cost" id="flat_directory_cost" value="{{$roofEstimateCalculator->roofEstimateCalculatorFlatRoof->directory_cost??'0'}}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Net Profit</td>
                        <td></td>
                        <td></td>
                        <td>
                            <input  class="form-control only-numbers"  type="text" name="net_profit" id="flat_net_profit" value="{{$roofEstimateCalculator->roofEstimateCalculatorFlatRoof->net_profit??'0'}}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Margin %</td>
                        <td></td>
                        <td></td>
                        <td>
                            <input  class="form-control only-numbers"  type="text" name="margin_percentage" id="flat_margin_percentage" value="{{$roofEstimateCalculator->roofEstimateCalculatorFlatRoof->margin_percentage??'0'}}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Net Profit %</td>
                        <td></td>
                        <td></td>
                        <td>
                            <input  class="form-control only-numbers"  type="text" name="net_profit_percentage" id="flat_net_profit_percentage" value="{{$roofEstimateCalculator->roofEstimateCalculatorFlatRoof->net_profit_percentage??'0'}}" readonly>
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
            $roofDataFlat = json_decode($roofBaseValuesFlat->roof_flat_roof, true);
//            dd($roofDataFlat);
        @endphp

        var sq = $('#flat_total_sq_c7').val();
        var layer = {{ $additional_layer }};
        var totalLayer = sq * layer;
        // if(totalLayer == '0'){
        //     totalLayer = layer;
        // }
        $('#flat_additional_layer').val(totalLayer);
        var stepCharge = {{ $stepCharge }};
        var totalStepCharge = sq * stepCharge;
        // if(totalStepCharge == '0'){
        //     totalStepCharge = stepCharge;
        // }
        $('#flat_step_charge').val(totalStepCharge);
        // calculationSkylight();
        // calculationAboutMaterial();
        // calculationAboutLabour();
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
        calculationAboutProjectCost();
        calculationAboutMarginProfit();
        calculationAboutSuper();
        calculationAboutSales();
        calculationAboutNetProfit();
        calculationAboutSkylight();
        calculationAboutDirectoryCost();
        calculationAboutmarginProfit();
        calculationAboutNetProfitPercentage();

        $(document).on('input', '#flat_materials_price_price_per_sq_d_15,#flat_skylight_price_price_per_sq_d_13, #flat_plywood_price_per_sq_d_12, #flat_siding_azeck_price_per_sq_d_11,  #flat_chimney_size_price_per_sq_d_10', function () {
            calculationAboutMaterial();
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
            // calculationAboutNetProfitPercentage()
            // calculationAboutRoofingPrice()
        });

        function calculationAboutMaterial() {
            var totalsq = parseFloat($('#flat_total_sq_c7').val()) || 0;
            var materials = parseFloat($('#flat_materials_price_price_per_sq_d_15').val()) || 0;
            var chimney_size = parseFloat($('#flat_chimney_size_price_per_sq_d_10').val()) || 0;
            var plywood_price = parseFloat($('#flat_plywood_price_per_sq_d_12').val()) || 0;
            var siding_azeck = parseFloat($('#flat_siding_azeck_price_per_sq_d_11').val()) || 0;
            var skylightPrice = parseFloat($('#flat_skylight_price_price_per_sq_d_13').val()) || 0;
            var multiply = totalsq * materials + chimney_size + plywood_price + siding_azeck + skylightPrice;
            $('#flat_materials_price_price_final').val(multiply.toFixed(2));
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
        $(document).on('input', '#flat_labour_price_price_per_sq_d_16, #flat_plywood_price_per_sq_d_12,#flat_chimney_size_price_per_sq_d_10, #flat_step_charge_price_per_sq_d_9, #flat_siding_azeck_price_per_sq_d_11, #flat_additional_layer_price_per_sq_d_8', function () {
            // calculationAboutLabour();
            // calculationAboutProjectCost()
            // calculationAboutMarginProfit();
            // calculationAboutSuper();
            // calculationAboutSales();
            // calculationAboutmarginProfit();
            // calculationAboutDirectoryCost();
            // calculationAboutNetProfit();
            // calculationAboutNetProfitPercentage()
            // calculationAboutRoofingPrice()
            // calculationAboutSkylight()
            // calculationAboutMaterial()

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
            var totalsq = parseFloat($('#flat_total_sq_c7').val()) || 0;
            var labour = parseFloat($('#flat_labour_price_price_per_sq_d_16').val()) || 0;
            var additional_layer = parseFloat($('#flat_additional_layer_price_per_sq_d_8').val()) || 0;
            var step_charge = parseFloat($('#flat_step_charge_price_per_sq_d_9').val()) || 0;
            var chimney_size = parseFloat($('#flat_chimney_size_price_per_sq_d_10').val()) || 0;
            var siding_azeck = parseFloat($('#flat_siding_azeck_price_per_sq_d_11').val()) || 0;
            var plywood_price = parseFloat($('#flat_plywood_price_per_sq_d_12').val()) || 0;
            var skylight = parseFloat($('#flat_total_labour_skylight').val()) || 0;
            var multiply = totalsq * labour + additional_layer + step_charge + chimney_size + siding_azeck + plywood_price + skylight;
            $('#flat_labour_price_price_final').val(multiply.toFixed(2));
        }
        // calculationAboutLabour();
        $(document).on('input', '#flat_dumpster_price_price_per_sq_d_17, #flat_materials_price_price_final', function () {
            // calculationAboutDumpster();
            // calculationAboutProjectCost()
            // calculationAboutMarginProfit();
            // calculationAboutSuper();
            // calculationAboutSales();
            // calculationAboutmarginProfit();
            // calculationAboutDirectoryCost();
            // calculationAboutNetProfit();
            // calculationAboutNetProfitPercentage()
            // calculationAboutRoofingPrice()
            // calculationAboutSkylight()
            // calculationAboutMaterial()

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
            var materials_price = parseFloat($('#flat_materials_price_price_final').val()) || 0;
            var dumpster_percentage = parseFloat($('#flat_dumpster_price_price_per_sq_d_17').val()) || 0;
            var multiply = materials_price * (dumpster_percentage / 100);
            $('#flat_dumster_price_price_final').val(multiply.toFixed(2));
        }
        // calculationAboutDumpster();

        $(document).on('input', '#flat_permit_warranty_price_price_per_sq_d_18, #flat_materials_price_price_final', function () {
            // calculationAboutPermit();
            // calculationAboutProjectCost()
            // calculationAboutMarginProfit();
            // calculationAboutSuper();
            // calculationAboutSales();
            // calculationAboutDirectoryCost();
            // calculationAboutNetProfit();
            // calculationAboutmarginProfit();
            // calculationAboutNetProfitPercentage()
            // calculationAboutRoofingPrice()
            // calculationAboutSkylight()
            // calculationAboutMaterial()

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
        function calculationAboutPermit() {
            var materials_price = parseFloat($('#flat_materials_price_price_final').val()) || 0;
            var permit_warranty_price = parseFloat($('#flat_permit_warranty_price_price_per_sq_d_18').val()) || 0;
            var multiply = materials_price * (permit_warranty_price / 100);
            $('#flat_permit_warranty_price_price_final').val(multiply.toFixed(2));
        }
        // calculationAboutPermit();
            $(document).on('input', '#flat_miscellaneous', function () {
                // calculationAboutMaterial();
                // calculationAboutDumpster();
                // calculationAboutPermit();
                // calculationAboutProjectCost();
                // calculationAboutMarginProfit();
                // calculationAboutSuper();
                // calculationAboutSales();
                // calculationAboutNetProfit();
                // calculationAboutSkylight();
                // calculationAboutDirectoryCost();
                // calculationAboutmarginProfit();
                // calculationAboutNetProfitPercentage();
                // calculationAboutRoofingPrice();

                calculationAboutProjectCost();
                calculationAboutMarginProfit();
                calculationAboutSuper();
                calculationAboutSales();
                calculationAboutDirectoryCost();
                calculationAboutNetProfit();
                calculationAboutSkylight();
            });
        function calculationAboutProjectCost() {
            var materials_price_price_final = parseFloat($('#flat_materials_price_price_final').val()) || 0;
            var labour_price_price_final = parseFloat($('#flat_labour_price_price_final').val()) || 0;
            var dumster_price_price_final = parseFloat($('#flat_dumster_price_price_final').val()) || 0;
            var permit_warranty_price_price_final = parseFloat($('#flat_permit_warranty_price_price_final').val()) || 0;
                var flat_miscellaneous = parseFloat($('#flat_miscellaneous').val()) || 0;
                var addition = materials_price_price_final + labour_price_price_final+ permit_warranty_price_price_final + dumster_price_price_final + flat_miscellaneous;
            $('#flat_project_cost_price_price_final').val(addition.toFixed(2));
        }
        // calculationAboutProjectCost();

        function calculationAboutMarginProfit() {
            var project_cost_price_price_final = parseFloat($('#flat_project_cost_price_price_final').val()) || 0;
            var percentage = (project_cost_price_price_final / ({{$roofDataFlat['margin_profit']??1}} / 100)); // Divide by 0.75 to get 100%
            $('#flat_margin_profit_price_price_final').val(percentage.toFixed(2));
        }


        // calculationAboutMarginProfit();

        $(document).on('input', '#flat_super_percentage', function () {
            // calculationAboutSuper();
            // calculationAboutSales();
            // calculationAboutDirectoryCost();
            // calculationAboutNetProfit();
            // calculationAboutmarginProfit();
            // calculationAboutNetProfitPercentage()
            // calculationAboutRoofingPrice()
            // calculationAboutMaterial()

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
        function calculationAboutSuper() {
            var margin_profit_price_price_final = parseFloat($('#flat_margin_profit_price_price_final').val()) || 0;
            var super_percentage = parseFloat($('#flat_super_percentage').val()) || 0;
            var super_percentage_final = margin_profit_price_price_final * (super_percentage / 100); // Convert percentage to decimal
            $('#flat_super_price_price_final').val(super_percentage_final.toFixed(2));
        }

        // calculationAboutSuper();

        $(document).on('input', '#flat_sales_percentage', function () {
            calculationAboutSales();
            calculationAboutDirectoryCost();
            calculationAboutNetProfit();
            calculationAboutmarginProfit();
            calculationAboutNetProfitPercentage()
            calculationAboutRoofingPrice()
            calculationAboutSkylight()
            calculationAboutMaterial()

        });
        function calculationAboutSales() {
            var margin_profit_price_price_final = parseFloat($('#flat_margin_profit_price_price_final').val()) || 0;
            var sales_percentage = parseFloat($('#flat_sales_percentage').val()) || 0;
            var sales_percentage_final = margin_profit_price_price_final * (sales_percentage / 100);
            $('#flat_sales_price_price_final').val(sales_percentage_final.toFixed(2));
        }
        // calculationAboutSales()


        function calculationAboutDirectoryCost() {
            var sales_price_price_final = parseFloat($('#flat_sales_price_price_final').val()) || 0;
            var super_price_price_final = parseFloat($('#flat_super_price_price_final').val()) || 0;
            var directory_cost = sales_price_price_final + super_price_price_final;
            $('#flat_directory_cost').val(directory_cost.toFixed(2));
        }
        // calculationAboutDirectoryCost();

        function calculationAboutNetProfit() {
            var project_cost_price_price_final = parseFloat($('#flat_project_cost_price_price_final').val()) || 0;
            var margin_profit_price_price_final = parseFloat($('#flat_margin_profit_price_price_final').val()) || 0;
            var directory_cost = parseFloat($('#flat_directory_cost').val()) || 0;
            var netprofit = margin_profit_price_price_final - project_cost_price_price_final - directory_cost;
            $('#flat_net_profit').val(netprofit.toFixed(2));
        }
        // calculationAboutNetProfit();

        $(document).on('input', '#flat_skylight_price', function () {
            // calculationAboutSkylight()
            // calculationAboutmarginProfit()
            // calculationAboutNetProfitPercentage()
            // calculationAboutRoofingPrice()
            // calculationAboutMaterial()

            calculationAboutSkylight()
            calculationAboutmarginProfit()
            calculationAboutNetProfitPercentage()
            calculationAboutRoofingPrice()
            calculationAboutMaterial()
            calculationAboutLabour()

        });
        function calculationAboutSkylight(){
            var skylight_price = parseFloat($('#flat_skylight_price').val()) || 0;
            var margin_profit_price_price_final = parseFloat($('#flat_margin_profit_price_price_final').val()) || 0;
            var totalRecommendedPrice = skylight_price + margin_profit_price_price_final;
            $('#flat_recommended_price').val(totalRecommendedPrice.toFixed(2));
            $('#flat_recommended_price_global').text(totalRecommendedPrice.toFixed(2));
        }//ends
        // calculationAboutSkylight()

        function calculationAboutmarginProfit(){
            var recommended_price = parseFloat($('#flat_recommended_price').val()) || 0;
            var project_cost_price_price_final = parseFloat($('#flat_project_cost_price_price_final').val()) || 0;
            var totalmargin = ((recommended_price - project_cost_price_price_final) / recommended_price) * 100;
            $('#flat_margin_percentage').val(totalmargin.toFixed(2));
        }//ends
        // calculationAboutmarginProfit()

        function calculationAboutNetProfitPercentage(){
            var recommended_price = parseFloat($('#flat_recommended_price').val()) || 0;
            var net_profit = parseFloat($('#flat_net_profit').val()) || 0;
            var total_net_profit = (net_profit / recommended_price) * 100;
            $('#flat_net_profit_percentage').val(total_net_profit.toFixed(2));
        }//ends
        // calculationAboutNetProfitPercentage()

        function calculationAboutRoofingPrice(){
            var margin_profit_price_price_final = parseFloat($('#flat_margin_profit_price_price_final').val()) || 0;
            var totalsq = parseFloat($('#flat_total_sq_c7').val()) || 0;
            var totalRoofingPrice = margin_profit_price_price_final/ totalsq;
            $('#flat_roofing_price').val(totalRoofingPrice.toFixed(2));
        }//ends
        // calculationAboutRoofingPrice()
        $(document).on('input', '#flat_plywood', function () {
            // calculationAboutplywood()
            // calculationAboutSkylight()
            // calculationAboutMaterial()

            calculationAboutplywood()
            calculationAboutSkylight()
            calculationAboutMaterial()
            calculationAboutLabour()
        });
        function calculationAboutplywood(){
            var plywood = parseFloat($('#flat_plywood').val()) || 0;
            var total = plywood * {{$roofDataFlat['plywood']??0}};
            $('#flat_plywood_price_per_sq_d_12').val(total.toFixed(2));
        }//ends
        // calculationAboutplywood()
        $(document).on('input', '#flat_additional_layer', function () {
            // calculationAboutadditionalLayer()
            // calculationAboutSkylight()
            // calculationAboutMaterial()

            calculationAboutadditionalLayer()
            calculationAboutSkylight()
            calculationAboutMaterial()
            calculationAboutLabour()
        });
        function calculationAboutadditionalLayer(){
            var additional_layer = parseFloat($('#flat_additional_layer').val()) || 0;
            var total = parseFloat(additional_layer) * parseFloat({{$roofDataFlat['additional_layer']??0}});
            // console.log('dev...', total);
            $('#flat_additional_layer_price_per_sq_d_8').val(total.toFixed(2));
        }//ends
        // calculationAboutadditionalLayer()

        $(document).on('input', '#flat_step_charge', function () {
            // calculationAboutstep_charge()
            // calculationAboutSkylight()
            // calculationAboutMaterial()

            calculationAboutstep_charge()
            calculationAboutSkylight()
            calculationAboutMaterial()
            calculationAboutLabour()
        });
        function calculationAboutstep_charge(){
            var step_charge = parseFloat($('#flat_step_charge').val()) || 0;
            var total = step_charge * {{$roofDataFlat['step_charge']??0}};
            $('#flat_step_charge_price_per_sq_d_9').val(total.toFixed(2));
        }//ends
        // calculationAboutstep_charge()
        $(document).on('input', '#flat_chimney_size', function () {
            // calculationAboutchimney_size()
            // calculationAboutSkylight()
            // calculationAboutMaterial()

            calculationAboutchimney_size()
            calculationAboutSkylight()
            calculationAboutMaterial()
            calculationAboutLabour()
        });
        function calculationAboutchimney_size(){
            var chimney_size = parseFloat($('#flat_chimney_size').val()) || 0;
            var total = chimney_size * {{$roofDataFlat['chimney_size']??0}};
            $('#flat_chimney_size_price_per_sq_d_10').val(total.toFixed(2));
        }//ends
        function calculationSkylight() {
            var skylight = parseFloat($('#under_skylight_labour').val()) || 0;
            var baseSkylight = {{$roofDataFlat['skylight']??0}};
            var totalSkylight = (skylight  * baseSkylight);
            $('#flat_total_labour_skylight').val(totalSkylight.toFixed(2));
        }
        // calculationAboutchimney_size()
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

    $(document).ready(function (){
        storeData();
        $(document).on('keyup', '.form-control', function() {
            storeData();
        });
        function storeData(){
            var formData = $('#store_roof_estimate_calculator_flat_roof').serialize();
            $.ajax({
                url: '{{ route("store_roof_estimate_calculator_flat_roof") }}',
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
