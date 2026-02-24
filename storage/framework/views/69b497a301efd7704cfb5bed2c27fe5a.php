

<?php $__env->startPush('css'); ?>
    <link href="<?php echo e(asset('plugins/components/datatables/jquery.dataTables.min.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title pull-left"><?php echo e(preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Staff')); ?></h3>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add-'.str_slug('Staff'))): ?>
                            <a class="btn btn-success pull-right" href="<?php echo e(url('/staff/staff/create')); ?>">Add <?php echo e(preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Staff')); ?> <i class="icon-plus"></i> </a>
                        <?php endif; ?>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="button_logo">
                            <button type="button" class="btn borderRadius delete_inbox_email green_btn" data-notification-id="" id="btn-delete-multiple">
                                <span class="fa fa-trash"></span>
                            </button>
                            <button type="button" class="btn green_btn borderRadius add_job_note_modal_btn" > <span class="fa fa-envelope"></span> </button>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add-'.str_slug('Announcement'))): ?>
                                <button type="button" class="btn green_btn borderRadius add_announcement_btn" > <span class="fa fa-bell"></span> </button>
                            <?php endif; ?>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="myTable">
                                <thead>
                                <tr>
                                    <th>
                                        <div class="custom_checkbox">
                                            <input class="noti_check" type="checkbox" name="notify_check" id="notify_check">
                                            <label for="notify_check"></label>
                                        </div>
                                        
                                    </th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>

                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="staff_check">
                                        <td>
                                            <div class="custom_checkbox">
                                                <input class="noti_check noti_checks" type="checkbox" data-staffCheck-id="<?php echo e($item->id); ?>">
                                                <label for="notify_check_<?php echo e($item->id); ?>"></label>
                                            </div>
                                        </td>
                                        <td><?php echo e($item->name??"Not Available"); ?></td>
                                        <td><?php echo e($item->email??"Not Available"); ?></td>
                                        <td><?php echo e($item->profile->phone??"Not Available"); ?></td>




                                        
                                        <td>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->status == 1): ?>
                                                <a href="<?php echo e(route('change_staff_status', [$item->id, 0])); ?>" onclick="return confirmAndDisable(this);">
                                                    <div class="lead_check">
                                                        <div class="status_btn">
                                                            <label for="status-<?php echo e($item->id); ?>">
                                                                <badge class="badge badge-success">
                                                                    Active
                                                                </badge>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </a>
                                            <?php else: ?>
                                                <a href="<?php echo e(route('change_staff_status', [$item->id, 1])); ?>" onclick="return confirmAndDisable(this);">
                                                    <div class="lead_check">
                                                        <div class="status_btn">
                                                            <label for="status-<?php echo e($item->id); ?>">
                                                                <badge class="badge badge-warning">
                                                                    Inactive
                                                                </badge>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </a>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        </td>
                                        <td class="btn_td">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-'.str_slug('Staff'))): ?>
                                                <a href="<?php echo e(url('/staff/staff/' . $item->id)); ?>"
                                                   title="View <?php echo e(preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Staff')); ?>">
                                                    <button class="btn view_btn btn-sm">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </button>
                                                </a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-'.str_slug('Staff'))): ?>
                                                <a href="<?php echo e(url('staff_time_clock/' . $item->id)); ?>" class="btn view_btn btn-sm" title="View <?php echo e(preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Clock')); ?>">
                                                    <i class="fa fa-clock" aria-hidden="true"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-'.str_slug('Staff'))): ?>
                                                <a href="<?php echo e(url('/staff/staff/' . $item->id . '/edit')); ?>"
                                                   title="Edit <?php echo e(preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Staff')); ?>">
                                                    <button class="btn edit_btn btn-sm">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </button>
                                                </a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-'.str_slug('Staff'))): ?>
                                                <form method="POST"
                                                      action="<?php echo e(url('/staff/staff' . '/' . $item->id)); ?>"
                                                      accept-charset="UTF-8" style="display:inline" class="delete-form">
                                                    <?php echo e(method_field('DELETE')); ?>

                                                    <?php echo e(csrf_field()); ?>

                                                    <button type="button" class="btn delete_btn btn-sm"
                                                            title="Delete <?php echo e(preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Staff')); ?>"
                                                            onclick="showDeleteConfirmation(this)"><i class="fa fa-trash" aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal" id="addEmails" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJob">Emails</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal emailValidate" method="get" id="email_form" action="<?php echo e(route('send_email_to_users')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="subject" class="form-control" placeholder="Enter Subject" id="subject" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Attachments *</label>
                                        <div class="input_fields_wrap_right">
                                            <div class="custom_add_inputs">
                                                <input type="file" name="mail_attachment[]" placeholder="Subject" class="form-control" value="" />
                                                <button class="btn remove_button" type="button"><i class="fa fa-times" aria-hidden="true"></i></button>
                                            </div>
                                            <button class="add_field_button btn btn-warning " type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="recipient-name" class="input_labels control-label">Description:</label>
                                        <textarea class="form-control" rows="5" name="description" type="textarea" id="description"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class=" d-flex justify-content-center ">
                                            <button class="btn green_btn borderRadius add_task_modal_btn " type="submit">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="addAnnouncement" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJob">Enter Announcement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal validateAnnoucement" method="POST" id="add_announcement_form" action="<?php echo e(route('annoucement_assign_to_staff')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 control-label text_align_disabling">
                                    <label for="announcement_description"><?php echo e('Description'); ?></label>

                                    <textarea class="form-control " rows="5" name="description" type="textarea" id="announcement_description" ></textarea>
                                </div>


                                <div class="col-md-12 text-center">
                                    <input class="btn green_btn_description" type="submit" value="Create">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
    <script src="<?php echo e(asset('plugins/components/toast-master/js/jquery.toast.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/components/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>






    <!-- start - This is for export functionality only -->
    <!-- end - This is for export functionality only -->
    <script>
        //  ===============  CK editor JS  ==================

        $(document).ready(function() {
            CKEDITOR.replace('description');
        });
        $(document).ready(function() {
            CKEDITOR.replace('announcement_description');
        });
        $(document).ready(function () {
            $('#notify_check').change(function () {
                if (this.checked) {
                    $('.noti_checks').prop('checked', true);
                } else {
                    $('.noti_checks').prop('checked', false);
                }
            });
        });

        

        
        
        
        
        
        
        
        
        
        
        
        

        function confirmAndDisable(link) {
            event.preventDefault();
            if (link.classList.contains('disabled')) {
                return false; // Link is already disabled
            }
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to change the status!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change it!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    link.classList.add('disabled'); // Disable the link
                    window.location = link.href;
                }
            });
        }


        $(function () {
            $('#myTable').DataTable({
                'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': [-1] /* 1st one, start by the right */
                }]
            });

        });
        $(document).on('click', '#btn-delete-multiple', function (event) {
            event.preventDefault();
            var selectedStaffCount = $('.noti_checks:checked').length;

            if (selectedStaffCount === 0) {
                Swal.fire('Warning!', 'Please select at least one staff member to delete.', 'warning');
                return;
            }
            showConfirmationDialog();
        });

        function showConfirmationDialog() {
            Swal.fire({
                title: 'Are You Sure You Want To Delete The Staff?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {
                if (result.isConfirmed) {
                    deleteSelectedStaffs();
                }
            });
        }

        function deleteSelectedStaffs() {
            var selectedStaffIDs = [];
            $('.noti_checks:checked').each(function () {
                selectedStaffIDs.push($(this).attr('data-staffCheck-id'));
            });
            $.ajax({
                url: "<?php echo e(route('staff_multiple_delete')); ?>",
                type: 'POST',
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    ids: selectedStaffIDs
                },

                success: function(response) {
                    selectedStaffIDs.forEach(function (id) {
                        $('.noti_checks[data-staffCheck-id="' + id + '"]').closest('.staff_check').remove();
                    });
                    if (response == "success") {
                        Swal.fire({
                            title: "Selected Staffs Deleted Successfully",
                            icon: "success",
                            timer: 5000,
                            buttons: false,
                        });
                    }
                    console.log('Delete IDS:', selectedStaffIDs);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Delete Error:', textStatus, errorThrown);
                }
            });
        }


        $(document).on('click','.add_job_note_modal_btn',function(e){
            e.preventDefault();
            var user_ids = [];
            $('.noti_checks:checked').each(function() {
                var contact_id = $(this).attr('data-staffCheck-id');
                user_ids.push(contact_id);
                $('#email_form').append($('<input>', {type: 'hidden', name: 'user_ids[]', value: contact_id}));
            });
            if (user_ids.length === 0) {
                Swal.fire({
                    title: 'please select staff first',
                    text: '',
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok',
                    timer: 5000,
                });
            } else {
                $('#addEmails').modal('show');
            }
        });

        $(document).on('click', '.add_announcement_btn', function (e) {
            e.preventDefault();
            var user_ids = [];
            $('.noti_checks:checked').each(function () {
                var contact_id = $(this).attr('data-staffCheck-id');
                user_ids.push(contact_id);
            });

            if (user_ids.length === 0) {
                Swal.fire({
                    title: 'please select staff first',
                    text: '',
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok',
                    timer: 5000,
                });
            } else {
                $('#addAnnouncement').modal('show');

                // Append hidden input fields after modal is shown
                $.each(user_ids, function (index, contact_id) {
                    $('#add_announcement_form').append($('<input>', { type: 'hidden', name: 'user_ids[]', value: contact_id }));
                });
            }
        });

        $(document).ready(function() {
            $.validator.addMethod("ckrequired", function(value, element) {
                var id = $(element).attr('id');
                var editorInstance = CKEDITOR.instances[id];
                return !!(editorInstance && editorInstance.getData().length);
            }, "This field is required");
            $('.emailValidate').validate({
                ignore: [],
                rules: {
                    subject: {
                        required: true
                    },
                    description: {
                        ckrequired: true
                    }
                },
                messages: {
                    subject: {
                        required: "Subject required."
                    },
                    description: {
                        ckrequired: "Description required."
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });

        $(document).ready(function() {
            $.validator.addMethod("ckrequired", function(value, element) {
                var id = $(element).attr('id');
                var editorInstance = CKEDITOR.instances[id];
                return !!(editorInstance && editorInstance.getData().length);
            }, "This field is required");
            $('.validateAnnoucement').validate({
                ignore: [],
                rules: {
                    description: {
                        ckrequired: true
                    }
                },
                messages: {
                    description: {
                        ckrequired: "Description required."
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });

    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/staff/staff/index.blade.php ENDPATH**/ ?>