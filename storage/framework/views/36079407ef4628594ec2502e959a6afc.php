

<?php $__env->startPush('css'); ?>
    <link href='<?php echo e(asset('plugins/components/fullcalendar/fullcalendar.css')); ?>' rel='stylesheet'>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="dashboard_sec">
        <div class="container-fluid">
            <div class="row">
                <?php
                    $boxes = [
                        ['Active Jobs:', $schedulingtask->where('job_status', 'active')->count(),'active_jobs_box', 'active-iocn.svg'],
                        ['Completed Jobs:', $schedulingtask->where('job_status', 'complete')->count(), 'completed_jobs_box', 'completed-iocn.svg'],
                        ['Upcoming Work Orders:', $subcontractor->subContractorProposal->where("status", "required")->count(), 'upcoming_work_box', 'upcoming-iocn.svg'],
                        ['Signed Work Orders:', $subcontractor->subContractorProposal->where("status", "signed")->count(), 'signed_Work_box', 'signed-iocn.svg']
                    ];
                ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $boxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$title, $count, $class, $background]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-3">
                        <div class="card info-box <?php echo e($class); ?>" style="background-image: url('<?php echo e(asset("website/images/$background")); ?>'); background-size: 75px 75px; background-repeat: no-repeat; background-position: right;">
                            <div class="card-header" >
                                <h6><?php echo e($title); ?></h6>
                            </div>
                            <div class="card-body">
                                <h4><?php echo e($count); ?></h4>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="row">
                            <div class="col-lg-2  col-md-3">
                                <div class="lead-jobs-calendar">
                                    <h5>Scheduled Tasks</h5>
                                    <div class="scheduled_task_list">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($schedulingtask)): ?>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $schedulingtask; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="scheduled_task_list_box" style="background-color: <?php echo e($task->getLead->category->color_id??''); ?>;">
                                                   <span > <?php echo e($task->getLead->title ?? ''); ?> - <?php echo e($task->getLead->category->name ?? ''); ?> </span>
                                                </div>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-10  col-md-9 ">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#calendar1"><i class="fa-solid fa-circle"></i></a></li>
                                    <li><a data-toggle="tab" href="#calendar2"><i class="fa-solid fa-minus"></i></a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="calendar1" class="tab-pane fade in active">
                                        <div id="calendar-view-one"></div>
                                    </div>
                                    <div id="calendar2" class="tab-pane fade">
                                        <div id="calendar-view-two"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Scheduling Task Details</h5>
                    <button type="button" class="close mx-3" data-dismiss="modal" aria-hidden="true"><i class="fa fa-remove"></i></button>
                </div>
                <div class="modal-body scheduling-modal-body">
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script src='<?php echo e(asset('plugins/components/moment/moment.js')); ?>'></script>
    <script src='<?php echo e(asset('plugins/components/fullcalendar/fullcalendar.js')); ?>'></script>
    <script>
        $(document).ready(function () {
            $('#calendar-view-one').fullCalendar({
                events: [
                        <?php $__currentLoopData = $schedulingtask; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    {
                        title: '<?php echo e($task->getLead->customer->last_name ?? ''); ?> - <?php echo e($task->getLead->category->name ?? ''); ?>',
                        eventID: '<?php echo e($task->id ?? ''); ?>',
                        
                                
                        backgroundColor: '<?php echo e($task->color_id); ?>',
                        borderColor: '<?php echo e($task->color_id); ?>',
                        textColor: '#FFF',
                        name: '<?php echo e($task->name ?? ''); ?>',
                        leadId: '<?php echo e($task->getLead->id ?? ''); ?>',
                        lead: '<?php echo e($task->getLead->title ?? ''); ?>',
                        leadPrice: '<?php echo e(optional($task->getLead)->lead_price ?? 0); ?>',
                        users: [
                            <?php $__currentLoopData = $task->getSchedulingUser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                '<?php echo e($item->getSchedulingUser->name ?? ''); ?>',
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        ],
                        team: '<?php echo e($task->getTeam->name ?? ''); ?>',
                        start: '<?php echo e($task->start_date ?? ''); ?>',
                        end: '<?php echo e($task->end_date ?? ''); ?>',
                        description: <?php echo json_encode($task->description); ?>,
                        address: '<?php echo e($task->getLead->address ?? ''); ?>',
                        tooltip: `Address: <?php echo e($task->getLead->customer->profile->address ?? "N/A"); ?><br> Details: <?php echo e($task->getLead->category->name ?? "N/A"); ?><br> Note: <?php echo strip_tags($task->getLead->description??""); ?>`
                    },
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                editable: false,
                eventRender: function(event, element) {
                    element.css({
                        backgroundColor: 'transparent',
                        // border: 'none',
                        borderRadius: 0,
                        color: 'rgba(74, 74, 74, 1)'
                    });
                    element.find('.fc-title').prepend(
                        `<span class="fc-event-dot" style="background-color:${event.backgroundColor}; width: 10px; height: 10px; border-radius: 50%; display: inline-block; margin-right: 5px; vertical-align: middle;"></span>`
                    );
                    element.attr('title', event.tooltip);
                    element.tooltip({
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body',
                        html: true

                    });
                },
                eventClick: function(event) {
                    console.log(event);

                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = event.description;
                    const decodedDescription = tempDiv.textContent || tempDiv.innerText || '';

                    const startDate = event.start ? moment(event.start).format('MM-DD-YYYY') : 'N/A';
                    const endDate = event.end ? moment(event.end).format('MM-DD-YYYY') : startDate;



                    $('.scheduling-modal-body').html(
                        '<div class="row">' +
                        '<div class="col-md-6"><div class="form-group"><label>Lead:</label> <input type="text" class="form-control" value="' + event.lead + '" readonly></div></div>' +
                        '<div class="col-md-6"><div class="form-group"><label>Task:</label> <input type="text" class="form-control" value="' + event.name + '" readonly></div></div>' +
                        '<div class="col-md-6"><div class="form-group"><label>Assign User:</label> <input type="text" class="form-control" value="' + event.users + '" readonly></div></div>' +
                        '<div class="col-md-6"><div class="form-group"><label>Assign Team:</label> <input type="text" class="form-control" value="' + event.team + '" readonly></div></div>' +
                        '<div class="col-md-6"><div class="form-group"><label>Start Date:</label> <input type="text" class="form-control" value="' + startDate + '" readonly></div></div>' +
                        '<div class="col-md-6"><div class="form-group"><label>End Date:</label> <input type="text" class="form-control" value="' + endDate + '" readonly></div></div>' +
                        '<div class="col-md-12"><div class="form-group"><label>Lead Description:</label> <textarea class="form-control" rows="5" readonly>' + decodedDescription + '</textarea></div></div>'+
                        '</div>'
                    );

                    
                    
                    
                    $('#eventModal').modal('show');
                }

            });

            $('#calendar-view-two').fullCalendar({
                events: [
                        <?php $__currentLoopData = $schedulingtask; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    {
                        title: '<?php echo e($task->getLead->customer->last_name ?? ''); ?> - <?php echo e($task->getLead->category->name ?? ''); ?>',
                        eventID: '<?php echo e($task->id ?? ''); ?>',
                        
                                
                        backgroundColor: '<?php echo e($task->color_id); ?>',
                        borderColor: '<?php echo e($task->color_id); ?>',
                        textColor: '#FFF',
                        name: '<?php echo e($task->name ?? ''); ?>',
                        leadId: '<?php echo e($task->getLead->id ?? ''); ?>',
                        lead: '<?php echo e($task->getLead->title ?? ''); ?>',
                        leadPrice: '<?php echo e(optional($task->getLead)->lead_price ?? 0); ?>',
                        users: [
                            <?php $__currentLoopData = $task->getSchedulingUser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                '<?php echo e($item->getSchedulingUser->name ?? ''); ?>',
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        ],
                        team: '<?php echo e($task->getTeam->name ?? ''); ?>',
                        start: moment('<?php echo e($task->start_date ?? ''); ?>').format('YYYY-MM-DD'),
                        end: moment('<?php echo e($task->end_date ?? ''); ?>').format('YYYY-MM-DD'),
                        description: <?php echo json_encode($task->description); ?>,
                        address: '<?php echo e($task->getLead->address ?? ''); ?>',
                        tooltip: `Address: <?php echo e($task->getLead->customer->profile->address ?? "N/A"); ?><br> Details: <?php echo e($task->getLead->category->name ?? "N/A"); ?><br> Note: <?php echo strip_tags($task->getLead->description??""); ?>`
                    },
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                editable: false,

                eventRender: function(event, element) {
                    element.css({
                        backgroundColor: event.color,
                        border: 'none',
                        borderRadius: 0
                    });
                    element.attr('title', event.tooltip);
                    element.tooltip({
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body',
                        html: true

                    });
                },
                eventClick: function(event) {
                    console.log(event);

                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = event.description;
                    const decodedDescription = tempDiv.textContent || tempDiv.innerText || '';

                    const startDate = event.start ? moment(event.start).format('YYYY-MM-DD') : 'N/A';
                    const endDate = event.end ? moment(event.end).format('YYYY-MM-DD') : startDate; // <- Fix here

                    $('.scheduling-modal-body').html(
                        '<div class="row">' +
                        '<div class="col-md-6"><div class="form-group"><label>Lead:</label> <input type="text" class="form-control" value="' + event.lead + '" readonly></div></div>' +
                        '<div class="col-md-6"><div class="form-group"><label>Task:</label> <input type="text" class="form-control" value="' + event.name + '" readonly></div></div>' +
                        '<div class="col-md-6"><div class="form-group"><label>Assign User:</label> <input type="text" class="form-control" value="' + event.users + '" readonly></div></div>' +
                        '<div class="col-md-6"><div class="form-group"><label>Assign Team:</label> <input type="text" class="form-control" value="' + event.team + '" readonly></div></div>' +
                        '<div class="col-md-6"><div class="form-group"><label>Start Date:</label> <input type="text" class="form-control" value="' + startDate + '" readonly></div></div>' +
                        '<div class="col-md-6"><div class="form-group"><label>End Date:</label> <input type="text" class="form-control" value="' + endDate + '" readonly></div></div>' +
                        '<div class="col-md-12"><div class="form-group"><label>Lead Description:</label> <textarea class="form-control" rows="5" readonly>' + decodedDescription + '</textarea></div></div>'+
                        '</div>'
                    );
                    
                    
                    
                    $('#eventModal').modal('show');
                }
            });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $('#calendar-view-one, #calendar-view-two').each(function () {
                    $(this).fullCalendar('render');
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.new-master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/dashboard/subContractorDashboard/index.blade.php ENDPATH**/ ?>