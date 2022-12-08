@extends('layout.layout')
@section('meta')

@endsection
@section('title', 'Person in charge')
@section('content')
<link rel="stylesheet" href="{{ asset('lib/css/buttons.bootstrap4.min.css') }}" />
<link rel="stylesheet" href="{{ asset('lib/css/responsive.bootstrap4.min.css') }}" />
<link rel="stylesheet" href="{{ asset('lib/css/dataTables.bootstrap4.min.css') }}" />

@include('includes.nav')
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
                @if (session()->has('company_user'))
                <a href="#" class="d-block">{{session()->get('company_user.company.name')}}</a>
                @endif
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
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                       with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="{{route('control_panel.dashboard')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('control_panel.person_in_charge')}}" class="nav-link active">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            Person In Charge
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('control_panel.profile.view')}}" class="nav-link active">
                        <i class="nav-icon fa fa-user-secret"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#logout" id="logout" class="nav-link">
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
                    <h1 class="m-0">Person In Charge</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Person In Charge</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-12">
                    <form id="pic-form-update">
                        <div class="row">
                            <div class="col-md-12" style="display: none">
                                <div class="form-group">
                                    <label for="id">ID:</label>
                                    <input type="number" name="id" id="id" class="form-control"
                                        placeholder="Enter Email" value="{{$pic->pic_id}}" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Enter Email" value="{{$pic->email}}" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Enter password" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="confirm_password">Confirm password:</label>
                                    <input type="password" name="confirm_password" id="confirm_password"
                                        class="form-control" placeholder="Enter Confirm Password" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mobile">Mobile:</label>
                                    <input type="tel" name="mobile" id="mobile" class="form-control"
                                        placeholder="Enter Mobile Number" value="0{{$pic->mobile}}" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="position">Position:</label>
                                    <input type="text" name="position" id="position" class="form-control"
                                        placeholder="Enter Company position" value="{{$pic->position}}" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex float-right">
                                    <button class="btn btn-warning" type="submit">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('includes.footer')
<script type="text/javascript">
    document.getElementById('pic-form-update').addEventListener('submit', (e) => {
        e.preventDefault();

        $.ajax({
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: '{{route("control_panel.pic.update")}}',
            type:'POST',
            data:$('#pic-form-update').serialize(),
            beforSend: () => {
                console.log('requested ...');
            },
            success: (res) => {
                if (res.status == 200) {
                    Toast.fire({
                        icon: 'success',
                        title: res.message
                    });
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
</script>
@endsection