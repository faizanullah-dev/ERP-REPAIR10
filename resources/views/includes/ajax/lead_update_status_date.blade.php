<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="changeDateModalLabel">Change Date</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{ url("/leadStage/lead-stage", $leadStage->id) }}" accept-charset="UTF-8"
              class="form-horizontal" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}
            <input name="view_lead" value="1" type="hidden">
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="form-group ">
                        <label for="title" class=" control-label">Date</label>
                        <input class="form-control" name="date" type="date"
                               {{--                           value="{{ \Carbon\Carbon::parse($leadStage->date)->format('Y-m-d') }}">--}}
                               value="{{ $yearEstimation->year . '-01-01'??'---/--/--'}}">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-offset-4 ">
                    <button type="submit" class="btn green_btn borderRadius add_task_modal_btn ">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>