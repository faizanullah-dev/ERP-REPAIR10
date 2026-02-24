<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content my-0">
        <div class="modal-header">
            <h5 class="modal-title">Edit {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Stage') }}</h5>
            <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"> × </button>
        </div>
        <div class="modal-body">

            <div class="clearfix"></div>
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ url('/stage/stage/' . $stage->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="stage_edit_form">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}

                @include ('stage.stage.form', ['submitButtonText' => 'Update'])
            </form>

        </div>
    </div>
</div>