@push('css')
{{--    <link href="{{asset('plugins/components/dropzone-master/dist/dropzone.css')}}" rel="stylesheet" type="text/css" />--}}
@endpush
<div class="row">
    {{--        <div class="col-md-6">
        <div class="form-group {{ $errors->has('lead_id') ? 'has-error' : ''}}">
            <label for="lead_id" class="col-md-4 control-label">{{ 'Lead' }} *</label>
            <select class="form-control clr_input_fields select2 borderRadius" name="lead_id" id="lead_id" required>
                @if(!empty($leadExist))
                    @foreach($leads as $lead)
                        <option value="{{$lead->id}}" @if(isset($leadExist) && $lead->id == $leadExist->id) selected @endif readonly>{{$lead->title}}</option>
                    @endforeach
                @else
                    @foreach($leads as $lead)
                        <option value="{{$lead->id}}" @if(isset($task) && $lead->id == $task->assign_to_lead_id) selected @endif>{{$lead->title}}</option>
                    @endforeach
                @endif
            </select>
            {!! $errors->first('lead_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>--}}

    <div class="col-md-12">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            <label for="name" class="col-md-4 control-label">{{ 'Name' }} *</label>
            <input class="form-control" name="name" type="text" id="name" placeholder="Enter name... " value="{{ $material->name??''}}" required>
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    {{--<div class="col-md-6">
        <div class="form-group {{ $errors->has('quantity') ? 'has-error' : ''}}">
            <label for="quantity" class="col-md-4 control-label">{{ 'Quantity' }} *</label>
            <input class="form-control" name="quantity" type="number" min="0" id="quantity" placeholder="Enter quantity... " value="{{ $material->quantity??''}}" required>
            {!! $errors->first('quantity', '<p class="help-block">:message</p>') !!}
        </div>
    </div>--}}

    <div class="col-md-12">
        <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
            <label for="price" class="col-md-4 control-label">{{ 'Price' }} *</label>
            <input class="form-control" name="price" type="number" min="0" id="price" placeholder="Enter price... " step="0.01" value="{{ $material->price??''}}" required>
            {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
            <label for="status" class="control-label">{{ 'Status' }}</label>
            <select class="form-control" name="status">
                {{-- <option value="1" @if(isset($material) && $material->status=='1') selected @endif>Active</option>
                <option value="0" @if(isset($material) && $material->status=='0') selected @endif>Inactive</option> --}}

                <option value="1" @if(optional($material)->status == 1) selected @endif>Active</option>
                <option value="0" @if(optional($material)->status == 0) selected @endif>InActive</option>
            </select>
            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    {{--<input type="hidden" name="material_attachment" id="material_attachment">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}">
            <label for="images" class="control-label">{{ 'Documents' }} *</label>
            <div action="#" id="materialdropzonee" class="dropzone ">
                <div class="fallback">
                    <input name="images" id="images" type="file" multiple accept="image/*" required />
                </div>
            </div>
        </div>
    </div>--}}

    <div class="col-md-12">
        <div class="form-group mb-0">
            <input class="btn btn-green d-block mx-auto" type="submit" value="{{ $submitButtonText??'Create' }}">
        </div>
    </div>
</div>
@push('js')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    {{--<script src="{{asset('plugins/components/dropzone-master/dist/dropzone.js')}}"></script>--}}

<script>
    {{--$(document).ready(function () {--}}
    {{--    var sum = 0;--}}
    {{--    var material_attachment_arr = [];--}}
    {{--    Dropzone.autoDiscover = false;--}}
    {{--    $("#materialdropzonee").dropzone({--}}
    {{--        url: "{{route('upload_material_attachment')}}",--}}
    {{--        addRemoveLinks: true,--}}
    {{--        dictRemoveFileConfirmation: "Are you sure?",--}}
    {{--        //customize by unaiz dont remove--}}
    {{--        maxFiles: 5,--}}
    {{--        //customize by unaiz dont remove--}}
    {{--        removedfile: function (file) {--}}
    {{--            image_name = $(file._removeLink).attr('image_name')--}}
    {{--            id = $(file._removeLink).attr('id')--}}

    {{--            if (id == 'undefined') {--}}
    {{--                id = 0;--}}
    {{--            }--}}
    {{--            console.log(image_name);--}}
    {{--            material_attachment_arr = jQuery.grep(material_attachment_arr, function (value) {--}}
    {{--                return value != image_name;--}}
    {{--            });--}}
    {{--            $('#material_attachment_arr').val(material_attachment_arr);--}}
    {{--            file.previewElement.remove();--}}
    {{--            $.ajax({--}}
    {{--                type: 'get',--}}
    {{--                url: "{{ route('remove_material_attachment') }}",--}}
    {{--                data: { image_name: image_name, id: id },--}}
    {{--                async: false,--}}
    {{--                success: function (result) {--}}
    {{--                    $('#product_div').html(result);--}}
    {{--                    var currentAttachmentValue = $('#material_attachment').val();--}}
    {{--                    var attachmentArray = currentAttachmentValue.split(',');--}}
    {{--                    var indexToRemove = attachmentArray.indexOf(image_name);--}}
    {{--                    if (indexToRemove !== -1) {--}}
    {{--                        attachmentArray.splice(indexToRemove, 1);--}}
    {{--                    }--}}
    {{--                    var newAttachmentValue = attachmentArray.join(',');--}}
    {{--                    $('#material_attachment').val(newAttachmentValue);--}}
    {{--                }--}}
    {{--            });--}}
    {{--        },--}}
    {{--        sending: function (file, xhr, formData) {--}}
    {{--            formData.append("_token", "{{ csrf_token() }}");--}}
    {{--        },--}}
    {{--        success: function (file, response) {--}}
    {{--            file.previewElement.classList.add("dz-success");--}}
    {{--            material_attachment_arr.push(response);--}}
    {{--            $('#material_attachment').val(material_attachment_arr);--}}
    {{--            $(file._removeLink).attr('image_name', response)--}}
    {{--        },--}}
    {{--        error: function (file, response) {--}}
    {{--            file.previewElement.classList.add("dz-error");--}}
    {{--        },--}}
    {{--        init: function () {  // start of getting existing imahes--}}
    {{--            dropzone = this;--}}
    {{--            //customize by unaiz dont remove--}}
    {{--            this.on("maxfilesexceeded", function (file) {--}}
    {{--                this.removeFile(file);--}}
    {{--                swal.fire("File Limit exceeded!", "ERROR");--}}
    {{--            });--}}
    {{--            //customize by unaiz dont remove--}}
    {{--        }--}}
    {{--    });--}}
    {{--    @if (isset($material -> images) && $material -> images != null)--}}
    {{--    @foreach($material -> images as $attachment)--}}
    {{--    var file = {--}}
    {{--        name: "{{ explode('.',$attachment->name)[1]}}",--}}
    {{--        size: "{{ filesize(public_path().'/website/'.@$attachment->name) }}",--}}
    {{--        status: Dropzone.ADDED,--}}
    {{--        accepted: true--}}
    {{--    };--}}
    {{--    dropzone.emit("addedfile", file);--}}
    {{--    @if (isset($attachment -> name) && in_array(array_reverse(explode('.', $attachment -> name))[0], ['jpg', 'jpeg', 'pjpeg', 'png', 'x-png', 'gif', 'x-shockwave-flash']))--}}
    {{--    dropzone.emit("thumbnail", file, "{{ asset('/website').'/'.$attachment->name }}");--}}
    {{--    @elseif(isset($attachment -> name) && in_array(array_reverse(explode('.', $attachment -> name))[0], ['pdf']))--}}
    {{--    dropzone.emit("thumbnail", file, "{{ asset('/website/images').'/pdf.png' }}");--}}
    {{--    @elseif(isset($attachment -> name) && in_array(array_reverse(explode('.', $attachment -> name))[0], ['doc', 'docx']))--}}
    {{--    dropzone.emit("thumbnail", file, "{{ asset('/website/images').'/Word-Logo.png' }}");--}}
    {{--    @else--}}
    {{--    dropzone.emit("thumbnail", file, "{{ asset('/website/images').'/Word-Logo.png' }}");--}}
    {{--    @endif--}}
    {{--    dropzone.emit("complete", file);--}}
    {{--    $(file._removeLink).attr('id', '{{ $attachment->id }}')--}}
    {{--    $(file._removeLink).attr('image_name', '{{ $attachment->name}}')--}}
    {{--    dropzone.files.push(file);--}}
    {{--    @endforeach--}}
    {{--    @endif--}}

    {{--});--}}

    $(document).ready(function() {
        // $.validator.addMethod("noSpace", function(value, element) {
        //     return value.trim().length !== 0; // Check if the trimmed value is not an empty string
        // }, "Spaces are not allowed.");
        // var myDropzone = Dropzone.forElement(".dropzone");
        //
        // // Add event listener for the addedfile event
        // myDropzone.on("addedfile", function(file) {
        //     // Validate the file type (photo or document)
        //     var isPhoto = file.type.startsWith('image/');
        //     var isDocument = file.type.startsWith('application/') || file.type.startsWith('text/');
        //
        //     if (!(isPhoto || isDocument)) {
        //         // If the file is neither a photo nor a document, reject it
        //         myDropzone.removeFile(file);
        //         swal.fire("Invalid file type. Please upload a valid photo or document.");
        //     }
        // });
        $('#material-form').validate({
            ignore: [],
            rules: {
                name: {
                    required: true,
                    noSpace: true
                },
                // quantity: {
                //     required: true,
                // },
                price: {
                    required: true,
                }
            },
            messages: {
                name: {
                    required: "Please enter name",
                    noSpace: "Spaces are not allowed."
                },
                // quantity: {
                //     required: "Please enter quantity.",
                // },
                price: {
                    required: "Please enter price.",
                },
            },
            submitHandler: function(form) {
                // var drop = $('#material_attachment').val();
                // if (drop!='') {
                    form.submit();
                // } else {
                //     swal.fire("Please upload a file.");
                // }
            }
        });
    });
</script>
@endpush