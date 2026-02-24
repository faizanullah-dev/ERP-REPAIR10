@extends('layouts.master')
@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
@endpush
@section('content')
   <section>
       <div class="container-fluid">
           <div class="row">
               <div class="col-sm-12">
                   <div class="white-box lead_lead_page my_lead_parent lead_index_page h-100">
                       <div class="row">
                           <div class="col-md-12">
                               <div class="white-box-header">
                                   <div class="white-box-header-left">
                                       <h3 class="box-title">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Lead ') }}</h3>
                                   </div>
                                   <div class="white-box-header-right">
                                       @can('add-'.str_slug('Lead'))
                                           <a class="btn btn-success pull-right" href="{{ url('/lead/lead/create') }}"> <i class="icon-plus"></i> Add {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Lead') }} </a>
                                       @endcan
                                   </div>
                               </div>
                           </div>
                           <div class="col-md-12">
                               <div class="logoBtn_drop_wrapper form-group">
                                   <div class="button_logo">
                                       @can('delete-'.str_slug('Lead'))
                                           <button type="button" class="btn green_btn borderRadius delete_inbox_email" data-notification-id="" id="btn-delete-multiple" data-toggle="tooltip" data-placement="top" title="Delete" > <i class="fa-regular fa-trash-can"></i> </button>
                                       @endcan
                                       @can('view-usersmailboxconfiguration')
                                           <button type="button" class="btn green_btn borderRadius add_job_note_modal_btn" data-toggle="tooltip" data-placement="top" title="Emails" > <i class="fa-solid fa-envelopes-bulk"></i> </button>
                                       @endcan
                                       @can('add-'.str_slug('Task'))
                                           <button type="button" class="btn green_btn borderRadius add_task_modal_btn" data-toggle="tooltip" data-placement="top" title="Add Task" > <i class="fa-solid fa-list-check"></i> </button>
                                       @endcan
                                       @can('add-'.str_slug('JobNote'))
                                           <button type="button" class="btn green_btn borderRadius add_jobnote_btn" data-toggle="tooltip" data-placement="top" title="Job Note" > <i class="fa-regular fa-clipboard"></i> </button>
                                       @endcan
                                       @can('add-'.str_slug('Estimate'))
                                           <button type="button" class="btn green_btn borderRadius add_estimate_proposal_btn" data-toggle="tooltip" data-placement="top" title="Estimate Proposal" > <i class="fa-solid fa-briefcase"></i> </button>
                                       @endcan
                                       @can('add-'.str_slug('Material'))
                                           <button type="button" class="btn green_btn borderRadius add_material_btn" data-toggle="tooltip" data-placement="top" title="Material" > <i class="fa-solid fa-cubes-stacked"></i> </button>
                                       @endcan
                                   </div>
                                   {{--                                <div class="dropdown">--}}
                                   {{--                                    <button type="button" class="btn button_drop  dropdown-toggle green_btn borderRadius "    id="viwDropButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" > <i class="fa fa-eye"></i> </button>--}}
                                   {{--                                    <div class="dropdown-menu " aria-labelledby="viwDropButton">--}}
                                   {{--                                        <div class=" " >--}}
                                   {{--                                            <a href="{{url('map_view_lead')}}" class="btn border_btns borderRadius">Map View</a>--}}
                                   {{--                                        </div>--}}
                                   {{--                                        <div class=" " >--}}
                                   {{--                                            <a href="{{url('calender_task_view')}}" class="btn border_btns borderRadius">Calender View</a>--}}
                                   {{--                                        </div>--}}
                                   {{--                                        <div class=" " >--}}
                                   {{--                                            <a href="{{url('lead_card_view')}}" class="btn border_btns borderRadius">Card View</a>--}}
                                   {{--                                        </div>--}}
                                   {{--                                    </div>--}}
                                   {{--                                </div>--}}
                                   <div class="logobtn_right_box">
                                       <div class="view_type_box" >
                                           <a href="{{ url('lead_card_view?lead_card_view_status=unarchive') }}" class="btn green_btn {{ Request::is('lead_card_view') ? 'active' : '' }}"><img class="img-fluid" src="{{ asset('/website/images').'/cards-blank.svg' }} " ></a>
                                           <a href="{{ url('lead/lead') }}" class="btn green_btn {{ Request::is('lead/lead') ? 'active' : '' }}"><i class="fa-solid fa-list"></i></a>
                                           <a href="{{ url('map_view_lead') }}" class="btn green_btn {{ Request::is('map_view_lead') ? 'active' : '' }}"><i class="fa-solid fa-location-dot"></i></a>
                                           <a href="{{ url('calender_task_view') }}" class="btn green_btn {{ Request::is('calender_task_view') ? 'active' : '' }}"><i class="fa-solid fa-calendar"></i></a>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="col-md-12">
                               <form method="get" action="{{url('lead/lead')}}" id="filter-form">
                                   <div class=" filter_inputs_btns_wrapper form-group">
                                       <input type="hidden" name="lead_filter" value="yes">
                                       <div class="filter_inputs_parent">
                                           <label for="Select Category" class="form-label input_labels p-18">Select Category</label>
                                           <select class="form-control select_category_initialize borderRadius" data-placeholder="Select Category" id="categoryFilter" name="category_id" >
                                               <option value=""></option>
                                               @foreach($categories as $category)
                                                   <option value="{{$category->id}}" {{  request()->get('category_id') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                               @endforeach
                                           </select>
                                       </div>
                                       @php
                                           if (request()->get('duration_starts') && request()->get('duration_ends')) {
                                               $yearEstimation = (object) [
                                                   'year' => request()->get('duration_starts')
                                               ];
                                               $durationEnds = request()->get('duration_ends');
                                           } else {
                                               $durationEnds = now()->endOfYear()->format('Y-m-d');
                                           }
                                       @endphp
                                       <div class="filter_inputs_parent">

                                           <label for="duration_starts" class="form-label input_labels p-18">To </label>
                                           <input class="form-control clr_input_fields borderRadius"  name="duration_starts" value="{{ request()->get('duration_starts') ?? $yearEstimation->year . '-01-01' }}" type="date" id="duration_starts" placeholder="Enter duration_starts"  >
                                           {{--                                        <input class="form-control clr_input_fields borderRadius"  name="duration_starts" value="{{ request()->get('duration_starts') }}" type="date" id="duration_starts" placeholder="Enter duration_starts"  >--}}
                                       </div>
                                       <div class="filter_inputs_parent">
                                           <label for="duration_ends" class="form-label input_labels p-18">From </label>
                                           <input class="form-control clr_input_fields borderRadius" name="duration_ends" type="date" value="{{ request()->get('duration_ends') ?? $yearEstimation->year . '-12-31' }}" id="duration_ends" placeholder="duration_ends to_date"  >
                                           {{--                                        <input class="form-control clr_input_fields borderRadius" name="duration_ends" type="date" value="{{ request()->get('duration_ends')}}" id="duration_ends" placeholder="duration_ends to_date"  >--}}
                                       </div>
                                       {{--                                    <div class="  filter_inputs_parent filter_btns_parent">--}}
                                       {{--                                        <div class="reset_apply_btn">--}}
                                       {{--                                            <a href="{{ url('lead/lead') }}" class="btn border_btns borderRadius">Reset</a>--}}
                                       {{--                                            <button type="submit" class="btn border_btns borderRadius">Apply</button>--}}
                                       {{--                                        </div>--}}
                                       {{--                                    </div>--}}
                                       <div class="   filter_inputs_parent filter_btns_parent">
                                           <div class="reset_apply_btn">
                                               <button type="submit" class="btn blue_btn ">Apply <i class="fa-solid fa-check"></i></button>
                                               <a href="{{ url('lead/lead') }}" class="btn gray_btn ">Reset <img class="img-fluid" src="{{ asset('/website/images').'/recycle.svg' }} " ></a>
                                           </div>
                                       </div>

                                   </div>
                               </form>
                           </div>
                       </div>
                       <div class="row user-view-head lead_index mt-5">
                           <div class="col-md-4">
                               <div class="item-card-view">
                                   <h4>Won</h4>
                                   <ul>
                                       <li> {{$wonCount??'0' }} </li>
                                   </ul>
                               </div>
                           </div>
                           <div class="col-md-4">
                               <div class="item-card-view">
                                   <h4> Pending </h4>
                                   <ul>
                                       <li> {{ $pendingCount??'0' }} </li>
                                   </ul>
                               </div>
                           </div>
                           <div class="col-md-4">
                               <div class="item-card-view">
                                   <h4>Lost</h4>
                                   <ul>
                                       <li> {{ $lostCount??'0' }} </li>
                                   </ul>
                               </div>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-md-12">
                               <div class="table-responsive">
                                   <table class="table aligned_table" class="myTable" id="myTable">
                                       <thead>
                                       <tr>
                                           <th>
                                               <input class="noti_check" type="checkbox" name="notify_check" id="notify_check">
                                           </th>
                                           <th class="image">image</th>
                                           <th>Lead Number</th>
                                           <th>Title</th>
                                           <th>Description</th>
                                           <th>Customer</th>
                                           <th>Representative</th>
                                           <th>Category</th>
                                           <th>Address</th>
                                           <th>Lead Status</th>
                                           <th>Insurance</th>
                                           <th class="action">Actions</th>
                                       </tr>
                                       </thead>
                                       <tbody>

                                       @foreach($lead as $item)
                                           <tr class="lead_check">
                                               <td>
                                                   <input class="noti_check noti_checks" type="checkbox" data-leadCheck-id="{{ $item->id }}" data-user-id="{{ $item->customer_id }}">
                                               </td>
                                               <td class="aligning_table_images">
                                                   <div class="table_images_box">
                                                       @php
                                                           $totalDocuments = 0;
                                                               foreach ($item->getphotoandDocument as $photoAndDocument) {
                                                                   $totalDocuments += count($photoAndDocument->getDocuments);
                                                               }//ends foreach.
                                                           $displayed = 0;
                                                       @endphp
                                                       @if($totalDocuments == 0)
                                                           <img src="{{ asset('/website/images').'/by_default_two.png' }} " >
                                                       @else
                                                           @foreach ($item->getphotoandDocument as $photoAndDocument)
                                                               @foreach($photoAndDocument->getDocuments->where('doc_primary',1) as $document)
                                                                   @if($displayed < 1)
                                                                       @php
                                                                           $fileExtension = strtolower(array_reverse(explode('.', $document->name))[0]);//ends if.
                                                                       @endphp
                                                                       @if(isset($document->name) && in_array($fileExtension, ['jpg', 'jpeg', 'pjpeg', 'png', 'x-png', 'gif','webp', 'x-shockwave-flash']))
                                                                           <img src="{{ asset('website') }}/{{$document->name}}" >
                                                                       @elseif(isset($document->name) && $fileExtension == 'pdf')
                                                                           <img src="{{ asset('/website/images').'/pdf.png' }}" >
                                                                       @elseif(isset($document->name) && in_array($fileExtension, ['doc', 'docx', 'txt']))
                                                                           <img src="{{ asset('/website/images').'/Word-Logo.png' }}" >
                                                                       @else
                                                                           <img src="{{ asset('/website/images').'/user_profile.png' }} " >
                                                                       @endif
                                                                       @php $displayed++; @endphp
                                                                   @endif
                                                               @endforeach
                                                           @endforeach
                                                           @if($totalDocuments > 1)
                                                               <span class="badge"> +{{ $totalDocuments - $displayed }}</span>
                                                           @endif
                                                       @endif
                                                   </div>
                                               </td>

                                               <td>{{ $item->lead_number??"000" }}</td>
                                               <td>{{ $item->title??"Not Available" }}</td>
                                               <td>{!! substr($item->description,0,50),'...' !!}</td>
                                               <td>{{ $item->customer->name??"Not Available" }}</td>
                                               <td>{{ $item->representative->name??"Not Available" }}</td>
                                               <td>{{ str_limit($item->category->name??"Not Available",10) }}</td>
                                               <td>{{ substr($item->address,0,50),'...' }} {{--{{ $item->address??"" }}--}}</td>
                                               <td>
                                                   @if($item->lead_status == 'won')
                                                       <div class="status_btn">
                                                           <badge class=' green_btn badge  pric_span'>WON</badge>
                                                       </div>
                                                   @elseif($item->lead_status == 'lost')
                                                       <div class="status_btn">
                                                           <badge class='badge pric_span btn-danger'>LOST</badge>
                                                       </div>
                                                   @elseif($item->lead_status == 'pending')
                                                       <div class="status_btn">
                                                           <badge class='badge pending pric_span'>PENDING</badge>
                                                       </div>
                                                   @endif
                                               </td>
                                               <td>
                                                   @if($item->company_id != null)
                                                       @if(isset($item->companyInsurrance) && $item->companyInsurrance->insurance_status == 'expire')
                                                           <span class="badge badge-danger">Insurance Expired</span>
                                                       @else
                                                           <span class="badge badge-success">Insurance Active</span>
                                                       @endif
                                                   @else
                                                       <span class="badge badge-info">Insurance Not Found</span>
                                                   @endif
                                               </td>
                                               <td class="">

                                                   {{--                                       @if($item->company_id != null)--}}
                                                   {{--                                            @if(isset($item->companyInsurrance) && $item->companyInsurrance->insurance_status == 'expire')--}}
                                                   {{--                                                <span class="danger">Insurance Expired</span>--}}
                                                   {{--                                            @else--}}
                                                   {{--                                                <span class="warning">Insurance Active</span>--}}
                                                   {{--                                            @endif--}}
                                                   {{--                                        @else--}}
                                                   {{--                                            <span class="badge-info">Insurance Not Found</span>--}}
                                                   {{--                                        @endif--}}
                                                   <div class="btn_td">
                                                       @can('view-'.str_slug('Lead'))
                                                           <a href="{{ url('view_lead/' . $item->id) }}"
                                                              title="View {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Lead') }}">
                                                               <button class="btn view_btn btn-sm">
                                                                   <i class="fa fa-eye" aria-hidden="true"></i>
                                                               </button>
                                                           </a>
                                                       @endcan
                                                       @can('delete-'.str_slug('Lead'))
                                                           <form method="POST"  action="{{ url('/lead/lead' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline" class="delete-form">
                                                               {{ method_field('DELETE') }}
                                                               {{ csrf_field() }}
                                                               <button type="button" class="btn delete_btn btn-sm"
                                                                       title="Delete {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Lead') }}"
                                                                       onclick="showDeleteConfirmation(this)">
                                                                   <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                               </button>
                                                           </form>
                                                       @endcan
                                                       <a class="btn borderRadius view_btn job_insurance_for_lead" lead-id="{{$item->id}}" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample"><i class="fas fa-house-damage"></i></a>
                                                   </div>
                                               </td>
                                           </tr>
                                       @endforeach
                                       </tbody>
                                   </table>
                                   {{--                                <div class="pagination-wrapper"> {!! $lead->appends(['search' => Request::get('search')])->render() !!} </div>--}}
                               </div>
                           </div>
                       </div>

                   </div>
               </div>
           </div>
       </div>
   </section>
    <!-- ============================================================================================================ -->
    <div class="modal" id="addEmails" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJob">Emails</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal emailvalidate" method="get" id="email_form" action="{{route('send_email_to_users')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="subject" class="form-control" placeholder="Enter Subject" id="subject" required>
                                    </div>
                                </div>
                                {{--<div class="col-md-12">--}}

                                {{--<div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}">--}}
                                {{--<label for="imagesmail" class="control-label">{{ 'Attachments *' }}</label>--}}
                                {{--<div action="#" id="mailDropzone" class="dropzone">--}}
                                {{--<div class="fallback">--}}
                                {{--<input name="images" id="imagesmail" type="file" multiple accept="image/*" required />--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                <div class="col-md-12">
                                    <div class="form-group error_positioned_parent_narrow">
                                        <label>Attachments *</label>
                                        <div class="input_fields_wrap_right">
                                            <div class="custom_add_inputs">
                                                <input type="file" name="mail_attachment[]" placeholder="Subject" class="form-control" value="" />
                                                <button class="btn remove_button" type="button"><i class="fa fa-times" aria-hidden="true"></i></button>

                                            </div>
                                            <div class="inner_btn">

                                                <button class="add_field_button btn btn-warning " type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                            </div>

                                        </div>
                                        </div>
                                    </div>
                                <!-- <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="recipient-name" class="input_labels control-label">Description:</label>
                                        <textarea class="form-control" rows="5" name="description" type="textarea" id="description"></textarea>
                                </div>
                                </div> -->


                                <div class="col-md-12">
                                    <div class="form-group error_positioned_parent_modal {{ $errors->has('description') ? 'has-error' : ''}}">
                                        <label for="description" class="col-md-12 control-label">{{ 'Description' }} *</label>
                                        <textarea class="form-control" rows="5" name="description" type="textarea" id="mail_description" required>{{ strip_tags($jobnote->description??'')}}</textarea>
                                        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>





                                <div class="col-md-12">
                                    <div class="form-group  ">
                                        <div class="d-flex justify-content-center ">
                                            <button class="btn green_btn borderRadius  " type="submit">Submit</button>
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

    <div class="modal" id="addTaskModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJob">Add Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal taskvalidate" method="get" id="task_form" action="{{route('task_assign_to_lead')}}" enctype="multipart/form-data">
                        <div class="modal-body">
                            <section class="task_form">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                                <label for="title" class="col-md-4 control-label">{{ 'Title' }} *</label>
                                                <input class="form-control" placeholder="Enter title" name="title" type="text" id="title" value="{{ $task->title??''}}" required>
                                                {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                                                <div class="form-check form-check-inline mt-3">
                                                    <label for="priority_id" class="control-label w-100">{{ 'Priority' }}</label>
                                                    @foreach($priorities as $key => $priority)
                                                        <input class="mx-3" type="radio" name="priority_id" id="priority{{ $key }}" value="{{ $priority->id }}" @if((!old('priority_id') && isset($task) && $task->priority_id == $priority->id) || (old('priority_id') == $priority->id)) checked  @endif>
                                                        <label class="form-check-label fs-4" for="priority{{ $key }}">{{ $priority->name }}</label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('assign_to_user_id') ? 'has-error' : ''}}">
                                                <label for="assign_to_user_id" class="col-md-4 control-label">{{ 'Assign To User' }} *</label>
                                                <select class="form-control select_add_task_global_initialize js-example-basic-multiple borderRadius" data-placeholder="Select Assign To User" multiple="multiple"  name="assign_to_user_id[]" id="assign_to_user_id" required>
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}" @if(isset($task) && in_array($user->id, $task->getTaskAssignUser->pluck('user_id')->toArray())) selected @endif> {{$user->name??""}} </option>
                                                    @endforeach
                                                </select>
                                                {!! $errors->first('assign_to_user_id', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('due_date') ? 'has-error' : ''}}">
                                                <label for="due_date" class="col-md-4 control-label">{{ 'Due Date' }} *</label>
                                                <input class="form-control" name="due_date" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" type="date" id="due_date" value="{{ $task->due_date??''}}" required>
                                                {!! $errors->first('due_date', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('assign_to_team_id') ? 'has-error' : ''}}">
                                                <label for="assign_to_lead_id" class="col-md-4 control-label">{{ 'Assign To Team ' }} *</label>
                                                <select class="form-control select_add_task_global_initialize js-example-basic-single borderRadius" data-placeholder="Select Assign To Team" name="assign_to_team_id" id="assign_to_team_id">
                                                    @foreach($teams as $team)
                                                        <option value="{{$team->id}}" @if(isset($task) && $team->id == $task->assign_to_team_id) selected @endif>{{$team->name}}</option>
                                                    @endforeach
                                                </select>
                                                {!! $errors->first('assign_to_lead_id', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}">
                                                <label for="images" class="control-label">{{ 'Images' }} *</label>
                                                <div action="#" id="taskDropzone" class="dropzone validtedropzone">
                                                    <div class="fallback">
                                                        <input name="images" id="images" type="file" multiple accept="image/*" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="task_attachment" id="task_attachment">

                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group error_positioned_parent_modal {{ $errors->has('description') ? 'has-error' : ''}}">
                                                <label for="description" class="col-md-12 control-label">{{ 'Description' }} *</label>
                                                <textarea class="form-control" rows="5" name="description" type="textarea" id="task_description">{{ $task->description??''}}</textarea>
                                                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group  ">
                                                <div class="d-flex justify-content-center ">
                                                    <button class="btn green_btn borderRadius  " type="submit">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="jobNote" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJob">Job Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal jobvalidate" method="get" id="job_note_form" action="{{route('job_note_assign_to_lead')}}" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}">
                                        <label for="images" class="control-label">{{ 'Images' }} *</label>
                                        <div action="#" id="jobNotedropzone" class="dropzone brpzone_padBottom">
                                            <div class="fallback">
                                                <input name="images" id="images" type="file" multiple accept="image/*" required />
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="job_note_attachment" id="job_note_attachment">

                                </div>
                                <div class="col-md-12">
                                    <div class="form-group error_positioned_parent_modal {{ $errors->has('description') ? 'has-error' : ''}}">
                                        <label for="job_description" class="col-md-12 control-label">{{ 'Description' }} *</label>
                                        <textarea class="form-control" rows="5" name="job_description" type="textarea" id="job_description">{{ $task->description??''}}</textarea>
                                        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="d-flex justify-content-center ">
                                            <input class="btn green_btn borderRadius " type="submit" value="{{ $submitButtonText??'Create' }}">
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


    <div class="modal" id="estimateProposal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJob">Estimate Proposal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal estimatevalidate" method="get" id="estimate_proposal_form" action="{{route('estimate_proposal_assign_to_lead')}}" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}">
                                    <label for="images" class="control-label">{{ 'Photo And Documents' }} *</label>
                                    <div action="#" id="estimatedropzone" class="dropzone">
                                        <div class="fallback">
                                            <input name="images" id="images" type="file" multiple accept="image/*" required />
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="estimate_attachment" id="estimate_attachment">
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class=" d-flex justify-content-center ">
                                        <input class="btn green_btn borderRadius " type="submit" value="Create">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="addMaterial" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJob">Material</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal materialvalidate" method="post" id="add_material_form" action="{{route('material_assign_to_lead')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                    <label for="name" class="col-md-4 control-label">{{ 'Name' }} *</label>
                                    <input class="form-control" name="name" type="text" id="name" value="{{ $material->name??''}}" required>
                                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}">
                                    <label for="images" class="control-label">{{ 'Documents' }} *</label>
                                    <div action="#"  id="materialdropzoneee" class="dropzone">
                                        <div class="fallback">
                                            <input name="images" id="images" type="file" multiple accept="image/*" required />
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="material_attachment" id="material_attachment">
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class=" d-flex justify-content-center ">
                                        <input class="btn green_btn borderRadius " type="submit" value="{{ $submitButtonText??'Create' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="offcanvas Job_Insurance_offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    </div>
@endsection
@push('js')
    <script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>--}}
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <!-- Include DataTables Buttons JavaScript -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <!-- Your additional styles or scripts -->
    <script>
        $(window).on('load',function (){

            $('.select_add_task_global_initialize').select2({
                allowClear: true,
                placeholder: function() {
                    return $(this).data('placeholder');
                },
                dropdownParent: $('#addTaskModal')
            });
            $('.select_category_initialize').select2({
                placeholder: function() {
                    return $(this).data('placeholder');
                },
                allowClear: true,
            });
        })
        $(document).ready(function() {
            // Initialize DataTable
            $('#myTable').DataTable({
                // dom: 'Bfrtip',
                // buttons: [
                //     {
                //         extend: 'csv',
                //         exportOptions: {
                //             columns: ':visible:not(.image)' // Exclude columns with class 'exclude-columns'
                //         }
                //     }
                // ]
            });
        });
    </script>
    <script type="text/javascript">

        $(document).ready(function () {
            ['#job_description', '#mail_description', '#task_description'].forEach(selector => {
                ClassicEditor.create(document.querySelector(selector)).catch(console.error);
        });
        });
        // $(document).ready(function () {
        //     CKEDITOR.replace('job_description');
        // });
        //
        // $(document).ready(function () {
        //     CKEDITOR.replace('mail_description');
        // });

        // $(document).ready(function () {
        //     CKEDITOR.replace('task_description');
        // });
        $(document).ready(function () {
            var sum = 0;
            var material_attachment_arr = [];
            Dropzone.autoDiscover = false;
            $("#materialdropzoneee").dropzone({
                url: "{{route('upload_material_attachment')}}",
                addRemoveLinks: true,
                dictRemoveFileConfirmation: "Are you sure?",
                //customize by unaiz dont remove
                maxFiles: 5,
                //customize by unaiz dont remove
                removedfile: function (file) {
                    image_name = $(file._removeLink).attr('image_name')
                    id = $(file._removeLink).attr('id')

                    if (id == 'undefined') {
                        id = 0;
                    }
                    console.log(image_name);
                    material_attachment_arr = jQuery.grep(material_attachment_arr, function (value) {
                        return value != image_name;
                    });
                    $('#material_attachment_arr').val(material_attachment_arr);
                    file.previewElement.remove();
                    $.ajax({
                        type: 'get',
                        url: "{{ route('remove_material_attachment') }}",
                        data: { image_name: image_name, id: id },
                        async: false,
                        success: function (result) {
                            $('#product_div').html(result);
                            var currentAttachmentValue = $('#material_attachment').val();

                            // Split the value into an array using ","
                            var attachmentArray = currentAttachmentValue.split(',');

                            // Remove the specified image_name from the array
                            var indexToRemove = attachmentArray.indexOf(image_name);
                            if (indexToRemove !== -1) {
                                attachmentArray.splice(indexToRemove, 1);
                            }

                            // Join the array back into a string using ","
                            var newAttachmentValue = attachmentArray.join(',');

                            // Set the updated value to material_attachment
                            $('#material_attachment').val(newAttachmentValue);

                        }
                    });
                },
                sending: function (file, xhr, formData) {
                    formData.append("_token", "{{ csrf_token() }}");
                },
                success: function (file, response) {
                    file.previewElement.classList.add("dz-success");
                    material_attachment_arr.push(response);
                    $('#material_attachment').val(material_attachment_arr);
                    $(file._removeLink).attr('image_name', response)
                },
                error: function (file, response) {
                    file.previewElement.classList.add("dz-error");
                },
                init: function () {  // start of getting existing imahes
                    dropzone = this;
                    //customize by unaiz dont remove
                    this.on("maxfilesexceeded", function (file) {
                        this.removeFile(file);
                        swal.fire("File Limit exceeded!", "ERROR");
                    });
                    //customize by unaiz dont remove
                }
            });
        });

        $(document).ready(function () {
            var sum = 0;
            var estimate_attachment_arr = [];
            Dropzone.autoDiscover = false;
            $("#estimatedropzone").dropzone({
                url: "{{route('upload_estimate_attachment')}}",
                addRemoveLinks: true,
                dictRemoveFileConfirmation:  "Are you sure?",
                //customize by unaiz dont remove
                maxFiles: 5,
                //customize by unaiz dont remove
                removedfile: function(file) {
                    image_name = $(file._removeLink).attr('image_name')
                    id = $(file._removeLink).attr('id')

                    if(id == 'undefined'){
                        id = 0;
                    }
                    console.log(image_name);
                    estimate_attachment_arr = jQuery.grep(estimate_attachment_arr, function(value) {
                        return value != image_name;
                    });
                    $('#estimate_attachment').val(estimate_attachment_arr);
                    file.previewElement.remove();
                    $.ajax({
                        type: 'get',
                        url: "{{ route('remove_estimate_attachment') }}",
                        data: {image_name:image_name,id:id},
                        async: false,
                        success: function(result) {
                            $('#product_div').html(result);
                            var currentAttachmentValue = $('#estimate_attachment').val();
                            var attachmentArray = currentAttachmentValue.split(',');
                            var indexToRemove = attachmentArray.indexOf(image_name);
                            if (indexToRemove !== -1) {
                                attachmentArray.splice(indexToRemove, 1);
                            }
                            var newAttachmentValue = attachmentArray.join(',');
                            $('#estimate_attachment').val(newAttachmentValue);
                        }
                    });
                },
                sending: function(file, xhr, formData) {
                    formData.append("_token", "{{ csrf_token() }}");
                },
                success: function (file, response) {
                    file.previewElement.classList.add("dz-success");
                    estimate_attachment_arr.push(response);
                    $('#estimate_attachment').val(estimate_attachment_arr);
                    $(file._removeLink).attr('image_name',response)
                },
                error: function (file, response) {
                    file.previewElement.classList.add("dz-error");
                },
                init: function() {  // start of getting existing images
                    dropzone = this;
                    //customize by unaiz dont remove
                    this.on("maxfilesexceeded", function(file){
                        this.removeFile(file);
                        swal.fire("File Limit exceeded!","ERROR");
                    });
                    //customize by unaiz dont remove
                }
            });
        });
        $(document).ready(function () {
            var sum = 0;
            var task_attachment_arr = [];
            Dropzone.autoDiscover = false;
            $("#taskDropzone").dropzone({
                url: "{{route('upload_task_attachment')}}",
                addRemoveLinks: true,
                dictRemoveFileConfirmation: "Are you sure?",
                //customize by unaiz dont remove
                maxFiles: 5,
                //customize by unaiz dont remove
                removedfile: function (file) {
                    image_name = $(file._removeLink).attr('image_name')
                    id = $(file._removeLink).attr('id')

                    if (id == 'undefined') {
                        id = 0;
                    }
                    console.log(image_name);
                    task_attachment_arr = jQuery.grep(task_attachment_arr, function (value) {
                        return value != image_name;
                    });
                    $('#task_attachment').val(task_attachment_arr);
                    file.previewElement.remove();
                    $.ajax({
                        type: 'get',
                        url: "{{ route('remove_task_attachment') }}",
                        data: { image_name: image_name, id: id },
                        async: false,
                        success: function (result) {
                            $('#product_div').html(result);
                            var currentAttachmentValue = $('#task_attachment').val();
                            var attachmentArray = currentAttachmentValue.split(',');
                            var indexToRemove = attachmentArray.indexOf(image_name);
                            if (indexToRemove !== -1) {
                                attachmentArray.splice(indexToRemove, 1);
                            }
                            var newAttachmentValue = attachmentArray.join(',');
                            $('#task_attachment').val(newAttachmentValue);
                        }
                    });
                },
                sending: function (file, xhr, formData) {
                    formData.append("_token", "{{ csrf_token() }}");
                },
                success: function (file, response) {
                    file.previewElement.classList.add("dz-success");
                    task_attachment_arr.push(response);
                    $('#task_attachment').val(task_attachment_arr);
                    $(file._removeLink).attr('image_name', response)
                },
                error: function (file, response) {
                    file.previewElement.classList.add("dz-error");
                },
                init: function () {  // start of getting existing imahes
                    dropzone = this;
                    //customize by unaiz dont remove
                    this.on("maxfilesexceeded", function (file) {
                        this.removeFile(file);
                        swal.fire("File Limit exceeded!", "ERROR");
                    });
                    //customize by unaiz dont remove
                }
            });
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
        $(document).ready(function () {
            @if(\Session::has('message'))
            $.toast({
                heading: 'Success!',
                position: 'top-center',
                text: '{{session()->get('message')}}',
                loaderBg: '#ff6849',
                icon: 'success',
                hideAfter: 3000,
                stack: 6
            });
            @endif
        })

        // $(function () {
        //     $('#myTable').DataTable({
        //         'aoColumnDefs': [{
        //             'bSortable': false,
        //             'aTargets': [-1] /* 1st one, start by the right */
        //         }]
        //     });
        //
        // });
        $(document).on('click', '#btn-delete-multiple', function (event) {
            event.preventDefault();
            var selectedStaffCount = $('.noti_checks:checked').length;

            if (selectedStaffCount === 0) {
                Swal.fire('Warning!', 'Please select at least one lead to delete.', 'warning');
                return;
            }
            showConfirmationDialog();
        });

        function showConfirmationDialog() {
            Swal.fire({
                title: 'Are You Sure You Want To Delete The Lead?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {
                if (result.isConfirmed) {
                    deleteSelectedLeads();
                }
            });
        }

        function deleteSelectedLeads() {
            var selectedLeadIDs = [];
            $('.noti_checks:checked').each(function () {
                selectedLeadIDs.push($(this).attr('data-leadCheck-id'));
            });

            $.ajax({
                url: "{{ route('lead_multiple_delete') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    ids: selectedLeadIDs
                },

                success: function(response) {
                    selectedLeadIDs.forEach(function (id) {
                        $('.noti_checks[data-leadCheck-id="' + id + '"]').closest('.lead_check').remove();
                    });
                    if (response == "success") {
                        Swal.fire({
                            title: "Selected Leads Deleted Successfully",
                            icon: "success",
                            timer: 5000,
                            buttons: false,
                        });
                    }
                    console.log('Delete IDS:', selectedLeadIDs);
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
                var contact_id = $(this).attr('data-user-id');
                user_ids.push(contact_id);
                $('#email_form').append($('<input>', {type: 'hidden', name: 'user_ids[]', value: contact_id}));
            });
            if (user_ids.length === 0) {
                Swal.fire({
                    title: 'please select lead first',
                    text: '',
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok',
                    timer: 5000,
                });
            } else {
                $('#addEmails').modal('show');
            }
        })
        $(document).on('click','.add_material_btn',function(e){
            e.preventDefault();
            var user_ids = [];
            $('.noti_checks:checked').each(function() {
                var contact_id = $(this).attr('data-leadCheck-id');
                user_ids.push(contact_id);
                $('#add_material_form').append($('<input>', {type: 'hidden', name: 'lead_ids[]', value: contact_id}));
            });
            if (user_ids.length === 0) {
                Swal.fire({
                    title: 'please select lead first',
                    text: '',
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok',
                    timer: 5000,
                });
            } else {
                $('#addMaterial').modal('show');
            }
        })

        $(document).on('click','.add_task_modal_btn',function(e){
            e.preventDefault();
            var user_ids = [];
            $('.noti_checks:checked').each(function() {
                var contact_id = $(this).attr('data-leadCheck-id');
                user_ids.push(contact_id);
                $('#task_form').append($('<input>', {type: 'hidden', name: 'lead_ids[]', value: contact_id}));
            });
            if (user_ids.length === 0) {
                Swal.fire({
                    title: 'please select lead first',
                    text: '',
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok',
                    timer: 5000,
                });
            } else {
                $('#addTaskModal').modal('show');
            }
        })
        $(document).on('click','.add_jobnote_btn',function(e){
            e.preventDefault();
            var user_ids = [];
            $('.noti_checks:checked').each(function() {
                var contact_id = $(this).attr('data-leadCheck-id');
                user_ids.push(contact_id);
                $('#job_note_form').append($('<input>', {type: 'hidden', name: 'lead_ids[]', value: contact_id}));
            });
            if (user_ids.length === 0) {
                Swal.fire({
                    title: 'please select lead first',
                    text: '',
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok',
                    timer: 5000,
                });
            } else {
                $('#jobNote').modal('show');
            }
        })

        $(document).on('click','.add_estimate_proposal_btn',function(e){
            e.preventDefault();
            var user_ids = [];
            $('.noti_checks:checked').each(function() {
                var contact_id = $(this).attr('data-leadCheck-id');
                user_ids.push(contact_id);
                $('#estimate_proposal_form').append($('<input>', {type: 'hidden', name: 'lead_ids[]', value: contact_id}));
            });
            if (user_ids.length === 0) {
                Swal.fire({
                    title: 'please select lead first',
                    text: '',
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok',
                    timer: 5000,
                });
            } else {
                $('#estimateProposal').modal('show');
            }
        })


        $(document).ready(function () {
            var sum = 0;
            var job_note_attachment_arr = [];
            Dropzone.autoDiscover = false;
            $("#jobNotedropzone").dropzone({
                url: "{{route('upload_job_note_attachment')}}",
                addRemoveLinks: true,
                dictRemoveFileConfirmation:  "Are you sure?",
                //customize by unaiz dont remove
                maxFiles: 5,
                //customize by unaiz dont remove
                removedfile: function(file) {
                    image_name = $(file._removeLink).attr('image_name')
                    id = $(file._removeLink).attr('id')

                    if(id == 'undefined'){
                        id = 0;
                    }
                    console.log(image_name);
                    job_note_attachment_arr = jQuery.grep(job_note_attachment_arr, function(value) {
                        return value != image_name;
                    });
                    $('#job_note_attachment').val(job_note_attachment_arr);
                    file.previewElement.remove();
                    $.ajax({
                        type: 'get',
                        url: "{{ route('remove_job_note_attachment') }}",
                        data: {image_name:image_name,id:id},
                        async: false,
                        success: function(result) {
                            $('#product_div').html(result);
                            var currentAttachmentValue = $('#job_note_attachment').val();
                            var attachmentArray = currentAttachmentValue.split(',');
                            var indexToRemove = attachmentArray.indexOf(image_name);
                            if (indexToRemove !== -1) {
                                attachmentArray.splice(indexToRemove, 1);
                            }
                            var newAttachmentValue = attachmentArray.join(',');
                            $('#job_note_attachment').val(newAttachmentValue);

                        }
                    });
                },
                sending: function(file, xhr, formData) {
                    formData.append("_token", "{{ csrf_token() }}");
                },
                success: function (file, response) {
                    file.previewElement.classList.add("dz-success");
                    job_note_attachment_arr.push(response);
                    $('#job_note_attachment').val(job_note_attachment_arr);
                    $(file._removeLink).attr('image_name',response)
                },
                error: function (file, response) {
                    file.previewElement.classList.add("dz-error");
                },
                init: function() {  // start of getting existing imahes
                    dropzone = this;
                    //customize by unaiz dont remove
                    this.on("maxfilesexceeded", function(file){
                        this.removeFile(file);
                        swal.fire("File Limit exceeded!","ERROR");
                    });
                    //customize by unaiz dont remove
                }
            });
        });
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
    </script>
    <script>
        $(document).ready(function () {
            $("#filter-form").validate({
                rules: {
                    duration_starts: {
                        required: true
                    },
                    duration_ends: {
                        required: true
                    },
                    // category_id: {
                    //     required: true
                    // }
                },
                messages: {
                    duration_starts: {
                        required: "Please select the start date"
                    },
                    duration_ends: {
                        required: "Please select the end date"
                    },
                    // category_id: {
                    //     required: "Please select a category"
                    // }
                },
                errorElement: "span",
                errorPlacement: function (error, element) {
                    error.addClass("invalid-feedback");
                    element.closest(".mb-3").append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass("is-invalid").addClass("is-valid");
                }
            });
        });
        $(document).ready(function() {
            // Add custom method to check for spaces
            $.validator.addMethod("noSpace", function(value, element) {
                return value.trim().length !== 0; // Check if the trimmed value is not an empty string
            }, "Spaces are not allowed.");
            $.validator.addMethod("ckrequired", function(value, element) {
                var id = $(element).attr('id');
                var editorInstance = CKEDITOR.instances[id];
                return !!(editorInstance && editorInstance.getData().length);
            }, "Message field is required");

            // Initialize your existing Dropzone
            var myDropzone = Dropzone.forElement(".dropzone");

            // Add event listener for the addedfile event
            myDropzone.on("addedfile", function(file) {
                // Validate the file type (photo or document)
                var isPhoto = file.type.startsWith('image/');
                var isDocument = file.type.startsWith('application/') || file.type.startsWith('text/');

                if (!(isPhoto || isDocument)) {
                    // If the file is neither a photo nor a document, reject it
                    myDropzone.removeFile(file);
                    alert("Invalid file type. Please upload a valid photo or document.");
                }
            });

            $('.materialvalidate').validate({
                rules: {
                    name: {
                        required: true,
                        noSpace: true
                    }
                },
                messages: {
                    name: {
                        required: "Please enter Name.",
                        noSpace: "Spaces are not allowed."
                    }
                },
                submitHandler: function(form) {
                    var drop = $('#material_attachment').val();
                    // Check if Dropzone has any uploaded files
                    if (drop!='') {
                        form.submit();
                        // Process the form and handle file uploads
                    } else {
                        // Do something if no files are uploaded, e.g., show an error message
                        swal.fire("Please upload a file.");
                    }

                }


            });
            // Initialize jQuery Validation
            $('.estimatevalidate').validate({
                submitHandler: function(form) {
                    var drop = $('#estimate_attachment').val();
                    // Check if Dropzone has any uploaded files
                    if (drop != '') {
                        form.submit();
                        // Process the form and handle file uploads
                    } else {
                        // Do something if no files are uploaded, e.g., show an error message
                        swal.fire("Please upload a file.");
                    }
                }
            });
        });
        $(document).ready(function() {
            var myDropzone = Dropzone.forElement(".brpzone_padBottom");

            // Add event listener for the addedfile event
            myDropzone.on("addedfile", function(file) {
                // Validate the file type (photo or document)
                var isPhoto = file.type.startsWith('image/');
                var isDocument = file.type.startsWith('application/') || file.type.startsWith('text/');

                if (!(isPhoto || isDocument)) {
                    // If the file is neither a photo nor a document, reject it
                    myDropzone.removeFile(file);
                    swal.fire("Invalid file type. Please upload a valid photo or document.");
                }
            });

            $('.jobvalidate').validate({
                ignore: [],
                rules: {
                    job_description: {
                        ckrequired: true
                    }
                },
                messages: {
                    job_description: {
                        ckrequired: "Description field is required"
                    }
                },
                submitHandler: function(form) {
                    var drop = $('#job_note_attachment').val();
                    // Check if Dropzone has any uploaded files
                    if (drop!='') {
                        form.submit();
                        // Process the form and handle file uploads
                    } else {
                        // Do something if no files are uploaded, e.g., show an error message
                        swal.fire("Please upload a file.");
                    }

                }
            });
        });
        $(document).ready(function() {
            // Add custom method to check for spaces
            $.validator.addMethod("noSpace", function(value, element) {
                return value.trim().length !== 0; // Check if the trimmed value is not an empty string
            }, "Spaces are not allowed.");
            $('.emailvalidate').validate({
                ignore: [],
                rules: {
                    subject: {
                        required: true,
                        noSpace: true
                    },
                    // 'mail_attachment[]': {
                    //     required: true
                    // },
                    description: {
                        ckrequired: true
                    }
                },
                messages: {
                    subject: {
                        required: "Please enter subject.",
                        noSpace: "Spaces are not allowed."
                    },
                    // 'mail_attachment[]': {
                    //     required: "Please attachment first."
                    // },
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
            // Add custom method to check for spaces
            $.validator.addMethod("noSpace", function(value, element) {
                return value.trim().length !== 0; // Check if the trimmed value is not an empty string
            }, "Spaces are not allowed.");
            $.validator.addMethod("ckrequired", function(value, element) {
                var id = $(element).attr('id');
                var editorInstance = CKEDITOR.instances[id];
                return !!(editorInstance && editorInstance.getData().length);
            }, "Message field is required");
            var myDropzone = Dropzone.forElement(".validtedropzone");

            // Add event listener for the addedfile event
            myDropzone.on("addedfile", function(file) {
                // Validate the file type (photo or document)
                var isPhoto = file.type.startsWith('image/');
                var isDocument = file.type.startsWith('application/') || file.type.startsWith('text/');

                if (!(isPhoto || isDocument)) {
                    // If the file is neither a photo nor a document, reject it
                    myDropzone.removeFile(file);
                    swal.fire("Invalid file type. Please upload a valid photo or document.");
                }
            });

            $('.taskvalidate').validate({
                ignore: [],
                rules: {
                    title: {
                        required: true,
                        noSpace: true
                    },
                    'assign_to_user_id[]': {
                        required: true
                    },
                    priority_id: {
                        required: true
                    },
                    assign_to_lead_id: {
                        required: true
                    },
                    assign_to_team_id: {
                        required: true
                    },
                    description: {
                        ckrequired: true
                    }
                },
                messages: {
                    title: {
                        required: "Please enter Title.",
                        noSpace: "Spaces are not allowed."
                    },
                    'assign_to_user_id[]': {
                        required: "Please Assign First."
                    },
                    priority_id: {
                        required: "Please select Priority First."
                    },
                    assign_to_lead_id: {
                        required: "Please Assign Lead."
                    },
                    assign_to_team_id: {
                        required: "Please Assign Team."
                    },
                    description: {
                        ckrequired: "Message field is required"
                    }
                },
                submitHandler: function(form) {
                    var drop = $('#task_attachment').val();
                    // Check if Dropzone has any uploaded files
                    if (drop!='') {
                        form.submit();
                        // Process the form and handle file uploads
                    } else {
                        // Do something if no files are uploaded, e.g., show an error message
                        swal.fire("Please upload a file.");
                    }

                }
            });
        });

        $(document).on('click','.job_insurance_for_lead',function (e) {
            e.preventDefault();
            var lead_id = $(this).attr('lead-id');
                $.ajax({
                    type: 'get',
                    url: "{{ url('job_insurance_for_lead') }}/" + lead_id,
                    success:function(result){
                        $('#offcanvasExample').html(result);
                        $('#offcanvasExample').offcanvas('show');
                    }//end of success.
                });//ends ajax.
        })//ends on click.


    </script>


@endpush
