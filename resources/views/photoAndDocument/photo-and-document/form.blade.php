{{--@push('css')--}}
{{--<link href="{{asset('plugins/components/dropzone-master/dist/dropzone.css')}}" rel="stylesheet" type="text/css" />--}}
{{--@endpush--}}
<div class="col-md-12">
    <div class="form-group {{ $errors->has('lead_id') ? 'has-error' : ''}}">
    <label for="lead_id" class=" control-label">{{ 'Lead' }}</label>
        <select class="form-control   borderRadius assign_lead_readonly" name="lead_id">
            @if(!empty($leadExist))
                @foreach($leads as $lead)
                    <option value="{{$lead->id}}" @if(isset($leadExist) && $lead->id == $leadExist->id) selected @endif>{{$lead->title}}</option>
                @endforeach
            @else
                @foreach($leads as $lead)
                    <option value="{{$lead->id}}" @if(isset($photoanddocument) && $lead->id == $photoanddocument->lead_id) selected @endif>{{$lead->title}}</option>
                @endforeach
            @endif
        </select>
        {!! $errors->first('lead_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="col-md-12">
    <div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}">
        <label for="images" class="control-label">{{ 'Photo And Documents' }} </label>
        <div action="#" id="photodropzonee" class="dropzone">
            <div class="fallback">
                <input name="images" id="images" type="file" multiple accept="image/*"  />
            </div>
        </div>
    </div>
    <input type="hidden" name="photo_and_documents_attachment" id="photo_and_documents_attachment">
</div>

<div class="col-md-12">
    <div class="form-group mb-0 d-flex justify-content-center">
        <input class="btn btn-green add_task_modal_btn" type="submit" value="{{ $submitButtonText??'Create' }}" onclick="this.disabled = true; this.form.submit();">
    </div>
</div>


@push('js')

<script type="text/javascript">
    $(document).ready(function () {
        var sum = 0;
        var photo_and_documents_attachment_arr = [];
        Dropzone.autoDiscover = false;
        $("#photodropzonee").dropzone({
            url: "{{route('upload_photo_and_documents_attachment')}}",
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
                photo_and_documents_attachment_arr = jQuery.grep(photo_and_documents_attachment_arr, function (value) {
                    return value != image_name;
                });
                $('#photo_and_documents_attachment').val(photo_and_documents_attachment_arr);
                file.previewElement.remove();
                $.ajax({
                    type: 'get',
                    url: "{{ route('remove_photo_and_documents_attachment') }}",
                    data: { image_name: image_name, id: id },
                    async: false,
                    success: function (result) {
                        $('#product_div').html(result);
                        var currentAttachmentValue = $('#photo_and_documents_attachment').val();
                        var attachmentArray = currentAttachmentValue.split(',');
                        var indexToRemove = attachmentArray.indexOf(image_name);
                        if (indexToRemove !== -1) {
                            attachmentArray.splice(indexToRemove, 1);
                        }
                        var newAttachmentValue = attachmentArray.join(',');
                        $('#photo_and_documents_attachment').val(newAttachmentValue);
                    }
                });
            },
            sending: function (file, xhr, formData) {
                formData.append("_token", "{{ csrf_token() }}");
            },
            success: function (file, response) {
                file.previewElement.classList.add("dz-success");
                photo_and_documents_attachment_arr.push(response);
                $('#photo_and_documents_attachment').val(photo_and_documents_attachment_arr);
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
        @if (isset($photoanddocument -> getDocuments) && $photoanddocument -> getDocuments != null)
            @foreach($photoanddocument -> getDocuments as $attachment)
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



    $(document).ready(function() {
        var myDropzone = Dropzone.forElement(".dropzone");

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

        $('#document-form-add-photo-document').validate({
            ignore: [],
            rules: {
                lead_id: {
                    required: true
                }
            },
            messages: {
                lead_id: {
                    required: "Please select lead"
                }
            },
            submitHandler: function(form) {
                var drop = $('#photo_and_documents_attachment').val();
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
