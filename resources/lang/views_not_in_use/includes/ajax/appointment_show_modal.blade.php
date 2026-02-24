<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Appointment Details</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="inner_section_other_info card border-0 px-3 py-3 borderRadius20 box-shadow-card mt-5 mb-5">
                        <div class="heading_btn_wrapper">
                            <div class="main_heading">
                                <h5>Appointment Attendees</h5>
                            </div>
                            <div class="d-flex justify-content-end ">
                                <a href="{{url('/appointment/appointment/' . $appointments->id . '/edit') }}" class="btn green_btn borderRadius">Edit</a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                <tr>
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td>Image</td>
                                    <td>Phone</td>
                                    <td>Address</td>
                                <tr>
                                </thead>
                                <tbody>
                                @forelse($appointments->getAppointmentAttendee as $value)
                                    <tr>
                                        <th style="width: 20%;">{{$value->AttendeesDetail->name??"Not Available"}}</th>
                                        <td>{{$value->AttendeesDetail->email??"Not Available"}}</td>
                                        <td><div class="user_image"><img src="{{asset('storage/uploads/users')}}/{{$value->AttendeesDetail->profile->pic??""}}" onerror="this.src='{{asset('website')}}/images/user_profile.png'" alt="" style="width: 50px;height: 50px"></div></td>
                                        <td>{{$value->AttendeesDetail->profile->phone??"Not Available"}}</td>
                                        <td>{{$value->AttendeesDetail->profile->address??"Not Available"}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <th style="width: 20%;">Not Available</th>
                                        <td>Not Available</td>
                                        <td>Not Available</td>
                                        <td>Not Available</td>
                                        <td>Not Available</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="input_labels control-label">Appointment Title:</label>
                        <input type="text" class="form-control" id="recipient-name" value="{{$appointments->title??"Not Available"}}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class=" input_labels control-label">Appointment For Lead:</label>
                        <input type="text" class="form-control" id="recipient-name" value="{{$appointments->getLead->title??"Not Available"}}" readonly>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="recipient-name" class="input_labels control-label">Description:</label>
                        <p>{!! $appointments->description??"Not Available" !!}</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="recipient-name" class="input_labels control-label">Customer:</label>
                        <input type="text" class="form-control" id="recipient-name" value="{!! $appointments->getCustomer->name??"Not Available" !!}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="input_labels control-label">Location:</label>
                        <input type="text" class="form-control" id="recipient-name" value="{{$appointments->location??"Not Available"}}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="input_labels control-label">Additional Recipients:</label>
                        <input type="text" class="form-control" id="recipient-name" value="{{$appointments->additional_recipients??"Not Available"}}" readonly>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="input_labels control-label">Appointment Start:</label>
                        <input type="text" class="form-control" id="recipient-name" value="Time : {{ $appointments->date_time_from ? date('h:i A', strtotime($appointments->date_time_from)) : 'Not Available' }}, Date: {{ $appointments->date_time_from ? date('d M Y', strtotime($appointments->date_time_from)) : 'Not Avalible' }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="input_labels control-label">Appointment End:</label>
                        <input type="text" class="form-control" id="recipient-name" value="Time : {{ $appointments->date_time_to ? date('h:i A', strtotime($appointments->date_time_to)) : 'Not Available' }}, Date: {{ $appointments->date_time_to ? date('d M Y', strtotime($appointments->date_time_to)) : 'Not Avalible' }} " readonly>
                    </div>
                </div>
                <div class="col-md-12 p-0">
                    <div class="inner_section_recent_photo card border-0 px-3 py-3 borderRadius20 box-shadow-card">

                        <div class="heading_btn_wrapper">
                            <div class="main_heading">
                                <h5>{{--Appointments--}} Photo & Document</h5>
                            </div>
                            <div class="view_all_btn">
                                {{--<a class="btn green_btn borderRadius" href="javascript:void(0)">View All</a>--}}
                            </div>
                        </div>
                        <div class="files_wrapper">
                            <div class="row">
                                @forelse($appointments->images as $key => $appointment)
                                        <div class="col-md-4">
                                            <a href="{{asset('/website')}}/{{$appointment->name}}" target="_blank">
                                                <div class="file">
                                                    @if(isset($appointment->name) && in_array(array_reverse(explode('.',$appointment->name))[0],['jpg','jpeg','pjpeg','png','x-png','gif','x-shockwave-flash']) )
                                                        <img src="{{asset('website')}}/{{$appointment->name}}" >
                                                    @elseif(isset($appointment->name) && in_array(array_reverse(explode('.',$appointment->name))[0],['pdf']) )
                                                        <img src="{{ asset('/website/images').'/pdf.png' }}" >
                                                    @elseif(isset($appointment->name) && in_array(array_reverse(explode('.',$appointment->name))[0],['doc','docx']))
                                                        <img src="{{ asset('/website/images').'/Word-Logo.png' }}">
                                                    @else
                                                        <img src="{{ asset('/website/images').'/image.png' }}">
                                                    @endif
                                                    <span> View/Download </span>
                                                </div>
                                            </a>
                                        </div>
                                @empty
                                    <div class="heading_btn_wrapper">
                                        <div class="main_heading">
                                            <h5>Not Available</h5>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="recipient-name" class="input_labels control-label">Status:</label>
                        @if($appointments->status==1)
                            <badge class="badge badge-success">Active</badge>
                        @else
                            <badge class="badge badge-warning">InActive</badge>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
