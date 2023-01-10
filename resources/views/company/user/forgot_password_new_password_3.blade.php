@extends('layout.login_layout')
@section('meta')
@endsection
@section('title', 'Webcom Forgot Password')
@push('style')
@endpush
@section('content')

    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="#" class="h1"><b>Web</b>com</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">{{ session()->get('forgot.email') }}</p>

            <form id="forgot-password">
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Enter New Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-key"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="confirm_password"
                        placeholder="Enter Confirm Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-key"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class=" col-4">
                        <button type="submit" class="btn btn-primary btn-block">Reset</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    @push('script')
        <script type="text/javascript">
            document.getElementById('forgot-password').addEventListener('submit', (e) => {
                e.preventDefault();
                $.ajax({
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    type: "POST",
                    url: "{{ route('control_panel.password.forgot') }}",
                    data: $('#forgot-password').serialize(),
                    beforeSend: () => {
                        console.log('requested ...');
                    },
                    success: (res) => {
                        if (res.status == 200) {
                            location.replace(res.route);
                        } else {
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
    @endpush
@endsection
