<?php $__env->startSection('content'); ?>
 <!-- Start content -->
 <div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Invoices</h4>
                    <a href="<?php echo e(url('invoices/create')); ?>" class="btn btn-primary btn-rounded waves-light waves-effect float-right"><i class="fa fa-plus"></i> New Invoice</a>
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
                        <th>Invoice ID</th>
                        <th>Client</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                   <?php if($invoices!=FALSE): ?>
                    <?php $i = 1; ?>
                    <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="row_<?php echo e($inv->id); ?>">
                        <td class="order"><?php echo e($i++); ?></td>
                        <td><strong><a href="<?php echo e(url('invoices/'.$inv->invoiceID.'/edit')); ?>"><?php echo e($inv->invoiceID); ?></a></strong></td>
                        <td><?php echo e(ucwords($inv->client->client)); ?></td>
                        <td><?php echo e($inv->particulars->sum('amount')); ?></td>
                        <td><?php switch($inv->status):
                                case ('created'): ?>
                                    <span class="badge badge-secondary">Active</span>
                                    <?php break; ?>
                                <?php case ('send'): ?>
                                    <span class="badge badge-info">Resigned</span>
                                    <?php break; ?>
                                <?php case ('pending'): ?>
                                    <span class="badge badge-warning">Resigned</span>
                                    <?php break; ?>
                                <?php case ('rejected'): ?>
                                    <span class="badge badge-danger">Terminated</span>
                                    <?php break; ?>
                                <?php case ('received'): ?>
                                    <span class="badge badge-success">Terminated</span>
                                    <?php break; ?>
                                <?php case ('verified'): ?>
                                    <span class="badge badge-success">Terminated</span>
                                    <?php break; ?>
                                <?php default: ?>
                                    <span class="badge badge-secondary">Active</span>
                            <?php endswitch; ?>
                        </td>
                        <td><?php echo e($inv->date); ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?php echo e(url('invoices/'.$inv->invoiceID.'/edit')); ?>" class="btn btn-info btn-rounded waves-light waves-effect"><i class="fa fa-edit"></i></a>
                                <button type="button" class="btn btn-danger btn-rounded waves-light waves-effect" id="dltBtn_<?php echo e($inv->id); ?>" onclick="deleteFn(<?php echo e($inv->id); ?>)"><i class="fa fa-trash-o"></i></button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" align="center">No invoices found. <a href="<?php echo e(url('invoices/create')); ?>">Add Invoice</a></td>
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
//delete invoice
function deleteFn(id) {
   swal({
    title: 'Delete this Invoice?',
    text: 'This will remove the entire invoice details.',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#4fa7f3',
    cancelButtonColor: '#d57171',
    confirmButtonText: 'Delete'
  }).then(function () {
       $.ajax({
            url: burl+'/invoices/'+id,
            type: 'DELETE',
            dataType: 'JSON',
            beforeSend: function() {
               $("#dltBtn_"+id).prop('disabled', true);
               $("#dltBtn_"+id).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
             },
            success: function (res) {
                window.location.href = "<?php echo e(url('invoices')); ?>";
            }
        });
  });
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>