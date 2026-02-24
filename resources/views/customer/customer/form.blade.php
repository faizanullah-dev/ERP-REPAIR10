@push('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <style>
        #mouseSignatureCanvas {
            box-shadow: 4px 4px 4px 4px rgba(0, 0, 0, 0.5);
        }

        #submit_btn:disabled {
            cursor: not-allowed !important;
            opacity: 0.5 !important;
        }
    </style>
@endpush
<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <h5>Customer Information </h5>
            </div>
            <div class="col-md-12 residential_commercial {{ $errors->has('customer_type_id') ? 'has-error' : '' }}">
                @foreach ($customerTypes as $key => $customerType)
                    <div class="form-group custom_form_radio">
                        <div class="custom_radiobox">
                            <input type="radio" class="form-check-input customer_type" name="customer_type_id"
                                id="customer_type_id{{ $key }}" value="{{ $customerType->id }}"
                                data-type="{{ $customerType->name == 'Residential' ? 'residential' : 'commercial' }}"
                                @if (old('customer_type_id', $customer->customer_type_id ?? '') == $customerType->id) checked @elseif($key == 0) checked @endif>
                            <label for="customer_type_id{{ $key }}"
                                class="form-label input_labels">{{ $customerType->name }}</label>
                        </div>
                    </div>
                @endforeach
                {!! $errors->first('customer_type_id', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="col-md-6 {{ $errors->has('first_name') ? 'has-error' : '' }}">
                <div class="form-group">
                    <label for="customer-name" class="form-label input_labels ">{{ 'First Name' }} *</label>
                    <input type="text" class="form-control clr_input_fields " placeholder="Enter first name"
                        id="first_name" name="first_name"
                        value="{{ old('first_name', $customer->first_name ?? ($referral->first_name ?? '')) }}"
                        required>
                    {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="col-md-6 {{ $errors->has('last_name') ? 'has-error' : '' }}">
                <div class="form-group">
                    <label for="customer-name" class="form-label input_labels ">{{ 'Last Name' }} *</label>
                    <input type="text" class="form-control clr_input_fields " placeholder="Enter last name"
                        name="last_name" id="last_name"
                        value="{{ old('last_name', $customer->last_name ?? ($referral->last_name ?? '')) }}" required>
                    {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div id="hide_company" class="col-md-6 {{ $errors->has('company') ? 'has-error' : '' }}"
                style="display: none;">
                <div class="form-group">
                    <label for="company" class="form-label input_labels">Company *</label>
                    <input type="text" class="form-control clr_input_fields" placeholder="Enter company name"
                        name="company" id="company" value="{{ old('company', $customer->company ?? '') }}" disabled>
                    {!! $errors->first('company', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="col-md-6 multiple_inputs{{ $errors->has('email') ? 'has-error' : '' }}">
                <div class="multiple_inputs">
                    <div class="form-group">
                        <label for="email" class="form-label input_labels ">{{ 'Email' }}</label>
                        <input type="email" placeholder="Enter your email" name="email"
                            class="form-control clr_input_fields " id="email"
                            value="{{ old('email', $customer->email ?? ($referral->email ?? '')) }}">
                        <span style="color: red" id="email_exist_msg"></span>
                        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6 multiple_inputs{{ $errors->has('customer_date') ? 'has-error' : '' }}">
                <div class="multiple_inputs">
                    <div class="form-group">
                        <label for="customer_date" class="form-label input_labels ">{{ 'Customer Date' }}</label>
                        <input type="text" name="customer_date" class="form-control clr_input_fields datepicker"
                            id="customer_date"
                            value="{{ old('created_at', isset($customer->created_at) ? $customer->created_at->format('m/d/Y') : date('m/d/Y', strtotime('today'))) }}"
                            required readonly>
                        {!! $errors->first('customer_date', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
            @if (isset($customer) && $customer->customerPhones != null)
                <div class="col-md-12 multiple_inputs">
                    <div class="form-group multiple_inputs">
                        <label for="phone" class="form-label input_labels ">Phone *</label>
                        @foreach ($customer->customerPhones as $key => $item)
                            <div class=" @if ($loop->last) table-fields-phone @endif">
                                <div class="entry positioned_error_parent  form-inline text-center custom_phone_number">
                                    {{--                                               <span>+1</span> --}}
                                    <input class="form-control clr_input_fields phoneInput phone"
                                        placeholder="( ___ ) ___-____ " name="phone[]" value="{{ $item->phone ?? '' }}"
                                        type="tel" required>
                                    <div class="phoneValidationMessage"></div>
                                    @if ($loop->last)
                                        <button class="btn green_btn btn-add-phone append_phone_plus_btn"
                                            type="button">
                                            <span class="fa fa-plus"></span>
                                        </button>
                                    @else
                                        <button class="btn btn-danger btn-remove inline" type="button">
                                            <span class="fa fa-minus"></span>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="col-md-12 multiple_inputs">
                    <div class=" form-group multiple_inputs">
                        <label for="phone" class="form-label input_labels ">Phone *</label>
                        <div class=" mb-0 table-fields-phone">
                            <div class="phone_append_field">
                                <div class="entry  form-inline text-center custom_phone_number">
                                    {{--                                            <span>+1</span> --}}
                                    {{--                                        <input required class="form-control mb-0 clr_input_fields  phone" placeholder="( ___ ) ___-____ " name="phone[]" value="{{ $item->phone ??""}}" type="tel" required> --}}
                                    <input class="form-control clr_input_fields  phone phoneInput"
                                        placeholder="( ___ ) ___-____" name="phone[]"
                                        value="{{ $item->phone ?? ($referral->phone ?? '') }}" type="tel"
                                        required>
                                    {{--                                        <button class="btn btn-danger btn-remove inline" type="button" disabled > --}}
                                    {{--                                            <span class="fa fa-minus"></span> --}}
                                    {{--                                        </button> --}}
                                </div>
                                <button class="btn green_btn btn-add-phone plus_btn append_phone_plus_btn"
                                    type="button">
                                    <span class="fa fa-plus"></span>
                                </button>
                            </div>
                            <div class="phoneValidationMessage"></div>
                        </div>
                    </div>
                </div>
            @endif
            {{--            <div class="col-md-6"> --}}
            {{--                <div class="form-group"> --}}
            {{--                    <label for="customer-name" class="form-label input_labels ">User Category *</label> --}}
            {{--                    <select class="form-control clr_input_fields  select2" id="category_id" name="user_category_id" required> --}}
            {{--                        <option value="" selected>None</option> --}}
            {{--                        @foreach ($categories as $category) --}}
            {{--                            <option value="{{$category->id??''}}" @if (isset($customer->profile) && $category->id == $customer->profile->category_id) selected @endif>{{$category->name}}</option> --}}
            {{--                        @endforeach --}}
            {{--                    </select> --}}
            {{--                </div> --}}
            {{--            </div> --}}
            <div class="col-md-6 {{ $errors->has('salesman_id') ? 'has-error' : '' }}">
                <div class="form-group">
                    <label for="salesman-customer-rep"
                        class="form-label input_labels ">{{ 'Relationship Manager' }}</label>
                    <select class="form-control select2 " name="salesman_id" id="salesman_id">
                        <option value="">None</option>
                        @foreach ($saleMen as $key => $saleMan)
                            <option value="{{ $saleMan->id ?? '' }}" @if (isset($customer->salesman_id) && $customer->salesman_id == $saleMan->id) selected @endif
                                required>{{ $saleMan->name ?? '' }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('salesman_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="col-md-6 {{ $errors->has('customer_type') ? 'has-error' : '' }}">
                <div class="form-group">
                    <label for="customer_type" class="form-label input_labels ">{{ 'Customer Type' }}</label>
                    <select class="form-control select2" name="customer_type" id="customer_type">
                        <option value="">None</option>
                        @foreach ($customerOwnerTypes as $type)
                            <option value="{{ $type->id }}" @if (isset($customer->profile->customer_owner_type_id) && $customer->profile->customer_owner_type_id == $type->id) selected @endif>
                                {{ $type->name ?? '' }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('customer_type', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="col-md-6 {{ $errors->has('referral_source_id') ? 'has-error' : '' }}">
                <div class="form-group">
                    <label for="referred" class="form-label input_labels ">{{ 'Referral Source' }}</label>
                    <select class="form-control  referral_source_id select2" name="referral_source_id"
                        id="referral_source_id">
                        <option value="">None</option>
                        @foreach ($referralSources as $key => $referralSource)
                            <option value="{{ $referralSource->id }}"
                                @if (isset($customer->referral_source_id) && $customer->referral_source_id == $referralSource->id) selected @endif required>
                                {{ $referralSource->name }}
                            </option>
                        @endforeach
                    </select>
                    {!! $errors->first('referral_source_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <input name="customer_number" placeholder="Enter Lead" type="hidden"
                value="{{ $customerNumber ?? '' }}">
            <div class="col-md-6 {{ $errors->has('past_customer') ? 'has-error' : '' }}" id="past_customer_div"
                style="display:none;">
                <div class="form-group">
                    <label for="past_customer" class="form-label input_labels ">{{ 'Past Customer' }}</label>
                    <select class="form-control  select2" name="reference_customer_id" id="past_customer">
                        <option value="">None</option>
                        @foreach ($customers as $key => $user)
                            <option value="{{ $user->id }}" @if (isset($customer->reference_customer_id) && $customer->reference_customer_id == $user->id) selected @endif>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    {!! $errors->first('past_customer', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="customer-notes">Customer Notes</label>
                    <textarea class="form-control clr_textarea_fields" rows="3" placeholder="Enter customer notes" name="notes"
                        type="textarea" id="customer-notes" value="{{ $customer->profile->notes ?? '' }}">{{ $customer->profile->notes ?? '' }}</textarea>
                </div>
            </div>
            {{--                    <div class="col-md-12 "> --}}
            {{--                        <div class="form-group"> --}}
            {{--                            <label for="call-center"  class="form-label input_labels ">{{ 'e-Signature' }}</label> --}}
            {{--                            <input class="mx-3" type="radio"   name="signature_type" value="signature_pad"  @if (isset($customer->profile) && $customer->profile->signature_type == 'signature_pad') checked @endif   id="signatureCheckbox" > --}}
            {{--                            <label for="call-center" class="form-label input_labels ">{{ 'Upload Signature' }}</label> --}}
            {{--                            <input class="mx-3" type="radio" name="signature_type" value="signature_file"  @if (isset($customer->profile) && $customer->profile->signature_type == 'signature_file') checked @endif  id="upload_signature" > --}}
            {{--                            {!! $errors->first('upload_signature', '<p class="help-block">:message</p>') !!} --}}
            {{--                        </div> --}}
            {{--                    </div> --}}
            {{--                <div class="col-md-12 "> --}}
            {{--                <div class="d-flex justify-content-start"> --}}
            {{--                    <div id="signatureForm" style="display: none"> --}}
            {{--                        <h3>Customer Signature</h3> --}}
            {{--                            <canvas id="mouseSignatureCanvas" class="mouseSignatureCanvas shadow" width="400" height="200" ></canvas> --}}
            {{--                        <div class="text-end"> --}}
            {{--                                <button type="button" class="btn green_btn btn-add-phone inline mt-4" onclick="clearMouseSignature()">Clear</button> --}}
            {{--                        </div> --}}
            {{--                        <input type="hidden" name="signature" id="mouseSignatureInput"> --}}
            {{--                    </div> --}}
            {{--                </div> --}}
            {{--                </div> --}}
            {{--                <div id="remove_div" class="row"> --}}
            {{--                    <div class="col-md-12 {{ $errors->has('upload_signature') ? 'has-error' : ''}}"> --}}
            {{--                        <div class="form-group"> --}}
            {{--                            <label for="upload_customer_signature" class="form-label input_labels ">{{ 'Upload Signature' }}*</label> --}}
            {{--                            <input class="form-control " name="signature" type="file" id="upload_customer_signature" --}}
            {{--                                   @if (!isset($customer)) --}}{{-- required --}}{{-- @endif onchange="previewImage(this)"> --}}
            {{--                            @if (isset($customer) && isset($customer->profile) && $customer->profile->upload_signature != '') --}}
            {{--                                <input type="hidden" name="old_signature" value="{{ $customer->profile->upload_signature }}"> --}}
            {{--                            @endif --}}

            {{--                            {!! $errors->first('upload_signature', '<p class="help-block">:message</p>') !!} --}}
            {{--                        </div> --}}
            {{--                    </div> --}}
            {{--                </div> --}}
            <div class=" col-md-12">
                <div id="imagePreviewContainer" class="" style="display: none;">
                    <img id="imagePreview" src="#" alt="Image Preview"
                        style="max-width: 100%; max-height: 200px;">
                </div>
            </div>
            @if (isset($customer) && isset($customer->profile))
                @if ($customer->profile->signature_type == 'signature_file')
                    <div class="col-md-12" id="edit_signature_file">
                        <img id="editImagePreview"
                            src="{{ asset('website/' . $customer->profile->upload_signature) }}" alt="Image Preview"
                            style="max-width: 100%; max-height: 200px;">
                    </div>
                @elseif($customer->profile->signature_type == 'signature_pad')
                    <div class="col-md-12" id="edit_signature_pad">
                        <img src="{{ $customer->profile->upload_signature }}" alt="Image Preview"
                            style="max-width: 100%; max-height: 200px;">
                    </div>
                @endif
            @endif
            @if (request()->is('customer/customer/create'))
                <div class="col-md-4">
                    <div class="form-group">
                        <Button class=" btn green_btn create_lead_btn" id="uniqueKey" type="button">Create
                            Lead</Button>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <h5>Customer Address</h5>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name" class="form-label input_labels ">Address *</label>
                    <input id="address" type="text" name="address"
                        value="{{ old('address', $customer->profile->address ?? ($referral->address ?? '')) }}"
                        class="form-control clr_input_fields " required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="city" class="form-label input_labels ">City</label>
                    <input type="text" name="city" class="form-control clr_input_fields "
                        value="{{ old('city', $customer->profile->city ?? ($referral->city ?? '')) }}"
                        id="txtCity">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="state" class="form-label input_labels ">State</label>
                    <input type="text" name="state"
                        value="{{ old('state', $customer->profile->state ?? ($referral->state ?? '')) }}"
                        class="form-control clr_input_fields " id="txtState">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="zip" class="form-label input_labels ">Zip</label>
                    <input type="text" name="zip"
                        value="{{ old('zip', $customer->profile->zip ?? ($referral->zip ?? '')) }}"
                        class="form-control clr_input_fields " id="txtZip">
                    <input type="hidden" name="latitude"
                        value="{{ old('latitude', $customer->profile->latitude ?? '') }}"
                        class="form-control clr_input_fields " id="latitude">
                    <input type="hidden" name="longitude"
                        value="{{ old('longitude', $customer->profile->longitude ?? '') }}"
                        class="form-control clr_input_fields " id="longitude">

                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="country" class="form-label input_labels ">Country</label>
                    <input type="text" name="country"
                        value="{{ old('country', $customer->profile->country ?? ($referral->country ?? '')) }}"
                        class="form-control clr_input_fields " id="txtCountry">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h5>Office Address</h5>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="location_distance" class="form-label input_labels ">Distance</label>
                        <input type="text" id="location_distance"
                            class="form-control clr_input_fields location_distance" readonly>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <label for="call-center" class="form-label input_labels ">{{ 'Map' }}</label>
                <div id="map" style="height: 400px;"></div>
            </div>
        </div>

        {{-- starts permission --}}
        {{--                <div class="col-md-12"> --}}
        {{--                    <div class="form-group {{ $errors->has('role') ? 'has-error' : ''}}"> --}}
        {{--                        <label for="status" class="col-md-4 control-label">{{ 'Select Role' }} *</label> --}}
        {{--                        <select class="form-control" name="role_id" id="role_id"> --}}
        {{--                            @foreach ($roles as $role) --}}
        {{--                                <option value="{{$role->id}}" @if (isset($role->name) && $role->name == 'staff') selected @endif>{{$role->name}}</option> --}}
        {{--                            @endforeach --}}
        {{--                            <option value="custom_role">Other</option> --}}
        {{--                        </select> --}}
        {{--                        {!! $errors->first('status', '<p class="help-block">:message</p>') !!} --}}
        {{--                    </div> --}}
        {{--                </div> --}}
        {{--                <span style="color: red" id="role_exist_msg"></span> --}}
        {{--                <div id="permissions_detail_div"> --}}
        {{--                </div> --}}


        {{-- ends permission --}}
        {{--                <div class="col-md-4 col-md-offset-4 mt-5"> --}}
        {{--                    <button type="submit" id="submit_btn" class=" green_btn  w-100 submit_btn large_green_btn create_btn" >Create</button> --}}
        {{--                    <span class="form_error --}}
        {{--                <div class=" col-md-4 mt-5"> --}}
        {{--                        <div class="form-group"> --}}
        {{--                            <Button class="  green_btn create_lead_btn  " type="button"   >Create Lead</Button> --}}
        {{--                        </div> --}}
        {{--                    </div> --}}

    </div>
    @if (request()->is('customer/customer/create'))
        <!-- ============================================================================================================= -->
        <div class="lead_form_area">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="customer-name" class="form-label input_labels ">Job Name *</label>
                            <input class="form-control clr_input_fields " name="title" type="text"
                                id="title" placeholder="Enter Job Name" value="" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="customer-name" class="form-label input_labels ">Job Rep/Sales Rep *</label>
                            <select class="form-control  select2" id="representative_id" name="representative_id"
                                required>
                                <option value="" selected>Select</option>
                                @foreach ($roles as $role)
                                    @if ($role->name !== 'admin' && $role->name !== 'customer')
                                        <optgroup label="{{ $role->name }}">
                                            @foreach ($role->users as $user)
                                                <option value="{{ $user->id }}"> {{ $user->name ?? '' }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="customer-name" class="form-label input_labels ">Category *</label>
                            <select class="form-control  select2" id="category_id" name="category_id" required>
                                <option value="" selected>None</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="customer-name" class="form-label input_labels ">Customer Rep</label>
                            <input class="form-control clr_input_fields" type="text"
                                value="{{ auth()->user()->name ?? '' }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="customer-name" class="form-label input_labels ">Lead #</label>
                            <input class="form-control clr_input_fields" name="lead_number" placeholder="Enter Lead"
                                type="text" id="lead_number" value="{{ $leadNumber }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contact-person" class="form-label input_labels ">Contact Person</label>
                            <input class="form-control clr_input_fields " name="contact_person" placeholder="Contact"
                                type="text" id="contact_person">
                        </div>
                    </div>
                    {{--                <div class="col-md-6"> --}}
                    {{--                    <div class="form-group"> --}}
                    {{--                        <label for="customer-name" class="form-label input_labels ">Project Price*</label> --}}
                    {{--                        <input class="form-control clr_input_fields "  name="lead_price" placeholder="Enter Price" type="text" id="lead_price" pattern="\d*" oninput="this.value = formatCurrency(this.value);" required> --}}
                    {{--                    </div> --}}
                    {{--                </div> --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="customer-name" class="form-label input_labels ">Lead Date*</label>
                            <input type="text" name="lead_date" class="form-control clr_input_fields datepicker"
                                id="lead_date" value="{{ date('m/d/Y', strtotime('today')) }}" required readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group custom_add_address">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkDefault">
                                <label class="form-check-label" for="checkDefault">Lead Address</label>
                            </div>
                            <div class="appended_address">
                                <div class="form-group">
                                    <input type="text" name="lead_address" class="form-control " id=""
                                        value="" placeholder="Enter Lead Address">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row ">
                    <div class="col-md-12">
                        <div class="form-group error_positioned_parent">
                            <label for="description" class="form-label input_labels ">Job Description *</label>
                            <textarea class="form-control" rows="5" name="description" id="customer_description"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="my-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="call-center" class="form-label input_labels ">Minimum Days</label>
                                        <input min="0" oninput="this.value = Math.abs(this.value)"
                                            class="form-control  clr_input_fields" name="minimum_days" type="number"
                                            id="duration_days" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="call-center" class="form-label input_labels ">Maximum Days</label>
                                        <input min="0" oninput="this.value = Math.abs(this.value)"
                                            class="form-control  clr_input_fields" name="maximum_days" type="number"
                                            id="duration_hours" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea class="form-control  clr_textarea_fields" rows="3" placeholder="Other Information"
                                name="other_information" type="textarea" id="other_information"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================================================================= -->
    @endif
    <!--        <div class="col-md-4 col-md-offset-4 mt-5">
            <button type="submit" id="submit_btn" class="green_btn  w-100 submit_btn large_green_btn create_btn">Create</button>
            <span class="form_error"></span>
        </div>-->
    {{--        @if ($customer->customerPhones != null) --}}
    {{--            <div class="col-md-4 col-md-offset-4 mt-5"> --}}
    {{--                <button type="submit" id="submit_btn" class="green_btn  w-100 submit_btn large_green_btn create_btn">Save Changes</button> --}}
    {{--                <span class="form_error"></span> --}}
    {{--            </div> --}}
    {{--        @else --}}
    <div class="col-md-4">
        <button type="submit" id="submit_btn"
            class="green_btn  w-100 submit_btn large_green_btn create_btn">{{ $submitButtonText ?? 'Create' }}</button>
        <span class="form_error"></span>
    </div>
    {{--        @endif --}}
</div>



@push('js')
    {{--    <script src="//maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key={{env('googleAPI')}}"></script> --}}
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places,geometry&key={{ env('googleAPI') }}">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    @if (request()->is('customer/customer/create'))
        {{--    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script> --}}
        {{-- <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script> --}}
        <script>
            $(document).ready(function() {
                $(".custom_add_address .appended_address").hide();
                $(document).on("change", ".custom_add_address .form-check input[type=checkbox]", function() {
                    if ($(this).is(":checked")) {
                        $(".custom_add_address .appended_address").show();
                    } else {
                        $(".custom_add_address .appended_address").hide();
                    }
                });
            })

            $('.phoneInput').on('blur', function() {
                const inputElement = $(this);
                const phoneNumber = inputElement.val();
                if (phoneNumber) {
                    $.ajax({
                        url: '{{ url('phone_authentication') }}',
                        method: 'POST',
                        data: JSON.stringify({
                            "_token": "{{ csrf_token() }}",
                            phone: phoneNumber
                        }),
                        contentType: 'application/json',
                        success: function(data) {
                            const messageDiv = inputElement.closest('.custom_phone_number').next(
                                '.phoneValidationMessage');
                            if (data.duplicate) {
                                messageDiv.text("This phone number is already in use.");
                                messageDiv.css("color", "red");
                            } else if (data.valid) {
                                messageDiv.text("Phone number is authentic.");
                                messageDiv.css("color", "green");
                            } else {
                                messageDiv.text(data.message ||
                                    "Phone number is not authentic or invalid.");
                                messageDiv.css("color", "red");
                            }
                        },
                        error: function(error) {
                            console.error('Error:', error);
                            const messageDiv = inputElement.closest('.custom_phone_number').next(
                                '.phoneValidationMessage');
                            messageDiv.text("An error occurred while validating the phone number.").css(
                                "color", "red");
                        }
                    });
                }
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $(".datepicker").datepicker({
                dateFormat: 'mm/dd/yy',
                // defaultDate: new Date(),
                changeMonth: true,
                changeYear: true
            }).on('keydown', function(e) {
                e.preventDefault();
            }).on('blur', function() {
                if (!$(this).val() || !/^\d{2}\/\d{2}\/\d{4}$/.test($(this).val())) {
                    $(this).val('{{ date('mm/dd/yy', strtotime('today')) }}');
                }
            });
        });
        // var map;
        // var distanceService = new google.maps.DistanceMatrixService();
        // var customerMarker, officeMarker;
        // var customerLat, customerLng, officeLat, officeLng;
        // var dottedLine;  // Variable to store the polyline
        // var infowindow = new google.maps.InfoWindow();
        // var marker = new google.maps.Marker();
        //
        // function initMap() {
        //     map = new google.maps.Map(document.getElementById('map'), {
        //         center: { lat: 41.8719, lng: 12.5674 },
        //         zoom: 12
        //     });
        //
        //     // Autocomplete for Customer Address
        //     var customerInput = document.getElementById('address');
        //     var customerAutocomplete = new google.maps.places.Autocomplete(customerInput);
        //     customerAutocomplete.bindTo('bounds', map);
        //     customerMarker = new google.maps.Marker({
        //         map: map,
        //         anchorPoint: new google.maps.Point(0, -29),
        //         visible: false
        //     });
        //     var officeInput = document.getElementById('office_address');
        //     var officeAutocomplete = new google.maps.places.Autocomplete(officeInput);
        //     alert(officeAutocomplete);
        //     officeAutocomplete.bindTo('bounds', map);
        //     officeMarker = new google.maps.Marker({
        //         map: map,
        //         anchorPoint: new google.maps.Point(0, -29),
        //         visible: false
        //     });
        //     customerAutocomplete.addListener('place_changed', function() {
        //         var place = customerAutocomplete.getPlace();
        //         if (!place.geometry) {
        //             window.alert("No details available for input: '" + place.name + "'");
        //             return;
        //         }
        //         customerLat = place.geometry.location.lat();
        //         customerLng = place.geometry.location.lng();
        //
        //         document.getElementById('latitude').value = customerLat;
        //         document.getElementById('longitude').value = customerLng;
        //
        //         map.setCenter(place.geometry.location);
        //         map.setZoom(14);
        //
        //         customerMarker.setPosition(place.geometry.location);
        //         customerMarker.setVisible(true);
        //         updateAddressFields(place, 'customer');
        //         calculateDistance();
        //         drawDottedLine();
        //     });
        //     officeAutocomplete.addListener('place_changed', function() {
        //         var place = officeAutocomplete.getPlace();
        //         if (!place.geometry) {
        //             window.alert("No details available for input: '" + place.name + "'");
        //             return;
        //         }
        //         officeLat = place.geometry.location.lat();
        //         officeLng = place.geometry.location.lng();
        //         officeMarker.setPosition(place.geometry.location);
        //         officeMarker.setVisible(true);
        //         updateAddressFields(place, 'office');
        //         calculateDistance();
        //         drawDottedLine();
        //     });
        // }
        // function drawDottedLine() {
        //     if (customerLat && officeLat) {
        //         var customerLocation = new google.maps.LatLng(customerLat, customerLng);
        //         var officeLocation = new google.maps.LatLng(officeLat, officeLng);
        //         if (dottedLine) {
        //             dottedLine.setMap(null);
        //         }
        //         dottedLine = new google.maps.Polyline({
        //             path: [customerLocation, officeLocation],
        //             geodesic: true,
        //             strokeColor: '#FF0000',
        //             strokeOpacity: 1.0,
        //             strokeWeight: 2,
        //             icons: [{
        //                 icon: {
        //                     path: google.maps.SymbolPath.CIRCLE,
        //                     scale: 2,  // Adjust the size of the dots
        //                     strokeColor: '#FF0000',  // Dot color
        //                 },
        //                 offset: '0',
        //                 repeat: '10px'  // Distance between dots
        //             }]
        //         });
        //         dottedLine.setMap(map);
        //     }
        // }
        // // Update address fields based on place data
        // function updateAddressFields(place, type) {
        //     var address = '';
        //     if (place.address_components) {
        //         address = [
        //             (place.address_components[0] && place.address_components[0].short_name || ''),
        //             (place.address_components[1] && place.address_components[1].short_name || ''),
        //             (place.address_components[2] && place.address_components[2].short_name || '')
        //         ].join(' ');
        //     }
        //
        //     if (type === 'customer') {
        //         infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        //         infowindow.open(map, customerMarker);
        //         // Automatically fill in the country, state, city, and zip code
        //         for (var i = 0; i < place.address_components.length; i++) {
        //             var addressType = place.address_components[i].types[0];
        //             switch (addressType) {
        //                 case 'country':
        //                     // Set the country input to the 2-letter ISO code
        //                     document.getElementById('txtCountry').value = place.address_components[i].short_name; // Corrected to use short_name directly
        //                     break;
        //                 case 'administrative_area_level_1':
        //                     document.getElementById('txtState').value = place.address_components[i].long_name;
        //                     break;
        //                 case 'locality':
        //                     document.getElementById('txtCity').value = place.address_components[i].long_name;
        //                     break;
        //                 case 'postal_code':
        //                     document.getElementById('txtZip').value = place.address_components[i].long_name;
        //                     break;
        //             }
        //         }
        //     } else if (type === 'office') {
        //         // Handle the office address fields similarly
        //     }
        // }
        //
        // // Calculate the distance between the customer and office locations
        // function calculateDistance() {
        //     if (customerLat && officeLat) {
        //         var customerLocation = new google.maps.LatLng(customerLat, customerLng);
        //         var officeLocation = new google.maps.LatLng(officeLat, officeLng);
        //
        //         distanceService.getDistanceMatrix({
        //             origins: [customerLocation],
        //             destinations: [officeLocation],
        //             travelMode: 'DRIVING',
        //         }, function(response, status) {
        //             if (status === 'OK') {
        //                 var distance = response.rows[0].elements[0].distance.text;
        //                 $('.location_distance').val(distance)
        //             } else {
        //                 alert('Error in getting distance: ' + status);
        //             }
        //         });
        //     }
        // }
        //
        // google.maps.event.addDomListener(window, 'load', initMap);

        var map;
        var distanceService = new google.maps.DistanceMatrixService();
        var customerMarker, officeMarker;
        var customerLat, customerLng, officeLat = {{ auth()->user()->profile->company_latitude }},
            officeLng = {{ auth()->user()->profile->company_longitude }};
        var dottedLine;
        var infowindow = new google.maps.InfoWindow();
        var customerInfoWindow = new google.maps.InfoWindow();
        var officeInfoWindow = new google.maps.InfoWindow();

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: officeLat,
                    lng: officeLng
                },
                zoom: 4,
                zoomControl: true,
                zoomControlOptions: {
                    position: google.maps.ControlPosition.TOP_LEFT
                },
            });
            var officeLocation = new google.maps.LatLng(officeLat, officeLng);
            officeMarker = new google.maps.Marker({
                map: map,
                position: officeLocation,
                title: "Office Location"
            });
            officeInfoWindow.setContent('<div><strong>Office Location</strong><br>Static Office Address</div>');
            officeMarker.addListener('click', function() {
                officeInfoWindow.open(map, officeMarker);
            });
            var customerInput = document.getElementById('address');
            var customerAutocomplete = new google.maps.places.Autocomplete(customerInput);
            customerAutocomplete.bindTo('bounds', map);
            customerMarker = new google.maps.Marker({
                map: map,
                anchorPoint: new google.maps.Point(0, -29),
                visible: false
            });
            customerAutocomplete.addListener('place_changed', function() {
                $('.location_distance').val('');
                var place = customerAutocomplete.getPlace();
                if (!place.geometry) {
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

                customerLat = place.geometry.location.lat();
                customerLng = place.geometry.location.lng();

                document.getElementById('latitude').value = customerLat;
                document.getElementById('longitude').value = customerLng;

                var customerLocation = new google.maps.LatLng(customerLat, customerLng);
                var bounds = new google.maps.LatLngBounds();
                bounds.extend(customerLocation);
                bounds.extend(officeLocation);
                map.fitBounds(bounds);

                customerMarker.setPosition(customerLocation);
                customerMarker.setVisible(true);
                customerInfoWindow.setContent('<div><strong>' + place.name + '</strong><br>' + place
                    .formatted_address + '</div>');
                customerInfoWindow.open(map, customerMarker);
                officeInfoWindow.open(map, officeMarker);
                customerInfoWindow.open(map, customerMarker);
                updateAddressFields(place);
                calculateDistances(customerLocation, officeLocation);
                drawDottedLine(customerLocation, officeLocation);

                // ✅ NEW LINE: manually trigger the address validation
                const address = $('#address').val().trim();
                if (address.length >= 2) {
                    checkCustomerMatch({
                        address: address
                    });
                }
            });

        }

        function updateAddressFields(place) {
            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }
            for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];
                switch (addressType) {
                    case 'country':
                        document.getElementById('txtCountry').value = place.address_components[i].long_name;
                        break;
                    case 'administrative_area_level_1':
                        document.getElementById('txtState').value = place.address_components[i].long_name;
                        break;
                    case 'locality':
                        document.getElementById('txtCity').value = place.address_components[i].long_name;
                        break;
                    case 'postal_code':
                        document.getElementById('txtZip').value = place.address_components[i].long_name;
                        break;
                }
            }
        }

        function drawDottedLine(customerLocation, officeLocation) {
            if (customerLat && officeLat) {
                if (dottedLine) {
                    dottedLine.setMap(null);
                }
                dottedLine = new google.maps.Polyline({
                    path: [customerLocation, officeLocation],
                    geodesic: true,
                    strokeColor: '#FF0000',
                    strokeOpacity: 1.0,
                    strokeWeight: 2,
                    icons: [{
                        icon: {
                            path: google.maps.SymbolPath.CIRCLE,
                            scale: 2,
                            strokeColor: '#FF0000',
                        },
                        offset: '0',
                        repeat: '10px'
                    }]
                });
                dottedLine.setMap(map);
            }
        }

        function calculateDistances(customerLocation, officeLocation) {
            var geodesicDistance = google.maps.geometry.spherical.computeDistanceBetween(customerLocation, officeLocation);
            // var geodesicDistanceKm = geodesicDistance / 1000; // Convert to kilometers
            var geodesicDistanceMiles = geodesicDistance * 0.000621371; // Convert to kilometers
            var request = {
                origins: [customerLocation],
                destinations: [officeLocation],
                travelMode: 'DRIVING',
            };
            distanceService.getDistanceMatrix(request, function(response, status) {
                if (status === 'OK') {
                    var drivingDistance = response.rows[0].elements[0].distance.text;
                    $('.location_distance').val('Driving Distance: ' + drivingDistance);
                } else {
                    alert('Error in getting distance: ' + status);
                }
            });
            console.log("Geodesic (air) Distance: " + geodesicDistanceMiles.toFixed(2) + " miles");
            $('.location_distance').val($('.location_distance').val() + ' | Air Distance: ' + geodesicDistanceMiles.toFixed(
                2) + ' miles');
        }
        google.maps.event.addDomListener(window, 'load', initMap);

        function previewImage(input) {
            var file = input.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var imagePreview = document.getElementById('imagePreview');
                    var editImagePreview = document.getElementById('editImagePreview');
                    if (!imagePreview) {
                        imagePreview = document.createElement('img');
                        imagePreview.id = 'imagePreview';
                        imagePreview.alt = 'Image Preview';
                        imagePreview.style.maxWidth = '100%';
                        imagePreview.style.maxHeight = '200px';
                        document.getElementById('imagePreviewContainer').appendChild(imagePreview);
                    }
                    imagePreview.src = e.target.result;
                    if (editImagePreview) {
                        editImagePreview.style.display = 'none';
                    }
                    document.getElementById('imagePreviewContainer').style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        } //end previewImage

        $(document).ready(function() {
            function setupForm() {
                if ($('#signatureCheckbox').is(':checked')) {
                    // $('#upload_customer_signature').prop('required', false);
                    $('#remove_div').hide();
                    $('#upload_signature').prop('checked', false);
                    $('#imagePreviewContainer img').attr('src', '');
                    $('#imagePreviewContainer').css('display', 'none');
                    $('#fileInputElement').val('');
                    $('#signatureForm').show();
                } else if ($('#upload_signature').is(':checked')) {
                    $('#remove_div').show();
                    $('#signatureCheckbox').prop('checked', false);
                    $('#signatureForm').hide();
                } else {
                    $('#signatureForm').hide();
                    $('#remove_div').hide();
                }
            }
            setupForm();
            $('#signatureCheckbox').on('change', function() {
                setupForm();
            });
            $('#upload_signature').on('change', function() {
                setupForm();
            });
        });
        $(document).ready(function() {
            var storedSignature = "{{ $customer->upload_signature ?? '' }}";
            if (storedSignature !== null && storedSignature !== "") {
                $('#signatureForm').show();
                $('#signatureCheckbox').prop('checked', true);
                loadSignatureImage(storedSignature);
                $('#mouseSignatureInput').val(storedSignature);
            }
            $('#signatureCheckbox').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#signatureForm').show();
                } else {
                    $('#signatureForm').hide();
                }
            });

            function loadSignatureImage(signature) {
                var canvas = document.getElementById('mouseSignatureCanvas');
                var ctx = canvas.getContext('2d');
                var img = new Image();
                img.onload = function() {
                    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                };
                img.src = signature;
            }
        });
        // Mouse Signature
        var mouseSignatureCanvas = document.getElementById('mouseSignatureCanvas');
        var mouseSignaturePad = new SignaturePad(mouseSignatureCanvas);

        function clearMouseSignature() {
            mouseSignaturePad.clear();
            document.getElementById('mouseSignatureInput').value = "";
        }
        mouseSignaturePad.onEnd = function() {
            updateSignatureInput();
        };
    </script>
    <script>
        window.addEventListener('load', function() {
            var canvas = document.getElementById('mouseSignatureCanvas');
            var ctx = canvas.getContext('2d');
            var img = new Image();
            img.onload = function() {
                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
            };
            img.src = "{{ $customer->upload_signature ?? '' }}";
        });

        function updateSignatureInput() {
            var canvas = document.getElementById('mouseSignatureCanvas');
            var signatureInput = document.getElementById('mouseSignatureInput');
            signatureInput.value = canvas.toDataURL();
        }
        $(document).ready(function() {
            $('.phone').mask('(000) 000-0000'); // Use zeros to represent digit placeholders
        });
        $(document).on('keyup', '#email', function() {
            var email = $(this).val();
            $.ajax({
                url: "{{ route('check_email') }}",
                method: "POST",
                data: {
                    '_token': '{{ csrf_token() }}',
                    email: email,
                },
                success: function(data) {
                    console.log(data);
                    if (data == 'yes') {
                        $('#email_exist_msg').text("This email is already registered");
                        $('#submit_btn').attr('disabled', 'disabled');
                        event.preventDefault();
                    } else {
                        $('#email_exist_msg').text("");
                        $('#submit_btn').removeAttr('disabled', 'disabled');
                    }
                },
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var appendCounter = 0;

            // Event delegation for dynamically added elements
            $('.table-fields-phone').on('click', '.entry .btn-remove', function() {
                // Remove the parent .entry when .btn-remove is clicked
                $(this).closest('.entry').remove();
                appendCounter--; // Decrement the counter when an entry is removed

                // Enable the plus_btn if appendCounter is less than 3
                if (appendCounter < 3) {
                    $('.plus_btn').prop('disabled', false);
                }

                // Enable/disable all .btn-remove based on appendCounter value
                updateBtnRemoveState();
            });

            $('.plus_btn').on('click', function() {
                if (appendCounter < 3) {
                    var entryHtml =
                        '<div class="entry form-inline text-center custom_phone_number added-phone_number"><!--<span>+1</span>-->' +
                        '<input required class="form-control clr_input_fields phoneInput phone" placeholder="( ___ ) ___-____" name="phone[]" value="" type="tel" required>' +
                        '<button class="btn btn-danger btn-remove inline" type="button" >' +
                        '<span class="fa fa-minus"></span>' +
                        '</button>' +
                        '</div>' +
                        '<div class="phoneValidationMessage"></div>'
                    $('.table-fields-phone').append(entryHtml);
                    appendCounter++;

                    // Disable the plus_btn if appendCounter reaches 3
                    if (appendCounter === 3) {
                        $('.plus_btn').prop('disabled', true);
                    }

                    // Enable/disable all .btn-remove based on appendCounter value
                    updateBtnRemoveState();
                } else {
                    alert('Limit Exceeded');
                }
            });

            // Function to enable/disable all .btn-remove based on appendCounter value
            function updateBtnRemoveState() {
                if (appendCounter > 0) {
                    $('.entry .btn-remove').prop('disabled', false);
                } else {
                    $('.entry .btn-remove').prop('disabled', true);
                }
            }
        });

        $(".create_lead_btn").click(function() {
            if ($('.lead_form_area:visible').length) {
                $('.create_lead_btn').html("create Lead");
                $('.lead_form_area').hide();
                $('#title').removeAttr('required').val('');
                $('#representative_id').removeAttr('required').val('');
                $('#category_id').removeAttr('required').val('');
                $('#contact_person').val('');
                $('#lead_number').removeAttr('required');
                $('#lead_date').removeAttr('required');
            } else {
                $('.create_lead_btn').html("don't want to create lead?");
                $('.lead_form_area').show();
                $('#title').attr('required', 'required');
                $('#representative_id').attr('required', 'required');
                $('#category_id').attr('required', 'required');
                $('#lead_number').attr('required', 'required');
                $('#lead_date').attr('required', 'required');
            }
        });


        @if (request()->is('customer/customer/create'))
            function formatCurrency(value) {
                value = value.replace(/,/g, '');
                var parts = value.split('.');
                parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                return parts.join('.');
            }

            // $(document).ready(function() {
            //     $('#lead_price').on('input', function() {
            //         var inputValue = $(this).val().replace(/[^\d.]/g, '');
            //         $(this).val(formatCurrency(inputValue));
            //     });
            //
            //     $('form').submit(function() {
            //         $('#lead_price').val($('#lead_price').val().replace(/,/g, ''));
            //     });
            // });
        @endif

        {{--    getRolePermissions(6); --}}
        {{--    function getRolePermissions($role_id){ --}}
        {{--        var role  = $role_id; --}}
        {{--        $.ajax({ --}}
        {{--            type: "GET", --}}
        {{--            url: "{{url('get_role_details_staff')}}/"+role, --}}
        {{--            success: function(data){ --}}
        {{--                $('#permissions_detail_div').html(data) --}}
        {{--                console.log(data); --}}
        {{--            }, --}}
        {{--            error:function(e){ --}}
        {{--                console.log(e.status); --}}
        {{--            } --}}
        {{--        }) --}}
        {{--    } --}}

        {{--    $(document).on('change','#role_id',function (e) { --}}
        {{--        e.preventDefault(); --}}
        {{--        getRolePermissions($(this).val()); --}}
        {{--    }); --}}
        {{--    $(document).ready(function () { --}}
        {{--        $(document).on('click','input[data-permiss^="permiss_add"]',function () { --}}
        {{--            var isChecked = $(this).is(':checked'); --}}
        {{--            var permissionName = $(this).attr('data-permiss').replace('permiss_add', 'permiss_view'); --}}
        {{--            if (permissionName) { --}}
        {{--                $('input[data-permiss="'+ permissionName + '"]').prop('checked', isChecked); --}}
        {{--            } --}}
        {{--        }); --}}
        {{--        $(document).on('click','input[data-permiss^="permiss_edit"]',function () { --}}
        {{--            var isChecked = $(this).is(':checked'); --}}
        {{--            var permissionName = $(this).attr('data-permiss').replace('permiss_edit', 'permiss_view'); --}}
        {{--            if (permissionName) { --}}
        {{--                $('input[data-permiss="'+ permissionName + '"]').prop('checked', isChecked); --}}
        {{--            } --}}
        {{--        }); --}}
        {{--    }); --}}

        // $(document).ready(function() {
        //     $('#uniqueKey').on('click', function() {
        //         var customer_id = $(this).val();
        //         var ucode = '-' + ('000000' + Math.floor(Math.random() * 10000)).slice(-6) + '-';
        //         var data = {
        //             created_at: new Date(),
        //             unique_code: '',
        //             lead_count: 1
        //         };
        //
        //         var yearLastTwoDigits = new Date(data.created_at).getFullYear().toString().slice(-2);
        //         var uniqueCode = data.unique_code || '';
        //         var leadCount = data.lead_count;
        //         var newLeadNumber = yearLastTwoDigits + ucode + leadCount;
        //         $('#lead_number').val(newLeadNumber);
        //     });
        // });
    </script>
    <script>
        $(document).ready(function() {
            $('.customer_type').on('change', function() {
                var customerTypeId = $(this).val();
                if (customerTypeId == 1) { // Residential
                    $('#hide_company').hide();
                    $('#company').val('').prop('disabled', true);
                } else { // Commercial
                    $('#hide_company').show();
                    $('#company').prop('disabled', false);
                }
            });
            $('input[name="customer_type_id"]:checked').trigger('change');
            let editor;
            if (typeof ClassicEditor !== "undefined") {
                ClassicEditor
                    .create(document.querySelector('#customer_description'))
                    .then(newEditor => {
                        editor = newEditor;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            } else {
                console.error("ClassicEditor is not defined. Please check if CKEditor 5 is loaded correctly.");
            }
            $.validator.addMethod("customerDescription", function(value, element) {
                if (editor) {
                    var editorContent = editor.getData().trim();
                    return editorContent.length !== 0;
                }
                return false;
            }, "Description is required.");
            // Form validation
            $('#customer-form').validate({
                ignore: ":hidden:not(textarea):not(.select2-search__field)",
                rules: {
                    first_name: {
                        required: true
                    },
                    last_name: {
                        required: true
                    },
                    // email: { required: true },
                    //description: { customerDescription: true },
                    phone: {
                        required: true
                    },
                    customer_type_id: {
                        required: true
                    },
                    lead_date: {
                        required: true
                    },
                    address: {
                        required: true
                    },
                    'phone[]': {
                        required: true,
                        minlength: 14,
                        maxlength: 14
                    },
                    user_category_id: {
                        required: true
                    },
                    title: {
                        required: true
                    },
                    representative_id: {
                        required: true
                    },
                    category_id: {
                        required: true
                    },
                    company: {
                        required: function() {
                            return $('input[name="customer_type_id"]:checked').val() == 2;
                        }
                    }
                },
                messages: {
                    first_name: {
                        required: "Please enter First Name."
                    },
                    last_name: {
                        required: "Please enter Last Name."
                    },
                    // email: { required: "Please enter Email." },
                    //description: { customerDescription: "Description is required." },
                    phone: {
                        required: "Please enter Phone Number."
                    },
                    customer_type_id: {
                        required: "Please select Residential or Commercial."
                    },
                    lead_date: {
                        required: "Please select a Lead Date."
                    },
                    address: {
                        required: "Please enter Address."
                    },
                    'phone[]': {
                        required: "Phone number is required.",
                        minlength: "Invalid phone number. Must be 14 characters.",
                        maxlength: "Invalid phone number. Must be 14 characters."
                    },
                    user_category_id: {
                        required: "Please Select Category."
                    },
                    title: {
                        required: "Please enter Title."
                    },
                    representative_id: {
                        required: "Please select Job Rep / Estimator."
                    },
                    category_id: {
                        required: "Please select Category."
                    },
                    company: {
                        required: "Please enter Company for Commercial customers."
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") === "customer_type_id") {
                        error.insertAfter($('.residential_commercial'));
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form) {
                    if ($('input[name="customer_type_id"]:checked').length === 0) {
                        alert("Please select Residential or Commercial.");
                        return false;
                    }
                    $('.submit_btn').prop('disabled', true);
                    form.submit();
                }
            });
            /*$('#customer-form input, #customer-form select').on('keyup change', function () {
                if ($('#customer-form').valid()) {
                    $('.submit_btn').prop('disabled', false);
                } else {
                    $('.submit_btn').prop('disabled', true);
                }
            });*/
        });
        $(document).ready(function() {
            togglePastCustomerDiv();
            $('.referral_source_id').on('change', function() {
                togglePastCustomerDiv();
            });

            function togglePastCustomerDiv() {
                var referralSourceId = $('.referral_source_id').val();
                console.log('Referral Source ID:', referralSourceId);
                if (referralSourceId == '10') {
                    $('#past_customer_div').show();
                } else {
                    $('#past_customer_div').hide();
                }
            }


        });
    </script>

    <script>
        $(document).ready(function() {

            function debounce(fn, delay) {
                let timer;
                return function(...args) {
                    clearTimeout(timer);
                    timer = setTimeout(() => fn.apply(this, args), delay);
                };
            }

            // function checkCustomerMatch(data) {
            //     $.ajax({
            //         url: "{{ url('customer_match') }}", // Update route if needed
            //         method: "GET",
            //         data: data,
            //         success: function(response) {
            //             console.log(response);
            //             if (response.matched) {
            //                 Swal.fire({
            //                     title: 'Matching Customer Found!',
            //                     html: `
        //                 <b>Name:</b> ${response.record.first_name ?? ''} ${response.record.last_name ?? ''}<br>
        //                 <b>Email:</b> ${response.record.email ?? 'N/A'}
        //             `,
            //                     icon: 'info',
            //                     confirmButtonText: 'OK'
            //                 });
            //             }
            //         },
            //         error: function() {
            //             console.error('Error checking for customer match');
            //         }
            //     });
            // }

            function checkCustomerMatch(data) {
                // Collect all filled fields from the form
                const allData = {};

                // Add first_name if filled
                const firstName = $('#first_name').val().trim();
                if (firstName.length >= 2) {
                    allData.first_name = firstName;
                }

                // Add last_name if filled
                const lastName = $('#last_name').val().trim();
                if (lastName.length >= 2) {
                    allData.last_name = lastName;
                }

                // Add address if filled
                const address = $('#address').val().trim();
                if (address.length >= 2) {
                    allData.address = address;
                }

                // Add phone if filled
                const phone = $('.phoneInput').val().trim();
                if (phone.length >= 10) {
                    allData.phone = phone;
                }

                // Merge with any additional data passed in
                const finalData = Object.assign({}, allData, data);

                // Only proceed if at least one field is filled
                if (Object.keys(finalData).length === 0) {
                    return;
                }

                $.ajax({
                    url: "{{ url('customer_match') }}",
                    method: "GET",
                    data: finalData,
                    success: function(response) {
                        console.log(response);

                        if (response.matched) {

                            const records = response
                                .records; // Assuming this is the array of matched customers
                            const totalCount = records.length;
                            let htmlList = '';

                            // 1. Loop chala kar har record ki details HTML mein jama karein
                            records.forEach((record, index) => {
                                // Yahan aapko wo ID deni hai jisse aap view page par jaana chahte hain
                                const viewUrl = `{{ url('customer/customer') }}/${record.id}`;

                                // Get phone numbers if available
                                let phoneNumbers = 'N/A';
                                if (record.customer_phones && record.customer_phones.length >
                                    0) {
                                    phoneNumbers = record.customer_phones.map(p => p.phone)
                                        .join(', ');
                                }

                                // Get address if available
                                let addressText = 'N/A';
                                if (record.profile && record.profile.address) {
                                    addressText = record.profile.address;
                                }

                                htmlList += `
                                <div style="border-bottom: 1px solid #eee; padding: 8px 0;">
                                    <strong>${index + 1}. Name:</strong> ${record.first_name ?? ''} ${record.last_name ?? ''}<br>
                                    <strong>Email:</strong> ${record.email ?? 'N/A'}<br>
                                    <a href="${viewUrl}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                </div>
                            `;
                            });

                            // 2. Final HTML ko scrollable container mein daal dein
                            const finalHtml = `
                                <p style="font-weight: bold; margin-bottom: 10px;">Total Matches Found: ${totalCount}</p>

                                <div style="max-height: 250px; overflow-y: auto; text-align: left; padding: 0 10px;">
                                    ${htmlList}
                                </div>
                            `;

                            Swal.fire({
                                title: 'Multiple Matching Customers Found!',
                                html: finalHtml, // Scrolling list wala HTML yahan use kiya
                                icon: 'info',
                                confirmButtonText: 'Ok',
                                // Agar aap koi button chahte hain jo list page par le jaye, toh yahan showCancelButton: true use karein
                            });
                        }
                        // Agar match nahi hua toh koi doosra Swal dikha sakte hain
                        else {
                            // Don't show alert if no match found - just silently return
                            console.log('No customer match found');
                        }
                    },
                    error: function() {
                        console.error('Error checking for customer match');
                        // Don't show error alert for match checking
                    }
                });
            }


            // First Name Input Check
            const debouncedFirstNameCheck = debounce(function() {
                const firstName = $('#first_name').val().trim();
                if (firstName.length >= 2) {
                    checkCustomerMatch({
                        first_name: firstName
                    });
                }
            }, 500);

            $('#first_name').on('input', debouncedFirstNameCheck);

            // Last Name Input Check
            const debouncedLastNameCheck = debounce(function() {
                const lastName = $('#last_name').val().trim();
                if (lastName.length >= 2) {
                    checkCustomerMatch({
                        last_name: lastName
                    });
                }
            }, 500);

            $('#last_name').on('input', debouncedLastNameCheck);

            //Address Input Check
            const debouncedAddressCheck = debounce(function() {
                const address = $('#address').val().trim();
                if (address.length >= 2) {
                    checkCustomerMatch({
                        address: address
                    });
                }
            }, 500);

            $('#address').on('input', debouncedAddressCheck);

            //Phone Input Check
            const debouncedPhoneCheck = debounce(function() {
                const phone = $('.phoneInput').val().trim();
                if (phone.length >= 10) {
                    checkCustomerMatch({
                        phone: phone
                    });
                }
            }, 500);

            $('.phoneInput').on('input', debouncedPhoneCheck);

        });
    </script>
@endpush
