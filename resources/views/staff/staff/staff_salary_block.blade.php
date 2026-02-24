@extends('layouts.master')

@push('css')

@endpush

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="white-box-header">
                                    <div class="white-box-header-left">
                                        <h3 class="box-title">Salary Block</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <form class="row" action="{{ route('salaryBlock.update') }}" method="POST">
                                    @csrf
                                    <div class="col-md-12">
                                        <h6>Hourly</h6>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Pay</label>
                                            <input type="number" name="hourly_pay" class="form-control" min="0" value="{{ $salaryBlock['hourly']['pay'] ?? '' }}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label" >Hours Per Week</label>
                                            <input type="number" name="hourly_hours" class="form-control" min="0" value="{{ $salaryBlock['hourly']['hours_per_week'] ?? '' }}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label" >Total Weeks Per Year</label>
                                            <input type="number" name="hourly_weeks" class="form-control" min="0" value="{{ $salaryBlock['hourly']['total_weeks'] ?? '' }}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label" >Total Yearly Pay</label>
                                            <input type="number" name="hourly_total_yearly" class="form-control" min="0"  placeholder="" value="{{ $salaryBlock['hourly']['total_yearly_pay'] ?? '' }}" readonly >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <h6>Salary</h6>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label" >Pay</label>
                                            <input type="number" name="salary_pay" class="form-control" min="0" value="{{ $salaryBlock['salary']['pay'] ?? '' }}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label" >Number Of Days Per Week</label>
                                            <input type="number" name="salary_days" class="form-control" min="0" value="{{ $salaryBlock['salary']['days_per_week'] ?? '' }}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label" >Total Weeks Per Year</label>
                                            <input type="number" name="salary_weeks" class="form-control" min="0" value="{{ $salaryBlock['salary']['total_weeks'] ?? '' }}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label" >Total Yearly Pay</label>
                                            <input type="number" name="salary_total_yearly" class="form-control" min="0" value="{{ $salaryBlock['salary']['total_yearly_pay'] ?? '' }}" placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <h6>Commission</h6>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label" >Rate</label>
                                            <div class="input-group">
                                                <input type="number" name="commission_rate" class="form-control" min="0" value="{{ $salaryBlock['commission']['rate'] ?? '' }}" placeholder="">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" >Sales Target</label>
                                            <input type="number" name="commission_target" class="form-control" min="0" step="0.01" value="{{ number_format($salaryBlock['commission']['sales_target'] ?? 0, 2, '.', '') }}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label" >Total Yearly Pay</label>
                                            <input type="number" name="commission_total_yearly" class="form-control" min="0" value="{{ $salaryBlock['commission']['total_yearly_pay'] ?? '' }}" placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <h6>Base + Commission</h6>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label" >Pay</label>
                                            <input type="number" name="base_commission_pay" class="form-control" min="0" value="{{ $salaryBlock['base_commission']['pay'] ?? '' }}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label" >Weekly</label>
                                            <input type="number" name="base_commission_weekly" class="form-control" min="0" value="{{ $salaryBlock['base_commission']['weekly'] ?? '' }}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label" >Total Weeks Per Year</label>
                                            <input type="number" name="base_commission_weeks" class="form-control" min="0" value="{{ $salaryBlock['base_commission']['total_weeks'] ?? '' }}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label" >Total (Salary)</label>
                                            <input type="number" name="base_commission_salary_total" class="form-control" min="0" value="{{ $salaryBlock['base_commission']['total_salary'] ?? '' }}" placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label" >Rate</label>
                                            <div class="input-group">
                                                <input type="number" name="base_commission_rate" class="form-control" min="0" value="{{ $salaryBlock['base_commission']['rate'] ?? '' }}" placeholder="">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" >Sales Target</label>
                                            <input type="number" name="base_commission_target" class="form-control" min="0" step="0.01" value="{{ number_format($salaryBlock['base_commission']['sales_target'] ?? 0, 2, '.', '') }}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label" >Total (Commission)</label>
                                            <input type="number" name="base_commission_commission_total" class="form-control" min="0" value="{{ $salaryBlock['base_commission']['total_commission'] ?? '' }}" placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label" >Total Yearly Pay</label>
                                            <input type="number" name="base_commission_total_yearly" class="form-control" min="0" value="{{ $salaryBlock['base_commission']['total_yearly_pay'] ?? '' }}" placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form_action_btns">
                                            <button class="btn green_btn" type="submit">Save Changes <i class="fa-solid fa-check"></i></button>
                                            <button class="btn btn-secondary" type="button" > Cancel <i class="fa-solid fa-xmark"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        $(document).ready(function () {

            function calculateHourly() {
                let pay = parseFloat($("input[name='hourly_pay']").val()) || 0;
                let hoursPerWeek = parseFloat($("input[name='hourly_hours']").val()) || 0;
                let totalWeeks = parseFloat($("input[name='hourly_weeks']").val()) || 0;

                let totalYearlyPay = pay * hoursPerWeek * totalWeeks;
                $("input[name='hourly_total_yearly']").val(totalYearlyPay.toFixed(2));
            }

            function calculateSalary() {
                let pay = parseFloat($("input[name='salary_pay']").val()) || 0;
                let daysPerWeek = parseFloat($("input[name='salary_days']").val()) || 0;
                let totalWeeks = parseFloat($("input[name='salary_weeks']").val()) || 0;

                let totalYearlyPay = pay * daysPerWeek * totalWeeks;
                $("input[name='salary_total_yearly']").val(totalYearlyPay.toFixed(2));
            }

            function calculateCommission() {
                let rate = parseFloat($("input[name='commission_rate']").val()) || 0;
                let salesTarget = parseFloat($("input[name='commission_target']").val()) || 0;

                let totalYearlyPay = (rate / 100) * salesTarget;
                $("input[name='commission_total_yearly']").val(totalYearlyPay.toFixed(2));
            }

            function calculateBaseCommission() {
                let basePay = parseFloat($("input[name='base_commission_pay']").val()) || 0;
                let weekly = parseFloat($("input[name='base_commission_weekly']").val()) || 0;
                let totalWeeks = parseFloat($("input[name='base_commission_weeks']").val()) || 0;
                let rate = parseFloat($("input[name='base_commission_rate']").val()) || 0;
                let salesTarget = parseFloat($("input[name='base_commission_target']").val()) || 0;

                let totalSalary = basePay * weekly * totalWeeks;
                let totalCommission = (rate / 100) * salesTarget;
                let totalYearlyPay = totalSalary + totalCommission;

                $("input[name='base_commission_salary_total']").val(totalSalary.toFixed(2));
                $("input[name='base_commission_commission_total']").val(totalCommission.toFixed(2));
                $("input[name='base_commission_total_yearly']").val(totalYearlyPay.toFixed(2));
            }

            $("input[name='hourly_pay'], input[name='hourly_hours'], input[name='hourly_weeks']").on("keyup", calculateHourly);
            $("input[name='salary_pay'], input[name='salary_days'], input[name='salary_weeks']").on("keyup", calculateSalary);
            $("input[name='commission_rate'], input[name='commission_target']").on("keyup", calculateCommission);
            $("input[name='base_commission_pay'], input[name='base_commission_weekly'], input[name='base_commission_weeks'], input[name='base_commission_rate'], input[name='base_commission_target']").on("keyup", calculateBaseCommission);

        });
    </script>

@endpush
