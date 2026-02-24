<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Task Details</h4>
            <div class="d-flex justify-content-end Task_Details_modal_btn ">
                <a href="{{url('task/task/' . $task->id . '/edit') }}" class="btn green_btn borderRadius">Edit</a>
                <button type="button" class="close mx-3" data-dismiss="modal" aria-hidden="true">×
                </button>
            </div>

        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="inner_section_other_info card border-0 px-3 py-3 borderRadius20 box-shadow-card mt-5 mb-5">
                        <div class="heading_btn_wrapper">
                            <div class="main_heading">
                                <h5>Task Assign To Users</h5>
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
                                @forelse($task->getTaskAssignUser as $value)
                                    <tr>
                                        <th style="width: 20%;">{{$value->getUserDetails->name??"Not Available"}}</th>
                                        <td>{{$value->getUserDetails->email??"Not Available"}}</td>
                                        <td><div class="user_image"><img src="{{asset('storage/uploads/users')}}/{{$value->getUserDetails->profile->pic??""}}" onerror="this.src='{{asset('website')}}/images/user_profile.png'" alt="" style="width: 50px;height: 50px"></div></td>
                                        <td>{{$value->getUserDetails->profile->phone??"Not Available"}}</td>
                                        <td>{{$value->getUserDetails->profile->address??"Not Available"}}</td>
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
                        <label for="recipient-name" class="input_labels control-label">Task Title:</label>
                        <input type="text" class="form-control" id="recipient-name" value="{{$task->title??"Not Available"}}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class=" input_labels control-label">Task Assign For Lead:</label>
                        <input type="text" class="form-control" id="recipient-name" value="{{$task->getLead->title??"Not Available"}}" readonly>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="recipient-name" class="input_labels control-label">Description:</label>
                        <p>{!! $task->description??"Not Available" !!}</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="recipient-name" class="input_labels control-label">Due Date:</label>
                        <input type="text" class="form-control" id="recipient-name" value="{{$task->due_date? date('d M Y', strtotime($task->due_date)) : 'Not Avalible' }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="input_labels control-label">Priority:</label>
                        <input type="text" class="form-control" id="recipient-name" value="{{ $task->getPriority->name??"" }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="input_labels control-label">Task Created At:</label>
                        <input type="text" class="form-control" id="recipient-name" value="Date: {{ $task->created_at? date('d M Y', strtotime($task->created_at)) : 'Not Avalible' }}" readonly>
                    </div>
                </div>

                <div class="col-md-12 p-0">
                    <div class="inner_section_recent_photo card border-0 px-3 py-3 borderRadius20 box-shadow-card">
                        <div class="heading_btn_wrapper">
                            <div class="main_heading">
                                <h5>Photo & Document</h5>
                            </div>
                        </div>

                        <div class="files_wrapper">
                            <div class="row">
                                @forelse($task->images as $key => $task)
                                    <div class="col-md-4">
                                        <a href="{{asset('/website')}}/{{$task->name}}" target="_blank">
                                            <div class="file">
                                                @if(isset($task->name) && in_array(array_reverse(explode('.',$task->name))[0],['jpg','jpeg','pjpeg','png','x-png','gif','x-shockwave-flash']) )
                                                    <img src="{{asset('website')}}/{{$task->name}}">
                                                @elseif(isset($task->name) && in_array(array_reverse(explode('.',$task->name))[0],['pdf']) )
                                                    <img src="{{ asset('/website/images').'/pdf.png' }}" >
                                                @elseif(isset($task->name) && in_array(array_reverse(explode('.',$task->name))[0],['doc','docx']))
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

                {{--<div class="col-md-12">--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="recipient-name" class="input_labels control-label">Status:</label>--}}
                        {{--@if($appointments->status==1)--}}
                            {{--<badge class="badge badge-success">Active</badge>--}}
                        {{--@else--}}
                            {{--<badge class="badge badge-warning">InActive</badge>--}}
                        {{--@endif--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
</div>
