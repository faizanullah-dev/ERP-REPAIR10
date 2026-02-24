<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Invoice Details</h4>
            <div class="d-flex justify-content-end Task_Details_modal_btn">
                <button type="button" class="close mx-3" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
        </div>
        <div class="modal-body">
            <div class="changeOrderOutr">
                <div class="container-fluid">
                    <div class="white-box">
                        <form action="" class="form-horizontal">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="changeOrderLogo">
                                        <img src="{{asset('website/images/logo.png')}}" alt="logo">
                                    </div>
{{--                                    <span class="d-block">Check payable to:</span>--}}

                                </div>
                                <div class="col-md-4">
                                    @if(auth()->user()->hasRole('user'))
                                    <div class="edit_action_btns hide_print pull-right mt-3">
                                        <button type="button" class="btn action_btn" id="printBtnSingle">
                                            <i class="fa-solid fa-file-zipper"></i> Print
                                        </button>
                                        <button type="button" class="btn action_btn" id="send-invoice-single" data-invoice-id="{{$invoice->id}}">
                                            <i class="fa-solid fa-envelope"></i>Send Email
                                        </button>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-6">
{{--                                    <h2>{{ $invoice->customer_id??"Not Available"  }}</h2>--}}
                                    <div>
                                        <h5>Billing Address:</h5>
                                        <p>{{ $invoice->address??"Not Available"  }}</p>

                                    </div>
                                    <div >
                                        <h5>Contact Information:</h5>
                                        <p>{{ $invoice->getLead->contact_person??"Not Available"  }}</p>
                                        <p>{{ $invoice->getLead->user->email??"Not Available"  }}</p>
                                    </div>
                                    <div>
                                        <table class="tbl_small">
                                            <thead>
                                            <tr>
                                                <th>
                                                    Balance Due
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    {{ $invoice->total_amount??"00" }}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <h2>{{ $invoice->getLead->title??"" }}</h2>
                                    <p>244 A Route 6</p>
                                    <p>Columbia, CT 06237 <i></i></p>
                                    <p>Licenses #: HIC 0628045</p>
                                    <p>Phone #:
                                    @if(isset($invoice->getLead->customer) && $invoice->getLead->customer->customerPhones)
                                        <p class="p-16">
                                        <span>
                                            @forelse($invoice->getLead->customer->customerPhones as $item)
                                                <i class="fa-solid fa-phone"></i> {{ $item->phone ?? "Not Available" }}<br>
                                            @empty
                                                Not Available
                                            @endforelse
                                        </span>
                                        </p>
                                        @endif
                                        </p>
                                        <div class="">
                                            <table class="table table-borderless invoice_order_table">
                                                <tbody>
                                                <tr>
                                                    <td>Invoice Order:</td>
                                                    <td>{{ $invoice->invoice_unique_id??"" }}</td>

                                                  </tr>
                                                <tr>
                                                    <td>Billed On:</td>

                                                    <td>{{ $invoice->created_at->format('m/d/Y') }}</td>
                                                 </tr>

                                                <tr>
                                                    <td>Due Date:</td>
                                                    <td>{{ isset($invoice->due_date) ? \Carbon\Carbon::parse($invoice->due_date)->format('m/d/Y') : '' }}</td>
                                                </tr>

                                                </tbody>
                                            </table>

                                        </div>
                                </div>


                                <div class="col-md-12">
                                    <table class="table" >
                                        <thead>
                                        <tr>
                                            <th>Activity</th>
                                            <th>Category Type</th>
                                            <th>Quantity</th>
                                            <th>Rate</th>
                                            <th class="taxhead" style="display: none">Taxable</th>
                                            <th>Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($invoice->getInvoiceAttachments->count() > 0)
                                            @foreach($invoice->getInvoiceAttachments as $invoiceattachment)
                                                <tr>
                                                    <td>
                                                        <input class="form-control mb-3" name="activity_name[]" type="text" id="activity_name" value="{{ $invoiceattachment->activity_name }}" required  readonly>
                                                    </td>
                                                    <td>
                                                        <input class="form-control mb-3" value="{{ $invoiceattachment->getCategory->name??"" }}"  readonly>
                                                    </td>
                                                    <td>
                                                        <input class="form-control quantity mb-3" name="quantity[]" type="number"
                                                               id="quantity" value="{{ $invoiceattachment->quantity??"" }}"  readonly>
                                                    </td>
                                                    <td>
                                                        <input class="form-control rate mb-3" name="rate[]" type="number" id="rate" value="{{ number_format($invoiceattachment->rate ?? 0, 2) }}" readonly>
                                                    </td>
                                                    <td class="taxForm" style="display: none">
                                                        <input type="checkbox mb-3" name="terms" id="taxForm" checked  readonly>
                                                    </td>
                                                    <td>
                                                        <input class="form-control amount mb-3" name="amount[]" type="text" id="amount" value="{{ $invoiceattachment->amount??"" }}" readonly>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                    <div class="col-md-12">
                                        <span class="d-flex justify-content-end col-md-12">Sub Total: $<span id="subtotal">{{ $invoice->sub_total??"0.00" }}</span></span>
                                        <div class="tax col-md-12">
                                            <span class="d-flex justify-content-end">Tax: $<span id="tax">{{ $invoice->total_tax??"0.00" }}</span></span>
                                            <span class="d-flex justify-content-end">Total: $<span class="total" name="total_amount">{{ $invoice->total_amount??"0.00" }}</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <p>Note:</p>
                                    <span>{{ strip_tags($invoice->description??"") }}</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Email Content Modal -->
<div class="modal fade" id="emailContentModal" tabindex="-1" aria-labelledby="emailContentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="emailContentModalLabel">Email Content</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="emailContentForm">
                    <div class="mb-3">
                        <label for="emailSubject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="emailSubject" value="Invoice" required>
                    </div>
                    <div class="mb-3">
                        <label for="emailMessage" class="form-label">Message</label>
                        <textarea class="form-control" id="emailMessage" rows="5" placeholder="Enter your message here..." required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmSendEmail">Send Email</button>
            </div>
        </div>
    </div>
</div>

<script>
    var selectedInvoiceId = null;

    $(document).on('click', '#send-invoice-single', function (){
        selectedInvoiceId = $(this).data('invoice-id');
        $('#emailContentModal').modal('show');
    });



    $('#emailContentModal').on('hidden.bs.modal', function () {
        $('#emailContentForm')[0].reset();
        $('#confirmSendEmail').prop('disabled', false).text('Send Email');
    });

    @if(auth()->user()->hasRole('user'))
    document.getElementById('printBtnSingle').addEventListener('click', function () {
        // Create a hidden iframe
        var iframe = document.createElement('iframe');
        iframe.style.position = 'absolute';
        iframe.style.width = '0px';
        iframe.style.height = '0px';
        iframe.style.border = 'none';
        iframe.style.visibility = 'hidden';

        document.body.appendChild(iframe);

        // Get iframe document
        var iframeDoc = iframe.contentWindow.document;

        // Get modal content
        var modalElement = document.getElementById('viewInvoiceModal');

        // Clone modal content and remove scripts
        var modalClone = modalElement.cloneNode(true);
        var scripts = modalClone.querySelectorAll('script');
        scripts.forEach(function(script) {
            script.parentNode.removeChild(script);
        });

        // Remove hide_print elements
        var hidePrint = modalClone.querySelectorAll('.hide_print');
        hidePrint.forEach(function(element) {
            element.parentNode.removeChild(element);
        });

        // Work with iframe's existing document structure
        var head = iframeDoc.head;
        var body = iframeDoc.body;

        // Add title
        var title = iframeDoc.createElement('title');
        title.textContent = 'Invoice';
        head.appendChild(title);

        // Add Bootstrap CSS
        var link = iframeDoc.createElement('link');
        link.rel = 'stylesheet';
        link.href = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css';
        head.appendChild(link);

        // Add custom styles
        var style = iframeDoc.createElement('style');
        style.textContent = `
        body { margin: 20px; padding: 20px; }
        .hide_print { display: none !important; }
        .modal { display: block !important; position: static !important; }
        .modal-dialog { margin: 0 !important; max-width: 100% !important; }
    `;
        head.appendChild(style);

        // Add content to body
        body.innerHTML = modalClone.innerHTML;

        // Flag to track if print was already triggered
        var printTriggered = false;

        // Wait for CSS to load then print
        link.onload = function() {
            if (!printTriggered) {
                printTriggered = true;
                setTimeout(function() {
                    iframe.contentWindow.focus();
                    iframe.contentWindow.print();

                    // Clean up
                    setTimeout(function() {
                        if (iframe.parentNode) {
                            document.body.removeChild(iframe);
                        }
                    }, 500);
                }, 300);
            }
        };
    });
    @endif
</script>