<div class="row">
    <div class="col-md-12">
        <div class="invoice_modal_logo">
            <img src="{{asset('website/images/logo.png')}}"  class="img-fluid" alt="logo">
        </div>
    </div>
    <div class="col-md-6">
        <h4>{{$record->title??""}}</h4>
        <p><b>Address:</b> {{$record->address??"Not Available"}}</p>
        <p><b>ZIP Code:</b> {{$record->postal_code??"Not Available"}}</p>
        <p><b>Contact Person:</b> {{$record->contact_person??"Not Available"}}</p>
    </div>
    <div class="col-md-6">
        <h4>Contact Information:</h4>
        <p><b>Customer Name:</b> {{$record->customer->name??""}}</p>
        <p><b>Address:</b> {{$record->customer->profile->address??"Not Available"}}</p>
        <p><b>ZIP Code:</b> {{$record->customer->profile->zip??"Not Available"}}</p>
        <p><b>Phone:</b> {{$record->customer->customerPhonePrimary->phone??"Not Available"}}</p>
    </div>
    <div class="col-md-12">
        <hr>
    </div>
    <div class="row custom_row_gap">
        <div class="col-md-3 custom_space">
            <p><b>Lead No:</b> {{$record->lead_number??""}}</p>
        </div>
        <div class="col-md-3 custom_space">
            <p><b>Lead Starts:</b> {{\Carbon\Carbon::parse($record->lead_status_date)->format('m-d-Y') ?? ""}}</p>
        </div>
        <div class="col-md-3 custom_space">
            <p><b>Lead Price:</b> ${{number_format($record->lead_price, 2)}}</p>
        </div>
    </div>
    <div class="col-md-12">
        <table class="table">
            <thead>
            <tr>
                <th>S#No</th>
                <th>Invoice Number</th>
                <th>Date</th>
                <th>Invoice Amount</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($record->getInvoice as $invoices)
                <tr>
                    <td><input class="form-control" type="text" value="{{$loop->iteration}}" required readonly></td>
                    <td><input class="form-control" type="text" value="{{$invoices->invoice_unique_id??''}}" required readonly></td>
                    <td><input class="form-control" type="text" value="{{\Carbon\Carbon::parse($invoices->due_date)->format('m-d-Y') ?? ''}}" readonly></td>
                    <td><input class="form-control" type="text" value="{{$invoices->total_amount??'0.00'}}" readonly></td>
                    <td><input class="form-control" type="text" value="{{$invoices->status??''}}" readonly></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="col-md-12">
                                            <span class="d-flex justify-content-end col-md-12">Invoice Total: $
                                                <span id="">{{$record->getInvoice->sum(fn($invoice) => floatval($invoice->total_amount))}}</span>
                                            </span>
        </div>
    </div>
</div>