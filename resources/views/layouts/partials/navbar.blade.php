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
                    @php
                        $notificationList = \App\Notification::orderBy('id', 'desc')
                            ->where('status', 'unseen')
                            ->where('model', 'Message Received')
                            ->get();
                        $unseenNotificationsCount = \App\Notification::where('status', 'unseen')
                            ->where('model', 'Message Received')
                            ->count();
                    @endphp
                    <ul class="nav navbar-top-links navbar-right pull-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle waves-effect waves-light font-20 notify_icon"
                                data-toggle="dropdown" href="javascript:void(0);" id="notificationLink">
                                <i class="fa fa-bell"></i>
                                @if (auth()->user()->hasRole('user'))
                                    <span class="badge badge-xs badge-danger nav_bell_dropdown_icon"
                                        id="notificationCount">{{ $unseenNotificationsCount ?? 0 }}</span>
                                @else
                                    <span class="badge badge-xs badge-danger nav_bell_dropdown_icon"
                                        id="notifi-count"></span>
                                @endif
                            </a>
                            <ul class="dropdown-menu mailbox animated bounceInDown">
                                <li>
                                    @if (auth()->user()->hasRole('user'))
                                        <div class="drop-title">You have <span
                                                id="notifi-count">{{ $unseenNotificationsCount }}</span> new
                                            notifications
                                        </div>
                                    @else
                                        <div class="drop-title">You have no new notification</div>
                                    @endif
                                </li>

                                @if (auth()->user()->hasRole('user'))
                                    <li>
                                        <div class="scrollable-content" style="height: 300px">
                                            @foreach ($notificationList as $notification)
                                                @if (auth()->id() == 2 || $notification->user_id == auth()->id())
                                                    <div class="message-center" data-status="unseen"
                                                        data-notification-id="{{ $notification->id }}"
                                                        id="notification_status">
                                                        <div class="message_icon_parent">
                                                            <div class="message_icon_container">
                                                                @if ($notification->model == 'Message Received')
                                                                    <i class="fa-regular fa-comment-o"></i>
                                                                    {{--                                                            @if ($notification->model == 'lead') --}}
                                                                    {{--                                                                <i class="fa-solid fa-magnet"></i> --}}
                                                                    {{--                                                            @elseif($notification->model == 'photoAndDocument') --}}
                                                                    {{--                                                                <i class="fa-solid fa-panorama"></i> --}}
                                                                    {{--                                                            @elseif($notification->model == 'receivePayment') --}}
                                                                    {{--                                                                <i class="fa-solid fa-money-check-dollar"></i> --}}
                                                                    {{--                                                            @elseif($notification->model == 'jobNote') --}}
                                                                    {{--                                                                <i class="fa-solid fa-clipboard"></i> --}}
                                                                    {{--                                                            @elseif($notification->model == 'proposal') --}}
                                                                    {{--                                                                <i class="fa-solid fa-briefcase"></i> --}}
                                                                    {{--                                                            @elseif($notification->model == 'stage') --}}
                                                                    {{--                                                                <i class="fa-solid fa-bars-staggered"></i> --}}
                                                                    {{--                                                            @elseif($notification->model == 'email') --}}
                                                                    {{--                                                                <i class="fa-solid fa-envelope"></i> --}}
                                                                    {{--                                                            @elseif($notification->model == 'task') --}}
                                                                    {{--                                                                <i class="fa-solid fa-list-check"></i> --}}
                                                                    {{--                                                            @elseif($notification->model == 'materail') --}}
                                                                    {{--                                                                <i class="fa-solid fa-cubes-stacked"></i> --}}
                                                                    {{--                                                            @elseif($notification->model == 'appointment') --}}
                                                                    {{--                                                                <i class="fa-solid fa-calendar-check"></i> --}}
                                                                    {{--                                                            @elseif($notification->model == 'changeOrder') --}}
                                                                    {{--                                                                <i class="fa-regular fa-square-plus"></i> --}}
                                                                @else
                                                                    <i class="fa-solid fa-bell"></i>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="mail-contnet">
                                                            <div class="message_heading_time">
                                                                <h5> {{ $notification->model }} </h5>
                                                                <span
                                                                    class="time">{{ $notification->created_at->format('l, h:i A d-M-Y') }}</span>
                                                            </div>
                                                            <span class="mail-desc">
                                                                @if ($notification->model == 'Message Received')
                                                                    {{ $notification->title ?? '' }} against the lead
                                                                    {{ $notification->lead->title ?? '' }}
                                                                    {{--                                                                    @if ($notification->model == 'lead') --}}
                                                                    {{--                                                                A new Lead name " {{$notification->title??""}} " has been created by " {{$notification->user->name??""}} " --}}
                                                                    {{--                                                            @elseif($notification->model == 'photoAndDocument') --}}
                                                                    {{--                                                                Documents have been created for the {{$notification->lead->title??""}} --}}
                                                                    {{--                                                            @elseif($notification->model == 'receivePayment') --}}
                                                                    {{--                                                                A payment of a  amount ${{ number_format($notification->title) }} has been created against the  {{$notification->lead->title??""}} --}}
                                                                    {{--                                                            @elseif($notification->model == 'jobNote') --}}
                                                                    {{--                                                                New notes have been added against the lead " {{$notification->lead->title??""}} " --}}
                                                                    {{--                                                            @elseif($notification->model == 'proposal') --}}
                                                                    {{--                                                                A new proposal has been created for the lead " {{$notification->lead->title??""}} " --}}
                                                                    {{--                                                            @elseif($notification->model == 'stage') --}}
                                                                    {{--                                                                A new stage ( {{ $notification->title??"" }} ) has been created by " {{$notification->user->name??""}} " --}}
                                                                    {{--                                                            @elseif($notification->model == 'Email Create') --}}
                                                                    {{--                                                                @if (isset($lead->customer) && $lead->customer->name)    An email has been sent to the customer " {{ $lead->customer->name }} " associated with the lead @endif --}}
                                                                    {{--                                                            @elseif($notification->model == 'Lead Price Update') --}}
                                                                    {{--                                                                The lead price has been updated to ' {{ number_format($lead->lead_price) }} ' --}}
                                                                    {{--                                                            @elseif($notification->model == 'task') --}}
                                                                    {{--                                                                A task has been created for the lead " {{$notification->lead->title??""}} " by " {{$notification->user->name??""}} " --}}
                                                                    {{--                                                            @elseif($notification->model == 'material') --}}
                                                                    {{--                                                                Materials have been created for the lead " {{$notification->title??""}} " --}}
                                                                    {{--                                                            @elseif($notification->model == 'appointment') --}}
                                                                    {{--                                                                An appointment has been created for the lead " {{$notification->title??""}} " --}}
                                                                    {{--                                                            @elseif($notification->model == 'changeOrder') --}}
                                                                    {{--                                                                A change order for the lead " {{$notification->lead->title??""}} " has been created --}}
                                                                    {{--                                                            @elseif($notification->model == 'mark') --}}
                                                                    {{--                                                                A Mark name "{{ $notification->title }}" has been created by " {{$notification->user->name??""}} " --}}
                                                                    {{--                                                            @elseif($notification->model == 'user') --}}
                                                                    {{--                                                                --}}{{--                                                                        A User "{{ $notification->title??"" }}" assigned role "{{ $notification->getUser->roles->first()->name??""   }}" has been created by " {{$notification->user->name??""}} " --}}
                                                                    {{--                                                                A User "{{ $notification->title??"" }}" has been created by " {{$notification->user->name??""}} " --}}
                                                                    {{--                                                            @elseif($notification->model == 'category') --}}
                                                                    {{--                                                                A new Category "{{ $notification->title }}" has been created by " {{$notification->user->name??""}} " --}}
                                                                    {{--                                                            @elseif($notification->model == 'team') --}}
                                                                    {{--                                                                A new Team "{{ $notification->title }}" has been created by " {{$notification->user->name??""}} " --}}
                                                                    {{--                                                            @elseif($notification->model == 'priority') --}}
                                                                    {{--                                                                A new Priority "{{ $notification->title }}" has been created by " {{$notification->user->name??""}} " --}}
                                                                    {{--                                                            @elseif($notification->model == 'campaign') --}}
                                                                    {{--                                                                A new Campaign "{{ $notification->title }}" has been created by " {{$notification->user->name??""}} " --}}
                                                                    {{--                                                            @elseif($notification->model == 'proposalTemplate') --}}
                                                                    {{--                                                                A new Proposal Template name "{{ $notification->title }}" has been created by " {{$notification->user->name??""}} " --}}
                                                                    {{--                                                            @elseif($notification->model == 'emailTemplate') --}}
                                                                    {{--                                                                A new Email Template "{{ $notification->title }}" has been created by " {{$notification->user->name??""}} " --}}
                                                                @else
                                                                    {{ $notification->title }}
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <div class="d-flex justify-content-end">
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </li>
                                @endif
                                {{--                                        @else --}}
                                {{--                                            <span class="drop-title">No Notification Found</span> --}}
                                {{--                                        @endif --}}
                                {{--                                <li> --}}
                                {{--                                    <a class="text-center d-flex align-items-center justify-content-center gap-2 " href="{{ route('notification') }}"> --}}
                                {{--                                        <span class="d-flex justify-content-center">See all notifications</span> --}}
                                {{--                                        <i class="fa fa-angle-right"></i> --}}
                                {{--                                    </a> --}}
                                {{--                                </li> --}}
                            </ul>
                        </li>
                    </ul>

                </div>
                <div class="dropdown user-pro-body  profile_dropdown">
                    <p class="profile-text ">
                        <a href="javascript:void(0);">
                            @if (auth()->user()->name == 'Admin')
                                Developer
                            @elseif(auth()->user()->name == 'User')
                                {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}
                            @else
                                {{ auth()->user()->name }}
                            @endif
                        </a>
                    </p>
                    <div class="profile-image">
                        {{-- @if (auth()->user()->profile->pic === null) --}}
                        <img src="{{ asset('storage/uploads/users/no_avatar.jpg') }}" alt="user-img"
                            class="img-circle img-fluid">
                        {{-- @else
                            <img src="{{ asset('storage/uploads/users/' . auth()->user()->profile->pic) }}"
                                alt="user-img" class="img-fluid img-circle">
                        @endif --}}
                        <a href="javascript:void(0);" class="dropdown-toggle u-dropdown text-blue"
                            data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        </a>

                        <ul class="dropdown-menu animated flipInY navbar_profile_dropdown">
                            @if (!auth()->user()->hasRole('subcontractor'))
                                <li><a href="{{ url('user_profile') }}"><i class="fa fa-cog"></i> Account Settings</a>
                                </li>
                                @if (!auth()->user()->hasRole('customer'))
                                    <!-- This ensures that 'Company Settings' is hidden for customers -->
                                    <li class="dropdown-submenu">
                                        <a href="#!"><i class="fa fa-cog"></i> Company Settings</a>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-submenu">
                                                <a href="#!">Command Center</a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{ url('customer_onboarding') }}">Customer
                                                            Onboarding</a></li>
                                                    <li><a href="{{ url('controlPanel/control-panel') }}">Control
                                                            Panel</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu">
                                                <a href="#!">Calculators</a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{ url('roof_base') }}">Roof Calculator Base</a></li>
                                                    <li><a href="{{ url('chimney_base') }}">Chimney Calculator Base</a>
                                                    </li>
                                                    <li><a href="{{ url('side_base') }}">Siding Calculator Base</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu">
                                                <a href="#!">Marketing</a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{ url('referralSource/referral-source/') }}">Referral
                                                            Source</a></li>
                                                    <li><a href="{{ url('advertisement/advertisement/') }}">Monthly
                                                            Advertisement</a></li>
                                                    <li><a href="{{ url('cost_of_lead/') }}">Cost Of Lead</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="{{ url('companyContact/company-contact') }}">Company
                                                    Contact</a></li>
                                            <li><a href="{{ url('emailTemplateFolder/email-template-folder') }}">Email
                                                    Template Folder</a></li>
                                            <li><a href="{{ url('email_branding') }}">Email Branding</a></li>
                                            <li><a href="{{ url('category/category') }}">Category</a></li>
                                            <li><a href="{{ url('stage/stage') }}">Stage</a></li>
                                            <li><a href="{{ url('team/team') }}">Team</a></li>
                                            <li><a href="{{ url('holiday/holiday') }}">Holiday</a></li>
                                            <li><a href="{{ url('calendar_types') }}">Calendar Types</a></li>
                                            <li><a href="{{ url('cogsMaterial/cogs-material') }}">COGS Materials</a>
                                            </li>
                                            <li><a href="{{ url('mark/mark') }}">Mark</a></li>
                                            <li><a href="{{ url('priority/priority') }}">Priority</a></li>
                                            <li><a href="{{ url('announcement/announcement') }}">Announcements</a></li>
                                            <li><a href="{{ url('customerOwnerType/customer-owner-type') }}">Customer
                                                    Owner Type</a></li>
                                            <li><a href="{{ url('productCategory/product-category') }}">Product
                                                    Category</a></li>
                                            <li><a href="{{ url('paymentType/payment-type') }}">Payment Type</a></li>
                                            <li><a href="{{ url('trade/trade') }}">Trades</a></li>
                                        </ul>
                                    </li>
                                @endif
                                <li><a href="{{ url('logout') }}"><i class="fa fa-power-off"></i> Logout</a></li>
                            @endif
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
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

        {{-- $(document).ready(function () { --}}
        {{--    function checkForNewNotifications() { --}}
        {{--        $.ajax({ --}}
        {{--            url: '{{url('notification')}}', --}}
        {{--            method: 'GET', --}}
        {{--            dataType: 'json', --}}
        {{--            success: function (data) { --}}
        {{--                // displayNotifications(data); --}}
        {{--            }, --}}
        {{--            error: function (error) { --}}
        {{--                console.log('Error checking for notifications: ' + error); --}}
        {{--            } --}}
        {{--        }); --}}
        {{--    } --}}
        {{--    setInterval(checkForNewNotifications, 30000); --}}
        {{-- }); --}}

        $(document).ready(function() {
            // Check if the element exists before attaching the click event
            if ($("#notificationLink").length > 0) {
                $("#notificationLink").on("click", function() {
                    $("#notificationCount").text("0");
                    var status = $('.notification-row').attr('data-notification');
                    $.ajax({
                        url: '{{ route('status_change_notification') }}',
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
@endpush
