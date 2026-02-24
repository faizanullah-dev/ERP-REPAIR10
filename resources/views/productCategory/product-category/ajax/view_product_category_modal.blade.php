<div  class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered" tabindex="-1" aria-hidden="true">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Product Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="payment_type" class="input_labels control-label">Name</label>
                                <div class="view_data_span">
                                    <span>{{$productcategory->name}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Reference_Number" class="input_labels control-label">Status:</label>
                               <div class="view_data_span">
                                   <span>@if($productcategory->status == 1) Active @else Inactive @endif</span>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>