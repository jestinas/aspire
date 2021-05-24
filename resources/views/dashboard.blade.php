@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (request('loan_process') == 'success')
                            <div class="alert alert-success" role="alert">
                                Loan got sanctioned and amount credited to your account!
                            </div>
                        @endif
                        <div id="transaction_success" class="alert alert-success" style="display: none;" role="alert">
                            Loan payment success with Transaction id: <span id="transaction_id"></span>
                        </div>
                            <div id="transaction_fail" class="alert alert-danger" style="display: none;" role="alert">
                                Loan payment failed. Please try again
                            </div>
                        <p>Hi {{$user->name}}, your loan is ready.</p>
                            <a href="{{route('process-loan')}}" type="button" class="btn btn-primary">Get loan now</a>
                    </div>
                    @include('loan.loan-list')

                </div>
            </div>
        </div>
    </div>
@endsection
