@extends('layouts.master')

@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet"
          type="text/css"/>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <div class="table-header">
                        <div class="back-button-container">
                            <a href="{{ url('view_lead') }}/{{$leadExist->id}}" class="btn blue_btn"><i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                        </div>
                       <div class="table-header-leftbox">
                           <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Material') }}</h3>
                           <h5>Lead Name: {{$leadExist->title??''}}</h5>
                       </div>
                        {{--<button type="button" class="btn btn-success pull-right" data-bs-toggle="modal" data-bs-target="#addMaterialModal">Add Product</button>--}}
                        <div class="table-header-rightbox">
                            @php
                                $totalPriceSum = 0;
                                foreach ($groupedMaterials as $materialData) {
                                    $totalPriceSum += $materialData['price'] ?? 0;
                                }
                            @endphp
                            <div class="form-group">
                                <select class="form-select select2" data-placeholder="Change Template" aria-label="Default select example" id="templateSelect" name="">
                                    <option value="" selected disabled>Change Template</option>
                                    @foreach($templateCategories as $template)
                                        <option value="{{$template->id}}" @if($template->id == $leadExist->product_template) selected @endif>{{$template->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <h6>Total Price: {{ number_format($totalPriceSum, 2) }}</h6>
                            </div>
                            <button type="button" class="btn btn-success pull-right" id="compareBtn">Compare</button>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table append_td material_listing_tbl" id="">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Material</th>
                                <th>Delivery Date</th>
                                <th>Delivered</th>
                                <th>Added</th>
                                <th>Left Over</th>
                                <th>Used</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>


                            @foreach($defaultProducts->where('status', 1) as $key => $item)
                                @if(!in_array($item->id, $listedMaterialIds))
                                    <tr>
                                    <td class="indexing_td"></td>
                                    <td class="product_price" data-material-id="{{ $item->id ?? '' }}" data-product-price="{{ $item['price'] }}">
                                        {{ $item['sub_category'] ?? 'N/A' }}
                                    </td>
                                    <td> {{ \Carbon\Carbon::parse($item->getMaterialData->delivery_date ?? '')->format('m-d-Y') ?? 'Not Available' }}</td>
                                    <td><input type="number" data-status="delivered" data-lead-id="{{ $leadExist->id }}" class="form-control" placeholder="0"></td>
                                    <td><input type="number" data-status="added" data-lead-id="{{ $leadExist->id }}" class="form-control" placeholder="0"></td>
                                    <td><input type="number" data-status="leftover" data-lead-id="{{ $leadExist->id }}" class="form-control left-over" placeholder="0"></td>
                                    <td class="used_material"></td>
                                    <td class="total_price"></td>
                                    <td><button type="button" class="btn btn-danger delete_lead_material"><i class="fa fa-minus"></i></button></td>
                                </tr>
                                @endif
                            @endforeach


                            @if(isset($groupedMaterials))
                            @foreach($groupedMaterials as $materialId => $materialData)
                                <tr>
                                    <td class="indexing_td"></td>
                                    <td>{{ $materialData['material']->sub_category ?? "Not Available" }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($materialData['delivery_date'] ?? '')->format('m-d-Y') ?? 'Not Available' }}
                                    </td>
                                    <td><input type="number" data-status="delivered" data-lead-id="{{ $materialData['lead'] }}" data-material-id="{{ $materialData['material']->id ??""}}" data-unit-price="{{ $materialData['material']->price ??""}}" value="{{ $materialData['delivered'] }}" class="form-control" placeholder="0"></td>
                                    <td><input type="number" data-status="added" data-lead-id="{{ $materialData['lead'] }}" data-material-id="{{ $materialData['material']->id ??""}}" data-unit-price="{{ $materialData['material']->price ??""}}" value="{{ $materialData['added'] }}" class="form-control" placeholder="0"></td>
                                    <td><input type="number" data-status="leftover" data-lead-id="{{ $materialData['lead'] }}" data-material-id="{{ $materialData['material']->id ??""}}" data-unit-price="{{ $materialData['material']->price ??""}}" value="{{ $materialData['leftover'] }}" class="form-control left-over" placeholder="0"></td>
                                    <td class="used_material">{{ $materialData['used'] }}</td>
                                    <td class="total_price">{{ number_format($materialData['price'], 2) }}</td>
                                    <td><button type="button" class="btn btn-danger delete_lead_material" data-lead-id="{{ $materialData['lead'] }}" data-material-id="{{ $materialData['material']->id??'' }}"><i class="fa fa-minus"></i></button></td>
                                </tr>
                            @endforeach
                            @endif

                            </tbody>
                        </table>
                        {{--                        <div class="pagination-wrapper"> {!! $category->appends(['search' => Request::get('search')])->render() !!} </div>--}}
                    </div>
                    <button type="button" class="btn add_btn_td btn-green mt-2 border-0"> Add<i class="fa fa-plus"></i></button>
                </div>
            </div>
        </div>
    </div>

    {{--    <div id="addMaterialModal" class="main_modal modal aligned_modal" role="dialog" >--}}
    {{--        <div class="modal-dialog modal-dialog-centered">--}}
    {{--            <div class="modal-content">--}}
    {{--                <div class="modal-header">--}}
    {{--                    <h5 class="modal-title" id="">Add Material</h5>--}}
    {{--                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> × </button>--}}
    {{--                </div>--}}
    {{--                <div class="modal-body">--}}
    {{--                    <form method="POST" action="{{url('/materialListing/material-listing')}}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="material-form">--}}
    {{--                        {{ csrf_field() }}--}}
    {{--                        <div class="row">--}}
    {{--                            <div class="col-md-12">--}}
    {{--                                <div class="form-group">--}}
    {{--                                    <label for="customer-name" class="form-label input_labels p-18">Select Lead*</label>--}}
    {{--                                    <select class="form-control clr_input_fields borderRadius select2 select_product_and_lead" name="lead_id">--}}
    {{--                                        <option value="" selected>None</option>--}}
    {{--                                        @if(!empty($leadExist))--}}
    {{--                                            @foreach($leads as $lead)--}}
    {{--                                                <option value="{{$lead->id}}" @if(isset($leadExist) && $lead->id == $leadExist->id) selected @endif>{{$lead->title}}</option>--}}
    {{--                                            @endforeach--}}
    {{--                                        @else--}}
    {{--                                            @foreach($leads as $lead)--}}
    {{--                                                <option value="{{$lead->id}}" @if(isset($invoice)  && $lead->id == $invoice->lead_id) selected @endif >{{$lead->title}}</option>--}}
    {{--                                            @endforeach--}}
    {{--                                        @endif--}}
    {{--                                        <option>Other</option>--}}
    {{--                                    </select>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                            <div class="col-md-12">--}}
    {{--                                <div class="form-group">--}}
    {{--                                    <label for="customer-name" class="form-label input_labels p-18">Select Product*</label>--}}
    {{--                                    <select class="form-control clr_input_fields borderRadius select2 select_product_and_lead" name="material_id" id="lead_material-select">--}}
    {{--                                        <option value="" selected>None</option>--}}
    {{--                                        @foreach($products as $product)--}}
    {{--                                            <option value="{{ $product->id }}">{{ $product->sub_category??"" }}</option>--}}
    {{--                                        @endforeach--}}
    {{--                                        <option value="other">Other</option>--}}
    {{--                                    </select>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                            --}}{{--                            Hidden Fields--}}
    {{--                            <div class="col-md-12" id="other-material-fields" style="display: none;">--}}
    {{--                                <div class="col-md-12">--}}
    {{--                                    <div class="form-group">--}}
    {{--                                        <label for="customer-name" class="form-label input_labels p-18">Select Product Category*</label>--}}
    {{--                                        <select class="form-control borderRadius" name="product_category_id" id="lead_material-select">--}}
    {{--                                            <option value="" selected>None</option>--}}
    {{--                                            @foreach($productCategories as $productCategory)--}}
    {{--                                                <option value="{{ $productCategory->id }}">{{ $productCategory->name??"" }}</option>--}}
    {{--                                            @endforeach--}}
    {{--                                            <option value="other">Other</option>--}}
    {{--                                        </select>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="form-group">--}}
    {{--                                    <label for="material-name" class="form-label input_labels p-18">Material Name*</label>--}}
    {{--                                    <input type="text" class="form-control borderRadius" name="material_name" id="lead_material-name">--}}
    {{--                                </div>--}}
    {{--                                <div id="material_error"></div>--}}
    {{--                                <div class="form-group">--}}
    {{--                                    <label for="material-price" class="form-label input_labels p-18">Material Price*</label>--}}
    {{--                                    <input type="number" step="0.01" class="form-control borderRadius" name="material_price" id="lead_material-price">--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                            --}}{{--                            Hidden Fields--}}
    {{--                            <div class="col-md-12">--}}
    {{--                                <div class="form-group">--}}
    {{--                                    <label for="quantity" class="form-label input_labels">Quantity <span class="text-danger">*</span></label>--}}
    {{--                                    <input type="text" name="quantity" class="form-control" placeholder="Enter Quantity" id="quantity" required>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                            <div class="col-md-12">--}}
    {{--                                <div class="form-group">--}}
    {{--                                    <label for="customer-name" class="form-label input_labels p-18">Status</label>--}}
    {{--                                    <select class="form-control clr_input_fields borderRadius select2" name="status">--}}
    {{--                                        <option value="" selected>None</option>--}}
    {{--                                        <option value="added">Added</option>--}}
    {{--                                        <option value="delivered">Delivered</option>--}}
    {{--                                        <option value="leftover">Leftover</option>--}}
    {{--                                    </select>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                            --}}{{--<div class="col-md-6">--}}
    {{--                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cancel </button>--}}
    {{--                            </div>--}}
    {{--                            <div class="col-md-12">--}}
    {{--                                <div class="d-flex justify-content-center">--}}
    {{--                                    <button class="btn btn-green material_submit_btn" type="submit"> Submit </button>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </form>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <!-- Comparison Container -->
    <div id="comparison-container" class="white-box" style="width: 0;height: 0;opacity: 0;  transition: width 0.5s ease; ">
        <button id="closeComparison" style="position: relative; width: 35px; height: 35px; color: white; border-radius: 50%; background-color: var(--green_74C911); opacity: 1; margin-bottom: 10px; border: none; font-size: 20px; float: right;">&times;</button>
        <div id="comparison-content-box" class="comparison-container-box"></div>
        </div>


@endsection

@push('js')
    <script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>
    <script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
    <script>
        $(document).ready(function () {

            $('.select_modals_global_initialize').select2({
                placeholder: function() {
                    return $(this).data('placeholder');
                },
                allowClear: true,
            });

            $(document).on('click', '.add_btn_td', function() {
                let count = $('.append_td tbody > :last-child > :first-child').text();
                count = parseInt(count) + 1;
                var newRow = `
                    <tr>
                        <td class="sorting_1"> `+count+` </td>
                        <td>
                            <select class="form-control  borderRadius select2 select_product_and_lead" name="material_id" id="lead_material-select">
                                <option value="" selected>None</option>
                                @foreach($products as $product)
                <option value="{{ $product->id }}" data-unit-price="{{ $product->price }}" data-material-id="{{ $product->id }}">{{ $product->sub_category ?? "" }}</option>
                                @endforeach
                </select>
                </td>
                <td></td>
                <td><input type="number" data-status="delivered" name="status" class="form-control" placeholder="0" data-material-id="{{ $product->id??'' }}" data-lead-id="{{ $leadExist->id }}" disabled></td>
                        <td><input type="number" data-status="added" name="status" class="form-control" placeholder="0" data-material-id="{{ $product->id??'' }}" data-lead-id="{{ $leadExist->id }}" disabled></td>
                        <td><input type="number" data-status="leftover" name="status" class="form-control" placeholder="0" data-material-id="{{ $product->id??'' }}" data-lead-id="{{ $leadExist->id }}" disabled></td>
                        <td class="used_material">0</td>
                        <td class="total_price">0.00</td>
                        <td><button type="button" class="btn btn-danger remove_material"><i class="fa fa-minus"></i></button>
                        </td>
                    </tr>
                `;
                $('.material_listing_tbl tbody').append(newRow);
                $('.material_listing_tbl tbody tr:last .select2').select2({
                    width: '100%'
                });
            });
            $('.material_listing_tbl').on('change', '.select_product_and_lead', function () {
                var selectedVal = $(this).val();
                var $row = $(this).closest('tr');
                if (selectedVal) {
                    $row.find('input[data-status]').prop('disabled', false);
                } else {
                    $row.find('input[data-status]').prop('disabled', true);
                }
            });
            $(document).on('click', '.remove_material', function () {
                var audio = new Audio('{{ asset('website/images/noti.mp3') }}');
                audio.addEventListener('ended', function () {
                    audio.remove();
                });
                audio.play().catch(function(error) {
                    console.error('Audio playback failed:', error);
                });
                $(this).closest('tr').remove();
            });

            // Loop through each row and assign the index
            $('.append_td tbody tr').each(function(index) {
                $(this).find('.indexing_td').text(index + 1); // Add row index (starting from 1)
            });
        });

        $(document).ready(function () {

            @if(\Session::has('message'))
            $.toast({
                heading: 'Success!',
                position: 'top-center',
                text: '{{session()->get('message')}}',
                loaderBg: '#ff6849',
                icon: 'success',
                hideAfter: 3000,
                stack: 6
            });
            @endif
            $('.delete_lead_material').on('click', function(){
                var material_id = $(this).attr('data-material-id');
                var lead_id = $(this).attr('data-lead-id');
                function showConfirmationDialog() {
                    Swal.fire({
                        title: 'Are You Sure You Want To Delete The Material?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('delete_material_list') }}",
                                type: 'GET',
                                data: {
                                    'lead_id': lead_id,
                                    'material_id': material_id,
                                },
                                success: function (result) {
                                    if (result.success) {
                                        $(this).closest('tr').remove();
                                        location.reload();
                                        Swal.fire('Deleted!', 'Material has been deleted.', 'success')
                                            .then(function() {
                                                setTimeout(function() {
                                                    location.reload();
                                                }, 100);
                                            });
                                    } else {
                                        Swal.fire('Error!', 'Lead Email deletion failed.', 'error');
                                    }
                                },
                                error: function (e) {
                                    console.log(e.status);
                                }
                            });
                        }
                    });
                }
                showConfirmationDialog();
            });
            $(document).ready(function() {
                function debounce(func, wait) {
                    let timeout;
                    return function() {
                        const context = this;
                        const args = arguments;
                        clearTimeout(timeout);
                        timeout = setTimeout(() => func.apply(context, args), wait);
                    };
                }
                function handleKeyup() {
                    var row = $(this).closest('tr');
                    var delivered = parseFloat(row.find('input[data-status="delivered"]').val()) || 0;
                    var added = parseFloat(row.find('input[data-status="added"]').val()) || 0;
                    var leftover = parseFloat(row.find('input[data-status="leftover"]').val()) || 0;
                    var used = (delivered + added - leftover);
                    row.find('.used_material').text(used);
                    var selectedOption = row.find('select').find(":selected");
                    var unitPrice = $(this).data('unit-price') || parseFloat(selectedOption.data('unit-price')) || row.find('.product_price').attr('data-product-price')|| 0;
                    var price = used * unitPrice;
                    row.find('.total_price').text(price.toFixed(2));
                    var status = $(this).data('status');
                    var leadId = $(this).data('lead-id');
                    var value = $(this).val();
                    // if($(this).closest('tr').find('select').val()!=undefined){
                    //     var materialId = $(this).closest('tr').find('select').val();
                    // }else{
                    //     var materialId = $(this).data('material-id');
                    // }
                    if ($(this).closest('tr').find('select').val() != undefined && $(this).closest('tr').find('select').val() != "") {
                        var materialId = $(this).closest('tr').find('select').val();
                    } else if ($(this).closest('tr').find('.product_price').attr('data-material-id') != undefined) {
                        var materialId = $(this).closest('tr').find('.product_price').attr('data-material-id');
                    } else {
                        var materialId = $(this).data('material-id');
                    }

                    showLoadingSwal();
                    $.ajax({
                        url: "{{ route('update_material_list') }}",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            lead_id: leadId,
                            material_id: materialId,
                            status: status,
                            value: value
                        },
                        success: function(response) {
                            if (response.success) {
                                hideLoadingSwal();
                                console.log('Material values updated successfully');
                            } else {
                                console.log('Failed to update material values');
                            }
                        },
                        error: function(e) {
                            console.log('Error:', e.status);
                        }
                    });
                }
                $(document).on('keyup', 'input[type="number"]', debounce(function() {
                    handleKeyup.call(this);
                }, 200));
            });

        })
        $(function () {
            $('#myTable').DataTable({
                'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': [-1] /* 1st one, start by the right */
                }]
            });

        });
        function confirmAndDisable(link) {
            event.preventDefault();
            if (link.classList.contains('disabled')) {
                return false; // Link is already disabled
            }
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to change the status!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change it!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    link.classList.add('disabled'); // Disable the link
                    window.location = link.href;
                }
            });
        }
        $(document).ready(function() {
            $('#lead_material-select').change(function() {
                if ($(this).val() === 'other') {
                    $('#other-material-fields').show();
                    $('#lead_material-name, #lead_material-price')
                        .prop('required', true)
                        .prop('disabled', false); // Enable fields
                } else {
                    $('#other-material-fields').hide();
                    $('#lead_material-name, #lead_material-price')
                        .prop('required', false)
                        .prop('disabled', true)
                        .val('');
                }
            }).trigger('change');
            // $(document).on('input', '.form-control', function () {
            //     var row = $(this).closest('tr');
            //     var delivered = parseFloat(row.find('input[data-status="delivered"]').val()) || 0;
            //     var added = parseFloat(row.find('input[data-status="added"]').val()) || 0;
            //     var leftover = parseFloat(row.find('input[data-status="leftover"]').val()) || 0;
            //     if (leftover > (added + delivered)) {
            //         alert("Leftover cannot be greater than the sum of added and delivered.");
            //         row.find('input[data-status="leftover"]').val(added + delivered);
            //     }
            // });
            $(document).on('input', '.form-control', function () {
                // For the current row, get the values of delivered, added, and leftover
                var row = $(this).closest('tr'); // Find the row this input belongs to
                var delivered = parseFloat(row.find('input[data-status="delivered"]').val()) || 0;
                var added = parseFloat(row.find('input[data-status="added"]').val()) || 0;
                var leftover = parseFloat(row.find('input[data-status="leftover"]').val()) || 0;
                var errorMessage = row.find('.error-message');

                // Check if leftover is greater than the sum of added and delivered
                if (leftover > (added + delivered)) {
                    // Display the error message below the leftover input field if not already displayed
                    if (errorMessage.length === 0) {
                        row.find('input[data-status="leftover"]').after('<div class="error-message" style="color: red; font-size: 12px;">Leftover cannot be greater than the sum of added and delivered.</div>');
                    }
                    // Optionally reset the leftover field to match the sum of added and delivered
                    row.find('input[data-status="leftover"]').val(added + delivered);
                } else {
                    // If the validation is passed, remove the error message (if it exists)
                    errorMessage.remove();
                }
            });
        });
    </script>
    <!-- Comparison Button -->
    <script>
        // Function to get the current page's ID (from the URL)
        function getUrlId() {
            var currentUrl = window.location.href;  // Get the current URL
            var regex = /\/material_listing\/(\d+)/;  // Regular expression to extract the ID
            var match = currentUrl.match(regex);  // Match the ID from the URL

            return match ? match[1] : null;  // Return the ID if found, or null if not
        }

        // // When the Compare button is clicked
        // document.getElementById('compareBtn').addEventListener('click', function() {
        //     var id = getUrlId();  // Get the ID from the current URL
        //     if (id) {
        //         // Set the second iframe URL for the comparison
        //         document.getElementById('comparisonFrame').src = 'https://leadup.thebackendprojects.com/product_pricing_calculator_screen/' + id + '/6/material_list';
        //
        //         // Show the comparison container (right side)
        //         document.getElementById('comparison-container').style.display = 'block';
        //     } else {
        //         alert('ID not found in the current URL.');
        //     }
        // });
        //
        // // Close the comparison iframe when the close button is clicked
        // document.getElementById('closeComparison').addEventListener('click', function() {
        //     document.getElementById('comparison-container').style.display = 'none';
        // });
            $('#compareBtn').click(function () {
                var id = getUrlId();
                var productID = {{ $leadProduct ?? 'null' }};
                if (!productID || !id) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Product Not Found',
                        text: 'Please add a product first.',
                    });
                    return;
                }
                $.ajax({
                    url: '/product_pricing_calculator_screen/' + id + '/' + productID + '/material_list',
                    type: 'GET',
                    success: function (response) {
                        if (response && response.error) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Error',
                                text: response.error,
                            });
                        } else {
                            const tableContent = $(response).find('table');
                            $('#comparison-content-box').html(tableContent);
                            $('#comparison-content-box').css('pointer-events', 'none');
                            $('#comparison-content-box .table').removeClass('table-bordered');
                            $('#comparison-container').css({
                                width: '50%',
                                height: 'auto',
                                opacity: 1,
                                transition: 'width 0.5s ease, opacity 0.5s ease'
                            });
                            $('#sidebar').css({
                                width: '0',
                                minWidth: 0,
                                padding: '0',
                                transition: '0.5s ease'
                            });
                            $('.page-wrapper').css({
                                margin: '0',
                                display: 'flex',
                                transition: '0.5s ease'
                            });
                            $('.page-wrapper .container-fluid').css({
                                width: '50%',
                                margin: '0',
                                transition: '0.5s ease'
                            });
                            $('.top_navbar').css({
                                width: '0',
                                height: '0',
                                padding: '0',
                                transition: '0.5s ease'
                            });
                            $('html, body').scrollTop(0);
                            $('#compareBtn').hide();
                        }
                    },
                    error: function () {
                        $('#comparison-content-box').html('<p>Failed to load material list table.</p>');
                        $('#comparison-container').css('width', '50%');
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Please add product calculator.',
                        });
                    }
                });
            });
            $('#closeComparison').click(function () {
                $('#comparison-container').css({
                    width: '0',
                    height: '0',
                    opacity: 0,
                    transition: 'width 0.5s ease, opacity 0.5s ease'
                });

                $('#comparison-content-box').css('pointer-events', 'none');

                $('#sidebar').css({
                    width: '',
                    minWidth: '',
                    padding: '',
                    transition: '0.5s ease'
                });

                $('.page-wrapper').css({
                    margin: '',
                    display: '',
                    transition: '0.5s ease'
        });

                $('.page-wrapper .container-fluid').css({
                    width: '100%',
                    margin: '',
                    transition: '0.5s ease'
                });

                $('.top_navbar').css({
                    width: '',
                    height: '',
                    padding: '',
                    transition: '0.5s ease'
                });

                $('#compareBtn').show();
            });
    </script>

    <script>
    $(document).ready(function() {
        $('#templateSelect').change(function() {
            var newTemplateId = $(this).val();
            var leadId = {{ $leadExist->id }};

            if (newTemplateId) {
                // Show SweetAlert2 confirmation with three buttons
                Swal.fire({
                    title: 'Are you sure you want to change the template?',
                    text: "If you select 'Yes', the products will also be deleted.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    showDenyButton: true,
                    denyButtonText: 'Keep Existing Added Products',
                    focusConfirm: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        // "Yes" button clicked
                        $.ajax({
                            url: '{{ url("update_lead_template") }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                lead_id: leadId,
                                template_id: newTemplateId,
                                action: 'yes' // Action for "Yes"
                            },
                            // beforeSend: function() {
                            //     $('#loading').show().css('opacity','1');
                            //     $('body').addClass('preload');
                            // },
                            success: function(response) {
                                window.location.reload();
                            },
                            // complete: function() {
                            //     $('#loading').hide();
                            //     $('body').removeClass('preload');
                            // },
                            error: function(xhr) {
                                alert('Error updating template');
                                console.error(xhr.responseText);
                            }
                        });
                    } else if (result.isDenied) {
                        // "Keep Products In New Template" button clicked
                        $.ajax({
                            url: '{{ url("update_lead_template") }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                lead_id: leadId,
                                template_id: newTemplateId,
                                action: 'keep' // Action for "Keep Products In New Template"
                            },
                            beforeSend: function() {
                                $('#loading').show().css('opacity','1');
                                $('body').addClass('preload');
                            },
                            success: function(response) {
                                window.location.reload();
                            },
                            complete: function() {
                                $('#loading').hide();
                                $('body').removeClass('preload');
                            },
                            error: function(xhr) {
                                alert('Error updating template');
                                console.error(xhr.responseText);
                            }
                        });
                    } else {
                        // "No" button clicked, do nothing
                        window.location.reload();
                    }
                });
            }
        });
    });
</script>
@endpush
