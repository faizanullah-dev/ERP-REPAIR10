@push('css')
    <style>

    </style>
@endpush
<div class="changeOrderOutr">
    <div class="row">
        <div class="col-md-12">
            <div class="changeOrderLogo">
                <img src="{{asset('website/images/logo.png')}}" alt="logo">
            </div>
        </div>
        @php
            $change_order_unique_id = rand(100000, 999999)
        @endphp
        <div class="col-md-6">
            <h5>Job Info:</h5>

            <h6 id="lead_name"></h6>
            <p id="lead_address"></p>
        </div>
        <div class="col-md-6">
            <h5 class="d-block">Check payable to:</h5>
            <h6 class="customer_name">
            </h6>
            <p id="customer_address"></p>
            <p id="city"></p>
            <p id="state"></p>
            <p id="zip"></p>
        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group ">
                        <label for="billed_on" class=" control-label">Change Order #</label>
                        <input class="form-control" name="change_order_unique_id" type="text" id="change_order_unique_id" value="{{ $change_order_unique_id??"" }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="form-group ">
                        <label for="billed_on" class=" control-label">Billed On</label>
                        <input class="form-control"  id="billed_on" value="{{Carbon\Carbon::now()->format('M/d/Y')}}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                        <label for="due_date" class=" control-label">Due Date</label>
                        <input class="form-control" name="due_date" type="date" id="due_date" value="{{ Carbon\Carbon::now()->format('F j, Y') }}">
                    </div>
                </div>

                {{--                <div class="col-md-6">--}}
                {{--                    <div class="form-group">--}}
                {{--                        <label for="due_date" class=" control-label">Contract Price </label>--}}
                {{--                        <input class="form-control" name="due_date" type="text" id="due_date" value="" placeholder="Type here...">--}}
                {{--                        {!! $errors->first('due_date', '<p class="help-block">:message</p>') !!}--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                <div class="col-md-6">--}}
                {{--                    <div class="form-group">--}}
                {{--                        <label for="due_date" class=" control-label">Changes</label>--}}
                {{--                        <input class="form-control" name="text" type="text" id="due_date" value="" placeholder="Type here...">--}}
                {{--                        {!! $errors->first('due_date', '<p class="help-block">:message</p>') !!}--}}
                {{--                    </div>--}}
                {{--                </div>--}}


                {{--                <input type="hidden" class="form-control clr_input_fields select2 borderRadius lead_id_for_order" name="lead_id" value="" id="">--}}

                <div class="col-md-6" style="display: none">
                    <div class=" form-group {{ $errors->has('assign_to_lead_id') ? 'has-error' : ''}}">
                        <label for="assign_to_lead_id" class=" control-label">{{ 'Assign To Lead ' }} *</label>
                        <select class="form-control select2  borderRadius lead_id_for_order" name="lead_id" >
                            @if(!empty($leadExist))
                                @foreach($leads as $lead)
                                    <option value="{{$lead->id}}" @if(isset($leadExist) && $lead->id == $leadExist->id) selected @endif>{{$lead->title}}</option>
                                @endforeach
                            @else
                                @foreach($leads as $lead)
                                    <option  value="{{$lead->id}}" @if(isset($changeorder) && $lead->id == $changeorder->lead_id) selected @endif>{{$lead->title}}</option>
                                @endforeach
                            @endif
                        </select>
                        {!! $errors->first('lead_id', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                {{--                <div class="col-md-6">--}}
                {{--                    <div class=" form-group {{ $errors->has('assign_to_user_id') ? 'has-error' : ''}}">--}}
                {{--                        <label for="assign_to_user_id" class=" control-label">{{ 'User' }}</label>--}}
                <input type="hidden" name="customer_id" id="customer_id">
                <input type="hidden" class="form-control customer_name" id="lead_customer_name" readonly>
                {{--                        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}--}}
                <input class="form-control" name="representative_id" type="hidden" id="representative_id" readonly>
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                <div class="col-md-12">--}}
                {{--                    <div class=" form-group {{ $errors->has('address') ? 'has-error' : ''}}">--}}
                {{--                        <label for="address" class=" control-label">{{ 'Billing Address' }}</label>--}}
                <input class="form-control" placeholder="Enter address" name="address" type="hidden" id="address" readonly>
                {{--                        {!! $errors->first('address','<p class="help-block">:message</p>') !!}--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <table class="table change_order_table" id="myTable">
            <thead>
            <tr>
                <th>Activity</th>
                <th>Category Type</th>
                <th>Quantity</th>
                <th>Rate</th>
                <th class="taxhead">Taxable</th>
                <th colspan="2" >Amount</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($changeorder) && $changeorder)
                @foreach($changeorder->getChangeOrderAttachments as $value)
                    <tr>
                        <td class="" >
                            <input class="form-control" name="activity_name[]" type="text" id="activity_name"
                                   value="{{ $value->activity_name??''}}" required>
                        </td>
                        <td style="vertical-align: top;" >
                            <select class="form-control  custom_modal_select2 borderRadius" name="category_id[]"
                                    id="category_id" required>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if(isset($value) && $category->id == $category->category_id)
                                        selected @endif >{{$category->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="" >
                            <input class="form-control change_quantity" name="quantity[]" type="number" id="quantity"
                                   value="{{ $value->quantity??''}}">
                        </td>
                        <td class="" >
                            <input class="form-control change_rate" name="rate[]" type="number" id="rate"
                                   value="{{ $value->rate??''}}">
                        </td>
                        <td class="taxForm" >
                            <input type="hidden" class="change_tax" name="tax[]">
                            <input type="checkbox" name="terms" class="taxCheckbox">
                        </td>
                        <td>
                            <input class="form-control change_amount" name="amount[]" type="text" id="amount"
                                   value="{{ $value->amount??''}}" readonly>
                        </td>
                        @if($loop->last)
                            <td>
                                <button class="btn btn-danger addChangeRowBtn" style="width: auto !important;"><i class="btn btn-sm fa fa-plus" aria-hidden="true"></i></button>
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
                    <td >
                        <input class="form-control" name="activity_name[]" type="text" id="activity_name" value=""
                               required>
                    </td>
                    <td style="vertical-align: top;" >
                        <select class="form-control  custom_modal_select2 borderRadius" name="category_id[]"
                                id="category_id" required>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="form-control change_quantity" name="quantity[]" min="0" type="number" id="quantity" value="">
                    </td>
                    <td>
                        <input class="form-control change_rate" name="rate[]" min="0" type="number" id="rate" value="">
                    </td>
                    <td class="taxForm">
                        <input type="hidden" class="change_tax" name="tax[]">
                        <input type="checkbox" name="terms" class="taxCheckbox" >
                    </td>
                    <td>
                        <input class="form-control change_amount" name="amount[]" type="text" id="amount" value="" readonly>
                    </td>
                    <td>
                        <button class="btn btn-danger addChangeRowBtn" style="width: auto !important;"><i class="btn btn-sm fa fa-plus" aria-hidden="true"></i></button>
                    </td>
                </tr>
            @endif

            </tbody>
        </table>
        {{--        <div class="plus_btn_tax_check justify-content-end">--}}
        {{--            <button class="btn btn-primary addRowBtn" id="addRowBtn"><i class="fa-solid fa-plus"></i></button>--}}
        {{--            <div class="input_wrapper">--}}
        {{--                <input class="mx-3" type="checkbox" name="" id="taxCheckbox">--}}
        {{--                <label class="fs-3">Taxable</label>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        <span class="d-flex justify-content-end">Sub Total: $<span class="change_orders_subtotal" >{{ $changeorder->sub_total??"" }}</span>
            <input type="hidden" name="sub_total" class="subTotalInput"></span>
        <div class="tax" style="xdisplay: none;">
            <span class="d-flex justify-content-end">Tax: $<span  id="tax">{{ $changeorder->total_tax??"" }}</span>
                <input type="hidden" name="total_tax" id="taxInput"></span>
            <span class="d-flex justify-content-end">Total: $<span class="totalChange"></span>
                <input type="hidden" name="total_amount" class="total">
            </span>
        </div>

        {{--        <div class="row">--}}
        {{--            <div class="col-md-6">--}}
        {{--                <!-- <button class="btn btn-primary addRowBtn" id="addRowBtn">+</button> -->--}}
        {{--            </div>--}}
        {{--            <div class="col-md-6 text-right ">--}}
        {{--                <input class="mx-3" type="checkbox" name="" id="signatureCheckbox">--}}
        {{--                <label class="fs-3">Customer Signature</label>--}}

        {{--            </div>--}}
        {{--        </div>--}}
    </div>


    {{--    <div class=" signature_parent d-flex justify-content-end">--}}
    {{--        <div id="signatureForm"  class=" signature_wrpper " style="display: none">--}}
    {{--            <h3>Customer Signature</h3>--}}
    {{--            <canvas id="mouseSignatureCanvas" class="signature_showcase" ></canvas>--}}
    {{--            <div class="text-end">--}}
    {{--                <button type="button" class=" btn btn-primary" onclick="clearMouseSignature()">Clear</button>--}}
    {{--            </div>--}}
    {{--            <input type="hidden" name="signature" id="mouseSignatureInput">--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--    <div class=" signature_wrpper ">--}}
    {{--        --}}{{--        <div id="customerImagePreview" style="display: none">--}}
    {{--        <h3 >Customer Signature</h3>--}}
    {{--        <div id="imagePreviewContainer" class="mt-3 signature_showcase " style="display: none;">--}}
    {{--            <img id="imagePreview" src="" alt="Image Preview" >--}}
    {{--            <input  type="hidden"  name="upload_signature" id="upload_signature">--}}
    {{--        </div>--}}
    {{--        --}}{{--        </div>--}}
    {{--    </div>--}}
</div>
<div class="form-group error_positioned_parent_modal change_order_description {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="col-md-4 px-3 control-label">{{ 'Description' }} </label>
    <div class="col-md-12 px-3 ">
        <textarea class="form-control" rows="5" placeholder="Enter Description" name="description" id="order-description">{!! $changeorder->description??'' !!}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="d-flex align-items-center justify-content-around mb-3">
    <div class="form-check">
        <input class="form-check-input" type="radio" name="with_invoice" id="withInvoice" value="1">
        <label class="form-check-label" for="withInvoice">
            With Invoice
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="with_invoice" id="withoutInvoice" value="0" checked>
        <label class="form-check-label" for="withoutInvoice">
            Without Invoice
        </label>
    </div>
</div>
<div class="form-group">
    <div class=" d-flex justify-content-center ">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
@push('js')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>--}}
    <script type="text/javascript">

        // $(document).ready(function () {
        var initialLeadId = $('.lead_id_for_order').val();
        function fetchChangeOrderAddress(leadId) {
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
                    $('#lead_customer_name').val(response.customer_name);
                    $('.customer_name').text(response.customer_name);
                    $('#lead_name').text(response.title);
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
        fetchChangeOrderAddress(initialLeadId);
        // Event handler for lead ID change
        $(document).on('change', '.lead_id_for_order', function () {
            var leadId = $(this).val();
            fetchChangeOrderAddress(leadId);
        });
        // });
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
        {{--$(document).ready(function() {--}}
        {{--    // Retrieve the stored signature value--}}
        {{--    var storedSignature = "{{ $changeorder->signature ?? '' }}";--}}

        {{--    // Check if the stored signature is not null--}}
        {{--    if (storedSignature !== null && storedSignature !== "") {--}}
        {{--        // Display the signature form--}}
        {{--        $('#signatureForm').show();--}}

        {{--        // Set the stored signature as checked--}}
        {{--        $('#signatureCheckbox').prop('checked', true);--}}

        {{--        // Load the stored signature image onto the canvas--}}
        {{--        loadSignatureImage(storedSignature);--}}

        {{--        // Set the stored signature value to the hidden input field--}}
        {{--        $('#mouseSignatureInput').val(storedSignature);--}}
        {{--    }--}}

        {{--    // Handle the change event of the signature checkbox--}}
        {{--    $('#signatureCheckbox').on('change', function() {--}}
        {{--        if ($(this).is(':checked')) {--}}
        {{--            $('#signatureForm').show();--}}
        {{--        } else {--}}
        {{--            $('#signatureForm').hide();--}}
        {{--        }--}}
        {{--    });--}}

        {{--    // Function to load the stored signature image onto the canvas--}}
        {{--    function loadSignatureImage(signature) {--}}
        {{--        var canvas = document.getElementById('mouseSignatureCanvas');--}}
        {{--        var ctx = canvas.getContext('2d');--}}
        {{--        var img = new Image();--}}

        {{--        img.onload = function() {--}}
        {{--            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);--}}
        {{--        };--}}

        {{--        img.src = signature;--}}
        {{--    }--}}
        {{--});--}}

        // $(document).ready(function () {
        //     $('#taxCheckbox').on('change', function () {
        //         if ($(this).is(':checked')) {
        //             $('.taxForm').show();
        //             $('.taxhead').show();
        //         } else {
        //             $('.taxForm').hide();
        //             $('.taxhead').hide();
        //         }
        //     });
        // });
    </script>
    {{--    <script>--}}
    {{--        // Mouse Signature--}}
    {{--        var mouseSignatureCanvas = document.getElementById('mouseSignatureCanvas');--}}
    {{--        var mouseSignaturePad = new SignaturePad(mouseSignatureCanvas);--}}

    {{--        function clearMouseSignature() {--}}
    {{--            mouseSignaturePad.clear();--}}
    {{--            document.getElementById('mouseSignatureInput').value = "";--}}
    {{--        }--}}
    {{--        mouseSignaturePad.onEnd = function () {--}}
    {{--            updateSignatureInput();--}}
    {{--        };--}}
    {{--    </script>--}}
    {{--    <script>--}}
    {{--        window.addEventListener('load', function () {--}}
    {{--            var canvas = document.getElementById('mouseSignatureCanvas');--}}
    {{--            var ctx = canvas.getContext('2d');--}}
    {{--            var img = new Image();--}}

    {{--            img.onload = function () {--}}
    {{--                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);--}}
    {{--            };--}}

    {{--            img.src = "{{ $changeorder->signature??'' }}";--}}
    {{--        });--}}

    {{--        function updateSignatureInput() {--}}
    {{--            var canvas = document.getElementById('mouseSignatureCanvas');--}}
    {{--            var signatureInput = document.getElementById('mouseSignatureInput');--}}
    {{--            signatureInput.value = canvas.toDataURL();--}}
    {{--        }--}}
    {{--    </script>--}}

    <script>

        $(window).load(function() {

            function calculateTotalTax() {
                var subtotal = 0;
                var totalTax = 0;

                $('tr').each(function(index) {
                    var amountInput = $(this).find('.change_amount');
                    var taxInput = $(this).find('.tax');
                    var taxCheckbox = $(this).find('.taxCheckbox');
                    var amount = parseFloat(amountInput.val());
                    var orderTax = parseFloat({{ $leadExist->tax ?? 0 }}) / 100;

                    if (!isNaN(amount)) {
                        var taxAmount = 0;
                        if (taxCheckbox.is(':checked')) {
                            taxAmount = orderTax ?  amount * orderTax : 0 ;
                            $(this).find('.change_tax').val(taxAmount.toFixed(2));
                            amountInput.next('.tax-amount').remove();
                            amountInput.after('<span class="tax-amount fs-4"> (Tax $' + taxAmount.toFixed(2) + ')</span>');
                        } else {
                            $(this).find('.tax-amount').remove();
                        }
                        subtotal += amount;
                        totalTax += taxAmount;
                    }
                });
                $('.change_orders_subtotal').text(subtotal.toFixed(2));
                $('#tax').text(totalTax.toFixed(2));
                $('#taxInput').val(totalTax.toFixed(2)); // Update the input field for tax
                calculateTotal(subtotal, totalTax);
            }
            function calculateTotal(subtotal, tax) {
                var total = subtotal + tax;
                if ($('.taxCheckbox').is(':checked')) {
                    $('.totalChange').text(total.toFixed(2));
                    $('.total').val(total.toFixed(2));
                } else {
                    $('.total').text(subtotal.toFixed(2));
                    $('.totalChange').text(total.toFixed(2));
                    $('[name="total_amount"]').val(subtotalValue.toFixed(2));
                }
            }
            function calculateSubtotal() {
                var subtotal = 0;
                $('.change_amount').each(function () {
                    var amount = parseFloat($(this).val());
                    if (!isNaN(amount)) {
                        subtotal += amount;
                    }
                });
                subtotalValue = subtotal;
                $('.change_orders_subtotal').text(subtotal.toFixed(2));
                console.log('change_orders_subtotal', subtotal.toFixed(2));
                $('.subTotalInput').val(subtotal.toFixed(2));
                calculateTotalTax();
            }



            // $(document).ready(function () {
            // Calculate amount when quantity or rate changes
            $(document).on('input', '.change_quantity, .change_rate', function () {
                var row = $(this).closest('tr');
                var quantity = parseFloat(row.find('.change_quantity').val());
                var rate = parseFloat(row.find('.change_rate').val());
                var amount = isNaN(quantity) || isNaN(rate) ? 0 : quantity * rate;
                row.find('.change_amount').val(amount.toFixed(2));
                console.log(quantity);
                console.log(rate);
                console.log(amount);
                calculateSubtotal();
            });

            // Add new row when the plus button is clicked
            $('.addChangeRowBtn').on('click', function (event) {
                event.preventDefault();
                var isTaxChecked = $('#taxCheckbox').is(':checked');
                // var taxFormStyle = isTaxChecked ? '' : 'style="display: none;"';

                var newRow =
                    '<tr>' +
                    '<td><input class="form-control" name="activity_name[]" type="text"></td>' +
                    '<td>' +
                    '<select class="form-control  custom_modal_select2  borderRadius" name="category_id[]" required>' +
                    '@foreach($categories as $category)' +
                    '<option value="{{$category->id}}">{{$category->name}}</option>' +
                    '@endforeach' +
                    '</select>' +
                    '</td>' +
                    '<td><input class="form-control change_quantity" name="quantity[]" type="number"></td>' +
                    '<td><input class="form-control change_rate" name="rate[]" type="number"></td>' +
                    '<td class="taxForm"><input type="checkbox" name="terms" class="taxCheckbox"><input type="hidden" class="change_tax" name="tax[]"></td>' +
                    '<td><input class="form-control change_amount" name="amount[]" type="text" readonly></td>' +
                    '<td><button class="btn btn-danger deleteRowBtn"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>' +
                    '</tr>';
                $(this).closest('table').find('tbody').append(newRow);
                $(this).closest('table').find('tbody tr:last .select2').select2();

            });
            // Delete row when the delete button is clicked
            $(document).on('click', '.deleteRowBtn', function () {
                $(this).closest('tr').remove();
                calculateSubtotal();
            });

            $(document).on('change', '.taxCheckbox', function() {
                var rowIndex = $(this).data('row-index');
                console.log(rowIndex);
                calculateTotalTax(rowIndex);
            });

            $('.taxCheckbox').change(function () {
                calculateTotal(subtotalValue, parseFloat($('#tax').text()));
            });
            $('.taxCheckbox').change(function () {
                if ($('.taxCheckbox').is(':checked')) {
                } else {
                    calculateTotal(subtotalValue, 0);
                }
            });
        });

        $(document).ready(function() {
            $.validator.addMethod("noSpace", function(value, element) {
                return value.trim().length !== 0; // Check if the trimmed value is not an empty string
            }, "Spaces are not allowed.");
            let editor;
            if (typeof ClassicEditor !== "undefined") {
                ClassicEditor
                    .create(document.querySelector('#order-description'))
                    .then(newEditor => {
                        editor = newEditor;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            } else {
                console.error("ClassicEditor is not defined. Please check if CKEditor 5 is loaded correctly.");
            }
            $.validator.addMethod("orderDescription", function(value, element) {
                if (editor) {
                    var editorContent = editor.getData().trim();
                    return editorContent.length !== 0;
                }
                return false;
            }, "Description is required.");
            $('#changeorder-form').validate({
                ignore: [],
                rules: {
                    due_date: {
                        required: true
                    },
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
                submitHandler: function(form) {
                    form.submit();
                }
            });

        });

        // });
    </script>
@endpush
