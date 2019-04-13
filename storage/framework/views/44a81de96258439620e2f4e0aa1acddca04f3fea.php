<?php $__env->startSection('customcss'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/plugins/bootstrap-select/css/bootstrap-select.min.css')); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/plugins/select2/select2.min.css')); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/plugins/custombox/css/custombox.min.css')); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 <!-- Start content -->
 <div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Create Task</h4>
                    <a href="<?php echo e(url('tasks')); ?>" class="btn btn-primary btn-rounded waves-light waves-effect float-right"><i class="fa fa-briefcase"></i> Task List</a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card-box pt-0">
                    <form id="addForm" class="form" action="<?php echo e(url('tasks')); ?>" method="POST" autocomplete="off">
                        <?php echo csrf_field(); ?>
                        <h3><i class="fa fa-eye headIcon"></i> Basic Details</h3>
                        <section>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 form-group">
                                    <label class="control-label mandatory">Task ID</label>
                                    <input type="text" class="form-control" id="taskID" name="taskID" value="<?php echo e($nextCode); ?>" readonly>
                                </div>
                                <div class="col-lg-3 col-md-8 form-group">
                                    <label class="control-label mandatory">Client</label>
                                    <?php if(isAdmin()): ?>
                                    <a href="<?php echo e(url('clients/create')); ?>" class="float-right" style="font-weight: bold;font-size: 14px;"><i class="fa fa-plus-circle"></i> Add Client</a>
                                    <?php endif; ?>
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
                                    <?php if(isAdmin()): ?>
                                    <a href="#job-modal" id="jobModalOpen" class="float-right" style="font-weight: bold;font-size: 14px;" data-animation="push" data-plugin="custommodal" data-overlaySpeed="1000" data-overlayColor="#36404a"><i class="fa fa-plus-circle"></i> Add New</a>
                                    <?php endif; ?>
                                    <span id="jobNameCollections">
                                        <select class="selectpicker" data-live-search="true" data-style="btn-light" id="job" name="job">
                                            <option value="">Select Job</option>
                                            <?php if($jobNames!=FALSE): ?>
                                                <?php $__currentLoopData = $jobNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($name->id); ?>"><?php echo e(ucwords($name->jobname)); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </span>
                                </div>
                            
                                <div class="col-lg-3 col-md-6 form-group">
                                    <label class="control-label mandatory">Task Name</label>
                                    <input type="text" class="form-control" id="taskname" name="taskname">
                                </div>
                            </div>
                        </section>
                        <h3><i class="fa fa-list-ul headIcon"></i> Activity details</h3>
                        <section>
                        <div class="row form-group justify-content-center">
                            <div class="col-lg-4 col-md-6 form-group">
                                <label class="control-label">Choose Activity</label>
                                <?php if(isAdmin()): ?>
                                <a href="#activity-modal" id="activityModalOpen" class="float-right" style="font-weight: bold;font-size: 14px;" data-animation="push" data-plugin="custommodal" data-overlaySpeed="1000" data-overlayColor="#36404a"><i class="fa fa-plus-circle"></i> New Activity</a>
                                <?php endif; ?>
                                <span id="activityCollections">
                                    <select class="selectpicker" data-live-search="true" data-style="btn-light" id="activitySel" name="activitySel">
                                        <option value="">Select Activity</option>
                                        <?php if($activities!=FALSE): ?>
                                            <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($act->id); ?>"><?php echo e(ucwords($act->activity)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </span>
                            </div>
                            <div class="col-lg-4 col-md-6 form-group d-no" id="subActivityCol">
                                <label class="control-label mandatory">Choose Sub Activity</label>
                                <?php if(isAdmin()): ?>
                                <a href="#subactivity-modal" id="subactivityModalOpen" class="float-right" style="font-weight: bold;font-size: 14px;" data-animation="push" data-plugin="custommodal" data-overlaySpeed="1000" data-overlayColor="#36404a"><i class="fa fa-plus-circle"></i> New Sub Activity</a>
                                <?php endif; ?>
                                <span id="subActivityCollections">
	                                <select class="selectpicker" data-live-search="true" data-style="btn-light" id="subactivitySel" name="subactivitySel">
	                                    <option value="">Select Sub Activity</option>
	                                </select>
                                </span>
                            </div>
                        </div>
                        <h4 class="header-title text-center mb-4">Assigned Activities (<span id="numOfActivities">0</span>)</h4>
                        <div class="row justify-content-center activity-single" id="choosedActivityList">
                        	
                        </div>
                        </section>

                        <h3><i class="fa fa-users headIcon"></i> Resource Allocation</h3>
                        <section>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Engagement Partner</label>
                                    <select class="select2" multiple id="engagements" name="engagements[]">
									  <?php if($employees!=FALSE): ?>
                                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($emp->user_id); ?>"><?php echo e(ucwords($emp->fname.' '.$emp->mname.' '.$emp->lname)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
									</select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Execution Partner</label>
                                    <select class="select2" multiple id="executions" name="executions[]">
                                        <?php if($employees!=FALSE): ?>
                                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($emp->user_id); ?>"><?php echo e(ucwords($emp->fname.' '.$emp->mname.' '.$emp->lname)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Manager</label>
                                    <select class="select2" multiple id="managers" name="managers[]">
                                        <?php if($employees!=FALSE): ?>
                                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($emp->user_id); ?>"><?php echo e(ucwords($emp->fname.' '.$emp->mname.' '.$emp->lname)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="control-label">Team</label>
                                    <select class="select2" multiple id="team" name="team[]">
                                        <?php if($employees!=FALSE): ?>
                                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($emp->user_id); ?>"><?php echo e(ucwords($emp->fname.' '.$emp->mname.' '.$emp->lname)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </section>
                        <h3><i class="fa fa-calendar headIcon"></i> Date Details</h3>
                        <section>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Start Date</label>
                                    <input type="text" class="form-control datepicker" name="startDate" id="startDate">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">End Date</label>
                                    <input type="text" class="form-control datepicker" name="endDate" id="endDate">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Completed Date</label>
                                    <input type="text" class="form-control" name="completedDate" id="completedDate" value="" readonly>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-3 col-md-4 col-sm-4 col-12 statuscheck">
                                    <label class="control-label">Status:</label>
                                    <select class="form-control statusSelect" name="status" id="status">
                                        <option value="new" selected>New</option>
                                        <option value="in-progress">In-Progress</option>
                                        <option value="pending">Pending</option>
                                        <option value="completed">Completed</option>
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
<?php if(isAdmin()): ?>
<!--Add Job Modal -->
<div id="job-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">Add New Job Name</h4>
    <div class="custom-modal-text">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form id="addJobName" class="form" action="javascript:;" method="POST" autocomplete="off">
                    <section>
                        <div class="row justify-content-center">
                            <div class="col-md-7 col-12 form-group">
                                <label class="control-label mandatory">Job Name</label>
                                <input type="text" class="form-control" id="newjob">
                            </div>
                            <div class="col-md-7 col-12 form-group text-center mb-0">
                                <button type="button" onclick="Custombox.close();" class="btn btn-light">Close</button>
                                <button type="submit" id="jobAddBtn" class="btn btn-primary">Add Job</button>
                            </div>
                        </div>
                    </section>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Add Activity Modal -->
<div id="activity-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">Add New Activity</h4>
    <div class="custom-modal-text">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form id="addActivity" class="form" action="javascript:;" method="POST" autocomplete="off">
                    <section>
                        <div class="row justify-content-center">
                            <div class="col-md-7 col-12 form-group">
                                <label class="control-label mandatory">Activity</label>
                                <input type="text" class="form-control" id="newactivity">
                            </div>
                            <div class="col-md-7 col-12 form-group text-center mb-0">
                                <button type="button" onclick="Custombox.close();" class="btn btn-light">Close</button>
                                <button type="submit" id="activityAddBtn" class="btn btn-primary">Add Activity</button>
                            </div>
                        </div>
                    </section>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Add Sub Activity Modal -->
<div id="subactivity-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">Add New Sub Activity For <span id="selectedAct"></span></h4>
    <div class="custom-modal-text">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form id="addSubActivity" class="form" action="javascript:;" method="POST" autocomplete="off">
                	<input type="hidden" id="selectedActID" value="">
                    <section>
                        <div class="row justify-content-center">
                            <div class="col-md-7 col-12 form-group">
                                <label class="control-label mandatory">Sub Activity</label>
                                <input type="text" class="form-control" id="newsubactivity">
                            </div>
                            <div class="col-md-7 col-12 form-group text-center mb-0">
                                <button type="button" onclick="Custombox.close();" class="btn btn-light">Close</button>
                                <button type="submit" id="subActivityAddBtn" class="btn btn-primary">Add Sub Activity</button>
                            </div>
                        </div>
                    </section>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('customjs'); ?>

<script src="<?php echo e(asset('/plugins/bootstrap-select/js/bootstrap-select.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('/plugins/select2/select2.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('/plugins/custombox/js/custombox.min.js')); ?>" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2({closeOnSelect: false});
});
$(".date").datepicker({});

$(document).on('change','#activitySel',function(e) {//getting sub activities for the selected activity
    var selAct = $("#activitySel").val();
    if(selAct!='') {
    	$.ajax({
	        url: burl+'/load-subactivities/'+selAct,
	        type: 'GET',
	        dataType: 'JSON',
	        success: function (res) {
                $("#subActivityCollections").html(res);
		        $(".selectpicker").selectpicker('refresh');
		    	$("#subActivityCol").show();
	        }
	    });
    }
});
var selSubActIDArr = []; 
//adding activity list onchange of subactivitysel
$(document).on('change','#subactivitySel',function(e) {
	var selActID = $("#activitySel").val();
    var selSubActID = $("#subactivitySel").val();
    var selActName = $("#activitySel :selected").text();
    var selSubName = $("#subactivitySel :selected").text();
    if(selSubActID!='') {
    	if($.inArray(selSubActID, selSubActIDArr) !== -1) {//SubAct ID already selected
    		ajaxAlert('error','This sub activity already selected');
    	}else {
    		selSubActIDArr.push(selSubActID);
    		var activityHTML ='<div class="col-lg-4 col-md-6 col-sm-6 col-12" id="activity_'+selSubActID+'"><div class="card"><h6 class="card-header"><strong>'+selActName+'</strong><span>'+selSubName+'</span><button type="button" onclick="removeActivity('+selSubActID+')" class="btn btn-warning btn-rounded"><i class="fa fa-times"></i></button></h6><div class="card-body p-0"><input type="hidden" name="selActIDs[]" value="'+selActID+'" /><input type="hidden" name="selSubActIDs[]" value="'+selSubActID+'" /> <textarea class="form-control" name="subActDetails[]" placeholder="Enter details (Optional)"></textarea></div></div></div>';
    		$("#choosedActivityList").prepend(activityHTML);
    		$('#activity_'+selSubActID).hide().fadeIn();
    		$("#numOfActivities").text(selSubActIDArr.length);
    	}
    }
});

function removeActivity(id) {
	selSubActIDArr.splice($.inArray(id ,selSubActIDArr),1);
	$("#activity_"+id).fadeOut("100", function() {
        $(this).remove();
        $("#numOfActivities").text(selSubActIDArr.length);
    });
}

$("#jobModalOpen").click(function(){
    $("#newjob").focus();
});
$("#activityModalOpen").click(function(){
    $("#newactivity").focus();
});
$("#subactivityModalOpen").click(function(){
	$("#selectedAct").text($("#activitySel :selected").text());
	$("#selectedActID").val($("#activitySel").val());
    $("#newsubactivity").focus();
});
//add job name
$("#addJobName").submit(function(){
    var jobname = $("#newjob").val();
    if(!nullValidate(jobname,'newjob','Enter a Job name')) {
        return false;
    }
    $.ajax({
        url: burl+'/masters/jobs',
        type: 'POST',
        data: {jobname:jobname,type:1},
        dataType: 'JSON',
        beforeSend: function() {
           $("#jobAddBtn").prop('disabled', true);
           $("#jobAddBtn").html('<i class="fa fa-circle-o-notch fa-spin"></i> Adding');
        },
        success: function (res) {
            if(res!=0) {
                $("#jobNameCollections").html(res);
                $(".selectpicker").selectpicker('refresh');
                ajaxAlert('success','New Job Name added successfully to the list');
            }else {
                ajaxAlert('error','Something went wrong. Try again');
            }
            Custombox.close();
            $("#jobAddBtn").prop('disabled', false);
            $("#jobAddBtn").html('Add Job');
            $("#newjob").val('');
        }
    });
});
//add activity
$("#addActivity").submit(function(){
    var newactivity = $("#newactivity").val();
    if(!nullValidate(newactivity,'newactivity','Enter an Activity name')) {
        return false;
    }
    $.ajax({
        url: burl+'/masters/activities',
        type: 'POST',
        data: {newactivity:newactivity,type:1},
        dataType: 'JSON',
        beforeSend: function() {
           $("#activityAddBtn").prop('disabled', true);
           $("#activityAddBtn").html('<i class="fa fa-circle-o-notch fa-spin"></i> Adding');
        },
        success: function (res) {
            if(res!=0) {
                $("#activityCollections").html(res);
                $(".selectpicker").selectpicker('refresh');
                ajaxAlert('success','New Activity added successfully to the list');
            }else {
                ajaxAlert('error','Something went wrong. Try again');
            }
            Custombox.close();
            $("#activityAddBtn").prop('disabled', false);
            $("#activityAddBtn").html('Add Activity');
            $("#newactivity").val('');
        }
    });
});

//add new sub activity
$("#addSubActivity").submit(function(){
    var newsubactivity = $("#newsubactivity").val();
    var actID = $("#selectedActID").val();
    var activityName = $("#selectedAct").text();
    if(!nullValidate(newsubactivity,'newsubactivity','Enter a Sub Activity name')) {
        return false;
    }
    if(!nullValidate(actID,'selectedActID','No Activity Choosed')) {
        return false;
    }
    $.ajax({
        url: burl+'/masters/sub-activities',
        type: 'POST',
        data: {newsubactivity:newsubactivity,actID:actID,type:1},
        dataType: 'JSON',
        beforeSend: function() {
           $("#subActivityAddBtn").prop('disabled', true);
           $("#subActivityAddBtn").html('<i class="fa fa-circle-o-notch fa-spin"></i> Adding');
        },
        success: function (res) {
            if(res!=0) {
                $("#subActivityCollections").html(res);
                $(".selectpicker").selectpicker('refresh');
                ajaxAlert('success','New Sub Activity successfully added to the list under '+activityName);
            }else {
                ajaxAlert('error','Something went wrong. Try again');
            }
            Custombox.close();
            $("#subActivityAddBtn").prop('disabled', false);
            $("#subActivityAddBtn").html('Add Sub Activity');
            $("#newsubactivity").val('');
            $("#selectedActID").val('');
            $("#selectedAct").text('');
        }
    });
});

$("#addForm").submit(function(){
  var taskID = $("#taskID").val();
  var client = $("#client").val();
  var job = $("#job").val();
  var taskname = $("#taskname").val();

  if(!nullValidate(taskID,'taskID','No task ID found. Refresh the page to continue')) {
    return false;
  }
  if(!nullValidate(client,'client','Select a client')) {
    return false;
  }
  if(!nullValidate(job,'job','Select a job')) {
    return false;
  }
  if(!nullValidate(taskname,'taskname','Enter a task name')) {
    return false;
  }
  return true;
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>