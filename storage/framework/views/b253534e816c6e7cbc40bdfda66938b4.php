<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="description" content="<?php echo e(App\CommonSetting::first()->description??''); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('')); ?><?php echo e(App\CommonSetting::first()->favicon??''); ?>">
    <title><?php echo e(App\CommonSetting::first()->title??''); ?></title>
    <link href="<?php echo e(asset('bootstrap/dist/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('plugins/components/chartist-js/dist/chartist.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('plugins/components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('plugins/components/dropzone-master/dist/dropzone.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('plugins/components/toast-master/css/jquery.toast.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/animate.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/common.css')); ?>" rel="stylesheet">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->get('theme-layout') == 'fix-header'): ?>
        <link href="<?php echo e(asset('css/style-fix-header.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('css/colors/default.css')); ?>" rel="stylesheet">
    <?php elseif(session()->get('theme-layout') == 'mini-sidebar'): ?>
        <link href="<?php echo e(asset('css/style-mini-sidebar.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('css/colors/default.css')); ?>"  rel="stylesheet">
    <?php else: ?>
        <link href="<?php echo e(asset('css/style-normal.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('css/colors/default.css')); ?>" rel="stylesheet">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.9.0/css/bootstrap-iconpicker.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"  />
    <link rel="stylesheet" href="<?php echo e(asset('website/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('website/css/responsive.css')); ?>">
    <?php echo $__env->yieldPushContent('css'); ?>
</head>
<body class="<?php if(session()->get('theme-layout')): ?> <?php echo e(session()->get('theme-layout')); ?> <?php endif; ?> preload">
<div id="wrapper" >
    <div id="loading" class="preloader">
        <div class="loader"></div>
        <div class="loader_img"> <img src="<?php echo e(asset('website')); ?>/images/favicon.png" loading="lazy"></div>
    </div>
    <?php echo $__env->make('layouts.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <div class="page-wrapper ">
        <?php echo $__env->make('layouts.partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>
        <div id="search_modal" class="modal fade custom_modal search_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog search_modal_sizing">
                <div class="modal-content">
                    <div class="modal-body bottom_blue_line">
                        <div class="inner_section_modal">
                            <div class="modal_header search_form">
                                <div class="txt_field">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                    <input id="searching" class="form-control search searching" type="text" placeholder="Search for leads" name="name">
                                </div>
                                <button type="button" class="close">×</button>
                            </div>
                        </div>
                        <div class="modal_title">
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="searching_result" style="display: none;">
                                    <div class="tabs_wrapper"></div>
                                    <div id="Leads" class="tab_content tabcontent">
                                        <div class="dynamic_data_opportunities">
                                            <p>NO Record Found</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasRole('customer')): ?>
    <div class="customer-chat-box">
        <!-- Chat Button -->
        <div class="chat-button" id="chatButton">
            <svg id="chatIcon" viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"/></svg>
            <svg id="closeIcon" style="display: none;" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>
            <span class="notification-badge show" id="notificationBadge">1</span>
        </div>

        <!-- Chat Box -->
        <div class="chat-box" id="chatBox">
            <div class="chat-header">
                <div class="chat-avatar">🤖</div>
                <div class="chat-info">
                    <h3>Support </h3>
                </div>
            </div>

            <div class="chat-messages" id="chatMessages">
                <div class="message bot">
                    <div class="message-avatar">🤖</div>
                    <div>
                        <div class="message-content">
                            Hi there! 👋 How can we help you today?
                         </div>
                        <div class="message-time" id="initialTime"></div>
                    </div>
                </div>
            </div>

            <div class="chat-input-area">
                <div class="chat-input-wrapper">
                    <input type="hidden" name="sender_id" id="sender-id" value="<?php echo e(auth()->user()->id??''); ?>">
                    <input type="hidden" name="sender_type" id="sender-type" value="customer">
                    <input type="text" class="chat-input" id="chatInput" placeholder="Type your message..." autocomplete="off">
                    <button class="send-button" id="sendButton">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<script src="<?php echo e(asset('plugins/components/jquery/dist/jquery.min.js')); ?>"  ></script>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="<?php echo e(asset('bootstrap/dist/js/bootstrap.min.js')); ?>" defer ></script>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request()->is('jobNote/job-note*') ||request()->is('task/task/*') || request()->is('changeOrder/change-order*') || request()->is('lead_card_view*') || request()->is('lead/lead*') || request()->is('customer/customer*')|| request()->is('user_view') || request()->is('invoice/invoice*') || request()->is('schedulingTask/scheduling-task*') || request()->is('appointment/appointment*') || request()->is('campaign') || request()->is('credit/credit*') || request()->is('refund/refund*')): ?>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"  ></script>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" defer ></script>
<script src="<?php echo e(asset('js/jquery.slimscroll.js')); ?>"  ></script>
<script src="<?php echo e(asset('js/waves.js')); ?>" defer ></script>
<script src="<?php echo e(asset('js/sidebarmenu.js')); ?>" defer ></script>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->get('theme-layout') == 'fix-header'): ?>
    <script src="<?php echo e(asset('js/custom-fix-header.js')); ?>"  ></script>
<?php elseif(session()->get('theme-layout') == 'mini-sidebar'): ?>
    <script src="<?php echo e(asset('js/custom-mini-sidebar.js')); ?>"  ></script>
<?php else: ?>
    <script src="<?php echo e(asset('js/custom-normal.js')); ?>"  ></script>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<script src="<?php echo e(asset('plugins/components/styleswitcher/jQuery.style.switcher.js')); ?>" defer ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.9.0/js/bootstrap-iconpicker-iconset-all.min.js"  defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.9.0/js/bootstrap-iconpicker.min.js"  defer></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"  ></script>
<script src="<?php echo e(asset('plugins/components/dropzone-master/dist/dropzone.js')); ?>"  defer></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js" defer ></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#searching').on('keydown', function(e) {
            if (e.which === 32) {
                var $this = $(this);
                var value = $this.val();
                var cursorPos = this.selectionStart;
                var before = value[cursorPos - 1];
                var after = value[cursorPos];
                if (before === ' ' || after === ' ') {
                    e.preventDefault();
                }
            }
        });
        $('#searching').on('input', function() {
            var $this = $(this);
            $this.val($this.val().replace(/\s+/g, ' '));
        });
        $('#signoutButton').on('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to log out?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, log out!',
                cancelButtonText: 'No, stay logged in!',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?php echo e(url('logout')); ?>';
                } else {
                    Swal.fire('Cancelled', 'You are still logged in', 'info');
                }
            });
        });
    });
    <?php if(session()->has('message')): ?>
    Swal.fire({
        title: "<?php echo e(session()->get('title')??'success!'); ?>",
        html: "<?php echo e(@ucwords(preg_replace('/(?<!\ )[A-Z]/', ' $0', session()->get('message')))); ?>",
        icon: "<?php echo e(session()->get('type')??'success'); ?>",
        timer: 5000,
        buttons: false,
    });
    <?php endif; ?>
    <?php if(session()->has('error_message')): ?>
    Swal.fire({
        title: "<?php echo e(session()->get('title')??'error!'); ?>",
        html: "<?php echo e(@ucwords(preg_replace('/(?<!\ )[A-Z]/', ' $0', session()->get('error_message')))); ?>",
        icon: "<?php echo e(session()->get('type')??'error'); ?>",
        timer: 5000,
        buttons: false,
    });
    <?php endif; ?>
    <?php if(session()->has('flash_message')): ?>
    Swal.fire({
        title: "<?php echo e(@ucwords(preg_replace('/(?<!\ )[A-Z]/', ' $0', session()->get('flash_message')))); ?>",
        
        icon: "<?php echo e(session()->get('type')??'success'); ?>",
        timer: 2000,
        showConfirmButton: false,
        // buttons: false,
    });
    <?php endif; ?>
    function showDeleteConfirmation(button) {
        Swal.fire({
            title: 'Confirm Delete',
            text: 'Are you sure you want to delete this item?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                button.closest('.delete-form').submit();
            }
        });
    }//end function
    $(document).ready(function() {
        var searchInput = $("#searchInput");
        var searchingResult = $(".searching_result");
        var dynamicDataOpportunities = $(".dynamic_data_opportunities");
        function toggleSearchModal(show) {
            if (show) {
                $("#search_modal").modal("show");
                $('.searching').focus();
                $("#search_modal .modal-content").show();
            }
            else {
                $("#search_modal").modal("hide");
            }
        }
        searchInput.click(function() {
            toggleSearchModal(true);
        });
        $('#search_modal').on('shown.bs.modal', function () {
            $('.searching').focus();
        });
        $(document).on('click', '.close', function() {
            // e.preventDefault();
            // toggleSearchModal(false);
            $("#search_modal").modal("hide");
        });
        $(document).keydown(function(e) {
            if (e.ctrlKey && (e.key === 'k' || e.key === 'K')) {
                e.preventDefault();
                toggleSearchModal(true);
            }
            if (e.key === 'Escape') {
                toggleSearchModal(false);
            }
        });
        $(document).on('keyup', '.searching', function(event) {
            var inputValue = $(this).val();
            inputValue.trim() !== "" ? searchingResult.css("display", "block") : searchingResult.css("display", "none");
            $.ajax({
                url: "<?php echo e(url('autocomplete_search_data')); ?>",
                dataType: "json",
                data: {
                    query: inputValue
                },
                success: function(data) {
                    dynamicDataOpportunities.html(data.html);
                }
            });
        });
        $(window).on('load', function() {
            var preloader = $('#loading');
            if (preloader.length) {
                preloader.css({
                    'opacity': '0',
                    'transition': 'opacity 0.5s ease'
                });
                setTimeout(function() {
                    preloader.hide();
                    $('body').removeClass('preload');
                }, 200); // Match this with CSS transition time
            } else {
                // Fallback if preloader missing
                $('body').removeClass('preload');
            }
        });




    });
    $("#side-menu .nav-item a").click(function(){
        $(this).closest('.nav-item').siblings().removeClass('active-link');
        $(this).closest('.nav-item').addClass('active-link');
    });
    jQuery('.buttonContent:first').show();
    jQuery('.primary_general_tabs li:first').addClass('active');
    jQuery('.primary_general_tabs li').click(function(){
        var num = jQuery(this).index();
        jQuery('.primary_general_tabs li').removeClass('active');
        jQuery(this).addClass('active');
        jQuery('.buttonContent').hide();
        jQuery('.buttonContent').eq(num).show();
    });
    $(document).on('click','.close',function(e){
        e.preventDefault();
        $(this).parent().parent().parent().parent().modal('hide');
    });
    $(window).on('load', function() {
        $('#myTable_filter label').contents().filter(function() {
            return this.nodeType === 3 && this.textContent.trim() === 'Search:';
        }).remove();
        $('#myTable_filter label').append('<div class="search_icon"><i class="fa fa-search"></i></div>');
        $('#myTable_filter input[type="search"]').attr('placeholder', 'Search');
    });
    $(document).on('click', '.sidebar-nav #side-menu li a .add_btn', function(e) {
        e.stopPropagation();
        const url = $(this).data('href');
        window.location.href = url;
    });
    var currentAjaxRequest = null;
    function cancelPendingRequest() {
        if (currentAjaxRequest && currentAjaxRequest.readyState !== 4) {
            currentAjaxRequest.abort();
        }
    }
    function showLoadingSwal(message = 'Please wait...', text = 'Loading data...') {
        Swal.fire({
            title: message,
            text: text,
            icon: 'info',
            showConfirmButton: false,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    }
    function hideLoadingSwal() {
        Swal.close();
    }
    $(document).ready(function () {
        $("form").on("submit", function (e) {
            if ($(this).valid()) {
                $("button[type=submit], input[type=submit]", this).prop("disabled", true);
            }
        });
    });
    $(document).ready(function() {
        $('.create-customer-btn').on('click', function(event) {
            event.stopPropagation(); // Prevent parent <a> from being triggered
            event.preventDefault(); // Prevent default anchor behavior

            let targetUrl = $(this).data('href');
            localStorage.setItem('activeNav', 'customerNavLink'); // Store active state
            window.location.href = targetUrl;
        });
        if (window.location.pathname === "/customer/customer/create") {
            $("#customerNavLink").addClass("active");
        }
    });
    $(document).on('click', '.btn-offcanvas', function(){
        $('#sidebar').toggleClass('active');
        $(this).closest('nav').find('ul li').removeClass('active-link active collapse');
    });
    $(document).ready(function() {
        $('.select_two_initialize').select2({
            placeholder: "Select Lead",
            allowClear: true,
            width: '100%'
        });
    });
    $(document).ready(function () {
        $('.sidebar-nav #side-menu .dropdown > a.nav-link').on('click', function (e) {
            e.preventDefault();
            var $submenu = $(this).siblings('.submenu');
            $('.sidebar-nav #side-menu .submenu').not($submenu).removeClass('show');
            $('.sidebar-nav #side-menu .dropdown > a.nav-link').not(this).attr('aria-expanded', 'false');
            $submenu.toggleClass('show');
            $(this).attr('aria-expanded', $submenu.hasClass('show'));
        });
    });
    $(window).on('load', function () {
        $('.sidebar-nav #side-menu .dropdown').each(function () {
            if ($(this).find('.submenu .active').length > 0) {
                $(this).find('> a.nav-link').attr('aria-expanded', 'true');
                $(this).find('.submenu').addClass('show');
            }
        });
    });
    $(window).on('load', function () {
        $('.select2').select2({
            placeholder: "Select an option",
            allowClear: true,
            width: '100%'
        });
    });
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
    $(document).ready(function() {
        $('img').each(function() {
            $(this).attr('loading', 'lazy');
        });
    });
    $(document).on('shown.bs.modal', function () {
        $('.modal').each(function () {
            var select2Element = $(this).find('.custom_modal_select2');
            if (select2Element.length) {
                select2Element.each(function() {
                    var placeholder = $(this).data('placeholder') || 'Select an Option';
                    $(this).select2({
                        dropdownParent: $(this).closest('.modal'),
                        placeholder: placeholder
                    });
                });
            }
        });
    });


    // $(document).ready(function() {
    //     const $input = $('input[type="date"]');
    //     const formatDate = date => `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}`;
    //     $input.val(formatDate(new Date()));
    //     $input.on('change', function() {
    //         console.log('Formatted date:', formatDate(new Date($input.val())));
    //     });
    // });



</script>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasRole('customer')): ?>
    <script>
        $(document).ready(function() {
            // Variables
            var unreadCount = 0;
            var isChatOpen = false;

            // Parent container
            var $chatContainer = $('.customer-chat-box');

            // Child elements using parent-child hierarchy
            var $chatButton = $chatContainer.find('.chat-button');
            var $chatBox = $chatContainer.find('.chat-box');
            var $chatInput = $chatContainer.find('.chat-input');
            var $sendButton = $chatContainer.find('.send-button');
            var $chatMessages = $chatContainer.find('.chat-messages');
            var $chatIcon = $chatContainer.find('#chatIcon');
            var $closeIcon = $chatContainer.find('#closeIcon');
            var $notificationBadge = $chatContainer.find('.notification-badge');

            // Set initial timestamp
            $chatContainer.find('#initialTime').text(getCurrentTime());

            var lastMessageId = 0; // Track the last message ID to avoid duplicates
            var loadedMessageIds = new Set();

            // Toggle chat box - FIXED
            $chatButton.on('click', function() {
                isChatOpen = !isChatOpen;

                if (isChatOpen) {
                    $chatBox.addClass('open');
                    $chatButton.addClass('active');
                    $chatIcon.hide();
                    $closeIcon.show();
                    $chatInput.focus();

                    // Reset unread count when chat is opened
                    unreadCount = 0;
                    updateNotificationBadge();
                } else {
                    $chatBox.removeClass('open');
                    $chatButton.removeClass('active');
                    $chatIcon.show();
                    $closeIcon.hide();
                }
            });

            // Function to format time
            function formatTime(dateString) {
                const date = new Date(dateString);
                const hours = date.getHours();
                const minutes = date.getMinutes();
                const ampm = hours >= 12 ? 'PM' : 'AM';
                const formattedHours = hours % 12 || 12;
                const formattedMinutes = minutes < 10 ? '0' + minutes : minutes;
                return `${formattedHours}:${formattedMinutes} ${ampm}`;
            }

            // Function to add message to chat
            function addMessage(message, type, time, messageId = null) {
                if (messageId && loadedMessageIds.has(messageId)) {
                    return; // Skip if already loaded
                }
                const messageClass = type === 'user' ? 'user' : 'bot';
                const avatar = type === 'user' ? '👤' : '🤖';
                const messageTime = time ? formatTime(time) : formatTime(new Date());

                const messageHtml = `
                <div class="message ${messageClass}" data-message-id="${messageId || ''}">
                    <div class="message-avatar">${avatar}</div>
                    <div>
                        <div class="message-content">${message}</div>
                        <div class="message-time">${messageTime}</div>
                    </div>
                </div>
            `;

                $chatMessages.append(messageHtml);

                if (messageId) {
                    loadedMessageIds.add(messageId);
                }

                scrollToBottom();
            }

            // Scroll chat to bottom
            function scrollToBottom() {
                var chatMessages = document.getElementById('chatMessages');
                if (chatMessages) {
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }
            }

            // Load initial messages
            function loadMessages() {
                var senderId = $('#sender-id').val();

                $.ajax({
                    url: "<?php echo e(url('get_support_messages')); ?>",
                    type: 'get',
                    data: {
                        'sender_id': senderId,
                        'last_id': lastMessageId
                    },
                    success: function (result) {
                        if (result.success && result.messages.length > 0) {
                            var newAdminMessageCount = 0;

                            result.messages.forEach(function(msg) {
                                // Skip if message already loaded
                                if (loadedMessageIds.has(msg.id)) {
                                    return;
                                }

                                const isSender = msg.sender_id == senderId && msg.sender_type == 'customer';
                                const messageType = isSender ? 'user' : 'bot';

                                addMessage(msg.message, messageType, msg.created_at, msg.id);

                                // Count new admin messages
                                if (msg.sender_type === 'admin' && !isChatOpen) {
                                    newAdminMessageCount++;
                                }

                                // Update last message ID
                                if (msg.id > lastMessageId) {
                                    lastMessageId = msg.id;
                                }
                            });

                            // Update unread count and badge
                            if (newAdminMessageCount > 0 && !isChatOpen) {
                                unreadCount += newAdminMessageCount;
                                updateNotificationBadge();
                            }
                        }
                    },
                    error: function (e) {
                        console.error('Error loading messages:', e);
                    }
                });
            }

            // Send message function
            function sendMessage() {
                var message = $chatInput.val().trim();
                var senderId = $('#sender-id').val();
                var senderType = $('#sender-type').val();

                if (message === '') return;

                // Clear input first
                $chatInput.val('');

                $.ajax({
                    url: "<?php echo e(url('send_support_message')); ?>",
                    type: 'post',
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        'message': message,
                        'sender_id': senderId,
                        'sender_type': senderType,
                    },
                    success: function (result) {
                        if (result.success && result.message_id) {
                            // Add message with the returned ID
                            addMessage(message, 'user', new Date(), result.message_id);

                            // Update last message ID
                            if (result.message_id > lastMessageId) {
                                lastMessageId = result.message_id;
                            }
                        }
                    },
                    error: function (e) {
                        console.error('Error sending message:', e);
                    }
                });
            }

            // Send button click
            $sendButton.on('click', function() {
                sendMessage();
            });

            // Enter key press
            $chatInput.on('keypress', function(e) {
                if (e.which === 13) {
                    sendMessage();
                }
            });

            // Update notification badge
            function updateNotificationBadge() {
                if (unreadCount > 0) {
                    var displayCount = unreadCount > 99 ? '99+' : unreadCount;
                    $notificationBadge.text(displayCount).addClass('show');
                } else {
                    $notificationBadge.removeClass('show');
                }
            }

            // Get current time
            function getCurrentTime() {
                var now = new Date();
                var hours = now.getHours();
                var minutes = now.getMinutes();
                var ampm = hours >= 12 ? 'PM' : 'AM';

                hours = hours % 12;
                hours = hours ? hours : 12;
                minutes = minutes < 10 ? '0' + minutes : minutes;

                return hours + ':' + minutes + ' ' + ampm;
            }

            // Load messages on page load
            loadMessages();

            // Poll for new messages every 3 seconds
            setInterval(loadMessages, 3000);
        });
    </script>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<?php echo $__env->yieldPushContent('js'); ?>
</body>
</html>
<?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/layouts/master.blade.php ENDPATH**/ ?>