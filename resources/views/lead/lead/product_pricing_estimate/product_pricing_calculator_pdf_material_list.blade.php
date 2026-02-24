@extends('layouts.master')
@push('css')
    @section('content')
        <section class="white-box">
            <div class="container-fluid">
                <div class="row">
                    @if(isset($lead->productPricingEstimateCalculator) && $lead->productPricingEstimateCalculator)
                        <div class="col-md-12">
                            <div class="table_top_btn">
                                <a href="{{ url('product_pricing_calculator/' . $lead->productPricingEstimateCalculator->lead_id) }}" class="btn btn_green">Measurement</a>
                                <a href="{{url('product_pricing_calculator_screen')}}/{{$lead->id}}/{{$lead->productPricingEstimateCalculator->id}}/material_list" class="btn btn_green">Material List</a>
                                <a href="{{url('product_pricing_calculator_screen')}}/{{$lead->id}}/{{$lead->productPricingEstimateCalculator->id}}/price_list" class="btn btn_green">Price List</a>
                                <a href="{{url('product_pricing_calculator_screen')}}/{{$lead->id}}/{{$lead->productPricingEstimateCalculator->id}}/pdf_measurement" class="btn btn_green">PDF Measurement</a>
                            </div>
                        </div>
                    @endif
                    <div class="col-lg-12">
                        <form action="{{ route('product_pdf_material_list') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_price_pdf_measurement_id" value="{{ $productPricePdf->id??'' }}">
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
                                    <td><input class="form-control" type="text" name="product[name][]" placeholder="Type here" value="Owens Corning Trudefinition Duration Estate Gray 3 Bundle Per Square" readonly></td>
                                    <td class="green"><input class="form-control" type="number" name="product[unit][]" value="{{ isset($owensCorningTrudefinition) ? $owensCorningTrudefinition : '0' }}" min="0" readonly></td>
                                    <td class="green">BD - Bundle</td>
                                    <td class="green"><input class="form-control" type="number" name="product[quantity][]" value="{{ $owensCorningTrudefinition * 3 }}" min="0" readonly></td>
                                </tr>
                                <tr>
                                    <td><input class="form-control" type="text" name="product[name][]" placeholder="Type here" value="Owens Corning Proedge Hip & Ridge Algae Resistant Estate Gray 33 Linear Feet Per Bundle" readonly></td>
                                    <td class="green"><input class="form-control" type="number" name="product[unit][]" value="{{ $owensCorningProedgeHipRidge??"0" }}" min="0" readonly></td>
                                    <td class="green">BD - Bundle</td>
                                    <td class="green"><input class="form-control" type="number" name="product[quantity][]" value="{{ number_format($owensCorningProedgeHipRidge / 30 , 2) }}" min="0" readonly></td>
                                </tr>
                                <tr>
                                    <td><input class="form-control" type="text" name="product[name][]" placeholder="Type here" value="Owens Corning Ventsure 15" X 4' Strip Weather Protector" readonly></td>
                                    <td class="green"><input class="form-control" type="number" name="product[unit][]" value="{{ $owensCorningVentsure??"0" }}" min="0" readonly></td>
                                    <td class="green">PC</td>
                                    <td class="green"><input class="form-control" type="number" name="product[quantity][]" value="{{ number_format($owensCorningVentsure / 4, 2) }}" min="0" readonly></td>
                                </tr>
                                <tr>
                                    <td><input class="form-control" type="text" name="product[name][]" placeholder="Type here" value="Owens Corning Plus Starter ShinglesItem" readonly></td>
                                    <td class="green"><input class="form-control" type="number" name="product[unit][]" value="{{ $owensCorningPlus??"0" }}" min="0" readonly></td>
                                    <td class="green">BD - Bundle</td>
                                    <td class="green"><input class="form-control" type="number" name="product[quantity][]" value="{{ number_format($owensCorningPlus / 90, 2) }}" min="0" readonly></td>
                                </tr>
                                <tr>
                                    <td><input class="form-control" type="text" name="product[name][]" placeholder="Type here" value="Rhinoroof Granulated Self Adhered 2 Square Roll" readonly></td>
                                    <td class="green"><input class="form-control" type="number" name="product[unit][]" value="{{ $rhinoroof??"0" }}" min="0" readonly></td>
                                    <td class="green">RL-ROLL</td>
                                    <td class="green"><input class="form-control" type="number" name="product[quantity][]" value="{{ number_format($rhinoroof / 66, 2) }}" min="0" readonly></td>
                                </tr>
                                <tr>
                                    <td><input class="form-control" type="text" name="product[name][]" placeholder="Type here" value="Mfm Roof Deck Tape 4"X67'" readonly></td>
                                    <td class="green"><input class="form-control" type="number" name="product[unit][]" value="{{ $mfmRoof??'0' }}" min="0" readonly></td>
                                    <td class="green">RL-ROLL</td>
                                    <td class="green"><input class="form-control" type="number" name="product[quantity][]" value="{{ number_format($mfmRoof / 67, 2) }}" min="0" readonly></td>
                                </tr>
                                <tr>
                                    <td><input class="form-control" type="text" name="product[name][]" placeholder="Type here" value="Owens Corning Proarmor Synthetic Roof Underlayment 10 Square" readonly></td>
                                    <td class="green"><input class="form-control" type="number" name="product[unit][]" value="{{ $owensCorningProarmor??'0' }}" min="0" readonly></td>
                                    <td class="green">RL-ROLL</td>
                                    <td class="green"><input class="form-control" type="number" name="product[quantity][]" value="{{ number_format($owensCorningProarmor / 1000, 2) }}" min="0" readonly></td>
                                </tr>
                                <tr>
                                    <td><input class="form-control" type="text" name="product[name][]" placeholder="Type here" value="Coil Nail ABC 1-1/4"" readonly></td>
                                    <td class="green"><input class="form-control" type="number" name="product[unit][]" value="{{ $coilNail??'0' }}" min="0" readonly></td>
                                    <td class="green">BX-Box</td>
                                    <td class="green"><input class="form-control" type="number" name="product[quantity][]" value="{{ number_format($coilNail / 15, 2) }}" min="0" readonly></td>
                                </tr>
                                <tr>
                                    <td><input class="form-control" type="text" name="product[name][]" placeholder="Type here" value="ACM Drip Edge F-8Item" readonly></td>
                                    <td class="green"><input class="form-control" type="number" name="product[unit][]" value="{{ $owensCorningPlus??'0' }}" min="0" readonly></td>
                                    <td class="green">PC-Piece</td>
                                    <td class="green"><input class="form-control" type="number" name="product[quantity][]" value="{{ number_format($owensCorningPlus / 10, 2) }}" min="0" readonly></td>
                                </tr>
                                <tr>
                                    <td><input class="form-control" type="text" name="product[name][]" placeholder="Type here" value="Lifetime 3'' Ultra Pipe Flashing #300" readonly></td>
                                    <td class="green"><input class="form-control" type="number" name="product[unit][]" value="{{ $lifeTimeUltraPipe??'0' }}" min="0" readonly></td>
                                    <td class="green">PC-Piece</td>
                                    <td class="green"><input class="form-control" type="number" name="product[quantity][]" value="{{ $lifeTimeUltraPipeBundle??'0' }}" min="0" readonly></td>
                                </tr>
                                <tr>
                                    <td><input class="form-control" type="text" name="product[name][]" placeholder="Type here" value="Lifetime Tool Pipe Flashing 200" readonly></td>
                                    <td class="green"><input class="form-control" type="number" name="product[unit][]" value="0" min="0"></td>
                                    <td class="green">PC-Piece</td>
                                    <td class="green"><input class="form-control" type="number" name="product[quantity][]" value="0" min="0"></td>
                                </tr>
                                <tr>
                                    <td><input class="form-control" type="text" name="product[name][]" placeholder="Type here" value="Lifetime Tool Pipe Flashing 150" readonly></td>
                                    <td class="green"><input class="form-control" type="number" name="product[unit][]" value="0" min="0"></td>
                                    <td class="green">PC-Piece</td>
                                    <td class="green"><input class="form-control" type="number" name="product[quantity][]" value="0" min="0"></td>
                                </tr>
                                <tr>
                                    <td><input class="form-control" type="text" name="product[name][]" placeholder="Type here" value="Lifetime Tool Bath Dryer VentItem" readonly></td>
                                    <td class="green"><input class="form-control" type="number" name="product[unit][]" value="0" min="0"></td>
                                    <td class="green">PC-Piece</td>
                                    <td class="green"><input class="form-control" type="number" name="product[quantity][]" value="{{ $lifeTimeBathDryer??'0' }}" min="0" readonly></td>
                                </tr>
                                <tr>
                                    <td><input class="form-control" type="text" name="product[name][]" placeholder="Type here" value="12'' Lead Flashing" readonly></td>
                                    <td class="green"><input class="form-control" type="number" name="product[unit][]" value="{{ $leadFlashing??"0" }}" min="0" readonly></td>
                                    <td class="green">PC-Piece</td>
                                    <td class="green"><input class="form-control" type="number" name="product[quantity][]" value="{{ $leadFlashing??"0" }}" min="0" readonly></td>
                                </tr>
                                <tr>
                                    <td><input class="form-control" type="text" name="product[name][]" placeholder="Type here" value="1/2' Fir Cdx Plywood 4' X 8'Item # - 51MIFCP12" readonly></td>
                                    <td class="green"><input class="form-control" type="number" name="product[unit][]" value="{{ $plywood??'0' }}" min="0" readonly></td>
                                    <td class="green">PC-Piece</td>
                                    <td class="green"><input class="form-control" type="number" name="product[quantity][]" value="{{ $plywood??'0' }}" min="0" readonly></td>
                                </tr>
                                <tr>
                                    <td><input class="form-control" type="text" name="product[name][]" placeholder="Type here" value="SkyLight" readonly></td>
                                    <td class="green"><input class="form-control" type="text" name="product[unit][]" value="{{ @$skylight_one??'0' }}" min="0" readonly></td>
                                    <td class="green">Each</td>
                                    <td class="green"><input class="form-control" type="number" name="product[quantity][]" value="{{ $skyLightSum??'0' }}" min="0"></td>
                                </tr>
                                <tr>
                                    <td><input class="form-control" type="text" name="product[name][]" placeholder="Type here" value="SkyLight" readonly></td>
                                    <td class="green"><input class="form-control" type="text" name="product[unit][]" value="{{ @$SkyLight_two??'0' }}" min="0" readonly></td>
                                    <td class="green">Each</td>
                                    <td class="green"><input class="form-control" type="number" name="product[quantity][]" value="0" min="0"></td>
                                </tr>
                            </table>
                            <div class="table_top_btn">
                                <button type="submit" class="btn btn_green">Submit</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @endsection