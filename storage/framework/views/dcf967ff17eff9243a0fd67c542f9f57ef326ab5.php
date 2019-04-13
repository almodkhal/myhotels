<?php $__env->startSection('content'); ?>
<section class="jumbotron text-center">
  <div class="container">
    <h1 class="jumbotron-heading">Mini Car Inventory</h1>
    <p class="lead text-muted text-justify">This is a web application using which a user can create a manufacturer and thus create new Models of Cars with different colors, registration numbers, add images, etc. Also the inventory listing section has all the inventory data and user can change the "Sold" status of any particular car.</p>
    <p>
      <a href="<?php echo e(url('manufacturers')); ?>" class="btn btn-primary"><i class="fa fa-industry"></i> Manufacturers</a>
      <a href="<?php echo e(url('models')); ?>" class="btn btn-secondary"><i class="fa fa-car"></i> Models</a>
      <a href="<?php echo e(url('inventory')); ?>" class="btn btn-success"><i class="fa fa-search"></i> Inventory</a>
    </p>
  </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>