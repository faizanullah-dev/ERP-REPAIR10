<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('lead_id') ? 'has-error' : ''}}">
            <label for="lead_id" class="col-md-4 control-label">{{ 'Lead' }} <span class="text-danger">*</span></label>
            <select class="select2-payment form-control   borderRadius assign_lead_readonly" name="lead_id" id="" required >
                @if(!empty($leadExist))
                    @foreach($leads as $lead)
                        <option value="{{$lead->id}}" @if(isset($leadExist) && $lead->id == $leadExist->id) selected @endif>{{$lead->title}}</option>
                    @endforeach
                @else
                    @foreach($leads as $lead)
                        <option value="{{$lead->id}}" @if(isset($receivepayment) && $lead->id == $receivepayment->lead_id) selected @endif>{{$lead->title}}</option>
                    @endforeach
                @endif
            </select>
            {!! $errors->first('lead_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('payment_type') ? 'has-error' : ''}}">
            <label for="payment_type" class="col-md-4 control-label">{{ 'Payment Type' }} <span class="text-danger">*</span></label>
            <select class="select2-receive form-control  custom_modal_select2 borderRadius" name="payment_type" id="payment_type" required>
                @foreach($paymenttypes as $paymenttype)
                    <option value="{{$paymenttype->id}}" @if(isset($receivepayment) && $paymenttype->id == $receivepayment->payment_type) selected @endif>{{ $paymenttype->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('payment_type', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('Reference_number') ? 'has-error' : ''}}">
            <label for="Reference_number" class="col-md-4 control-label">{{ 'Reference Number' }} <span class="text-danger">*</span></label>
            <input class="form-control" placeholder="Enter reference number" name="reference_number" type="text" id="Reference_number" value="{{ $receivepayment->reference_number??''}}" required>
            {!! $errors->first('Reference_number', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
            <label for="date" class="col-md-4 control-label">{{ 'Date' }} <span class="text-danger">*</span></label>
            <input class="form-control" name="date" type="date" id="payment_date" value="{{  $receivepayment->date ?? $yearEstimation->year . '-01-01' }}" required>
            {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    {{--    <div class="col-md-12">--}}
    {{--        <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">--}}
    {{--            <label for="amount" class="col-md-4 control-label">{{ 'Amount' }} <span class="text-danger">*</span></label>--}}
    {{--            <input class="form-control" placeholder="Enter amount" name="amount[]" type="text" id="receiveAmount" value="{{ $receivepayment->amount??''}}" required>--}}
    {{--            {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <div class="col-md-12 mb-4">
        <p class="invoice_limit_error" style="color: red;display: none;font-weight: 400;
        ">Please select at least one invoice and its Amount</p>
        <label for="receiveInvoice" class="form-label">Invoice</label>
        {{--        <select class="form-select receive-invoice clr_input_fields select2" name="invoice_id" id="receiveInvoice" required="">--}}
        {{--            <option selected disabled>--Select Invoice-- </option>--}}
        {{--            @foreach($leadExist->getInvoice->where('payment_status','!=','fully_paid') as $item)--}}
        {{--                <option value="{{ $item->id }}" @if(isset($receivepayment) && $receivepayment->invoice_id == $item->id)selected @endif data-amount="{{ $item->total_amount ?? '00' }}">Date: {{ $item->due_date??'' }} - Amount: {{$item->total_amount}}</option>--}}
        {{--            @endforeach--}}
        {{--        </select>--}}
        {{--        <input type="hidden" id="payment_order_id" name="invoice_id[]">--}}
        {{--        <input type="hidden" id="total_amount_to_pay" name="amount[]">--}}
        <div class="invoice_wrapper">
            <div class="row">
                @foreach($leadExist->getInvoice->where('payment_status', '!=', 'fully_paid') as $key => $item)
                    <div class="col-md-3">
                        <div class="invoice_container">
                            <div class="invoice_container_top">
                                <input type="checkbox" class="order-checkbox" id="order-{{ $item->id }}" data-order-id="{{ $item->id }}" value="">
                                <label for="order-{{ $item->id }}" class="pdf_icon">
                                    <div>
                                        <i class="fas fa-file-invoice"></i>
                                        <span>Invoice {{ $key + 1 }}</span> <!-- Start invoice number from 1 -->
                                    </div>
                                    <div>
                                        <h6> Date: {{ \Carbon\Carbon::parse($item->due_date ?? '')->format('m-d-Y') ?? 'Not Available' }}</h6>
                                        <h6> Total Amount: {{ $item->total_amount ?? '0' }}</h6>
                                    </div>
                                </label>
                            </div>
                            <div class="invoice_container_bottom" style="display: none">
                                <div class="form-group">
                                    <label>Remaining Amount</label>
                                    <input type="number" class="form-control amount_to_pay" step="0.01" min="0"  readonly>
                                </div>
                                <div class="form-group">
                                    <label>Enter Amount</label>
                                    <input type="hidden" class="payment_order_id" name="" value="{{ $item->id }}">
                                    <input type="number" class="form-control paid_amount" name="" min="1" step="0.01" value="" required>
                                </div>
                                <div class="form-group">
                                    <label>Balance Amount</label>
                                    <input type="number" class="form-control unpaid_amount" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
    <div class="col-md-12">
        <div class="form-group mb-0">
            <input class="btn d-block mx-auto btn-green " type="submit" value="{{ $submitButtonText??'Create' }}">
        </div>
    </div>

</div>
@push('js')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script>
        $(".select_disabled_assign_lead").prop("disabled", true);
        // $(document).ready(function() {
        $('#receiveInvoice').on('change', function() {
            var selectedOption = $(this).find(':selected');
            var id = selectedOption.val();
            $.ajax({
                url: '{{url("get_invoice_amount")}}',
                type: 'GET',
                data: {
                    id: id
                },
                success: function(response) {
                    // console.log(response)
                    $('#receiveAmount').val(response);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
        $.validator.addMethod("noSpace", function(value, element) {
            return value.trim().length !== 0;
        }, "Spaces are not allowed.");
        $('#payment-form').validate({
            rules: {
                Reference_number: {
                    required: true,
                    noSpace: true
                },
                lead_id: {
                    required: true,
                    noSpace: true
                },
                payment_type: {
                    required: true,
                    noSpace: true
                },
                'amount[]': {  // Properly handle the array-like field
                    required: true,
                    noSpace: true
                },
                date: {
                    required: true,
                    noSpace: true
                }
            },
            messages: {
                Reference_number: {
                    required: "Please enter Reference Number.",
                    noSpace: "Spaces are not allowed."
                },
                lead_id: {
                    required: "Please select Lead.",
                    noSpace: "Spaces are not allowed."
                },
                payment_type: {
                    required: "Please select Payment Type.",
                    noSpace: "Spaces are not allowed."
                },
                'amount[]': {  // Properly handle the array-like field
                    required: "Please enter Amount.",
                    noSpace: "Spaces are not allowed."
                },
                date: {
                    required: "Please select Date.",
                    noSpace: "Spaces are not allowed."
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });


        // Submit form from modal
        // $(document).on('click', '.edit_receive_payment_btn', function (e) {
        //     e.preventDefault();
        //     if ($('.edit_receive_payment_form').valid()) {
        //         $('.edit_receive_payment_form').submit();
        //     } else {
        //         $('html, body').animate({
        //             scrollTop: $(".error:visible:first").offset().top - 100
        //         }, 500);
        //     }
        // });

        // });



        $(document).on('change', '.order-checkbox', function() {
            var This = $(this);
            var accordionContent = This.closest('.invoice_container').find('.invoice_container_bottom');
            var id = This.data('order-id');

            $.ajax({
                url: '{{url("get_invoice_amount")}}',
                type: 'GET',
                data: { id: id },
                success: function(response) {
                    accordionContent.find('.amount_to_pay').val(response);

                    if (This.is(':checked')) {
                        accordionContent.slideDown();
                        accordionContent.find('.amount_to_pay').val(response);
                        accordionContent.find('.paid_amount').prop('required', true);
                        accordionContent.find('.payment_order_id').attr('name', 'invoice_id[]');
                        accordionContent.find('.paid_amount').attr('name', 'amount[]');
                        This.closest('.invoice_container').addClass('open');
                    } else {
                        accordionContent.slideUp();
                        accordionContent.find('.amount_to_pay').val('');
                        accordionContent.find('.paid_amount').val('');
                        accordionContent.find('.unpaid_amount').val('');
                        accordionContent.find('.paid_amount').prop('required', false);
                        accordionContent.find('.payment_order_id').removeAttr('name');
                        accordionContent.find('.paid_amount').removeAttr('name');
                        This.closest('.invoice_container').removeClass('open');

                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        $(document).on('input', '.paid_amount', function() {
            var accordionContent = $(this).closest('.invoice_container');
            var amountToPay = parseFloat(accordionContent.find('.amount_to_pay').val()) || 0;
            var paidAmount = parseFloat($(this).val()) || 0;
            if (paidAmount > amountToPay) {
                $(this).val(amountToPay.toFixed(2));
                paidAmount = amountToPay;
            }
            if (paidAmount < 0) {
                $(this).val('0.00');
                paidAmount = 0;
            }
            var unpaidAmount = amountToPay - paidAmount;
            accordionContent.find('.unpaid_amount').val(unpaidAmount.toFixed(2));
        });



    </script>
@endpush
