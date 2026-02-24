@extends('layouts.master')
@push('css')
    <style>
        input[type="number"] {
            -moz-appearance: textfield; /* Firefox */
            -webkit-appearance: none; /* Chrome, Safari, Edge */
            appearance: none; /* Standard */
        }
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0; /* Optional to ensure no spacing */
        }

    </style>

@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <form method="POST" action="{{ url('/financeSheet/finance-sheet') }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="total_gross_income">
                        <input type="hidden" name="total_cogs">
                        <input type="hidden" name="total_gross_marging">
                        <input type="hidden" name="total_oh_expense">
                        <input type="hidden" name="year_estimation_id" value="{{ $yearEstimation->id }}">
                        <div class="row custom_row">
                            <div class="col-md-12">
                                <div class="top_heading">
                                    <h3 class="create_year_title">Create New Year Estimation</h3>
                                    <a href="{{ url('yearEstimation/year-estimation') }}" class="btn btn-success pull-right"><i class="icon-arrow-left-circle"></i> Back</a>
                                    @if($finance != null)
                                        <a href="{{ url('view_estimation/' . $yearEstimation->id) }}" class="btn btn-success pull-right"><i class="icon-arrow-right-circle"></i>View Finance Sheet</a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="gross_income">
                                    <h5>Gross Income</h5>
                                    <div class="custom_fields_flex">
                                        @foreach($categories as $category)
                                            <div class="form-group">
                                                <label for="">{{ $category->name??"" }}</label>
                                                <input type="hidden" name="grossIncome[{{ $category->name ?? "" }}][name]" value="{{ $category->name ?? "" }}">
                                                <input type="number"
                                                       class="form-control income"
                                                       name="grossIncome[{{ $category->name ?? '' }}][value]"
                                                       value="{{ number_format(optional(optional($finance->grossIncome ?? null)->firstWhere('name', $category->name))->value ?? 0, 2) }}"
                                                       placeholder="0.00"
                                                       min="0"
                                                       step="0.01"
                                                       required>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="">Total Gross Income</label>
                                <input type="number" class="totalIncome form-control" readonly>
                            </div>
                            <div class="col-md-12">
                                <div class="gross_income">
                                    <h5>Cost Of Goods Sold</h5>
                                    <div class="custom_fields_flex">
                                        @foreach($cogsMaterials as $cogsMaterial)
                                            <div class="form-group">
                                                <label for="">{{ $cogsMaterial->name??"" }}</label>
                                                <input type="hidden" name="grossCogs[{{ $cogsMaterial->name ?? "" }}][name]" value="{{ $cogsMaterial->name ?? "" }}">
                                                <input type="number"
                                                       class="form-control cogs"
                                                       name="grossCogs[{{$cogsMaterial->name}}][value]"
                                                       value="{{ number_format(optional(optional($finance->grossCogs ?? null)->firstWhere('name', $cogsMaterial->name))->value ?? 0, 2) }}"
                                                       placeholder="0.00"
                                                       min="0"
                                                       step="0.01"
                                                       onblur="if (this.value == '') { this.value = 0; }"
                                                       required>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="">Total Cost Of Goods Sold</label>
                                <input type="number" class="totalCogs form-control" readonly>
                            </div>
                            <div class="col-md-12">
                                <div class="gross_marging">
                                    <h5>Gross Margin</h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Total Gross Margin</label>
                                                <input type="number" class="totalMarging form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="custom_fields_flex">
                                        <div class="form-group">
                                            <label for="">Emp Payroll</label>
                                            <input type="number"
                                                   placeholder="0.00"
                                                   step="0.01"
                                                   name="payroll"
                                                   value="{{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->payroll : 0, 2) }}"
                                                   class="form-control oh_expense"
                                                   onblur="if (this.value == '') { this.value = 0; }"
                                                   required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Owner Pay</label>
                                            <input type="number"
                                                   placeholder="0.00"
                                                   step="0.01"
                                                   name="owner_pay"
                                                   value="{{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->owner_pay : 0, 2) }}"
                                                   class="form-control oh_expense"
                                                   onblur="if (this.value == '') { this.value = 0; }"
                                                   required>

                                        </div>
                                        <div class="form-group">
                                            <label for="">Merchant Fee</label>
                                            <input type="number"
                                                   placeholder="0.00"
                                                   step="0.01"
                                                   name="merchant_fee"
                                                   value="{{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->merchant_fee : 0, 2) }}"
                                                   class="form-control oh_expense"
                                                   onblur="if (this.value == '') { this.value = 0; }"
                                                   required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Employee Training</label>
                                            <input type="number"
                                                   placeholder="0.00"
                                                   step="0.01"
                                                   name="employee_training"
                                                   value="{{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->employee_training : 0, 2) }}"
                                                   class="form-control oh_expense"
                                                   onblur="if (this.value == '') { this.value = 0; }"
                                                   required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Advertising Marketing</label>
                                            <input type="number"
                                                   placeholder="0.00"
                                                   step="0.01"
                                                   name="advertising_marketing"
                                                   value="{{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->advertising_marketing : 0, 2) }}"
                                                   class="form-control oh_expense"
                                                   onblur="if (this.value == '') { this.value = 0; }"
                                                   required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Bank Charges</label>
                                            <input type="number"
                                                   placeholder="0.00"
                                                   step="0.01"
                                                   name="bank_charges"
                                                   value="{{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->bank_charges : 0, 2) }}"
                                                   class="form-control oh_expense"
                                                   onblur="if (this.value == '') { this.value = 0; }"
                                                   required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Dues & Subscription</label>
                                            <input type="number"
                                                   placeholder="0.00"
                                                   step="0.01"
                                                   name="dues_subscription"
                                                   value="{{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->dues_subscription : 0, 2) }}"
                                                   class="form-control oh_expense"
                                                   onblur="if (this.value == '') { this.value = 0; }"
                                                   required>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Insurance Expenses</label>
                                            <input type="number"
                                                   placeholder="0.00"
                                                   step="0.01"
                                                   name="insurance"
                                                   value="{{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->insurance : 0, 2) }}"
                                                   class="form-control oh_expense"
                                                   onblur="if (this.value == '') { this.value = 0; }"
                                                   required>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Legal & Professional</label>
                                            <input type="number"
                                                   placeholder="0.00"
                                                   step="0.01"
                                                   name="legal"
                                                   value="{{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->legal : 0, 2) }}"
                                                   class="form-control oh_expense"
                                                   onblur="if (this.value == '') { this.value = 0; }"
                                                   required>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Office Computer Supplies</label>
                                            <input type="number"
                                                   placeholder="0.00"
                                                   step="0.01"
                                                   name="office_computer"
                                                   value="{{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->office_computer : 0, 2) }}"
                                                   class="form-control oh_expense"
                                                   onblur="if (this.value == '') { this.value = 0; }"
                                                   required>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Rent & Lease</label>
                                            <input type="number"
                                                   placeholder="0.00"
                                                   step="0.01"
                                                   name="rent_lease"
                                                   value="{{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->rent_lease : 0, 2) }}"
                                                   class="form-control oh_expense"
                                                   onblur="if (this.value == '') { this.value = 0; }"
                                                   required>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Taxes</label>
                                            <input type="number"
                                                   placeholder="0.00"
                                                   step="0.01"
                                                   name="taxes"
                                                   value="{{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->taxes : 0, 2) }}"
                                                   class="form-control oh_expense"
                                                   onblur="if (this.value == '') { this.value = 0; }"
                                                   required>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Travel</label>
                                            <input type="number"
                                                   placeholder="0.00"
                                                   step="0.01"
                                                   name="travel"
                                                   value="{{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->travel : 0, 2) }}"
                                                   class="form-control oh_expense"
                                                   onblur="if (this.value == '') { this.value = 0; }"
                                                   required>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Utilities</label>
                                            <input type="number"
                                                   placeholder="0.00"
                                                   step="0.01"
                                                   name="utilities"
                                                   value="{{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->utilities : 0, 2) }}"
                                                   class="form-control oh_expense"
                                                   onblur="if (this.value == '') { this.value = 0; }"
                                                   required>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Vehicle Expenses</label>
                                            <input type="number"
                                                   placeholder="0.00"
                                                   step="0.01"
                                                   name="vehicle"
                                                   value="{{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->vehicle : 0, 2) }}"
                                                   class="form-control oh_expense"
                                                   onblur="if (this.value == '') { this.value = 0; }"
                                                   required>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" >Total Oh Expense</label>
                                                <input type="number"
                                                       class="form-control total_oh_expense"
                                                       value="{{ number_format($someValue ?? 0, 2) }}"
                                                       readonly step="0.01">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--                            <div class="col-md-12">--}}
                            {{--                                <div class="total_oh_expenses">--}}
                            {{--                                    <h5>Total OH Expenses</h5>--}}
                            {{--                                    <div class="custom_fields_flex">--}}
                            {{--                                        <div class="form-group">--}}
                            {{--                                            <label for="">clipper Magacine</label>--}}
                            {{--                                            <input type="number" placeholder="24,000.00" name="clipper" value="{{ isset($finance->grossExpense) ? $finance->grossExpense->first()->clipper :'0' }}" class="form-control" required>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="form-group">--}}
                            {{--                                            <label for="">Advance Magacine</label>--}}
                            {{--                                            <input type="number" placeholder="19,200.00" name="advance_magazine" value="{{ isset($finance->grossExpense) ? $finance->grossExpense->first()->advance_magazine :'0' }}" class="form-control" required>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="form-group">--}}
                            {{--                                            <label for="">Google Ads</label>--}}
                            {{--                                            <input type="number" placeholder="36,000.00" name="google_adds" value="{{ isset($finance->grossExpense) ? $finance->grossExpense->first()->google_adds:'0' }}" class="form-control" required>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="form-group">--}}
                            {{--                                            <label for="">Social Media</label>--}}
                            {{--                                            <input type="number" placeholder="6,000.00" name="social_media" value="{{ isset($finance->grossExpense) ? $finance->grossExpense->first()->social_media :'0' }}" class="form-control" required>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="form-group">--}}
                            {{--                                            <label for="">Total Advertising & Marketing</label>--}}
                            {{--                                            <input type="number" placeholder="85,200.00" name="total_advertising_marketing" value="{{ isset($finance->grossExpense) ? $finance->grossExpense->first()->total_advertising_marketing :'0' }}" class="form-control" required>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            <div class="col-md-12">
                                <div class="create_button_new">
                                    <button type="submit" class="btn btn-primary year_estimation_create_btn">Create</button>
                                </div>
                            </div>
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
            function calculateTotal() {
                var grossIncome = 0;
                var grossCogs = 0;
                var totalOhExpense = 0;
                $('.income').each(function () {
                    var value = parseFloat($(this).val()) || 0;
                    grossIncome += value;
                    $('.totalIncome').val(grossIncome.toFixed(2));
                });
                $('.cogs').each(function () {
                    var value = parseFloat($(this).val()) || 0;
                    grossCogs += value;
                    $('.totalCogs').val(grossCogs.toFixed(2));
                });
                var grossMarging = grossIncome - grossCogs;
                $('.totalMarging').val(grossMarging.toFixed(2));
                $('.oh_expense').each(function () {
                    var ohExpense = parseFloat($(this).val()) || 0;
                    totalOhExpense += ohExpense;
                });
                $('.total_oh_expense').val(totalOhExpense);
                // if (totalOhExpense > grossMarging) {
                //     Swal.fire({
                //         icon: 'error',
                //         title: 'Validation Error',
                //         text: 'Overhead expense must be less than Gross Margin.',
                //         confirmButtonText: 'OK',
                //     });
                //     $('.year_estimation_create_btn').prop('disabled', true);
                // } else {
                //     $('.year_estimation_create_btn').prop('disabled', false);
                // }
                $('#grossMarginDisplay').text(grossMarging.toFixed(2));
            }
            $('.income, .cogs, .oh_expense').on('input', calculateTotal);
            calculateTotal();
        });
    </script>
@endpush
