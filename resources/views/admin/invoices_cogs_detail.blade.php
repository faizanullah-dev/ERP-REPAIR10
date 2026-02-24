<div class="row">
    <div class="col-md-12">
        <div class="invoice_modal_logo">
            <img src="{{asset('website/images/logo.png')}}"  class="img-fluid" alt="logo">
        </div>
    </div>
    <div class="col-md-6">
        <h4>{{ $leads->title??"" }}</h4>
        <p> <b>Address: </b> {{  $leads->address??"" }} <i></i></p>
        <p> <b>Contact Person: </b>  {{  $leads->contact_person??"not available" }} </p>
    </div>
    <div class="col-md-6">
        <h4>Contact Information:</h4>
        <p> <b>Customer Name: </b> {{ $leads->customer->name ?? "Not Available" }}  </p>
        <p> <b>Address: </b>  {{ $leads->customer->profile->address??"Not Available"}} </p>
        <p> <b>City: </b>  {{ $leads->customer->profile->city??"Not Available"   }}    </p>
        <p> <b>State: </b>  {{ $leads->customer->profile->state??"Not Available"  }}   </p>
        <p> <b>Country: </b>  {{ $leads->customer->profile->country??"Not Available"}} </p>
        <p> <b>Phone: </b>
            @forelse($leads->customer->customerPhones as $item)
                {{ $item->phone ?? "Not Available" }}<br>
            @empty
                Not Available
            @endforelse
        </p>
    </div>
    <div class="col-md-12">
        <hr>
    </div>
    <div class="col-md-4">
        <p > <b>Lead No:</b> {{ $leads->lead_number ?? '' }}</p>
    </div>
    <div class="col-md-4">
        <p><b>Lead Starts :</b> {{ \Carbon\Carbon::parse($leads->lead_date ?? '')->format('m-d-Y') ?? '' }}</p>
    </div>
    <div class="col-md-4">
        <p ><b> Change Order Amount: </b> $ {{ number_format((float)$changeOrderAmount ?? 0, 2) }}</p>
    </div>
    <div class="col-md-4">
        <p  id="job_price"> <b> Job Price:</b> $ {{ number_format((float)$leads->lead_price ?? 0, 2) }}</p>
    </div>
    @php
        @$totalJobPrice = $changeOrderAmount + $leads->lead_price;
    @endphp
    <div class="col-md-4">
        <p > <b> Total Job Price:</b> $ {{ number_format((float)$totalJobPrice ?? 0, 2) }}</p>
    </div>
    <div class="col-md-12">
        <table class="table">
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
            @if($costOfGoodSold->count() > 0)
                @foreach($costOfGoodSold as $costOfGood)
                    @if(isset($costOfGood->cogsSheetsDetails) && !empty($costOfGood->cogsSheetsDetails))
                        @foreach($costOfGood->cogsSheetsDetails as $detail)
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
                @endforeach
            @else
                <tr>
                    <td colspan="7" class="text-center">No COGS Found</td>
                </tr>
            @endif
            </tbody>
        </table>
        <div class="col-md-12 d-flex flex-column align-items-end">
            <p><b>Lead Price:</b> ${{ number_format((float)($leads->lead_price ?? 0) + (float)($changeOrderAmount ?? 0), 2) }}</p>
            @php
                @$netProfit = ($leads->lead_price + @$changeOrderAmount) - $totalCost;
            @endphp
            <p> <b>Cost to do the Job (Projected):</b> $<span id="subtotal">{{ number_format((float)$totalCost ?? 0, 2) }}</span> </p>
            <p> <b>Profit / Loss (Projected): </b> ${{ number_format((float)$netProfit ?? 0, 2) }}</p>
        </div>
    </div>
    @if(isset($leads) && $leads->customer->profile->signature_type === 'signature_file')
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
    @elseif(isset($leads) && $leads->customer->profile->signature_type === 'signature_pad')
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
    @endif
</div>