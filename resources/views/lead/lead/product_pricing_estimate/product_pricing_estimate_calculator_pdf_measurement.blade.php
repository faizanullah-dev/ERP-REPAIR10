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
                                <a href="{{url('product_pricing_calculator_screen')}}/{{$lead->id}}/{{$lead->productPricingEstimateCalculator->id}}/pdf_material_list" class="btn btn_green">PDF Material List</a>
                            </div>
                        </div>
                    @endif
                    <div class="col-lg-12">
                        <form action="{{ route('store_product_pricing_calculator_pdf_measurement') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_pricing_calculator_id" value="{{ $productPricingEstimateCalculator->id??'' }}">
                            <input type="hidden" name="product_price_pdf_measurement_id" value="{{ $productPricePdf->id??'' }}">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <td>Structure #1</td>
                                    </tr>
                                    <tr>
                                        <td class="green"><input class="form-control" type="text" name="note" placeholder="Type here" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) ? $pdfMeasurement->productPricingPdfMeasurement->first()->note ?? '' : '' }}"></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th colspan="8">Measurements</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td colspan="4"><input class="form-control" type="text" name="name[]" placeholder="Type here" value="Total roof area" readonly></td>
                                        <td colspan="4"><input class="form-control" type="number" name="value[]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Total roof area')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Total roof area')->first()->value : '0' }}"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><input class="form-control" type="text" name="name[]" placeholder="Type here" value="Total pitched area" readonly></td>
                                        <td colspan="4"><input class="form-control" type="number" name="value[]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Total pitched area')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Total pitched area')->first()->value : '0' }}" min="0"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><input class="form-control" type="text" name="name[]" placeholder="Type here" value="Total Flat area" readonly></td>
                                        <td colspan="4"><input class="form-control" type="number" name="value[]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Total Flat area')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Total Flat area')->first()->value : '0' }}"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><input class="form-control" type="text" name="name[]" placeholder="Type here" value="Total roof Facets" readonly></td>
                                        <td colspan="4"><input class="form-control" type="number" name="value[]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Total roof Facets')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Total roof Facets')->first()->value : '0' }}" min="0"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><input class="form-control" type="text" name="name[]" placeholder="Type here" value="Predominant pitch" readonly></td>
                                        <td colspan="4"><input class="form-control" type="number" name="value[]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Predominant pitch')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Predominant pitch')->first()->value : '0' }}" min="0"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><input class="form-control" type="text" name="name[]" placeholder="Type here" value="Total eaves" readonly></td>
                                        <td colspan="4"><input class="form-control eaves" type="number" name="value[]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Total eaves')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Total eaves')->first()->value : '0' }}" min="0"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><input class="form-control" type="text" name="name[]" placeholder="Type here" value="Total Valleys" readonly></td>
                                        <td colspan="4"><input class="form-control" type="number" name="value[]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Total Valleys')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Total Valleys')->first()->value : '0' }}"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><input class="form-control" type="text" name="name[]" placeholder="Type here" value="Total hips" readonly></td>
                                        <td colspan="4"><input class="form-control hips" type="number" name="value[]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Total hips')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Total hips')->first()->value : '0' }}" min="0"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><input class="form-control" type="text" name="name[]" placeholder="Type here" value="Total ridges" readonly></td>
                                        <td colspan="4"><input class="form-control ridges" type="number" name="value[]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Total ridges')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Total ridges')->first()->value : '0' }}" min="0"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><input class="form-control" type="text" name="name[]" placeholder="Type here" value="Total rakes" readonly></td>
                                        <td colspan="4"><input class="form-control rakes" type="number" name="value[]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Total rakes')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Total rakes')->first()->value : '0' }}" min="0"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><input class="form-control" type="text" name="name[]" placeholder="Type here" value="Total wall Flashing" readonly></td>
                                        <td colspan="4"><input class="form-control" type="number" name="value[]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Total wall Flashing')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Total wall Flashing')->first()->value : '0' }}" min="0"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><input class="form-control" type="text" name="name[]" placeholder="Type here" value="Total step Flashing" readonly></td>
                                        <td colspan="4"><input class="form-control" type="number" name="value[]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Total step Flashing')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Total step Flashing')->first()->value : '0' }}" min="0"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><input class="form-control" type="text" name="name[]" placeholder="Type here" value="Total transitions" readonly></td>
                                        <td colspan="4"><input class="form-control" type="number" name="value[]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Total transitions')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Total transitions')->first()->value : '0' }}" min="0"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><input class="form-control" type="text" name="name[]" placeholder="Type here" value="Total parapet wall" readonly></td>
                                        <td colspan="4"><input class="form-control" type="number" name="value[]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Total parapet wall')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Total parapet wall')->first()->value : '0' }}" min="0"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><input class="form-control" type="text" name="name[]" placeholder="Type here" value="Total unspecified" readonly></td>
                                        <td colspan="4"><input class="form-control" type="number" name="value[]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Total unspecified')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Total unspecified')->first()->value : '0' }}" min="0"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><input class="form-control" type="text" name="name[]" placeholder="Type here" value="Hips + ridges" readonly></td>
                                        <td colspan="4"><input class="form-control" id="total_hips_ridges" type="number" name="value[]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Hips + ridges')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Hips + ridges')->first()->value : '0' }}" min="0"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><input class="form-control" type="text" name="name[]" placeholder="Type here" value="Eaves + rakes" readonly></td>
                                        <td colspan="4"><input class="form-control" id="total_eaves_rakes" type="number" name="value[]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Eaves + rakes')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPricePdfTotal->where('name', 'Eaves + rakes')->first()->value : '0' }}" min="0"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">PITCH</td>
                                        <td><input class="form-control" type="number" name="data[pitch][]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'pitch')->where('index', '0')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'pitch')->where('index', '0')->first()->value : '0' }}" min="0"></td>
                                        <td><input class="form-control" type="number" name="data[pitch][]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'pitch')->where('index', '1')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'pitch')->where('index', '1')->first()->value : '0' }}" min="0"></td>
                                        <td><input class="form-control" type="number" name="data[pitch][]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'pitch')->where('index', '2')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'pitch')->where('index', '2')->first()->value : '0' }}" min="0"></td>
                                        <td><input class="form-control" type="number" name="data[pitch][]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'pitch')->where('index', '3')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'pitch')->where('index', '3')->first()->value : '0' }}" min="0"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">AREA (SQFT)</td>
                                        <td><input class="form-control area" type="number" name="data[area][]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'area')->where('index', '0')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'area')->where('index', '0')->first()->value : '0' }}" min="0"></td>
                                        <td><input class="form-control area" type="number" name="data[area][]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'area')->where('index', '1')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'area')->where('index', '1')->first()->value : '0' }}" min="0"></td>
                                        <td><input class="form-control area" type="number" name="data[area][]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'area')->where('index', '2')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'area')->where('index', '2')->first()->value : '0' }}" min="0"></td>
                                        <td><input class="form-control area" type="number" name="data[area][]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'area')->where('index', '3')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'area')->where('index', '3')->first()->value : '0' }}" min="0"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">SQUARE</td>
                                        <td><input class="form-control square" type="number" name="data[square][]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'square')->where('index', '0')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'square')->where('index', '0')->first()->value : '0' }}" min="0" step="0.01" ></td>
                                        <td><input class="form-control square" type="number" name="data[square][]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'square')->where('index', '1')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'square')->where('index', '1')->first()->value : '0' }}" min="0" step="0.01"></td>
                                        <td><input class="form-control square" type="number" name="data[square][]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'square')->where('index', '2')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'square')->where('index', '2')->first()->value : '0' }}" min="0" step="0.01"></td>
                                        <td><input class="form-control square" type="number" name="data[square][]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'square')->where('index', '3')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'square')->where('index', '3')->first()->value : '0' }}" min="0" step="0.01"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="8"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="8"></td>
                                    </tr>
                                    <tr>
                                        <td width="200">WASTE %</td>
                                        <td><input class="form-control" type="number" name="data[waste][]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'waste')->where('index', '0')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'waste')->where('index', '0')->first()->value : '0' }}" min="0"></td>
                                        <td><input class="form-control" type="number" name="data[waste][]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'waste')->where('index', '1')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'waste')->where('index', '1')->first()->value : '0' }}" min="0"></td>
                                        <td><input class="form-control" type="number" name="data[waste][]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'waste')->where('index', '2')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'waste')->where('index', '2')->first()->value : '0' }}" min="0"></td>
                                        <td><input class="form-control" type="number" name="data[waste][]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'waste')->where('index', '3')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'waste')->where('index', '3')->first()->value : '0' }}" min="0"></td>
                                        <td><input class="form-control" type="number" name="data[waste][]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'waste')->where('index', '4')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'waste')->where('index', '4')->first()->value : '0' }}" min="0"></td>
                                        <td><input class="form-control" type="number" name="data[waste][]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'waste')->where('index', '5')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'waste')->where('index', '5')->first()->value : '0' }}" min="0"></td>
                                        <td><input class="form-control" type="number" name="data[waste][]" value="{{ isset($pdfMeasurement->productPricingPdfMeasurement) && $pdfMeasurement->productPricingPdfMeasurement->first() && $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'waste')->where('index', '6')->first() ? $pdfMeasurement->productPricingPdfMeasurement->first()->productPriceAreaPitch->where('name', 'waste')->where('index', '6')->first()->value : '0' }}" min="0"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7">AREA (SQFT)</td>
                                        <td><input class="form-control" type="number" id="total_area" name="total_area" value="{{$pdfMeasurement->productPricingPdfMeasurement->first()->total_area??''}}" min="0"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7">SQUARE</td>
                                        <td><input class="form-control total" id="total_square" type="number" name="total_square_ft" value="{{$pdfMeasurement->productPricingPdfMeasurement->first()->total_square_ft??''}}" min="0"></td>
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
    @push('js')
        <script>
            $(document).ready(function() {
                function updateTotal(selector, totalField) {
                    var total = 0;
                    $(selector).each(function() {
                        total += parseFloat($(this).val()) || 0;
                    });
                    $(totalField).val(total.toFixed(2));
                }

                $('.square').on('input', function() {
                    updateTotal('.square', '#total_square');
                });

                $('.area').on('input', function() {
                    updateTotal('.area', '#total_area');
                });

                $('.eaves, .rakes').on('input', function() {
                    updateTotal('.eaves, .rakes', '#total_eaves_rakes');
                });

                $('.hips, .ridges').on('input', function() {
                    updateTotal('.hips, .ridges', '#total_hips_ridges');
                });
            });
        </script>
    @endpush