<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addCredit">Cumulative Invoices</h5>
            <button type="button" class="btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="acumalative-invoices">
                <div class="container-fluid">
                    <div class="white-box">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="changeOrderLogo">
                                    <img src="{{asset('/website')}}/images/logo.png" alt="logo">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div>
                                    <h5>Customer Info:</h5>
                                    <p>Customer Name</p>
                                    <p>33 Park St, </p>
                                    <p>Griswold  CT 06351</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Job Info:</h5>
                                <p>Job Name</p>
                                <p>33 Park St, </p>
                                <p>Griswold  CT 06351</p>
                            </div>

                            <div class="col-md-4">
                                <h5>Business Info:</h5>
                                <p>Phone #: <i class="fa-solid fa-phone"></i> +123456789 </p>
                                <p>Business: business@gmail.com </p>
                                <p>Invoice due day: 21-Mar-25</p>
                            </div>

                            <div class="col-md-12 mt-4">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Day</th>
                                        <th>Activity</th>
                                        <th>Category Type</th>
                                        <th>Quantity</th>
                                        <th>Rate</th>
                                        <th>Taxable</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td> 21-Mar-25 </td>
                                        <td> Roof Replacement </td>
                                        <td> Roof </td>
                                        <td> 1 </td>
                                        <td> 10000 </td>
                                        <td> </td>
                                        <td> 10000 </td>
                                    </tr>
                                    <tr>
                                        <td> 21-Mar-25 </td>
                                        <td> Down Payment </td>
                                        <td> Roof </td>
                                        <td> 1 </td>
                                        <td> -5000 </td>
                                        <td> </td>
                                        <td> -5000 </td>
                                    </tr>

                                    <tr>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                    </tr>

                                    <tr>
                                        <td> 21-Mar-25 </td>
                                        <td> Change Order </td>
                                        <td> Plywood </td>
                                        <td> 20 </td>
                                        <td> 100 </td>
                                        <td> </td>
                                        <td> 2000 </td>
                                    </tr>

                                    <tr>
                                        <td> 21-Mar-25 </td>
                                        <td> Credit: Interior Damage </td>
                                        <td> Roof </td>
                                        <td> 1 </td>
                                        <td> -500 </td>
                                        <td> </td>
                                        <td> -500 </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="col-md-12">
                                            <span class="d-flex justify-content-end col-md-12">Project Cost: $
                                                <span id="subtotal">12000</span>
                                            </span>
                                    <div class="tax col-md-12">
                                                <span class="d-flex justify-content-end">Payments/Credits: $
                                                    <span id="paymentCredit">-5500</span>
                                                </span>
                                        <span class="d-flex justify-content-end">Tax: $
                                                    <span id="tax">0</span>
                                                </span>
                                        <span class="d-flex justify-content-end">Amount Due: $
                                                    <span class="total" name="total_amount">6500</span>
                                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>