<div class="form-group {{ $errors->has('new_role_name') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'New Role' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="new_role_name" type="text" id="status" value="{{ $staff->new_role_name??''}}" required >
        {!! $errors->first('new_role_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

{{--<div class="form-group">--}}
{{--    <label for="status" class="col-md-4 control-label">{{ 'Permissions' }}</label>--}}
{{--    <div class="mb-3 checkbox_btn_box col-md-12">--}}
{{--       @forelse($permissions as $key=>$permission)--}}
{{--            <div class="single_checkbox_btn borderRadius">--}}
{{--                <input type="checkbox" class="form-check-input" data-permiss="permiss_{{str_replace('-',' ',$permission->name)}}" name="permissions[]" id="permissions{{$key}}" value="{{$permission->id}}">--}}
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


<div class="row">
    <div class="col-md-12 inner_section_user_permission_checks">
        @php $permissionsData = [];  $parrentPermissions = [];  $sortedArr = []; @endphp
        @foreach($permissions as $key => $permission)
            @if(!in_array(explode('-', $permission->name)[1], $parrentPermissions)) @php
                $parent =explode(' ',ucwords(str_replace('-',' ',$permission->name)))[1];
                $parentKey = str_replace(' ', '', $parent);
                array_push($parrentPermissions, explode('-', $permission->name)[1]);
                array_push($sortedArr, [
                    'parent' => $parent,
                    'children' => [],
                    'childrenId' => []
                ]); @endphp
            @endif
            @php
                $parentIndex = array_search($parent, array_column($sortedArr, 'parent'));
            @endphp
            @if($parentIndex !== false)
                @php
                    array_push($sortedArr[$parentIndex]['children'], ucwords(str_replace('-', ' ', $permission->name)));
                    array_push($sortedArr[$parentIndex]['childrenId'], $permission->id);
                @endphp
            @endif
        @endforeach
        <div class="row">
            @foreach($sortedArr as $key => $result)
{{--                @if (!in_array($result['parent'], ['Customer', 'Staff', 'Category']))--}}
               <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="parent_div">
                            <div class="panel-heading">
                                <div class="custom_checkbox parent_checkbox">
                                    <input id="chk_{{$key}}" type="checkbox"  value="">
                                    <label class="custom_check" for="chk_{{$key}}" style=" font-weight: bold;">{{$result['parent']}}</label>
                                </div>
                                <div class="panel-action"><a href="#" data-perform="panel-collapse"><i class="fa fa-angle-down" style="font-size: 24px;"></i></a></div>
                            </div>
                            <div class="panel-wrapper collapse">
                                <div class="panel-body">
                                    @foreach($result['children'] as $child_id=>$child)
                                        <div class="child_div">
                                            <div class="custom_checkbox">
                                                <input id="chk_{{str_replace(' ', '_', $child)}}" type="checkbox" name="permissions[]" value="{{$result['childrenId'][$child_id]}}">
                                                <label class="custom_check" for="chk_{{str_replace(' ', '_', $child)}}">{{$child}}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
{{--                @endif--}}
            @endforeach
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.parent_checkbox input[type="checkbox"]').change(function () {
            var isChecked = $(this).is(':checked');
            $(this).closest('.parent_div').find('.child_div input[type="checkbox"]').prop('checked', isChecked);
        });
        $('.custom_checkbox input[id^="chk_Add"]').change(function () {
            var isChecked = $(this).is(':checked');
            $(this).closest('.parent_div').find('.child_div input[id^="chk_View"]').prop('checked', isChecked);
        });
        $('.custom_checkbox input[id^="chk_Edit"]').change(function () {
            var isChecked = $(this).is(':checked');
            $(this).closest('.parent_div').find('.child_div input[id^="chk_View"]').prop('checked', isChecked);
        });
    });
</script>