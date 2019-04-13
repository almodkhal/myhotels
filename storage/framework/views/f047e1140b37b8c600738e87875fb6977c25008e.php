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
                    <h4 class="page-title float-left">Edit Company: <span class="choosen"><?php echo e($company->cname); ?></span></h4>
                    <div class="btn-group float-right">
                        <a href="<?php echo e(url('companies')); ?>" class="btn btn-primary btn-rounded waves-light waves-effect"><i class="fa fa-file-text-o"></i> Company List</a>
                        <a href="<?php echo e(url('companies/create')); ?>" class="btn btn-light btn-rounded waves-light waves-effect"><i class="fa fa-plus"></i> New Company</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card-box pt-0">
                    <form id="updateForm" class="form" action="<?php echo e(url('companies/update')); ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
                        <input type="hidden" name="cid" id="cid" value="<?php echo e($company->id); ?>">
                        <input type="hidden" id="typeErr" value="1">
                        <input type="hidden" id="imgChange" name="imgChng" value="2">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                            <h3><i class="fa fa-eye headIcon"></i> Basic Details</h3>
                            <section>
                                <div class="row">
                                    <div class="col-lg-2 col-md-4 form-group">
                                        <label class="control-label mandatory">Company ID</label>
                                        <input type="text" class="form-control" id="companyID" name="companyID" value="<?php echo e($company->cid); ?>" readonly>
                                    </div>
                                    <div class="col-lg-5 col-md-8 form-group">
                                        <label class="control-label mandatory">Company Name</label>
                                        <input type="text" class="form-control" id="companyName" name="companyName" value="<?php echo e($company->cname); ?>">
                                    </div>
                                    <div class="col-lg-3 col-md-6 form-group">
                                        <label class="control-label">TRN No.</label>
                                        <input type="text" class="form-control" id="trn_num" name="trn_num" value="<?php echo e($company->trnNo); ?>">
                                    </div>
                                    <div class="col-lg-2 col-md-6 form-group">
                                        <label class="control-label mandatory">Currency</label>
                                        <select class="selectpicker m-b-0" data-style="btn-light" id="currency" name="currency">
                                            <option value="">Select Currency</option>
                                            <?php if($currency!=FALSE): ?>
                                                <?php $__currentLoopData = $currency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($curr->id); ?>" data-icon="fa fa-money" <?php if($company->currency==$curr->id): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e($curr->currencyCode); ?></option>
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
                                        <textarea style="height: 117px;" class="form-control" id="address" name="address"><?php echo e($company->address); ?></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12 form-group">
                                                <label class="control-label mandatory">Phone (Office)</label>
                                                <input type="text" class="form-control" id="offcePhone" name="offcePhone" value="<?php echo e($company->officePhone); ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 form-group">
                                                <label class="control-label mandatory">Phone (Mobile)</label>
                                                <input type="text" class="form-control" id="mobilePhone" name="mobilePhone" value="<?php echo e($company->mobilePhone); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label class="control-label mandatory">Location</label>
                                        <input type="text" class="form-control" id="location" name="location" value="<?php echo e($company->location); ?>">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="control-label mandatory">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" value="<?php echo e($company->email); ?>">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="control-label">Website</label>
                                        <input type="text" class="form-control" id="website" name="website" value="<?php echo e($company->website); ?>">
                                    </div>
                                </div>
                            </section>
                            <h3><i class="fa fa-bank headIcon"></i> Bank details</h3>
                            <section>
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label class="control-label">Bank Name</label>
                                        <input type="text" class="form-control" id="bank" name="bank" value="<?php echo e($company->bankName); ?>">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="control-label">Account Name</label>
                                        <input type="text" class="form-control" name="accountName" value="<?php echo e($company->accountName); ?>">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="control-label">Account Number</label>
                                        <input type="text" class="form-control" id="accountNo" name="accountNo" value="<?php echo e($company->accountNo); ?>">
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="control-label">IBAN No</label>
                                        <input type="text" class="form-control" id="iban" name="iban" value="<?php echo e($company->ibanNo); ?>">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="control-label">Swift Code</label>
                                        <input type="text" class="form-control" id="swift" name="swift" value="<?php echo e($company->swiftCode); ?>">
                                    </div>
                                </div>
                            </section>
                            <h3><i class="fa fa-file-text-o headIcon"></i> Invoice details</h3>
                            <section>
                                <div class="row justify-content-center">
                                    <div class="col-md-6 form-group d-flex">
                                        <label class="control-label d-flex pr-2 mb-0" style="align-items: center;">Invoice Logo: </label>
                                        <div id="showImgBg" style="background-image: url('<?php echo e(asset('/uploads/company/'.$company->logo)); ?>');">
                                            <div class="row justify-content-center">
                                                <div class="col-10" id="updBtnCol">
                                                    <button type="button" id="updBtn" class="btn btn-primary btn-sm w-100" >Change Logo <i class="fa fa-image"></i></button>
                                                </div>
                                                <div class="col-2" id="removeImgCol" style="display: block;">
                                                    <button type="button" id="removeBtn" class="btn btn-danger btn-sm w-100" ><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="file" class="d-none" accept="image/*" id="invoiceLogo" name="invoiceLogo">
                                    </div>
                                    <div class="col-md-6 form-group d-flex" style="align-items: center;">
                                        <label class="control-label pr-2 mb-0">Invoice Prefix: </label>
                                        <input style="width: 75px;height: 40px;text-transform: uppercase;border-radius: 0;" type="text" class="form-control" name="invoicePrefix" id="invoicePrefix" value="<?php echo e($company->invoicePrefix); ?>">
                                        <input style="width: 120px;height: 40px;border-radius: 0;" type="text" class="form-control" value="/<?php echo e(date('Y')); ?>/0001" readonly>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row mt-4s">
                                    <div class="col-sm-6 col-12 statuscheck">
                                        <label class="control-label pr-3">Status: <input type="checkbox" name="status" value="1" <?php if($company->status==1): ?> <?php echo e("checked"); ?> <?php endif; ?> data-plugin="switchery" data-color="#039cfd" data-size="small"/></label>
                                    </div>
                                    <div class="col-sm-6 col-12 formbuttons">
                                        <button type="button" onclick="deleteFn(<?php echo e($company->id); ?>)" class="btn btn-danger" id="dltBtn_<?php echo e($company->id); ?>">Delete</button>
                                        <button type="reset" class="btn btn-light">Cancel</button>
                                        <button type="submit" class="btn btn-success">Update</button>
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
$('#updBtn').click(function(){ $('#invoiceLogo').trigger('click'); });
$('#removeBtn').click(function(){
    $("#invoiceLogo").val('');
    $('#imgChange').val('0');
    $('#updBtn').html('Choose Logo <i class="fa fa-image"></i>')
    $('#updBtnCol').removeClass('col-10').addClass('col-12');
    $('#removeImgCol').hide();
    $('#showImgBg').css("background-image", "");
});
//display selected img prior upload
$("#invoiceLogo").change(function () {
    if(this.files && this.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#showImgBg').css("background-image", "url("+e.target.result+")");  
      }
      reader.readAsDataURL(this.files[0]);
    }
    $('#updBtn').html('Change Logo <i class="fa fa-image"></i>')
    $('#updBtnCol').removeClass('col-12').addClass('col-10');
    $('#removeImgCol').fadeIn();
    //update validation elements
    $('#imgChange').val('1');
    var type = this.files[0].type;
    var validTypes = ["image/jpg", "image/jpeg", "image/png"];
    if($.inArray(type, validTypes) < 0) {//unsupported
        $('#typeErr').val('0');
    }
    else {//image file is supported
        $('#typeErr').val('1');
    }
});
$("#updateForm").submit(function(){
  var companyName = $("#companyName").val();
  var currency = $("#currency").val();
  var address = $("#address").val();
  var offcePhone = $("#offcePhone").val();
  var mobilePhone = $("#mobilePhone").val();
  var location = $("#location").val();
  var email = $("#email").val();

  var imgChng = $("#imgChange").val();
  var typeErr = $("#typeErr").val();

  var invoicePrefix = $("#invoicePrefix").val();

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
  //type,value,inputField,dbColumn,tables,message
  if(!fieldExist(email,'email','email','companies','Email already exist. Use different email address','edit')) {
    return false;
  }
  //image validation is choosed
  if(imgChng==1 && typeErr!=1) {
    $("#showImgBg").css('border','1px solid #ef190e');
    notify('Only .jpeg, .jpg, .png image files allowed');return false;
  }else {
    $("#showImgBg").css('border','none');
  }
  if(invoicePrefix.length>5) {
    $("#invoicePrefix").css('borderColor','#ef190e');$("#invoicePrefix").focus();
    notify('Maximum 5 characters allowed for prefix name');return false;
  }else {
     $("#invoicePrefix").css('borderColor','#dadada');
  }
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>