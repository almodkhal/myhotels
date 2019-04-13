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
                    <h4 class="page-title float-left">Time Entry</h4>
                    <a href="<?php echo e(url('time-entry/create')); ?>" class="btn btn-primary btn-rounded waves-light waves-effect float-right"><i class="fa fa-plus"></i> Add Time Entry</a>
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
                        <th>Project ID</th>
                        <th>Project</th>
                        <th>Client</th>
                        <th>Status</th>
                        <th>Total Effort</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($projects!=FALSE): ?>
                    <?php $i = 1; ?>
                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="row_<?php echo e($project->id); ?>">
                        <td class="order"><?php echo e($i++); ?></td>
                        <td><strong><a href="<?php echo e(url('time-entry/'.$project->projectID)); ?>"><?php echo e($project->projectID); ?></a></strong></td>
                        <td><?php echo e(ucwords($project->projectname->projectname)); ?></td>
                        <td><?php echo e(ucwords($project->belongsToClient->client)); ?></td>
                        <td><?php switch($project->status):
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
                        <td><?php echo e(convertToHoursMins($project->time_entries->sum('effort_time'))); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" align="center">No Projects found. <a href="<?php echo e(url('projects/create')); ?>">Add Project</a></td>
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
<script src="<?php echo e(asset('/plugins/bootstrap-select/js/bootstrap-select.js')); ?>" type="text/javascript"></script>
<script type="text/javascript">
//delete time entry
function deleteFn(id) {
   swal({
    title: 'Delete this Time Entry?',
    text: 'This will remove the time entry details and the effort time associated with it.',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#4fa7f3',
    cancelButtonColor: '#d57171',
    confirmButtonText: 'Delete'
  }).then(function () {
       $.ajax({
            url: burl+'/time-entry/'+id,
            type: 'DELETE',
            dataType: 'JSON',
            beforeSend: function() {
               $("#dltBtn_"+id).prop('disabled', true);
               $("#dltBtn_"+id).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
             },
            success: function (res) {
                window.location.href = "<?php echo e(url('time-entry')); ?>";
            }
        });
  });
}
$("#task").change(function(){
   var taskID = $(this).val();
   window.location.href = burl+'/time-entry/'+taskID;
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>