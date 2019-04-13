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
                    <h4 class="page-title float-left">Create New Job</h4>
                    <a href="<?php echo e(url('jobs')); ?>" class="btn btn-primary btn-rounded waves-light waves-effect float-right"><i class="fa fa-briefcase"></i> Job List</a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card-box pt-0">
                    <form id="addForm" class="form" action="<?php echo e(url('jobs')); ?>" method="POST" autocomplete="off">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="company" id="company" value="<?php echo e($companies->id); ?>">
                        <h3><i class="fa fa-eye headIcon"></i> Basic Details</h3>
                        <section>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 form-group">
                                    <label class="control-label mandatory">Job ID</label>
                                    <input type="text" class="form-control" id="jobID" name="jobID" value="<?php echo e($nextCode); ?>" readonly>
                                </div>
                                <div class="col-lg-3 col-md-8 form-group">
                                    <label class="control-label mandatory">Client</label>
                                    <a href="<?php echo e(url('clients/create')); ?>" class="float-right" style="font-weight: bold;font-size: 14px;"><i class="fa fa-plus-circle"></i> Add Client</a>
                                    <select class="selectpicker" data-live-search="true" data-style="btn-light" id="client" name="client">
                                        <option value="">Select Client</option>
                                        <?php if($clients!=FALSE): ?>
                                            <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($client->id); ?>"><?php echo e(ucwords($client->client)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6 form-group">
                                    <label class="control-label mandatory">Job</label>
                                    <a href="#custom-modal" id="industryModalOpen" class="float-right" style="font-weight: bold;font-size: 14px;" data-animation="push" data-plugin="custommodal" data-overlaySpeed="1000" data-overlayColor="#36404a"><i class="fa fa-plus-circle"></i> Add New</a>
                                    <span id="jobNameCollections">
                                        <select class="selectpicker" data-live-search="true" data-style="btn-light" id="job" name="job">
                                            <option value="">Select Job</option>
                                            <?php if($clients!=FALSE): ?>
                                                <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($client->id); ?>"><?php echo e(ucwords($client->client)); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </span>
                                </div>
                            
                                <div class="col-lg-3 col-md-6 form-group">
                                    <label class="control-label mandatory">Job Name</label>
                                    <input type="text" class="form-control" id="jobname" name="jobname">
                                </div>
                            </div>
                        </section>
                        <h3><i class="fa fa-list-ul headIcon"></i> Activity details <button type="button" class="btn btn-warning btn-rounded btn-sm waves-light waves-effect float-right" style="margin-top: -6px;"><i class="fa fa-plus-circle"></i> Add Activity</button></h3>
                        <section>
                            <?php for($i=1;$i<2;$i++) {?>
                            <div class="row card-box" style="padding: 15px 0;margin-bottom: 15px;padding-bottom: 0;border:3px solid #eee">
                                <div class="col-md-1 col-sm-12 form-group">
                                    <div class="row h-100">
                                        <div class="col-sm-12" style="display: flex;justify-content: center;align-items: center;">
                                            <h5 style="font-size: 50px;color: #eeeff1;"><?php echo e($i); ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-12">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-6 form-group">
                                            <label class="control-label mandatory">Activity</label>
                                            <a href="#custom-modal" id="industryModalOpen" class="float-right" style="font-weight: bold;font-size: 14px;" data-animation="push" data-plugin="custommodal" data-overlaySpeed="1000" data-overlayColor="#36404a"><i class="fa fa-plus-circle"></i> New Activity</a>
                                            <span id="activityCollections">
                                                <select class="selectpicker" data-live-search="true" data-style="btn-light" id="job" name="job">
                                                    <option value="">Select Activity</option>
                                                    <?php if($clients!=FALSE): ?>
                                                        <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($client->id); ?>"><?php echo e(ucwords($client->client)); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>
                                            </span>
                                        </div>
                                        <div class="col-md-12 col-sm-6 form-group">
                                            <label class="control-label mandatory">Sub Activity</label>
                                            <a href="#custom-modal" id="industryModalOpen" class="float-right" style="font-weight: bold;font-size: 14px;" data-animation="push" data-plugin="custommodal" data-overlaySpeed="1000" data-overlayColor="#36404a"><i class="fa fa-plus-circle"></i> New Sub Activity</a>
                                            <span id="activityCollections">
                                                <select class="selectpicker" data-live-search="true" data-style="btn-light" id="job" name="job">
                                                    <option value="">Select Activity</option>
                                                    <?php if($clients!=FALSE): ?>
                                                        <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($client->id); ?>"><?php echo e(ucwords($client->client)); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-12 form-group">
                                    <label class="control-label">Details</label>
                                    <textarea style="height: 117px;" class="form-control" id="currAddress" name="currAddress"></textarea>
                                </div>
                                <div class="col-md-1 col-sm-12 form-group" style="display: flex;justify-content: center;align-items: center">
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <i class="fa fa-times-circle" style="font-size: 25px;color: #f36270;cursor: pointer;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </section>
                        
                        <h3><i class="fa fa-lock headIcon"></i> Login details</h3>
                        <section>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label class="control-label mandatory">Email</label>
                                    <input type="text" class="form-control" value="" name="loginEmail" id="loginEmail" readonly>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label mandatory">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" value="<?php echo e($nextCode); ?>">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label mandatory">Password</label>
                                    <label class="float-right">By default: "employee@123"</label>
                                    <input type="password" class="form-control" id="password" name="password" value="employee@123">
                                </div>
                            </div>
                        </section>
                        <h3><i class="fa fa-info-circle headIcon"></i> Other Details</h3>
                        <section>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Emergency Contact</label>
                                    <input type="text" class="form-control" id="emergencyContact" name="emergencyContact">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Nominee</label>
                                    <input type="text" class="form-control" id="nominee" name="nominee">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Relation With Nominee</label>
                                    <input type="text" class="form-control" id="relationWithNominee" name="relationWithNominee">
                                </div>
                            </div>
                        </section>
                        <section>
                            <div class="row mt-4s">
                                <div class="col-lg-3 col-md-4 col-sm-4 col-12 statuscheck form-group">
                                    <label class="control-label">Status:</label>
                                    <select class="form-control statusSelect" name="status" id="status">
                                        <option value="active" selected>Active</option>
                                        <option value="resigned">Resigned</option>
                                        <option value="absconded">Absconded</option>
                                        <option value="terminated">Terminated</option>
                                    </select>
                                </div>
                                <div class="col-lg-9 col-md-8 col-sm-8 col-12 formbuttons">
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
<!-- Modal -->
<div id="custom-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">Add New Department</h4>
    <div class="custom-modal-text">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form id="addDept" class="form" action="javascript:;" method="POST" autocomplete="off">
                    <section>
                        <div class="row justify-content-center">
                            <div class="col-md-7 col-12 form-group">
                                <label class="control-label mandatory">Department Name</label>
                                <input type="text" class="form-control" id="newdept">
                            </div>
                            <div class="col-md-7 col-12 form-group text-center mb-0">
                                <button type="button" onclick="Custombox.close();" class="btn btn-light">Close</button>
                                <button type="submit" id="deptAddBtn" class="btn btn-primary">Add Department</button>
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
$("#dob").datepicker({
    changeYear: true,
    changeMonth: true,
    yearRange: "-100:+0",//last 100years
    showButtonPanel: true
});

$("#deptModalOpen").click(function(){
    $("#newdept").focus();
});

$("#addDept").submit(function(){
    var dept = $("#newdept").val();
    if(!nullValidate(dept,'newdept','Enter a department name')) {
        return false;
    }
    $.ajax({
        url: burl+'/masters/departments',
        type: 'POST',
        data: {dept:dept,type:1},
        dataType: 'JSON',
        beforeSend: function() {
           $("#deptAddBtn").prop('disabled', true);
           $("#deptAddBtn").html('<i class="fa fa-circle-o-notch fa-spin"></i> Adding');
        },
        success: function (res) {
            if(res!=0) {
                $("#deptCollections").html(res);
                $(".selectpicker").selectpicker('refresh');
                ajaxAlert('success','New Department Added successfully');
            }else {
                ajaxAlert('error','Something went wrong. Try again');
            }
            Custombox.close();
            $("#deptAddBtn").prop('disabled', false);
            $("#deptAddBtn").html('Add Department');
            $("#newdept").val('');
        }
    });
});

$("#addressToggler").click(function(){
    if($(this).prop('checked')==false){
        $("#permanentAddrField").slideDown();
    }else {
        $("#permanentAddrField").slideUp();
    }
});

$("#email").keyup(function(){
    var email = $(this).val();
    $("#loginEmail").val(email);
});

$("#addForm").submit(function(){

  var department = $("#department").val();
  var fname = $("#fname").val();
  var doj = $("#doj").val();
  var dob = $("#dob").val();

  var currAddress = $("#currAddress").val();
  var currLocation = $("#currLocation").val();
  var usePermaCheck = $("#addressToggler").prop('checked');
  var permaAddress = $("#permaAddress").val();
  var permaLocation = $("#permaLocation").val();

  var mobilePhone = $("#mobilePhone").val();
  var email = $("#email").val();
  var username = $("#username").val();
  var password = $("#password").val();

  if(!nullValidate(department,'department','Select a department')) {
    return false;
  }
  if(!nullValidate(fname,'fname','Enter first name')) {
    return false;
  }
  if(doj!='' && !dateValidate(doj,'doj','Invalid date format given for Date-of-Joining')) {
    return false;
  }
  if(dob!='' && !dateValidate(dob,'dob','Invalid date format given for Date-of-Birth')) {
    return false;
  }
  if(!nullValidate(currAddress,'currAddress','Enter present address')) {
    return false;
  }
  if(!nullValidate(currLocation,'currLocation','Enter present location')) {
    return false;
  }
  if(usePermaCheck==false) {
    if(!nullValidate(permaAddress,'permaAddress','Enter permanent address')) {
       return false;
    }
    if(!nullValidate(permaLocation,'permaLocation','Enter permanent location')) {
       return false;
    }
  }
  if(!nullValidate(mobilePhone,'mobilePhone','Enter valid mobile phone number')) {
    return false;
  }
  if(!nullValidate(email,'email','Enter an email address')) {
    return false;
  }
  if(!emailValidate(email,'email')) {
    return false;
  }
  //value,inputField,dbColumn,table,message
  if(!fieldExist(email,'email','email','users','Email already exist. Use different email address')) {
    return false;
  }
  if(!nullValidate(username,'username','Enter a username')) {
    return false;
  }
  if(!usernameValidate(username,'username')) {
    return false;
  }
  if(!fieldExist(username,'username','username','users','Username already exist. Use a different username.')) {
    return false;
  }
  if(!nullValidate(password,'password','Enter a strong password')) {
    return false;
  }
  return true;
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>