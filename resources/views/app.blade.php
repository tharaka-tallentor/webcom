@extends('layout.layout')
@section('meta')

@endsection
@section('title', 'Home')
@push('styles')
<link rel="stylesheet" href="{{ asset('lib/css/slick.css') }}" />
@endpush
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
@section('content')
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
                    <a href="{{route('control_panel.dashboard')}}" class="nav-link active">
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
                    <a href="{{route('control_panel.all.company.post')}}" class="nav-link">
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

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
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
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">CPU Traffic</span>
                            <span class="info-box-number">
                                10
                                <small>%</small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Likes</span>
                            <span class="info-box-number">41,410</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Sales</span>
                            <span class="info-box-number">760</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">New Members</span>
                            <span class="info-box-number">2,000</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-md-12 col-sm-12">
                    <div class="connections">
                        @foreach ($connections as $key => $data)
                        <div class="card m-2">
                            <img src="{{ asset($data->company_avatar) }}" class="card-img" loading="lazy"
                                alt="coonection_avatar">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <div class="d-flex justify-content-center">
                                            <h3 class="card-title">{{$data->name}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{route('control_panel.approvel', ['id' => $data->company_id])}}"
                                                class="btn btn-primary rounded-circle">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @foreach ($news_que as $key => $item)
                                <div class="col-12 col-md-12 col-sm-6">
                                    <div class="card">
                                        <div class="d-flex justify-content-center">
                                            {!! $item['content'] !!}
                                        </div>
                                        <div class="d-flex float-right">
                                            <p>{{$item['date']}}</p>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-3 col-md-3">
                                                    <select name="react" id="react" class="form-control"
                                                        style="border: none">
                                                        @foreach ($reaction as $react_key => $react)
                                                        <option value="{{$react->react_id }}">
                                                            <span
                                                                style="width: 20px; height: auto;">{!!$react->emojy_code!!}</span>
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <a href="javascript:void(0)" onclick="comment_open({{$item['id']}})"
                                                        style="color: white">
                                                        <i class="fa fa-comment" aria-hidden="true"></i>
                                                        Comment
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div id="comment-model" class="modal fade bd-example-modal-lg" tabindex="-1"
                                    role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="col-12 col-md-12 col-sm-6">
                                                <div class="card mt-2">
                                                    <form action="{{route('control_panel.post.comment')}}"
                                                        method="POST">
                                                        @csrf
                                                        @method('POST')
                                                        <div class="input-group" style="display: none">
                                                            <input type="text" class="form-control" name="post_id"
                                                                id="post_id" />
                                                        </div>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="post_comment"
                                                                id="post_comment" />
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-primary"
                                                                    type="submit">Comment</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="row" id="content"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('includes.footer')
@push('script')
<script src="{{ asset('lib/js/slick.min.js') }}"></script>
@endpush
<script type="text/javascript">
    $(document).ready(() => {
        $('.connections').slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 4,
            responsive: [
                {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: false
                }
                },
                {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
                },
                {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
                }
            ]
            });
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
                    alert(res.message);
                }
            },
            error:(XMLHttpRequest, textStatus, errorThrown) =>{
                console.error(XMLHttpRequest.responseJSON
                                .message);
            }
        });
     });

    function comment_open(params) {
        $('#comment-model').modal('show');
        $('#post_id').val(params);
        getAllComment(params)
    }

    document.getElementById('comment-form').addEventListener('submit', (e) => {
        $.ajax({
            headers:{
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: '{{route("control_panel.post.comment")}}',
            type: 'POST',
            data: $('#comment-form').serialize(),
            beforSend: () => {
                console.log('requested ...');
            },
            success: (res) => {
                if(res.status == 200){
                    let post_id = document.getElementById('post_comment');
                    getAllComment(post_id.value);
                    post_id.value = "";
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
                console.error(XMLHttpRequest.responseJSON
                                .message);
            }
        });
    });

    function getAllComment(value){
        $.ajax({
            headers:{
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: 'GET',
            url: '{{url("/")}}'+ '/control/all/post/' + value + '/' + 'comment',
            processData: false,
            beforSend: () => {
                console.log('requested .....');
            },
            success: (res) => {
                $('#content').html(res);
            },
            error: (XMLHttpRequest, textStatus, errorThrown) => {
                console.error(XMLHttpRequest.responseJSON
                                .message);
            }
        });
    }
</script>
@endsection