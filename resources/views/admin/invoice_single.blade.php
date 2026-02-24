<div class="row">
    <div class="col-md-12">
        <div class="changeOrderLogo">
            <img src="{{asset('website/images/logo.png')}}" alt="logo">
        </div>
        {{--                                    <span class="d-block">Check payable to:</span>--}}

    </div>
    <br><br>
    <div class="col-md-12">
        {{ $customMessage }}
    </div>
    <br><br>

    <div class="col-md-6">
        {{--                                    <h2>{{ $invoice->customer_id??"Not Available"  }}</h2>--}}
        <div>
            <h5>Billing Address:</h5>
            <p>{{ $invoice->address??"Not Available"  }}</p>

        </div>
        <div >
            <h5>Contact Information:</h5>
            <p>{{ $invoice->getLead->contact_person??"Not Available"  }}</p>
            <p>{{ $invoice->getLead->user->email??"Not Available"  }}</p>
        </div>
        <div>
            <table class="tbl_small">
                <thead>
                <tr>
                    <th>
                        Balance Due
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        {{ $invoice->total_amount??"00" }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6">

        <h2>{{ $invoice->getLead->title??"" }}</h2>
        <p>244 A Route 6</p>
        <p>Columbia, CT 06237 <i></i></p>
        <p>Licenses #: HIC 0628045</p>
        <p>Phone #:
        @if(isset($invoice->getLead->customer) && $invoice->getLead->customer->customerPhones)
            <p class="p-16">
                                        <span>
                                            @forelse($invoice->getLead->customer->customerPhones as $item)
                                                <i class="fa-solid fa-phone"></i> {{ $item->phone ?? "Not Available" }}<br>
                                            @empty
                                                Not Available
                                            @endforelse
                                        </span>
            </p>
            @endif
            </p>
            <div class="">
                <table class="table table-borderless invoice_order_table">
                    <tbody>
                    <tr>
                        <td>Invoice Order:</td>
                        <td>{{ $invoice->invoice_unique_id??"" }}</td>

                    </tr>
                    <tr>
                        <td>Billed On:</td>

                        <td>{{ $invoice->created_at->format('m/d/Y') }}</td>
                    </tr>

                    <tr>
                        <td>Due Date:</td>
                        <td>{{ isset($invoice->due_date) ? \Carbon\Carbon::parse($invoice->due_date)->format('m/d/Y') : '' }}</td>
                    </tr>

                    </tbody>
                </table>

            </div>
    </div>


    <div class="col-md-12">
        <table class="table" >
            <thead>
            <tr>
                <th>Activity</th>
                <th>Category Type</th>
                <th>Quantity</th>
                <th>Rate</th>
                <th class="taxhead" style="display: none">Taxable</th>
                <th>Amount</th>
            </tr>
            </thead>
            <tbody>
            @if($invoice->getInvoiceAttachments->count() > 0)
                @foreach($invoice->getInvoiceAttachments as $invoiceattachment)
                    <tr>
                        <td>
                            <input class="form-control mb-3" name="activity_name[]" type="text" id="activity_name" value="{{ $invoiceattachment->activity_name }}" required  readonly>
                        </td>
                        <td>
                            <input class="form-control mb-3" value="{{ $invoiceattachment->getCategory->name??"" }}"  readonly>
                        </td>
                        <td>
                            <input class="form-control quantity mb-3" name="quantity[]" type="number"
                                   id="quantity" value="{{ $invoiceattachment->quantity??"" }}"  readonly>
                        </td>
                        <td>
                            <input class="form-control rate mb-3" name="rate[]" type="number" id="rate" value="{{ number_format($invoiceattachment->rate ?? 0, 2) }}" readonly>
                        </td>
                        <td class="taxForm" style="display: none">
                            <input type="checkbox mb-3" name="terms" id="taxForm" checked  readonly>
                        </td>
                        <td>
                            <input class="form-control amount mb-3" name="amount[]" type="text" id="amount" value="{{ $invoiceattachment->amount??"" }}" readonly>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        <div class="col-md-12">
            <span class="d-flex justify-content-end col-md-12">Sub Total: $<span id="subtotal">{{ $invoice->sub_total??"0.00" }}</span></span>
            <div class="tax col-md-12">
                <span class="d-flex justify-content-end">Tax: $<span id="tax">{{ $invoice->total_tax??"0.00" }}</span></span>
                <span class="d-flex justify-content-end">Total: $<span class="total" name="total_amount">{{ $invoice->total_amount??"0.00" }}</span></span>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <p>Note:</p>
        <span>{{ strip_tags($invoice->description??"") }}</span>
    </div>
</div>