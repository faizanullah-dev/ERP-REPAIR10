

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Create New <?php echo e(preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Lead')); ?></h3>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-'.str_slug('Lead'))): ?>
                        <a class="btn btn-success pull-right" href="<?php echo e(url('/lead/lead')); ?>">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    <?php endif; ?>

                    <div class="clearfix"></div>
                    <hr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                        <ul class="alert alert-danger">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </ul>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <form method="POST" action="<?php echo e(url('/lead/lead')); ?>" accept-charset="UTF-8"
                          class="form-horizontal" id="leadFrom" enctype="multipart/form-data" onsubmit="disableSubmitButton(this);">
                        <?php echo e(csrf_field()); ?>


                        <?php echo $__env->make('lead.lead.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script>
        // function disableSubmitButton(form) {
        //     const submitButton = form.querySelector('input[type=submit]') || form.querySelector('button[type=submit]');
        //     if (submitButton) {
        //         submitButton.disabled = true;
        //         if (submitButton.tagName === 'INPUT') {
        //             submitButton.value = 'Submitting...';
        //         } else if (submitButton.tagName === 'BUTTON') {
        //             submitButton.innerText = 'Submitting...';
        //         }
        //     } else {
        //         console.error('Submit button not found in the form.');
        //     }
        // }

        document.querySelector('.btn-success').addEventListener('click', function (event) {
            event.preventDefault();
            window.location.href = '<?php echo e(url()->previous()); ?>';
        });
        window.onload = function() {
            const fileInput = $('.job-image-input');
            const preview = $('.job-image-preview');
            const error = $('.job-image-error');
            const pencilButton = $('.job-image-pencil');
            const defaultImage = '<?php echo e(asset("website/images/upload_avatar.svg")); ?>';
            function resetImageField() {
                fileInput.val('');
                preview.attr('src', defaultImage).css('opacity', 0.7);
            }
            $(document).on('change', '.job-image-input', function(event) {
                const file = event.target.files[0];
                error.hide();
                if (!file) return resetImageField();
                if (!file.type.match('image/(jpeg|png|webp)')) {
                    error.text('Only JPEG, PNG, or WebP allowed.').show();
                    return resetImageField();
                }
                if (file.size > 2 * 1024 * 1024) {
                    error.text('Image must be under 2MB.').show();
                    return resetImageField();
                }
                const reader = new FileReader();
                reader.onload = e => preview.css('opacity', 0).attr('src', e.target.result).animate({ opacity: 1 }, 300);
                reader.onerror = () => {
                    error.text('Error loading image. Try again.').show();
                    resetImageField();
                };
                reader.readAsDataURL(file);
            });
            fileInput.on('invalid', e => {
                e.preventDefault();
                error.text('Job image is required.').show();
            });
            preview.css('opacity', 0.7);
            pencilButton.show();
        };
    </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/lead/lead/create.blade.php ENDPATH**/ ?>