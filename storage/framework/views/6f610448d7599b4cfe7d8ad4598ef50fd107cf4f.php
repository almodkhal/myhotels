<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="shortcut icon" href="<?php echo e(asset('/images/favicon.png')); ?>">

    <title><?php echo e(config('app.name')); ?></title>
    <!-- COOMON CSS -->
    <link href="<?php echo e(asset('/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/sweet-alert/sweetalert2.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/jquery-toastr/jquery.toast.min.css')); ?>" rel="stylesheet">
    <!-- datatable css -->
    <link href="<?php echo e(asset('/plugins/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/datatables/responsive.bootstrap4.min.css')); ?>" rel="stylesheet">
    <!-- OWL Carousel -->
    <link href="<?php echo e(asset('/plugins/owl-carousel/owl.carousel.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/plugins/owl-carousel/owl.theme.default.min.css')); ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/plugins/bootstrap-select/bootstrap-select.min.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/plugins/custombox/custombox.min.css')); ?>" />
    <link href="<?php echo e(asset('/css/style.css')); ?>" rel="stylesheet">
    <!-- jQuery -->
    <script src="<?php echo e(asset('/js/jquery.min.js')); ?>"></script>
  </head>
<body>


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

<!-- Navigation Menu-->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
  <a class="navbar-brand" href="<?php echo e(url('dashboard')); ?>">
    <img width="50px" src="<?php echo e(asset('/images/logo.png')); ?>"> Mini Car Inventory
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo e(url('dashboard')); ?>">Dashboard</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdownList" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Masters
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownList">
          <a class="dropdown-item" href="<?php echo e(url('manufacturers')); ?>">Add Manufacturer</a>
          <a class="dropdown-item" href="<?php echo e(url('models')); ?>">Add Model</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo e(url('inventory')); ?>">Inventory</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="javascript:;" onclick="event.preventDefault();$('#logout-form').submit();">Logout
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;"><?php echo csrf_field(); ?></form>
        </a>
      </li>
    </ul>
  </div>
</nav>
<section class="contents">
<!-- ============================================================== -->
<!-- PAGE CONTENT GOES HERE -->
<!-- ============================================================== -->
      <?php echo $__env->yieldContent('content'); ?>
<!-- ============================================================== -->
<!-- PAGE CONTENT GOES HERE -->
<!-- ============================================================== -->
</section>
<footer class="footer text-center fixed-bottom bg-dark">
  <div class="container">
    <?php echo e(date('Y')); ?> &copy; <?php echo e(config('app.name')); ?> | <span>Developed By: <a target="_blank" href="http://thasleem.me">THASLEEM C</span></a>
  </div>
</footer>

<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->
<!-- END wrapper -->

<!-- COMMON Scripts  -->
<script type="text/javascript">
    var burl = "<?php echo e(url('/')); ?>";
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"}});
</script>
<script src="<?php echo e(asset('/js/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/sweet-alert/sweetalert2.min.js')); ?>"></script>
<!-- Datatable js -->
<script src="<?php echo e(asset('/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
ss<script src="<?php echo e(asset('/plugins/datatables/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/datatables/responsive.bootstrap4.min.js')); ?>"></script>

<script src="<?php echo e(asset('/plugins/jquery-toastr/jquery.toast.min.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/owl-carousel/owl.carousel.min.js')); ?>"></script>
<script src="<?php echo e(asset('/js/custom.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/bootstrap-select/bootstrap-select.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('/plugins/custombox/custombox.min.js')); ?>" type="text/javascript"></script>
</body>
</html>