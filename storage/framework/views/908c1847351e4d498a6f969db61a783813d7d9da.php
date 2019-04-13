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
                    <h4 class="page-title float-left">Edit Employee: <span class="choosen"><?php echo e($employee->fname.' '.$employee->mname.' '.$employee->lname); ?></span></h4>
                    <div class="btn-group float-right">
                        <a href="<?php echo e(url('employees')); ?>" class="btn btn-primary btn-rounded waves-light waves-effect"><i class="fa fa-file-text-o"></i> Employee List</a>
                        <a href="<?php echo e(url('employees/create')); ?>" class="btn btn-light btn-rounded waves-light waves-effect"><i class="fa fa-plus"></i> New Employee</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card-box pt-0">
                    <form id="updateForm" class="form" action="<?php echo e(url('employees/update')); ?>" method="POST" autocomplete="off">
                        <input type="hidden" name="eid" value="<?php echo e($employee->user_id); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                       <input type="hidden" name="company" id="company" value="<?php echo e($companies->id); ?>">
                        <h3><i class="fa fa-eye headIcon"></i> Basic Details</h3>
                        <section>
                            <div class="row">
                                <div class="col-lg-4 col-md-3 form-group">
                                    <label class="control-label mandatory">Employee ID</label>
                                    <input type="text" class="form-control" id="empID" name="empID" value="<?php echo e($employee->eid); ?>" readonly>
                                </div>
                                <div class="col-lg-4 col-md-5 form-group">
                                    <label class="control-label mandatory">Department</label>
                                    <a href="#custom-modal" id="deptModalOpen" class="float-right" style="font-weight: bold;font-size: 14px;" data-animation="push" data-plugin="custommodal" data-overlaySpeed="1000" data-overlayColor="#36404a"><i class="fa fa-plus-circle"></i> Add New</a>
                                    <span id="deptCollections">
                                        <select class="selectpicker" data-live-search="true" data-style="btn-light" id="department" name="department">
                                            <option value="">Select Department</option>
                                            <?php if($departments!=FALSE): ?>
                                                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($dept->id); ?>" <?php if($dept->id==$employee->department_id): ?> <?php echo e("selected"); ?><?php endif; ?>><?php echo e($dept->department); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </span>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Designation</label>
                                    <input type="text" class="form-control" id="designation" name="designation" value="<?php echo e($employee->designation); ?>">
                                </div>
                            
                                <div class="col-md-4 form-group">
                                    <label class="control-label mandatory">First Name</label>
                                    <input type="text" class="form-control" id="fname" name="fname" value="<?php echo e($employee->fname); ?>">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Middle Name</label>
                                    <input type="text" class="form-control" id="mname" name="mname" value="<?php echo e($employee->mname); ?>">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Last Name</label>
                                    <input type="text" class="form-control" id="lname" name="lname" value="<?php echo e($employee->lname); ?>">
                                </div>
                            
                                <div class="col-lg-4 col-md-4 form-group">
                                    <label class="control-label">Gender</label>
                                    <select class="selectpicker" name="gender" id="gender" data-style="btn-light">
                                        <option value="" <?php if($employee->gender==''): ?><?php echo e("selected"); ?><?php endif; ?>>Select Gender</option>
                                        <option value="male" <?php if($employee->gender=='male'): ?><?php echo e("selected"); ?><?php endif; ?> data-icon="mdi mdi-gender-male">Male</option>
                                        <option value="female" <?php if($employee->gender=='female'): ?><?php echo e("selected"); ?><?php endif; ?> data-icon="mdi mdi-gender-female">Female</option>
                                        <option value="other" <?php if($employee->gender=='other'): ?><?php echo e("selected"); ?><?php endif; ?> data-icon="mdi mdi-gender-transgender">Other</option>
                                    </select>
                                    
                                </div>
                                <div class="col-lg-4 col-md-4 form-group">
                                    <label class="control-label">Date-of-Joining</label>
                                    <input type="text" class="form-control datepicker" id="doj" name="doj" value="<?php echo e($employee->doj); ?>">
                                </div>
                                <div class="col-lg-4 col-md-4 form-group">
                                    <label class="control-label">Date-of-Birth</label>
                                    <input type="text" class="form-control" id="dob" name="dob"value="<?php echo e($employee->dob); ?>">
                                </div>
                            </div>
                        </section>
                        <h3><i class="fa fa-address-book-o headIcon"></i> Contact details</h3>
                        <section>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 form-group">
                                    <label class="control-label mandatory">Present Address</label>
                                    <label class="float-right" style="font-weight: bold;"> Use as permanent address: <input type="checkbox" name="isPermanent" value="1" <?php if($employee->currentLocation==$employee->permanentLocation && $employee->currentAddress==$employee->permanentAddress): ?><?php echo e('checked'); ?><?php endif; ?> data-plugin="switchery" data-color="#039cfd" data-size="small" id="addressToggler" /></label>
                                    <textarea style="height: 117px;" class="form-control" id="currAddress" name="currAddress"> <?php echo e($employee->currentAddress); ?></textarea>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-6 form-group">
                                            <label class="control-label mandatory">Present Location</label>
                                            <input type="text" class="form-control" id="currLocation" name="currLocation" value="<?php echo e($employee->currentLocation); ?>">
                                        </div>
                                        <div class="col-md-12 col-sm-6 form-group">
                                            <label class="control-label">Present Zip Code</label>
                                            <input type="text" class="form-control" id="currZip" name="currZip" value="<?php echo e($employee->currentZip); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="permanentAddrField" style="<?php if($employee->currentLocation==$employee->permanentLocation && $employee->currentAddress==$employee->permanentAddress): ?><?php echo e('display: none;'); ?><?php endif; ?>" >
                                <div class="col-md-6 col-sm-12 form-group">
                                    <label class="control-label mandatory">Permanent Address</label>
                                    <textarea style="height: 117px;" class="form-control" id="permaAddress" name="permaAddress"><?php echo e($employee->permanentAddress); ?></textarea>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-6 form-group">
                                            <label class="control-label mandatory">Permanent Location</label>
                                            <input type="text" class="form-control" id="permaLocation" name="permaLocation" value="<?php echo e($employee->permanentLocation); ?>">
                                        </div>
                                        <div class="col-md-12 col-sm-6 form-group">
                                            <label class="control-label">Permanent Zip Code</label>
                                            <input type="text" class="form-control" id="permaZip" name="permaZip" value="<?php echo e($employee->permanentZip); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label class="control-label mandatory">Mobile Number</label>
                                    <input type="text" class="form-control" id="mobilePhone" name="mobilePhone" value="<?php echo e($employee->mobilePhone); ?>">  
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Landline Number</label>
                                    <input type="text" class="form-control" id="landlinePhone" name="landlinePhone" value="<?php echo e($employee->landline); ?>">  
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label mandatory">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="<?php echo e($employee->email); ?>">  
                                </div>
                            </div>
                        </section>
                        
                        <h3><i class="fa fa-lock headIcon"></i> Login details</h3>
                        <section>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label class="control-label mandatory">Email</label>
                                    <input type="text" class="form-control" name="loginEmail" id="loginEmail" readonly value="<?php echo e($employee->email); ?>">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label mandatory">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" value="<?php echo e($employee->user->username); ?>">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Password</label>
                                    <label class="float-right">* Uses old password if blank</label>
                                    <input type="password" class="form-control" id="password" name="password" value="">
                                </div>
                            </div>
                        </section>
                        <h3><i class="fa fa-info-circle headIcon"></i> Other Details</h3>
                        <section>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Emergency Contact</label>
                                    <input type="text" class="form-control" id="emergencyContact" name="emergencyContact" value="<?php echo e($employee->emergencyContact); ?>">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Nominee</label>
                                    <input type="text" class="form-control" id="nominee" name="nominee" value="<?php echo e($employee->nominee); ?>">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Relation With Nominee</label>
                                    <input type="text" class="form-control" id="relationWithNominee" name="relationWithNominee" value="<?php echo e($employee->relationWithNominee); ?>">
                                </div>
                            </div>
                        </section>
                        <section>
                            <div class="row mt-4">
                                <div class="col-lg-3 col-md-4 col-sm-4 col-12 statuscheck form-group">
                                    <label class="control-label">Status:</label>
                                    <select class="form-control statusSelect" name="status" id="status">
                                        <option value="active" <?php if($employee->status=='active'): ?><?php echo e("selected"); ?><?php endif; ?> >Active</option>
                                        <option value="resigned" <?php if($employee->status=='resigned'): ?><?php echo e("selected"); ?><?php endif; ?> >Resigned</option>
                                        <option value="absconded" <?php if($employee->status=='absconded'): ?><?php echo e("selected"); ?><?php endif; ?> >Absconded</option>
                                        <option value="terminated" <?php if($employee->status=='terminated'): ?><?php echo e("selected"); ?><?php endif; ?> >Terminated</option>
                                    </select>
                                </div>
                                <div class="col-lg-9 col-md-8 col-sm-8 col-12 formbuttons">
                                	<button type="button" onclick="deleteFn(<?php echo e($employee->user_id); ?>)" class="btn btn-danger" id="dltBtn_<?php echo e($employee->user_id); ?>">Delete</button>
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
//delete codes
function deleteFn(id) {
   swal({
    title: 'Delete this Employee?',
    text: 'This will remove the entire employee details, timesheet entries, etc. associated with it.',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#4fa7f3',
    cancelButtonColor: '#d57171',
    confirmButtonText: 'Delete'
  }).then(function () {
       $.ajax({
            url: burl+'/employees/'+id,
            type: 'DELETE',
            dataType: 'JSON',
            beforeSend: function() {
               $("#dltBtn_"+id).prop('disabled', true);
               $("#dltBtn_"+id).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
             },
            success: function (res) {
                window.location.href = "<?php echo e(url('employees')); ?>";
            }
        });
  });
}
$("#updateForm").submit(function(){
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
  if(!fieldExist(email,'email','email','users','Email already exist. Use different email address','edit')) {
    return false;
  }
  if(!nullValidate(username,'username','Enter a username')) {
    return false;
  }
  if(!usernameValidate(username,'username')) {
    return false;
  }
  if(!fieldExist(username,'username','username','users','Username already exist. Use a different username.','edit')) {
    return false;
  }
  return true;
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>