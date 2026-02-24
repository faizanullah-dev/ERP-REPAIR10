<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" >Edit Job Details </h5>
            <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> × </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ url('/lead/lead/' . $editLead->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="edit_detail_form">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label input_labels p-18">Customer *</label>
                            <select class="form-control  borderRadius custom_modal_select2" id="customer_id" name="customer_id" required>
                                <option value="" selected>Select</option>
                                @foreach($customers as $customer)
                                    <option value="{{$customer->id}}" @if(isset($editLead) && $editLead->customer_id==$customer->id) selected @endif>{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="customer-name" class="form-label input_labels p-18">Job Name *</label>
                            <input class="form-control clr_input_fields borderRadius" name="title" type="text" id="title" placeholder="Enter Job Name" value="{{ $editLead->title??''}}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="customer-name" class="form-label input_labels p-18">Job Rep / Estimator *</label>
                            <select class="form-control clr_input_fields borderRadius custom_modal_select2"  id="representative_id" name="representative_id" required>
                                <option value="" selected>Select</option>
                                @foreach ($roles as $role)
                                    @if ($role->name !== 'admin' && $role->name !== 'user' && $role->name !== 'customer')
                                        <optgroup label="{{ $role->name }}">
                                            @foreach ($role->users as $user)
                                                <option value="{{ $user->id }}" @if($user->id == $editLead->representative_id) selected @endif > {{ $user->name ?? "" }} </option>
                                            @endforeach
                                        </optgroup>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="customer-name" class="form-label input_labels p-18">Category *</label>
                            <select class="form-control clr_input_fields borderRadius custom_modal_select2" id="category_id" name="category_id" required>
                                <option value="" selected>None</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if(isset($editLead) && $editLead->category_id==$category->id) selected @endif>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="customer-name" class="form-label input_labels p-18">Lead #</label>
                            <input class="form-control clr_input_fields borderRadius" name="lead_number" placeholder="Enter Lead" type="text" id="lead_number" value="{{ $editLead->lead_number??"" }}" readonly >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="contact-person" class="form-label input_labels p-18">Contact Person</label>
                            <input class="form-control clr_input_fields borderRadius" name="contact_person" placeholder="Contact" type="text" id="contact_person" value="{{ $editLead->contact_person??''}}" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="customer-name" class="form-label input_labels p-18">Project Price*</label>
                            <input class="form-control clr_input_fields borderRadius"  name="lead_price" placeholder="Enter Price" type="text" id="lead_price" value="{{ number_format($editLead->lead_price)??''}}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="customer-name" class="form-label input_labels p-18">Lead Date*</label>
                            <input class="form-control clr_input_fields borderRadius" name="lead_date" placeholder="Enter Price" type="date" id="lead_date" value="{{ $editLead->lead_date ?? ""}}" required>
                        </div>
                    </div>

<!--
                    <div class="row">


                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label input_labels p-18">Select Percentage / Flat *</label>
                                <select  name="percentage_or_flat" class="form-control" id="percentage_or_flat" required>
                                    <option value=""> Select Values </option>
                                    <option value="percentage" @if(isset($editLead) && $editLead->percentage_or_flat == 'percentage') selected @endif > Percentage </option>
                                    <option value="flat"  @if(isset($editLead) && $editLead->percentage_or_flat == 'flat') selected @endif > Flat </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="customer-name" class="form-label input_labels p-18">Enter Percentage / Flat *</label>
                                <input class="form-control clr_input_fields borderRadius" name="percentage_flat_value" placeholder="Enter Percentage / Flat" type="number" id="percentage_flat_value" value="{{$editLead->percentage_flat_value??'0'}}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="customer-name" class="form-label input_labels p-18">Sales Commission *</label>
                                <input class="form-control clr_input_fields borderRadius" name="sales_commission" placeholder="Commission" type="number" id="sales_commission" value="{{$editLead->sales_commission??'0'}}" required readonly>
                            </div>
                        </div>


                    </div>
-->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="job-address" class="form-label input_labels p-18">Job Address *</label>
                            <input class="form-control clr_textarea_fields borderRadius" value="{{$editLead->address??''}}" name="address" type="text" id="edit_lead_address" required>
                            <input type="hidden" name="latitude" value="{{old('latitude',   $editLead->latitude ??'')}}"  class="form-control clr_input_fields borderRadius" id="edit_latitude" >
                            <input type="hidden" name="longitude" value="{{old('longitude', $editLead->longitude ??'')}}" class="form-control clr_input_fields borderRadius" id="edit_longitude" >
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="description" class="form-label input_labels p-18">Job Description *</label>
                            <textarea class="form-control" rows="5" name="description" type="textarea" id="job_description" required>{{ $editLead->description??'' }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="call-center" class="form-label input_labels p-18">Minimum Days</label>
                            <input  min="0" oninput="this.value = Math.abs(this.value)" class="form-control borderRadius clr_input_fields" name="minimum_days" type="number" id="duration_days" value="{{ $editLead->minimum_days??''}}" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="call-center" class="form-label input_labels p-18">Maximum Days</label>
                            <input  min="0" oninput="this.value = Math.abs(this.value)" class="form-control borderRadius clr_input_fields" name="maximum_days" type="number" id="duration_hours" value="{{ $editLead->maximum_days??''}}" >
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-4">
                            <label for="call-center" class="form-label input_labels p-18">Other Information</label>
                            <textarea class="form-control borderRadius clr_textarea_fields" rows="3" placeholder="Other Information" name="other_information" type="textarea" id="other_information" >{{ $editLead->other_information??''}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            <input class="btn mx-auto d-block btn-green" type="submit" value="{{ $submitButtonText??'Save' }}" onclick="this.disabled = true; this.form.submit();">
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {


        // Define the formatCurrency function in the global scope
        function formatCurrency(value) {
            value = value.replace(/,/g, '');
            var parts = value.split('.');
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return parts.join('.');
        }
        $('#lead_price').on('input', function() {
            var inputValue = $(this).val().replace(/[^\d.]/g, '');
            $(this).val(formatCurrency(inputValue));
        });

        // Event listener for form submission to remove commas
        $('form').submit(function() {
            // Remove commas before submitting the form
            $('#lead_price').val($('#lead_price').val().replace(/,/g, ''));
        });

        // Event listeners for commission calculation
        $(document).on('change', '#percentage_or_flat', function() {
            calculateComssion();
        });

        $(document).on('input keyup', '#percentage_flat_value, #lead_price', function() {
            calculateComssion();
        });

        // Function to calculate commission
        function calculateComssion() {
            var value = $('#percentage_or_flat').val();
            var leadPrice = $('#lead_price').val().replace(/,/g, '');

            if (value == 'percentage') {
                var percentageValue = $('#percentage_flat_value').val();
                var commission = (leadPrice * percentageValue) / 100;
                $('#sales_commission').val(commission.toFixed(2)); // Fix to 2 decimal places
            } else {
                var flatValue = $('#percentage_flat_value').val();
                $('#sales_commission').val(flatValue);
            }
        }
    });

    $(document).ready(function(){
        $.validator.addMethod("job_description", function(value, element) {
            if (editor) {
                var editorContent = editor.getData().trim();
                return editorContent.length !== 0;
            }
            return false;
        }, "Description is required.");

        $('#edit_detail_form').validate({
            rules: {
                customer_id: {
                    required: true,
                },
                title: {
                    required: true,
                },
                representative_id: {
                    required: true,
                },
                category_id: {
                    required: true,
                },
                lead_price: {
                    required: true,
                },
                lead_date: {
                    required: true,
                },
                percentage_or_flat: {
                    required: true,
                },
                percentage_flat_value: {
                    required: true,
                    min:1,
                },
                sales_commission: {
                    required: true,
                },
                address: {
                    required: true,
                },
                description: {
                    job_description: true,
                },
                minimum_days: {
                    required: true,
                    min: 1,
                },
                maximum_days: {
                    required: true,
                    min: 1,
                },
            },
            messages: {
                customer_id: {
                    required: "Please select customer",
                },
                title: {
                    required: "Please enter job name",
                },
                representative_id: {
                    required: "Please select job rep / estimator",
                },
                category_id: {
                    required: "Please select category",
                },
                lead_price: {
                    required: "Please enter project price",
                },
                lead_date: {
                    required: "Please select lead date",
                },
                percentage_or_flat: {
                    required: "Please select percentage / flat",
                },
                percentage_flat_value: {
                    required: "Please enter percentage / flat",
                    min: "Please select percentage / flat",
                },
                sales_commission: {
                    required: "Please enter sales commission",
                },
                address: {
                    required: "Please enter job address",
                },
                description: {
                    job_description: "Please enter job description",
                },
                minimum_days: {
                    required: "Please enter minimum days",
                },
                maximum_days: {
                    required: "Please enter maximum days",
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>
