<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Change Order</h4>
            <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ url('/task/task/' . $task->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <input name="view_lead" value="1" type="hidden">
                {{--                @include ('task.task.form', ['submitButtonText' => 'Update'])--}}
                <section class="task_form">
                    <div class="changeOrderOutr">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="changeOrderLogo">
                                    <img src="{{asset('website/images/logo.png')}}" alt="logo">
                                </div>
                                <span class="d-block">Check payable to:</span>
                                <h2>LEADUP Roofing LLC</h2>
                                <p>244 A Route 6</p>
                                <p>Columbia, CT 06237 <i></i></p>
                                <p>Licenses #: HIC 0628045</p>
                                <p>Phone #: (860) 942-8000</p>

                            </div>
                            @php
                                $change_order_unique_id = rand(100000, 999999)
                            @endphp
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group ">
                                        <div class="col-md-6"> <label for="billed_on" class=" control-label">Change Order #</label></div>
                                        <div class="col-md-6"><input class="form-control" name="change_order_unique_id" type="text" id="change_order_unique_id" value="{{ $change_order_unique_id??"" }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="col-md-6"> <label for="billed_on" class=" control-label">Billed On</label></div>
                                        <div class="col-md-6"><input class="form-control" name="due_date" type="date" id="billed_on" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label for="due_date" class=" control-label">Due Date</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" name="due_date" type="date" id="due_date"
                                                   value="{{ $changeorder->due_date??''}}">
                                            {!! $errors->first('due_date', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    {{--<div class="col-md-6">--}}
                                    {{--<p>Job #</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-6">--}}
                                    {{--<p class="changeOrderInpClor px-3">Job # 23-79</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group">--}}

                                    {{--<div class="col-md-6"><label for="changeOrderUnit" class="  control-label">Unit #</label>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-6"> <input type="text" class="border-0 bg-transparent px-3" placeholder="Unit #"--}}
                                    {{--name="" id="changeOrderUnit"> </div>--}}
                                    {{--</div>--}}
                                </div>
                            </div>


                            <div class="col-md-12">
                                <span>Billed TO:</span>
                                <h2>Michael Withington
                                </h2>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p>Billing Address:</p>
                                                <p>72 Plains Road</p>
                                                <p>Windham, CT 06280</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Billing Address:</p>
                                                <p>72 Plains Road</p>
                                                <p>Windham, CT 06280</p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <!-- <div class="changeOrderDisabled1 changeOrderDisabled ">
                                            <p class="changeOrderInpClor ">Balance Due</p>
                                        </div>
                                        <div class="changeOrderDisabled2 changeOrderDisabled">
                                            <p class="changeOrderInpClor ">XXXX</p>
                                        </div> -->

                                        <table  class="tbl_small">

                                            <thead>
                                            <tr>
                                                <th>
                                                    Balance Due
                                                </th>
                                            </tr>

                                            </thead>
                                            <tbody>

                                            <tr>
                                                <td>
                                                    XXXX
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>




                    <div class="row">

                        <div class="col-md-6 form-group {{ $errors->has('assign_to_lead_id') ? 'has-error' : ''}}">
                            <label for="assign_to_lead_id" class="col-md-4 control-label">{{ 'Assign To Lead ' }}</label>
                            <div class="col-md-6">
                                <select class="form-control clr_input_fields select2 borderRadius" name="lead_id" id="lead_id" required>
                                    @foreach($leads as $lead)
                                        <option value="{{$lead->id}}" @if(isset($changeorder) && $lead->id == $changeorder->lead_id) selected
                                                @endif >{{$lead->title}}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('lead_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-6 form-group {{ $errors->has('assign_to_user_id') ? 'has-error' : ''}}">
                            <label for="assign_to_user_id" class="col-md-4 control-label">{{ 'User' }}</label>
                            <div class="col-md-6">
                                <input class="form-control" name="customer_id" type="text" id="customer_id" readonly>
                                {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <input class="form-control" name="representative_id" type="hidden" id="representative_id" readonly>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                            <label for="address" class="col-md-4 control-label">{{ 'Billing Address' }}</label>
                            <div class="col-md-6">
                                <input class="form-control" placeholder="Enter address" name="address" type="text" id="address" readonly>
                                {!! $errors->first('address','<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        {{--<div class="col-md-6 form-group {{ $errors->has('due_date') ? 'has-error' : ''}}">--}}
                        {{--<label for="due_date" class="col-md-4 control-label">{{ 'Due Date' }}</label>--}}
                        {{--<div class="col-md-6">--}}
                        {{--<input class="form-control" name="due_date" type="date" id="due_date"--}}
                        {{--value="{{ $changeorder->due_date??''}}">--}}
                        {{--{!! $errors->first('due_date', '<p class="help-block">:message</p>') !!}--}}
                        {{--</div>--}}
                        {{--</div>--}}
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table" id="myTable">
                                <thead>
                                <tr>
                                    <th>Activity</th>
                                    <th>Category Type</th>
                                    <th>Quantity</th>
                                    <th>Rate</th>
                                    <th class="taxhead" style="display: none">Taxable</th>
                                    <th>Amount</th>
                                    <th>
                                        <button class="btn btn-primary" id="addRowBtn">+</button>
                                    </th>
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
                                                <select class="form-control clr_input_fields select2 borderRadius" name="category_id[]"
                                                        id="category_id" required>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}" @if(isset($value) && $category->id == $value->category_id)
                                                            selected @endif >{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input class="form-control quantity" min="0" name="quantity[]" type="number" id="quantity"
                                                       value="{{ $value->quantity??''}}">
                                            </td>
                                            <td>
                                                <input class="form-control rate" min="0" name="rate[]" type="number" id="rate"
                                                       value="{{ $value->rate??''}}">
                                            </td>
                                            <td class="taxForm" style="display: none">
                                                <input type="checkbox" name="terms" class="taxCheckbox" >
                                            </td>
                                            <td>
                                                <input class="form-control amount" name="amount[]" type="text" id="amount"
                                                       value="{{ $value->amount??''}}" readonly>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger deleteRowBtn"><i class="fa fa-trash-o"
                                                                                               aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>
                                            <input class="form-control" name="activity_name[]" type="text" id="activity_name" value=""
                                                   required>
                                        </td>
                                        <td>
                                            <select class="form-control clr_input_fields select2 borderRadius" name="category_id[]"
                                                    id="category_id" required>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input class="form-control quantity" name="quantity[]" type="number" id="quantity" value="">
                                        </td>
                                        <td>
                                            <input class="form-control rate" name="rate[]" type="number" id="rate" value="">
                                        </td>
                                        <td class="taxForm" style="display: none">
                                            <input type="checkbox" name="terms" class="taxCheckbox" >
                                        </td>
                                        <td>
                                            <input class="form-control amount" name="amount[]" type="text" id="amount" value="" readonly>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger deleteRowBtn"><i class="fa fa-trash-o"
                                                                                           aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                @endif

                                </tbody>
                            </table>
                            <span class="d-flex justify-content-end">Sub Total: $<span id="subtotal">{{ $changeorder->sub_total??"" }}</span><input type="hidden" name="sub_total" id="subTotalInput" value="{{ $changeorder->sub_total??"" }}"></span>
                            <div class="tax" style="display: none;">
            <span class="d-flex justify-content-end">Tax: $<span id="tax">{{ $changeorder->tax??"" }}</span><input
                        type="hidden" name="tax" id="taxInput" value="{{ $changeorder->tax ??"" }}"></span>
                                <span class="d-flex justify-content-end">Total: $<span class="total"
                                                                                       name="total_amount">{{ $changeorder->total_amount??"" }}</span><input type="hidden"
                                                                                                                                                             name="total_amount" class="total" value="{{ $changeorder->total_amount ??"" }}"></span>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    {{--                <button class="btn btn-primary" id="addRowBtn">+</button>--}}
                                </div>
                                <div class="col-md-6">
                                    <input class="mx-3" type="checkbox" name="" id="signatureCheckbox">
                                    <label class="fs-3">Customer Signature</label>
                                    <input class="mx-3" type="checkbox" name="" id="taxCheckbox">
                                    <label class="fs-3">Taxable</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <div id="signatureForm" style="display: none">
                                <h3>Customer Signature</h3>
                                <canvas id="mouseSignatureCanvas" width="400" height="200"></canvas>
                                <div class="text-end">
                                    <button type="button" onclick="clearMouseSignature()">Clear</button>
                                </div>
                                <input type="hidden" name="signature" id="mouseSignatureInput">
                            </div>

                        </div>
                    </div>


                    <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                        <label for="description" class="col-md-4 control-label">{{ 'Description' }}</label>
                        <div class="col-md-12">
        <textarea class="form-control" rows="5" name="description" type="textarea" id="description"
                  required>{{ strip_tags($changeorder->description??'')}}</textarea>
                            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">
                            <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
                        </div>
                    </div>

                </section>

                {{--<script src="{{asset('plugins/components/dropzone-master/dist/dropzone.js')}}"></script>--}}
                <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
                <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
                <script type="text/javascript">
                    $(document).ready(function () {
                        CKEDITOR.replace('description');
                    });
                    $(document).ready(function () {
                        // Get the initial value of the lead ID
                        var initialLeadId = $('#lead_id').val();

                        // Function to fetch and populate the customer ID and address fields
                        function fetchAddress(leadId) {
                            $.ajax({
                                url: '/changeOrder/change-order/fetch-address/' + leadId,
                                type: 'GET',
                                data: {
                                    lead_id: leadId
                                },
                                success: function (response) {
                                    $('#address').val(response.address);
                                    $('#customer_id').val(response.customer_id);
                                    $('#representative_id').val(response.representative_id);
                                },
                                error: function (xhr, status, error) {
                                    console.log(xhr.responseText);
                                }
                            });
                        }

                        // Call the fetchAddress function on page load with the initial lead ID
                        fetchAddress(initialLeadId);

                        // Event handler for lead ID change
                        $('#lead_id').change(function () {
                            var leadId = $(this).val();
                            fetchAddress(leadId);
                        });
                    });
                    $(document).ready(function () {
                        $('#signatureCheckbox').on('change', function () {
                            if ($(this).is(':checked')) {
                                $('#signatureForm').show();

                            } else {
                                $('#signatureForm').hide();
                            }
                        });
                    });
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

                        // Handle the change event of the signature checkbox
                        $('#signatureCheckbox').on('change', function() {
                            if ($(this).is(':checked')) {
                                $('#signatureForm').show();
                            } else {
                                $('#signatureForm').hide();
                            }
                        });

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
                    $(document).ready(function () {
                        $('#taxCheckbox').on('change', function () {
                            if ($(this).is(':checked')) {
                                $('.taxForm').show();
                                $('.taxhead').show();
                                $('.tax').show();
                            } else {
                                $('.taxForm').hide();
                                $('.taxhead').hide();
                                $('.tax').hide();
                            }
                        });
                    });
                    // Mouse Signature
                    var mouseSignatureCanvas = document.getElementById('mouseSignatureCanvas');
                    var mouseSignaturePad = new SignaturePad(mouseSignatureCanvas);

                    function clearMouseSignature() {
                        mouseSignaturePad.clear();
                        document.getElementById('mouseSignatureInput').value = "";
                    }
                    mouseSignaturePad.onEnd = function () {
                        updateSignatureInput();
                    };
                    window.addEventListener('load', function () {
                        var canvas = document.getElementById('mouseSignatureCanvas');
                        var ctx = canvas.getContext('2d');
                        var img = new Image();

                        img.onload = function () {
                            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                        };

                        img.src = "{{ $changeorder->signature??'' }}";
                    });

                    function updateSignatureInput() {
                        var canvas = document.getElementById('mouseSignatureCanvas');
                        var signatureInput = document.getElementById('mouseSignatureInput');
                        signatureInput.value = canvas.toDataURL();
                    }
                    $(document).ready(function () {
                        // Calculate amount when quantity or rate changes
                        $(document).on('change', '.quantity, .rate', function () {
                            var row = $(this).closest('tr');
                            var quantity = parseFloat(row.find('.quantity').val());
                            var rate = parseFloat(row.find('.rate').val());
                            var amount = isNaN(quantity) || isNaN(rate) ? 0 : quantity * rate;
                            row.find('.amount').val(amount.toFixed(2));
                            calculateSubtotal();
                        });

                        // Add new row when the plus button is clicked
                        $('#addRowBtn').on('click', function (event) {
                            event.preventDefault(); // Prevent form submission

                            var isTaxChecked = $('#taxCheckbox').is(':checked');
                            var taxFormStyle = isTaxChecked ? '' : 'style="display: none;"';

                            var newRow =
                                '<tr>' +
                                '<td><input class="form-control" name="activity_name[]" type="text"></td>' +
                                '<td>' +
                                '<select class="form-control clr_input_fields select2 borderRadius" name="category_id[]" required>' +
                                '@foreach($categories as $category)' +
                                '<option value="{{$category->id}}">{{$category->name}}</option>' +
                                '@endforeach' +
                                '</select>' +
                                '</td>' +
                                '<td><input class="form-control quantity" name="quantity[]" type="number"></td>' +
                                '<td><input class="form-control rate" name="rate[]" type="number"></td>' +
                                '<td class="taxForm" ' + taxFormStyle + '><input type="checkbox" name="terms" class="taxCheckbox"></td>' +
                                '<td><input class="form-control amount" name="amount[]" type="text" readonly></td>' +
                                '<td><button class="btn btn-danger deleteRowBtn"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>' +
                                '</tr>';
                            $('#myTable tbody').append(newRow);
                            $('#myTable tbody tr:last .select2').select2();
                        });
                        // Delete row when the delete button is clicked
                        $(document).on('click', '.deleteRowBtn', function () {
                            $(this).closest('tr').remove();
                            calculateSubtotal();
                        });

                        $(document).on('change', '.taxCheckbox', function() {
                            var rowIndex = $(this).data('row-index');
                            calculateTotalTax(rowIndex);
                        });

                        // Function to calculate and update the subtotal
                        function calculateSubtotal() {
                            var subtotal = 0;
                            $('.amount').each(function () {
                                var amount = parseFloat($(this).val());
                                if (!isNaN(amount)) {
                                    subtotal += amount;
                                }
                            });
                            subtotalValue = subtotal; // Store the subtotal value
                            $('#subtotal').text(subtotal.toFixed(2));
                            calculateTotalTax();
                            $('#subTotalInput').val(subtotalValue); // Update the input field for sub_total
                        }

                        function calculateTotalTax() {
                            var subtotal = 0;
                            var totalTax = 0;

                            $('tr').each(function(index) {
                                var amountInput = $(this).find('.amount');
                                var taxInput = $(this).find('.tax');
                                var taxCheckbox = $(this).find('.taxCheckbox');

                                var amount = parseFloat(amountInput.val());

                                if (!isNaN(amount)) {
                                    var taxAmount = 0; // Initialize taxAmount to 0

                                    if (taxCheckbox.is(':checked')) {
                                        taxAmount = amount * 0.05; // Calculate tax amount as 5% of the amount

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


                        function calculateTotal(subtotal, tax) {
                            var total = subtotal + tax;
                            if ($('#taxCheckbox').is(':checked')) {
                                $('.total').text(total.toFixed(2)); // Update the total value with tax
                                $('[name="total_amount"]').val(total.toFixed(
                                    2)); // Update the total_amount input field with tax
                            } else {
                                $('.total').text(subtotal.toFixed(2)); // Update the total value without tax
                                $('[name="total_amount"]').val(subtotalValue.toFixed(
                                    2)); // Update the total_amount input field with the subtotal
                            }
                        }


                        $('#taxCheckbox').change(function () {
                            calculateTotal(subtotalValue, parseFloat($('#tax').text()));
                        });

                        $('#taxCheckbox').change(function () {
                            if ($('#taxCheckbox').is(':checked')) {
                                // calculateTax(subtotalValue);
                            } else {
                                calculateTotal(subtotalValue, 0);
                            }
                        });

                        $(document).ready(function () {
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
                </script>
            </form>
        </div>
    </div>
</div>

