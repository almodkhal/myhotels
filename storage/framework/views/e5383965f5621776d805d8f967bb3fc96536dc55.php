<?php $__env->startSection('content'); ?>
 <!-- Start content -->
 <div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">CLIENTS</h4>
                    <a href="<?php echo e(url('clients/create')); ?>" class="btn btn-primary btn-rounded waves-light waves-effect float-right"><i class="fa fa-plus"></i> New Client</a>
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
                        <th>Client</th>
                        <th>Industry</th>
                        <th>Location</th>
                        <th>Email</th>
                        <th>Phone(O)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($clients!=FALSE): ?>
                    <?php $i = 1; ?>
                    <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="row_<?php echo e($client->id); ?>">
                        <td class="order"><?php echo e($i++); ?></td>
                        <td><strong><a href="<?php echo e(url('clients/'.$client->clientCode.'/edit')); ?>"><?php echo e($client->clientCode); ?></a></strong></td>
                        <td><?php echo e(ucwords($client->client)); ?></td>
                        <td><?php if(isset($client->hasIndustry->industry)): ?><?php echo e(ucwords($client->hasIndustry->industry)); ?><?php else: ?> <?php echo e("Industry"); ?><?php endif; ?></td>
                        <td><?php echo e(ucwords($client->location)); ?></td>
                        <td><?php echo e($client->email); ?></td>
                        <td><?php echo e($client->officePhone); ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?php echo e(url('clients/'.$client->clientCode.'/edit')); ?>" class="btn btn-info btn-rounded waves-light waves-effect"><i class="fa fa-edit"></i></a>
                                <button type="button" class="btn btn-danger btn-rounded waves-light waves-effect" id="dltBtn_<?php echo e($client->id); ?>" onclick="deleteFn(<?php echo e($client->id); ?>)"><i class="fa fa-trash-o"></i></button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" align="center">No clients found. <a href="<?php echo e(url('clients/create')); ?>">Add Client</a></td>
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
    title: 'Delete this Client?',
    text: 'This will remove the entire client details, employees, etc. associated with it.',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#4fa7f3',
    cancelButtonColor: '#d57171',
    confirmButtonText: 'Delete'
  }).then(function () {
       $.ajax({
            url: burl+'/clients/'+id,
            type: 'DELETE',
            dataType: 'JSON',
            beforeSend: function() {
               $("#dltBtn_"+id).prop('disabled', true);
               $("#dltBtn_"+id).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
             },
            success: function (res) {
                window.location.href = "<?php echo e(url('clients')); ?>";
            }
        });
  });
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>