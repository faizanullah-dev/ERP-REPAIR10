<div class="form-group {{ $errors->has('roof_estimate_calculator_id') ? 'has-error' : ''}}">
    <label for="roof_estimate_calculator_id" class="col-md-4 control-label">{{ 'Roof Estimate Calculator Id' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="roof_estimate_calculator_id" type="textarea" id="roof_estimate_calculator_id" >{{ $roofestimatecalculatorflatroof->roof_estimate_calculator_id??''}}</textarea>
        {!! $errors->first('roof_estimate_calculator_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('recommended_price') ? 'has-error' : ''}}">
    <label for="recommended_price" class="col-md-4 control-label">{{ 'Recommended Price' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="recommended_price" type="textarea" id="recommended_price" >{{ $roofestimatecalculatorflatroof->recommended_price??''}}</textarea>
        {!! $errors->first('recommended_price', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('roofing_price') ? 'has-error' : ''}}">
    <label for="roofing_price" class="col-md-4 control-label">{{ 'Roofing Price' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="roofing_price" type="textarea" id="roofing_price" >{{ $roofestimatecalculatorflatroof->roofing_price??''}}</textarea>
        {!! $errors->first('roofing_price', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('total_sq') ? 'has-error' : ''}}">
    <label for="total_sq" class="col-md-4 control-label">{{ 'Total Sq' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="total_sq" type="textarea" id="total_sq" >{{ $roofestimatecalculatorflatroof->total_sq??''}}</textarea>
        {!! $errors->first('total_sq', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('additional_layer') ? 'has-error' : ''}}">
    <label for="additional_layer" class="col-md-4 control-label">{{ 'Additional Layer' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="additional_layer" type="textarea" id="additional_layer" >{{ $roofestimatecalculatorflatroof->additional_layer??''}}</textarea>
        {!! $errors->first('additional_layer', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('additional_layer_price_per_sq') ? 'has-error' : ''}}">
    <label for="additional_layer_price_per_sq" class="col-md-4 control-label">{{ 'Additional Layer Price Per Sq' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="additional_layer_price_per_sq" type="textarea" id="additional_layer_price_per_sq" >{{ $roofestimatecalculatorflatroof->additional_layer_price_per_sq??''}}</textarea>
        {!! $errors->first('additional_layer_price_per_sq', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('step_charge') ? 'has-error' : ''}}">
    <label for="step_charge" class="col-md-4 control-label">{{ 'Step Charge' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="step_charge" type="textarea" id="step_charge" >{{ $roofestimatecalculatorflatroof->step_charge??''}}</textarea>
        {!! $errors->first('step_charge', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('step_charge_price_per_sq') ? 'has-error' : ''}}">
    <label for="step_charge_price_per_sq" class="col-md-4 control-label">{{ 'Step Charge Price Per Sq' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="step_charge_price_per_sq" type="textarea" id="step_charge_price_per_sq" >{{ $roofestimatecalculatorflatroof->step_charge_price_per_sq??''}}</textarea>
        {!! $errors->first('step_charge_price_per_sq', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('chimney_size') ? 'has-error' : ''}}">
    <label for="chimney_size" class="col-md-4 control-label">{{ 'Chimney Size' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="chimney_size" type="textarea" id="chimney_size" >{{ $roofestimatecalculatorflatroof->chimney_size??''}}</textarea>
        {!! $errors->first('chimney_size', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('chimney_size_price_per_sq') ? 'has-error' : ''}}">
    <label for="chimney_size_price_per_sq" class="col-md-4 control-label">{{ 'Chimney Size Price Per Sq' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="chimney_size_price_per_sq" type="textarea" id="chimney_size_price_per_sq" >{{ $roofestimatecalculatorflatroof->chimney_size_price_per_sq??''}}</textarea>
        {!! $errors->first('chimney_size_price_per_sq', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('siding_azeck') ? 'has-error' : ''}}">
    <label for="siding_azeck" class="col-md-4 control-label">{{ 'Siding Azeck' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="siding_azeck" type="textarea" id="siding_azeck" >{{ $roofestimatecalculatorflatroof->siding_azeck??''}}</textarea>
        {!! $errors->first('siding_azeck', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('siding_azeck_price_per_sq') ? 'has-error' : ''}}">
    <label for="siding_azeck_price_per_sq" class="col-md-4 control-label">{{ 'Siding Azeck Price Per Sq' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="siding_azeck_price_per_sq" type="textarea" id="siding_azeck_price_per_sq" >{{ $roofestimatecalculatorflatroof->siding_azeck_price_per_sq??''}}</textarea>
        {!! $errors->first('siding_azeck_price_per_sq', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('plywood') ? 'has-error' : ''}}">
    <label for="plywood" class="col-md-4 control-label">{{ 'Plywood' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="plywood" type="textarea" id="plywood" >{{ $roofestimatecalculatorflatroof->plywood??''}}</textarea>
        {!! $errors->first('plywood', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('plywood_price_per_sq') ? 'has-error' : ''}}">
    <label for="plywood_price_per_sq" class="col-md-4 control-label">{{ 'Plywood Price Per Sq' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="plywood_price_per_sq" type="textarea" id="plywood_price_per_sq" >{{ $roofestimatecalculatorflatroof->plywood_price_per_sq??''}}</textarea>
        {!! $errors->first('plywood_price_per_sq', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('skylight_price') ? 'has-error' : ''}}">
    <label for="skylight_price" class="col-md-4 control-label">{{ 'Skylight Price' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="skylight_price" type="textarea" id="skylight_price" >{{ $roofestimatecalculatorflatroof->skylight_price??''}}</textarea>
        {!! $errors->first('skylight_price', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('skylight_price_price_per_sq') ? 'has-error' : ''}}">
    <label for="skylight_price_price_per_sq" class="col-md-4 control-label">{{ 'Skylight Price Price Per Sq' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="skylight_price_price_per_sq" type="textarea" id="skylight_price_price_per_sq" >{{ $roofestimatecalculatorflatroof->skylight_price_price_per_sq??''}}</textarea>
        {!! $errors->first('skylight_price_price_per_sq', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('materials_price_price_per_sq') ? 'has-error' : ''}}">
    <label for="materials_price_price_per_sq" class="col-md-4 control-label">{{ 'Materials Price Price Per Sq' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="materials_price_price_per_sq" type="textarea" id="materials_price_price_per_sq" >{{ $roofestimatecalculatorflatroof->materials_price_price_per_sq??''}}</textarea>
        {!! $errors->first('materials_price_price_per_sq', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('materials_price_price_final') ? 'has-error' : ''}}">
    <label for="materials_price_price_final" class="col-md-4 control-label">{{ 'Materials Price Price Final' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="materials_price_price_final" type="textarea" id="materials_price_price_final" >{{ $roofestimatecalculatorflatroof->materials_price_price_final??''}}</textarea>
        {!! $errors->first('materials_price_price_final', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('labour_price_price_per_sq') ? 'has-error' : ''}}">
    <label for="labour_price_price_per_sq" class="col-md-4 control-label">{{ 'Labour Price Price Per Sq' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="labour_price_price_per_sq" type="textarea" id="labour_price_price_per_sq" >{{ $roofestimatecalculatorflatroof->labour_price_price_per_sq??''}}</textarea>
        {!! $errors->first('labour_price_price_per_sq', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('labour_price_price_final') ? 'has-error' : ''}}">
    <label for="labour_price_price_final" class="col-md-4 control-label">{{ 'Labour Price Price Final' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="labour_price_price_final" type="textarea" id="labour_price_price_final" >{{ $roofestimatecalculatorflatroof->labour_price_price_final??''}}</textarea>
        {!! $errors->first('labour_price_price_final', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('dumpster_price_price_per_sq') ? 'has-error' : ''}}">
    <label for="dumpster_price_price_per_sq" class="col-md-4 control-label">{{ 'Dumpster Price Price Per Sq' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="dumpster_price_price_per_sq" type="textarea" id="dumpster_price_price_per_sq" >{{ $roofestimatecalculatorflatroof->dumpster_price_price_per_sq??''}}</textarea>
        {!! $errors->first('dumpster_price_price_per_sq', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('dumster_price_price_final') ? 'has-error' : ''}}">
    <label for="dumster_price_price_final" class="col-md-4 control-label">{{ 'Dumster Price Price Final' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="dumster_price_price_final" type="textarea" id="dumster_price_price_final" >{{ $roofestimatecalculatorflatroof->dumster_price_price_final??''}}</textarea>
        {!! $errors->first('dumster_price_price_final', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('permit_warranty_price_price_per_sq') ? 'has-error' : ''}}">
    <label for="permit_warranty_price_price_per_sq" class="col-md-4 control-label">{{ 'Permit Warranty Price Price Per Sq' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="permit_warranty_price_price_per_sq" type="textarea" id="permit_warranty_price_price_per_sq" >{{ $roofestimatecalculatorflatroof->permit_warranty_price_price_per_sq??''}}</textarea>
        {!! $errors->first('permit_warranty_price_price_per_sq', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('permit_warranty_price_price_final') ? 'has-error' : ''}}">
    <label for="permit_warranty_price_price_final" class="col-md-4 control-label">{{ 'Permit Warranty Price Price Final' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="permit_warranty_price_price_final" type="textarea" id="permit_warranty_price_price_final" >{{ $roofestimatecalculatorflatroof->permit_warranty_price_price_final??''}}</textarea>
        {!! $errors->first('permit_warranty_price_price_final', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('project_cost') ? 'has-error' : ''}}">
    <label for="project_cost" class="col-md-4 control-label">{{ 'Project Cost' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="project_cost" type="textarea" id="project_cost" >{{ $roofestimatecalculatorflatroof->project_cost??''}}</textarea>
        {!! $errors->first('project_cost', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('margin_profit') ? 'has-error' : ''}}">
    <label for="margin_profit" class="col-md-4 control-label">{{ 'Margin Profit' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="margin_profit" type="textarea" id="margin_profit" >{{ $roofestimatecalculatorflatroof->margin_profit??''}}</textarea>
        {!! $errors->first('margin_profit', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('super_percentage') ? 'has-error' : ''}}">
    <label for="super_percentage" class="col-md-4 control-label">{{ 'Super Percentage' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="super_percentage" type="textarea" id="super_percentage" >{{ $roofestimatecalculatorflatroof->super_percentage??''}}</textarea>
        {!! $errors->first('super_percentage', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('super_price_price_final') ? 'has-error' : ''}}">
    <label for="super_price_price_final" class="col-md-4 control-label">{{ 'Super Price Price Final' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="super_price_price_final" type="textarea" id="super_price_price_final" >{{ $roofestimatecalculatorflatroof->super_price_price_final??''}}</textarea>
        {!! $errors->first('super_price_price_final', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('sales_percentage') ? 'has-error' : ''}}">
    <label for="sales_percentage" class="col-md-4 control-label">{{ 'Sales Percentage' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="sales_percentage" type="textarea" id="sales_percentage" >{{ $roofestimatecalculatorflatroof->sales_percentage??''}}</textarea>
        {!! $errors->first('sales_percentage', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('sales_price_price_final') ? 'has-error' : ''}}">
    <label for="sales_price_price_final" class="col-md-4 control-label">{{ 'Sales Price Price Final' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="sales_price_price_final" type="textarea" id="sales_price_price_final" >{{ $roofestimatecalculatorflatroof->sales_price_price_final??''}}</textarea>
        {!! $errors->first('sales_price_price_final', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('directory_cost') ? 'has-error' : ''}}">
    <label for="directory_cost" class="col-md-4 control-label">{{ 'Directory Cost' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="directory_cost" type="textarea" id="directory_cost" >{{ $roofestimatecalculatorflatroof->directory_cost??''}}</textarea>
        {!! $errors->first('directory_cost', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('net_profit') ? 'has-error' : ''}}">
    <label for="net_profit" class="col-md-4 control-label">{{ 'Net Profit' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="net_profit" type="textarea" id="net_profit" >{{ $roofestimatecalculatorflatroof->net_profit??''}}</textarea>
        {!! $errors->first('net_profit', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('margin_percentage') ? 'has-error' : ''}}">
    <label for="margin_percentage" class="col-md-4 control-label">{{ 'Margin Percentage' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="margin_percentage" type="textarea" id="margin_percentage" >{{ $roofestimatecalculatorflatroof->margin_percentage??''}}</textarea>
        {!! $errors->first('margin_percentage', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('net_profit_percentage') ? 'has-error' : ''}}">
    <label for="net_profit_percentage" class="col-md-4 control-label">{{ 'Net Profit Percentage' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="net_profit_percentage" type="textarea" id="net_profit_percentage" >{{ $roofestimatecalculatorflatroof->net_profit_percentage??''}}</textarea>
        {!! $errors->first('net_profit_percentage', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
