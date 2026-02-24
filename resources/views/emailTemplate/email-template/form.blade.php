<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('email_template_folder_id') ? 'has-error' : ''}}">
            <label for="status" class=" control-label">{{ 'Email Template Folder' }}</label>
            <select class="form-control custom_modal_select2" name="email_template_folder_id" id="email_template_folder_id" required>
                <option disabled selected>--Select Folder--</option>
                @if(isset($emailTemplateFolders))
                @foreach($emailTemplateFolders as $value)
                    <option value="{{ $value->id }}" @if(isset($emailtemplate) && $emailtemplate->email_template_folder_id == $value->id) selected @endif>{{ $value->name??"" }}</option>
                @endforeach
                @endif
            </select>
            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
          <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
              <label for="title" class="control-label">{{ 'Title' }} *</label>
              <input class="form-control" name="title" type="text" id="title" placeholder="Enter Template Title" value="{{ $emailtemplate->title??''}}"  required>
              {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
          </div>
      </div>
      <div class="col-md-6">
          <div class="form-group {{ $errors->has('subject') ? 'has-error' : ''}}">
              <label for="subject" class="control-label">{{ 'Subject' }} *</label>

              <input class="form-control" name="subject" type="text" id="subject" placeholder="Enter Email Subject" value="{{ $emailtemplate->subject??''}}"  required>
              {!! $errors->first('subject', '<p class="help-block">:message</p>') !!}
          </div>
      </div>
      <div class="col-md-12">
          <div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}">
              <label for="images" class="control-label">{{ 'Attachments' }}</label>
              <div action="#" id="emailTemplatedropzone" class="dropzone brpzone_padBottom">
                  <div class="fallback">
                      <input name="images" id="images" type="file" multiple accept="image/*" required />
                  </div>
              </div>
          </div>
          <input type="hidden" name="email_template_attachment" id="email_template_attachment">
      </div>
{{--      <div class="col-md-12">--}}
{{--          <div class="form-group error_positioned_parent {{ $errors->has('body') ? 'has-error' : ''}}">--}}
{{--              <label for="body" class=" control-label">{{ 'Body' }} *</label>--}}
{{--              <textarea class="form-control" name="body" type="text" id="body"  >{{ $emailtemplate->body??''}}</textarea>--}}
{{--              {!! $errors->first('body', '<p class="help-block">:message</p>') !!}--}}
{{--          </div>--}}
{{--      </div>--}}
    <div class="col-md-12">
        <div class=" form-group">
            <label class="control-label" for="">Content</label>
            <div class="dropdown-input">
                <textarea class="form-control" name="body" id="body" placeholder="Type Here">{{ $emailtemplate->body??''}}</textarea>
                <svg xmlns="http://www.w3.org/2000/svg" class="drowpdown-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                <div class="dropdown-row" bis_skin_checked="1">
                    <div class="dropdown-header" bis_skin_checked="1">
                        <h6>
                            <span>Email Variables</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        </h6>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </div>
                    <input class="form-control" type="text" placeholder="Type to search" name="search-type">
                    <div class="dropdown-col" bis_skin_checked="1">
                        <div class="dropdown-ul" bis_skin_checked="1">
                            <ul data-heading="contact" style="display: block;">
                                @foreach ($variables as $element)
                                    <li data-label="{{ $element->value ??''}}">{{ $element->name??'' }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
      <div class="col-md-offset-4 col-md-4">
          <div class="form-group text-center ">

              <input class="btn green_btn borderRadius add_task_modal_btn " type="submit" value="{{ $submitButtonText??'Create' }}">
          </div>
      </div>
</div>
@push('js')
{{--<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>--}}
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
<script>
    // CKEDITOR.replace( 'body' );
    $(document).ready(function () {



        var sum = 0;
        var email_template_attachment_arr = [];
        Dropzone.autoDiscover = false;
        $("#emailTemplatedropzone").dropzone({
            url: "{{route('upload_email_template_attachment')}}",
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
                email_template_attachment_arr = jQuery.grep(email_template_attachment_arr, function(value) {
                    return value != image_name;
                });
                $('#email_template_attachment').val(email_template_attachment_arr);
                file.previewElement.remove();
                $.ajax({
                    type: 'get',
                    url: "{{ route('remove_email_template_attachment') }}",
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
                email_template_attachment_arr.push(response);
                $('#email_template_attachment').val(email_template_attachment_arr);
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


        @if(isset($emailtemplate->images) && $emailtemplate->images != null)
        @foreach ($emailtemplate->images as $attachment)
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
        $.validator.addMethod("ckrequired", function(value, element) {
            // Your custom validation logic for 'ckrequired'
            return value.trim().length !== 0;
        }, "This field is required.");
        $('#emailtemplatevalidate').validate({
            ignore: [],
            rules: {
                email_template_folder_id:{
                  required: true,
                },
                email_template: {
                    required: true,
                    noSpace: true
                },
                title: {
                    required: true,
                    noSpace: true
                },
                subject: {
                    required: true,
                    noSpace: true
                },

                body: {
                    ckrequired: true
                }
            },
            messages: {
                email_template_folder_id:{
                    required: "Please select folder."
                },
                title: {
                    required: "Please enter title."
                },
                subject: {
                    required: "Please enter subject.",
                    noSpace: "Spaces are not allowed."
                },
                body: {
                    ckrequired: "Body field is required"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });



</script>
<script>
    $(document).ready(function(){
        $(document).on('click', '.dropdown-input > svg', function(){
            $(this).closest(".dropdown-input").addClass("dropdown-show");
            $(this).closest(".dropdown-input").find('.dropdown-row').addClass("dropdown-show-ul");
        });
        $(document).on('click', '.dropdown-row .dropdown-header > svg', function(){
            $(this).closest(".dropdown-input").removeClass("dropdown-show");
            $(".dropdown-row").removeClass("dropdown-show-ul");
            $(".dropdown-header h6 > span").text("Custom Values");
            $(".dropdown-row > input").val("");
        });
        var heading = "";
        $(document).on('click', '.dropdown-heading > li', function(){
            $(this).closest(".dropdown-row").addClass("dropdown-show-ul");
            heading = $(this).text().toLowerCase();
            heading = $.trim(heading);
            $(".dropdown-header h6 > span").text(heading);
            $('.dropdown-ul > :not([data-heading="'+heading+'"])').hide();
            $('.dropdown-ul > [data-heading="'+heading+'"]').show();
            $(".dropdown-ul > ul > li").show();
        });
        let productEditor;
        ClassicEditor.create(document.querySelector('#body'))
            .then(editor => {
                console.log('Editor initialized successfully:', editor);
                productEditor = editor; // Store the editor instance
            })
            .catch(error => {
                console.error('Error initializing the product_editor:', error);
            });

        $(document).on('click', '.dropdown-ul ul > li', function(){
            let label = $(this).data("label");
            console.log(label);

            if (productEditor) {
                // Get the current selection position
                const selection = productEditor.model.document.selection;

                // Get the selected position within the editor content
                const position = selection.getFirstPosition();

                // Create a new Text node with the label
                const textNode = productEditor.model.change(writer => {
                    const text = writer.createText(label);
                    writer.insert(text, position);
                });

                // Focus back on the editor
                productEditor.editing.view.focus();
            }

            $(this).closest(".dropdown-input").find('.dropdown-row').removeClass("dropdown-show-ul");
            $(this).closest(".dropdown-input").removeClass("dropdown-show");
        });
        // $(document).on('click', '.dropdown-ul ul > li', function(){
        //     let label = '';
        //     label = $(this).data("label");
        //     console.log($(this).data("label"))
        //     let fromName = label;
        //     var existing_input_value = $(this).closest('.dropdown-input').find('> input').val();
        //     $(this).closest('.dropdown-input').find('> input').val(existing_input_value+' '+fromName);
        //
        //     var existing_input_value_textarea = $(this).closest('.dropdown-input').find('> textarea').val();
        //     $(this).closest('.dropdown-input').find('> textarea').val(existing_input_value_textarea+' '+fromName);
        //
        //     $(this).closest(".dropdown-input").find('.dropdown-row').removeClass("dropdown-show-ul");
        //     $(this).closest(".dropdown-input").removeClass("dropdown-show");
        // });
        //Search Filter
        $('.dropdown-row > input').on('keyup', function() {
            var searchValue = $(this).val().toLowerCase();
            $(".dropdown-row").addClass("dropdown-show-ul");
            $(".dropdown-ul > ul").show();
            $('.dropdown-ul ul > li').each(function() {
                var listItemText = $(this).text().toLowerCase();
                if (listItemText.includes(searchValue)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });



</script>
@endpush
