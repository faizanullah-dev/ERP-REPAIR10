
<?php $__env->startPush('css'); ?>
    <link href="<?php echo e(asset('plugins/components/morrisjs/morris.css')); ?>" rel="stylesheet">

    <style>
        .info-box .info-count {
            margin-top: 0px !important;
        }

        .checkbox_line .collapse.in {
            display: inline !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"  />
    <!-- Include Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasRole('admin')): ?>
        <div class="row m-0">
            <div class="col-md-3 col-sm-6 info-box">
                <div class="media">
                    <div class="media-left">
                        <span class="icoleaf bg-primary text-white"><i class="mdi mdi-checkbox-marked-circle-outline"></i></span>
                    </div>
                    <div class="media-body">
                        <h3 class="info-count text-blue">154</h3>
                        <p class="info-text font-12">Bookings</p>
                        <span class="hr-line"></span>
                        <p class="info-ot font-15">Target<span class="label label-rounded label-success">300</span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 info-box">
                <div class="media">
                    <div class="media-left">
                        <span class="icoleaf bg-primary text-white"><i class="mdi mdi-comment-text-outline"></i></span>
                    </div>
                    <div class="media-body">
                        <h3 class="info-count text-blue">68</h3>
                        <p class="info-text font-12">Complaints</p>
                        <span class="hr-line"></span>
                        <p class="info-ot font-15">Total Pending<span
                                    class="label label-rounded label-danger">154</span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 info-box">
                <div class="media">
                    <div class="media-left">
                        <span class="icoleaf bg-primary text-white"><i class="mdi mdi-coin"></i></span>
                    </div>
                    <div class="media-body">
                        <h3 class="info-count text-blue">&#36;9475</h3>
                        <p class="info-text font-12">Earning</p>
                        <span class="hr-line"></span>
                        <p class="info-ot font-15">March : <span class="text-blue font-semibold">&#36;514578</span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 info-box b-r-0">
                <div class="media">
                    <div class="media-left p-r-5">
                        <div id="earning" class="e" data-percent="60">
                            <div id="pending" class="p" data-percent="55"></div>
                            <div id="booking" class="b" data-percent="50"></div>
                        </div>
                    </div>
                    <div class="media-body">
                        <h2 class="text-blue font-22 m-t-0">Report</h2>
                        <ul class="p-0 m-b-20">
                            <li><i class="fa fa-circle m-r-5 text-primary"></i>60% Earnings</li>
                            <li><i class="fa fa-circle m-r-5 text-primary"></i>55% Pending</li>
                            <li><i class="fa fa-circle m-r-5 text-info"></i>50% Bookings</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <div class="white-box stat-widget">
                        <div class="row">
                            <div class="col-md-3 col-sm-3">
                                <h4 class="box-title">Statistics</h4>
                            </div>
                            <div class="col-md-9 col-sm-9">
                                <select class="custom-select">
                                    <option selected value="0">Feb 04 - Mar 03</option>
                                    <option value="1">Mar 04 - Apr 03</option>
                                    <option value="2">Apr 04 - May 03</option>
                                    <option value="3">May 04 - Jun 03</option>
                                </select>
                                <ul class="list-inline">
                                    <li>
                                        <h6 class="font-15"><i class="fa fa-circle m-r-5 text-success"></i>New Sales
                                        </h6>
                                    </li>
                                    <li>
                                        <h6 class="font-15"><i class="fa fa-circle m-r-5 text-primary"></i>Existing
                                            Sales</h6>
                                    </li>
                                </ul>
                            </div>
                            <div class="stat chart-pos"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="white-box">
                        <h4 class="box-title">Task Progress</h4>
                        <div class="task-widget t-a-c">
                            <div class="task-chart" id="sparklinedashdb"></div>
                            <div class="task-content font-16 t-a-c">
                                <div class="col-sm-6 b-r">
                                    Urgent Tasks
                                    <h1 class="text-primary">05 <span class="font-16 text-muted">Tasks</span></h1>
                                </div>
                                <div class="col-sm-6">
                                    Normal Tasks
                                    <h1 class="text-primary">03 <span class="font-16 text-muted">Tasks</span></h1>
                                </div>
                            </div>
                            <div class="task-assign font-16">
                                Assigned To
                                <ul class="list-inline">
                                    <li class="p-l-0">
                                        <img src="<?php echo e(asset('plugins/images/users/1.png')); ?>" alt="user"
                                             data-toggle="tooltip"
                                             data-placement="top" title="" data-original-title="Steave">
                                    </li>
                                    <li>
                                        <img src="<?php echo e(asset('plugins/images/users/2.png')); ?>" alt="user"
                                             data-toggle="tooltip"
                                             data-placement="top" title="" data-original-title="Steave">
                                    </li>
                                    <li>
                                        <img src="<?php echo e(asset('plugins/images/users/3.png')); ?>" alt="user"
                                             data-toggle="tooltip"
                                             data-placement="top" title="" data-original-title="Steave">
                                    </li>
                                    <li class="p-r-0">
                                        <a href="javascript:void(0);" class="btn btn-success font-16">3+</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="white-box bg-primary color-box">
                        <h1 class="text-white font-light">&#36;6547 <span class="font-14">Revenue</span></h1>
                        <div class="ct-revenue chart-pos"></div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="white-box bg-success color-box">
                        <h1 class="text-white font-light m-b-0">5247</h1>
                        <span class="hr-line"></span>
                        <p class="cb-text">current visits</p>
                        <h6 class="text-white font-semibold">+25% <span class="font-light">Last Week</span></h6>
                        <div class="chart">
                            <div class="ct-visit chart-pos"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="white-box bg-danger color-box">
                        <h1 class="text-white font-light m-b-0">25%</h1>
                        <span class="hr-line"></span>
                        <p class="cb-text">Finished Tasks</p>
                        <h6 class="text-white font-semibold">+15% <span class="font-light">Last Week</span></h6>
                        <div class="chart">
                            <input class="knob" data-min="0" data-max="100" data-bgColor="#f86b4a"
                                   data-fgColor="#ffffff"
                                   data-displayInput=false data-width="96" data-height="96" data-thickness=".1"
                                   value="25"
                                   readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box user-table">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="box-title">Table Format/User Data</h4>
                            </div>
                            <div class="col-sm-6">
                                <ul class="list-inline">
                                    <li>
                                        <a href="javascript:void(0);" class="btn btn-default btn-outline font-16"><i
                                                    class="fa fa-trash" aria-hidden="true"></i></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="btn btn-default btn-outline font-16"><i class="fa fa-commenting" aria-hidden="true"></i></a>
                                    </li>
                                </ul>
                                <select class="custom-select">
                                    <option selected>Sort by</option>
                                    <option value="1">Name</option>
                                    <option value="2">Location</option>
                                    <option value="3">Type</option>
                                    <option value="4">Role</option>
                                    <option value="5">Action</option>
                                </select>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>
                                        <div class="checkbox checkbox-info">
                                            <input id="c1" type="checkbox">
                                            <label for="c1"></label>
                                        </div>
                                    </th>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Type</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="checkbox checkbox-info">
                                            <input id="c2" type="checkbox">
                                            <label for="c2"></label>
                                        </div>
                                    </td>
                                    <td><a href="javascript:void(0);" class="text-link">Daniel Kristeen</a></td>
                                    <td>Texas, US</td>
                                    <td>Posts 564</td>
                                    <td><span class="label label-success">Admin</span></td>
                                    <td>
                                        <select class="custom-select">
                                            <option value="1">Modulator</option>
                                            <option value="2">Admin</option>
                                            <option value="3">Staff</option>
                                            <option value="4">User</option>
                                            <option value="5">General</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox checkbox-info">
                                            <input id="c3" type="checkbox">
                                            <label for="c3"></label>
                                        </div>
                                    </td>
                                    <td><a href="javascript:void(0);" class="text-link">Hanna Gover</a></td>
                                    <td>Los Angeles, US</td>
                                    <td>Posts 451</td>
                                    <td><span class="label label-info">Staff</span></td>
                                    <td>
                                        <select class="custom-select">
                                            <option value="1">Modulator</option>
                                            <option value="2">Admin</option>
                                            <option value="3">Staff</option>
                                            <option value="4">User</option>
                                            <option value="5">General</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox checkbox-info">
                                            <input id="c4" type="checkbox">
                                            <label for="c4"></label>
                                        </div>
                                    </td>
                                    <td><a href="javascript:void(0);" class="text-link">Jeffery Brown</a></td>
                                    <td>Houston, US</td>
                                    <td>Posts 978</td>
                                    <td><span class="label label-danger">User</span></td>
                                    <td>
                                        <select class="custom-select">
                                            <option value="1">Modulator</option>
                                            <option value="2">Admin</option>
                                            <option value="3">Staff</option>
                                            <option value="4">User</option>
                                            <option value="5">General</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox checkbox-info">
                                            <input id="c5" type="checkbox">
                                            <label for="c5"></label>
                                        </div>
                                    </td>
                                    <td><a href="javascript:void(0);" class="text-link">Elliot Dugteren</a></td>
                                    <td>San Antonio, US</td>
                                    <td>Posts 34</td>
                                    <td><span class="label label-warning">General</span></td>
                                    <td>
                                        <select class="custom-select">
                                            <option value="1">Modulator</option>
                                            <option value="2">Admin</option>
                                            <option value="3">Staff</option>
                                            <option value="4">User</option>
                                            <option value="5">General</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox checkbox-info">
                                            <input id="c6" type="checkbox">
                                            <label for="c6"></label>
                                        </div>
                                    </td>
                                    <td><a href="javascript:void(0);" class="text-link">Sergio Milardovich</a></td>
                                    <td>Jacksonville, US</td>
                                    <td>Posts 31</td>
                                    <td><span class="label label-primary">Partial</span></td>
                                    <td>
                                        <select class="custom-select">
                                            <option value="1">Modulator</option>
                                            <option value="2">Admin</option>
                                            <option value="3">Staff</option>
                                            <option value="4">User</option>
                                            <option value="5">General</option>
                                        </select>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <ul class="pagination">
                            <li class="disabled"><a href="#">1</a></li>
                            <li class="active"><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                        </ul>
                        <a href="javascript:void(0);" class="btn btn-success pull-right m-t-10 font-20">+</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="white-box">
                        <div class="task-widget2">
                            <div class="task-image">
                                <img src="<?php echo e(asset('plugins/images/task.jpg')); ?>" alt="task" class="img-responsive">
                                <div class="task-image-overlay"></div>
                                <div class="task-detail">
                                    <h2 class="font-light text-white m-b-0">07 April</h2>
                                    <h4 class="font-normal text-white m-t-5">Your tasks for today</h4>
                                </div>
                                <div class="task-add-btn">
                                    <a href="javascript:void(0);" class="btn btn-success">+</a>
                                </div>
                            </div>
                            <div class="task-total">
                                <p class="font-16 m-b-0"><strong>5</strong> Tasks for <a href="javascript:void(0);"
                                                                                         class="text-link">Jon Doe</a>
                                </p>
                            </div>
                            <div class="task-list">
                                <ul class="list-group">
                                    <li class="list-group-item bl-info">
                                        <div class="checkbox checkbox-success">
                                            <input id="c7" type="checkbox">
                                            <label for="c7">
                                                <span class="font-16">Create invoice for customers and email each customers.</span>
                                            </label>
                                            <h6 class="p-l-30 font-bold">05:00 PM</h6>
                                        </div>
                                    </li>
                                    <li class="list-group-item bl-warning">
                                        <div class="checkbox checkbox-success">
                                            <input id="c8" type="checkbox" checked>
                                            <label for="c8">
                                        <span class="font-16">Send payment of <strong>&#36;500 invoised</strong> on 23
                                            May to <a href="javascript:void(0);" class="text-link">Daniel Kristeen</a>
                                            via paypal.</span>
                                            </label>
                                            <h6 class="p-l-30 font-bold">03:00 PM</h6>
                                        </div>
                                    </li>
                                    <li class="list-group-item bl-danger">
                                        <div class="checkbox checkbox-success">
                                            <input id="c9" type="checkbox">
                                            <label for="c9">
                                        <span class="font-16">It is a long established fact that a reader will be
                                            distracted by the readable.</span>
                                            </label>
                                            <h6 class="p-l-30 font-bold">04:45 PM</h6>
                                        </div>
                                    </li>
                                    <li class="list-group-item bl-success">
                                        <div class="checkbox checkbox-success">
                                            <input id="c10" type="checkbox">
                                            <label for="c10">
                                        <span class="font-16">It is a long established fact that a reader will be
                                            distracted by the readable.</span>
                                            </label>
                                            <h6 class="p-l-30 font-bold">05:30 PM</h6>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="task-loadmore">
                                <a href="javascript:void(0);" class="btn btn-default btn-outline btn-rounded">Load
                                    More</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="white-box chat-widget">
                        <a href="javascript:void(0);" class="pull-right"><i class="icon-settings"></i></a>
                        <h4 class="box-title">Chat</h4>
                        <ul class="chat-list slimscroll" style="overflow: hidden;" tabindex="5005">
                            <li>
                                <div class="chat-image"><img alt="male"
                                                             src="<?php echo e(asset('plugins/images/users/hanna.jpg')); ?>"></div>
                                <div class="chat-body">
                                    <div class="chat-text">
                                        <p><span class="font-semibold">Hanna Gover</span> Hey Daniel, This is just a
                                            sample chat. </p>
                                    </div>
                                    <span>2 Min ago</span>
                                </div>
                            </li>
                            <li class="odd">
                                <div class="chat-body">
                                    <div class="chat-text">
                                        <p> buddy </p>
                                    </div>
                                    <span>2 Min ago</span>
                                </div>
                            </li>
                            <li>
                                <div class="chat-image"><img alt="male"
                                                             src="<?php echo e(asset('plugins/images/users/hanna.jpg')); ?>"></div>
                                <div class="chat-body">
                                    <div class="chat-text">
                                        <p><span class="font-semibold">Hanna Gover</span> Bye now. </p>
                                    </div>
                                    <span>1 Min ago</span>
                                </div>
                            </li>
                            <li class="odd">
                                <div class="chat-body">
                                    <div class="chat-text">
                                        <p> We have been busy all the day to make your website proposal and finally came
                                            with the super excited offer. </p>
                                    </div>
                                    <span>5 Sec ago</span>
                                </div>
                            </li>
                        </ul>
                        <div class="chat-send">
                            <input type="text" class="form-control" placeholder="Write your message">
                            <i class="fa fa-camera"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ===== Right-Sidebar ===== -->
            
            <!-- ===== Right-Sidebar-End ===== -->
        </div>
    <?php else: ?>

        <section class="dashboard_top_bar">
            <div class="container-fluid">
                <div class="row check_on_sec">
                    <div class="col-md-12">
                        <div class="top_stats_cards">
                            <div class="row">
                                <div class="col-md-4">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!auth()->user()->hasRole(['admin', 'customer'])): ?>
                                        <div class="card custom_flex">
                                            <div>
                                                <h5>Session Control</h5>
                                                <h6>Check-in Time</h6>
                                                <p class="timer_counts">
                                                    <span class="check_in_time"></span>
                                                </p>
                                            </div>
                                            <div class="btns">
                                                <button id="playBtn" class="btn btn-main checkin_btn">
                                                    <span>Check-in</span><i class="fa-solid fa-play"></i>
                                                </button>
                                                <button id="pauseBtn" class="btn pause_btn btn-hidden">
                                                    <span>Pause</span><i class="fa-solid fa-pause"></i>
                                                </button>
                                                <button id="resumeBtn" class="btn resume_btn btn-hidden">
                                                    <span>Resume</span><i class="fa-solid fa-play"></i>
                                                </button>
                                                <button id="checkOutBtn" class="btn check_out_btn btn-hidden" disabled>
                                                    <span>Check-out</span><i class="fa-solid fa-stop"></i>
                                                </button>
                                            </div>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <div class="col-md-4">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!auth()->user()->hasRole(['admin', 'customer'])): ?>
                                        <div class="card line_before_card">
                                            <h5>Timer</h5>
                                            <p class="timer_counts">
                                                <span class="achieved_amount hours">00</span>
                                                <span>:</span>
                                                <span class="achieved_amount minutes">00</span>
                                                <span>:</span>
                                                <span class="achieved_amount seconds">00</span>
                                            </p>
                                            <p class="total_time">
                                                <span>
                                                  Today Total Hours: <span id="totalHours">00:00:00</span>
                                                </span>
                                            </p>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <div class="col-md-4">
                                    <form class="card year_select_box form-group line_before_card">
                                        <h5>Year Filter</h5>
                                        <select id="yearSelect" class=" form-control">
                                            <option selected disabled>--Select Year--</option>
                                            <option value="all_year">All Year</option>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $yearEstimations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value->year); ?>"
                                                        <?php echo e((request('year') == $value->year || (!request('year') && $yearEstimation->year == $value->year)) ? 'selected' : ''); ?>>
                                                    <?php echo e($value->year ?? ""); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="inner_section_timeline">
                            <div class="timelines">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $stages->sortBy('position'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="single_timeline   checked " data-index="<?php echo e(++$key); ?>">
                                        <style>
                                            .timelines .single_timeline.checked[data-index="<?php echo e($key); ?>"] .timeline_title:after {
                                                background-color: <?php echo e($value->colour_id); ?>

                                }
                                            .timelines .single_timeline.checked[data-index="<?php echo e($key); ?>"] .timeline_bar:before {
                                                background-color: <?php echo e($value->colour_id); ?>;
                                                border-color: <?php echo e($value->colour_id); ?>

                                }
                                        </style>
                                        
                                        
                                        
                                        
                                        
                                        <a href="<?php echo e(request('year') ? route('lead_by_stages') . '/' . $value->id . '/' . request('year') : route('lead_by_stages') . '/' . $value->id); ?>">
                                            <div class="timeline_title" style="background-color: <?php echo e($value->colour_id); ?>">
                                                <span><?php echo e($value->name ?? ""); ?></span>
                                            </div>
                                        </a>

                                        <div class="timeline_bar" style="background-color: <?php echo e($value->colour_id); ?>"></div>
                                        <?php
                                            $selectedYear = request('year') ?? date('Y');
                                          if (auth()->user()->hasRole('staff')){
                                                $leadCount = \App\Lead::where('stage_id', $value->id)->where('representative_id', auth()->user()->id)->count();
                                                $leadPrice =  \App\Lead::where('stage_id', $value->id)->where('representative_id', auth()->user()->id)->sum('lead_price');
                                          }elseif(auth()->user()->hasRole('user')){
                                              if($selectedYear)
                                                 $leadCount = \App\Lead::where('stage_id', $value->id)->where('lead_date', $selectedYear)->count();
                                                 $leadPrice =  \App\Lead::where('stage_id', $value->id)->where('lead_date', $selectedYear)->sum('lead_price');
                                                   $changeOrderTotalAmount = \App\ChangeOrder::whereHas('getLead', function ($query) use ($value) {
                                                    $query->where('stage_id', $value->id)
                                                          ->where('lead_status', 'won');
                                                })
                                                        ->where('status', 'approved')
                                                        ->sum('total_amount');
                                          }else{
                                                $leadCount = \App\Lead::where('stage_id', $value->id)->where('representative_id', auth()->user()->id)->count();
                                                $leadPrice =  \App\Lead::where('stage_id', $value->id)->where('representative_id', auth()->user()->id)->sum('lead_price');
                                                $changeOrderTotalAmount = \App\ChangeOrder::whereHas('getLead', function ($query) use ($value) {
                                                    $query->where('stage_id', $value->id)
                                                          ->where('lead_status', 'won');
                                                })
                                                        ->where('status', 'approved')
                                                        ->sum('total_amount');
                                          }
                                        ?>
                                        <div class="timeline_date">
                                <span class="completed_timeline">

                                    <?php echo $value->stageCount??""; ?>

                                </span>
                                        </div>
                                        <div class="timeline_date">
                                <span class="completed_timeline">

                                   $<?php echo e(number_format($value->LeadPrice ?? 0, 2)); ?>

                                </span>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="single_timeline">
                                        <div class="timeline_title">
                                            <span>No Stage Available</span>
                                        </div>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="number_cards_announcement px-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-7">
                        <div class="number_cards_section">
                            <div class=".number_cards_Row row">
                                <div class="col-md-4">
                                    <div class="number_card card1 card_bg_img">
                                        <p class="p-22">Total Leads</p>
                                        
                                        
                                        
                                        
                                        
                                        
                                        <h1 class="number">
                                            <?php echo e($lead->filter(function ($item) use($year) {
                                                    $selectedYear = request('year') ?? $year; // Use request('year') if available, otherwise use $year
                                                    if (request('year') === 'all_year') {
                                                        return true; // Include all items
                                                    }
                                                    return \Carbon\Carbon::parse($item->lead_date)->year == $selectedYear;
                                                })->count() ?? "00"); ?>

                                        </h1>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="number_card card2 card_bg_img">
                                        <p class="p-22">Success Leads</p>
                                        <?php
                                            $selectedYear = request('year');
                                            $user = auth()->user();
                                            $isUser = $user->hasRole('user');
                                            $query = $successLead;
                                           if ($isUser) {
                                            $count = $query;
                                             if ($selectedYear === 'all_year') {
                                                $count = \App\Lead::where('lead_status', 'won')->count();
                                            } elseif ($selectedYear) {
                                                $count = \App\Lead::whereYear('lead_status_date', $selectedYear)->where('lead_status', 'won')->count(); // Ensure $query is a query builder
                                            } else {
                                                $count = $query->count();
                                            }
                                            } else {
                                                $isCustomer = $user->hasRole('customer');
                                                if ($isCustomer) {
                                                    $count = $query->where('customer_id', $user->id)->count();
                                                } else {
                                                    $count = $query->where('representative_id', $user->id)->count();
                                                }
                                            }
                                        ?>
                                        <h1 class="number"><?php echo e($count); ?></h1>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="number_card card3 card_bg_img">
                                        <p class="p-22">Unconverted Leads</p>
                                        <?php
                                            $selectedYear = request('year');
                                            $user = auth()->user();
                                            $query = $lead->where('lead_status', '==', 'pending');
                                            if ($user->hasRole('user')) {
//                                                $count = $query->whereYear('lead_date', $year)->count();
                                             if ($selectedYear === 'all_year') {
                                                $count = $query->count();
                                            }elseif($selectedYear){
                                                     $count = $query->filter(function ($item) use ($selectedYear) {
                                                    return \Carbon\Carbon::parse($item->lead_date)->year == $selectedYear;
                                                })->count();
                                             }else{
                                                    $count = $query->filter(function ($item) use ($year) {
                                                    return \Carbon\Carbon::parse($item->lead_date)->year == $year;
                                                })->count();
                                             }
                                            } else {
                                                $isCustomer = $user->hasRole('customer'); // Adjust based on your role logic
                                                if ($isCustomer) {
                                                    $count = $query->where('customer_id', $user->id)->count();
                                                } else {
                                                    $count = $query->where('representative_id', $user->id)->count();
                                                }
                                            }//ends here.
                                        ?>
                                        <h1 class="number"><?php echo e($count); ?></h1>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="number_card card4 card_bg_img">
                                        <p class="p-22">Total Customer</p>
                                        <h1 class="number"><?php echo e(\App\User::whereHas('roles', function($q){$q->where('name','customer');})->count()??"00"); ?></h1>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="number_card card5 card_bg_img">
                                        <p class="p-22">Achieved Amount</p>
                                        <?php
                                            $selectedYear = request('year');
                                             if ($selectedYear === 'all_year') {
                                               $query = \App\Lead::where('lead_status', 'won')->sum('lead_price');
                                               $changeOrderTotalAmount = \App\ChangeOrder::whereHas('getLead', function ($query) use ($selectedYear) {
                                                   $query->where('lead_status', 'won');
                                           })
                                           ->where('status', 'approved')
                                           ->sum('total_amount');
                                           $count = $query + $changeOrderTotalAmount;
                                           }elseif($selectedYear){
                                                  $query = \App\Lead::whereYear('lead_status_date', $selectedYear)->where('lead_status', 'won')->sum('lead_price');
                                                    $changeOrderTotalAmount = \App\ChangeOrder::whereHas('getLead', function ($query) use ($selectedYear) {
                                                       $query->whereYear('lead_status_date', $selectedYear)
                                                             ->where('lead_status', 'won');
                                           })
                                           ->where('status', 'approved')
                                           ->sum('total_amount');
                                            $count = $query + $changeOrderTotalAmount;
                                            }else{
                                            $query = \App\Lead::whereYear('lead_status_date', $year)->where('lead_status', 'won')->sum('lead_price');
                                            $changeOrderTotalAmount = \App\ChangeOrder::whereHas('getLead', function ($query) use ($year) {
                                               $query->whereYear('lead_status_date', $year)
                                                     ->where('lead_status', 'won');
                                           })
                                           ->where('status', 'approved')
                                           ->sum('total_amount');
                                            }
                                            $count = $query + $changeOrderTotalAmount
                                        ?>
                                        <h1 class="number">$<?php echo e(number_format($count ?? 0, 2)); ?></h1>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="number_card card6 card_bg_img">
                                        <p class="p-22">This Year Target</p>
                                        
                                        <?php
                                            $selectedYear = request()->query('year');
                                            if ($selectedYear === 'all_year') {
                                                $totalEstimate = $yearEstimations->sum('estimate_amount');
                                            } else {
                                                $selectedEstimation = $yearEstimations->firstWhere('year', $selectedYear);
                                                $totalEstimate = isset($selectedEstimation) ? $selectedEstimation->estimate_amount : ($yearEstimation->estimate_amount ?? 0);
                                            }
                                        ?>
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        <h2 class="number green-text">
                                            $<?php echo e(number_format($totalEstimate ?? 0, 2)); ?>


                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="announcement_box">
                            <div class="card-headerr">
                                <h5>Activities</h5>
                                
                                <a data-bs-toggle="tooltip" data-bs-placement="left" title="Read Description Below">
                                    <i class="fa fa-info-circle"></i>
                                </a>
                            </div>
                            <div class="card-body">
                                <?php if(!auth()->user()->hasRole('admin')): ?>
                                    <div class="activities">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($notificationList->count() > 0): ?>
                                            <div class="scrollable-content" style="height: 300px">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $notificationList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="<?php echo e(url('view_lead')); ?>/<?php echo e($notification->lead_id); ?>">
                                                        <div class="message-center" data-status="unseen" data-notification-id="<?php echo e($notification->id); ?>" id="notification_status">
                                                            <div class="message_icon_parent">
                                                                <div class="message_icon_container">
                                                                    <i class="<?php echo e($notification->icon ??''); ?>"></i>
                                                                </div>
                                                            </div>
                                                            <div class="mail-contnet">
                                                                <div class="message_heading_time">
                                                                    <h6> <?php echo e($notification->model); ?></h6>
                                                                    <span class="time"><?php echo e($notification->created_at->format('l, h:i A M-d-Y')); ?></span>
                                                                </div>
                                                                <span class="mail-desc">
                                                            <?php echo $notification->title; ?> <?php echo e($notification->user->name??""); ?>.
                                                        </span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Clock On Clock Off SECTION -->

        <!-- CALENDAR SECTION -->
        <section class="calendar">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card borderRadius20 box-shadow-card border-0 mt-5">
                            <div class="card-headerr calendar_sec_heading">
                                <h4>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('year')): ?>
                                        <?php echo e(request('year')); ?>

                                    <?php elseif(isset($yearEstimation->year) && $yearEstimation->year): ?>
                                        <?php echo e($yearEstimation->year); ?>

                                    <?php else: ?>
                                        #
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </h4>
                            </div>
                            <div class="card-body calendar_wrapper">
                                <div class="row calendar_row">
                                    <?php
                                        $selectedYear = request()->query('year') ?? ($yearEstimation->year ?? now()->year);
                                        if ($selectedYear === 'all_year') {
                                            $yearEstimations = \App\YearEstimation::all();
                                            $selectedYears = $yearEstimations->pluck('year')->toArray();
                                        } else {
                                            $yearEstimations = collect([\App\YearEstimation::where('year', $selectedYear)->first()]);
                                            $selectedYears = [$selectedYear];
                                        }
                                        $monthlyAggregatedData = [];
                                      foreach ($selectedYears as $year) {
                                        $yearData = \App\YearEstimation::where('year', $year)->first();
                                        if ($yearData) {
                                            foreach ($yearData->months as $key => $monthData) {
                                                $monthIndex = $key + 1; // Convert to 1-based index (January = 1)
                                                $monthName = date('F', mktime(0, 0, 0, $monthIndex, 10));
                                                if (!isset($monthlyAggregatedData[$monthName])) {
                                                    $monthlyAggregatedData[$monthName] = [
                                                        'percentage' => 0,
                                                        'amount' => 0,
                                                        'production' => 0,
                                                        'production_percentage' => 0,
                                                        'lead_id' => [], // Add the lead_titles array here
                                                        'weeks' => [
                                                            'week1' => ['percentage' => 0, 'amount' => 0],
                                                            'week2' => ['percentage' => 0, 'amount' => 0],
                                                            'week3' => ['percentage' => 0, 'amount' => 0],
                                                            'week4' => ['percentage' => 0, 'amount' => 0],
                                                        ],
                                                    ];
                                                }
                                                    $monthlyAggregatedData[$monthName]['percentage'] += $monthData->percentage ?? 0;
                                                    $monthlyAggregatedData[$monthName]['amount'] += $monthData->amount ?? 0;
                                                    $productionAmount = \App\Lead::where('lead_status', 'won')
                                                        ->whereMonth('lead_status_date', $monthIndex)
                                                        ->whereYear('lead_status_date', $year)
                                                        ->with(['getChangeOrder' => function ($query) {
                                                            $query->where('status', 'approved');
                                                        }])
                                                        ->get()
                                                        ->sum(function ($item) use (&$monthlyAggregatedData, $monthName) {
                                                            $monthlyAggregatedData[$monthName]['lead_id'][] = $item->id;
                                                            return (float)$item->lead_price + (float)$item->getChangeOrder->sum('total_amount');
                                                        }) ?? 0;
                                                    $monthlyAggregatedData[$monthName]['production'] += $productionAmount;
                                                    if ($monthlyAggregatedData[$monthName]['amount'] > 0) {
                                                        $monthlyAggregatedData[$monthName]['production_percentage'] =
                                                            ($productionAmount / $monthlyAggregatedData[$monthName]['amount']) * 100;
                                                    }
                                                    for ($week = 1; $week <= 4; $week++) {
                                                        $weekStart = ($week - 1) * 7 + 1;
                                                        $weekEnd = $week * 7;
                                                        $weeklyProduction = \App\Lead::where('lead_status', 'won')
                                                            ->whereMonth('lead_status_date', $monthIndex)
                                                            ->whereYear('lead_status_date', $year)
                                                            ->whereDay('lead_status_date', '>=', $weekStart)
                                                            ->whereDay('lead_status_date', '<=', $weekEnd)
                                                            ->with(['getChangeOrder' => function ($query) {
                                                                $query->where('status', 'approved');
                                                            }])
                                                            ->get()
                                                            ->sum(function ($item) {
                                                                return (float)$item->lead_price + (float)$item->getChangeOrder->sum('total_amount');
                                                            }) ?? 0;
                                                        $monthlyAggregatedData[$monthName]['weeks']['week' . $week]['amount'] += $weeklyProduction;
                                                        if ($monthlyAggregatedData[$monthName]['amount'] > 0) {
                                                            $monthlyAggregatedData[$monthName]['weeks']['week' . $week]['percentage'] =
                                                                ($weeklyProduction / $monthlyAggregatedData[$monthName]['amount']) * 100;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    ?>
                                    
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($yearEstimations) && count($monthlyAggregatedData) > 0): ?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $monthlyAggregatedData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $monthName => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-xl-3 col-lg-4 col-md-6">
                                                <div class="single_calendar_box">
                                                    <div>
                                                        <h5><?php echo e($monthName); ?></h5>
                                                        <ul class="nav nav-tabs customtab2" role="tablist">
                                                            <li role="presentation" class="active">
                                                                <a href="#monthly<?php echo e($monthName); ?>" class="monthly<?php echo e($monthName); ?>" role="tab" data-toggle="tab">Monthly</a>
                                                            </li>
                                                            <li role="presentation">
                                                                <a href="#weekly<?php echo e($monthName); ?>" class="week-btn" data-weekly="<?php echo e(json_encode($data['weeks'])); ?>"  data-key="<?php echo e($monthName); ?>" role="tab" data-toggle="tab">
                                                                    <i class="fa-solid fa-chart-column"></i> Weekly
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <div class="tab-content">
                                                            <div role="tabpanel" class="tab-pane active" id="monthly<?php echo e($monthName); ?>">
                                                                <div class="calendar_content">
                                                                    <h6>Goal</h6>
                                                                    <p>
                                                                        <span class="green-text"><?php echo e($data['percentage']); ?>%</span>
                                                                        <span>|</span>
                                                                        <span class="green-text monthly_amount">$<?php echo e(number_format($data['amount'] ?? 0, 2)); ?></span>
                                                                    </p>
                                                                </div>
                                                                <div class="calendar_content">
                                                                    <h6>Production</h6>
                                                                    <p>
                                                                        <span class="green-text productionPercentage"><?php echo e(round($data['production_percentage'], 2)); ?>%</span>
                                                                        <span>|</span>
                                                                        <span class="green-text achieved_amount" data-lead-id="<?php echo e(implode(', ', $data['lead_id'])); ?>">
                                                                           $<?php echo e(number_format($data['production'] ?? 0, 2)); ?>

                                                                        </span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div role="tabpanel" class="tab-pane" id="weekly<?php echo e($monthName); ?>">
                                                                <div class="calendar_content">
                                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($week = 1; $week <= 4; $week++): ?>
                                                                        <span>
                                                                            <p class="week-count"><?php echo e($week); ?>ST Week</p>
                                                                            <span class="green-text weekly_percentage">0%</span>
                                                                            <span>|</span>
                                                                            <span class="green-text weekly_amount">$0.00</span>
                                                                        </span>
                                                                    <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php else: ?>
                                        
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 1; $i <= 12; $i++): ?>
                                            <div class="col-xl-3 col-lg-4 col-md-6">
                                                <div class="single_calendar_box">
                                                    <div class="calendar_month"
                                                         style="background-image: <?php echo e(asset('website')); ?>/images/calendar.png;">
                                                        <p><?php echo e(date('F', mktime(0, 0, 0, $i, 10))); ?></p>
                                                    </div>
                                                    <div class="calendar_content">
                                                        <p><span>NOT FOUND</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="graphs px-5">
            <div class="container=fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card borderRadius20 box-shadow-card border-0 mt-5">
                            <div class="card-headerr">
                                <h4>Yearly Report</h4>
                                <ul class="nav nav-tabs customtab2 " role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#yearly_line_chart" aria-controls="" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa-solid fa-chart-line"></i> Line Chart  </a>
                                    </li>
                                    <li role="presentation" class="">
                                        <a href="#yearly_pie_chart" aria-controls="" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa-solid fa-chart-pie"></i>  Pie Chart  </a>
                                    </li>
                                    <li role="presentation" class="">
                                        <a href="#yearly_bar_chart" aria-controls="" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa-solid fa-chart-column"></i> Bar Chart  </a>
                                    </li>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                </ul>
                            </div>
                            <div class="card-body ">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="yearly_line_chart">
                                        <div id="morris-area-chart_1" style="height: 400px; width: 100%;"></div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="yearly_pie_chart">
                                        <canvas id="yearlyReportPiechart" width="400" height="400"></canvas>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="yearly_bar_chart">
                                        <canvas id="YearlyReportBarChart" ></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card borderRadius20 box-shadow-card border-0 mt-5">
                            <div class="card-headerr">
                                <h4>Monthly Earning</h4>
                                <ul class="nav nav-tabs customtab2 " role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#monthly_line_chart" aria-controls="" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa-solid fa-chart-line"></i> Line Chart  </a>
                                    </li>
                                    <li role="presentation" class="">
                                        <a href="#monthly_pie_chart" aria-controls="" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa-solid fa-chart-pie"></i> Pie Chart  </a>
                                    </li>
                                    <li role="presentation" class="">
                                        <a href="#monthly_bar_chart" aria-controls="" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa-solid fa-chart-column"></i> Bar Chart  </a>
                                    </li>
                                    <li>
                                        <div class="graph_filter order_filter">
                                            <button class="btn secondary_btn   graph_filter_btn " type="button" id="custom_filter_btn">
                                                Filter
                                            </button>
                                            <div class="graph_filter_box" >
                                                <form method="get" action="<?php echo e(url('dashboard')); ?>">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="from_date_input_yearly" class="form-label input_labels">From</label>
                                                                <input type="date" class=" form-control clr_input_fields borderRadius "
                                                                       name="from_date_input_yearly"
                                                                       id="from_date_input_yearly"
                                                                       value="<?php echo e(request()->get('from_date_input_yearly', $fromDate)); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="to_date_input_yearly" class="form-label input_labels">To</label>
                                                                <input type="date" class=" form-control clr_input_fields borderRadius "
                                                                       name="to_date_input_yearly"
                                                                       id="to_date_input_yearly"
                                                                       value="<?php echo e(request()->get('to_date_input_yearly', $toDate)); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 ">
                                                            <div class="d-flex align-items-center justify-content-between">
                                                                <a href="<?php echo e(url('/dashboard')); ?>" class="btn secondary_btn  add_task_modal_btn" > Reset </a>
                                                                <button type="submit" class="btn green_btn  add_task_modal_btn" > Apply </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body ">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="monthly_line_chart">
                                        <div id="morris-area-chart_2" style="height: 400px; width: 100%;"></div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="monthly_pie_chart">
                                        <canvas id="MonthlyEarningPiechart" width="400" height="400"></canvas>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="monthly_bar_chart">
                                        <canvas id="MonthlyEarningBarChart" width="400" height="400"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card borderRadius20 box-shadow-card border-0 mt-5">
                            <div class="card-headerr">
                                <h4>Success Leads Report</h4>
                                <ul class="nav nav-tabs customtab2 " role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#leads_line_chart" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa-solid fa-chart-line"></i> Line Chart  </a>
                                    </li>
                                    <li role="presentation" class="">
                                        <a href="#leads_pie_chart" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa-solid fa-chart-pie"></i> Pie Chart  </a>
                                    </li>
                                    <li role="presentation" class="">
                                        <a href="#leads_bar_chart" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa-solid fa-chart-column"></i> Bar Chart  </a>
                                    </li>
                                    <li>
                                        <div class="graph_filter order_filter">
                                            <button class="btn secondary_btn   graph_filter_btn " type="button" id="custom_filter_btn">
                                                Filter
                                            </button>
                                            <div class="graph_filter_box" >
                                                <form method="get" action="<?php echo e(url('dashboard')); ?>">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="from_date_input_yearly" class="form-label input_labels">From</label>
                                                                <input type="date" class=" form-control clr_input_fields borderRadius"
                                                                       name="from_date_input_yearly"
                                                                       id="from_date_input_yearly"
                                                                       value="<?php echo e(request()->get('from_date_input_yearly', $fromDate)); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="to_date_input_yearly" class="form-label input_labels">To</label>
                                                                <input type="date" class="  form-control clr_input_fields borderRadius"
                                                                       name="to_date_input_yearly"
                                                                       id="to_date_input_yearly"
                                                                       value="<?php echo e(request()->get('to_date_input_yearly', $toDate)); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 ">
                                                            <div class="d-flex align-items-center justify-content-between">
                                                                <a href="<?php echo e(url('dashboard')); ?>" class="btn secondary_btn  add_task_modal_btn" >  Reset </a>
                                                                <button type="submit" class="btn green_btn add_task_modal_btn" >Apply </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body ">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="leads_line_chart">
                                        <div id="morris-area-chart_3" style="height: 400px; width: 100%;"></div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="leads_pie_chart">
                                        <canvas id="LeadsReportPiechart" height="400" width="100%"></canvas>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="leads_bar_chart">
                                        <canvas id="LeadsReportBarChart" height="400" width="100%"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div id="leadModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="leadModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="leadModalLabel">Lead Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-borderless" id="leadsTable">
                                <thead>
                                <tr>
                                    <th>Lead Title</th>
                                    <th>Lead Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- Data will be dynamically inserted here -->
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div id="tasksModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tasksModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tasksModalLabel">Assigned Tasks</h5>
                    </div>
                    <form id="tasksForm" action="<?php echo e(url('workForceHour/work-force-hour')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="user_id" value="<?php echo e(auth()->user()->id??''); ?>">
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                    <tr>
                                        <th>Lead Title</th>
                                        <th>Task Title</th>
                                        <th>Duration</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- Data will be dynamically inserted here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?php echo e(asset('plugins/components/raphael/raphael-min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/components/morrisjs/morris.js')); ?>"></script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>
    <!-- Include Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        $(document).ready(function () {
            let timerInterval;
            let totalSeconds = 0;
            let cumulativeTotalSeconds = 0;
            let userId = <?php echo e(auth()->user()->id); ?>;
            var playBtn = $('#playBtn');
            var pauseBtn = $('#pauseBtn');
            var resumeBtn = $('#resumeBtn');
            var checkOutBtn = $('#checkOutBtn');
            var hoursDisplay = $('.hours');
            var minutesDisplay = $('.minutes');
            var secondsDisplay = $('.seconds');
            var totalHoursDisplay = $('#totalHours');
            let isPaused = false;
            playBtn.show();
            pauseBtn.hide();
            resumeBtn.hide();
            checkOutBtn.show();
            checkActiveSession();
            function checkActiveSession() {
                $.ajax({
                    url: '<?php echo e(url("get_active_session")); ?>',
                    method: 'GET',
                    data: {
                        "user_id": userId
                    },
                    success: function (response) {
                        if (response.status === 'running') {
                            sessionStartTime = new Date(response.check_in);
                            totalSeconds = response.elapsed_time || 0;
                            cumulativeTotalSeconds = response.total_time_today || 0;
                            resumeTimer();
                            playBtn.hide();
                            pauseBtn.show();
                            checkOutBtn.show();
                            checkOutBtn.prop('disabled', false);
                            console.log("Raw Date:", sessionStartTime);
                            let hours = sessionStartTime.getHours();
                            let minutes = sessionStartTime.getMinutes().toString().padStart(2, '0');
                            let ampm = hours >= 12 ? 'PM' : 'AM';
                            hours = hours % 12 || 12;
                            let formattedTime = `${hours}:${minutes} ${ampm}`;
                            console.log("Formatted Time:", formattedTime);
                            $('.check_in_time').text(formattedTime);
                        } else {
                            cumulativeTotalSeconds = response.total_time_today || 0;
                            totalSeconds = 0;
                            updateTotalTimeDisplay(cumulativeTotalSeconds);
                        }
                    }
                });
            }

            $(document).on('click', '#playBtn', function () {
                // checkActiveSession();
                if (isPaused) {
                    resumeTimer();
                    isPaused = false;
                } else {
                    $.ajax({
                        url: '<?php echo e(url("start_session")); ?>',
                        method: 'POST',
                        data: {
                            "_token": "<?php echo e(csrf_token()); ?>",
                            "user_id": userId
                        },
                        success: function (response) {
                            checkActiveSession();
                            sessionStartTime = new Date(response.check_in);
                            totalSeconds = response.elapsed_time || 0;
                            cumulativeTotalSeconds = response.total_time_today || 0;
                            resumeTimer();
                        }
                    });
                }
                playBtn.hide();
                pauseBtn.show();
                checkOutBtn.show();
                checkOutBtn.prop('disabled', false);
            });

            // Handle Pause button click (Stop the timer)
            $(document).on('click', '#pauseBtn', function () {
                clearInterval(timerInterval);  // Stop the timer
                isPaused = true;  // Indicate the timer is paused

                $.ajax({
                    url: '<?php echo e(url("pause_session")); ?>',
                    method: 'POST',
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        "user_id": userId,
                    },
                    success: function (response) {
                        console.log('Session paused:', response);
                    }
                });

                pauseBtn.hide();
                resumeBtn.show();
                checkOutBtn.show();
                checkOutBtn.prop('disabled', false);
            });

            $(document).on('click', '#resumeBtn', function () {
                resumeTimer();
                resumeBtn.hide();
                pauseBtn.show();
            });

            $(document).on('click', '#checkOutBtn', function () {
                // var totalResumeTime = $('.timer_counts').text();
                var totalResumeTime = $('.timer_counts').text().trim();
                var match = totalResumeTime.match(/\d{2}\s*:\s*\d{2}\s*:\s*\d{2}/);
                if (match) {
                    totalResumeTime = match[0].replace(/\s+/g, '');
                }
                console.log(totalResumeTime);
                // alert(totalResumeTime);
                clearInterval(timerInterval);
                $.ajax({
                    url: '<?php echo e(url("stop_session")); ?>',
                    method: 'POST',
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        "user_id": userId,
                        "total_resume_time": totalResumeTime,
                    },
                    success: function (response) {
                        console.log('Session checked out:', response);
                        // Update the cumulative total time for the user
                        cumulativeTotalSeconds += totalSeconds;
                        // Reset the timer display
                        totalSeconds = 0;
                        hoursDisplay.text('00');
                        minutesDisplay.text('00');
                        secondsDisplay.text('00');

                        updateTotalTimeDisplay(cumulativeTotalSeconds);
                        $('.check_in_time').text('');

                        <?php if(auth()->user()->hasRole('staff')): ?>
                        $('#tasksModal').modal({
                            backdrop: 'static',   // Disable clicking outside the modal
                            keyboard: false       // Disable closing the modal by pressing the ESC key
                        });

                        // Prevent the modal from closing when the close button (X) is clicked
                        $('#tasksModal .close').on('click', function (e) {
                            e.preventDefault();
                        });

                        // Prevent closing the modal when clicking outside of it
                        $('#tasksModal').on('click', function (e) {
                            if ($(e.target).is('#tasksModal')) {
                                e.preventDefault();
                            }
                        });
                        $('#tasksModal').modal('show');

                        $('#tasksModal .modal-body tbody').empty();
                        const maxTimeSeconds = convertTimeToSeconds(response.formatted_time);
                        response.scheduling_task.forEach(function(task, index) {
                            var taskRow = `
            <tr>
                <td>
                    <input type="text" class="form-control" value="${task.lead_title}" readonly>
                    <input type="hidden" name="lead_id[]" value="${task.lead_id}">
                </td>
                <td>
                    <input type="text" class="form-control" value="${task.name}" readonly>
                    <input type="hidden" name="task_id[]" value="${task.id}">
                </td>
                <td>
                    <input type="text" class="form-control timepickerjob" name="time[]">
                </td>
            </tr>
        `;
                            $('#tasksModal .modal-body tbody').append(taskRow);
                        });

                        function convertTimeToSeconds(timeStr) {
                            const parts = timeStr.split(':');
                            const hours = parseInt(parts[0]) || 0;
                            const minutes = parseInt(parts[1]) || 0;
                            const seconds = parseInt(parts[2]) || 0;
                            return (hours * 3600) + (minutes * 60) + seconds;
                        }

                        // Function to calculate total time from all inputs
                        function calculateTotalTime() {
                            let totalSeconds = 0;
                            $('.timepickerjob').each(function() {
                                const value = $(this).val();
                                if (value) {
                                    totalSeconds += convertTimeToSeconds(value);
                                }
                            });
                            return totalSeconds;
                        }

                        // Function to convert seconds back to HH:MM:SS format
                        function convertSecondsToTime(seconds) {
                            const hours = Math.floor(seconds / 3600);
                            const minutes = Math.floor((seconds % 3600) / 60);
                            const secs = seconds % 60;
                            return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
                        }

                        $(".timepickerjob").flatpickr({
                            enableTime: true,
                            noCalendar: true,
                            dateFormat: "H:i:S",
                            time_24hr: true,
                            enableSeconds: true,
                            minuteIncrement: 1,
                            secondIncrement: 1,
                            defaultHour: 0,
                            defaultMinute: 0,
                            defaultDate: "00:00:00",
                            onChange: function(selectedDates, dateStr, instance) {
                                // Validate on every change
                                const totalTime = calculateTotalTime();

                                if (totalTime > maxTimeSeconds) {
                                    alert(`Total time cannot exceed ${response.formatted_time}. Current total: ${convertSecondsToTime(totalTime)}`);
                                    // Clear the current input that caused the overflow
                                    instance.clear();
                                }
                            },
                            onReady: function(selectedDates, dateStr, instance) {
                                // Add a clear button
                                const clearBtn = document.createElement("button");
                                clearBtn.innerHTML = "Clear";
                                clearBtn.type = "button";
                                clearBtn.classList.add("flatpickr-clear-btn");
                                clearBtn.style.cssText = "width: 100%; padding: 8px; margin-top: 5px; background: #dc3545; color: white; border: none; border-radius: 3px; cursor: pointer;";

                                clearBtn.addEventListener("click", function() {
                                    instance.clear();
                                    instance.close();
                                });

                                instance.calendarContainer.appendChild(clearBtn);
                            }
                        });
                        const remainingTimeDiv = $('<div class="alert alert-success mt-2" id="remainingTime"></div>');
                        remainingTimeDiv.html(`<strong>Available Time:</strong> ${response.formatted_time} | <strong>Remaining:</strong> <span id="remaining">${response.formatted_time}</span>`);
                        $('#tasksModal .modal-body').prepend(remainingTimeDiv);

                        // Update remaining time display on input
                        $(document).on('change', '.timepickerjob', function() {
                            const totalUsed = calculateTotalTime();
                            const remaining = maxTimeSeconds - totalUsed;
                            $('#remaining').text(convertSecondsToTime(Math.max(0, remaining)));

                            if (remaining < 0) {
                                $('#remaining').parent().removeClass('alert-success').addClass('alert-danger');
                            } else {
                                $('#remaining').parent().removeClass('alert-danger').addClass('alert-success');
                            }
                        });
                        <?php endif; ?>
                    }
                });



                playBtn.show();
                pauseBtn.hide();
                resumeBtn.hide();
                checkOutBtn.show();
                checkOutBtn.prop('disabled', true);
            });
            function resumeTimer() {
                clearInterval(timerInterval);
                timerInterval = setInterval(() => {
                    totalSeconds++;
                    var hours = Math.floor(totalSeconds / 3600);
                    var minutes = Math.floor((totalSeconds % 3600) / 60);
                    var seconds = totalSeconds % 60;
                    hoursDisplay.text(pad(hours));
                    minutesDisplay.text(pad(minutes));
                    secondsDisplay.text(pad(seconds));
                    const totalElapsedSeconds = cumulativeTotalSeconds + totalSeconds;
                    updateTotalTimeDisplay(totalElapsedSeconds);
                }, 1000);
            }
            function updateTotalTimeDisplay(totalSeconds) {
                var hours = Math.floor(totalSeconds / 3600);
                var minutes = Math.floor((totalSeconds % 3600) / 60);
                var seconds = totalSeconds % 60;
                const formattedTime = `${pad(hours)}:${pad(minutes)}:${pad(seconds)}`;
                totalHoursDisplay.text(formattedTime);
            }
            function pad(value) {
                return value < 10 ? `0${value}` : value;
            }
        });

        $('#yearSelect').on('change', function() {
            const selectedYear = $(this).val();
            const url = new URL(window.location.href);
            url.searchParams.set('year', selectedYear);
            window.location.href = url;
        });

        // $(document).on('click', '.week-btn', function () {
        //     var key = $(this).attr('data-key');
        //     var $monthlySection = $('#monthly' + key).last();
        //     var monthlyAmount = $monthlySection.find('.monthly_amount').text();
        //     var monthlyPercentage = $monthlySection.find('.green-text').first().text();
        //     monthlyAmount = parseFloat(monthlyAmount.replace(/[^0-9.-]+/g, ""));
        //     monthlyPercentage = parseFloat(monthlyPercentage.replace(/[^0-9.-]+/g, ""));
        //     var weeklyAmount = monthlyAmount / 4;
        //     var weeklyPercentage = monthlyPercentage / 4;
        //     var $weeklySection = $('#weekly' + key);
        //     $weeklySection.find('.weekly_amount').each(function () {
        //         $(this).text('$' + weeklyAmount.toFixed(2)); // Set weekly amount
        //     });
        //     $weeklySection.find('.weekly_percentage').each(function () {
        //         $(this).text(weeklyPercentage.toFixed(2) + "%"); // Set weekly percentage
        //     });
        // });
        $(document).on('click', '.week-btn', function () {
            var weeklyProductionData = JSON.parse($(this).attr('data-weekly'));
            var key = $(this).attr('data-key');
            var $monthlySection = $('#monthly' + key);
            var productionAmount = $monthlySection.find('.achieved_amount').text();
            var productionPercentage = $monthlySection.find('.productionPercentage').text();
            productionAmount = parseFloat(productionAmount.replace(/[^0-9.-]+/g, ""));
            productionPercentage = parseFloat(productionPercentage.replace(/[^0-9.-]+/g, ""));
            var $weeklySection = $('#weekly' + key);
            $weeklySection.find('.weekly_amount').each(function () {
                $(this).text('$0.00');
            });
            $weeklySection.find('.weekly_percentage').each(function () {
                $(this).text('0%');
            });
            for (var week = 1; week <= 4; week++) {
                var weekData = weeklyProductionData['week' + week];
                var weekAmount = weekData ? weekData.amount : 0;
                var weekPercentage = weekData ? (weekAmount / productionAmount) * 100 : 0;
                if (weekAmount > 0) {
                    $weeklySection.find('.weekly_amount').eq(week - 1).text('$' + weekAmount.toFixed(2));
                    $weeklySection.find('.weekly_percentage').eq(week - 1).text(weekPercentage.toFixed(2) + "%");
                }
            }
        });

        $(document).ready(function() {
            $(".graph_filter_btn").click(function() {
                $(".graph_filter_box").not($(this).closest(".graph_filter").find(".graph_filter_box")).fadeOut(300);
                $(this).closest(".graph_filter").find(".graph_filter_box").fadeToggle(300);
            });
            $(".graph_filter_box .close-btn").click(function() {
                $(this).closest(".graph_filter_box").fadeOut(300);
            });
        });
        <?php
            $dataPoints = [];
                      if(request()->get('from_date_input_yearly')  &&  request()->get('to_date_input_yearly')){
                             for ($year = $startsyear; $year <= $lastYearEstimation; $year++) {
                              $user = auth()->user();
                              $queryBase = \App\Lead::whereYear('lead_date', $year)
                                            ->whereBetween('lead_status_date', [request()->get('from_date_input_yearly'), request()->get('to_date_input_yearly')])
                                            ->where('lead_status', 'won');
                              $changeOrderTotalAmount = \App\ChangeOrder::whereHas('getLead', function ($query) use ($year) {
                                  $query->whereYear('lead_date', $year)
                                        ->where('lead_status', 'won');
                              })
                              ->where('status', 'approved')
                              ->sum('total_amount');
                          if($user->hasRole('customer')) {
                                      $query = $queryBase->where('customer_id', $user->id);
                              }elseif($user->hasRole('user')){
                                      $query = $queryBase;
                              }elseif(!$user->hasRole('user')){
                                      $query = $queryBase->where('representative_id', $user->id);
                              }//ends else if.
                          $jobsCount = $query->count();
                          $totalAmount = $query->sum('lead_price');
                                  $dataPoints[] = [
                                      'label' => (string)$year,
                                      'y' => $totalAmount
                                  ];
                             }//end for
                      }else{
                           for ($year = $startsyear; $year <= $lastYearEstimation; $year++) {
                                  $user = auth()->user();
                                  $query = \App\Lead::whereYear('lead_status_date', $year)->where('lead_status', 'won');
                                  $leadPriceTotal = $query->sum('lead_price');
                                   $changeOrderTotalAmount = \App\ChangeOrder::whereHas('getLead', function ($query) use ($year) {
                                      $query->whereYear('lead_status_date', $year)
                                            ->where('lead_status', 'won');
                                  })
                                  ->where('status', 'approved')
                                  ->sum('total_amount');
                                  if (!empty($yearEstimation->year)) {
                                      $query->whereYear('lead_date', $yearEstimation->year);
                                  }
                                  if (!$user->hasRole('user')) {
                                      $roleField = $user->hasRole('customer') ? 'customer_id' : 'representative_id';
                                      $query->where($roleField, $user->id);
                                  }//ends here.
                                  $jobsCount = $query->count();
                                 $totalAmount = $leadPriceTotal + $changeOrderTotalAmount;
                          $dataPoints[] = [
                              'label' => (string)$year,
                              'y' => $totalAmount
                          ];
                              }//end for
                      }//end if
        ?>
        document.addEventListener('DOMContentLoaded', function () {
            var dynamicColors = ["#74C911", "#E5E5E5", "#4E7D18"];
            var dataPoints = <?php echo json_encode($dataPoints, 15, 512) ?>;
            for (var i = 0; i < dataPoints.length; i++) {
                dataPoints[i].backgroundColor = dynamicColors[i % dynamicColors.length];
                dataPoints[i].borderColor = "#FFFFFF";
                dataPoints[i].borderWidth = 5;
                dataPoints[i].hoverOffset = 4;
                dataPoints[i].borderRadius = 15;
            }
            var ctx = document.getElementById('yearlyReportPiechart').getContext('2d');
            var myDoughnutChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: dataPoints.map(point => point.label),
                    datasets: [{
                        data: dataPoints.map(point => point.y),
                        backgroundColor: dataPoints.map(point => point.backgroundColor),
                        borderColor: dataPoints.map(point  => point.borderColor),
                        borderWidth: dataPoints.map(point  => point.borderWidth),
                        hoverOffset: dataPoints.map(point  => point.hoverOffset),
                        borderRadius: dataPoints.map(point => point.borderRadius),
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                usePointStyle: true  ,
                                color: '#838383'
                            }
                        }
                    }
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function () {
            var dataPoints = <?php echo json_encode($dataPoints, 15, 512) ?>;

            const backgroundBar = {
                id: 'backgroundBar',
                beforeDatasetsDraw(chart, args, pluginOptions) {
                    const { ctx, chartArea: { left, top, right, bottom }, scales: { x, y } } = chart;
                    ctx.save();
                    ctx.fillStyle = '#F9FFF2';
                    const barWidth = 10;
                    const borderRadius = 10;
                    for (let i = 0; i < dataPoints.length; i++) {
                        const xPixel = x.getPixelForValue(i) - barWidth / 2;
                        ctx.fillRect(xPixel, top, barWidth, bottom - top);

                        ctx.save();
                        ctx.fillStyle = '#F9FFF2';
                        ctx.shadowColor = '#6060601F';
                        ctx.shadowOffsetX = 0;
                        ctx.shadowOffsetY = 2;
                        ctx.shadowBlur = 4;

                        ctx.beginPath();
                        ctx.moveTo(xPixel + borderRadius, top);
                        ctx.lineTo(xPixel + barWidth - borderRadius, top);
                        ctx.quadraticCurveTo(xPixel + barWidth, top, xPixel + barWidth, top + borderRadius);
                        ctx.lineTo(xPixel + barWidth, bottom - borderRadius);
                        ctx.quadraticCurveTo(xPixel + barWidth, bottom, xPixel + barWidth - borderRadius, bottom);
                        ctx.lineTo(xPixel + borderRadius, bottom);
                        ctx.quadraticCurveTo(xPixel, bottom, xPixel, bottom - borderRadius);
                        ctx.lineTo(xPixel, top + borderRadius);
                        ctx.quadraticCurveTo(xPixel, top, xPixel + borderRadius, top);
                        ctx.closePath();
                        ctx.fill();
                        ctx.restore();
                    }
                    ctx.restore();
                }
            };

            var options = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    backgroundBar: { barColor: '#F9FFF2' }
                },
                scales: {
                    x: { grid: { display: false }, ticks: { font: { color: '#838383' } } },
                    y: {
                        ticks: {
                            font: { color: '#838383' },
                            callback: function(value) {
                                return value.toFixed(2); // Format Y-axis values to 2 decimal places
                            }
                        }
                    }
                }
            };

            var ctx = document.getElementById('YearlyReportBarChart').getContext('2d');
            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dataPoints.map(point => point.label),
                    datasets: [{
                        data: dataPoints.map(point => point.y),
                        backgroundColor: '#74C911',
                        borderColor: '#F9FFF2',
                        borderWidth: 2,
                        borderSkipped: false,
                        barThickness: 10,
                        borderRadius: 20,
                    }]
                },
                options: options,
                plugins: [backgroundBar]
            });
        });

        <?php if(request()->get('from_date_input_yearly')  &&  request()->get('to_date_input_yearly')): ?>
        var chartData = [
                <?php for($year = $startsyear; $year <= $lastYearEstimation; $year++): ?>
                <?php
                    $user = auth()->user();
                    $queryBase = \App\Lead::whereYear('lead_status_date', $year)
                                      ->whereBetween('lead_status_date', [request()->get('from_date_input_yearly'), request()->get('to_date_input_yearly')])
                                      ->where('lead_status', 'won');
                     $changeOrderTotalAmount = \App\ChangeOrder::whereHas('getLead', function ($query) use ($year) {
                            $query->whereYear('lead_status_date', $year)
                                  ->where('lead_status', 'won');
                        })
                        ->where('status', 'approved')
                        ->sum('total_amount');
                        if($user->hasRole('customer')) {
                                $query = $queryBase->where('customer_id', $user->id);
                        }elseif($user->hasRole('user')){
                                $query = $queryBase;
                        }elseif(!$user->hasRole('user')){
                                $query = $queryBase->where('representative_id', $user->id);
                        }//ends else if.
                    $jobsCount = $query->count();
                    $totalAmount = $query->sum('lead_price');
                ?>
            {
                period: '<?php echo e($year); ?>',
                jobs: '<?php echo e($jobsCount); ?>',
                total_amount: '<?php echo e($totalAmount + $changeOrderTotalAmount); ?>',
            },
            <?php endfor; ?>
        ];
        <?php else: ?>
        
        
        
        
        
        
        
        
        
        
        var chartData = [
                <?php for($year = $startsyear; $year <= $lastYearEstimation; $year++): ?>
                <?php
                    $selectedYear = request()->query('year');
                    $user = auth()->user();

                    if ($selectedYear === 'all_year') {
                        // Get data for all years combined
                        $query = \App\Lead::where('lead_status', 'won')->whereYear('lead_status_date', $year);
                        $changeOrderTotalAmount = \App\ChangeOrder::whereHas('getLead', function ($query) use ($year) {
                            $query->whereYear('lead_status_date', $year)->where('lead_status', 'won');
                        })->where('status', 'approved')->sum('total_amount');
                    } else {
                        // Get data for a specific year
                        $query = \App\Lead::whereYear('lead_status_date', $year)->where('lead_status', 'won');
                        $changeOrderTotalAmount = \App\ChangeOrder::whereHas('getLead', function ($query) use ($year) {
                            $query->whereYear('lead_status_date', $year)->where('lead_status', 'won');
                        })->where('status', 'approved')->sum('total_amount');
                    }

                    // Apply role-based filtering
                    if (!$user->hasRole('user')) {
                        $roleField = $user->hasRole('customer') ? 'customer_id' : 'representative_id';
                        $query->where($roleField, $user->id);
                    }

                    // Count jobs and total lead amount for each year
                    $jobsCount = $query->count();
                    $totalAmount = $query->sum('lead_price');
                ?>
            {
                period: '<?php echo e($year); ?>',
                jobs: '<?php echo e($jobsCount); ?>',
                total_amount: '<?php echo e($totalAmount + $changeOrderTotalAmount); ?>',
            },
            <?php endfor; ?>
        ];
        <?php endif; ?>
        Morris.Line({
            element: 'morris-area-chart_1',
            data: chartData,
            xkey: 'period',
            ykeys: ['jobs', 'total_amount'],
            labels: ['jobs', 'total_amount'],
            parseTime: false,
            xLabels: 'year',
            pointSize: 0,
            lineWidth: 8,
            smooth: true,
            fillOpacity: 0.3,
            pointStrokeColors: ['#000'],
            gridLineColor: '#DBDBDB',
            continuousLine: false,
            hideHover: 'auto',
            lineColors: ['rgba(0, 0, 0, 0)', '#74C911'],
            resize: true,
            yLabelFormat: function(y) {
                return y.toFixed(2); // Format Y-axis labels to 2 decimal places
            }
        });

        <?php if(request()->get('from_date_input_monthly')  &&  request()->get('to_date_input_monthly')): ?>
        var chartDataMonth = [
                <?php
                    $user = auth()->user();
                    $currentYear = \Carbon\Carbon::now()->format('Y');
                ?>
                <?php for($month = 1; $month <= 12; $month++): ?>
                <?php
                    $monthName = DateTime::createFromFormat('!m', $month)->format('M');
                    $yearForQuery = !empty($yearEstimation->year) ? $yearEstimation->year : $currentYear;
                    $queryBase = \App\Lead::whereMonth('lead_date', $month)->whereBetween('lead_date', [request()->get('from_date_input_monthly'), request()->get('to_date_input_monthly')])->where('lead_status', 'won');
                    $changeOrderTotalAmount = \App\ChangeOrder::whereHas('getLead', function ($query) use ($month) {
                    $query->whereMonth('lead_date', $month)
                          ->whereBetween('lead_date', [
                              request()->get('from_date_input_monthly'),
                              request()->get('to_date_input_monthly')
                          ])
                          ->where('lead_status', 'won');
                })
                ->where('status', 'approved')
                ->sum('total_amount');
                    if($user->hasRole('customer')) {
                            $query = $queryBase->where('customer_id', $user->id);
                    }elseif($user->hasRole('user')){
                            $query = $queryBase;
                    }elseif(!$user->hasRole('user')){
                            $query = $queryBase->where('representative_id', $user->id);
                    }//ends else if.
                    $leadsCount = $query->count();
                    $totalMonthlyAmount = $query->sum('lead_price');
                ?>
            {
                "months": "<?php echo e($yearForQuery); ?> - <?php echo e($monthName); ?>",
                "leads": <?php echo e($leadsCount); ?>,
                "total_monthly_amount": <?php echo e($totalMonthlyAmount + $changeOrderTotalAmount); ?>

            }<?php if($month < 12): ?>,<?php endif; ?>
            <?php endfor; ?>


        ]
        <?php else: ?>
        
        
        
        
        
        
        
        
        
        
        
        var chartDataMonth = [
                <?php
                    $user = auth()->user();
                    $selectedYear = request('year');

                    // Get all available years if 'all_year' is selected, otherwise use the requested year
                    $years = ($selectedYear === 'all_year') ? \App\YearEstimation::pluck('year')->toArray() : [$selectedYear ?? ($yearEstimation->year ?? now()->year)];
                ?>

                <?php for($month = 1; $month <= 12; $month++): ?>
                <?php
                    $monthName = DateTime::createFromFormat('!m', $month)->format('F');

                    // Initialize variables to sum all years
                    $totalLeads = 0;
                    $totalAmount = 0;

                    foreach ($years as $yearForQuery) {
                        $queryBase = \App\Lead::whereYear('lead_status_date', $yearForQuery)
                                              ->whereMonth('lead_status_date', $month)
                                              ->where('lead_status', 'won');

                        $changeOrderTotalAmount = \App\ChangeOrder::whereHas('getLead', function ($query) use ($month, $yearForQuery) {
                                $query->whereMonth('lead_status_date', $month)
                                      ->whereYear('lead_status_date', $yearForQuery)
                                      ->where('lead_status', 'won');
                            })
                            ->where('status', 'approved')
                            ->sum('total_amount');

                        // Apply user roles for filtering
                        if ($user->hasRole('customer')) {
                            $query = $queryBase->where('customer_id', $user->id);
                        } elseif ($user->hasRole('user')) {
                            $query = $queryBase;
                        } elseif (!$user->hasRole('user')) {
                            $query = $queryBase->where('representative_id', $user->id);
                        }

                        // Aggregate data for this month across all years
                        $totalLeads += $query->count();
                        $totalAmount += $query->sum('lead_price') + $changeOrderTotalAmount;
                    }
                ?>
            {
                "months": "<?php echo e($monthName); ?>",
                "leads": <?php echo e($totalLeads); ?>,
                "total_monthly_amount": <?php echo e($totalAmount); ?>

            }<?php if($month < 12): ?>,<?php endif; ?>
            <?php endfor; ?>
        ];
        <?php endif; ?>
        <?php if(request()->get('from_date_input_lead')  &&  request()->get('to_date_input_lead')): ?>
        var chartDataLeadsReport = [
                <?php $__currentLoopData = \App\Stage::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $user = auth()->user();
                    $queryBase = \App\Lead::whereBetween('lead_date', [request()->get('from_date_input_lead'), request()->get('to_date_input_lead')])->where('stage_id', $stage->id);
                    if($user->hasRole('customer')) {
                            $query = $queryBase->where('customer_id', $user->id);
                    }elseif($user->hasRole('user')){
                            $query = $queryBase;
                    }elseif(!$user->hasRole('user')){
                        $query = $queryBase->where('representative_id', $user->id);
                    }//ends else if.
                    $stageLeads = $query->count();
                    $totalLeadAmount = $query->sum('lead_price');
                ?>
            {
                stage: '<?php echo e($stage->name); ?>',
                stage_leads: '<?php echo e($stageLeads); ?>',
                total_lead_amount: '<?php echo e($totalLeadAmount); ?>',
            },
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ];
        <?php else: ?>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        var chartDataLeadsReport = [
                <?php $__currentLoopData = \App\Stage::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $selectedYear = request('year') ?? ($yearEstimation->year ?? null);
                    $user = auth()->user();
                    $yearList = ($selectedYear === 'all_year') ? \App\YearEstimation::pluck('year')->toArray() : [$selectedYear];
                    $queryBase = \App\Lead::where('stage_id', $stage->id)
                        ->where('lead_status', 'won')
                        ->where(function ($query) use ($yearList) {
                            foreach ($yearList as $year) {
                                $query->orWhereYear('lead_status_date', $year);
                            }
                        });
                    if ($user->hasRole('customer')) {
                        $queryBase->where('customer_id', $user->id);
                    } elseif (!$user->hasRole('user')) {
                        $queryBase->where('representative_id', $user->id);
                    }
                    $stageLeads = $queryBase->count();
                    $totalLeadAmount = $queryBase->sum('lead_price');
                    $changeOrderTotalAmount = \App\ChangeOrder::whereHas('getLead', function ($query) use ($stage, $yearList) {
                        $query->where('stage_id', $stage->id)
                            ->where('lead_status', 'won')
                            ->where(function ($query) use ($yearList) {
                                foreach ($yearList as $year) {
                                    $query->orWhereYear('lead_status_date', $year);
                                }
                            });
                    })
                    ->where('status', 'approved')
                    ->sum('total_amount');
                    $totalAmount = $totalLeadAmount + $changeOrderTotalAmount;
                ?>
            {
                stage: '<?php echo e($stage->name); ?>',
                stage_leads: <?php echo e($stageLeads); ?>,
                total_lead_amount: <?php echo e($totalAmount); ?>,
            },
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ];
        <?php endif; ?>
        Morris.Line({
            element: 'morris-area-chart_2',
            data: chartDataMonth,
            xkey: 'months',
            ykeys: ['leads', 'total_monthly_amount'],
            labels: ['Leads', 'Total Monthly Amount'],
            parseTime: false,
            xLabels: 'month',
            pointSize: 0,
            lineWidth: 8,
            smooth: true,
            fillOpacity: 0.3,
            pointStrokeColors: ['#000'],
            gridLineColor: '#DBDBDB',
            continuousLine: false,
            hideHover: 'auto',
            lineColors: ['rgba(0, 0, 0, 0)', '#74C911'],
            resize: true,
            yLabelFormat: function(y) {
                return '$' + y.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            },
            hoverCallback: function(index, options, content, row) {
                // Custom tooltip format
                var month = row.months;
                var leads = Math.floor(row.leads); // Ensure leads is an integer
                var amount = '$' + row.total_monthly_amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                return '<div class="morris-hover-row-label">' + month + '</div>' +
                    '<div class="morris-hover-point">Leads: ' + leads + '</div>' +
                    '<div class="morris-hover-point">Total Monthly Amount: ' + amount + '</div>';
            }
        });
        <?php
            $user = auth()->user();
            $currentYear = \Carbon\Carbon::now()->format('Y');
            $chartData = [];
        ?>
        <?php if(request()->get('from_date_input_monthly') && request()->get('to_date_input_monthly')): ?>
        <?php for($month = 1; $month <= 12; $month++): ?>
        <?php
            $monthName = DateTime::createFromFormat('!m', $month)->format('M');
            if (!empty($yearEstimation->year)){
                $query = \App\Lead::whereMonth('lead_date', $month)->whereBetween('lead_date', [request()->get('from_date_input_monthly'), request()->get('to_date_input_monthly')])->where('lead_status', 'won');
            }else{
                $query = \App\Lead::whereBetween('lead_date', [request()->get('from_date_input_monthly'), request()->get('to_date_input_monthly')])->whereMonth('lead_date', $month)->where('lead_status', 'won');
            }//end if else.
                    if($user->hasRole('customer')) {
                            $query = $query->where('customer_id', $user->id);
                    }elseif($user->hasRole('user')){
                $query = $query;
                    }elseif(!$user->hasRole('user')){
                            $query = $query->where('representative_id', $user->id);
                    }//ends else if.
            $leadsCount = $query->count();
            $totalMonthlyAmount = $query->sum('lead_price');
            if (!empty($yearEstimation->year)){
                $chartData[] = [
                    'label' => "$yearEstimation->year - $monthName",
                    'y'     =>  $totalMonthlyAmount,
                ];
            }else{
                $chartData[] = [
                    'label' => "$currentYear - $monthName",
                    'y' => $totalMonthlyAmount,
                ];
            }//end if else.
        ?>
        <?php endfor; ?>
        <?php else: ?>
        
        
        
        <?php
            $selectedYear = request('year') ?? ($yearEstimation->year ?? $currentYear);
            $chartData = [];
            $yearList = ($selectedYear === 'all_year') ? \App\YearEstimation::pluck('year')->toArray() : [$selectedYear];
            for ($month = 1; $month <= 12; $month++) {
                $monthName = DateTime::createFromFormat('!m', $month)->format('M');
                $query = \App\Lead::whereIn(DB::raw('YEAR(lead_status_date)'), $yearList)
                    ->whereMonth('lead_status_date', $month)
                    ->where('lead_status', 'won');
                $changeOrderTotalAmount = \App\ChangeOrder::whereHas('getLead', function ($query) use ($yearList, $month) {
                    $query->whereIn(DB::raw('YEAR(lead_status_date)'), $yearList)
                        ->whereMonth('lead_status_date', $month)
                        ->where('lead_status', 'won');
                })
                ->where('status', 'approved')
                ->sum('total_amount');
                if ($user->hasRole('customer')) {
                    $query->where('customer_id', $user->id);
                } elseif (!$user->hasRole('user')) {
                    $query->where('representative_id', $user->id);
                }
                $leadsCount = $query->count();
                $leadMonthlyPrice = $query->sum('lead_price');
                $totalMonthlyAmount = $leadMonthlyPrice + $changeOrderTotalAmount;
                $chartData[] = [
                    'label' => "All Years - $monthName", // Dynamic Label
                    'y' => $totalMonthlyAmount,
                ];
            }
        ?>
        <?php endif; ?>
        document.addEventListener('DOMContentLoaded', function () {
            var dynamicColors = ["#74C911", "#E5E5E5", "#4E7D18"];
            var dataPoints = <?php echo json_encode($chartData, 15, 512) ?>;

            // Set chart data properties
            for (var i = 0; i < dataPoints.length; i++) {
                dataPoints[i].backgroundColor = dynamicColors[i % dynamicColors.length];
                dataPoints[i].borderColor = "#FFFFFF";
                dataPoints[i].borderWidth = 5;
                dataPoints[i].hoverOffset = 4;
                dataPoints[i].borderRadius = 15;
            }

            var ctx = document.getElementById('MonthlyEarningPiechart').getContext('2d');
            var myDoughnutChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: dataPoints.map(point => point.label),
                    datasets: [{
                        data: dataPoints.map(point => point.y),
                        backgroundColor: dataPoints.map(point => point.backgroundColor),
                        borderColor: dataPoints.map(point => point.borderColor),
                        borderWidth: dataPoints.map(point => point.borderWidth),
                        hoverOffset: dataPoints.map(point => point.hoverOffset),
                        borderRadius: dataPoints.map(point => point.borderRadius),
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                color: '#838383'
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    // Format tooltip value as a decimal with 2 decimal places
                                    var value = tooltipItem.raw;
                                    return tooltipItem.label + ': ' + value.toFixed(2); // Adjust decimal places here
                                }
                            }
                        }
                    }
                }
            });
        });


        <?php
            $user = auth()->user();
            $currentYear = \Carbon\Carbon::now()->format('Y');
            $chartData = [];
        ?>
        <?php if(request()->get('from_date_input_monthly')  &&  request()->get('to_date_input_monthly')): ?>
        <?php for($month = 1; $month <= 12; $month++): ?>
        <?php
            $monthName = DateTime::createFromFormat('!m', $month)->format('M');
            if (!empty($yearEstimation->year)){
                $query = \App\Lead::whereBetween('lead_date', [request()->get('from_date_input_monthly'), request()->get('to_date_input_monthly')])->whereMonth('lead_date', $month)->where('lead_status', 'won');
            }else{
                $query = \App\Lead::whereBetween('lead_date', [request()->get('from_date_input_monthly'), request()->get('to_date_input_monthly')])->whereMonth('lead_date', $month)->where('lead_status', 'won');
            }//end if else.
                    if($user->hasRole('customer')) {
                            $query = $query->where('customer_id', $user->id);
                    }elseif($user->hasRole('user')){
                            $query = $query;
                    }elseif(!$user->hasRole('user')){
                            $query = $query->where('representative_id', $user->id);
                    }//ends else if.
            $leadsCount = $query->count();
            $totalMonthlyAmount = $query->sum('lead_price');
            if (!empty($yearEstimation->year)){
                $chartData[] = [
                    'label' => "$yearEstimation->year - $monthName",
                    'y' => $totalMonthlyAmount,
                ];
            }else{
                $chartData[] = [
                    'label' => "$currentYear - $monthName",
                    'y' => $totalMonthlyAmount,
                ];
            }//end if else.
        ?>
        <?php endfor; ?>
        <?php else: ?>
        
        
        
        <?php
            $selectedYear = request('year') ?? ($yearEstimation->year ?? $currentYear);
            $chartData = [];
            $yearList = ($selectedYear === 'all_year') ? \App\YearEstimation::pluck('year')->toArray() : [$selectedYear];
            for ($month = 1; $month <= 12; $month++) {
                $monthName = DateTime::createFromFormat('!m', $month)->format('M');
                $query = \App\Lead::whereIn('lead_status', ['won'])
                    ->whereMonth('lead_status_date', $month)
                    ->where(function ($query) use ($yearList) {
                        foreach ($yearList as $year) {
                            $query->orWhereYear('lead_status_date', $year);
                        }
                    });
                $changeOrderTotalAmount = \App\ChangeOrder::whereHas('getLead', function ($query) use ($yearList, $month) {
                    $query->whereMonth('lead_status_date', $month)
                        ->where(function ($query) use ($yearList) {
                            foreach ($yearList as $year) {
                                $query->orWhereYear('lead_status_date', $year);
                            }
                        })
                        ->where('lead_status', 'won');
                })
                ->where('status', 'approved')
                ->sum('total_amount');
                if ($user->hasRole('customer')) {
                    $query->where('customer_id', $user->id);
                } elseif (!$user->hasRole('user')) {
                    $query->where('representative_id', $user->id);
                }
                $leadsCount = $query->count();
                $leadPriceAmount = $query->sum('lead_price');
                $totalMonthlyAmount = $leadPriceAmount + $changeOrderTotalAmount;
                $chartData[] = [
                    'label' => ($selectedYear === 'all_year') ? "All Years - $monthName" : "$selectedYear - $monthName",
                    'y' => $totalMonthlyAmount,
                ];
            }
        ?>
        <?php endif; ?>
        document.addEventListener('DOMContentLoaded', function () {
            var dataPoints = <?php echo json_encode($chartData, 15, 512) ?>;
            const backgroundBar = {
                id: 'backgroundBar',
                beforeDatasetsDraw(chart, args, pluginOptions) {
                    const { ctx, chartArea: { left, top, right, bottom }, scales: { x, y } } = chart;
                    ctx.save();
                    ctx.fillStyle = '#F9FFF2';
                    const barWidth = 10;
                    const borderRadius = 10;
                    for (let i = 0; i < dataPoints.length; i++) {
                        const xPixel = x.getPixelForValue(i) - barWidth / 2;
                        ctx.fillRect(xPixel, top, barWidth, bottom - top);
                        ctx.save();
                        ctx.fillStyle = '#F9FFF2';
                        ctx.shadowColor = '#6060601F';
                        ctx.shadowOffsetX = 0;
                        ctx.shadowOffsetY = 2;
                        ctx.shadowBlur = 4;
                        ctx.beginPath();
                        ctx.moveTo(xPixel + borderRadius, top);
                        ctx.lineTo(xPixel + barWidth - borderRadius, top);
                        ctx.quadraticCurveTo(xPixel + barWidth, top, xPixel + barWidth, top + borderRadius);
                        ctx.lineTo(xPixel + barWidth, bottom - borderRadius);
                        ctx.quadraticCurveTo(xPixel + barWidth, bottom, xPixel + barWidth - borderRadius, bottom);
                        ctx.lineTo(xPixel + borderRadius, bottom);
                        ctx.quadraticCurveTo(xPixel, bottom, xPixel, bottom - borderRadius);
                        ctx.lineTo(xPixel, top + borderRadius);
                        ctx.quadraticCurveTo(xPixel, top, xPixel + borderRadius, top);
                        ctx.closePath();
                        ctx.fill();
                        ctx.restore();
                    }
                    ctx.restore();
                }
            };
            var options = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    backgroundBar: { barColor: '#F9FFF2' },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return '$' + context.parsed.y.toFixed(2);
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { font: { color: '#838383' } }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: { color: '#838383' },
                            callback: function(value, index, values) {
                                return '$' + value.toFixed(2);
                            }
                        }
                    }
                }
            };
            var ctx = document.getElementById('MonthlyEarningBarChart').getContext('2d');
            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dataPoints.map(point => point.label),
                    datasets: [{
                        data: dataPoints.map(point => point.y),
                        backgroundColor: '#74C911',
                        borderColor: '#F9FFF2',
                        borderWidth: 2,
                        borderSkipped: false,
                        barThickness: 10,
                        borderRadius: 20,
                    }]
                },
                options: options,
                plugins: [backgroundBar]
            });
        });
        Morris.Line({
            element: 'morris-area-chart_3',
            data: chartDataLeadsReport,
            xkey: 'stage',
            ykeys: ['stage_leads', 'total_lead_amount'],
            labels: ['Stage Leads', 'Total Lead Amount'],
            parseTime: false,
            xLabels: 'month',
            pointSize: 0,
            lineWidth: 8,
            smooth: true,
            fillOpacity: 0.3,
            pointStrokeColors: ['#000'],
            gridLineColor: '#DBDBDB',
            continuousLine: false,
            hideHover: 'auto',
            lineColors: ['rgba(0, 0, 0, 0)', '#74C911'],
            resize: true,
            yLabelFormat: function(y) {
                return '$' + y.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            },
            hoverCallback: function(index, options, content, row) {
                // Customize tooltip content
                var stage = row.stage;
                var stageLeads = Math.round(row.stage_leads); // Ensure stage_leads is an integer
                var totalLeadAmount = '$' + row.total_lead_amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');

                // Construct custom tooltip HTML
                return '<div class="morris-hover-row-label">' + stage + '</div>' +
                    '<div class="morris-hover-point">Stage Leads: ' + stageLeads + '</div>' +
                    '<div class="morris-hover-point">Total Lead Amount: ' + totalLeadAmount + '</div>';
            }
        });

        <?php
            $PiechartLeadsReport = [];
            if(request()->get('from_date_input_lead')  &&  request()->get('to_date_input_lead')){
                    foreach (\App\Stage::all() as $stage) {
                        $user = auth()->user();
                        $queryBase = \App\Lead::whereBetween('lead_date', [request()->get('from_date_input_lead'), request()->get('to_date_input_lead')])->where('stage_id', $stage->id)->where('lead_status','won');
                        if($user->hasRole('customer')) {
                            $query = $queryBase->where('customer_id', $user->id);
                        }elseif($user->hasRole('user')){
                                $query = $queryBase;
                        }elseif(!$user->hasRole('user')){
                            $query = $queryBase->where('representative_id', $user->id);
                        }
                        $stageLeads = $query->count();
                        $totalLeadAmount = $query->sum('lead_price');
                        $PiechartLeadsReport[] = [
                            'label' => $stage->name,
                            'y' => $stageLeads,
                        ];
                }
            }else{
//      $PiechartLeadsReport = [];

    foreach (\App\Stage::all() as $stage) {
        $user = auth()->user();
        $selectedYear = request('year') ?? ($yearEstimation->year ?? null);

        // Handle 'all_year' selection dynamically
        $yearList = ($selectedYear === 'all_year') ? \App\YearEstimation::pluck('year')->toArray() : [$selectedYear];

        // Base query for leads
        $queryBase = \App\Lead::where('stage_id', $stage->id)
            ->where('lead_status', 'won')
            ->where(function ($query) use ($yearList) {
                foreach ($yearList as $year) {
                    $query->orWhereYear('lead_status_date', $year);
                }
            });

        // Apply role-based filtering
        if ($user->hasRole('customer')) {
            $queryBase->where('customer_id', $user->id);
        } elseif (!$user->hasRole('user')) {
            $queryBase->where('representative_id', $user->id);
        }

        // Calculate total lead count & price
        $stageLeads = $queryBase->count();
        $leadPriceTotal = $queryBase->sum('lead_price');

        // Calculate Change Order Total Amount
        $changeOrderTotalAmount = \App\ChangeOrder::whereHas('getLead', function ($query) use ($stage, $yearList) {
            $query->where('stage_id', $stage->id)
                ->where('lead_status', 'won')
                ->where(function ($query) use ($yearList) {
                    foreach ($yearList as $year) {
                        $query->orWhereYear('lead_status_date', $year);
                    }
                });
        })
        ->where('status', 'approved')
        ->sum('total_amount');

        $totalAmount = $leadPriceTotal + $changeOrderTotalAmount;

        // Add to Pie Chart Data
        $PiechartLeadsReport[] = [
            'label' => $stage->name,
            'y' => $totalAmount,
        ];
    }
            }
        ?>
        document.addEventListener('DOMContentLoaded', function () {
            var dynamicColors = ["#74C911", "#E5E5E5", "#4E7D18"];
            var dataPoints = <?php echo json_encode($PiechartLeadsReport, 15, 512) ?>;

            // Assign dynamic properties for each data point
            for (var i = 0; i < dataPoints.length; i++) {
                dataPoints[i].backgroundColor = dynamicColors[i % dynamicColors.length];
                dataPoints[i].borderColor = "#FFFFFF";
                dataPoints[i].borderWidth = 5;
                dataPoints[i].hoverOffset = 4;
                dataPoints[i].borderRadius = 15;
            }

            var ctx = document.getElementById('LeadsReportPiechart').getContext('2d');
            var myDoughnutChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: dataPoints.map(point => point.label),
                    datasets: [{
                        data: dataPoints.map(point => point.y),
                        backgroundColor: dataPoints.map(point => point.backgroundColor), // Dynamically assigned color
                        borderColor: dataPoints.map(point => point.borderColor),         // Dynamically assigned border color
                        borderWidth: 5,                                                   // Static border width (same for all segments)
                        hoverOffset: 4,                                                   // Static hover offset (same for all segments)
                        borderRadius: 15,                                                 // Static border radius (same for all segments)
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                color: '#838383'
                            }
                        },
                        tooltip: {
                            callbacks: {
                                // Format the tooltip value as decimal with two decimal places
                                label: function(tooltipItem) {
                                    return '$' + tooltipItem.raw.toFixed(2); // Format to 2 decimal places
                                }
                            }
                        }
                    }
                }
            });
        });


        
        <?php
            $dataLeadsReport = [];
            $user = auth()->user();

            // Check if a date range is provided
            if (request()->get('from_date_input_lead') && request()->get('to_date_input_lead')) {
                $fromDate = request()->get('from_date_input_lead');
                $toDate = request()->get('to_date_input_lead');

                foreach (\App\Stage::all() as $stage) {
                    $queryBase = \App\Lead::whereBetween('lead_date', [$fromDate, $toDate])
                        ->where('stage_id', $stage->id)
                        ->where('lead_status', 'won');

                    // Apply role-based filtering
                    if ($user->hasRole('customer')) {
                        $queryBase->where('customer_id', $user->id);
                    } elseif (!$user->hasRole('user')) {
                        $queryBase->where('representative_id', $user->id);
                    }

                    // Get lead count and sum of lead prices
                    $stageLeads = $queryBase->count();
                    $totalLeadAmount = $queryBase->sum('lead_price');

                    $dataLeadsReport[] = [
                        'label' => $stage->name,
                        'y' => $stageLeads,
                    ];
                }
            } else {
                // Handle year selection (including all_year)
                $selectedYear = request('year') ?? ($yearEstimation->year ?? null);
                $yearList = ($selectedYear === 'all_year') ? \App\YearEstimation::pluck('year')->toArray() : [$selectedYear];

                foreach (\App\Stage::all() as $stage) {
                    $queryBase = \App\Lead::where('stage_id', $stage->id)
                        ->where('lead_status', 'won')
                        ->where(function ($query) use ($yearList) {
                            foreach ($yearList as $year) {
                                $query->orWhereYear('lead_status_date', $year);
                            }
                        });

                    // Apply role-based filtering
                    if ($user->hasRole('customer')) {
                        $queryBase->where('customer_id', $user->id);
                    } elseif (!$user->hasRole('user')) {
                        $queryBase->where('representative_id', $user->id);
                    }

                    // Get lead count and sum of lead prices
                    $stageLeads = $queryBase->count();
                    $totalLeadAmount = $queryBase->sum('lead_price');

                    $dataLeadsReport[] = [
                        'label' => $stage->name,
                        'y' => $stageLeads,
                    ];
                }
            }
        ?>

        document.addEventListener('DOMContentLoaded', function () {
            var dataPoints = <?php echo json_encode($dataLeadsReport, 15, 512) ?>;
            const backgroundBar = {
                id: 'backgroundBar',
                beforeDatasetsDraw(chart, args, pluginOptions) {
                    const { ctx, chartArea: { left, top, right, bottom }, scales: { x, y } } = chart;
                    ctx.save();
                    ctx.fillStyle = '#F9FFF2';
                    const barWidth = 35;
                    const borderRadius = 35;
                    for (let i = 0; i < dataPoints.length; i++) {
                        const xPixel = x.getPixelForValue(i) - barWidth / 2;
                        ctx.fillRect(xPixel, top, barWidth, bottom - top);
                        ctx.save();
                        ctx.fillStyle = '#F9FFF2';
                        ctx.shadowColor = '#6060601F';
                        ctx.shadowOffsetX = 0;
                        ctx.shadowOffsetY = 2;
                        ctx.shadowBlur = 4;
                        ctx.beginPath();
                        ctx.moveTo(xPixel + borderRadius, top);
                        ctx.lineTo(xPixel + barWidth - borderRadius, top);
                        ctx.quadraticCurveTo(xPixel + barWidth, top, xPixel + barWidth, top + borderRadius);
                        ctx.lineTo(xPixel + barWidth, bottom - borderRadius);
                        ctx.quadraticCurveTo(xPixel + barWidth, bottom, xPixel + barWidth - borderRadius, bottom);
                        ctx.lineTo(xPixel + borderRadius, bottom);
                        ctx.quadraticCurveTo(xPixel, bottom, xPixel, bottom - borderRadius);
                        ctx.lineTo(xPixel, top + borderRadius);
                        ctx.quadraticCurveTo(xPixel, top, xPixel + borderRadius, top);
                        ctx.closePath();
                        ctx.fill();
                        ctx.restore();
                    }
                    ctx.restore();
                }
            };
            var options = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    backgroundBar: { barColor: '#F9FFF2' },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return Math.round(context.parsed.y); // Display tooltip value as a whole number
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { font: { color: '#838383' } }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: { color: '#838383' },
                            callback: function(value, index, values) {
                                return value.toFixed(2);
                            }
                        }
                    }
                }
            };
            var ctx = document.getElementById('LeadsReportBarChart').getContext('2d');
            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dataPoints.map(point => point.label),
                    datasets: [{
                        data: dataPoints.map(point => point.y),
                        backgroundColor: '#74C911',
                        borderColor: '#F9FFF2',
                        borderWidth: 2,
                        borderSkipped: false,
                        barThickness: 35,
                        borderRadius: 35,
                    }]
                },
                options: options,
                plugins: [backgroundBar]
            });
        });

        const buttons = document.querySelectorAll('.see_More');
        let isSeeMore = true;
        buttons.forEach(button => {
            button.addEventListener('click', function () {
                if (isSeeMore) {
                    button.textContent = 'See Less';
                    button.innerHTML += '<i class="fa fa-caret-up"></i>';
                } else {
                    button.textContent = 'See More';
                    button.innerHTML += '<i class="fa fa-caret-down"></i>';
                }//ends else if.
                isSeeMore = !isSeeMore;
            });
        }); //ends buttons.forEach.
    </script>
    <script>
        $(document).ready(function() {
            $('.timeline_title').each(function() {
                var backgroundColor = $(this).css('background-color');
                var brightness = getBrightness(backgroundColor);
                var textColor = brightness > 180 ? 'black' : 'white'; // Adjust threshold as needed

                $(this).find('span').css('color', textColor);
            });

            // Function to calculate brightness
            function getBrightness(rgbColor) {
                var matches = rgbColor.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
                if (!matches) return 0;
                var r = parseInt(matches[1]);
                var g = parseInt(matches[2]);
                var b = parseInt(matches[3]);
                return (r * 299 + g * 587 + b * 114) / 1000;
            }
        });
        $(document).ready(function() {
            $('.tab-pane').each(function() {
                var goalAmountText = $(this).find('.monthly_amount').text().trim() || "$0";
                var monthlyGoal = parseFloat(goalAmountText.replace(/[^\d.-]/g, '')) || 0;
                var achievedAmountText = $(this).find('.achieved_amount').text().trim() || "$0";
                var monthlyProduction = parseFloat(achievedAmountText.replace(/[^\d.-]/g, '')) || 0;
                var monthlyPercentage = monthlyGoal > 0 ? (monthlyProduction / monthlyGoal * 100) : 0;
                $(this).find('.productionPercentage').text(monthlyPercentage.toFixed(2) + '%');
            });
        });
    </script>
    <script>
        $(document).on('click', '.achieved_amount', function() {
            var leadID = $(this).attr('data-lead-id');
            $.ajax({
                url: '<?php echo e(route('get_leads_detail')); ?>',
                type: 'GET',
                data: {
                    lead_id: leadID
                },
                dataType: 'json',
                success: function(response) {
                    $('#leadsTable tbody').empty();
                    $('#leadsTable tbody').html(
                        response.leads.length === 0
                            ? '<tr><td colspan="2" class="text-center">No data available</td></tr>'
                            : response.leads.map(function(lead) {
                                return '<tr>' +
                                    '<td>' + lead.title + '</td>' +
                                    '<td>$' + parseFloat(lead.total_price).toFixed(2) + '</td>'
                                '</tr>';
                            }).join('')
                    );
                    $('#leadModal').modal('show');
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                    Swal.fire('Error!', 'Request failed: ' + errorMessage, 'error');
                }
            });
        });

        // click outside of filter to closed it
        $(document).ready(function(){
            $(document).click(function(event) {
                if (!$(event.target).closest('.graph_filter').length) {
                    $('.graph_filter_box').hide();  // Close all filter boxes
                }
            });
            flatpickr(".date_format", {
                dateFormat: "m/d/Y",
            });
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/dashboard/index.blade.php ENDPATH**/ ?>