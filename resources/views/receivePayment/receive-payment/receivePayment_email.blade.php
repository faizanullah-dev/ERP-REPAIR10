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
                    <h2>{{ $receive_payment->getLead->title??"" }}</h2>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="invocie_unique_id" class="normal_text control-label">Payment Type</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="form-control input_fields" type="text"  value="{{ $receive_payment->getPaymenttype->name??"" }}" readonly >
                </td>
            </tr>
            <tr>
                <td>
                    <label for="invocie_unique_id" class="normal_text control-label">Reference Number #</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="form-control input_fields" type="text" value="{{ $receive_payment->Reference_number??"" }}" readonly >
                </td>
            </tr>
            <tr>
                <td>
                    <label for="due_date" class=" normal_text control-label">Date</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="input_fields form-control" type="text" value="{{ isset($receive_payment->date) ? \Carbon\Carbon::parse($receive_payment->date)->format('d/m/Y') : '' }}" readonly>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="due_date" class=" normal_text control-label">Amount</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="input_fields form-control" type="text" value="{{ isset($receive_payment->amount) ? ($receive_payment->amount) : '0.00' }}" readonly>
                </td>
            </tr>
            </tbody>
        </table>
        <table>
            <tbody>
            </tbody>
        </table>
    </form>
</div>
</body>
</html>