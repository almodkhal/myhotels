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
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(url('time-entry')); ?>">All Projects</a></li>
                        <?php if(!isset($entryDate)): ?>
                        <li class="breadcrumb-item active"><?php echo e($currProject->projectID); ?></li>
                        <?php else: ?>
                        <li class="breadcrumb-item"><a href="<?php echo e(url('time-entry/'.$currProject->projectID)); ?>"><?php echo e($currProject->projectID); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo e($entryDate); ?></li>
                        <?php endif; ?>
                        
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->
<div class="row">

    <div class="col-lg-12">
        <div class="card-box mb-0">
            <?php if(!isset($entryDate)): ?>
            <table class="table table-hover table-bordered mb-0 datatable nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Total Effort</th>
                    </tr>
                </thead>
                <tbody>
                   <?php //$entries = $currProject->time_entries; ?>
                   <?php if($entries!=FALSE): ?>
                    <?php $i = 1; ?>
                    <?php $__currentLoopData = $entries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="row_<?php echo e($entry->id); ?>">
                        <td class="order"><?php echo e($i++); ?></td>
                        <td><strong><a href="<?php echo e(url('time-entry/'.$entry->project->projectID.'/'.$entry->entry_date)); ?>"><?php echo e($entry->entry_date); ?></a></strong></td>
                        <td><?php echo e(convertToHoursMins($entry->totalEffort)); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" align="center">No Time Entry found for this Project. <a href="<?php echo e(url('time-entry/create')); ?>">Add Time Entry</a></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <?php else: ?>
            
            <table class="table table-hover table-bordered mb-0 datatable nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Resource</th>
                        <th>Task</th>
                        <th>From Time</th>
                        <th>To Time</th>
                        <th>Effort</th>
                    </tr>
                </thead>
                <tbody>
                   <?php //$entries = $currProject->time_entries; ?>
                   <?php if($entries!=FALSE): ?>
                    <?php $i = 1; ?>
                    <?php $__currentLoopData = $entries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="row_<?php echo e($entry->id); ?>">
                        <td class="order"><?php echo e($i++); ?></td>
                        <td><strong><?php echo e(ucwords($entry->resource->name)); ?></strong></td>
                        <td><?php echo e(ucwords($entry->subactivity->subactivity)); ?></td>
                        <td><?php echo e($entry->from_time); ?></td>
                        <td><?php echo e($entry->to_time); ?></td>
                        <td><?php echo e(convertToHoursMins($entry->effort_time)); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" align="center">No Time Entry found for this Project on <?php echo e($entryDate); ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <?php endif; ?>
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
$('#projectSelector').on('change', function() {
    var pID = this.value;
    if(pID!='') {
        window.location.href = burl+'/time-entry/'+pID;
    }
});
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