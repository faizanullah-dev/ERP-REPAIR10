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