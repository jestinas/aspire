@include('loan.loan-details-model')
<div class="col-sm-12">
    <h1 class="display-5">Disbursed Loans</h1>
    <table id="loanTable" class="table table-striped">
        <thead>
            <tr>
                <td>SI NO</td>
                <td>Loan ID</td>
                <td>Amount Disbursed</td>
                <td>Amount Paid</td>
                <td>Pending Tenure</td>
                <td>Next Payment Date</td>
                <td colspan = 2>Loan Details</td>
                <td colspan = 2>Pay Term</td>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<script type='text/javascript'>
    $(document).ready(function(){
        getAllLoans();
    });

    function getAllLoans() {
        let input = {
            url: '{{route('get-loans.api')}}',
            data: {},
            success: function (result) {
                this.mySuccess();
                drawRecords(result);
            },
            type: 'GET',
            overwrite_container: false,
            ajax_target_element: document.getElementById('loanTable')
        };
        Aspire.Ajax(input);
    }

    function drawRecords(response){
        let len = 0;
        $('#loanTable tbody').empty();
        if(response['data'] != null){
            len = response['data'].length;
        }
        if(len > 0){
            for(let i=0; i<len; i++){
                let loan_id = response['data'][i].loan_application_id;
                let amount_disbursed = response['data'][i].loan_amount;
                let amount_paid = response['data'][i].summary.total_paid;
                let pending_tenure = response['data'][i].summary.balance_term;
                let next_payment_date = response['data'][i].summary.next_payment_date;
                let action = "<input type='button' value='view' onclick=loanDetails(\'"+loan_id+"\')>";
                if(pending_tenure > 0){
                    var term = "<input type='button' value='Pay' onclick=payLoanTerm(\'"+loan_id+"\')>";
                }else{
                    var term = "<input type='button' value='Pay' disabled>";
                }

                let tr_str = "<tr>" +
                    "<td align='center'>" + (i+1) + "</td>" +
                    "<td align='center'>" + loan_id + "</td>" +
                    "<td align='center'>" + amount_disbursed + "</td>" +
                    "<td align='center'>" + amount_paid + "</td>" +
                    "<td align='center'>" + pending_tenure + "</td>" +
                    "<td align='center'>" + next_payment_date + "</td>" +
                    "<td align='center' colspan = 2>" + action + "</td>" +
                    "<td align='center' colspan = 2>" + term + "</td>" +
                    "</tr>";

                $("#loanTable tbody").append(tr_str);
            }
        }else{
            let tr_str = "<tr>" +
                "<td align='center' colspan='7'>No record found.</td>" +
                "</tr>";
            $("#loanTable tbody").append(tr_str);
        }
    }

    function loanDetails(loan_id){
        let uri = '{{route('get-loan-details.api', [''])}}';
        let input = {
            url: uri+'/'+loan_id,
            data: {},
            success: function (result) {
                this.mySuccess();
                drawRepaymentRecords(result.data[0].history);
                fill_data(result.data)
            },
            type: 'GET',
            overwrite_container: false,
            ajax_target_element: document.getElementById('loanTable')
        };
        Aspire.Ajax(input);
    }

    function drawRepaymentRecords(response){
        let len = 0;
        $('#loanDetailsTable tbody').empty();
        if(response != null){
            len = response.length;
        }
        if(len > 0){
            for(let i=0; i<len; i++){
                let amount_paid = response[i].paid_amount;
                let txn_id = response[i].transaction_id;
                let payment_date = response[i].created_at;

                let tr_str = "<tr>" +
                    "<td align='center'>" + (i+1) + "</td>" +
                    "<td align='center'>" + amount_paid + "</td>" +
                    "<td align='center'>" + txn_id + "</td>" +
                    "<td align='center'>" + payment_date + "</td>" +
                    "</tr>";
                $("#loanDetailsTable tbody").append(tr_str);
            }
        }else{
            let tr_str = "<tr>" +
                "<td align='center' colspan='4'>No record found.</td>" +
                "</tr>";
            $("#loanDetailsTable tbody").append(tr_str);
        }
        $("#LoanDetailsModal").modal('show');
    }

    function payLoanTerm(loan_id) {
        let uri = '{{route('loan-payment.api', [''])}}';
        let input = {
            url: uri+'/'+loan_id,
            data: {},
            success: function (result) {
                this.mySuccess();
                if(result.data.payment_status == 'done'){
                    $('#transaction_success').show();
                    $('#transaction_id').html(result.data.transaction_id);
                }else{
                    $('#transaction_fail').show();
                }
                getAllLoans();
            },
            type: 'POST',
            overwrite_container: false,
            ajax_target_element: document.getElementById('loanTable')
        };
        Aspire.Ajax(input);
    }

    function fill_data(response_data){
        let response = response_data[0];
        let loan_id = response.loan_application_id;
        let loan_amount = response.loan_amount;
        let loan_tenure = response.loan_tenure;
        let interest = response.interest;
        let total_paid = response.summary.total_paid;
        let balance_term = response.summary.balance_term;
        let last_payment_date = response.summary.last_payment_date;
        let next_payment_date = response.summary.next_payment_date;
        let bank_account_number = response.bank.bank_account_number;
        let account_name = response.bank.account_name;

        $("#application_id").html(loan_id);
        $("#loan_amount").html(loan_amount);
        $("#loan_tenure").html(loan_tenure);
        $("#interest").html(interest);
        $("#total_paid").html(total_paid);
        $("#balance_term").html(balance_term);
        $("#last_payment_date").html(last_payment_date);
        $("#next_payment_date").html(next_payment_date);
        $("#bank_account_number").html(bank_account_number);
        $("#account_name").html(account_name);
    }
</script>
