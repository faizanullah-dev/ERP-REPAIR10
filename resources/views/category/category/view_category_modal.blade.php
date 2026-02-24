<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content my-0">
        <div class="modal-header">
            <h5 class="modal-title"> {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Category') }}</h5>
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
                                    <td>{{ $category->id }}</td>
                                </tr>
                                <tr>
                                    <th> Name </th>
                                    <td> {{ $category->name??"Not Available" }} </td>
                                </tr>
                                <tr>
                                    <th> Status </th>
                                    <td> {!! ($category->status==1)?"  <badge class='badge badge-success'>Active</badge>":"<badge class='badge badge-warning'>Inactive</badge>" !!} </td>
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