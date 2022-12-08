@extends('layout.login_layout')
@section('title', 'Company Registation')
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

        <form action="{{route('control_panel.company.register')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="name" placeholder="Enter company name">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-key"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="email" class="form-control" name="email" placeholder="Enter company email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="tel" class="form-control" name="mobile" placeholder="Enter mobile number">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-mobile"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="tel" class="form-control" name="tel" placeholder="Enter telephone number">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-phone"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <textarea name="address" id="address" class="form-control" rows="7"></textarea>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-address-book"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="file" class="form-control" name="avatar" accept="image/jpeg">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fa fa-file"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="url" class="form-control" name="web" placeholder="Enter company website url">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-link"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="url" class="form-control" name="fb_page" placeholder="Enter facebook page url">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-link"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <select name="country" id="country" class="form-control">
                    <option value="0" selected>Choose Country</option>
                    @foreach ($country as $key => $data)
                    <option value="{{$data->country_id}}">{{$data->country}}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fa fa-globe"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <select name="industry" id="industry" class="form-control">
                    <option value="0" selected>Choose Industry</option>
                    @foreach ($industry as $key => $data)
                    <option value="{{$data->industry_id}}">{{$data->industry_name}}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fa fa-user"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class=" col-4">
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
</div>
@endsection