@extends('admin.layout.admin_layout')
@section('meta')

@endsection
@section('title', 'Webcom | System Admin')
@push('styles')
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
                        <a href="{{ route('admin.in.system') }}" class="nav-link active">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                System Admins
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.profile') }}" class="nav-link">
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
                        <h1 class="m-0">System Admin's</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Admin Edit</li>
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
                        <form action="{{ route('admin.update.data') }}" method="post">
                            @csrf
                            @method('post')
                            <div class="row">
                                <div class="col-6 col-md-6">
                                    <div class="form-group">
                                        <label for="f_name">First Name :</label>
                                        <input type="text" class="form-control @error('f_name') is-invalid @enderror"
                                            id="f_name" name="f_name" value="{{ ucfirst($user->first_name) }}"
                                            placeholder="Enter First Name" />
                                    </div>
                                    @error('f_name')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-6 col-md-6">
                                    <div class="form-group">
                                        <label for="l_name">Last Name :</label>
                                        <input type="text" class="form-control @error('l_name') is-invalid @enderror"
                                            id="l_name" name="l_name" value="{{ ucfirst($user->last_name) }}"
                                            placeholder="Enter Last Name" />
                                    </div>
                                    @error('l_name')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-6 col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email :</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ $user->email }}"
                                            placeholder="Enter Email" />
                                    </div>
                                    @error('email')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-6 col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Mobile :</label>
                                        <input type="tel" class="form-control @error('mobile') is-invalid @enderror"
                                            id="mobile" name="mobile" value="0{{ $user->mobile }}"
                                            placeholder="Enter Mobile Number" />
                                    </div>
                                    @error('mobile')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-6 col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password :</label>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" id="password"
                                            name="password" placeholder="Enter Password (not optional)" />
                                    </div>
                                    @error('password')
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
                    </div>
                </div>
            </div>
        </section>
        @push('script')
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
