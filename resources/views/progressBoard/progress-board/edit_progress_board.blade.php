<div class="offcanvas create_task offcanvas-end" tabindex="-1" id="editOffcanvasRight" aria-labelledby="editOffcanvasRightLabel">
        <div class="offcanvas-header border-bottom">
            <h5 id="editOffcanvasRightLabel">Edit</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
    <div class="offcanvas-body">
        <form action="{{ route('store_progress_task') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="lead_id" id="task_lead_id">
            <input type="hidden" name="progress_name" id="progress_name">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="title" class="form-label input_labels">Title</label>
                        <input class="form-control clr_input_fields borderRadius" type="text" id="title" name="title">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group mt-5">
                        <label for="high_priority" class="form-label input_labels ">Priority</label>
                        <div class="form-check form-check-inline mt-3">
{{--                            @foreach($priorities as $key => $priority)--}}
{{--                                <input class="mx-3" type="radio" name="priority_id" id="priority{{ $key }}" value="{{ $priority->id }}" @if((!old('priority_id') && isset($task) && $task->priority_id == $priority->id) || (old('priority_id') == $priority->id)) checked  @endif required>--}}
{{--                                <label class="form-check-label fs-4" for="priority{{ $key }}">{{ $priority->name }}</label>--}}
{{--                            @endforeach--}}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group mt-5">
                        <label for="assign_to_user_id" class="form-label input_labels">Assign To User</label>
                        <select class="form-control clr_input_fields borderRadius select2" multiple name="assign_to_user_id[]" id="assign_to_user_id" required>
{{--                            @foreach($taskUsers as $user)--}}
{{--                                <option value="{{$user->id}}" @if(isset($task) && in_array($user->id, $task->getTaskAssignUser->pluck('user_id')->toArray())) selected @endif> {{$user->name??""}} </option>--}}
{{--                            @endforeach--}}
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="assign_to_lead_id" class="form-label input_labels">Assign To Team</label>
                        <select class="form-control clr_input_fields select2 borderRadius" name="assign_to_team_id" id="assign_to_team_id">
{{--                            @foreach($teams as $team)--}}
{{--                                <option value="{{$team->id}}" @if(isset($task) && $team->id == $task->assign_to_team_id) selected @endif>{{$team->name}}</option>--}}
{{--                            @endforeach--}}
                        </select>
                        {!! $errors->first('assign_to_team_id', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="due_date" class="form-label input_labels ">Due Date</label>
                        <input class="form-control clr_input_fields borderRadius" id="due_date" type="date" name="due_date">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="checkbox" name="link_to_job" id="link_to_job">
                        <label for="link_to_job" class="form-label input_labels ">Link To Job</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="note" class="form-label input_labels ">Note</label>
                        <textarea id="description" class="form-control clr_input_fields borderRadius" name="description"></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="images" class="form-label input_labels">Attachments</label>
                        <div action="#" id="taskDropzone" class="dropzone">
                            <div class="fallback">
                                <input name="images" id="images" type="file" multiple accept="image/*" required />
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="task_attachment" id="task_attachment">
                </div>
                <div class="canvas_footer">
                    <div class="footer_left">
                        <a href="javascript:void(0)" class="text-primary">Select Template</a>
                    </div>
                    <div class="footer_right">
                        <button type="submit" class="btn green_btn">Create</button>
                        <button type="button" class="btn secondary_btn text-reset" data-bs-dismiss="offcanvas" aria-label="Close">Cancel</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="offcanvas offcanvas-end" tabindex="-1" id="canvas_two" aria-labelledby="offcanvasRightLabel" style="width: 80%;">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Offcanvas right</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
    </div>
</div>