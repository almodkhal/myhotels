<?php $__env->startSection('customcss'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/plugins/bootstrap-select/css/bootstrap-select.min.css')); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/plugins/custombox/css/custombox.min.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
 <!-- Start content -->
 <div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Edit Client: <span class="choosen"><?php echo e($client->client); ?></span></h4>
                    <div class="btn-group float-right">
                        <a href="<?php echo e(url('clients')); ?>" class="btn btn-primary btn-rounded waves-light waves-effect"><i class="fa fa-file-text-o"></i> Client List</a>
                        <a href="<?php echo e(url('clients/create')); ?>" class="btn btn-light btn-rounded waves-light waves-effect"><i class="fa fa-plus"></i> New Client</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card-box pt-0">
                    <form id="updateForm" class="form" action="<?php echo e(url('clients/update')); ?>" method="POST" autocomplete="off">
                        <input type="hidden" name="cid" value="<?php echo e($client->id); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        <input type="hidden" name="company" id="company" value="<?php echo e($client->company); ?>">
                        <h3><i class="fa fa-eye headIcon"></i> Basic Details</h3>
                        <section>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 form-group">
                                     <label class="control-label mandatory">Client ID</label>
                                    <input type="text" class="form-control" id="clientID" name="clientID" value="<?php echo e($client->clientCode); ?>" readonly>
                                </div>
                                <div class="col-lg-4 col-md-8 form-group">
                                    <label class="control-label mandatory">Client Name</label>
                                    <input type="text" class="form-control" id="clientName" name="clientName" value="<?php echo e($client->client); ?>">
                                </div>
                                <div class="col-lg-3 col-md-6 form-group">
                                    <label class="control-label mandatory">Industry Type</label>
                                    <a href="#custom-modal" id="industryModalOpen" class="float-right" style="font-weight: bold;font-size: 14px;" data-animation="push" data-plugin="custommodal" data-overlaySpeed="1000" data-overlayColor="#36404a"><i class="fa fa-plus-circle"></i> Add New</a>
                                    <span id="industryCollections">
                                        <select class="selectpicker" data-live-search="true" data-style="btn-light" id="industry" name="industry">
                                            <option value="">Select Industry</option>
                                            <?php if($industries!=FALSE): ?>
                                                <?php $__currentLoopData = $industries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ind): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($ind->id); ?>" <?php if($client->industry==$ind->id): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e($ind->industry); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </span>
                                </div>
                                <div class="col-lg-2 col-md-6 form-group">
                                    <label class="control-label">TRN No.</label>
                                    <input type="text" class="form-control" id="trn_num" name="trn_num" value="<?php echo e($client->trnNo); ?>">
                                </div>
                            </div>
                        </section>
                        
                        <h3><i class="fa fa-bank headIcon"></i> Company details</h3>
                        <section>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="control-label mandatory">Company Address</label>
                                    <textarea style="height: 117px;" class="form-control" id="address" name="address"><?php echo e($client->address); ?></textarea>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <label class="control-label mandatory">Phone (Office)</label>
                                            <input type="text" class="form-control" id="offcePhone" name="offcePhone" value="<?php echo e($client->officePhone); ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <label class="control-label mandatory">Phone (Mobile)</label>
                                            <input type="text" class="form-control" id="mobilePhone" name="mobilePhone" value="<?php echo e($client->mobilePhone); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label class="control-label mandatory">Location</label>
                                    <input type="text" class="form-control" id="location" name="location" value="<?php echo e($client->location); ?>">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label mandatory">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="<?php echo e($client->email); ?>">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Website</label>
                                    <input type="text" class="form-control" id="website" name="website" value="<?php echo e($client->website); ?>">
                                </div>
                            </div>
                        </section>
                        <h3><i class="fa fa-user-md headIcon"></i> Contact Persons</h3>
                        <section>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Primary Contact Person</label>
                                    <input type="text" class="form-control" id="primary_contact" name="primary_contact" value="<?php echo e($client->person1); ?>">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">His/Her Email</label>
                                    <input type="text" class="form-control" id="primary_contact_email" name="primary_contact_email" value="<?php echo e($client->p1_email); ?>">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">His/Her Phone</label>
                                    <input type="text" class="form-control" id="primary_contact_phone" name="primary_contact_phone" value="<?php echo e($client->p1_phone); ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Secondary Contact Person</label>
                                    <input type="text" class="form-control" id="secondary_contact" name="secondary_contact" value="<?php echo e($client->person2); ?>">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">His/Her Email</label>
                                    <input type="text" class="form-control" id="secondary_contact_email" name="secondary_contact_email" value="<?php echo e($client->p2_phone); ?>">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">His/Her Phone</label>
                                    <input type="text" class="form-control" id="secondary_contact_phone" name="secondary_contact_phone" value="<?php echo e($client->p2_phone); ?>">
                                </div>
                            </div>
                        </section>
                        <section>
                            <div class="row mt-4s">
                                <div class="col-sm-6 col-12 statuscheck">
                                    <label class="control-label">Status: <input type="checkbox" name="status" value="1" <?php if($client->status==1): ?> <?php echo e("checked"); ?> <?php endif; ?> data-plugin="switchery" data-color="#039cfd" data-size="small"/></label>
                                </div>
                                <div class="col-sm-6 col-12 formbuttons">
                                    <button type="button" onclick="deleteFn(<?php echo e($client->id); ?>)" class="btn btn-danger" id="dltBtn_<?php echo e($client->id); ?>">Delete</button>
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
<!-- Modal -->
<div id="custom-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">Add New Industry</h4>
    <div class="custom-modal-text">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form id="addIndustry" class="form" action="javascript:;" method="POST" autocomplete="off">
                    <section>
                        <div class="row justify-content-center">
                            <div class="col-md-7 col-12 form-group">
                                <label class="control-label mandatory">Industry Name</label>
                                <input type="text" class="form-control" id="newindustry">
                            </div>
                            <div class="col-md-7 col-12 form-group text-center mb-0">
                                <button type="button" onclick="Custombox.close();" class="btn btn-light">Close</button>
                                <button type="submit" id="industryAddBtn" class="btn btn-primary">Add Industry</button>
                            </div>
                        </div>
                    </section>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('customjs'); ?>

<script src="<?php echo e(asset('/plugins/bootstrap-select/js/bootstrap-select.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('/plugins/custombox/js/custombox.min.js')); ?>" type="text/javascript"></script>
<script type="text/javascript">
$("#industryModalOpen").click(function(){
    $("#newindustry").focus();
});
$("#addIndustry").submit(function(){
    var industry = $("#newindustry").val();
    if(!nullValidate(industry,'newindustry','Enter an industry name')) {
        return false;
    }
    $.ajax({
        url: burl+'/industries',
        type: 'POST',
        data: {industry:industry,type:1},
        dataType: 'JSON',
        beforeSend: function() {
           $("#industryAddBtn").prop('disabled', true);
           $("#industryAddBtn").html('<i class="fa fa-circle-o-notch fa-spin"></i> Adding');
        },
        success: function (res) {
            if(res!=0) {
                $("#industryCollections").html(res);
                $(".selectpicker").selectpicker('refresh');
                ajaxAlert('success','New Industry Added successfully');
            }else {
                ajaxAlert('error','Something went wrong. Try again');
            }
            Custombox.close();
            $("#industryAddBtn").prop('disabled', false);
            $("#industryAddBtn").html('Add Industry');
            $("#newindustry").val('');
        }
    });
});
//delete codes
function deleteFn(id) {
   swal({
    title: 'Delete this Client?',
    text: 'This will remove the entire client details, clients, employees, etc. associated with it.',
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
$("#updateForm").submit(function(){
  var clientName = $("#clientName").val();
  var industry = $("#industry").val();
  var address = $("#address").val();
  var offcePhone = $("#offcePhone").val();
  var mobilePhone = $("#mobilePhone").val();
  var location = $("#location").val();
  var email = $("#email").val();

  if(!nullValidate(clientName,'clientName','Enter the client name')) {
    return false;
  }
  if(!nullValidate(industry,'industry','Select an industry')) {
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
  if(!fieldExist(email,'email','email','users','Email already exist. Use different email address','edit')) {
    return false;
  }
  return true;
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>