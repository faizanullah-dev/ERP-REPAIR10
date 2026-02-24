<style>
    .scrollable-content {
        overflow-y: auto;
        overflow-x: hidden;

    }

    .message_icon_container {
        height: 50px;
        width: 50px;
        border-radius: 50%;
        border: 0;
        background-color: var(--green_74C911);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .message_icon_container i {
        font-size: 22px;
        color: white;
    }

    .message-center {
        display: flex;
        gap: 10px;
        padding-inline-start: 10px;
        padding-block: 5px;



    }

    .message_heading_time {
        display: flex;
        justify-content: space-between;
    }

    .message_icon_parent {
        display: flex;
        align-items: center;
    }
</style>

<div class="top_navbar">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center">
            <div class="sidebar-toggle">
                <a href="javascript:void(0)" class="sidebartoggler waves-effect waves-light"><i
                        class="fa fa-circle-arrow-left"></i></a>
            </div>
            <div class="search">
                <i class="fa fa-search"></i>
                <input type="text" class="form-control borderRadius search_bar" id="searchInput" placeholder="Search">
            </div>
        </div>
        <div class="col-md-6">
            <div class="right_column">
                <div class="msg_bell_icon notification_icon_box">
                    <?php
                        $notificationList = \App\Notification::orderBy('id', 'desc')
                            ->where('status', 'unseen')
                            ->where('model', 'Message Received')
                            ->get();
                        $unseenNotificationsCount = \App\Notification::where('status', 'unseen')
                            ->where('model', 'Message Received')
                            ->count();
                    ?>
                    <ul class="nav navbar-top-links navbar-right pull-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle waves-effect waves-light font-20 notify_icon"
                                data-toggle="dropdown" href="javascript:void(0);" id="notificationLink">
                                <i class="fa fa-bell"></i>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasRole('user')): ?>
                                    <span class="badge badge-xs badge-danger nav_bell_dropdown_icon"
                                        id="notificationCount"><?php echo e($unseenNotificationsCount ?? 0); ?></span>
                                <?php else: ?>
                                    <span class="badge badge-xs badge-danger nav_bell_dropdown_icon"
                                        id="notifi-count"></span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </a>
                            <ul class="dropdown-menu mailbox animated bounceInDown">
                                <li>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasRole('user')): ?>
                                        <div class="drop-title">You have <span
                                                id="notifi-count"><?php echo e($unseenNotificationsCount); ?></span> new
                                            notifications
                                        </div>
                                    <?php else: ?>
                                        <div class="drop-title">You have no new notification</div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </li>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasRole('user')): ?>
                                    <li>
                                        <div class="scrollable-content" style="height: 300px">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $notificationList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(auth()->id() == 2 || $notification->user_id == auth()->id()): ?>
                                                    <div class="message-center" data-status="unseen"
                                                        data-notification-id="<?php echo e($notification->id); ?>"
                                                        id="notification_status">
                                                        <div class="message_icon_parent">
                                                            <div class="message_icon_container">
                                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($notification->model == 'Message Received'): ?>
                                                                    <i class="fa-regular fa-comment-o"></i>
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                <?php else: ?>
                                                                    <i class="fa-solid fa-bell"></i>
                                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="mail-contnet">
                                                            <div class="message_heading_time">
                                                                <h5> <?php echo e($notification->model); ?> </h5>
                                                                <span
                                                                    class="time"><?php echo e($notification->created_at->format('l, h:i A d-M-Y')); ?></span>
                                                            </div>
                                                            <span class="mail-desc">
                                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($notification->model == 'Message Received'): ?>
                                                                    <?php echo e($notification->title ?? ''); ?> against the lead
                                                                    <?php echo e($notification->lead->title ?? ''); ?>

                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                <?php else: ?>
                                                                    <?php echo e($notification->title); ?>

                                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                            </span>
                                                        </div>
                                                        <div class="d-flex justify-content-end">
                                                        </div>
                                                    </div>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                    </li>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                
                                
                                
                                
                                
                                
                                
                                
                                
                            </ul>
                        </li>
                    </ul>

                </div>
                <div class="dropdown user-pro-body  profile_dropdown">
                    <p class="profile-text ">
                        <a href="javascript:void(0);">
                            <?php if(auth()->user()->name == 'Admin'): ?>
                                Developer
                            <?php elseif(auth()->user()->name == 'User'): ?>
                                <?php echo e(auth()->user()->first_name . ' ' . auth()->user()->last_name); ?>

                            <?php else: ?>
                                <?php echo e(auth()->user()->name); ?>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </a>
                    </p>
                    <div class="profile-image">
                        
                        <img src="<?php echo e(asset('storage/uploads/users/no_avatar.jpg')); ?>" alt="user-img"
                            class="img-circle img-fluid">
                        
                        <a href="javascript:void(0);" class="dropdown-toggle u-dropdown text-blue"
                            data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        </a>

                        <ul class="dropdown-menu animated flipInY navbar_profile_dropdown">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!auth()->user()->hasRole('subcontractor')): ?>
                                <li><a href="<?php echo e(url('user_profile')); ?>"><i class="fa fa-cog"></i> Account Settings</a>
                                </li>
                                <?php if(!auth()->user()->hasRole('customer')): ?>
                                    <!-- This ensures that 'Company Settings' is hidden for customers -->
                                    <li class="dropdown-submenu">
                                        <a href="#!"><i class="fa fa-cog"></i> Company Settings</a>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-submenu">
                                                <a href="#!">Command Center</a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="<?php echo e(url('customer_onboarding')); ?>">Customer
                                                            Onboarding</a></li>
                                                    <li><a href="<?php echo e(url('controlPanel/control-panel')); ?>">Control
                                                            Panel</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu">
                                                <a href="#!">Calculators</a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="<?php echo e(url('roof_base')); ?>">Roof Calculator Base</a></li>
                                                    <li><a href="<?php echo e(url('chimney_base')); ?>">Chimney Calculator Base</a>
                                                    </li>
                                                    <li><a href="<?php echo e(url('side_base')); ?>">Siding Calculator Base</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu">
                                                <a href="#!">Marketing</a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="<?php echo e(url('referralSource/referral-source/')); ?>">Referral
                                                            Source</a></li>
                                                    <li><a href="<?php echo e(url('advertisement/advertisement/')); ?>">Monthly
                                                            Advertisement</a></li>
                                                    <li><a href="<?php echo e(url('cost_of_lead/')); ?>">Cost Of Lead</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="<?php echo e(url('companyContact/company-contact')); ?>">Company
                                                    Contact</a></li>
                                            <li><a href="<?php echo e(url('emailTemplateFolder/email-template-folder')); ?>">Email
                                                    Template Folder</a></li>
                                            <li><a href="<?php echo e(url('email_branding')); ?>">Email Branding</a></li>
                                            <li><a href="<?php echo e(url('category/category')); ?>">Category</a></li>
                                            <li><a href="<?php echo e(url('stage/stage')); ?>">Stage</a></li>
                                            <li><a href="<?php echo e(url('team/team')); ?>">Team</a></li>
                                            <li><a href="<?php echo e(url('holiday/holiday')); ?>">Holiday</a></li>
                                            <li><a href="<?php echo e(url('calendar_types')); ?>">Calendar Types</a></li>
                                            <li><a href="<?php echo e(url('cogsMaterial/cogs-material')); ?>">COGS Materials</a>
                                            </li>
                                            <li><a href="<?php echo e(url('mark/mark')); ?>">Mark</a></li>
                                            <li><a href="<?php echo e(url('priority/priority')); ?>">Priority</a></li>
                                            <li><a href="<?php echo e(url('announcement/announcement')); ?>">Announcements</a></li>
                                            <li><a href="<?php echo e(url('customerOwnerType/customer-owner-type')); ?>">Customer
                                                    Owner Type</a></li>
                                            <li><a href="<?php echo e(url('productCategory/product-category')); ?>">Product
                                                    Category</a></li>
                                            <li><a href="<?php echo e(url('paymentType/payment-type')); ?>">Payment Type</a></li>
                                            <li><a href="<?php echo e(url('trade/trade')); ?>">Trades</a></li>
                                        </ul>
                                    </li>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <li><a href="<?php echo e(url('logout')); ?>"><i class="fa fa-power-off"></i> Logout</a></li>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->startPush('js'); ?>
    <script>
        // function updateNotificationCount() {
        //     currentAjaxRequest  = $.ajax({
        //         url: "/notification",
        //         type: 'GET',
        //         success: function (response) {
        //             var newCount = response.unseenCount;
        //             $('#notifi-count').text(newCount);
        //         },
        //         error: function (jqXHR, textStatus, errorThrown) {
        //             console.log('Error:', textStatus, errorThrown);
        //         }
        //     });
        // }
        // $(document).ready(function () {
        //     updateNotificationCount();
        //     setInterval(updateNotificationCount, 30000);
        // });

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        $(document).ready(function() {
            // Check if the element exists before attaching the click event
            if ($("#notificationLink").length > 0) {
                $("#notificationLink").on("click", function() {
                    $("#notificationCount").text("0");
                    var status = $('.notification-row').attr('data-notification');
                    $.ajax({
                        url: '<?php echo e(route('status_change_notification')); ?>',
                        type: 'GET',
                        data: {
                            status: 'seen',
                        },
                        success: function(response) {
                            console.log(response);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error checking for notifications: ' + error);
                        }
                    });
                });
            }
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/layouts/partials/navbar.blade.php ENDPATH**/ ?>