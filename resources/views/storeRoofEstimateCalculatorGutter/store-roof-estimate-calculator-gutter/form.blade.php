<div class="form-group {{ $errors->has('roof_estimate_calculator_id') ? 'has-error' : ''}}">
    <label for="roof_estimate_calculator_id" class="col-md-4 control-label">{{ 'Roof Estimate Calculator Id' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="roof_estimate_calculator_id" type="textarea" id="roof_estimate_calculator_id" >{{ $storeroofestimatecalculatorgutter->roof_estimate_calculator_id??''}}</textarea>
        {!! $errors->first('roof_estimate_calculator_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('recommended_price') ? 'has-error' : ''}}">
    <label for="recommended_price" class="col-md-4 control-label">{{ 'Recommended Price' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="recommended_price" type="textarea" id="recommended_price" >{{ $storeroofestimatecalculatorgutter->recommended_price??''}}</textarea>
        {!! $errors->first('recommended_price', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('gutter_sub_total') ? 'has-error' : ''}}">
    <label for="gutter_sub_total" class="col-md-4 control-label">{{ 'Gutter Sub Total' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="gutter_sub_total" type="textarea" id="gutter_sub_total" >{{ $storeroofestimatecalculatorgutter->gutter_sub_total??''}}</textarea>
        {!! $errors->first('gutter_sub_total', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('gutter_per_sq_price') ? 'has-error' : ''}}">
    <label for="gutter_per_sq_price" class="col-md-4 control-label">{{ 'Gutter Per Sq Price' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="gutter_per_sq_price" type="textarea" id="gutter_per_sq_price" >{{ $storeroofestimatecalculatorgutter->gutter_per_sq_price??''}}</textarea>
        {!! $errors->first('gutter_per_sq_price', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('gutter_sq_total_price') ? 'has-error' : ''}}">
    <label for="gutter_sq_total_price" class="col-md-4 control-label">{{ 'Gutter Sq Total Price' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="gutter_sq_total_price" type="textarea" id="gutter_sq_total_price" >{{ $storeroofestimatecalculatorgutter->gutter_sq_total_price??''}}</textarea>
        {!! $errors->first('gutter_sq_total_price', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('downspouts_sub_total') ? 'has-error' : ''}}">
    <label for="downspouts_sub_total" class="col-md-4 control-label">{{ 'Downspouts Sub Total' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="downspouts_sub_total" type="textarea" id="downspouts_sub_total" >{{ $storeroofestimatecalculatorgutter->downspouts_sub_total??''}}</textarea>
        {!! $errors->first('downspouts_sub_total', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('downspouts_per_sq_price') ? 'has-error' : ''}}">
    <label for="downspouts_per_sq_price" class="col-md-4 control-label">{{ 'Downspouts Per Sq Price' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="downspouts_per_sq_price" type="textarea" id="downspouts_per_sq_price" >{{ $storeroofestimatecalculatorgutter->downspouts_per_sq_price??''}}</textarea>
        {!! $errors->first('downspouts_per_sq_price', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('downspouts_sq_total_price') ? 'has-error' : ''}}">
    <label for="downspouts_sq_total_price" class="col-md-4 control-label">{{ 'Downspouts Sq Total Price' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="downspouts_sq_total_price" type="textarea" id="downspouts_sq_total_price" >{{ $storeroofestimatecalculatorgutter->downspouts_sq_total_price??''}}</textarea>
        {!! $errors->first('downspouts_sq_total_price', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('guards_sub_total') ? 'has-error' : ''}}">
    <label for="guards_sub_total" class="col-md-4 control-label">{{ 'Guards Sub Total' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="guards_sub_total" type="textarea" id="guards_sub_total" >{{ $storeroofestimatecalculatorgutter->guards_sub_total??''}}</textarea>
        {!! $errors->first('guards_sub_total', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('guards_per_sq_price') ? 'has-error' : ''}}">
    <label for="guards_per_sq_price" class="col-md-4 control-label">{{ 'Guards Per Sq Price' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="guards_per_sq_price" type="textarea" id="guards_per_sq_price" >{{ $storeroofestimatecalculatorgutter->guards_per_sq_price??''}}</textarea>
        {!! $errors->first('guards_per_sq_price', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('guards_sq_total_price') ? 'has-error' : ''}}">
    <label for="guards_sq_total_price" class="col-md-4 control-label">{{ 'Guards Sq Total Price' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="guards_sq_total_price" type="textarea" id="guards_sq_total_price" >{{ $storeroofestimatecalculatorgutter->guards_sq_total_price??''}}</textarea>
        {!! $errors->first('guards_sq_total_price', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('project_cost') ? 'has-error' : ''}}">
    <label for="project_cost" class="col-md-4 control-label">{{ 'Project Cost' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="project_cost" type="textarea" id="project_cost" >{{ $storeroofestimatecalculatorgutter->project_cost??''}}</textarea>
        {!! $errors->first('project_cost', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('margin_profit') ? 'has-error' : ''}}">
    <label for="margin_profit" class="col-md-4 control-label">{{ 'Margin Profit' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="margin_profit" type="textarea" id="margin_profit" >{{ $storeroofestimatecalculatorgutter->margin_profit??''}}</textarea>
        {!! $errors->first('margin_profit', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('super_percentage') ? 'has-error' : ''}}">
    <label for="super_percentage" class="col-md-4 control-label">{{ 'Super Percentage' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="super_percentage" type="textarea" id="super_percentage" >{{ $storeroofestimatecalculatorgutter->super_percentage??''}}</textarea>
        {!! $errors->first('super_percentage', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('super_total') ? 'has-error' : ''}}">
    <label for="super_total" class="col-md-4 control-label">{{ 'Super Total' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="super_total" type="textarea" id="super_total" >{{ $storeroofestimatecalculatorgutter->super_total??''}}</textarea>
        {!! $errors->first('super_total', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('sales_percentage') ? 'has-error' : ''}}">
    <label for="sales_percentage" class="col-md-4 control-label">{{ 'Sales Percentage' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="sales_percentage" type="textarea" id="sales_percentage" >{{ $storeroofestimatecalculatorgutter->sales_percentage??''}}</textarea>
        {!! $errors->first('sales_percentage', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('sales_total') ? 'has-error' : ''}}">
    <label for="sales_total" class="col-md-4 control-label">{{ 'Sales Total' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="sales_total" type="textarea" id="sales_total" >{{ $storeroofestimatecalculatorgutter->sales_total??''}}</textarea>
        {!! $errors->first('sales_total', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('direct_cost') ? 'has-error' : ''}}">
    <label for="direct_cost" class="col-md-4 control-label">{{ 'Direct Cost' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="direct_cost" type="textarea" id="direct_cost" >{{ $storeroofestimatecalculatorgutter->direct_cost??''}}</textarea>
        {!! $errors->first('direct_cost', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('net_profit') ? 'has-error' : ''}}">
    <label for="net_profit" class="col-md-4 control-label">{{ 'Net Profit' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="net_profit" type="textarea" id="net_profit" >{{ $storeroofestimatecalculatorgutter->net_profit??''}}</textarea>
        {!! $errors->first('net_profit', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('margin_percentage') ? 'has-error' : ''}}">
    <label for="margin_percentage" class="col-md-4 control-label">{{ 'Margin Percentage' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="margin_percentage" type="textarea" id="margin_percentage" >{{ $storeroofestimatecalculatorgutter->margin_percentage??''}}</textarea>
        {!! $errors->first('margin_percentage', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('net_profit_percentage') ? 'has-error' : ''}}">
    <label for="net_profit_percentage" class="col-md-4 control-label">{{ 'Net Profit Percentage' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="net_profit_percentage" type="textarea" id="net_profit_percentage" >{{ $storeroofestimatecalculatorgutter->net_profit_percentage??''}}</textarea>
        {!! $errors->first('net_profit_percentage', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('recommended_price_two') ? 'has-error' : ''}}">
    <label for="recommended_price_two" class="col-md-4 control-label">{{ 'Recommended Price Two' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="recommended_price_two" type="textarea" id="recommended_price_two" >{{ $storeroofestimatecalculatorgutter->recommended_price_two??''}}</textarea>
        {!! $errors->first('recommended_price_two', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('gutter_sub_total_two') ? 'has-error' : ''}}">
    <label for="gutter_sub_total_two" class="col-md-4 control-label">{{ 'Gutter Sub Total Two' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="gutter_sub_total_two" type="textarea" id="gutter_sub_total_two" >{{ $storeroofestimatecalculatorgutter->gutter_sub_total_two??''}}</textarea>
        {!! $errors->first('gutter_sub_total_two', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('gutter_per_sq_price_two') ? 'has-error' : ''}}">
    <label for="gutter_per_sq_price_two" class="col-md-4 control-label">{{ 'Gutter Per Sq Price Two' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="gutter_per_sq_price_two" type="textarea" id="gutter_per_sq_price_two" >{{ $storeroofestimatecalculatorgutter->gutter_per_sq_price_two??''}}</textarea>
        {!! $errors->first('gutter_per_sq_price_two', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('gutter_sq_total_price_two') ? 'has-error' : ''}}">
    <label for="gutter_sq_total_price_two" class="col-md-4 control-label">{{ 'Gutter Sq Total Price Two' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="gutter_sq_total_price_two" type="textarea" id="gutter_sq_total_price_two" >{{ $storeroofestimatecalculatorgutter->gutter_sq_total_price_two??''}}</textarea>
        {!! $errors->first('gutter_sq_total_price_two', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('downspouts_sub_total_two') ? 'has-error' : ''}}">
    <label for="downspouts_sub_total_two" class="col-md-4 control-label">{{ 'Downspouts Sub Total Two' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="downspouts_sub_total_two" type="textarea" id="downspouts_sub_total_two" >{{ $storeroofestimatecalculatorgutter->downspouts_sub_total_two??''}}</textarea>
        {!! $errors->first('downspouts_sub_total_two', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('downspouts_per_sq_price_two') ? 'has-error' : ''}}">
    <label for="downspouts_per_sq_price_two" class="col-md-4 control-label">{{ 'Downspouts Per Sq Price Two' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="downspouts_per_sq_price_two" type="textarea" id="downspouts_per_sq_price_two" >{{ $storeroofestimatecalculatorgutter->downspouts_per_sq_price_two??''}}</textarea>
        {!! $errors->first('downspouts_per_sq_price_two', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('downspouts_sq_total_price_two') ? 'has-error' : ''}}">
    <label for="downspouts_sq_total_price_two" class="col-md-4 control-label">{{ 'Downspouts Sq Total Price Two' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="downspouts_sq_total_price_two" type="textarea" id="downspouts_sq_total_price_two" >{{ $storeroofestimatecalculatorgutter->downspouts_sq_total_price_two??''}}</textarea>
        {!! $errors->first('downspouts_sq_total_price_two', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('guards_sub_total_two') ? 'has-error' : ''}}">
    <label for="guards_sub_total_two" class="col-md-4 control-label">{{ 'Guards Sub Total Two' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="guards_sub_total_two" type="textarea" id="guards_sub_total_two" >{{ $storeroofestimatecalculatorgutter->guards_sub_total_two??''}}</textarea>
        {!! $errors->first('guards_sub_total_two', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('guards_per_sq_price_two') ? 'has-error' : ''}}">
    <label for="guards_per_sq_price_two" class="col-md-4 control-label">{{ 'Guards Per Sq Price Two' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="guards_per_sq_price_two" type="textarea" id="guards_per_sq_price_two" >{{ $storeroofestimatecalculatorgutter->guards_per_sq_price_two??''}}</textarea>
        {!! $errors->first('guards_per_sq_price_two', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('guards_sq_total_price_two') ? 'has-error' : ''}}">
    <label for="guards_sq_total_price_two" class="col-md-4 control-label">{{ 'Guards Sq Total Price Two' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="guards_sq_total_price_two" type="textarea" id="guards_sq_total_price_two" >{{ $storeroofestimatecalculatorgutter->guards_sq_total_price_two??''}}</textarea>
        {!! $errors->first('guards_sq_total_price_two', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('project_cost_two') ? 'has-error' : ''}}">
    <label for="project_cost_two" class="col-md-4 control-label">{{ 'Project Cost Two' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="project_cost_two" type="textarea" id="project_cost_two" >{{ $storeroofestimatecalculatorgutter->project_cost_two??''}}</textarea>
        {!! $errors->first('project_cost_two', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('margin_profit_two') ? 'has-error' : ''}}">
    <label for="margin_profit_two" class="col-md-4 control-label">{{ 'Margin Profit Two' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="margin_profit_two" type="textarea" id="margin_profit_two" >{{ $storeroofestimatecalculatorgutter->margin_profit_two??''}}</textarea>
        {!! $errors->first('margin_profit_two', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('super_percentage_two') ? 'has-error' : ''}}">
    <label for="super_percentage_two" class="col-md-4 control-label">{{ 'Super Percentage Two' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="super_percentage_two" type="textarea" id="super_percentage_two" >{{ $storeroofestimatecalculatorgutter->super_percentage_two??''}}</textarea>
        {!! $errors->first('super_percentage_two', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('super_total_two') ? 'has-error' : ''}}">
    <label for="super_total_two" class="col-md-4 control-label">{{ 'Super Total Two' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="super_total_two" type="textarea" id="super_total_two" >{{ $storeroofestimatecalculatorgutter->super_total_two??''}}</textarea>
        {!! $errors->first('super_total_two', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('sales_percentage_two') ? 'has-error' : ''}}">
    <label for="sales_percentage_two" class="col-md-4 control-label">{{ 'Sales Percentage Two' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="sales_percentage_two" type="textarea" id="sales_percentage_two" >{{ $storeroofestimatecalculatorgutter->sales_percentage_two??''}}</textarea>
        {!! $errors->first('sales_percentage_two', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('sales_total_two') ? 'has-error' : ''}}">
    <label for="sales_total_two" class="col-md-4 control-label">{{ 'Sales Total Two' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="sales_total_two" type="textarea" id="sales_total_two" >{{ $storeroofestimatecalculatorgutter->sales_total_two??''}}</textarea>
        {!! $errors->first('sales_total_two', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('direct_cost_two') ? 'has-error' : ''}}">
    <label for="direct_cost_two" class="col-md-4 control-label">{{ 'Direct Cost Two' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="direct_cost_two" type="textarea" id="direct_cost_two" >{{ $storeroofestimatecalculatorgutter->direct_cost_two??''}}</textarea>
        {!! $errors->first('direct_cost_two', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('net_profit_two') ? 'has-error' : ''}}">
    <label for="net_profit_two" class="col-md-4 control-label">{{ 'Net Profit Two' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="net_profit_two" type="textarea" id="net_profit_two" >{{ $storeroofestimatecalculatorgutter->net_profit_two??''}}</textarea>
        {!! $errors->first('net_profit_two', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('margin_percentage_two') ? 'has-error' : ''}}">
    <label for="margin_percentage_two" class="col-md-4 control-label">{{ 'Margin Percentage Two' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="margin_percentage_two" type="textarea" id="margin_percentage_two" >{{ $storeroofestimatecalculatorgutter->margin_percentage_two??''}}</textarea>
        {!! $errors->first('margin_percentage_two', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('net_profit_percentage_two') ? 'has-error' : ''}}">
    <label for="net_profit_percentage_two" class="col-md-4 control-label">{{ 'Net Profit Percentage Two' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="net_profit_percentage_two" type="textarea" id="net_profit_percentage_two" >{{ $storeroofestimatecalculatorgutter->net_profit_percentage_two??''}}</textarea>
        {!! $errors->first('net_profit_percentage_two', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
