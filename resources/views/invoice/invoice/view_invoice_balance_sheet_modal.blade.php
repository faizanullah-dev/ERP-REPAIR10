<div class="modal-dialog modal-lg modal-dialog-centered invoice_modal_box">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" >Invoice Balance Sheet</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="invoice_modal_logo">
                        <img src="{{asset('website/images/logo.png')}}"  class="img-fluid" alt="logo">
                    </div>
                </div>
                <div class="col-md-6">
                    <h4>{{ $leads->title??"" }}</h4>
                    <p> <b>Address: </b> {{  $leads->address??"" }} <i></i></p>
                    <p> <b>Contact Person: </b>  {{  $leads->contact_person??"not available" }} </p>
                </div>
                <div class="col-md-6">
                    <h4>Contact Information:</h4>
                    <p> <b>Customer Address: </b> {{ $leads->customer->name ?? "Not Available" }}  </p>
                    <p> <b>Address: </b>  {{ $leads->customer->profile->address??"Not Available"}} </p>
                    <p> <b>City: </b>  {{ $leads->customer->profile->city??"Not Available"   }}    </p>
                    <p> <b>State: </b>  {{ $leads->customer->profile->state??"Not Available"  }}   </p>
                    <p> <b>Country: </b>  {{ $leads->customer->profile->country??"Not Available"}} </p>
{{--                    <p> <b>Phone: </b>  {{ $leads->customer->profile->phone??"Not Available"  }}   </p>--}}
                    <p> <b>Phone: </b>
                        @forelse($leads->customer->customerPhones as $item)
                           {{ $item->phone ?? "Not Available" }}<br>
                        @empty
                            Not Available
                        @endforelse
                    </p>
                </div>
                <div class="col-md-12">
                    <hr>
                </div>
                <div class="col-md-3">
                    <p> <b> Lead No: </b> {{ $leads->lead_number ?? '' }}</p>
                </div>
                <div class="col-md-3">
                    <p> <b>Lead Starts :</b> {{ $leads->lead_date ? \Carbon\Carbon::parse($leads->lead_date)->format('m-d-Y') : '' }}</p>

                </div>
                <div class="col-md-3">
                    <p> <b>Lead Price :</b> ${{ $leads->lead_price + $leads->getChangeOrder->where('status', 'approved')->sum('total_amount') ??''}}</p>
                </div>
                <div class="col-md-3">
                    <div class="edit_action_btns hide_print">
                        <button type="button" class="btn action_btn" id="printBtnBalanceSheet">
                            <i class="fa-solid fa-file-zipper"></i> Print
                        </button>
                        <button type="button" class="btn action_btn" id="send-balance-sheet" data-lead-id="{{$leads->id}}">
                            <i class="fa-solid fa-envelope"></i>Send Email
                        </button>
                    </div>
                </div>
{{--                <div class="col-md-3">--}}
{{--                    <p> <b>Net Profit: :</b> $</p>--}}
{{--                </div>--}}
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                        <tr>
                        <th>S#No</th>
                        <th>Invoice Number</th>
                        <th>Date</th>
                        <th>Taxable</th>
                        <th>Invoice Amount</th>
                        <th>Remaining Balance</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if(isset($leads) && !empty($leads))
                            @php
                                $lead_price = $leads->lead_price + $leads->getChangeOrder->where('status', 'approved')->sum('total_amount')?? 0;
                                $remaining_balance = $lead_price;
                            @endphp
                            @foreach($leads->getReceivePayments as $detail)
                                @php
                                    $remaining_balance -= $detail->amount ?? 0;
                                @endphp
                                <tr>
                                    <td>
                                        <input class="form-control" name="" type="text" value="{{ $loop->iteration }}" required readonly>
                                    <td>
                                        @if($detail->invoice_id != null )
                                            <input class="form-control" name="" type="text"  value="{{ $detail->invoice->invoice_unique_id??'' }}" required readonly>
                                        @else
                                            <input class="form-control" type="text" value="{{ $detail->reference_number??'' }}" required readonly>
                                        @endif
                                    </td>
                                    <td>
                                        @if($detail->invoice_id != null && $detail->date)
                                            <input class="form-control" name="due_date[]" type="text" value="{{ \Carbon\Carbon::parse($detail->date)->format('m-d-Y') }}" readonly>
                                        @elseif($detail->invoice && $detail->invoice->due_date)
                                            <input class="form-control" name="due_date[]" type="text" value="{{ \Carbon\Carbon::parse($detail->invoice->due_date)->format('m-d-Y') }}" readonly>
                                        @else
                                            <input class="form-control" name="due_date[]" type="text" value="00-00-0000" readonly>
                                        @endif


                                    </td>
                                    <td>
{{--                                        @if($detail->tax)--}}
                                        <input class="form-control" name="tax[]" type="text" value="{{ $detail->invoice->total_tax ?? '0.00' }}" readonly>
{{--                                        @else--}}
{{--                                        <input class="form-control" name="tax[]" type="text" value="0" readonly>--}}
{{--                                        @endif--}}
                                    </td>
                                    <td>
                                        <input class="form-control quantity" name="quantity[]" type="text" value="{{ number_format($detail->amount ?? 0, 2, '.', '') }}" readonly>
                                    </td>
                                    <td>
                                        <input class="form-control amount" name="remaining_balance[]" type="number" value="{{ $remaining_balance }}" readonly>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                @if(isset($leads) && $leads->customer->profile->signature_type === 'signature_file')
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <div id="signatureForm">
                                <div class="signature_wrpper">
                                    <h3>Customer Signature</h3>
                                    <div class="signature_showcase">
                                        <img src="{{asset('website/' . $leads->customer->profile->upload_signature)}}" width="200" height="200"></img>
                                    </div>
                                    <div class="text-end">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif(isset($leads) && $leads->customer->profile->signature_type === 'signature_pad')
                    <div class="col-md-12">
                        <div id="signatureForm">
                            <div class="signature_wrpper">
                                <h3>Customer Signature</h3>
                                <div class="signature_showcase">
                                    <img src="{{$leads->customer->profile->upload_signature}}" width="400" height="200"></img>
                                </div>
                                <div class="text-end">
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('printBtnBalanceSheet').addEventListener('click', function () {
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
        var modalElement = document.getElementById('viewInvoiceBalanceSheetModal');

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
        title.textContent = 'Balance Sheet';
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