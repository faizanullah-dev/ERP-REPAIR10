{{--@extends('layouts.master')--}}
{{--@push('css')--}}
{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">--}}

{{--    <style>--}}
{{--        .table-custom th, .table-custom td {--}}
{{--            text-align: center;--}}
{{--            vertical-align: middle;--}}
{{--        }--}}
{{--        .highlight-yellow {--}}
{{--            background-color: #FFEB3B;--}}
{{--        }--}}
{{--        .highlight-blue {--}}
{{--            background-color: #BBDEFB;--}}
{{--        }--}}
{{--        .highlight-red {--}}
{{--            background-color: #FFCDD2;--}}
{{--        }--}}
{{--    </style>--}}

{{--@endpush--}}
{{--@section('content')--}}
    <section class="white-box">
    <div class="container-fluid">
        <form action="" class="row" method="post" id="store_chimney_estimate_calculator_liner">
            @csrf
            <input type="hidden" name="chimney_estimate_calculator_id" value="{{$chimneyEstimateCalculator->id??''}}">
{{--            @if(isset($lead->chimneyEstimateCalculator) && $lead->chimneyEstimateCalculator)--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="table_top_btn">--}}
{{--                        <a href="{{ url('product_pricing_calculator/' . $lead->productPricingEstimateCalculator->lead_id) }}" class="btn btn_green">Measurement</a>--}}
{{--                        <a href="{{url('chimney_estimation_calculator/' . $lead->chimneyEstimateCalculator->lead_id) }}" class="btn btn_green">Measurement</a>--}}
{{--                        <a href="{{url('chimney_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->chimneyEstimateCalculator->id}}/chimney" class="btn btn_green">Chimney ({{ $lead->chimneyEstimateCalculator->storeChimney->recommended_price??'0' }} )</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endif--}}
            <div class="col-md-6">
                <table class="table table-bordered table-custom">
                    <thead>
                    <div class="col-md-12">
                        <h3>Chimney Estimation Calculator (Liner)</h3>
                    </div>
                    <tr>
                        <th colspan="3">Recommended Price</th>
                        <td class="highlight">
                            <input  class="form-control only-numbers" type="text" name="recommended_price" id="liner_recommended_price" value="0" readonly>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <input class="form-control only-numbers" type="text" name="home_style" id="colonial" value="{{ ucfirst($chimneyHomeStyle??"") }}" readonly>
                        </td>
                        <td>
                            <input class="form-control only-numbers" type="text" min="0" name="home_style_value" id="colonial_value" value="0" readonly>
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
                            <input class="form-control only-numbers" type="text" min="0" name="total_value" id="total_value" value="0" readonly>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Miscellaneous</td>
                        <td>
                            <input  class="form-control only-numbers" placeholder="Type Here..." value="{{ $lead->chimneyEstimateCalculator->storeLiner->miscellaneous??"0" }}" type="text" name="miscellaneous" id="liner_miscellaneous" @if(!auth()->user()->can('edit-chimneyestimatecalculator')) readonly @endif>
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
                            <input  class="form-control only-numbers" min="0" type="text" name="material" id="material" value="{{$lead->chimneyEstimateCalculator->storeLiner->material??$chimneyDataLiner['material']??'1'}}" @if(!auth()->user()->can('edit-chimneyestimatecalculator')) readonly @endif>

                        </td>
                        <td>
                            <input  class="form-control only-numbers" min="0" type="text" name="total_material_value" id="liner_material_value" value="{{$lead->chimneyEstimateCalculator->storeLiner->total_material_value??'1'}}" readonly>
                        </td>
                    </tr>

                    <tr>
                        <td>Labor</td>
                        <td></td>
                        <td>
                            <input  class="form-control only-numbers" min="0" type="text" name="labor" id="labor" value="{{$lead->chimneyEstimateCalculator->storeLiner->labor??$chimneyDataLiner['labor']??'1'}}" @if(!auth()->user()->can('edit-chimneyestimatecalculator')) readonly @endif>

                        </td>
                        <td>
                            <input  class="form-control only-numbers" min="0" type="text" name="total_labor_value" id="liner_labor_value" value="{{$lead->chimneyEstimateCalculator->storeLiner->total_labor_value??'0'}}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Permit %</td>
                        <td></td>
                        <td>
                            <input  class="form-control only-numbers" min="0" type="text" name="permit_warranty" id="permit" value="{{$lead->chimneyEstimateCalculator->storeLiner->permit_warranty??$chimneyDataLiner['permit_warranty']??'0'}}" @if(!auth()->user()->can('edit-chimneyestimatecalculator')) readonly @endif>

                        </td>
                        <td>
                            <input  class="form-control only-numbers" min="0" type="text" name="total_permit_warranty_value" id="permit_value" value="{{$lead->chimneyEstimateCalculator->storeLiner->total_permit_warranty_value??'0'}}" readonly>
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
                            <input  class="form-control only-numbers" min="0" type="text" name="project_cost" id="liner_project_cost" value="0" readonly>
                        </td>
                    </tr>


                    <tr>
                        <td>Margin Profit</td>
                        <td></td>
                        <td></td>
                        <td>
                            <input  class="form-control only-numbers" min="0" type="text" name="margin_profit" id="margin_profit" value="0" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Sales %</td>
                        <td>
                            <input  class="form-control only-numbers" min="0" type="text" name="sales" id="sales_percentage" value="{{$lead->chimneyEstimateCalculator->storeLiner->sales??$chimneyDataLiner['sales']??'0'}}" @if(!auth()->user()->can('edit-chimneyestimatecalculator')) readonly @endif>
                        </td>
                        <td></td>
                        <td>
                            <input  class="form-control only-numbers" min="0" type="text" name="total_sales_value" id="sales_total" value="0" readonly>
                        </td>
                    </tr>
                    <tr class="highlight-red">
                        <td>Direct Cost</td>
                        <td></td>
                        <td></td>
                        <td>
                            <input  class="form-control only-numbers" min="0" type="text" name="direct_cost" id="liner_direct_cost" value="0" readonly>
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
                            <input  class="form-control only-numbers" min="0" type="text" name="net_profit" id="liner_net_profit" value="0" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Margin %</td>
                        <td></td>
                        <td></td>
                        <td>
                            <input  class="form-control only-numbers" min="0" type="text" name="margin_percent" id="margin_percentage" value="0" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Net Profit %</td>
                        <td></td>
                        <td></td>
                        <td>
                            <input  class="form-control only-numbers" min="0" type="text" name="net_profit_percent" id="liner_net_profit_percentage" value="0" readonly>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    </section>
{{--@endsection--}}
{{--@push('js')--}}
    <script>
        $(document).ready(function() {
            function calculateTotalMaterialVal() {
                var totalVal = parseFloat($('#total_value').val()) || 0;
                var materialVal = parseFloat($('#material').val()) || 0;
                var laborVal = parseFloat($('#labor').val()) || 0;
                var ValAnsMaterial = totalVal * materialVal;
                var ValAnsLabor = totalVal * laborVal;
                $('#liner_material_value').val(ValAnsMaterial.toFixed(2));
                $('#liner_labor_value').val(ValAnsLabor.toFixed(2));
            }
            showRanchData();
            showTotalAns();
            function calculateTotalPermitPercent() {
                var laborPercentVal = parseFloat($('#liner_labor_value').val()) || 0;
                var permitPercentVal = parseFloat($('#permit').val()) || 0;
                var percentVal = (laborPercentVal * permitPercentVal) / 100;
                $('#permit_value').val(percentVal.toFixed(2));
            }
            showRanchData();
            showTotalAns();
            function calculateTotalSumProjectCost() {
                var Val1 = parseFloat($('#liner_material_value').val()) || 0;
                var Val2 = parseFloat($('#liner_labor_value').val()) || 0;
                var Val3 = parseFloat($('#permit_value').val()) || 0;
                var liner_miscellaneous = parseFloat($('#liner_miscellaneous').val()) || 0;
                var ValAns = Val1 + Val2 + Val3 + liner_miscellaneous;
                $('#liner_project_cost').val(ValAns.toFixed(2));
            }
            function calculateMarginCostval() {
                var projectCostVal = parseFloat($('#liner_project_cost').val()) || 0;
                var totalMarginVal = (projectCostVal / ({{$chimneyDataLiner['margin_profit']??1}} / 100));
                $('#margin_profit').val(totalMarginVal.toFixed(2));
            }
            function calculateSalesval() {
                var marginVal = parseFloat($('#margin_profit').val()) || 0;
                var salesVal = parseFloat($('#sales_percentage').val()) || 0;
                var salesValtotal = (marginVal * salesVal) / 100;
                $('#sales_total').val(salesValtotal.toFixed(2));
            }
            function calculateDirectCostSum() {
                var saleVal = parseFloat($('#sales_total').val()) || 0;
                var saleTotal = saleVal;
                $('#liner_direct_cost').val(saleTotal.toFixed(2));
            }
            function showRecommendedPrice() {
                var marginVal = parseFloat($('#margin_profit').val()) || 0;
                var val = marginVal;
                $('#liner_recommended_price').val(val.toFixed(2));
                $('#liner_recommended_price_global').text(val.toFixed(2));
            }
            function calculateNetProfitSum() {
                var ValSum1 = parseFloat($('#liner_direct_cost').val()) || 0;
                var ValSum2 = parseFloat($('#margin_profit').val()) || 0;
                var ValSum3 = parseFloat($('#liner_project_cost').val()) || 0;
                var sumTotal = ValSum2 - ValSum3 - ValSum1;
                $('#liner_net_profit').val(sumTotal.toFixed(2));
            }
            function calculateMarginPercent() {
                var Valpercent1 = parseFloat($('#liner_recommended_price').val()) || 0;
                var Valpercent2 = parseFloat($('#liner_project_cost').val()) || 0;

                if (Valpercent1 === 0) {
                    $('#margin_percentage').val('40');
                } else {
                    var percentTotal = ((Valpercent1 - Valpercent2) / Valpercent1) * 100;
                    $('#margin_percentage').val(Math.round(percentTotal));
                }
            }
            function calculateNetProfitPercent() {
                var Vallpercent1 = parseFloat($('#liner_recommended_price').val()) || 0;
                var Vallpercent2 = parseFloat($('#liner_net_profit').val()) || 0;
                var percentTotal = (Vallpercent2/Vallpercent1) * 100;
                $('#liner_net_profit_percentage').val(Math.round(percentTotal));
            }
            function showTotalAns() {
                var showans1 = parseFloat($('#colonial_value').val()) || 0;

                $('#total_value').val(showans1);
            }
            function showRanchData() {
                var dataAnswer = $('#colonial').val().trim();

                if (dataAnswer === "Ranch") {
                    $('#colonial_value').val('20');
                } else if (dataAnswer === "Cape") {
                    $('#colonial_value').val('28');
                } else if (dataAnswer === "Colonial") {
                    $('#colonial_value').val('34');
                } else if (dataAnswer === "Victorian") {
                    $('#colonial_value').val('40');
                } else {
                    $('#colonial_value').val(dataAnswer);
                }
            }

            $('#total_value, #material,#labor').on('input', calculateTotalMaterialVal);
            $('#liner_labor_value, #permit').on('input', calculateTotalPermitPercent);
            $('#liner_material_value, #liner_labor_value,#permit_value').on('input', calculateTotalSumProjectCost);
            $('#liner_project_cost').on('input', calculateMarginCostval);
            $('#margin_profit').on('input', showRecommendedPrice);
            $('#margin_profit,#sales_percentage').on('input', calculateSalesval);
            $('#sales_total').on('input', calculateDirectCostSum);
            $('#liner_direct_cost,#margin_profit,#liner_project_cost').on('input', calculateNetProfitSum);
            $('#liner_recommended_price,#liner_project_cost').on('input', calculateMarginPercent);
            $('#liner_recommended_price,#liner_net_profit').on('input', calculateNetProfitPercent);
            $('#colonial').on('input', showRanchData);
            $('#colonial_value').on('input', showTotalAns);

            $('input').on('input', function() {
                calculateTotalMaterialVal();
                calculateTotalPermitPercent();
                calculateTotalSumProjectCost();
                calculateMarginCostval();
                calculateSalesval();
                calculateDirectCostSum();
                calculateNetProfitSum();
                calculateMarginPercent();
                calculateNetProfitPercent();
                showRecommendedPrice();
                showRanchData();
                showTotalAns();

            });

            calculateTotalMaterialVal();
            calculateTotalPermitPercent();
            calculateTotalSumProjectCost();
            calculateMarginCostval();
            calculateSalesval();
            calculateDirectCostSum();
            calculateNetProfitSum();
            calculateMarginPercent();
            showRecommendedPrice();
            calculateNetProfitPercent();
            showRanchData();
            showTotalAns();
        });
        $(document).ready(function () {
            updateChimneyLiner();
            $(document).on('keyup', '.form-control', function () {
                updateChimneyLiner();
            });
            function updateChimneyLiner() {
                var formData = $('#store_chimney_estimate_calculator_liner').serialize();
                $.ajax({
                    url: '{{ route("store_chimney_estimate_calculator_liner") }}',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        console.log("Page Loaded / Keyup Triggered:", response);
                    },
                    error: function (xhr) {
                        console.error("Error:", xhr);
                    }
                });
            }
        // });
        });
    </script>
{{--@endpush--}}