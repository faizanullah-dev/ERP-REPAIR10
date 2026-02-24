<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addCredit">Edit Credit</h5>
            <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> × </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ url('/credit/credit/' . $credit->id) }}" accept-charset="UTF-8" class="form-horizontal edit_credit_form" enctype="multipart/form-data" novalidate>
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <input name="view_lead" value="1" type="hidden">
                <div class="row">
                    {{--                <input type="hidden" name="lead_id" value="{{ $leadExist->id??'' }}">--}}
                    <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
                        <div class="mb-3">
                            <label for="amount" class="col-md-4 control-label">{{ 'Credit Amount' }}<span class="text-danger">*</span></label>
                            <input type="number" class="form-control edit_credit_amount" id="amount" name="amount" placeholder="Enter amount..." value="{{ number_format((float)$credit->amount ?? 0, 2) }}" step="0.01" required>
                            {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}

                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
                        <div class="mb-3">
                            <label for="date" class="col-md-4 control-label">{{ 'Date' }}</label>
                            <input type="date" class="form-control" id="amount" name="date" value="{{ $credit->date ?? $yearEstimation->year . '-01-01' }}">
                            {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('invoice') ? 'has-error' : ''}}">
                        <label for="invoice" class=" control-label">{{ 'Invoice' }}<span class="text-danger">*</span></label>
                        <select class="form-select finance-invoice custom_modal_select2  edit_credit_select_modal edit_credit_invoice" id="invoice_id" name="invoice_id" required>
                            @foreach($leads->getInvoice as $value)
                                <option value="{{ $value->id }}" data-cr-invoice-id="{{ $value->total_amount ?? '' }}"
                                        @if(isset($credit) && $value->id == $credit->invoice_id) selected @endif>
                                    Date: {{ \Carbon\Carbon::parse($value->due_date ?? '')->format('m-d-Y') }} - Amount: {{ $value->total_amount }}
                                </option>
                            @endforeach

                        </select>
                        {!! $errors->first('invoice', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="mb-4">
                        <label for="refundDescription" class="form-label">Description</label>
                        <textarea class="form-control editCreditDescription" id="refundDescription" name="description">{!! $credit->description !!}</textarea>
                    </div>
                    <div class="form-group mb-0">
                        <input class="btn btn-green d-block mx-auto edit_credit_submit_btn" type="submit" value="{{ $submitButtonText??'Update' }}">
                    </div>
                </div>
                <script>
                        $(document).ready(function(){
                            $('.edit_credit_select_modal').select2({
                                placeholder: "Select Invoice",
                                allowClear: true,
                                dropdownParent: $('#editCreditModal') // Ensure dropdown appears inside the modal
                            });
                         console.log('araib');
                            if (typeof ClassicEditor !== "undefined") {
                                $('.editCreditDescription').each(function() {
                                    ClassicEditor.create(this)
                                        .then(newEditor => {})
                                        .catch(error => {
                                            console.error(error);
                                        });
                                });
                            } else {
                                console.error("ClassicEditor is not defined. Please check if CKEditor 5 is loaded correctly.");
                            }
                            $(document).on('change', '.edit_credit_invoice', function() {
                                var selectedOption = $(this).find('option:selected');
                                var amount = parseFloat(selectedOption.attr('data-cr-invoice-id')) || 0;
                                var creditAmount = parseFloat($('.edit_credit_amount').val()) || 0;
                                $('.edit_credit_amount').attr('max', amount);
                                $('#edit-amount-error').remove();
                                if (creditAmount > amount) {
                                    $('.edit_credit_amount').val(amount);
                                    $('.edit_credit_amount').after('<div id="edit-amount-error" class="error-message" style="color: red;">Amount cannot exceed ' + amount + '</div>');
                                }
                            });
                        });

                        $(document).on('click', '.edit_credit_submit_btn', function (e) {
                            e.preventDefault();
                            if ($('.edit_credit_form').valid()) {
                                $('.edit_credit_form').submit();
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
