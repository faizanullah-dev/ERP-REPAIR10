<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Mail Details</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
            </button>
        </div>
        
        <div class="modal-body">
            <div class="modal-body">
                <input name="view_lead" value="1" type="hidden">
                <div class="mb-3">
                    <label for="taxable" class="form-label">Lead</label>
                    <input type="text" class="form-control"  value="{{ $leadMail->getLead->title }}" readonly>
                </div>
                
                <div class="mb-3">
                    <label for="taxable" class="form-label">Subject</label>
                    <input type="text" class="form-control" value="{{ $leadMail->subject }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="taxable" class="form-label">Date:</label>
                    <p>{{$leadMail->created_at->format('m-d-Y')}}</p>
                </div>
                    <div class="mb-3">
                        @if(isset($leadMail))
                            @if($leadMail->mail_attachment != '')
                                @foreach(json_decode($leadMail->mail_attachment) as $item)
                                    <div class="col-md-3">
                                        <div class="inner_section_attachments">
                                            @if(in_array(strtolower(pathinfo($item, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'pjpeg', 'png', 'x-png', 'gif', 'x-shockwave-flash']))
                                                <!-- Display Image -->
                                                <img data-enlargeable src="{{ asset($item) }}" alt="" style="width: 80%; height: 100%">
                                            @else
                                                <!-- Display Link to File -->
                                                <a href="{{ asset($item) }}" target="_blank">{{ $item }}</a>
                                                <a href="{{ asset($item) }}" download>Download</a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-md-3">
                                    <div class="inner_section_attachments">
                                        <p>Not Available</p>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>

                    <!-- Description Block -->
                    <div class="mb-3 " >
                        <label for="message_description" class="form-label">Description</label>
                        {{--<textarea class="form-control" rows="5" id="message_description" readonly>{{ strip_tags($leadMail->message ?? '') }} </textarea>--}}
                        <p id="message_description" >{{ strip_tags($leadMail->message ?? '') }}</p>


                    </div>
                </div>

            </div>
    </div>
</div>
