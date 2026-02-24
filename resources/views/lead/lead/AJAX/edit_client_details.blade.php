<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" >Edit Job Details </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ url('/lead/lead/' . $editLead->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="edit_detail_form">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name" class="form-label input_labels p-18">Customer *</label>
                                <select class="form-control clr_input_fields borderRadius select2" id="customer_id" name="customer_id" required>
                                    <option value="" selected>Select</option>
                                    @foreach($customers as $customer)
                                        <option value="{{$customer->id}}" @if(isset($editLead) && $editLead->customer_id==$customer->id) selected @endif>{{$customer->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="job-address" class="form-label input_labels p-18">Job Address *</label>
                                <input class="form-control clr_textarea_fields borderRadius" value="{{$editLead->address??''}}" name="address" type="text" id="edit_lead_address" required>
                                <input type="hidden" name="latitude" value="{{old('latitude',   $editLead->latitude ??'')}}"  class="form-control clr_input_fields borderRadius" id="edit_latitude" >
                                <input type="hidden" name="longitude" value="{{old('longitude', $editLead->longitude ??'')}}" class="form-control clr_input_fields borderRadius" id="edit_longitude" >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class=" d-flex justify-content-center ">
                                    <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Save' }}" onclick="this.disabled = true; this.form.submit();">
                                </div>
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
    })


</script>
