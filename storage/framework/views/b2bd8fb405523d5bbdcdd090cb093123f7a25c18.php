<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo e(asset('/images/favicon.ico')); ?>">

    <title>Evas international</title>
    <!-- COOMON CSS -->
    <link href="<?php echo e(asset('/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/icons.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/metismenu.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/icons.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/sweet-alert/sweetalert2.min.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('/plugins/jquery-toastr/jquery.toast.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/switchery/switchery.min.css')); ?>" rel="stylesheet">
    <!-- datatable css -->
    <link href="<?php echo e(asset('/plugins/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/datatables/buttons.bootstrap4.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/datatables/responsive.bootstrap4.min.css')); ?>" rel="stylesheet">
    <!-- Custom CSS -->  
    <?php echo $__env->yieldContent('customcss'); ?>
    <link href="<?php echo e(asset('/css/style.css')); ?>" rel="stylesheet">
    <!-- jQuery -->
    <script src="<?php echo e(asset('/js/jquery.min.js')); ?>"></script>  
    
    <link href="<?php echo e(asset('/plugins/jquery-ui/jquery-ui.min.css')); ?>" rel="stylesheet">
    <script src="<?php echo e(asset('/plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>  
  </head>
<body>

<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    <div class="topbar">

        <!-- LOGO -->
        <div class="topbar-left">
            <a href="index.html" class="logo">
                <span>
                    <img src="<?php echo e(asset('/images/logo.png')); ?>" alt="" height="50">
                </span>
                <i>
                    <img src="<?php echo e(asset('/images/logo_sm.png')); ?>" alt="" height="40">
                </i>
            </a>
        </div>

        <nav class="navbar-custom">

            <ul class="list-unstyled topbar-right-menu float-right mb-0">
                <li class="dropdown notification-list hide-phone">
                    <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                       <i class="mdi mdi-earth"></i> <span>English</span>  <i class="mdi mdi-chevron-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            Spanish
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            Italian
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            French
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            Russian
                        </a>

                    </div>
                </li>

                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        <i class="fi-bell noti-icon"></i>
                        <span class="badge badge-danger badge-pill noti-icon-badge">4</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h6 class="m-0"><span class="float-right"><a href="#" class="text-dark"><small>Clear All</small></a> </span>Notification</h6>
                        </div>

                        <div class="slimscroll" style="max-height: 190px;">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-success"><i class="mdi mdi-comment-account-outline"></i></div>
                                <p class="notify-details">Caleb Flakelar commented on Admin<small class="text-muted">1 min ago</small></p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-info"><i class="mdi mdi-account-plus"></i></div>
                                <p class="notify-details">New user registered.<small class="text-muted">5 hours ago</small></p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-danger"><i class="mdi mdi-heart"></i></div>
                                <p class="notify-details">Carlos Crouch liked <b>Admin</b><small class="text-muted">3 days ago</small></p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-warning"><i class="mdi mdi-comment-account-outline"></i></div>
                                <p class="notify-details">Caleb Flakelar commented on Admin<small class="text-muted">4 days ago</small></p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-purple"><i class="mdi mdi-account-plus"></i></div>
                                <p class="notify-details">New user registered.<small class="text-muted">7 days ago</small></p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-custom"><i class="mdi mdi-heart"></i></div>
                                <p class="notify-details">Carlos Crouch liked <b>Admin</b><small class="text-muted">13 days ago</small></p>
                            </a>
                        </div>

                        <!-- All-->
                        <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                            View all <i class="fi-arrow-right"></i>
                        </a>

                    </div>
                </li>

                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        <i class="fi-speech-bubble noti-icon"></i>
                        <span class="badge badge-light badge-pill noti-icon-badge">6</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h6 class="m-0"><span class="float-right"><a href="#" class="text-dark"><small>Clear All</small></a> </span>Chat</h6>
                        </div>

                        <div class="slimscroll" style="max-height: 190px;">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon"><img src="<?php echo e(asset('/images/users/avatar-2.jpg')); ?>" class="img-fluid rounded-circle" alt="" /> </div>
                                <p class="notify-details">Cristina Pride</p>
                                <p class="text-muted font-13 mb-0 user-msg">Hi, How are you? What about our next meeting</p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon"><img src="<?php echo e(asset('/images/users/avatar-3.jpg')); ?>" class="img-fluid rounded-circle" alt="" /> </div>
                                <p class="notify-details">Sam Garret</p>
                                <p class="text-muted font-13 mb-0 user-msg">Yeah everything is fine</p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon"><img src="<?php echo e(asset('/images/users/avatar-4.jpg')); ?>" class="img-fluid rounded-circle" alt="" /> </div>
                                <p class="notify-details">Karen Robinson</p>
                                <p class="text-muted font-13 mb-0 user-msg">Wow that's great</p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon"><img src="<?php echo e(asset('/images/users/avatar-5.jpg')); ?>" class="img-fluid rounded-circle" alt="" /> </div>
                                <p class="notify-details">Sherry Marshall</p>
                                <p class="text-muted font-13 mb-0 user-msg">Hi, How are you? What about our next meeting</p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon"><img src="<?php echo e(asset('/images/users/avatar-6.jpg')); ?>" class="img-fluid rounded-circle" alt="" /> </div>
                                <p class="notify-details">Shawn Millard</p>
                                <p class="text-muted font-13 mb-0 user-msg">Yeah everything is fine</p>
                            </a>
                        </div>

                        <!-- All-->
                        <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                            View all <i class="fi-arrow-right"></i>
                        </a>

                    </div>
                </li>

                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        <img src="<?php echo e(asset('/images/users/avatar-1.jpg')); ?>" alt="user" class="rounded-circle"> <span class="ml-1">Admin <i class="mdi mdi-chevron-down"></i> </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown">

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fi-head"></i> <span>My Account</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fi-cog"></i> <span>Settings</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fi-help"></i> <span>Support</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fi-lock"></i> <span>Lock Screen</span>
                        </a>

                        <!-- item-->
                        <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                            $('#logout-form').submit();" class="dropdown-item notify-item">
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;"><?php echo csrf_field(); ?></form>
                            <i class="fi-power"></i> <span>Logout</span>
                        </a>

                    </div>
                </li>

            </ul>

            <ul class="list-inline menu-left mb-0">
                <li class="float-left">
                    <button class="button-menu-mobile open-left waves-light waves-effect">
                        <i class="dripicons-menu"></i>
                    </button>
                </li>
            </ul>

        </nav>

    </div>
    <!-- Top Bar End -->


    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
        <div class="slimscroll-menu" id="remove-scroll">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu" id="side-menu">
                    <li class="menu-title">Navigation</li>
                    <li><a href="<?php echo e(url('dashboard')); ?>"><i class="fi-air-play"></i><span> Dashboard </span></a></li>

                    <li><a href="<?php echo e(url('companies')); ?>"><i class="fi-briefcase"></i> <span>Companies</span> </a></li>

                    <li><a href="<?php echo e(url('clients')); ?>"><i class="fa fa-user-md"></i> <span>Clients</span> </a></li>

                    <li><a href="<?php echo e(url('employees')); ?>"><i class="fa fa-user-o"></i> <span>Employees</span> </a></li>

                    <li>
                        <a href="javascript: void(0);"><i class="fa fa-briefcase"></i> <span>Jobs</span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="jobs/create">Create New Job</a></li>
                            <li><a href="jobs/assign">Resource Allocation</a></li>
                            <li><a href="jobs">Job List</a></li>
                        </ul>
                    </li>

                    <li><a href="timeentry"><i class="fa fa-clock-o"></i> <span>Time Entry</span> </a></li>

                    <li><a href="expense"><i class="fa fa-money"></i> <span>Expense</span> </a></li>

                    <li class="menu-title">More</li>

                    <li>
                        <a href="javascript: void(0);"><i class="fi-paper"></i> <span>Reports</span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="reports/job">Job Wise Effort</a></li>
                            <li><a href="reports/employee">Employee Wise Effort</a></li>
                            <li><a href="reports/expense">Expense</a></li>
                            <li><a href="reports/leave">Leave</a></li>
                            <li><a href="reports/invoiced">Invoiced</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);"><i class="mdi mdi-account-settings-variant"></i> <span>Master Settings</span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="masters/job">Job Name</a></li>
                            <li><a href="masters/activity">Activity Name</a></li>
                            <li><a href="masters/sub-activity">Sub Activity Name</a></li>
                            <li><a href="masters/leave">Leave Type</a></li>
                            <li><a href="masters/expense">Expense Type</a></li>
                            <li><a href="masters/calender">Calender</a></li>
                            <li><a href="masters/currency">Currency</a></li>
                        </ul>
                    </li>

                    
                </ul>

            </div>
            <!-- Sidebar -->
            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>
    <!-- Left Sidebar End -->

<?php if(session('update_success')): ?>
<div class="alert alert-success row">
    <div class="col-2"><i class="fa fa-check-circle-o"></i></div>
    <div class="col-10"><?php echo e(session('update_success')); ?></div>
</div>
<?php endif; ?>

<?php if(session('update_error')): ?>
<div class="alert alert-error row">
    <div class="col-2"><i class="fa fa-times-circle-o"></i></div>
    <div class="col-10"><?php echo e(session('update_error')); ?></div>
</div>
<?php endif; ?>

<div class="alert alert-success row" id="Alertsuccess" style="display: none;">
    <div class="col-2"><i class="fa fa-check-circle-o"></i></div>
    <div class="col-10" id="Msgsuccess"></div>
</div>
<div class="alert alert-error row" id="Alerterror" style="display: none;">
    <div class="col-2"><i class="fa fa-times-circle-o"></i></div>
    <div class="col-10" id="Msgerror"></div>
</div>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">

<!-- ============================================================== -->
<!-- PAGE CONTENT GOES HERE -->
<!-- ============================================================== -->
      <?php echo $__env->yieldContent('content'); ?>
<!-- ============================================================== -->
<!-- PAGE CONTENT GOES HERE -->
<!-- ============================================================== -->
  

<footer class="footer text-right">
    <?php echo e(date('Y')); ?> &copy; Evas International
</footer>

</div>

<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->
</div>
<!-- END wrapper -->

<!-- COMMON Scripts  -->
<script type="text/javascript">
    var burl = "<?php echo e(url('/')); ?>";
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"}});
    $(".datepicker").datepicker();
</script>
<script src="<?php echo e(asset('/js/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('/js/metisMenu.min.js')); ?>"></script>
<script src="<?php echo e(asset('/js/waves.js')); ?>"></script>
<script src="<?php echo e(asset('/js/jquery.slimscroll.js')); ?>"></script>
<script src="<?php echo e(asset('/js/pages/jquery.dashboard.init.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/sweet-alert/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/switchery/switchery.min.js')); ?>"></script>
<script src="<?php echo e(asset('/js/jquery.core.js')); ?>"></script>
<script src="<?php echo e(asset('/js/jquery.app.js')); ?>"></script>
<!-- Datatable js -->
<script src="<?php echo e(asset('/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/datatables/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/datatables/buttons.bootstrap4.min.js')); ?>"></script>

<script src="<?php echo e(asset('/plugins/datatables/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/datatables/vfs_fonts.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/datatables/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/datatables/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/datatables/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/datatables/responsive.bootstrap4.min.js')); ?>"></script>

<script src="<?php echo e(asset('/plugins/jquery-toastr/jquery.toast.min.js')); ?>"></script>
<script src="<?php echo e(asset('/js/custom.js')); ?>"></script>
<?php echo $__env->yieldContent('customjs'); ?>
</body>
</html>