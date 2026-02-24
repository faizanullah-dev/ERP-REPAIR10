{{--<div class="modal fade" id="addEmailModalBtn" tabindex="-1"  aria-hidden="true">--}}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Add Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/leadMail/lead-mail/' . $leadMail->id) }}" method="POST">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Assign Email To Lead</label>
                                <div class="form-group">
                                    {{--                                        <input type="text" name="subject" class="form-control" placeholder="Enter Subject" id="subject" required>--}}
                                    <select class="form-control" name="lead_id">
                                        @foreach($leads as $lead)
                                            <option value="{{$lead->id}}" @if(isset($leadMail)  && $lead->id == $leadMail->lead_id) selected @endif >{{$lead->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="subject" class="form-control" placeholder="Enter Subject" value="{{ $leadMail->subject }}">
                                </div>
                            </div>
                            {{--<div class="col-md-12">--}}

                            {{--<div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}">--}}
                            {{--<label for="imagesmail" class="control-label">{{ 'Attachments *' }}</label>--}}
                            {{--<div action="#" id="mailDropzone" class="dropzone">--}}
                            {{--<div class="fallback">--}}
                            {{--<input name="images" id="imagesmail" type="file" multiple accept="image/*" required />--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
{{--                            <div class="col-md-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>Attachments *</label>--}}
{{--                                    <div class="input_fields_wrap_right">--}}
{{--                                        <div class="custom_add_inputs">--}}
{{--                                            <input type="file" name="mail_attachment[]" placeholder="Subject" class="form-control" value="" />--}}
{{--                                        </div>--}}
{{--                                        <div class="inner_btn">--}}
{{--                                            <button class="btn remove_button" type="button"><i class="fa fa-times" aria-hidden="true"></i></button>--}}

{{--                                            <button class="add_field_button btn btn-warning " type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>--}}
{{--                                        </div>--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                    <label for="description" class="col-md-12 control-label">{{ 'Description' }}</label>
                                    <textarea class="form-control" rows="5" name="message" type="textarea" id="email_description" required>{{ strip_tags($leadMail->message??'')}}</textarea>
                                    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group  ">
                                    <div class="d-flex justify-content-center ">
                                        <button class="btn  btn-primary " type="submit">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{--</div>--}}