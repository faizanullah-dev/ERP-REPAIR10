{{--<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">--}}
    {{--<label for="title" class="col-md-4 control-label">{{ 'Title' }} *</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<input class="form-control" name="title" type="text" id="title" value="{{ $lead->title??''}}" required>--}}
        {{--{!! $errors->first('title', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">--}}
    {{--<label for="description" class="col-md-4 control-label">{{ 'Description' }}</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<textarea class="form-control" rows="5" name="description" type="textarea" id="description" required>{{ $lead->description??''}}</textarea>--}}
        {{--{!! $errors->first('description', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="form-group {{ $errors->has('customer_id') ? 'has-error' : ''}}">--}}
    {{--<label for="customer_id" class="col-md-4 control-label">{{ 'Customer' }} *</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<select class="form-control select2" id="customer_id" name="customer_id">--}}
            {{--<option value="" selected>Select Customer</option>--}}
            {{--@foreach($customers as $customer)--}}
                {{--<option value="{{$customer->id}}" @if(isset($lead) && $lead->customer_id==$customer->id) selected @endif>{{$customer->name}}</option>--}}
            {{--@endforeach--}}
        {{--</select>--}}
        {{--<input class="form-control" name="customer_id" type="number" id="customer_id" value="{{ $lead->customer_id??''}}" required>--}}
        {{--{!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="form-group {{ $errors->has('representative_id') ? 'has-error' : ''}}">--}}
    {{--<label for="representative_id" class="col-md-4 control-label">{{ 'Representative Id' }}</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<input class="form-control" name="representative_id" type="number" id="representative_id" value="{{ $lead->representative_id??''}}" >--}}
        {{--<select class="form-control select2" id="representative_id" name="representative_id">--}}
            {{--<option value="" selected>Select Representative</option>--}}
            {{--@foreach($representatives as $representative)--}}
                {{--<option value="{{$representative->id}}" @if(isset($lead) && $lead->representative_id==$representative->id) selected @endif>{{$representative->name}}</option>--}}
            {{--@endforeach--}}
        {{--</select>--}}
        {{--{!! $errors->first('representative_id', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">--}}
    {{--<label for="category_id" class="col-md-4 control-label">{{ 'Category Id' }}</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<input class="form-control" name="category_id" type="number" id="category_id"category_id value="{{ $lead->category_id??''}}" >--}}
        {{--<select class="form-control select2" id="category_id" name="category_id">--}}
            {{--<option value="" selected>Select Category</option>--}}
            {{--@foreach($categories as $category)--}}
                {{--<option value="{{$category->id}}" @if(isset($lead) && $lead->category_id==$category->id) selected @endif>{{$category->name}}</option>--}}
            {{--@endforeach--}}
        {{--</select>--}}
        {{--{!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="form-group {{ $errors->has('lead_number') ? 'has-error' : ''}}">--}}
    {{--<label for="lead_number" class="col-md-4 control-label">{{ 'Lead Number' }}</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<input class="form-control" name="lead_number" type="text" id="lead_number" value="{{ $lead->lead_number??rand(111111,999999)}}" >--}}
        {{--{!! $errors->first('lead_number', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="form-group {{ $errors->has('duration_days') ? 'has-error' : ''}}">--}}
    {{--<label for="duration_days" class="col-md-4 control-label">{{ 'Duration Days' }}</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<input class="form-control" name="duration_days" type="text" id="duration_days" value="{{ $lead->duration_days??''}}" >--}}
        {{--{!! $errors->first('duration_days', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="form-group {{ $errors->has('duration_hours') ? 'has-error' : ''}}">--}}
    {{--<label for="duration_hours" class="col-md-4 control-label">{{ 'Duration Hours' }}</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<input class="form-control" name="duration_hours" type="text" id="duration_hours" value="{{ $lead->duration_hours??''}}" >--}}
        {{--{!! $errors->first('duration_hours', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="form-group {{ $errors->has('duration_minutes') ? 'has-error' : ''}}">--}}
    {{--<label for="duration_minutes" class="col-md-4 control-label">{{ 'Duration Minutes' }}</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<input class="form-control" name="duration_minutes" type="text" id="duration_minutes" value="{{ $lead->duration_minutes??''}}" >--}}
        {{--{!! $errors->first('duration_minutes', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">--}}
    {{--<label for="address" class="col-md-4 control-label">{{ 'Address' }}</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<input class="form-control" name="address" type="text" id="address" value="{{ $lead->address??''}}" >--}}
        {{--{!! $errors->first('address', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="form-group {{ $errors->has('contact_person') ? 'has-error' : ''}}">--}}
    {{--<label for="contact_person" class="col-md-4 control-label">{{ 'Contact Person' }}</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<input class="form-control" name="contact_person" type="text" id="contact_person" value="{{ $lead->contact_person??''}}" >--}}
        {{--{!! $errors->first('contact_person', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="form-group {{ $errors->has('other_information') ? 'has-error' : ''}}">--}}
    {{--<label for="other_information" class="col-md-4 control-label">{{ 'Other Information' }}</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<textarea class="form-control" rows="5" name="other_information" type="textarea" id="other_information" >{{ $lead->other_information??''}}</textarea>--}}
        {{--{!! $errors->first('other_information', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">--}}
    {{--<label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<input class="form-control" name="status" type="text" id="status" value="{{ $lead->status??''}}" >--}}
        {{--<select class="form-control" name="status" id="status">--}}
            {{--<option value="1" @if(isset($lead) && $lead->status=='1') selected @endif>Active</option>--}}
            {{--<option value="0" @if(isset($lead) && $lead->status=='0') selected @endif>Inactive</option>--}}
        {{--</select>--}}
        {{--{!! $errors->first('status', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}

{{--<div class="form-group">--}}
    {{--<div class="col-md-offset-4 col-md-4">--}}
        {{--<input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">--}}
    {{--</div>--}}
{{--</div>--}}









{{--form--}}


<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <h5>Job Information</h5>
            <div class="mt-5">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label input_labels p-18">Customer *</label>
                            <select class="form-control clr_input_fields borderRadius select2" id="customer_id" name="customer_id">
                                <option value="" selected>Select</option>
                                @foreach($customers as $customer)
                                    <option value="{{$customer->id}}" @if(isset($lead) && $lead->customer_id==$customer->id) selected @endif>{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="customer-name" class="form-label input_labels p-18">Job Name *</label>
                            <input class="form-control clr_input_fields borderRadius" name="title" type="text" id="title" placeholder="Enter Job Name" value="{{ $lead->title??''}}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="customer-name" class="form-label input_labels p-18">Job Rep / Estimator *</label>
                            <select class="form-control clr_input_fields borderRadius select2"  id="representative_id" name="representative_id">
                                <option value="" selected>Select</option>
                                @foreach($representatives as $representative)
                                    <option value="{{$representative->id}}" @if(isset($lead) && $lead->representative_id==$representative->id) selected @endif>{{$representative->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="customer-name" class="form-label input_labels p-18">Category *</label>
                            <select class="form-control clr_input_fields borderRadius select2" id="category_id" name="category_id">
                                <option value="" selected>None</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if(isset($lead) && $lead->category_id==$category->id) selected @endif>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="customer-name" class="form-label input_labels p-18">Lead #</label>
                            <input class="form-control clr_input_fields borderRadius" name="lead_number" placeholder="Enter Lead" type="text" id="lead_number" value="{{ $lead->lead_number??rand(111111,999999)}}" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="contact-person" class="form-label input_labels p-18">Contact Person</label>
                            <input class="form-control clr_input_fields borderRadius" name="contact_person" placeholder="Contact" type="text" id="contact_person" value="{{ $lead->contact_person??''}}" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="job-address" class="form-label input_labels p-18">Job Address</label>
                            <textarea class="form-control clr_textarea_fields borderRadius" row="2" name="address" type="text" id="address" >{{ $lead->address??''}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        <div class="col-md-6">

            <div>
                <div class="row top">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="call-center" class="form-label input_labels p-18">Job Discription *</label>
                            {{--<textarea class="form-control borderRadius clr_textarea_fields" placeholder="Enter Job Discription" rows="6" name="description" type="textarea" id="description" required>{{ $lead->description??''}}</textarea>--}}
                            <textarea class="form-control" rows="5" name="description" type="textarea" id="description">{{ $lead->description??'' }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="call-center" class="form-label input_labels p-18">Duration Days</label>
                                    <input class="form-control borderRadius clr_input_fields" name="duration_days" type="number" id="duration_days" value="{{ $lead->duration_days??''}}" >
                                </div>
                                <div class="col-md-4">
                                    <label for="call-center" class="form-label input_labels p-18">Duration Hours</label>
                                    <input class="form-control borderRadius clr_input_fields" name="duration_hours" type="number" id="duration_hours" value="{{ $lead->duration_hours??''}}" >
                                </div>
                                <div class="col-md-4">
                                    <label for="call-center" class="form-label input_labels p-18">Duration Minutes</label>
                                    <input class="form-control borderRadius clr_input_fields" name="duration_minutes" type="number" id="duration_minutes" value="{{ $lead->duration_minutes??''}}" >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <textarea class="form-control borderRadius clr_textarea_fields" rows="3" placeholder="Other Information" name="other_information" type="textarea" id="other_information" >{{ $lead->other_information??''}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-4 col-md-4">
                <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
            </div>
        </div>
        </div>

</div>


@push('js')
<script src="//maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyAM52bC4tsQFv_3IPHLJ7kyrMx1Ys_teaU"></script>
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script>

    $(document).ready(function() {
        CKEDITOR.replace('description');
    });

    google.maps.event.addDomListener(window, 'load', function () {
        var places = new google.maps.places.Autocomplete(document.getElementById('address'));
        google.maps.event.addListener(places, 'place_changed', function () {
            var place = places.getPlace();
            var address = place.formatted_address;
            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();
            var latlng = new google.maps.LatLng(latitude, longitude);
            var geocoder = geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        var address = results[0].formatted_address;
                        var pin = results[0].address_components[results[0].address_components.length - 1].long_name;
                        var country = results[0].address_components[results[0].address_components.length - 2].long_name;
                        var state = results[0].address_components[results[0].address_components.length - 3].long_name;
                        var city = results[0].address_components[results[0].address_components.length - 4].long_name;

                    }
                }
            });
        });
    });

   $(document).ready(function () {
      var phone = 0;
      $(document).on('click', '.btn-add-phone', function (e) {
         e.preventDefault();
         console.log(phone)
         if (phone < 4) {
             var tableFields = $('.table-fields-phone'),
                currentEntry = $(this).parents('.entry:first'),
                newEntry = $(currentEntry.clone()).appendTo(tableFields);

             newEntry.find('input').val('');
             tableFields.find('.entry:not(:last) .btn-add-phone')
                .removeClass('btn-add-phone').addClass('btn-remove')
                .removeClass('btn-success').addClass('btn-danger')
                .html('<span class="fa fa-minus"></span>');
            phone++;
         }
      }).on('click', '.btn-remove', function (e) {
         $(this).parents('.entry:first').remove();
         phone--;
         e.preventDefault();
         return false;
      });
    });

    // Used to format phone number
    function phoneFormatter() {

       $(document).on('input', '.phone', function (e) {
          var number = $(this).val().replace(/[^\d]/g, '')
          if (number.length < 7) {
             number = number.replace(/(\d{0,3})(\d{0,3})/, "($1) $2");
          } else if (number.length <= 10) {
             number = number.replace(/(\d{3})(\d{3})(\d{1,4})/, "($1) $2-$3");
          } else {
             // ignore additional digits
             number = number.replace(/(\d{3})(\d{1,3})(\d{1,4})(\d.*)/, "($1) $2-$3");
          }
          $(this).val(number)
       });
    };
    $(phoneFormatter);

</script>
@endpush


