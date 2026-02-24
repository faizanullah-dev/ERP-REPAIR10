<div class="modal-dialog modal-lg modal-dialog-centered edit_cogs_modal">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit COGS</h4>
            <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> × </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ url('/costOfGoodSold/cost-of-good-sold/' . $costofgoodsold->id) }}" accept-charset="UTF-8" class="form-horizontal edit_cogs_form" enctype="multipart/form-data" novalidate>
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <div class="date_field">
                    <div class="form-group select_date">
                        <label for="" class="control-label">Date</label>
                        <input class="form-control" type="date" name="cogs_date" value="{{ $costofgoodsold->cogs_date ?? $yearEstimation->year. '-01-01' }}">
                    </div>
                </div>
                <div class="products_container">
                    @foreach($costofgoodsold->cogsSheetsDetails as $index => $costofgoodsoldProduct)
                        <div class="product-item edit-product-item" data-index="{{ $index }}">
                            <div class="form-group custom_cogs_chk_wrapper">
                                <label class="custom_cogs_chk_label">Job Per Hour</label>
                                <input class="edit-show-job-per-hr" type="checkbox" name="" value="1" {{ $costofgoodsoldProduct->job_per_hr ? 'checked' : '' }}>
                                <input type="hidden" class="edit-hidden-checkbox" name="show_job_per_hr[{{$index}}]" value="{{ $costofgoodsoldProduct->job_per_hr ? '1' : '0' }}">
                            </div>
                            <div class="form-group {{ $errors->has('cogs_material_id') ? 'has-error' : ''}}">
                                <label for="cogs_material_id" class="control-label">{{ 'COGS Material' }}</label>
                                <select class="form-control" name="cogs_material_id[]" id="cogs_material_id" required>
                                    @foreach($cogs_materials as $key => $value)
                                        <option value="{{$value->id}}" @if($costofgoodsoldProduct->cogs_material_id == $value->id) selected @endif>{{$value->name??''}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                <label for="name" class="control-label">{{ 'Name' }}<span class="text-danger">*</span></label>
                                <input class="form-control" name="name[]" type="text" id="name" placeholder="Type Name Here" required value="{{ $costofgoodsoldProduct->name??''}}">
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                <label for="description" class="control-label">{{ 'Description' }}</label>
                                <input class="form-control" name="description[]" type="text" id="description" placeholder="Type Description Here" value="{{ $costofgoodsoldProduct->description??''}}">
                                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('unit_qty') ? 'has-error' : ''}}">
                                <label for="unit_qty" class="control-label">{{ 'Unit Qty' }}<span class="text-danger">*</span></label>
                                <input class="form-control unit_qty" name="unit_qty[]" type="number" id="unit_qty" placeholder="Type Unit Quantity Here" required value="{{ $costofgoodsoldProduct->unit_qty??''}}">
                                {!! $errors->first('unit_qty', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('qty_price') ? 'has-error' : ''}} unit-price-container" style="display: none;">
                                <label for="qty_price" class="control-label">{{ 'Unit Price' }}</label>
                                <input class="form-control qty_price" name="qty_price[]" type="number" step="0.01" id="qty_price" placeholder="Type Unit Price Here" required value="{{ $costofgoodsoldProduct->qty_price??''}}">
                                {!! $errors->first('qty_price', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('job_per_hr') ? 'has-error' : ''}} job-per-hr-container" style="display: none;">
                                <label for="job_per_hr" class="control-label">{{ 'Job Per Hr' }}</label>
                                <input class="form-control job_per_hrr" name="job_per_hr[]" type="number" id="job_per_hr" placeholder="Type Job Per Hour Here" value="{{ $costofgoodsoldProduct->job_per_hr??''}}">
                                {!! $errors->first('job_per_hr', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('total_cost') ? 'has-error' : ''}}">
                                <label for="total_cost" class="control-label">{{ 'Total Cost' }}<span class="text-danger">*</span></label>
                                <input class="form-control total_cost" name="total_cost[]" type="text" id="total_cost" placeholder="Type Total Cost Here" required value="{{ $costofgoodsoldProduct->total_cost??''}}" readonly>
                                {!! $errors->first('total_cost', '<p class="help-block">:message</p>') !!}
                            </div>
                            {{--<div class="form-group extra_btn">--}}
                            {{--<button type="button" class="btn btn-success edit-product">+</button>--}}
                            {{--<button type="button" class="btn btn-danger edit-remove-product">-</button>--}}
                            {{--</div>--}}
                            <div class="form-group extra_btn add_cogs_modal_btn">
                                <button type="button" class="btn btn-green edit-product">
                                    <i class="btn btn-sm fa fa-plus" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btn btn-danger edit-remove-product">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                    <div class="clone_products"></div>
                </div>
                <div class="form-group mb-0">
                    <div class="d-flex justify-content-center">
                        <input class="btn btn-green edit_cogs_submit_btn" type="submit" value="Update">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        function calculateTotalPrice() {
            var parent = $(this).closest('.edit-product-item');
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

        $(document).on('change', '.edit-show-job-per-hr', function () {
            var parent = $(this).closest('.edit-product-item');
            var hiddenCheckbox = parent.find('.edit-hidden-checkbox');
            if (this.checked) {
                parent.find('.job-per-hr-container').show();
                parent.find('.unit-price-container').hide();
                parent.find('.qty_price').val('');
                parent.find('.job_per_hrr').prop('required', true);
                parent.find('.qty_price').removeAttr('required');
                hiddenCheckbox.val('1');
            } else {
                parent.find('.job-per-hr-container').hide();
                parent.find('.unit-price-container').show();
                parent.find('.job_per_hrr').val('');
                parent.find('.qty_price').prop('required', true);
                parent.find('.job_per_hrr').removeAttr('required');
                hiddenCheckbox.val('0');
            }

            calculateTotalPrice.call(this);
        });

        // Set the initial state based on the hidden checkbox values
        $('.edit-product-item').each(function () {
            var parent = $(this);
            var hiddenCheckboxValue = parent.find('.edit-hidden-checkbox').val();
            if (hiddenCheckboxValue === '1') {
                parent.find('.edit-show-job-per-hr').prop('checked', true).trigger('change');
            } else {
                parent.find('.edit-show-job-per-hr').prop('checked', false).trigger('change');
            }
        });



        // $(document).on('click', '.edit-product', function () {
        //     var form = $(this).closest('form');
        //     var productContainer = form.find('.products_container');
        //     var productRowHTML = productContainer.find('.edit-product-item').first().clone();
        //     var newIndex = productContainer.find('.edit-product-item').length;
        //
        //     productRowHTML.attr('data-index', newIndex);
        //
        //     productRowHTML.find('input, select').each(function () {
        //         var element = $(this);
        //         var name = element.attr('name');
        //         if (name) {
        //             var newName = name.replace(/\[\d+\]/, '[' + newIndex + ']');
        //             element.attr('name', newName);
        //         }
        //         var id = element.attr('id');
        //         if (id) {
        //             var newId = id.replace(/\d+/, newIndex);
        //             element.attr('id', newId);
        //         }
        //     });
        //
        //     productRowHTML.find('.edit-hidden-checkbox').val('0');
        //     productRowHTML.find('input').not(':checkbox').val('');
        //     productRowHTML.find('input[type="checkbox"]').prop('checked', false);
        //
        //     productContainer.append(productRowHTML);
        // });


        $(document).on('click', '.edit-remove-product', function () {
            $(this).closest('.product-item').remove();
        });
    });

    $(document).on('click', '.edit_cogs_submit_btn', function (e) {
        e.preventDefault();
        if ($('.edit_cogs_form').valid()) {
            $('.edit_cogs_form').submit();
        } else {
            $('html, body').animate({
                scrollTop: $(".error:visible:first").offset().top - 100
            }, 500);
        }
    });
</script>
