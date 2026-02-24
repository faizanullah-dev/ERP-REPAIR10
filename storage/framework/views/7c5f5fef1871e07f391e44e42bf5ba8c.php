<h6 class="pull-left">Search Leads</h6>
<h6 class="pull-right">TOTAL: <?php echo e($leadCount??'0'); ?></h6>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="row">
        <div class="col-md-12">
            <div class="search_result_link">
                <a href="<?php echo e(url('customer/customer/'. $lead->customer_id)); ?>" target="_blank">
                    <div class="name">
                        <p><?php echo e($lead->customer->name??""); ?></p>
    
                    </div>
                </a>
                <a href="<?php echo e(url('view_lead/'. $lead->id)); ?>" target="_blank">
                    <div class="name">
    
                        <p><?php echo e($lead->title); ?></p>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <hr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="row">
        <div class="col-md-12" style="text-align: center;">
            <p> No Lead Found </p>
        </div>
    </div><hr>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?><?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/lead/lead/search_dynamic_data.blade.php ENDPATH**/ ?>