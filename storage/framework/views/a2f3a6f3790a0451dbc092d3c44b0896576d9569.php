<?php $__env->startSection('content'); ?>
<section class="jumbotron text-center">
  <div class="container">
    <h1 class="jumbotron-heading mb-5">Welcome <?php echo strtoupper(Auth::user()->role); ?></h1>
      <a href="<?php echo e(url('managers')); ?>" class="btn btn-primary"><i class="fa fa-user-md"></i> Managers</a>
      <a href="<?php echo e(url('rooms')); ?>" class="btn btn-secondary"><i class="fa fa-bed"></i> Rooms</a>
      <a href="<?php echo e(url('bookings')); ?>" class="btn btn-success"><i class="fa fa-calendar-check-o"></i> Bookings</a>
    </p>
  </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>