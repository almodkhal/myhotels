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
                    <h4 class="page-title float-left">Time Entry: <span class="choosen"><?php echo e(ucwords($currProject->projectID.' '.$currProject->projectname->projectname)); ?></span></h4>
                    <a href="<?php echo e(url('time-entry/create')); ?>" class="btn btn-primary btn-rounded waves-light waves-effect float-right"><i class="fa fa-plus"></i> Add Time Entry</a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->
<div class="row">
    <div class="col-12">
        <select class="selectpicker mb-1" data-live-search="true" data-style="btn-info" id="projectSelector">
            <option value="">Select Project</option>
            <?php if($projects!=FALSE): ?>
                <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($pro->projectID); ?>" <?php if($pro->projectID==$currProject->projectID): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e($pro->projectID.' '.ucwords($pro->projectname->projectname)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </select>
    </div>
    <div class="col-lg-12">
        <div class="card-box mb-0">
            <table class="table table-hover table-bordered mb-0 datatable nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Task</th>
                        <th>Date</th>
                        <th>Work Status</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Effort</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $entries = $currProject->time_entries; ?>
                   <?php if(count($entries)>0): ?>
                    <?php $i = 1; ?>
                    <?php $__currentLoopData = $entries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="row_<?php echo e($entry->id); ?>">
                        <td class="order"><?php echo e($i++); ?></td>
                        <td><?php echo e(ucwords($entry->subactivity->subactivity)); ?></td>
                        <td><?php echo e($entry->entry_date); ?></td>
                        <td><?php switch($entry->work_status):
                                case ('working'): ?>
                                    <span class="badge badge-success">Working</span>
                                    <?php break; ?>
                                <?php case ('leave'): ?>
                                    <span class="badge badge-danger">Leave</span>
                                    <?php break; ?>
                                <?php case ('holiday'): ?>
                                    <span class="badge badge-secondary">Holiday</span>
                                    <?php break; ?>
                                <?php default: ?>
                                    <span class="badge badge-success">Working</span>
                            <?php endswitch; ?>
                        </td>
                        <td><?php echo e($entry->from_time); ?></td>
                        <td><?php echo e($entry->to_time); ?></td>
                        <td><?php echo e($entry->effort_time); ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?php echo e(url('time-entry/'.$entry->id.'/edit')); ?>" class="btn btn-info btn-rounded waves-light waves-effect" data-toggle="tooltip" title="Edit TIme Entry"><i class="fa fa-edit"></i></a>
                                <button type="button" class="btn btn-danger btn-rounded waves-light waves-effect" id="dltBtn_<?php echo e($entry->id); ?>" onclick="deleteFn(<?php echo e($entry->id); ?>)"><i class="fa fa-trash-o"></i></button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" align="center">No Time Entry found for this Project. <a href="<?php echo e(url('time-entry/create')); ?>">Add Time Entry</a></td>
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