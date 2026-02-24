<div class="form-group {{ $errors->has('lead_id') ? 'has-error' : ''}}">
    <label for="lead_id" class="col-md-4 control-label">{{ 'Lead Id' }}</label>
    <div class="col-md-6">
        <select class="form-control" name="lead_id" required>
            @foreach($lead as $item)
                <option value="{{ $item->id }}" @if(isset($progressboard) && $item->id == $progressboard->lead_id) selected @endif>{{ $item->title??"" }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group {{ $errors->has('lead_id') ? 'has-error' : ''}}">
    <label for="lead_id" class="col-md-4 control-label">{{ 'Category' }}</label>
    <div class="col-md-6">
        @forelse($categories as $key => $category)
            <input class="mx-3" type="checkbox" name="category_id[]" id="mark{{ $key }}" value="{{ $category->id }}"  @if(isset($progressboard) && in_array($category->id, $progressboard->getprogressBoardCategory->pluck('category_id')->toArray())) checked @endif required>
            <label class="form-check-label fs-4" for="mark{{ $key }}">{{ $category->name }}</label>
        @empty
            <label class="form-check-label fs-4" for="mark">No Category Available</label>
        @endforelse
    </div>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
