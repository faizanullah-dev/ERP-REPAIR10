<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Change Order</h4>
            <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> × </button>
        </div>

        <div class="modal-body">
            <form method="POST" action="{{ url('/changeOrder/change-order/'. $changeorder->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="changeorderedit-form" novalidate>
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <input name="view_lead" value="1" type="hidden">
                <div class="changeOrderOutr">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="changeOrderLogo">
                                    <img src="{{asset('website/images/logo.png')}}" alt="logo">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <p>Billed To:</p>
                                <h2>{{ $changeorder->customer_id??"Not Available"  }}</h2>
                                <p id="customer_address"></p>
                                <p id="zip"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <p class="d-block">Check Payable to:</p>
                                <h2 id="lead_name"></h2>
                                <p id="lead_address"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="billed_on" class=" control-label">Change Order #</label>
                                <input class="form-control" name="change_order_unique_id" type="text" id="change_order_unique_id" value="{{ $changeorder->change_order_unique_id??"" }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="billed_on" class=" control-label">Billed On</label>
                                <input class="form-control"   id="billed_on" value="{{Carbon\Carbon::parse($changeorder->created_at)->format('M/d/Y') }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class=" form-group {{ $errors->has('assign_to_lead_id') ? 'has-error' : ''}}">
                                <label for="assign_to_lead_id" class="control-label ">{{ 'Assign To Lead ' }}</label>
                                <select class="form-control   assign_lead_readonly" name="lead_id" id="lead_id" required >
                                    @foreach($leads as $lead)
                                        <option value="{{$lead->id}}" @if(isset($changeorder) && $lead->id == $changeorder->lead_id) selected
                                                @endif >{{$lead->title}}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('lead_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class=" form-group {{ $errors->has('assign_to_user_id') ? 'has-error' : ''}}">
                                <label for="assign_to_user_id" class="control-label">{{ 'User' }}</label>
                                <input class="form-control" name="customer_id" type="text" id="customer_id"  readonly>
                                {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class=" form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                                <label for="address" class="control-label">{{ 'Billing Address' }}</label>
                                <input class="form-control" placeholder="Enter address" name="address" type="text" id="address" readonly>
                                {!! $errors->first('address','<p class="help-block">:message</p>') !!}
                                <input class="form-control" name="representative_id" type="hidden" id="representative_id" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0 mt-4">
                                <label></label>
                                <table  class="tbl_small">
                                    <thead>
                                    <tr>
                                        <th>
                                            Balance Due :  {{ $changeorder->total_amount??"00" }}
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
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
                                @if(isset($changeorder) && $changeorder)
                                    @foreach($changeorder->getChangeOrderAttachments as $value)
                                        <tr>
                                            <td>
                                                <input class="form-control" name="activity_name[]" type="text" id="activity_name"
                                                       value="{{ $value->activity_name??''}}" required>
                                            </td>
                                            <td>
                                                <select class="form-control custom_modal_select2 " name="category_id[]"
                                                        id="category_id" required>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}" @if(isset($value) && $category->id == $value->category_id)
                                                            selected @endif >{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input class="form-control edit_quantity" min="0" name="quantity[]" type="number" id="quantity" value="{{ $value->quantity??''}}">
                                            </td>
                                            <td>
                                                <input class="form-control edit_rate" min="0" name="rate[]" type="number" id="rate" value="{{ $value->rate??''}}">
                                            </td>
                                            <td class="taxForm">
                                                @if($value->tax != null)
                                                    <input type="checkbox" name="terms" class="editTaxCheck" checked>
                                                @else
                                                    <input type="checkbox" name="terms" class="editTaxCheck">
                                                @endif
                                                    <input type="hidden" class="edit_change_tax" name="tax[]">
                                            </td>
                                            <td>
                                                <input class="form-control edit_amount" name="amount[]" type="text" id="amount" value="{{ $value->amount??''}}" readonly>
                                            </td>
                                            @if($loop->first)
                                                <td>
                                                    <button class="btn btn-danger addRowBtn addRowEditBtn" style="width: auto!important;"><i class="btn btn-sm fa fa-plus" aria-hidden="true"></i></button>
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
                                            <select class="form-control  custom_modal_select2 " name="category_id[]"
                                                    id="category_id" required>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input class="form-control edit_quantity" name="quantity[]" type="number" id="quantity" value="">
                                        </td>
                                        <td>
                                            <input class="form-control edit_rate" name="rate[]" type="number" id="rate" value="">
                                        </td>
                                        <td class="taxForm">
                                            <input type="checkbox" name="terms" class="editTaxCheck" >
                                            <input type="hidden" class="edit_chnage_tax" name="tax[]">
                                        </td>
                                        <td>
                                            <input class="form-control edit_amount" name="amount[]" type="text" id="amount" value="" readonly>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger addRowBtn"  style="width: auto!important;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
{{--                            <div class="plus_btn_tax_check justify-content-end">--}}
{{--                                <div class="input_wrapper">--}}
{{--                                    <input class="mx-3" type="checkbox" name="" id="editTaxCheck">--}}
{{--                                    <label class="fs-3">Taxable</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <span class="d-flex justify-content-end">Sub Total: $<span id="editSubtotal">{{ $changeorder->sub_total??"" }}</span>
                                <input type="hidden" class="editSubTotalInput" name="sub_total" value="{{ $changeorder->sub_total??"" }}">
                            </span>

                            <div class="tax" style="xdisplay: none;">
                                <span class="d-flex justify-content-end">Tax: $<span id="tax">{{ $changeorder->total_tax??"" }}</span>
                                    <input type="hidden" name="total_tax" id="taxInput" value="{{ $changeorder->total_tax ??"" }}"></span>
                                <span class="d-flex justify-content-end">Total: $<span class="total" name="total_amount">{{ $changeorder->total_amount??"" }}</span><input type="hidden" name="total_amount" class="total" value="{{ $changeorder->total_amount ??"" }}"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                <div>
                                    <label for="description" class="control-label">{{ 'Description' }}</label>
                                </div>
                                <div>
                                    <textarea class="form-control" rows="5" name="description"  id="changeOrderdescription">{!!($changeorder->description??'')!!}</textarea>
                                </div>
                                <p class="help-block text-danger" id="change-order-description"></p>
                                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-0">
                                <input class="btn d-block mx-auto btn-green edit_change_order_btn" type="submit" value="Update">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">

    $(document).ready(function() {


        $.validator.addMethod("noSpace", function(value, element) {
            return value.trim().length !== 0; // Check if the trimmed value is not an empty string
        }, "Spaces are not allowed.");
        let editor;
        // if (typeof ClassicEditor !== "undefined") {
            ClassicEditor
                .create(document.querySelector('#changeOrderdescription'))
                .then(newEditor => {
                    editor = newEditor;
                })
                .catch(error => {
                    console.error(error);
                });
        // } else {
        //     console.error("ClassicEditor is not defined. Please check if CKEditor 5 is loaded correctly.");
        // }
        $.validator.addMethod("orderChangeDescription", function(value, element) {
            if (editor) {
                var editorContent = editor.getData().trim();
                return editorContent.length !== 0;
            }
            return false;
        }, "Description is required.");
        var formValidator =   $('#changeorderedit-form').validate({
            ignore: [],
            rules: {
                due_date: {
                    required: true
                },
                /*description: {
                    orderChangeDescription: true
                },*/
                'rate[]': {
                    required: true
                },
                'quantity[]': {
                    required: true
                },
                'category_id[]': {
                    required: true
                },
                'activity_name[]': {
                    required: true,
                    noSpace: true
                }
            },
            messages: {
                due_date: {
                    required: "Please select date."
                },
                /*description: {
                    orderChangeDescription: "Please enter Description"
                },*/
                'rate[]': {
                    required: "Please enter rate"
                },
                'quantity[]': {
                    required: "Please enter quantity"
                },
                'category_id[]': {
                    required: "Please select category"
                },
                'activity_name[]': {
                    required: "Please enter Activity Name",
                    noSpace: "Spaces are not allowed."

                }
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            },
            highlight: function (element) {
                $(element).closest('td').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).closest('td').removeClass('has-error');
            },
            submitHandler: function (form) {
                form.submit();
            }
        });

        // $(document).ready(function () {
        //     ['#changeOrderdescription'].forEach(selector => {
        //         ClassicEditor.create(document.querySelector(selector)).catch(console.error);
        //     });
        // });
        $(document).ready(function () {
            var initialLeadId = $('#lead_id').val();
            function fetchAddress(leadId) {
                $.ajax({
                    url: '/changeOrder/change-order/fetch-address/' + leadId,
                    type: 'GET',
                    data: {
                        lead_id: leadId
                    },
                    success: function (response) {
                        $('#address').val(response.address);
                        $('#lead_address').text(response.address);
                        $('#customer_address').text(response.address);
                        $('#city').text(response.city);
                        $('#state').text(response.state);
                        $('#zip').text(response.zip);
                        $('#customer_id').val(response.customer_id);
                        $('#customer_name').text(response.customer_id);
                        var leadName= response.title;
                        $('#lead_name').text(leadName);
                        $('#representative_id').val(response.representative_id);
                        var imageUrl = response.upload_signature;
                        var NoImage=imageUrl==null;
                        if (imageUrl === null || imageUrl === "") {
                            $('#signatureForm').show();
                            $('#imagePreviewContainer').hide();
                            $('#signatureCheckbox').prop('checked', true);
                        }
                        else if (imageUrl.includes('.png') || imageUrl.includes('.jpg') || imageUrl.includes('.jpeg')) {
                            $('#imagePreview').attr('src', '{{ asset("website/") }}' + '/' + imageUrl);
                            $('#signatureForm').hide();
                            $('#upload_signature').val(imageUrl);
                            $('#imagePreviewContainer').show();
                            $('#signatureCheckbox').prop('checked', true);
                        }else {
                            $('#imagePreview').attr('src', imageUrl);
                            $('#signatureForm').hide();
                            $('#imagePreviewContainer').show();
                            $('#mouseSignatureInput').val(imageUrl);
                            $('#upload_signature').val(null);
                            $('#signatureCheckbox').prop('checked', true);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
            // Call the fetchAddress function on page load with the initial lead ID
            fetchAddress(initialLeadId);

            // Event handler for lead ID change
            $(document).on('change', '#lead_id', function () {
                var leadId = $(this).val();
                fetchAddress(leadId);
            });
        });
        // $(document).ready(function () {
        //     $('#signatureCheckbox').on('change', function () {
        //         if ($(this).is(':checked')) {
        //             $('#signatureForm').show();
        //
        //         } else {
        //             $('#signatureForm').hide();
        //         }
        //     });
        // });
        $(document).ready(function() {
            // Retrieve the stored signature value
            var storedSignature = "{{ $changeorder->signature ?? '' }}";

            // Check if the stored signature is not null
            if (storedSignature !== null && storedSignature !== "") {
                // Display the signature form
                $('#signatureForm').show();

                // Set the stored signature as checked
                $('#signatureCheckbox').prop('checked', true);

                // Load the stored signature image onto the canvas
                loadSignatureImage(storedSignature);

                // Set the stored signature value to the hidden input field
                $('#mouseSignatureInput').val(storedSignature);
            }

            {{--    // Handle the change event of the signature checkbox--}}
            {{--    // $('#signatureCheckbox').on('change', function() {--}}
            {{--    //     if ($(this).is(':checked')) {--}}
            {{--    //         $('#signatureForm').show();--}}
            {{--    //     } else {--}}
            {{--    //         $('#signatureForm').hide();--}}
            {{--    //     }--}}
            {{--    // });--}}

            // Function to load the stored signature image onto the canvas
            function loadSignatureImage(signature) {
                var canvas = document.getElementById('mouseSignatureCanvas');
                var ctx = canvas.getContext('2d');
                var img = new Image();

                img.onload = function() {
                    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                };

                img.src = signature;
            }
        });
        // $(document).ready(function () {
        //     $('#editTaxCheck').on('change', function () {
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
        // Mouse Signature
        {{--var mouseSignatureCanvas = document.getElementById('mouseSignatureCanvas');--}}
        {{--var mouseSignaturePad = new SignaturePad(mouseSignatureCanvas);--}}

        {{--function clearMouseSignature() {--}}
        {{--    mouseSignaturePad.clear();--}}
        {{--    document.getElementById('mouseSignatureInput').value = "";--}}
        {{--}--}}
        {{--mouseSignaturePad.onEnd = function () {--}}
        {{--    updateSignatureInput();--}}
        {{--};--}}
        {{--window.addEventListener('load', function () {--}}
        {{--    var canvas = document.getElementById('mouseSignatureCanvas');--}}
        {{--    var ctx = canvas.getContext('2d');--}}
        {{--    var img = new Image();--}}

        {{--    img.onload = function () {--}}
        {{--        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);--}}
        {{--    };--}}

        {{--    img.src = "{{ $changeorder->signature??'' }}";--}}
        {{--});--}}

        {{--function updateSignatureInput() {--}}
        {{--    var canvas = document.getElementById('mouseSignatureCanvas');--}}
        {{--    var signatureInput = document.getElementById('mouseSignatureInput');--}}
        {{--    signatureInput.value = canvas.toDataURL();--}}
        {{--}--}}

        $(document).ready(function () {
            // Calculate amount when quantity or rate changes
            $(document).on('input', '.edit_quantity, .edit_rate', function () {
                var row = $(this).closest('tr');
                var quantity = parseFloat(row.find('.edit_quantity').val());
                var rate = parseFloat(row.find('.edit_rate').val());
                var amount = isNaN(quantity) || isNaN(rate) ? 0 : quantity * rate;
                row.find('.edit_amount').val(amount.toFixed(2));
                calculateSubtotal();
            });

            // Add new row when the plus button is clicked
            $('.addRowEditBtn').on('click', function (event) {
                event.preventDefault();
                var isTaxChecked = $('.editTaxCheck').is(':checked');
                // var taxFormStyle = isTaxChecked ? '' : 'style="display: none;"';
                var newRow =
                    '<tr>' +
                    '<td><input class="form-control" name="activity_name[]" type="text"></td>' +
                    '<td>' +
                    '<select class="form-control custom_modal_select2 " name="category_id[]" required>' +
                    '@foreach($categories as $category)' +
                    '<option value="{{$category->id}}">{{$category->name}}</option>' +
                    '@endforeach' +
                    '</select>' +
                    '</td>' +
                    '<td><input class="form-control edit_quantity" name="quantity[]" type="number"></td>' +
                    '<td><input class="form-control edit_rate" name="rate[]" type="number"></td>' +
                    '<td class="taxForm"><input type="checkbox" name="terms" class="editTaxCheck"><input type="hidden" class="edit_change_tax" name="tax[]"></td>' +
                    '<td><input class="form-control edit_amount" name="amount[]" type="text" readonly></td>' +
                    '<td><button class="btn btn-danger deleteRowBtn"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>' +
                    '</tr>';
                $(this).closest('table').find('tbody').append(newRow);
                $('#myTable tbody tr:last .select2').select2();
                $('.edit_change_order_select_modal').select2({
                    placeholder: "Select Lead",
                    allowClear: true,
                    dropdownParent: $('#editChangeOrderModal') // Ensure dropdown appears inside the modal
                });
                $('#myTable tbody tr:last').find('input, select').each(function () {
                    $(this).rules('add', formValidator.settings.rules);
                    $(this).valid();
                });
            });
            {{----}}

            // Delete row when the delete button is clicked
            // $(document).on('click', '.deleteRowBtn', function () {
            //     $(this).closest('tr').remove();
            //     calculateSubtotal();
            // });
            $('#changeorderedit-form').on('submit', function(event) {
                event.preventDefault();
                var isValid = $(this).valid();
                if (isValid) {
                    $(this).submit();
                } else {
                    console.log("Form is invalid.");
                }
            });

            $('#myTable').on('click', '.deleteRowBtn', function (event) {
                event.preventDefault();
                $(this).closest('tr').remove();
                $('#changeorderedit-form').validate().element($('#myTable input, #myTable select'));
            });
            //
            $(document).on('change', '.editTaxCheck', function () {
                var rowIndex = $(this).data('row-index');
                calculateTotalTax(rowIndex);
            });

            // Function to calculate and update the subtotal
            function calculateSubtotal() {
                var subtotal = 0;
                $('.edit_amount').each(function () {
                    var amount = parseFloat($(this).val());
                    if (!isNaN(amount)) {
                        subtotal += amount;
                    }
                });
                subtotalValue = subtotal;
                $('#editSubtotal').text(subtotal.toFixed(2));
                $('.editSubTotalInput').val(subtotal.toFixed(2));
                calculateTotalTax();
            }
            function calculateTotalTax() {
                var subtotal = 0;
                var totalTax = 0;
                $('tr').each(function (index) {
                    var amountInput = $(this).find('.edit_amount');
                    var taxInput = $(this).find('.tax');
                    var editTaxCheck = $(this).find('.editTaxCheck');
                    var amount = parseFloat(amountInput.val());
                    var editTax = parseFloat({{ $changeorder->getLead->tax ?? 0 }}) / 100;
                    if (!isNaN(amount)) {
                        var taxAmount = 0;
                        if (editTaxCheck.is(':checked')) {
                            taxAmount = amount * editTax;
                            $(this).find('.edit_change_tax').val(taxAmount);
                            // Display tax amount below the amount field
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

                $('#subtotal').text(subtotal.toFixed(2));
                $('#tax').text(totalTax.toFixed(2));
                $('#taxInput').val(totalTax.toFixed(2)); // Update the input field for tax
                calculateTotal(subtotal, totalTax);
            }

            // function calculateTotal(subtotal, tax) {
            //     var total = subtotal + tax;
            //     if ($('.editTaxCheck').is(':checked')) {
            //         $('.total').text(total.toFixed(2));
            //         $('[name="total_amount"]').val(total.toFixed(2));
            //     } else {
            //         $('.total').text(subtotal.toFixed(2));
            //         $('[name="total_amount"]').val(subtotalValue.toFixed(2));
            //     }
            // }
            function calculateTotal(subtotal, tax) {
                var total = subtotal + tax;
                if ($('.editTaxCheck').is(':checked')) {
                    // If tax is checked, show total with tax included
                    $('.total').text(total.toFixed(2));
                    $('[name="total_amount"]').val(total.toFixed(2));
                } else {
                    // If tax is not checked, show subtotal only
                    $('.total').text(subtotal.toFixed(2));
                    $('[name="total_amount"]').val(subtotal.toFixed(2)); // Use 'subtotal' here, not 'subtotalValue'
                }
            }


            $('.editTaxCheck').change(function () {
                calculateTotal(subtotalValue, parseFloat($('#tax').text()));
            });

            $('.editTaxCheck').change(function () {
                if ($('.editTaxCheck').is(':checked')) {
                    // calculateTax(subtotalValue);
                } else {
                    calculateTotal(subtotalValue, 0);
                }
            });

        });
    });

    // Submit form from modal
    $(document).on('click', '.edit_change_order_btn', function (e) {
        e.preventDefault();
        if ($('#changeorderedit-form').valid()) {
            $('#changeorderedit-form').submit();
        } else {
            $('html, body').animate({
                scrollTop: $(".error:visible:first").offset().top - 100
            }, 500);
        }
    });
</script>


