
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

    <section class="lead-card-view">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box lead_lead_page my_lead_parent">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="white-box-header">
                                    <div class="white-box-header-left">
                                        <h3 class="box-title"><?php echo e(preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Customer ')); ?></h3>
                                    </div>
                                    <div class="white-box-header-right">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add-'.str_slug('Customer'))): ?>
                                            <a class="btn blue_btn " href="<?php echo e(url('/customer/customer/create')); ?>">  Add <?php echo e(preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Customer')); ?> <i class="icon-plus"></i> </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="logoBtn_drop_wrapper ">
                                    <div class="logobtn_left_box button_logo">
                                        <button type="button" class="btn borderRadius delete_inbox_email green_btn" data-notification-id="" id="btn-delete-multiple" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"> <span class="fa fa-trash"></span> </button>
                                        <button type="button" class="btn green_btn borderRadius add_mail_modal_btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Email"> <span class="fa fa-envelope"></span> </button>
                                        
                                        
                                        
                                        
                                    </div>
                                    <div class="logobtn_right_box">
                                        <button type="button" class="btn green_btn  exportToExcel" data-bs-toggle="tooltip" data-bs-placement="top" title="Export to Excel">
                                            <i class="fa-solid fa-file-excel"></i>
                                        </button>
                                        <div class="view_type_box user_view_right_btn" >
                                            <a href="<?php echo e(url('user_view')); ?>" class="btn green_btn <?php echo e(Request::is('user_view') ? 'active' : ''); ?>"><img class="img-fluid" src="<?php echo e(asset('/website/images').'/cards-blank.svg'); ?> " ></a>
                                            <a href="<?php echo e(url('customer/customer')); ?>" class="btn green_btn <?php echo e(Request::is('customer/customer') ? 'active' : ''); ?>"><i class="fa-solid fa-list"></i></a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <form method="get" action="<?php echo e(url('user_view/')); ?>" id="filter-form">
                                    <div class="  filter_inputs_btns_wrapper ">
                                        <input type="hidden" name="customer_filter" value="yes">
                                        <div class=" filter_inputs_parent">
                                            <label for="duration_starts" class="form-label input_labels p-18">To </label>
                                            <input class="form-control clr_input_fields borderRadius" name="duration_starts" value="<?php echo e(request()->get('duration_starts') ?? ($yearEstimation->year . '-01-01')); ?>" type="date" id="duration_starts" required placeholder="Enter duration_starts"  >
                                        </div>
                                        <div class="filter_inputs_parent">
                                            <label for="duration_ends" class="form-label input_labels p-18">From </label>
                                            <input class="form-control clr_input_fields borderRadius" name="duration_ends" type="date" value="<?php echo e(request()->get('duration_ends') ?? ($yearEstimation->year . '-12-31')); ?>" id="duration_ends" required placeholder="duration_ends to_date"  >
                                        </div>

                                        <div class="filter_inputs_parent filter_btns_parent">
                                            <div class="reset_apply_btn">
                                                <button type="submit" class="btn blue_btn ">Apply <i class="fa-solid fa-check"></i></button>
                                                <a href="<?php echo e(url('user_view')); ?>" class="btn gray_btn ">Reset <img class="img-fluid" src="<?php echo e(asset('/website/images').'/recycle.svg'); ?> " ></a>
                                            </div>
                                        </div>

                                        
                                        
                                        
                                        
                                        
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row user-view-head">
                        <div class="col-md-4">
                            <div class="item-card-view">
                                <h4>Leads</h4>
                                <ul>
                                    <li> <?php echo e($lead->count()); ?> </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="item-card-view">
                                <h4> Appointments </h4>
                                <ul>
                                    <li> <?php echo e($appointment_count??"0"); ?> </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="item-card-view">
                                <h4>Sold</h4>
                                <ul>
                                    <li> <?php echo e($sold_lead_count??"0"); ?> </li>
                                    <li> $<?php echo e($sold_leads??"0"); ?> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="global_search_datatable_style search_filter_wrapper">
                        <div  class="dataTables_filter">
                            <label>
                                <input type="search" class="" id="userSearch" placeholder="Search" >
                                <div class="search_icon">
                                    <i class="fa fa-search"></i>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="customerContainer">
                    <div class="row user-view-item">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-4">
                                <div class="item-card-view customer-box">
                                    <div class="lead-card-top">
                                        <div class="custom_checkbox">
                                            <input class="noti_check noti_checks" type="checkbox" id="cardCheckbox<?php echo e($customer->id); ?>" data-customercheck-id="<?php echo e($customer->id); ?>" >
                                            <label for="cardCheckbox<?php echo e($customer->id); ?>"></label>
                                        </div>
                                        <div class="image-status">
                                            <div class="image-count">
                                                <a href="<?php echo e(url('customer/customer')); ?>/<?php echo e($customer->id); ?>" title="View <?php echo e(preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Lead')); ?>">
                                                    <img src="<?php echo e(asset('storage/uploads/users')); ?>/<?php echo e($customer->profile->pic ?: 'mA8rgUHtbm.jpg'); ?>">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="<?php echo e(url('customer/customer')); ?>/<?php echo e($customer->id); ?>" title="View <?php echo e(preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Lead')); ?>">
                                        <h4 class="customer_card_name"><?php echo e($customer->first_name.' '.$customer->last_name ?? "Not Available"); ?></h4>
                                    </a>
                                    <ul>
                                        <li class="email">
                                            <b>Customer Number:</b>
                                            <?php echo e($customer->profile->customer_number ?? 'R'.$customer->created_at->format('mdY') ?? "Not Available"); ?>

                                        </li>
                                        <li class="email only_email_customer_card"><b>Email:</b> <?php echo e($customer->email ?? "Not Available"); ?></li>
                                        <li class="email"><b>Created At:</b> <?php echo e($customer->created_at->format('m-d-Y') ?? "Not Available"); ?></li>
                                        <li class="phone-no"><b>Phone Number:</b>





                                                <?php echo e($customer->profile->phone??'Not Available'); ?>


                                        </li>
                                        <li class="category"><b>Category:</b> <?php echo e($customer->profile->category->name ?? "Not Available"); ?></li>
                                        <li class="address"><b>Address:</b> <?php echo e($customer->profile->address ?? "Not Available"); ?></li>
                                        <li class="action">
                                            <a href="<?php echo e(url('customer/customer')); ?>/<?php echo e($customer->id); ?>" class="btn btn_icon blue_btn" customer-id="<?php echo e($customer->id); ?>">
                                                <i class="fa-solid fa fa-eye"></i>
                                            </a>
                                            <a type="button" class="btn btn_icon float-right lead_check btn-success add_email_modal_btn"  customer-id="<?php echo e($customer->id); ?>" data-bs-toggle="modal" data-bs-target="#addEmailModalBtn">
                                                <i class="fa-solid fa fa-envelope"></i>
                                            </a>
                                            <a href="<?php echo e(url('customer/customer')); ?>/<?php echo e($customer->id); ?>/edit" class="btn btn_icon float-right lead_check btn-success" customer-id="<?php echo e($customer->id); ?>">
                                                <i class="fa-solid fa fa-pencil"></i>
                                            </a>
                                            <a href="#" class="toggle-status"
                                               data-id="<?php echo e($customer->id); ?>"
                                               data-status="<?php echo e($customer->status); ?>">
                                                                <span class="badge <?php echo e($customer->status == 1 ? 'badge-success' : 'badge-secondary'); ?>">
                                                                    <?php echo e($customer->status == 1 ? 'Active' : 'Inactive'); ?>

                                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                    

                                    
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    </div>
                    <div class="pagination-wrapper">
                        <?php echo $customers->appends([
                            'search' => Request::get('search'),
                            'lead_card_view_status' => Request::get('lead_card_view_status'),
                            'customer_filter' => Request::get('customer_filter'),
                            'duration_starts' => Request::get('duration_starts'),
                            'duration_ends' => Request::get('duration_ends')
                        ])->render(); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal" id="addEmailModalBtn" tabindex="-1"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Add Email</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?php echo e(url('/customerCommunication/customer-communication')); ?>" accept-charset="UTF-8" id="email_form" class="form-horizontal" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="user_id[]" id="user_id_input">
                                </div>
                                <div class="col-md-12">
                                    <label for="customer-name" class="form-label input_labels p-18">Type *</label>
                                    <select class="form-control clr_input_fields borderRadius select2" id="type_communication" name="type" required>
                                        <option value="email">Email</option>
                                        <option value="phone">Phone</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Subject *</label>
                                        <input type="text" name="subject" class="form-control" placeholder="Enter Subject" id="subject" required>
                                    </div>
                                </div>
                                <div class="col-md-12 attachment_for_email">
                                    <div class="form-group error_positioned_parent_modal">
                                        <label>Attachments *</label>
                                        <div class="input_fields_wrap_right">
                                            <div class="custom_add_inputs">
                                                <input type="file" name="mail_attachment[]" class="form-control" />
                                                <button class="btn remove_button" type="button"><i class="fa fa-times" aria-hidden="true"></i></button>
                                            </div>
                                            <div class="inner_btn">
                                                <button class="add_field_button btn btn-warning" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group error_positioned_parent_modal <?php echo e($errors->has('description') ? 'has-error' : ''); ?>">
                                        <label for="description" class="col-md-12 control-label"><?php echo e('Description'); ?> *</label>
                                        <textarea class="form-control" rows="5" name="message" type="textarea" id="email_description" required><?php echo e(strip_tags($leadMail->message??'')); ?></textarea>
                                        <?php echo $errors->first('description', '<p class="help-block">:message</p>'); ?>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="d-flex justify-content-center ">
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
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script>
        // $(document).ready(function () {
        //     CKEDITOR.replace('customerAnnouncmentDescription');
        // });
        $(document).on('click', '.add_email_modal_btn', function() {
            var customerId = $(this).attr("customer-id");
            $("#user_id_input").val(customerId);
        });
        $(document).ready(function () {
            var phone_count = 1;
            $(".input_fields_wrap_right .add_field_button").click(function () {
                var tr = '<input type="file" name="mail_attachment[]"  placeholder="Subject" class="form-control" /> <button class="btn remove_button" type="button" ><i class="fa fa-times" aria-hidden="true"></i></button>';
                var rowCount = $('.input_fields_wrap_right .custom_add_inputs').length;
                if (rowCount >= 1 && rowCount <= 4) {
                    $('.input_fields_wrap_right').prepend("<div class='custom_add_inputs'>" + tr + "</div>");
                }
                phone_count++;
            });
            $(".input_fields_wrap_right").on('click', '.remove_button', function () {
                var rowCount = $('.input_fields_wrap_right .custom_add_inputs').length;
                if (rowCount > 1) {
                    $(this).closest('.input_fields_wrap_right .custom_add_inputs').remove();
                }
            });
        });
        $(document).on('change', '#type_communication', function () {
            var type = $(this).val();
            if (type == 'email') {
                $('.attachment_for_email').show();
            } else {
                $('.attachment_for_email').hide();
            }
        });
        $(document).on('click', '#btn-delete-multiple', function (event) {
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
            $('.noti_checks:checked').each(function () {
                selectedCustomerIDs.push($(this).attr('data-customerCheck-id'));
            });
            $.ajax({
                url: "<?php echo e(route('customer_multiple_delete')); ?>",
                type: 'POST',
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    ids: selectedCustomerIDs
                },
                success: function (response) {
                    selectedCustomerIDs.forEach(function (id) {
                        $('.noti_checks[data-customerCheck-id="' + id + '"]').closest('.customer-box').remove();
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
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('Delete Error:', textStatus, errorThrown);
                }
            });
        }
        $(document).ready(function () {
            var phone_count = 1;
            $(".input_fields_wrap_right .add_field_button").click(function () {
                var tr = '<input type="file" name="mail_attachment[]"  placeholder="Subject" class="form-control" value=""/> <button class="btn remove_button" type="button" ><i class="fa fa-times" aria-hidden="true"></i></button>';
                var rowCount = $('.input_fields_wrap_right .custom_add_inputs').length;
                if (rowCount >= 1 && rowCount <= 4) {
                    $('.input_fields_wrap_right').prepend("<div class='custom_add_inputs'>" + tr + "</div>");
                }
                phone_count++;
            });

            $(".input_fields_wrap_right").on('click', '.remove_button', function () {
                var rowCount = $('.input_fields_wrap_right .custom_add_inputs').length;
                if (rowCount > 1) {
                    $(this).closest('.input_fields_wrap_right .custom_add_inputs').remove();
                }
            });
        });
        $(document).on('click','.add_mail_modal_btn',function(e){
            e.preventDefault();
            var user_ids = [];
            $('.noti_checks:checked').each(function() {
                var contact_id = $(this).attr('data-customerCheck-id');
                user_ids.push(contact_id);
                $('#email_form').append($('<input>', {type: 'hidden', name: 'user_ids[]', value: contact_id}));
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

        // Function to generate HTML for a single customer card
        function createCustomerCardHtml(customer) {
            // Get profile properties, safely handling null relationships
            const profile = customer.profile || {};
            const category = profile.category || {};

            // Determine values, falling back to "Not Available"
            const customerName = (customer.first_name || 'Not Available') + ' ' + (customer.last_name || '');
            const customerNumber = profile.customer_number || ('R' + new Date(customer.created_at).toLocaleDateString('en-US', { month: '2-digit', day: '2-digit', year: 'numeric' }).replace(/\//g, ''));
            const createdAt = new Date(customer.created_at).toLocaleDateString('en-US');
            const profilePic = profile.pic || 'mA8rgUHtbm.jpg';
            const statusBadge = customer.status == 1
                ? `<span class="badge badge-success">Active</span>`
                : `<span class="badge badge-secondary">Inactive</span>`;

            // START HTML STRING CONSTRUCTION
            let html = `
        <div class="col-md-4">
            <div class="item-card-view customer-box">
                <div class="lead-card-top">
                    <div class="custom_checkbox">
                        <input class="noti_check noti_checks" type="checkbox" id="cardCheckbox${customer.id}" data-customercheck-id="${customer.id}" >
                        <label for="cardCheckbox${customer.id}"></label>
                    </div>
                    <div class="image-status">
                        <div class="image-count">
                            <a href="/customer/customer/${customer.id}" title="View Lead">
                                <img src="/storage/uploads/users/${profilePic}">
                            </a>
                        </div>
                    </div>
                </div>
                <a href="/customer/customer/${customer.id}" title="View Lead">
                    <h4 class="customer_card_name">${customerName}</h4>
                </a>
                <ul>
                    <li class="email">
                        <b>Customer Number:</b> ${customerNumber}
                    </li>
                    <li class="email only_email_customer_card"><b>Email:</b> ${customer.email || "Not Available"}</li>
                    <li class="email"><b>Created At:</b> ${createdAt}</li>
                    <li class="phone-no"><b>Phone Number:</b> ${profile.phone || "Not Available"}</li>
                    <li class="category"><b>Category:</b> ${category.name || "Not Available"}</li>
                    <li class="address"><b>Address:</b> ${profile.address || "Not Available"}</li>
                    <li class="action">
                        <a href="/customer/customer/${customer.id}" class="btn btn_icon blue_btn" customer-id="${customer.id}">
                            <i class="fa-solid fa fa-eye"></i>
                        </a>
                        <a type="button" class="btn btn_icon float-right lead_check btn-success add_email_modal_btn" customer-id="${customer.id}" data-bs-toggle="modal" data-bs-target="#addEmailModalBtn">
                            <i class="fa-solid fa fa-envelope"></i>
                        </a>
                        <a href="/customer/customer/${customer.id}/edit" class="btn btn_icon float-right lead_check btn-success" customer-id="${customer.id}">
                            <i class="fa-solid fa fa-pencil"></i>
                        </a>
                        <a href="#" class="toggle-status" data-id="${customer.id}" data-status="${customer.status}">
                            ${statusBadge}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    `;
            return html;
        }
        // custom search filter
        $(document).ready(function(){
            // $('.global_search_datatable_style .dataTables_filter input[type="search"]').on('keyup', function() {
            //     var searchTerm = $(this).val().toLowerCase();
            //
            //     $('.user-view-item .col-md-4').each(function() {
            //         var name = $(this).find('.customer_card_name').text().toLowerCase();
            //         var email = $(this).find('.only_email_customer_card').text().toLowerCase();
            //
            //         if(name.includes(searchTerm) || email.includes(searchTerm)) {
            //             $(this).show();
            //         } else {
            //             $(this).hide();
            //         }
            //     });
            // });
            var timeout = null;
            var searchInput = $('#userSearch');
            const customerListUrl = window.location.href;
            const contentContainer = $('#customerContainer');

            // 1. Keyup handler
            searchInput.on('keyup', function() {
                clearTimeout(timeout);
                var searchTerm = $(this).val();

                // Immediately fetch if search term is cleared
                if (searchTerm.length === 0) {
                    fetchCustomers(searchTerm, 1);
                    return;
                }

                // Wait 500ms after typing stops
                timeout = setTimeout(function() {
                    fetchCustomers(searchTerm, 1);
                }, 500);
            });

            // 2. Main AJAX function
            function fetchCustomers(searchTerm, page = 1) {
                contentContainer.html('<div class="row user-view-item"><div style="text-align: center; padding: 50px;">Searching...</div></div>');

                let requestData = {
                    search: searchTerm,
                    page: page
                };

                // Include existing URL parameters (like other filters)
                const currentParams = new URLSearchParams(window.location.search);
                currentParams.forEach((value, key) => {
                    if (key !== 'page' && key !== 'search') {
                        requestData[key] = value;
                    }
                });

                $.ajax({
                    url: customerListUrl,
                    type: 'GET',
                    data: requestData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    dataType: 'json', // EXPECT JSON BACK!
                    success: function(response) {
                        let cardsHtml = '';

                        if (response.customers && response.customers.length > 0) {
                            // Build the HTML structure from the JSON data
                            response.customers.forEach(customer => {
                                cardsHtml += createCustomerCardHtml(customer);
                            });
                        } else {
                            cardsHtml = '<div style="text-align: center; padding: 50px;">No customers found matching your search.</div>';
                        }

                        // Inject the new content: cards first, then pagination
                        let fullContent = `
                    <div class="row user-view-item">
                        ${cardsHtml}
                    </div>
                    <div class="pagination-wrapper">
                        ${response.pagination_html}
                    </div>
                `;

                        contentContainer.html(fullContent);

                    },
                    error: function() {
                        contentContainer.html('<div class="row user-view-item"><div style="text-align: center; padding: 50px; color: red;">Error loading data.</div></div>');
                    }
                });
            }

            // 3. Handle AJAX Pagination clicks
            $(document).on('click', '#customerContainer .pagination-wrapper a', function(e){
                e.preventDefault();

                let pageUrl = new URL($(this).attr('href'));
                let pageNumber = pageUrl.searchParams.get('page');
                let currentSearch = searchInput.val();

                fetchCustomers(currentSearch, pageNumber);
            });

            // Helper function to extract existing query params (for persisting filters)
            function getQueryParams() {
                let params = {};
                window.location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m, key, value) {
                    // Only capture the existing filter parameters, skip 'page' and 'search' as they are handled explicitly
                    if (key !== 'page' && key !== 'search') {
                        params[key] = decodeURIComponent(value);
                    }
                });
                return params;
            }

            // 3. Handle AJAX Pagination clicks (event delegation)
            $(document).on('click', '#customerContainer .pagination-wrapper a', function(e){
                e.preventDefault();

                // Extract the page number from the pagination link's href
                let pageUrl = new URL($(this).attr('href'));
                let pageNumber = pageUrl.searchParams.get('page');

                // Get the current search term
                let currentSearch = searchInput.val();

                // Fetch data for the new page, retaining the search term
                fetchCustomers(currentSearch, pageNumber);
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
        $(document).ready(function () {
            $(document).on('click', '.exportToExcel', function () {
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
                    success: function (data) {
                        console.log(data);
                        const customers = data.map(customer => ({
                            'Customer Name': (customer.first_name + ' ' + customer.last_name) || 'Not Available',
                            'Customer Number': customer.created_at
                                ? 'R' + new Date(customer.created_at).toISOString().slice(2, 10).replace(/-/g, '')
                                : 'Not Available',
                            'Email': customer.email || 'Not Available',
                            'Created At': customer.created_at
                                ? new Date(customer.created_at).toISOString().slice(0, 10)
                                : 'Not Available',
                            'Phone Number': customer.profile?.phone || 'Not Available',
                            'Category': customer.profile?.category?.name || 'Not Available',
                            'Address': customer.profile?.address || 'Not Available',
                            'City': customer.profile?.city || 'Not Available',
                            'State': customer.profile?.state || 'Not Available',
                            'Zip': customer.profile?.zip || 'Not Available',
                            'Total Won Jobs': customer.customerLeads || '0',
                            'Total Won Job Price': customer.total_job_price != null ? `$${Number(customer.total_job_price).toFixed(2)}` : '0'
                        }));

                        const ws = XLSX.utils.json_to_sheet(customers);
                        const wb = XLSX.utils.book_new();
                        XLSX.utils.book_append_sheet(wb, ws, 'Customers');

                        const headers = [
                            'Customer Name', 'Customer Number', 'Email', 'Created At', 'Phone Number',
                            'Category', 'Address', 'City', 'State', 'Zip', 'Total Won Jobs', 'Total Won Job Price'
                        ];
                        XLSX.utils.sheet_add_aoa(ws, [headers], { origin: 'A1' });

                        XLSX.writeFile(wb, 'customers_export.xlsx');

                        $('.preloader').fadeOut();
                        $('body').css('overflow-y', 'auto');
                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching customer data:', error);
                        alert('Failed to export customers. Please try again.');
                        $('.preloader').fadeOut();
                        $('body').css('overflow-y', 'auto');
                    }
                });
            });
        });

    </script>

    <script>
        $(document).on('click', '.toggle-status', function(e) {
            e.preventDefault();

            let button = $(this);
            let userId = button.data('id');
            let currentStatus = button.data('status');
            let newStatus = currentStatus == 1 ? 2 : 1;

            $.ajax({
                url: "<?php echo e(url('update-user-status')); ?>/" + userId,
                method: 'POST',
                data: {
                    status: newStatus,
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                success: function(response) {
                    if(response.success) {
                        button.data('status', newStatus);
                        let badge = button.find('.badge');
                        if(newStatus == 1) {
                            badge.removeClass('badge-secondary').addClass('badge-success').text('Active');
                        } else {
                            badge.removeClass('badge-success').addClass('badge-secondary').text('Inactive');
                        }
                    } else {
                        alert('Failed to update status.');
                    }
                },
                error: function() {
                    alert('Error occurred while updating status.');
                }
            });
        });

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/customer/customer/user_view.blade.php ENDPATH**/ ?>