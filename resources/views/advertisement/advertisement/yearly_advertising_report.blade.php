@extends('layouts.master')
@section('content')
    <section class="summary_section pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 px-3 py-3 borderRadius20 box-shadow-card">
                        <div class="card-headerr mb-4">
                            <h5>Yearly Advertising Budget {{ $selectedYear??"" }}</h5>
                        </div>
                        <div class="advance_btn ml-auto">
                            <form>
{{--                                <label for="Select Category" class="form-label input_labels p-18">Select Year</label>--}}
                                <select class="form-control  borderRadius select2 w-25" id="year_filter" name="year">
                                    <option value="" {{ request()->get('year') == '' ? 'selected hidden' : '' }}>Year</option>
                                    @foreach($years as $year)
                                        <option value="{{$year->year}}" {{ request()->get('year') == $year->year ? 'selected' : '' }}>{{$year->year}}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                        <div class="hr-line mt-2"></div>
                        <div class="report_tabs">
                        </div>
                        <div class="table_div"  style="overflow-x:auto;">
                            <table class="table table-borderless staff table-responsive">
                                <thead>
                                <tr>
                                    <th>Months</th>
                                    <th>Expended</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                                @endphp
                                @foreach($months as $key => $month)
                                    <tr>
                                        <td class="align-middle">{{ $month }}</td>
                                        @php
                                            $found = false;
                                        @endphp
                                        @foreach($advertisements as $item)
                                            @if(strtolower($item->month) == strtolower($month))
                                                <td class="align-middle">${{ $item->monthly_budget }}</td>
                                                @php
                                                    $found = true;
                                                @endphp
                                                @break
                                            @endif
                                        @endforeach
                                        @if(!$found)
                                            <td class="align-middle">${{ number_format(0, 2) }}</td>
                                        @endif
                                        @if($key == 0)
                                            <td>
                                                <input type="number" placeholder="%" name="percent_value" id="percent_input" value="7">
                                            %</td>
                                            <td id="calculated_value">${{ number_format($yearly_budget ?? 0, 2) }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                                <tr>
                                    <th>Total Yearly Budget</th>
                                    <td><strong>${{ number_format($yearly_budget ?? 0, 2) }}</strong></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#year_filter').change(function() {
                var selectedYear = $(this).val();
                var currentYear = selectedYear;
                $('#current_year').text(currentYear);
                console.log("Selected year: " + currentYear);
                $(this).closest('form').submit();
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            var yearlyBudget = {{ $yearly_budget }};
            function calculateAndDisplay(percent) {
                if (percent !== '') {
                    var calculatedValue =yearlyBudget / percent;
                    $('#calculated_value').text('$' + calculatedValue.toFixed(2));
                } else {
                    $('#calculated_value').text('$' + yearlyBudget.toFixed(2));
                }
            }
            var defaultPercent = 7;
            $('#percent_input').val(defaultPercent);
            calculateAndDisplay(defaultPercent);
            $('#percent_input').on('input', function(){
                var percent = $(this).val();
                calculateAndDisplay(percent);
            });
        });
    </script>
@endpush
