
<div class="form-group {{ $errors->has('Title') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Title' }} *</label>
    <div class="col-md-12">
        <input class="form-control" name="title" type="text" id="title" value="{{ $proposaltemplate->title??''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="col-md-12">
    <div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}">
        <label for="images" class="control-label">{{ 'Images' }} *</label>
        <div action="#" id="proposalTemplatedropzone" class="dropzone brpzone_padBottom">
            <div class="fallback">
                <input name="images" id="images" type="file" multiple accept="image/*" required />

            </div>
        </div>
    </div>
    <input type="hidden" name="proposal_template_attachment" id="proposal_template_attachment">
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}" onclick="this.disabled = true; this.form.submit();">
    </div>
</div>
@push('js')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="{{asset('plugins/components/dropzone-master/dist/dropzone.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var sum = 0;
            var proposal_template_attachment_arr = [];
            Dropzone.autoDiscover = false;
            $("#proposalTemplatedropzone").dropzone({
                url: "{{route('upload_proposal_template_attachment')}}",
                addRemoveLinks: true,
                // acceptedFiles: 'image/*',
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
                    proposal_template_attachment_arr = jQuery.grep(proposal_template_attachment_arr, function(value) {
                        return value != image_name;
                    });
                    $('#proposal_template_attachment').val(proposal_template_attachment_arr);
                    file.previewElement.remove();
                    $.ajax({
                        type: 'get',
                        url: "{{ route('remove_proposal_template_attachment') }}",
                        data: {image_name:image_name,id:id},
                        async: false,
                        success: function(result) {
                            $('#product_div').html(result);
                            var currentAttachmentValue = $('#proposal_template_attachment').val();
                            var attachmentArray = currentAttachmentValue.split(',');
                            var indexToRemove = attachmentArray.indexOf(image_name);
                            if (indexToRemove !== -1) {
                                attachmentArray.splice(indexToRemove, 1);
                            }
                            var newAttachmentValue = attachmentArray.join(',');
                            $('#proposal_template_attachment').val(newAttachmentValue);
                        }
                    });
                },
                sending: function(file, xhr, formData) {
                    formData.append("_token", "{{ csrf_token() }}");
                },
                success: function (file, response) {
                    file.previewElement.classList.add("dz-success");
                    proposal_template_attachment_arr.push(response);
                    $('#proposal_template_attachment').val(proposal_template_attachment_arr);
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
            @if(isset($proposaltemplate->images) && $proposaltemplate->images != null)
            @foreach ($proposaltemplate->images as $attachment)
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
        $(document).ready(function() {
            // Add custom method to check for spaces
            $.validator.addMethod("noSpace", function(value, element) {
                return value.trim().length !== 0; // Check if the trimmed value is not an empty string
            }, "Spaces are not allowed.");
            var myDropzone = Dropzone.forElement(".dropzone");

            // Add event listener for the addedfile event
            myDropzone.on("addedfile", function(file) {
                // Validate the file type (photo or document)
                var isPhoto = file.type.startsWith('image/');
                var isDocument = file.type.startsWith('application/') || file.type.startsWith('text/');

                // if (!(isPhoto || isDocument)) {
                //     // If the file is neither a photo nor a document, reject it
                //     myDropzone.removeFile(file);
                //     swal.fire("Invalid file type. Please upload a valid photo or document.");
                // }

                if (!(isPhoto)) {
                    // If the file is not a photo, reject it
                    myDropzone.removeFile(file);
                    swal.fire("Invalid file type. Please upload a valid photo.");
                }
            });
            $('#proposaltemplatevalidate').validate({
                ignore: [],
                rules: {
                    title: {
                        required: true,
                        noSpace: true
                    }
                },
                messages: {
                    title: {
                        required: "Please enter title."
                    }
                },
                submitHandler: function(form) {
                    var drop = $('#proposal_template_attachment').val();
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
    </script>

@endpush
