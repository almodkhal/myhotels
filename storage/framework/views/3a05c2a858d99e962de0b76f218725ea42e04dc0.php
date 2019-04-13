<?php $__env->startSection('content'); ?>
 <!-- Start content -->
 <div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Tasks</h4>
                    <a href="<?php echo e(url('tasks/create')); ?>" class="btn btn-primary btn-rounded waves-light waves-effect float-right"><i class="fa fa-plus"></i> New Task</a>
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
                        <th>Task ID</th>
                        <th>Task</th>
                        <th>Client</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($tasks!=FALSE): ?>
                    <?php $i = 1; ?>
                    <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="row_<?php echo e($task->id); ?>">
                        <td class="order"><?php echo e($i++); ?></td>
                        <td><strong><a href="<?php echo e(url('tasks/'.$task->taskID.'/edit')); ?>"><?php echo e($task->taskID); ?></a></strong></td>
                        <td><?php echo e(ucwords($task->jobname->jobname.' '.$task->taskname)); ?></td>
                        <td><?php echo e(ucwords($task->belongsToClient->client)); ?></td>
                        <td><?php switch($task->status):
                                case ('new'): ?>
                                    <span class="badge badge-warning">New</span>
                                    <?php break; ?>
                                <?php case ('in-progress'): ?>
                                    <span class="badge badge-info">In-Progress</span>
                                    <?php break; ?>
                                <?php case ('pending'): ?>
                                    <span class="badge badge-danger">Pending</span>
                                    <?php break; ?>
                                <?php case ('completed'): ?>
                                    <span class="badge badge-success">Completed</span>
                                    <?php break; ?>
                                <?php default: ?>
                                    <span class="badge badge-warning">New</span>
                            <?php endswitch; ?>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="<?php echo e(url('tasks/'.$task->taskID.'/edit')); ?>" class="btn btn-info btn-rounded waves-light waves-effect"><i class="fa fa-edit"></i></a>
                                <button type="button" class="btn btn-danger btn-rounded waves-light waves-effect" id="dltBtn_<?php echo e($task->id); ?>" onclick="deleteFn(<?php echo e($task->id); ?>)"><i class="fa fa-trash-o"></i></button>
                                <button type="button" class="btn btn-dark btn-rounded waves-light waves-effect" ><i class="fa fa-clock-o"></i></button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" align="center">No Tasks found. <a href="<?php echo e(url('tasks/create')); ?>">Add Task</a></td>
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
    title: 'Delete this Task?',
    text: 'This will remove the entire task details, time entry details, activities etc. associated with it.',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#4fa7f3',
    cancelButtonColor: '#d57171',
    confirmButtonText: 'Delete'
  }).then(function () {
       $.ajax({
            url: burl+'/tasks/'+id,
            type: 'DELETE',
            dataType: 'JSON',
            beforeSend: function() {
               $("#dltBtn_"+id).prop('disabled', true);
               $("#dltBtn_"+id).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
             },
            success: function (res) {
                window.location.href = "<?php echo e(url('tasks')); ?>";
            }
        });
  });
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>