<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Invoice</h4>
            <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> × </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ url('/invoice/invoice/'. $invoice->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="invoiceEditForm" novalidate>
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <input name="view_lead" value="1" type="hidden">
                {{--                @include ('task.task.form', ['submitButtonText' => 'Update'])--}}
                <section class="task_form">
                    <div class="changeOrderOutr">
                        <div class="row">
                            @php
                                $invoice_unique_id = rand(100000, 999999);
                            @endphp
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                                    <label for="address" class=" control-label">{{ 'Invoice Number' }}</label>

                                    <input class="form-control" name="invoice_unique_id" type="text"  value="{{ $invoice_unique_id }}" readonly>
                                    {!! $errors->first('address','<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class=" form-group {{ $errors->has('assign_to_lead_id') ? 'has-error' : ''}}">
                                    <label for="assign_to_lead_id" class=" control-label">{{ 'Assign To Lead ' }}</label>

                                    <select class="form-control   borderRadius assign_lead_readonly" name="lead_id" id="lead_id" required>
                                        @if(!empty($leadExist))
                                            @foreach($leads as $lead)
                                                <option value="{{$lead->id}}" @if(isset($leadExist) && $lead->id == $leadExist->id) selected @endif>{{$lead->title}}</option>
                                            @endforeach
                                        @else
                                            @foreach($leads as $lead)
                                                <option value="{{$lead->id}}" @if(isset($invoice)  && $lead->id == $invoice->lead_id) selected @endif >{{$lead->title}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    {!! $errors->first('lead_id', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class=" form-group {{ $errors->has('assign_to_user_id') ? 'has-error' : ''}}">
                                    <label for="assign_to_user_id" class=" control-label">{{ 'User ' }}</label>

                                    <input class="form-control" name="customer_id" type="text" id="customer_id" readonly>
                                    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class=" form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                                    <label for="address" class=" control-label">{{ 'Billing Address' }}</label>

                                    <input class="form-control" placeholder="Enter address" name="address" type="text" id="address" readonly>
                                    {!! $errors->first('address','<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class=" form-group {{ $errors->has('due_date') ? 'has-error' : ''}}">
                                    <label for="due_date" class=" control-label">{{ 'Due Date' }}</label>

                                    <input class="form-control" name="due_date" type="date" id="due_date" value="{{ $invoice->due_date??''}}" >
                                    {!! $errors->first('due_date', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="col-md-12">

                                <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                    <label for="description" class=" control-label">{{ 'Description' }}</label>
                                    <textarea class="form-control" rows="5" name="invoice_description" id="invoice_description">{!! $invoice->description??''!!}</textarea>
                                    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table" id="myTable">
                                    <thead>
                                    <tr>
                                        <th>Activity<span class="text-danger">*</span></th>
                                        <th>Category Type</th>
                                        <th>Quantity</th>
                                        <th>Rate</th>
                                        <th class="taxhead">Taxable</th>
                                        <th colspan="2">Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($invoice) && $invoice)
                                        @foreach($invoice->getInvoiceAttachments as $value)
                                            <tr>
                                                <td>
                                                    <input class="form-control" name="activity_name[]" type="text" id="activity_name" value="{{ $value->activity_name??''}}" required>
                                                </td>
                                                <td>
                                                    <select class="form-control  custom_modal_select2 borderRadius" name="category_id[]" id="category_id" required>
                                                        @foreach($categories as $category)
                                                            <option value="{{$category->id}}" @if(isset($value) && $category->id == $value->category_id) selected @endif >{{$category->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input class="form-control quantity" name="quantity[]" min="0" type="number" id="quantity" value="{{ $value->quantity??''}}">
                                                </td>
                                                <td>
                                                    <input class="form-control rate" name="rate[]" min="0" type="number" id="rate" value="{{ $value->rate??''}}">
                                                </td>
                                                <td class="taxForm">
                                                    @if($value->tax != null)
                                                        <input type="checkbox" name="terms" class="InvoicetaxCheckbox" checked>
                                                    @else
                                                        <input type="checkbox" name="terms" class="InvoicetaxCheckbox">
                                                    @endif
                                                    <input type="hidden" class="edit_invoice_tax" name="tax[]">
                                                </td>
                                                <td>
                                                    <input class="form-control amount" name="amount[]" type="text" id="amount" value="{{ $value->amount??''}}" readonly>
                                                </td>
                                                @if($loop->first)
                                                    <td>
                                                        <button id="addInvoiceRowBtn" class="btn btn-danger addRowBtn addRowEditBtn" style="width: auto!important;"><i class="btn btn-sm fa fa-plus" aria-hidden="true"></i></button>
                                                    </td>
                                                @else
                                                    <td>
                                                        <button class="btn btn-danger deleteRowBtn"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>
                                                <input class="form-control" name="activity_name[]" type="text" id="activity_name" value="" required>
                                            </td>
                                            <td>
                                                <select class="form-control  custom_modal_select2 borderRadius" name="category_id[]" id="category_id" required>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input class="form-control quantity" name="quantity[]" min="0" type="number" id="quantity" value="1">
                                            </td>
                                            <td>
                                                <input class="form-control rate" name="rate[]" min="0" type="number" id="lead_price" value="">
                                            </td>
                                            <td class="taxForm">
                                                <input type="checkbox" name="terms" class="InvoicetaxCheckbox" >
                                                <input type="hidden" class="edit_invoice_tax" name="tax[]">
                                            </td>

                                            <td>
                                                <input class="form-control amount" name="amount[]" type="text" id="amount" value="" readonly>
                                            </td>
{{--                                            <td>--}}
{{--                                                <button class="btn btn-danger deleteRowBtn"><i class="fa fa-trash-o" aria-hidden="true"></i></button>--}}
{{--                                            </td>--}}
                                            <td>
                                                <a id="addInvoiceRowBtn" class="btn btn-danger addRowBtn addRowEditBtn" style="width: auto!important;"><i class="btn btn-sm fa fa-plus" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    @endif

                                    </tbody>
                                </table>
                                @php
                                    $subtotalValue = 0;
                                    foreach($invoice->getInvoiceAttachments as $value){
                                        $subtotalValue += $value->amount;
                                    }
                                @endphp
                                <span class="d-flex justify-content-end">Sub Total: $<span class="subtotalInvoice">{{ $subtotalValue??"" }}</span>
                                    <input type="hidden" name="sub_total" class="editSubtotal">
                                </span>
                                <div class="tax" style="xdisplay: none;">
                                    <span class="d-flex justify-content-end">Tax: $<span id="tax">{{ $invoice->total_tax??"" }}</span><input type="hidden" name="total_tax" id="taxInput" value="{{ $invoice->total_tax ??"" }}"></span>
                                    <span class="d-flex justify-content-end">Total: $<span class="invoice_total_amount" name="total_amount">{{ $invoice->total_amount??"" }}</span><input type="hidden" name="total_amount" class="invoice_total_amount" value="{{ $invoice->total_amount ??"" }}"></span>
                                </div>


{{--                                <div class="row">--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <button class="btn btn-primary" id="addInvoiceRowBtn">+</button>--}}
{{--                                    </div>--}}
{{--                                    <div class="d-flex justify-content-end align-items-center">--}}
{{--                                        <input class="mx-3" type="checkbox" name="" id="taxCheckbox">--}}
{{--                                        <label class="fs-3 mb-0">Taxable</label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                            <div class="col-md-12">
                                {{--<div class="form-group">
                                    <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
                                </div>--}}
                                <div class="form-group mb-0">
                                    <div class="d-flex justify-content-center">
                                        <input class="btn btn-green edit_invoice_submit_btn" type="submit" value="{{ $submitButtonText??'Update' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
{{--    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.validator.addMethod("noSpace", function(value, element) {
                return value.trim().length !== 0; // Check if the trimmed value is not an empty string
            }, "Spaces are not allowed.");
            let editor;
            if (typeof ClassicEditor !== "undefined") {
                ClassicEditor
                    .create(document.querySelector('#invoice_description'))
                    .then(newEditor => {
                        editor = newEditor;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            } else {
                console.error("ClassicEditor is not defined. Please check if CKEditor 5 is loaded correctly.");
            }
            $.validator.addMethod("invoiceDescription", function(value, element) {
                if (editor) {
                    var editorContent = editor.getData().trim();
                    return editorContent.length !== 0;
                }
                return false;
            }, "Description is required.");
            $('#invoiceEditForm').validate({
                ignore: [],
                rules: {
                    due_date: {
                        required: true
                    },
                    description: {
                        invoiceDescription: true
                    },
                    activity_name: {
                        required: true,
                        noSpace: true
                    },
                    quantity: {
                        required: true
                    },
                    rate: {
                        required: true,
                    }
                },
                messages: {
                    due_date: {
                        required: "Please select date."
                    },
                    description: {
                        invoiceDescription: "Please enter Description"
                    },
                    rate: {
                        required: "Please enter rate"
                    },
                    quantity: {
                        required: "Please enter quantity"
                    },
                    activity_name: {
                        required: "Please enter Activity Name",
                        noSpace: "Spaces are not allowed."

                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Get the initial value of the lead ID
            var initialLeadId = $('#lead_id').val();

            // Function to fetch and populate the customer ID and address fields
            function fetchData(leadId) {
                $.ajax({
                    url: '/invoice/invoice/fetch-data/' + leadId,
                    type: 'GET',
                    data: { lead_id: leadId },
                    success: function(response) {
                        $('#address').val(response.address);
                        $('#customer_id').val(response.customer_id);
                        $('#lead_price').val(response.lead_price);
                        $('#tax').val(response.tax);
                        // $('.edit_invoice_tax').val(response.tax);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
            // Call the fetchAddress function on page load with the initial lead ID
            fetchData(initialLeadId);

            // Event handler for lead ID change
            $('#lead_id').change(function() {
                var leadId = $(this).val();
                fetchData(leadId);
            });
        });
        $(document).ready(function() {
            $('#signatureCheckbox').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#signatureForm').show();

                } else {
                    $('#signatureForm').hide();
                }
            });
        });

        // $(document).ready(function() {
        //     $('#taxCheckbox').on('change', function() {
        //         if ($(this).is(':checked')) {
        //             $('.taxForm').show();
        //             $('.taxhead').show();
        //             //$('.tax').show();
        //         } else {
        //             $('.taxForm').hide();
        //             $('.taxhead').hide();
        //             //$('.tax').hide();
        //         }
        //     });
        // });
        $(document).ready(function() {
            // Calculate amount when quantity or rate changes
            $(document).on('input', '.quantity, .rate', function() {
                var row = $(this).closest('tr');
                var quantity = parseFloat(row.find('.quantity').val());
                var rate = parseFloat(row.find('.rate').val());
                var amount = isNaN(quantity) || isNaN(rate) ? 0 : quantity * rate;
                row.find('.amount').val(amount.toFixed(2));
                calculateSubtotal();
            });
            // Add new row when the plus button is clicked
            $('#addInvoiceRowBtn').on('click', function(event) {
                event.preventDefault(); // Prevent form submission
                var isTaxChecked = $('#taxCheckbox').is(':checked');
                // var taxFormStyle = isTaxChecked ? '' : 'style="display: none;"';
                var newRow =
                    '<tr>' +
                    '<td><input class="form-control" name="activity_name[]" type="text"></td>' +
                    '<td>' +
                    '<select class="form-control custom_modal_select2 borderRadius" name="category_id[]" required>' +
                    '@foreach($categories as $category)' +
                    '<option value="{{$category->id}}">{{$category->name}}</option>' +
                    '@endforeach' +
                    '</select>' +
                    '</td>' +
                    '<td><input class="form-control quantity" name="quantity[]" min="0" type="number"></td>' +
                    '<td><input class="form-control rate" name="rate[]" min="0" type="number"></td>' +
                    '<td class="taxForm"><input type="checkbox" name="terms" class="InvoicetaxCheckbox"><input type="hidden" class="edit_invoice_tax" name="tax[]"></td>' +
                    '<td><input class="form-control amount" name="amount[]" type="text" readonly></td>' +
                    '<td><button class="btn btn-danger deleteRowBtn"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>' +
                    '</tr>';
                $('#myTable tbody').append(newRow);
                $('#myTable tbody tr:last .select2').select2();
            });
            // Delete row when the delete button is clicked
            $(document).on('click', '.deleteRowBtn', function() {
                $(this).closest('tr').remove();
                calculateSubtotal();
            });

            $(document).on('change', '.InvoicetaxCheckbox', function() {
                var rowIndex = $(this).data('row-index');
                calculateTotalTax(rowIndex);
            });

            //Function to calculate and update the subtotal
            function calculateSubtotal() {
                var subtotal = 0;
                $('.amount').each(function() {
                    var amount = parseFloat($(this).val());
                    if (!isNaN(amount)) {
                        subtotal += amount;
                    }
                });
                subtotalValue = subtotal;
                $('.subtotalInvoice').text(subtotal.toFixed(2));
                // $('.subTotalInput').text(subtotal.toFixed(2));
                calculateTotalTax();
            }

            function calculateTotalTax() {
                var subtotal = 0;
                var totalTax = 0;
                $('tr').each(function(index) {
                    var amountInput = $(this).find('.amount');
                    var taxInput = $(this).find('.tax');
                    var taxCheckbox = $(this).find('.InvoicetaxCheckbox');
                    var amount = parseFloat(amountInput.val());
                    if (!isNaN(amount)) {
                        {{--var taxRate = "{{ $lead->tax??"0" }}";--}}
                        var taxRate = $('#tax').val();
                        console.log('tax:',taxRate);
                        var taxAmount = 0; // Initialize taxAmount to 0
                        if (taxCheckbox.is(':checked')) {
                            taxAmount = amount * taxRate / 100;
                            // $('.edit_invoice_tax').val(taxAmount);
                            $(this).find('.edit_invoice_tax').val(taxAmount);
                            console.log('tax after total amount:', taxAmount);
                            amountInput.next('.tax-amount').remove();
                            amountInput.after('<span class="tax-amount fs-4"> (Tax $' + taxAmount.toFixed(2) + ')</span>');
                        } else {
                            // Remove tax amount if the checkbox is unchecked
                            $(this).find('.tax-amount').remove();
                        }
                        // Add the amount and tax to the subtotal and totalTax
                        subtotal += amount;
                        totalTax += taxAmount;
                    }
                });

                $('.subtotalInvoice').text(subtotal.toFixed(2));
                $('.editSubtotal').val(subtotal.toFixed(2));
                $('#tax').text(totalTax.toFixed(2));
                $('#taxInput').val(totalTax.toFixed(2));
                calculateTotal(subtotal, totalTax);
            }

            function calculateTotal(subtotal, tax) {
                var total = subtotal + tax;
                if ($('.InvoicetaxCheckbox').is(':checked')) {
                    $('.invoice_total_amount').text(total.toFixed(2));
                    $('[name="total_amount"]').val(total.toFixed(2));
                } else {
                    $('.invoice_total_amount').text(subtotal.toFixed(2));
                    $('[name="total_amount"]').val(subtotal.toFixed(2));
                }
            }

            $('.InvoicetaxCheckbox').change(function() {
                if ($('.InvoicetaxCheckbox').is(':checked')) {
                    // calculateTotal(subtotalValue, parseFloat($('#tax').text()));
                } else {
                    calculateTotal(subtotalValue, 0);
                }
            });

            $(document).ready(function(){
                $("#changeorder_form").validate({
                    rules: {
                        lead_id: "required",
                        address: "required",
                        description: "required",
                    },
                    messages: {
                        lead_id: {
                            required: "Please enter your Address",
                        },
                        address: {
                            required: "Please enter your Address",
                        },
                        description: {
                            required: "Please enter your Address",
                        },
                    },
                });
            });
        });

        // Submit form from modal
        $(document).on('click', '.edit_invoice_submit_btn', function (e) {
            e.preventDefault();
            if ($('#invoiceEditForm').valid()) {
                $('#invoiceEditForm').submit();
            } else {
                $('html, body').animate({
                    scrollTop: $(".error:visible:first").offset().top - 100
                }, 500);
            }
        });

        $(".select_disabled_assign_lead").prop("disabled", true);
    </script>
</div>
