<?php


namespace App\Implementations;


use App\Interfaces\LoanImplementationInterface;
use App\Models\LoanDetails;
use App\Models\LoanPaymentHistory;
use App\Models\LoanSummary;
use App\Models\UserBankDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LoanImplementation implements LoanImplementationInterface
{
    private $user;

    private $request;

    public function __construct()
    {

    }

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    protected function getUser()
    {
        return $this->user;
    }

    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    protected function getRequest($key = "")
    {
        if($key){
            return $this->request[$key] ?? null;
        }
        return $this->request;
    }

    public function process_loan_applications(): array
    {
        $created_user_bank = $this->get_bank_details();
        $loan_application_details = $this->insert_into_loan_applications($created_user_bank->user_bank_id);
        $loan_summary_details = $this->insert_into_loan_summary($loan_application_details->loan_id);
        $loan_data = [
            'sanctioned_amount' => $loan_application_details->amount,
            'loan_application_id' => $loan_application_details->loan_application_id,
            'interest' => $loan_application_details->interest,
            'tenure' => $loan_application_details->loan_tenure,
        ];
        return $loan_data;
    }

    protected function get_bank_details()
    {
        $bank_details =  [
            'user_id' => $this->user->id,
            'bank_account_number' => $this->getRequest('account_number'),
            'ifsc' => $this->getRequest('ifsc_code'),
            'account_name' => $this->getRequest('name')
        ];
        return UserBankDetails::firstOrCreate($bank_details, [
            'user_id' => $this->user->id,
            'bank_account_number' => $this->getRequest('account_number'),
            'ifsc' => $this->getRequest('ifsc_code')
        ]);
    }

    protected function insert_into_loan_applications($bank_id)
    {
        $loan_details =  [
            'user_id' => $this->user->id,
            'loan_application_id' => uniqid('loan_'),
            'loan_amount' => $this->getRequest('amount'),
            'loan_tenure' => $this->getRequest('tenure'),
            'interest' => config('loan.fixed_loan_interest_rate'),
            'user_bank_id' => $bank_id
        ];
        return LoanDetails::create($loan_details);
    }

    protected function insert_into_loan_summary($loan_id)
    {
        $loan_summary_details =  [
            'loan_id' => $loan_id,
            'loan_amount' => $this->getRequest('amount'),
            'total_paid' => 0,
            'interest_charged' => 0,
            'balance_term' => $this->getRequest('tenure'),
            'next_payment_date' => Carbon::now()->addWeek(),
        ];
        return LoanSummary::create($loan_summary_details);
    }

    public function get_all_user_loans()
    {
        return LoanDetails::with('summary')->where('user_id', $this->user->id)->paginate();
    }

    public function get_loans_details($loan_id)
    {
        return LoanDetails::with(['summary', 'history', 'bank'])->where(['user_id' => $this->user->id, 'loan_application_id' => $loan_id])->get();
    }

    public function make_loan_payment($loan_id)
    {
        $loan_data = LoanDetails::where(['user_id' => $this->user->id, 'loan_application_id' => $loan_id])->first();
        if(!$loan_data || $loan_data->summary->balance_term < 1){
            return ['payment_status' => 'failed', 'transaction_id' => 0];
        }
        $principal = $loan_data->loan_amount;
        $interest = $loan_data->interest / 100 / 52.143; // Weekly interest rate
        $payments = $loan_data->loan_tenure; // Term in Weekly
        $emi = round($principal * $interest * (pow(1 + $interest, $payments) / (pow(1 + $interest, $payments) - 1)), 2);
        $history_data = [
            'loan_id' => $loan_data->loan_id,
            'user_id' => $loan_data->user_id,
            'paid_amount' => $emi,
            'transaction_id' => uniqid('txn_')
        ];
        $total_paid = $loan_data->summary->total_paid + $emi;
        $balance_term = $loan_data->summary->balance_term -1;
        $next_payment_date = $loan_data->summary->next_payment_date;
        $summary_update_data = [
            'total_paid' => $total_paid,
            'interest_charged' => 0,
            'balance_term' => $balance_term,
            'last_payment_date' => Carbon::now(),
            'next_payment_date' => Carbon::createFromDate($next_payment_date)->addWeek(),
        ];
        LoanPaymentHistory::create($history_data);
        LoanSummary::where('loan_id', $loan_data->loan_id)->update($summary_update_data);
        return ['payment_status' => 'done', 'transaction_id' => $history_data['transaction_id']];
    }


}
