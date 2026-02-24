<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addCredit">Cumulative Invoices</h5>
            <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> × </button>
        </div>
        <div class="modal-body">
            <div class="acumalative-invoices">
                <div class="container-fluid">
                    <div class="white-box m-0 p-0 shadow-none">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="changeOrderLogo">
                                    <img src="{{asset('/website')}}/images/logo.png" alt="logo">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div>
                                    <h5>Customer Info:</h5>
                                    <p>{{ $lead->customer->name??"" }}</p>
                                    <p>{{ $lead->customer->profile->address??"" }}</p>
{{--                                    <p>Griswold  CT 06351</p>--}}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Job Info:</h5>
                                <p>{{ $lead->title??"" }}</p>
                                <p>{{ $lead->address??"" }}</p>
{{--                                <p>Griswold  CT 06351</p>--}}
                            </div>
                            <div class="col-md-4">
                                <h5>Business Info:</h5>
                                <p>Phone #: <i class="fa-solid fa-phone"></i> {{ auth()->user()->profile->company_phone??"" }} </p>
                                <p>Business: {{ auth()->user()->profile->company_email??"" }} </p>
                                <p>Invoice due day: {{ isset($lead->getRefund->first()->getInvoice->due_date) ? \Carbon\Carbon::parse($lead->getRefund->first()->getInvoice->due_date)->format('d-m-Y') : "Not Available" }}</p>
                            </div>
                            <div class="col-md-12">
                                <div class="edit_action_btns hide_print">
                                    <button type="button" class="btn action_btn" id="printBtnCumulative">
                                        <i class="fa-solid fa-file-zipper"></i> Print
                                    </button>
                                    <button type="button" class="btn action_btn" id="send-cumulative" data-lead-id="{{$lead->id}}">
                                        <i class="fa-solid fa-envelope"></i>Send Email
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Day</th>
                                        <th>Activity</th>
                                        <th>Category Type</th>
                                        <th>Quantity</th>
                                        <th>Rate</th>
                                        <th>Taxable</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($lead->getRefund->isEmpty())
                                        <tr>
                                            <td colspan="7">No Data Found</td>
                                        </tr>
                                    @else
                                        @foreach($lead->getRefund as $value)
                                            @forelse($value->getInvoice->getInvoiceAttachments ?? [] as $item)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($value->getInvoice->due_date)->format('m-d-Y') ?? "" }}</td>
                                                    <td>{{ $item->activity_name ?? "" }}</td>
                                                    <td>{{ $item->category_id ?? "" }}</td>
                                                    <td>{{ $item->quantity ?? "" }}</td>
                                                    <td>{{ number_format($item->rate ?? 0, 2) }}</td>
                                                    <td>{{ $item->tax ?? "" }}</td>
                                                    <td>{{ number_format(($item->amount + $item->tax) ?? 0, 2) }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7">No Data Found</td>
                                                </tr>
                                            @endforelse
                                            <!-- Add the refund rows directly after the invoice attachment rows -->
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($value->date)->format('m-d-Y') }}</td>
                                                <td> - </td>
                                                <td> - </td>
                                                <td> 1 </td>
                                                <td>-{{ number_format((float)($value->amount ?? 0), 2, '.', '') }}</td>
                                                <td> - </td>
                                                <td class="amount"> -{{ number_format((float)($value->amount ?? 0), 2, '.', '') }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                <tr>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                    </tr>
                                    @if($lead->getCredit->isEmpty())
                                        <tr>
                                            <td colspan="7">No Data Found</td>
                                        </tr>
                                    @else
                                        @foreach($lead->getCredit as $value)
                                            @forelse($value->getInvoice->getInvoiceAttachments ?? [] as $item)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($value->getInvoice->due_date)->format('m-d-Y') ?? "" }}</td>
                                                    <td>{{ $item->activity_name ?? "" }}</td>
                                                    <td>{{ $item->category_id ?? "" }}</td>
                                                    <td>{{ $item->quantity ?? "" }}</td>
                                                    <td>{{ number_format($item->rate ?? 0, 2) }}</td>
                                                    <td>{{ $item->tax ?? "" }}</td>
                                                    <td>{{ number_format(($item->amount + $item->tax) ?? 0, 2) }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7">No Data Found</td>
                                                </tr>
                                            @endforelse

                                            <!-- Add the refund rows directly after the invoice attachment rows -->
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($value->date)->format('m-d-Y') }}</td>
                                                <td> - </td>
                                                <td> - </td>
                                                <td> 1 </td>
                                                <td> -{{ $value->amount ?? "" }} </td>
                                                <td> - </td>
                                                <td class="amount"> -{{ $value->amount ?? "" }} </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                                <div class="col-md-12">
                                            <span class="d-flex justify-content-end col-md-12">Project Cost: $
                                                <span id="project_cost">{{ $lead->lead_price + $lead->getChangeOrder()->where('status', 'approved')->sum('total_amount') }}</span>
                                            </span>
                                    <div class="tax col-md-12">
                                                <span class="d-flex justify-content-end">Payments/Credits: $
                                                    <span id="creditPayment"></span>
                                                </span>
{{--                                        <span class="d-flex justify-content-end">Tax: $--}}
{{--                                                    <span id="tax">0</span>--}}
{{--                                                </span>--}}
                                        <span class="d-flex justify-content-end">Amount Due: $
                                                    <span id="amountDue"></span>
                                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    var amounts = $('.amount').text().split(/\s+/);
                    console.log(amounts);
                    var totalAmount = 0;
                    amounts.forEach(function(amount) {
                        if (amount.trim() !== "") {
                            var cleanedAmount = Math.abs(parseFloat(amount));
                            totalAmount += cleanedAmount;
                            console.log('amount add:', cleanedAmount);
                        }
                    });
                    $('#creditPayment').text(totalAmount);
                    var projectCost = parseFloat($('#project_cost').text());
                    var totalPayment = projectCost - totalAmount;
                    $('#amountDue').text(totalPayment.toFixed(2));
                });
            </script>
        </div>
    </div>
</div>

<script>
    document.getElementById('printBtnCumulative').addEventListener('click', function () {
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
        var modalElement = document.getElementById('cumulativeInvoices');

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
        title.textContent = 'Cumulative Invoices';
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

</script>