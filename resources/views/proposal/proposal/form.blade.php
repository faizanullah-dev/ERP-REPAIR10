@push('css')
    {{--<link href="{{asset('plugins/components/dropzone-master/dist/dropzone.css')}}" rel="stylesheet" type="text/css" />--}}
@endpush
<div class="row p-3" >
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('lead_id') ? 'has-error' : ''}}">
            <label for="proposal_lead_id" class="col-md-4 control-label">{{ 'Lead' }} *</label>
            <select id="proposal_lead_id" class="form-control clr_input_fields   borderRadius" name="lead_id" required >
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
    @if(!empty($leadExist))
        <div class="col-md-12">
            <div class="form-group {{ $errors->has('Proposals') ? 'has-error' : ''}}">
                <label for="lead_id" class="col-md-4 control-label">{{ 'Proposal Template' }} *</label>
                <select class="form-control clr_input_fields proposal_template_id  borderRadius" id="proposal_template_id" name="proposal_template_id">
                    <option value="" selected > Proposal Template </option>
                    @foreach($proposalTemplates as $Template)
                        <option value="{{$Template->id}}" template-id="{{$Template->id}}">{{$Template->title}}</option>
                    @endforeach
                </select>
                {!! $errors->first('lead_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group template_attachment">
            <label class="col-md-2 control-label" for="attachments-container">Attachments</label>
            <div id="attachments-container" class="attachments-container">
            </div>
        </div>
        <input type="hidden" value="{{$leadExist->id}}" name="lead_id" id="lead_id">
    @endif
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}">
            <label for="images" class="control-label">{{ 'Photo And Documents' }} *</label>
            <div action="#" id="proposal_dropzone" class="dropzone">
                <div class="fallback">
                    <input name="images" id="images" type="file" multiple accept="image/*" required />
                </div>
            </div>
        </div>
        <input type="hidden" name="proposal_attachment" id="proposal_attachment">
    </div>
    <div class="col-md-offset-4 col-md-4">
    <div class="form-group">
        <div class="d-flex justify-content-center">

            <input class="btn green_btn borderRadius add_task_modal_btn" type="submit" value="{{ $submitButtonText??'Create' }}">
        </div>
    </div>
</div>
</div>
@push('js')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js"></script>

    {{--<script src="{{asset('plugins/components/dropzone-master/dist/dropzone.js')}}"></script>--}}
    <script type="text/javascript">
        $(document).ready(function () {
            var sum = 0;
            var proposal_attachment_arr = [];
            Dropzone.autoDiscover = false;
            $("#proposal_dropzone").dropzone({
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
                            $(".assign_to_add_propsal").select2();
                            var currentAttachmentValue = $('#proposal_attachment').val();
                            var attachmentArray = currentAttachmentValue.split(',');
                            var indexToRemove = attachmentArray.indexOf(image_name);
                            if (indexToRemove !== -1) {
                                attachmentArray.splice(indexToRemove, 1);
                            }
                            var newAttachmentValue = attachmentArray.join(',');
                            $('#proposal_attachment').val(newAttachmentValue);
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

        $('.template_attachment').hide();
        $(document).on('change','.proposal_template_id', function () {
            var proposal_template_id = $(this).val();
            $.ajax({
                url: "{{url('get_proposal_template')}}/" + proposal_template_id,
                type: 'get',
                success: function (response) {
                    $('.template_attachment').show();
                    $('#attachments-container').empty();
                     if (!response.attachments || response.attachments.length === 0) {
                        $('#attachments-container').append('<span>There are no attachments in this template</span>');
                     } else {
                        response.attachments.forEach(function(attachment){
                            var filepath = attachment.filepath;
                            var fileExtension = filepath.split('.').pop().toLowerCase();
                            var imgSrc;
                            if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(fileExtension)) {
                                imgSrc = filepath;
                            } else if (fileExtension === 'pdf') {
                                imgSrc = '{{ asset("/website/images/pdf.png") }}';
                            } else if (['doc', 'docx', 'txt'].includes(fileExtension)) {
                                imgSrc = '{{ asset("/website/images/Word-Logo.png") }}';
                            } else {
                                imgSrc = '{{ asset("/website/images/image.png") }}';
                            }//end if.
                            var img = $('<img>').attr('src', imgSrc).attr('alt', 'Attachment').css({ borderRadius: '12px' });
                            var link = $('<a>').attr('href', filepath).append(img);
                            $('#attachments-container').append(link);
                        });//end forEach.
                    }//end else if.
                },error: function(xhr, status, error) {
                    $('#attachments-container').empty();
                    $('#attachments-container').append('<span>There are no attachments in this template</span>');
                },
            });
        });
        $(document).ready(function() {
            var myDropzone = Dropzone.forElement(".dropzone");
            myDropzone.on("addedfile", function(file) {
                var isPhoto = file.type.startsWith('image/');
                var isDocument = file.type.startsWith('application/') || file.type.startsWith('text/');
                if (!(isPhoto || isDocument)) {
                    myDropzone.removeFile(file);
                    swal.fire("Invalid file type. Please upload a valid photo or document.");
                }//end if
            });
            $('#proposal-form').validate({
                submitHandler: function(form) {
                    var drop = $('#proposal_attachment').val();
                    var proposal_template_id = $('#proposal_template_id').val();
                    var srcValues = [];
                    $('#attachments-container a').each(function() {
                        var src = $(this).find('img').attr('src');
                        srcValues.push(src);
                    });
                    // if (drop !== '' || srcValues.length > 0) {
                    if (drop !== '' || proposal_template_id != ''){
                        form.submit();
                    } else {
                        swal.fire("Please select template or upload a file.");
                    }//endd if.
                }//ends submitHandler.
            });//ends validate.
        });



    </script>
@endpush
