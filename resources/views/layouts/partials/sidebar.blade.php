<aside id="sidebar" class="sidebar " >
    <div class="sidebar-header">
        <div class="sidebar_logo"><a href="{{ url('dashboard') }}" class="logo"><img src="{{asset('website')}}/images/logo.png" loading="lazy" alt=""></a></div>
        <div class="sidebar-toggle">
            <a href="javascript:void(0)" class="sidebartoggler waves-effect waves-light"><i class="fa fa-close"></i></a>
        </div>
    </div>
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="side-menu">

                <li>
                    <a class="active waves-effect" href="{{url('dashboard')}}" aria-expanded="false">
                        <div class="dashboard_icon"> <img src="{{asset('website')}}/images/Dashboard.svg" loading="lazy" alt=""></div>
                        <span class="hide-menu"> Dashboard </span>
                    </a>
                    @if(auth()->user()->isAdmin() == true)
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{asset('dashboard')}}">Modern Version</a></li>
                            <li><a href="{{asset('index2')}}">Clean Version</a></li>
                            <li><a href="{{asset('index3')}}">Analytical Version</a></li>
                            <li>
                                <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><span
                                            class="hide-menu"> eCommerce </span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="{{asset('index4')}}">Dashboard</a></li>
                                    <li><a href="{{asset('products')}}">Products</a></li>
                                    <li><a href="{{asset('product-detail')}}">Product Detail</a></li>
                                    <li><a href="{{asset('product-edit')}}">Product Edit</a></li>
                                    <li><a href="{{asset('product-orders')}}">Product Orders</a></li>
                                    <li><a href="{{asset('product-cart')}}">Product Cart</a></li>
                                    <li><a href="{{asset('product-checkout')}}">Product Checkout</a></li>
                                </ul>
                            </li>
                        </ul>
                    @endif
                </li>
                @if((Auth::user()->roles()->pluck('name')->implode(', ')=='user'))
                    {{--<li class="nav-item {{ request()->is('users') ? 'active' : '' }}">--}}
                    {{--<a class="waves-effect nav-link" href="{{ url('users') }}">--}}
                    {{--<span class="hide-menu"> Manage Users</span>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                @endif
                @if(auth()->user()->isAdmin() == true)
                    <li>
                        <a class="waves-effect" href="{{asset('role-management')}}"><i class=" icon-layers fa-fw"></i><span class="hide-menu"> Roles </span></a>
                    </li>
                    <li class="two-column">
                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                                    class="icon-user fa-fw"></i> <span class="hide-menu"> Users</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{asset('users')}}">Manage Users</a></li>
                            <li><a href="{{asset('user/create')}}">Add New User</a></li>
                            <li><a href="{{asset('user/deleted')}}">Deleted Users</a></li>

                        </ul>
                    </li>
                    <li><hr /></li>
                    {{--<li><a class="waves-effect" href="{{asset('permission-management')}}"> <i--}}
                    {{--class="icon-list fa-fw"></i><span class="hide-menu"> Permissions</span></a></li>--}}
                    <li><a class="waves-effect" href="{{asset('crud-generator')}}">
                            <i class="icon-drawar fa-fw"></i><span class="hide-menu"> CRUD Generator</span></a>
                    </li>
                    <li class="two-column">
                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-eye fa-fw"></i> <span class="hide-menu"> Logs</span></a>
                        <ul aria-exzpanded="false" class="collapse">
                            <li><a href="{{asset('log-viewer')}}">Laravel Log</a></li>
                            <li><a href="{{asset('activity-log')}}">Activity Log</a></li>
                        </ul>
                    </li>
                @endif
                {{--@foreach($laravelAdminMenus->menus as $section)--}}
                {{--@if(count(collect($section->items)) > 0)--}}
                {{--@foreach($section->items as $key => $menu)--}}
                {{--@can('view-'.str_slug($menu->title))--}}
                {{--@if($key == 15 || $key == 23 || $key == 54 || $key == 7 || $key == 8 || $key == 11 || $key == 43 )@continue @endif--}}
                {{--@if(ucwords($menu->title)=="ReportPermission")--}}
                {{--@else--}}
                {{--<li>--}}
                {{--<a class="waves-effect" href="{{ url($menu->url) }}">--}}
                {{--<i class="glyphicon {{$menu->icon}} fa-fw"></i>--}}
                {{--<span class="hide-menu">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', '$0', ucwords($menu->title)) }} {{$key}}</span>--}}
                {{--</a>--}}
                {{--</li>--}}
                {{--@endif--}}
                {{--@endcan--}}
                {{--@endforeach--}}
                {{--@endif--}}
                {{--@endforeach--}}
                {{--                @can('view-customer')--}}
                {{--                    <li class="custom_item nav-item @if(request()->is('user_view/*') || request()->is('user_view*')) active @endif">--}}
                {{--                        <a class="waves-effect nav-link " href="{{url('user_view/')}}">--}}
                {{--                            <i class="fa-regular fa-user"></i>--}}
                {{--                            <span class="hide-menu">Customer</span>--}}
                {{--                            <span class="hide-menu add_btn" data-href="{{ url('/customer/customer/create') }}"><i class="fa fa-circle-plus"></i></span>--}}
                {{--                        </a>--}}
                {{--                    </li>--}}
                {{--                @endif--}}
                @can('view-customer')
                    {{--                    <li class="custom_item nav-item @if(request()->is('user_view/*') || request()->is('customer/customer/*') || request()->is('customer/customer/create')) active @endif">--}}
                    {{--                        <a class="waves-effect nav-link @if(request()->is('customer/customer/create')) active @endif" href="{{ url('user_view/') }}" id="customerNavLink">--}}
                    {{--                            <i class="fa-regular fa-user"></i>--}}
                    {{--                            <span class="hide-menu">Customer</span>--}}
                    {{--                            <span class="hide-menu add_btn">--}}
                    {{--                                <i class="fa fa-circle-plus create-customer-btn" data-href="{{ url('/customer/customer/create') }}"></i>--}}
                    {{--                            </span>--}}
                    {{--                        </a>--}}
                    {{--                    </li>--}}
                    <li class="custom_item nav-item @if(request()->is('user_view/*') || request()->is('customer/customer/*') || request()->is('customer/customer/create') || request()->is('customer/customer/*/edit')) active @endif">
                        <a class="waves-effect nav-link @if(request()->is('customer/customer/create')) active @endif" href="{{ url('user_view/') }}" id="customerNavLink">
                            <div class="dashboard_icon"> <img src="{{asset('website')}}/images/Customer.svg" loading="lazy"  alt=""></div>
                            <span class="hide-menu">Customer</span>
                            <span class="hide-menu add_btn">
                                <i class="fa fa-circle-plus create-customer-btn" data-href="{{ url('/customer/customer/create') }}"></i>
                            </span>
                        </a>
                    </li>
                @endcan
                @can('view-'.str_slug('staff'))
                    <li class="dropdown nav-item @if(request()->is('staff/staff*')) active @endif">
                        <a class="waves-effect nav-link" href="#Staff" aria-expanded="{{ request()->is('staff/staff*') ? 'true' : 'false' }}">
                            <i class="fa-regular fa-calendar"></i>
                            <span class="hide-menu">Staff</span>
                        </a>
                        <ul class="collapse submenu {{ request()->is('staff/staff*') ? 'in' : '' }}" id="Staff" data-bs-parent="#menu">
                            <li class="{{ request()->is('staff/staff') ? 'active' : '' }}">
                                <a href="{{ url('staff/staff') }}">Manage Staff</a>
                            </li>
                            <li class="{{ request()->is('sub_contractor') ? 'active' : '' }}">
                                <a href="{{ url('sub_contractor') }}">Sub Contractor</a>
                            </li>
                            @if(auth()->user()->hasRole('user'))
                                <li class="{{ request()->is('admin-listing') ? 'active' : '' }}">
                                    <a href="{{ url('admin-listing') }}">Admin Listing</a>
                                </li>
                            @endif
                            <li class="dropdown nav-item @if(request()->is('staff/staff*')) active @endif">
                                <a class="waves-effect nav-link" href="#Compensation" aria-expanded="false">
                                    <i class="fa-solid fa-sack-dollar"></i>
                                    <span class="hide-menu">Compensation</span>
                                </a>
                                <ul class="collapse submenu" id="Compensation" data-bs-parent="#menu">
                                    <li class="{{ request()->is('staff_benefits_block') ? 'active' : '' }}">
                                        <a href="{{ url('staff_salary_block') }}">Salary Block</a>
                                    </li>
                                    <li class="{{ request()->is('staff_benefits_block') ? 'active' : '' }}">
                                        <a href="{{ url('staff_benefits_block') }}">Benefits Block</a>
                                    </li>
                                    <li class="{{ request()->is('positionBlock/position-block') ? 'active' : '' }}">
                                        <a href="{{ url('positionBlock/position-block') }}">Positions Block</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('view-lead')
                    @php
                        $isActive = request()->is('lead/lead/*') ||
                                    request()->is('appointment_per_day') ||
                                    request()->is('lead_card_view*') ||
                                    request()->is('lead/lead?lead_type=pending') ||
                                    request()->is('lead/lead?lead_type=won') ||
                                    request()->is('lead/lead?lead_type=lost');
                    @endphp
                    @if(!auth()->user()->hasRole('customer'))
                        <li class="dropdown custom_item nav-item @if($isActive) active @endif">
                            <a class="waves-effect nav-link" href="#Lead" aria-expanded="{{ $isActive ? 'true' : 'false' }}">
                                <div class="dashboard_icon"> <img src="{{asset('website')}}/images/Lead Job.svg" loading="lazy"  alt=""></div>
                                <span class="hide-menu">Lead</span>
                                <span class="hide-menu add_btn" data-href="{{ url('/lead/lead/create') }}">
                                <i class="fa fa-circle-plus"></i>
                            </span>
                            </a>
                            @php
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
                            @endphp

                            <ul class="collapse submenu {{ $isActive ? 'in' : '' }}" id="Appointments" data-bs-parent="#menu" aria-expanded="{{ $isActive ? 'true' : 'false' }}">
                                <li id="appointment_all" class="{{ request()->is('lead_card_view*') ? 'active' : '' }}">
                                    <a href="{{ url('lead_card_view?lead_card_view_status=unarchive') }}">
                                        All <span class="badge badge-danger">{{ $all ?? '0' }}</span>
                                    </a>
                                </li>
                                <li id="appointment_new" class="{{ request()->is('lead/lead?lead_type=new') ? 'active' : '' }}">
                                    <a href="{{ url('lead_card_view?lead_type=new') }}">
                                        New <span class="badge badge-danger">{{ $new ?? '0' }}</span>
                                    </a>
                                </li>
                                <li id="lead_pending" class="{{ request()->is('lead/lead?lead_type=pending') ? 'active' : '' }}">
                                    <a href="{{ url('lead_card_view?lead_type=pending') }}">
                                        Pending <span class="badge badge-danger">{{ $pending ?? '0' }}</span>
                                    </a>
                                </li>
                                <li id="lead_won" class="{{ request()->is('lead/lead?lead_type=won') ? 'active' : '' }}">
                                    <a href="{{ url('lead_card_view?lead_type=won') }}">
                                        Won <span class="badge badge-danger">{{ $won ?? '0' }}</span>
                                    </a>
                                </li>
                                <li id="lead_lost" class="{{ request()->is('lead/lead?lead_type=lost') ? 'active' : '' }}">
                                    <a href="{{ url('lead_card_view?lead_type=lost') }}">
                                        Lost <span class="badge badge-danger">{{ $lost ?? '0' }}</span>
                                    </a>
                                </li>
                                <li id="lead_delete" class="{{ request()->is('lead/lead?lead_type=delete') ? 'active' : '' }}">
                                    <a href="{{ url('lead_card_view?lead_type=delete') }}">
                                        Deleted <span class="badge badge-danger">{{ $delete ?? '0' }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                @endif
                @can('view-'.str_slug('appointment'))
                    @if(!auth()->user()->hasRole('customer'))
                        <li class="dropdown nav-item @if(request()->is('schedulingTask/scheduling-task*') || request()->is('calendar_appointment_view*')) active @endif">
                            <a class="waves-effect nav-link" href="#Appointments" aria-expanded="{{ request()->is('schedulingTask/scheduling-task*') || request()->is('calendar_appointment_view*') ? 'true' : 'false' }}">
                                <div class="dashboard_icon"> <img src="{{asset('website')}}/images/Calender.svg" loading="lazy"  alt=""> </div>
                                <span class="hide-menu">Calendar</span>
                            </a>
                            <ul class="collapse submenu {{ request()->is('schedulingTask/scheduling-task*') || request()->is('calendar_appointment_view*') ? 'in' : '' }}" id="Appointments" data-bs-parent="#menu">
                                <li id="appointment_all" class="{{ request()->is('schedulingTask/scheduling-task*') || request()->is('appointment_per_day') ? 'active' : '' }}">
                                    <a href="{{ url('schedulingTask/scheduling-task') }}">Production Calendar</a>
                                </li>
                                <li id="appointment_pending" class="{{ request()->is('calendar_appointment_view*') ? 'active' : '' }}">
                                    <a href="{{ url('calendar_appointment_view') }}">Staff Calendar</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                @endcan
                {{--                @can('view-'.str_slug('appointment'))--}}
                {{--                    <li class="nav-item @if(request()->is('appointment/appointment/*') || request()->is('calendar_appointment_view*') || request()->is('appointment_report_table') || request()->is('sales_weekly') || request()->is('appointment_per_day')) active @endif">--}}
                {{--                        <a class="waves-effect nav-link" href="{{url('appointment/appointment?appointment_type=pending')}}">--}}
                {{--                        <a class="waves-effect nav-link" href="#Appointments">--}}
                {{--                            <i class="fa fa-calendar"></i>--}}
                {{--                            <span class="hide-menu">Appointments Report</span> --}}
                {{--                        </a>--}}
                {{--                        @php--}}
                {{--                            $leadsQuery = \App\Appointment::with('lead');--}}
                {{--                                if (!auth()->user()->hasRole('user')) {--}}
                {{--                                    $leadsQuery->whereHas('lead', function ($query) {--}}
                {{--                                        $query->where('representative_id', auth()->user()->id)--}}
                {{--                                            ->orWhere('customer_id', auth()->user()->id);--}}
                {{--                                    });--}}
                {{--                                } else {--}}
                {{--                                    $leadsQuery->whereHas('lead', function ($query) {});--}}
                {{--                                }--}}
                {{--                                $leads = $leadsQuery->get();--}}
                {{--                                $pending = $leads->where('lead.lead_status', 'pending')->count();--}}
                {{--                                $won = $leads->where('lead.lead_status', 'won')->count();--}}
                {{--                                $lost = $leads->where('lead.lead_status', 'lost')->count();--}}
                {{--                            $all = $leads->where('lead.lead_status')->count();--}}
                {{--                        @endphp--}}

                {{--                        <ul class="collapse submenu" id="Appointments" data-bs-parent="#menu">--}}
                {{--                            <li id="appointment_all" class="{{ request()->is('appointment/appointment/*') || request()->is('appointment_per_day') ?  'active' : '' }}">--}}
                {{--                                <a href="{{url('appointment/appointment')}}"> All <span class="badge badge-danger">{{ $all??'0' }}</span></a>--}}
                {{--                            </li>--}}
                {{--                            <li id="appointment_pending" class="{{ request()->is('appointment/appointment?appointment_type=pending') ?  'active' : '' }}">--}}
                {{--                                <a href="{{url('appointment/appointment?appointment_type=pending')}}"> Pending <span class="badge badge-danger">{{ $pending??'0' }}</span></a>--}}
                {{--                            </li>--}}
                {{--                            <li id="appointment_won" class="{{ request()->is('appointment/appointment?appointment_type=won') ? 'active' : '' }}">--}}
                {{--                                <a href="{{url('appointment/appointment?appointment_type=won')}}">Won <span class="badge badge-danger">{{ $won??'0' }}</span></a>--}}
                {{--                            </li>--}}
                {{--                            <li id="appointment_lost" class="{{ request()->is('appointment/appointment?appointment_type=lost') ? 'active' : '' }}">--}}
                {{--                                <a href="{{url('appointment/appointment?appointment_type=lost')}}">Lost <span class="badge badge-danger">{{ $lost??'0' }}</span></a>--}}
                {{--                            </li>--}}
                {{--                        </ul>--}}
                {{--                        --}}{{--                        <ul class="collapse nav flex-column ms-1 submenu" id="submenu3" data-bs-parent="#menu">--}}
                {{--                        --}}{{--                            <li id="appointment_pending" class="{{ request()->is('appointment/appointment?appointment_type=pending') ?  'active' : '' }}">--}}
                {{--                        --}}{{--                                <a href="{{url('appointment/appointment?appointment_type=pending')}}"> Pending <span class="badge badge-danger">{{ $pending??'0' }}</span></a>--}}
                {{--                        --}}{{--                            </li>--}}
                {{--                        --}}{{--                        </ul>--}}
                {{--                        --}}{{--                        <ul class="collapse nav flex-column ms-1 submenu" id="submenu3" data-bs-parent="#menu">--}}
                {{--                        --}}{{--                            <li id="appointment_won" class="{{ request()->is('appointment/appointment?appointment_type=won') ? 'active' : '' }}">--}}
                {{--                        --}}{{--                                <a href="{{url('appointment/appointment?appointment_type=won')}}">Won <span class="badge badge-danger">{{ $won??'0' }}</span></a>--}}
                {{--                        --}}{{--                            </li>--}}
                {{--                        --}}{{--                        </ul>--}}
                {{--                        --}}{{--                        <ul class="collapse nav flex-column ms-1 submenu" id="submenu3" data-bs-parent="#menu">--}}
                {{--                        --}}{{--                            <li id="appointment_lost" class="{{ request()->is('appointment/appointment?appointment_type=lost') ? 'active' : '' }}">--}}
                {{--                        --}}{{--                                <a href="{{url('appointment/appointment?appointment_type=lost')}}">Lost <span class="badge badge-danger">{{ $lost??'0' }}</span></a>--}}
                {{--                        --}}{{--                            </li>--}}
                {{--                        --}}{{--                        </ul>--}}
                {{--                    </li>--}}
                {{--                @endcan--}}

                @if(auth()->user()->can('view-usermailsend') || auth()->user()->can('view-usersmailboxconfiguration'))
                    <li class="dropdown nav-item">
                        <a class="waves-effect nav-link" href="#communication" aria-expanded="false" aria-controls="communication">
                            <div class="dashboard_icon"> <img src="{{asset('website')}}/images/Comunications.svg" loading="lazy"  alt=""></div>
                            <span class="hide-menu">Communication</span>
                        </a>
                        <ul class="collapse submenu" id="communication" data-bs-parent="#menu">
                            @can('view-usermailsend')
                                <li class="nav-item {{ request()->is('userMailSend/user-mail-send/*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ url('userMailSend/user-mail-send') }}">
                                        <!--                                        <i class="fa fa-envelope"></i>--> Email </a>
                                </li>
                            @endcan
                            @can('view-usersmailboxconfiguration')
                                <li class="nav-item {{ request()->is('usersMailboxConfiguration/users-mailbox-configuration/*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ url('usersMailboxConfiguration/users-mailbox-configuration/') }}">
                                        <!--                                        <i class="fa fa-inbox"></i>-->
                                        <span class="hide-menu">Users Mailbox Configuration</span>
                                    </a>
                                </li>
                            @endcan
                            <li class="nav-item {{ request()->is('mail_configuration/*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/mail_configuration') }}">
                                    <!--                                    <i class="fa fa-inbox"></i>--> Mail Configuration </a>
                            </li>
                        </ul>
                        {{--                            @can('view-usersmailboxconfiguration')--}}
                        {{--                                    <ul class="collapse nav flex-column ms-1 submenu" id="communication" data-bs-parent="#menu">--}}
                        {{--                                <li class="nav-item {{ request()->is('usersMailboxConfiguration/users-mailbox-configuration/*') ? 'active' : '' }}">--}}
                        {{--                                    <a class="nav-link" href="{{ url('usersMailboxConfiguration/users-mailbox-configuration/') }}">--}}
                        {{--                                        <i class="fa fa-inbox"></i>--}}
                        {{--                                        <span class="hide-menu">Users Mailbox Configuration</span>--}}
                        {{--                                    </a>--}}
                        {{--                                </li>--}}
                        {{--                                    </ul>--}}
                        {{--                            @endcan--}}
                        {{--                                        <ul class="collapse nav flex-column ms-1 submenu" id="communication" data-bs-parent="#menu">--}}
                        {{--                            <li class="nav-item {{ request()->is('mail_configuration/*') ? 'active' : '' }}">--}}
                        {{--                                <a class="nav-link" href="{{ url('/mail_configuration') }}">--}}
                        {{--                                    <i class="fa fa-inbox"></i> Mail Configuration </a>--}}
                        {{--                            </li>--}}
                        {{--                        </ul>--}}
                    </li>
                @endif


                {{--                @if(auth()->user()->can('view-roofestimatecalculator'))--}}
                {{--                    <li class="nav-item">--}}
                {{--                        <a class="waves-effect nav-link" href="#roofestimatecalculator" aria-expanded="false" aria-controls="roofestimatecalculator">--}}
                {{--                            <i class="fa fa-users"></i>--}}
                {{--                            <span class="hide-menu">Calculator</span> --}}
                {{--                        </a>--}}
                {{--                            <ul class="collapse submenu" id="roofestimatecalculator" data-bs-parent="#menu">--}}
                {{--                        @can('view-roofestimatecalculator')--}}
                {{--                                <li class="nav-item {{ request()->is('roof_estimation_calculator/*') ? 'active' : '' }}">--}}
                {{--                                    <a class="nav-link" href="{{ url('roofEstimateCalculator/roof-estimate-calculator') }}">--}}
                {{--<!--                                        <i class="fa fa-envelope"></i>--> Roof Estimation </a>--}}
                {{--                                </li>--}}
                {{--                        @endcan--}}
                {{--                        @can('view-sidingestimatecalculator')--}}
                {{--                                <li class="nav-item {{ request()->is('siding_estimation_calculator/*') ? 'active' : '' }}">--}}
                {{--                                    <a class="nav-link" href="{{ url('sidingEstimateCalculator/siding-estimate-calculator') }}">--}}
                {{--                                        <!--                                        <i class="fa fa-envelope"></i>--> Side Estimation </a>--}}
                {{--                                </li>--}}
                {{--                        @endcan--}}
                {{--                        @can('view-chimneyestimatecalculator')--}}
                {{--                                <li class="nav-item {{ request()->is('chimney_estimation_calculator/*') ? 'active' : '' }}">--}}
                {{--                                    <a class="nav-link" href="{{ url('chimneyEstimateCalculator/chimney-estimate-calculator') }}">--}}
                {{--                                        <!--                                        <i class="fa fa-envelope"></i>--> Chimney Estimation </a>--}}
                {{--                                </li>--}}
                {{--                        @endcan--}}
                {{--                        @can('view-productpricingestimatecalculator')--}}
                {{--                                <li class="nav-item {{ request()->is('product_pricing_estimation_calculator/*') ? 'active' : '' }}">--}}
                {{--                                    <a class="nav-link" href="{{ url('productPricingEstimateCalculator/product-pricing-estimate-calculator') }}">--}}
                {{--                                        <!--                                        <i class="fa fa-envelope"></i>--> Product Pricing Estimation </a>--}}
                {{--                                </li>--}}
                {{--                        @endcan--}}
                {{--                            </ul>--}}
                {{--                        @can('view-roofestimatecalculator')--}}
                {{--                            <ul class="collapse submenu" id="roofestimatecalculator" data-bs-parent="#menu">--}}
                {{--                                <li class="nav-item {{ request()->is('roof_estimation_calculator/*') ? 'active' : '' }}">--}}
                {{--                                    <a class="nav-link" href="{{ url('roofEstimateCalculator/roof-estimate-calculator') }}">--}}
                {{--                                        <!--                                        <i class="fa fa-envelope"></i>--> Roof Estimation </a>--}}
                {{--                                </li>--}}
                {{--                            </ul>--}}
                {{--                        @endcan--}}
                {{--                        @can('view-sidingestimatecalculator')--}}
                {{--                            <ul class="collapse nav flex-column ms-1 submenu" id="communication" data-bs-parent="#menu">--}}
                {{--                                <li class="nav-item {{ request()->is('siding_estimation_calculator/*') ? 'active' : '' }}">--}}
                {{--                                    <a class="nav-link" href="{{ url('sidingEstimateCalculator/siding-estimate-calculator') }}">--}}
                {{--<!--                                        <i class="fa fa-envelope"></i>--> Side Estimation </a>--}}
                {{--                                </li>--}}
                {{--                            </ul>--}}
                {{--                        @endcan--}}
                {{--                    </li>--}}
                {{--                @endif--}}

                @can('view-'.str_slug('Campaign'))
                    <li class="dropdown nav-item {{ request()->is('campaign/campaign/*') ? 'active' : '' }}" >
                        {{--                        <a class="waves-effect nav-link" href="{{url('campaign/campaign?campaign_type=active')}}">--}}
                        <a class="waves-effect nav-link" href="#Campaign" aria-expanded="false">
                            <div class="dashboard_icon"> <img src="{{asset('website')}}/images/Camping.svg" loading="lazy"  alt=""></div>
                            <span class="hide-menu">Campaign</span>
                        </a>
                        <ul class="collapse submenu" id="Campaign" data-bs-parent="#menu">
                            <li id="campaign_active" class="{{ request()->is('campaign/campaign?campaign_type=active') ? 'active' : '' }}">
                                <a href="{{url('campaign/campaign?campaign_type=active')}}"> Active Campaign</a>
                            </li>
                            <li id="campaign_inactive" class="{{ request()->is('campaign/campaign?campaign_type=inactive') ? 'active' : '' }}"><a href="{{url('campaign/campaign?campaign_type=inactive')}}">InActive Campaign</a></li>
                        </ul>
                        {{--                        <ul class="collapse nav flex-column ms-1 submenu" id="submenu3" data-bs-parent="#menu">--}}
                        {{--                        </ul>--}}
                    </li>
                @endcan
                @if(!auth()->user()->hasRole('customer'))
                    <li class="dropdown nav-item" >
                        <a class="waves-effect nav-link" href="#AITools" aria-expanded="false">
                            <div class="dashboard_icon"> <img src="{{asset('website')}}/images/user-robot.svg" loading="lazy"  alt=""></div>
                            <span class="hide-menu">AI Tools</span>
                        </a>
                        <ul class="collapse submenu" id="AITools" data-bs-parent="#menu">
                            <li>
                                <a href="{{url('ai_year_estimation')}}">Year Estimation</a>
                            </li>
                            <li>
                                <a href="{{url('earning-forecast')}}">Job Type Earnings Analysis</a>
                            </li>
                            <li>
                                <a href="{{url('marketing-analysis')}}">Marketing Spend Optimization</a>
                            </li>
                            <li>
                                <a href="{{url('')}}">Expense Prediction For Leads</a>
                            </li>
                            <li>
                                <a href="{{url('dashboard-insights')}}">Dashboard Insights</a>
                            </li>
                            <li>
                                <a href="{{url('chatbot-assistant')}}">ChatBot Assistant</a>
                            </li>
                        </ul>
                    </li>
                @endif

                {{--                @if(auth()->user()->can('view-advertisement') || auth()->user()->can('view-referralsource') ||auth()->user()->can('view-costoflead') )--}}
                {{--                    <li class="nav-item @if(request()->is('referralSource/referral-source/*') ||request()->is('advertisement/advertisement/*') ||request()->is('cost_of_lead/*')||request()->is('yearly_advertising_report')) active @endif">--}}
                {{--                        <a class="waves-effect nav-link" href="{{ url('referralSource/referral-source') }}">--}}
                {{--                        <a class="waves-effect nav-link" href="#Marketing">--}}
                {{--                            <i class="fa fa-cog"></i>--}}
                {{--                            <span class="hide-menu">Marketing</span> --}}
                {{--                        </a>--}}
                {{--                        <ul class="collapse submenu" id="Marketing" data-bs-parent="#menu">--}}
                {{--                            @can('view-referralsource')--}}
                {{--                                <li class="nav-item @if(request()->is('referralSource/referral-source/*')) active @endif " >--}}
                {{--                                    <a href="{{url('referralSource/referral-source/')}}" class="nav-link">--}}
                {{--<!--                                        <i class="fa fa-list-alt" aria-hidden="true"></i>--> Referral Source</a>--}}
                {{--                                </li>--}}
                {{--                            @endcan--}}
                {{--                            @can('view-advertisement')--}}
                {{--                                <li class="nav-item @if(request()->is('advertisement/advertisement/*')||request()->is('yearly_advertising_report')) active @endif">--}}
                {{--                                    <a href="{{ url('advertisement/advertisement/') }}" class="nav-link">--}}
                {{--<!--                                        <i class="fa fa-line-chart" aria-hidden="true"></i>-->Monthly Advertisement</a>--}}
                {{--                                </li>--}}
                {{--                            @endcan--}}
                {{--                            @can('view-advertisement')--}}
                {{--                                <li class="nav-item @if(request()->is('cost_of_lead/*')) active @endif ">--}}
                {{--                                    <a href="{{url('cost_of_lead/')}}" class="nav-link">--}}
                {{--<!--                                        <i class="fa fa-flag"></i>-->Cost Of Lead</a>--}}
                {{--                                </li>--}}
                {{--                            @endcan--}}
                {{--                        </ul>--}}
                {{--                    </li>--}}
                {{--                @endif--}}
                @if(auth()->user()->hasRole('user'))
                    <li class="dropdown nav-item">
                        <a class="waves-effect nav-link" href="#support" aria-expanded="false">
                            <div class="dashboard_icon"> <img src="{{asset('website')}}/images/support.svg" loading="lazy"  alt=""></div>
                            <span class="hide-menu">Support</span>
                        </a>
                        <ul class="collapse submenu" id="support" data-bs-parent="#menu">
                            <li class="nav-item {{ request()->is('reporting_for_stages', 'reporting_for_stages/*','monthly_sales_report', 'monthly_sales_report/*') ? 'active' : '' }}">
                                <a href="{{url('support_chat')}}" class="nav-link">Support Chat</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('lead_chat')}}" class="nav-link">Lead Chats</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('referrals')}}" class="nav-link">Referrals</a>
                            </li>
                        </ul>
                    </li>
                @endif

                @can('view-'.str_slug('ReportPermission'))
                    <li class="dropdown nav-item {{ request()->is('reporting_for_stages', 'reporting_for_stages/*', 'jobs_won', 'jobs_won/*', 'performance', 'performance/*', 'by_salesman', 'by_salesman/*', 'summary', 'summary/*', 'job_listings', 'job_listings/*', 'monthly_sales_report', 'monthly_sales_report/*') ? 'active' : '' }}">
                        {{--                        <a class="waves-effect nav-link {{ request()->is('reporting_for_stages', 'reporting_for_stages/*', 'jobs_won', 'jobs_won/*', 'performance', 'performance/*', 'by_salesman', 'by_salesman/*', 'summary', 'summary/*', 'job_listings', 'job_listings/*', 'monthly_sales_report', 'monthly_sales_report/*') ? 'active' : '' }}" href="{{url('reporting_for_stages')}}">--}}
                        <a class="waves-effect nav-link" href="#Reports" aria-expanded="false">
                            <div class="dashboard_icon"> <img src="{{asset('website')}}/images/Reports.svg" loading="lazy"  alt=""></div>
                            <span class="hide-menu"> Reports</span>
                        </a>
                        <ul class="collapse submenu" id="Reports" data-bs-parent="#menu">
                            <li class="nav-item {{ request()->is('reporting_for_stages', 'reporting_for_stages/*','monthly_sales_report', 'monthly_sales_report/*') ? 'active' : '' }}">
                                <a href="{{url('reporting_for_stages')}}" class="nav-link">
                                    <!--                                    <i class="fa fa-pie-chart"></i>-->  Monthly Reports  </a>
                            </li>
                            <li class="nav-item {{ request()->is('jobs_won', 'jobs_won/*') ? 'active' : '' }}">
                                <a href="{{url('jobs_won?filter=year')}}" class="nav-link">
                                    <!--                                    <i class="fa fa-wrench"></i>-->
                                    Jobs Won(#)
                                </a>
                            </li>
                            <li class="nav-item {{ request()->is('performance', 'performance/*') ? 'active' : '' }}">
                                <a href="{{url('performance')}}" class="nav-link">
                                    <!--                                    <i class="fa fa-area-chart"></i>-->
                                    Performance ($)
                                </a>
                            </li>
                            <li class="nav-item {{ request()->is('by_salesman', 'by_salesman/*') ? 'active' : '' }}">
                                <a href="{{url('by_salesman')}}" class="nav-link">
                                    <!--                                    <i class="fa fa-money"></i>--> By Salesmen</a>
                            </li>
                            <li class="nav-item {{ request()->is('summary', 'summary/*') ? 'active' : '' }}">
                                <a href="{{url('summary')}}" class="nav-link">
                                    <!--                                    <i class="fa fa-file-pdf-o"></i>--> Summary</a>
                            </li>
                            <li class="nav-item {{ request()->is('job_listings', 'job_listings/*') ? 'active' : '' }}">
                                <a href="{{url('job_listings')}}" class="nav-link">
                                    <!--                                    <i class="fa fa-th-list"></i>--> Job Listing (#)</a>
                            </li>
                            @can('view-'.str_slug('appointment'))
                                <li class="dropdown nav-item @if(request()->is('appointment/appointment/*') || request()->is('appointment_report_table') || request()->is('sales_weekly') || request()->is('appointment_per_day')) active @endif">
                                    {{--                                <a class="waves-effect nav-link" href="{{url('appointment/appointment?appointment_type=pending')}}">--}}
                                    <a class="waves-effect nav-link" href="#Appointments" aria-expanded="false">
                                        <i class="fa fa-calendar"></i>
                                        <span class="hide-menu">Appointments Report</span>
                                    </a>

                                    @php
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
                                    @endphp
                                    <ul class="collapse submenu" id="Appointments" data-bs-parent="#menu">
                                        <li id="appointment_all" class="{{ request()->is('appointment/appointment/*') || request()->is('appointment_per_day') ?  'active' : '' }}">
                                            <a href="{{url('appointment/appointment')}}"> All <span class="badge badge-danger">{{ $all??'0' }}</span></a>
                                        </li>
                                        <li id="appointment_pending" class="{{ request()->is('appointment/appointment?appointment_type=pending') ?  'active' : '' }}">
                                            <a href="{{url('appointment/appointment?appointment_type=pending')}}"> Pending <span class="badge badge-danger">{{ $pending??'0' }}</span></a>
                                        </li>
                                        <li id="appointment_won" class="{{ request()->is('appointment/appointment?appointment_type=won') ? 'active' : '' }}">
                                            <a href="{{url('appointment/appointment?appointment_type=won')}}">Won <span class="badge badge-danger">{{ $won??'0' }}</span></a>
                                        </li>
                                        <li id="appointment_lost" class="{{ request()->is('appointment/appointment?appointment_type=lost') ? 'active' : '' }}">
                                            <a href="{{url('appointment/appointment?appointment_type=lost')}}">Lost <span class="badge badge-danger">{{ $lost??'0' }}</span></a>
                                        </li>
                                    </ul>
                                    {{--                                                                            <ul class="collapse nav flex-column ms-1 submenu" id="submenu3" data-bs-parent="#menu">--}}
                                    {{--                                                                                <li id="appointment_pending" class="{{ request()->is('appointment/appointment?appointment_type=pending') ?  'active' : '' }}">--}}
                                    {{--                                                                                    <a href="{{url('appointment/appointment?appointment_type=pending')}}"> Pending <span class="badge badge-danger">{{ $pending??'0' }}</span></a>--}}
                                    {{--                                                                                </li>--}}
                                    {{--                                                                            </ul>--}}
                                    {{--                                                                            <ul class="collapse nav flex-column ms-1 submenu" id="submenu3" data-bs-parent="#menu">--}}
                                    {{--                                                                                <li id="appointment_won" class="{{ request()->is('appointment/appointment?appointment_type=won') ? 'active' : '' }}">--}}
                                    {{--                                                                                    <a href="{{url('appointment/appointment?appointment_type=won')}}">Won <span class="badge badge-danger">{{ $won??'0' }}</span></a>--}}
                                    {{--                                                                                </li>--}}
                                    {{--                                                                            </ul>--}}
                                    {{--                                                                            <ul class="collapse nav flex-column ms-1 submenu" id="submenu3" data-bs-parent="#menu">--}}
                                    {{--                                                                                <li id="appointment_lost" class="{{ request()->is('appointment/appointment?appointment_type=lost') ? 'active' : '' }}">--}}
                                    {{--                                                                                    <a href="{{url('appointment/appointment?appointment_type=lost')}}">Lost <span class="badge badge-danger">{{ $lost??'0' }}</span></a>--}}
                                    {{--                                                                                </li>--}}
                                    {{--                                                                            </ul>--}}
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                {{--                @can('view-paymentType')--}}
                {{--                    <li class="nav-item @if(request()->is('paymentType/payment-type/*')) active @endif">--}}
                {{--                        <a class="waves-effect nav-link" href="{{url('paymentType/payment-type/')}}">--}}
                {{--                            <i class="fa fa-cc-visa"></i>--}}
                {{--                            <span class="hide-menu">Payment Type</span>--}}
                {{--                        </a>--}}
                {{--                    </li>--}}
                {{--                @endif--}}
                @if(auth()->user()->can('view-users') || auth()->user()->can('view-proposaltemplate')|| auth()->user()->can('view-companycontact') ||auth()->user()->can('view-emailtemplate') || auth()->user()->can('view-yearEstimation') || auth()->user()->can('view-category') || auth()->user()->can('view-stage') || auth()->user()->can('view-team') || auth()->user()->can('view-staff'))
                    <li class="dropdown nav-item @if(request()->is('proposalTemplate/proposal-template/*') || request()->is('companyContact/company-contact/*') || request()->is('holiday/holiday/*')  ||request()->is('stage/stage/*') ||request()->is('team/team/*')||request()->is('emailTemplate/email-template/*') ||request()->is('category/category/*') ||request()->is('users/*') ||request()->is('staff/staff/*')|| request()->is('yearEstimation/year-estimation/*')) active @endif">
                        {{--                        <a class="waves-effect nav-link" href="{{ url('staff/staff') }}">--}}
                        <a class="waves-effect nav-link" href="#Settings" aria-expanded="false">
                            <div class="dashboard_icon"> <img src="{{asset('website')}}/images/Settings.svg" loading="lazy"  alt=""></div>
                            <span class="hide-menu"> Settings </span>
                        </a>
                        <ul class="collapse submenu" id="Settings" data-bs-parent="#menu">
                            {{--                            @if(auth()->user()->hasRole('user'))--}}
                            {{--                                <li>--}}
                            {{--                                    <a class="nav-link px-0" href="{{ url('users') }}">--}}
                            {{--                                    <i class="fa fa-user" aria-hidden="true"></i>  Manage Users</a>--}}
                            {{--                                </li>--}}
                            {{--                            @endif--}}
                            {{--@can('view-staff')--}}
                            {{--<li class="nav-item @if(request()->is('staff/staff/*')) active @endif ">--}}
                            {{--<a class="nav-link" href="{{url('staff/staff/')}}">--}}
                            {{--<!--<i class="fa fa-odnoklassniki-square"></i>--> Staff</a>--}}
                            {{--</li>--}}
                            {{--@endcan--}}
                            {{--                            @can('view-companycontact')--}}
                            {{--                                <li class="nav-item @if(request()->is('companyContact/company-contact/*')) active @endif " >--}}
                            {{--                                    <a class="nav-link" href="{{url('companyContact/company-contact/')}}">--}}
                            {{--                                        <!--                                        <i class="fa fa-odnoklassniki-square"></i>--> Company Contact</a>--}}
                            {{--                                </li>--}}
                            {{--                            @endcan--}}

                            {{--                            @can('view-emailtemplate')--}}
                            {{--                                <li class="nav-item @if(request()->is('emailTemplate/email-template/*')) active @endif ">--}}
                            {{--                                    <a class="nav-link" href="{{url('emailTemplate/email-template/')}}">--}}
                            {{--                                        <!--                                        <i class="fa fa-bookmark-o"></i>-->  Email Template--}}
                            {{--                                    </a>--}}
                            {{--                                </li>--}}
                            {{--                            @endcan--}}

                            {{--                            @can('view-emailtemplatefolder')--}}
                            {{--                                <li class="nav-item @if(request()->is('emailTemplateFolder/email-template-folder/*')) active @endif ">--}}
                            {{--                                    <a class="nav-link" href="{{url('emailTemplateFolder/email-template-folder/')}}">--}}
                            {{--                                        <!--<i class="fa fa-bookmark-o"></i>-->  Email Template Folder--}}
                            {{--                                    </a>--}}
                            {{--                                </li>--}}

                            {{--                                <li class="nav-item @if(request()->is('emailTemplateFolder/email-template-folder/*')) active @endif ">--}}
                            {{--                                    <a class="nav-link" href="{{url('email_branding')}}">--}}
                            {{--                                        <!--<i class="fa fa-bookmark-o"></i>-->  Email Branding--}}
                            {{--                                    </a>--}}
                            {{--                                </li>--}}
                            {{--                            @endcan--}}
                            {{--                            @can('view-emailtemplatevariable')--}}
                            {{--                                <li class="nav-item @if(request()->is('emailTemplateVariable/email-template-variable/*')) active @endif ">--}}
                            {{--                                    <a class="nav-link" href="{{url('emailTemplateVariable/email-template-variable/')}}">--}}
                            {{--<!--                                        <i class="fa fa-bookmark-o"></i>-->  Email Varible--}}
                            {{--                                    </a>--}}
                            {{--                                </li>--}}
                            {{--                            @endcan--}}
                            {{--                            @can('view-proposaltemplate')--}}
                            {{--                                <li class="nav-item @if(request()->is('proposalTemplate/proposal-template/*')) active @endif ">--}}
                            {{--                                    <a class="nav-link" href="{{url('proposalTemplate/proposal-template/')}}">--}}
                            {{--                                        <!--                                        <i class="fa fa-bookmark-o"></i>-->  Proposal Template--}}
                            {{--                                    </a>--}}
                            {{--                                </li>--}}
                            {{--                            @endcan--}}
                            @can('view-yearestimation')
                                <li class="nav-item @if(request()->is('yearEstimation/year-estimation/*')) active @endif " >
                                    <a href="{{url('yearEstimation/year-estimation/')}}" class="nav-link">
                                        <!--                                        <i class="fa fa-calculator" aria-hidden="true"></i>-->Year Estimation</a>
                                </li>
                            @endcan
                            {{--                            @can('view-category')--}}
                            {{--                                <li class="nav-item @if(request()->is('category/category/*')) active @endif " >--}}
                            {{--                                    <a href="{{url('category/category/')}}" class="nav-link">--}}
                            {{--                                        <!--                                        <i class="fa fa-list-alt" aria-hidden="true"></i>--> Category</a>--}}
                            {{--                                </li>--}}
                            {{--                            @endcan--}}
                            {{--                            @can('view-stage')--}}
                            {{--                                <li class="nav-item @if(request()->is('stage/stage/*')) active @endif " >--}}
                            {{--                                    <a href="{{url('stage/stage/')}}" class="nav-link">--}}
                            {{--                                        <!--                                        <i class="fa fa-flag"></i>--> Stage</a>--}}
                            {{--                                </li>--}}
                            {{--                            @endcan--}}
                            {{--                            @can('view-team')--}}
                            {{--                                <li class="nav-item @if(request()->is('team/team/*')) active @endif " >--}}
                            {{--                                    <a href="{{url('team/team/')}}" class="nav-link">--}}
                            {{--                                        <!--                                        <i class="fa fa-users" aria-hidden="true"></i>--> Team</a>--}}
                            {{--                                </li>--}}
                            {{--                            @endcan--}}
                            {{--                            @can('view-holiday')--}}
                            {{--                                <li class="nav-item @if(request()->is('holiday/holiday/*')) active @endif " >--}}
                            {{--                                    <a href="{{url('holiday/holiday')}}" class="nav-link">--}}
                            {{--                                        <!--                                        <i class="fa fa-users" aria-hidden="true"></i>--> Holiday</a>--}}
                            {{--                                </li>--}}
                            {{--                            @endcan--}}
                            @if(auth()->user()->hasRole('user'))
                                <li class="nav-item">
                                    <a href="{{ url('proposal_generator') }}" class="nav-link">
                                        {{--                                        <i class="fa fa-file-word"></i>--}}
                                        <span class="hide-menu">Proposal Generator</span>
                                    </a>
                                </li>
                            @endif
                            {{--                            @if(auth()->user()->hasRole('user'))--}}
                            {{--                                <li class="nav-item @if(request()->is('calendar_types')) active @endif ">--}}
                            {{--                                    <a href="{{ url('calendar_types') }}" class="nav-link">--}}
                            {{--                                        <span class="hide-menu">Calendar Types</span>--}}
                            {{--                                    </a>--}}
                            {{--                                </li>--}}
                            {{--                            @endif--}}
                        </ul>
                    </li>
                @endif
                @if( auth()->user()->can('view-mark') || auth()->user()->can('view-priority') || auth()->user()->can('view-announcement') || auth()->user()->can('view-cogsmaterial'))
                    <li class="dropdown nav-item @if(request()->is('mark/mark/*') ||request()->is('priority/priority/*') ||request()->is('roofEstimateCalculator/roof-estimate-calculator/*') ||request()->is('sidingEstimateCalculator/siding-estimate-calculator') ||request()->is('chimneyEstimateCalculator/chimney-estimate-calculator/*') ||request()->is('productPricingEstimateCalculator/product-pricing-estimate-calculator/*') ||request()->is('referralSource/referral-source/*') ||request()->is('advertisement/advertisement/*') ||request()->is('cost_of_lead/*') ||request()->is('announcement/announcement/*')) active @endif">
                        {{--                        <a class="waves-effect nav-link" href="{{url('cogsMaterial/cogs-material/')}}" >--}}
                        <a class="waves-effect nav-link" href="#Other"  aria-expanded="false">
                            <i class="fab-regular fa fa-icons"></i>
                            <span class="hide-menu">Other</span>
                        </a>
                        <ul class="collapse submenu" id="Other" data-bs-parent="#menu">
                            {{--                            @can('view-cogsmaterial')--}}
                            {{--                                <li class="nav-item @if(request()->is('cogsMaterial/cogs-material/*')) active @endif " >--}}
                            {{--                                    <a class="nav-link" href="{{url('cogsMaterial/cogs-material/')}}">--}}
                            {{--                                        <!--                                        <i class="fa fa-sitemap"></i>--> COGS Materials </a>--}}
                            {{--                                </li>--}}
                            {{--                            @endcan--}}
                            {{--                            @can('view-mark')--}}
                            {{--                                <li class="nav-item @if(request()->is('mark/mark/*')) active @endif ">--}}
                            {{--                                    <a class="nav-link" href="{{url('mark/mark/')}}">--}}
                            {{--                                        <!--                                        <i class="fa fa-bookmark-o"></i>-->  Mark</a>--}}
                            {{--                                </li>--}}
                            {{--                            @endcan--}}
                            {{--                            @can('view-priority')--}}
                            {{--                                <li class="nav-item @if(request()->is('priority/priority/*')) active @endif ">--}}
                            {{--                                    <a href="{{url('priority/priority/')}}" class="nav-link">--}}
                            {{--                                        <!--                                        <i class="fa fa-exclamation-circle"></i>-->--}}
                            {{--                                        Priority--}}
                            {{--                                    </a>--}}
                            {{--                                </li>--}}
                            {{--                            @endcan--}}
                            {{--                            @can('view-announcement')--}}
                            {{--                                <li class="nav-item @if(request()->is('announcement/announcement/*')) active @endif ">--}}
                            {{--                                    <a href="{{url('announcement/announcement/')}}" class="nav-link">--}}
                            {{--                                        <!--                                        <i class="fa fa-bullhorn"></i>--> Announcement</a>--}}
                            {{--                                </li>--}}
                            {{--                            @endcan--}}
                            {{--                            @can('view-customerownertype')--}}
                            {{--                                <li class="nav-item @if(request()->is('customerOwnerType/customer-owner-type/*')) active @endif ">--}}
                            {{--                                    <a href="{{url('customerOwnerType/customer-owner-type/')}}" class="nav-link">Customer Owner Type</a>--}}
                            {{--                                </li>--}}
                            {{--                            @endcan--}}
                            {{--                            @can('view-announcement')--}}
                            {{--                                <li class="nav-item @if(request()->is('calculatorSize/calculator-size/*')) active @endif ">--}}
                            {{--                                    <a href="{{url('calculatorSize/calculator-size/')}}" class="nav-link">--}}
                            {{--                                        <!--                                        <i class="fa fa-bullhorn"></i>--> Calculator Size</a>--}}
                            {{--                                </li>--}}
                            {{--                            @endcan--}}
                            @can('view-progressboard')
                                <li class="nav-item @if(request()->is('progress_board/*')) active @endif ">
                                    <a href="{{url('progress_board')}}" class="nav-link">Progress Board</a>
                                </li>
                            @endcan
                            {{--                            @can('view-productcategory')--}}
                            {{--                                <li class="nav-item @if(request()->is('productCategory/product-category/*')) active @endif ">--}}
                            {{--                                    <a href="{{url('productCategory/product-category')}}" class="nav-link">Product Category</a>--}}
                            {{--                                </li>--}}
                            {{--                            @endcan--}}
                            @can('view-product')
                                <li class="nav-item @if(request()->is('product/product/*')) active @endif ">
                                    <a href="{{url('product/product')}}" class="nav-link">Product</a>
                                </li>
                            @endcan
                            {{--                            @can('view-material')--}}
                            {{--                                <li class="nav-item @if(request()->is('material/material/*')) active @endif ">--}}
                            {{--                                    <a href="{{url('material/material')}}" class="nav-link">Material</a>--}}
                            {{--                                </li>--}}
                            {{--                            @endcan--}}
                            {{--                            @can('view-paymenttype')--}}
                            {{--                                <li class="nav-item @if(request()->is('paymentType/payment-type/*')) active @endif">--}}
                            {{--                                    <a class="waves-effect nav-link" href="{{url('paymentType/payment-type/')}}">--}}
                            {{--                                        --}}{{--                                        <i class="fa fa-cc-visa"></i>--}}
                            {{--                                        <span class="hide-menu">Payment Type</span>--}}
                            {{--                                    </a>--}}
                            {{--                                </li>--}}
                            {{--                            @endif--}}
                            <li class="dropdown nav-item @if(request()->is('mark/mark/*') ||request()->is('priority/priority/*') ||request()->is('roofEstimateCalculator/roof-estimate-calculator/*') ||request()->is('sidingEstimateCalculator/siding-estimate-calculator') ||request()->is('chimneyEstimateCalculator/chimney-estimate-calculator/*') ||request()->is('productPricingEstimateCalculator/product-pricing-estimate-calculator/*') ||request()->is('referralSource/referral-source/*') ||request()->is('advertisement/advertisement/*') ||request()->is('cost_of_lead/*') ||request()->is('announcement/announcement/*')) active @endif">
                                {{--                        <a class="waves-effect nav-link" href="{{url('cogsMaterial/cogs-material/')}}" >--}}
                                <a class="waves-effect nav-link" href="#calculator" aria-expanded="false" >
                                    <i class="fa fa-calculator"></i>
                                    <span class="hide-menu">Calculator</span>
                                </a>
                                <ul class="collapse submenu" id="calculator" data-bs-parent="#menu">
                                    @can('view-roofestimatecalculator')
                                        <li class="nav-item {{ request()->is('roof_estimation_calculator/*') ? 'active' : '' }}">
                                            <a class="nav-link" href="{{ url('roofEstimateCalculator/roof-estimate-calculator') }}">
                                                <!--                                        <i class="fa fa-envelope"></i>--> Roof Estimation </a>
                                        </li>
                                    @endcan
                                    @can('view-sidingestimatecalculator')
                                        <li class="nav-item {{ request()->is('siding_estimation_calculator/*') ? 'active' : '' }}">
                                            <a class="nav-link" href="{{ url('sidingEstimateCalculator/siding-estimate-calculator') }}">
                                                <!--                                        <i class="fa fa-envelope"></i>--> Side Estimation </a>
                                        </li>
                                    @endcan
                                    @can('view-chimneyestimatecalculator')
                                        <li class="nav-item {{ request()->is('chimney_estimation_calculator/*') ? 'active' : '' }}">
                                            <a class="nav-link" href="{{ url('chimneyEstimateCalculator/chimney-estimate-calculator') }}">
                                                <!--                                        <i class="fa fa-envelope"></i>--> Chimney Estimation </a>
                                        </li>
                                    @endcan
                                    @can('view-productpricingestimatecalculator')
                                        <li class="nav-item {{ request()->is('product_pricing_estimation_calculator/*') ? 'active' : '' }}">
                                            <a class="nav-link" href="{{ url('productPricingEstimateCalculator/product-pricing-estimate-calculator') }}">
                                                <!--                                        <i class="fa fa-envelope"></i>--> Product Pricing Estimation </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                            {{--                            <li class="dropdown nav-item @if(request()->is('mark/mark/*') ||request()->is('priority/priority/*') ||request()->is('roofEstimateCalculator/roof-estimate-calculator/*') ||request()->is('sidingEstimateCalculator/siding-estimate-calculator') ||request()->is('chimneyEstimateCalculator/chimney-estimate-calculator/*') ||request()->is('productPricingEstimateCalculator/product-pricing-estimate-calculator/*') ||request()->is('referralSource/referral-source/*') ||request()->is('advertisement/advertisement/*') ||request()->is('cost_of_lead/*') ||request()->is('announcement/announcement/*')) active @endif">--}}
                            {{--                                --}}{{--                        <a class="waves-effect nav-link" href="{{url('cogsMaterial/cogs-material/')}}" >--}}
                            {{--                                <a class="waves-effect nav-link" href="#Marketing" aria-expanded="false" >--}}
                            {{--                                    <i class="fa fa-calculator"></i>--}}
                            {{--                                    <span class="hide-menu">Marketing</span>--}}
                            {{--                                </a>--}}
                            {{--                                <ul class="collapse submenu" id="marketing" data-bs-parent="#menu">--}}
                            {{--                                    @can('view-referralsource')--}}
                            {{--                                        <li class="nav-item @if(request()->is('referralSource/referral-source/*')) active @endif " >--}}
                            {{--                                            <a href="{{url('referralSource/referral-source/')}}" class="nav-link">--}}
                            {{--                                                <!--                                        <i class="fa fa-list-alt" aria-hidden="true"></i>--> Referral Source</a>--}}
                            {{--                                        </li>--}}
                            {{--                                    @endcan--}}
                            {{--                                    @can('view-advertisement')--}}
                            {{--                                        <li class="nav-item @if(request()->is('advertisement/advertisement/*')||request()->is('yearly_advertising_report')) active @endif">--}}
                            {{--                                            <a href="{{ url('advertisement/advertisement/') }}" class="nav-link">--}}
                            {{--                                                <!--                                        <i class="fa fa-line-chart" aria-hidden="true"></i>-->Monthly Advertisement</a>--}}
                            {{--                                        </li>--}}
                            {{--                                    @endcan--}}
                            {{--                                    @can('view-advertisement')--}}
                            {{--                                        <li class="nav-item @if(request()->is('cost_of_lead/*')) active @endif ">--}}
                            {{--                                            <a href="{{url('cost_of_lead/')}}" class="nav-link">--}}
                            {{--                                                <!--                                        <i class="fa fa-flag"></i>-->Cost Of Lead</a>--}}
                            {{--                                        </li>--}}
                            {{--                                    @endcan--}}
                            {{--                                </ul>--}}
                            {{--                            </li>--}}

                        </ul>
                    </li>
                @endif
                {{--                @can('view-'.str_slug('account-settings'))--}}
                @if(auth()->user()->hasRole('subcontractor'))
                    <li>
                        <a class="waves-effect" href="{{url('sub_contractor_insurance_info')}}" aria-expanded="false">
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
                                <a href="{{ url('work_orders/upcoming') }}" class="nav-link">Upcoming</a>
                            </li>
                            <li>
                                <a href="{{ url('work_orders/signed') }}" class="nav-link">Signed</a>
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
                                <a href="{{ url('job/active') }}" class="nav-link">Active</a>
                            </li>
                            <li>
                                <a href="{{ url('job/complete') }}" class="nav-link">Complete</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="waves-effect" href="{{url('sub_contractor_finance')}}" aria-expanded="false">
                            <i class="fa-solid fa-desktop"></i>
                            <span class="hide-menu">Finance</span>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->hasRole('customer'))
                    {{--                    <li class="{{ request()->is('customer-management/96') ? 'active' : '' }}">--}}
                    {{--                        <a class="waves-effect {{ request()->is('customer-management/96') ? 'active' : '' }}" href="{{url('customer-management/96')}}" aria-expanded="false">--}}
                    {{--                            <div class="dashboard_icon"> <img src="{{asset('website')}}/images/Lead Job.svg"></div>--}}
                    {{--                            <span class="hide-menu">Lead</span>--}}
                    {{--                        </a>--}}
                    {{--                    </li>--}}

                    <li>
                        <a href="{{url('dashboard')}}/#customer-payments-tab">
                            <i class="fa-solid fa-list"></i>
                            <span class="hide-menu">Job Listings</span>
                        </a>
                    </li>
                @endif
                @if(!auth()->user()->hasRole('customer'))
                    <li class="dropdown nav-item">
                        <a class="waves-effect nav-link" href="#AccountSettings" aria-expanded="false">
                            <div class="dashboard_icon"> <img src="{{asset('website')}}/images/Account Setting.svg" loading="lazy" alt=""></div>
                            <span class="hide-menu"> Account Settings</span>
                        </a>
                        <ul class="collapse submenu" id="AccountSettings" data-bs-parent="#menu">
                            @if(auth()->user()->hasRole('subcontractor'))
                                <li>
                                    <a href="{{ url('sub_contractor_profile') }}" class="nav-link">Profile</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ url('user_profile') }}" class="nav-link">Profile</a>
                                </li>
                            @endif
                            @if(!auth()->user()->hasRole('subcontractor'))
                                <li>
                                    <a href="{{ url('change_password') }}" class="nav-link">Change Password</a>
                                </li>
                            @endif
                            @if(auth()->user()->hasRole('user'))
                                <li>
                                    <a href="{{ url('terms_and_condition') }}" class="nav-link">Terms and conditions</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                {{--                @endcan--}}
                <li class="nav-item">
                    <a class="waves-effect nav-link" href="javascript:void(0);" id="signoutButton">
                        <div class="dashboard_icon"> <img src="{{asset('website')}}/images/Logout.svg" loading="lazy"  alt=""></div>
                        <span class="hide-menu">Signout</span>
                    </a>
                </li>
                @if(auth()->user()->isAdmin() == true)
                    <li><hr/></li>
                    <li class="two-column">
                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false">
                            <i class="icon-equalizer fa-fw"></i>
                            <span class="hide-menu"> UI Elements</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li>
                                <a href="{{asset('panels-wells')}}">
                                    Panels and Wells
                                </a>
                            </li>
                            <li><a href="{{asset('panel-ui-block')}}">Panels With BlockUI</a></li>
                            <li><a href="{{asset('portlet-draggable')}}">Draggable Portlet</a></li>
                            <li><a href="{{asset('buttons')}}">Buttons</a></li>
                            <li><a href="{{asset('tabs')}}">Tabs</a></li>
                            <li><a href="{{asset('modals')}}">Modals</a></li>
                            <li><a href="{{asset('progressbars')}}">Progress Bars</a></li>
                            <li><a href="{{asset('notification')}}">Notifications</a></li>
                            <li><a href="{{asset('carousel')}}">Carousel</a></li>
                            <li><a href="{{asset('user-cards')}}">User Cards</a></li>
                            <li><a href="{{asset('timeline')}}">Timeline</a></li>
                            <li><a href="{{asset('timeline-horizontal')}}">Horizontal Timeline</a></li>
                            <li><a href="{{asset('range-slider')}}">Range Slider</a></li>
                            <li><a href="{{asset('ribbons')}}">Ribbons</a></li>
                            <li><a href="{{asset('steps')}}">Steps</a></li>
                            <li><a href="{{asset('session-idle-timeout')}}">Session Idle Timeout</a></li>
                            <li><a href="{{asset('session-timeout')}}">Session Timeout</a></li>
                            <li><a href="{{asset('bootstrap-ui')}}">Bootstrap UI</a></li>
                        </ul>
                    </li>
                    <li class="two-column">
                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-docs fa-fw"></i> <span class="hide-menu"> Pages</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{asset('starter-page')}}">Starter Page</a></li>
                            <li><a href="{{asset('blank')}}">Blank Page</a></li>
                            <li><a href="{{asset('search-result')}}">Search Result</a></li>
                            <li><a href="{{asset('custom-scroll')}}">Custom Scrolls</a></li>
                            <li><a href="{{asset('login')}}">Login Page</a></li>
                            <li><a href="{{asset('lock-screen')}}">Lock Screen</a></li>
                            <li><a href="{{asset('recoverpw')}}">Recover Password</a></li>
                            <li><a href="{{asset('animation')}}">Animations</a></li>
                            <li><a href="{{asset('profile')}}">Profile</a></li>
                            <li><a href="{{asset('invoice')}}">Invoice</a></li>
                            <li><a href="{{asset('gallery')}}">Gallery</a></li>
                            <li><a href="{{asset('pricing')}}">Pricing</a></li>
                            <li><a href="{{asset('register')}}">Register</a></li>
                            <li><a href="{{asset('400')}}">Error-400</a></li>
                            <li><a href="{{asset('403')}}">Error-403</a></li>
                            <li><a href="{{asset('404')}}">Error-404</a></li>
                            <li><a href="{{asset('500')}}">Error-500</a></li>
                            <li><a href="{{asset('503')}}">Error-503</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-notebook fa-fw"></i> <span class="hide-menu"> Forms </span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{asset('form-basic')}}">Basic Forms</a></li>
                            <li><a href="{{asset('form-layout')}}">Form Layout</a></li>
                            <li><a href="{{asset('icheck-control')}}">Icheck Control</a></li>
                            <li><a href="{{asset('form-advanced')}}">Form Addons</a></li>
                            <li><a href="{{asset('form-upload')}}">File Upload</a></li>
                            <li><a href="{{asset('form-dropzone')}}">File Dropzone</a></li>
                            <li><a href="{{asset('form-pickers')}}">Form-pickers</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-grid fa-fw"></i> <span class="hide-menu"> Tables</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{asset('basic-table')}}">Basic Tables</a></li>
                            <li><a href="{{asset('table-layouts')}}">Table Layouts</a></li>
                            <li><a href="{{asset('data-table')}}">Data Table</a></li>
                            <li><a href="{{asset('bootstrap-tables')}}">Bootstrap Tables</a></li>
                            <li><a href="{{asset('responsive-tables')}}">Responsive Tables</a></li>
                            <li><a href="{{asset('editable-tables')}}">Editable Tables</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-layers fa-fw"></i> <span class="hide-menu"> Extra</span></a>
                        <ul aria-expanded="false" class="collapse extra">
                            <li>
                                <a class="waves-effect" href="javascript:void(0);" aria-expanded="false">
                                    <span class="hide-menu"> Inbox </span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="{{asset('inbox')}}">Mail Box</a></li>
                                    <li><a href="{{asset('inbox-detail')}}">Mail Details</a></li>
                                    <li><a href="{{asset('compose')}}">Compose Mail</a></li>
                                    <li><a href="{{asset('contact')}}">Contact</a></li>
                                    <li><a href="{{asset('contact-detail')}}">Contact Detail</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{asset('calendar')}}" aria-expanded="false"><span
                                            class="hide-menu">Calendar</span></a>
                            </li>
                            <li>
                                <a href="{{asset('widgets')}}" aria-expanded="false"><span
                                            class="hide-menu"> Widgets </span></a>
                            </li>
                            <li>
                                <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><span
                                            class="hide-menu"> Charts</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="{{asset('morris-chart')}}">Morris Chart</a></li>
                                    <li><a href="{{asset('peity-chart')}}">Peity Charts</a></li>
                                    <li><a href="{{asset('knob-chart')}}">Knob Charts</a></li>
                                    <li><a href="{{asset('sparkline-chart')}}">Sparkline charts</a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><span
                                            class="hide-menu"> Icons</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="{{asset('simple-line')}}">Simple Line</a></li>
                                    <li><a href="{{asset('fontawesome')}}">Fontawesome</a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><span
                                            class="hide-menu"> Maps</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="{{asset('map-google')}}">Google Map</a></li>
                                    <li><a href="{{asset('map-vector')}}">Vector Map</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
            <button class="btn-offcanvas"> ☰ </button>
        </nav>
    </div>
</aside>
