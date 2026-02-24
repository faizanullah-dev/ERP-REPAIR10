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
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    {{--            <h3 class="box-title pull-left">{{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Year Goal') }} {{ $yearestimation->year }}</h3>--}}
                    @can('view-'.str_slug('YearEstimation'))
                        <a class="btn btn-success pull-right" href="{{ url('/yearEstimation/year-estimation') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    @can('view-'.str_slug('YearEstimation'))
                        <a class="btn btn-success pull-right" href="{{ url('create_new_year_estimate/' . $yearEstimation->id) }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Finance Sheet</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="text-center">Projected </h2>
                        </div>
                        <div class="col-md-6">
                            <h2 class="text-center">Annual</h2>
                        </div>
                        <div class="col-md-6">
                            <h5>Sheet</h5>
                            <table class="table table-bordered view_estimation_custom_table">
                                <tr>
                                    <th> Gross Income </th>
                                    <th> $ {{ isset($finance->grossIncome) ? number_format($finance->grossIncome->sum('value'), 2) : '0.00' }} </th>
                                </tr>
                                @foreach($finance->grossIncome ?? [] as $grossIncome)
                                <tr>
                                    <td>{{ $grossIncome->name??"" }}</td>
                                    <td>$ {{ number_format($grossIncome->value ?? 0, 2) }}</td>
                                </tr>
                                @endforeach
                            </table>
                            <table class="table table-bordered view_estimation_custom_table">
                                <tr>
                                    <th> Cost of Goods Sold </th>
                                    <th> $ {{ isset($finance->grossCogs)  ? number_format($finance->grossCogs->sum('value'), 2) : '0.00' }} </th>
                                </tr>
                                @foreach($finance->grossCogs ?? [] as $grossCog)
                                    <tr>
                                        <td>{{ $grossCog->name??"" }}</td>
                                        <td>$ {{ number_format($grossCog->value ?? 0, 2) }}</td>
                                    </tr>
                                @endforeach
                            </table>
                            <table class="table table-bordered view_estimation_custom_table">
                                <tr>
                                    <th>Gross Margin</th>
                                    <th>
                                        $ {{isset($finance->grossIncome) && isset($finance->grossCogs) ? number_format($finance->grossIncome->sum('value') - $finance->grossCogs->sum('value'), 2) : '0.00'}}
                                    </th>
                                </tr>
                                <tr>
                                    <td>Emp Payroll</td>
                                    <td>$ {{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->payroll : 0, 2) }}</td>

                                </tr>
                                <tr>
                                    <td>Owner Pay</td>
                                    <td>$ {{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->owner_pay : 0, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Merchant fee</td>
                                    <td>$ {{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->merchant_fee : 0, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Employee Training</td>
                                    <td>$ {{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->employee_training : 0, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Advertising  Marketing</td>
                                    <td>$ {{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->advertising_marketing : 0, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Bank Charges</td>
                                    <td>$ {{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->bank_charges : 0, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Dues & Subscriptions</td>
                                    <td>$ {{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->dues_subscription : 0, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Insurance Expences</td>
                                    <td>$ {{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->insurance : 0, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Legal & Profetional</td>
                                    <td>$ {{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->legal : 0, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Office Computer Supplies</td>
                                    <td>$ {{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->office_computer : 0, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Rent & Lease</td>
                                    <td>$ {{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->rent_lease : 0, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Taxes</td>
                                    <td>$ {{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->taxes : 0, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Travel</td>
                                    <td>$ {{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->travel : 0, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Utilities</td>
                                    <td>$ {{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->utilities : 0, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Vehicle Expenses</td>
                                    <td>$ {{ number_format(isset($finance->grossExpense) ? $finance->grossExpense->first()->vehicle : 0, 2) }}</td>
                                </tr>
                            </table>
                            <table class="table table-bordered view_estimation_custom_table">
                                <tr>
                                    <th> Total OH Expenses </th>
                                    <th>
                                        $ {{ number_format(
    collect(['payroll', 'owner_pay', 'merchant_fee', 'employee_training', 'advertising_marketing', 'bank_charges', 'dues_subscription', 'insurance', 'legal', 'office_computer', 'rent_lease', 'taxes', 'travel', 'utilities', 'vehicle'])
    ->sum(fn($field) => isset($finance->grossExpense) ? $finance->grossExpense->sum(fn($item) => isset($item[$field]) ? $item[$field] : 0) : 0),
    2
) }}


                                    </th>
                                </tr>
{{--                                <tr>--}}
{{--                                    <td>clipper Magacine</td>--}}
{{--                                    <td>$ {{ isset($finance->grossExpense) ? $finance->grossExpense->first()->clipper : '0' }}</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>Advance Magacine</td>--}}
{{--                                    <td>$ {{ isset($finance->grossExpense) ? $finance->grossExpense->first()->advance_magazine : '0' }}</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>Google Ads</td>--}}
{{--                                    <td>$ {{ isset($finance->grossExpense) ? $finance->grossExpense->first()->google_adds : '0' }}</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>Social Media</td>--}}
{{--                                    <td>$ {{ isset($finance->grossExpense) ? $finance->grossExpense->first()->social_media :'0' }}</td>--}}
{{--                                </tr>--}}
                            </table>
                            <table class="table table-bordered view_estimation_custom_table">
                                <tr>
                                    <td class="net_income_new">Net Income</td>
                                    <td class="net_income_new">$ {{ number_format($totalIncome ?? 0, 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="net_income_new">Net Income %</td>
                                    <td class="net_income_new">
                                        {{
      number_format(
          ($finance->grossIncome->sum('value') > 0)
              ? ($totalIncome / $finance->grossIncome->sum('value')) * 100
              : 0,
          2
      )
  }}%

                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Sheet</h5>
                            <table class="table table-bordered view_estimation_custom_table">
                                <tr>
                                    <th> Gross Income </th>
                                    <th> $ {{ number_format($totalGrossIncome, 2)  }} </th>
                                </tr>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->name ?? '' }}</td>
                                        <td>
                                            ${{ number_format(
        $lead->sum(function ($item) use ($category) {
            $leadPriceTotal = $item->category_id == $category->id ? $item->lead_price : 0;
            $changeOrderTotal = $item->getChangeOrder()
                ->where('status', 'approved')
                ->get()
                ->sum(function ($changeOrder) use ($category) {
                    return $changeOrder->getChangeOrderAttachments()
                        ->where('category_id', $category->id)
                        ->get()
                        ->sum(function ($attachment) {
                            return (float)($attachment->amount) + (float)($attachment->tax);
                        });
                });
            return (float)$leadPriceTotal + (float)$changeOrderTotal;
        }),
        2
    ) }}
                                        </td>

                                    </tr>
                                @endforeach
                            </table>
                            <table class="table table-bordered view_estimation_custom_table">
                                <tr>
                                    <th> Cost of Goods Sold </th>
                                    <td>
                                        $ {{ $cogs->filter(function($cog) {
                                            return $cog->lead && $cog->lead->lead_status == 'won'; // Filter only won leads
                                        })->sum(function($cog) {
                                            return $cog->cogsSheetsDetails->sum('total_cost'); // Sum total_cost of related cogsSheetsDetails
                                        }) }}
                                    </td>
                                </tr>
                                @foreach($cogsMaterials as $cogsMaterial)
                                    <tr>
                                        <td>{{ $cogsMaterial->name??"" }}</td>
                                        <td>
                                            $ {{ $filteredCogs->sum(function ($cog) use ($cogsMaterial) {
                                                return $cog->cogsSheetsDetails->where('cogs_material_id', $cogsMaterial->id)->sum('total_cost');
                                            }) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <form method="POST" action="{{ url('/financeOhExpense/finance-oh-expense') }}" accept-charset="UTF-8"
                                  class="form-horizontal" enctype="multipart/form-data">
                                {{ csrf_field() }}
                            <table class="table table-bordered view_estimation_custom_table">
                                <tr>
                                    <th>Gross Margin</th>
                                    <td class="total_gross_margin">$ {{ $totalGrossIncome -
//                                        $cogs->sum(function($cog) {
//                                        return $cog->cogsSheetsDetails->sum('total_cost');
//                                        })
                                        $cogs->filter(function($cog) {
                                            return $cog->lead && $cog->lead->lead_status == 'won'; // Filter only won leads
                                        })->sum(function($cog) {
                                            return $cog->cogsSheetsDetails->sum('total_cost'); // Sum total_cost of related cogsSheetsDetails
                                        })
                                        }}
                                    </td>
                                </tr>
{{--                                <form id="total_oh_expense_form">--}}
                                    <input type="hidden" name="finance_sheet_id" value="{{ $finance->id }}">
                                <tr>
                                    <td>Emp Payroll</td>
                                    <td><input type="number" min="0" step="0.01" placeholder="0.00" name="expense[payroll][value]" value="{{ isset($finance->totalOhExpense) ? optional($finance->totalOhExpense->where('name', 'payroll')->first())->value : '0.00' }}" class="form-control expense"></td>
                                </tr>
                                <tr>
                                    <td>Owner Pay</td>
                                    <td><input type="number" min="0" step="0.01" placeholder="0.00" name="expense[owner_pay][value]" value="{{ isset($finance->totalOhExpense) ? optional($finance->totalOhExpense->where('name', 'owner_pay')->first())->value : '0.00' }}" class="form-control expense"></td>
                                </tr>
                                <tr>
                                    <td>Merchant fee</td>
                                    <td><input type="number" min="0" step="0.01" placeholder="0.00" name="expense[merchant_fee][value]" value="{{ isset($finance->totalOhExpense) ? optional($finance->totalOhExpense->where('name', 'merchant_fee')->first())->value : '0.00' }}" class="form-control expense"></td>
                                </tr>
                                <tr>
                                    <td>Employee Training</td>
                                    <td><input type="number" min="0" step="0.01" placeholder="0.00" name="expense[employee_training][value]" value="{{ isset($finance->totalOhExpense) ? optional($finance->totalOhExpense->where('name', 'employee_training')->first())->value : '0.00' }}" class="form-control expense"></td>
                                </tr>
                                <tr>
                                    <td>Advertising Marketing</td>
{{--                                    <td><input type="number" min="0" placeholder="0.00" name="expense[advertising_marketing][value]" value="{{isset($finance->totalOhExpense) ? optional($finance->totalOhExpense->where('name', 'advertising_marketing')->first())->value : '0.00' }}" class="form-control expense"></td>--}}
                                    <td><input type="number" min="0" placeholder="0.00" name="expense[advertising_marketing][value]" value="{{ $advertisementBudget??'0' }}" class="form-control expense" readonly></td>
                                </tr>
                                <tr>
                                    <td>Bank Charges</td>
                                    <td><input type="number" min="0" step="0.01" placeholder="0.00" name="expense[bank_charges][value]" value="{{ isset($finance->totalOhExpense) ? optional($finance->totalOhExpense->where('name', 'bank_charges')->first())->value : '0.00' }}" class="form-control expense"></td>
                                </tr>
                                <tr>
                                    <td>Dues & Subscriptions</td>
                                    <td><input type="number" min="0" step="0.01" placeholder="0.00" name="expense[dues_subscription][value]" value="{{ isset($finance->totalOhExpense) ? optional($finance->totalOhExpense->where('name', 'dues_subscription')->first())->value : '0.00' }}" class="form-control expense"></td>
                                </tr>
                                <tr>
                                    <td>Insurance Expences</td>
                                    <td><input type="number" min="0" step="0.01" placeholder="0.00" name="expense[insurance][value]" value="{{ isset($finance->totalOhExpense) ? optional($finance->totalOhExpense->where('name', 'insurance')->first())->value : '0.00' }}" class="form-control expense"></td>
                                </tr>
                                <tr>
                                    <td>Legal & Profetional</td>
                                    <td><input type="number" min="0" step="0.01" placeholder="0.00" name="expense[legal][value]" value="{{ isset($finance->totalOhExpense) ? optional($finance->totalOhExpense->where('name', 'legal')->first())->value : '0.00' }}" class="form-control expense"></td>
                                </tr>
                                <tr>
                                    <td>Office Computer Supplies</td>
                                    <td><input type="number" min="0" step="0.01" placeholder="0.00" name="expense[office_computer][value]" value="{{ isset($finance->totalOhExpense) ? optional($finance->totalOhExpense->where('name', 'office_computer')->first())->value : '0.00' }}" class="form-control expense"></td>
                                </tr>
                                <tr>
                                    <td>Rent & Lease</td>
                                    <td><input type="number" min="0" step="0.01" placeholder="0.00" name="expense[rent_lease][value]" value="{{ isset($finance->totalOhExpense) ? optional($finance->totalOhExpense->where('name', 'rent_lease')->first())->value : '0.00' }}" class="form-control expense"></td>
                                </tr>
                                <tr>
                                    <td>Taxes</td>
                                    <td><input type="number" min="0" step="0.01" placeholder="0.00" name="expense[taxes][value]" value="{{ isset($finance->totalOhExpense) ? optional($finance->totalOhExpense->where('name', 'taxes')->first())->value : '0.00' }}" class="form-control expense"></td>
                                </tr>
                                <tr>
                                    <td>Travel</td>
                                    <td><input type="number" min="0" step="0.01" placeholder="0.00" name="expense[travel][value]" value="{{ isset($finance->totalOhExpense) ? optional($finance->totalOhExpense->where('name', 'travel')->first())->value : '0.00' }}" class="form-control expense"></td>
                                </tr>
                                <tr>
                                    <td>Utilities</td>
                                    <td><input type="number" min="0" step="0.01" placeholder="0.00" name="expense[utilities][value]" value="{{ isset($finance->totalOhExpense) ? optional($finance->totalOhExpense->where('name', 'utilities')->first())->value : '0.00' }}" class="form-control expense"></td>
                                </tr>
                                <tr>
                                    <td>Vehicle Expenses</td>
                                    <td><input type="number" min="0" step="0.01" placeholder="0.00" name="expense[vehicle][value]" value="{{ isset($finance->totalOhExpense) ? optional($finance->totalOhExpense->where('name', 'vehicle')->first())->value : '0.00' }}" class="form-control expense"></td>
                                </tr>
                            </table>
                            <table class="table table-bordered view_estimation_custom_table">
                                <tr>
                                    <th> Total OH Expenses </th>
                                    <td><input type="text" class="form-control total_oh_expense" name="total_oh_expense" value="{{ $finance->total_oh_expense }}" readonly></td>
                                </tr>
{{--                                <tr>--}}
{{--                                    <td>clipper Magacine</td>--}}
{{--                                    <td><input type="number" min="0" placeholder="0.00" name="advance_magazine" class="form-control"></td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>Advance Magacine</td>--}}
{{--                                    <td><input type="number" min="0" placeholder="0.00" name="advance_magazine" class="form-control"></td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>Google Ads</td>--}}
{{--                                    <td><input type="number" min="0" placeholder="0.00" name="advance_magazine" class="form-control"></td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>Social Media</td>--}}
{{--                                    <td><input type="number" min="0" placeholder="0.00" name="advance_magazine" class="form-control"></td>--}}
{{--                                </tr>--}}
                            </table>
                            <div class="d-flex justify-content-end my-3">
                                <button type="submit" class="btn btn-primary">Submit </button>
                            </div>
                            </form>
                            <table class="table table-bordered view_estimation_custom_table">
                                <tr>
                                    <td class="net_income_new">Net Income</td>
                                    <td class="net_income_new">
                                        $ {{ number_format(
    $totalGrossIncome -
    $cogs->filter(function($cog) {
        return $cog->lead && $cog->lead->lead_status == 'won'; // Filter only won leads
    })->sum(function($cog) {
        return $cog->cogsSheetsDetails->sum('total_cost'); // Sum total_cost of related cogsSheetsDetails
    })
    - $finance->total_oh_expense,
    2
) }}

                                    </td>
                                </tr>
                                <tr>
                                    <td class="net_income_new">Net Income %</td>
                                    <td class="net_income_new">
                                        {{
                                              $totalGrossIncome != 0
                                              ? number_format(
                                                  (
                                                      ($totalGrossIncome -
                                                          $cogs->filter(function($cog) {
                                                              return $cog->lead && $cog->lead->lead_status == 'won';
                                                          })->sum(function($cog) {
                                                              return $cog->cogsSheetsDetails->sum('total_cost');
                                                          })
                                                      + $finance->total_oh_expense
                                                  ) / $totalGrossIncome
                                              ) * 100, 2)
                                              : 0
                                          }} %
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('js')
<script>
    $(document).ready(function () {
        function calculateTotal() {
            let total = 0;
            $('.expense').each(function () {
                total += parseFloat($(this).val()) || 0;
            });
            $('.total_oh_expense').val('$' + total.toFixed(2));
            // var margin = parseFloat($('.total_gross_margin').text().replace('$', '').trim());
        }
        $('.expense').on('input', calculateTotal);
        calculateTotal();

    {{--$('#total_oh_expense_form').on('input', '.expense', function () {--}}
        {{--    const formData = $('#total_oh_expense_form').serialize();--}}
        {{--    $.ajax({--}}
        {{--        url: '{{ route('store_finance_oh') }}',--}}
        {{--        type: 'POST',--}}
        {{--        data: formData,--}}
        {{--        headers: {--}}
        {{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
        {{--        },--}}
        {{--        success: function (response) {--}}
        {{--            console.log('Data saved successfully');--}}
        {{--        },--}}
        {{--        error: function (xhr) {--}}
        {{--            console.error('Error saving data:', xhr.responseJSON?.message);--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}
    });
</script>
@endpush
