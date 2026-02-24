<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Cost of good sold Details</h4>
            <div class="d-flex justify-content-end Task_Details_modal_btn ">
                <button type="button" class="close mx-3" data-dismiss="modal" aria-hidden="true">×
                </button>
            </div>
        </div>
        <div class="changeOrderOutr">
            <div class="container-fluid">
                <div class="white-box">
                    <form action="" class="form-horizontal">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="changeOrderLogo">
                                    <img src="{{asset('website/images/logo.png')}}" alt="logo">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h2>{{ $leads->title??"" }}</h2>
                                <p> <b>Address: </b> {{  $leads->address??"" }} <i></i></p>
                                <p> <b>Contact Person: </b>  {{  $leads->contact_person??"not available" }} </p>

                                <p class="changeOrderInpClor"> <b> Lead No: </b> {{ $leads->lead_number ?? '' }}</p>
                                <p class="changeOrderInpClor"><b>Lead Starts :</b> {{ \Carbon\Carbon::parse($leads->lead_date ?? '')->format('m-d-Y') ?? '' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Contact Information:</h5>
                                <p> <b>Customer Address: </b> {{ $leads->customer->name ?? "Not Available" }}  </p>
                                <p> <b>Address: </b>  {{ $leads->customer->profile->address??"Not Available"}} </p>
                                <p> <b>City: </b>  {{ $leads->customer->profile->city??"Not Available"   }}    </p>
                                <p> <b>State: </b>  {{ $leads->customer->profile->state??"Not Available"  }}   </p>
                                <p> <b>Country: </b>  {{ $leads->customer->profile->country??"Not Available"}} </p>
{{--                                <p> <b>Phone: </b>  {{ $leads->customer->profile->phone??"Not Available"  }}   </p>--}}
                                <p> <b>Phone: </b>
                                    @forelse($leads->customer->customerPhones as $item)
                                         {{ $item->phone ?? "Not Available" }}<br>
                                    @empty
                                        Not Available
                                    @endforelse
                                </p>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table" id="myTable">
                                    <thead>
                                    <tr>
                                        <th>Material</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                        <th>Qty Price</th>
                                        <th>Job/Hr</th>
                                        <th>Total Cost</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $totalCost = 0;
                                    @endphp
                                        @if(isset($costOfGoodSold->cogsSheetsDetails) && !empty($costOfGoodSold->cogsSheetsDetails))
                                            @foreach($costOfGoodSold->cogsSheetsDetails as $detail)
                                                @php
                                                    $totalCost += $detail->total_cost;
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <input class="form-control" name="" type="text" id="activity_name_{{ $detail->id }}" value="{{ $detail->cogsMaterial->name }}" required readonly>
                                                    </td>
                                                    <td>
                                                        <input class="form-control" name="" type="text" id="activity_name_{{ $detail->id }}" value="{{ $detail->name }}" required readonly>
                                                    </td>
                                                    <td>
                                                        <input class="form-control" value="{{ $detail->description }}" readonly>
                                                    </td>
                                                    <td>
                                                        <input class="form-control quantity" name="quantity[]" type="number" id="quantity_{{ $detail->id }}" value="{{ $detail->unit_qty }}" readonly>
                                                    </td>
                                                    <td>
                                                        <input class="form-control rate" name="rate[]" type="number" id="rate_{{ $detail->id }}" value="{{ number_format($detail->qty_price ?? 0, 2, '.', '') }}" readonly>
                                                    </td>
                                                    <td>
                                                        <input class="form-control rate" name="rate[]" type="number" id="rate_{{ $detail->id }}" value="{{ number_format($detail->job_per_hr ?? 0, 2, '.', '') }}" readonly>
                                                    </td>
                                                    <td>
                                                        <input class="form-control amount" name="amount[]" type="text" id="amount_{{ $detail->id }}" value="{{ $detail->total_cost }}" readonly>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <div class="col-md-12 d-flex flex-column align-items-end">
                                    <p> <b>Lead Price: </b>${{ number_format((float)@$leads->lead_price ?? 0, 2) }}</p>
                                    @php
                                        @$netProfit = $leads->lead_price - $totalCost;
                                    @endphp
                                    <p> <b>COGS Total: </b> $<span id="subtotal">{{ number_format((float)$totalCost ?? 0, 2) }}</span> </p>
                                    <p> <b>Net Profit: </b> ${{ number_format((float)$netProfit ?? 0, 2) }}</p>
                                </div>
                            </div>
                        </div>
                        @if(isset($leads) && $leads->customer->profile->signature_type === 'signature_file')
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="form-group">
                                        <div id="signatureForm">
                                            <div class="signature_wrpper">
                                                <h3>Customer Signature</h3>
                                                <div class="signature_showcase">
                                                    <img src="{{asset('website/' . $leads->customer->profile->upload_signature)}}" width="200" height="200"></img>
                                                </div>
                                                <div class="text-end">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif(isset($leads) && $leads->customer->profile->signature_type === 'signature_pad')
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="signatureForm">
                                        <div class="signature_wrpper">
                                            <h3>Customer Signature</h3>
                                            <div class="signature_showcase">
                                                <img src="{{$leads->customer->profile->upload_signature}}" width="400" height="200"></img>
                                            </div>
                                            <div class="text-end">
                                            </div>
                                        </div>
                                     </div>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
