@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Customer') }} {{ $customer->id }}</h3>
                    @can('view-'.str_slug('Customer'))
                        <a class="btn btn-success pull-right" href="{{ url('/customer/customer') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="left_align_text_tabel">

                        <section class="lead-card-view">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="item-card-view">
                                        <h4> {{ $customer->first_name.' '.$customer->last_name ??"Not Avalible"}} </h4>
                                        <ul>
                                            <li class="email"> <b>Email: </b> {{ $customer->email ??"Not Avalible"}} </li>
                                            <li class="phone-no"> <b>Phone Number: </b>
                                                @foreach($customer->customerPhones as $key=>$item)
                                                    {{ $item->phone ??"Not Avalible"}}<br>
                                                @endforeach
                                            </li>
                                            <li class="address"> <b>Address: </b> {{ $customer->profile->address??"Not Avalible"}} </li>
                                            <li class="address"> <b>City: </b> {{ $customer->profile->city??"Not Avalible"}} </li>
                                            <li class="address"> <b>State: </b> {{ $customer->profile->state??"Not Avalible"}} </li>
                                            <li class="address"> <b>Zip: </b> {{ $customer->profile->zip??"Not Avalible"}} </li>
                                            <li class="address"> <b>Country: </b> {{ $customer->profile->country??"Not Avalible"}} </li>
                                            <li class="company"> <b>Company: </b> {{ $customer->company ??"Not Avalible"}} </li>
                                            <li class="salesman"> <b>Salesman: </b> {{ $customer->salesman->name ??'Not Avalible'}} </li>
                                            <li class="address"> <b>Customer Type: </b> {{ $customer->CustomerType->name??"Not Avalible"}} </li>
                                            <li class="address"> <b>Referral Source: </b> {{ $customer->referralSource->name??"Not Avalible"}} </li>
                                            <li class="address"> <b>Customer Note: </b> {{ $customer->profile->notes??"Not Avalible"}} </li>
                                            @if(isset($customer) && $customer->profile && $customer->profile->signature_type && $customer->profile->signature_type == "signature_file")
                                                <li class="">
                                                    <b>Signature Image: </b>
                                                        <img src="{{asset('website/' . $customer->profile->upload_signature)}}" alt="Signature Image" style="display: block; margin: auto;">

                                                </li>
                                            @elseif(isset($customer) && $customer->profile && $customer->profile->signature_type && $customer->profile->signature_type == "signature_pad")
                                                <li>
                                                    <b>E Signature:</b>
{{--                                                    <td style="text-align: center;">--}}
                                                        <img src="{{$customer->profile->upload_signature }}" alt="E Signature" style="max-width: 100%; max-height: 200px; display: block; margin: auto;">
{{--                                                    </td>--}}
                                                </li>
                                            @else
                                                <li>
                                                    <b>Signature: </b>Not Available
                                                </li>
                                            @endif
                                            <li> <b>Total Won Jobs: </b> {{ number_format($customer->customerLeads->where('lead_status', 'won')->count(), 2) ?? 'Not Available' }} </li>
                                            <li> <b>Total Won Job Price: </b> ${{ number_format($customer_won_price ?? 0, 2) }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="item-card-view position-relative">
                                        <div class="row d-flex justify-content-end">
                                            <button class="btn btn-primary">View Finance</button>
                                        </div>
                                        <ul class="mt-5">
                                            <li class="proposal"> <b>Pending: </b>${{ number_format($customer_pending_price ?? 0, 2) }}</li>
                                            <li class="status"> <b>Won: </b>${{ number_format($customer_won_price ?? 0, 2) }}</li>
                                            <li class="status"> <b>Lost: </b>${{ number_format($customer_lost_price ?? 0, 2) }}</li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-between align-items-center"> 
                                    <h3 class="mb-0">Jobs</h3>
                                    <a href="{{ url('lead/lead/create') }}?customer_id={{ $customer->id }}" class="btn btn-primary">Create Lead</a> 
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                               @if($customer->customerLeads->count() > 0)
                                @foreach($customer->customerLeads as $lead)
                                <div class="col-md-6">
                                    <a href="{{ url('view_lead') }}/{{ $lead->id }}">
                                        <div class="item-card-view">
                                          <div class="jobz_status">
                                              @if($lead->lead_status == 'won')
                                                  <span class='badge pric_span green_btn py-3'>WON</span>
                                              @elseif($lead->lead_status == 'lost')
                                                  <span class='badge pric_span lost py-3'>LOST</span>
                                              @elseif($lead->lead_status == 'pending')
                                                  <span class='badge pric_span pending py-3'>PENDING</span>
                                              @endif
                                          </div>
                                            <h4> {{ $lead->title??"" }} </h4>
                                            <ul>
                                                <li class="lead-no"> <b>Lead Number: </b>{{ $lead->lead_number??"" }}</li>
                                                <li class="category"> <b>Category: </b>{{ $lead->category->name??"" }}</li>
                                                <li class="address"> <b>Address: </b> {{ $lead->address??"Not Avalible"}} </li>
                                                <li class="phone-no"> <b>Phone Number: </b>{{ $lead->contact_person??"" }}</li>
                                            </ul>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                                @else
                                    <span class='badge pric_span pending'>No Jobs Found</span>
                                @endif
                            </div>
                        </section>

                    <div class="table-responsive d-none">
                        <table class="table table">
                            <tbody>
                                <tr>
                                    <th style="min-width: 200px" >ID </th>
                                    <td>{{ $customer->id }}</td>
                                </tr>
                                <tr>
                                    <th> Name </th>
                                    <td>{{ $customer->first_name.' '.$customer->last_name ??"Not Avalible"}}</td>
                                </tr>
                                <tr>
                                    <th>Primary Email </th>
                                    <td>{{ $customer->email ??"Not Avalible"}}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $customer->profile->address??"Not Avalible"}}</td>
                                </tr>
                                <tr>
                                    <th>City</th>
                                    <td>{{ $customer->profile->city??"Not Avalible"}}</td>
                                </tr>
                                <tr>
                                    <th>State</th>
                                    <td>{{ $customer->profile->state??"Not Avalible"}}</td>
                                </tr>
                                <tr>
                                    <th>Zip</th>
                                    <td>{{ $customer->profile->zip??"Not Avalible"}}</td>
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <td>{{ $customer->profile->country??"Not Avalible"}}</td>
                                </tr>
                                <tr>
                                    <th>Phone Numbers</th>
                                        <td>
                                            @foreach($customer->customerPhones as $key=>$item)
                                                {{ $item->phone ??"Not Avalible"}}<br>
                                            @endforeach
                                        </td>
                                </tr>
                                <tr>
                                    <th> Company </th>
                                    <td>{{ $customer->company ??"Not Avalible"}}</td>
                                </tr>
                                <tr>
                                    <th> Customer Type</th>
                                    <td> {{ $customer->CustomerType->name??"Not Avalible" }}</td>
                                </tr>
                                <tr>
                                    <th> Salesman </th>
                                    <td> {{ $customer->salesman->name ??'Not Avalible'}}</td>
                                </tr>
                                <tr>
                                    <th> Referral Source </th>
                                    <td> {{ $customer->referralSource->name ??'Not Avalible'}}</td>
                                </tr>
                                <tr>
                                    <th> Customer Note </th>
                                    <td>{{ $customer->customer_note ??"Not Avalible"}}</td>
                                </tr>
                                @if(isset($customer) && $customer->profile && $customer->profile->signature_type && $customer->profile->signature_type == "signature_file")
                                    <tr>
                                        <th>Signature Image</th>
                                        <td style="text-align: center;">
                                            <img src="{{asset('website/' . $customer->profile->upload_signature)}}" alt="Signature Image" style="display: block; margin: auto;">
                                        </td>
                                    </tr>
                                @elseif(isset($customer) && $customer->profile && $customer->profile->signature_type && $customer->profile->signature_type == "signature_pad")
                                    <tr>
                                        <th>E Signature</th>
                                        <td style="text-align: center;">
                                            <img src="{{$customer->profile->upload_signature }}" alt="E Signature" style="max-width: 100%; max-height: 200px; display: block; margin: auto;">
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <th>Signature</th>
                                        <td style="text-align: center;">Not Available</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

