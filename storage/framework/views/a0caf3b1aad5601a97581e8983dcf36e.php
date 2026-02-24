<div class="row">
    <input type="hidden" name="lead_id" value="<?php echo e($leadExist->id??''); ?>">
    <div class="form-group <?php echo e($errors->has('amount') ? 'has-error' : ''); ?>">
        <div class="mb-3">
            <label for="amount" class="col-md-4 control-label"><?php echo e('Refund Amount'); ?><span class="text-danger">*</span></label>
            <input type="number" class="form-control refund_amount" id="amount" name="amount" placeholder="Enter amount..." step="0.01" required>
            <?php echo $errors->first('amount', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>
        <div class="form-group <?php echo e($errors->has('payment_type') ? 'has-error' : ''); ?>">
            <label for="payment_type" class=" control-label"><?php echo e('Refund Payment Type'); ?></label>
            <select class="form-select finance-invoice  custom_modal_select2" id="payment_type" name="payment_type_id" required>
                <option disabled>--Select Payment Type--</option>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $paymenttypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($value->id); ?>" ><?php echo e($value->name??''); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </select>
            <?php echo $errors->first('payment_type', '<p class="help-block">:message</p>'); ?>

        </div>
        <div class="form-group <?php echo e($errors->has('invoice') ? 'has-error' : ''); ?>">
            <label for="invoice" class=" control-label"><?php echo e('Invoice'); ?></label>
            <select class="form-select finance-invoice  custom_modal_select2 refund_invoice_id" id="invoice_id" name="invoice_id" required>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($leadExist)): ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $leadExist->getInvoice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($value->total_amount > 0): ?>  <!-- Add this condition -->
                        <option value="<?php echo e($value->id); ?>" data-refund-amount="<?php echo e($value->total_amount??''); ?>">Date:<?php echo e(\Carbon\Carbon::parse($value->due_date)->format('m/d/y') ?? ''); ?> - Amount: <?php echo e($value->total_amount); ?></option>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php else: ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $lead->getInvoice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($value->total_amount > 0): ?>  <!-- Add this condition -->
                            <option value="<?php echo e($value->id); ?>" <?php if(isset($credit) && $credit->invoice_id == $credit->invoice_id): ?> selected <?php endif; ?> ><?php echo e($value->total_amount); ?></option>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </select>

            <?php echo $errors->first('invoice', '<p class="help-block">:message</p>'); ?>

    </div>
    <div class="form-group <?php echo e($errors->has('date') ? 'has-error' : ''); ?>">
        <div class="mb-3">
            <label for="date" class="col-md-4 control-label"><?php echo e('Date'); ?></label>
            <input type="date" class="form-control" id="amount" name="date" value="<?php echo e($credit->due_date ?? $yearEstimation->year . '-01-01'); ?>">
            <?php echo $errors->first('date', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>
    <div class="form-group <?php echo e($errors->has('refundDescription') ? 'has-error' : ''); ?>">
        <div class="mb-0">
            <label for="refundDescription" class="form-label">Description</label>
            <textarea class="form-control refund_description" id="refundDescription" name="description"></textarea>
            <?php echo $errors->first('refundDescription', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>
    <div class="form-group mb-0">
        <input class="btn d-block mx-auto btn-green add_refund_submit_form" type="submit" value="<?php echo e($submitButtonText??'Create'); ?>">
    </div>
</div>
<?php $__env->startPush('js'); ?>
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
<?php $__env->stopPush(); ?>
<?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/refund/refund/form.blade.php ENDPATH**/ ?>