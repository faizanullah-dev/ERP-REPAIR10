<div class="col-md-1">
    <div class="form-group {{ $errors->has('Value') ? 'has-error' : ''}}">
        <label for="type" class="col-md-12 control-label">{{ 'Value' }}</label>
        <input class="form-control calculation" name="estimate_value" type="number" id="estimate_value" value="{{$yearestimation->estimate_value??'580'}}" placeholder="580" required>
        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="row">
    <div class="col-md-1">
        <div class="form-group {{ $errors->has('year') ? 'has-error' : ''}}">
            <label for="year" class="col-md-12 control-label">{{ 'Year' }}</label>
{{--                @if(isset($yearestimation))--}}
{{--                    <select class="form-control select2" id="year" name="year" >--}}
{{--                            @foreach((range(date('Y'), strftime("%Y", time()) + 100)) as $year))--}}
{{--                        @foreach(range(2010, date('Y') + 100) as $year)--}}
{{--                                <option value="{{$year}}" @if(isset($yearestimation) && $yearestimation->year == $year) selected @endif>{{$year}}</option>--}}
{{--                            @endforeach--}}
{{--                    </select>--}}
{{--                @else--}}
{{--                    <select class="form-control select2" id="year" name="year">--}}
{{--                        @foreach((range(date('Y'), strftime("%Y", time()) + 100)) as $year))--}}
{{--                        @foreach(range(2010, date('Y') + 100) as $year)--}}
{{--                            @if(in_array($year, $years)) @continue @endif--}}
{{--                            <option value="{{$year}}" @if(isset($yearestimation) && $yearestimation->year == $year) selected @endif>{{$year}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                @endif--}}
            @if(isset($yearestimation))
                <select class="form-control select_new_year_estimation" id="year" name="year">
                    @foreach(range(2010, date('Y') + 100) as $year)
                        <option value="{{ $year }}" @if(isset($yearestimation) && $yearestimation->year == $year) selected @endif>{{ $year }}</option>
                    @endforeach
                </select>
            @else
                <select class="form-control select_new_year_estimation" id="year" name="year">
                    @foreach(range(2010, date('Y') + 100) as $year)
                        {{-- Skip years that are in the $years array --}}
                        @if(isset($years) && in_array($year, $years))
                            @continue
                        @endif
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            @endif
            {!! $errors->first('year', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
            <label for="type" class="col-md-12 control-label">{{ 'Type' }}</label>
            <input class="form-control calculation" name="type" type="text" id="type" value="Goal" readonly>
                {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group {{ $errors->has('estimate_amount') ? 'has-error' : ''}}">
            <label for="estimate_amount" class="col-md-12 control-label">{{ 'Gross Income' }}</label>
{{--                <input class="form-control calculation" name="estimate_amount" type="text" id="estimate_amount" value="{{number_format($yearestimation->estimate_amount??2000000)}}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >--}}
            <input class="form-control calculation" name="estimate_amount" type="text" id="estimate_amount"
                   value="{{ number_format($yearestimation->estimate_amount ?? 0, 2) }}"
                   required
                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
            {!! $errors->first('estimate_amount', '<p class="help-block">:message</p>') !!}

        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('amount_per_job') ? 'has-error' : ''}}">
            <label for="amount_per_job" class="col-md-12 control-label">{{ 'Amount Per Job' }}</label>
{{--            <input class="form-control calculation" name="amount_per_job" type="text" id="amount_per_job" value="{{number_format( $yearestimation->amount_per_job??11600)}}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >--}}
            <input class="form-control calculation"
                   name="amount_per_job"
                   type="number"
                   id="amount_per_job"
                   value="{{ number_format($yearestimation->amount_per_job ?? 0, 2) }}"
                   required
                   step="0.01"
                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
            {!! $errors->first('amount_per_job', '<p class="help-block">:message</p>') !!}

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('job_convertion_ratio') ? 'has-error' : ''}}">
            <label for="job_convertion_ratio" class="col-md-12 control-label">{{ 'Job Conversion Ratio %' }}</label>
{{--            <input class="form-control calculation" name="job_convertion_ratio" type="text" id="job_convertion_ratio" value="{{ $yearestimation->job_convertion_ratio??30}}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >--}}
            <input class="form-control calculation" name="job_convertion_ratio" type="text"  id="job_convertion_ratio" value="{{ $yearestimation->job_convertion_ratio??0}}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
            {!! $errors->first('job_convertion_ratio', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('extra_push') ? 'has-error' : ''}}">
            <label for="extra_push" class="col-md-12 control-label">{{ 'Extra Push %' }}</label>
{{--            <input class="form-control calculation" name="extra_push" type="text" id="extra_push" value="{{ $yearestimation->extra_push??40}}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >--}}
            <input class="form-control calculation" name="extra_push" type="text" id="extra_push" value="{{ $yearestimation->extra_push??0}}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
            {!! $errors->first('extra_push', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
@foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $index => $month)
    <div class="row row_{{ strtolower($month) }}">
        <div class="col-md-1">
            <div class="form-group {{ $errors->has('month_'.strtolower($month)) ? 'has-error' : ''}}">
                <label for="month_{{ strtolower($month) }}" class="col-md-4 control-label">{{ 'Month' }}</label>
                <input class="form-control month" name="month[{{ strtolower($month) }}][name]" type="text" id="month_{{ strtolower($month) }}" readonly @if(isset($yearestimation->months) && $yearestimation->months) value="{{$yearestimation->months[$index]->name}}" @else value="{{ $month }}" @endif >
                {!! $errors->first('month_'.strtolower($month), '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group {{ $errors->has('percentage_'.strtolower($month)) ? 'has-error' : ''}}">
                <label for="percentage_{{ strtolower($month) }}" class="col-md-12 control-label">{{ 'Percent %' }}</label>
                <input class="form-control month_percentate calculation" name="month[{{ strtolower($month) }}][percentage]" type="number" id="percentage_{{ strtolower($month) }}" @if(isset($yearestimation->months) && $yearestimation->months) value="{{$yearestimation->months[$index]->percentage}}" @endif required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
                {!! $errors->first('percentage_'.strtolower($month), '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group {{ $errors->has('amount_'.strtolower($month)) ? 'has-error' : ''}}">
                <label for="amount_{{ strtolower($month) }}" class="col-md-12 control-label">{{ 'Amount $' }}</label>
                <input class="form-control month_amount" name="month[{{ strtolower($month) }}][amount]"
                       type="text" id="amount_{{ strtolower($month) }}"
                       value="{{ number_format($monthAmount ?? 0, 2) }}" readonly>
                {!! $errors->first('amount_'.strtolower($month), '<p class="help-block">:message</p>') !!}

            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group {{ $errors->has('month_required_leads_'.strtolower($month)) ? 'has-error' : ''}}">
                <label for="month_required_leads_{{ strtolower($month) }}" class="col-md-12 control-label">{{ 'Required Leads' }}</label>
                <input class="form-control month_required_leads" name="month[{{ strtolower($month) }}][month_required_leads]" type="number" id="month_required_leads_{{ strtolower($month) }}" readonly>
                {!! $errors->first('month_required_leads_'.strtolower($month), '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group {{ $errors->has('month_needed_leads_'.strtolower($month)) ? 'has-error' : ''}}">
                <label for="month_needed_leads_{{ strtolower($month) }}" class="col-md-12 control-label">{{ 'Leads Needed' }}</label>
                <input class="form-control month_needed_leads" name="month[{{ strtolower($month) }}][month_needed_leads]" type="number" id="month_needed_leads_{{ strtolower($month) }}" readonly>
                {!! $errors->first('month_needed_leads_'.strtolower($month), '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group {{ $errors->has('extra_leads_'.strtolower($month)) ? 'has-error' : ''}}">
                <label for="extra_leads_{{ strtolower($month) }}" class="col-md-12 control-label">{{ 'Extra Leads' }}</label>
                <input class="form-control month_extra_leads" name="month[{{ strtolower($month) }}][extra_leads]" type="number" id="extra_leads_{{ strtolower($month) }}" readonly>
                {!! $errors->first('extra_leads_'.strtolower($month), '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group {{ $errors->has('extra_amount_'.strtolower($month)) ? 'has-error' : ''}}">
                <label for="extra_amount_{{ strtolower($month) }}" class="col-md-12 control-label">{{ 'Extra Amount $' }}</label>
                <input class="form-control month_extra_amount"
                       name="month[{{ strtolower($month) }}][extra_amount]"
                       type="text"
                       id="extra_amount_{{ strtolower($month) }}"
                       value="{{ number_format($monthExtraAmount ?? 0, 2) }}"
                       readonly>
                {!! $errors->first('extra_amount_'.strtolower($month), '<p class="help-block">:message</p>') !!}

            </div>
        </div>
    </div>
@endforeach

<div class="row row_total">
    <hr>
    <div class="col-md-1">
        <div class="form-group">
            <input class="form-control" type="text" value="Total" readonly>
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group">
            <input class="form-control total_percent" type="text" readonly>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <input class="form-control total_amount" type="text" readonly>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <input class="form-control total_required_leads" type="text" readonly>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <input class="form-control total_needed_leads" type="text" readonly>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <input class="form-control total_extra_leads" type="text" readonly>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <input class="form-control total_extra_amount" type="text" readonly>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary year_estimation_create_btn" type="submit" value="{{ $submitButtonText??'Create' }}" onclick="this.disabled = true; this.form.submit();">
    </div>
</div>

@push('js')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script> {{--For create/edit form validation--}}
    <script type="text/javascript">
        // $(document).on('keyup keydown change','.calculation',function(e){
        //     calculation();
        // });
        // function calculation(){
        //     var estimated_amount_string = $('#estimate_amount').val();
        //     var number_format_estimated_amount = estimated_amount_string.replace(/[^0-9.]+/g, '');
        //     var estimated_amount = parseFloat(number_format_estimated_amount);
        //     if (isNaN(estimated_amount)) {
        //         estimated_amount = 0;
        //     }
        //     var amount_per_job_string = $('#amount_per_job').val();
        //     var number_format_amount_per = amount_per_job_string.replace(/[^0-9.]+/g, '');
        //     var amount_per_job = parseFloat(number_format_amount_per);
        //     if (isNaN(amount_per_job)) {
        //         amount_per_job = 0;
        //     }
        //     var total_percent = 0;
        //     var total_amount = 0;
        //     var total_required_leads = 0;
        //     var total_needed_leads = 0;
        //     var total_extra_leads = 0;
        //     var total_extra_amount = 0;
        //     $('.month_percentate').each(function(i, obj) {
        //         if($(this).val()=='' || $(this).val()==8){
        //             monthly_amount = ((estimated_amount/12.5));
        //             monthly_percentage = ((100/12.5));
        //         }else{
        //             monthly_amount = ((estimated_amount*$(this).val())/100);
        //             monthly_percentage = (($(this).val()));
        //         }
        //         $(this).val(Math.round(monthly_percentage));
        //         var month_required_leads = ((monthly_amount/amount_per_job));
        //         var month_needed_leads = ((month_required_leads/$('#job_convertion_ratio').val()*100));
        //         var month_extra_leads = ((month_needed_leads/100*$('#extra_push').val()));
        //         var month_extra_amount = ((month_extra_leads*amount_per_job));
        //         if(isNaN(month_extra_amount)){
        //             month_extra_amount = 0;
        //         }
        //         $(this).closest(".row").find('.month_amount').val('$'+Math.round(monthly_amount).toLocaleString());
        //         $(this).closest(".row").find('.month_required_leads').val(Math.round(month_required_leads));
        //         $(this).closest(".row").find('.month_needed_leads').val(Math.round(month_needed_leads));
        //         $(this).closest(".row").find('.month_extra_leads').val(Math.round(month_extra_leads));
        //         $(this).closest(".row").find('.month_extra_amount').val('$'+Math.round(month_extra_amount).toLocaleString());
        //         total_percent += parseInt(monthly_percentage);
        //         total_amount += monthly_amount;
        //         total_required_leads += month_required_leads;
        //         total_needed_leads += month_needed_leads;
        //         total_extra_leads += month_extra_leads;
        //         total_extra_amount += month_extra_amount;
        //     });
        //     $(".total_percent").val(Math.round(total_percent)+'%');
        //     $(".total_amount").val('$'+total_amount.toLocaleString());
        //     $(".total_required_leads").val(Math.round(total_required_leads));
        //     $(".total_needed_leads").val(Math.round(total_needed_leads));
        //     $(".total_extra_leads").val(Math.round(total_extra_leads));
        //     $(".total_extra_amount").val('$'+total_extra_amount.toLocaleString());
        // }
        $(document).on('keyup keydown change', '.calculation', function(e) {
            calculation();
        });

        $('.select_new_year_estimation').select2({
            placeholder: "Select Year",
            allowClear: true,
        });

        function calculation() {
            var estimated_amount_string = $('#estimate_amount').val();
            var number_format_estimated_amount = estimated_amount_string.replace(/[^0-9.]+/g, '');
            var estimated_amount = parseFloat(number_format_estimated_amount);
            if (isNaN(estimated_amount)) {
                estimated_amount = 0;
            }

            var amount_per_job_string = $('#amount_per_job').val();
            var number_format_amount_per = amount_per_job_string.replace(/[^0-9.]+/g, '');
            var amount_per_job = parseFloat(number_format_amount_per);
            if (isNaN(amount_per_job) || amount_per_job === 0) {
                amount_per_job = 1; // Avoid division by zero
            }

            var job_conversion_ratio = parseFloat($('#job_convertion_ratio').val());
            if (isNaN(job_conversion_ratio) || job_conversion_ratio === 0) {
                job_conversion_ratio = 1; // Avoid division by zero
            }

            var extra_push = parseFloat($('#extra_push').val());
            if (isNaN(extra_push)) {
                extra_push = 0; // Default to 0 if empty
            }

            var total_percent = 0;
            var total_amount = 0;
            var total_required_leads = 0;
            var total_needed_leads = 0;
            var total_extra_leads = 0;
            var total_extra_amount = 0;

            $('.month_percentate').each(function(i, obj) {
                var monthly_amount = 0, monthly_percentage = 0;

                // Calculate monthly percentage and amount
                if ($(this).val() === '' || $(this).val() == 8) {
                    monthly_amount = (estimated_amount / 12.5);
                    monthly_percentage = (100 / 12.5);
                } else {
                    monthly_percentage = parseFloat($(this).val());
                    if (isNaN(monthly_percentage)) {
                        monthly_percentage = 0; // Handle invalid percentages
                    }
                    monthly_amount = (estimated_amount * monthly_percentage) / 100;
                }

                $(this).val(Math.round(monthly_percentage));

                // Calculate required leads
                var month_required_leads = (monthly_amount / amount_per_job);
                if (isNaN(month_required_leads)) {
                    month_required_leads = 0;
                }
                // Calculate needed and extra leads
                var month_needed_leads = (month_required_leads / job_conversion_ratio) * 100;
                var month_extra_leads = (month_needed_leads / 100) * extra_push;
                var month_extra_amount = month_extra_leads * amount_per_job;

                if (isNaN(month_extra_amount)) {
                    month_extra_amount = 0;
                }

                // Update DOM elements
                $(this).closest(".row").find('.month_amount').val('$' + Math.round(monthly_amount).toLocaleString());
                $(this).closest(".row").find('.month_required_leads').val(Math.round(month_required_leads));
                $(this).closest(".row").find('.month_needed_leads').val(Math.round(month_needed_leads));
                $(this).closest(".row").find('.month_extra_leads').val(Math.round(month_extra_leads));
                $(this).closest(".row").find('.month_extra_amount').val('$' + Math.round(month_extra_amount).toLocaleString());

                // Accumulate totals
                total_percent += monthly_percentage;
                total_amount += monthly_amount;
                total_required_leads += month_required_leads; // Correctly accumulating here
                total_needed_leads += month_needed_leads;
                total_extra_leads += month_extra_leads;
                total_extra_amount += month_extra_amount;
                // console.log('month need lead:', month_required_leads);
            });


            // Update total values in DOM
            $(".total_percent").val(Math.round(total_percent) + '%');
            $(".total_amount").val('$' + total_amount.toLocaleString());
            $(".total_required_leads").val(Math.round(total_required_leads));
            $(".total_needed_leads").val(Math.round(total_needed_leads));
            $(".total_extra_leads").val(Math.round(total_extra_leads));
            $(".total_extra_amount").val('$' + total_extra_amount.toLocaleString());
        }
        calculation();
        $(document).ready(function() {
            $('#estimate_amount').on('input', function() {
                var sanitizedValue = $(this).val().replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
                if (!isNaN(parseFloat(sanitizedValue)) && sanitizedValue !== '') {
                    sanitizedValue = parseFloat(sanitizedValue).toLocaleString('en-US', { minimumFractionDigits: 0, maximumFractionDigits: 2 });
                }
                $(this).val(sanitizedValue);
            }).on('blur', function() {
                var value = $(this).val().replace(/,/g, '');
                if (!isNaN(parseFloat(value)) && value !== '') {
                    $(this).val(parseFloat(value).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                }
            });
        });
        $(document).ready(function() {
            $('#amount_per_job').on('input', function() {
                var sanitizedValue = $(this).val().replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
                if (!isNaN(parseFloat(sanitizedValue)) && sanitizedValue !== '') {
                    sanitizedValue = parseFloat(sanitizedValue).toLocaleString('en-US', { minimumFractionDigits: 0, maximumFractionDigits: 2 });
                }
                $(this).val(sanitizedValue);
            })
                .on('blur', function() {
                    var value = $(this).val().replace(/,/g, '');
                    if (!isNaN(parseFloat(value)) && value !== '') {
                        $(this).val(parseFloat(value).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                    }
                });
        });

        $(document).ready(function() {
            $('#year_estimation_create_form,#year_estimation_edit_form').validate({
                ignore: [],
                rules: {
                    estimate_value: {
                        required: true,
                        number: true,
                        min: 1
                    },
                    estimate_amount: {
                        required: true,
                        number: true,
                    },
                    amount_per_job: {
                        required: true,
                        number: true,
                    },
                    job_convertion_ratio: {
                        required: true,
                        number: true,
                        min: 1
                    },
                },
                messages: {
                    estimate_value: {
                        required: "Please enter value",
                        number: "Please enter valid number",
                    },
                    estimate_amount: {
                        required: "Please enter amount",
                        number: "Please enter valid number",
                    },
                    amount_per_job: {
                        required: "Please enter amount per job",
                        number: "Please enter valid number",
                    },
                    job_convertion_ratio: {
                        required: "Please enter job convertion ratio",
                        number: "Please enter valid number",
                        min: "Please enter valid Job Conversion Ratio %"
                    },
                }
            })
        });
    </script>
@endpush
