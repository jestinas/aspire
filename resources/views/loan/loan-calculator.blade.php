<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#loanCalculatorModal">
    Launch Loan Calculator
</button>

<!-- Modal -->
<div class="modal fade" id="loanCalculatorModal" tabindex="-1" role="dialog" aria-labelledby="loanCalculator" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loanCalculator">Loan Calculator</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="loan_data">
                    <table>
                        <tr><td colspan="3"><b>Enter Loan Information:</b></td></tr>
                        <tr>
                            <td>Loan Amount:</td>
                            <td><input type="text" id="principal" name="principal" size="12" onchange="calculate();"></td>
                        </tr>
                        <tr>
                            <td>Annual percentage rate of interest:</td>
                            <td><input type="text" id="interest" name="interest" size="12" onchange="calculate();"></td>
                        </tr>
                        <tr>
                            <td>Tenure years:</td>
                            <td><input type="text" id="tenure_years" name="tenure_years" size="12" onchange="calculate();"></td>
                        </tr>
                        <tr><td colspan="3">
                                <button type="button" class="btn btn-info btn-sm" onclick="calculate();">Calculate</button>
                            </td></tr>
                        <tr>
                            <td colspan="3">
                                <b>Payment Information:</b>
                            </td>
                        </tr>
                        <tr>
                            <td>Your weekly payment will be:</td>
                            <td><input type="text" id="payment" name="payment" size="12"></td>
                        </tr>
                        <tr>
                            <td>Your total payment will be:</td>
                            <td><input type="text" id="total" name="total" size="12"></td>
                        </tr>
                        <tr>
                            <td>Your total interest payments will be:</td>
                            <td><input type="text" id="total_interest" name="total_interest" size="12"></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function calculate() {
        let principal = $('#principal').val();
        let interest = $('#interest').val() / 100 / 52.143;
        let payments = $('#tenure_years').val() * 52.143;

        let x = Math.pow(1 + interest, payments);
        let weekly = (principal*x*interest)/(x-1);

        if (!isNaN(weekly) &&
            (weekly !== Number.POSITIVE_INFINITY) &&
            (weekly !== Number.NEGATIVE_INFINITY)) {

            $('#payment').val(weekly.toFixed(2));
            $('#total').val((weekly * payments).toFixed(2));
            $('#total_interest').val(round((weekly * payments) - principal));
        } else {
            $('#payment').val('');
            $('#total').val('');
            $('#total_interest').val('');
        }
    }

    // This simple method rounds a number to two decimal places.
    function round(x) {
        return Math.round(x*100)/100;
    }
</script>
