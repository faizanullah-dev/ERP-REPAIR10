<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Proposal Details</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="recipient-name" class=" input_labels control-label">Proposal Lead:</label>
                        <input type="text" class="form-control" id="recipient-name" value="{{$proposal->getLead->title??"Not Available"}}" readonly>
                    </div>
                </div>
                <div class="col-md-12 p-0">
                    <div class="inner_section_recent_photo card border-0 px-3 py-3 borderRadius20 ">

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
                                @forelse($proposal->images as $key => $value)
                                    <div class="col-md-4">
                                        <a href="{{asset('/website')}}/{{$value->name}}" target="_blank">
                                            <div class="file">
                                                @if(isset($value->name) && in_array(array_reverse(explode('.',$value->name))[0],['jpg','jpeg','pjpeg','png','x-png','gif','x-shockwave-flash']) )
                                                    <img src="{{asset('website')}}/{{$value->name}}" >
                                                @elseif(isset($value->name) && in_array(array_reverse(explode('.',$value->name))[0],['pdf']) )
                                                    <img src="{{ asset('/website/images').'/pdf.png' }}" >
                                                @elseif(isset($value->name) && in_array(array_reverse(explode('.',$value->name))[0],['doc','docx']))
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
            </div>
        </div>
    </div>
</div>
