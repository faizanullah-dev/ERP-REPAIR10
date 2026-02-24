<div class="row">
    <div class="col-md-1">
        <div class="form-group {{ $errors->has('year') ? 'has-error' : ''}}">
            <label for="year" class="col-md-12 control-label">{{ 'Year' }}</label>
           @if(isset($yearestimation))
            <select class="form-control select2" id="year" name="year" >
                    @foreach((range(date('Y'), strftime("%Y", time()) + 100)) as $year))
                        <option value="{{$year}}" @if(isset($yearestimation) && $yearestimation->year == $year) selected @endif>{{$year}}</option>
                    @endforeach
            </select>
            @else
                <select class="form-control select2" id="year" name="year" >
                    @foreach((range(date('Y'), strftime("%Y", time()) + 100)) as $year))
                    @if(in_array($year, $years)) @continue @endif
                    <option value="{{$year}}" @if(isset($yearestimation) && $yearestimation->year == $year) selected @endif>{{$year}}</option>
                    @endforeach
                </select>
            @endif
                {!! $errors->first('year', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
            <label for="type" class="col-md-12 control-label">{{ 'Type' }}</label>
                <select class="form-control select2" id="type" name="type" >
                    <option value="Goal" @if(isset($yearestimation) && $yearestimation->type=='Goal') selected @endif>Goal</option>
                    <option value="Real Production" @if(isset($yearestimation) && $yearestimation->type=='Real Production') selected @endif>Real Production</option>
                 </select>
                {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('estimate_amount') ? 'has-error' : ''}}">
            <label for="estimate_amount" class="col-md-12 control-label">{{ 'Gross Income' }}</label>
                <input class="form-control calculation" name="estimate_amount" type="text" id="estimate_amount" value="{{$yearestimation->estimate_amount??2000000}}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
            {!! $errors->first('estimate_amount', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('amount_per_job') ? 'has-error' : ''}}">
            <label for="amount_per_job" class="col-md-12 control-label">{{ 'Amount Per Job' }}</label>
            <input class="form-control calculation" name="amount_per_job" type="text" id="amount_per_job" value="{{ $yearestimation->amount_per_job??11600}}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
            {!! $errors->first('amount_per_job', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('job_convertion_ratio') ? 'has-error' : ''}}">
            <label for="job_convertion_ratio" class="col-md-12 control-label">{{ 'Job Convertion Ratio %' }}</label>
            <input class="form-control calculation" name="job_convertion_ratio" type="text" id="job_convertion_ratio" value="{{ $yearestimation->job_convertion_ratio??30}}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
            {!! $errors->first('job_convertion_ratio', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('extra_push') ? 'has-error' : ''}}">
            <label for="extra_push" class="col-md-12 control-label">{{ 'Extra Push %' }}</label>
            <input class="form-control calculation" name="extra_push" type="text" id="extra_push" value="{{ $yearestimation->extra_push??40}}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
            {!! $errors->first('extra_push', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

</div>
<div class="row row_january">

    <div class="col-md-1">
        <div class="form-group {{ $errors->has('month_january') ? 'has-error' : ''}}">
            <label for="month_january" class="col-md-4 control-label">{{ 'Month' }}</label>
              <input class="form-control month" name="month[january][name]" type="text" id="month_january" readonly value="January">
            {!! $errors->first('month_january', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group {{ $errors->has('percentage_january') ? 'has-error' : ''}}">
            <label for="percentage_january" class="col-md-12 control-label">{{ 'Percent %' }}</label>
              <input class="form-control month_percentate calculation" name="month[january][percentage]" type="number" id="percentage_january" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
            {!! $errors->first('percentage_january', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('amount_january') ? 'has-error' : ''}}">
            <label for="amount_january" class="col-md-12 control-label">{{ 'Amount $' }}</label>
             <input class="form-control month_amount" name="month[january][amount]" type="text" id="amount_january" readonly >
            {!! $errors->first('amount_january', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('month_required_leads_january') ? 'has-error' : ''}}">
            <label for="month_required_leads_january" class="col-md-12 control-label">{{ 'Required Leads' }}</label>
            <input class="form-control month_required_leads" name="month[january][month_required_leads]" type="number" id="month_required_leads_january" readonly  >
            {!! $errors->first('month_required_leads_january', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('month_needed_leads_january') ? 'has-error' : ''}}">
            <label for="month_needed_leads_january" class="col-md-12 control-label">{{ 'Leads Needed' }}</label>
            <input class="form-control month_needed_leads" name="month[january][month_needed_leads]" type="number" id="month_needed_leads_january" readonly  >
            {!! $errors->first('estimate_amount', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('extra_leads_january') ? 'has-error' : ''}}">
            <label for="extra_leads_january" class="col-md-12 control-label">{{ 'Extra Leads' }}</label>
            <input class="form-control month_extra_leads" name="month[january][extra_leads]" type="number" id="extra_leads_january" readonly >
            {!! $errors->first('extra_leads_january', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('extra_amount_january') ? 'has-error' : ''}}">
            <label for="extra_amount_january" class="col-md-12 control-label">{{ 'Extra Amount $' }}</label>
            <input class="form-control month_extra_amount" name="month[january][extra_amount]" type="text" id="extra_amount_january" readonly>
            {!! $errors->first('extra_amount_january', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

</div>

<div class="row row_february">

    <div class="col-md-1">
        <div class="form-group {{ $errors->has('month_february') ? 'has-error' : ''}}">
              <input class="form-control month" name="month[february][name]" type="text" id="month_february" value="February" readonly>
            {!! $errors->first('month_february', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group {{ $errors->has('percentage_february') ? 'has-error' : ''}}">
              <input class="form-control month_percentate calculation" name="month[february][percentage]" type="number" id="percentage_february" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
            {!! $errors->first('percentage_february', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('amount_february') ? 'has-error' : ''}}">
             <input class="form-control month_amount" name="month[february][amount]" type="text" id="amount_february" readonly >
            {!! $errors->first('amount_february', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('month_required_leads_february') ? 'has-error' : ''}}">
            <input class="form-control month_required_leads" name="month[february][month_required_leads]" type="number" readonly id="month_required_leads_february">
            {!! $errors->first('month_required_leads_february', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('month_needed_leads_february') ? 'has-error' : ''}}">
            <input class="form-control month_needed_leads" name="month[february][month_needed_leads]" type="number" readonly id="month_needed_leads_february">
            {!! $errors->first('month_needed_leads_february', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('extra_leads_february') ? 'has-error' : ''}}">
            <input class="form-control month_extra_leads" name="month[february][extra_leads]" type="number" readonly id="extra_leads_february" >
            {!! $errors->first('extra_leads_february', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('extra_amount_february') ? 'has-error' : ''}}">
            <input class="form-control month_extra_amount" name="month[february][extra_amount]" type="text" readonly id="extra_amount_february" >
            {!! $errors->first('extra_amount_february', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

</div>


<div class="row row_march">

    <div class="col-md-1">
        <div class="form-group {{ $errors->has('month_march') ? 'has-error' : ''}}">
              <input class="form-control month" name="month[march][name]" type="text" id="month_march" value="March" readonly>
            {!! $errors->first('month_march', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group {{ $errors->has('percentage_march') ? 'has-error' : ''}}">
              <input class="form-control month_percentate calculation" name="month[march][percentage]" type="number" id="percentage_march" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
            {!! $errors->first('percentage_march', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('amount_march') ? 'has-error' : ''}}">
             <input class="form-control month_amount" name="month[march][amount]" type="text" readonly id="amount_march" >
            {!! $errors->first('amount_march', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('month_required_leads_march') ? 'has-error' : ''}}">
            <input class="form-control month_required_leads" name="month[march][month_required_leads]" readonly type="number" id="month_required_leads_march" >
            {!! $errors->first('month_required_leads_march', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('month_needed_leads_march') ? 'has-error' : ''}}">
            <input class="form-control month_needed_leads" name="month[march][month_needed_leads]" readonly type="number" id="month_needed_leads_march" >
            {!! $errors->first('month_needed_leads_march', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('extra_leads_march') ? 'has-error' : ''}}">
            <input class="form-control month_extra_leads" name="month[march][extra_leads]" type="number" readonly id="extra_leads_march" >
            {!! $errors->first('extra_leads_march', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('extra_amount_march') ? 'has-error' : ''}}">
            <input class="form-control month_extra_amount" name="month[march][extra_amount]" type="text" readonly id="extra_amount_march" >
            {!! $errors->first('extra_amount_march', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

</div>


<div class="row row_april">

    <div class="col-md-1">
        <div class="form-group {{ $errors->has('month_april') ? 'has-error' : ''}}">
              <input class="form-control month" name="month[april][name]" type="text" id="month_april" value="April" readonly>
            {!! $errors->first('month_april', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group {{ $errors->has('percentage_april') ? 'has-error' : ''}}">
              <input class="form-control month_percentate calculation" name="month[april][percentage]" type="number" id="percentage_april" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
            {!! $errors->first('percentage_april', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('amount_april') ? 'has-error' : ''}}">
             <input class="form-control month_amount" name="month[april][amount]" type="text" id="amount_april" readonly >
            {!! $errors->first('amount_april', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('month_required_leads_april') ? 'has-error' : ''}}">
            <input class="form-control month_required_leads" name="month[april][month_required_leads]" type="number" readonly id="month_required_leads_april" >
            {!! $errors->first('month_required_leads_april', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('month_needed_leads_april') ? 'has-error' : ''}}">
            <input class="form-control month_needed_leads" name="month[april][month_needed_leads]" type="number" readonly id="month_needed_leads_april" >
            {!! $errors->first('month_needed_leads_april', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('extra_leads_april') ? 'has-error' : ''}}">
            <input class="form-control month_extra_leads" name="month[april][extra_leads]" type="number" id="extra_leads_april"  readonly >
            {!! $errors->first('extra_leads_april', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('extra_amount_april') ? 'has-error' : ''}}">
            <input class="form-control month_extra_amount" name="month[april][extra_amount]" type="text" id="extra_amount_april"  readonly >
            {!! $errors->first('extra_amount_april', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

</div>


<div class="row row_may">

    <div class="col-md-1">
        <div class="form-group {{ $errors->has('month_may') ? 'has-error' : ''}}">
              <input class="form-control month" name="month[may][name]" type="text" id="month_may" value="May" readonly>
            {!! $errors->first('month_may', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group {{ $errors->has('percentage_may') ? 'has-error' : ''}}">
              <input class="form-control month_percentate calculation" name="month[may][percentage]" type="number" id="percentage_may" value="{{ $yearestimation->percentage??''}}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
            {!! $errors->first('percentage_may', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('amount_may') ? 'has-error' : ''}}">
             <input class="form-control month_amount" name="month[may][amount]" type="text" id="amount_may" readonly  >
            {!! $errors->first('amount_may', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('month_required_leads_may') ? 'has-error' : ''}}">
            <input class="form-control month_required_leads" name="month[may][month_required_leads]" type="number"  readonly id="month_required_leads_may">
            {!! $errors->first('month_required_leads_may', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('month_needed_leads_may') ? 'has-error' : ''}}">
            <input class="form-control month_needed_leads" name="month[may][month_needed_leads]" type="number"  readonly id="month_needed_leads_may" >
            {!! $errors->first('month_needed_leads_may', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('extra_leads_may') ? 'has-error' : ''}}">
            <input class="form-control month_extra_leads" name="month[may][extra_leads]" type="number"  readonly id="extra_leads_may" >
            {!! $errors->first('extra_leads_may', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('extra_amount_may') ? 'has-error' : ''}}">
            <input class="form-control month_extra_amount" name="month[may][extra_amount]" type="text"  readonly id="extra_amount_may" >
            {!! $errors->first('extra_amount_may', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

</div>


<div class="row row_june">

    <div class="col-md-1">
        <div class="form-group {{ $errors->has('month_june') ? 'has-error' : ''}}">
              <input class="form-control month" name="month[june][name]" type="text" id="month_june" value="June" readonly>
            {!! $errors->first('month_june', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group {{ $errors->has('percentage_june') ? 'has-error' : ''}}">
              <input class="form-control month_percentate calculation" name="month[june][percentage]" type="number" id="percentage_june" value="{{ $yearestimation->percentage??''}}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
            {!! $errors->first('percentage_june', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('amount_june') ? 'has-error' : ''}}">
             <input class="form-control month_amount" name="month[june][amount]" type="text" id="amount_june"  readonly>
            {!! $errors->first('amount_june', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('month_required_leads_june') ? 'has-error' : ''}}">
            <input class="form-control month_required_leads" name="month[june][month_required_leads]" type="number" readonly  id="month_required_leads_june"  >
            {!! $errors->first('month_required_leads_june', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('month_needed_leads_june') ? 'has-error' : ''}}">
            <input class="form-control month_needed_leads" name="month[june][month_needed_leads]" type="number" readonly  id="month_needed_leads_june" >
            {!! $errors->first('month_needed_leads_june', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('extra_leads_june') ? 'has-error' : ''}}">
            <input class="form-control month_extra_leads" name="month[june][extra_leads]" type="number" id="extra_leads_june" readonly  >
            {!! $errors->first('extra_leads_june', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('extra_amount_june') ? 'has-error' : ''}}">
            <input class="form-control month_extra_amount" name="month[june][extra_amount]" type="text" id="extra_amount_june"  readonly >
            {!! $errors->first('extra_amount_june', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

</div>


<div class="row row_july">

    <div class="col-md-1">
        <div class="form-group {{ $errors->has('month_july') ? 'has-error' : ''}}">
              <input class="form-control month" name="month[july][name]" type="text" id="month_july" value="July" readonly>
            {!! $errors->first('month_july', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group {{ $errors->has('percentage_july') ? 'has-error' : ''}}">
              <input class="form-control month_percentate calculation" name="month[july][percentage]" type="number" id="percentage_july" value="{{ $yearestimation->percentage??''}}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
            {!! $errors->first('percentage_july', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('amount_july') ? 'has-error' : ''}}">
             <input class="form-control month_amount" name="month[july][amount]" type="text" id="amount_july"  readonly >
            {!! $errors->first('amount_july', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('month_required_leads_july') ? 'has-error' : ''}}">
            <input class="form-control month_required_leads" name="month[july][month_required_leads]" type="number" readonly  id="month_required_leads_july" >
            {!! $errors->first('month_required_leads_july', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('month_needed_leads_july') ? 'has-error' : ''}}">
            <input class="form-control month_needed_leads" name="month[july][month_needed_leads]" type="number"  readonly id="month_needed_leads_july" >
            {!! $errors->first('month_needed_leads_july', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('extra_leads_july') ? 'has-error' : ''}}">
            <input class="form-control month_extra_leads" name="month[july][extra_leads]" type="number"  readonly id="extra_leads_july" >
            {!! $errors->first('extra_leads_july', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('extra_amount_january') ? 'has-error' : ''}}">
            <input class="form-control month_extra_amount" name="month[july][extra_amount]" type="text"  readonly id="extra_amount_january">
            {!! $errors->first('extra_amount_january', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

</div>


<div class="row row_august">

    <div class="col-md-1">
        <div class="form-group {{ $errors->has('month_august') ? 'has-error' : ''}}">
              <input class="form-control month" name="month[august][name]" type="text" id="month_august" value="august" readonly="" >
            {!! $errors->first('month_august', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group {{ $errors->has('percentage_august') ? 'has-error' : ''}}">
              <input class="form-control month_percentate calculation" name="month[august][percentage]" type="number" id="percentage_august" value="{{ $yearestimation->percentage??''}}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
            {!! $errors->first('percentage_august', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('amount_august') ? 'has-error' : ''}}">
             <input class="form-control month_amount" name="month[august][amount]" type="text" id="amount_august"  readonly >
            {!! $errors->first('amount_august', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('month_required_leads_august') ? 'has-error' : ''}}">
            <input class="form-control month_required_leads" name="month[august][month_required_leads]" type="number"  readonly id="month_required_leads_august">
            {!! $errors->first('month_required_leads_august', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('month_needed_leads_august') ? 'has-error' : ''}}">
            <input class="form-control month_needed_leads" name="month[august][month_needed_leads]" type="number"  readonly id="month_needed_leads_august" >
            {!! $errors->first('month_needed_leads_august', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('extra_leads_august') ? 'has-error' : ''}}">
            <input class="form-control month_extra_leads" name="month[august][extra_leads]" type="number"  readonly id="extra_leads_august" >
            {!! $errors->first('extra_leads_august', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('extra_amount_august') ? 'has-error' : ''}}">
            <input class="form-control month_extra_amount" name="month[august][extra_amount]" type="text" readonly  id="extra_amount_august"  >
            {!! $errors->first('extra_amount_august', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

</div>


<div class="row row_september">

    <div class="col-md-1">
        <div class="form-group {{ $errors->has('month_september') ? 'has-error' : ''}}">
              <input class="form-control month" name="month[september][name]" type="text" id="month_september" value="September" readonly >
            {!! $errors->first('month_september', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group {{ $errors->has('percentage_september') ? 'has-error' : ''}}">
              <input class="form-control month_percentate calculation" name="month[september][percentage]" type="number" id="percentage_september" value="{{ $yearestimation->percentage??''}}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
            {!! $errors->first('percentage_september', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('amount_september') ? 'has-error' : ''}}">
             <input class="form-control month_amount" name="month[september][amount]" type="text" id="amount_september" readonly  >
            {!! $errors->first('amount_september', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('month_required_leads_september') ? 'has-error' : ''}}">
            <input class="form-control month_required_leads" name="month[september][month_required_leads]" type="number"  readonly id="month_required_leads_september"  >
            {!! $errors->first('month_required_leads_september', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('month_needed_leads_september') ? 'has-error' : ''}}">
            <input class="form-control month_needed_leads" name="month[september][month_needed_leads]" type="number" readonly  id="month_needed_leads_september"  >
            {!! $errors->first('month_needed_leads_september', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('extra_leads_september') ? 'has-error' : ''}}">
            <input class="form-control month_extra_leads" name="month[september][extra_leads]" type="number"  readonly id="extra_leads_september"  >
            {!! $errors->first('extra_leads_september', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('extra_amount_september') ? 'has-error' : ''}}">
            <input class="form-control month_extra_amount" name="month[september][extra_amount]" type="text" readonly  id="extra_amount_september" >
            {!! $errors->first('extra_amount_september', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

</div>


<div class="row row_october">

    <div class="col-md-1">
        <div class="form-group {{ $errors->has('month_october') ? 'has-error' : ''}}">
              <input class="form-control month" name="month[october][name]" type="text" id="month_october" value="October" readonly >
            {!! $errors->first('month_october', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group {{ $errors->has('percentage_october') ? 'has-error' : ''}}">
              <input class="form-control month_percentate calculation" name="month[october][percentage]" type="number" id="percentage_october" value="{{ $yearestimation->percentage??''}}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
            {!! $errors->first('percentage_october', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('amount_october') ? 'has-error' : ''}}">
             <input class="form-control month_amount" name="month[october][amount]" type="text" id="amount_october"  readonly  >
            {!! $errors->first('amount_october', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('amount_october') ? 'has-error' : ''}}">
            <input class="form-control month_required_leads" name="month[october][month_required_leads]" type="number" readonly  id="month_required_leads_october"  >
            {!! $errors->first('amount_october', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('month_needed_leads_october') ? 'has-error' : ''}}">
            <input class="form-control month_needed_leads" name="month[october][month_needed_leads]" type="number" readonly  id="month_needed_leads_october"  >
            {!! $errors->first('month_needed_leads_october', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('extra_leads_october') ? 'has-error' : ''}}">
            <input class="form-control month_extra_leads" name="month[october][extra_leads]" type="number"  readonly id="extra_leads_october"  >
            {!! $errors->first('extra_leads_october', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('extra_amount_october') ? 'has-error' : ''}}">
            <input class="form-control month_extra_amount" name="month[october][extra_amount]" type="text"  readonly id="extra_amount_october"  >
            {!! $errors->first('extra_amount_october', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

</div>


<div class="row row_november">

    <div class="col-md-1">
        <div class="form-group {{ $errors->has('month_november') ? 'has-error' : ''}}">
              <input class="form-control month" name="month[november][name]" type="text" id="month_november" value="November" readonly >
            {!! $errors->first('month_november', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group {{ $errors->has('percentage_november') ? 'has-error' : ''}}">
              <input class="form-control month_percentate calculation" name="month[november][percentage]" type="number" id="percentage_november" value="{{ $yearestimation->percentage??''}}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
            {!! $errors->first('percentage_november', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('amount_november') ? 'has-error' : ''}}">
             <input class="form-control month_amount" name="month[november][amount]" type="text"  readonly id="amount_november"  >
            {!! $errors->first('amount_november', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('month_required_leads_november') ? 'has-error' : ''}}">
            <input class="form-control month_required_leads" name="month[november][month_required_leads]"  readonly type="number" id="month_required_leads_november"  >
            {!! $errors->first('month_required_leads_november', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('month_needed_leads_november') ? 'has-error' : ''}}">
            <input class="form-control month_needed_leads" name="month[november][month_needed_leads]" type="number"  readonly id="month_needed_leads_november"  >
            {!! $errors->first('month_needed_leads_november', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('extra_leads_november') ? 'has-error' : ''}}">
            <input class="form-control month_extra_leads" name="month[november][extra_leads]" type="number" readonly  id="extra_leads_november"  >
            {!! $errors->first('extra_leads_november', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('extra_amount_november') ? 'has-error' : ''}}">
            <input class="form-control month_extra_amount" name="month[november][extra_amount]" type="text" readonly  id="extra_amount_november"  >
            {!! $errors->first('extra_amount_november', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

</div>


<div class="row row_december">

    <div class="col-md-1">
        <div class="form-group {{ $errors->has('month_december') ? 'has-error' : ''}}">
              <input class="form-control month" name="month[december][name]" type="text" id="month_december" value="December" readonly="" >
            {!! $errors->first('month_december', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group {{ $errors->has('percentage_december') ? 'has-error' : ''}}">
              <input class="form-control month_percentate calculation" name="month[december][percentage]" type="number" id="percentage_december" value="{{ $yearestimation->percentage??''}}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
            {!! $errors->first('percentage_december', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('amount_december') ? 'has-error' : ''}}">
             <input class="form-control month_amount" name="month[december][amount]" type="text" id="amount_december"  readonly  >
            {!! $errors->first('amount_december', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('month_required_leads_december') ? 'has-error' : ''}}">
            <input class="form-control month_required_leads" name="month[december][month_required_leads]" type="number"  readonly id="month_required_leads_december"  >
            {!! $errors->first('month_required_leads_december', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('month_needed_leads_december') ? 'has-error' : ''}}">
            <input class="form-control month_needed_leads" name="month[december][month_needed_leads]" type="number" readonly  id="month_needed_leads_december"  >
            {!! $errors->first('month_needed_leads_december', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('extra_leads_december') ? 'has-error' : ''}}">
            <input class="form-control month_extra_leads" name="month[december][extra_leads]" type="number"  readonly id="extra_leads_december"  >
            {!! $errors->first('extra_leads_december', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {{ $errors->has('extra_amount_december') ? 'has-error' : ''}}">
            <input class="form-control month_extra_amount" name="month[december][extra_amount]" type="text"  readonly id="extra_amount_december"  >
            {!! $errors->first('extra_amount_december', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

</div>

<div class="row row_total">
    <hr>
    <div class="col-md-1">
        <div class="form-group">
          <input class="form-control" type="text" id="month_december" value="Total" >
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group">
              <b><input class="form-control total_percent"  type="text" readonly></b>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
             <input class="form-control total_amount" type="text" readonly >
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <input class="form-control total_required_leads" type="text" readonly>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <input class="form-control total_needed_leads" type="text" readonly >
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <input class="form-control total_extra_leads" type="text" readonly >
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
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>

@push('js')
    <script type="text/javascript">
        $(document).on('keyup keydown change','.calculation',function(e){
            // console.log('hello')
            calculation();
        });
        function calculation(){
            var estimated_amount = $('#estimate_amount').val();
            var amount_per_job = $('#amount_per_job').val();
            var total_percent=0;var total_amount=0;var total_required_leads=0;var total_needed_leads=0;var total_extra_leads=0;var total_extra_amount=0;
            $('.month_percentate').each(function(i, obj) {
                if($(this).val()=='' || $(this).val()==8){
                    monthly_amount      = ((estimated_amount/12.5));
                    monthly_percentage  = ((100/12.5));
                }else{
                    monthly_amount      = ((estimated_amount*$(this).val())/100);
                    monthly_percentage  = (($(this).val()));
                }
                $(this).val(Math.round(monthly_percentage));
                var month_required_leads  = ((monthly_amount/amount_per_job));
                var month_needed_leads  = ((month_required_leads/$('#job_convertion_ratio').val()*100));
                var month_extra_leads  = ((month_needed_leads/100*$('#extra_push').val()));
                var month_extra_amount  =((month_extra_leads*amount_per_job));
                var month_required_leads  = ((monthly_amount/amount_per_job));
                var month_needed_leads  = ((month_required_leads/$('#job_convertion_ratio').val()*100));
                $(this).closest( ".row" ).find('.month_amount').val('$'+Math.round(monthly_amount).toLocaleString());
                $(this).closest( ".row" ).find('.month_required_leads').val(Math.round(month_required_leads));
                $(this).closest( ".row" ).find('.month_needed_leads').val(Math.round(month_needed_leads));
                $(this).closest( ".row" ).find('.month_extra_leads').val(Math.round(month_extra_leads));
                $(this).closest( ".row" ).find('.month_extra_amount').val('$'+Math.round(month_extra_amount).toLocaleString());
                total_percent +=parseInt(monthly_percentage);
                total_amount +=monthly_amount;
                total_required_leads +=month_required_leads;
                total_needed_leads +=month_needed_leads;
                total_extra_leads +=month_extra_leads;
                total_extra_amount +=month_extra_amount;
            });
            $(".total_percent").val(Math.round(total_percent)+'%');
            $(".total_amount").val('$'+total_amount.toLocaleString());
            $(".total_required_leads").val(Math.round(total_required_leads));
            $(".total_needed_leads").val(Math.round(total_needed_leads));
            $(".total_extra_leads").val(Math.round(total_extra_leads));
            $(".total_extra_amount").val('$'+total_extra_amount.toLocaleString());
        }

        // function calculation(){
        //     var estimated_amount = $('#estimate_amount').val();
        //     var monthly_amount;
        //     var monthly_percentage;
        //     if (estimated_amount>0) {

        //         if($('.default_percent').val()<=0 || $('.default_percent').val()==8){
        //              monthly_amount      = ((estimated_amount/12.5));
        //              monthly_percentage  = ((100/12.5));
        //         }else{
        //             console.log($('.default_percent').val());
        //             console.log(estimated_amount);
        //              monthly_amount      = ((estimated_amount/$('.default_percent').val()));
        //              monthly_percentage  = ((100/$('.default_percent').val()));
        //         }
        //            // console.log(monthly_percentage)
        //         var amount_per_job = $('#amount_per_job').val();
        //         var month_required_leads  = ((monthly_amount/amount_per_job));
        //         var month_needed_leads  = ((month_required_leads/$('#job_convertion_ratio').val()*100));
        //         var month_extra_leads  = ((month_needed_leads/100*$('#extra_push').val()));
        //         var month_extra_amount  =((month_extra_leads*amount_per_job));
        //         $('.month_amount').val(Math.round(monthly_amount));
        //         $('.month_percentage').val(Math.round(monthly_percentage));
        //         $('.month_required_leads').val(Math.round(month_required_leads));
        //         $('.month_needed_leads').val(Math.round(month_needed_leads));
        //         $('.month_extra_leads').val(Math.round(month_extra_leads));
        //         $('.month_extra_amount').val(Math.round(month_extra_amount));
        //         //month_extra_leads
        //     }else{
        //         $('.month_amount').val('');
        //         $('.month_percentage').val('');
        //         $('.month_required_leads').val('');
        //         $('.month_needed_leads').val('');
        //         $('.month_extra_leads').val('');
        //         $('.month_extra_amount').val('');
        //     }
        // }
        // call this function default.
        calculation();

    </script>
@endpush