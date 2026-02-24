@extends('layouts.master')
@section('content')
    <section class="summary_section pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 px-3 py-3 borderRadius20 box-shadow-card">
                        <div class="card-headerr bg-white">
                            <h5>Yearly Advertising Budget {{ $selectedYear??"" }}</h5>
                        </div>
                        <div class="advance_btn ml-auto">
                            <form>
                                <label for="Select Category" class="form-label input_labels p-18">Select Year</label>
                                <select class="form-control  borderRadius select2" id="year_filter" name="year">
                                    <option value="" {{ request()->get('year') == '' ? 'selected' : '' }}>Select Year</option>
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
                                @foreach($months as $month)
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
                                            <td class="align-middle">$0</td>
                                        @endif
                                        <td class="align-middle"></td>
                                        <td class="align-middle"></td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th>Total Yearly Budget</th>
                                    <td><strong>${{ $yearly_budget }}</strong></td>
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
@endpush
