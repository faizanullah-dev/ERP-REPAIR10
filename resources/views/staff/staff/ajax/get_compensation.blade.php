@if($type === 'hourly')
    <h6>Hourly</h6>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label">Pay</label>
            <input type="number" name="compensations[hourly][pay]" class="form-control" min="0" placeholder="" value="{{ $hourly['pay'] ?? '' }}">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label">Hours Per Week</label>
            <input type="number" name="compensations[hourly][hours_per_week]" class="form-control" min="0" placeholder="" value="{{ $hourly['hours_per_week'] ?? '' }}">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label">Total Weeks Per Year</label>
            <input type="number" name="compensations[hourly][total_weeks]" class="form-control" min="0" placeholder="" value="{{ $hourly['total_weeks'] ?? '' }}">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label">Total Yearly Pay</label>
            <input type="number" name="compensations[hourly][total_yearly_pay]" class="form-control" min="0" placeholder="" value="{{ $hourly['total_yearly_pay'] ?? '' }}" readonly>
        </div>
    </div>
@elseif($type === 'salary')
    <h6>Salary</h6>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label">Pay</label>
            <input type="number" name="compensations[salary][pay]" class="form-control" min="0" placeholder="" value="{{ $salary['pay'] ?? '' }}">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label">Number Of Days Per Week</label>
            <input type="number" name="compensations[salary][days_per_week]" class="form-control" min="0" placeholder="" value="{{ $salary['days_per_week'] ?? '' }}">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label">Total Weeks Per Year</label>
            <input type="number" name="compensations[salary][total_weeks]" class="form-control" min="0" placeholder="" value="{{ $salary['total_weeks'] ?? '' }}">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label">Total Yearly Pay</label>
            <input type="number" name="compensations[salary][total_yearly_pay]" class="form-control" min="0" placeholder="" value="{{ $salary['total_yearly_pay'] ?? '' }}" readonly>
        </div>
    </div>
@elseif($type === 'commission')
    <h6>Commission</h6>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label">Rate</label>
            <input type="number" name="compensations[commission][rate]" class="form-control" min="0" placeholder="" value="{{ $commission['rate'] ?? '' }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label">Sales Target</label>
            <input type="number" name="compensations[commission][sales_target]" class="form-control" min="0" placeholder="" value="{{ $commission['sales_target'] ?? '' }}">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label">Total Yearly Pay</label>
            <input type="number" name="compensations[commission][total_yearly_pay]" class="form-control" min="0" placeholder="" value="{{ $commission['total_yearly_pay'] ?? '' }}" readonly>
        </div>
    </div>
@elseif($type === 'base_commission')
    <h6>Base + Commission</h6>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label">Pay</label>
            <input type="number" name="compensations[base_commission][pay]" class="form-control" min="0" placeholder="" value="{{ $base_commission['pay'] ?? '' }}">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label">Weekly</label>
            <input type="number" name="compensations[base_commission][weekly]" class="form-control" min="0" placeholder="" value="{{ $base_commission['weekly'] ?? '' }}">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label">Total Weeks Per Year</label>
            <input type="number" name="compensations[base_commission][total_weeks]" class="form-control" min="0" placeholder="" value="{{ $base_commission['total_weeks'] ?? '' }}">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label">Total (Salary)</label>
            <input type="number" name="compensations[base_commission][total_salary]" class="form-control" min="0" placeholder="" value="{{ $base_commission['total_salary'] ?? '' }}" readonly>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label">Rate</label>
            <input type="number" name="compensations[base_commission][rate]" class="form-control" min="0" placeholder="" value="{{ $base_commission['rate'] ?? '' }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label">Sales Target</label>
            <input type="number" name="compensations[base_commission][sales_target]" class="form-control" min="0" placeholder="" value="{{ $base_commission['sales_target'] ?? '' }}">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label">Total (Commission)</label>
            <input type="number" name="compensations[base_commission][total_commission]" class="form-control" min="0" placeholder="" value="{{ $base_commission['total_commission'] ?? '' }}" readonly>
        </div>
    </div>
    <div class="col-md-9"></div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label">Total Yearly Pay</label>
            <input type="number" name="compensations[base_commission][total_yearly_pay]" class="form-control" min="0" placeholder="" value="{{ $base_commission['total_yearly_pay'] ?? '' }}" readonly>
        </div>
    </div>
@endif


<script>
    $(document).ready(function () {

        function calculateHourly() {
            let pay = parseFloat($("input[name='compensations[hourly][pay]']").val()) || 0;
            let hoursPerWeek = parseFloat($("input[name='compensations[hourly][hours_per_week]']").val()) || 0;
            let totalWeeks = parseFloat($("input[name='compensations[hourly][total_weeks]']").val()) || 0;

            let totalYearlyPay = pay * hoursPerWeek * totalWeeks;
            $("input[name='compensations[hourly][total_yearly_pay]']").val(totalYearlyPay.toFixed(2));
        }

        function calculateSalary() {
            let pay = parseFloat($("input[name='compensations[salary][pay]']").val()) || 0;
            let daysPerWeek = parseFloat($("input[name='compensations[salary][days_per_week]']").val()) || 0;
            let totalWeeks = parseFloat($("input[name='compensations[salary][total_weeks]']").val()) || 0;

            let totalYearlyPay = pay * daysPerWeek * totalWeeks;
            $("input[name='compensations[salary][total_yearly_pay]']").val(totalYearlyPay.toFixed(2));
        }

        function calculateCommission() {
            let rate = parseFloat($("input[name='compensations[commission][rate]']").val()) || 0;
            let salesTarget = parseFloat($("input[name='compensations[commission][sales_target]']").val()) || 0;

            let totalYearlyPay = (rate / 100) * salesTarget;
            $("input[name='compensations[commission][total_yearly_pay]']").val(totalYearlyPay.toFixed(2));
        }

        function calculateBaseCommission() {
            let basePay = parseFloat($("input[name='compensations[base_commission][pay]']").val()) || 0;
            let weekly = parseFloat($("input[name='compensations[base_commission][weekly]']").val()) || 0;
            let totalWeeks = parseFloat($("input[name='compensations[base_commission][total_weeks]']").val()) || 0;
            let rate = parseFloat($("input[name='compensations[base_commission][rate]']").val()) || 0;
            let salesTarget = parseFloat($("input[name='compensations[base_commission][sales_target]']").val()) || 0;

            let totalSalary = basePay * weekly * totalWeeks;
            let totalCommission = (rate / 100) * salesTarget;
            let totalYearlyPay = totalSalary + totalCommission;

            $("input[name='compensations[base_commission][total_salary]']").val(totalSalary.toFixed(2));
            $("input[name='compensations[base_commission][total_commission]']").val(totalCommission.toFixed(2));
            $("input[name='compensations[base_commission][total_yearly_pay]']").val(totalYearlyPay.toFixed(2));
        }

        $(document).on("keyup","input[name='compensations[hourly][pay]'], input[name='compensations[hourly][hours_per_week]'], input[name='compensations[hourly][total_weeks]']", calculateHourly);
        $(document).on("keyup","input[name='compensations[salary][pay]'], input[name='compensations[salary][days_per_week]'], input[name='compensations[salary][total_weeks]']", calculateSalary);
        $(document).on("keyup","input[name='compensations[commission][rate]'], input[name='compensations[commission][sales_target]']",calculateCommission);
        $(document).on("keyup","input[name='compensations[base_commission][pay]'], input[name='compensations[base_commission][weekly]'], input[name='compensations[base_commission][total_weeks]'], input[name='compensations[base_commission][rate]'], input[name='compensations[base_commission][sales_target]']" ,calculateBaseCommission);

    });
</script>