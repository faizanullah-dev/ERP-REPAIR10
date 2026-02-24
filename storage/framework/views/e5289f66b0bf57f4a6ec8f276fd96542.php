 <div class="input_group_row staff_edit_finance_selection">
        <div class="form-group">
            <label class="form-label" >Position</label>
        <input type="hidden" name="positions[<?php echo e($position['id']); ?>][id]" value="<?php echo e($position['id']); ?>">
        <input type="text" value="<?php echo e($position['name']); ?>" name="positions[<?php echo e($position['id']); ?>][name]" class="form-control" placeholder="" readonly>
        </div>
        <div class="form-group">
            <label class="form-label" >Insurance Rate</label>
            <div class="input-group">
            <input type="text" name="positions[<?php echo e($position['id']); ?>][insurance_rate]" value="<?php echo e($position['insurance_rate']); ?>" class="form-control" placeholder="">
                <span class="input-group-text">%</span>
            </div>
        </div>
    <div class="form-group pay_rate_weekly">
            <label class="form-label" >Pay Rate Weekly</label>
        <div class="input-group">
            <input type="number" name="positions[<?php echo e($position['id']); ?>][pay_rate_weekly]" value="<?php echo e(number_format((float)$position['pay_rate_weekly'] ?? 0, 2)); ?>" class="form-control" min="0" placeholder="">
            <select class="form-control" name="positions[<?php echo e($position['id']); ?>][pay_rate_type]">
                <option value="flat" <?php if($position['pay_rate_type'] == 'flat'): ?> selected <?php endif; ?>>Flat</option>
                <option value="percentage" <?php if($position['pay_rate_type'] == 'percentage'): ?> selected <?php endif; ?>>%</option>
            </select>
        </div>
        </div>
        <div class="form-group">
            <label class="form-label" >Total Yearly Pay</label>
            <input type="number"
                   name="positions[<?php echo e($position['id']); ?>][total_yearly_pay]"
                   value="<?php echo e(number_format($position['total_yearly_pay'] ?? 0, 2, '.', '')); ?>"
                   class="form-control"
                   min="0"
                   step="0.01"
                   placeholder="">

        </div>
        <div class="form-group">
            <label class="form-label" >VAN</label>
            <input type="number" name="positions[<?php echo e($position['id']); ?>][van]" value="<?php echo e($position['van']); ?>" class="form-control" min="0" placeholder="">
        </div>
        <div class="form-group">
            <label class="form-label" >AUT Insurance</label>
            <input type="number" name="positions[<?php echo e($position['id']); ?>][aut_insurance]" value="<?php echo e($position['aut_insurance']); ?>" class="form-control" min="0" placeholder="">
        </div>
        <div class="form-group">
            <label class="form-label" >State Federal Payment</label>
            <div class="input-group">
                <input type="number" name="positions[<?php echo e($position['id']); ?>][state_federal_payment]" value="<?php echo e($position['state_federal_payment']); ?>" class="form-control" min="0" placeholder="">
                <input type="hidden" name="positions[<?php echo e($position['id']); ?>][state_federal_amount]" value="<?php echo e($position['state_federal_amount'] ?? '0'); ?>">
                <span class="input-group-text">%</span>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" >Cost of Insurance</label>
        <input type="number" name="positions[<?php echo e($position['id']); ?>][cost_of_insurance]" value="<?php echo e($position['cost_of_insurance']); ?>" class="form-control" min="0" placeholder="" readonly>
        </div>
 </div>

 <script>
     $(document).ready(function () {
         $(".input_group_row").each(function () {
             let row = $(this);
             let yearlyPay = parseFloat(row.find("input[name^='positions'][name$='[total_yearly_pay]']").val()) || 0;
             function calculateInsurance() {
                 let rate = parseFloat(row.find("input[name^='positions'][name$='[insurance_rate]']").val()) || 0;

                 let insuranceCost = (rate / 100) * yearlyPay;
                 row.find("input[name^='positions'][name$='[cost_of_insurance]']").val(insuranceCost.toFixed(2));

             }

             function calculateStateFederalAmount() {
                 let stateFederalPayment = parseFloat(row.find("input[name^='positions'][name$='[state_federal_payment]']").val()) || 0;
                 let stateFederalAmount = yearlyPay / stateFederalPayment;
                 row.find("input[name^='positions'][name$='[state_federal_amount]']").val(stateFederalAmount.toFixed(2));
             }

             row.find("input[name^='positions'][name$='[insurance_rate]'], input[name^='positions'][name$='[total_yearly_pay]']").on("input", function () {
                 calculateInsurance();
             });
             row.find("input[name^='positions'][name$='[state_federal_payment]']").on("input", function () {
                 calculateStateFederalAmount();
             });
         });
     });
 </script>
<?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/staff/staff/ajax/get_position.blade.php ENDPATH**/ ?>