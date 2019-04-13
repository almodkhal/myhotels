<?php $__env->startSection('content'); ?>
 <!-- Start content -->
 <div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Employees</h4>
                    <a href="<?php echo e(url('employees/create')); ?>" class="btn btn-primary btn-rounded waves-light waves-effect float-right"><i class="fa fa-plus"></i> New Employee</a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->

<div class="row">
    <div class="col-lg-12">
        <div class="card-box mb-0">
            <table class="table table-hover table-bordered mb-0 datatable nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Employee</th>
                        <th>Department</th>
                        <th>Location</th>
                        <th>Email</th>
                        <th>Phone(M)</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($employees!=FALSE): ?>
                    <?php $i = 1; ?>
                    <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="row_<?php echo e($emp->id); ?>">
                        <td class="order"><?php echo e($i++); ?></td>
                        <td><strong><a href="<?php echo e(url('employees/'.$emp->eid.'/edit')); ?>"><?php echo e($emp->eid); ?></a></strong></td>
                        <td><?php echo e(ucwords($emp->fname.' '.$emp->lname)); ?></td>
                        <td><?php echo e(ucwords($emp->department->department)); ?></td>
                        <td><?php echo e(ucwords($emp->currentLocation)); ?></td>
                        <td><?php echo e($emp->email); ?></td>
                        <td><?php echo e($emp->mobilePhone); ?></td>
                        <td><?php switch($emp->status):
                                case ('active'): ?>
                                    <span class="badge badge-success">Active</span>
                                    <?php break; ?>
                                <?php case ('resigned'): ?>
                                    <span class="badge badge-danger">Resigned</span>
                                    <?php break; ?>
                                <?php case ('absconded'): ?>
                                    <span class="badge badge-secondary">Resigned</span>
                                    <?php break; ?>
                                <?php case ('terminated'): ?>
                                    <span class="badge badge-warning">Terminated</span>
                                    <?php break; ?>
                                <?php default: ?>
                                    <span class="badge badge-success">Active</span>
                            <?php endswitch; ?>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="<?php echo e(url('employees/'.$emp->eid.'/edit')); ?>" class="btn btn-info btn-rounded waves-light waves-effect"><i class="fa fa-edit"></i></a>
                                <button type="button" class="btn btn-danger btn-rounded waves-light waves-effect" id="dltBtn_<?php echo e($emp->user_id); ?>" onclick="deleteFn(<?php echo e($emp->user_id); ?>)"><i class="fa fa-trash-o"></i></button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" align="center">No employees found. <a href="<?php echo e(url('employees/create')); ?>">Add Employee</a></td>
                        </tr>
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
<script type="text/javascript">
//delete codes
function deleteFn(id) {
   swal({
    title: 'Delete this Employee?',
    text: 'This will remove the entire employee details, time entry details, etc. associated with it.',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#4fa7f3',
    cancelButtonColor: '#d57171',
    confirmButtonText: 'Delete'
  }).then(function () {
       $.ajax({
            url: burl+'/employees/'+id,
            type: 'DELETE',
            dataType: 'JSON',
            beforeSend: function() {
               $("#dltBtn_"+id).prop('disabled', true);
               $("#dltBtn_"+id).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
             },
            success: function (res) {
                window.location.href = "<?php echo e(url('employees')); ?>";
            }
        });
  });
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>