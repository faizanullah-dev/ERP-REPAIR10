<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Receive Payment Details </h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class=" input_labels control-label">Receive Payment For Lead:</label>
                        <input type="text" class="form-control" id="recipient-name" value="{{$receivepayment->getLead->title??"Not Available"}}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="payment_type" class="input_labels control-label">Payment Type:</label>
                        {{--<p>{!! $receivepayment->getPaymenttype->name??"Not Available" !!}</p>--}}
                        <input type="text" class="form-control" id="payment_type" value="{!! $receivepayment->getPaymenttype->name??"Not Available" !!}" readonly>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Reference_Number" class="input_labels control-label">Reference Number:</label>
                        {{--<p>{!! $receivepayment->Reference_number??"Not Available" !!}</p>--}}
                        <input type="text" class="form-control" id="Reference_Number" value="{!! $receivepayment->Reference_number??"Not Available" !!}" readonly>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Amount" class="input_labels control-label">Amount:</label>
                        {{--<p>{!! $receivepayment->amount??"Not Available" !!}</p>--}}
                        <input type="text" class="form-control" id="Amount" value="{!! $receivepayment->amount??"Not Available" !!}" readonly>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="Date" class="input_labels control-label">Date:</label>
                        {{--<p>{!! $receivepayment->date??"Not Available" !!}</p>--}}
                        <input type="text" class="form-control" id="Date" value="{!! $receivepayment->date->format('m/d/y') ?? "Not Available" !!}
" readonly>

                    </div>
                </div>
{{--                <div class="col-md-12">--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="recipient-name" class="input_labels control-label">Status:</label>--}}
{{--                        @if($receivePayment->status==1)--}}
{{--                            <badge class="badge badge-success">Active</badge>--}}
{{--                        @else--}}
{{--                            <badge class="badge badge-warning">InActive</badge>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
</div>
