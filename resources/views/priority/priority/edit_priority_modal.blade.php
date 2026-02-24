<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content my-0">
        <div class="modal-header">
            <h5 class="modal-title">Edit {{ preg_replace('/(?<=[a-z])[A-Z]|[A-Z](?=[a-z])/', ' $0', 'Priority') }}</h5>
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

            <form method="POST" action="{{ url('/priority/priority/' . $priority->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}

                @include ('priority.priority.form', ['submitButtonText' => 'Update'])
            </form>

        </div>
    </div>
</div>