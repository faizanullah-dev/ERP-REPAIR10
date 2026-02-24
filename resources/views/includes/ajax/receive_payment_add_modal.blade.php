<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Receive Payment</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ url('/receivePayment/receive-payment/' . $receivepayment->id) }}" accept-charset="UTF-8" class="form-horizontal edit_receive_payment_form" enctype="multipart/form-data" novalidate>
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <input name="view_lead" value="1" type="hidden">
                @include ('receivePayment.receive-payment.form', ['submitButtonText' => 'Update'])
            </form>
        </div>
    </div>
</div>
