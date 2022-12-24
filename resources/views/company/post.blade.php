@extends('layout.layout')
@section('meta')

@endsection
@section('title', 'company profile')
@section('content')
@include('includes.nav')
@push('styles')
<link rel="stylesheet" href="{{ asset('lib/css/summernote-bs4.min.css') }}" />
@endpush
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
                    <a href="{{route('control_panel.person_in_charge')}}" class="nav-link">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            Person In Charge
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('control_panel.profile.view')}}" class="nav-link">
                        <i class="nav-icon fa fa-user-secret"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('control_panel.all.company.post')}}" class="nav-link active">
                        <i class="nav-icon fa fa-plus"></i>
                        <p>
                            Post
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
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Post</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Post</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('control_panel.company.post.create')}}" method="POST">
                                @csrf
                                @method('post')
                                <div class="form-group">
                                    <textarea class="form-control" name="content" id="content" rows="3"></textarea>
                                    @error('content')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="d-flex float-right">
                                        <button class="btn btn-primary" type="submit">Post</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @foreach ($post as $key => $item)
                                <div class="card">
                                    <div class="card-body">
                                        {!!$item->content!!}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('includes.footer')
@push('script')
<script src="{{ asset('lib/js/summernote-bs4.min.js') }}"></script>
@endpush
<script type="text/javascript">
    $(document).ready(() => {
       $('#content').summernote();
    });
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