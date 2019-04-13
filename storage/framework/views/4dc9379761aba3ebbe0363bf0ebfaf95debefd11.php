<?php $__env->startSection('content'); ?>
 <!-- Start content -->
 <div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Dashboard</h4>

                    <span class="float-right loggedin">welcome, <strong><?php echo e(ucwords(Auth::user()->name)); ?></strong></span>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->


        <div class="row justify-content-center">
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <a href="<?php echo e(url('companies')); ?>">
                <div class="card-box tilebox-one">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="mb-0">Companies</h3>
                        </div>
                        <div class="col-4 text-right">
                            <i class="fi-briefcase"></i>
                        </div>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <a href="<?php echo e(url('clients')); ?>">
                <div class="card-box tilebox-one">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="mb-0">Clients</h3>
                        </div>
                        <div class="col-4 text-right">
                            <i class="fa fa-user-md"></i>
                        </div>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <a href="<?php echo e(url('employees')); ?>">
                <div class="card-box tilebox-one">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="mb-0">Employees</h3>
                        </div>
                        <div class="col-4 text-right">
                            <i class="fa fa-user-o"></i>
                        </div>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <a href="<?php echo e(url('projects')); ?>">
                <div class="card-box tilebox-one">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="mb-0">Projects</h3>
                        </div>
                        <div class="col-4 text-right">
                            <i class="fa fa-briefcase"></i>
                        </div>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                <a href="<?php echo e(url('timeentry')); ?>">
                <div class="card-box tilebox-one">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="mb-0">Time Entry</h3>
                        </div>
                        <div class="col-4 text-right">
                            <i class="fa fa-clock-o"></i>
                        </div>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                <a href="<?php echo e(url('expense')); ?>">
                <div class="card-box tilebox-one">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="mb-0">Expense</h3>
                        </div>
                        <div class="col-4 text-right">
                            <i class="fa fa-money"></i>
                        </div>
                    </div>
                </div>
                </a>
            </div>

        </div>



        


    </div> <!-- container -->
</div> <!-- content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>