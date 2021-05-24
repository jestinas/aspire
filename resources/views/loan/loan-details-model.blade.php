<!-- Modal -->
<div class="modal fade" id="LoanDetailsModal" tabindex="-1" role="dialog" aria-labelledby="LoanDetails" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="LoanDetails">Loan Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-sm-12">
                    <p>Loan detail for application: <span id="application_id">application_id</span></p>

                    <dl>
                        <dt>Loan Amount</dt>
                        <dd><span id="loan_amount">loan_amount</span></dd>
                        <dt>Loan Tenure</dt>
                        <dd><span id="loan_tenure">loan_tenure</span></dd>
                        <dt>Interest Rate</dt>
                        <dd><span id="interest">interest</span></dd>
                        <dt>Total Paid</dt>
                        <dd><span id="total_paid">total_paid</span></dd>
                        <dt>Balance Term</dt>
                        <dd><span id="balance_term">balance_term</span></dd>
                        <dt>Last Payment Date</dt>
                        <dd><span id="last_payment_date">last_payment_date</span></dd>
                        <dt>Next Payment Date</dt>
                        <dd><span id="next_payment_date">next_payment_date</span></dd>
                        <dt>Disbursed Account Number</dt>
                        <dd><span id="bank_account_number">bank_account_number</span></dd>
                        <dt>Account Name</dt>
                        <dd><span id="account_name">account_name</span></dd>

                    </dl>

                    <h3 class="display-8">Repayment History</h3>
                    <table id="loanDetailsTable" class="table table-striped">
                        <thead>
                        <tr>
                            <td>SI NO</td>
                            <td>Amount Paid</td>
                            <td>Transaction Id</td>
                            <td>Paid Date</td>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
