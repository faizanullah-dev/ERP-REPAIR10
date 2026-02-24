<div class="row">
    <input type="hidden" name="lead_id" value="{{ $leadExist->id??'' }}">
    <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
        <div class="mb-3">
            <label for="amount" class="col-md-4 control-label">{{ 'Refund Amount' }}<span class="text-danger">*</span></label>
            <input type="number" class="form-control refund_amount" id="amount" name="amount" placeholder="Enter amount..." step="0.01" required>
            {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
        <div class="form-group {{ $errors->has('payment_type') ? 'has-error' : ''}}">
            <label for="payment_type" class=" control-label">{{ 'Refund Payment Type' }}</label>
            <select class="form-select finance-invoice  custom_modal_select2" id="payment_type" name="payment_type_id" required>
                <option disabled>--Select Payment Type--</option>
                @foreach($paymenttypes as $value)
                    <option value="{{$value->id}}" >{{ $value->name??'' }}</option>
                @endforeach
            </select>
            {!! $errors->first('payment_type', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('invoice') ? 'has-error' : ''}}">
            <label for="invoice" class=" control-label">{{ 'Invoice' }}</label>
            <select class="form-select finance-invoice  custom_modal_select2 refund_invoice_id" id="invoice_id" name="invoice_id" required>
                @if(!empty($leadExist))
                    @foreach($leadExist->getInvoice as $value)
                        @if($value->total_amount > 0)  <!-- Add this condition -->
                        <option value="{{$value->id}}" data-refund-amount="{{ $value->total_amount??'' }}">Date:{{ \Carbon\Carbon::parse($value->due_date)->format('m/d/y') ?? '' }} - Amount: {{$value->total_amount}}</option>
                        @endif
                    @endforeach
                @else
                    @foreach($leads as $lead)
                        @foreach($lead->getInvoice as $value)
                            @if($value->total_amount > 0)  <!-- Add this condition -->
                            <option value="{{$value->id}}" @if(isset($credit) && $credit->invoice_id == $credit->invoice_id) selected @endif >{{$value->total_amount}}</option>
                            @endif
                        @endforeach
                    @endforeach
                @endif
            </select>

            {!! $errors->first('invoice', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
        <div class="mb-3">
            <label for="date" class="col-md-4 control-label">{{ 'Date' }}</label>
            <input type="date" class="form-control" id="amount" name="date" value="{{ $credit->due_date ?? $yearEstimation->year . '-01-01' }}">
            {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('refundDescription') ? 'has-error' : ''}}">
        <div class="mb-0">
            <label for="refundDescription" class="form-label">Description</label>
            <textarea class="form-control refund_description" id="refundDescription" name="description"></textarea>
            {!! $errors->first('refundDescription', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group mb-0">
        <input class="btn d-block mx-auto btn-green add_refund_submit_form" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function(){
            if (typeof ClassicEditor !== "undefined") {
                $('.refund_description').each(function() {
                    ClassicEditor.create(this)
                        .then(newEditor => {})
                        .catch(error => {
                            console.error(error);
                        });
                });
            } else {
                console.error("ClassicEditor is not defined. Please check if CKEditor 5 is loaded correctly.");
            }
            $(document).on('change', '.refund_invoice_id', function() {
                var selectedOption = $(this).find('option:selected');
                var amount = parseFloat(selectedOption.attr('data-refund-amount')) || 0;
                var refundAmount = parseFloat($('.refund_amount').val()) || 0;
                $('.refund_amount').attr('max', amount);
                $('#amount-error').remove();
                if (refundAmount > amount) {
                    $('.refund_amount').val(amount);
                    $('.refund_amount').after('<div id="amount-error" class="error-message" style="color: red;">Amount cannot exceed ' + amount + '</div>');
                }
            });
        });

        $(document).on('click', '.add_refund_submit_form', function (e) {
            e.preventDefault();
            if ($('.add_refunds_form').valid()) {
                $('.add_refunds_form').submit();
            } else {
                $('html, body').animate({
                    scrollTop: $(".error:visible:first").offset().top - 100
                }, 500);
            }
        });

    </script>
@endpush
