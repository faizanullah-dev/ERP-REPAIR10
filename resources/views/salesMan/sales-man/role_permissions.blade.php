<div class="form-group">
    <label for="status" class="col-md-4 control-label">{{ 'Permissions' }}</label>
    <div class="mb-3 checkbox_btn_box col-md-12">
        @forelse($role->permissions as $key=>$permission)
            <div class="single_checkbox_btn borderRadius">
                <input type="checkbox" class="form-check-input" name="permissions[]" id="permissions{{$key}}" value="{{$permission->id}}" disabled checked >
                <div class="green_circle"></div>
                <label for="permissions{{$key}}" class="form-label input_labels p-18">{{ucwords(str_replace('-',' ',$permission->name)) }}</label>
            </div>
        @empty
            <div class="col-md-6">
                <input class="form-control"  type="text" value="Not Available" disabled >
            </div>
        @endforelse
    </div>
</div>