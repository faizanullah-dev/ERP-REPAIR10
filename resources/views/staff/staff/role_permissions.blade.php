{{--<div class="form-group">--}}
{{--    <label for="status" class="col-md-4 control-label">{{ 'Permissions' }}</label>--}}
{{--    <div class="mb-3 checkbox_btn_box col-md-12">--}}
{{--        @forelse($role->permissions as $key=>$permission)--}}
{{--            <div class="single_checkbox_btn borderRadius">--}}
{{--                <input type="checkbox" class="form-check-input" name="permissions[]" id="permissions{{$key}}" value="{{$permission->id}}" disabled checked >--}}
{{--                <div class="green_circle"></div>--}}
{{--                <label for="permissions{{$key}}" class="form-label input_labels p-18">{{ucwords(str_replace('-',' ',$permission->name)) }}</label>--}}
{{--            </div>--}}
{{--        @empty--}}
{{--            <div class="col-md-6">--}}
{{--                <input class="form-control"  type="text" value="Not Available" disabled >--}}
{{--            </div>--}}
{{--        @endforelse--}}
{{--    </div>--}}
{{--</div>--}}


@php $permissionsData = []; $parrentPermissions = [];  $sortedArr = []; @endphp
@foreach($role->permissions as $key => $permission)
    @if(!in_array(explode('-', $permission->name)[1], $parrentPermissions))
        @php
            $parent =explode(' ',ucwords(str_replace('-',' ',$permission->name)))[1];
            $parentKey = str_replace(' ', '', $parent);
            array_push($parrentPermissions, explode('-', $permission->name)[1]);
            array_push($sortedArr, [
                'parent' => $parent,
                'children' => [],
                'childrenId' => []
            ]);
        @endphp
    @endif
    @php $parentIndex = array_search($parent, array_column($sortedArr, 'parent')); @endphp
    @if($parentIndex !== false)
        @php
            array_push($sortedArr[$parentIndex]['children'], ucwords(str_replace('-', ' ', $permission->name)));
            array_push($sortedArr[$parentIndex]['childrenId'], $permission->id);
        @endphp
    @endif
@endforeach
<div class="row">
    <div class="col-md-12 inner_section_user_permission_checks">
        <div class="row">
            @foreach($sortedArr as $key => $result)
                <div class="col-md-4">
                    <div class="parent_div">
                        <div class="custom_checkbox parent_checkbox">
                            <input id="chk_{{$key}}" type="checkbox" id="permissions{{$key}}" value="" disabled checked>
                            <label class="custom_check" for="chk_{{$key}}" >{{$result['parent']}}</label>
                        </div>
                        @foreach($result['children'] as $child_id=>$child)
                            <div class="child_div">
                                <div class="custom_checkbox">
                                    <input id="chk_{{$child}}" type="checkbox" name="permissions[]" id="permissions{{$key}}" disabled checked value="{{$result['childrenId'][$child_id]}}" required>
                                    <label class="custom_check" for="chk_{{$child}}">{{$child}}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>

