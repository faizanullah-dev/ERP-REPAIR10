@push('css')
<link href="{{asset('plugins/components/dropzone-master/dist/dropzone.css')}}" rel="stylesheet" type="text/css" />
@endpush
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('assign_to_lead_id') ? 'has-error' : ''}}">
            <label for="assign_to_lead_id" class="col-md-4 control-label">{{ 'Assign To Lead ' }}</label>
            <select class="form-control   borderRadius assign_lead_readonly" name="lead_id" id="" required >
                @if(!empty($leadExist))
                    @foreach($leads as $lead)
                        <option value="{{$lead->id}}" @if(isset($leadExist) && $lead->id == $leadExist->id) selected @endif>{{$lead->title}}</option>
                    @endforeach
                @else
                    @foreach($leads as $lead)
                        <option value="{{$lead->id}}" @if(isset($task) && $lead->id == $task->assign_to_lead_id) selected @endif>{{$lead->title}}</option>
                    @endforeach
                @endif
            </select>
            {!! $errors->first('lead_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
            <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
            <select class="form-control borderRadius" name="status" id="status" required>
                <option value="1" @if(isset($jobnote) && $jobnote->status == 1) selected @endif>Active</option>
                <option value="0" @if(isset($jobnote) && $jobnote->status == 0) selected @endif>InActive</option>
            </select>
            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}">
            <label for="images" class="control-label">{{ 'Images' }}<span class="text-danger">*</span></label>
            <div action="#" id="jobNotedropzone" class="dropzone brpzone_padBottom">
                <div class="fallback">
                    <input name="images" id="images" type="file" multiple accept="image/*" required />
                </div>
            </div>
        </div>
        <input type="hidden" name="job_note_attachment" id="job_note_attachment">
    </div>
    <div class="col-md-12">
        <div class="form-group error_positioned_parent {{ $errors->has('description') ? 'has-error' : ''}} mb-0">
            <label for="description" class="col-md-12 control-label">{{ 'Description' }} <span class="text-danger">*</span></label>
            <textarea class="form-control" rows="5" name="description" type="textarea" id="jobnotedescription" required>{!! $jobnote->description ?? '' !!} </textarea>
            <p class="help-block text-danger" id="description-error"></p>
            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <textarea name="description" id="jobnotedescription-modal" style="display: none"></textarea>

    <div class="col-md-12">
        <div class="d-flex justify-content-center">
            <input class="btn btn-green add_task_modal_btn job_note_submit_btn m-0" type="submit" value="{{ $submitButtonText??'Create' }}">
        </div>
    </div>

</div>
@push('js')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
{{--<script src="{{asset('plugins/components/dropzone-master/dist/dropzone.js')}}"></script>--}}
{{--<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>--}}
<script type="text/javascript">
//     $(document).ready(function() {
//         // CKEDITOR.replace('jobnotedescription');
//         $(document).ready(function() {
//             ClassicEditor
//                 .create(document.querySelector('#jobnotedescription'))
//                 .catch(error => {
//                     console.error(error);
//                 });
//         });
// });
</script>
<script>
    $(document).ready(function() {
        $.validator.addMethod("noSpace", function(value, element) {
            return value.trim().length !== 0;
        }, "Spaces are not allowed.");
        let editor;
        if (typeof ClassicEditor !== "undefined") {
            ClassicEditor
                .create(document.querySelector('#jobnotedescription'))
                .then(newEditor => {
                    editor = newEditor;
                })
                .catch(error => {
                    console.error(error);
                });
        } else {
            console.error("ClassicEditor is not defined. Please check if CKEditor 5 is loaded correctly.");
        }
        $.validator.addMethod("descriptionRequired", function(value, element) {
            if (editor) {
                var editorContent = editor.getData().trim();
                return editorContent.length !== 0;
            }
            return false;
        }, "Description is required.");
        $('#JobNote-form').validate({
            ignore: [],
            rules: {
                lead_id: {
                    required: true
                },
                description: {
                    descriptionRequired: true
                }
            },
            messages: {
                lead_id: {
                    required: "Please Assign Lead."
                },
                description: {
                    descriptionRequired: "Message field is required."
                }
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") === "description") {
                    error.appendTo("#description-error");
                }
            },
            submitHandler: function(form) {
                const editorData = editor.getData().trim();
                if (editorData) {
                    $('textarea[name="description"]').val(editorData);
                }
                form.submit();
            }
        });
    });

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

    // Submit form from modal
    $(document).on('click', '.job_note_submit_btn', function (e) {
        e.preventDefault();
        if ($('#JobNote-form').valid()) {
            $('#JobNote-form').submit();
        } else {
            $('html, body').animate({
                scrollTop: $(".error:visible:first").offset().top - 100
            }, 500);
        }
    });

</script>
@endpush
