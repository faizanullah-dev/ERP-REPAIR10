<div class="row">
    <input type="hidden" name="lead_id" value="<?php echo e($leadExist->id??''); ?>">
    <div class="form-group <?php echo e($errors->has('amount') ? 'has-error' : ''); ?>">
        <div class="mb-3">
            <label for="amount" class="col-md-4 control-label"><?php echo e('Credit Amount'); ?><span class="text-danger">*</span></label>
            <input type="number" class="form-control credit_amount" id="amount" name="amount" placeholder="Enter amount..." step="0.01" required>
            <?php echo $errors->first('amount', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>

    <div class="form-group <?php echo e($errors->has('date') ? 'has-error' : ''); ?>">
        <div class="mb-3">
            <label for="date" class="col-md-4 control-label"><?php echo e('Date'); ?></label>
            <input type="date" class="form-control" id="amount" name="date" value="<?php echo e($refund->due_date ?? $yearEstimation->year . '-01-01'); ?>">
            <?php echo $errors->first('date', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>
    <div class="form-group <?php echo e($errors->has('invoice') ? 'has-error' : ''); ?>">
        <label for="invoice" class=" control-label"><?php echo e('Invoice'); ?></label>
        <select class="form-select finance-invoice  custom_modal_select2 credit_invoice_id" id="credit_invoice_id" name="invoice_id" required>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($leadExist)): ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $leadExist->getInvoice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($value->id); ?>" data-amount="<?php echo e($value->total_amount); ?>">Date: <?php echo e(\Carbon\Carbon::parse($value->due_date ?? '')->format('m-d-Y') ?? ''); ?> - Amount: <?php echo e($value->total_amount); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php else: ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $lead->getInvoice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($value->id); ?>" <?php if(isset($credit)  && $credit->invoice_id == $credit->invoice_id): ?> selected <?php endif; ?> ><?php echo e($value->total_amount); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </select>
        <?php echo $errors->first('invoice', '<p class="help-block">:message</p>'); ?>

    </div>
    <div class="mb-4">
        <label for="refundDescription" class="form-label">Description</label>
        <textarea class="form-control financeDescription" id="refundDescription" name="description"></textarea>
    </div>
    <div class="form-group mb-0">
        <input class="btn d-block mx-auto btn-green add_credits_submit_form" type="submit" value="<?php echo e($submitButtonText??'Create'); ?>">
    </div>
</div>
<?php $__env->startPush('js'); ?>
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
<?php $__env->stopPush(); ?>
<?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/credit/credit/form.blade.php ENDPATH**/ ?>