@extends('layouts.master')
@push('css')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .green {
            background-color: #00FF00;
        }
        .orange {
            background-color: #FFA500;
        }
        .no-border {
            border: none !important;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid black !important;
        }
    </style>
@endpush
@section('content')
    <section class="white-box">
        <div class="container-fluid">
            <div class="row">
                @if(isset($lead->productPricingEstimateCalculator) && $lead->productPricingEstimateCalculator)
                    <div class="col-md-12">
                        <div class="table_top_btn">
                            <a href="{{url('siding_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->productPricingEstimateCalculator->id}}/replacement" class="btn btn_green">Material List</a>
                            <a href="{{url('siding_estimation_calculator_screen')}}/{{$lead->id}}/{{$lead->productPricingEstimateCalculator->id}}/over_existing" class="btn btn_green">Price List</a>
                        </div>
                    </div>
                @endif
                <div class="col-md-12">
                    <form class="" action="{{ route('store_product_pricing_estimation_calculator') }}" method="post">
                        @csrf
                        <input type="hidden" name="lead_id" value="{{$lead->id??"0"}}">
                        <input type="hidden" name="product_pricing_calculator_id" @if(isset($lead->productPricingEstimateCalculator->id) && $lead->productPricingEstimateCalculator->id) value="{{$lead->productPricingEstimateCalculator->id??"0"}}" @else value="0" @endif >

                        <div class="row">

                            <div class="col-lg-12">
                                @if(isset($lead->productPricingEstimateCalculator) && isset($lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels))
                                    {{--  labels starts--}}
                                    <table class="table table-bordered">
                                        <tr>
                                            <td colspan="2" width="200">Customer Name:</td>
                                            <td colspan="">{{$lead->lead_number??"000"}}</td>
                                            <td colspan="2" class="no-border">{{$lead->title??""}}</td>
                                            <td colspan="">Date:</td>
                                            <td width="200" colspan="3" class="green">{{$lead->lead_date??"000"}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><input class="form-control" type="text" id="home_style" required name="labels[home_style][name]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','home_style')->first()->name??'Home Style'}}" ></td>
                                            <td colspan=""><input class="form-control" type="text" required id="home_style_value" name="labels[home_style][value]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','home_style')->first()->value??'1'}}"></td>
                                            <td><input class="form-control" type="text" id="stories" required name="labels[stories][name]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','stories')->first()->name??'Stories'}}"></td>
                                            <td colspan="" class="green"><input class="form-control" required type="number" min="1" id="stories_value" name="labels[stories][value]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','stories')->first()->value??'1'}}"></td>
                                            <td><input class="form-control" type="text" id="layers" required name="labels[layers][name]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','layers')->first()->name??'Layers'}}"></td>
                                            <td class="green" colspan="3"><input class="form-control" type="number" required min="1" id="layers_value" name="labels[layers][value]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','layers')->first()->value??'1'}}"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><input required class="form-control" type="text" id="chimneySizes" name="chimney_sizes" value="Chimney Sizes"></td>
                                            <td colspan="3" class="green"><input required class="form-control" type="number" min="1" id="chimney_sizes" name="labels[chimney_sizes][value]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','windows')->first()->value??'1'}}"></td>
                                            <td colspan="3"><input class="form-control" type="text" id="pitch" required name="pitch" value="Pitch"></td>
                                            <td colspan="3" class="green"><input class="form-control" required type="number" min="1" id="pitch" name="labels[pitch][value]"value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','facia_inches')->first()->value??'1'}}"></td>
                                        </tr>
                                        <tr>
                                            <td><input class="form-control" type="text" id="pipe_boots" required name="labels[pipe_boots][name]" value="Pipe Boots"></td>
                                            <td class="green"><input class="form-control" type="number" required min="1" id="pipe_boots_value" name="labels[pipe_boots][value]" value="{{@$lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section','pipe_boots')->first()->value??'1'}}"></td>
                                            <td><input class="form-control" type="text" id="bathroom_vent" required name="labels[bathroom_vent][name]" value="Bathroom Vent"></td>
                                            <td class="no-border"><input class="form-control" required type="number" id="bathroom_vent_value" name="labels[bathroom_vent][value]" value="{{@$lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section','bathroom_vent')->first()->value??'1'}}"></td>
{{--                                            <td><input class="form-control" type="text" id="skyLights" required name="labels[sky_light_one][name]" value="SkyLights"></td>--}}
{{--                                            <td class="no-border"><input class="form-control" required type="number" id="skyLights_value" name="labels[sky_light_one][value]" value="{{@$lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section','sky_light_one')->first()->value??'1'}}"></td>--}}
{{--                                            <input type="hidden" name="labels[sky_light_two][name]" value="SkyLights">--}}
{{--                                            <td class="no-border"><input class="form-control" required type="number" id="skyLights_value" name="labels[sky_light_two][value]" value="{{@$lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section','sky_light_two')->first()->value??'1'}}"></td>--}}
{{--                                            <input type="hidden" name="labels[sky_light_three][name]" value="SkyLights">--}}
{{--                                            <td class="no-border"><input class="form-control" required type="number" id="skyLights_value" name="labels[sky_light_three][value]" value="{{@$lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section','sky_light_three')->first()->value??'1'}}"></td>--}}
{{--                                            <input type="hidden" name="labels[sky_light_four][name]" value="SkyLights">--}}
{{--                                            <td class="no-border"><input class="form-control" required type="number" id="skyLights_value" name="labels[sky_light_four][value]" value="{{@$lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section','sky_light_four')->first()->value??'1'}}"></td>--}}
{{--                                            <input type="hidden" name="labels[sky_light_five][name]" value="SkyLights">--}}
{{--                                            <td class="no-border"><input class="form-control" required type="number" id="skyLights_value" name="labels[sky_light_five][value]" value="{{@$lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section','sky_light_five')->first()->value??'1'}}"></td>--}}
                                        </tr>
                                        <tr>
                                            <td><input class="form-control" type="text" id="sizes" required name="labels[sizes][name]" value="Sizes"></td>
                                            <td class="green">
                                                {{--                                        <input class="form-control" type="number" required min="1" id="sizes_value" name="labels[size_one][value]" value="{{@$lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section','size_one')->first()->value??'1'}}">--}}
                                                <select class="form-select" aria-label="Default select example" name="labels[sizes][value]">
                                                    <option selected value="4" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'sizes')->first()->value == '4' ? 'selected' : '' }}>4</option>
                                                    <option value="3" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'sizes')->first()->value == '3' ? 'selected' : '' }}>3</option>
                                                    <option value="2" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'sizes')->first()->value == '2' ? 'selected' : '' }}>2</option>
                                                    <option value="1.5" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'sizes')->first()->value == '1.5' ? 'selected' : '' }}>1 1/2</option>
                                                </select>
                                            </td>
                                            <td><input class="form-control" type="text" id="sizes" required name="labels[size_two][name]" value="Sizes"></td>
                                            <td class="green"><input class="form-control" type="number" required min="1" id="sizes_value" name="labels[size_two][value]" value="{{@$lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section','size_two')->first()->value??'1'}}"></td>
                                            <td><input class="form-control" type="text" id="sizes" required name="labels[size_three][name]" value="Sizes"></td>
                                            <td class="no-border">
                                                <select class="form-select" aria-label="Default select example" name="labels[size_three][value]">
                                                    <option selected value="C04 fixed" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_three')->first()->value == 'C04 fixed' ? 'selected' : '' }}>C04 fixed</option>
                                                    <option value="C04 Fixed With solar blind" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_three')->first()->value == 'C04 Fixed With solar blind' ? 'selected' : '' }}>C04 Fixed With solar blind</option>
                                                    <option value="C04 Manual Vented" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_three')->first()->value == 'C04 Manual Vented' ? 'selected' : '' }}>C04 Manual Vented</option>
                                                    <option value="C04 Manual vented with solar blind" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_three')->first()->value == 'C04 Manual vented with solar blind' ? 'selected' : '' }}>C04 Manual vented with solar blind</option>
                                                    <option value="C04 Solar Vented" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_three')->first()->value == 'C04 Solar Vented' ? 'selected' : '' }}>C04 Solar Vented</option>
                                                    <option value="C04 Solar Vented with solar blind" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_three')->first()->value == 'C04 Solar Vented with solar blind' ? 'selected' : '' }}>C04 Solar Vented with solar blind</option>
                                                    <option value="0" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_three')->first()->value == '0' ? 'selected' : '' }}>0</option>
                                                </select>
                                            </td>
                                            <input type="hidden" name="labels[size_four][name]" value="Sizes">
                                            <td colspan="" class="no-border">
                                                <select class="form-select" aria-label="Default select example" name="labels[size_four][value]">
                                                    <option selected value="C04 fixed" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_four')->first()->value == 'C04 fixed' ? 'selected' : '' }}>C04 fixed</option>
                                                    <option value="C04 Fixed With solar blind" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_four')->first()->value == 'C04 Fixed With solar blind' ? 'selected' : '' }}>C04 Fixed With solar blind</option>
                                                    <option value="C04 Manual Vented" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_four')->first()->value == 'C04 Manual Vented' ? 'selected' : '' }}>C04 Manual Vented</option>
                                                    <option value="C04 Manual vented with solar blind" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_four')->first()->value == 'C04 Manual vented with solar blind' ? 'selected' : '' }}>C04 Manual vented with solar blind</option>
                                                    <option value="C04 Solar Vented" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_four')->first()->value == 'C04 Solar Vented' ? 'selected' : '' }}>C04 Solar Vented</option>
                                                    <option value="C04 Solar Vented with solar blind" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_four')->first()->value == 'C04 Solar Vented with solar blind' ? 'selected' : '' }}>C04 Solar Vented with solar blind</option>
                                                    <option value="0" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_four')->first()->value == '0' ? 'selected' : '' }}>0</option>
                                                </select>
                                            </td>
                                            <input type="hidden" name="labels[size_five][name]" value="Sizes">
                                            <td colspan="" class="no-border">
                                                <select class="form-select" aria-label="Default select example" name="labels[size_five][value]">
                                                    <option selected value="C04 fixed" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_five')->first()->value == 'C04 fixed' ? 'selected' : '' }}>C04 fixed</option>
                                                    <option value="C04 Fixed With solar blind" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_five')->first()->value == 'C04 Fixed With solar blind' ? 'selected' : '' }}>C04 Fixed With solar blind</option>
                                                    <option value="C04 Manual Vented" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_five')->first()->value == 'C04 Manual Vented' ? 'selected' : '' }}>C04 Manual Vented</option>
                                                    <option value="C04 Manual vented with solar blind" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_five')->first()->value == 'C04 Manual vented with solar blind' ? 'selected' : '' }}>C04 Manual vented with solar blind</option>
                                                    <option value="C04 Solar Vented" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_five')->first()->value == 'C04 Solar Vented' ? 'selected' : '' }}>C04 Solar Vented</option>
                                                    <option value="C04 Solar Vented with solar blind" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_five')->first()->value == 'C04 Solar Vented with solar blind' ? 'selected' : '' }}>C04 Solar Vented with solar blind</option>
                                                    <option value="0" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_five')->first()->value == '0' ? 'selected' : '' }}>0</option>
                                                </select>
                                            </td>
                                            <input type="hidden" name="labels[size_six][name]" value="Sizes">
                                            <td colspan="" class="no-border">
                                                <select class="form-select" aria-label="Default select example" name="labels[size_six][value]">
                                                    <option selected value="C04 fixed" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_six')->first()->value == 'C04 fixed' ? 'selected' : '' }}>C04 fixed</option>
                                                    <option value="C04 Fixed With solar blind" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_six')->first()->value == 'C04 Fixed With solar blind' ? 'selected' : '' }}>C04 Fixed With solar blind</option>
                                                    <option value="C04 Manual Vented" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_six')->first()->value == 'C04 Manual Vented' ? 'selected' : '' }}>C04 Manual Vented</option>
                                                    <option value="C04 Manual vented with solar blind" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_six')->first()->value == 'C04 Manual vented with solar blind' ? 'selected' : '' }}>C04 Manual vented with solar blind</option>
                                                    <option value="C04 Solar Vented" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_six')->first()->value == 'C04 Solar Vented' ? 'selected' : '' }}>C04 Solar Vented</option>
                                                    <option value="C04 Solar Vented with solar blind" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_six')->first()->value == 'C04 Solar Vented with solar blind' ? 'selected' : '' }}>C04 Solar Vented with solar blind</option>
                                                    <option value="0" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_six')->first()->value == '0' ? 'selected' : '' }}>0</option>
                                                </select>
                                            </td>
                                            <input type="hidden" name="labels[size_seven][name]" value="Sizes">
                                            <td colspan="" class="no-border">
                                                <select class="form-select" aria-label="Default select example" name="labels[size_seven][value]">
                                                    <option selected value="C04 fixed" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_seven')->first()->value == 'C04 fixed' ? 'selected' : '' }}>C04 fixed</option>
                                                    <option value="C04 Fixed With solar blind" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_seven')->first()->value == 'C04 Fixed With solar blind' ? 'selected' : '' }}>C04 Fixed With solar blind</option>
                                                    <option value="C04 Manual Vented" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_seven')->first()->value == 'C04 Manual Vented' ? 'selected' : '' }}>C04 Manual Vented</option>
                                                    <option value="C04 Manual vented with solar blind" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_seven')->first()->value == 'C04 Manual vented with solar blind' ? 'selected' : '' }}>C04 Manual vented with solar blind</option>
                                                    <option value="C04 Solar Vented" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_seven')->first()->value == 'C04 Solar Vented' ? 'selected' : '' }}>C04 Solar Vented</option>
                                                    <option value="C04 Solar Vented with solar blind" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_seven')->first()->value == 'C04 Solar Vented with solar blind' ? 'selected' : '' }}>C04 Solar Vented with solar blind</option>
                                                    <option value="0" {{ $lead->productPricingEstimateCalculator->productPricingEstimateCalculatorLabels->where('section', 'size_seven')->first()->value == '0' ? 'selected' : '' }}>0</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><input class="form-control" type="text" id="plywood" required name="labels[plywood][name]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','plywood')->first()->name??'Plywood'}}"></td>
                                            <td class="green"><input class="form-control" type="number" required min="1" id="plywood_value" name="labels[plywood][value]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','plywood')->first()->value??'1'}}"></td>
                                            <td><input class="form-control" type="text" id="skylight_price" required name="labels[skylight_price][name]" value="Skylight Price"></td>
                                            <td colspan="" class="no-border"><input class="form-control" type="number" required min="1" id="skylight_price_value" name="labels[skylight_price][value]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','cover_porch')->first()->value??'1'}}"></td>
                                            <td><input class="form-control" type="text" id="flat_areas" required name="labels[flat_areas][name]" value="Flat Areas"></td>
                                            <td colspan="3" class="no-border"><input class="form-control" required type="number" id="flat_areas" name="labels[flat_areas][value]" value="{{@$lead->sidingEstimateCalculator->sidingEstimateCalculatorLabels->where('section','shatter')->first()->value??'1'}}"></td>
                                        </tr>

                                    </table>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Skylight Size</th>
                                            <th>Skylight Quantity</th>
                                            <th>Skylight Price</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($skylights as $index => $skylight)
                                            <tr>
                                                <td><input class="form-control" name="skylight[size_{{ $index }}][size][]" value="{{ $skylight->size }}"></td>
                                                <td><input class="form-control" name="skylight[size_{{ $index }}][quantity][]" value="{{ $skylight->quantity }}"></td>
                                                <td><input class="form-control" name="skylight[size_{{ $index }}][price][]" value="{{ $skylight->price }}"></td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td id="sizePriceTableBody">

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    {{--  labels ends--}}
                                @else
                                    <div class="d-flex flex-row justify-content-between">
                                        <div class="form-group w-25">
                                            <select name="lead_id" class="form-control select2" id="product_pricing_estimate_calculator_lead_id" required>
                                                <option value="">Select Lead</option>
                                                @foreach($leads as $lead)
                                                    <option value="{{$lead->id}}" @if(isset($productpricingestimatecalculator) && $productpricingestimatecalculator->lead_id == $lead->id) selected @endif>{{$lead->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="lead_back_btn">
                                                <a class="btn secondary_btn" href="{{ url('productPricingEstimateCalculator/product-pricing-estimate-calculator') }}"><i class="icon-arrow-left-circle" aria-hidden="true"></i> Back </a>
                                            </div>
                                        </div>
                                    </div>
                                    {{--  labels starts--}}
                                    <table class="table table-bordered">
                                        <tr>
                                            <td colspan="3" width="200">Lead Name:</td>
                                            <td colspan="" id="lead_number">{{$productpricingestimatecalculator->Lead->lead_number??"000"}}</td>
                                            <td colspan="2" class="no-border" id="Lead_title">{{$productpricingestimatecalculator->Lead->title??""}}</td>
{{--                                            <td colspan="2" class="no-border"></td>--}}
{{--                                            <td class="no-border"></td>--}}
                                            <td colspan="">Date:</td>
                                            <td width="200" colspan="3" class="green" id="lead_date" >{{$productpricingestimatecalculator->Lead->lead_date??"000"}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><input class="form-control" type="text" id="home_style" required name="labels[home_style][name]" value="Home Style" ></td>
                                            <td colspan=""><input class="form-control" type="text" min="1" required id="home_style_value" name="labels[home_style][value]" placeholder="Type Here"></td>
                                            <td><input class="form-control" type="text" id="stories" required name="labels[stories][name]" value="Stories"></td>
                                            <td colspan="" class="green"><input class="form-control" required type="number" min="1" id="stories_value" name="labels[stories][value]" value="1"></td>
                                            <td><input class="form-control" type="text" id="layers" required name="labels[layers][name]" value="Layers"></td>
                                            <td class="green" colspan="3"><input class="form-control" type="number" required min="1" id="layers_value" name="labels[layers][value]" value="1"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><input required class="form-control" type="text" id="chimneySizes" name="labels[chimney_sizes][name]" value="Chimney Sizes"></td>
                                            <td colspan="2" class="green"><input required class="form-control" type="number" min="1" id="chimney_sizes" name="labels[chimney_sizes][value]" value="1"></td>
                                            <td colspan="2"><input class="form-control" type="text" id="pitch" required name="labels[pitch][name]" value="Pitch"></td>
                                            <td colspan="3" class="green"><input class="form-control" required type="number" min="1" id="pitch" name="labels[pitch][value]"value="1"></td>
                                        </tr>
                                        <tr>
                                            <td><input class="form-control" type="text" id="pipe_boots" required name="labels[pipe_boots][name]" value="Pipe Boots"></td>
                                            <td class="green"><input class="form-control" type="number" required min="1" id="pipe_boots_value" name="labels[pipe_boots][value]" value="1"></td>
                                            <td><input class="form-control" type="text" id="bathroom_vent" required name="labels[bathroom_vent][name]" value="Bathroom Vent"></td>
                                            <td class="no-border"><input class="form-control" required type="number" id="bathroom_vent_value" name="labels[bathroom_vent][value]" value="1"></td>
{{--                                            <td><input class="form-control" type="text" id="skylights" required name="labels[sky_light_one][name]" value="Skylights"></td>--}}
{{--                                            <td class="no-border"><input class="form-control" required type="number" id="skyLights_value" name="labels[sky_light_one][value]" value="1"></td>--}}
{{--                                            <input class="form-control" type="hidden" id="sizes" required name="labels[sky_light_two][name]" value="Skylights">--}}
{{--                                            <td colspan="" class="no-border"><input class="form-control" required type="number" id="skyLights_value" name="labels[sky_light_two][value]" value="1"></td>--}}

{{--                                            <input class="form-control" type="hidden" id="sizes" required name="labels[sky_light_three][name]" value="Skylights">--}}
{{--                                            <td colspan="" class="no-border"><input class="form-control" required type="number" id="skyLights_value" name="labels[sky_light_three][value]" value="1"></td>--}}

{{--                                            <input class="form-control" type="hidden" id="sizes" required name="labels[sky_light_four][name]" value="Skylights">--}}
{{--                                            <td colspan="" class="no-border"><input class="form-control" required type="number" id="skyLights_value" name="labels[sky_light_four][value]" value="1"></td>--}}

{{--                                            <input class="form-control" type="hidden" id="sizes" required name="labels[sky_light_five][name]" value="Skylights">--}}
{{--                                            <td colspan="" class="no-border"><input class="form-control" required type="number" id="skyLights_value" name="labels[sky_light_five][value]" value="1"></td>--}}
                                        </tr>
                                        <tr>
                                            <td><input class="form-control" type="text" id="sizes" required name="labels[sizes][name]" value="Sizes"></td>
                                            <td class="green">
                                                <select class="form-select" aria-label="Default select example" name="labels[sizes][value]">
                                                    <option selected value="4">4</option>
                                                    <option value="3">3</option>
                                                    <option value="2">2</option>
                                                    <option value="1.5">1 1/2</option>
                                                </select>
                                            </td>
                                            <td><input class="form-control" type="text" id="sizes" required name="labels[size_two][name]" value="Sizes"></td>
                                            <td class="green"><input class="form-control" type="number" required min="1" id="sizes_value" name="labels[size_two][value]" value="1"></td>
{{--                                            <td><input class="form-control" type="text" id="sizes" required name="labels[size_three][name]" value="Sizes"></td>--}}
{{--                                            <td class="no-border">--}}
{{--                                                <select class="form-select" aria-label="Default select example" name="labels[size_three][value]" >--}}
{{--                                                    <option selected value="C04 fixed">C04 fixed</option>--}}
{{--                                                    <option value="C04 Fixed With solar blind">C04 Fixed With solar blind</option>--}}
{{--                                                    <option value="C04 Manual Vented">C04 Manual Vented</option>--}}
{{--                                                    <option value="C04 Manual vented with solar blind">C04 Manual vented with solar blind</option>--}}
{{--                                                    <option value="C04 Solar Vented">C04 Solar Vented</option>--}}
{{--                                                    <option value="C04 Solar Vented with solar blind">C04 Solar Vented with solar blind</option>--}}
{{--                                                    <option value="0">0</option>--}}
{{--                                                </select>--}}
{{--                                            </td>--}}
{{--                                            <input class="form-control" type="hidden" id="sizes" required name="labels[size_four][name]" value="Sizes">--}}
{{--                                            <td colspan="" class="no-border">--}}
{{--                                                <select class="form-select" aria-label="Default select example" name="labels[size_four][value]">--}}
{{--                                                    <option selected value="C04 fixed">C04 fixed</option>--}}
{{--                                                    <option value="C04 Fixed With solar blind">C04 Fixed With solar blind</option>--}}
{{--                                                    <option value="C04 Manual Vented">C04 Manual Vented</option>--}}
{{--                                                    <option value="C04 Manual vented with solar blind">C04 Manual vented with solar blind</option>--}}
{{--                                                    <option value="C04 Solar Vented">C04 Solar Vented</option>--}}
{{--                                                    <option value="C04 Solar Vented with solar blind">C04 Solar Vented with solar blind</option>--}}
{{--                                                    <option value="0">0</option>--}}
{{--                                                </select>--}}
{{--                                            </td>--}}
{{--                                            <input class="form-control" type="hidden" id="sizes" required name="labels[size_five][name]" value="Sizes">--}}
{{--                                            <td colspan="" class="no-border">--}}
{{--                                                <select class="form-select" aria-label="Default select example" name="labels[size_five][value]">--}}
{{--                                                    <option selected value="C04 fixed">C04 fixed</option>--}}
{{--                                                    <option value="C04 Fixed With solar blind">C04 Fixed With solar blind</option>--}}
{{--                                                    <option value="C04 Manual Vented">C04 Manual Vented</option>--}}
{{--                                                    <option value="C04 Manual vented with solar blind">C04 Manual vented with solar blind</option>--}}
{{--                                                    <option value="C04 Solar Vented">C04 Solar Vented</option>--}}
{{--                                                    <option value="C04 Solar Vented with solar blind">C04 Solar Vented with solar blind</option>--}}
{{--                                                    <option value="0">0</option>--}}
{{--                                                </select>--}}
{{--                                            </td>--}}
{{--                                            <input class="form-control" type="hidden" id="sizes" required name="labels[size_six][name]" value="Sizes">--}}
{{--                                            <td colspan="" class="no-border">--}}
{{--                                                <select class="form-select" aria-label="Default select example" name="labels[size_six][value]">--}}
{{--                                                    <option selected value="C04 fixed">C04 fixed</option>--}}
{{--                                                    <option value="C04 Fixed With solar blind">C04 Fixed With solar blind</option>--}}
{{--                                                    <option value="C04 Manual Vented">C04 Manual Vented</option>--}}
{{--                                                    <option value="C04 Manual vented with solar blind">C04 Manual vented with solar blind</option>--}}
{{--                                                    <option value="C04 Solar Vented">C04 Solar Vented</option>--}}
{{--                                                    <option value="C04 Solar Vented with solar blind">C04 Solar Vented with solar blind</option>--}}
{{--                                                    <option value="0">0</option>--}}
{{--                                                </select>--}}
{{--                                            </td>--}}
{{--                                            <input class="form-control" type="hidden" id="sizes" required name="labels[size_seven][name]" value="Sizes">--}}
{{--                                            <td colspan="" class="no-border">--}}
{{--                                                <select class="form-select" aria-label="Default select example" name="labels[size_seven][value]">--}}
{{--                                                    <option selected value="C04 fixed">C04 fixed</option>--}}
{{--                                                    <option value="C04 Fixed With solar blind">C04 Fixed With solar blind</option>--}}
{{--                                                    <option value="C04 Manual Vented">C04 Manual Vented</option>--}}
{{--                                                    <option value="C04 Manual vented with solar blind">C04 Manual vented with solar blind</option>--}}
{{--                                                    <option value="C04 Solar Vented">C04 Solar Vented</option>--}}
{{--                                                    <option value="C04 Solar Vented with solar blind">C04 Solar Vented with solar blind</option>--}}
{{--                                                    <option value="0">0</option>--}}
{{--                                                </select>--}}
{{--                                            </td>--}}
                                        </tr>
                                        <tr>
                                            <td colspan="3"><input class="form-control" type="text" id="plywood" required name="labels[plywood][name]" value="Plywood"></td>
                                            <td class="green"><input class="form-control" type="number" required min="1" id="plywood_value" name="labels[plywood][value]" value="1"></td>
{{--                                            <td><input class="form-control" type="text" id="skylight_price" required name="labels[skylight_price][name]" value="Skylight Price"></td>--}}
{{--                                            <td colspan="" class="no-border"><input class="form-control" type="number" required min="1" id="skylight_price_value" name="labels[skylight_price][value]" value="1"></td>--}}
                                            <td><input class="form-control" type="text" id="flat_areas" required name="labels[flat_areas][name]" value="Flat Areas"></td>
                                            <td colspan="3" class="no-border"><input class="form-control" required type="number" id="flat_areas" name="labels[flat_areas][value]" value="1"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="10">
                                                <button type="button"
                                                        class="green_btn borderRadius add_size_modal_btn pull-left"
                                                        data-toggle="modal"
                                                        data-target="#addSizeModal">Add Skylight
                                                </button>
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="table table-bordered" id="sizePriceTableBody">
                                        <thead>
                                        <tr>
                                            <th>Skylight Size</th>
                                            <th>Skylight Quantity</th>
                                            <th>Skylight Price</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                    </table>
                                @endif
                            </div>

                            <div class="col-lg-12">
                                @if(isset($lead->productPricingEstimateCalculator) && isset($lead->productPricingEstimateCalculator->productPricingEstimateCalculatorEaveRakes))

                                    {{--eave rakes starts--}}
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Letter</th>
                                            <th>Eave</th>
                                            <th></th>
                                            <th>Rakes</th>
                                            <th></th>
                                            <th>Eave Final Rakes</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($lead->productPricingEstimateCalculator->productPricingEstimateCalculatorEaveRakes as $letter)
                                            <tr>
                                                <td>{{ $letter->section ?? ''}}</td>
                                                <td class="green"><input class="form-control eave" type="number" name="eave_rakes[{{$letter->section}}][eave][]" value="{{$letter->eave??'0'}}" min="0"></td>
                                                <td class="green">X</td>
                                                <td class="green"><input class="form-control rakes" type="number" name="eave_rakes[{{$letter->section}}][rakes][]" value="{{$letter->rakes??'0'}}" min="0"></td>
                                                <td class="green">X</td>
                                                <td class="green"><input class="form-control eave_final_rakes" type="number" name="eave_rakes[{{$letter->section}}][eave_final_rakes][]" value="{{$letter->eave_final_rakes??'0'}}" min="0"></td>
                                                <td class="green"><input class="form-control calculate-final-value-eave-rakes" type="number" name="eave_rakes[{{$letter->section}}][calculate_final_value_eave_rakes][]" readonly value="{{$letter->calculate_final_value_eave_rakes??'0'}}" min="0"></td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <td colspan="3">SUBTOTAL</td>
{{--                                            <td></td>--}}
{{--                                            <td></td>--}}
{{--                                            <td colspan="4"></td>--}}
{{--                                            <td></td>--}}
                                            <td colspan="3"></td>
                                            <td><input id="sub_total_eave_rakes" type="number" class="form-control" name="eave_rakes_subtotal" min="0" readonly></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">WASTE (%)</td>
{{--                                            <td></td>--}}
{{--                                            <td colspan="4"></td>--}}
                                            <td class="green"><input id="waste_eave_rakes" type="number" class="form-control" name="waste_eave_rakes" min="0" value="10"></td>
{{--                                            <td></td>--}}
                                            <td colspan="2"></td>
                                            <td class="green"><input id="sub_total_with_waste" type="number" class="form-control" name="waste_percent_eave_rakes" min="0" value="10" readonly></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">SQFT</td>
{{--                                            <td></td>--}}
{{--                                            <td></td>--}}
{{--                                            <td colspan="4"></td>--}}
{{--                                            <td></td>--}}
                                            <td colspan="3"></td>
                                            <td class="no-border"> <input id="total_eave_rakes" type="number" class="form-control" name="eave_rakes_total" min="0" value="0" readonly></td>
                                        </tr>
                                        <tr>
{{--                                            <td></td>--}}
{{--                                            <td></td>--}}
{{--                                            <td colspan="4"></td>--}}
{{--                                            <td></td>--}}
{{--                                            <td></td>--}}
                                            <td colspan="6"></td>
                                            <td class="no-border"> <input id="divide_total_eave_rakes" type="number" class="form-control" name="eave_rakes_total_percent" value="0" min="0" readonly></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    {{--eave rakes ends--}}

                                @else

                                    {{--eave rakes starts--}}
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Letter</th>
                                            <th>Eave</th>
                                            <th></th>
                                            <th>Rakes</th>
                                            <th></th>
                                            <th>Eave Final Rakes</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            function generateLetters($start, $end) {
                                                $letters = [];
                                                for ($i = ord($start); $i <= ord($end); $i++) {
                                                    $letters[] = chr($i);
                                                }
                                                return $letters;
                                            }

                                            $letters = generateLetters('A', 'O');
                                        @endphp
                                        @foreach ($letters as $letter)
                                            <tr>
                                                <td>{{ $letter }}</td>
                                                <td class="green"><input class="form-control eave" type="number" name="eave_rakes[{{$letter}}][eave][]" value="0" min="0"></td>
                                                <td class="green">X</td>
                                                <td class="green"><input class="form-control rakes" type="number" name="eave_rakes[{{$letter}}][rakes][]" value="0" min="0"></td>
                                                <td class="green">X</td>
                                                <td class="green"><input class="form-control eave_final_rakes" type="number" name="eave_rakes[{{$letter}}][eave_final_rakes][]" value="1" min="0"></td>
                                                <td class="green"><input class="form-control calculate-final-value-eave-rakes" type="number" name="eave_rakes[{{$letter}}][eave_final_rakes_total][]" readonly value="1" min="0"></td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3">SUBTOTAL</td>
{{--                                            <td></td>--}}
{{--                                            <td></td>--}}
{{--                                            <td colspan="4"></td>--}}
{{--                                            <td></td>--}}
                                            <td colspan="3"></td>
                                            <td><input id="sub_total_eave_rakes" type="number" class="form-control" name="eave_rakes_sub_total" min="0" readonly></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">WASTE (%)</td>
{{--                                            <td></td>--}}
{{--                                            <td colspan="4"></td>--}}
                                            <td class="green"><input id="waste_eave_rakes" type="number" class="form-control" name="eave_rakes_waste" min="0" value="10"></td>
{{--                                            <td></td>--}}
                                            <td colspan="2"></td>
                                            <td class="green"><input id="sub_total_with_waste" type="number" class="form-control" name="eave_rakes_total_waste" min="0" value="10" readonly></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">SQFT</td>
{{--                                            <td></td>--}}
{{--                                            <td></td>--}}
{{--                                            <td colspan="4"></td>--}}
{{--                                            <td></td>--}}
                                            <td colspan="3"></td>
                                            <td class="no-border"> <input id="total_eave_rakes" type="number" class="form-control" name="eave_rakes_total" min="0" value="0" readonly></td>
                                        </tr>
                                        <tr>
{{--                                            <td></td>--}}
{{--                                            <td></td>--}}
{{--                                            <td colspan="4"></td>--}}
{{--                                            <td></td>--}}
{{--                                            <td></td>--}}
                                            <td colspan="6"></td>
                                            <td class="no-border"> <input id="divide_total_eave_rakes" type="number" class="form-control" name="eave_rakes_total_percent" value="0" min="0" readonly></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    {{--eave rakes ends--}}


                                @endif


                                <br>

                                @if(isset($lead->productPricingEstimateCalculator) && isset($lead->productPricingEstimateCalculator->productPricingEstimateCalculatorFlatArea))
                                    {{-- FLATAREA starts--}}
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Flat Areas</th>
                                            <th>Eaves</th>
                                            <th class="no-border"></th>
                                            <th >Rakes</th>
                                            <th class="no-border"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($lead->productPricingEstimateCalculator->productPricingEstimateCalculatorFlatArea as $letter)
                                            <tr>
                                                <td>{{ $letter->section??"" }}</td>
                                                <td class="green"><input class="form-control eave_flat_area" type="number" name="flat_area[{{ $letter->section }}][eave][]" value="{{$letter->eave??'0'}}" min="0"></td>
                                                <td class="green">X</td>
                                                <td class="green"><input class="form-control rakes_flat_area" type="number" name="flat_area[{{ $letter->section }}][rakes][]" value="{{$letter->rakes??'0'}}" min="0"></td>
                                                <td class="green"><input class="form-control calculate-final-value-flat-area" type="number" name="flat_area[{{ $letter->section }}][eave_rakes_total][]" readonly value="{{$letter->eave_rakes_total??'0'}}" min="0"></td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="2">SUBTOTAL</td>
                                            <td colspan=""></td>
{{--                                            <td></td>--}}
                                            <td><input id="sub_total_flat_area" type="number" class="form-control" name="eave_rakes_sub_total" min="0" value="0" readonly></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">WASTE (%)</td>
{{--                                            <td colspan="3"></td>--}}
                                            <td class="green"><input id="flat_waste_eave_rakes" type="number" class="form-control" name="waste_eave_rakes" min="0" value="10"></td>
                                            <td class="green"><input id="flat_sub_total_with_waste" type="number" class="form-control" name="waste_percent_eave_rakes" min="0" value="10" readonly></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">TOTAL</td>
                                            <td colspan=""></td>
{{--                                            <td></td>--}}
                                            <td class="no-border"> <input id="total_eave_flat_area" type="number" class="form-control" name="eave_rakes_total" min="0" value="0" readonly></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    {{-- FLATAREA ends--}}
                                @else
                                    {{-- FLATAREA starts--}}
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Flat Areas</th>
                                            <th>Eaves</th>
                                            <th class="no-border"></th>
                                            <th >Rakes</th>
                                            <th class="no-border"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            function generateLettersFlatArea($start, $end) {
                                                $letters = [];
                                                for ($i = ord($start); $i <= ord($end); $i++) {
                                                    $letters[] = chr($i);
                                                }
                                                return $letters;
                                            }

                                            $letters = generateLettersFlatArea('A', 'O');
                                        @endphp
                                        @foreach ($letters as $letter)
                                            <tr>
                                                <td>{{ $letter }}</td>
                                                <td class="green"><input class="form-control eave_flat_area" type="number" name="flat_area[{{ $letter }}][eave][]" value="0" min="0"></td>
                                                <td class="green">X</td>
                                                <td class="green"><input class="form-control rakes_flat_area" type="number" name="flat_area[{{ $letter }}][rakes][]" value="0" min="0"></td>
                                                <td class="green"><input class="form-control calculate-final-value-flat-area" type="number" name="flat_area[{{ $letter }}][eave_rakes_total][]" readonly value="0" min="0"></td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="2">SUBTOTAL</td>
{{--                                            <td colspan="2"></td>--}}
                                            <td></td>
                                            <td><input id="sub_total_flat_area" type="number" class="form-control" name="eave_rakes_flat_area_sub_total" value="0" min="0" readonly></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">WASTE (%)</td>
{{--                                            <td colspan="2"></td>--}}
                                            <td class="green"><input id="flat_waste_eave_rakes" type="number" class="form-control" name="eave_rakes_flat_area_waste" min="0" value="10"></td>
                                            <td class="green"><input id="flat_sub_total_with_waste" type="number" class="form-control" name="eave_rakes_total_flat_area_waste" min="0" value="10" readonly></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">TOTAL</td>
{{--                                            <td colspan="2"></td>--}}
                                            <td></td>
                                            <td class="no-border"> <input id="total_eave_flat_area" type="number" class="form-control" name="eave_rakes_flat_area_total" min="0" value="0" readonly></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    {{-- FLATAREA ends--}}
                                @endif
                                <br>

                                @if(isset($lead->roofEstimateCalculator) && isset($lead->roofEstimateCalculator->roofEstimateCalculatorDownspouts))

                                    {{-- guarders starts--}}
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Gutters</th>
                                            <th>Downspouts</th>
                                            <th>G. Guards</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($lead->roofEstimateCalculator->roofEstimateCalculatorDownspouts as $index)
                                            <tr>
                                                <td></td>
                                                <td class="green"><input class="form-control gutters" type="number" name="downspouts[gutters][]" value="{{$index->gutters??''}}" min="0"></td>
                                                <td class="green"><input class="form-control downspouts" type="number" name="downspouts[downspouts][]" value="{{$index->downspouts??''}}" min="0"></td>
                                                <td class="green"><input class="form-control guards" type="number" name="downspouts[guards][]" value="{{$index->guards??''}}" min="0"></td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td>sub total</td>
                                            <td class="orange"> <input class="form-control" type="number" id="sub_total_gutters" name="sub_total_gutters" readonly @if(isset($lead->roofEstimateCalculator) && $lead->roofEstimateCalculator)  value="{{$lead->roofEstimateCalculator->sub_total_gutters??'0'}}" @else value="0" @endif min="0"></td>
                                            <td class="orange" ><input class="form-control" type="number" id="sub_total_downspouts" name="sub_total_downspouts" readonly @if(isset($lead->roofEstimateCalculator) && $lead->roofEstimateCalculator)  value="{{$lead->roofEstimateCalculator->sub_total_downspouts??'0'}}" @else value="0" @endif min="0"></td>
                                            <td class="orange"><input class="form-control" type="number" id="sub_total_guards" name="sub_total_guards" readonly @if(isset($lead->roofEstimateCalculator) && $lead->roofEstimateCalculator)  value="{{$lead->roofEstimateCalculator->sub_total_guards??'0'}}" @else value="0" @endif min="0"></td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td colspan="3" class="orange"><input class="form-control" type="number" id="total_all" name="total_all_guards" readonly @if(isset($lead->roofEstimateCalculator) && $lead->roofEstimateCalculator)  value="{{$lead->roofEstimateCalculator->total_all_guards??'0'}}" @else value="0" @endif min="0"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    {{-- guarders ends--}}

                                @else

                                    {{-- guarders starts--}}
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Gutters</th>
                                            <th>Downspouts</th>
                                            <th>G. Guards</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach (range(1, 5) as $index)
                                            <tr>
                                                <td></td>
                                                <td class="green"><input class="form-control gutters" type="number" name="downspouts[gutters][]" value="0" min="0"></td>
                                                <td class="green"><input class="form-control downspouts" type="number" name="downspouts[downspouts][]" value="0" min="0"></td>
                                                <td class="green"><input class="form-control guards" type="number" name="downspouts[guards][]" value="0" min="0"></td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td>sub total</td>
                                            <td class="orange"> <input class="form-control" type="number" id="sub_total_gutters" name="gutter_sub_total" readonly value="0" min="0"></td>
                                            <td class="orange" ><input class="form-control" type="number" id="sub_total_downspouts" name="downspout_sub_total" readonly value="0" min="0"></td>
                                            <td class="orange"><input class="form-control" type="number" id="sub_total_guards" name="guards_sub_total" readonly value="0" min="0"></td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td colspan="3" class="orange"><input class="form-control" type="number" id="total_all" name="total_all_downspouts" readonly value="0" min="0"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    {{-- guarders ends--}}

                                @endif
                                <br>
                                <table class="table table-bordered">
                                    {{--                                    <tr>--}}
                                    {{--                                        <td>Total SQ</td>--}}
                                    {{--                                        <td class="green"><input class="form-control" type="number" id="total_sq" name="total_sq" readonly @if(isset($lead->roofEstimateCalculator) && $lead->roofEstimateCalculator)  value="{{$lead->roofEstimateCalculator->total_sq??'0'}}" @else value="0" @endif min="0"></td>--}}
                                    {{--                                    </tr>--}}
                                    <tr>
                                        <td>Notes:</td>
                                        <td class="no-border"><input class="form-control" type="text" id="note" name="note" @if(isset($lead->roofEstimateCalculator) && $lead->roofEstimateCalculator)  value="{!!  $lead->roofEstimateCalculator->note??'' !!}"   @endif placeholder="Enter Any Notes"></td>
                                    </tr>
                                </table>
                                <button type="submit" class="green_btn borderRadius btn-submit" onclick="this.disabled = true; this.form.submit();">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="addSizeModal" tabindex="-1" role="dialog" aria-labelledby="addSizeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSizeModalLabel">Add Size</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Modal Body Content -->
                    <div class="form-group">
                        <label for="sizeName">Skylight Quantity</label>
                        <input type="text" class="form-control" placeholder="Enter Quantity.." id="quantity" placeholder="Enter quantity">
                    </div>
                    <div class="form-group">
                        <label for="sizeName">Skylight Price</label>
                        <input type="text" class="form-control" placeholder="Enter Price.." id="sizePrice" placeholder="Enter size">
                    </div>
                    <div class="form-group">
                        <label for="sizeDescription">Size</label>
                        <select class="form-select custom_modal_select2" data-placeholder="Select Size" aria-label="Default select example" id="sizeSelection" name="labels[size_one][value]">
                            @foreach($calculatorSizes as $calculatorSize)
                                <option>{{ $calculatorSize->name??"" }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="secondary_btn" data-dismiss="modal">Close</button>
                    <button type="button" class="green_btn" id="addSize" data-dismiss="modal">Add</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {


            // Initialize a counter
            var rowCounter = 1;
            $('#addSize').on('click', function() {
                var quantity = $('#quantity').val();
                var size = $('#sizeSelection').val();
                var price = $('#sizePrice').val();
                var newRow = `
                            <td><input class="form-control size-input" type="text" name="skylight[size_${rowCounter}][size][]" value="${size}"></td>
                            <td><input class="form-control size-quantity" type="text" name="skylight[size_${rowCounter}][quantity][]" value="${quantity}"></td>
                            <td><input class="form-control price-input" type="text" name="skylight[size_${rowCounter}][price][]" value="${price}"></td>
                            `;
                $('#sizePriceTableBody').append(newRow);
                rowCounter++;
                $('#addSizeModal').modal('hide');
                $('#sizeQuantity').val('');
                $('#sizePrice').val('');
                $('#sizeSelection').prop('selectedIndex', 0);
            });
        });

        function calculateRowTotal(eave, rakes, finalRakes) {
            return eave * rakes * finalRakes;
        }//ends calculateRowTotal
        function updateTotals() {
            let subtotal = 0;
            $('table.table tbody tr').each(function() {
                const eave = parseFloat($(this).find('.eave').val()) || 0;
                const rakes = parseFloat($(this).find('.rakes').val()) || 0;
                const finalRakes = parseFloat($(this).find('.eave_final_rakes').val()) || 0;
                const rowTotal = calculateRowTotal(eave, rakes, finalRakes);
                $(this).find('.calculate-final-value-eave-rakes').val(rowTotal);
                subtotal += rowTotal;
            });
            $('#sub_total_eave_rakes').val(subtotal);
            const wastePercentage = parseFloat($('#waste_eave_rakes').val()) || 0;
            const total = subtotal * (1 + (wastePercentage / 100));
            $('#total_eave_rakes').val(total.toFixed(2));
        }//ends updateTotals

        $(document).on('input', '.eave, .rakes, .eave_final_rakes, #waste_eave_rakes,#divide_total_eave_rakes', function() {
            updateTotals();
            calculateTotalSQ()
            flatWastePercent()
            eaveRakesTotalPercent()
        });
        $(document).ready(function() {
            updateTotals();
            updateTotalsFlatArea();
            updateTotalsGuttersSection();
        });
        function calculateRowTotalFlatArea(eave, rakes) {
            return eave * rakes;
        }//ends calculateRowTotalFlatArea
        function updateTotalsFlatArea() {
            let subtotal = 0;
            $('table.table tbody tr').each(function() {
                const eave = parseFloat($(this).find('.eave_flat_area').val()) || 0;
                const rakes = parseFloat($(this).find('.rakes_flat_area').val()) || 0;
                const rowTotal = calculateRowTotalFlatArea(eave, rakes);
                $(this).find('.calculate-final-value-flat-area').val(rowTotal);
                subtotal += rowTotal;
            });
            $('#sub_total_flat_area').val(subtotal);
            // const wastePercentage = parseFloat($('#waste_eave_flat_area').val()) || 0;
            // const total = subtotal * (1 + (wastePercentage / 100));
            // $('#total_eave_flat_area').val(total.toFixed(2));
        }//ends updateTotalsFlatArea
        $(document).on('input', '.eave_flat_area, .rakes_flat_area, #waste_eave_flat_area,#waste_eave_rakes,#sub_total_eave_rakes,#flat_waste_eave_rakes,#sub_total_flat_area,#flat_sub_total_with_waste', function() {
            updateTotalsFlatArea();
            calculateTotalSQ()
            flatWastePercent()
            eaveRakesWastePercent()
            flatEaveRakesTotalPercent()
        });
        function updateTotalsGuttersSection() {
            let subTotalGutters = 0;
            let subTotalDownspouts = 0;
            let subTotalGuards = 0;
            $('table.table tbody tr').each(function() {
                const gutters = parseFloat($(this).find('.gutters').val()) || 0;
                const downspouts = parseFloat($(this).find('.downspouts').val()) || 0;
                const guards = parseFloat($(this).find('.guards').val()) || 0;
                subTotalGutters += gutters;
                subTotalDownspouts += downspouts;
                subTotalGuards += guards;
            });
            $('#sub_total_gutters').val(subTotalGutters);
            $('#sub_total_downspouts').val(subTotalDownspouts);
            $('#sub_total_guards').val(subTotalGuards);
            const totalAll = subTotalGutters + subTotalDownspouts + subTotalGuards;
            $('#total_all').val(totalAll);
        }//ends updateTotalsGuttersSection
        $(document).on('input', '.gutters, .downspouts, .guards', function() {
            updateTotalsGuttersSection();
            calculateTotalSQ()
            flatWastePercent()
        });
        function calculateTotalSQ() {
            var total_eave_rakes =  $('#total_eave_rakes').val() / 100;
            $('#total_sq').val(total_eave_rakes.toFixed(2));
        }//ends calculateTotalSQ

        function flatWastePercent(){
            var wasteVal = parseFloat($('#waste_eave_rakes').val()) || 0;
            var eaveRakesVal = parseFloat($('#sub_total_eave_rakes').val()) || 0;
            var totalVal = (eaveRakesVal * wasteVal) / 100;
            $('#sub_total_with_waste').val(totalVal.toFixed(2));

        }
        function eaveRakesWastePercent(){
            var subTotalVal = parseFloat($('#sub_total_flat_area').val()) || 0;
            var subWasteVal = parseFloat($('#flat_waste_eave_rakes').val()) || 0;
            var totalValans = (subTotalVal * subWasteVal) / 100;
            $('#flat_sub_total_with_waste').val(totalValans.toFixed(2));

        }
        function eaveRakesTotalPercent(){
            var totalValper = parseFloat($('#total_eave_rakes').val()) || 0;
            var AnswerVal = (totalValper) / 100;
            $('#divide_total_eave_rakes').val(AnswerVal.toFixed(2));

        }
        function flatEaveRakesTotalPercent(){
            var valValue1 = parseFloat($('#sub_total_flat_area').val()) || 0;
            var valValue2 = parseFloat($('#flat_sub_total_with_waste').val()) || 0;
            var AnswerVal3 = valValue1 + valValue2;
            $('#total_eave_flat_area').val(AnswerVal3.toFixed(2));

        }
        flatWastePercent();
        eaveRakesTotalPercent();
        eaveRakesWastePercent();
        flatEaveRakesTotalPercent();


        $(document).on('change', '#product_pricing_estimate_calculator_lead_id', function() {
            var leadId = $(this).val();
            $.ajax({
                url: '{{ url("lead_detail") }}/' + leadId,
                type: 'GET',
                success: function(response) {
                    if (response.lead) {
                        $('#lead_number').text(response.lead.lead_number ?? "000");
                        $('#Lead_title').text(response.lead.title ?? "");
                        $('#lead_date').text(response.lead.lead_date ?? "000");
                    }//ends if....
                },
                error: function(xhr) {
                    console.error(xhr);
                }
            });
        });
    </script>
@endpush
