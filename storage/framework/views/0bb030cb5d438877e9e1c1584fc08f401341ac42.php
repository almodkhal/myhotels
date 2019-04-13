<?php $__env->startSection('customcss'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/plugins/bootstrap-select/css/bootstrap-select.min.css')); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 <!-- Start content -->
 <div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">PERMISSIONS</h4>
                    <div class="btn-group float-right">
                        <a href="<?php echo e(url('masters/roles')); ?>" class="btn btn-primary btn-rounded waves-light waves-effect float-right"><i class="fa fa-file-text-o"></i> Manage Roles</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->

<div class="row justify-content-center">
    <div class="col-lg-9 col-md-12">
        <div class="card-box mb-0 table-responsive" style="min-height: calc(100vh - 210px);">
            <div class="row form-group justify-content-end">
                <div class="col-sm-6 col-21">
                    <h4 class="header-title mb-0 float-left" style="line-height: 36px;"><span id="selRole" style="color: #dc3545;">Admin</span> Permissions</h4>
                </div>
                <div class="col-sm-6 col-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-right pr-1">
                            <span class="form-control pr-0" style="border: none;">Select Role: </span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-right pl-1">
                            <select class="selectpicker" name="role" id="role" data-style="btn-light">
                                <?php if($roles!=FALSE): ?>
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($role->id); ?>" <?php if($role->id==1): ?><?php echo e('selected'); ?><?php endif; ?>><?php echo e(ucwords($role->role)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <style type="text/css">
                .fa-check-circle {color: #229a73;font-size: 16px;}
                .fa-times-circle {color: #dc3545;font-size: 16px;}
            </style>
            <table class="table table-hover table-bordered mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Forms</th>
                        <th style="text-align: center;">Create</th>
                        <th style="text-align: center;">Edit</th>
                        <th style="text-align: center;">Delete</th>
                    </tr>
                </thead>
                <tbody id="permissionsTbl">
                    <?php if($permissions!=FALSE): ?>
                    <?php $i = 1; ?>
                    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="order"><?php echo e($i++); ?></td>
                        <td><?php echo e(ucwords($permi->forms)); ?></td>
                        <td align="center"><i class="fa fa-<?php if($permi->new=='1'): ?><?php echo e('check'); ?><?php else: ?><?php echo e('times'); ?><?php endif; ?>-circle"></i></td>
                        <td align="center"><i class="fa fa-<?php if($permi->edit=='1'): ?><?php echo e('check'); ?><?php else: ?><?php echo e('times'); ?><?php endif; ?>-circle"></i></td>
                        <td align="center"><i class="fa fa-<?php if($permi->destroy=='1'): ?><?php echo e('check'); ?><?php else: ?><?php echo e('times'); ?><?php endif; ?>-circle"></i></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <?php $i = 1; ?>
                    <?php $__currentLoopData = $forms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="order"><?php echo e($i++); ?></td>
                        <td><?php echo e(ucwords($form->form)); ?></td>
                        <td align="center"><i class="fa fa-check-circle"></i></td>
                        <td align="center"><i class="fa fa-check-circle"></i></td>
                        <td align="center"><i class="fa fa-check-circle"></i></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- end row -->
    </div> <!-- container -->
</div> <!-- content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('customjs'); ?>
<script src="<?php echo e(asset('/plugins/bootstrap-select/js/bootstrap-select.js')); ?>" type="text/javascript"></script>
<script type="text/javascript">
$("#role").change(function(){
    var role = $(this).val();
    var selRoleName = $("#role option:selected").text();
     $("#selRole").text(selRoleName);
    $.ajax({
        url: burl+'/masters/permissions/'+role,
        type: 'GET',
        dataType: 'JSON',
        success: function (res) {
            $('#permissionsTbl').html(res);
        }
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>