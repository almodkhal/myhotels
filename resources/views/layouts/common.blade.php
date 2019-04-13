<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="shortcut icon" href="{{ asset('/images/favicon.png') }}">

    <title>{{config('app.name')}} | @if(!isGuest()){{ucwords(Auth::user()->role)}}@else{{"India's No.1 Hotel"}}@endif</title>
    <!-- COOMON CSS -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/sweet-alert/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/jquery-toastr/jquery.toast.min.css') }}" rel="stylesheet">
    <!-- datatable css -->
    <link href="{{ asset('/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet">
    <!-- OWL Carousel -->
    <link href="{{ asset('/plugins/owl-carousel/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/owl-carousel/owl.theme.default.min.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/plugins/bootstrap-select/bootstrap-select.min.css') }}" />
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <!-- jQuery -->
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <!-- jquery UI css & js -->
    <link href="{{ asset('/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">
    <script src="{{ asset('/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  </head>
<body>

{{-- Success Message --}}
@if(session('update_success'))
<div class="alert alert-success row">
    <div class="col-2"><i class="fa fa-check-circle-o"></i></div>
    <div class="col-10">{{ session('update_success') }}</div>
</div>
@endif
{{-- Error Message --}}
@if(session('update_error'))
<div class="alert alert-error row">
    <div class="col-2"><i class="fa fa-times-circle-o"></i></div>
    <div class="col-10">{{ session('update_error') }}</div>
</div>
@endif
{{-- Ajax reponse alerts --}}
<div class="alert alert-success row" id="Alertsuccess" style="display: none;">
    <div class="col-2"><i class="fa fa-check-circle-o"></i></div>
    <div class="col-10" id="Msgsuccess"></div>
</div>
<div class="alert alert-error row" id="Alerterror" style="display: none;">
    <div class="col-2"><i class="fa fa-times-circle-o"></i></div>
    <div class="col-10" id="Msgerror"></div>
</div>

<!-- Navigation Menu-->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
  <a class="navbar-brand" href="{{ url('/') }}">
    <img width="50px" src="{{ asset('/images/logo.png') }}"> My Hotels <span>@if(!isGuest() && !isUser()){{ucwords(Auth::user()->role)}}@endif</span>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
    <?php $current =  Request::segment(1); ?>
    <ul class="navbar-nav">
      @if(isAdmin())
      <li class="nav-item">
        <a class="nav-link @if($current=='dashboard'){{'active'}}@endif" href="{{ url('dashboard') }}">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if($current=='managers'){{'active'}}@endif" href="{{ url('managers') }}">Managers</a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if($current=='rooms'){{'active'}}@endif" href="{{ url('rooms') }}">Rooms</a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if($current=='bookings'){{'active'}}@endif" href="{{ url('bookings') }}">Bookings</a>
      </li>
      @elseif(isManager())
      <li class="nav-item">
        <a class="nav-link @if($current=='bookings'){{'active'}}@endif" href="{{ url('bookings') }}">Bookings</a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if($current=='rooms'){{'active'}}@endif" href="{{ url('rooms') }}">Rooms</a>
      </li>
      @elseif(isUser())
      <li class="nav-item">
        <a class="nav-link @if($current==''){{'active'}}@endif" href="{{ url('/') }}">Rooms</a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if($current=='my-bookings'){{'active'}}@endif" href="{{ url('my-bookings') }}">My Bookings</a>
      </li>
      @else
      <li class="nav-item">
        <a class="nav-link @if($current==''){{'active'}}@endif" href="{{ url('/') }}">Rooms</a>
      </li>
      @endif
      @if(!isGuest())
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdownList" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #f75565;">
          {!!ucwords(Auth::user()->name)!!}
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownList">
          <a class="dropdown-item" href="javascript:;" onclick="event.preventDefault();$('#logout-form').submit();">Logout</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        </div>
      </li>
      @else
      <li class="nav-item">
        <a class="nav-link" href="javascript:;" data-toggle="modal" data-target="#accountModal">Login/SignUp</a>
      </li>
      @endif
    </ul>
  </div>
</nav>
@if(isGuest())
<!-- Login/ Signup Modal -->
<div class="modal fade bd-example-modal-lg bigModal" id="accountModal" tabindex="-1" role="dialog" aria-labelledby="somthing" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <i class="fa fa-times-circle"></i>
      </button>
    <div class="row login-page">
        <div class="col-md-6 login-left m-c">
        </div>
        <div class="col-md-6 login-right m-c p-4">
            {{-- Ajax reponse alerts --}}
            <div class="alert alert-success modalAlrt" id="Modalsuccess"></div>
            <div class="alert alert-error modalAlrt" id="Modalerror"></div>

            <div class="login-section">
              <div class="text-center">
                <img src="{{ asset('/images/logo.png') }}" width="100px">
              </div>
                <div class="app-name m-c mb-1">{{config('app.name')}}</div>
                <div id="loginForm">
                  <h5 class="text-center">Login to Book Rooms</h5>
                  <form id="realLoginForm" method="POST" action="{{ route('login') }}" autocomplete="off">
                       @csrf
                       <input type="hidden" name="role" value="user">
                       <div class="form-group">
                           <i class="fa fa-user-o icon"></i>
                           <input type="text" id="loginName" name="login" class="form-control" placeholder="Email or User name" value="thasleemmji">
                       </div>
                       <div class="form-group">
                           <i class="fa fa-key icon"></i>
                           <input type="password" id="loginPassword" name="password" class="form-control" placeholder="Password" value="thas@123">
                       </div>
                       <div class="form-group">
                            <div class="row">
                                <div class="col-6 text-left">
                                    <button type="submit" class="btn-login">Login <i class="fa fa-sign-in"></i></button>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="javascript:;" id="showForgot" class="btn btn-link">Forgot Password?</a>
                                </div>
                            </div>
                       </div>
                       <div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    New user? <a href="javascript:;" id="showSignUp">Create an account</a>
                                </div>
                            </div>
                       </div>
                   </form>
                  </div>
                  {{-- Signup form --}}
                  <div id="signUpForm" style="display: none;">
                    <h5 class="text-center">Create your Account</h5>
                    <form id="realSignupForm" method="POST" action="{{ url('sign-up') }}" autocomplete="off">
                       @csrf()
                       <div class="form-group">
                           <i class="fa fa-user-o icon"></i>
                           <input type="text" name="accountName" id="accountName" class="form-control" placeholder="Name">
                       </div>
                       <div class="form-group">
                           <i class="fa fa-envelope-o icon"></i>
                           <input type="text" name="accountEmail" id="accountEmail" class="form-control" placeholder="Email">
                       </div>
                       <div class="form-group">
                           <i class="fa fa-user-circle-o icon"></i>
                           <input type="text" name="accountUsername" id="accountUsername" class="form-control" placeholder="User name">
                       </div>
                       <div class="form-group">
                           <i class="fa fa-key icon" ></i>
                           <input type="password" name="accountPassword" id="accountPassword" class="form-control" placeholder="Password">
                       </div>
                       <div class="form-group">
                            <div class="row">
                                <div class="col-3 text-left">
                                    <a href="javascript:;" id="cancelSignUp" class="btn btn-link">Login</a>
                                </div>
                                <div class="col-9 text-right">
                                  <button type="submit" class="btn-login">Create Account <i class="fa fa-sign-in"></i></button>
                                </div>
                            </div>
                       </div>
                    </form>
                  </div>
                  {{-- Forgot pasword form --}}
                  <div id="forgotForm" style="display: none;">
                    <h5 class="text-center">Reset your Password</h5>
                    <form method="POST" action="javascript:;" autocomplete="off">
                      @csrf()
                       <div class="form-group">
                           <i class="fa fa-user-o icon"></i>
                           <input type="text" name="username" class="form-control" placeholder="Email or User name">
                       </div>
                       <div class="form-group">
                            <div class="row">
                                <div class="col-3 text-left">
                                    <a href="javascript:;" id="cancelForgot" class="btn btn-link">Login</a>
                                </div>
                                <div class="col-9 text-right">
                                  <button type="submit" class="btn-login">Reset Password <i class="fa fa-lock"></i></button>
                                </div>
                            </div>
                       </div>
                    </form>
                  </div>
              </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endif
<section class="contents">
<!-- ============================================================== -->
<!-- PAGE CONTENT GOES HERE -->
<!-- ============================================================== -->
      @yield('content')
<!-- ============================================================== -->
<!-- PAGE CONTENT GOES HERE -->
<!-- ============================================================== -->
</section>
<footer class="footer text-center fixed-bottom bg-dark">
  <div class="container">
    {{ date('Y')}} &copy; {{config('app.name')}} | <span>Developed By: <a target="_blank" href="http://thasleem.me">THASLEEM C</span></a>
  </div>
</footer>

<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->
<!-- END wrapper -->

<!-- COMMON Scripts  -->
<script type="text/javascript">
@if(isGuest())
  $("#showForgot").click(function () {
     $("#loginForm").hide();
     $("#forgotForm").slideDown();
  });

  $("#cancelForgot").click(function () {
     $("#forgotForm").hide();
     $("#loginForm").slideDown();
  });

  $("#showSignUp").click(function () {
     $("#loginForm").hide();
     $("#signUpForm").slideDown();
  });

  $("#cancelSignUp").click(function () {
     $("#signUpForm").hide();
     $("#loginForm").slideDown();
  });

  $("#realLoginForm").submit(function () {
    var login = $("#loginName").val();
    var pass = $("#loginPassword").val();
    if(!checkForNull(login,'loginName','Enter an email or username')) {
        return false;
    }
    if(!checkForNull(pass,'loginPassword','Enter a password')) {
        return false;
    }
    return true;
  });

  $("#realSignupForm").submit(function () {
    var name = $("#accountName").val();
    var email = $("#accountEmail").val();
    var username = $("#accountUsername").val();
    var password = $("#accountPassword").val();
    if(!checkForNull(name,'accountName','Enter a name')) {
        return false;
    }
    if(!checkForNull(email,'accountEmail','Enter an email')) {
        return false;
    }
    if(!emailValidateModal(email,'accountEmail')) {
        return false;
    }
     //value,inputField,dbColumn,table,message
    if(!fieldExistModal(email,'accountEmail','email','This Email already exist. Use different one')) {
        return false;
    }
    if(!checkForNull(username,'accountUsername','Enter an username')) {
        return false;
    }
     //value,inputField,dbColumn,message
    if(!fieldExistModal(username,'accountUsername','username','This Username already exist. Use different one')) {
        return false;
    }
    if(!checkForNull(password,'accountPassword','Enter a password')) {
        return false;
    }
    return true;
  });
@endif
    var burl = "{{ url('/') }}";
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}});
</script>
<script src="{{ asset('/js/popper.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/plugins/sweet-alert/sweetalert2.min.js') }}"></script>
<!-- Datatable js -->
<script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
{{-- Toaster js --}}
<script src="{{ asset('/plugins/jquery-toastr/jquery.toast.min.js') }}"></script>
<script src="{{ asset('/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('/js/custom.js') }}"></script>
<script src="{{ asset('/plugins/bootstrap-select/bootstrap-select.js') }}" type="text/javascript"></script>
</body>
</html>