@extends('layouts.new-master')
@push('css')
@endpush

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="white-box-header">
                            <h4>Finance</h4>
                        </div>
                        <ul class="nav nav-tabs" id="financeTabs" role="tablist">
                            <li class="active" role="presentation">
                                <a href="#invoices" id="invoices-tab" role="tab" data-toggle="tab" aria-controls="invoices" aria-expanded="true">Invoices</a>
                            </li>
                            <li role="presentation">
                                <a href="#receivables" id="receivables-tab" role="tab" data-toggle="tab" aria-controls="receivables" aria-expanded="false">Receivables</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="financeTabsContent">
                            <div class="tab-pane fade in active" id="invoices" role="tabpanel" aria-labelledby="invoices-tab">
                                <div class="table-responsive">
                                    <table class="table table-striped dataTable">
                                        <thead>
                                        <tr>
                                            <th>Invoice Number</th>
                                            <th>Job Name</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Created By</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($invoices as $invoice)
                                            <tr>
                                                <td>{{$invoice->invoice_unique_id??''}}</td>
                                                <td>{{$invoice->getJob->name??''}}</td>
                                                <td>${{ number_format($invoice->total ?? 0, 2) }}</td>
                                                <td class="status">
                                                    <div class="dropdown ">
                                                        @if($invoice->status == 'pending' && $invoice->created_by != auth()->user()->id)
                                                            <button class="btn dropdown-toggle" type="button" id="statusDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <span class="
                                                                    @if($invoice->status == 'pending')
                                                                        text-warning
                                                                    @endif
                                                                        ">
                                                                    {{ ucfirst($invoice->status) }}
                                                                </span>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="statusDropdown">
                                                                <a class="dropdown-item text-success" href="javascript:void(0);" onclick="confirmPaymentAction('{{ url('change_invoice_status/' . $invoice->id . '/approved') }}','You are approving this transaction. Do you want to continue?', '{{ $invoice->id }}', '{{ $invoice->total }}', 'approved','{{ $invoice->lead_id }}','{{$invoice->job_id}}')">Approved</a>
                                                                <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="confirmPaymentAction('{{ url('subContractorReceiveable/sub-contractor-receiveable/' . $invoice->id . '/rejected') }}','Are you sure you want to reject this invoice? Once rejected, no further changes can be made.', '{{ $invoice->id }}','{{ $invoice->total }}','rejected',{{ $invoice->lead_id }},'{{$invoice->job_id}}')">Rejected</a>
                                                            </div>
                                                        @else
                                                            <button class="btn" type="button" >
                                                                <span class="
                                                                     @if($invoice->status == 'approved')
                                                                      text-success
                                                                     @elseif($invoice->status == 'rejected')
                                                                      text-danger
                                                                     @elseif($invoice->status == 'pending')
                                                                      text-warning
                                                                     @endif
                                                                ">
                                                                 {{ ucfirst($invoice->status) }}
                                                                </span>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>{{$invoice->created_at->format('m-d-Y')}}</td>
                                                <td>@if($invoice->creator->hasRole('user')) MJT Roofing LLC @else {{$invoice->getSubContractor->subContractorCompany->name??''}} @endif </td>
                                                <td class="btn_td">
                                                    <button type="button" class="btn btn_primary view_subcontractor_invoice" data-invoice-id="{{$invoice->id}}" data-bs-toggle="modal">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="receivables" role="tabpanel" aria-labelledby="receivables-tab">
                                <div class="table-responsive">
                                    <table class="table table-striped dataTable">
                                        <thead>
                                        <tr>
                                            <th>Invoice Number</th>
                                            <th>Job Name</th>
                                            <th>Price</th>
                                            <th>Remaining Amount</th>
                                            <th>Date</th>
                                            <th>Payment Type</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($receivable->flatMap->receivables as $invoice)
                                            <tr>
                                                <td>{{ $invoice->getInvoice->invoice_unique_id ?? '' }}</td>
                                                <td>{{ $invoice->getJob->name ?? '' }}</td>
                                                <td>${{ number_format($invoice->amount ?? 0, 2) }}</td>
                                                <td>${{ number_format($invoice->remaining_balance, 2)??'' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($invoice->date ?? '')->format('m-d-Y') ?? '' }}</td>
                                                <td>{{ $invoice->getPaymentType->name??'' }}</td>
                                                <td class="btn_td">
                                                    <button type="button" class="btn btn_primary view_subcontractor_invoice" data-invoice-id="{{$invoice->getInvoice->id??''}}" data-bs-toggle="modal">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="createInvoiceModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Invoice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-remove"></i></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{url('subContractorInvoice/sub-contractor-invoice')}}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="subcontractor_id" value="{{$subcontractor->id}}">
                        <input type="hidden" name="bill_from" value="{{$subcontractor->id}}">
                        <input type="hidden" name="address" value="244 Rut 6 Columbia CT 06237">
                        <input type="hidden" name="sub_total" id="subTotalInput" value="0">
                        <input type="hidden" name="tax_total" id="taxAmountInput" value="0">
                        <input type="hidden" name="total_amount" id="totalAmountInput" value="0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Bill To</label>
                                    <select name="bill_to" class="form-control custom_modal_select2" readonly="">
                                        <option value="MJT ROOFING LLC">MJT ROOFING LLC</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Lead</label>
                                    <select name="lead_id" id="subcontractor_lead_id" class="form-control custom_modal_select2" required>
                                        <option value="">Select Lead</option>
                                        @foreach($jobLeads as $lead)
                                            <option value="{{$lead->lead_id}}" data-subcontractor-id="{{$subcontractor->id}}">{{$lead->getLead->title??''}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Job/Task</label>
                                    <select name="job_id" id="subcontractor_job_id" class="form-control custom_modal_select2" required>
                                        <option value="">Select Job</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table class="table ">
                                    <thead>
                                    <tr>
                                        <th>Tax</th>
                                        <th>Product Name</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="productRows">
                                    <tr class="product-row">
                                        <td class="text-center align-middle">
                                            <input type="checkbox" class="row-tax">
                                        </td>
                                        <td>
                                            <input type="text" name="products[]" class="form-control product-name" required placeholder="Product Name">
                                        </td>
                                        <td>
                                            <input type="number" name="quantities[]" class="form-control quantity" min="1" required placeholder="Qty">
                                        </td>
                                        <td>
                                            <input type="number" name="unit_prices[]" class="form-control unit-price" min="0" placeholder="Rate">
                                        </td>
                                        <td>
                                            <input type="hidden" name="row_taxes[]" class="row-tax-amount" value="0">
                                            <input type="number" name="amounts[]" class="form-control amount" readonly placeholder="Total">
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn_primary btn-sm add-product-row">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-end fw-bold">Sub Total:</td>
                                        <td><span id="subTotalText">$0.00</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="text-end fw-bold">Tax:</td>
                                        <td><span id="taxAmountText">$0.00</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="text-end fw-bold">Total:</td>
                                        <td><span id="totalAmountText">$0.00</span></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn_primary submit_center_btn">Create</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div id="createReceivablesModal" class="modal fade" role="dialog" >
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Add Receive Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-remove"></i></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{url('create_receive')}}"  accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" id="receive_remaining">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Job *</label>
                                    <select class="form-control custom_modal_select2" name="job_id" id="jobs"  required>
                                        @foreach($jobLeads as $job)
                                            <option value="{{$job->id}}" >{{$job->name??''}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Payment Type *</label>
                                    <select class="form-control custom_modal_select2" name="payment_type"  required>
                                        @foreach($paymenttypes as $payment)
                                            <option value="{{$payment->id}}">{{$payment->name??''}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date *</label>
                                    <input class="form-control" name="date" type="date"  value="" required>
                                </div>
                            </div>
{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>Amount *</label>--}}
{{--                                    <input class="form-control" name="amount" type="number" id="receive_amount" step="0.01" min="0" value="" required placeholder="Enter amount">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Invoice *</label>
                                    <div class="invoice_wrapper">
                                        <div class="row">
                                        </div>
                                    </div>
{{--                                    <select class="form-control select2" name="invoice_id" id="job_invoices"  required>--}}
{{--                                        <option selected disabled>--Select Invoice-- </option>--}}
{{--                                    </select>--}}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn_primary submit_center_btn">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="invoice_details"></div>
    <div id="confirmPaymentModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content shadow-lg rounded-3">
                <!-- Modal Header -->
                <div class="modal-header bg-gradient-primary text-white">
                    <h5 class="modal-title fw-bold">Confirm Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-remove"></i></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form method="POST" action="{{ url('subContractorReceiveable/sub-contractor-receiveable') }}" accept-charset="UTF-8"
                          class="form-horizontal" id="confirm_payment_form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="lead_id" id="lead_id" >
                        <input type="hidden" name="job_id" id="receive_job_id" >
                        <input type="hidden" name="invoice_id" id="receive_invoice_id">
                        <input type="hidden" name="amount" id="invoice_amount">
                        <input type="hidden" name="status" id="invoice_status">

                        {{--                        <input type="hidden" name="date" id="current_date">--}}
                        <div class="form-group">
                            <label for="payment_type" class="control-label">{{ 'Payment Type' }} *</label>
                            <select class="select2-receive form-control  custom_modal_select2" name="payment_type" id="payment_type" required>
                                <option value="" selected disabled>Select Payment Type</option>
                                @foreach($paymenttypes as $paymenttype)
                                    <option value="{{$paymenttype->id}}" @if(isset($receivepayment) && $paymenttype->id == $receivepayment->payment_type) selected @endif>{{ $paymenttype->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">{{ 'Date' }} *</label>
                            <input type="date" name="date" class="form-control" value="{{ $yearEstimation->year . '-01-01' ?? '' }}"  required>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn_primary submit_center_btn  confirm_payment_form">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            var taxRate = 0;
            $(document).on('change', '#subcontractor_lead_id', function () {
                var leadId = $(this).val();
                var subcontractorId = $(this).find('option:selected').data('subcontractor-id');

                if (leadId) {
                    $.ajax({
                        url: '{{url("get_lead_job")}}',
                        type: 'GET',
                        data: {
                            lead_id: leadId,
                            subcontractor_id: subcontractorId
                        },
                        success: function (response) {
                            console.log('Response:', response);
                            if (response.lead && typeof response.lead.tax !== 'undefined') {
                                taxRate = parseFloat(response.lead.tax) || 0;
                            }
                            console.log('lead taxRate' , taxRate)

                            var $jobSelect = $('#subcontractor_job_id');
                            $jobSelect.empty().append('<option value="">Select Job</option>');

                            if (response.task && response.task.length) {
                                $.each(response.task, function (key, job) {
                                    $jobSelect.append('<option value="' + job.id + '">' + job.name + '</option>');
                                });
                            } else {
                                console.log('No jobs found');
                            }

                            calculateTotals();
                            $('#subcontractor_job_id').trigger('change');

                        }
                    });
                } else {
                    $('#subcontractor_job_id').empty().append('<option value="">Select Job</option>');
                    taxRate = 0;
                    calculateTotals();
                }
            });

            function calculateAmount(row) {
                const qty = parseFloat(row.find('.quantity').val()) || 0;
                const price = parseFloat(row.find('.unit-price').val()) || 0;
                const amount = qty * price;
                row.find('.amount').val(amount.toFixed(2));
            }

            function calculateTotals() {
                let subTotal = 0,
                    taxTotal = 0;

                $('#productRows .product-row').each(function () {
                    const row = $(this);
                    const amount = parseFloat(row.find('.amount').val()) || 0;
                    const taxApplied = row.find('.row-tax').is(':checked');
                    let rowTax = 0;
                    subTotal += amount;

                    if (taxApplied) {
                        rowTax = (amount * taxRate / 100);
                        taxTotal += rowTax;
                    }

                    row.find('.row-tax-amount').val(rowTax.toFixed(2));
                });

                const total = subTotal + taxTotal;

                $('#subTotalText').text(`$${subTotal.toFixed(2)}`);
                $('#taxAmountText').text(`$${taxTotal.toFixed(2)}`);
                $('#totalAmountText').text(`$${total.toFixed(2)}`);

                // update hidden inputs
                $('#subTotalInput').val(subTotal.toFixed(2));
                $('#taxAmountInput').val(taxTotal.toFixed(2));
                $('#totalAmountInput').val(total.toFixed(2));
            }

            $('#productRows').on('input', '.quantity, .unit-price', function () {
                const row = $(this).closest('.product-row');
                calculateAmount(row);
                calculateTotals();
            });

            $('#productRows').on('change', '.row-tax', function () {
                calculateTotals();
            });

            $('#productRows').on('click', '.add-product-row', function () {
                const newRow = `
        <tr class="product-row">
            <td class="text-center align-middle">
                <input type="checkbox" class="row-tax">
            </td>
            <td>
                <input type="text" name="products[]" class="form-control product-name" required placeholder="Product Name">
            </td>
            <td>
                <input type="number" name="quantities[]" class="form-control quantity" min="1" required placeholder="Qty">
            </td>
            <td>
                <input type="number" name="unit_prices[]" class="form-control unit-price" min="0" placeholder="Price">
            </td>
            <td>
                 <input type="hidden" name="row_taxes[]" class="row-tax-amount" value="0">
                <input type="number" name="amounts[]" class="form-control amount" readonly placeholder="Amount">
            </td>
            <td class="text-center">
                <button type="button" class="btn btn_primary btn-sm remove-row">
                    <i class="fa fa-minus"></i>
                </button>
            </td>
        </tr>`;
                $('#productRows').append(newRow);
            });

            $('#productRows').on('click', '.remove-row', function () {
                $(this).closest('tr').remove();
                calculateTotals();
            });

            calculateTotals();
        });
        $(document).on('click', '.view_subcontractor_invoice', function(){
            var id = $(this).data('invoice-id');
            $.ajax({
                url: '{{ url("get_subcontractor_invoice") }}',
                method: 'GET',
                data: {
                    id: id
                },
                success: function(response) {
                    $('#invoice_details').html(response);
                    $('#viewInvoiceModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
        function confirmPaymentAction(url, message, invoiceId, amount, actionType, leadId, jobId) {
            Swal.fire({
                title: 'Are you sure?',
                text: message,
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log('Action Type:', actionType); // Debugging action type
                    $('#receive_invoice_id').val(invoiceId);
                    $('#invoice_amount').val(amount);
                    $('#lead_id').val(leadId);
                    $('#receive_job_id').val(jobId);
                    $('#invoice_status').val(actionType);
                    const today = new Date();
                    const formattedDate = today.toISOString().split('T')[0];
                    $('#current_date').val(formattedDate);

                    if (actionType === 'approved') {
                        console.log('Opening modal...');
                        $('#confirmPaymentModal').modal('show');
                    }
                    else if (actionType === 'rejected') {

                        $.ajax({
                            url: '{{ url("subContractorReceiveable/sub-contractor-receiveable") }}',
                            method: 'POST',
                            data: {
                                status: actionType,
                                invoice_id: invoiceId,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Status Updated',
                                    confirmButtonText: 'OK',
                                    showConfirmButton: true
                                }).then(() => {
                                    location.reload();
                                });

                            },
                            error: function(xhr, status, error) {
                                console.error('Error:', error);
                            }
                        });
                    }
                    else {
                        console.log('Redirecting to:', url);
                        window.location.href = url;
                    }
                }
            });
        }
        $(window).on('load', function () {
            $('#invoices .dataTables_filter').append(`
        <button type="button" class="btn btn_primary" data-toggle="modal" data-target="#createInvoiceModal">
            Create Invoice <i class="fa-solid fa-plus"></i>
        </button>
    `);
            $('#receivables .dataTables_filter').append(`
        <button type="button" class="btn btn_primary" data-toggle="modal" data-target="#createReceivablesModal">
            Create Receivables <i class="fa-solid fa-plus"></i>
        </button>
    `);
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#jobs').change(function() {
                var jobId = $(this).val();
                $.ajax({
                    url: '{{url("get_job_invoices")}}',
                    type: 'GET',
                    data: { job_id: jobId },
                    success: function(response) {
                        console.log('Invoices:', response);
                        $('.invoice_wrapper .row').empty();
                        // $.each(response, function(key, invoice) {
                        //     if(invoice.status !== 'rejected') {
                        //         $('.invoice_wrapper').append('<option value="'+invoice.id+'">'+invoice.invoice_unique_id+' - $'+invoice.total+'</option>');
                        //     }
                        // });

                        // Check if the response contains any invoices
                        if (response.length === 0 || !response.some(invoice => invoice.status !== 'rejected')) {
                            // No invoices available or all invoices are rejected
                            $('.invoice_wrapper').append('<div class="col-12"><p>No invoices available.</p></div>');
                        } else {
                            // Loop through the response and append the invoices
                            $.each(response, function(key, invoice) {
                                if (invoice.status !== 'rejected') {
                                    var formattedDate = new Date(invoice.created_at).toLocaleDateString('en-GB'); // Format as 'd-m-Y'

                                    var invoiceHTML = `
                            <div class="col-md-3">
                                <div class="invoice_container">
                                    <div class="invoice_container_top">
                                        <input type="checkbox" class="order-checkbox" id="order-${ invoice.id }" data-order-id="${ invoice.id }" value="">
                                        <label for="order-${ invoice.id }" class="pdf_icon">
                                            <div>
                                                <i class="fas fa-file-invoice"></i>
                                                <span>Invoice ${ key + 1 }</span>
                                            </div>
                                            <div>
                                                <h6> Date: ${ formattedDate }</h6>
                                                <h6> Total Amount: ${ invoice.total ?? '0' }</h6>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="invoice_container_bottom" style="display: none">
                                        <div class="form-group">
                                            <label>Remaining Amount</label>
                                            <input type="number" class="form-control amount_to_pay" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Enter Amount</label>
                                            <input type="hidden" class="payment_order_id" name="" value="${invoice.id}">
                                            <input type="number" class="form-control paid_amount" name="" min="0" step="0.01" value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Balance Amount</label>
                                            <input type="number" class="form-control unpaid_amount" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                                    $('.invoice_wrapper .row').append(invoiceHTML);
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }).trigger('change');

            $('#job_invoices').change(function() {
                var invoiceId = $(this).val();
                if(!invoiceId || invoiceId === '--Select Invoice--') return;

                $.ajax({
                    url: '{{url("get_job_receive")}}',
                    type: 'GET',
                    data: {invoice_id: invoiceId},
                    success: function(response) {
                        if(response.total){
                            $('#receive_remaining').val(response.total);
                        }
                        else{
                            $('#receive_remaining').val(response.remaining_balance);
                        }
                    },
                    error: function(xhr) {
                        console.error('Error loading invoice details');
                    }
                });
            });
            $(document).on('input', '#receive_amount', function (){
                var remaining = parseFloat($('#receive_remaining').val());
                var amount = parseFloat($(this).val());
                if(amount > remaining) {
                    $(this).val('');
                    Swal.fire('Error', 'Amount can\'t be greater than remaining', 'error');
                }
            });
            $(document).on('change', '.order-checkbox', function() {
                var This = $(this);
                var accordionContent = This.closest('.invoice_container').find('.invoice_container_bottom');
                var id = This.data('order-id');

                $.ajax({
                    url: '{{url("get_job_receive")}}',
                    type: 'GET',
                    data: { invoice_id: id },
                    success: function(response) {
                        var amountToPay = response.total ? response.total : response.remaining_balance;

                        if (This.is(':checked')) {
                            accordionContent.slideDown();
                            accordionContent.find('.amount_to_pay').val(amountToPay);
                            accordionContent.find('.paid_amount').prop('required', true);
                            accordionContent.find('.payment_order_id').attr('name', 'invoice_id[]');
                            accordionContent.find('.paid_amount').attr('name', 'amount[]');
                            This.closest('.invoice_container').addClass('open');
                        } else {
                            accordionContent.slideUp();
                            accordionContent.find('.amount_to_pay').val('');
                            accordionContent.find('.paid_amount').val('');
                            accordionContent.find('.unpaid_amount').val('');
                            accordionContent.find('.paid_amount').prop('required', false);
                            accordionContent.find('.payment_order_id').removeAttr('name');
                            accordionContent.find('.paid_amount').removeAttr('name');
                            This.closest('.invoice_container').removeClass('open');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
            $(document).on('input', '.paid_amount', function() {
                var accordionContent = $(this).closest('.invoice_container_bottom');
                var amountToPay = parseFloat(accordionContent.find('.amount_to_pay').val()) || 0;
                var paidAmount = parseFloat($(this).val()) || 0;
                if (paidAmount > amountToPay) {
                    $(this).val(amountToPay.toFixed(2));
                    paidAmount = amountToPay;
                }
                if (paidAmount < 0) {
                    $(this).val('0.00');
                    paidAmount = 0;
                }
                var unpaidAmount = amountToPay - paidAmount;
                accordionContent.find('.unpaid_amount').val(unpaidAmount.toFixed(2));
            });


        });
    </script>
@endpush
