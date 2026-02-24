@extends('layouts.master')

@push('css')
<link href="{{asset('plugins/components/horizontal-timeline/css/horizontal-timeline.css')}}" rel="stylesheet">
<style>

</style>
@endpush
@section('content')
    <section class="create_order_sec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="create_order_heading">
                        <h1>Create Order</h1>
                    </div>
                </div>
                <div class="col-md-12">
                    <form id="order_form"  class="create_order_form" method="POST">
                        @csrf
                        <div class="form-header">
                            <div class="step-item" id="1">1</div>
                            <div class="step-item" id="2">2</div>
                            <div class="step-item" id="2">3</div>
                            <div class="step-item" id="2">4</div>
                            <div class="step-item" id="2">5</div>
                            <div class="step-item" id="2">6</div>
                            <div class="step-item" id="2">7</div>
                            <div class="step-item" id="2">8</div>
                            <div class="step-item" id="2">9</div>
                            {{--<div class="step-item">10</div>--}}
                        </div>
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                        <input type="hidden" name="order_id" id="order_id" value="{{$orderDetails->id??'0'}}">
                            <div class="tab" id="1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="create-order-content">
                                        <h3>General Information</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">This Sheet Created By </label>
                                        <input type="text" name="sheet_created_by" value="{{auth()->user()->name??""}}" id="sheet_created_by" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">What Location Is This Catering For</label>

                                        @if(auth()->user()->id == '2')
                                        <div class="form-group">
                                            <select name="type_of_service_id" id="type_of_service_id" class="form-control service">
                                                @foreach($locations as $location)
                                                    <option value="{{$location->id}}" @if(isset($orderDetails) && $location->id == $orderDetails->type_of_service_id) selected @endif>{{$location->name??""}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                            @else
                                            <input type="text" class="form-control" name="catering_location" value="{{auth()->user()->getLocation->name??""}}"   id="catering_location" required readonly>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">What Is The Name Of This Catering?</label>
                                        <input type="text" class="form-control" name="name_catering" @if(isset($orderDetails) && $orderDetails->name_catering) value="{{$orderDetails->name_catering??""}}" @endif  id="name_catering" placeholder="Catering Name" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Company </label>
                                        <input type="text" class="form-control" name="company" @if(isset($orderDetails) && $orderDetails->company) value="{{$orderDetails->company??""}}" @endif   id="company" placeholder="Company" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Contact Name</label>
                                        <input type="text" class="form-control" name="contact_name" @if(isset($orderDetails) && $orderDetails->contact_name) value="{{$orderDetails->contact_name??""}}" @endif  id="contact" placeholder="Contact Name" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Phone Number </label>
                                        <input type="number" class="form-control" name="phone_number" id="phone_number" @if(isset($orderDetails) && $orderDetails->phone_number) value="{{$orderDetails->phone_number??""}}" @endif  placeholder="Phone Number" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="email">Email </label>
                                        <input type="email" class="form-control" name="email" value="{{auth()->user()->email??""}}" placeholder="Email" required readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab" id="2">
                            <div class="row form_main_sec">
                                <div class="col-md-12">
                                    <div class="create-order-content" >
                                        <h3>Delivery Information</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Contact Name (For Delivery) </label>
                                        <input type="text" class="form-control" name="contact_name_for_delivery" @if(isset($orderDetails) && $orderDetails->contact_name_for_delivery) value="{{$orderDetails->contact_name_for_delivery??""}}" @endif  id="contact_name_for_delivery" placeholder="John">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Phone Number (For Delivery) </label>
                                        <input type="number" class="form-control" name="phone_number_for_delivery" @if(isset($orderDetails) && $orderDetails->phone_number_for_delivery) value="{{$orderDetails->phone_number_for_delivery??""}}" @endif  id="phone_number_for_delivery" placeholder="number">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Number Of People? </label>
                                        <input type="number" class="form-control" @if(isset($orderDetails) && $orderDetails->number_of_people) value="{{$orderDetails->number_of_people??""}}" @endif name="number_of_people" id="number_of_people" placeholder="number">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Date </label>
                                        <input type="Date" class="form-control" @if(isset($orderDetails) && $orderDetails->date_delivery) value="{{$orderDetails->date_delivery??""}}" @endif name="date_delivery" id="date"  placeholder="Contact">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Day Of The Week? </label>
                                        <div class="form-group">
                                            <select name="days_of_week" id="days" class="form-control days_of_week">
                                                <option value="Monday" @if(isset($orderDetails) && $orderDetails->days_of_week == 'Monday') selected @endif>Monday</option>
                                                <option value="Tuesday" @if(isset($orderDetails) && $orderDetails->days_of_week == 'Tuesday') selected @endif>Tuesday</option>
                                                <option value="Wednesday" @if(isset($orderDetails) && $orderDetails->days_of_week == 'Wednesday') selected @endif>Wednesday</option>
                                                <option value="Thursday" @if(isset($orderDetails) && $orderDetails->days_of_week == 'Thursday') selected @endif>Thursday</option>
                                                <option value="Friday" @if(isset($orderDetails) && $orderDetails->days_of_week == 'Friday') selected @endif>Friday</option>
                                                <option value="Saturday" @if(isset($orderDetails) && $orderDetails->days_of_week == 'Saturday') selected @endif>Saturday</option>
                                                <option value="Sunday" @if(isset($orderDetails) && $orderDetails->days_of_week == 'Sunday') selected @endif>Sunday</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">What Time should the food Leave Moe's?</label>
                                        <input type="Time" class="form-control" @if(isset($orderDetails) && $orderDetails->food_leave_time) value="{{$orderDetails->food_leave_time??""}}" @endif name="food_leave_time" placeholder="Phone Number">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Type Of Service? </label>
                                        <div class="form-group">
                                            <select name="type_of_service_id" id="type_of_service_id" class="form-control service">
                                                @foreach($typesofservices as $services)
                                                    <option value="{{$services->id}}" @if(isset($orderDetails) && $services->id == $orderDetails->type_of_service_id) selected @endif>{{$services->name??""}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">What Is The Delivery Address? </label>
                                        <input type="text" class="form-control" name="delivery_address" @if(isset($orderDetails) && $orderDetails->delivery_address) value="{{$orderDetails->delivery_address??""}}" @endif id="delivery_address" placeholder="Location">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">What Is The Delivery Fee? </label>
                                        <input type="number" class="form-control" @if(isset($orderDetails) && $orderDetails->delivery_fee) value="{{$orderDetails->delivery_fee??""}}" @endif name="delivery_fee" placeholder="John">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">How Much Is The Gratuity? </label>
                                        <input type="number" class="form-control" @if(isset($orderDetails) && $orderDetails->gratuity) value="{{$orderDetails->gratuity??""}}" @endif name="gratuity" id="gratuity" placeholder="Company">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">What Time Should The Food Be Delivered?</label>
                                        <input type="Time" class="form-control" placeholder="Phone Number" @if(isset($orderDetails) && $orderDetails->food_be_delivered_time) value="{{$orderDetails->food_be_delivered_time??""}}" @endif name="food_be_delivered_time" id="food_be_delivered_time">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form_selectfield_row">
                                        <label class="control-label">Do They Need Plates? (Y/N)? </label>
                                        <div class="form-group">
                                            <select name="need_plates" id="need_plates"  class="form-control Choice">
                                                <option value="yes" @if(isset($orderDetails) && $orderDetails->need_plates == 'yes') selected @endif >Yes</option>
                                                <option value="no" @if(isset($orderDetails) && $orderDetails->need_plates == 'no') selected @endif >No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 @if(isset($orderDetails) && $orderDetails->need_plates == 'yes') active @else hide-field-plate @endif">
                                    <div class="form-group">
                                        <label class="control-label">Regular Plates Or Small Plates?</label>
                                        <div class="form-group">
                                            <select name="regular_plates_or_small" id="regular_plates_or_small" class="form-control size">
                                                <option value="regular" @if(isset($orderDetails) && $orderDetails->regular_plates_or_small == 'regular') selected @endif >Regular</option>
                                                <option value="small" @if(isset($orderDetails) && $orderDetails->regular_plates_or_small == 'small') selected @endif>Small</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab">
                            <div class="row form_main_sec">
                                <div class="col-md-12">
                                    <div class="create-order-content" >
                                        <h3>Utensils Information</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form_selectfield_row ">
                                        <label class="control-label">Do They Need Utensils (Y/N)?</label>
                                        <div class="form-group">
                                            <select name="need_utensils" id="need_utensils" class="form-control  utensil Choice">
                                                <option value="Rolled Utensils" @if(isset($orderDetails) && $orderDetails->need_utensils == 'Rolled Utensils') selected @endif>Rolled Utensils</option>
                                                <option value="Utensil Packs" @if(isset($orderDetails) && $orderDetails->need_utensils == 'Utensil Packs') selected @endif>Utensil Packs</option>
                                                <option value="no" @if(isset($orderDetails) && $orderDetails->need_utensils == 'no') @endif>No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" id="utensilQtyContainer">
                                    <div class="form-group">
                                        <label for="input1">QTY</label>
                                        <div class="form-group">
                                            <input type="text" id="utensilPercentage" name="" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="col-md-12 @if(isset($orderDetails) && $orderDetails->need_utensils == 'yes') active @else hide-field-utensil @endif">--}}
                                    {{--<div class="row utensil_main_box">--}}
                                        {{--@if(isset($orderDetails) && $orderDetails->getUtensils)--}}
                                            {{--@foreach($orderDetails->getUtensils as $value)--}}
                                                {{--<div class="col-md-12">--}}
                                                    {{--<div class="row" id="row">--}}
                                                        {{--<div class="col-md-4">--}}
                                                            {{--<div class="form-group">--}}
                                                                {{--<label for="input1">Name</label>--}}
                                                                {{--<div class="form-group">--}}
                                                                    {{--<select name="utensil_id[]" class="form-control Meat-cat Role">--}}
                                                                        {{--@foreach($utensils as $utensil)--}}
                                                                            {{--<option value="{{ $utensil->id ?? '' }}" @if(isset($orderDetails) && $value->utensil_id == $utensil->id) selected @endif>{{ $utensil->name ?? '' }}</option>--}}
                                                                        {{--@endforeach--}}
                                                                    {{--</select>--}}
                                                                {{--</div>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col-md-4">--}}
                                                            {{--<div class="form-group">--}}
                                                                {{--<label for="input1">Utensil Packs Or Individual Utensils?</label>--}}
                                                                {{--<div class="form-group">--}}
                                                                    {{--<input type="text" id="" name="" class="form-control" value="">--}}
                                                                {{--</div>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col-md-4">--}}
                                                            {{--<div class="form-group">--}}
                                                                {{--<label for="input2">QTY</label>--}}
                                                                {{--<input type="number" id="input2" name="utensil_qty[]" class="form-control" value="{{$value->utensil_qty??""}}">--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--@endforeach--}}
                                        {{--@endif--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-12 @if(isset($orderDetails) && $orderDetails->need_utensils == 'yes') active @else hide-field-utensil @endif">--}}
                                    {{--<div class="btn_icon">--}}
                                        {{--<button class="btn add_utensil" type="button" id=""><i class="fa-solid fa-plus"></i></button>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="col-md-12">
                                    <div class="create-order-content">
                                        <h3>Drinks</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form_selectfield_row">
                                        <label class="control-label">Do They Want Drinks?</label>
                                        <div class="form-group">
                                            <select name="want_drinks" id="want_drinks" class="form-control Drink Choice" required>
                                                <option value="yes" @if(isset($orderDetails) && $orderDetails->want_drinks == 'yes') selected @endif>Yes</option>
                                                <option value="no" @if(isset($orderDetails) && $orderDetails->want_drinks == 'no') selected @endif>No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 @if(isset($orderDetails) && $orderDetails->want_drinks == 'yes') active @else hide-field-drink @endif">
                                    <div class="form-sec">
                                        <div class="form-col-div2">
                                            <div class="form-group">
                                                <label class="control-label">Cups </label>
                                                <div class="form-group">
                                                    <select name="want_drink_cups" id="want_drink_cups" class="form-control Cups" required>
                                                        <option value="yes" @if(isset($orderDetails) && $orderDetails->want_drink_cups == 'yes') selected @endif>Yes</option>
                                                        <option value="no" @if(isset($orderDetails) && $orderDetails->want_drink_cups == 'no') selected @endif>No</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-col-div2">
                                            <div class="form-group">
                                                <label class="control-label">Bags Of Ice
                                                </label>
                                                <div class="form-group">
                                                    <select name="want_drink_bags" id="want_drink_bags" class="form-control Bags">
                                                        <option value="yes" @if(isset($orderDetails) && $orderDetails->want_drink_bags == 'yes') selected @endif>Yes</option>
                                                        <option value="no" @if(isset($orderDetails) && $orderDetails->want_drink_bags == 'no') selected @endif>No</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-col-div2">
                                            <div class="form-group">
                                                <label class="control-label">Drink Dispensers </label>
                                                <div class="form-group">
                                                    <select name="want_drink_dispensers" id="want_drink_dispensers" class="form-control Dispensers">
                                                        <option value="yes" @if(isset($orderDetails) && $orderDetails->want_drink_dispensers == 'yes') selected @endif>Yes</option>
                                                        <option value="no" @if(isset($orderDetails) && $orderDetails->want_drink_dispensers == 'no') selected @endif>No</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-12 @if(isset($orderDetails) && $orderDetails->want_drinks == 'yes') active @else hide-field-drink @endif">
                                    <div class="row drinks_main_box">
                                        @if(isset($orderDetails) && $orderDetails->getdrinks)
                                            @foreach($orderDetails->getdrinks as $value)
                                                <div class="col-md-12">
                                                    <div class="row" id="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="input1">Name</label>
                                                                <div class="form-group">
                                                                    <select name="drink_id[]" class="form-control Meat-cat Role">
                                                                        @foreach($drinks as $drink)
                                                                            <option value="{{ $drink->id ?? '' }}" @if(isset($orderDetails) && $value->drink_id == $drink->id) selected @endif>{{ $drink->name ?? '' }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="input2">QTY</label>
                                                                <input type="number" id="input2" name="drink_qty[]" value="{{ $value->drink_qty }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="btn_icon">
                                                                <i class="fa fa-trash delete-row" aria-hidden="true" style="color: red;"></i>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12 @if(isset($orderDetails) && $orderDetails->want_drinks == 'yes') active @else hide-field-drink @endif">
                                    <div class="btn_icon">
                                        <button class="btn add_drinks" type="button" id=""><i class="fa-solid fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="create-order-content">
                                        <h3>Buns</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form_selectfield_row">
                                        <label class="control-label">Do They Need Buns?</label>
                                        <div class="form-group">
                                            <select name="need_buns" id="need_buns" class="form-control Choice Buns">
                                                <option value="Regular Buns" @if(isset($orderDetails) && $orderDetails->need_buns == 'yes') selected @endif>Regular Buns</option>
                                                <option value="Slider Buns" @if(isset($orderDetails) && $orderDetails->need_buns == 'Slider Buns') selected @endif>Slider Buns</option>
                                                <option value="Cornbread" @if(isset($orderDetails) && $orderDetails->need_buns == 'Cornbread') selected @endif>Cornbread</option>
                                                <option value="Slider Rolls" @if(isset($orderDetails) && $orderDetails->need_buns == 'Slider Rolls') selected @endif>Slider Rolls</option>
                                                <option value="no" @if(isset($orderDetails) && $orderDetails->need_buns == 'no') selected @endif>No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4" id="bunsqtyContainer">
                                    <div class="form-group">
                                        <label class="control-label">QTY</label>
                                        <div class="form-group">
                                            <input type="number" class="form-control hide_field" @if(isset($orderDetails) && $orderDetails->slider_rolls_per_person) value="{{$orderDetails->slider_rolls_per_person}}" @endif name="slider_rolls_per_person" id="slider_rolls_per_person" placeholder="Enter Quantity">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4  hide-field-corn">
                                    <div class="form-group">
                                        <label class="control-label">Catering Pieces Or '1/2' Pieces?</label>
                                        <input type="text" class="form-control hide_field" @if(isset($orderDetails) && $orderDetails->catering_pieces) value="{{$orderDetails->catering_pieces}}" @endif name="catering_pieces"  placeholder="Location">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="create-order-content">
                                        <h3>Sauces</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">How Many Bottles Of Red Sauce?</label>
                                        <input type="number" class="form-control" name="points_of_red_sauce" @if(isset($orderDetails) && $orderDetails->points_of_red_sauce) value="{!! $orderDetails->points_of_red_sauce !!}"  @endif placeholder="number">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">How Many Pints Of White Sauce? </label>
                                        <input type="number" class="form-control" name="points_of_white_sauce" @if(isset($orderDetails) && $orderDetails->points_of_white_sauce) value="{!! $orderDetails->points_of_white_sauce !!}" @endif id="points_of_white_sauce" placeholder="number">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">How Many Pints Of Pickles? </label>
                                        <input type="number" class="form-control" name="points_of_pickles" @if(isset($orderDetails) && $orderDetails->points_of_pickles) value="{!! $orderDetails->points_of_pickles !!}" @endif placeholder="number">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">How Many Individual Red Sauce? </label>
                                        <input type="number" class="form-control" name="individual_red_sauce" @if(isset($orderDetails) && $orderDetails->individual_red_sauce)   value="{!! $orderDetails->individual_red_sauce !!}"  @endif placeholder="number">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab">
                            <div class="row form_main_sec">
                                <div class="col-md-12">
                                    <div class="create-order-content" >
                                        <h3>Payment Information</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Payment Method </label>
                                        <div class="form-group">
                                            <select name="payment_method_id" id="payment_method_id" class="form-control Payment-Method">
                                                @forelse($paymentMethods as $paymentMethod)
                                                    <option value="{{$paymentMethod->id}}" @if(isset($orderDetails) && $orderDetails->payment_method_id == $paymentMethod->id) selected @endif>{{$paymentMethod->name??""}}</option>
                                                @empty
                                                    <option value="0">FINAL PAYMENT TBD</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab">
                            <div class="row form_main_sec">
                                <div class="col-md-12">
                                    <div class="create-order-content" >
                                        <h3>Enter Appetizer</h3>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div id="rowContainer" class=" row appetizer_main_box main_add_box">
                                        @if(isset($orderDetails) && $orderDetails->getTrayType)
                                            @foreach($orderDetails->getTrayType as $value)
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="input1">Tray Type</label>
                                                                <div class="form-group">
                                                                    <select name="tray_type_id[]" class="form-control Meat-cat" id="appetizer">
                                                                        <option></option>
                                                                        @foreach($trayTypes as $trayType)
                                                                            <option value="{{$trayType->id??""}}" @if(isset($orderDetails) && $value->tray_type_id == $trayType->id) selected @endif >{{$trayType->name??""}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="input2">How Many Trays?</label>
                                                                <input type="text" id="input2" name="trays_qty[]" value="{{$value->trays_qty}}" class="form-control" placeholder="12">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="btn_icon">
                                                                <label for="myCheckbox{{$loop->index}}" class="tick-checkbox">
                                                                    <input type="checkbox"  name="a_la_cart[]" @if(isset($orderDetails) && $value->a_la_cart == 'yes') checked @endif value="yes" id="myCheckbox{{$loop->index}}">
                                                                </label>
                                                                <p> A LA CART </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="btn_icon">
                                                                <i class="fa fa-trash delete-row" aria-hidden="true" style="color: red;"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="input1">Tray Type</label>
                                                            <div class="form-group">
                                                                <select name="tray_type_id[]" class="form-control Meat-cat" id="appetizer">
                                                                    <option></option>
                                                                    @foreach($trayTypes as $trayType)
                                                                        <option value="{{$trayType->id??""}}" >{{$trayType->name??""}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="input2">How Many Trays?</label>
                                                            <input type="text" id="input2" name="trays_qty[]" class="form-control" placeholder="12">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="btn_icon">
                                                            <label for="myCheckbox" class="tick-checkbox"> <input type="checkbox" name="a_la_cart[]" value="yes" id="myCheckbox"> </label>
                                                            <p> A LA CART </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="btn_icon">
                                                            <i class="fa fa-trash delete-row" aria-hidden="true" style="color: red;"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12 ">
                                    <div class="btn_icon">
                                        <button class="btn add_appetizer" type="button" id="addButton"><i class="fa-solid fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="create-order-content" >
                                        <h3>Enter Meat</h3>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row meat_cat_row main_add_box ">
                                        <div class="col-md-12 cat_main_col">
                                            @if(isset($orderDetails) && $orderDetails->getMeats)
                                                @foreach($orderDetails->getMeats as $value)
                                                    <div class="row duplicated_row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Meat Category </label>
                                                                <div class="form-group">
                                                                    <select name="meat_id[]" class="form-control meat_id Meat-cat">
                                                                        @foreach($meats as $meat)
                                                                            <option value="{{$meat->id??""}}" @if(isset($orderDetails) && $value->meat_id == $meat->id) selected @endif>{{$meat->name??""}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label class="control-label">%</label>
                                                                <input type="text" class="form-control" name="percentage_meat[]" value="{{$value->percentage_meat??""}}" placeholder="0%">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label class="control-label">Note </label>
                                                                <div class="form-group">
                                                                    <select class="form-control {{--meat_note_id--}}" name="meat_note_id[]">
                                                                        @foreach($meatNote as $note)
                                                                            <option value="{{ $note->id }}" @if(isset($orderDetails) && $value->meat_note_id == $note->id) selected @endif>{{ $note->note??''}} =>{{ $note->price??''}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label class="control-label">Assumption </label>
                                                                <input type="number" class="form-control" value="{{$value->assumption_qty??""}}" name="assumption_qty[]"  placeholder="Question">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="btn_icon">
                                                                <label for="meatcheckbox" class="tick-checkbox">
                                                                    <input type="checkbox" name="a_la_cart_meat[]" value="yes" id="meatcheckbox"
                                                                           @if(isset($value->a_la_cart_meat) && $value->a_la_cart_meat == 'yes') checked @endif>
                                                                </label>
                                                                <p> A LA CART </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="btn_icon">
                                                                <i class="fas fa-trash-alt delete-row" style="color: red;" ></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="row duplicated_row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Meat Category </label>
                                                            <div class="form-group">
                                                                <select name="meat_id[]" class="form-control meat_id Meat-cat">
                                                                    <option></option>
                                                                    @foreach($meats as $meat)
                                                                        <option value="{{$meat->id??""}}">{{$meat->name??""}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <label class="control-label">%</label>
                                                            <input type="text" class="form-control" name="percentage_meat[]" placeholder="0%">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="control-label">Note </label>
                                                            <div class="form-group">
                                                                <select class="form-control meat_note_id" name="meat_note_id[]">

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="control-label">Assumption </label>
                                                            <input type="number" class="form-control" name="assumption_qty[]"  placeholder="Question">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="btn_icon">
                                                            <label for="meatcheckbox" class="tick-checkbox">
                                                                <input type="checkbox" name="a_la_cart_meat[]" value="yes" id="meatcheckbox">
                                                            </label>
                                                            <p> A LA CART </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="btn_icon">
                                                            <i class="fas fa-trash-alt delete-row" style="color: red;" ></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 btn_icon ">
                                    <div class="btn_icon">
                                        <button class="btn add_cat_btn" type="button"><i class="fa-solid fa-plus"></i></button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="tab">
                            <div class="row form_main_sec">
                                <div class="col-md-12">
                                    <div class="create-order-content" >
                                        <h3>Enter Sides</h3>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div id="" class=" row sides_main_box main_add_box">
                                        @if(isset($orderDetails) && $orderDetails->getSides)
                                            @foreach($orderDetails->getSides as $value)
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="input1">Name</label>
                                                                <div class="form-group">
                                                                    <select name="side_id[]" class="form-control" id="">
                                                                        <option></option>
                                                                        @foreach($sides as $side)
                                                                            <option value="{{$side->id??""}}" @if(isset($orderDetails) && $value->side_id == $side->id) selected @endif  > {{$side->name??""}} </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="input2">QTY</label>
                                                                <input type="number" name="side_qty[]" value="{{$value->side_qty}}" class="form-control" placeholder="0">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="btn_icon">
                                                                <label for="sidesCheckbox{{$loop->index}}" class="tick-checkbox">
                                                                    <input type="checkbox" class="" name="a_la_cart_side[]" @if(isset($orderDetails) && $value->a_la_cart_side == 'yes') checked @endif  value="yes" id="sidesCheckbox{{$loop->index}}">
                                                                </label>
                                                                <p> A LA CART </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="btn_icon">
                                                                <i class="fas fa-trash-alt delete-row" style="color: red;" ></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="input1">Name</label>
                                                            <div class="form-group">
                                                                <select name="side_id[]" class="form-control" id="">
                                                                    <option></option>
                                                                    @foreach($sides as $side)
                                                                        <option value="{{$side->id??""}}"> {{$side->name??""}} </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="input2">QTY</label>
                                                            <input type="number" name="side_qty[]" class="form-control" placeholder="0">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="btn_icon">
                                                            <label for="sidesCheckbox" class="tick-checkbox">
                                                                <input type="checkbox" class="" name="a_la_cart_side[]" value="yes" id="sidesCheckbox">
                                                            </label>
                                                            <p> A LA CART </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="btn_icon">
                                                            <i class="fas fa-trash-alt delete-row" style="color: red;" ></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12 ">
                                    <div class="btn_icon">
                                        <button class="btn add_sides" type="button" id="addButton"><i class="fa-solid fa-plus"></i></button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="create-order-content" >
                                        <h3>Billing Information</h3>
                                        <h4>A La Carte Meats</h4>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="user_request_form">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th class="center">Item</th>
                                                    <th class="center">Name</th>
                                                    <th class="center">Qty</th>
                                                    <th class="center">Price</th>
                                                    <th class="center">Ext Price</th>
                                                </tr>
                                                </thead>
                                                <tbody id="meat_cat_row">
                                                <tfoot>
                                                <tr>
                                                    <td colspan="2"> </td>
                                                    <td class="right">Total </td>
                                                    <td>$<span id="total_meat_ext_price"></span></td>
                                                </tr>
                                                </tfoot>
                                                </tbody>
                                            </table>
                                            <div class="pagination-wrapper"> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="create-order-content">
                                        <h3>A La Carte Sides</h3>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="user_request_form">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th class="center">Item</th>
                                                    <th class="center">Name</th>
                                                    <th class="center">Qty</th>
                                                    <th class="center">Price</th>
                                                    <th class="center">Ext Price</th>
                                                </tr>
                                                </thead>
                                                <tbody id="sides_main_box">
                                                <tfoot>
                                                <tr>
                                                    <td colspan="2"> </td>
                                                    <td class="right">Total </td>
                                                    <td>$<span id="total_side_ext_price"></span></td>
                                                </tr>
                                                </tfoot>
                                                </tbody>
                                            </table>

                                            <div class="pagination-wrapper"> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="create-order-content">
                                        <h3>Chafing Pans</h3>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group form_selectfield_row">
                                        <label class="control-label">How Many Chafing Dishes? </label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" @if(isset($orderDetails) && $orderDetails->chafing_dishes) value="{{$orderDetails->chafing_dishes}}" @endif placeholder="How Many Chafing Dishes?" name="chafing_dishes">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Please Describe Each Chafer</label>
                                        <textarea id="w3review" class="form-control" name="describe_each_chafer" rows="3" cols="30">@if(isset($orderDetails) && $orderDetails->describe_each_chafer) {!! $orderDetails->describe_each_chafer !!} @endif</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="create-order-content">
                                        <h3>Drink</h3>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="user_request_form">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th class="center">Item</th>
                                                    <th class="center">Name</th>
                                                    <th class="center">Qty</th>
                                                    <th class="center">Price</th>
                                                    <th class="center">Ext Price</th>
                                                </tr>
                                                </thead>
                                                <tbody id="drinks_main_box">
                                                <tfoot>
                                                <tr>
                                                    <td colspan="2"> </td>
                                                    <td class="right">Total</td>
                                                    <td>$<span id="total_drink_ext_price"></span></td>
                                                </tr>
                                                </tfoot>

                                                </tbody>
                                            </table>
                                            <div class="pagination-wrapper"> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--<div class="tab">--}}
                        {{--<div class="row">--}}

                        {{--<div class="col-md-12">--}}
                        {{--<div class="create-order-content">--}}
                        {{--<h3>Buns & Cornbread</h3>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-12 align_center">--}}
                        {{--<div class="col-md-2">--}}
                        {{--<label class="control-label">How Many Buns? </label>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-3">--}}
                        {{--<input type="number" class="form-control" placeholder="">--}}
                        {{--</div>--}}
                        {{--<div class="col-md-3">--}}
                        {{--<label class="control-label">=</label>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-2">--}}
                        {{--<input type="number" class="form-control" placeholder="">--}}
                        {{--</div>--}}
                        {{--<div class="col-md-2">--}}
                        {{--<label class="control-label">bags </label>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-12 align_center">--}}
                        {{--<div class="col-md-2">--}}
                        {{--<label class="control-label">How Many Slider Buns? </label>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-3">--}}
                        {{--<input type="number" class="form-control" placeholder="">--}}
                        {{--</div>--}}
                        {{--<div class="col-md-3">--}}

                        {{--</div>--}}
                        {{--<div class="col-md-2">--}}
                        {{--<input type="number" class="form-control" placeholder="">--}}
                        {{--</div>--}}
                        {{--<div class="col-md-2">--}}
                        {{--<label class="control-label"> </label>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-12 align_center">--}}
                        {{--<div class="col-md-2">--}}
                        {{--<label class="control-label">How Many Cornbread Pieces? </label>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-3">--}}
                        {{--<input type="number" class="form-control" placeholder="">--}}
                        {{--</div>--}}
                        {{--<div class="col-md-3">--}}

                        {{--</div>--}}
                        {{--<div class="col-md-2">--}}
                        {{--<input type="number" class="form-control" placeholder="">--}}
                        {{--</div>--}}
                        {{--<div class="col-md-2">--}}
                        {{--<label class="control-label">Catering Pieces </label>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-12 align_center">--}}
                        {{--<div class="col-md-2">--}}

                        {{--</div>--}}
                        {{--<div class="col-md-3">--}}
                        {{--<input type="number" class="form-control" placeholder="">--}}
                        {{--</div>--}}
                        {{--<div class="col-md-3">--}}
                        {{--<label class="control-label">Regular Pieces Cut In 1/2 = </label>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-2">--}}
                        {{--<input type="number" class="form-control" placeholder="">--}}
                        {{--</div>--}}
                        {{--<div class="col-md-2">--}}
                        {{--<label class="control-label">Total Pieces </label>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-12">--}}
                        {{--<div class="create-order-content">--}}
                        {{--<h3>Plates & Utensils</h3>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-4">--}}
                        {{--<div class="form-group">--}}
                        {{--<label class="control-label">Plates </label>--}}
                        {{--<input type="number" class="form-control" placeholder="">--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-4">--}}
                        {{--<div class="form-group">--}}
                        {{--<label class="control-label">Forks </label>--}}
                        {{--<input type="number" class="form-control" placeholder="">--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-4">--}}
                        {{--<div class="form-group">--}}
                        {{--<label class="control-label">Knives--}}
                        {{--</label>--}}
                        {{--<input type="number" class="form-control" placeholder="">--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-4">--}}
                        {{--<div class="form-group">--}}
                        {{--<label class="control-label">Spoons </label>--}}
                        {{--<input type="number" class="form-control" placeholder="">--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-4">--}}
                        {{--<div class="form-group">--}}
                        {{--<label class="control-label">Wetnaps </label>--}}
                        {{--<input type="number" class="form-control" placeholder="">--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-4">--}}
                        {{--<div class="form-group">--}}
                        {{--<label class="control-label">Utensil Packs--}}
                        {{--</label>--}}
                        {{--<input type="number" class="form-control" placeholder="">--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-12">--}}
                        {{--<div class="create-order-content">--}}
                        {{--<h3>Paper Towels</h3>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-4">--}}
                        {{--<div class="form-group">--}}
                        {{--<label class="control-label">Rolls Of Paper Towels </label>--}}
                        {{--<input type="number" class="form-control" placeholder="">--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        <div class="tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="create-order-content" >
                                        <h3>Billing Information</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Taxable (T)?
                                        </label>
                                        <input type="text" name="taxable" class="form-control taxable" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Purchase Order #</label>
                                        <input type="number" name="purchase_order" value="{{rand(000000,111111)}}" class="form-control" placeholder="Phone Number">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-sec">
                                        <div class="form-col-sec">
                                            <div class="form-group">
                                                <label class="control-label"># PPL</label>
                                                <input class="form-control" @if(isset($orderDetails) && $orderDetails->number_of_people) value="{{$orderDetails->number_of_people??""}}" @endif name="ppl" value="{{ $order->number_of_people??"" }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-col-sec">
                                            <div class="form-group">
                                                <label class="control-label">Total Amount</label>
                                                {{--<span id="totalAmount">--}}
                                                <input type="text" class="form-control" name="total_amount" id="overall_total" readonly>

                                                {{--</span>--}}

                                            </div>

                                        </div>
                                        <div class="form-col-sec">
                                            <div class="form-group">
                                                <label class="control-label">A La Carte Total </label>
                                                <input type="number" class="form-control" name="a_la_carte_total" id="a_la_carte_total" value="150" readonly>
                                            </div>
                                        </div>
                                        <div class="form-col-sec">
                                            <div class="form-group">
                                                <label class="control-label">Subtotal</label>
                                                <input type="number" class="form-control" name="sub_total" id="sub_total" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-sec">
                                        <div class="form-col-sec">
                                            <div class="form-group">
                                                <label class="control-label">Delivery Price</label>
                                                <input type="number" class="form-control" name="delivery_price" id="delivery_price" value="1000">
                                            </div>
                                        </div>
                                        <div class="form-col-sec">
                                            <div class="form-group">
                                                <label class="control-label">(Before Tax)
                                                </label>
                                                <input type="number" class="form-control" name="before_tax" id="before_tax" readonly>
                                            </div>
                                        </div>
                                        <div class="form-col-sec">
                                            <div class="form-group">
                                                <label class="control-label">Tax </label>
                                                <input type="number" class="form-control" name="tax" id="tax" value="5" readonly>
                                            </div>
                                        </div>
                                        <div class="form-col-sec">
                                            <div class="form-group">
                                                <label class="control-label">(After Tax)</label>
                                                <input type="number" class="form-control" name="after_tax" id="after_tax" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="create-order-content">
                                        <h3>Deposit</h3>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-sec">
                                        <div class="form-col-sec">
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="deposit_amount" id="deposit" value="20000">
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="create-order-content">
                                        <h3>Remaining Balance</h3>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-sec">
                                        <div class="form-col-sec">
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="remaining_amount" id="remaining_amount" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="step_btn">
                            <button type="button" class="btn_red prevBtn" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                            <button type="button" class="btn_red  nextBtn" id="nextBtn" onclick="nextPrev(1)">Next</button>
                        </div>
                        <!-- Circles which indicates the steps of the form: -->
                        <div class="step_pagination ">
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script src="{{asset('plugins/components/horizontal-timeline/js/horizontal-timeline.js')}}"></script>
<script>
    $(document).ready(function() {
        var $needBunsDropdown = $("#need_buns");
        var $qtyContainer = $("#qtyContainer");

        // Initial state
        toggleQtyContainer();

        // Add an event listener to the need_buns dropdown
        $needBunsDropdown.on("change", toggleQtyContainer);

        function toggleQtyContainer() {
            if ($needBunsDropdown.val() === "no") {
                $qtyContainer.hide();
            } else {
                $qtyContainer.show();
            }
        }
    });

    $(document).ready(function() {
        var $needUtensilsDropdown = $("#need_utensils");
        var $qtyContainer = $("#utensilQtyContainer"); // Get the container div

        // Initial state
        toggleQtyContainer();

        // Add an event listener to the need_utensils dropdown
        $needUtensilsDropdown.on("change", toggleQtyContainer);

        function toggleQtyContainer() {
            if ($needUtensilsDropdown.val() === "no") {
                $qtyContainer.hide();
            } else {
                $qtyContainer.show();
            }
        }
    });

        $(document).ready(function() {
            var $numberOfPeople = $("#number_of_people");
            var $utensilPercentage = $("#utensilPercentage");

            $numberOfPeople.on("input", function() {
                var numberOfPeople = parseFloat($numberOfPeople.val());
                if (!isNaN(numberOfPeople)) {
                    var utensilPercentage = Math.round(numberOfPeople * 1.1); // Calculate and round off to nearest whole number
                    $utensilPercentage.val(utensilPercentage);
                } else {
                    $utensilPercentage.val("");
                }
            });
        });

    $(document).ready(function() {
        // Get references to the date and day input elements
        const $dateInput = $("#date");
        const $dayInput = $("#days");

        // Add an event listener to the date input to update the day input when a date is selected
        $dateInput.on("change", function() {
            const selectedDate = new Date($dateInput.val());
            const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            const dayOfWeek = daysOfWeek[selectedDate.getDay()];

            // Set the selected day in the day input
            $dayInput.val(dayOfWeek);
        });
    });


    $(document).ready(function() {
        // Function to update the table
        function updateTable() {
            var orderDetails = {
                meats: [],
                sides: [],
                drinks: []
            };

            $('.duplicated_row').each(function() {
                var meat = {};
                meat.name = $(this).find('select[name="meat_id[]"] option:selected').text();
                meat.assumption_qty = $(this).find('input[name="assumption_qty[]"]').val();
                meat.a_la_cart_meat = $(this).find('input[name="a_la_cart_meat[]"]').prop('checked') ? 'yes' : 'no';
                orderDetails.meats.push(meat);
            });

            $('.sides_main_box .col-md-12').each(function() {
                var side = {};
                side.name = $(this).find('select[name="side_id[]"] option:selected').text();
                side.side_qty = $(this).find('input[name="side_qty[]"]').val();
                orderDetails.sides.push(side);
            });

            $('.drinks_main_box .col-md-12').each(function() {
                var drink = {};
                drink.name = $(this).find('select[name="drink_id[]"] option:selected').text();
                drink.drink_qty = $(this).find('input[name="drink_qty[]"]').val();
                orderDetails.drinks.push(drink);
            });

            var tbodyMeat = $('#meat_cat_row');
            var tbodySide = $('#sides_main_box');
            var tbodyDrink = $('#drinks_main_box');

            tbodyMeat.empty();
            tbodySide.empty();
            tbodyDrink.empty();

            var totalMeatExtPrice = 0;
            var totalSideExtPrice = 0;
            var totalDrinkExtPrice = 0;

            // Update the meat table
            $.each(orderDetails.meats, function(index, meat) {
                var row = $('<tr>');
                row.append($('<td>').addClass('center').text(index + 1));
                row.append($('<td>').addClass('center').text(meat.name));
                row.append($('<td>').addClass('center').text(meat.assumption_qty));

                $.ajax({
                    url: '/meat',
                    method: 'GET',
                    data: { meat_name: meat.name },
                    success: function(response) {
                        var price = response.price || 0;
                        var quantity = meat.assumption_qty || 0;
                        var extPrice = price * quantity;
                        totalMeatExtPrice += extPrice;
                        row.append($('<td>').addClass('center').text(price));
                        row.append($('<td>').addClass('center').text(extPrice));
                        tbodyMeat.append(row);
                updateTotal();
                    },
                    error: function() {
                        // Handle error if the price retrieval fails
                    }
            });
            });

// Update the sides table
            $.each(orderDetails.sides, function(index, side) {
                var row = $('<tr>');
                row.append($('<td>').addClass('center').text(index + 1));
                row.append($('<td>').addClass('center').text(side.name));
                row.append($('<td>').addClass('center').text(side.side_qty));

                $.ajax({
                    url: '/side',
                    method: 'GET',
                    data: { side_name: side.name },
                    success: function(response) {
                        var price = response.price || 0;
                        var quantity = side.side_qty || 0;
                        var extPrice = price * quantity;
                        totalSideExtPrice += extPrice;
                        row.append($('<td>').addClass('center').text(price));
                        row.append($('<td>').addClass('center').text(extPrice));
                tbodySide.append(row);
                updateTotal();
                    }
            });
            });

            // Update the drinks table
            $.each(orderDetails.drinks, function(index, drink) {
                $.ajax({
                    url: '/drinks',
                    method: 'GET',
                    data: { drink_name: drink.name },
                    success: function(response) {
                        var row = $('<tr>');
                        row.append($('<td>').addClass('center').text(index + 1));
                        row.append($('<td>').addClass('center').text(drink.name));
                        row.append($('<td>').addClass('center').text(drink.drink_qty));

                        var price = response.price || 0;
                        var quantity = drink.drink_qty || 0;
                        var extPrice = price * quantity;
                        totalDrinkExtPrice += extPrice;
                        row.append($('<td>').addClass('center').text(response.price));
                        row.append($('<td>').addClass('center').text(extPrice));
                        tbodyDrink.append(row);
                        updateTotal();
                    }
                });
            });

            // Function to update the total values
            function updateTotal() {
                $('#total_meat_ext_price').text(totalMeatExtPrice);
                $('#total_side_ext_price').text(totalSideExtPrice);
                $('#total_drink_ext_price').text(totalDrinkExtPrice);

                // Calculate the overall total
                var overallTotal = totalMeatExtPrice + totalSideExtPrice + totalDrinkExtPrice;
                $('#overall_total').val(overallTotal);

                // Calculate the subtotal
                var aLaCarteTotal = parseInt($('#a_la_carte_total').val()) || 0; // Get the value of a_la_carte_total input field
                var subtotal = overallTotal + aLaCarteTotal;

                // Update the value of the subtotal input field
                $('#sub_total').val(subtotal);

                $('#before_tax').val(subtotal);

                var taxPercentage = parseFloat($('#tax').val()) || 0;
                var deliveryPrice = parseFloat($('#delivery_price').val()) || 0;
                var taxAmount = (subtotal * taxPercentage) / 100;
                var afterTax = subtotal + taxAmount + deliveryPrice;

                $('#after_tax').val(afterTax);
                var depositAmount = parseInt($('#deposit').val()) || 0;

                // Calculate the remaining amount
                var remainingAmount = afterTax - depositAmount;

                // Update the value of the remaining_amount input field
                $('#remaining_amount').val(remainingAmount);
            }
        }

        // Update the table when the input fields change
        $(document).on('change', 'input[name="assumption_qty[]"], select[name="meat_id[]"]', function() {
            updateTable();
        });

        $(document).on('change', 'input[name="side_qty[]"], select[name="side_id[]"], input[name="price[]"]', function() {
            updateTable();
        });

        $('.drinks_main_box').on('change', 'input[name="drink_qty[]"], select[name="drink_id[]"]', function() {
            updateTable();
        });

        $(".sides_main_box").on("click", ".delete-row", function() {
            var row = $(this).closest(".row");
            row.remove();
            updateTable();
        });
        $(".drinks_main_box").on("click", ".delete-row", function() {
            var row = $(this).closest(".row");
            row.remove();
            updateTable();
        });
        $(".meat_cat_row").on("click", ".delete-row", function() {
            var row = $(this).closest(".row");
            row.remove();
            updateTable();
        });
        // Initial table update
        updateTable();
    });


    jQuery('.form_main_sec .Choice').on('change', function () {
        jQuery('.form_main_sec .form_selectfield_row').addClass('active');
        var selectedValue = jQuery(this).val();
        console.log(selectedValue);
        if (selectedValue == 'yes') {
            jQuery('.hide-field-plate').css("display", "block");
            jQuery('.hide-field-plate input.form-control').attr('required', 'required');

        } else {
            jQuery('.hide-field-plate').css("display", "none");
            jQuery('.hide-field-plate input.form-control').removeAttr('required');
            jQuery('.hide-field-plate input.form-control').val('');

        }

    });

    jQuery('.form_main_sec .utensil').on('change', function () {
        jQuery('.form_main_sec .form_selectfield_row').addClass('active');

        var selectedValue = jQuery(this).val();
        console.log(selectedValue);
        if (selectedValue == 'yes') {
            jQuery('.hide-field-utensil').css("display", "block");
            jQuery('.hide-field-utensil input.form-control').attr('required', 'required');
        }  else {
            jQuery('.hide-field-utensil').css("display", "none");
            jQuery('.hide-field-utensil input.form-control').removeAttr('required');
            jQuery('.hide-field-utensil input.form-control').val('');
//                jQuery('.hide-field-utensil input.form-control').val('');
        }
    });

    jQuery('.form_main_sec .pack').on('change', function () {
        jQuery('.form_main_sec .form_selectfield_row').addClass('active');

        var selectedValue = jQuery(this).val();
        console.log(selectedValue);
        if (selectedValue == 'no') {
            jQuery('.hide-field-pack').css("display", "block");
            jQuery('.hide-field-pack input.form-control').attr('required', 'required');
            jQuery('.hide_field_utensil_pack').css("display", "none");
            jQuery('.hide_field_utensil_pack input.form-control').removeAttr('required');
        }
        else if (selectedValue == 'yes') {
            jQuery('.hide_field_utensil_pack').css("display", "block");
            jQuery('.hide_field_utensil_pack input.form-control').attr('required', 'required');
            jQuery('.hide-field-pack').css("display", "none");
            jQuery('.hide-field-pack input.form-control').removeAttr('required');
        }
        else {
            jQuery('.hide-field-pack').css("display", "none");
            jQuery('.hide-field-pack input.form-control').val('');
            jQuery('.hide-field-pack input.form-control').removeAttr('required');
            jQuery('.hide_field_utensil_pack').css("display", "none");
            jQuery('.hide_field_utensil_pack input.form-control').val('');
            jQuery('.hide_field_utensil_pack input.form-control').removeAttr('required');

        }
    });

    jQuery('.form_main_sec .Drink').on('change', function () {
        jQuery('.form_main_sec .form_selectfield_row').addClass('active');

        var selectedValue = jQuery(this).val();
        console.log(selectedValue);
        if (selectedValue == 'yes') {

            jQuery('.hide-field-drink').css("display", "block");
            jQuery('.hide-field-drink input.form-control').attr('required', 'required');
        }
        else{
            jQuery('.hide-field-drink').css("display", "none");
            jQuery('.hide-field-drink input.form-control').removeAttr('required');
            jQuery('.hide-field-drink input.form-control').val('');
        }
    });

    jQuery('.form_main_sec .Buns').on('change', function () {
        jQuery('.form_main_sec .form_selectfield_row').addClass('active');

        var selectedValue = jQuery(this).val();
        console.log(selectedValue);
        if (selectedValue == 'yes') {
            jQuery('.hide-field-buns').css("display", "block");
            // jQuery('.hide-field-slider').css("display", "block");
            // jQuery('.hide-field-corn').css("display", "block");
        }
        else {
            jQuery('.hide-field-buns').css("display", "none");
            // jQuery('.hide-field-slider').css("display", "none");
            // jQuery('.hide-field-corn').css("display", "none");
            jQuery('.hide-field-buns input.form-control').val('');
            jQuery('.hide-field-slider input.form-control').val('');
            jQuery('.hide-field-corn input.form-control').val('');
        }
    });

    jQuery('.form_main_sec .buns_slider').on('change', function () {
        var selectedValue = jQuery(this).val();
        console.log(selectedValue);
        if (selectedValue == 'Regular Buns') {
            jQuery('.hide_slider_buns').css("display", "none");
            jQuery('.hide_regular_buns').css("display", "block");

        } else if (selectedValue == 'Slider Buns') {
            jQuery('.hide_slider_buns').css("display", "block");
            jQuery('.hide_regular_buns').css("display", "none");
        } else {
            jQuery('.hide_slider_buns').css("display", "none");
            jQuery('.hide_regular_buns').css("display", "none");
            jQuery('.hide_slider_buns input.form-control').val('');
            jQuery('.hide_regular_buns input.form-control').val('');
        }
    });

    jQuery('.form_main_sec .Cornbread').on('change', function () {
        var selectedValue = jQuery(this).val();
        console.log(selectedValue);
        if (selectedValue == 'no') {
            jQuery('.hide-field-corn').css("display", "block");
        } else if (selectedValue == 'yes') {
            jQuery('.hide-field-corn').css("display", "none");
        } else {
            jQuery('.hide-field-corn').css("display", "none");
        }
    });

    jQuery('.form_main_sec .Coolers').on('change', function () {
        jQuery('.form_main_sec .form_selectfield_row').addClass('active');

        var selectedValue = jQuery(this).val();
        console.log(selectedValue);
        if (selectedValue == 'no') {
            jQuery('.hide-field-cooler').css("display", "none");
        } else if (selectedValue == 'yes') {
            jQuery('.hide-field-cooler').css("display", "block");
        } else {
            jQuery('.hide-field-cooler').css("display", "none");
        }
    });

    jQuery('.form_main_sec .Payment-Note').on('change', function () {
        jQuery('.form_main_sec .form_selectfield_row').addClass('active');

        var selectedValue = jQuery(this).val();
        console.log(selectedValue);
        if (selectedValue == 'no') {
            jQuery('.hide-field-Payment').css("display", "none");
        } else if (selectedValue == 'yes') {
            jQuery('.hide-field-Payment').css("display", "block");
        } else {
            jQuery('.hide-field-Payment').css("display", "none");
        }
    });

    // APPETIZER JAVASCRIPT===========================================================================

    $(document).ready(function() {
        var rowCounter = 0;
        $(".add_appetizer").click(function(event) {
            event.preventDefault(); // Prevent form submission or page refresh
            rowCounter++;
            var newRow = '<div class="col-md-12"> ' +
                '<div class="row" id="row' + rowCounter + '"> ' +
                '<div class="col-md-6"> ' +
                '<div class="form-group"> ' +
                '<label for="input1_' + rowCounter + '">Tray Type</label> ' +
                '<div class="form-group"> ' +
                '<select  name="tray_type_id[]"  class="form-control Meat-cat Role_' + rowCounter + '"> ' +
                    @foreach($trayTypes as $trayType)
                        '<option value="{{$trayType->id??""}}">{{$trayType->name??""}}</option> ' +
                    @endforeach
                        '</select> ' +
                '</div> ' +
                '</div> ' +
                '</div> ' +
                '<div class="col-md-4"> ' +
                '<div class="form-group"> ' +
                '<label for="input2_' + rowCounter + '">How Many Trays?</label> ' +
                '<input type="text" id="input2_' + rowCounter + '" name="trays_qty[]" class="form-control"> ' +
                '</div> ' +
                '</div> ' +
                '<div class="col-md-2"> ' +
                '<div class="btn_icon"> ' +
                '<label for="input3_' + rowCounter + '" class="tick-checkbox"> ' +
                '<input type="checkbox" name="a_la_cart[]" value="yes" id="input3_' + rowCounter + '"> ' +
                '</label> <p> A LA CART </p> ' +
                '</div> ' +
                '</div> ' +
                '<div class="col-md-2"> ' +
                '<div class="btn_icon"> ' +
                '<i class="fa fa-trash delete-row" aria-hidden="true" style="color: red;"></i> ' +
                '</div> ' +
                '</div> ' +
                '</div> ' +
                '</div>';
            $(".appetizer_main_box").append(newRow);
        });
        $(".appetizer_main_box").on("click", ".delete-row", function() {
            var row = $(this).closest(".row");
            row.remove();
        });
    });


    // MEAT JAVASCRIPT================================================================================================
    jQuery(document).ready(function() {
        var count = 0;
        jQuery('.add_cat_btn').click(function() {
            var newRow = '<div class="row duplicated_row"> ' +
                '<div class="col-md-3"> ' +
                '<div class="form-group"> ' +
                '<label class="control-label">Meat Category </label>' +
                '<div class="form-group"> ' +
                '<select name="meat_id[]" class="form-control meat_id Meat-cat">' +
                    @foreach($meats as $meat)
                        '<option value="{{$meat->id}}" selected="">{{$meat->name??""}}</option>'+
                    @endforeach
                        '</select> ' +
                '</div> ' +
                '</div> ' +
                '</div> ' +
                '<div class="col-md-1"> ' +
                '<div class="form-group"> ' +
                '<label class="control-label">%</label> ' +
                '<input type="text" class="form-control" name="percentage_meat[]" placeholder="0%"> ' +
                '</div> ' +
                '</div> ' +
                '<div class="col-md-2"> ' +
                '<div class="form-group"> ' +
                '<label class="control-label">Note </label>' +
                '<div class="form-group"> ' +
                '<select class="form-control meat_note_id" name="meat_note_id[]" style="display: block;"> ' +
                '</select> ' +
                '</div> ' +
                '</div> ' +
                '</div> ' +
                '<div class="col-md-2"> ' +
                '<div class="form-group"> ' +
                '<label class="control-label">Assumption </label> ' +
                '<input type="text" class="form-control" name="assumption_qty[]" placeholder="Question"> ' +
                '</div> ' +
                '</div> ' +
                '<div class="col-md-2"> ' +
                '<div class="btn_icon"> ' +
                '<label for="meatcheckbox_' + count +'" class="tick-checkbox"> ' +
                '<input type="checkbox" name="a_la_cart_meat[]" value="yes" id="meatcheckbox_' + count +'"> ' +
                '</label> <p> A LA CART </p> ' +
                '</div> ' +
                '</div> ' +
                '<div class="col-md-2"> ' +
                '<div class="btn_icon"> ' +
                '<i class="fa fa-trash delete-row" aria-hidden="true" style="color: red;"></i> ' +
                '</div> ' +
                '</div> ' +
                '</div>';

            jQuery(" .meat_cat_row .cat_main_col").append(newRow);
            count++;

        });
    });
    $(document).on('change', '.meat_id', function() {
        var id = 0;
        var meat_id = $(this).val();
        meatNoteDropdown(meat_id,id)
    });
    function meatNoteDropdown(meat_id,id){
        $.ajax({
            url: '{{route('meat_note_dropdown')}}',
            type: 'GET',
            data:{'id': id,'meat_id': meat_id},
            success: function(result) {
                $('.meat_note_id').html(result);
            },
            error:function(e){
                console.log(e.status);
            }
        });
    }//ends function meatNoteDropdown.

    $(document).ready(function() {
        var sidesCounter = 0;
        $(".add_sides").click(function(event) {
            event.preventDefault(); // Prevent form submission or page refresh
            sidesCounter++;
            var newRow = '<div class="col-md-12"> ' +
                '<div class="row" id="row' + sidesCounter + '"> ' +
                '<div class="col-md-6"> ' +
                '<div class="form-group"> ' +
                '<label for="input1_' + sidesCounter + '">Name</label> ' +
                '<div class="form-group"> ' +
                '<select name="side_id[]" class="form-control Meat-cat Role_' + sidesCounter + '"> ' +
                    @foreach($sides as $side)
                        '<option value="{{$side->id??""}}">{{$side->name??""}}</option> ' +
                    @endforeach
                        '</select> ' +
                '</div> ' +
                '</div> ' +
                '</div> ' +
                '<div class="col-md-2"> ' +
                '<div class="form-group"> ' +
                '<label for="input2_' + sidesCounter + '">QTY</label> ' +
                '<input type="number" id="input2_' + sidesCounter + '" name="side_qty[]" class="form-control"> ' +
                '</div> ' +
                '</div> ' +
                '<div class="col-md-2"> ' +
                '<div class="btn_icon"> <label for="input3_' + sidesCounter + '" class="tick-checkbox"> <input type="checkbox" name="a_la_cart_side[]" value="yes" id="input3_' + sidesCounter + '"> </label> <p> A LA CART </p> </div> </div> </div> </div>' +
                '<div class="col-md-2">' +
                '<div class="btn_icon">' +
                '<i class="fas fa-trash-alt delete-row" style="color: red;"></i>' +
                '</div>' +
                '</div>' +
                '</div>';
            $(".sides_main_box").append(newRow);
        });
    });

    $(document).ready(function() {
        var drinksCounter = 0;
        $(".add_drinks").click(function(event) {
            event.preventDefault(); // Prevent form submission or page refresh
            drinksCounter++;
            var newRow = '<div class="col-md-12"> ' +
                '<div class="row" id="row' + drinksCounter + '"> ' +
                '<div class="col-md-4"> <div class="form-group"> ' +
                '<label for="input1_' + drinksCounter + '">Name</label> ' +
                '<div class="form-group"> ' +
                '<select name="drink_id[]" class="form-control Meat-cat Role_' + drinksCounter + '"> ' +
                    @foreach($drinks as $drink)
                        '<option value="{{$drink->id??""}}">{{$drink->name??""}}</option> ' +
                    @endforeach
                        '</select> ' +
                '</div> ' +
                '</div> ' +
                '</div> ' +
                '<div class="col-md-4"> ' +
                '<div class="form-group"> ' +
                '<label for="input2_' + drinksCounter + '">QTY</label> ' +
                '<input type="number" id="input2_' + drinksCounter + '" name="drink_qty[]" class="form-control">' +
                '</div> ' +
                '</div>  ' +
                '<div class="col-md-4">' +
                '<div class="btn_icon">' +
                '<i class="fas fa-trash-alt delete-row" style="color: red;" ></i> ' +
                '</div>' +
                '</div>' +
                '</div>';
            $(".drinks_main_box").append(newRow);
        });
    });

        {{--$(document).ready(function() {--}}
            {{--var bunsCounter = 0;--}}
            {{--$(".add_buns").click(function(event) {--}}
                {{--event.preventDefault(); // Prevent form submission or page refresh--}}
                {{--bunsCounter++;--}}
                {{--var newRow = '<div class="col-md-12"> ' +--}}
                    {{--'<div class="row" id="row' + bunsCounter + '"> ' +--}}
                    {{--'<div class="col-md-4"> ' +--}}
                    {{--'<div class="form-group"> ' +--}}
                    {{--'<label for="input1_' + bunsCounter + '">Name</label> ' +--}}
                    {{--'<div class="form-group"> ' +--}}
                    {{--'<select name="bun_id[]" id="buns_id" class="form-control Meat-cat buns_id Role_' + bunsCounter + '"> ' +--}}
                    {{--'<option value="0"></option>' +--}}
                        {{--@foreach($buns as $bun)--}}
                            {{--'<option value="{{$bun->id}}">{{$bun->name??""}}</option> ' +--}}
                        {{--@endforeach--}}
                            {{--'</select> ' +--}}
                    {{--'</div> ' +--}}
                    {{--'</div> ' +--}}
                    {{--'</div> ' +--}}
                    {{--'<div class="col-md-4"> ' +--}}
                    {{--'<div class="form-group"> ' +--}}
                    {{--'<label for="input1_\' + bunsCounter + \'">Type</label> ' +--}}
                    {{--'<div class="form-group"> ' +--}}
                    {{--'<select name="bun_note_id[]"  class="form-control bun_note_id Meat-cat Role_\' + bunsCounter + \'"> ' +--}}

                    {{--'</select> ' +--}}
                    {{--'</div> ' +--}}
                    {{--'</div> ' +--}}
                    {{--'</div> ' +--}}
                    {{--'<div class="col-md-4"> ' +--}}
                    {{--'<div class="form-group"> ' +--}}
                    {{--'<label for="input2_' + bunsCounter + '">QTY</label> ' +--}}
                    {{--'<input type="number" id="input2_' + bunsCounter + '" name="bun_qty[]" class="form-control"> ' +--}}
                    {{--'</div> ' +--}}
                    {{--'</div>  ' +--}}
                    {{--'</div> ' +--}}
                    {{--'</div>';--}}
                {{--$(".buns_main_box").append(newRow);--}}
            {{--});--}}
        {{--});--}}
    $(document).on('change', '.buns_id', function() {
        var id = 0;
        var bun_id = $(this).val();
        noteNoteDropdown(bun_id,id)
    });
    function noteNoteDropdown(bun_id,id){
        $.ajax({
            url: '{{route('bun_note_dropdown')}}',
            type: 'GET',
            data:{'id': id,'bun_id': bun_id},
            success: function(result) {
                $('.bun_note_id').html(result);
            },
            error:function(e){
                console.log(e.status);
            }
        });
    }//ends function noteNoteDropdown.
    $(document).ready(function() {
        var utensilCounter = 0;
        $(".add_utensil").click(function(event) {
            event.preventDefault(); // Prevent form submission or page refresh
            utensilCounter++;
            var newRow = '<div class="col-md-12"> ' +
                '<div class="row" id="row' + utensilCounter + '"> ' +
                '<div class="col-md-4"> ' +
                '<div class="form-group"> ' +
                '<label for="input1_' + utensilCounter + '">Name</label> ' +
                '<div class="form-group"> ' +
                '<select name="utensil_id[]" class="form-control Meat-cat Role_' + utensilCounter + '"> ' +
                    @foreach($utensils as $utensil)
                        '<option value="{{$utensil->id??""}}">{{$utensil->name??""}}</option> ' +
                    @endforeach
                        '</select> ' +
                '</div> ' +
                '</div> ' +
                '</div> ' +
                '<div class="col-md-4"> ' +
                '<div class="form-group"> ' +
                '<label for="input1_\' + bunsCounter + \'">Utensil Packs Or Individual Utensils?</label> ' +
                '<div class="form-group"> ' +
                '<select name="packs_or_individual_utensils[]" id="packs_or_individual_utensils"  class="form-control Meat-cat Role_\' + bunsCounter + \'"> ' +
                '<option value="utensil_packs">Utensil Packs</option>' +
                '<option value="individual_utensils">Individual Utensils</option>' +
                '</select> ' +
                '</div> ' +
                '</div> ' +
                '</div> ' +
                '<div class="col-md-4"> ' +
                '<div class="form-group"> ' +
                '<label for="input2_' + utensilCounter + '">QTY</label> ' +
                '<input type="number" id="input2_' + utensilCounter + '" name="utensil_qty[]" class="form-control"> ' +
                '</div> ' +
                '</div>  ' +
                '</div> ' +
                '</div>';
            $(".utensil_main_box").append(newRow);
        });
    });
    // Step form
    var currentTab = 0;
    showTab(currentTab);

    function showTab(n) {
        var x = document.querySelectorAll(".tab");
        x[n].style.display = "block";

        var prevBtn = document.getElementById("prevBtn");
        var nextBtn = document.getElementById("nextBtn");

        if (n === 0) {
            prevBtn.style.display = "none";
        } else {
            prevBtn.style.display = "block";
        }

        if (n === x.length - 1) {
            nextBtn.textContent = "Submit";
        } else {
            var current_valid_fieldset_id = $(this).parent().closest('.tab').attr('id');
            var formData = new FormData($('#order_form')[0]);

           if (n > 0){
                $.ajax({
                    url: "{{ route('store_or_update_order_form') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        if (response.is_valid) { // Updated condition to check for truthiness
                            $('#order_id').val(response.order_detail_id);
                        } else {
                            $('#order_id').val(response.order_detail_id);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('Error:', textStatus, errorThrown);
                    }
                });
           }

            nextBtn.textContent = "Next";
        }

        fixStepIndicator(n);
    }

    function submitForm() {
        var form = document.getElementById("order_form");
        $('<input>', {type: 'hidden', name: 'status', value: 1}).appendTo(form);

        // Send the form data to the server using AJAX
        $.ajax({
            url: 'store_or_update_order_form',
            method: 'POST',
            data: $(form).serialize(),
            success: function(response) {
                // Handle the server response if needed
                console.log(response);
                // Show success message
            },
            error: function(xhr, status, error) {
                // Handle any errors that occur during the AJAX request
                console.log(error);
            }
        });
    }

    function nextPrev(n) {
        var x = document.querySelectorAll(".tab");

        if (n === 1 && !validateForm()) {
            return false;
        }

        x[currentTab].style.display = "none";
        currentTab += n;

        if (currentTab >= x.length) {
            showConfirmationDialog(); // Show the confirmation dialog
            return false;
        }

        showTab(currentTab);
    }

    function showConfirmationDialog() {
        swal({
            title: 'Are You Sure You Want To Submit The Form?',
            icon: "warning",
            buttons: ["Cancel","Yes!"],
            dangerMode: true,
        })
            .then(function(confirm) {
                if (confirm) {
                    submitForm();
                    swal("Form Submitted!", "Your form has been successfully submitted.", "success")
                        .then(function () {
                            // Redirect to a new page
                            window.location.href = "all_order";
                        });
                } else {
                    x[currentTab - 1].style.display = "block";
                }
            });
    }

    function validateForm() {
        var x = document.querySelectorAll(".tab");
        var y = x[currentTab].querySelectorAll("input");
        var valid = true;

        y.forEach(function (input) {
            if (input.hasAttribute("required") && input.value === "") {
                input.classList.add("invalid");
                valid = false;
            } else {
                input.classList.remove("invalid");
            }

            // Check for email field
            if (input.getAttribute("type") === "email" && !isValidEmail(input.value)) {
                input.classList.add("invalid");
                valid = false;
            }
        });

        var stepItems = document.querySelectorAll(".step-item");
        var currentStepItem = stepItems[currentTab];

        if (valid) {
            currentStepItem.classList.add("finish");
        } else {
            currentStepItem.classList.remove("finish");
        }

        return valid;
    }

    // Helper function to validate email format
    function isValidEmail(email)
    {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email)
            ;
    }

    function fixStepIndicator(n) {
        var x = document.querySelectorAll(".step");
        var x1 = document.querySelectorAll(".step-item");

        x.forEach(function (step) {
            step.classList.remove("active");
        });
        x[n].classList.add("active");

        x1.forEach(function (stepItem) {
            stepItem.classList.remove("active");
        });
        x1[n].classList.add("active");

        var stepFinishActive = document.querySelector(".step-item.finish.active");
    }

    // Add this script
    var stepItems = document.querySelectorAll(".step-item");
    stepItems.forEach(function (stepItem) {
        stepItem.addEventListener("click", function () {
            var index = Array.prototype.indexOf.call(stepItems, stepItem);
            if (index < currentTab) {
                var x = document.querySelectorAll(".tab");
                x[currentTab].style.display = "none";
                currentTab = index;
                showTab(currentTab);
            }
            var activeStep = document.querySelector(".step-item.active");
            var nextSteps = activeStep.nextElementSibling;
            while (nextSteps !== null) {
                nextSteps.classList.remove("finish");
                nextSteps = nextSteps.nextElementSibling;
            }
        });
    });

    var prevBtn = document.querySelector(".prevBtn");
    prevBtn.addEventListener("click", function () {
        var activeStep = document.querySelector(".step-item.active");
        var nextSteps = activeStep.nextElementSibling;
        while (nextSteps !== null) {
            nextSteps.classList.remove("finish");
            nextSteps = nextSteps.nextElementSibling;
        }
    });

</script>
@endpush