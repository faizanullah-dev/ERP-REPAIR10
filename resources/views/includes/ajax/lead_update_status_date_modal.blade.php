<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="changeDateModalLabel">Change Lead Status Date</h5>
            <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> × </button>
        </div>
        <form method="POST" action="{{ route('update_status_lead_date') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <input name="view_lead" value="1" type="hidden">
            <input name="lead_id" value="{{ $lead->id }}" type="hidden">
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="form-group ">
                        <label for="title" class=" control-label">Date</label>
                        <input class="form-control" name="lead_status_date" type="date" value="{{ $lead->lead_status_date ?? $yearEstimation->year . '-01-01' }}">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-offset-4 mt-3">
                    <button type="submit" class="btn btn-green add_task_modal_btn ">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>