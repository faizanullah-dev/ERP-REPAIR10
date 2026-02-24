{{--@push('css')--}}
{{--    <style>--}}
{{--        #mouseSignatureCanvas {--}}
{{--            box-shadow: 4px 4px 4px 4px rgba(0, 0, 0, 0.5);--}}
{{--        }--}}
{{--    </style>--}}
{{--@endpush--}}

<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Change Order Details</h4>
            <div class="d-flex justify-content-end Task_Details_modal_btn ">
                <button type="button" class="close mx-3" data-dismiss="modal" aria-hidden="true">×
                </button>
            </div>
        </div>
        <div class="changeOrderOutr">
            <div class="container-fluid">
                <div class="mt-4">
                    <form action="" class="form-horizontal">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="changeOrderLogo">
                                    <img src="{{asset('website/images/logo.png')}}" alt="logo">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h2>{{ $changeorder->customer->name??"Not Available"  }}</h2>
                                {{--<div class="col-md-6">--}}
                                {{--</div>--}}
                                <h5>Contact Information:</h5>
                                <p>{{ $changeorder->getLead->customer->profile->address??"Not Available"  }}</p>
{{--                                <p>{{ $changeorder->getLead->customer->profile->city??"Not Available"  }}</p>--}}
{{--                                <p>{{ $changeorder->getLead->customer->profile->state??"Not Available"  }}</p>--}}
{{--                                <p>{{ $changeorder->getLead->customer->profile->country??"Not Available"  }}</p>--}}
                                <p>{{ $changeorder->getLead->customer->profile->phone??"Not Available"  }}</p>
                            </div>
                            <div class="col-md-6">
                                <span class="d-block mt-4">Check payable to:</span>
                                <h2 class="mt-0">{{ $changeorder->getLead->title??"" }}</h2>
                                {{--<p>{{  $changeorder->getLead->representative->name??"" }} </p>--}}
                                <p>{{  $changeorder->address??"" }} <i></i></p>
                                <p>Phone #: {{  $changeorder->contact_person??"not available" }} </p>
                            </div>





                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6 d-flex align-items-center">
                                        <span class="d-block"> Change Order: </span>
                                        <span class="d-block px-3 changeOrderInpClor"> #{{ $changeorder->change_order_unique_id??"" }}</span>
                                    </div>

                                    <div class="col-md-6 d-flex align-items-center">
                                        <span class="d-block">Billed On:</span>
                                        <span class="d-block changeOrderInpClor px-3">{{ $changeorder->created_at->format('m/d/Y')??"" }}</span>
                                    </div>

                                    <div class="col-md-6">
                                        <span class="d-block">Due Date: </span>
                                        <span class="d-block changeOrderInpClor">
                                             {{ isset($changeorder->due_date) ? \Carbon\Carbon::parse($changeorder->due_date)->format('m/d/Y') : '' }}
                                        </span>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="tbl_small mt-3">

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
                                                    {{ $changeorder->total_amount??"00" }}
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
                                    @if($changeorder->getChangeOrderAttachments->count() > 0)
                                        @foreach($changeorder->getChangeOrderAttachments  as $changeorderattachment)
                                            <tr>
                                                <td>
                                                    <input class="form-control mb-3" name="activity_name[]" type="text" id="activity_name" value="{{ $changeorderattachment->activity_name }}" required  readonly>
                                                </td>

                                                <td>
                                                    <input class="form-control mb-3" value="{{ $changeorderattachment->getCategory->name??"" }}"  readonly>
                                                </td>
                                                <td>
                                                    <input class="form-control quantity mb-3" name="quantity[]" type="number" id="quantity" value="{{ $changeorderattachment->quantity??"" }}"  readonly>
                                                </td>
                                                <td>
                                                    <input class="form-control rate mb-3" name="rate[]" type="number" id="rate" value="{{ number_format($changeorderattachment->rate ?? 0, 2) }}" readonly>
                                                </td>
                                                <td class="taxForm" style="display: none">
                                                    <input type="checkbox mb-3" name="terms" id="taxForm" checked  readonly>
                                                </td>
                                                <td>
                                                    <input class="form-control amount mb-3" name="amount[]" type="text" id="amount" value="{{ $changeorderattachment->amount??"" }}" readonly>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                                <div col-md-12>
                                    <span class="d-flex justify-content-end col-md-12">Sub Total: $<span id="subtotal">{{ $changeorder->sub_total??"" }}</span></span>

                                    <div class="tax col-md-12">
                                        <span class="d-flex justify-content-end">Tax: $<span id="tax">{{ $changeorder->tax??"" }}</span></span>
                                        <span class="d-flex justify-content-end">Total: $<span class="total" name="total_amount">{{ $changeorder->total_amount??"" }}</span></span>
                                    </div>
                                </div>


                            </div>
                        </div>

{{--                        @if(isset($changeorder) && $changeorder->signature_type==='upload_image')--}}
{{--                        <div class="row">--}}
{{--                                <div class="col-md-12 text-center">--}}
{{--                                <div class="form-group">--}}
{{--                                    <div id="signatureForm">--}}
{{--                                        <div class="signature_wrpper">--}}
{{--                                        <h3>Customer Signature</h3>--}}
{{--                                            <div class="signature_showcase">--}}
{{--                                            <img src="{{asset('website/' . $changeorder->getLead->customer->profile->upload_signature)}}" width="200" height="200"></img>--}}
{{--                                            </div>--}}
{{--                                        <div class="text-end">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                            </div>--}}
{{--                        @elseif(isset($changeorder) && $changeorder->signature_type==='e_signature')--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <div id="signatureForm">--}}
{{--                                        <div class="signature_wrpper">--}}
{{--                                            <h3>Customer Signature</h3>--}}
{{--                                            <div class="signature_showcase">--}}

{{--                                            <img src="{{$changeorder->signature}}" width="400" height="200"></img>--}}
{{--                                            </div>--}}
{{--                                            <div class="text-end">--}}
{{--                                            </div>--}}

{{--                                            </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endif--}}
                        <div class="row">
                            <div class="col-md-12 mb-0">
                                <div class="form-group mb-0">
                                    <div class="col-md-12">
                                        <p>Note:</p>
                                        <span>{{ strip_tags($changeorder->description??"") }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <div class="col-md-offset-4 col-md-4">
                                <input class="btn btn-primary" type="submit" value="create">
                            </div>
                        </div>-->

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

