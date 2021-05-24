<?php


namespace App\Http\Controllers;


use App\Http\RequestValidators\LoanRequest;
use App\Interfaces\LoanImplementationInterface;
use App\Models\LoanSummary;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LoanController extends Controller
{
    /**
     * @var LoanImplementationInterface
     */
    private $loan_implementation;

    public function __construct(LoanImplementationInterface $loan_implementation)
    {

        $this->loan_implementation = $loan_implementation;
    }

    public function loan_view()
    {
        return view('loan.loan-process');
    }

    public function process_loan(LoanRequest $request)
    {
        $loan_data = $this->loan_implementation->setUser(auth()->user())
            ->setRequest($request->all())
            ->process_loan_applications();

        return response()->json([
            'success' => true,
            'data' => $loan_data,
            'message' => 'Loan Application Submitted & Processed',
        ], Response::HTTP_CREATED);
    }

    public function get_loans()
    {
        $loan_data = $this->loan_implementation->setUser(auth()->user())
            ->get_all_user_loans();

        return response()->json($loan_data, Response::HTTP_CREATED);
    }

    public function get_loans_details($loan_id)
    {
        request()->merge(['loan_id' => request()->route('loan_id')]);
        $loan_data = $this->loan_implementation->setUser(auth()->user())
            ->get_loans_details($loan_id);

        return response()->json(['data' => $loan_data], Response::HTTP_CREATED);
    }

    public function make_loan_payment($loan_id)
    {
        $loan_data = $this->loan_implementation->setUser(auth()->user())
            ->make_loan_payment($loan_id);

        return response()->json(['data' => $loan_data], Response::HTTP_CREATED);
    }
}
