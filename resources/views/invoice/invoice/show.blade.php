@extends('layouts.master')
@push('css')
<link rel="stylesheet" href="style.css">
<link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<style>
    #mouseSignatureCanvas {
        box-shadow: 4px 4px 4px 4px rgba(0, 0, 0, 0.5);
    }
</style>
@endpush

@section('content')

    <div class="changeOrderOutr">
        <div class="container-fluid">

            <div class="white-box">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="changeOrderLogo">
                                <img src="{{asset('website/images/logo.png')}}" alt="logo">
                            </div>
                            <span class="d-block">Check payable to:</span>
                            <h2>{{ $invoice->getLead->title??"" }}</h2>
                            <p>244 A Route 6</p>
                            <p>Columbia, CT 06237 <i></i></p>
                            <p>Licenses #: HIC 0628045</p>
                            <p>Phone #: (860) 942-8000</p>

                        </div>
                        <div class="col-md-6 d-flex align-items-end ">
                            <div class="row">
                                <div class="col-md-6">
                                    <p> Invoice Order #</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="px-3 changeOrderInpClor">{{ $invoice->invoice_unique_id??"" }}</p>
                                </div>
                                <div class="form-group ">
                                    <div class="col-md-6">
                                        <p>Billed On:</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="changeOrderInpClor px-3">{{ $invoice->created_at->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p>Due Date:</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="changeOrderInpClor px-3"> {{ isset($invoice->due_date) ? \Carbon\Carbon::parse($invoice->due_date)->format('d/m/Y') : '' }}
                                    </p>
                                </div>

                            </div>
                        </div>


                        <div class="col-md-12">

                            <h2>{{ $invoice->customer_id??"Not Available"  }}
                            </h2>

                            <div class="row">
                                        <div class="col-md-6">
                                            <h5>Billing Address:</h5>
                                            <p>{{ $invoice->address??"Not Available"  }}</p>

                                        </div>

                                    <div class="col-md-6">
                                                <h5>Contact Information:</h5>
                                                <p>{{ $invoice->getLead->contact_person??"Not Available"  }}</p>
                                                <p>{{ $invoice->getLead->user->email??"Not Available"  }}</p>

                                    </div>
                            </div>
                                <div class="col-md-12">

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

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table" id="myTable">
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
                                                <input class="form-control rate mb-3" name="rate[]" type="number" id="rate" value="{{ $invoiceattachment->rate??"" }}"  readonly>

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
                            <div col-md-12>
                                <span class="d-flex justify-content-end col-md-12">Sub Total: $<span id="subtotal">{{ $invoice->sub_total??"" }}</span></span>

                                <div class="tax col-md-12">
                                    <span class="d-flex justify-content-end">Tax: $<span id="tax">{{ $invoice->tax??"" }}</span></span>
                                    <span class="d-flex justify-content-end">Total: $<span class="total" name="total_amount">{{ $invoice->total_amount??"" }}</span></span>
                                </div>
                            </div>


                        </div>

                        <div class="d-flex justify-content-end">
{{--                            <div id="signatureForm">--}}
{{--                                <h3>Customer Signature</h3>--}}
{{--                                <img src="{{$invoice->signature??''}}" width="400" height="200"></img>--}}
{{--                                <div class="text-end">--}}
{{--                                </div>--}}
{{--                            </div>--}}

                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">

                            <div class="col-md-12">

                                <p>Note:</p>
                                <span>{{ strip_tags($invoice->description??"") }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">
                        </div>
                    </div>
            </div>
        </div>
    </div>

@endsection

