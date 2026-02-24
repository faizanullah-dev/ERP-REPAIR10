<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Proposal</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ url('/proposal/proposal/' . $proposal->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <input name="view_lead" value="1" type="hidden">
{{--                @include ('proposal.proposal.form', ['submitButtonText' => 'Update'])--}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('lead_id') ? 'has-error' : ''}}">
                                <label for="lead_id" class="col-md-4 control-label">{{ 'Lead' }}</label>
                                <select class="form-control clr_input_fields clr_input_proposal select2 borderRadius" name="lead_id" required>
{{--                                    @if(!empty($leadExist))--}}
{{--                                        @foreach($leads as $lead)--}}
{{--                                            <option value="{{$lead->id}}" @if(isset($leadExist) && $lead->id == $leadExist->id) selected @endif>{{$lead->title}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    @else--}}
                                        @foreach($leads as $lead)
                                            <option value="{{$lead->id}}" @if(isset($proposal) && $lead->id == $proposal->lead_id) selected @endif>{{$lead->title}}</option>
                                        @endforeach
{{--                                   @endif--}}
                                </select>
                                {!! $errors->first('lead_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}">
                                <label for="images" class="control-label">{{ 'Photo And Documents' }}</label>
                                <div action="#" id="editDropzone" class="dropzone">
                                    <div class="fallback">
                                        <input name="images" id="images" type="file" multiple accept="image/*" required />
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="proposal_attachment" id="proposal_attachment">
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-center save col-md-offset-4 col-md-4">
                                <input class="btn btn-primary" type="submit" value="Update">
                            </div>
                        </div>
                    </div>
                </div>
                    <script src="{{asset('plugins/components/dropzone-master/dist/dropzone.js')}}"></script>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            var sum = 0;
                            var proposal_attachment_arr = [];
                            Dropzone.autoDiscover = false;
                            $("#editDropzone").dropzone({
                                url: "{{route('upload_proposal_attachment')}}",
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
                                    proposal_attachment_arr = jQuery.grep(proposal_attachment_arr, function (value) {
                                        return value != image_name;
                                    });
                                    $('#proposal_attachment').val(proposal_attachment_arr);
                                    file.previewElement.remove();
                                    $.ajax({
                                        type: 'get',
                                        url: "{{ route('remove_proposal_attachment') }}",
                                        data: { image_name: image_name, id: id },
                                        async: false,
                                        success: function (result) {
                                            $('#product_div').html(result);
                                        }
                                    });
                                },
                                sending: function (file, xhr, formData) {
                                    formData.append("_token", "{{ csrf_token() }}");
                                },
                                success: function (file, response) {
                                    file.previewElement.classList.add("dz-success");
                                    proposal_attachment_arr.push(response);
                                    $('#proposal_attachment').val(proposal_attachment_arr);
                                    $(file._removeLink).attr('image_name', response)
                                },
                                error: function (file, response) {
                                    file.previewElement.classList.add("dz-error");
                                },
                                init: function () {  // start of getting existing images
                                    dropzone = this;
                                    //customize by unaiz dont remove
                                    this.on("maxfilesexceeded", function (file) {
                                        this.removeFile(file);
                                        swal.fire("File Limit exceeded!", "ERROR");
                                    });
                                    //customize by unaiz dont remove
                                }
                            });
                            @if (isset($proposal -> images) && $proposal -> images != null)
                            @foreach($proposal -> images as $attachment)
                            var file = {
                                name: "{{ explode('.',@$attachment->name)[0]}}",
                                size: "{{ filesize(public_path().'/website/'.@$attachment->name) }}",
                                status: Dropzone.ADDED,
                                accepted: true
                            };
                            dropzone.emit("addedfile", file);
                            @if (isset($attachment -> name) && in_array(array_reverse(explode('.', $attachment -> name))[0], ['jpg', 'jpeg', 'pjpeg', 'png', 'x-png', 'gif', 'x-shockwave-flash']))
                            dropzone.emit("thumbnail", file, "{{ asset('/website').'/'.$attachment->name }}");
                            @elseif(isset($attachment -> name) && in_array(array_reverse(explode('.', $attachment -> name))[0], ['pdf']))
                            dropzone.emit("thumbnail", file, "{{ asset('/website/images').'/pdf.png' }}");
                            @elseif(isset($attachment -> name) && in_array(array_reverse(explode('.', $attachment -> name))[0], ['doc', 'docx']))
                            dropzone.emit("thumbnail", file, "{{ asset('/website/images').'/Word-Logo.png' }}");
                            @else
                            dropzone.emit("thumbnail", file, "{{ asset('/website/images').'/Word-Logo.png' }}");
                            @endif
                            dropzone.emit("complete", file);
                            $(file._removeLink).attr('id', '{{ $attachment->id }}')
                            $(file._removeLink).attr('image_name', '{{ $attachment->name}}')
                            dropzone.files.push(file);
                            @endforeach
                            @endif
                        });
                    </script>


            </form>
        </div>
    </div>
</div>
