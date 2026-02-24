<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title"> Refund Payment Details </h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class=" input_labels control-label">Refund Payment For Lead:</label>
                        <input type="text" class="form-control" id="recipient-name" value="{{$refund->getLead->title??"Not Available"}}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="payment_type" class="input_labels control-label">Payment Type:</label>
                        <input type="text" class="form-control" id="payment_type" value="{!! $refund->paymentType->name??"Not Available" !!}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Reference_Number" class="input_labels control-label">Invoice:</label>
                        <input type="text" class="form-control" id="Reference_Number" value="{!! $refund->invoice_id??"Not Available" !!}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Reference_Number" class="input_labels control-label">Refund Amount:</label>
                        <input type="text" class="form-control" id="Reference_Number" value="{!! $refund->amount ? number_format($refund->amount, 2, '.', '') : 'Not Available' !!}" readonly>                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Amount" class="input_labels control-label">Date:</label>
                        <input type="text" class="form-control" id="Amount" value="{{ $refund->date ? \Carbon\Carbon::parse($refund->date)->format('m-d-Y') : 'Not Available' }}" readonly>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="Date" class="input_labels control-label">Description:</label>
                        <textarea class="form-control" readonly>{!! strip_tags($refund->description) ?? "Not Available" !!}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
