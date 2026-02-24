{{--@extends('layouts.master')--}}
{{--@push('css')--}}
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">--}}
{{--    <style>--}}
{{--        .table th, .table td {--}}
{{--            text-align: center;--}}
{{--        }--}}
{{--        .bg-recommend, .bg-project, .bg-total, .bg-net-profit {--}}
{{--            background-color: #f8f9fa;--}}
{{--        }--}}
{{--        .bg-recommend { background-color: #f0e68c; }--}}
{{--        .bg-project { background-color: #faebd7; }--}}
{{--        .bg-total { background-color: #add8e6; }--}}
{{--        .bg-net-profit { background-color: #98fb98; }--}}
{{--    </style>--}}
{{--@endpush--}}
{{--@section('content')--}}
    <div class="white-box">
    <div class="container-fluid">
        <form action="" class="row" method="post" id="store_roof_estimate_calculator_over_existing">
            @csrf
            <input type="hidden" name="side_estimate_calculator_id" value="{{$sidingEstimateCalculator->id??''}}">
{{--                @if(isset($lead->sidingEstimateCalculator) && $lead->sidingEstimateCalculator)--}}
{{--                    <div class="col-md-12">--}}
{{--                        <div class="table_top_btn">--}}
{{--                            <a href="{{url('siding_estimation_calculator/' . $lead->sidingEstimateCalculator->lead_id) }}" class="btn btn_green">Measurement </a>--}}
{{--                            <a href="{{url('siding_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->sidingEstimateCalculator->id}}/over_existing" class="btn btn_green">Over Existing ({{ $lead->sidingEstimateCalculator->storeSidingOverExisting->recommended_price??"0" }})</a>--}}
{{--                            <a href="{{url('siding_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->sidingEstimateCalculator->id}}/gutters" class="btn btn_green">Gutter ({{ $lead->sidingEstimateCalculator->storeSidingEstimateCalculatorGutter->recommended_price??"0" }}) ({{ $lead->sidingEstimateCalculator->storeSidingEstimateCalculatorGutter->recommended_price_two??"0" }})</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}
                <div class="col-md-12">
                    <h3>Side Estimation Calculator (Repalcement)</h3>
                </div>
            <div class="col-md-6">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th colspan="3">Recommended Price</th>
                        <th colspan="2" class="text-right"><input class="form-control" type="text" name="recommended_price" id="replacement_recommended_price" value="{{ $sidingEstimateCalculator->sideEstimateCalculatorReplacement->recommended_price??'0' }}" readonly></th>
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
                        <td><input class="form-control" type="text" name="price_per_sq_value" id="replacement_price_per_sq_value" value="{{ $sidingEstimateCalculator->sideEstimateCalculatorReplacement->price_per_sq_value??'0' }}" readonly ></td>

                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td>SQ</td>

                        <td><input class="form-control" type="text" name="siding_sq_value" id="replacement_siding_sq_value" value="{{ $sidingReplacementSq??"0.00" }}" readonly></td>
                        <td>Price Per SQ</td>

                    </tr>
                    <tr>
                        <td>Soffit</td>

                        <td><input class="form-control" type="text" name="siding_soffit_value" id="replacement_siding_soffit_value" value="{{ $sidingReplacementSoffitTotalSum??"0.00" }}" readonly></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td>Additional layer</td>

                        <td><input class="form-control" type="text" name="additional_layer_value" id="replacement_additional_layer_value" value="{{ $sidingReplacementAdditionalLayers??"0.00" }}" readonly></td>
                        <td><input class="form-control" type="text" name="additional_layer_per_sq_value" id="replacement_additional_layer_per_sq_value" value="{{ $sidingEstimateCalculator->sideEstimateCalculatorReplacement->additional_layer_per_sq_value??'0' }}" readonly></td>

                    </tr>
                    <tr>
                        <td>Windows / Doors</td>

                        <td><input class="form-control" type="text" name="window_door_value" id="replacement_window_door_value" readonly value="{{ $replacementWindowsDoors }}"></td>
                        <td><input class="form-control" type="text" name="window_door_per_sq_value" id="replacement_window_door_per_sq_value" value="{{ $sidingEstimateCalculator->sideEstimateCalculatorReplacement->window_door_per_sq_value??'0' }}" readonly></td>


                    </tr>
                    <tr>
                        <td>Aluminium Trim</td>
                        <td><input class="form-control" type="text" name="aluminium_trim_value" id="replacement_aluminium_trim_value"value="{{ $aluminum}}"  readonly></td>
                        <td><input class="form-control" type="text" name="aluminium_trim_per_sq_value" id="replacement_aluminium_trim_per_sq_value" value="{{ $sidingEstimateCalculator->sideEstimateCalculatorReplacement->aluminium_trim_per_sq_value??'0' }}" readonly></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td>Azeck / Wood (1/2)</td>
                        <td><input class="form-control" type="text" name="azeck_wood_value" id="replacement_azeck_wood_value" value="{{($sidingEstimateCalculator->soffit_eave + $sidingEstimateCalculator->soffit_rakes)}}" readonly></td>
                        <td><input class="form-control" type="text" name="azeck_wood_per_sq_value" id="replacement_azeck_wood_per_sq_value" value="" readonly></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td>Shatters</td>
                        <td><input class="form-control" type="text" name="shutter_value" id="replacement_shutter_value" value="{{ $sidingReplacementShatters??"0.00" }}" readonly></td>
                        <td><input class="form-control" type="text" name="shutter_per_sq_value" id="replacement_shutter_per_sq_value" value="{{ $sidingEstimateCalculator->sideEstimateCalculatorReplacement->shutter_per_sq_value??'0' }}" readonly></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Plywood</td>
                        <td><input class="form-control" type="text" name="plywood_value" id="replacement_plywood_value" value="{{ $sidingReplacementPlywood??"0.00" }}" readonly></td>
                        <td><input class="form-control" type="text" name="plywood_per_sq_value" id="replacement_plywood_per_sq_value" value="{{ $sidingEstimateCalculator->sideEstimateCalculatorReplacement->plywood_per_sq_value??'0' }}" readonly></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td>Miscellaneous</td>
                        <td></td>
                        <td><input class="form-control" type="number" name="miscellaneous" id="replacement_miscellaneous" min="0" value="{{ $sidingEstimateCalculator->sideEstimateCalculatorReplacement->miscellaneous??'0' }}" placeholder="Type here value" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif oninput="this.value = Math.abs(this.value)"></td>
                        <td></td>
                    </tr>
                    <tr class="bg-project">
                        <td colspan="3">PROJECT COST</td>
                        <td colspan="2"><input class="form-control" type="text" name="project_cost" id="replacement_project_cost" value="{{ $sidingEstimateCalculator->sideEstimateCalculatorReplacement->project_cost??'0' }}" readonly></td>
                    </tr>
                    <tr>
                        <td>Materials</td>
                        <td></td>
                        <td><input class="form-control" type="number" name="material_value" id="replacement_material_value" min="0" value="{{ $sidingEstimateCalculator->sideEstimateCalculatorReplacement->material_value??$sideDataReplacement['material_value']??'0' }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif oninput="this.value = Math.abs(this.value)"></td>

                        <td><input class="form-control" type="text" name="total_material_value" id="replacement_total_material_value" value="{{ $sidingEstimateCalculator->sideEstimateCalculatorReplacement->total_material_value??'0' }}" readonly></td>
                    </tr>
                    <tr>
                        <td>Labor</td>
                        <td></td>
                        <td><input class="form-control" type="number" name="labor_value" id="replacement_labor_value" min="0" value="{{ $sidingEstimateCalculator->sideEstimateCalculatorReplacement->labor_value??$sideDataReplacement['labor_value']??'0' }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif oninput="this.value = Math.abs(this.value)"></td>

                        <td><input class="form-control" type="text" name="total_labor_value" id="replacement_total_labor_value" value="{{ $sidingEstimateCalculator->sideEstimateCalculatorReplacement->total_labor_value??'0' }}" readonly></td>
                    </tr>
                    <tr>
                        <td>Dumpster%</td>
                        <td></td>
                        <td><input class="form-control" type="number" name="dumpster_value" id="replacement_dumpster_value" min="0" value="{{ $sidingEstimateCalculator->sideEstimateCalculatorReplacement->dumpster_value??$sideDataReplacement['dumpster_value']??'0' }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif oninput="this.value = Math.abs(this.value)"></td>
                        <td><input class="form-control" type="text" name="total_dumpster_value" id="replacement_total_dumpster_value" value="{{ $sidingEstimateCalculator->sideEstimateCalculatorReplacement->total_dumpster_value??'0' }}" readonly></td>

                    </tr>
                    <tr>
                        <td>Permit / Warranty%</td>
                        <td></td>
                        <td><input class="form-control" type="number" name="permit_warranty_value" id="replacement_permit_warranty_value" min="0" value="{{ $sidingEstimateCalculator->sideEstimateCalculatorReplacement->permit_warranty_value??$sideDataReplacement['permit_warranty_value']??'0' }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif oninput="this.value = Math.abs(this.value)"></td>
                        <td><input class="form-control" type="text" name="total_permit_warranty_value" id="replacement_total_permit_warranty_value" value="{{ $sidingEstimateCalculator->sideEstimateCalculatorReplacement->total_permit_warranty_value??'0' }}" readonly></td>
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
                        <td><input class="form-control" type="text" name="margin_profit_value" id="replacement_margin_profit_value" value="{{ $sidingEstimateCalculator->sideEstimateCalculatorReplacement->margin_profit_value??'0' }}" readonly></td>
                    </tr>
                    <tr>
                        <td>Super%</td>
                        <td><input class="form-control" type="number" name="super_value" id="replacement_super_value" min="0" value="{{ $sidingEstimateCalculator->sideEstimateCalculatorReplacement->super_value??$sideDataReplacement['super_value']??'0' }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif oninput="this.value = Math.abs(this.value)"></td>
                        <td></td>
                        <td><input class="form-control" type="text" name="total_super_value" id="replacement_total_super_value" value="{{ $sidingEstimateCalculator->sideEstimateCalculatorReplacement->total_super_value??'0' }}" readonly></td>
                    </tr>
                    <tr>
                        <td>Sales%</td>
                        <td><input class="form-control" type="number" name="sales_value" id="replacement_sales_value" min="0" value="{{ $sidingEstimateCalculator->sideEstimateCalculatorReplacement->sales_value??$sideDataReplacement['sales_value']??'0' }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif oninput="this.value = Math.abs(this.value)"></td>

                        <td></td>
                        <td><input class="form-control" type="text" name="total_sales_value" id="replacement_total_sales_value" value="{{ $sidingEstimateCalculator->sideEstimateCalculatorReplacement->total_sales_value??'0' }}" readonly></td>
                    </tr>
                    <tr>
                        <td>Direct Cost</td>

                        <td></td>
                        <td></td>
                        <td><input class="form-control" type="text" name="direct_cost_value" id="replacement_direct_cost_value" value="{{ $sidingEstimateCalculator->sideEstimateCalculatorReplacement->direct_cost_value??'0' }}" readonly></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="bg-net-profit">
                        <td colspan="3">Net Profit</td>
                        <td colspan="2"><input class="form-control" type="text" name="net_profit" id="replacement_net_profit" value="{{ $sidingEstimateCalculator->sideEstimateCalculatorReplacement->net_profit??'0' }}" readonly></td>
                    </tr>
                    <tr>
                        <td>%</td>
                        <td></td>
                        <td><input class="form-control" type="text" name="sub_total_value" id="replacement_sub_total_value" value="{{ $sidingEstimateCalculator->sideEstimateCalculatorReplacement->sub_total_value??'0' }}" readonly></td>
                        <td><input class="form-control" type="text" name="total_sub_total_value" id="replacement_total_sub_total_value" value="{{ $sidingEstimateCalculator->sideEstimateCalculatorReplacement->total_sub_total_value??'0' }}" readonly></td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </form>
    </div>
    </div>

{{--@endsection--}}

{{--<@push('js')--}}
     <script>
         @php
             $sidingData = json_decode($sidingBaseValuesReplacement->siding_replacement, true);
         @endphp
         $(document).ready(function() {
             function calculateRecommendedPrice() {
                 var netVal = parseFloat($('#replacement_margin_profit_value').val()) || 0;
                 $('#replacement_recommended_price').val(netVal.toFixed(2));
                 $('#replacement_recommended_price_global').text(netVal.toFixed(2));
             }

             // function calculatePricePerSq() {
             //     var recommedPriceVal = parseFloat($('#replacement_recommended_price').val()) || 0;
             //     var squareValue = parseFloat($('#replacement_siding_sq_value').val()) || 0;
             //     var totalPricePerSq = recommedPriceVal / squareValue;
             //     $('#replacement_price_per_sq_value').val(totalPricePerSq.toFixed(2));
             // }
             function calculatePricePerSq() {
                 var recommedPriceVal = parseFloat($('#replacement_recommended_price').val()) || 0;
                 var squareValue = parseFloat($('#replacement_siding_sq_value').val()) || 0;
                 var totalPricePerSq = 0;
                 if (squareValue !== 0) {
                     totalPricePerSq = recommedPriceVal / squareValue;
                 }
                 $('#replacement_price_per_sq_value').val(totalPricePerSq.toFixed(2));
             }

             function calculateAddionalLayerValue() {
                 var addionalLayerVal = parseFloat($('#replacement_additional_layer_value').val()) || 0;
                 var layerTotalVal = addionalLayerVal * {{$sidingData['additional_layer']??0}};
                 $('#replacement_additional_layer_per_sq_value').val(layerTotalVal.toFixed(2));
             }

             function calculateWindowsValue() {
                 var windowsVal = parseFloat($('#replacement_window_door_value').val()) || 0;
                 var windowsTotalVal = windowsVal * {{$sidingData['window']??0}};
                 $('#replacement_window_door_per_sq_value').val(windowsTotalVal.toFixed(2));
             }

             function calculateShattersValue() {
                 var shatterVal = parseFloat($('#replacement_shutter_value').val()) || 0;
                 var shatterTotalVal = shatterVal * {{$sidingData['shatters']??0}};
                 $('#replacement_shutter_per_sq_value').val(shatterTotalVal.toFixed(2));
             }

             function calculatePlywoodValue() {
                 var plywoodVal = parseFloat($('#replacement_plywood_value').val()) || 0;
                 var windowsTotalVal = plywoodVal * {{$sidingData['plywood']??0}};
                 $('#replacement_plywood_per_sq_value').val(windowsTotalVal.toFixed(2));
             }
             function calculateAluminumValue() {
                 var aluminumVal = parseFloat($('#replacement_aluminium_trim_value').val()) || 0;
                 var aluminumTotalVal = aluminumVal * {{$sidingData['aluminium_trim']??0}};
                 $('#replacement_aluminium_trim_per_sq_value').val(aluminumTotalVal.toFixed(2));
             }
             function calculateAzeckValue() {
                 var azeckVal = parseFloat($('#replacement_azeck_wood_value').val()) || 0;
                 var selectedOption = $('select[name="labels[azeck_wood][value]"] option:selected').text().trim();
                 var multiplier = 0;

                 // Determine multiplier based on selected option
                 if (selectedOption === 'Azeck') {
                     multiplier = {{ $sidingData['azeck'] ?? 0 }};
                 } else if (selectedOption === 'Wood') {
                     multiplier = {{ $sidingData['wood'] ?? 0 }};
                 }

                 var azeckTotalVal = azeckVal * multiplier;
                 $('#replacement_azeck_wood_per_sq_value').val(azeckTotalVal.toFixed(2));
             }
             function calculateTotalMaterialValue() {
                 var sidingSqValue = parseFloat($('#replacement_siding_sq_value').val()) || 0;
                 var sidingSoffitValue = parseFloat($('#replacement_siding_soffit_value').val()) || 0;
                 var azeckWoodPerSqValue = parseFloat($('#replacement_azeck_wood_per_sq_value').val()) || 0;
                 var shutterPerSqValue = parseFloat($('#replacement_shutter_per_sq_value').val()) || 0;
                 var plywoodPerSqValue = parseFloat($('#replacement_plywood_per_sq_value').val()) || 0;
                 var materialValue = parseFloat($('#replacement_material_value').val()) || 0;
                 var firstVal = (sidingSqValue + sidingSoffitValue)* materialValue;
                 var seconfVal = azeckWoodPerSqValue + shutterPerSqValue + plywoodPerSqValue;
                 var replacement_miscellaneous = parseFloat($('#replacement_miscellaneous').val()) || 0;
                 var totalMaterialValue = firstVal + seconfVal + replacement_miscellaneous;
                 $('#replacement_total_material_value').val(totalMaterialValue.toFixed(2));
             }

             function calculateTotalLaborValue() {
                 var sidingSqValue = parseFloat($('#replacement_siding_sq_value').val()) || 0;
                 var sidingSoffitValue = parseFloat($('#replacement_siding_soffit_value').val()) || 0;
                 var azeckWoodPerSqValue = parseFloat($('#replacement_azeck_wood_per_sq_value').val()) || 0;
                 var shutterPerSqValue = parseFloat($('#replacement_shutter_per_sq_value').val()) || 0;
                 var plywoodPerSqValue = parseFloat($('#replacement_plywood_per_sq_value').val()) || 0;
                 var additionalLayerPerSqValue = parseFloat($('#replacement_additional_layer_per_sq_value').val()) || 0;
                 var windowDoorPerSqValue = parseFloat($('#replacement_window_door_per_sq_value').val()) || 0;
                 var aluminiumTrimPerSqValue = parseFloat($('#replacement_aluminium_trim_per_sq_value').val()) || 0;
                 var laborValue = parseFloat($('#replacement_labor_value').val()) || 0;
                 var replacement_miscellaneous = parseFloat($('#replacement_miscellaneous').val()) || 0;

                 var totalSum1 = (sidingSqValue + sidingSoffitValue) * laborValue ;
                 var totalSum2 = azeckWoodPerSqValue + shutterPerSqValue + plywoodPerSqValue + additionalLayerPerSqValue + windowDoorPerSqValue + aluminiumTrimPerSqValue + replacement_miscellaneous;
                 var totalValSum = totalSum1 + totalSum2;
                 $('#replacement_total_labor_value').val(totalValSum.toFixed(2));
             }

             function calculateTotalDumpsterValue() {
                 var totalMaterialValue = parseFloat($('#replacement_total_material_value').val()) || 0;
                 var dumpsterValue = parseFloat($('#replacement_dumpster_value').val()) || 0;
                 var additionalLayerPerSqValue = parseFloat($('#replacement_additional_layer_per_sq_value').val()) || 0;

                 var total1 = (totalMaterialValue * (dumpsterValue / 100));
                 var totoal2 = total1 + additionalLayerPerSqValue;
                 $('#replacement_total_dumpster_value').val(totoal2.toFixed(2));
             }

             function calculateTotalPermitWarrantyValue() {
                 var totalMaterialValue = parseFloat($('#replacement_total_material_value').val()) || 0;
                 var permitWarrantyValue = parseFloat($('#replacement_permit_warranty_value').val()) || 0;
                 var totalPermitWarrantyValue = (totalMaterialValue * permitWarrantyValue) / 100;

                 $('#replacement_total_permit_warranty_value').val(totalPermitWarrantyValue.toFixed(2));
             }

             function updateProjectCost() {
                 var materialValue = parseFloat($('#replacement_total_material_value').val()) || 0;
                 var laborValue = parseFloat($('#replacement_total_labor_value').val()) || 0;
                 var dumpsterValue = parseFloat($('#replacement_total_dumpster_value').val()) || 0;
                 var permitWarrantyValue = parseFloat($('#replacement_total_permit_warranty_value').val()) || 0;
                 // var replacement_miscellaneous = parseFloat($('#replacement_miscellaneous').val()) || 0;
                 var total = materialValue + laborValue + dumpsterValue + permitWarrantyValue;
                 $('#replacement_project_cost').val(total.toFixed(2));
             }

             function calculateMarginProfitValue() {
                 var projectCost = parseFloat($('#replacement_project_cost').val());
                 if (!isNaN(projectCost)) {
                     {{--var marginProfitValue = projectCost / ({{$sidingData['additional_layer'] ??1 }} / 100);--}}
                     var marginProfitValue = projectCost / ({{$sidingData['margin_profit'] ??1 }} / 100);
                     $('#replacement_margin_profit_value').val(marginProfitValue.toFixed(2));
                 }
             }

             function calculateSuperValue() {
                 var marginValue = parseFloat($('#replacement_margin_profit_value').val()) || 0;
                 var superValue = parseFloat($('#replacement_super_value').val()) || 0;
                 var sideMargin = {{ $sidingData['additional_layer']??1 }};
                 console.log(sideMargin);
                 var superValueTotal = marginValue * superValue / 100;
                 $('#replacement_total_super_value').val(superValueTotal.toFixed(2));
             }

             function calculateSalesValue() {
                 var marginVal = parseFloat($('#replacement_margin_profit_value').val()) || 0;
                 var salesValue = parseFloat($('#replacement_sales_value').val()) || 0;
                 var salesValueTotal = marginVal * salesValue / 100;
                 $('#replacement_total_sales_value').val(salesValueTotal.toFixed(2));
             }

             function sumSalesSuperValue() {
                 var salesVal = parseFloat($('#replacement_total_super_value').val()) || 0;
                 var superVal = parseFloat($('#replacement_total_sales_value').val()) || 0;
                 var totalSum = salesVal + superVal;
                 $('#replacement_direct_cost_value').val(totalSum.toFixed(2));
             }

             function calculateNetProfitValue() {
                 var projectCostVal = parseFloat($('#replacement_project_cost').val()) || 0;
                 var marginProfitVal = parseFloat($('#replacement_margin_profit_value').val()) || 0;
                 var directCostVal = parseFloat($('#replacement_direct_cost_value').val()) || 0;
                 var totalNetProfit = marginProfitVal - projectCostVal - directCostVal;
                 $('#replacement_net_profit').val(totalNetProfit.toFixed(2));
             }

             function calculateNetProfitPercent() {
                 var projectCostValval = parseFloat($('#replacement_project_cost').val()) || 0;
                 var marginProfitValval = parseFloat($('#replacement_margin_profit_value').val()) || 0;
                 var totalNetProfitPercent = ((marginProfitValval - projectCostValval) / marginProfitValval) * 100;
                 $('#replacement_sub_total_value').val(Math.round(totalNetProfitPercent));
             }

             function calculateNetProfitPercentdouble() {
                 var netProfitVal = parseFloat($('#replacement_net_profit').val()) || 0;
                 var marginVal = parseFloat($('#replacement_margin_profit_value').val()) || 0;
                 var totalNetProfitPercentVal = (netProfitVal / marginVal) * 100;
                 $('#replacement_total_sub_total_value').val(Math.round(totalNetProfitPercentVal));
             }



             $('input').on('input', function() {
                 calculateAddionalLayerValue();
                 calculateWindowsValue();
                 calculateShattersValue();
                 calculatePlywoodValue();
                 calculateAluminumValue();
                 calculateAzeckValue();
                 calculateTotalMaterialValue();
                 calculateTotalLaborValue();
                 calculateTotalDumpsterValue();
                 calculateTotalPermitWarrantyValue();
                 updateProjectCost();
                 calculateMarginProfitValue();
                 calculateSuperValue();
                 calculateSalesValue();
                 sumSalesSuperValue();
                 calculateNetProfitValue();
                 calculateNetProfitPercent();
                 calculateNetProfitPercentdouble();
                 calculateRecommendedPrice();
                 calculatePricePerSq();
                 // calculateTotalMaterialValue();
                 // calculateTotalLaborValue();
                 // calculateTotalDumpsterValue();
                 // calculateTotalPermitWarrantyValue();
                 // updateProjectCost();
                 // calculateMarginProfitValue();
                 // calculateSuperValue();
                 // calculateSalesValue();
                 // sumSalesSuperValue();
                 // calculateNetProfitValue();
                 // calculateNetProfitPercent();
                 // calculateNetProfitPercentdouble();
                 //
                 // calculatePricePerSq();
                 // calculateAddionalLayerValue();
                 // calculateWindowsValue();
                 // calculateShattersValue();
                 // calculatePlywoodValue();
                 // calculateMarginProfitValue();
                 // calculateAluminumValue();
                 // calculateAzeckValue();

             });

             $('#replacement_project_cost').on('input', calculateMarginProfitValue);
             $('#replacement_margin_profit_value, #replacement_super_value').on('input', calculateSuperValue);
             $('#replacement_margin_profit_value, #replacement_sales_value').on('input', calculateSalesValue);
             $('#replacement_total_super_value, #replacement_total_sales_value').on('input', sumSalesSuperValue);
             $('#replacement_project_cost, #replacement_margin_profit_value, #replacement_direct_cost_value').on('input', calculateNetProfitValue);
             $('#replacement_project_cost, #replacement_margin_profit_value').on('input', calculateNetProfitPercent);
             $('#replacement_net_profit, #replacement_margin_profit_value').on('input', calculateNetProfitPercentdouble);
             $('#replacement_margin_profit_value').on('input', calculateRecommendedPrice);
             $('#replacement_recommended_price, #replacement_siding_sq_value').on('input', calculatePricePerSq);
             $('#replacement_additional_layer_value').on('input', calculateAddionalLayerValue);
             $('#replacement_window_door_value').on('input', calculateWindowsValue);
             $('#replacement_shutter_value').on('input', calculateShattersValue);
             $('#replacement_plywood_value').on('input', calculatePlywoodValue);
             $('#replacement_aluminium_trim_value').on('input', calculateAluminumValue);
             $('#replacement_azeck_wood_value').on('input', calculateAzeckValue);
             $('#replacement_material_value,#replacement_plywood_per_sq_value,#replacement_shutter_per_sq_value,#replacement_azeck_wood_per_sq_value,#replacement_siding_soffit_value,#replacement_siding_sq_value').on('input', calculateTotalMaterialValue);
             $('#replacement_labor_value,#replacement_aluminium_trim_per_sq_value,#replacement_window_door_per_sq_value,#replacement_additional_layer_per_sq_value,#replacement_plywood_per_sq_value,#replacement_shutter_per_sq_value,#replacement_azeck_wood_per_sq_value,#replacement_siding_soffit_value,#replacement_siding_sq_value').on('input', calculateTotalLaborValue);


             // calculateTotalMaterialValue();
             // calculateTotalLaborValue();
             // calculateTotalDumpsterValue();
             // calculateTotalPermitWarrantyValue();
             // updateProjectCost();
             // calculateMarginProfitValue();
             // calculateSuperValue();
             // calculateSalesValue();
             // sumSalesSuperValue();
             // calculateNetProfitValue();
             // calculateNetProfitPercent();
             // calculateNetProfitPercentdouble();
             // calculateRecommendedPrice();
             // calculatePricePerSq();
             // calculateAddionalLayerValue();
             // calculateWindowsValue();
             // calculateShattersValue();
             // calculatePlywoodValue();
             // calculateMarginProfitValue();
             // calculateAluminumValue();
             // calculateAzeckValue();

             calculateAddionalLayerValue();
             calculateWindowsValue();
             calculateShattersValue();
             calculatePlywoodValue();
             calculateAluminumValue();
             calculateAzeckValue();
             calculateTotalMaterialValue();
             calculateTotalLaborValue();
             calculateTotalDumpsterValue();
             calculateTotalPermitWarrantyValue();
             updateProjectCost();
             calculateMarginProfitValue();
             calculateSuperValue();
             calculateSalesValue();
             sumSalesSuperValue();
             calculateNetProfitValue();
             calculateNetProfitPercent();
             calculateNetProfitPercentdouble();
             calculateRecommendedPrice();
             calculatePricePerSq();
         });
         $(document).ready(function(){
            storeData();
         $(document).on('keyup', '.form-control', function() {
             storeData();
         });
         function storeData(){
             var formData = $('#store_roof_estimate_calculator_over_existing').serialize();
             $.ajax({
                 url: '{{ route("store_siding_replacement") }}',
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