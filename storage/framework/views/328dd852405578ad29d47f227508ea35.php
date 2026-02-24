
<?php $__env->startPush('css'); ?>
    <link href="<?php echo e(asset('plugins/components/datatables/jquery.dataTables.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <style>
        .onboarding_form .form-group {
            margin-left: 0px;
            margin-right: 0px;
        }

        .onboarding_form .dropdown-input {
            position: relative;
        }


        .onboarding_form .dropdown-input>svg {
            top: 40px;
            width: 28px;
            height: 100%;
            cursor: pointer;
            position: absolute;
            /* transform: translateY(-50%); */
            bottom: 0;
            margin: auto 0;
            height: fit-content;
            right: 20px;
        }

        .onboarding_form .dropdown-show .dropdown-row {
            opacity: 1;
            right: -2px;
            transition: .5s;
            visibility: visible;
        }

        .onboarding_form .dropdown-row {
            top: -20px;
            z-index: 1;
            opacity: 0;
            right: -20%;
            height: 350px;
            transition: .5s;
            overflow: hidden;
            visibility: hidden;
            position: absolute;
            border-radius: 10px;
            background: #F3F4F6;
            border: 1px solid #DCDBDB;
            box-shadow: 0 8px 21px #e8e8e8;
        }

        .onboarding_form .dropdown-show-ul {
            min-width: 380px;
            max-width: 380px;
        }

        .onboarding_form .dropdown-row .dropdown-header {
            padding: 0;
            display: flex;
            align-items: center;
            margin: 15px 10px 10px;
            justify-content: space-between;
        }

        .onboarding_form .dropdown-input *:not(svg) {
            font-size: 14px;
        }

        .onboarding_form .dropdown-col {
            display: flex;
            background: #fff;
            justify-content: space-between;
        }

        .onboarding_form .dropdown-show-ul .dropdown-ul {
            display: block;
        }

        .form-horizontal .dropdown-col>* {
            width: 100%;
            height: 240px;
            overflow-y: auto;
        }

        .onboarding_form .dropdown-input ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        .onboarding_form .dropdown-input ul>li {
            padding: 15px;
            cursor: pointer;
            line-height: 1.2;
            color: #374151;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .onboarding_form .dropdown-row .dropdown-header>svg {
            cursor: pointer;
        }

        .onboarding_form .dropdown-input svg {
            width: 21px;
        }

        .onboarding_form .dropdown-header h6 {
            margin: 0;
            display: flex;
            align-items: center;
            text-transform: capitalize;
            justify-content: space-between;
        }

        .onboarding_form .drowpdown-icon {
            top: 5px;
            right: 3%;
            position: absolute;
        }

        form .form-group .ck-reset_all :not(.ck-reset_all-excluded *),
        form .form-group .ck.ck-reset,
        form .form-group .ck.ck-reset_all {
            background-color: #F5F5F5;
        }

        form .form-group .ck.ck-editor__main .ck-editor__editable {
            background-color: #F5F5F5;
            min-height: 120px;
        }

        /* Status badge hover cursor */
        .status_btn a,
        .status_btn label,
        .status_btn badge {
            cursor: pointer !important;
        }

        .lead_check a:hover {
            cursor: pointer !important;
        }

        .badge:hover {
            cursor: pointer !important;
            opacity: 0.8;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <section class="lead-card-view">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box lead_lead_page my_lead_parent">
                        <form class="onboarding_form">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="white-box-header">
                                        <div class="white-box-header-left">
                                            <h3 class="box-title">
                                                <?php echo e(preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Customer Onboarding')); ?>

                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="onboarding_subject">Subject*</label>
                                        <input type="text" name="subject" id="onboarding_subject"
                                            class="form-control clr_input_fields borderRadius" placeholder="Enter Subject"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="onboarding_description">Content*</label>
                                        <div class="dropdown-input">
                                            <textarea class="form-control note_description" name="description" id="onboarding_description"
                                                placeholder="Enter Description" required style="min-height: 120px;"></textarea>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="drowpdown-icon" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                                </path>
                                            </svg>
                                            <div class="dropdown-row">
                                                <div class="dropdown-header">
                                                    <h6>
                                                        <span>Email Variables</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                    </h6>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </div>
                                                <input class="form-control" type="text" placeholder="Type to search"
                                                    name="search-type">
                                                <div class="dropdown-col">
                                                    <div class="dropdown-ul">
                                                        <ul data-heading="contact" style="display: block;">
                                                            <li data-label="{customer_name}">Customer Name</li>
                                                            <li data-label="{customer_email}">Customer Email</li>
                                                            <li data-label="{customer_phone}">Customer Phone</li>
                                                            <li data-label="{company_name}">Company Name</li>
                                                            <li data-label="{current_date}">Current Date</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- Submit Button Section -->
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="button" class="btn btn-success send_welcome_email_btn"
                                        id="sendWelcomeEmailBtn">
                                        <i class="fa fa-envelope"></i> Send Welcome Email to Selected Customers
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class=" white-box">
                        <div class="table-responsive ">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="custom_checkbox">
                                                <input class="noti_check" type="checkbox" name="notify_check"
                                                    id="notify_check">
                                                <label for="notify_check"></label>
                                            </div>
                                        </th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="staff_check">
                                            <td>
                                                <div class="custom_checkbox">
                                                    <input class="noti_check noti_checks" type="checkbox"
                                                        id="cardCheckbox<?php echo e($customer->id); ?>"
                                                        data-customercheck-id="<?php echo e($customer->id); ?>">
                                                    <label for="cardCheckbox<?php echo e($customer->id); ?>"></label>
                                                </div>
                                            </td>
                                            <td class="customer_card_name">
                                                <?php echo e($customer->first_name . ' ' . $customer->last_name ?? 'Not Available'); ?>

                                            </td>
                                            <td class="only_email_customer_card"><?php echo e($customer->email ?? 'Not Available'); ?>

                                            </td>
                                            <td class="">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($customer->status == 1): ?>
                                                    <a href="<?php echo e(route('change_staff_status', [$customer->id, 2])); ?>"
                                                        onclick="return confirmAndDisable(this);">
                                                        <div class="lead_check">
                                                            <div class="status_btn">
                                                                <label for="status-<?php echo e($customer->id); ?>">
                                                                    <badge class="badge badge-success">
                                                                        Active
                                                                    </badge>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </a>
                                                <?php else: ?>
                                                    <a href="<?php echo e(route('change_staff_status', [$customer->id, 1])); ?>"
                                                        onclick="return confirmAndDisable(this);">
                                                        <div class="lead_check">
                                                            <div class="status_btn">
                                                                <label for="status-<?php echo e($customer->id); ?>">
                                                                    <badge class="badge badge-warning">
                                                                        Inactive
                                                                    </badge>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </a>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

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
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script src="<?php echo e(asset('plugins/components/toast-master/js/jquery.toast.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/components/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script>
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
        $(function() {
            $('#myTable').DataTable({
                'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': [-1] /* 1st one, start by the right */
                }]
            });

        });
        $(document).ready(function() {
            $('#notify_check').change(function() {
                if (this.checked) {
                    $('.noti_checks').prop('checked', true);
                } else {
                    $('.noti_checks').prop('checked', false);
                }
            });
        });
        // Initialize CK Editor for note_description class (following project pattern)
        $(document).ready(function() {
            // Check if ClassicEditor is available
            function initializeCKEditor() {
                if (typeof ClassicEditor !== 'undefined') {
                    $('.note_description').each(function() {
                        if (!$(this).data("editor-instance")) {
                            console.log("Initializing CKEditor for:", this);
                            ClassicEditor.create(this, {
                                    toolbar: {
                                        items: [
                                            'heading', '|',
                                            'bold', 'italic', 'underline', '|',
                                            'bulletedList', 'numberedList', '|',
                                            'outdent', 'indent', '|',
                                            'link', 'blockQuote', '|',
                                            'undo', 'redo'
                                        ]
                                    },
                                    height: '120px'
                                })
                                .then(editor => {
                                    $(this).data("editor-instance", editor);

                                    // Store editor instance globally for dropdown functionality
                                    window.ckEditorInstance = editor;

                                    // Set editor height
                                    editor.editing.view.change(writer => {
                                        writer.setStyle('min-height', '120px', editor
                                            .editing.view.document.getRoot());
                                    });

                                    editor.model.document.on('change:data', () => {
                                        $(this).val(editor.getData()).trigger('keyup');
                                    });
                                    console.log("✅ CKEditor initialized successfully!");
                                })
                                .catch(error => {
                                    console.error("❌ Error initializing CKEditor:", error);
                                });
                        }
                    });
                } else {
                    console.log("⏳ ClassicEditor not ready, retrying...");
                    setTimeout(initializeCKEditor, 200);
                }
            }

            // Start initialization after a short delay
            setTimeout(initializeCKEditor, 100);
        });

        // Send Welcome Email to Selected Customers
        $(document).on('click', '.send_welcome_email_btn', function() {
            var selectedCustomers = [];
            var subject = $('#onboarding_subject').val();
            var description = '';

            // Get CKEditor content properly
            if (window.ckEditorInstance) {
                description = window.ckEditorInstance.getData();
            } else {
                // Fallback to textarea value
                description = $('#onboarding_description').val();
            }

            // Get selected customers
            $('.noti_checks:checked').each(function() {
                var customerId = $(this).attr('data-customercheck-id');
                selectedCustomers.push(customerId);
            });

            console.log('Form Data:', {
                subject: subject,
                description: description.substring(0, 100) + '...',
                selectedCustomers: selectedCustomers
            });

            // Validation
            if (selectedCustomers.length === 0) {
                Swal.fire({
                    title: 'No Customers Selected!',
                    text: 'Please select at least one customer to send welcome email.',
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok',
                    timer: 5000,
                });
                return;
            }

            if (!subject || subject.trim() === '') {
                Swal.fire({
                    title: 'Subject Required!',
                    text: 'Please enter a subject for the welcome email.',
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok',
                    timer: 5000,
                });
                return;
            }

            // Remove HTML tags for validation but keep original for sending
            var descriptionText = description.replace(/<[^>]*>/g, '').trim();
            if (!description || descriptionText === '' || description === '<p><br></p>' || description ===
                '<p></p>') {
                Swal.fire({
                    title: 'Description Required!',
                    text: 'Please enter a description for the welcome email.',
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok',
                });
                return;
            }

            // Confirmation dialog
            Swal.fire({
                title: 'Send Welcome Email?',
                text: `Are you sure you want to send welcome email to ${selectedCustomers.length} selected customer(s)?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Send Email!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    sendWelcomeEmailToCustomers(selectedCustomers, subject, description);
                }
            });
        });

        // Function to send welcome email
        function sendWelcomeEmailToCustomers(customerIds, subject, description) {
            // Show loading
            Swal.fire({
                title: 'Sending Emails...',
                text: 'Please wait while we send welcome emails to selected customers.',
                icon: 'info',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: "<?php echo e(route('send_welcome_email_to_customers')); ?>", // We'll create this route
                type: 'POST',
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    customer_ids: customerIds,
                    subject: subject,
                    description: description
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: `Welcome emails sent successfully to ${customerIds.length} customer(s).`,
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok',
                            timer: 5000,
                        });

                        // Clear form
                        $('#onboarding_subject').val('');

                        // Clear CKEditor content
                        if (window.ckEditorInstance) {
                            window.ckEditorInstance.setData('');
                        } else {
                            $('#onboarding_description').val('');
                        }
                        location.reload();

                        // Uncheck all checkboxes
                        $('.noti_checks').prop('checked', false);
                        $('#notify_check').prop('checked', false);

                    } else {
                        console.log('Error response:', response); // Debug log
                        let errorMessage = response.message ||
                            'Failed to send welcome emails. Please try again.';

                        // Add debug info if available
                        if (response.debug_info) {
                            console.log('Debug info:', response.debug_info);
                            errorMessage += '\n\nDebug Info:\n';
                            response.debug_info.forEach(function(customer) {
                                errorMessage +=
                                    `Customer ID ${customer.id}: ${customer.exists ? 'Found' : 'Not Found'}`;
                                if (customer.exists) {
                                    errorMessage += `, Email: ${customer.email || 'No Email'}`;
                                }
                                errorMessage += '\n';
                            });
                        }

                        Swal.fire({
                            title: 'Error!',
                            text: errorMessage,
                            icon: 'error',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok',
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error sending welcome emails:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to send welcome emails. Please try again.',
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok',
                    });
                }
            });
        }

        $(document).on('click', '.add_email_modal_btn', function() {
            var customerId = $(this).attr("customer-id");
            $("#user_id_input").val(customerId);
        });
        $(document).ready(function() {
            var phone_count = 1;
            $(".input_fields_wrap_right .add_field_button").click(function() {
                var tr =
                    '<input type="file" name="mail_attachment[]"  placeholder="Subject" class="form-control" /> <button class="btn remove_button" type="button" ><i class="fa fa-times" aria-hidden="true"></i></button>';
                var rowCount = $('.input_fields_wrap_right .custom_add_inputs').length;
                if (rowCount >= 1 && rowCount <= 4) {
                    $('.input_fields_wrap_right').prepend("<div class='custom_add_inputs'>" + tr +
                        "</div>");
                }
                phone_count++;
            });
            $(".input_fields_wrap_right").on('click', '.remove_button', function() {
                var rowCount = $('.input_fields_wrap_right .custom_add_inputs').length;
                if (rowCount > 1) {
                    $(this).closest('.input_fields_wrap_right .custom_add_inputs').remove();
                }
            });
        });
        $(document).on('change', '#type_communication', function() {
            var type = $(this).val();
            if (type == 'email') {
                $('.attachment_for_email').show();
            } else {
                $('.attachment_for_email').hide();
            }
        });
        $(document).on('click', '#btn-delete-multiple', function(event) {
            event.preventDefault();
            var selectedStaffCount = $('.noti_checks:checked').length;
            if (selectedStaffCount === 0) {
                Swal.fire('Warning!', 'Please select at least one customer  to delete.', 'warning');
                return;
            }
            showConfirmationDialog();
        });

        function showConfirmationDialog() {
            Swal.fire({
                title: 'Are You Sure You Want To Delete The Customer?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {
                if (result.isConfirmed) {
                    deleteSelectedCustomers();
                }
            });
        }

        function deleteSelectedCustomers() {
            selectedCustomerIDs = [];
            $('.noti_checks:checked').each(function() {
                selectedCustomerIDs.push($(this).attr('data-customerCheck-id'));
            });
            $.ajax({
                url: "<?php echo e(route('customer_multiple_delete')); ?>",
                type: 'POST',
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    ids: selectedCustomerIDs
                },
                success: function(response) {
                    selectedCustomerIDs.forEach(function(id) {
                        $('.noti_checks[data-customerCheck-id="' + id + '"]').closest('.customer-box')
                            .remove();
                    });
                    if (response == "success") {
                        Swal.fire({
                            title: "Selected Customer Deleted Successfully",
                            icon: "success",
                            timer: 5000,
                            buttons: false,
                        });
                    }
                    location.reload();
                    console.log('Delete IDS:', selectedCustomerIDs);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Delete Error:', textStatus, errorThrown);
                }
            });
        }
        $(document).ready(function() {
            var phone_count = 1;
            $(".input_fields_wrap_right .add_field_button").click(function() {
                var tr =
                    '<input type="file" name="mail_attachment[]"  placeholder="Subject" class="form-control" value=""/> <button class="btn remove_button" type="button" ><i class="fa fa-times" aria-hidden="true"></i></button>';
                var rowCount = $('.input_fields_wrap_right .custom_add_inputs').length;
                if (rowCount >= 1 && rowCount <= 4) {
                    $('.input_fields_wrap_right').prepend("<div class='custom_add_inputs'>" + tr +
                        "</div>");
                }
                phone_count++;
            });

            $(".input_fields_wrap_right").on('click', '.remove_button', function() {
                var rowCount = $('.input_fields_wrap_right .custom_add_inputs').length;
                if (rowCount > 1) {
                    $(this).closest('.input_fields_wrap_right .custom_add_inputs').remove();
                }
            });
        });
        $(document).on('click', '.add_mail_modal_btn', function(e) {
            e.preventDefault();
            var user_ids = [];
            $('.noti_checks:checked').each(function() {
                var contact_id = $(this).attr('data-customerCheck-id');
                user_ids.push(contact_id);
                $('#email_form').append($('<input>', {
                    type: 'hidden',
                    name: 'user_ids[]',
                    value: contact_id
                }));
            });
            if (user_ids.length === 0) {
                Swal.fire({
                    title: 'Please select customer first',
                    text: '',
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok',
                    timer: 5000,
                });
            } else {
                $('#addEmailModalBtn').modal('show');
            }
        })
        // Select All functionality for table
        $(document).ready(function() {
            // Select All checkbox functionality
            $('#notify_check').on('change', function() {
                var isChecked = $(this).is(':checked');
                $('.noti_checks').prop('checked', isChecked);
            });

            // Individual checkbox change
            $(document).on('change', '.noti_checks', function() {
                var totalCheckboxes = $('.noti_checks').length;
                var checkedCheckboxes = $('.noti_checks:checked').length;

                if (totalCheckboxes === checkedCheckboxes) {
                    $('#notify_check').prop('checked', true);
                } else {
                    $('#notify_check').prop('checked', false);
                }
            });


        });

        // Dropdown functionality for email variables
        $(document).ready(function() {
            $(document).on('click', '.dropdown-input > svg', function() {
                $(this).closest(".dropdown-input").addClass("dropdown-show");
                $(this).closest(".dropdown-input").find('.dropdown-row').addClass("dropdown-show-ul");
            });

            $(document).on('click', '.dropdown-row .dropdown-header > svg', function() {
                $(this).closest(".dropdown-input").removeClass("dropdown-show");
                $(".dropdown-row").removeClass("dropdown-show-ul");
                $(".dropdown-header h6 > span").text("Email Variables");
                $(".dropdown-row > input").val("");
            });

            $(document).on('click', '.dropdown-ul ul > li', function() {
                let label = $(this).data("label");
                console.log('Inserting variable:', label);

                if (window.ckEditorInstance) {
                    // Get the current selection position
                    const selection = window.ckEditorInstance.model.document.selection;
                    const position = selection.getFirstPosition();

                    // Insert the variable at cursor position
                    window.ckEditorInstance.model.change(writer => {
                        const text = writer.createText(' ' + label + ' ');
                        writer.insert(text, position);
                    });

                    // Focus back on the editor
                    window.ckEditorInstance.editing.view.focus();
                }

                $(this).closest(".dropdown-input").find('.dropdown-row').removeClass("dropdown-show-ul");
                $(this).closest(".dropdown-input").removeClass("dropdown-show");
            });

            // Search Filter for variables
            $('.dropdown-row > input').on('keyup', function() {
                var searchValue = $(this).val().toLowerCase();
                $(".dropdown-row").addClass("dropdown-show-ul");
                $(".dropdown-ul > ul").show();
                $('.dropdown-ul ul > li').each(function() {
                    var listItemText = $(this).text().toLowerCase();
                    if (listItemText.includes(searchValue)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });

        // $(document).on('click','.add_assign_annoucement',function(e){
        //     e.preventDefault();
        //     var user_ids = [];
        //     $('.noti_checks:checked').each(function(){
        //         var contact_id = $(this).attr('data-customerCheck-id');
        //         user_ids.push(contact_id);
        //         $('#announcement_form').append($('<input>', {type: 'hidden', name: 'user_ids[]', value: contact_id}));
        //     });
        //     if (user_ids.length === 0) {
        //         Swal.fire({
        //             title: 'please select customer first',
        //             text: '',
        //             icon: 'info',
        //             confirmButtonColor: '#3085d6',
        //             confirmButtonText: 'Ok',
        //             timer: 5000,
        //         });
        //     } else {
        //         $('#addAnnouncement').modal('show');
        //     }
        // })
        $(document).ready(function() {
            $(document).on('click', '.exportToExcel', function() {
                $('.preloader').fadeIn();
                $('body').css('overflow-y', 'hidden');

                $.ajax({
                    url: "<?php echo e(url('customers/export')); ?>",
                    method: 'GET',
                    data: {
                        customer_filter: '<?php echo e(request()->customer_filter); ?>',
                        duration_starts: '<?php echo e(request()->duration_starts); ?>',
                        duration_ends: '<?php echo e(request()->duration_ends); ?>'
                    },
                    success: function(data) {
                        console.log(data);
                        const customers = data.map(customer => ({
                            'Customer Name': (customer.first_name + ' ' + customer
                                .last_name) || 'Not Available',
                            'Customer Number': customer.created_at ?
                                'R' + new Date(customer.created_at).toISOString()
                                .slice(2, 10).replace(/-/g, '') : 'Not Available',
                            'Email': customer.email || 'Not Available',
                            'Created At': customer.created_at ?
                                new Date(customer.created_at).toISOString().slice(0,
                                    10) : 'Not Available',
                            'Phone Number': customer.profile?.phone ||
                                'Not Available',
                            'Category': customer.profile?.category?.name ||
                                'Not Available',
                            'Address': customer.profile?.address || 'Not Available',
                            'City': customer.profile?.city || 'Not Available',
                            'State': customer.profile?.state || 'Not Available',
                            'Zip': customer.profile?.zip || 'Not Available',
                            'Total Won Jobs': customer.customerLeads || '0',
                            'Total Won Job Price': customer.total_job_price !=
                                null ?
                                `$${Number(customer.total_job_price).toFixed(2)}` :
                                '0'
                        }));

                        const ws = XLSX.utils.json_to_sheet(customers);
                        const wb = XLSX.utils.book_new();
                        XLSX.utils.book_append_sheet(wb, ws, 'Customers');

                        const headers = [
                            'Customer Name', 'Customer Number', 'Email', 'Created At',
                            'Phone Number',
                            'Category', 'Address', 'City', 'State', 'Zip', 'Total Won Jobs',
                            'Total Won Job Price'
                        ];
                        XLSX.utils.sheet_add_aoa(ws, [headers], {
                            origin: 'A1'
                        });

                        XLSX.writeFile(wb, 'customers_export.xlsx');

                        $('.preloader').fadeOut();
                        $('body').css('overflow-y', 'auto');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching customer data:', error);
                        alert('Failed to export customers. Please try again.');
                        $('.preloader').fadeOut();
                        $('body').css('overflow-y', 'auto');
                    }
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/customer/customer/customer_onboarding.blade.php ENDPATH**/ ?>