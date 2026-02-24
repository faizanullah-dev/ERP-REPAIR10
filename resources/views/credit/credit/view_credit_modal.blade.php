<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title"> Credit Payment Details </h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class=" input_labels control-label">Credit Payment For Lead:</label>
                        <input type="text" class="form-control" id="recipient-name" value="{{$credit->getLead->title??"Not Available"}}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Reference_Number" class="input_labels control-label">Invoice:</label>
                        <input type="text" class="form-control" id="Reference_Number" value="{!! $credit->invoice_id??"Not Available" !!}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Reference_Number" class="input_labels control-label">Credit Amount:</label>
                        <input type="text" class="form-control" id="Reference_Number" value="{!! number_format((float)$credit->amount ?? 0, 2) !!}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Amount" class="input_labels control-label">Date:</label>
                        <input type="text" class="form-control" id="Amount" value="{{ $credit->date ? \Carbon\Carbon::parse($credit->date)->format('m-d-Y') : 'Not Available' }}" readonly>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="Date" class="input_labels control-label">Description:</label>
                        <textarea class="form-control" readonly>{!! strip_tags($credit->description) ?? "Not Available" !!}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
