<div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Job Insurance</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body">
    <form method="POST" action="<?php echo e(url('update_job_insurance_for_lead')); ?>/<?php echo e($lead->id); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="insuranceCompany" class="form-label input_labels p-18">Insurance company</label>
                    <select class="form-control clr_input_fields borderRadius select_insurance_initialize" name="company_id" id="insuranceCompany">
                        <option value="">Select Insurance Company</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($company->id); ?>" <?php if(isset($lead) && $lead->company_id==$company->id): ?> selected <?php endif; ?> required><?php echo e($company->company??''); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <!-- Add more options as needed -->
                    </select>
                </div>
            </div>

            <div class="col-md-12">
                <div class="mb-3">
                    <label for="Claim" class="form-label input_labels p-18">Claim# </label>
                    <input class="form-control clr_input_fields borderRadius" name="claim_number" placeholder="Enter Claim#" type="text" id="" value="<?php echo e($lead->claim_number??''); ?>">
                </div>
            </div>

            <div class="col-md-12">
                <div class="mb-3">
                    <label for="Policy" class="form-label input_labels p-18">Policy# </label>
                    <input class="form-control clr_input_fields borderRadius" name="policy_number" placeholder="Enter Policy # " type="text" id="Policy" value="<?php echo e($lead->policy_number??''); ?>" >
                </div>
            </div>

            <div class="col-md-12">
                <div class="mb-3">
                    <label for="Phone" class="form-label input_labels p-18">Phone # </label>
                    <input class="form-control clr_input_fields borderRadius" name="phone_insurance" placeholder="(__)__-__" type="tel" id="phone_insurance" value="<?php echo e($lead->phone_insurance??''); ?>" >
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="Fax" class="form-label input_labels p-18">Fax </label>
                    <input class="form-control clr_input_fields borderRadius" name="fax_number" placeholder="(__)__-__" type="text" id="Fax" value="<?php echo e($lead->fax_number??''); ?>" >
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="Email" class="form-label input_labels p-18">Email </label>
                    <input class="form-control clr_input_fields borderRadius" name="email_insurance" placeholder="" type="email" id="Email" value="<?php echo e($lead->email_insurance??''); ?>" >
                </div>
            </div>

            <div class="col-md-12">
                <div class="mb-3">
                    <label for="adjustName" class="form-label input_labels p-18">Adjust Name </label>
                    <input class="form-control clr_input_fields borderRadius" name="adjust_name_insurance" placeholder="Adjust Name" type="text" id="adjustName" value="<?php echo e($lead->adjust_name_insurance??''); ?>" >
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="adjustPhone" class="form-label input_labels p-18">Adjust Phone </label>
                    <input class="form-control clr_input_fields borderRadius" name="adjust_Phone_insurance" placeholder="(__)__-__" type="tel" id="adjustPhone" value="<?php echo e($lead->adjust_Phone_insurance??''); ?>" >
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="adjustEmail" class="form-label input_labels p-18">Adjust Email </label>
                    <input class="form-control clr_input_fields borderRadius" name="adjust_email_insurance" placeholder="Adjust Email" type="email" id="adjustEmail" value="<?php echo e($lead->adjust_email_insurance??''); ?>" >
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="contractSignedDate" class="form-label input_labels p-18">Contingency Contract Signed Date </label>

                    <input class="form-control clr_input_fields borderRadius" name="contract_signed_date" placeholder="Select Date" type="date" id="contractSignedDate" value="<?php echo e($yearEstimation->year . '-01-01' ?? ""); ?>" >
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="dateLoss" class="form-label input_labels p-18">Date of Loss </label>

                    <input class="form-control clr_input_fields borderRadius" name="date_loss_insurance" placeholder="Select Date" type="date" id="dateLoss" value="<?php echo e($yearEstimation->year . '-01-01' ?? ""); ?>" >
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="claimFilledDate" class="form-label input_labels p-18">Claim Filled Date </label>

                    <input class="form-control clr_input_fields borderRadius" name="claim_filled_date" placeholder="Select Date" type="date" id="claimFilledDate" value="<?php echo e($yearEstimation->year . '-01-01' ?? ""); ?>">
                </div>
            </div>
            <div class="col-md-12 m-t-20">
                <div class="form-group  ">
                    <div class="d-flex justify-content-space-between  ">
                        <button class="btn green_btn borderRadius" type="submit" onclick="this.disabled = true; this.form.submit();">Submit</button>
                        <a class="btn m-l-5 borderRadius right_canvas_cancelBtn " data-bs-dismiss="offcanvas"  style=" background: none;" aria-label="Close" >Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('#insuranceCompany').change(function() {
            var companyId = $(this).val();

            // AJAX request
            $.ajax({
                url: "<?php echo e(url('get_company_detail')); ?>", // Replace with your endpoint URL
                method: 'GET',
                data: {
                    companyId: companyId,
                },
                success: function(response) {
                    $('#phone_insurance').val(response.phone ?? '')
                    $('#Email').val(response.email ?? '')
                    $('#contractSignedDate').val(response.insurance_start ?? '')
                    $('#dateLoss').val(response.insurance_expire ?? '')


                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(xhr.responseText);
                }
            });
        });

        $('.select_insurance_initialize').select2({
            placeholder: "Select Insurance Company",
            allowClear: true,
            width: '100%',
            dropdownParent: $('#offcanvasExample')
        });
    });
</script>
<?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/lead/lead/job_insurance_view.blade.php ENDPATH**/ ?>