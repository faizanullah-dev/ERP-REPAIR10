<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="editRefund">Edit Refund</h5>
        <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> × </button>
    </div>
    <div class="modal-body">
        <form method="POST" action="{{ url('/refund/refund/' . $refund->id) }}" accept-charset="UTF-8" class="form-horizontal edit_refunds_submit_form" enctype="multipart/form-data" novalidate>
            {{ method_field('PATCH') }}
            {{ csrf_field() }}
            <input name="view_lead" value="1" type="hidden">
            <div class="row">
{{--                <input type="hidden" name="lead_id" value="{{ $leadExist->id??'' }}">--}}
                <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
                    <div class="mb-3">
                        <label for="amount" class="col-md-4 control-label">{{ 'Refund Amount' }}<span class="text-danger">*</span></label>
                        <input type="number" class="form-control edit_refund_amount" id="amount" name="amount" placeholder="Enter amount..." value="{{ $refund->amount??"" }}" step="0.01" required>
                        {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('payment_type') ? 'has-error' : ''}}">
                    <label for="payment_type" class=" control-label">{{ 'Refund Payment Type' }}</label>
                    <select class="form-select finance-invoice custom_modal_select2" id="payment_type" name="payment_type_id" required>
                        @foreach($paymenttypes as $value)
                            <option value="{{$value->id}}" @if(isset($refund) && $value->id == $refund->payment_type_id) selected @endif >{{ $value->name??'' }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('payment_type', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="form-group {{ $errors->has('invoice') ? 'has-error' : ''}}">
                    <label for="invoice" class=" control-label">{{ 'Invoice' }}</label>
                    <select class="form-select finance-invoice custom_modal_select2  edit_refund_select_modal edit_refund_invoice" id="invoice_id" name="invoice_id" required>
                        @foreach($leads->getInvoice as $value)
                            <option value="{{$value->id}}" data-rf-invoice-id="{{ $value->total_amount??'' }}" @if(isset($refund) && $value->id == $refund->invoice_id) selected @endif >{{$value->total_amount}}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('invoice', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
                    <div class="mb-3">
                        <label for="date" class="col-md-4 control-label">{{ 'Date' }}</label>
                        <input type="date" class="form-control" id="amount" name="date" value="{{ $refund->date ?? $yearEstimation->year . '-01-01' }}">
                        {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('refundDescription') ? 'has-error' : ''}}">
                    <div class="mb-3">
                        <label for="refundDescription" class="form-label">Description</label>
                        <textarea class="form-control edit_refund_description" id="refundDescription" name="description">{!! $refund->description !!}</textarea>
                        {!! $errors->first('refundDescription', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group mb-0">
                    <input class="btn btn-green d-block mx-auto edit_refunds_submit_btn" type="submit" value="{{ $submitButtonText??'Update' }}">
                </div>
            </div>
            <script>
                $(document).ready(function(){


                    if (typeof ClassicEditor !== "undefined") {
                        $('.edit_refund_description').each(function() {
                            ClassicEditor.create(this)
                                .then(newEditor => {})
                                .catch(error => {
                                    console.error(error);
                                });
                        });
                    } else {
                        console.error("ClassicEditor is not defined. Please check if CKEditor 5 is loaded correctly.");
                    }
                    $(document).on('change', '.edit_refund_invoice', function() {
                        var selectedOption = $(this).find('option:selected');
                        var amount = parseFloat(selectedOption.attr('data-rf-invoice-id')) || 0;
                        console.log(amount);
                        var refundAmount = parseFloat($('.edit_refund_amount').val()) || 0;
                        console.log(refundAmount);
                        $('.edit_refund_amount').attr('max', amount);
                        $('#edit-amount-error').remove();
                        if (refundAmount > amount) {
                            $('.edit_refund_amount').val(amount);
                            $('.edit_refund_amount').after('<div id="edit-amount-error" class="error-message" style="color: red;">Amount cannot exceed ' + amount + '</div>');
                        }
                    });
                });

                // Submit form from modal
                $(document).on('click', '.edit_refunds_submit_btn', function (e) {
                    e.preventDefault();
                    if ($('.edit_refunds_submit_form').valid()) {
                        $('.edit_refunds_submit_form').submit();
                    } else {
                        $('html, body').animate({
                            scrollTop: $(".error:visible:first").offset().top - 100
                        }, 500);
                    }
                });
            </script>
        </form>
    </div>
</div>
</div>
