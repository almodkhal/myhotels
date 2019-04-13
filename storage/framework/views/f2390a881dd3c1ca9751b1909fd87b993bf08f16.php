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
                    <h4 class="page-title float-left">Create Company</h4>
                    <a href="<?php echo e(url('companies')); ?>" class="btn btn-primary btn-rounded waves-light waves-effect float-right"><i class="fa fa-file-text-o"></i> Company List</a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card-box pt-0">
                    <form id="addForm" class="form" action="<?php echo e(url('companies')); ?>" method="POST" autocomplete="off">
                        <?php echo csrf_field(); ?>
                            <h3><i class="fa fa-eye headIcon"></i> Basic Details</h3>
                            <section>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 form-group">
                                         <label class="control-label mandatory">Company ID</label>
                                        <input type="text" class="form-control" id="companyID" name="companyID" value="<?php echo e($nextCode); ?>" readonly>
                                    </div>
                                    <div class="col-lg-5 col-md-8 form-group">
                                        <label class="control-label mandatory">Company Name</label>
                                        <input type="text" class="form-control" id="companyName" name="companyName">
                                    </div>
                                    <div class="col-lg-2 col-md-6 form-group">
                                        <label class="control-label">TRN No.</label>
                                        <input type="text" class="form-control" id="trn_num" name="trn_num">
                                    </div>
                                    <div class="col-lg-2 col-md-6 form-group">
                                        <label class="control-label mandatory">Currency</label>
                                        <select class="selectpicker m-b-0" data-style="btn-light" id="currency" name="currency">
                                            <option value="">Select Currency</option>
                                            <?php if($currency!=FALSE): ?>
                                                <?php $__currentLoopData = $currency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($curr->id); ?>" data-icon="fa fa-money" <?php if($curr->currencyCode=='AED'): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e($curr->currencyCode); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </section>
                            
                            <h3><i class="fa fa-address-book-o headIcon"></i> Contact details</h3>
                            <section>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="control-label mandatory">Company Address</label>
                                        <textarea style="height: 117px;" class="form-control" id="address" name="address"></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12 form-group">
                                                <label class="control-label mandatory">Phone (Office)</label>
                                                <input type="text" class="form-control" id="offcePhone" name="offcePhone">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 form-group">
                                                <label class="control-label mandatory">Phone (Mobile)</label>
                                                <input type="text" class="form-control" id="mobilePhone" name="mobilePhone">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label class="control-label mandatory">Location</label>
                                        <input type="text" class="form-control" id="location" name="location">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="control-label mandatory">Email</label>
                                        <input type="text" class="form-control" id="email" name="email">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="control-label">Website</label>
                                        <input type="text" class="form-control" id="website" name="website">
                                    </div>
                                </div>
                            </section>
                            <h3><i class="fa fa-bank headIcon"></i> Bank details</h3>
                            <section>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="control-label">Bank Name</label>
                                        <input type="text" class="form-control" id="bank" name="bank">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="control-label">Account Number</label>
                                        <input type="text" class="form-control" id="accountNo" name="accountNo">
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="control-label">IBAN No</label>
                                        <input type="text" class="form-control" id="iban" name="iban">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="control-label">Swift Code</label>
                                        <input type="text" class="form-control" id="swift" name="swift">
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row mt-4s">
                                    <div class="col-sm-6 col-12 statuscheck">
                                        <label class="control-label pr-3">Status: <input type="checkbox" name="status" value="1" checked data-plugin="switchery" data-color="#039cfd" data-size="small"/></label>
                                    </div>
                                    <div class="col-sm-6 col-12 formbuttons">
                                        <button type="reset" class="btn btn-light">Cancel</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </section>
                    </form>
                </div>
            </div>
        </div>
        <!-- End row -->
    </div> <!-- container -->
</div> <!-- content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('customjs'); ?>

<script src="<?php echo e(asset('/plugins/bootstrap-select/js/bootstrap-select.js')); ?>" type="text/javascript"></script>
<script type="text/javascript">

$("#addForm").submit(function(){
  var companyName = $("#companyName").val();
  var currency = $("#currency").val();
  var address = $("#address").val();
  var offcePhone = $("#offcePhone").val();
  var mobilePhone = $("#mobilePhone").val();
  var location = $("#location").val();
  var email = $("#email").val();

  if(!nullValidate(companyName,'companyName','Enter the company name')) {
    return false;
  }
  if(!nullValidate(currency,'currency','Select the currency')) {
    return false;
  }
  if(!nullValidate(address,'address','Enter the address')) {
    return false;
  }
  if(!nullValidate(offcePhone,'offcePhone','Enter valid office phone number')) {
    return false;
  }
  if(!nullValidate(mobilePhone,'mobilePhone','Enter valid mobile phone number')) {
    return false;
  }
  if(!nullValidate(location,'location','Enter a location')) {
    return false;
  }
  if(!nullValidate(email,'email','Enter an email address')) {
    return false;
  }
  if(!emailValidate(email,'email')) {
    return false;
  }
  //value,inputField,dbColumn,tables,message
  if(!fieldExist(email,'email','email', 'companies','Email already exist. Use different email address')) {
    return false;
  }
  return true;
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>