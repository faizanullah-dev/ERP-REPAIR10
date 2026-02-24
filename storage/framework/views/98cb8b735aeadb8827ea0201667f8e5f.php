<div class="row">
    <?php
        $invoice_unique_id = rand(100000, 999999);
    ?>

    <div class="col-md-6">
        <div class="form-group <?php echo e($errors->has('address') ? 'has-error' : ''); ?>">
            <label for="address" class=" control-label"><?php echo e('Job Number'); ?><span class="text-danger">*</span></label>
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($leadExist->getInvoice) && isset($leadExist->getInvoice->first()->invoice_unique_id)): ?>
                <input class="form-control" name="invoice_unique_id" type="text"  value="<?php echo e($leadExist->getInvoice->first()->invoice_unique_id ?? ''); ?>" readonly>
            <?php else: ?>
                
                
                <input class="form-control" name="invoice_unique_id" type="text"
                       value="<?php echo e(isset($leadExist->category->name) ? substr($leadExist->category->name, 0, 1) : ''); ?><?php echo e(isset($leadExist->created_at) ? $leadExist->created_at->format('y') : ''); ?>-<?php echo e(isset($invoice_unique_id) ? $invoice_unique_id : ''); ?>-<?php echo e(isset($leadExist->customer->customerLeads) ? $leadExist->customer->customerLeads->count() : '0'); ?>"
                       readonly>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php echo $errors->first('address','<p class="help-block">:message</p>'); ?>

        </div>
    </div>
    <div class="col-md-6" style="display: none;">
        <div class=" form-group <?php echo e($errors->has('assign_to_lead_id') ? 'has-error' : ''); ?>">
            <label for="assign_to_lead_id" class=" control-label"><?php echo e('Assign To Lead '); ?></label>

            <select class="form-control custom_modal_select2 borderRadius" name="lead_id" id="lead_id" required>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($leadExist)): ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($lead->id); ?>" <?php if(isset($leadExist) && $lead->id == $leadExist->id): ?> selected <?php endif; ?>><?php echo e($lead->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php else: ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($lead->id); ?>" <?php if(isset($invoice)  && $lead->id == $invoice->lead_id): ?> selected <?php endif; ?> ><?php echo e($lead->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </select>
            <?php echo $errors->first('lead_id', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>




            <input class="form-control" name="customer_id" type="hidden" id="invoice_customer_id" readonly>







            <input class="form-control" placeholder="Enter address" name="address" type="hidden" id="invoice_address" readonly>



    <div class="col-md-6">
        <div class=" form-group <?php echo e($errors->has('due_date') ? 'has-error' : ''); ?>">
            <label for="due_date" class=" control-label"><?php echo e('Due Date'); ?></label>
            <input class="form-control" name="due_date" type="date" id="due_date" value="<?php echo e($invoice->due_date ?? date('m-d-Y')); ?>">
            <?php echo $errors->first('due_date', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group <?php echo e($errors->has('description') ? 'has-error' : ''); ?>">
            <label for="description" class=" control-label"><?php echo e('Description'); ?></label>
            <textarea class="form-control" rows="5" name="description" id="invoice-description" ><?php echo $invoice->description??''; ?></textarea>
            <?php echo $errors->first('description', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>
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
                <th colspan="2">Amount</th>
            </tr>
            </thead>
            <tbody>
            <?php if(isset($invoice) && $invoice): ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $invoice->getInvoiceAttachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <input class="form-control" name="activity_name[]" type="text" id="activity_name" value="<?php echo e($value->activity_name??''); ?>" required>
                        </td>
                        <td>
                            <select class="form-control  custom_modal_select2 borderRadius" name="category_id[]" id="category_id" required>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>" <?php if(isset($value) && $category->id == $value->category_id): ?> selected <?php endif; ?> ><?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </select>
                        </td>
                        <td>
                            <input class="form-control invoice_quantity" name="quantity[]" type="number" min="0" id="quantity" value="<?php echo e($value->quantity??''); ?>" required>
                        </td>
                        <td>
                            <input class="form-control invoice_rate" name="rate[]" type="number" min="0" id="rate" value="<?php echo e($value->rate??''); ?>" required>
                        </td>
                        <td class="taxForm">
                            <input type="hidden" class="invoice_tax" name="tax[]" value="<?php echo e($value->tax??""); ?>">
                            <input type="checkbox" name="terms" class="taxInvoiceCheckbox" >
                        </td>
                        <td>
                            <input class="form-control invoice_amount" name="amount[]" type="text" id="amount" value="<?php echo e($value->amount??''); ?>" readonly>
                        </td>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loop->last): ?>
                            <td>
                                <button class="btn btn-danger addInvoiceRowBtn" style="width: auto !important;"><i class="btn btn-sm fa fa-plus" aria-hidden="true"></i></button>
                            </td>
                        <?php else: ?>
                            <td>
                                <button class="btn btn-danger deleteRowBtn"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                            </td>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php else: ?>
                <tr>
                    <td>
                        <input class="form-control" name="activity_name[]" type="text" id="activity_name" value="" required>
                    </td>
                    <td>
                        <select class="form-control custom_modal_select2  borderRadius" name="category_id[]" id="category_id" required>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </select>
                    </td>
                    <td>
                        <input class="form-control invoice_quantity" name="quantity[]" min="0" type="number" id="quantity" value="1">
                    </td>
                    <td>
                        <input class="form-control invoice_rate" name="rate[]" min="0" type="number" id="invoice_lead_price" value="">
                    </td>

                    <td class="taxForm">
                        <input type="hidden" class="invoice_tax" name="tax[]">
                        <input type="checkbox" name="terms" class="taxInvoiceCheckbox" >
                    </td>
                    <td>
                        <input class="form-control invoice_amount" name="amount[]" type="text" id="amount" value="" readonly>
                    </td>
                    <td>
                        <button class="btn btn-danger addInvoiceRowBtn" style="width: auto !important;"><i class="btn btn-sm fa fa-plus" aria-hidden="true"></i></button>
                    </td>
                </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            </tbody>
        </table>
        <span class="d-flex justify-content-end">Sub Total: $ <span class="invoice_subtotal" id="invoice_subtotal"><?php echo e($invoice->sub_total??""); ?></span>
                <input type="hidden" name="sub_total" class="invoice_subtotal"></span>
        <div class="tax" >
            <span class="d-flex justify-content-end">Tax: $ <span class="invoice_total_tax" id="invoice_total_tax"><?php echo e($invoice->total_tax??""); ?></span><input type="hidden" name="total_tax" class="taxInput" value="<?php echo e($invoice->total_tax ??""); ?>"></span>
            <span class="d-flex justify-content-end">Total: $ <span class="invoice_total" name="total_amount"><?php echo e($invoice->total_amount??""); ?></span><input type="hidden" name="total_amount" class="invoice_total" value="<?php echo e($invoice->total_amount ??""); ?>"></span>
        </div>
        
        
        
        
        
        
        
        
        
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <div class=" d-flex justify-content-center ">
                <input class="btn btn-primary" type="submit" value="<?php echo e($submitButtonText??'Create'); ?>">
            </div>
        </div>
    </div>
</div>
<?php $__env->startPush('js'); ?>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
    
    <script type="text/javascript">
        // $(document).ready(function() {
        var initialLeadId = $('#lead_id').val();
        function fetchData(leadId) {
            $.ajax({
                url: '/invoice/invoice/fetch-data/' + leadId,
                type: 'GET',
                data: { lead_id: leadId },
                success: function(response) {
                    $('#invoice_address').val(response.address);
                    $('#invoice_customer_id').val(response.customer_id);
                    // $('#invoice_lead_price').val(response.lead_price);
                    // $('.invoice_tax').val(response.tax);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
        fetchData(initialLeadId);
        $(document).on('change', '#lead_id', function () {
            var leadId = $(this).val();
            fetchData(leadId);
        });
        // });
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
        //     $('#taxInvoiceCheckbox').on('change', function() {
        //         if ($(this).is(':checked')) {
        //             $('.taxForm').show();
        //             $('.taxhead').show();
        //             // $('.tax').show();
        //         } else {
        //             $('.taxForm').hide();
        //             $('.taxhead').hide();
        //             // $('.tax').hide();
        //         }
        //     });
        // });
        $(document).ready(function() {
            // Initialize variables
            var subtotalValue = 0;

            // Function to calculate amount for a specific row
            function calculateRowAmount(row) {
                var quantityInput = row.find('.invoice_quantity');
                var rateInput = row.find('.invoice_rate');
                var amountInput = row.find('.invoice_amount');

                var quantity = parseFloat(quantityInput.val()) || 0;
                var rate = parseFloat(rateInput.val()) || 0;
                var amount = quantity * rate;

                amountInput.val(amount.toFixed(2));
                return amount;
            }

            // Function to calculate all amounts and totals
            function calculateAllAmounts() {
                $('#myTable tbody tr').each(function() {
                    calculateRowAmount($(this));
                });
                calculateSubtotal();
            }

            // Function to force recalculation
            function forceRecalculation() {
                console.log('Force recalculation triggered');
                setTimeout(function() {
                    calculateAllAmounts();
                }, 100);
            }

            // Bind calculation events with multiple triggers
            $(document).on('input keyup change blur', '.invoice_quantity, .invoice_rate', function () {
                var row = $(this).closest('tr');
                calculateRowAmount(row);
                calculateSubtotal();
            });

            // Multiple event handlers for modal opening
            $(document).on('shown.bs.modal', '#addInvoiceModalBtn', function () {
                forceRecalculation();
            });

            $(document).on('show.bs.modal', '#addInvoiceModalBtn', function () {
                setTimeout(forceRecalculation, 300);
            });

            // Handle page load scenarios
            $(window).on('load', function() {
                forceRecalculation();
            });

            // Fallback calculation after DOM is ready
            setTimeout(function() {
                calculateAllAmounts();
            }, 500);

            $('.addInvoiceRowBtn').on('click',function (event) {
                event.preventDefault();
                var newRow =
                    '<tr>' +
                    '<td>' +
                    '<input class="form-control activity_name" name="activity_name[]" type="text" required>' +
                    '<div class="invalid-feedback">Activity name is required.</div>' +
                    '</td>' +
                    '<td>' +
                    '<select class="form-control custom_modal_select2 borderRadius category" name="category_id[]" required>' +
                    '<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>' +
                    '<option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>' +
                    '<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>' +
                    '</select>' +
                    '<div class="invalid-feedback">Category is required.</div>' +
                    '</td>' +
                    '<td>' +
                    '<input class="form-control invoice_quantity" name="quantity[]" min="0" type="number" value="1" required>' +
                    '<div class="invalid-feedback">Quantity is required.</div>' +
                    '</td>' +
                    '<td>' +
                    '<input class="form-control invoice_rate" name="rate[]" min="0" type="number" value="0" required>' +
                    '<div class="invalid-feedback">Rate is required.</div>' +
                    '</td>' +
                    '<td class="taxForm"><input type="checkbox" name="terms" class="taxInvoiceCheckbox"><input type="hidden" class="invoice_tax" name="tax[]"></td>' +
                    '<td>' +
                    '<input class="form-control invoice_amount" name="amount[]" type="text" readonly>' +
                    '</td>' +
                    '<td><button class="btn btn-danger deleteRowBtn"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>' +
                    '</tr>';
                $('#myTable tbody').append(newRow);
                $('#myTable tbody tr:last .custom_modal_select2').select2();

                // Calculate amount for the new row
                setTimeout(function() {
                    calculateRowAmount($('#myTable tbody tr:last'));
                }, 100);
            });

            $(document).on('click', '.deleteRowBtn', function () {
                $(this).closest('tr').remove();
                calculateSubtotal();
            });

            $(document).on('change', '.taxInvoiceCheckbox', function () {
                calculateTotalTax();
            });

            function calculateSubtotal() {
                var subtotal = 0;
                $('.invoice_amount').each(function () {
                    var amount = parseFloat($(this).val()) || 0;
                    subtotal += amount;
                });
                subtotalValue = subtotal;
                $('.invoice_subtotal').text(subtotal.toFixed(2));
                $('input[name="sub_total"]').val(subtotal.toFixed(2));
                calculateTotalTax();
            }

            function calculateTotalTax() {
                var subtotal = 0;
                var totalTax = 0;

                $('#myTable tbody tr').each(function () {
                    var amountInput = $(this).find('.invoice_amount');
                    var taxInput = $(this).find('.invoice_tax');
                    var taxInvoiceCheckbox = $(this).find('.taxInvoiceCheckbox');
                    var amount = parseFloat(amountInput.val()) || 0;

                    if (amount > 0) {
                        var taxRate = parseFloat("<?php echo e($leadExist->tax ?? '0'); ?>") || 0;
                        var taxAmount = 0;

                        if (taxInvoiceCheckbox.is(':checked')) {
                            taxAmount = amount * taxRate / 100;
                            taxInput.val(taxAmount.toFixed(2));

                            // Display tax amount
                            amountInput.next('.tax-amount').remove();
                            amountInput.after('<span class="tax-amount fs-4"> (Tax $' + taxAmount.toFixed(2) + ')</span>');
                        } else {
                            $(this).find('.tax-amount').remove();
                            taxInput.val('0');
                        }

                        subtotal += amount;
                        totalTax += taxAmount;
                    }
                });

                $('.invoice_subtotal').text(subtotal.toFixed(2));
                $('.invoice_total_tax').text(totalTax.toFixed(2));
                $('.taxInput').val(totalTax.toFixed(2));
                calculateTotal(subtotal, totalTax);
            }

            function calculateTotal(subtotal, tax) {
                var total = subtotal + tax;
                $('.invoice_total').text(total.toFixed(2));
                $('[name="total_amount"]').val(total.toFixed(2));
            }

            // Form validation
            $('#invoice_form').on('submit', function (e) {
                let isValid = true;
                $('#myTable tbody tr').each(function () {
                    $(this).find('input[required], select[required]').each(function () {
                        if (!$(this).val()) {
                            isValid = false;
                            $(this).addClass('is-invalid');
                        } else {
                            $(this).removeClass('is-invalid');
                        }
                    });
                });
                if (!isValid) {
                    e.preventDefault();
                    alert('Please fill out all required fields before submitting.');
                }
            });

            $('#myTable').on('input change', 'input, select', function () {
                if ($(this).val()) {
                    $(this).removeClass('is-invalid');
                }
            });

            // Lead data fetching (from your original code)
            var initialLeadId = $('#lead_id').val();

            function fetchData(leadId) {
                $.ajax({
                    url: '/invoice/invoice/fetch-data/' + leadId,
                    type: 'GET',
                    data: { lead_id: leadId },
                    success: function(response) {
                        $('#invoice_address').val(response.address);
                        $('#invoice_customer_id').val(response.customer_id);
                        // Trigger recalculation after data is loaded
                        setTimeout(forceRecalculation, 200);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }

            if (initialLeadId) {
                fetchData(initialLeadId);
            }

            $(document).on('change', '#lead_id', function () {
                var leadId = $(this).val();
                fetchData(leadId);
            });

            // Signature checkbox handler
            $('#signatureCheckbox').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#signatureForm').show();
                } else {
                    $('#signatureForm').hide();
                }
            });

            // Validation rules
            $.validator.addMethod("noSpace", function (value, element) {
                return value.trim().length !== 0;
            }, "Spaces are not allowed.");

            $("#invoice_form").validate({
                ignore: [],
                rules: {
                    lead_id: "required",
                    address: "required",
                    'activity_name[]': {
                        required: true,
                        noSpace: true
                    },
                },
                messages: {
                    lead_id: {
                        required: "Please enter your Lead ID",
                    },
                    address: {
                        required: "Please enter your Address",
                    },
                    'activity_name[]': {
                        required: "Activity name is required.",
                        noSpace: "Activity name is required."
                    },
                },
                errorPlacement: function (error, element) {
                    error.insertAfter(element);
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/invoice/invoice/form.blade.php ENDPATH**/ ?>