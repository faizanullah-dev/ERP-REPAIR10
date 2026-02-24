<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Email</title>

    <style>
        .white-box {

            padding: 40px 20px 20px 20px;
            box-shadow: 0px 5px 25px #52575d15;
            border-radius: 20px;
            border: none;
            margin: 20px;
        }

        .changeOrderLogo {
            width: 250px;
            height: auto;
        }

        .changeOrderLogo img {
            height: 100%;
            width: 100%;
            object-fit: contain;
            object-position: center;
        }
        .normal_text{
            display: block;
            font-family: 'Open Sans',sans-serif;
            font-weight: 400;
            color: #8d9498;
            line-height: 1.6;
            font-size: 18px;

        }
        table{
            width: 100%;
            border-spacing: 10px;

        }
        table td {
            margin: 12px 12px 12px 12px;
        }

        h2{
            display: block;
            font-family: sans-serif ;
            font-size: 36px ;
            font-weight: 400;
            margin: 10px 0;
            line-height: 36px;
            color: black;
        }
        .input_fields{
            width: 100%;
            font-family: sans-serif ;
            border-radius: 10px;
            background-color: #F8F8F8 ;
            height: 45px;
            transition: all 300ms linear 0s;
            padding-block: 7px;
            color: #565656;
            border: 1px solid #e5ebec;
            display: block;
            font-size: 18px;


        }
        textarea.input_fields{
            height: unset;
        }

        /* select.input_fields{
            height: 61px;
        
        } */
        .inline_element{
            display: inline;
        }
        .signature_showcase {
            width:100%;
            height:200px;
            border: 1px solid #e5ebec;
            border-radius: 10px;


        }
        .signature_showcase img{
            width:100%;
            height:100%;
            margin:0 auto;
            object-fit:contain;
            object-position:center;

        }


    </style>




</head>

<body>


<div class="white-box">


    <form method="POST" action="" accept-charset="UTF-8" class="form-horizontal" enctype="">


        <table>
            <tbody>
            <tr>
                <td colspan="2">
                    <div class="changeOrderLogo">
                        <img src="{{asset('website/images/logo.png')}}" alt="logo">
                    </div>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <span class="normal_text">Check payable to :</span>
                    <h2>{{ $invoice->getLead->title??"" }}</h2>
                    {{--<p id="lead_address normal_text"></p>--}}
                </td>
                <td>
                    <span class="normal_text" >Billed TO:</span>
                    <h2>{{ $invoice->customer_id??"Not Available"  }}</h2>
                    {{--<p id="customer_address normal_text"></p>--}}
                    {{--<p id="city normal_text"></p>--}}
                    {{--<p id="state normal_text"></p>--}}
                    {{--<p id="zip normal_text"></p>--}}
                </td>
            </tr>
            <tr>
                <td>
                    <label for="invocie_unique_id" class="normal_text control-label">Invoice #</label>
                </td>
                <td>
                    <label for="billed_on" class=" normal_text control-label">Billed On</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="form-control input_fields" name="invoice_unique_id" type="text" id="invoice_unique_id" value="{{ $invoice->invoice_unique_id??"" }}" readonly >
                </td>
                <td>
                    <input class="form-control input_fields" name="due_date" type="text" id="billed_on" value="{{ $invoice->created_at->format('d/m/Y')??"" }}" readonly>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="due_date" class=" normal_text control-label">Due Date</label>
                </td>
                <td>
                    <label for="assign_to_lead_id" class=" normal_text control-label">Assign To Lead </label>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="input_fields form-control" name="due_date" type="text" id="due_date" value="{{ isset($invoice->due_date) ? \Carbon\Carbon::parse($invoice->due_date)->format('d/m/Y') : '' }}" readonly>
                </td>
                <td>
                    <select class="form-control input_fields clr_input_fields select2 borderRadius" name="lead_id" id="lead_id" >
                        <option value="" id="" selected>{{ $invoice->getLead->title??"" }}</option>
                        {{--<option value="">title2</option>--}}
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="assign_to_user_id" class=" normal_text control-label">User</label>
                </td>
                <td>
                    <label for="address" class=" normal_text control-label">Billing Address</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="form-control input_fields" name="customer_id" type="text" value="{{ $invoice->getLead->customer->first_name??""}}" id="customer_id" readonly>
                </td>
                <td>
                    <input class="form-control input_fields" placeholder="Enter address" name="address" type="text" value="{{ $invoice->getLead->customer->profile->address??"Not Available"  }}" id="address" readonly>
                </td>
            </tr>

            </tbody>
        </table>



        <table class="table invoice_table" id="myTable">
            <thead>
            <tr>
                <th>Activity</th>
                <th>Category Type</th>
                <th>Quantity</th>
                <th>Rate</th>
                <th class="taxhead" style="display: none">Taxable</th>
                <th colspan="2">Amount</th>
            </tr>
            </thead>
            <tbody>
            @if($invoice->getInvoiceAttachments->count() > 0)
                @foreach($invoice->getInvoiceAttachments  as $invoiceattachment)
                    <tr>
                        <td>
                            <input class="form-control input_fields" name="activity_name[]" type="text" id="activity_name" value="{{ $invoiceattachment->activity_name }}" readonly>
                        </td>
                        <td>
                            <select class="input_fields form-control clr_input_fields select2 borderRadius" name="category_id[]" id="category_id" readonly="">
                                <option value="">{{ $invoiceattachment->getCategory->name??"" }}</option>
                                {{--<option value="">category name</option>--}}
                                {{--<option value="">category name</option>--}}
                            </select>
                        </td>
                        <td>
                            <input class="input_fields form-control quantity" name="quantity[]" type="number" id="quantity" value="{{ $invoiceattachment->quantity??"" }}" readonly>
                        </td>
                        <td>
                            <input class="input_fields form-control rate" name="rate[]" type="number" id="rate"  value="{{ $invoiceattachment->rate??"" }}" readonly>
                        </td>
                        <td class=" taxForm" style="display: none">
                            <input type="checkbox mb-3" name="terms" id="taxForm" checked  readonly>
                        </td>
                        <!-- -------------------------------------------------------------- -->
                        <td>
                            <input class="input_fields form-control amount" name="amount[]" type="text" id="amount" value="{{ $invoiceattachment->amount??"" }}" readonly>
                        </td>

                    </tr>
                @endforeach
            @endif

            </tbody>
        </table>



        <table>
            <tbody>
            <tr>
                <td>


                    {{--<input class=" inline_element " type="checkbox" name="" id="taxCheckbox">--}}
                    {{--<label class="normal_text inline_element">Taxable</label>--}}
                    <span class="d-flex justify-content-end">Tax: $<span id="tax">{{ $invoice->tax??"" }}</span></span>

                </td>
            </tr>
            <tr>
                <td>
                    <span class="normal_text" >Sub Total: $<span id="subtotal">{{ $invoice->sub_total??"" }}</span></span>
                </td>
            </tr>

            <tr>
                <td>
                    @if(isset($invoice) && $invoice->signature_type==='upload_image')
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div class="form-group">
                                    <div id="signatureForm">
                                        <div class="signature_wrpper">
                                            <h3>Customer Signature</h3>
                                            <div class="signature_showcase">
                                                <img src="{{asset('website/' . $invoice->getLead->customer->profile->upload_signature)}}" width="200" height="200"></img>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif(isset($invoice) && $invoice->signature_type==='e_signature')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div id="signatureForm">
                                        <div class="signature_wrpper">
                                            <h3>Customer Signature</h3>
                                            <div class="signature_showcase">
                                                @php
                                                    $image = str_replace('data:image/png;base64,', '', $invoice->signature);
                                                    $image = str_replace(' ', '+', $image);
                                                    $image = $message->embedData(base64_decode($image), 'imagename.png');
                                                @endphp
                                                <img src="{{$image}}" width="400" height="200">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </td>
            </tr>
            </tbody>
        </table>
        <table>
            <tbody>
            <tr>
                <td>

                </td>
            </tr>
            <tr>
                <td>
                    <label for="description" class=" normal_text control-label">Description</label>
                </td>
            </tr>
            <tr>
                <td>
                    <div class=" ">
                        <textarea class="input_fields form-control" rows="8" placeholder="Enter Description" name="description" type="textarea" id="invoicedescription" readonly>{{ strip_tags($invoice->description??"") }}</textarea>
                    </div>
                </td>
            </tr>

            </tbody>
        </table>
    </form>
</div>
</body>

</html>