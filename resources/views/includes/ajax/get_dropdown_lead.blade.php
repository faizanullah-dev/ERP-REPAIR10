@forelse($getData as $val)
    <option value="{{$val->id??''}}" @if($id == $val->id) selected @endif data-id="{{$id}}"> {{$val->title}} </option>
@empty
    <option value="no_data_found">No Data found</option>
@endforelse
