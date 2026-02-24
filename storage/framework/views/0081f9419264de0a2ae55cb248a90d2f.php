

<?php $__env->startPush('css'); ?>
    <link href="<?php echo e(asset('plugins/components/datatables/jquery.dataTables.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Users List</h3>
                  
                    <div class="clearfix"></div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="myTable" class="table">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($key+1); ?></td>
                                            <td><?php echo e(($user->name=='User'?"Admin":$user->name??'Not Available')); ?></td>
                                            <td><?php echo e($user->email); ?></td>
                                            <td><?php echo e(($user->roles()->pluck('name')->implode(', ')=='user')?'Admin':$user->roles()->pluck('name')->implode(', ')??'Not Available'); ?></td>
                                            <th>
                                                <a href="<?php echo e(url('user/edit/'.$user->id)); ?>">
                                                    <button class="btn btn-primary btn-sm">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 
                                                    </button>
                                                </a> &nbsp;&nbsp;
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->roles()->pluck('name')->implode(', ')=='user'): ?>
                                                    <a href="#" style="cursor:not-allowed;">
                                                        <button class="btn btn-primary btn-sm" style="cursor:not-allowed;" disabled>
                                                            <i class="icon-trash" style="cursor:not-allowed;"></i> 
                                                        </button>
                                                    </a>
                                                <?php else: ?>
                                                    <form method="GET"
                                                          action="<?php echo e(url('user/delete/'.$user->id)); ?>"
                                                          accept-charset="UTF-8" style="display:inline" class="delete-form">
                                                        <button type="button" class="btn btn-sm"
                                                                title="Delete <?php echo e(preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'User')); ?>"
                                                                onclick="showDeleteConfirmation(this)">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                        </button>
                                                    </form>

                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </th>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php echo $__env->make('layouts.partials.right-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('plugins/components/toast-master/js/jquery.toast.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/components/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click','.delete',function (e) {
                if(confirm('Are you sure want to delete?'))
                {
                }
                else
                {
                    return false;
                }
            });
            <?php if(\Session::has('message')): ?>
            $.toast({
                heading: 'Success!',
                position: 'top-center',
                text: '<?php echo e(session()->get('message')); ?>',
                loaderBg: '#ff6849',
                icon: 'success',
                hideAfter: 3000,
                stack: 6
            });
            <?php endif; ?>
        })

        $(function() {
            $('#myTable').DataTable({
                "columns": [
                    null, null,null, {"orderable": false},null
                ]
            });

        });
    </script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/users/index.blade.php ENDPATH**/ ?>