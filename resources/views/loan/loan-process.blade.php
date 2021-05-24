@extends('layout')

@section('content')
    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div id="loan_form" class="card">
                        <div class="card-header">Get instant loan from Aspire</div>
                        <div class="card-body">
                            @include('loan.loan-calculator')
                            <form action="" id="loan_process" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Name as per PAN CARD</label>
                                    <div class="col-md-6">
                                        <input type="text" id="name" data-validation-error-msg-container="#name-error" class="form-control" name="name" required autofocus>
                                        <span id="name_error" class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="city" class="col-md-4 col-form-label text-md-right">City</label>
                                    <div class="col-md-6">
                                        <input type="text" data-validation-error-msg-container="#city_error" id="city" class="form-control" name="city" required autofocus>
                                        <span id="city_error" class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="pan" class="col-md-4 col-form-label text-md-right">PAN</label>
                                    <div class="col-md-6">
                                        <input type="text" data-validation-error-msg-container="#pan_error" id="pan" class="form-control" name="pan" required>
                                        <span id="pan_error" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label type="number" for="amount" class="col-md-4 col-form-label text-md-right">Loan Amount</label>
                                    <div class="col-md-6">
                                        <input type="number" data-validation-error-msg-container="#amount_error" id="amount" class="form-control" name="amount" required>
                                        <span id="amount_error" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tenure" class="col-md-4 col-form-label text-md-right">Tenure Weeks</label>
                                    <div class="col-md-6">
                                        <input type="number" data-validation-error-msg-container="#tenure_error" minlength="4" maxlength="100" id="tenure" class="form-control" name="tenure" required>
                                        <span id="tenure_error" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="account_number" class="col-md-4 col-form-label text-md-right">Bank Account Number</label>
                                    <div class="col-md-6">
                                        <input type="text" data-validation-error-msg-container="#account_number_error" minlength="4" maxlength="100" id="account_number" class="form-control" name="account_number" required>
                                        <span id="account_number_error" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ifsc_code" class="col-md-4 col-form-label text-md-right">IFSC</label>
                                    <div class="col-md-6">
                                        <input type="text" data-validation-error-msg-container="#ifsc_error" minlength="4" maxlength="100" id="ifsc_code" class="form-control" name="ifsc_code" required>
                                        <span id="ifsc_error" class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <button type="button" onclick="loanProcess()" class="btn btn-primary">
                                        Process Loan
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script type="text/javascript">
        function loanProcess() {
            let input = {
                url: '{{route('process-loan.api')}}',
                data: $('#loan_process').serialize(),
                success: function (result) {
                    this.mySuccess();
                    if(result.success){
                        $('#loan_process')[0].reset();
                        window.location.href = '{{route('dashboard',['loan_process' => 'success'])}}'
                    }
                },
                type: 'POST',
                overwrite_container: false,
                ajax_target_element: document.getElementById('loan_form')
            };
            Aspire.Ajax(input);
        }
    </script>
@endsection
