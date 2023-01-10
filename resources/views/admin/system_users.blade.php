@extends('admin.layout.admin_layout')
@section('meta')

@endsection
@section('title', 'Webcom | DASHBOARD')
@push('styles')
    <link rel="stylesheet" href="{{ asset('lib/css/daterangepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('lib/css/buttons.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('lib/css/responsive.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('lib/css/dataTables.bootstrap4.min.css') }}" />
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
                        <a href="{{ route('admin.company.user.view') }}" class="nav-link active">
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
                        <h1 class="m-0">System Company Users</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Comapnys users</li>
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
                    <div class="col-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Company's</h2>
                            </div>
                            <div class="card-body">
                                <table id="table-companys" class="table table-bordered table-striped table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Telephone</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Website</th>
                                            <th>Facebook</th>
                                            <th>Registor Date</th>
                                            <th>Find</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Users</h2>
                            </div>
                            <div class="card-body">
                                <table id="company-users" class="table table-bordered table-striped table-responsive">
                                    <thead>
                                        <tr>
                                            <th>UUID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Authorize By</th>
                                            <th>Position</th>
                                            <th>Register Date</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('includes.footer')
    @push('script')
        <script src="{{ asset('lib/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('lib/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('lib/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('lib/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('lib/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('lib/js/buttons.bootstrap4.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(() => {
                $('#table-companys').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    "ajax": "{{ route('admin.all.companys') }}",
                    columns: [{
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'address',
                            name: 'address'
                        },
                        {
                            data: 'tel',
                            name: 'tel'
                        },
                        {
                            data: 'mobile',
                            name: 'mobile'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'web',
                            name: 'web'
                        },
                        {
                            data: 'fb_page',
                            name: 'fb_page'
                        },
                        {
                            data: 'registor_date',
                            name: 'registor_date'
                        },
                        {
                            data: "company_id",
                            render: function(data, type, row, meta) {
                                return type === 'display' ?
                                    '<button class="btn btn-primary" onClick="findUsers(' + data +
                                    ')">Find</button>' :
                                    data;
                            }
                        }
                    ]
                });
            });

            function findUsers(params) {
                tableDistroy();
                $('#company-users').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    "ajax": "{{ url('/') }}" + "/admin/company/user/" + params + "/list",
                    columns: [{
                            data: 'pic_uuid',
                            name: 'pic_uuid'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'mobile',
                            name: 'mobile'
                        },
                        {
                            data: 'authorize_by',
                            name: 'authorize_by'
                        },
                        {
                            data: 'position',
                            name: 'position'
                        },
                        {
                            data: 'registor_date',
                            name: 'registor_date'
                        },
                        {
                            data: "pic_id",
                            render: function(data, type, row, meta) {
                                return type === 'display' ?
                                    '<button class="btn btn-danger" onClick="deleteUsers(' + data +
                                    ')">Delete</button>' :
                                    data;
                            }
                        }
                    ]
                });
            }

            function tableDistroy() {
                let table = $('#company-users').DataTable();
                table.destroy();
            }

            function deleteUsers(params) {
                $.ajax({
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url: "{{ route('admin.company.user.delete') }}",
                    type: "DELETE",
                    data: {
                        id: params
                    },
                    beforeSend: () => {
                        console.log('Requested ...');
                    },
                    success: (res) => {
                        if (res.status == 200) {
                            load_table();
                            Toast.fire({
                                icon: 'success',
                                title: res.message
                            });
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
                        console.error(XMLHttpRequest.responseJSON
                            .message);
                    }
                });
            }

            function load_table() {
                let table = $('#company-users').DataTable();
                table.ajax.reload();
            }
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
