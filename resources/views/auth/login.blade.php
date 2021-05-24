@extends('layout')

@section('content')
    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Login</div>
                        <div class="card-body">

                            <form id="login_form" action="" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                    <div class="col-md-6">
                                        <input  type="text" id="email" class="form-control" data-validation-error-msg-container="#email_error" name="email" value="jes@test.com" required autofocus>
                                        <span id="email_error" class="email-error text-danger"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" data-validation-error-msg-container="#pass_error"  class="form-control" value="123456" name="password" required>
                                        <span id="pass_error" class="pass-error text-danger"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember"> Remember Me
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <button type="button" onclick="processLogin()" class="btn btn-primary">
                                        Login
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function processLogin() {
            let input = {
                url: '{{route('login.api')}}',
                data: $('#login_form').serialize(),
                success: function (result) {
                    this.mySuccess();
                    console.log(JSON.stringify(result))
                    localStorage.setItem('jwt_creds', JSON.stringify(result));
                    window.location.href = '{{route('dashboard')}}';
                },
                type: 'POST',
                overwrite_container: false,
                ajax_target_element: document.getElementById('login_form')
            };
            Aspire.Ajax(input);
        }
    </script>
@endsection
