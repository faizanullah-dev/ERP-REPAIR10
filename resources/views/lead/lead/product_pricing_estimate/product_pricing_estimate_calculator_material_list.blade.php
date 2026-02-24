@extends('layouts.master')
@push('css')
    @section('content')
        <section class="white-box">
            <div class="container-fluid">
                @if(isset($lead->productPricingEstimateCalculator) && $lead->productPricingEstimateCalculator)
                    <div class="col-md-12">
                        <div class="table_top_btn">
                            <a href="{{ url('product_pricing_calculator/' . $lead->productPricingEstimateCalculator->lead_id) }}" class="btn btn_green">Measurement</a>
                            <a href="{{url('product_pricing_calculator_screen')}}/{{$lead->id}}/{{$lead->productPricingEstimateCalculator->id}}/price_list" class="btn btn_green">Price List</a>
                            <a href="{{url('product_pricing_calculator_screen')}}/{{$lead->id}}/{{$lead->productPricingEstimateCalculator->id}}/pdf_measurement" class="btn btn_green">PDF Measurement</a>
                            <a href="{{url('product_pricing_calculator_screen')}}/{{$lead->id}}/{{$lead->productPricingEstimateCalculator->id}}/pdf_material_list" class="btn btn_green">PDF Material List</a>
                        </div>
                    </div>
                @endif
                <div class="col-lg-12">
                    <form action="{{ route('store_product_pricing_calculator_material_list') }}" class="row" method="post" id="store_product_material_list">
                        @csrf
                        <input type="hidden" name="product_pricing_calculator_id" value="{{$productPricingEstimateCalculator->id??''}}">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>PRODUCT</th>
                                    <th>UNIT</th>
                                    <th>U/M</th>
                                    <th>QTY</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td data-product-key="1">
                                        Owens Corning Trudefinition Duration Estate Gray 3 Bundle Per Square
                                        <i class="fa fa-plus-square toggle-input" style="cursor: pointer;"></i>
                                    </td>
                                    <td class="green">
                                        <input class="form-control" type="number" name="name[owens_corning][unit][]" value="{{$productMaterialList->owens_corning??'0'}}" readonly>
                                        Total Unit
                                        <input class="form-control final_total_unit" type="text" data-section-id="1" readonly> <!-- Added data-section-id -->
                                    </td>
                                    <td class="green">BD - Bundle</td>
                                    <td class="green">
                                        <input class="form-control" type="number" name="name[owens_corning][quantity][]" value="{{ $eaveRakesTotalPercentBundle }}" readonly>
                                    </td>
                                @foreach($productMaterial as $product)
                                    @foreach($product->productMaterialSection as $section)
                                        <tr>
                                            @if($section->material_list_id == 1)
                                                <td class="green">
                                                    <input class="form-control d-inline-block" type="text" name="name[1][value][]" value="{{ $section->name ?? '' }}" readonly style="width: 48%; display: inline;">
                                                    <input class="form-control d-inline-block total_unit" type="text" name="name[1][unit][]" value="{{ $section->unit ?? '' }}" data-section-id="1" readonly style="width: 48%; display: inline;"> <!-- Added data attribute -->
                                                </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                        @endforeach
                                        </tr>

                                        <tr>
                                            <td data-product-key="2">
                                                Owens Corning Proedge Hip & Ridge Algae Resistant Estate Gray 33 Linear Feet Per Bundle
                                                <i class="fa fa-plus-square toggle-input" style="cursor: pointer;"></i>
                                            </td>
                                            <td class="green">
                                                <input class="form-control" type="number" name="name[corning_proedge][unit][]" value="{{ $productPricingEaveSum }}" readonly>
                                                Total Unit
                                                <input class="form-control final_total_unit" type="text" data-section-id="2" readonly> <!-- Added data-section-id -->
                                            </td>
                                            <td class="green">BD - Bundle</td>
                                            <td class="green">
                                                <input class="form-control" type="number" name="name[corning_proedge][quantity][]" value="{{ isset($materialListCorningProedgeBundle) ? number_format($materialListCorningProedgeBundle, 2) : '0.00' }}" readonly>
                                            </td>
                                        @foreach($productMaterial as $product)
                                            @foreach($product->productMaterialSection as $section)
                                                <tr>
                                                    @if($section->material_list_id == 2)
                                                        <td class="green">
                                                            <input class="form-control d-inline-block" type="text" name="name[2][value][]" value="{{ $section->name ?? '' }}" readonly style="width: 48%; display: inline;">
                                                            <input class="form-control d-inline-block total_unit" type="text" name="name[2][unit][]" value="{{ $section->unit ?? '' }}" data-section-id="2" readonly style="width: 48%; display: inline;"> <!-- Added data attribute -->
                                                        </td>
                                                    @endif
                                                </tr>
                                                @endforeach
                                                @endforeach
                                                </tr>

                                                <tr>
                                                    <td data-product-key="3">Owens Corning Ventsure 15" X 4' Strip Weather Protector<i class="fa fa-plus-square toggle-input" style="cursor: pointer;"></i></td>
                                                    <td class="green"><input class="form-control" type="number" name="name[corning_ventsure][unit][]" value="{{ $productPricingEaveSum }}"  readonly>
                                                        Total Unit
                                                        <input class="form-control final_total_unit" type="text"></td>
                                                    <td class="green">PC</td>
                                                    <td class="green"><input class="form-control" type="number" name="name[corning_ventsure][quantity][]" value="{{ isset($materialListCorningVenstureBundle) ? number_format($materialListCorningVenstureBundle, 2) : '0.00' }}" readonly></td>
                                                @foreach($productMaterial as $product)
                                                    @foreach($product->productMaterialSection as $section)
                                                        <tr>
                                                            @if($section->material_list_id == 3)
                                                                <td class="green">
                                                                    <input class="form-control d-inline-block" type="text" name="name[3][value][]" value="{{ $section->name ?? '' }}" readonly style="width: 48%; display: inline;">
                                                                    <input class="form-control d-inline-block" type="text" name="name[3][unit][]" value="{{ $section->unit ?? '' }}" readonly style="width: 48%; display: inline;">
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        @endforeach
                                                        @endforeach
                                                        </tr>
                                                        <tr>
                                                            <td data-product-key="4">Owens Corning Plus Starter ShinglesItem <i class="fa fa-plus-square toggle-input" style="cursor: pointer;"></i></td>
                                                            <td class="green"><input class="form-control" type="number" name="name[corning_plus][unit][]" value="{{ $materiaListshingleItems }}"  readonly>
                                                                Total Unit
                                                                <input class="form-control final_total_unit" type="text"></td>
                                                            <td class="green">BD - Bundle</td>
                                                            <td class="green"><input class="form-control" type="number" name="name[corning_plus][quantity][]" value="{{ isset($materialListCorningPlusBundle) ? number_format($materialListCorningPlusBundle, 2) : '0.00' }}" readonly></td>
                                                        @foreach($productMaterial as $product)
                                                            @foreach($product->productMaterialSection as $section)
                                                                <tr>
                                                                    @if($section->material_list_id == 4)
                                                                        <td class="green">
                                                                            <input class="form-control d-inline-block" type="text" name="name[4][value][]" value="{{ $section->name ?? '' }}" readonly style="width: 48%; display: inline;">
                                                                            <input class="form-control d-inline-block" type="text" name="name[4][unit][]" value="{{ $section->unit ?? '' }}" readonly style="width: 48%; display: inline;">
                                                                        </td>
                                                                    @endif
                                                                </tr>
                                                                @endforeach
                                                                @endforeach
                                                                </tr>
                                                                <tr>
                                                                    <td data-product-key="5">Rhinoroof Granulated Self Adhered 2 Square Roll<i class="fa fa-plus-square toggle-input" style="cursor: pointer;"></i></td>
                                                                    <td class="green"><input class="form-control" type="number" name="name[rhinoroof][unit][]" value="{{ $materiaListRhinRoof }}"  readonly>
                                                                        Total Unit
                                                                        <input class="form-control final_total_unit" type="text"></td>
                                                                    <td class="green">RL-ROLL</td>
                                                                    <td class="green"><input class="form-control" type="number" name="name[rhinoroof][quantity][]" value="{{ isset($materialListRhinRoofBundle) ? number_format($materialListRhinRoofBundle, 2) : '0.00' }}" readonly></td>
                                                                @foreach($productMaterial as $product)
                                                                    @foreach($product->productMaterialSection as $section)
                                                                        <tr>
                                                                            @if($section->material_list_id == 5)
                                                                                <td class="green">
                                                                                    <input class="form-control d-inline-block" type="text" name="name[5][value][]" value="{{ $section->name ?? '' }}" readonly style="width: 48%; display: inline;">
                                                                                    <input class="form-control d-inline-block" type="text" name="name[5][unit][]" value="{{ $section->unit ?? '' }}" readonly style="width: 48%; display: inline;">
                                                                                </td>
                                                                            @endif
                                                                        </tr>
                                                                        @endforeach
                                                                        @endforeach
                                                                        </tr>
                                                                        <tr>
                                                                            <td data-product-key="6">Mfm Roof Deck Tape 4"X67'<i class="fa fa-plus-square toggle-input" style="cursor: pointer;"></i></td>
                                                                            <td class="green"><input class="form-control" type="number" name="name[mfm_roof][unit][]" value="{{ $materiaListMfmRoof }}"  readonly>
                                                                                Total Unit
                                                                                <input class="form-control final_total_unit" type="text"></td>
                                                                            <td class="green">RL-ROLL</td>
                                                                            <td class="green"><input class="form-control" type="number" name="name[mfm_roof][quantity][]" value="{{ isset($materialListMfmBundle) ? number_format($materialListMfmBundle, 2) : '0.00' }}" readonly></td>
                                                                        @foreach($productMaterial as $product)
                                                                            @foreach($product->productMaterialSection as $section)
                                                                                <tr>
                                                                                    @if($section->material_list_id == 6)
                                                                                        <td class="green">
                                                                                            <input class="form-control d-inline-block" type="text" name="name[6][value][]" value="{{ $section->name ?? '' }}" readonly style="width: 48%; display: inline;">
                                                                                            <input class="form-control d-inline-block" type="text" name="name[6][unit][]" value="{{ $section->unit ?? '' }}" readonly style="width: 48%; display: inline;">
                                                                                        </td>
                                                                                    @endif
                                                                                </tr>
                                                                                @endforeach
                                                                                @endforeach
                                                                                </tr>
                                                                                <tr>
                                                                                    <td data-product-key="7">Owens Corning Proarmor Synthetic Roof Underlayment 10 Square<i class="fa fa-plus-square toggle-input" style="cursor: pointer;"></i></td>
                                                                                    <td class="green"><input class="form-control" type="number" name="name[corning_proarmor][unit][]" value="{{ $eaveRakesTotalPercent }}" readonly>
                                                                                        Total Unit
                                                                                        <input class="form-control final_total_unit" type="text"></td>
                                                                                    <td class="green">RL-ROLL</td>
                                                                                    <td class="green"><input class="form-control" type="number" name="name[corning_proarmor][quantity][]" value="{{ isset($materlistCorningPrarmorBundle) ? number_format($materlistCorningPrarmorBundle, 2, '.', '') : '0.00' }}" readonly></td>
                                                                                @foreach($productMaterial as $product)
                                                                                    @foreach($product->productMaterialSection as $section)
                                                                                        <tr>
                                                                                            @if($section->material_list_id == 7)
                                                                                                <td class="green">
                                                                                                    <input class="form-control d-inline-block" type="text" name="name[7][value][]" value="{{ $section->name ?? '' }}" readonly style="width: 48%; display: inline;">
                                                                                                    <input class="form-control d-inline-block" type="text" name="name[7][unit][]" value="{{ $section->unit ?? '' }}" readonly style="width: 48%; display: inline;">
                                                                                                </td>
                                                                                            @endif
                                                                                        </tr>
                                                                                        @endforeach
                                                                                        @endforeach
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td data-product-key="8">Coil Nail ABC 1-1/4" <i class="fa fa-plus-square toggle-input" style="cursor: pointer;"></i></td>
                                                                                            <td class="green"><input class="form-control" type="number" name="name[coil_nail][unit][]" value="{{ $eaveRakesTotalPercent }}"  readonly>
                                                                                                Total Unit
                                                                                                <input class="form-control final_total_unit" type="text"></td>
                                                                                            <td class="green">BX-Box</td>
                                                                                            <td class="green"><input class="form-control" type="number" name="name[coil_nail][quantity][]" value="{{ isset($materlistCoilNailBundle) ? number_format($materlistCoilNailBundle, 2, '.', '') : '0.00'}}" readonly></td>
                                                                                        @foreach($productMaterial as $product)
                                                                                            @foreach($product->productMaterialSection as $section)
                                                                                                <tr>
                                                                                                    @if($section->material_list_id == 8)
                                                                                                        <td class="green">
                                                                                                            <input class="form-control d-inline-block" type="text" name="name[8][value][]" value="{{ $section->name ?? '' }}" readonly style="width: 48%; display: inline;">
                                                                                                            <input class="form-control d-inline-block" type="text" name="name[8][unit][]" value="{{ $section->unit ?? '' }}" readonly style="width: 48%; display: inline;">
                                                                                                        </td>
                                                                                                    @endif
                                                                                                </tr>
                                                                                                @endforeach
                                                                                                @endforeach
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td data-product-key="9">ACM Drip Edge F-8Item <i class="fa fa-plus-square toggle-input" style="cursor: pointer;"></i></td>
                                                                                                    <td class="green"><input class="form-control" type="number" name="name[acm_drip][unit][]" value="{{ $materiaListshingleItems }}"  readonly>
                                                                                                        Total Unit
                                                                                                        <input class="form-control final_total_unit" type="text"></td>
                                                                                                    <td class="green">PC-Piece</td>
                                                                                                    <td class="green"><input class="form-control" type="number" name="name[acm_drip][quantity][]" value="{{ isset($materlistAcmDripBundle) ? number_format($materlistAcmDripBundle) : '0.00' }}" readonly></td>
                                                                                                @foreach($productMaterial as $product)
                                                                                                    @foreach($product->productMaterialSection as $section)
                                                                                                        <tr>
                                                                                                            @if($section->material_list_id == 9)
                                                                                                                <td class="green">
                                                                                                                    <input class="form-control d-inline-block" type="text" name="name[9][value][]" value="{{ $section->name ?? '' }}" readonly style="width: 48%; display: inline;">
                                                                                                                    <input class="form-control d-inline-block" type="text" name="name[9][unit][]" value="{{ $section->unit ?? '' }}" readonly style="width: 48%; display: inline;">
                                                                                                                </td>
                                                                                                            @endif
                                                                                                        </tr>
                                                                                                        @endforeach
                                                                                                        @endforeach
                                                                                                        </tr>
                                                                                                        @if($lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'sizes')->first()->value == '3')
                                                                                                            <tr>
                                                                                                                <td data-product-key="10">Lifetime 3" Ultra Pipe Flashing #300<i class="fa fa-plus-square toggle-input" style="cursor: pointer;"></i></td>
{{--                                                                                                                <td class="green"><input class="form-control" type="number" name="name[lifetime_ultra_pipe][unit][]" value="{{ $productPricingSizeOneLabels }}"  readonly>--}}
                                                                                                                <td class="green"><input class="form-control" type="number" name="name[lifetime_ultra_pipe][unit][]" value="0"  readonly>
                                                                                                                    Total Unit
                                                                                                                    <input class="form-control final_total_unit" type="text"></td>
                                                                                                                <td class="green">PC-Piece</td>
                                                                                                                <td class="green"><input class="form-control" type="number" name="name[lifetime_ultra_pipe][quantity][]" value="{{ isset($productPricingPipeBootsLabels) ? number_format($productPricingPipeBootsLabels, 2) : '0.00'}}" readonly></td>
                                                                                                            @foreach($productMaterial as $product)
                                                                                                                @foreach($product->productMaterialSection as $section)
                                                                                                                    <tr>
                                                                                                                        @if($section->material_list_id == 10)
                                                                                                                            <td class="green">
                                                                                                                                <input class="form-control d-inline-block" type="text" name="name[10][value][]" value="{{ $section->name ?? '' }}" readonly style="width: 48%; display: inline;">
                                                                                                                                <input class="form-control d-inline-block" type="text" name="name[10][unit][]" value="{{ $section->unit ?? '' }}" readonly style="width: 48%; display: inline;">
                                                                                                                            </td>
                                                                                                                        @endif
                                                                                                                    </tr>
                                                                                                                    @endforeach
                                                                                                                    @endforeach
                                                                                                                    </tr>
                                                                                                                    @elseif($lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'sizes')->first()->value == '2')
                                                                                                                        <tr>
                                                                                                                            <td data-product-key="10">Lifetime Tool Pipe Flashing 200 <i class="fa fa-plus-square toggle-input" style="cursor: pointer;"></i></td>
                                                                                                                            <td class="green"><input class="form-control" type="number" name="name[lifetime_tool_pipe_two][unit][]" value="{{$productMaterialList->lifetime_tool_pipe_two??'0'}}" >
                                                                                                                                Total Unit
                                                                                                                                <input class="form-control final_total_unit" type="text"></td>
                                                                                                                            <td class="green">PC-Piece</td>
                                                                                                                            <td class="green"><input class="form-control" type="number" name="name[lifetime_tool_pipe_two][quantity][]" value="{{$productMaterialList->lifetime_tool_pipe_two_piece??'0'}}" ></td>
                                                                                                                        @foreach($productMaterial as $product)
                                                                                                                            @foreach($product->productMaterialSection as $section)
                                                                                                                                <tr>
                                                                                                                                    @if($section->material_list_id == 10)
                                                                                                                                        <td class="green">
                                                                                                                                            <input class="form-control d-inline-block" type="text" name="name[10][value][]" value="{{ $section->name ?? '' }}" readonly style="width: 48%; display: inline;">
                                                                                                                                            <input class="form-control d-inline-block" type="text" name="name[10][unit][]" value="{{ $section->unit ?? '' }}" readonly style="width: 48%; display: inline;">
                                                                                                                                        </td>
                                                                                                                                    @endif
                                                                                                                                </tr>
                                                                                                                                @endforeach
                                                                                                                                @endforeach
                                                                                                                                </tr>
                                                                                                                                @elseif($lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'sizes')->first()->value == '1.5')
                                                                                                                                    <tr>
                                                                                                                                        <td data-product-key="10">Lifetime Tool Pipe Flashing 150 <i class="fa fa-plus-square toggle-input" style="cursor: pointer;"></i></td>
                                                                                                                                        <td class="green"><input class="form-control" type="number" name="name[lifetime_tool_pipe_one][unit][]" value="{{$productMaterialList->lifetime_tool_pipe_one??'0'}}" >
                                                                                                                                            Total Unit
                                                                                                                                            <input class="form-control final_total_unit" type="text"></td>
                                                                                                                                        <td class="green">PC-Piece</td>
                                                                                                                                        <td class="green"><input class="form-control" type="number" name="name[lifetime_tool_pipe_one][quantity][]" value="{{$productMaterialList->lifetime_tool_pipe_one_piece??'0'}}" ></td>
                                                                                                                                    @foreach($productMaterial as $product)
                                                                                                                                        @foreach($product->productMaterialSection as $section)
                                                                                                                                            <tr>
                                                                                                                                                @if($section->material_list_id == 10)
                                                                                                                                                    <td class="green">
                                                                                                                                                        <input class="form-control d-inline-block" type="text" name="name[10][value][]" value="{{ $section->name ?? '' }}" readonly style="width: 48%; display: inline;">
                                                                                                                                                        <input class="form-control d-inline-block" type="text" name="name[10][unit][]" value="{{ $section->unit ?? '' }}" readonly style="width: 48%; display: inline;">
                                                                                                                                                    </td>
                                                                                                                                                @endif
                                                                                                                                            </tr>
                                                                                                                                            @endforeach
                                                                                                                                            @endforeach
                                                                                                                                            </tr>
                                                                                                                                            @endif
                                                                                                                                            <tr>
                                                                                                                                                <td data-product-key="11">Lifetime Tool Bath Dryer VentItem <i class="fa fa-plus-square toggle-input" style="cursor: pointer;"></i></td>
                                                                                                                                                {{--                                    <td class="green"><input class="form-control" type="number" name="lifetime_tool_bath_dryer" value="{{ $productPricingSizeTwoLabels }}"  readonly></td>--}}
                                                                                                                                                <td class="green"><input class="form-control" type="number" name="name[lifetime_tool_bath_dryer][unit][]" value="0"  readonly>
                                                                                                                                                    Total Unit
                                                                                                                                                    <input class="form-control final_total_unit" type="text"></td>
                                                                                                                                                <td class="green">PC-Piece</td>
                                                                                                                                                <td class="green"><input class="form-control" type="number" name="name[lifetime_tool_bath_dryer][quantity][]" value="{{ $productPricingBathroomVentLabels }}"  readonly></td>
                                                                                                                                            @foreach($productMaterial as $product)
                                                                                                                                                @foreach($product->productMaterialSection as $section)
                                                                                                                                                    <tr>
                                                                                                                                                        @if($section->material_list_id == 11)
                                                                                                                                                            <td class="green">
                                                                                                                                                                <input class="form-control d-inline-block" type="text" name="name[11][value][]" value="{{ $section->name ?? '' }}" readonly style="width: 48%; display: inline;">
                                                                                                                                                                <input class="form-control d-inline-block" type="text" name="name[11][unit][]" value="{{ $section->unit ?? '' }}" readonly style="width: 48%; display: inline;">
                                                                                                                                                            </td>
                                                                                                                                                        @endif
                                                                                                                                                    </tr>
                                                                                                                                                    @endforeach
                                                                                                                                                    @endforeach
                                                                                                                                                    </tr>
                                                                                                                                                    <tr>
                                                                                                                                                        <td data-product-key="12">12" Lead Flashing<i class="fa fa-plus-square toggle-input" style="cursor: pointer;"></i></td>
                                                                                                                                                        <td class="green"><input class="form-control" type="number" name="name[lead_flashing][unit][]" value="{{$productMaterialList->lead_flashing??'0'}}" >
                                                                                                                                                            Total Unit
                                                                                                                                                            <input class="form-control final_total_unit" type="text"></td>
                                                                                                                                                        <td class="green">PC-Piece</td>
                                                                                                                                                        <td class="green"><input class="form-control" type="number" name="name[lead_flashing][quantity][]" value="{{ $productPricingChimneySizeLabels }}"  readonly></td>
                                                                                                                                                    @foreach($productMaterial as $product)
                                                                                                                                                        @foreach($product->productMaterialSection as $section)
                                                                                                                                                            <tr>
                                                                                                                                                                @if($section->material_list_id == 12)
                                                                                                                                                                    <td class="green">
                                                                                                                                                                        <input class="form-control d-inline-block" type="text" name="name[12][value][]" value="{{ $section->name ?? '' }}" readonly style="width: 48%; display: inline;">
                                                                                                                                                                        <input class="form-control d-inline-block" type="text" name="name[12][unit][]" value="{{ $section->unit ?? '' }}" readonly style="width: 48%; display: inline;">
                                                                                                                                                                    </td>
                                                                                                                                                                @endif
                                                                                                                                                            </tr>
                                                                                                                                                            @endforeach
                                                                                                                                                            @endforeach
                                                                                                                                                            </tr>
                                                                                                                                                            <tr>
                                                                                                                                                                <td data-product-key="13">1/2" Fir Cdx Plywood 4' X 8'Item # - 51MIFCP12<i class="fa fa-plus-square toggle-input" style="cursor: pointer;"></i></td>
                                                                                                                                                                <td class="green"><input class="form-control" type="number" name="name[plywood][unit][]" value="{{$productMaterialList->plywood??'0'}}" >
                                                                                                                                                                    Total Unit
                                                                                                                                                                    <input class="form-control " id="final_total_unit" type="text"></td>
                                                                                                                                                                <td class="green">PC-Piece</td>
                                                                                                                                                                <td class="green"><input class="form-control" type="number" name="name[plywood][quantity][]" value="{{ $productPricingPlywoodLabels }}"  readonly></td>
                                                                                                                                                            @foreach($productMaterial as $product)
                                                                                                                                                                @foreach($product->productMaterialSection as $section)
                                                                                                                                                                    <tr>
                                                                                                                                                                        @if($section->material_list_id == 13)
                                                                                                                                                                            <td class="green">
                                                                                                                                                                                <input class="form-control d-inline-block" type="text" name="name[13][value][]" value="{{ $section->name ?? '' }}" readonly style="width: 48%; display: inline;">
                                                                                                                                                                                <input class="form-control d-inline-block" type="text" name="name[13][unit][]" value="{{ $section->unit ?? '' }}" readonly style="width: 48%; display: inline;">
                                                                                                                                                                            </td>
                                                                                                                                                                        @endif
                                                                                                                                                                    </tr>
                                                                                                                                                                    @endforeach
                                                                                                                                                                    @endforeach
                                                                                                                                                                    </tr>
                                                                                                                                                                    @foreach($skylights as $skylight)
                                                                                                                                                                        <tr>
                                                                                                                                                                            <td>Skylight</td>
                                                                                                                                                                            <td class="green"><input class="form-control" type="text" name="skylight_one" value="{{ $skylight->size??"" }}"  readonly></td>
                                                                                                                                                                            <td class="green">Each</td>
                                                                                                                                                                            <td class="green"><input class="form-control" type="number" name="skylight_one_each" value="{{ $skyLightSum??"0" }}" ></td>
                                                                                                                                                                        </tr>
                                @endforeach
                                {{--                                <tr>--}}
                                {{--                                    <td>Skylight</td>--}}
                                {{--                                    <td class="green"><input class="form-control" type="text" name="skylight_two" value=""  readonly></td>--}}
                                {{--                                    <td class="green">Each</td>--}}
                                {{--                                    <td class="green"><input class="form-control" type="number" name="skylight_two_each" value="{{$productMaterialList->skylight_two_each??'0'}}" ></td>--}}
                                {{--                                </tr>--}}
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
                function calculateRowTotal(sectionId) {
                    var total = 0;
                    $('.total_unit[data-section-id="' + sectionId + '"]').each(function() {
                        var value = parseFloat($(this).val()) || 0;
                        total += value;
                    });
                    console.log(total);
                    $('.final_total_unit[data-section-id="' + sectionId + '"]').val(total);
                }
                $('tr').each(function() {
                    var sectionId = $(this).find('.total_unit').attr('data-section-id');
                    if (sectionId) {
                        calculateRowTotal(sectionId);
                    }
                });
                $(document).on('input', '.total_unit', function() {
                    var sectionId = $(this).attr('data-section-id');
                    calculateRowTotal(sectionId);
                });
            });

            {{--$(document).on('keyup', '.form-control', function() {--}}
            {{--    var formData = $('#store_product_material_list').serialize();--}}
            {{--    $.ajax({--}}
            {{--        url: '{{ route("store_product_pricing_calculator_material_list") }}',--}}
            {{--        type: 'POST',--}}
            {{--        data: formData,--}}
            {{--        success: function(response) {--}}
            {{--            console.log(response);--}}
            {{--        },--}}
            {{--        error: function(xhr) {--}}
            {{--            console.error(xhr);--}}
            {{--        }--}}
            {{--    });--}}
            {{--});--}}
            $(document).ready(function() {
                var inputCounters = {};

                $('.toggle-input').on('click', function() {
                    var parentTd = $(this).closest('td');
                    var productKey = parentTd.data('product-key');
                    var sanitizedProductKey = productKey.toString();

                    if (!inputCounters[sanitizedProductKey]) {
                        inputCounters[sanitizedProductKey] = 0;
                    }

                    inputCounters[sanitizedProductKey]++;
                    var uniqueId = sanitizedProductKey + '_input_' + inputCounters[sanitizedProductKey];

                    // Create new input group with value field
                    var newInput = `
                        <div class="input-group" id="${uniqueId}" style="margin-top: 10px;">
                            <input type="hidden" name="lead_id" value="{{ $lead->productPricingEstimateCalculator->lead_id }}">
                            <input class="form-control additional-input" style="margin-right: 10px;"
                                   type="text" name="name[${sanitizedProductKey}][value][]"
                                   placeholder="Enter additional info">
                            <input class="form-control additional-input"
                                   type="number" name="name[${sanitizedProductKey}][unit][]"
                                   placeholder="Enter unit">
                            <button type="button" class="btn btn-danger remove-input" data-row-id="${uniqueId}">-</button>
                        </div>`;
                    parentTd.append(newInput);
                });
                $(document).on('click', '.remove-input', function() {
                    var rowId = $(this).attr('data-row-id');
                    $('#' + rowId).remove();
                });
            });
        </script>
    @endpush