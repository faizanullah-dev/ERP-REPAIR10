

















<?php $permissionsData = []; $parrentPermissions = [];  $sortedArr = []; ?>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $role->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!in_array(explode('-', $permission->name)[1], $parrentPermissions)): ?>
        <?php
            $parent =explode(' ',ucwords(str_replace('-',' ',$permission->name)))[1];
            $parentKey = str_replace(' ', '', $parent);
            array_push($parrentPermissions, explode('-', $permission->name)[1]);
            array_push($sortedArr, [
                'parent' => $parent,
                'children' => [],
                'childrenId' => []
            ]);
        ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php $parentIndex = array_search($parent, array_column($sortedArr, 'parent')); ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($parentIndex !== false): ?>
        <?php
            array_push($sortedArr[$parentIndex]['children'], ucwords(str_replace('-', ' ', $permission->name)));
            array_push($sortedArr[$parentIndex]['childrenId'], $permission->id);
        ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<div class="row">
    <div class="col-md-12 inner_section_user_permission_checks">
        <div class="row">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $sortedArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4">
                    <div class="parent_div">
                        <div class="custom_checkbox parent_checkbox">
                            <input id="chk_<?php echo e($key); ?>" type="checkbox" id="permissions<?php echo e($key); ?>" value="" disabled checked>
                            <label class="custom_check" for="chk_<?php echo e($key); ?>" ><?php echo e($result['parent']); ?></label>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $result['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child_id=>$child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="child_div">
                                <div class="custom_checkbox">
                                    <input id="chk_<?php echo e($child); ?>" type="checkbox" name="permissions[]" id="permissions<?php echo e($key); ?>" disabled checked value="<?php echo e($result['childrenId'][$child_id]); ?>" required>
                                    <label class="custom_check" for="chk_<?php echo e($child); ?>"><?php echo e($child); ?></label>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>
    </div>
</div>

<?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/staff/staff/role_permissions.blade.php ENDPATH**/ ?>