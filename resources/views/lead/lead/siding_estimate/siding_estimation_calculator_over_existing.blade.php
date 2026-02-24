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
        <form action="" class="row" method="post" id="store_side_estimate_calculator_over_existing">
            @csrf
            <input type="hidden" name="side_estimate_calculator_id" value="{{$sidingEstimateCalculator->id??''}}">
{{--            @if(isset($lead->sidingEstimateCalculator) && $lead->sidingEstimateCalculator)--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="table_top_btn">--}}
{{--                        <a href="{{url('siding_estimation_calculator/' . $lead->sidingEstimateCalculator->lead_id) }}" class="btn btn_green">Measurement </a>--}}
{{--                        <a href="{{url('siding_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->sidingEstimateCalculator->id}}/replacement" class="btn btn_green">Replacement ({{ $lead->sidingEstimateCalculator->sideEstimateCalculatorReplacement->recommended_price??"0" }})</a>--}}
{{--                        <a href="{{url('siding_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->sidingEstimateCalculator->id}}/gutters" class="btn btn_green">Gutter ({{ $lead->sidingEstimateCalculator->storeSidingEstimateCalculatorGutter->recommended_price??"0" }}) ({{ $lead->sidingEstimateCalculator->storeSidingEstimateCalculatorGutter->recommended_price_two??"0" }})</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endif--}}
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
                        {{--                        <td><input type="text" name="siding_price_value" id="siding_price_value"></td>--}}
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

                        <td><input class="form-control" type="text" name="siding_sq_value" id="over_siding_sq_value" value="{{ $sidingExistingSq??"" }}" readonly></td>
                        <td>Price Per SQ</td>

                    </tr>
                    <tr>
                        <td>Soffit</td>

                        <td><input class="form-control" type="text" name="siding_soffit_value" id="over_siding_soffit_value" value="{{ $sidingExistingSoffitTotalSum??"0.00" }}" readonly></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td>Additional layer</td>

                        <td><input class="form-control" type="text" name="additional_layer_value" id="over_additional_layer_value" value="{{ $sidingExistingAdditionalLayers??"0.00" }}" readonly></td>
                        <td><input class="form-control" type="text" name="additional_layer_per_sq_value" id="over_additional_layer_per_sq_value" readonly></td>

                    </tr>
                    <tr>
                        <td>Windows / Doors</td>

                        <td><input class="form-control" type="text" name="window_door_value" id="over_window_door_value" readonly value="{{ $existingWindowsDoors??"0.00" }}"></td>
                        <td><input class="form-control" type="text" name="window_door_per_sq_value" id="over_window_door_per_sq_value" readonly></td>


                    </tr>
                    <tr>
                        <td>Aluminium Trim</td>
                        <td><input class="form-control" type="text" name="aluminium_trim_value" id="over_aluminium_trim_value"value="{{ $aluminum}}"  readonly></td>
                        <td><input class="form-control" type="text" name="aluminium_trim_per_sq_value" id="over_aluminium_trim_per_sq_value" readonly></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td>Azeck / Wood (1/2)</td>
                        <td><input class="form-control" type="text" name="azeck_wood_value" id="over_azeck_wood_value" value="{{($sidingEstimateCalculator->soffit_eave + $sidingEstimateCalculator->soffit_rakes)??0}}" readonly></td>
                        <td><input class="form-control" type="text" name="azeck_wood_per_sq_value" id="over_azeck_wood_per_sq_value" value="" readonly></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Shatters</td>
                        <td><input class="form-control" type="text" name="shutter_value" id="over_shutter_value" value="{{ $sidingExistingShatters??"0.00" }}" readonly></td>
                        <td><input class="form-control" type="text" name="shutter_per_sq_value" id="over_shutter_per_sq_value" value="50" readonly></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Plywood</td>
                        <td><input class="form-control" type="text" name="plywood_value" id="over_plywood_value" value="{{ $sidingExistingPlywood??"0.00" }}" readonly></td>
                        <td><input class="form-control" type="text" name="plywood_per_sq_value" id="over_plywood_per_sq_value" value="50" readonly></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td>Miscellaneous</td>
                        <td></td>
                        <td><input class="form-control" type="number" name="miselanies" id="over_miselanies" placeholder="Type here value" min="0" value="{{$sidingEstimateCalculator->storeSidingOverExisting->miselanies??'0'}}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif oninput="this.value = Math.abs(this.value)"></td>
                        <td></td>
                    </tr>
                    <tr class="bg-project">
                        <td colspan="3">PROJECT COST</td>
                        <td colspan="2"><input class="form-control" type="text" name="project_cost" id="over_project_cost" value="0.00" readonly></td>
                    </tr>
                    <tr>
                        <td>Materials</td>
                        <td></td>
                        <td><input class="form-control" type="number" name="material_value" id="over_material_value" min="0" value="{{ $sidingEstimateCalculator->storeSidingOverExisting->material_value??$sideDataOver['material_value']??'0' }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif oninput="this.value = Math.abs(this.value)"></td>
                        <td><input class="form-control" type="text" name="total_material_value" id="over_total_material_value" value="{{ $sidingEstimateCalculator->storeSidingOverExisting->total_material_value??'0' }}" readonly></td>
                    </tr>
                    <tr>
                        <td>Labor</td>
                        <td></td>
                        <td><input class="form-control" type="number" name="labor_value" id="over_labor_value" min="0" value="{{ $sidingEstimateCalculator->storeSidingOverExisting->labor_value??$sideDataOver['labor_value']??'0' }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif oninput="this.value = Math.abs(this.value)"></td>

                        <td><input class="form-control" type="text" name="total_labor_value" id="over_total_labor_value" value="{{ $sidingEstimateCalculator->storeSidingOverExisting->total_labor_value??'0' }}"  readonly></td>
                    </tr>
                    <tr>
                        <td>Dumpster%</td>
                        <td></td>
                        <td><input class="form-control" type="number" name="dumpster_value" id="over_dumpster_value" min="0" value="{{ $sidingEstimateCalculator->storeSidingOverExisting->dumpster_value??$sideDataOver['dumpster_value']??'0' }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif oninput="this.value = Math.abs(this.value)"></td>
                        <td><input class="form-control" type="text" name="total_dumpster_value" id="over_total_dumpster_value" value="{{ $sidingEstimateCalculator->storeSidingOverExisting->total_dumpster_value??'0' }}" readonly></td>
                    </tr>
                    <tr>
                        <td>Permit / Warranty%</td>
                        <td></td>
                        <td><input class="form-control" type="number" name="permit_warranty_value" id="over_permit_warranty_value" min="0" value="{{ $sidingEstimateCalculator->storeSidingOverExisting->permit_warranty_value??$sideDataOver['permit_warranty_value']??'0' }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif oninput="this.value = Math.abs(this.value)"></td>
                        <td><input class="form-control" type="text" name="total_permit_warranty_value" id="over_total_permit_warranty_value" value="{{ $sidingEstimateCalculator->storeSidingOverExisting->total_permit_warranty_value??'0' }}" readonly></td>
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
                        <td><input class="form-control" type="text" name="margin_profit_value" id="over_margin_profit_value" value="{{ $sidingEstimateCalculator->storeSidingOverExisting->margin_profit_value??'0' }}" readonly></td>
                    </tr>
                    <tr>
                        <td>Super%</td>
                        <td><input class="form-control" type="number" name="super_value" id="over_super_value" min="0" value="{{ $sidingEstimateCalculator->storeSidingOverExisting->super_value??$sideDataOver['super_value']??'0' }}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif oninput="this.value = Math.abs(this.value)"></td>
                        <td></td>
                        <td><input class="form-control" type="text" name="total_super_value" id="over_total_super_value" value="{{ $sidingEstimateCalculator->storeSidingOverExisting->total_super_value??'0' }}" readonly></td>
                    </tr>
                    <tr>
                        <td>Sales%</td>
                        <td><input class="form-control" type="number" name="sales_value" id="over_sales_value" value="{{$sideDataOver['sales_value']??'0'}}" @if(!auth()->user()->can('edit-sidingestimatecalculator')) readonly @endif oninput="this.value = Math.abs(this.value)"></td>

                        <td></td>
                        <td><input class="form-control" type="text" name="total_sales_value" id="over_total_sales_value" readonly></td>
                    </tr>
                    <tr>
                        <td>Direct Cost</td>
                        <td></td>
                        <td></td>
                        <td><input class="form-control" type="text" name="direct_cost_value" id="over_direct_cost_value" value="{{ $sidingEstimateCalculator->storeSidingOverExisting->direct_cost_value??'0' }}" readonly></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="bg-net-profit">
                        <td colspan="3">Net Profit</td>
                        <td colspan="2"><input class="form-control" type="text" name="net_profit" id="over_net_profit" value="{{ $sidingEstimateCalculator->storeSidingOverExisting->net_profit??'0' }}" readonly></td>
                    </tr>
                    <tr>
                        <td>%</td>
                        <td></td>
                        <td><input class="form-control" type="text" name="sub_total_value" id="over_sub_total_value" value="{{ $sidingEstimateCalculator->storeSidingOverExisting->sub_total_value??'0' }}" readonly></td>
                        <td><input class="form-control" type="text" name="total_sub_total_value" id="over_total_sub_total_value" value="{{ $sidingEstimateCalculator->storeSidingOverExisting->total_sub_total_value??'0' }}" readonly></td>

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
    $(document).ready(function() {
        @php
            $sidingDataOver = json_decode($sidingBaseValuesOver->siding_over_existing, true);
        @endphp
        function calculateRecommendedPrice() {
            var netVal = parseFloat($('#over_margin_profit_value').val()) || 0;
            $('#over_recommended_price').val(netVal.toFixed(2));
            $('#over_recommended_price_global').text(netVal.toFixed(2));
        }

        function calculatePricePerSq() {
            var recommedPriceVal = parseFloat($('#over_recommended_price').val()) || 0;
            var squareValue = parseFloat($('#over_siding_sq_value').val()) || 0;
            var totalPricePerSq = recommedPriceVal / squareValue;
            $('#over_price_per_sq_value').val(totalPricePerSq.toFixed(2));
        }

        function calculateAddionalLayerValue() {
            var addionalLayerVal = parseFloat($('#over_additional_layer_value').val()) || 0;
            var layerTotalVal = addionalLayerVal * {{$sidingDataOver['additional_layer']??0}};
            console.log(layerTotalVal);
            $('#over_additional_layer_per_sq_value').val(layerTotalVal.toFixed(2));
        }

        function calculateWindowsValue() {
            var windowsVal = parseFloat($('#over_window_door_value').val()) || 0;
            var windowsTotalVal = windowsVal * {{$sidingDataOver['window']??0}};
            $('#over_window_door_per_sq_value').val(windowsTotalVal.toFixed(2));
        }

        function calculateShattersValue() {
            var shatterVal = parseFloat($('#over_shutter_value').val()) || 0;
            var shatterTotalVal = shatterVal * {{$sidingDataOver['shatters']??0}};
            $('#over_shutter_per_sq_value').val(shatterTotalVal.toFixed(2));
        }

        function calculatePlywoodValue() {
            var plywoodVal = parseFloat($('#over_plywood_value').val()) || 0;
            var windowsTotalVal = plywoodVal * {{$sidingDataOver['plywood']??0}};
            $('#over_plywood_per_sq_value').val(windowsTotalVal.toFixed(2));
        }
        function calculateAluminumValue() {
            var aluminumVal = parseFloat($('#over_aluminium_trim_value').val()) || 0;
            var aluminumTotalVal = aluminumVal * {{$sidingDataOver['aluminium']??0}};
            $('#over_aluminium_trim_per_sq_value').val(aluminumTotalVal.toFixed(2));
        }
        function calculateAzeckValue() {
            var azeckVal = parseFloat($('#over_azeck_wood_value').val()) || 0;
            var selectedOption = $('select[name="labels[azeck_wood][value]"] option:selected').text().trim();
            var multiplier = 0;

            if (selectedOption === 'Azeck') {
                multiplier = {{ $sidingDataOver['azeck'] ?? 0 }};
            } else if (selectedOption === 'Wood') {
                multiplier = {{ $sidingDataOver['wood'] ?? 0 }};
            }

            var azeckTotalVal = azeckVal * multiplier??0;
            $('#over_azeck_wood_per_sq_value').val(azeckTotalVal.toFixed(2));
        }
        function calculateTotalMaterialValue() {
            var sidingSqValue = parseFloat($('#over_siding_sq_value').val()) || 0;
            var sidingSoffitValue = parseFloat($('#over_siding_soffit_value').val()) || 0;
            var azeckWoodPerSqValue = parseFloat($('#over_azeck_wood_per_sq_value').val()) || 0;
            var shutterPerSqValue = parseFloat($('#over_shutter_per_sq_value').val()) || 0;
            var plywoodPerSqValue = parseFloat($('#over_plywood_per_sq_value').val()) || 0;
            var materialValue = parseFloat($('#over_material_value').val()) || 0;
            var additionallValue = parseFloat($('#over_additional_layer_per_sq_value').val()) || 0;
            var windowssValue = parseFloat($('#over_window_door_per_sq_value').val()) || 0;
            var aluminummValue = parseFloat($('#over_aluminium_trim_per_sq_value').val()) || 0;
            var miselaniesValue = parseFloat($('#over_miselanies').val()) || 0;
            // var firstVal = (sidingSqValue + sidingSoffitValue) * materialValue;
            var firstVal = (sidingSqValue + sidingSoffitValue) * materialValue;
            var seconfVal =  azeckWoodPerSqValue + shutterPerSqValue + plywoodPerSqValue + miselaniesValue;
            var totalMaterialValue = firstVal + seconfVal
            $('#over_total_material_value').val(totalMaterialValue.toFixed(2));
        }

        function calculateTotalLaborValue() {
            var sidingSqValue = parseFloat($('#over_siding_sq_value').val()) || 0;
            var sidingSoffitValue = parseFloat($('#over_siding_soffit_value').val()) || 0;
            var azeckWoodPerSqValue = parseFloat($('#over_azeck_wood_per_sq_value').val()) || 0;
            var shutterPerSqValue = parseFloat($('#over_shutter_per_sq_value').val()) || 0;
            var plywoodPerSqValue = parseFloat($('#over_plywood_per_sq_value').val()) || 0;
            var additionalLayerPerSqValue = parseFloat($('#over_additional_layer_per_sq_value').val()) || 0;
            var windowDoorPerSqValue = parseFloat($('#over_window_door_per_sq_value').val()) || 0;
            var aluminiumTrimPerSqValue = parseFloat($('#over_aluminium_trim_per_sq_value').val()) || 0;
            var laborValue = parseFloat($('#over_labor_value').val()) || 0;
            var miselaniessValue = parseFloat($('#over_miselanies').val()) || 0;

            var totalSum1 = (sidingSqValue + sidingSoffitValue) * laborValue ;
            var totalSum2 = azeckWoodPerSqValue + shutterPerSqValue + plywoodPerSqValue + additionalLayerPerSqValue + windowDoorPerSqValue + aluminiumTrimPerSqValue + miselaniessValue;
            var totalValSum = totalSum1 + totalSum2;
            $('#over_total_labor_value').val(totalValSum.toFixed(2));
        }

        function calculateTotalDumpsterValue() {
            var totalMaterialValue = parseFloat($('#over_total_material_value').val()) || 0;
            var dumpsterValue = parseFloat($('#over_dumpster_value').val()) || 0;
            var additionalLayerPerSqValue = parseFloat($('#over_additional_layer_per_sq_value').val()) || 0;

            var total1 = (totalMaterialValue * (dumpsterValue / 100));
            var totoal2 = total1 + additionalLayerPerSqValue;
            $('#over_total_dumpster_value').val(totoal2.toFixed(2));
        }

        function calculateTotalPermitWarrantyValue() {
            var totalMaterialValue = parseFloat($('#over_total_material_value').val()) || 0;
            var permitWarrantyValue = parseFloat($('#over_permit_warranty_value').val()) || 0;
            var totalPermitWarrantyValue = (totalMaterialValue * permitWarrantyValue) / 100;

            $('#over_total_permit_warranty_value').val(totalPermitWarrantyValue.toFixed(2));
        }

        function updateProjectCost() {
            var materialValue = parseFloat($('#over_total_material_value').val()) || 0;
            var laborValue = parseFloat($('#over_total_labor_value').val()) || 0;
            var dumpsterValue = parseFloat($('#over_total_dumpster_value').val()) || 0;
            var permitWarrantyValue = parseFloat($('#over_total_permit_warranty_value').val()) || 0;
            // var over_miselanies = parseFloat($('#over_miselanies').val()) || 0;

            var total = materialValue + laborValue + dumpsterValue + permitWarrantyValue;
            $('#over_project_cost').val(total.toFixed(2));
        }

        function calculateMarginProfitValue() {
            var projectCost = parseFloat($('#over_project_cost').val());
            if (!isNaN(projectCost)) {
                var marginProfitValue = projectCost / ({{$sidingDataOver['margin_profit']??1}} / 100);
                $('#over_margin_profit_value').val(marginProfitValue.toFixed(2));
            }
        }
        function calculateSuperValue() {
            var marginValue = parseFloat($('#over_margin_profit_value').val()) || 0;
            var superValue = parseFloat($('#over_super_value').val()) || 0;
            var superValueTotal = marginValue * superValue / 100;
            $('#over_total_super_value').val(superValueTotal.toFixed(2));
        }

        function calculateSalesValue() {
            var marginVal = parseFloat($('#over_margin_profit_value').val()) || 0;
            var salesValue = parseFloat($('#over_sales_value').val()) || 0;
            var salesValueTotal = marginVal * salesValue / 100;
            $('#over_total_sales_value').val(salesValueTotal.toFixed(2));
        }

        function sumSalesSuperValue() {
            var salesVal = parseFloat($('#over_total_super_value').val()) || 0;
            var superVal = parseFloat($('#over_total_sales_value').val()) || 0;
            var totalSum = salesVal + superVal;
            $('#over_direct_cost_value').val(totalSum.toFixed(2));
        }

        function calculateNetProfitValue() {
            var projectCostVal = parseFloat($('#over_project_cost').val()) || 0;
            var marginProfitVal = parseFloat($('#over_margin_profit_value').val()) || 0;
            var directCostVal = parseFloat($('#over_direct_cost_value').val()) || 0;
            var totalNetProfit = marginProfitVal - projectCostVal - directCostVal;
            $('#over_net_profit').val(totalNetProfit.toFixed(2));
        }

        function calculateNetProfitPercent() {
            var projectCostValval = parseFloat($('#over_project_cost').val()) || 0;
            var marginProfitValval = parseFloat($('#over_margin_profit_value').val()) || 0;
            var totalNetProfitPercent = ((marginProfitValval - projectCostValval) / marginProfitValval) * 100;
            $('#over_sub_total_value').val(Math.round(totalNetProfitPercent));
        }

        function calculateNetProfitPercentdouble() {
            var netProfitVal = parseFloat($('#over_net_profit').val()) || 0;
            var marginVal = parseFloat($('#over_margin_profit_value').val()) || 0;
            var totalNetProfitPercentVal = (netProfitVal / marginVal) * 100;
            $('#over_total_sub_total_value').val(Math.round(totalNetProfitPercentVal));
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

        $('#over_project_cost').on('input', calculateMarginProfitValue);
        $('#over_margin_profit_value, #over_super_value').on('input', calculateSuperValue);
        $('#over_margin_profit_value, #over_sales_value').on('input', calculateSalesValue);
        $('#over_total_super_value, #over_total_sales_value').on('input', sumSalesSuperValue);
        $('#over_project_cost, #over_margin_profit_value, #direct_cost_value').on('input', calculateNetProfitValue);
        $('#over_project_cost, #over_margin_profit_value').on('input', calculateNetProfitPercent);
        $('#over_net_profit, #over_margin_profit_value').on('input', calculateNetProfitPercentdouble);
        $('#over_margin_profit_value').on('input', calculateRecommendedPrice);
        $('#over_recommended_price, #over_siding_sq_value').on('input', calculatePricePerSq);
        $('#over_additional_layer_value').on('input', calculateAddionalLayerValue);
        $('#over_window_door_value').on('input', calculateWindowsValue);
        $('#over_shutter_value').on('input', calculateShattersValue);
        $('#over_plywood_value').on('input', calculatePlywoodValue);
        $('#over_aluminium_trim_value').on('input', calculateAluminumValue);
        $('#over_azeck_wood_value').on('input', calculateAzeckValue);
        $('#over_material_value,#over_plywood_per_sq_value,#over_shutter_per_sq_value,#over_azeck_wood_per_sq_value,#over_siding_soffit_value,#over_over_siding_sq_value,#over_aluminium_trim_per_sq_value,#over_window_door_per_sq_value,#over_additional_layer_per_sq_value').on('input', calculateTotalMaterialValue);
        $('#over_labor_value,#over_aluminium_trim_per_sq_value,#over_window_door_per_sq_value,#over_additional_layer_per_sq_value,#over_plywood_per_sq_value,#over_shutter_per_sq_value,#over_azeck_wood_per_sq_value,#over_siding_soffit_value,#over_siding_sq_value').on('input', calculateTotalLaborValue);


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
    $(document).ready(function (){
        storeData();
    $(document).on('keyup', '.form-control', function() {
        storeData();
    });
    function storeData(){
        var formData = $('#store_side_estimate_calculator_over_existing').serialize();
        $.ajax({
            url: '{{ route("store_siding_over_existing") }}',
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
