<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content my-0">
        <div class="modal-header">
            <h5 class="modal-title"> {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Stage') }}</h5>
            <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> × </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="left_align_text_tabel">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $stage->id }}</td>
                                </tr>
                                <tr>
                                    <th> Name </th>
                                    <td> {{ $stage->name??"Not Available" }} </td>
                                </tr>
                                <tr>
                                    <th> Colour </th>
                                    <td><span style="width: 20px; height: 20px; border-radius: 10px; display: inline-block; margin: 0 auto; background-color: {{ $stage->colour_id }}"></span></td>
                                </tr>
                                <tr>
                                    <th> Status </th>
                                    <td>
                                        @if($stage->status==1)
                                            <div class="status_btn">
                                                <badge class='badge btn-success badge-success'>Active </badge>
                                            </div>
                                        @else
                                            <div class="status_btn">
                                                <badge class='badge btn-warning badge-warning'>InActive</badge>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>