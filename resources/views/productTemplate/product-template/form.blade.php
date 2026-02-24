<div class="white-box">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                <label for="name" class="col-md-4 control-label">{{ 'Template Name' }}</label>
                <input class="form-control" name="name" type="text" id="name" value="{{ $producttemplate->name??''}}" placeholder="Enter Template Name" required>
                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('categories') ? 'has-error' : ''}}">
                <label for="categories" class="col-md-4 control-label">{{ 'Categories' }}</label>
                <select id="productCategory" class="form-control select2" name="default_category[]" multiple="multiple" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if(isset($producttemplate) && in_array($category->id, json_decode($producttemplate->categories, true))) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>

<div class="product_template_container">
    <div class="row">
        <div class="col-md-6">
            <div class="white-box selected_products">
                <h3>Selected Products</h3>
                <div class="table-responsive scroll_tobdy_fixed_class">
                    <table class="table" id="">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Product Name</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        @if(isset($producttemplate))
                            @foreach($producttemplate->templateProducts->sortBy('sort_index') as $selected)
                                <tr class="ui-sortable-handle">
                                    <td>
                                        <input type="hidden" name="product_id[]" value="{{$selected->product_id}}">
                                        <span><i class="fa-solid fa-bars"></i></span>
                                    </td>
                                    <td>{{$selected->getProduct->sub_category??''}}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm remove_row"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="white-box custom_products">
                <h3>Products</h3>
                <div class="table-responsive scroll_tobdy_fixed_class">
                    <table class="table" id="myTable">
                        <thead>
                        <tr>
                            <th>
                                <input class="form-check-input" type="checkbox" id="select_all_tbl_row" value="">
                            </th>
                            <th>Product Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td><input class="form-check-input user-checkbox" type="checkbox" @if(isset($selectedProductIds) && in_array($product->id, $selectedProductIds)) checked @endif id="select_checkbox_{{$product->id}}" value="{{$product->id}}"></td>
                                <td>{{$product->sub_category}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="create_template_btn">
    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>


@push('js')
    <script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

    <script>
        $(document).ready(function (){
            $(function () {
                $('#myTable').DataTable({
                    'paging': false,
                    'lengthChange': false,
                    'info': false,
                    'aoColumnDefs': [{
                        'bSortable': false,
                        'aTargets': [-1] /* 1st one, start by the right */
                    }]
                });

            });
            $('#productCategory').select2({
                placeholder: "Select categories",
                allowClear: true
            });

            // Check if dropdown is empty
            if ($('#productCategory option').length === 0) {
                $('#productCategory').prop('disabled', true);
                Swal.fire({
                    icon: 'warning',
                    title: 'No Categories Available',
                    text: 'No active categories found. Please add categories first.',
                    confirmButtonText: 'OK'
                });
            }
        })
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize Sortable on the table body with ID "sortable"
            new Sortable(document.getElementById('sortable'), {
                animation: 150, // Smooth animation on drag
                handle: '.ui-sortable-handle', // Restrict dragging to the handle icon
                onEnd: function (evt) {
                    // Collect sorted row IDs and their new positions
                    let sortedIds = Array.from(document.querySelectorAll('#sortable tr')).map((row, index) => ({
                        id: row.dataset.id // New position (starting from 1)
                    }));
                }
            });
        });

        $(document).ready(function () {
            // Select All checkbox
            const $selectAllCheckbox = $('#select_all_tbl_row');
            const $checkboxes = $('.custom_products #myTable .form-check-input[type="checkbox"]');

            // Handle Select All checkbox
            $selectAllCheckbox.change(function() {
                const checkedStatus = this.checked;
                $checkboxes.prop('checked', checkedStatus); // Check or uncheck all checkboxes

                if (checkedStatus) {
                    // If Select All is checked, add all rows to the second table
                    $('.custom_products #myTable tbody tr').each(function() {
                        const $row = $(this);
                        // Ensure that the row contains a non-empty product name before appending
                        const productName = $row.find('td:eq(1)').text().trim();
                        if (productName !== "" && !$row.data('appended')) {
                            addToSelectedProducts($row); // Add each row to the second table
                            $row.data('appended', true); // Mark this row as appended
                        }
                    });
                } else {
                    // If Select All is unchecked, remove all rows from the second table
                    $('.selected_products #sortable').empty();
                    $checkboxes.prop('checked', false); // Uncheck all checkboxes
                }
            });

            // Handle individual checkbox selection
            $checkboxes.change(function() {
                const $row = $(this).closest('tr');
                if (this.checked) {
                    addToSelectedProducts($row);
                } else {
                    removeFromSelectedProducts($row);
                }

                // Check if all individual checkboxes are checked, update Select All checkbox
                const allChecked = $checkboxes.filter(':checked').length === $checkboxes.length;
                $selectAllCheckbox.prop('checked', allChecked);
            });

            // Add selected row to the second table
            function addToSelectedProducts($row) {
                const $productName = $row.find('td:eq(1)').text().trim(); // Get product name text and trim extra spaces
                const $productId = $row.find('input').val(); // Get product name text and trim extra spaces
                console.log($productId);
                // Ensure that empty rows are not appended
                if ($productName === "") return;

                const $newRow = $('<tr class="ui-sortable-handle">')
                    .append('<td><input type="hidden" name="product_id[]" value="' + $productId + '"> <span><i class="fa-solid fa-bars"></i></span></td>') // Add bars icon
                    .append('<td>' + $productName + '</td>') // Add product name
                    .append('<td><button type="button" class="btn btn-danger btn-sm remove_row"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>'); // Add delete button

                // Mark this row as appended
                $newRow.data('appended', true);

                // Attach delete functionality
                $newRow.find('.remove_row').on('click', function(e) {
                    e.preventDefault();
                    removeFromSelectedProducts($row);
                });

                // Append row to the second table
                $('.selected_products #sortable').append($newRow);
            }

            // Remove selected row from the second table
            function removeFromSelectedProducts($row) {
                const productName = $row.find('td:eq(1)').text().trim(); // Get the product name
                // Find the row with the same product name and remove it from the second table
                $('.selected_products #sortable tr').each(function() {
                    if ($(this).find('td:eq(1)').text().trim() === productName) {
                        $(this).remove();
                        $row.data('appended', false); // Mark the row as removed
                        $row.find('input[type="checkbox"]').prop('checked', false); // Uncheck the related checkbox in the first table
                    }
                });
            }

            $(document).on('click', '.remove_row', function(e) {
                e.preventDefault();  // Prevent the default action
                const $row = $(this).closest('tr');  // Get the row that contains the clicked delete button
                removeFromSelectedProducts($row);   // Remove the row from the second table
            });
        });

    </script>

@endpush
