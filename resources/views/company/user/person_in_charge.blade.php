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
                    <form id="pic-form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Enter Email" />
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
                                        placeholder="Enter Mobile Number" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex float-right">
                                    <button class="btn btn-warning" type="submit">Add</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-12 mt-4">
                    <table class="table table-bordered table-striped table-responsive" id="pic-table">
                        <thead>
                            <tr>
                                <th>UUID</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Authorize By</th>
                                <th>Designation</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pic as $key => $data)
                            <tr>
                                <td>{{$data->pic_uuid}}</td>
                                <td>{{$data->email}}</td>
                                <td>{{$data->mobile}}</td>
                                <td>{{$data->authorize_by}}</td>
                                <td>{{$data->designation}}</td>
                                <td>{{$data->status}}</td>
                                <td>{{$data->registor_date}}</td>
                                <td><a href="#" class="btn btn-warning">Edit</a></td>
                                <td><a href="#" class="btn btn-danger">Delete</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('includes.footer')
<script src="{{ asset('lib/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('lib/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('lib/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('lib/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('lib/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('lib/js/buttons.bootstrap4.js') }}"></script>
<script type="text/javascript">
    $(document).ready(() => {
        $('#pic-table').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true
        });
        load_data();
    });
    document.getElementById('pic-form').addEventListener('submit', (e) => {
        e.preventDefault();
        $.ajax({
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: '{{route("control_panel.registor")}}',
            type:'POST',
            data: $('#pic-form').serialize(),
            beforeSend: () => {
                console.log('reqested ...');
            },
            success: (res) => {
                if(res.status == 200){
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

    function load_data() {
        $.ajax({
            headers: {
                'Accept': 'application/json'
            },
            url: '{{route("control_panel.all.pic")}}',
            type:'GET',
            beforeSend: () => {
                console.log('reqested ...');
            },
            success: (res) => {
                // console.log(res.data);
                if(res.status == 200){
                    alert(res.message);
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
    }

    document.getElementById('logout').addEventListener('click', (e) => {
        $.ajax({
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: "{{ route('control_panel.logout') }}",
            type: "GET",
            beforSend:() => {
                console.log('requested ...');
            },
            success:(res) => {
                if(res.status == 200){
                    window.location.replace(res.route);
                }else{
                    Toast.fire({
                        icon: 'error',
                        title: res.message
                    });
                }
            },
            error:(XMLHttpRequest, textStatus, errorThrown) =>{
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