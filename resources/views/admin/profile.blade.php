@extends('admin.layout.admin_layout')
@section('meta')

@endsection
@section('title', 'Webcom | System Admin')
@push('styles')
    <link rel="stylesheet" href="{{ asset('/lib/css/cropper.min.css') }}" />
@endpush
@section('content')
    @include('admin.includes.nav')
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8"> --}}
            <span class="brand-text font-weight-light">Webcom Dashboard</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                {{-- <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div> --}}
                <div class="info">
                    @auth
                        <a href="javascript:void(0)"
                            class="d-block">{{ ucfirst(auth()->user()->first_name) . ' ' . ucfirst(auth()->user()->last_name) }}</a>
                    @endauth
                </div>
            </div>

            {{--
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> --}}

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                                                                                                                                                                                                                                                                                                                                                                                           with font-awesome or any other icon font library -->
                    <li class="nav-item menu-open">
                        <a href="{{ route('admin.dashboard.view') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Home
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.company.view') }}" class="nav-link">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                System Companys
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.company.user.view') }}" class="nav-link">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                Company Users
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.in.system') }}" class="nav-link">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                System Admins
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.profile') }}" class="nav-link active">
                            <i class="nav-icon fa fa-user-secret"></i>
                            <p>
                                Profile
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.logout') }}" id="logout" class="nav-link">
                            <i class="nav-icon fa fa-power-off"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Profile</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{ ucfirst(auth()->user()->first_name) . ' ' . 'Profile' }}
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="card card-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header text-white"
                                style="background: url('{{ asset('/upload/admin/cover/156672332.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                                <h3 class="widget-user-username text-right">
                                    {{ ucfirst(auth()->user()->first_name) . ' ' . ucfirst(auth()->user()->last_name) }}
                                </h3>
                                <h5 class="widget-user-desc text-right">System Admin</h5>
                            </div>
                            <div class="widget-user-image">
                                <img class="img-circle" src="{{ asset(auth()->user()->user_avatar) }}" loading="lazy"
                                    alt="User Avatar" style="width: 100px; height: 100px;">
                            </div>
                            <div class="card-footer">
                                <form action="{{ route('admin.profile.update') }}" method="POST">
                                    @csrf
                                    @method('post')
                                    <div class="row">
                                        <div class="col-6 col-md-6">
                                            <div class="form-group">
                                                <label for="f_name">First Name :</label>
                                                <input type="text"
                                                    class="form-control @error('f_name') is-invalid @enderror"
                                                    name="f_name" id="f_name" placeholder="Enter First Name"
                                                    value="{{ ucfirst(auth()->user()->first_name) }}" />
                                            </div>
                                            @error('f_name')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <div class="form-group">
                                                <label for="l_name">Last Name :</label>
                                                <input type="text"
                                                    class="form-control @error('l_name') is-invalid @enderror"
                                                    name="l_name" id="l_name" placeholder="Enter Last Name"
                                                    value="{{ ucfirst(auth()->user()->last_name) }}" />
                                            </div>
                                            @error('l_name')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email :</label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    id="email" placeholder="Enter Email"
                                                    value="{{ auth()->user()->email }}" />
                                            </div>
                                            @error('email')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <div class="form-group">
                                                <label for="mobile">Mobile :</label>
                                                <input type="tel"
                                                    class="form-control @error('mobile') is-invalid @enderror"
                                                    name="mobile" id="mobile" placeholder="Enter Mobile Number"
                                                    value="{{ '0' . auth()->user()->mobile }}" />
                                            </div>
                                            @error('mobile')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <div class="form-group">
                                                <label for="password">Password (not optional) :</label>
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" id="password" placeholder="Enter New Password" />
                                            </div>
                                            @error('password')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <div class="form-group">
                                                <label for="confirm_password">Confirm Password :</label>
                                                <input type="password"
                                                    class="form-control @error('confirm_password') is-invalid @enderror"
                                                    name="confirm_password" id="confirm_password"
                                                    placeholder="Enter Confirm Password">
                                            </div>
                                            @error('confirm_password')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="d-flex float-right">
                                                <button class="btn btn-success" type="submit">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <form action="{{ route('admin.avatar.upload') }}" method="POST">
                                    @csrf
                                    @method('post')
                                    <div class="row">
                                        <div class="col-6 col-md-6">
                                            <div class="form-group">
                                                <img src="{{ asset(auth()->user()->user_avatar) }}"
                                                    class="img img-thumbnail" style="width: 300px; height: auto;"
                                                    loading="lazy" alt="avatar image" />
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <div class="form-group">
                                                <label for="new_avatar">Avatar :</label>
                                                <img style="display: none" id="preview_new_avatar"
                                                    class="img img-thumbnail" src="" loading="lazy"
                                                    alt="new avatar" />
                                                <textarea style="display: none" class="form-control" name="avatar" id="avatar"></textarea>
                                                <input type="file"
                                                    class="form-control @error('avatar') is-invalid @enderror"
                                                    id="new_avatar" name="new_avatar" accept="image/jpeg" />

                                            </div>
                                            @error('avatar')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="d-flex float-right">
                                                <button type="submit" class="btn btn-success">Upload</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div id="cropper-model" class="modal fade bd-example-modal-lg" tabindex="-1"
                                    role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h2 class="card-title">Crop Avatar</h2>
                                                </div>
                                                <div class="card-body">
                                                    <div class="col-12 col-md-12">
                                                        <div class="row">
                                                            <div class="col-6 col-md-6 m-2" id="crop-canvas">
                                                            </div>
                                                            <div class="col-6 col-md-4 m-2" id="preview-canvas">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="col-12 col-md-12">
                                                        <div class="d-flex inline float-right">
                                                            <button class="btn btn-success m-2" type="button"
                                                                id="ok-btn">OK</button>
                                                            <button class="btn btn-warning m-2" type="button"
                                                                id="crop-btn">Crop</button>
                                                            <button class="btn btn-danger m-2" type="button"
                                                                id="cancel-btn">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
    </section>
    @push('script')
        <script src="{{ asset('/lib/js/cropper.min.js') }}"></script>
        <script type="text/javascript">
            let cropper = null;
            let image = document.getElementById("preview-canvas");
            let reader = null;
            let croped_area = "";
            let canves = null;
            let imgData = ""
            let data = "";

            document.getElementById('new_avatar').addEventListener('change', (e) => {

                croped_area = document.getElementById("crop-canvas");
                if (e.target.files.length) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        if (e.target.result) {
                            let img = document.createElement('img');
                            img.id = 'croped-img';
                            img.src = e.target.result;
                            img.style.width = '100%';
                            img.style.height = 'auto';
                            img.loading = 'lazy';
                            croped_area.innerHTML = '';
                            croped_area.appendChild(img);
                            cropper = new Cropper(img, {
                                aspectRatio: 1,
                                viewMode: 3
                            });
                        }
                    };
                    reader.readAsDataURL(e.target.files[0]);
                }

                $('#cropper-model').modal('show');
            });

            document.getElementById('crop-btn').addEventListener('click', () => {

                canves = cropper.getCroppedCanvas({
                    width: 320,
                    height: 320,
                });

                let result_img = document.getElementById("preview-canvas");
                imgData = canves.toDataURL();

                let img = document.createElement('img');
                img.id = 'preview-image';
                img.src = imgData;
                img.style.width = '100%';
                img.style.height = 'auto';
                img.loading = 'lazy';
                result_img.innerHTML = '';
                result_img.appendChild(img);

                $('#avatar').val(imgData);

                canves.toBlob(function(blob) {
                    let url = URL.createObjectURL(blob);
                    let reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onload = () => {
                        data = reader.result;
                    }

                });


            });

            document.getElementById('cancel-btn').addEventListener('click', () => {
                cropper.destroy();
                cropper = null;
                let result_img = document.getElementById("preview-canvas").innerHTML = "";
                croped_area.innerHTML = "";
                $('#avatar').val("");
                $("#cropper-model").modal('hide');
            });

            document.getElementById('ok-btn').addEventListener('click', () => {
                cropper.destroy();
                cropper = null;
                let result_img = document.getElementById("preview-canvas").innerHTML = "";
                croped_area.innerHTML = "";
                $("#cropper-model").modal('hide');
            });
        </script>
        @if (session()->has('success'))
            <script type="text/javascript">
                Toast.fire({
                    icon: 'success',
                    title: "{{ session()->get('success') }}"
                });
            </script>
        @endif
        @if (session()->has('error'))
            <script type="text/javascript">
                Toast.fire({
                    icon: 'error',
                    title: "{{ session()->get('error') }}"
                });
            </script>
        @endif
    @endpush
@endsection
