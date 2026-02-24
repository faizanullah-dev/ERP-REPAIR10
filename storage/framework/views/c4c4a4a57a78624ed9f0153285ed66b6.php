

<?php $__env->startSection('content'); ?>
    <section class="staff_create_form_sec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                       <div class="row">
                           <div class="col-md-12">
                               <div class="white-box-header">
                                   <div class="white-box-header-left">
                                       <h3 class="box-title">Create New Staff</h3>
                                   </div>
                               </div>
                           </div>
                           <div class="col-md-12">
                               <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                                   <ul class="alert alert-danger">
                                       <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                           <li><?php echo e($error); ?></li>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                   </ul>
                               <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                               <form method="POST" action="<?php echo e(url('/staff/staff')); ?>" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="staff-form">
                                   <?php echo e(csrf_field()); ?>

                                   <?php echo $__env->make('staff.staff.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                               </form>
                           </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/staff/staff/create.blade.php ENDPATH**/ ?>