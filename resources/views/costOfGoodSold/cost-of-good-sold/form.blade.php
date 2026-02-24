<div class="date_field">
    <div class="form-group select_date">
        <label for="" class="control-label">Date</label>
        <input class="form-control" type="date" name="cogs_date" value="{{ $yearEstimation->year. '-01-01' }}" required>
    </div>
</div>
<div class="products_container_first" id="product-items">
    <div class="product-item">
        <div class="form-group custom_cogs_chk_wrapper">
            <label class="custom_cogs_chk_label">Job Per Hour</label>
            <input class="show-job-per-hr" type="checkbox" id="" name="show_job_per_hrr[]" value="1">
            <input type="hidden" name="show_job_per_hrr[]" value="0" class="hidden-checkbox">
        </div>

        <div class="form-group {{ $errors->has('cogs_material_id') ? 'has-error' : ''}}">
            <label for="cogs_material_id" class="control-label">{{ 'COGS Material' }}</label>
            <select class="form-control" name="cogs_material_id[]"  id="" required>
                @foreach($cogs_materials as $key => $value)
                    <option value="{{$value->id}}" >{{$value->name??''}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            <label for="name" class="control-label">{{ 'Name' }}<span class="text-danger">*</span></label>
            <input class="form-control" required name="name[]" type="text" id="" placeholder="Type Name Here" value="{{ $costofgoodsold->name??''}}">
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
            <label for="description" class=" control-label">{{ 'Description' }}</label>
            <input class="form-control" name="description[]" type="text" id="" placeholder="Type Description Here" value="{{ $costofgoodsold->description??''}}" >
            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('unit_qty') ? 'has-error' : ''}}">
            <label for="unit_qty" class="control-label">{{ 'Unit Qty' }}<span class="text-danger">*</span></label>
            <input class="form-control unit_qty" name="unit_qty[]" type="number" required id="" placeholder="Type Unit Quantity Here" value="{{ $costofgoodsold->unit_qty??''}}">
            {!! $errors->first('unit_qty', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group unit_price_input {{ $errors->has('qty_price') ? 'has-error' : ''}} unit-price-container" style="display: none;">
            <label for="qty_price" class=" control-label">{{ 'Unit Price' }}</label>
            <input class="form-control qty_price" name="qty_price[]" type="number" step="0.01" required id="qty_price[]" placeholder="Type Unit Price Here" value="{{ $costofgoodsold->qty_price??''}}">
            {!! $errors->first('qty_price', '<p class="help-block">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('job_per_hr') ? 'has-error' : ''}} job-per-hr-container" style="display: none;">
            <label for="job_per_hr" class="control-label">{{ 'Job Per Hr' }}</label>
            <input class="form-control job_per_hrr" name="job_per_hr[]" type="number" id="" placeholder="Type Job Per Hour Here" value="{{ $costofgoodsold->job_per_hr??''}}">
            {!! $errors->first('job_per_hr', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('total_cost') ? 'has-error' : ''}}">
            <label for="total_cost" class=" control-label">{{ 'Total Cost' }}<span class="text-danger">*</span></label>
            <input class="form-control total_cost" name="total_cost[]" type="number" required id="" value="{{ $costofgoodsold->total_cost??''}}" readonly>
            {!! $errors->first('total_cost', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group extra_btn add_cogs_modal_btn">
            <button type="button" class="btn btn-green add-product">
                <i class="btn btn-sm fa fa-plus" aria-hidden="true"></i>
            </button>
            <button type="button" class="btn btn-danger remove-product">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
            </button>
        </div>
    </div>
    <div class="clone_products mb-4"></div>
    <div class="form-group mb-0">
        <input class="btn d-block mx-auto btn-green add_cogs_submit_form" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function() {
            initValidation();

            function initValidation() {
                $(['#cogs_create_form,#cogs_edit_form']).validate({
                    rules: {
                        "cogs_date": { required: true },
                        "cogs_material_id[]": { required: true },
                        "name[]": { required: true },
                        "description[]": { required: true },
                        "unit_qty[]": { required: true, number: true },
                        "qty_price[]": {
                            required: function(element) {
                                return $(element).closest('.product-item').find('.unit_price_input').is(':visible');
                            },
                            number: true
                        },
                        "job_per_hr[]": {
                            required: function(element) {
                                return $(element).closest('.product-item').find('.job-per-hr-container').is(':visible');
                            },
                            number: true
                        },
                        "total_cost[]": { required: true, number: true }
                    },
                    messages: {
                        "cogs_date": { required: "Please select COGS Date" },
                        "cogs_material_id[]": { required: "Please select COGS Material" },
                        "name[]": { required: "Please enter Name" },
                        "description[]": { required: "Please enter Description" },
                        "unit_qty[]": { required: "Please enter Unit Quantity" },
                        "qty_price[]": { required: "Please enter Unit Price", number: "Please enter a valid number" },
                        "job_per_hr[]": { required: "Please enter Job Per Hour", number: "Please enter a valid number" },
                        "total_cost[]": { required: "Please enter Total Cost", number: "Please enter a valid number" }
                    },
                    errorPlacement: function(error, element) {
                        error.insertAfter(element);
                    },
                });
            }
            // $(document).on('click', '.add-product', function() {
            //     const productItemCount = $('#product-items .product-item').length;
            //
            //     if (productItemCount > 0 && $('.product-item:last').find('.remove-product').is(':visible')) {
            //
            //         var newRow = $('.product-item:first').clone();
            //
            //         newRow.find('input[type="text"], select').val('');
            //         newRow.find('input[type="checkbox"]').prop('checked', false);
            //         newRow.find('.help-block').remove();
            //
            //         newRow.find('input, select').each(function() {
            //             var name = $(this).attr('name');
            //             if (name) {
            //                 var newIndex = productItemCount;
            //                 $(this).attr('name', name.replace(/\[\d+\]/, '[' + newIndex + ']'));
            //             }
            //         });
            //         newRow.find('.add-product').remove();
            //         newRow.find('.remove-product').show();
            //
            //         $('#product-items').append(newRow);
            //     }
            // });
            // $(document).on('click', '.remove-product', function() {
            //     if ($('#product-items .product-item').length > 1) {
            //         $(this).closest('.product-item').remove();
            //     }
            // });
            // $('#cogs_form').on('submit', function(e) {
            //     e.preventDefault();
            //     if ($(this).valid()) {
            //         this.submit();
            //     }
            // });


            $(document).on('click', '.add-product', function () {
                const productItemCount = $('#product-items .product-item').length;

                if (productItemCount > 0 && $('.product-item:last').find('.remove-product').is(':visible')) {
                    var newRow = $('.product-item:first').clone();

                    // Clear values in the cloned row
                    newRow.find('input[type="text"], select').val('');
                    newRow.find('input[type="checkbox"]').prop('checked', false);
                    newRow.find('.help-block, .invalid-feedback').remove(); // Remove old validation messages

                    // Update name attributes with new index
                    newRow.find('input, select').each(function () {
                        var name = $(this).attr('name');
                        if (name) {
                            var newIndex = productItemCount;
                            $(this).attr('name', name.replace(/\[\d+\]/, '[' + newIndex + ']'));
                        }
                    });

                    // Update buttons in the new row
                    newRow.find('.add-product').remove();
                    newRow.find('.remove-product').show();

                    // Append the new row to the container
                    //$('#product-items').append(newRow);
                }
            });

            $(document).on('click', '.remove-product', function () {
                if ($('#product-items .product-item').length > 1) {
                    $(this).closest('.product-item').remove();
                }
            });

            // Form validation on submit
            $('#cogs_form').on('submit', function (e) {
                let isValid = true;

                // Validate each input and select within the product items
                $('#product-items .product-item').each(function () {
                    $(this).find('input, select').each(function () {
                        if (!$(this).val()) {
                            isValid = false;
                            $(this).addClass('is-invalid');
                            if (!$(this).next('.invalid-feedback').length) {
                                $(this).after('<div class="invalid-feedback">This field is required.</div>');
                            }
                        } else {
                            $(this).removeClass('is-invalid');
                            $(this).next('.invalid-feedback').remove();
                        }
                    });
                });

                if (!isValid) {
                    e.preventDefault(); // Prevent form submission
                    console.log('Please fill out all fields before submitting.');
                }
            });

            // Real-time validation to remove errors
            $('#product-items').on('input change', 'input, select', function () {
                if ($(this).val()) {
                    $(this).removeClass('is-invalid');
                    $(this).next('.invalid-feedback').remove();
                }
            });

            // Final form submission
            $('#cogs_form').on('submit', function (e) {
                e.preventDefault();
                if ($(this).valid()) {
                    this.submit(); // Submit if valid
                }
            });






        });

        /*       $(document).ready(function () {

                   $(document).on('click', '.add-product', function() {``
                       var lastIndex = $('#product-items .product-item').length - 1;
                       var newRow = $('.product-item:last').clone();


                       newRow.find('input[type="text"], select').val('');
                       newRow.find('input[type="checkbox"]').prop('checked', false);
                       newRow.find('.help-block').remove();


                       newRow.find('input, select').each(function() {
                           var name = $(this).attr('name');
                           if (name) {

                               $(this).attr('name', name.replace(/\[\d+\]/, '[' + (lastIndex + 1) + ']'));
                           }
                       });

                       $('#product-items').append(newRow);
                       initValidation();
                   });


                   $(document).on('click', '.remove-product', function() {
                       if ($('#product-items .product-item').length > 1) {
                           $(this).closest('.product-item').remove();
                       }
                   });
                   $('#cogs-form').on('submit', function(e) {
                       e.preventDefault();
                       if ($(this).valid()) {
                           this.submit();
                       }
                   });
               });*/

        // $(document).ready(function () {
        //     function calculateTotalPrice() {
        //         var parent = $(this).closest('.product-item');
        //         var unitQty = parseFloat(parent.find('.unit_qty').val()) || 0;
        //         var qtyPrice = parseFloat(parent.find('.qty_price').val()) || 0;
        //         var jobPerHr = parseFloat(parent.find('.job_per_hrr').val()) || 0;
        //         var totalCost = unitQty * qtyPrice;
        //         if (parent.find('.job_per_hrr').is(':visible')) {
        //             totalCost += unitQty * jobPerHr;
        //         }``
        //         parent.find('.total_cost').val(totalCost.toFixed(2));
        //     }
        //     $(document).on('input', '.unit_qty, .qty_price, .job_per_hrr', calculateTotalPrice);
        //     $(document).on('change', '.show-job-per-hr', function () {
        //         var parent = $(this).closest('.product-item');
        //         if (this.checked) {
        //             parent.find('.job-per-hr-container').show();
        //             parent.find('.unit-price-container').hide();
        //             parent.find('.qty_price').val('');
        //             parent.find('.job_per_hrr').prop('required', true);
        //             parent.find('.qty_price').removeAttr('required');
        //         } else {
        //             parent.find('.job-per-hr-container').hide();
        //             parent.find('.unit-price-container').show();
        //             parent.find('.job_per_hrr').val('');
        //             parent.find('.job_per_hrr').removeAttr('required');
        //             parent.find('.qty_price').prop('required', true);
        //         }
        //
        //         calculateTotalPrice.call(this); // Calculate total price when checkbox changes
        //     });
        //
        //     $('.unit-price-container').show();
        //     $('.job-per-hr-container').hide();
        //     $(document).on('change', '.show-job-per-hr', function() {
        //         var parent = $(this).closest('.product-item');
        //         if (this.checked) {
        //             parent.find('.hidden-checkbox').remove();
        //         } else {
        //             parent.append('<input type="hidden" name="show_job_per_hrr[]" value="0" class="hidden-checkbox">');
        //         }
        //     });
        //
        //
        //     $(document).on('click', '.add-product', function() {
        //         var productRowHTML = $('.products_container_first .product-item').html();
        //         var clonedHTML = $('<div class="product-item">' + productRowHTML + '</div>');
        //         clonedHTML.find('.add-product').remove();
        //         $('.clone_products').append(clonedHTML);
        //     });
        //     $(document).on('click', '.remove-product', function() {
        //         $(this).closest('.product-item').remove();
        //     });
        //
        //
        // });
        $(document).ready(function () {
            function calculateTotalPrice() {
                var parent = $(this).closest('.product-item');
                var unitQty = parseFloat(parent.find('.unit_qty').val()) || 0;
                var qtyPrice = parseFloat(parent.find('.qty_price').val()) || 0;
                var jobPerHr = parseFloat(parent.find('.job_per_hrr').val()) || 0;
                var totalCost = unitQty * qtyPrice;
                if (parent.find('.job_per_hrr').is(':visible')) {
                    totalCost += unitQty * jobPerHr;
                }
                parent.find('.total_cost').val(totalCost.toFixed(2));
            }
            $(document).on('input', '.unit_qty, .qty_price, .job_per_hrr', calculateTotalPrice);
            $(document).on('change', '.show-job-per-hr', function () {
                var parent = $(this).closest('.product-item');
                if (this.checked) {
                    parent.find('.job-per-hr-container').show();
                    parent.find('.unit-price-container').hide();
                    parent.find('.qty_price').val('');
                    parent.find('.job_per_hrr').prop('required', true);
                    parent.find('.qty_price').removeAttr('required');
                } else {
                    parent.find('.job-per-hr-container').hide();
                    parent.find('.unit-price-container').show();
                    parent.find('.job_per_hrr').val('');
                    parent.find('.job_per_hrr').removeAttr('required');
                    parent.find('.qty_price').prop('required', true);
                }

                calculateTotalPrice.call(this); // Calculate total price when checkbox changes
            });

            // Handle the Labour dropdown selection
            $(document).on('change', '[name="cogs_material_id[]"]', function() {
                var parent = $(this).closest('.product-item');
                var selectedOptionText = $(this).find('option:selected').text().toLowerCase();

                // Check if the selected option is "Labour"
                if (selectedOptionText === 'labor') {
                    parent.find('.job-per-hr-container').show();
                    parent.find('.unit-price-container').hide();
                    parent.find('.qty_price').val('');
                    parent.find('.job_per_hrr').prop('required', true);
                    parent.find('.qty_price').removeAttr('required');
                } else {
                    parent.find('.job-per-hr-container').hide();
                    parent.find('.unit-price-container').show();
                    parent.find('.job_per_hrr').val('');
                    parent.find('.job_per_hrr').removeAttr('required');
                    parent.find('.qty_price').prop('required', true);
                }

                calculateTotalPrice.call(this);
            });

            // Initial setup: show unit price by default
            $('.unit-price-container').show();
            $('.job-per-hr-container').hide();

            // Handle hidden checkbox for job per hour
            $(document).on('change', '.show-job-per-hr', function() {
                var parent = $(this).closest('.product-item');
                if (this.checked) {
                    parent.find('.hidden-checkbox').remove();
                } else {
                    parent.append('<input type="hidden" name="show_job_per_hrr[]" value="0" class="hidden-checkbox">');
                }
            });

            // Add new product row
            $(document).on('click', '.add-product', function() {
                var productRowHTML = $('.products_container_first > .product-item').html();
                var clonedHTML = $('<div class="product-item">' + productRowHTML + '</div>');
                clonedHTML.find('.add-product').remove();
                $('.clone_products').append(clonedHTML);
            });

            // Remove product row
            $(document).on('click', '.remove-product', function() {
                $(this).closest('.product-item').remove();
            });
        });

        $(document).on('click', '.add_cogs_submit_form', function (e) {
            e.preventDefault();
            if ($('#cogs_create_form').valid()) {
                $('#cogs_create_form').submit();
            } else {
                $('html, body').animate({
                    scrollTop: $(".error:visible:first").offset().top - 100
                }, 500);
            }
        });

    </script>

@endpush
