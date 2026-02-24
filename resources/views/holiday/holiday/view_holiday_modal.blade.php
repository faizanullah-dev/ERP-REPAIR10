<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content my-0">
        <div class="modal-header">
            <h5 class="modal-title"> {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Holiday') }}</h5>
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
                                    <td>{{ $holiday->id }}</td>
                                </tr>
                                <tr>
                                    <th> User Id </th>
                                    <td> {{ $holiday->user->name??"" }} </td>
                                </tr>
                                <tr>
                                    <th> Name </th>
                                    <td> {{ $holiday->name??"" }} </td>
                                </tr>
                                <tr>
                                    <th> Date </th>
                                    <td>
                                        @forelse($holiday->getHoliday as $item)
                                            @if ($item->date)
                                                {{ \Carbon\Carbon::parse($item->date)->format('j-F-Y')??"Not Available" }},<br>
                                            @endif
                                        @empty
                                            Not Available
                                        @endforelse
                                    </td>

                                </tr>
                                <tr>
                                    <th> Status </th>
                                    <td>
                                        @if($holiday->status == 1)
                                            <span class="label label-success">Active</span>
                                        @else
                                            <span class="label label-danger">InActive</span>
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