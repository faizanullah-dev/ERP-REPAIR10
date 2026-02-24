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
    <link href="<?php echo e(asset('plugins/components/chartist-js/dist/chartist.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('plugins/components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('plugins/components/dropzone-master/dist/dropzone.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('plugins/components/toast-master/css/jquery.toast.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/animate.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/common.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('plugins/components/datatables/jquery.dataTables.min.css')); ?>" rel="stylesheet" type="text/css"/>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->get('theme-layout') == 'fix-header'): ?>
        <link href="<?php echo e(asset('css/style-fix-header.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('css/colors/default.css')); ?>" id="theme" rel="stylesheet">
    <?php elseif(session()->get('theme-layout') == 'mini-sidebar'): ?>
        <link href="<?php echo e(asset('css/style-mini-sidebar.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('css/colors/default.css')); ?>" id="theme" rel="stylesheet">
    <?php else: ?>
        <link href="<?php echo e(asset('css/style-normal.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('css/colors/default.css')); ?>" id="theme" rel="stylesheet">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.9.0/css/bootstrap-iconpicker.min.css"/>
    <link href="<?php echo e(asset('plugins/components/custom-select/custom-select.css')); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"  />
    <link rel="stylesheet" href="<?php echo e(asset('css/dashboard/style.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/dashboard/responsive.css')); ?>">


    <?php echo $__env->yieldPushContent('css'); ?>
</head>
<body>
<div id="wrapper">
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <?php echo $__env->make('layouts.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <div class="page-wrapper">
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
<script src="<?php echo e(asset('plugins/components/jquery/dist/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request()->is('jobNote/job-note*') ||request()->is('task/task/*') || request()->is('changeOrder/change-order*') || request()->is('lead_card_view*') || request()->is('lead/lead*') || request()->is('customer/customer*')|| request()->is('user_view') || request()->is('invoice/invoice*') || request()->is('schedulingTask/scheduling-task*') || request()->is('appointment/appointment*') || request()->is('campaign')): ?>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<script src="<?php echo e(asset('js/jquery.slimscroll.js')); ?>"></script>
<script src="<?php echo e(asset('js/waves.js')); ?>"></script>
<script src="<?php echo e(asset('js/sidebarmenu.js')); ?>"></script>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->get('theme-layout') == 'fix-header'): ?>
    <script src="<?php echo e(asset('js/custom-fix-header.js')); ?>"></script>
<?php elseif(session()->get('theme-layout') == 'mini-sidebar'): ?>
    <script src="<?php echo e(asset('js/custom-mini-sidebar.js')); ?>"></script>
<?php else: ?>
    <script src="<?php echo e(asset('js/custom-normal.js')); ?>"></script>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<script src="<?php echo e(asset('plugins/components/styleswitcher/jQuery.style.switcher.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.9.0/js/bootstrap-iconpicker-iconset-all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.9.0/js/bootstrap-iconpicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo e(asset('plugins/components/custom-select/custom-select.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('plugins/components/dropzone-master/dist/dropzone.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/components/datatables/jquery.dataTables.min.js')); ?>"></script>
<script type="text/javascript">
    window.onload = function() {
        $('.select2').select2();
    };

    $(document).ready(function() {
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
    }
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
        // This runs after all images and other resources have fully loaded
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
                console.log('yes')
            }
        });
    });
    $(document).ready(function () {
        $('.dataTable').each(function () {
            var table = $(this).DataTable({
                pageLength: 10,
                searching: true,
                paging: true,
                info: true,
                ordering: false,
                initComplete: function () {
                    const $filter = $(this).closest('.dataTables_wrapper').find('.dataTables_filter');
                    const $input = $filter.find('input');
                    $filter.html(`
                    <div class="search-wrapper">
                        <i class="fa fa-search"></i>
                        <span class="search-text">Search</span>
                    </div>
                `);
                    $filter.find('.search-wrapper').append($input);
                    $input.on('input', function () {
                        table.search($input.val()).draw();
                    });
                }
            });
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

</script>
<?php echo $__env->yieldPushContent('js'); ?>
</body>
</html>
<?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/layouts/new-master.blade.php ENDPATH**/ ?>