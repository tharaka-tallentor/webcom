@extends('layout.login_layout')
@section('title', 'Company Login')
@section('meta')

@endsection
@section('content')
<!-- /.login-logo -->
<div class="card card-outline card-primary">
    <div class="card-header text-center">
        <a href="#" class="h1"><b>Web</b>com</a>
    </div>
    <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form id="company-login-form">
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="otp" placeholder="Enter Your OTP">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-key"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <a href="javascript:void(0)" id="resend">Resend OTP</a>
                    </div>
                </div>
                <!-- /.col -->
                <div class=" col-4">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
</div>
<script type="text/javascript">
    document.getElementById('company-login-form').addEventListener('submit', (e) => {
        e.preventDefault();
        $.ajax({
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: "{{ route('control_panel.company.login') }}",
            type: "POST",
            data: $("#company-login-form").serialize(),
            beforeSend: () => {
                console.log('requested ....');
            },
            success: (res) => {
                if (res.status == 200) {
                    window.location.replace(res.route);
                }else{
                    Toast.fire({
                    icon: 'error',
                    title: res.message
                });
                }
            },
            error: (XMLHttpRequest, textStatus, errorThrown) => {
                Toast.fire({
                    icon: 'warning',
                    title: XMLHttpRequest.responseJSON
                                .message
                });
            }
        });
    });
    document.getElementById('resend').addEventListener('click', (e) => {
        e.preventDefault();

        $.ajax({
            headers: {
                'Accept': 'application/json'
            },
            url: "{{ route('control_panel.resend.otp') }}",
            type: "GET",
            beforeSend: () => {
                console.log('requested ....');
            },
            success: (res) => {
                if (res.status == 200) {
                    Toast.fire({
                    icon: 'success',
                    title: res.message
                });
                }else{
                    Toast.fire({
                    icon: 'error',
                    title: res.message
                });
                }
            },
            error: (XMLHttpRequest, textStatus, errorThrown) => {
                Toast.fire({
                    icon: 'warning',
                    title: XMLHttpRequest.responseJSON
                                .message
                });
            }
        });
    });
</script>
@endsection