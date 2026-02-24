@extends('layouts.master')
@push('css')
    @section('content')
        <section class="white-box">
            @can('add-'.str_slug('Product'))
                <a class="btn btn-success pull-right" href="{{ url('/product/product/create') }}"><i class="icon-plus"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Product') }}</a>
            @endcan
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
                    <form action class="row" method="post" id="store_product_material_list">
                        @csrf
                        <div class="col-md-8">
{{--                            <form method="get" action="{{url('lead_card_view')}}" id="filter-form">--}}
                                <div class=" filter_inputs_btns_wrapper form-group">
                                    <input type="hidden" name="lead_filter" value="yes">
                                    <div class="mb-3 filter_inputs_parent">
                                        <label for="Select Category" class="form-label input_labels p-18">Select Product Category</label>
                                        <select class="form-control clr_input_fields borderRadius select2" id="categoryFilter" name="category_id" >
                                            <option value="" selected>Select Product Category</option>
                                            @foreach($productCategories as $category)
                                                <option value="{{$category->id}}" {{  request()->get('category_id') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 filter_inputs_parent">
                                        <label for="Select Category" class="form-label input_labels p-18">Select Product Category</label>
                                        <select class="form-control clr_input_fields borderRadius select2" id="categoryFilter" name="category_id" >
                                            <option value="" selected>Select Sub Category</option>
{{--                                            @foreach($productCategories as $category)--}}
{{--                                                <option value="{{$category->id}}" {{  request()->get('category_id') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>--}}
{{--                                            @endforeach--}}
                                        </select>
                                    </div>
                                    <div class="  filter_inputs_parent filter_btns_parent">
                                        <div class="reset_apply_btn">
                                            <a href="#" class="btn border_btns borderRadius">Reset</a>
                                            <button type="submit" class="btn border_btns borderRadius">Apply</button>
                                        </div>
                                    </div>
                                </div>
{{--                            </form>--}}
                        </div>
                        <div class="col-md-4 search_input_wrapper mt-3">
                            <input type="text" style="display: inline-block" class="form-control clr_input_fields borderRadius" id="searchInput" name="search" placeholder="Search...">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>PRODUCT</th>
                                    <th>Sub Category</th>
                                    <th>Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($product as $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $value->productCategory->name }}</td>
                                    <td class="green">{{ $value->sub_category }}</td>
                                    <td class="green">${{ number_format($value->price, 2) }}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    @endsection
    @push('js')
        <script>

        </script>
    @endpush