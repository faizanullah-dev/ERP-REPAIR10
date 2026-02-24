<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content my-0">
        <div class="modal-header">
            <h5 class="modal-title"> {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'EmailTemplateFolder') }}</h5>
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
                                    <td>{{ $emailtemplatefolder->id }}</td>
                                </tr>
                                <tr>
                                    <th> Name </th>
                                    <td> {{ $emailtemplatefolder->name??"Not Available" }} </td>
                                </tr>
                                <tr>
                                    <th> Status </th>
                                    <td>
                                        @if($emailtemplatefolder->status == 1 )
                                            <badge class="badge badge-success">Active</badge>
                                        @else
                                            <badge  class="badge badge-warning">Inactive</badge>
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