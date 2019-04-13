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
                    <h4 class="page-title float-left">Edit Project: <span class="choosen"><?php echo e($project->projectID.' '.ucwords($project->projectname->projectname)); ?></span></h4>
                    <div class="btn-group float-right">
                        <a href="<?php echo e(url('projects')); ?>" class="btn btn-primary btn-rounded waves-light waves-effect"><i class="fa fa-file-text-o"></i> Project List</a>
                        <a href="<?php echo e(url('projects/create')); ?>" class="btn btn-light btn-rounded waves-light waves-effect"><i class="fa fa-plus"></i> New Project</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card-box pt-0">
                    <form id="addForm" class="form" action="<?php echo e(url('projects/update')); ?>" method="POST" autocomplete="off">
                        <input type="hidden" name="pid" value="<?php echo e($project->id); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        <h3 class="mt-0"><i class="fa fa-eye headIcon"></i> Basic Details</h3>
                        <section>
                            <div class="row">
                                <div class="col-lg-2 col-md-3 form-group">
                                    <label class="control-label mandatory">Project ID</label>
                                    <input type="text" class="form-control" id="projectID" name="projectID" value="<?php echo e($project->projectID); ?>" readonly>
                                </div>
                                <div class="col-lg-10 col-md-9 form-group">
                                    <label class="control-label mandatory">Client</label>
                                    <?php if(isAdmin()): ?>
                                    <a href="<?php echo e(url('clients/create')); ?>" class="float-right" style="font-weight: bold;font-size: 14px;"><i class="fa fa-plus-circle"></i> Add Client</a>
                                    <?php endif; ?>
                                    <select class="selectpicker" data-live-search="true" data-style="btn-light" id="client" name="client">
                                        <option value="">Select Client</option>
                                        <?php if($clients!=FALSE): ?>
                                            <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($client->id); ?>" <?php if($client->id==$project->client): ?><?php echo e('selected'); ?><?php endif; ?>><?php echo e(ucwords($client->client)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <label class="control-label mandatory">Project</label>
                                            <?php if(isAdmin()): ?>
                                            <a href="#project-modal" id="projectModalOpen" class="float-right" style="font-weight: bold;font-size: 14px;" data-animation="push" data-plugin="custommodal" data-overlaySpeed="1000" data-overlayColor="#36404a"><i class="fa fa-plus-circle"></i> Add Project</a>
                                            <?php endif; ?>
                                            <span id="projectNameCollections">
                                                <select class="selectpicker" data-live-search="true" data-style="btn-light" id="project" name="project">
                                                    <option value="">Select Project</option>
                                                    <?php if($projectNames!=FALSE): ?>
                                                        <?php $__currentLoopData = $projectNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($name->id); ?>" <?php if($name->id==$project->project): ?><?php echo e('selected'); ?><?php endif; ?>><?php echo e(ucwords($name->projectname)); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>
                                            </span>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label class="control-label mandatory">Choose Activity</label>
                                            <?php if(isAdmin()): ?>
                                            <a href="#activity-modal" id="activityModalOpen" class="float-right" style="font-weight: bold;font-size: 14px;" data-animation="push" data-plugin="custommodal" data-overlaySpeed="1000" data-overlayColor="#36404a"><i class="fa fa-plus-circle"></i> New Activity</a>
                                            <?php endif; ?>
                                            <span id="activityCollections">
                                                <select class="selectpicker" data-live-search="true" data-style="btn-light" id="activity" name="activity">
                                                    <option value="">Select Activity</option>
                                                    <?php if($activities!=FALSE): ?>
                                                        <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($act->id); ?>" <?php if($act->id==$project->activity_id): ?><?php echo e('selected'); ?><?php endif; ?>><?php echo e(ucwords($act->activity)); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Project Details</label>
                                    <textarea class="form-control" name="projectDetails" id="projectDetails" style="height: 117px;"><?php echo e($project->details); ?></textarea>
                                </div>
                            </div>
                        </section>

                        <h3><i class="fa fa-users headIcon"></i> Resource Allocation</h3>
                        <?php 
                            //already saved resources
                            $selEng = explode(',',trim($project->engagement_partners, ','));
                            $selExc = explode(',',trim($project->execution_partners, ','));
                            $selMng = explode(',',trim($project->managers, ','));
                            $selTean = explode(',',trim($project->team, ','));
                        ?>
                        <section>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Engagement Partner</label>
                                    <select class="select2" multiple id="engagements" name="engagements[]">
                                      <?php if($employees!=FALSE): ?>
                                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($emp->user_id); ?>" <?php if(in_array($emp->user_id, $selEng)): ?><?php echo e('selected'); ?><?php endif; ?>><?php echo e(ucwords($emp->fname.' '.$emp->mname.' '.$emp->lname)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Execution Partner</label>
                                    <select class="select2" multiple id="executions" name="executions[]">
                                        <?php if($employees!=FALSE): ?>
                                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($emp->user_id); ?>" <?php if(in_array($emp->user_id, $selExc)): ?><?php echo e('selected'); ?><?php endif; ?>><?php echo e(ucwords($emp->fname.' '.$emp->mname.' '.$emp->lname)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Manager</label>
                                    <select class="select2" multiple id="managers" name="managers[]">
                                        <?php if($employees!=FALSE): ?>
                                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($emp->user_id); ?>" <?php if(in_array($emp->user_id, $selMng)): ?><?php echo e('selected'); ?><?php endif; ?>><?php echo e(ucwords($emp->fname.' '.$emp->mname.' '.$emp->lname)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="control-label">Team</label>
                                    <select class="select2" multiple id="team" name="team[]">
                                        <?php if($employees!=FALSE): ?>
                                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($emp->user_id); ?>" <?php if(in_array($emp->user_id, $selTean)): ?><?php echo e('selected'); ?><?php endif; ?>><?php echo e(ucwords($emp->fname.' '.$emp->mname.' '.$emp->lname)); ?></option>
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
                                    <input type="text" class="form-control datepicker" name="startDate" id="startDate" value="<?php echo e($project->start_date); ?>">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">End Date</label>
                                    <input type="text" class="form-control datepicker" name="endDate" id="endDate" value="<?php echo e($project->end_date); ?>">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Completed Date</label>
                                    <input type="text" class="form-control" name="completedDate" id="completedDate" value="<?php echo e($project->completed_date); ?>" readonly>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-3 col-md-4 col-sm-4 col-12 statuscheck">
                                    <label class="control-label">Status:</label>
                                    <select class="form-control statusSelect" name="status" id="status">
                                        <option value="new" <?php if($project->status=='new'): ?><?php echo e('selected'); ?><?php endif; ?>>New</option>
                                        <option value="in-progress" <?php if($project->status=='in-progress'): ?><?php echo e('selected'); ?><?php endif; ?>>In-Progress</option>
                                        <option value="pending" <?php if($project->status=='pending'): ?><?php echo e('selected'); ?><?php endif; ?>>Pending</option>
                                        <option value="completed" <?php if($project->status=='completed'): ?><?php echo e('selected'); ?><?php endif; ?>>Completed</option>
                                    </select>
                                </div>
                                <div class="col-lg-9 col-md-8 col-sm-8 col-12 formbuttons">
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
<?php if(isAdmin()): ?>
<!--Add Job Modal -->
<div id="project-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">Add New Project</h4>
    <div class="custom-modal-text">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form id="addProjectName" class="form" action="javascript:;" method="POST" autocomplete="off">
                    <section>
                        <div class="row justify-content-center">
                            <div class="col-md-7 col-12 form-group">
                                <label class="control-label mandatory">Project Name</label>
                                <input type="text" class="form-control" id="newproject">
                            </div>
                            <div class="col-md-7 col-12 form-group">
                                <div class="row">
                                    <div class="col-4 pr-1">
                                        <label class="control-label">Currency</label>
                                        <select class="selectpicker m-b-0" data-style="btn-light" id="projectCurrency">
                                            <?php if($currency!=FALSE): ?>
                                                <?php $__currentLoopData = $currency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($curr->id); ?>" data-icon="fa fa-money" <?php if($curr->currencyCode=='AED'): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e($curr->currencyCode); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="col-8 pl-1">
                                        <label class="control-label">Project Value</label>
                                        <input type="text" class="form-control" id="projectVal" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 col-12 form-group">
                                <label class="control-label">Duration</label>
                                <select class="selectpicker" data-style="btn-light" id="projectDuration">
                                    <option value="0">One-Time</option>
                                    <option value="7">Weekly</option>
                                    <option value="30">Monthly</option>
                                    <option value="365">Annually</option>
                                </select>
                            </div>
                            <div class="col-md-7 col-12 form-group text-center mb-0">
                                <button type="button" onclick="Custombox.close();" class="btn btn-light">Close</button>
                                <button type="submit" id="projectAddBtn" class="btn btn-primary">Add Project</button>
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


$("#projectModalOpen").click(function(){
    $("#newproject").focus();
});
$("#activityModalOpen").click(function(){
    $("#newactivity").focus();
});

//add job name
$("#addProjectName").submit(function(){
    var newproject = $("#newproject").val();
    var projectCurrency = $("#projectCurrency").val();
    var projectVal = $("#projectVal").val();
    var projectDuration = $("#projectDuration").val();

    if(!nullValidate(newproject,'newproject','Enter a Project name')) {
        return false;
    }
    if(!nullValidate(projectVal,'projectVal','Enter a project value')) {
        return false;
    }
    $.ajax({
        url: burl+'/masters/project-name',
        type: 'POST',
        data: {newproject:newproject,pcurrency:projectCurrency,value:projectVal,period:projectDuration,type:1},
        dataType: 'JSON',
        beforeSend: function() {
           $("#projectAddBtn").prop('disabled', true);
           $("#projectAddBtn").html('<i class="fa fa-circle-o-notch fa-spin"></i> Adding');
        },
        success: function (res) {
            if(res!=0) {
                $("#projectNameCollections").html(res);
                $(".selectpicker").selectpicker('refresh');
                ajaxAlert('success','New Project Name added successfully to the list');
            }else {
                ajaxAlert('error','Something went wrong. Try again');
            }
            Custombox.close();
            $("#projectAddBtn").prop('disabled', false);
            $("#projectAddBtn").html('Add Project');
            $("#addProjectName")[0].reset();
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


$("#addForm").submit(function(){
  var projectID = $("#projectID").val();
  var client = $("#client").val();
  var project = $("#project").val();
  var activity = $("#activity").val();

  if(!nullValidate(projectID,'projectID','No project ID found. Refresh the page to continue')) {
    return false;
  }
  if(!nullValidate(client,'client','Select a client')) {
    return false;
  }
  if(!nullValidate(project,'project','Select a project')) {
    return false;
  }
  if(!nullValidate(activity,'activity','Select an activity')) {
    return false;
  }
  return true;
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>