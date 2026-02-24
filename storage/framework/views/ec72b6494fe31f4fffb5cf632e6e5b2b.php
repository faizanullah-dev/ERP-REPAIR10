<aside id="sidebar" class="sidebar " >
    <div class="sidebar-header">
        <div class="sidebar_logo"><a href="<?php echo e(url('dashboard')); ?>" class="logo"><img src="<?php echo e(asset('website')); ?>/images/logo.png" loading="lazy" alt=""></a></div>
        <div class="sidebar-toggle">
            <a href="javascript:void(0)" class="sidebartoggler waves-effect waves-light"><i class="fa fa-close"></i></a>
        </div>
    </div>
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="side-menu">

                <li>
                    <a class="active waves-effect" href="<?php echo e(url('dashboard')); ?>" aria-expanded="false">
                        <div class="dashboard_icon"> <img src="<?php echo e(asset('website')); ?>/images/Dashboard.svg" loading="lazy" alt=""></div>
                        <span class="hide-menu"> Dashboard </span>
                    </a>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->isAdmin() == true): ?>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="<?php echo e(asset('dashboard')); ?>">Modern Version</a></li>
                            <li><a href="<?php echo e(asset('index2')); ?>">Clean Version</a></li>
                            <li><a href="<?php echo e(asset('index3')); ?>">Analytical Version</a></li>
                            <li>
                                <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><span
                                            class="hide-menu"> eCommerce </span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?php echo e(asset('index4')); ?>">Dashboard</a></li>
                                    <li><a href="<?php echo e(asset('products')); ?>">Products</a></li>
                                    <li><a href="<?php echo e(asset('product-detail')); ?>">Product Detail</a></li>
                                    <li><a href="<?php echo e(asset('product-edit')); ?>">Product Edit</a></li>
                                    <li><a href="<?php echo e(asset('product-orders')); ?>">Product Orders</a></li>
                                    <li><a href="<?php echo e(asset('product-cart')); ?>">Product Cart</a></li>
                                    <li><a href="<?php echo e(asset('product-checkout')); ?>">Product Checkout</a></li>
                                </ul>
                            </li>
                        </ul>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </li>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((Auth::user()->roles()->pluck('name')->implode(', ')=='user')): ?>
                    
                    
                    
                    
                    
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->isAdmin() == true): ?>
                    <li>
                        <a class="waves-effect" href="<?php echo e(asset('role-management')); ?>"><i class=" icon-layers fa-fw"></i><span class="hide-menu"> Roles </span></a>
                    </li>
                    <li class="two-column">
                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                    class="icon-user fa-fw"></i> <span class="hide-menu"> Users</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="<?php echo e(asset('users')); ?>">Manage Users</a></li>
                            <li><a href="<?php echo e(asset('user/create')); ?>">Add New User</a></li>
                            <li><a href="<?php echo e(asset('user/deleted')); ?>">Deleted Users</a></li>

                        </ul>
                    </li>
                    <li><hr /></li>
                    
                    
                    <li><a class="waves-effect" href="<?php echo e(asset('crud-generator')); ?>">
                            <i class="icon-drawar fa-fw"></i><span class="hide-menu"> CRUD Generator</span></a>
                    </li>
                    <li class="two-column">
                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-eye fa-fw"></i> <span class="hide-menu"> Logs</span></a>
                        <ul aria-exzpanded="false" class="collapse">
                            <li><a href="<?php echo e(asset('log-viewer')); ?>">Laravel Log</a></li>
                            <li><a href="<?php echo e(asset('activity-log')); ?>">Activity Log</a></li>
                        </ul>
                    </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-customer')): ?>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    <li class="custom_item nav-item <?php if(request()->is('user_view/*') || request()->is('customer/customer/*') || request()->is('customer/customer/create') || request()->is('customer/customer/*/edit')): ?> active <?php endif; ?>">
                        <a class="waves-effect nav-link <?php if(request()->is('customer/customer/create')): ?> active <?php endif; ?>" href="<?php echo e(url('user_view/')); ?>" id="customerNavLink">
                            <div class="dashboard_icon"> <img src="<?php echo e(asset('website')); ?>/images/Customer.svg" loading="lazy"  alt=""></div>
                            <span class="hide-menu">Customer</span>
                            <span class="hide-menu add_btn">
                                <i class="fa fa-circle-plus create-customer-btn" data-href="<?php echo e(url('/customer/customer/create')); ?>"></i>
                            </span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-'.str_slug('staff'))): ?>
                    <li class="dropdown nav-item <?php if(request()->is('staff/staff*')): ?> active <?php endif; ?>">
                        <a class="waves-effect nav-link" href="#Staff" aria-expanded="<?php echo e(request()->is('staff/staff*') ? 'true' : 'false'); ?>">
                            <i class="fa-regular fa-calendar"></i>
                            <span class="hide-menu">Staff</span>
                        </a>
                        <ul class="collapse submenu <?php echo e(request()->is('staff/staff*') ? 'in' : ''); ?>" id="Staff" data-bs-parent="#menu">
                            <li class="<?php echo e(request()->is('staff/staff') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('staff/staff')); ?>">Manage Staff</a>
                            </li>
                            <li class="<?php echo e(request()->is('sub_contractor') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('sub_contractor')); ?>">Sub Contractor</a>
                            </li>
                            <?php if(auth()->user()->hasRole('user')): ?>
                                <li class="<?php echo e(request()->is('admin-listing') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(url('admin-listing')); ?>">Admin Listing</a>
                                </li>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <li class="dropdown nav-item <?php if(request()->is('staff/staff*')): ?> active <?php endif; ?>">
                                <a class="waves-effect nav-link" href="#Compensation" aria-expanded="false">
                                    <i class="fa-solid fa-sack-dollar"></i>
                                    <span class="hide-menu">Compensation</span>
                                </a>
                                <ul class="collapse submenu" id="Compensation" data-bs-parent="#menu">
                                    <li class="<?php echo e(request()->is('staff_benefits_block') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(url('staff_salary_block')); ?>">Salary Block</a>
                                    </li>
                                    <li class="<?php echo e(request()->is('staff_benefits_block') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(url('staff_benefits_block')); ?>">Benefits Block</a>
                                    </li>
                                    <li class="<?php echo e(request()->is('positionBlock/position-block') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(url('positionBlock/position-block')); ?>">Positions Block</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-lead')): ?>
                    <?php
                        $isActive = request()->is('lead/lead/*') ||
                                    request()->is('appointment_per_day') ||
                                    request()->is('lead_card_view*') ||
                                    request()->is('lead/lead?lead_type=pending') ||
                                    request()->is('lead/lead?lead_type=won') ||
                                    request()->is('lead/lead?lead_type=lost');
                    ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!auth()->user()->hasRole('customer')): ?>
                        <li class="dropdown custom_item nav-item <?php if($isActive): ?> active <?php endif; ?>">
                            <a class="waves-effect nav-link" href="#Lead" aria-expanded="<?php echo e($isActive ? 'true' : 'false'); ?>">
                                <div class="dashboard_icon"> <img src="<?php echo e(asset('website')); ?>/images/Lead Job.svg" loading="lazy"  alt=""></div>
                                <span class="hide-menu">Lead</span>
                                <span class="hide-menu add_btn" data-href="<?php echo e(url('/lead/lead/create')); ?>">
                                <i class="fa fa-circle-plus"></i>
                            </span>
                            </a>
                            <?php
                                $yearEstimation = \App\YearEstimation::where('status', 1)->first();
                                $leadsQuery = \App\Lead::whereYear('lead_date', $yearEstimation->year)->orWhereYear('lead_status_date', $yearEstimation->year);
                                if (!auth()->user()->hasRole('user')) {
                                    $leadsQuery->where(function ($query) {
                                        $query->where('representative_id', auth()->user()->id)
                                              ->orWhere('customer_id', auth()->user()->id);
                                    });
                                }

                                $leads = $leadsQuery->get();
                                $leadAll = \App\Lead::whereYear('lead_status_date', $yearEstimation->year)->get();
                                $pending = \App\Lead::whereYear('lead_status_date', $yearEstimation->year)->where('lead_status', 'pending')->count();
                                $won = \App\Lead::whereYear('lead_status_date', $yearEstimation->year)->where('lead_status', 'won')->count();
                                $lost = \App\Lead::whereYear('lead_status_date', $yearEstimation->year)->where('lead_status', 'lost')->count();
                                $new = \App\Lead::whereYear('lead_status_date', $yearEstimation->year)->where('lead_status', 'new')->count();
                                $delete = \App\Lead::onlyTrashed()->whereYear('deleted_at', $yearEstimation->year)->count();
                                $all = $leadAll->count();
                            ?>

                            <ul class="collapse submenu <?php echo e($isActive ? 'in' : ''); ?>" id="Appointments" data-bs-parent="#menu" aria-expanded="<?php echo e($isActive ? 'true' : 'false'); ?>">
                                <li id="appointment_all" class="<?php echo e(request()->is('lead_card_view*') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(url('lead_card_view?lead_card_view_status=unarchive')); ?>">
                                        All <span class="badge badge-danger"><?php echo e($all ?? '0'); ?></span>
                                    </a>
                                </li>
                                <li id="appointment_new" class="<?php echo e(request()->is('lead/lead?lead_type=new') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(url('lead_card_view?lead_type=new')); ?>">
                                        New <span class="badge badge-danger"><?php echo e($new ?? '0'); ?></span>
                                    </a>
                                </li>
                                <li id="lead_pending" class="<?php echo e(request()->is('lead/lead?lead_type=pending') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(url('lead_card_view?lead_type=pending')); ?>">
                                        Pending <span class="badge badge-danger"><?php echo e($pending ?? '0'); ?></span>
                                    </a>
                                </li>
                                <li id="lead_won" class="<?php echo e(request()->is('lead/lead?lead_type=won') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(url('lead_card_view?lead_type=won')); ?>">
                                        Won <span class="badge badge-danger"><?php echo e($won ?? '0'); ?></span>
                                    </a>
                                </li>
                                <li id="lead_lost" class="<?php echo e(request()->is('lead/lead?lead_type=lost') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(url('lead_card_view?lead_type=lost')); ?>">
                                        Lost <span class="badge badge-danger"><?php echo e($lost ?? '0'); ?></span>
                                    </a>
                                </li>
                                <li id="lead_delete" class="<?php echo e(request()->is('lead/lead?lead_type=delete') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(url('lead_card_view?lead_type=delete')); ?>">
                                        Deleted <span class="badge badge-danger"><?php echo e($delete ?? '0'); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-'.str_slug('appointment'))): ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!auth()->user()->hasRole('customer')): ?>
                        <li class="dropdown nav-item <?php if(request()->is('schedulingTask/scheduling-task*') || request()->is('calendar_appointment_view*')): ?> active <?php endif; ?>">
                            <a class="waves-effect nav-link" href="#Appointments" aria-expanded="<?php echo e(request()->is('schedulingTask/scheduling-task*') || request()->is('calendar_appointment_view*') ? 'true' : 'false'); ?>">
                                <div class="dashboard_icon"> <img src="<?php echo e(asset('website')); ?>/images/Calender.svg" loading="lazy"  alt=""> </div>
                                <span class="hide-menu">Calendar</span>
                            </a>
                            <ul class="collapse submenu <?php echo e(request()->is('schedulingTask/scheduling-task*') || request()->is('calendar_appointment_view*') ? 'in' : ''); ?>" id="Appointments" data-bs-parent="#menu">
                                <li id="appointment_all" class="<?php echo e(request()->is('schedulingTask/scheduling-task*') || request()->is('appointment_per_day') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(url('schedulingTask/scheduling-task')); ?>">Production Calendar</a>
                                </li>
                                <li id="appointment_pending" class="<?php echo e(request()->is('calendar_appointment_view*') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(url('calendar_appointment_view')); ?>">Staff Calendar</a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?>
                
                
                
                
                
                
                
                

                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                

                <?php if(auth()->user()->can('view-usermailsend') || auth()->user()->can('view-usersmailboxconfiguration')): ?>
                    <li class="dropdown nav-item">
                        <a class="waves-effect nav-link" href="#communication" aria-expanded="false" aria-controls="communication">
                            <div class="dashboard_icon"> <img src="<?php echo e(asset('website')); ?>/images/Comunications.svg" loading="lazy"  alt=""></div>
                            <span class="hide-menu">Communication</span>
                        </a>
                        <ul class="collapse submenu" id="communication" data-bs-parent="#menu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-usermailsend')): ?>
                                <li class="nav-item <?php echo e(request()->is('userMailSend/user-mail-send/*') ? 'active' : ''); ?>">
                                    <a class="nav-link" href="<?php echo e(url('userMailSend/user-mail-send')); ?>">
                                        <!--                                        <i class="fa fa-envelope"></i>--> Email </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-usersmailboxconfiguration')): ?>
                                <li class="nav-item <?php echo e(request()->is('usersMailboxConfiguration/users-mailbox-configuration/*') ? 'active' : ''); ?>">
                                    <a class="nav-link" href="<?php echo e(url('usersMailboxConfiguration/users-mailbox-configuration/')); ?>">
                                        <!--                                        <i class="fa fa-inbox"></i>-->
                                        <span class="hide-menu">Users Mailbox Configuration</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <li class="nav-item <?php echo e(request()->is('mail_configuration/*') ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/mail_configuration')); ?>">
                                    <!--                                    <i class="fa fa-inbox"></i>--> Mail Configuration </a>
                            </li>
                        </ul>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                    </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-'.str_slug('Campaign'))): ?>
                    <li class="dropdown nav-item <?php echo e(request()->is('campaign/campaign/*') ? 'active' : ''); ?>" >
                        
                        <a class="waves-effect nav-link" href="#Campaign" aria-expanded="false">
                            <div class="dashboard_icon"> <img src="<?php echo e(asset('website')); ?>/images/Camping.svg" loading="lazy"  alt=""></div>
                            <span class="hide-menu">Campaign</span>
                        </a>
                        <ul class="collapse submenu" id="Campaign" data-bs-parent="#menu">
                            <li id="campaign_active" class="<?php echo e(request()->is('campaign/campaign?campaign_type=active') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('campaign/campaign?campaign_type=active')); ?>"> Active Campaign</a>
                            </li>
                            <li id="campaign_inactive" class="<?php echo e(request()->is('campaign/campaign?campaign_type=inactive') ? 'active' : ''); ?>"><a href="<?php echo e(url('campaign/campaign?campaign_type=inactive')); ?>">InActive Campaign</a></li>
                        </ul>
                        
                        
                    </li>
                <?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!auth()->user()->hasRole('customer')): ?>
                    <li class="dropdown nav-item" >
                        <a class="waves-effect nav-link" href="#AITools" aria-expanded="false">
                            <div class="dashboard_icon"> <img src="<?php echo e(asset('website')); ?>/images/user-robot.svg" loading="lazy"  alt=""></div>
                            <span class="hide-menu">AI Tools</span>
                        </a>
                        <ul class="collapse submenu" id="AITools" data-bs-parent="#menu">
                            <li>
                                <a href="<?php echo e(url('ai_year_estimation')); ?>">Year Estimation</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('earning-forecast')); ?>">Job Type Earnings Analysis</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('marketing-analysis')); ?>">Marketing Spend Optimization</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('')); ?>">Expense Prediction For Leads</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('dashboard-insights')); ?>">Dashboard Insights</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('chatbot-assistant')); ?>">ChatBot Assistant</a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                <?php if(auth()->user()->hasRole('user')): ?>
                    <li class="dropdown nav-item">
                        <a class="waves-effect nav-link" href="#support" aria-expanded="false">
                            <div class="dashboard_icon"> <img src="<?php echo e(asset('website')); ?>/images/support.svg" loading="lazy"  alt=""></div>
                            <span class="hide-menu">Support</span>
                        </a>
                        <ul class="collapse submenu" id="support" data-bs-parent="#menu">
                            <li class="nav-item <?php echo e(request()->is('reporting_for_stages', 'reporting_for_stages/*','monthly_sales_report', 'monthly_sales_report/*') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('support_chat')); ?>" class="nav-link">Support Chat</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(url('lead_chat')); ?>" class="nav-link">Lead Chats</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(url('referrals')); ?>" class="nav-link">Referrals</a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-'.str_slug('ReportPermission'))): ?>
                    <li class="dropdown nav-item <?php echo e(request()->is('reporting_for_stages', 'reporting_for_stages/*', 'jobs_won', 'jobs_won/*', 'performance', 'performance/*', 'by_salesman', 'by_salesman/*', 'summary', 'summary/*', 'job_listings', 'job_listings/*', 'monthly_sales_report', 'monthly_sales_report/*') ? 'active' : ''); ?>">
                        
                        <a class="waves-effect nav-link" href="#Reports" aria-expanded="false">
                            <div class="dashboard_icon"> <img src="<?php echo e(asset('website')); ?>/images/Reports.svg" loading="lazy"  alt=""></div>
                            <span class="hide-menu"> Reports</span>
                        </a>
                        <ul class="collapse submenu" id="Reports" data-bs-parent="#menu">
                            <li class="nav-item <?php echo e(request()->is('reporting_for_stages', 'reporting_for_stages/*','monthly_sales_report', 'monthly_sales_report/*') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('reporting_for_stages')); ?>" class="nav-link">
                                    <!--                                    <i class="fa fa-pie-chart"></i>-->  Monthly Reports  </a>
                            </li>
                            <li class="nav-item <?php echo e(request()->is('jobs_won', 'jobs_won/*') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('jobs_won?filter=year')); ?>" class="nav-link">
                                    <!--                                    <i class="fa fa-wrench"></i>-->
                                    Jobs Won(#)
                                </a>
                            </li>
                            <li class="nav-item <?php echo e(request()->is('performance', 'performance/*') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('performance')); ?>" class="nav-link">
                                    <!--                                    <i class="fa fa-area-chart"></i>-->
                                    Performance ($)
                                </a>
                            </li>
                            <li class="nav-item <?php echo e(request()->is('by_salesman', 'by_salesman/*') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('by_salesman')); ?>" class="nav-link">
                                    <!--                                    <i class="fa fa-money"></i>--> By Salesmen</a>
                            </li>
                            <li class="nav-item <?php echo e(request()->is('summary', 'summary/*') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('summary')); ?>" class="nav-link">
                                    <!--                                    <i class="fa fa-file-pdf-o"></i>--> Summary</a>
                            </li>
                            <li class="nav-item <?php echo e(request()->is('job_listings', 'job_listings/*') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('job_listings')); ?>" class="nav-link">
                                    <!--                                    <i class="fa fa-th-list"></i>--> Job Listing (#)</a>
                            </li>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-'.str_slug('appointment'))): ?>
                                <li class="dropdown nav-item <?php if(request()->is('appointment/appointment/*') || request()->is('appointment_report_table') || request()->is('sales_weekly') || request()->is('appointment_per_day')): ?> active <?php endif; ?>">
                                    
                                    <a class="waves-effect nav-link" href="#Appointments" aria-expanded="false">
                                        <i class="fa fa-calendar"></i>
                                        <span class="hide-menu">Appointments Report</span>
                                    </a>

                                    <?php
                                        $yearEstimation = \App\YearEstimation::where('status', 1)->first();
                                        $leadsQuery = \App\Appointment::with('lead');
                                            if (!auth()->user()->hasRole('user')) {
                                                $leadsQuery->whereHas('lead', function ($query) {
                                                    $query->where('representative_id', auth()->user()->id)
                                                        ->orWhere('customer_id', auth()->user()->id);
                                                });
                                            } else {
                                                $leadsQuery->whereHas('lead', function ($query) {});
                                            }
                                              $leads = $leadsQuery->whereYear('date_time_from', $yearEstimation->year)->get();
                                            $pending = $leads->where('lead.lead_status', 'pending')->count();
                                            $won = $leads->where('lead.lead_status', 'won')->count();
                                            $lost = $leads->where('lead.lead_status', 'lost')->count();
                                        $all = $leads->where('lead.lead_status')->count();
                                    ?>
                                    <ul class="collapse submenu" id="Appointments" data-bs-parent="#menu">
                                        <li id="appointment_all" class="<?php echo e(request()->is('appointment/appointment/*') || request()->is('appointment_per_day') ?  'active' : ''); ?>">
                                            <a href="<?php echo e(url('appointment/appointment')); ?>"> All <span class="badge badge-danger"><?php echo e($all??'0'); ?></span></a>
                                        </li>
                                        <li id="appointment_pending" class="<?php echo e(request()->is('appointment/appointment?appointment_type=pending') ?  'active' : ''); ?>">
                                            <a href="<?php echo e(url('appointment/appointment?appointment_type=pending')); ?>"> Pending <span class="badge badge-danger"><?php echo e($pending??'0'); ?></span></a>
                                        </li>
                                        <li id="appointment_won" class="<?php echo e(request()->is('appointment/appointment?appointment_type=won') ? 'active' : ''); ?>">
                                            <a href="<?php echo e(url('appointment/appointment?appointment_type=won')); ?>">Won <span class="badge badge-danger"><?php echo e($won??'0'); ?></span></a>
                                        </li>
                                        <li id="appointment_lost" class="<?php echo e(request()->is('appointment/appointment?appointment_type=lost') ? 'active' : ''); ?>">
                                            <a href="<?php echo e(url('appointment/appointment?appointment_type=lost')); ?>">Lost <span class="badge badge-danger"><?php echo e($lost??'0'); ?></span></a>
                                        </li>
                                    </ul>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                
                
                
                
                
                
                
                
                <?php if(auth()->user()->can('view-users') || auth()->user()->can('view-proposaltemplate')|| auth()->user()->can('view-companycontact') ||auth()->user()->can('view-emailtemplate') || auth()->user()->can('view-yearEstimation') || auth()->user()->can('view-category') || auth()->user()->can('view-stage') || auth()->user()->can('view-team') || auth()->user()->can('view-staff')): ?>
                    <li class="dropdown nav-item <?php if(request()->is('proposalTemplate/proposal-template/*') || request()->is('companyContact/company-contact/*') || request()->is('holiday/holiday/*')  ||request()->is('stage/stage/*') ||request()->is('team/team/*')||request()->is('emailTemplate/email-template/*') ||request()->is('category/category/*') ||request()->is('users/*') ||request()->is('staff/staff/*')|| request()->is('yearEstimation/year-estimation/*')): ?> active <?php endif; ?>">
                        
                        <a class="waves-effect nav-link" href="#Settings" aria-expanded="false">
                            <div class="dashboard_icon"> <img src="<?php echo e(asset('website')); ?>/images/Settings.svg" loading="lazy"  alt=""></div>
                            <span class="hide-menu"> Settings </span>
                        </a>
                        <ul class="collapse submenu" id="Settings" data-bs-parent="#menu">
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            

                            
                            
                            
                            
                            
                            
                            

                            
                            
                            
                            
                            
                            

                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-yearestimation')): ?>
                                <li class="nav-item <?php if(request()->is('yearEstimation/year-estimation/*')): ?> active <?php endif; ?> " >
                                    <a href="<?php echo e(url('yearEstimation/year-estimation/')); ?>" class="nav-link">
                                        <!--                                        <i class="fa fa-calculator" aria-hidden="true"></i>-->Year Estimation</a>
                                </li>
                            <?php endif; ?>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <?php if(auth()->user()->hasRole('user')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(url('proposal_generator')); ?>" class="nav-link">
                                        
                                        <span class="hide-menu">Proposal Generator</span>
                                    </a>
                                </li>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            
                            
                            
                            
                            
                            
                            
                        </ul>
                    </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if( auth()->user()->can('view-mark') || auth()->user()->can('view-priority') || auth()->user()->can('view-announcement') || auth()->user()->can('view-cogsmaterial')): ?>
                    <li class="dropdown nav-item <?php if(request()->is('mark/mark/*') ||request()->is('priority/priority/*') ||request()->is('roofEstimateCalculator/roof-estimate-calculator/*') ||request()->is('sidingEstimateCalculator/siding-estimate-calculator') ||request()->is('chimneyEstimateCalculator/chimney-estimate-calculator/*') ||request()->is('productPricingEstimateCalculator/product-pricing-estimate-calculator/*') ||request()->is('referralSource/referral-source/*') ||request()->is('advertisement/advertisement/*') ||request()->is('cost_of_lead/*') ||request()->is('announcement/announcement/*')): ?> active <?php endif; ?>">
                        
                        <a class="waves-effect nav-link" href="#Other"  aria-expanded="false">
                            <i class="fab-regular fa fa-icons"></i>
                            <span class="hide-menu">Other</span>
                        </a>
                        <ul class="collapse submenu" id="Other" data-bs-parent="#menu">
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-progressboard')): ?>
                                <li class="nav-item <?php if(request()->is('progress_board/*')): ?> active <?php endif; ?> ">
                                    <a href="<?php echo e(url('progress_board')); ?>" class="nav-link">Progress Board</a>
                                </li>
                            <?php endif; ?>
                            
                            
                            
                            
                            
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-product')): ?>
                                <li class="nav-item <?php if(request()->is('product/product/*')): ?> active <?php endif; ?> ">
                                    <a href="<?php echo e(url('product/product')); ?>" class="nav-link">Product</a>
                                </li>
                            <?php endif; ?>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <li class="dropdown nav-item <?php if(request()->is('mark/mark/*') ||request()->is('priority/priority/*') ||request()->is('roofEstimateCalculator/roof-estimate-calculator/*') ||request()->is('sidingEstimateCalculator/siding-estimate-calculator') ||request()->is('chimneyEstimateCalculator/chimney-estimate-calculator/*') ||request()->is('productPricingEstimateCalculator/product-pricing-estimate-calculator/*') ||request()->is('referralSource/referral-source/*') ||request()->is('advertisement/advertisement/*') ||request()->is('cost_of_lead/*') ||request()->is('announcement/announcement/*')): ?> active <?php endif; ?>">
                                
                                <a class="waves-effect nav-link" href="#calculator" aria-expanded="false" >
                                    <i class="fa fa-calculator"></i>
                                    <span class="hide-menu">Calculator</span>
                                </a>
                                <ul class="collapse submenu" id="calculator" data-bs-parent="#menu">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-roofestimatecalculator')): ?>
                                        <li class="nav-item <?php echo e(request()->is('roof_estimation_calculator/*') ? 'active' : ''); ?>">
                                            <a class="nav-link" href="<?php echo e(url('roofEstimateCalculator/roof-estimate-calculator')); ?>">
                                                <!--                                        <i class="fa fa-envelope"></i>--> Roof Estimation </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-sidingestimatecalculator')): ?>
                                        <li class="nav-item <?php echo e(request()->is('siding_estimation_calculator/*') ? 'active' : ''); ?>">
                                            <a class="nav-link" href="<?php echo e(url('sidingEstimateCalculator/siding-estimate-calculator')); ?>">
                                                <!--                                        <i class="fa fa-envelope"></i>--> Side Estimation </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-chimneyestimatecalculator')): ?>
                                        <li class="nav-item <?php echo e(request()->is('chimney_estimation_calculator/*') ? 'active' : ''); ?>">
                                            <a class="nav-link" href="<?php echo e(url('chimneyEstimateCalculator/chimney-estimate-calculator')); ?>">
                                                <!--                                        <i class="fa fa-envelope"></i>--> Chimney Estimation </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-productpricingestimatecalculator')): ?>
                                        <li class="nav-item <?php echo e(request()->is('product_pricing_estimation_calculator/*') ? 'active' : ''); ?>">
                                            <a class="nav-link" href="<?php echo e(url('productPricingEstimateCalculator/product-pricing-estimate-calculator')); ?>">
                                                <!--                                        <i class="fa fa-envelope"></i>--> Product Pricing Estimation </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            

                        </ul>
                    </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                
                <?php if(auth()->user()->hasRole('subcontractor')): ?>
                    <li>
                        <a class="waves-effect" href="<?php echo e(url('sub_contractor_insurance_info')); ?>" aria-expanded="false">
                            <i class="fa-solid fa-desktop"></i>
                            <span class="hide-menu">Insurance Info</span>
                        </a>
                    </li>
                    <li class="dropdown nav-item">
                        <a class="waves-effect nav-link" href="#WorkOrders" aria-expanded="false">
                            <i class="fa-solid fa-sliders"></i>
                            <span class="hide-menu">Work Orders</span>
                        </a>
                        <ul class="collapse submenu" id="WorkOrders" data-bs-parent="#menu">
                            <li>
                                <a href="<?php echo e(url('work_orders/upcoming')); ?>" class="nav-link">Upcoming</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('work_orders/signed')); ?>" class="nav-link">Signed</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown nav-item">
                        <a class="waves-effect nav-link" href="#Jobs" aria-expanded="false">
                            <i class="fa-solid fa-sliders"></i>
                            <span class="hide-menu">Jobs</span>
                        </a>
                        <ul class="collapse submenu" id="Jobs" data-bs-parent="#menu">
                            <li>
                                <a href="<?php echo e(url('job/active')); ?>" class="nav-link">Active</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('job/complete')); ?>" class="nav-link">Complete</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="waves-effect" href="<?php echo e(url('sub_contractor_finance')); ?>" aria-expanded="false">
                            <i class="fa-solid fa-desktop"></i>
                            <span class="hide-menu">Finance</span>
                        </a>
                    </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(auth()->user()->hasRole('customer')): ?>
                    
                    
                    
                    
                    
                    

                    <li>
                        <a href="<?php echo e(url('dashboard')); ?>/#customer-payments-tab">
                            <i class="fa-solid fa-list"></i>
                            <span class="hide-menu">Job Listings</span>
                        </a>
                    </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!auth()->user()->hasRole('customer')): ?>
                    <li class="dropdown nav-item">
                        <a class="waves-effect nav-link" href="#AccountSettings" aria-expanded="false">
                            <div class="dashboard_icon"> <img src="<?php echo e(asset('website')); ?>/images/Account Setting.svg" loading="lazy" alt=""></div>
                            <span class="hide-menu"> Account Settings</span>
                        </a>
                        <ul class="collapse submenu" id="AccountSettings" data-bs-parent="#menu">
                            <?php if(auth()->user()->hasRole('subcontractor')): ?>
                                <li>
                                    <a href="<?php echo e(url('sub_contractor_profile')); ?>" class="nav-link">Profile</a>
                                </li>
                            <?php else: ?>
                                <li>
                                    <a href="<?php echo e(url('user_profile')); ?>" class="nav-link">Profile</a>
                                </li>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(!auth()->user()->hasRole('subcontractor')): ?>
                                <li>
                                    <a href="<?php echo e(url('change_password')); ?>" class="nav-link">Change Password</a>
                                </li>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(auth()->user()->hasRole('user')): ?>
                                <li>
                                    <a href="<?php echo e(url('terms_and_condition')); ?>" class="nav-link">Terms and conditions</a>
                                </li>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
                <li class="nav-item">
                    <a class="waves-effect nav-link" href="javascript:void(0);" id="signoutButton">
                        <div class="dashboard_icon"> <img src="<?php echo e(asset('website')); ?>/images/Logout.svg" loading="lazy"  alt=""></div>
                        <span class="hide-menu">Signout</span>
                    </a>
                </li>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->isAdmin() == true): ?>
                    <li><hr/></li>
                    <li class="two-column">
                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false">
                            <i class="icon-equalizer fa-fw"></i>
                            <span class="hide-menu"> UI Elements</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li>
                                <a href="<?php echo e(asset('panels-wells')); ?>">
                                    Panels and Wells
                                </a>
                            </li>
                            <li><a href="<?php echo e(asset('panel-ui-block')); ?>">Panels With BlockUI</a></li>
                            <li><a href="<?php echo e(asset('portlet-draggable')); ?>">Draggable Portlet</a></li>
                            <li><a href="<?php echo e(asset('buttons')); ?>">Buttons</a></li>
                            <li><a href="<?php echo e(asset('tabs')); ?>">Tabs</a></li>
                            <li><a href="<?php echo e(asset('modals')); ?>">Modals</a></li>
                            <li><a href="<?php echo e(asset('progressbars')); ?>">Progress Bars</a></li>
                            <li><a href="<?php echo e(asset('notification')); ?>">Notifications</a></li>
                            <li><a href="<?php echo e(asset('carousel')); ?>">Carousel</a></li>
                            <li><a href="<?php echo e(asset('user-cards')); ?>">User Cards</a></li>
                            <li><a href="<?php echo e(asset('timeline')); ?>">Timeline</a></li>
                            <li><a href="<?php echo e(asset('timeline-horizontal')); ?>">Horizontal Timeline</a></li>
                            <li><a href="<?php echo e(asset('range-slider')); ?>">Range Slider</a></li>
                            <li><a href="<?php echo e(asset('ribbons')); ?>">Ribbons</a></li>
                            <li><a href="<?php echo e(asset('steps')); ?>">Steps</a></li>
                            <li><a href="<?php echo e(asset('session-idle-timeout')); ?>">Session Idle Timeout</a></li>
                            <li><a href="<?php echo e(asset('session-timeout')); ?>">Session Timeout</a></li>
                            <li><a href="<?php echo e(asset('bootstrap-ui')); ?>">Bootstrap UI</a></li>
                        </ul>
                    </li>
                    <li class="two-column">
                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-docs fa-fw"></i> <span class="hide-menu"> Pages</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="<?php echo e(asset('starter-page')); ?>">Starter Page</a></li>
                            <li><a href="<?php echo e(asset('blank')); ?>">Blank Page</a></li>
                            <li><a href="<?php echo e(asset('search-result')); ?>">Search Result</a></li>
                            <li><a href="<?php echo e(asset('custom-scroll')); ?>">Custom Scrolls</a></li>
                            <li><a href="<?php echo e(asset('login')); ?>">Login Page</a></li>
                            <li><a href="<?php echo e(asset('lock-screen')); ?>">Lock Screen</a></li>
                            <li><a href="<?php echo e(asset('recoverpw')); ?>">Recover Password</a></li>
                            <li><a href="<?php echo e(asset('animation')); ?>">Animations</a></li>
                            <li><a href="<?php echo e(asset('profile')); ?>">Profile</a></li>
                            <li><a href="<?php echo e(asset('invoice')); ?>">Invoice</a></li>
                            <li><a href="<?php echo e(asset('gallery')); ?>">Gallery</a></li>
                            <li><a href="<?php echo e(asset('pricing')); ?>">Pricing</a></li>
                            <li><a href="<?php echo e(asset('register')); ?>">Register</a></li>
                            <li><a href="<?php echo e(asset('400')); ?>">Error-400</a></li>
                            <li><a href="<?php echo e(asset('403')); ?>">Error-403</a></li>
                            <li><a href="<?php echo e(asset('404')); ?>">Error-404</a></li>
                            <li><a href="<?php echo e(asset('500')); ?>">Error-500</a></li>
                            <li><a href="<?php echo e(asset('503')); ?>">Error-503</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-notebook fa-fw"></i> <span class="hide-menu"> Forms </span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="<?php echo e(asset('form-basic')); ?>">Basic Forms</a></li>
                            <li><a href="<?php echo e(asset('form-layout')); ?>">Form Layout</a></li>
                            <li><a href="<?php echo e(asset('icheck-control')); ?>">Icheck Control</a></li>
                            <li><a href="<?php echo e(asset('form-advanced')); ?>">Form Addons</a></li>
                            <li><a href="<?php echo e(asset('form-upload')); ?>">File Upload</a></li>
                            <li><a href="<?php echo e(asset('form-dropzone')); ?>">File Dropzone</a></li>
                            <li><a href="<?php echo e(asset('form-pickers')); ?>">Form-pickers</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-grid fa-fw"></i> <span class="hide-menu"> Tables</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="<?php echo e(asset('basic-table')); ?>">Basic Tables</a></li>
                            <li><a href="<?php echo e(asset('table-layouts')); ?>">Table Layouts</a></li>
                            <li><a href="<?php echo e(asset('data-table')); ?>">Data Table</a></li>
                            <li><a href="<?php echo e(asset('bootstrap-tables')); ?>">Bootstrap Tables</a></li>
                            <li><a href="<?php echo e(asset('responsive-tables')); ?>">Responsive Tables</a></li>
                            <li><a href="<?php echo e(asset('editable-tables')); ?>">Editable Tables</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-layers fa-fw"></i> <span class="hide-menu"> Extra</span></a>
                        <ul aria-expanded="false" class="collapse extra">
                            <li>
                                <a class="waves-effect" href="javascript:void(0);" aria-expanded="false">
                                    <span class="hide-menu"> Inbox </span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?php echo e(asset('inbox')); ?>">Mail Box</a></li>
                                    <li><a href="<?php echo e(asset('inbox-detail')); ?>">Mail Details</a></li>
                                    <li><a href="<?php echo e(asset('compose')); ?>">Compose Mail</a></li>
                                    <li><a href="<?php echo e(asset('contact')); ?>">Contact</a></li>
                                    <li><a href="<?php echo e(asset('contact-detail')); ?>">Contact Detail</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo e(asset('calendar')); ?>" aria-expanded="false"><span
                                            class="hide-menu">Calendar</span></a>
                            </li>
                            <li>
                                <a href="<?php echo e(asset('widgets')); ?>" aria-expanded="false"><span
                                            class="hide-menu"> Widgets </span></a>
                            </li>
                            <li>
                                <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><span
                                            class="hide-menu"> Charts</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?php echo e(asset('morris-chart')); ?>">Morris Chart</a></li>
                                    <li><a href="<?php echo e(asset('peity-chart')); ?>">Peity Charts</a></li>
                                    <li><a href="<?php echo e(asset('knob-chart')); ?>">Knob Charts</a></li>
                                    <li><a href="<?php echo e(asset('sparkline-chart')); ?>">Sparkline charts</a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><span
                                            class="hide-menu"> Icons</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?php echo e(asset('simple-line')); ?>">Simple Line</a></li>
                                    <li><a href="<?php echo e(asset('fontawesome')); ?>">Fontawesome</a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><span
                                            class="hide-menu"> Maps</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?php echo e(asset('map-google')); ?>">Google Map</a></li>
                                    <li><a href="<?php echo e(asset('map-vector')); ?>">Vector Map</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </ul>
            <button class="btn-offcanvas"> ☰ </button>
        </nav>
    </div>
</aside>
<?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/layouts/partials/sidebar.blade.php ENDPATH**/ ?>