@push('css')
<link href="{{asset('plugins/components/dropzone-master/dist/dropzone.css')}}" rel="stylesheet" type="text/css" />
@endpush
<div class="form-group {{ $errors->has('assign_to_lead_id') ? 'has-error' : ''}}">
    <label for="assign_to_lead_id" class="col-md-4 control-label">{{ 'Assign To Lead ' }}</label>
    <div class="col-md-6">
            <select class="form-control clr_input_fields select2 borderRadius" name="lead_id" id="lead_id" required>
                @foreach($leads as $lead)
                    <option value="{{$lead->id}}" @if(isset($jobnote)  && $lead->id == $jobnote->lead_id) selected @endif >{{$lead->title}}</option>
                @endforeach
                <option value="custom_role">Other</option>
            </select>
        {!! $errors->first('lead_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="col-md-4 control-label">{{ 'Description' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="description" type="textarea" id="description" required>{{ strip_tags($jobnote->description??'')}}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}">
    <label for="images" class="control-label">{{ 'Images' }}</label>
    <div action="#" id="dropzone" class="dropzone col-md-6">
        <div class="fallback">
            <input name="images" id="images" type="file" multiple accept="image/*" required />
        </div>
    </div>
</div>
<input type="hidden" name="job_note_attachment" id="job_note_attachment">
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        <select class="form-control clr_input_fields select2 borderRadius" name="status" id="status" required>
            <option value="1" @if(isset($appointment) && $appointment->status == 1) selected @endif>Active</option>
            <option value="0" @if(isset($appointment) && $appointment->status == 0) selected @endif>InActive</option>
        </select>
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
@push('js')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="{{asset('plugins/components/dropzone-master/dist/dropzone.js')}}"></script>
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        CKEDITOR.replace('description');
    });
</script>
<script>
    $(document).ready(function() {
        $('#JobNote').validate({
            rules: {
                description: {
                    required: true,
                },
                lead_id: {
                    required: true,
                },
                images: {
                    required: true,
                },
                status: {
                    required: true,
                },
            },
            messages: {
                description: {
                    required: "Please enter your description",
                },
                lead_id: {
                    required: "Please select the lead field",
                },
                images: {
                    required: "Please select the images",
                },
                status: {
                    required: "Please select the status field",
                },
            }
        });
    });

    $(document).ready(function () {
        var sum = 0;
        var job_note_attachment_arr = [];
        Dropzone.autoDiscover = false;
        $("#dropzone").dropzone({
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
                @if(isset($jobnote->images) && $jobnote->images != null)
                @foreach ($jobnote->images as $attachment)
                    var file = {
                            name: "{{ explode('.',$attachment->name)[1]}}",
                            size: "{{ filesize(public_path().'/website/'.@$attachment->name) }}",
                            status: Dropzone.ADDED,
                            accepted: true
                        };
                            dropzone.emit("addedfile", file);
                        @if(isset($attachment->name) && in_array(array_reverse(explode('.',$attachment->name))[0],['jpg','jpeg','pjpeg','png','x-png','gif','x-shockwave-flash']))
                            dropzone.emit("thumbnail", file, "{{ asset('/website').'/'.$attachment->name }}");
                        @elseif(isset($attachment->name) && in_array(array_reverse(explode('.',$attachment->name))[0],['pdf']))
                            dropzone.emit("thumbnail", file, "{{ asset('/website/images').'/pdf.png' }}");
                        @elseif(isset($attachment->name) && in_array(array_reverse(explode('.',$attachment->name))[0],['doc','docx']))
                            dropzone.emit("thumbnail", file, "{{ asset('/website/images').'/Word-Logo.png' }}");
                        @else
                            dropzone.emit("thumbnail", file, "{{ asset('/website/images').'/Word-Logo.png' }}");
                        @endif
                            dropzone.emit("complete", file);
                            $(file._removeLink).attr('id','{{ $attachment->id }}')
                            $(file._removeLink).attr('image_name','{{ $attachment->name}}')
                            dropzone.files.push(file);
        @endforeach
        @endif

    });

</script>
@endpush