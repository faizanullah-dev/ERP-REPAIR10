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
    <section class="white-box">
    <div class="container-fluid">
        <form action="" class="row" method="post" id="store_chimney_estimate_calculator_chimney">
            @csrf
            <input type="hidden" name="chimney_estimate_calculator_id" value="{{$chimneyEstimateCalculator->id??''}}">
{{--            @if(isset($lead->chimneyEstimateCalculator) && $lead->chimneyEstimateCalculator)--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="table_top_btn">--}}
{{--                        <a href="{{url('chimney_estimation_calculator/' . $lead->chimneyEstimateCalculator->lead_id) }}" class="btn btn_green">Measurement </a>--}}
{{--                        <a href="{{url('chimney_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->chimneyEstimateCalculator->id}}/liner" class="btn btn_green">Liner ({{ $lead->chimneyEstimateCalculator->storeLiner->recommended_price??'0' }} )</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endif--}}
            <div class="col-md-12">
                <h3>Chimney Estimation Calculator (Chimney Rebuild)</h3>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th colspan="3">Recommended Price</th>
                        <th colspan="2" class="text-right"><input class="form-control" type="text" name="recommended_price" id="chimney_recommended_price" value="0.00" readonly></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>

                    </tr>
                    <tr>
                        <td>Chimney Price</td>
                        <td></td>
                        {{--                        <td><input type="text" name="siding_price_value" id="siding_price_value"></td>--}}
                        <td></td>
                        <td><input class="form-control" type="text" name="chimney_price" id="chimney_price" value="0.00" readonly ></td>

                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td>Bricks</td>

                        <td><input class="form-control" type="text" name="bricks" id="bricks_value" value="{{ $totalBricks??'0' }}" readonly></td>
                        <td>Price Per SQ</td>

                    </tr>
                    <tr>
                        <td>Stories</td>

                        <td><input class="form-control" type="text" name="stories" id="stories_value" value="{{ $chimneyStoriesLabels??'0' }}" readonly></td>
                        <td><input class="form-control" type="text" name="total_stories_value" id="total_stories_value" value="0" readonly></td>

                    </tr>
                    <tr>
                        <td>Pitch</td>

                        <td><input class="form-control" type="text" name="pitch" id="pitch_value" value="{{ $chimneyPitchLabels??'0' }}" readonly></td>
                        <td><input class="form-control" type="text" name="total_pitch_value" id="total_pitch_value" readonly></td>

                    </tr>
                    <tr>
                        <td>Difficulty</td>
                        <td><input class="form-control" type="text" name="dificultie" id="dificultie_value" readonly value="{{ $chimneyDificutLabels??'0' }}"></td>
                        <td><input class="form-control" type="text" name="total_dificultie_value" id="total_dificultie_value" readonly></td>
                    </tr>
                    <tr>
                        @php
                            $data = json_decode($chimneyBaseValues->chimney_chimney, true);
                        @endphp
                        <td>Cap</td>
                        <td><input  class="form-control" type="text" name="chimney_cap" id="cap_value" value="{{ $chimneyCapLabels??'0' }}" readonly></td>
                        <td><input class="form-control" type="text" name="total_chimney_cap_value" value="{{$lead->chimneyEstimateCalculator->chimneyEstimateCalculatorLabels->where('section', 'chimney_cap_two')->first()->value ?? $data['cap'] ?? '0'}}"  id="total_cap_value" readonly></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Miscellaneous</td>
                        <td></td>
                        <td>
                            <input  class="form-control only-numbers" placeholder="Type Here..." value="{{ $lead->chimneyEstimateCalculator->storeChimney->miscellaneous??"0" }}" type="text" name="miscellaneous" id="chimney_miscellaneous" @if(!auth()->user()->can('edit-chimneyestimatecalculator')) readonly @endif>
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
                        <td><input class="form-control" type="text" name="material" id="material_value" value="{{ $lead->chimneyEstimateCalculator->storeChimney->material??$chimneyDataChimney['material']??"0" }}"  @if(!auth()->user()->can('edit-chimneyestimatecalculator')) readonly @endif></td>
                        <td><input class="form-control" type="text" name="total_material_value" id="total_material_value" readonly ></td>
                    </tr>
                    <tr>
                        <td>Labor</td>
                        <td></td>
                        <td><input class="form-control" type="text" name="labor" id="labor_value" value="{{$lead->chimneyEstimateCalculator->storeChimney->labor??$chimneyDataChimney['labor']??'0'}}" @if(!auth()->user()->can('edit-chimneyestimatecalculator')) readonly @endif></td>
                        <td><input class="form-control" type="text" name="total_labor_value" id="total_labor_value" readonly></td>
                    </tr>
                    <tr>
                        <td>Dumpster%</td>
                        <td></td>
                        <td><input class="form-control" type="text" name="dumpster" id="dumpster_value" value="{{$lead->chimneyEstimateCalculator->storeChimney->dumpster??$chimneyDataChimney['dumpster']??'0'}}" @if(!auth()->user()->can('edit-chimneyestimatecalculator')) readonly @endif></td>
                        <td><input class="form-control" type="text" name="total_dumpster_value" id="total_dumpster_value" readonly></td>
                    </tr>
                    <tr>
                        <td>Permit / Warranty%</td>
                        <td></td>
                        <td><input class="form-control" type="text" name="permit_warranty" id="permit_warranty_value" value="{{$lead->chimneyEstimateCalculator->storeChimney->permit_warranty??$chimneyDataChimney['permit_warranty']??'0'}}" @if(!auth()->user()->can('edit-chimneyestimatecalculator')) readonly @endif></td>
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
                        <td colspan="2"><input class="form-control" type="text" name="project_cost" id="project_cost" value="0.00" readonly></td>
                    </tr>
                    <tr>
                        <td>Margin Profit</td>
                        <td></td>
                        <td></td>
                        <td><input class="form-control" type="text" name="margin_profit" id="margin_profit_value" readonly></td>
                    </tr>
                    <tr>
                        <td>Sales%</td>
                        <td><input class="form-control" type="text" name="sales" id="sales_value" value="{{$lead->chimneyEstimateCalculator->storeChimney->sales??$chimneyDataChimney['sales']??'0'}}" @if(!auth()->user()->can('edit-chimneyestimatecalculator')) readonly @endif></td>
                        <td></td>
                        <td><input class="form-control" type="text" name="total_sales_value" id="total_sales_value" readonly></td>
                    </tr>
                    <tr>
                        <td>Direct Cost</td>
                        <td></td>
                        <td></td>
                        <td><input class="form-control" type="text" name="direct_cost" id="direct_cost" value="0.00" readonly></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="bg-net-profit">
                        <td colspan="3">Net Profit</td>
                        <td colspan="2"><input class="form-control" type="text" name="net_profit" id="net_profit" value="0.00" readonly></td>
                    </tr>
                    <tr>
                        <td>Margin%</td>
                        <td></td>
                        <td></td>
                        {{--                        <td><input class="form-control" type="text" name="sub_total_value" id="sub_total_value" value="30"></td>--}}
                        <td><input class="form-control" type="text" name="margin_percent" id="margin_value" value="22" readonly></td>

                    </tr>
                    <tr>
                        <td>Net Profit%</td>
                        <td></td>
                        <td></td>
                        {{--                        <td><input class="form-control" type="text" name="sub_total_value" id="sub_total_value" value="30"></td>--}}
                        <td><input class="form-control" type="text" name="net_profit_percent" id="net_profit_value" value="22" readonly></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    </section>
{{--@endsection--}}
{{--@push('js')--}}
@php
    $data = json_decode($chimneyBaseValues->chimney_chimney, true);
@endphp
    <script>
        $(document).ready(function() {
            function calculateMultiplyValues() {
                var storiesVal = parseFloat($('#stories_value').val()) || 0;
                var pitchVal = parseFloat($('#pitch_value').val()) || 0;
                var dificultyVal = parseFloat($('#dificultie_value').val()) || 0;
                var capVal = parseFloat($('#cap_value').val()) || 0;
                var capValvalue = parseFloat($('#total_cap_value').val()) || 0;
                var totalStoriesVal = storiesVal * {{$data['stories'] ?? 0}};
                var totalpitchVal = pitchVal * {{$data['pitch'] ?? 0}};
                var totaldificultyVal = dificultyVal * {{$data['difficulty'] ?? 0}};
                var totalCapVal = capVal * capValvalue;
                $('#total_stories_value').val(totalStoriesVal.toFixed(2));
                $('#total_pitch_value').val(totalpitchVal.toFixed(2));
                $('#total_dificultie_value').val(totaldificultyVal.toFixed(2));
                $('#total_cap_value').val(totalCapVal.toFixed(2));
            }
            function calculateMultiplySumValues() {
                var totalBricksVal = parseFloat($('#bricks_value').val()) || 0;
                var totalStoriesVal = parseFloat($('#total_stories_value').val()) || 0;
                var totalPitchVal = parseFloat($('#total_pitch_value').val()) || 0;
                var totalDificultyVal = parseFloat($('#total_dificultie_value').val()) || 0;
                var totalCapVal = parseFloat($('#total_cap_value').val()) || 0;
                var materialVal = parseFloat($('#material_value').val()) || 0;
                var laborVal = parseFloat($('#labor_value').val()) || 0;
                var multiplyBricksVal1 = totalBricksVal * materialVal ;
                var multiplyBricksVal2 = totalBricksVal * laborVal ;
                var sumMeterialTotalVal = totalStoriesVal + totalCapVal ;
                // var sumMeterialTotalVal = totalStoriesVal + totalPitchVal + totalDificultyVal + totalCapVal + materialVal ;
                var sumLaborTotalVal = totalStoriesVal + totalPitchVal + totalDificultyVal + totalCapVal ;
                var totalMaterialMultiSumVal = multiplyBricksVal1 + sumMeterialTotalVal ;
                var totalLaborMultiSumVal = multiplyBricksVal2 + sumLaborTotalVal ;
                $('#total_material_value').val(totalMaterialMultiSumVal.toFixed(2));
                $('#total_labor_value').val(totalLaborMultiSumVal.toFixed(2));

            }
            function calculateMultiplyDumsterPermitValues() {
                var totalMaterialVal = parseFloat($('#total_material_value').val()) || 0;
                var totalDumsterVal = parseFloat($('#dumpster_value').val()) || 0;
                var totalPermitVal = parseFloat($('#permit_warranty_value').val()) || 0;
                var TotalMultiplyDumsterVal = totalMaterialVal * (totalDumsterVal / 100) ;
                var TotalMultiplyPermitVal = totalMaterialVal * (totalPermitVal / 100) ;
                $('#total_dumpster_value').val(TotalMultiplyDumsterVal.toFixed(2));
                $('#total_permit_warranty_value').val(TotalMultiplyPermitVal.toFixed(2));
            }
            function calculateSumProjectCost() {
                var materialtotalVal = parseFloat($('#total_material_value').val()) || 0;
                var laborTotalVal = parseFloat($('#total_labor_value').val()) || 0;
                var dumsterTotalVal = parseFloat($('#total_dumpster_value').val()) || 0;
                var permitTotalVal = parseFloat($('#total_permit_warranty_value').val()) || 0;
                var chimney_miscellaneous = parseFloat($('#chimney_miscellaneous').val()) || 0;
                var totalSumVal = materialtotalVal + laborTotalVal + dumsterTotalVal + permitTotalVal + chimney_miscellaneous;
                $('#project_cost').val(totalSumVal.toFixed(2));
            }
            function calculateMarginProfit() {
                var projectCostVal = parseFloat($('#project_cost').val()) || 0;
                var totalProjectCostVal = (projectCostVal / ({{$data['margin_profit'] ?? 0}} / 100));
                $('#margin_profit_value').val(totalProjectCostVal.toFixed(2));
            }
            function calculateSalesTotal() {
                var totalMarginValue = parseFloat($('#margin_profit_value').val()) || 0;
                var totalSalesValue = parseFloat($('#sales_value').val()) || 0;
                var totalProjectCostVal =  (totalMarginValue * totalSalesValue) / 100 ;
                $('#total_sales_value').val(totalProjectCostVal.toFixed(2));
            }
            function calculateDirectCostTotalSum () {
                var totalsalesVal = parseFloat($('#total_sales_value').val()) || 0;
                var totalProjectCostVal = totalsalesVal;
                $('#direct_cost').val(totalProjectCostVal.toFixed(2));
            }
            function calculateNetProfitTotal() {
                var projectCostTotalVal = parseFloat($('#project_cost').val()) || 0;
                var marginTotalVal = parseFloat($('#margin_profit_value').val()) || 0;
                var directCostTotalVal = parseFloat($('#direct_cost').val()) || 0;
                var netProfitTotal = marginTotalVal - projectCostTotalVal - directCostTotalVal ;
                $('#net_profit').val(netProfitTotal.toFixed(2));
            }
            function calculateMarginPercent() {
                var projectCostTotalVal = parseFloat($('#project_cost').val()) || 0;
                var recommededPriceTotalVal = parseFloat($('#chimney_recommended_price').val()) || 0;

               if (recommededPriceTotalVal === 0 || !isFinite(projectCostTotalVal)) {
                    $('#margin_value').val(35);
                } else {
                    var marginTotalVal = ((recommededPriceTotalVal - projectCostTotalVal) / recommededPriceTotalVal) * 100;
                    $('#margin_value').val(Math.round(marginTotalVal));
                }
            }
            function calculateNetProfitPercent() {
                var netProfitVall = parseFloat($('#net_profit').val()) || 0;
                var recommededPriceTotalVall = parseFloat($('#chimney_recommended_price').val()) || 0;
               if (recommededPriceTotalVall === 0 || !isFinite(netProfitVall)) {
                    $('#net_profit_value').val(27);
                } else {
                    var netProfitTotalVall = (netProfitVall / recommededPriceTotalVall) * 100;
                    $('#net_profit_value').val(Math.round(netProfitTotalVall));
                }
            }
            function calculateRecommededVal() {
                var marfinProfit = parseFloat($('#margin_profit_value').val()) || 0;
                var capVall = parseFloat($('#cap_value').val()) || 0;
                var recommendedTotal = marfinProfit + capVall;
                $('#chimney_recommended_price').val(recommendedTotal.toFixed(2));
                $('#chimney_recommended_price_global').text(recommendedTotal.toFixed(2));
            }
            function calculateChimneyPriceVal() {
                var recommendedPriceVal = parseFloat($('#chimney_recommended_price').val()) || 0;
                var bricksVal = parseFloat($('#bricks_value').val()) || 0;
                var TotalVal = recommendedPriceVal / bricksVal;
                $('#chimney_price').val(TotalVal.toFixed(2));
            }
            $('input').on('input', function() {
                // calculateMultiplyValues();
                calculateMultiplySumValues();
                calculateMultiplyDumsterPermitValues();
                calculateSumProjectCost();
                calculateMarginProfit();
                calculateSalesTotal();
                calculateDirectCostTotalSum();
                calculateNetProfitTotal();
                calculateMarginPercent();
                calculateNetProfitPercent();
                calculateRecommededVal();
                calculateChimneyPriceVal();
            });
            $('#stories_value,#pitch_value,#dificultie_value,#cap_value').on('input', calculateMultiplyValues);
            $('#bricks_value,#total_stories_value,#total_pitch_value,#total_dificultie_value,#total_cap_value,#material_value,#labor_value').on('input', calculateMultiplySumValues);
            $('#total_material_value,#dumpster_value,#permit_warranty_value').on('input', calculateMultiplyDumsterPermitValues);
            $('#total_material_value,#total_labor_value,#total_dumpster_value,#total_permit_warranty_value').on('input', calculateSumProjectCost);
            $('#project_cost').on('input', calculateMarginProfit);
            $('#margin_profit_value,#sales_value').on('input', calculateSalesTotal);
            $('#total_sales_value').on('input', calculateDirectCostTotalSum);
            $('#project_cost,#margin_profit_value,#direct_cost').on('input', calculateNetProfitTotal);
            $('#project_cost,#chimney_recommended_price').on('input', calculateMarginPercent);
            $('#net_profit,#chimney_recommended_price').on('input', calculateMarginPercent);
            $('#margin_profit_value,#cap_value').on('input', calculateRecommededVal);
            $('#chimney_recommended_price,#bricks_value').on('input', calculateChimneyPriceVal);

            calculateMultiplyValues();
            calculateMultiplySumValues();
            calculateMultiplyDumsterPermitValues();
            calculateSumProjectCost();
            calculateMarginProfit();
            calculateSalesTotal();
            calculateDirectCostTotalSum();
            calculateNetProfitTotal();
            calculateMarginPercent();
            calculateNetProfitPercent();
            calculateRecommededVal();
            calculateChimneyPriceVal();
        });
        $(document).ready(function(){
            storeData();
        $(document).on('keyup', '.form-control', function() {
            storeData();
        });
        function storeData() {
            var formData = $('#store_chimney_estimate_calculator_chimney').serialize();
            $.ajax({
                url: '{{ route("store_chimney_estimate_calculator_chimney") }}',
                type: 'POST',
                data: formData,
                success: function (response) {
                    console.log(response);
                },
                error: function (xhr) {
                    console.error(xhr);
                }
            });
        }
        });
        // }
        // });
    </script>
{{--@endpush--}}