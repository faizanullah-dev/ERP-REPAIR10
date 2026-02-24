
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box lead_lead_page my_lead_parent">
                    <h5>Leads (<?php echo e($stage->name ?? ''); ?>)</h5>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table aligned_table" class="myTable" id="myTable">
                            <thead>
                                <tr>
                                    <th class="image">image</th>
                                    <th>Lead Number</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Customer</th>
                                    <th>Representative</th>
                                    <th>Category</th>
                                    <th>Address</th>
                                    <th>Lead Status</th>
                                    <th class="action">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $leadByStages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr class="lead_check">

                                        <td class="aligning_table_images">
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            

                                            
                                            
                                            
                                            
                                            <?php
                                                $totalDocuments = 0;
                                                foreach ($item->getphotoandDocument as $photoAndDocument) {
                                                    $totalDocuments += count($photoAndDocument->getDocuments);
                                                }
                                                $displayed = 0;
                                            ?>

                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($totalDocuments == 0): ?>
                                                <img src="<?php echo e(asset('/website/images') . '/by_default_two.png'); ?> "
                                                    style="width: 80px; height: 80px; border-radius: 50%;">
                                            <?php else: ?>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $item->getphotoandDocument; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photoAndDocument): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $photoAndDocument->getDocuments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($displayed < 1): ?>
                                                            <?php $fileExtension = strtolower(array_reverse(explode('.', $document->name))[0]); ?>

                                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($document->name) &&
                                                                    in_array($fileExtension, ['jpg', 'jpeg', 'pjpeg', 'png', 'x-png', 'gif', 'x-shockwave-flash'])): ?>
                                                                <img src="<?php echo e(asset('website')); ?>/<?php echo e($document->name); ?>"
                                                                    style="width: 80px; height: 80px; border-radius: 50%;">
                                                            <?php elseif(isset($document->name) && $fileExtension == 'pdf'): ?>
                                                                <img src="<?php echo e(asset('/website/images') . '/pdf.png'); ?>"
                                                                    style="width: 80px; height: 80px; border-radius: 50%;">
                                                            <?php elseif(isset($document->name) && in_array($fileExtension, ['doc', 'docx', 'txt'])): ?>
                                                                <img src="<?php echo e(asset('/website/images') . '/Word-Logo.png'); ?>"
                                                                    style="width: 80px;">
                                                            <?php else: ?>
                                                                <img src="<?php echo e(asset('/website/images') . '/user_profile.png'); ?> "
                                                                    style="width: 80px; height: 80px; border-radius: 50%;">
                                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                                            <?php $displayed++; ?>
                                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>



                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($totalDocuments > 1): ?>
                                                    +<?php echo e($totalDocuments - $displayed); ?>

                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        </td>
                                        <td><?php echo e($item->lead_number ?? '000'); ?></td>
                                        <td><?php echo e($item->title ?? 'Not Available'); ?></td>
                                        <td><?php echo substr($item->description, 0, 50), '...'; ?></td>
                                        <td><?php echo e($item->customer->name ?? 'Not Available'); ?></td>
                                        <td><?php echo e($item->representative->name ?? 'Not Available'); ?></td>
                                        <td><?php echo e($item->category->name ?? 'Not Available'); ?></td>
                                        <td><?php echo e(substr($item->address, 0, 50), '...'); ?> </td>
                                        <td>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->lead_status == 'won'): ?>
                                                <badge class='badge badge-success'>WON</badge>
                                            <?php elseif($item->lead_status == 'lost'): ?>
                                                <badge class='badge badge-danger'>LOST</badge>
                                            <?php elseif($item->lead_status == 'pending'): ?>
                                                <badge class='badge badge-warning'>PENDING</badge>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="btn_td">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-' . str_slug('Lead'))): ?>
                                                    <a href="<?php echo e(url('view_lead/' . $item->id)); ?>"
                                                        title="View <?php echo e(preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Lead')); ?>">
                                                        <button class="btn green_btn btn-sm">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                        </button>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-' . str_slug('Lead'))): ?>
                                                    <form method="POST" id="delete-form-<?php echo e($item->id); ?>"
                                                        action="<?php echo e(url('/lead/lead' . '/' . $item->id)); ?>"
                                                        accept-charset="UTF-8" style="display:inline">
                                                        <?php echo e(method_field('DELETE')); ?>

                                                        <?php echo e(csrf_field()); ?>

                                                        <button type="button" class="btn green_btn btn-sm delete-btn"
                                                            data-id="<?php echo e($item->id); ?>"
                                                            title="Delete <?php echo e(preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Lead')); ?>">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            No Record Available
                                        </td>
                                    </tr>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        $(document).ready(function() {
            // Delete button click handler
            $('.delete-btn').on('click', function(e) {
                e.preventDefault();

                const leadId = $(this).data('id');
                const form = $('#delete-form-' + leadId);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/admin/lead_by_stages.blade.php ENDPATH**/ ?>