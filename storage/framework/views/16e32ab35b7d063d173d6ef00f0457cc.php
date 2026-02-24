

<?php $__env->startSection('content'); ?>
<section id="wrapper" class="login-register">
    <div class="login-box">
        <div class="white-box passowrd_fields">
            <form class="form-horizontal form-material" id="loginform" method="post" action="<?php echo e(route('login')); ?>">
                <?php echo e(csrf_field()); ?>

                <h3 class="box-title m-b-20">Sign In</h3>
                <div class="form-group ">
                    <div class="col-xs-12">
                        <label for="email" class="form-label input_labels p-18">Email</label>
                        <div class="input_group_box">
                            <input id="email" placeholder="example@mail.com" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
                            <div class="input_icon">
                                <a href="javascript:void(0);"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->has('email')): ?>
                            <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                            </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="password" class="form-label input_labels p-18">Password</label>
                        <div class="input_group_box">
                            <input id="password"  type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required placeholder="Type password">
                            <div class="input_icon">
                                <a href="javascript:void(0);" class="password_btn1"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->has('password')): ?>
                            <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                            </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="checkbox checkbox-primary pull-left p-t-0">
                            <input type="checkbox" id="checkbox-signup" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                            <label for="checkbox-signup"> Remember me </label>
                        </div>
                        <a href="<?php echo e(route('password.request')); ?>" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot password?</a> </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit"> Log In
                        </button>
                    </div>
                </div>
                
                





            </form>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $('.password_btn1').click(function(){
                if($('.password_btn1 i').hasClass('fa-eye-slash')){
                    $('.password_btn1 i').removeClass('fa-eye-slash');
                    $('.password_btn1 i').addClass('fa-eye');
                    $('#password').attr('type','text');
                }else{
                    $('.password_btn1 i').removeClass('fa-eye');
                    $('.password_btn1 i').addClass('fa-eye-slash');
                    $('#password').attr('type','password');
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/auth/login.blade.php ENDPATH**/ ?>