

<?php $__env->startPush('css'); ?>
    <link href="<?php echo e(asset('plugins/components/datatables/jquery.dataTables.min.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet"
          type="text/css"/>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Role Management</h3>
                    <a class="btn btn-success pull-right" href="<?php echo e(url('role/create')); ?>"><i class="icon-plus"></i> Add
                        Role</a>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($key+1); ?></td>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($role->name=='admin'): ?>
                                                <td>Developer</td>
                                            <?php elseif($role->name=='user'): ?>
                                                <td>Website Admin</td>
                                            <?php else: ?>
                                                <td><?php echo e($role->name); ?></td>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <th>
                                                <a class="btn btn-info btn-sm" href="<?php echo e(url('role/edit/'.$role->id)); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($role->name=='admin'): ?>
                                                    &nbsp;&nbsp;<button class="delete btn btn-danger btn-sm" href="#" disabled><i class="fa fa-trash-o"></i> Delete</button>
                                                <?php elseif($role->name=='user'): ?>
                                                    &nbsp;&nbsp;<button class="delete btn btn-danger btn-sm" href="#" disabled><i class="fa fa-trash-o"></i> Delete</button>
                                                <?php else: ?>
                                                    &nbsp;&nbsp;<a class="delete btn btn-danger btn-sm" href="<?php echo e(url('role/delete/'.$role->id)); ?>"><i class="fa fa-trash-o"></i> Delete</a>
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
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    
    
    
    
    
    
    
    <script>
        $(document).on('click', '.delete', function () {
            if (confirm('Are you sure want to delete?')) {
            }
            else {
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
        $(function () {
            $('#myTable').DataTable({
                "columns": [
                    null, null, {"orderable": false}
                ],
                "columnDefs": [
                    {"width": "50%", "targets": 1}
                ]
            });

        });
    </script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/role/index.blade.php ENDPATH**/ ?>