<div class="row">
    <input type="hidden" name="lead_id" value="{{ $leadExist->id??'' }}">
    <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
        <div class="mb-3">
            <label for="amount" class="col-md-4 control-label">{{ 'Credit Amount' }}<span class="text-danger">*</span></label>
            <input type="number" class="form-control credit_amount" id="amount" name="amount" placeholder="Enter amount..." step="0.01" required>
            {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
        <div class="mb-3">
            <label for="date" class="col-md-4 control-label">{{ 'Date' }}</label>
            <input type="date" class="form-control" id="amount" name="date" value="{{ $refund->due_date ?? $yearEstimation->year . '-01-01' }}">
            {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('invoice') ? 'has-error' : ''}}">
        <label for="invoice" class=" control-label">{{ 'Invoice' }}</label>
        <select class="form-select finance-invoice  custom_modal_select2 credit_invoice_id" id="credit_invoice_id" name="invoice_id" required>
            @if(!empty($leadExist))
                @foreach($leadExist->getInvoice as $value)
                    <option value="{{$value->id}}" data-amount="{{ $value->total_amount }}">Date: {{ \Carbon\Carbon::parse($value->due_date ?? '')->format('m-d-Y') ?? '' }} - Amount: {{$value->total_amount}}</option>
                @endforeach
            @else
                @foreach($leads as $lead)
                    @foreach($lead->getInvoice as $value)
                        <option value="{{$value->id}}" @if(isset($credit)  && $credit->invoice_id == $credit->invoice_id) selected @endif >{{$value->total_amount}}</option>
                    @endforeach
                @endforeach
            @endif
        </select>
        {!! $errors->first('invoice', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="mb-4">
        <label for="refundDescription" class="form-label">Description</label>
        <textarea class="form-control financeDescription" id="refundDescription" name="description"></textarea>
    </div>
    <div class="form-group mb-0">
        <input class="btn d-block mx-auto btn-green add_credits_submit_form" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function(){
            ClassicEditor.create(document.querySelector('#refundDescription'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable'],
                table: {
                    contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                }
            })
                .then(newEditor => {
                    console.log(newEditor);
                })
                .catch(error => {
                    console.error(error);
                });

            $(document).on('change', '.credit_invoice_id', function() {
                var selectedOption = $(this).find('option:selected');
                var amount = parseFloat(selectedOption.data('amount')) || 0;
                var creditAmount = parseFloat($('.credit_amount').val()) || 0;
                $('.credit_amount').attr('max', amount);
                $('#amount-error').remove();
                if (creditAmount > amount) {
                    $('.credit_amount').val(amount);
                    $('.credit_amount').after('<div id="amount-error" class="error-message" style="color: red;">Amount cannot exceed ' + amount + '</div>');
                }
            });

        });

        $(document).on('click', '.add_credits_submit_form', function (e) {
            e.preventDefault();
            if ($('#credit_form').valid()) {
                $('#credit_form').submit();
            } else {
                $('html, body').animate({
                    scrollTop: $(".error:visible:first").offset().top - 100
                }, 500);
            }
        });
    </script>
@endpush
