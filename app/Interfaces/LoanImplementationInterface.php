<?php


namespace App\Interfaces;


interface LoanImplementationInterface
{
    public function setUser($user);
    public function setRequest($request);
    public function process_loan_applications();
    public function get_all_user_loans();
    public function get_loans_details($loan_id);
}
