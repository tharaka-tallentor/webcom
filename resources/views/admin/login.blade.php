@extends('admin.layout.login_layout')
@section('meta')
<meta name="description" content="Webcom system controling panel. autorize users can access this panel">
<meta name="keywords" content="WEBCOM, WEBCOM Admin, WEBCOM Admin Panel">
<meta name="author" content="WEBCOM">
@endsection
@section('title', 'Webcom | ADMIN PANEL')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header text-center">
        <a href="javascript:void(0)" class="h1"><b>WebCom</b>ADMIN</a>
    </div>
    <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="{{route('admin.login')}}" method="POST">
            @csrf
            @method('post')
            <div class="input-group mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    placeholder="Enter user email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
            </div>
            @error('email')
            <p style="color: red">{{ $message }}</p>
            @enderror
            <div class="input-group mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                    placeholder="Enter user password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-key"></span>
                    </div>
                </div>
            </div>
            @error('password')
            <p style="color: red">{{ $message }}</p>
            @enderror
            <div class="row">
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
@if (session()->has('success'))
<script type="text/javascript">
    Toast.fire({
            icon: 'success',
            title: "{{session()->get('success')}}"
        });
</script>
@endif
@if (session()->has('error'))
<script type="text/javascript">
    Toast.fire({
            icon: 'error',
            title: "{{session()->get('error')}}"
        });
</script>
@endif
@endsection