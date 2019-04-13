<?php $__env->startSection('content'); ?>
 <!-- Start content -->
 <div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">COMPANIES</h4>
                    <a href="<?php echo e(url('companies/create')); ?>" class="btn btn-primary btn-rounded waves-light waves-effect float-right"><i class="fa fa-plus"></i> New Company</a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->

<div class="row">
    <div class="col-lg-12">
        <div class="card-box mb-0">
            <table class="table table-hover table-responsive-md table-bordered mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Company ID</th>
                        <th>Company</th>
                        <th>Location</th>
                        <th>Email</th>
                        <th>Phone(O)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($companies!=FALSE): ?>
                    <?php $i = 1; ?>
                    <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="row_<?php echo e($company->id); ?>">
                        <td class="order"><?php echo e($i++); ?></td>
                        <td><strong><a href="<?php echo e(url('companies/'.$company->cid.'/edit')); ?>"><?php echo e($company->cid); ?></a></strong></td>
                        <td><?php echo e(ucwords($company->cname)); ?></td>
                        <td><?php echo e(ucwords($company->location)); ?></td>
                        <td><?php echo e($company->email); ?></td>
                        <td><?php echo e($company->officePhone); ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?php echo e(url('companies/'.$company->cid.'/edit')); ?>" class="btn btn-info btn-rounded waves-light waves-effect"><i class="fa fa-edit"></i></a>
                                <button type="button" class="btn btn-danger btn-rounded waves-light waves-effect" id="dltBtn_<?php echo e($company->id); ?>" onclick="deleteFn(<?php echo e($company->id); ?>)"><i class="fa fa-trash-o"></i></button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" align="center">No companies found. <a href="<?php echo e(url('companies/create')); ?>">Add Company</a></td>
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
    title: 'Delete this Company?',
    text: 'This will remove the entire company details, clients, employees, etc. associated with it.',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#4fa7f3',
    cancelButtonColor: '#d57171',
    confirmButtonText: 'Delete'
  }).then(function () {
       $.ajax({
            url: burl+'/companies/'+id,
            type: 'DELETE',
            dataType: 'JSON',
            beforeSend: function() {
               $("#dltBtn_"+id).prop('disabled', true);
               $("#dltBtn_"+id).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
             },
            success: function (res) {
                window.location.href = "<?php echo e(url('companies')); ?>";
            }
        });
  });
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>