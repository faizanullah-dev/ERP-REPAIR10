<div id="viewInvoiceModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-remove"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="white-box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <img src="{{ asset('website/images/logo.png') }}" alt="Logo" class="img-fluid" >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                @if($invoice->creator->hasRole('user'))
                                <div>
                                    <p>MJT ROOFING LLC</p>
                                    <p>244 Rut 6</p>
                                    <p>Columbia CT 06237</p>
                                </div>
                                @else
                                <div>
                                    <p>{{$invoice->getSubContractor->subContractorCompany->name??''}}</p>
                                    <p>{{$invoice->getSubContractor->subContractorCompany->address??''}}</p>
                                    <p>{{$invoice->getSubContractor->subContractorCompany->zip_code}}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            @if($invoice->creator->hasRole('user'))
                            <div class="form-group">
                                <h5 class="">Bill To</h5>
                                <p>{{$invoice->getSubContractor->subContractorCompany->name??''}}</p>
                                <a href="mailto:{{$invoice->getSubContractor->subContractorCompany->email??'#'}}">{{$invoice->getSubContractor->subContractorCompany->email??''}}</a>
                                <p>{{$invoice->getSubContractor->subContractorCompany->address??''}}<br> {{$invoice->getSubContractor->subContractorCompany->zip_code??''}}</p>
                            </div>
                            @else
                                <div class="form-group">
                                    <h5 class="">Bill To</h5>
                                    <p>MJT Roofing LLC</p>
                                    <a href="mailto:mjt@yopmail.com">mjt@yopmail.com</a>
                                    <p>244 Rut 6<br> Columbia CT 06237</p>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5 class="">Project Details</h5>
                                <p>{{$invoice->getJob->name??''}}<br>{{$invoice->getLead->address??''}}<br>{{$invoice->getLead->postal_code??''}}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <p><strong>Date:</strong> {{$invoice->created_at->format('m/d/Y')}}</p>
                                <p><strong>Invoice #:</strong> {{$invoice->invoice_unique_id}}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Tax</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($invoice->getProducts as $product)
                                        <tr>
                                            <td>{{$product->product_name??''}}</td>
                                            <td>{{$product->quantity??''}}</td>
                                            <td>$ {{ number_format($product->rate ?? 0, 2) }}</td>
                                            <td>$ {{$product->tax??''}}</td>
                                            <td>$ {{ number_format((float)($product->total ?? 0) + (float)($product->tax ?? 0), 2) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-end fw-bold">Sub Total:</td>
                                        <td>$ {{$invoice->sub_total??'0.0'}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-end fw-bold">Tax:</td>
                                        <td>$ {{$invoice->tax??'0.0'}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-end fw-bold">Total:</td>
                                        <td>$ {{$invoice->total??'0.0'}}</td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
