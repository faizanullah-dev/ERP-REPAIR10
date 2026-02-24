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
        <form action="{{route('store_roof_estimate_calculator_gutters')}}" class="row" method="post" id="store_roof_estimate_calculator_gutters">
            @csrf
            <input type="hidden" name="roof_estimate_calculator_id" value="{{$roofEstimateCalculator->id}}">
{{--            @if(isset($lead->roofEstimateCalculator) && $lead->roofEstimateCalculator)--}}
{{--                <div class="col-md-10">--}}
{{--                    <div class="table_top_btn">--}}
{{--                        <a href="{{url('roof_estimation_calculator/' . $lead->roofEstimateCalculator->lead_id) }}" class="btn btn_green">Measurement</a>--}}
{{--                        <a href="{{url('roof_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->roofEstimateCalculator->id}}/preferred" class="btn btn_green">Preferred  ( {{@$lead->roofEstimateCalculator->roofEstimateCalculatorpreferred->recommended_price??'0'}} ) </a>--}}
{{--                        <a href="{{url('roof_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->roofEstimateCalculator->id}}/system" class="btn btn_green">System  ( {{@$lead->roofEstimateCalculator->roofEstimateCalculatorSystem->recommended_price??'0'}} )</a>--}}
{{--                        <a href="{{url('roof_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->roofEstimateCalculator->id}}/under_fifteen_sq" class="btn btn_green">Under 15 SQ  ( {{@$lead->roofEstimateCalculator->roofEstimateCalculatorUnderFifteen->recommended_price??'0'}} )</a>--}}
{{--                        <a href="{{url('roof_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->roofEstimateCalculator->id}}/flat_roof" class="btn btn_green">Flat Roof  ( {{@$lead->roofEstimateCalculator->roofEstimateCalculatorFlatRoof->recommended_price??'0'}} )</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-2">--}}
{{--                    <a class="btn btn-success pull-right" href="{{ url('roof_estimation_calculator/' . $lead->id) }}">--}}
{{--                        <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            @endif--}}
            <div class="col-md-6">
                <table class="table table-bordered table-custom">
                    <thead>
                    <tr>
                        <th colspan="3">Recommended Price</th>
                        <td class="highlight">
                            <input  class="form-control only-numbers" type="text" name="recommended_price"  id="gutter_recommended_price" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->recommended_price??"0"}}" readonly>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Gutters</td>
                        <td>
                            <input  class="form-control only-numbers" type="text" name="gutter_sub_total" id="gutter_sub_total" value="{{$roofEstimateCalculator->gutter_sub_total??'0'}}" readonly>
                        </td>
                        <td>
                            <input  class="form-control only-numbers" type="text" min="0" name="gutter_per_sq_price" id="gutter_per_sq_price" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->gutter_per_sq_price??$roofDataGutter['gutter_per_sq_price']??'1'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                        </td>
                        <td>
                            <input readonly class="form-control only-numbers" type="text" min="0" name="gutter_sq_total_price" id="gutter_sq_total_price" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->gutter_sq_total_price??'0'}}">
                        </td>
                    </tr>
                    <tr>
                        <td>Downspouts</td>
                        <td>
                            <input class="form-control only-numbers" type="text" name="downspouts_sub_total" id="gutter_downspouts_sub_total" value="{{$roofEstimateCalculator->downspout_sub_total??'0'}}" readonly>
                        </td>
                        <td>
                            <input class="form-control only-numbers" type="text" min="0" name="downspouts_per_sq_price" id="gutter_downspouts_per_sq_price" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->downspouts_per_sq_price??$roofDataGutter['downspouts_per_sq_price']??'1'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                        </td>
                        <td>
                            <input readonly class="form-control only-numbers" type="text" min="0" name="downspouts_sq_total_price" id="gutter_downspouts_sq_total_price" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->downspouts_sq_total_price??'0'}}">
                        </td>
                    </tr>
                    <tr>
                        <td>Gutter Guards</td>
                        <td>
                            <input class="form-control only-numbers" type="text" name="guards_sub_total" id="gutter_guards_sub_total" value="{{$roofEstimateCalculator->guards_sub_total??'0'}}" readonly>
                        </td>
                        <td>
                            <input class="form-control only-numbers" type="text" min="0" name="guards_per_sq_price" id="gutter_guards_per_sq_price" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->guards_per_sq_price??$roofDataGutter['guards_per_sq_price']??'1'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                        </td>
                        <td>
                            <input readonly class="form-control only-numbers" type="text" min="0" name="guards_sq_total_price" id="gutter_guards_sq_total_price" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->guards_sq_total_price??'0'}}">
                        </td>
                    </tr>
                    <tr>
                        <td>Miscellaneous</td>
                        <td></td>
                        <td></td>
                        <td>
                            <input  class="form-control only-numbers" placeholder="Type Here..." type="text" name="gutter_miscellaneous" id="gutter_miscellaneous" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->gutter_miscellaneous??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
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
                            <input  class="form-control only-numbers" min="0" type="text" name="project_cost" id="gutter_project_cost" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->project_cost??'0'}}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Margin Profit</td>
                        <td></td>
                        <td></td>
                        <td>
                            <input  class="form-control only-numbers" min="0" type="text" name="margin_profit" id="gutter_margin_profit" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->margin_profit??'0'}}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Super (%)</td>
                        <td>
                            <input  class="form-control only-numbers" min="0" type="text" name="super_percentage" id="gutter_super_percentage" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->super_percentage??$roofDataGutter['super_percentage']??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                        </td>
                        <td></td>
                        <td>
                            <input readonly class="form-control only-numbers" min="0" type="text" name="super_total" id="gutter_super_total" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->super_total??'0'}}">
                        </td>
                    </tr>
                    <tr>
                        <td>Sales (%)</td>
                        <td>
                            <input  class="form-control only-numbers" min="0" type="text" name="sales_percentage" id="gutter_sales_percentage" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->sales_percentage??$roofDataGutter['sales_percentage']??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                        </td>
                        <td></td>
                        <td>
                            <input readonly class="form-control only-numbers" min="0" type="text" name="sales_total" id="gutter_sales_total" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->sales_total??'0'}}">
                        </td>
                    </tr>
                    <tr class="highlight-red">
                        <td>Direct Cost</td>
                        <td></td>
                        <td></td>
                        <td>
                            <input readonly  class="form-control only-numbers" min="0" type="text" name="direct_cost" id="gutter_direct_cost" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->direct_cost??'0'}}">
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
                            <input readonly class="form-control only-numbers" min="0" type="text" name="net_profit" id="gutter_net_profit" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->net_profit??'0'}}">
                        </td>
                    </tr>
                    <tr>
                        <td>Margin %</td>
                        <td></td>
                        <td></td>
                        <td>
                            <input readonly class="form-control only-numbers" min="0" type="text" name="margin_percentage" id="gutter_margin_percentage" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->margin_percentage??'0'}}">
                        </td>
                    </tr>
                    <tr>
                        <td>Net Profit %</td>
                        <td></td>
                        <td></td>
                        <td>
                            <input readonly class="form-control only-numbers" min="0" type="text" name="net_profit_percentage" id="gutter_net_profit_percentage" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->net_profit_percentage??'0'}}">
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
                            <input  class="form-control only-numbers" type="text" name="recommended_price_two" id="gutter_recommended_price2" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->recommended_price_two??'0'}}" readonly>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Gutters</td>
                        <td>
                            <input class="form-control only-numbers" type="text" name="gutter_sub_total_two" id="gutter_sub_total2" value="{{$roofEstimateCalculator->gutter_sub_total}}" readonly>
                        </td>
                        <td>
                            <input class="form-control only-numbers" type="text" min="0" name="gutter_per_sq_price_two" id="gutter_per_sq_price2" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->gutter_per_sq_price_two??$roofDataGutter['gutter_per_sq_price_two']??'1'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                        </td>
                        <td>
                            <input readonly class="form-control only-numbers" type="text" min="0" name="gutter_sq_total_price_two" id="gutter_sq_total_price2" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->gutter_sq_total_price_two??'0'}}">
                        </td>
                    </tr>
                    <tr>
                        <td>Downspouts</td>
                        <td>
                            <input class="form-control only-numbers" type="text" name="downspouts_sub_total_two" id="gutter_downspouts_sub_total2" value="{{$roofEstimateCalculator->downspout_sub_total}}" readonly>
                        </td>
                        <td>
                            <input class="form-control only-numbers" type="text" min="0" name="downspouts_per_sq_price_two" id="gutter_downspouts_per_sq_price2" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->downspouts_per_sq_price_two??$roofDataGutter['downspouts_per_sq_price_two']??'1'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                        </td>
                        <td>
                            <input readonly class="form-control only-numbers" type="text" min="0" name="downspouts_sq_total_price_two" id="gutter_downspouts_sq_total_price2" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->downspouts_sq_total_price_two??'0'}}">
                        </td>
                    </tr>
                    <tr>
                        <td>Gutter Guards</td>
                        <td>
                            <input class="form-control only-numbers" type="text" name="guards_sub_total_two" id="gutter_guards_sub_total2" value="{{$roofEstimateCalculator->guards_sub_total}}" readonly>
                        </td>
                        <td>
                            <input class="form-control only-numbers" type="text" min="0" name="guards_per_sq_price_two" id="gutter_guards_per_sq_price2" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->guards_per_sq_price_two??$roofDataGutter['guards_per_sq_price_two']??'1'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                        </td>
                        <td>
                            <input readonly class="form-control only-numbers" type="text" min="0" name="guards_sq_total_price_two" id="gutter_guards_sq_total_price2" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->guards_sq_total_price_two??'0'}}" >
                        </td>
                    </tr>
                    <tr>
                        <td>Miscellaneous</td>
                        <td></td>
                        <td></td>
                        <td>
                            <input  class="form-control only-numbers" placeholder="Type Here..." type="text" name="gutter_miscellaneous_two" id="gutter_miscellaneous_two" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->gutter_miscellaneous_two??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
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
                            <input readonly class="form-control only-numbers" min="0" type="text" name="project_cost_two" id="gutter_project_cost2" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->project_cost_two??'0'}}">
                        </td>
                    </tr>
                    <tr>
                        <td>Margin Profit</td>
                        <td></td>
                        <td></td>
                        <td>
                            <input  class="form-control only-numbers" min="0" type="text" name="margin_profit_two" id="gutter_margin_profit2" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->margin_profit_two??'0'}}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Super (%)</td>
                        <td>
                            <input  class="form-control only-numbers" min="0" type="text" name="super_percentage_two" id="gutter_super_percentage2" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->super_percentage_two??$roofDataGutter['super_percentage_two']??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                        </td>
                        <td></td>
                        <td>
                            <input readonly class="form-control only-numbers" min="0" type="text" name="super_total_two" id="gutter_super_total2" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->super_total_two??'0'}}">
                        </td>
                    </tr>
                    <tr>
                        <td>Sales (%)</td>
                        <td>
                            <input  class="form-control only-numbers" min="0" type="text" name="sales_percentage_two" id="gutter_sales_percentage2" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->sales_percentage_two??$roofDataGutter['sales_percentage_two']??'0'}}" @if(!auth()->user()->can('edit-roofestimatecalculator')) readonly @endif>
                        </td>
                        <td></td>
                        <td>
                            <input readonly class="form-control only-numbers" min="0" type="text" name="sales_total_two" id="gutter_sales_total2" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->sales_total_two??'0'}}">
                        </td>
                    </tr>
                    <tr class="highlight-red">
                        <td>Direct Cost</td>
                        <td></td>
                        <td></td>
                        <td>
                            <input readonly class="form-control only-numbers" min="0" type="text" name="direct_cost_two" id="gutter_direct_cost2" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->direct_cost_two??'0'}}">
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
                            <input  readonly class="form-control only-numbers" min="0" type="text" name="net_profit_two" id="gutter_net_profit2" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->net_profit_two??'0'}}">
                        </td>
                    </tr>
                    <tr>
                        <td>Margin %</td>
                        <td></td>
                        <td></td>
                        <td>
                            <input readonly class="form-control only-numbers" min="0" type="text" name="margin_percentage_two" id="gutter_margin_percentage2" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->margin_percentage_two??'0'}}">
                        </td>
                    </tr>
                    <tr>
                        <td>Net Profit %</td>
                        <td></td>
                        <td></td>
                        <td>
                            <input readonly class="form-control only-numbers" min="0" type="text" name="net_profit_percentage_two" id="gutter_net_profit_percentage2" value="{{$roofEstimateCalculator->storeRoofEstimateCalculatorGutter->net_profit_percentage_two??'0'}}">
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
            @php
                $roofDataGutter = json_decode($roofBaseValuesGutter->roof_gutter, true);
            @endphp
            roundToTwo();
            calculateTotal();
            calculateProjectCost();
            calculateSuperTotal();
            calculateDirectCost();
            calculateNetProfit();
            calculateMarginPercentage();
            calculateNetProfitPercentage();
            handleInputChange();
            handleSuperPercentageChange();

            $(document).on('input', '#gutter_miscellaneous', function () {
                roundToTwo();
                calculateTotal();
                calculateProjectCost();
                calculateSuperTotal();
                calculateDirectCost();
                calculateNetProfit();
                calculateMarginPercentage();
                calculateNetProfitPercentage();
                handleInputChange();
                handleSuperPercentageChange();
            });

            function roundToTwo(num) {
                return Math.round((num + Number.EPSILON) * 100) / 100 || 0;
            }

            function calculateTotal(subTotalId, pricePerSqId, totalPriceId) {
                var subTotal = parseFloat($(subTotalId).val()) || 0;
                var pricePerSq = parseFloat($(pricePerSqId).val()) || 0;
                var totalPrice = subTotal * pricePerSq;
                $(totalPriceId).val(roundToTwo(totalPrice).toFixed(2));
            }

            function calculateProjectCost() {
                var gutterTotal = parseFloat($('#gutter_sq_total_price').val()) || 0;
                var downspoutsTotal = parseFloat($('#gutter_downspouts_sq_total_price').val()) || 0;
                var guardsTotal = parseFloat($('#gutter_guards_sq_total_price').val()) || 0;
                var gutter_miscellaneous = parseFloat($('#gutter_miscellaneous').val()) || 0;
                var projectCost = gutterTotal + downspoutsTotal + guardsTotal + gutter_miscellaneous;
                $('#gutter_project_cost').val(roundToTwo(projectCost).toFixed(2));
                var marginProfit = (projectCost / ({{$roofDataGutter['margin_profit']??1}} / 100));
                $('#gutter_margin_profit').val(roundToTwo(marginProfit).toFixed(2));
                $('#gutter_recommended_price').val(roundToTwo(marginProfit).toFixed(2));
                $('#gutter_recommended_price_global').text(roundToTwo(marginProfit).toFixed(2));
                calculateSuperTotal(marginProfit);
            }

            function calculateSuperTotal(marginProfit) {
                var superPercentage = parseFloat($('#gutter_super_percentage').val()) || 0;
                var superTotal = marginProfit * (superPercentage / 100);
                var salesPercentage = parseFloat($('#gutter_sales_percentage').val()) || 0;
                var salesTotal = marginProfit * (salesPercentage / 100);

                $('#gutter_super_total').val(roundToTwo(superTotal).toFixed(2));
                $('#gutter_sales_total').val(roundToTwo(salesTotal).toFixed(2));
                calculateDirectCost(superTotal, salesTotal);
            }

            function calculateDirectCost(superTotal, salesTotal) {
                var directCost = superTotal + salesTotal;
                $('#gutter_direct_cost').val(roundToTwo(directCost).toFixed(2));
                calculateNetProfit();
            }

            function calculateNetProfit() {
                var marginProfit = parseFloat($('#gutter_margin_profit').val()) || 0;
                var projectCost = parseFloat($('#gutter_project_cost').val()) || 0;
                var directCost = parseFloat($('#gutter_direct_cost').val()) || 0;
                var netProfit = marginProfit - projectCost - directCost;
                $('#gutter_net_profit').val(roundToTwo(netProfit).toFixed(2));
                calculateMarginPercentage(marginProfit, projectCost);
                calculateNetProfitPercentage(netProfit, marginProfit);
            }

            function calculateMarginPercentage(marginProfit, projectCost) {
                var marginPercentage = ((marginProfit - projectCost) / marginProfit) * 100;
                $('#gutter_margin_percentage').val(roundToTwo(marginPercentage).toFixed(2));
            }

            function calculateNetProfitPercentage(netProfit, marginProfit) {
                var netProfitPercentage = (netProfit / marginProfit) * 100;
                $('#gutter_net_profit_percentage').val(roundToTwo(netProfitPercentage).toFixed(2));
            }

            function handleInputChange() {
                calculateTotal('#gutter_sub_total', '#gutter_per_sq_price', '#gutter_sq_total_price');
                calculateTotal('#gutter_downspouts_sub_total', '#gutter_downspouts_per_sq_price', '#gutter_downspouts_sq_total_price');
                calculateTotal('#gutter_guards_sub_total', '#gutter_guards_per_sq_price', '#gutter_guards_sq_total_price');
                calculateProjectCost();
            }

            function handleSuperPercentageChange() {
                var marginProfit = parseFloat($('#gutter_margin_profit').val()) || 0;
                calculateSuperTotal(marginProfit);
            }
            $('#gutter_sub_total, #gutter_per_sq_price').on('input', handleInputChange);
            $('#gutter_downspouts_per_sq_price').on('input', handleInputChange);
            $('#gutter_guards_per_sq_price').on('input', handleInputChange);
            $('#gutter_super_percentage').on('input', handleSuperPercentageChange);
            $('#gutter_sales_percentage').on('input', handleSuperPercentageChange);
            handleInputChange();
        });

        $(document).ready(function() {
            roundToTwo();
            calculateTotal2();
            calculateProjectCost2();
            calculateSuperTotal2();
            calculateDirectCost2();
            calculateNetProfit2();
            calculateMarginPercentage2();
            calculateNetProfitPercentage2();
            handleInputChange2();

            $(document).on('input', '#gutter_miscellaneous_two', function () {
                roundToTwo();
                calculateTotal2();
                calculateProjectCost2();
                calculateSuperTotal2();
                calculateDirectCost2();
                calculateNetProfit2();
                calculateMarginPercentage2();
                calculateNetProfitPercentage2();
                handleInputChange2();
                handleSuperPercentageChange2();
            });

            function roundToTwo(num) {
                return Math.round((num + Number.EPSILON) * 100) / 100 || 0;
            }
            function calculateTotal2(subTotalId2, pricePerSqId2, totalPriceId2) {
                var subTotal2 = parseFloat($(subTotalId2).val()) || 0;
                var pricePerSq2 = parseFloat($(pricePerSqId2).val()) || 0;
                var totalPrice2 = subTotal2 * pricePerSq2;
                $(totalPriceId2).val(roundToTwo(totalPrice2).toFixed(2));
            }

            function calculateProjectCost2() {
                var gutterTotal2 = parseFloat($('#gutter_sq_total_price2').val()) || 0;
                var downspoutsTotal2 = parseFloat($('#gutter_downspouts_sq_total_price2').val()) || 0;
                var guardsTotal2 = parseFloat($('#gutter_guards_sq_total_price2').val()) || 0;
                var gutter_miscellaneous_two = parseFloat($('#gutter_miscellaneous_two').val()) || 0;
                var projectCost2 = gutterTotal2 + downspoutsTotal2 + guardsTotal2 + gutter_miscellaneous_two;
                $('#gutter_project_cost2').val(roundToTwo(projectCost2).toFixed(2));
                var marginProfit2 = (projectCost2 / ({{$roofDataGutter['margin_profit_two']??1}} / 100));
                $('#gutter_margin_profit2').val(roundToTwo(marginProfit2).toFixed(2));
                $('#gutter_recommended_price2').val(roundToTwo(marginProfit2).toFixed(2));
                $('#gutter_recommended_price2_global').text(roundToTwo(marginProfit2).toFixed(2));
                calculateSuperTotal2(marginProfit2);
            }

            function calculateSuperTotal2(marginProfit2) {
                var superPercentage2 = parseFloat($('#gutter_super_percentage2').val()) || 0;
                var superTotal2 = marginProfit2 * (superPercentage2 / 100) || 0;
                var salesPercentage2 = parseFloat($('#gutter_sales_percentage2').val()) || 0;
                var salesTotal2 = marginProfit2 * (salesPercentage2 / 100);

                $('#gutter_super_total2').val(roundToTwo(superTotal2).toFixed(2));
                $('#gutter_sales_total2').val(roundToTwo(salesTotal2).toFixed(2));
                calculateDirectCost2(superTotal2, salesTotal2);
            }

            function calculateDirectCost2(superTotal2, salesTotal2) {
                var directCost2 = superTotal2 + salesTotal2;
                $('#gutter_direct_cost2').val(roundToTwo(directCost2).toFixed(2));
                calculateNetProfit2();
            }

            function calculateNetProfit2() {
                var marginProfit2 = parseFloat($('#gutter_margin_profit2').val()) || 0;
                var projectCost2 = parseFloat($('#gutter_project_cost2').val()) || 0;
                var directCost2 = parseFloat($('#gutter_direct_cost2').val()) || 0;
                var netProfit2 = marginProfit2 - projectCost2 - directCost2;
                $('#gutter_net_profit2').val(roundToTwo(netProfit2).toFixed(2));
                calculateMarginPercentage2(marginProfit2, projectCost2);
                calculateNetProfitPercentage2(netProfit2, marginProfit2);
            }

            function calculateMarginPercentage2(marginProfit2, projectCost2) {
                var marginPercentage2 = ((marginProfit2 - projectCost2) / marginProfit2) * 100 || 0;
                $('#gutter_margin_percentage2').val(roundToTwo(marginPercentage2).toFixed(2));
            }

            function calculateNetProfitPercentage2(netProfit2, marginProfit2) {
                var netProfitPercentage2 = (netProfit2 / marginProfit2) * 100 || 0;
                $('#gutter_net_profit_percentage2').val(roundToTwo(netProfitPercentage2).toFixed(2));
            }

            function handleInputChange2() {
                calculateTotal2('#gutter_sub_total2', '#gutter_per_sq_price2', '#gutter_sq_total_price2');
                calculateTotal2('#gutter_downspouts_sub_total2', '#gutter_downspouts_per_sq_price2', '#gutter_downspouts_sq_total_price2');
                calculateTotal2('#gutter_guards_sub_total2', '#gutter_guards_per_sq_price2', '#gutter_guards_sq_total_price2');
                calculateProjectCost2();
            }

            function handleSuperPercentageChange2() {
                var marginProfit2 = parseFloat($('#gutter_margin_profit2').val()) || 0;
                calculateSuperTotal2(marginProfit2);
            }

            $('#gutter_sub_total2, #gutter_per_sq_price2').on('input', handleInputChange2);
            $('#gutter_downspouts_per_sq_price2').on('input', handleInputChange2);
            $('#gutter_guards_per_sq_price2').on('input', handleInputChange2);
            $('#gutter_super_percentage2').on('input', handleSuperPercentageChange2);
            $('#gutter_sales_percentage2').on('input', handleSuperPercentageChange2);

            handleInputChange2();
        });

        // $(document).ready(function() {
        //     $('.only-numbers').on('keypress', function(event) {
        //         var charCode = (event.which) ? event.which : event.keyCode;
        //         if (charCode < 48 || charCode > 57) {
        //             event.preventDefault();
        //         }
        //     });
        //     $('.only-numbers').on('paste', function(event) {
        //         var pasteData = event.originalEvent.clipboardData.getData('text');
        //         if (!$.isNumeric(pasteData)) {
        //             event.preventDefault();
        //         }
        //     });
        // });
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

        $(document).ready(function() {
            storeData();
            $(document).on('keyup', '.form-control', function() {
                storeData();
            });
            function storeData() {
                var formData = $('#store_roof_estimate_calculator_gutters').serialize();
                $.ajax({
                    url: '{{ route("store_roof_estimate_calculator_gutters") }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log('Data submitted successfully:', response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', error);
                    }
                });
            }
        });

    </script>
{{--@endpush--}}
