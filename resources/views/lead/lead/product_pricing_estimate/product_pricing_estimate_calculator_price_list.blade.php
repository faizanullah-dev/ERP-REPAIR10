@extends('layouts.master')
@push('css')
    @section('content')
        <section class="white-box">
            <div class="container-fluid">
                @if(isset($lead->productPricingEstimateCalculator) && $lead->productPricingEstimateCalculator)
                    <div class="col-md-12">
                        <div class="table_top_btn">
                            <a href="{{ url('product_pricing_calculator/' . $lead->productPricingEstimateCalculator->lead_id) }}" class="btn btn_green">Measurement</a>
                            <a href="{{url('product_pricing_calculator_screen')}}/{{$lead->id}}/{{$lead->productPricingEstimateCalculator->id}}/material_list" class="btn btn_green">Material List</a>
                            <a href="{{url('product_pricing_calculator_screen')}}/{{$lead->id}}/{{$lead->productPricingEstimateCalculator->id}}/pdf_measurement" class="btn btn_green">PDF Measurement</a>
                            <a href="{{url('product_pricing_calculator_screen')}}/{{$lead->id}}/{{$lead->productPricingEstimateCalculator->id}}/pdf_material_list" class="btn btn_green">PDF Material List</a>

                        </div>
                    </div>
                @endif
                <div class="col-lg-12">
                    <form action="{{ route('store_product_pricing_calculator_price_list') }}" method="post">
                        @csrf
                        <input type="hidden" name="product_pricing_calculator_id" value="{{ $productPricingEstimateCalculator->id??'' }}">
                        <input type="hidden" name="product_pricing_price_list_id" value="{{ $productPriceList->id??'' }}">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>PRODUCT</th>
                                    <th>U/M</th>
                                    <th>QTY</th>
                                    <th>PRICE/UNIT</th>
                                    <th>EXT.PRICE</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Owens Corning Trudefinition Duration Estate Gray 3 Bundle Per Square</td>
                                    <td class="green">BD - Bundle</td>
{{--                                    <td class="green"><input class="form-control quantity" type="text" name="quantity[owens_corning][]" value="{{ $productPricingMaterialList->owens_corning_bundle??"" }}" readonly></td>--}}
                                    <td class="green"><input class="form-control quantity" type="text" name="quantity[owens_corning][]" value="{{ $productPricingMaterialList->where('name', 'owens_corning')->first()->quantity??"" }}" readonly></td>
                                    <td class="green"><input class="form-control price" type="text" name="price[owens_corning][]"  value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'owens_corning')->price ?? '' : '' }}" ></td>
                                    <td class="green"><input class="form-control ext_price" type="text" name="ext_price[owens_corning][]" value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'owens_corning')->ext_price ?? '' : '' }}" readonly ></td>
                                </tr>
                                <tr>
                                    <td>Owens Corning Proedge Hip & Ridge Algae Resistant Estate Gray 33 Linear Feet Per Bundle</td>
                                    <td class="green">BD - Bundle</td>
                                    <td class="green"><input class="form-control quantity" type="text" name="quantity[corning_proedge][]" value="{{ $productPricingMaterialList->where('name', 'corning_proedge')->first()->quantity??"" }}" readonly></td>
                                    <td class="green"><input class="form-control price" type="text" name="price[corning_proedge][]"  value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'corning_proedge')->price ?? '' : '' }}" ></td>
                                    <td class="green"><input class="form-control ext_price" type="text" name="ext_price[corning_proedge][]" value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'corning_proedge')->ext_price ?? '' : '' }}" readonly ></td>
                                </tr>
                                <tr>
                                    <td>Owens Corning Ventsure 15" X 4' Strip Weather Protector</td>
                                    <td class="green">PC</td>
                                    <td class="green"><input class="form-control quantity" type="text" name="quantity[corning_ventsure][]" value="{{ $productPricingMaterialList->where('name', 'corning_ventsure')->first()->quantity??"" }}" readonly></td>
                                    <td class="green"><input class="form-control price" type="text" name="price[corning_ventsure][]"  value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'corning_ventsure')->price ?? '' : '' }}" ></td>
                                    <td class="green"><input class="form-control ext_price" type="text" name="ext_price[corning_ventsure][]" value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'corning_ventsure')->ext_price ?? '' : '' }}" readonly ></td>
                                </tr>
                                <tr>
                                    <td>Owens Corning Plus Starter Shingles</td>
                                    <td class="green">BD - Bundle</td>
                                    <td class="green"><input class="form-control quantity" type="text" name="quantity[corning_plus][]" value="{{ $productPricingMaterialList->where('name', 'corning_plus')->first()->quantity??"" }}" readonly></td>
                                    <td class="green"><input class="form-control price" type="text" name="price[corning_plus][]" value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'corning_plus')->price ?? '' : '' }}" ></td>
                                    <td class="green"><input class="form-control ext_price" type="text" name="ext_price[corning_plus][]" value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'corning_plus')->ext_price ?? '' : '' }}" readonly ></td>
                                </tr>
                                <tr>
                                    <td>Rhinoroof Granulated Self Adhered 2 Square Roll</td>
                                    <td class="green">RL-ROLL</td>
                                    <td class="green"><input class="form-control quantity" type="text" name="quantity[rhinoroof][]" value="{{ $productPricingMaterialList->where('name', 'rhinoroof')->first()->quantity??"" }}" readonly></td>
                                    <td class="green"><input class="form-control price" type="text" name="price[rhinoroof][]"  value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'rhinoroof')->price ?? '' : '' }}"></td>
                                    <td class="green"><input class="form-control ext_price" type="text" name="ext_price[rhinoroof][]" value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'rhinoroof')->ext_price ?? '' : '' }}" readonly ></td>
                                </tr>
                                <tr>
                                    <td>Mfm Roof Deck Tape 4"X67'</td>
                                    <td class="green">RL-ROLL</td>
                                    <td class="green"><input class="form-control quantity" type="text" name="quantity[mfm_roof][]" value="{{ $productPricingMaterialList->where('name', 'mfm_roof')->first()->quantity??"" }}" readonly></td>
                                    <td class="green"><input class="form-control price" type="text" name="price[mfm_roof][]"  value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'mfm_roof')->price ?? '' : '' }}" ></td>
                                    <td class="green"><input class="form-control ext_price" type="text" name="ext_price[mfm_roof][]"   value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'mfm_roof')->ext_price ?? '' : '' }}" readonly ></td>
                                </tr>
                                <tr>
                                    <td>Owens Corning Proarmor Synthetic Roof Underlayment 10 Square</td>
                                    <td class="green">RL-ROLL</td>
                                    <td class="green"><input class="form-control quantity" type="text" name="quantity[corning_proarmor][]" value="{{ $productPricingMaterialList->where('name', 'corning_proarmor')->first()->quantity??"" }}" readonly></td>
                                    <td class="green"><input class="form-control price" type="text" name="price[corning_proarmor][]"  value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'corning_proarmor')->price ?? '' : '' }}" ></td>
                                    <td class="green"><input class="form-control ext_price" type="text" name="ext_price[corning_proarmor][]"   value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'corning_proarmor')->ext_price ?? '' : '' }}" readonly ></td>
                                </tr>
                                <tr>
                                    <td>Coil Nail ABC 1-1/4"</td>
                                    <td class="green">BX-Box</td>
                                    <td class="green"><input class="form-control quantity" type="text" name="quantity[coil_nail][]" value="{{ $productPricingMaterialList->where('name', 'coil_nail')->first()->quantity??"" }}" readonly></td>
                                    <td class="green"><input class="form-control price" type="text" name="price[coil_nail][]"  value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'coil_nail')->price ?? '' : '' }}" ></td>
                                    <td class="green"><input class="form-control ext_price" type="text" name="ext_price[coil_nail][]"   value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'coil_nail')->ext_price ?? '' : '' }}" readonly ></td>
                                </tr>
                                <tr>
                                    <td>ACM Drip Edge F-8</td>
                                    <td class="green">PC-Piece</td>
                                    <td class="green"><input class="form-control quantity" type="text" name="quantity[acm_drip][]" value="{{ $productPricingMaterialList->where('name', 'acm_drip')->first()->quantity??"" }}" readonly></td>
                                    <td class="green"><input class="form-control price" type="text" name="price[acm_drip][]"  value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'acm_drip')->price ?? '' : '' }}" ></td>
                                    <td class="green"><input class="form-control ext_price" type="text" name="ext_price[acm_drip][]"   value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'acm_drip')->ext_price ?? '' : '' }}" readonly ></td>
                                </tr>
                                <tr>
                                    <td>Lifetime 3" Ultra Pipe Flashing #300</td>
                                    <td class="green">PC-Piece</td>
                                    <td class="green"><input class="form-control quantity" type="text" name="quantity[lifetime_ultra_pipe][]" value="{{ $productPricingMaterialList->where('name', 'lifetime_tool_pipe_two')->first()->quantity??"" }}" readonly></td>
                                    <td class="green"><input class="form-control price" type="text" name="price[lifetime_ultra_pipe][]" value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'lifetime_ultra_pipe')->price ?? '' : '' }}" ></td>
                                    <td class="green"><input class="form-control ext_price" type="text" name="ext_price[lifetime_ultra_pipe][]"   value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'lifetime_ultra_pipe')->ext_price ?? '' : '' }}" readonly ></td>
                                </tr>
                                <tr>
                                    <td>Lifetime Tool Pipe Flashing 200</td>
                                    <td class="green">PC-Piece</td>
                                    <td class="green"><input class="form-control quantity" type="text" name="quantity[lifetime_tool_pipe_two][]" value="{{ $productPricingMaterialList->where('name', 'lifetime_tool_pipe_two')->first()->quantity??"" }}" readonly></td>
                                    <td class="green"><input class="form-control price" type="text" name="price[lifetime_tool_pipe_two][]" value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'lifetime_tool_pipe_two')->price ?? '' : '' }}" ></td>
                                    <td class="green"><input class="form-control ext_price" type="text" name="ext_price[lifetime_tool_pipe_two][]"   value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'lifetime_tool_pipe_two')->ext_price ?? '' : '' }}" readonly ></td>
                                </tr>
                                <tr>
                                    <td>Lifetime Tool Pipe Flashing 150</td>
                                    <td class="green">PC-Piece</td>
                                    <td class="green"><input class="form-control quantity" type="text" name="quantity[lifetime_tool_pipe_one][]" value="{{ $productPricingMaterialList->where('name', 'lifetime_tool_pipe_two')->first()->quantity??"" }}" readonly></td>
                                    <td class="green"><input class="form-control price" type="text" name="price[lifetime_tool_pipe_one][]" value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'lifetime_tool_pipe_one')->price ?? '' : '' }}" ></td>
                                    <td class="green"><input class="form-control ext_price" type="text" name="ext_price[lifetime_tool_pipe_one][]"   value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'lifetime_tool_pipe_one')->ext_price ?? '' : '' }}" readonly ></td>
                                </tr>
                                <tr>
                                    <td>Lifetime Tool Bath Dryer Vent</td>
                                    <td class="green">PC-Piece</td>
                                    <td class="green"><input class="form-control quantity" type="text" name="quantity[lifetime_tool_bath][]" value="{{ $productPricingMaterialList->where('name', 'lifetime_tool_bath_dryer')->first()->quantity??"" }}" readonly></td>
                                    <td class="green"><input class="form-control price" type="text" name="price[lifetime_tool_bath][]" value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'lifetime_tool_bath')->price ?? '' : '' }}" ></td>
                                    <td class="green"><input class="form-control ext_price" type="text" name="ext_price[lifetime_tool_bath][]" value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'lifetime_tool_bath')->ext_price ?? '' : '' }}" readonly ></td>
                                </tr>
                                <tr>
                                    <td>12" Lead Flashing</td>
                                    <td class="green">PC-Piece</td>
                                    <td class="green"><input class="form-control quantity" type="text" name="quantity[lead_flashing][]" value="{{ $productPricingMaterialList->where('name', 'lead_flashing')->first()->quantity??"" }}" readonly></td>
                                    <td class="green"><input class="form-control price" type="text" name="price[lead_flashing][]" value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'lead_flashing')->price ?? '' : '' }}"></td>
                                    <td class="green"><input class="form-control ext_price" type="text" name="ext_price[lead_flashing][]"   value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'lead_flashing')->ext_price ?? '' : '' }}" readonly ></td>
                                </tr>
                                <tr>
                                    <td>1/2" Fir Cdx Plywood 4' X 8'Item # - 51MIFCP12</td>
                                    <td class="green">PC-Piece</td>
                                    <td class="green"><input class="form-control quantity" type="text" name="quantity[plywood][]" value="{{ $productPricingMaterialList->where('name', 'plywood')->first()->quantity??"" }}" readonly></td>
                                    <td class="green"><input class="form-control price" type="text" name="price[plywood][]" value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'plywood')->price ?? '' : '' }}"></td>
                                    <td class="green"><input class="form-control ext_price" type="text" name="ext_price[plywood][]"   value="{{ isset($productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList) ? $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->productPricingPriceList->firstWhere('name', 'plywood')->ext_price ?? '' : '' }}" readonly ></td>
                                </tr>
                                <tr>
                                    <td>Skylight</td>
                                    <td class="green"></td>
                                    <td class="green"><input class="form-control" type="text" name="quantity[skylight_one][]" value="0" readonly></td>
                                    <td class="green"><input class="form-control" type="text" name="price[skylight_one][]" value="0" ></td>
                                    <td class="green"><input class="form-control" type="text" name="ext_price[skylight_one][]" value="0.00" readonly ></td>
                                </tr>
                                <tr>
                                    <td colspan="4">ESTIMATED TOTAL</td>
                                    <td class="green"><input class="form-control" type="text" name="estimated_total"   value="{{ $productPricingEstimateCalculator->productPricingEstimateCalculatorPriceList->first()->estimated_total ?? '' }}" readonly ></td>
                                </tr>
                            </table>
                        </div>
                        <button type="submit" class="green_btn borderRadius btn-submit">Submit</button>
                    </form>
                </div>
            </div>
        </section>
    @endsection
    @push('js')
         <script>
             $(document).ready(function() {
                 function updateTotal() {
                     var totalOutputSum = 0;

                     $('.quantity').each(function(index) {
                         var quantity = parseFloat($(this).val().replace(/[^0-9.]/g, '')) || 0;
                         var price = parseFloat($('.price').eq(index).val().replace(/[^0-9.]/g, '')) || 0;
                         var total = quantity * price;
                         $('.ext_price').eq(index).val(total.toFixed(2));
                         totalOutputSum += total;
                     });

                     $('input[name="estimated_total"]').val(totalOutputSum.toFixed(2));
                 }

                 $('input').on('input', function() {
                     var sanitizedInput = $(this).val().replace(/[^0-9.]/g, '');
                     $(this).val(sanitizedInput);
                     updateTotal();
                 });
                 $('.quantity, .price').on('input', function() {
                     updateTotal();
                 });
             });

         </script>
    @endpush