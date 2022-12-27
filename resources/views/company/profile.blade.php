@extends('layout.layout')
@section('meta')

@endsection
@section('title', 'company profile')
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
                    <a href="{{route('control_panel.profile.view')}}" class="nav-link active">
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
                        <li class="breadcrumb-item active">Profile</li>
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
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if (session()->get('company_user.company.company_avatar') == "")

                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('upload/profile/defult_av.jpg') }}" loading="lazy"
                                    alt="User profile picture">
                                @else
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset(session()->get('company_user.company.company_avatar')) }}"
                                    loading="lazy" alt="User profile picture">

                                @endif
                            </div>

                            <h3 class="profile-username text-center">{{session()->get('company_user.company.name')}}
                            </h3>

                            <p class="text-muted text-center">{{session()->get('company_user.industry.industry_name')}}
                            </p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Followers</b> <a class="float-right">1,322</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Following</b> <a class="float-right">543</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Friends</b> <a class="float-right">13,287</a>
                                </li>
                            </ul>

                            <div class="row">
                                <div class="col-6 col-md-6">
                                    <a href="javascript:void(0)" id="connection-btn"
                                        class="btn btn-outline-success">Connections</a>
                                </div>
                                <div class="col-6 col-md-6">
                                    <a href="javascript:void(0)" id="approvel-btn"
                                        class="btn btn-outline-success">Approvel</a>
                                </div>
                            </div>
                            <div id="approve-model" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="row" id="content"></div>
                                    </div>
                                </div>
                            </div>
                            <div id="conection-model" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="row" id="conn-content"></div>
                                    </div>
                                </div>
                            </div>
                            {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Education</strong>

                            <p class="text-muted">
                                B.S. in Computer Science from the University of Tennessee at Knoxville
                            </p>

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>

                            <p class="text-muted">{{session()->get('company_user.company.address')}}</p>

                            <hr>

                            <strong><i class="fas fa-pencil-alt mr-1"></i> Social</strong>

                            <p class="text-muted">
                                <span class="tag tag-danger">Facebook</span>
                                <span class="tag tag-success">Instargrame</span>
                                <span class="tag tag-info">Linkdin</span>
                                <span class="tag tag-warning">Whatsapp</span>
                            </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Company details</h2>
                        </div>
                        <div class="card-body">
                            <form id="profile-update" action="{{route('control_panel.profile.update')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="name">Name:</label>
                                                    <input type="text" class="form-control" name="name" id="name"
                                                        placeholder="Company name"
                                                        value="{{session()->get('company_user.company.name')}}" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="mobile">Mobile:</label>
                                                    <input type="tel" class="form-control" id="mobile" name="mobile"
                                                        placeholder="Enter mobile number"
                                                        value="{{session()->get('company_user.company.mobile')}}" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="tel">Telephone:</label>
                                                    <input type="tel" name="tel" id="tel" class="form-control"
                                                        placeholder="Enter telephone number"
                                                        value="{{session()->get('company_user.company.tel')}}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">Address:</label>
                                            <textarea name="address" id="address" class="form-control"
                                                rows="8">{{session()->get('company_user.company.address')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Enter email address"
                                                value="{{session()->get('company_user.company.email')}}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="avatar">Avatar:</label>
                                            <input type="file" class="form-control" name="avatar" id="avatar"
                                                accept="image/jpeg" />
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="display: none">
                                        <div class="form-group">
                                            <label for="path">Path:</label>
                                            <input type="text" class="form-control" name="path" id="path"
                                                value="{{session()->get('company_user.company.company_avatar')}}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="web">Website Link:</label>
                                            <input type="url" class="form-control" name="web" id="web"
                                                placeholder="Enter wensite url"
                                                value="{{session()->get('company_user.company.web')}}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fb_page">Facebook Page:</label>
                                            <input type="url" class="form-control" name="fb_page" id="fb_page"
                                                placeholder="Enter facebook page url"
                                                value="{{session()->get('company_user.company.fb_page')}}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="country">Country:</label>
                                            <select name="country" id="country" class="form-control">
                                                @foreach ($country as $key => $data)
                                                <option value="{{$data->country_id}}">{{$data->country}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="industry">Industry:</label>
                                            <select name="industry" id="industry" class="form-control">
                                                @foreach ($industry as $key => $data)
                                                <option value="{{$data->industry_id}}">{{$data->industry_name}}</option>
                                                @endforeach
                                            </select>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Social</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('control_panel.company.social.add')}}" method="POST">
                                @csrf
                                @method('post')
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="media_name">Media Name:</label>
                                                <input type="text" name="media_name" id="media_name"
                                                    class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="media_link">Media Link:</label>
                                                <input type="url" name="media_link" id="media_link"
                                                    class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="d-flex float-right">
                                                <button type="submit" class="btn btn-info">ADD</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            @foreach ($social as $key => $data)
                            <a class="badge badge-warning p-3" href="{{$data->link}}"
                                target="blank">{{$data->social_media_name}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('includes.footer')
<script type="text/javascript">
    $(document).ready(() => {
        // socials();
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

     document.getElementById('connection-btn').addEventListener('click', (e) => {
        $.ajax({
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: "{{ route('control_panel.connection.list') }}",
            type: "GET",
            beforSend:() => {
                console.log('requested ...');
            },
            success:(res) => {
               $('#conn-content').html(res.list);
               $('#conection-model').modal('show');
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
    //  document.getElementById('social-form').addEventListener('submit', (e) => {
    //     e.preventDefault();
    //     $.ajax({
    //         headers: {
    //             'Accept': 'application/json',
    //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //         },
    //         url:"{{route('control_panel.company.social.add')}}",
    //         type:"POST",
    //         data:$('#social-form').serialize(),
    //         beforSend: () => {
    //             console.log('requested ...');
    //         },
    //         success: (res) => {
    //             if (res.status == 200) {
    //                 Toast.fire({
    //                     icon: 'success',
    //                     title: res.message
    //                 });
    //                 // socials();
    //             }else{
    //                 Toast.fire({
    //                     icon: 'error',
    //                     title: res.message
    //                 });
    //             }
    //         },
    //         error: (XMLHttpRequest, textStatus, errorThrown) => {
    //             Toast.fire({
    //                     icon: 'warning',
    //                     title: XMLHttpRequest.responseJSON
    //                             .message
    //                 });
    //         }
    //     });
    //  });

    //  function socials() {
    //     let social_area =  $('#social-tag');
    //     social_area.innerHTML = "";
    //     $.ajax({
    //         headers: {
    //             'Accept': 'application/json',
    //         },
    //         url:"{{route('control_panel.all.company.socials')}}",
    //         type:"GET",
    //         beforSend: () => {
    //             console.log('requested ...');
    //         },
    //         success: (res) => {
    //             let tag;
    //             res.forEach(element => {
    //                 tag += ' <div class="alert alert-warning alert-dismissible">'+
    //               '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
    //               '<h5>'+element.social_media_name+'</h5>'+
    //                 '</div>' 
    //             });

    //             social_area.html(tag);
    //         },
    //         error: (XMLHttpRequest, textStatus, errorThrown) => {
    //             Toast.fire({
    //                     icon: 'warning',
    //                     title: XMLHttpRequest.responseJSON
    //                             .message
    //                 });
    //         }
    //     });
    //  }
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
<script type="text/javascript">
    document.getElementById('approvel-btn').addEventListener('click', (e) => {
        $.ajax({
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: '{{route("control_panel.approve.list")}}',
            type: 'GET',
            beforSend: () => {

            },
            success: (res) => {
                $("#content").html(res.data);
                $('#approve-model').modal('show');
            },
            error: (XMLHttpRequest, textStatus, errorThrown) => {

            }
        });
    });
</script>
{{-- <script type="text/javascript">
    document.getElementById('profile-update').addEventListener('submit', (e) => {
        e.preventDefault();
        $.ajax({
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'multipart/form-data',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: '{{route("control_panel.profile.update")}}',
            type:'POST',
            data:$('#profile-update').serialize(),
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
                // Toast.fire({
                //         icon: 'warning',
                //         title: XMLHttpRequest.responseJSON.message
                //     });
                console.log(XMLHttpRequest);
            }
        });
     });

</script> --}}
@endsection