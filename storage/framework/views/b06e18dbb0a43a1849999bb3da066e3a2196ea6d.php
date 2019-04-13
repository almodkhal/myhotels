<?php $__env->startSection('customcss'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/plugins/bootstrap-select/css/bootstrap-select.min.css')); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css')); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/plugins/custombox/css/custombox.min.css')); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 <!-- Start content -->
 <a href="#expense-modal" id="ExpenseModalOpen" class="d-none" data-animation="push" data-plugin="custommodal" data-overlaySpeed="1000" data-overlayColor="#36404a"></a>
 <div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Add Time Entry</h4>
                    <button type="button" onclick="loadExpenseWindow(0)" id="expWindowOpenBtn_0" class="btn btn-primary btn-rounded waves-light waves-effect float-right" ><i class="fa fa-plus"></i> General Expense</button>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card-box pt-0">
                  <?php $i=0; ?>
                  <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <form class="addForm form" data-pid="<?php echo e($project->id); ?>" action="<?php echo e(url('time-entry')); ?>" method="POST" autocomplete="off">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="project" value="<?php echo e($project->id); ?>">
                        <input type="hidden" name="activity" value="<?php echo e($project->activity_id); ?>">

                        <div class="card" style="box-shadow: none;margin-bottom: 10px;">
                          <a href="#collapse<?php echo e($project->id); ?>" data-toggle="collapse" aria-expanded="<?php if($i==0): ?><?php echo e('true'); ?><?php else: ?><?php echo e('false'); ?><?php endif; ?>" aria-controls="collapse<?php echo e($project->id); ?>">
                            <h3 class="mt-0"><i class="fa fa-briefcase headIcon"></i> <?php echo e($project->projectID. ' '.ucwords($project->projectname->projectname)); ?></h3>
                          </a>
                        
                          <section id="collapse<?php echo e($project->id); ?>" class="collapse <?php if($i==0): ?><?php echo e('show'); ?><?php endif; ?>" aria-labelledby="heading<?php echo e($project->id); ?>" data-parent="#accordion">
                              <div class="row justify-content-start">
                                <div class="col-md-3 form-group d-flex text-left">
                                      <label class="control-label mandatory d-flex mb-0 pr-2" style="align-items: center;">Select Date: </label>
                                      <input style="width: 105px;" type="text" class="form-control datepicker" id="entrydate_<?php echo e($project->id); ?>" name="entrydate" value="<?php echo e(date('Y-m-d')); ?>">
                                </div>
                                <div class="col-md-4 form-group d-flex text-left">
                                      <label class="control-label mandatory d-flex mb-0" style="align-items: center;width: 150px;">Work Status: </label>
                                      <select class="selectpicker" name="workStatus" id="workStatus_<?php echo e($project->id); ?>" data-style="btn-light">
                                        <option value="">Select Status</option>
                                        <option value="working">Working Day</option>
                                        <option value="leave">Leave</option>
                                        <option value="holiday">Holiday</option>
                                    </select>
                                </div>
                                <div class="col-md-5 form-group text-right">
                                  <button type="button" onclick="loadExpenseWindow(<?php echo e($project->id); ?>,'<?php echo e($project->projectID. ' '.ucwords($project->projectname->projectname)); ?>')" id="expWindowOpenBtn_<?php echo e($project->id); ?>" class="btn btn-info waves-light waves-effect" ><i class="fa fa-plus"></i> Add Expense</button>
                                </div>
                              </div>
                              <div class="row justify-content-center">
                                 <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                       <thead>
                                          <tr>
                                            <th width="4%">#</th>
                                            <th width="35%">Task</th>
                                            <th>From Time</th>
                                            <th>To Time</th>
                                            <th>Effort</th>
                                            <th width="28%">Comments</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php $j=1; $subActs = $project->activity->subactivities; ?>
                                          <?php if(count($subActs)>0): ?>
                                            <?php $__currentLoopData = $subActs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <tr>
                                                <td><?php echo e($j++); ?></td>
                                                <td>
                                                  <?php echo e(ucwords($task->subactivity)); ?>

                                                  <input type="hidden" name="subactivity[]" value="<?php echo e($task->id); ?>">
                                                </td>
                                                <td><input type="text" class="form-control timepicker" name="fromTime[]" id="from_<?php echo e($project->id); ?>_<?php echo e($task->id); ?>" onchange="CalcTotal(<?php echo e($project->id); ?>,<?php echo e($task->id); ?>)"></td>
                                                <td><input type="text" class="form-control timepicker" name="toTime[]" id="to_<?php echo e($project->id); ?>_<?php echo e($task->id); ?>" onchange="CalcTotal(<?php echo e($project->id); ?>,<?php echo e($task->id); ?>)"></td>
                                                <td><input type="text" class="form-control" id="total_<?php echo e($project->id); ?>_<?php echo e($task->id); ?>" name="totalTime_<?php echo e($project->id); ?>[]" readonly value="00:00"></td>
                                                <td><input type="text" class="form-control" name="comments[]"></td>
                                             </tr>
                                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                          <?php endif; ?>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                             
                              <div class="row mt-2">
                                <div class="col-6">
                                    <a class="btn btn-primary btn-rounded" href="<?php echo e(url('time-entry/'.$project->projectID)); ?>"><i class="fa fa-file-text-o"></i> Show Entries</a>
                                </div>
                                <div class="col-6 formbuttons">
                                    <button type="reset" class="btn btn-light">Clear</button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                          </section>
                        </div>
                    </form>
                    <?php $i++; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <!-- End row -->
    </div> <!-- container -->
</div> <!-- content -->
<!-- Modal -->
<div id="expense-modal" class="modal-demo">

<div class="alert alert-success modalAlrt" id="Modalsuccess"></div>
<div class="alert alert-error modalAlrt" id="Modalerror"></div>
    <button type="button" class="close" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title" id="expenseTitle"></h4>
    <div class="custom-modal-text">
      <form id="addExpense" class="form w-100" action="javascript:;" method="POST" autocomplete="off">
        <input type="hidden" id="projectID" value="0">
        <div class="row justify-content-center">
          <div class="col-md-12 form-group text-right d-flex justify-content-end">
             <label class="control-label mandatory d-flex mb-0 pr-2" style="align-items: center;">Select Date: </label>
             <input style="width: 160px;" type="date" class="form-control" id="expenseDate" value="<?php echo e(date('Y-m-d')); ?>">
          </div>
            <div class="col-md-12 table-responsive">
               <table class="table table-striped table-bordered">
                 <thead>
                    <tr>
                      <th width="5%">#</th>
                      <th width="60%">Expense Type</th>
                      <th>Amount (AED)</th>
                      <th>Delete</th>
                    </tr>
                 </thead>
                 <tbody id="expenseList">
                    
                 </tbody>
               </table>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-4 text-left">
                <button type="button" id="addNewExpense" class="btn btn-link">Add New</button>
            </div>
            <div class="col-8 text-right">
                <button type="button" onclick="Custombox.close();" class="btn btn-light">Close</button>
                <button type="submit" id="addExpenseBtn" class="btn btn-success">Save</button>
            </div>
        </div>
      </form>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('customjs'); ?>

<script src="<?php echo e(asset('/plugins/bootstrap-select/js/bootstrap-select.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('/plugins/bootstrap-timepicker/bootstrap-timepicker.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('/plugins/moment/moment.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('/plugins/custombox/js/custombox.min.js')); ?>" type="text/javascript"></script>
<script type="text/javascript">

$('.timepicker').timepicker({
    minuteStep: 1,
    icons: {
        up: 'mdi mdi-chevron-up',
        down: 'mdi mdi-chevron-down'
    },
    defaultTime:null
});

function CalcTotal(pid,tid) {
  var from = $('#from_'+pid+'_'+tid).val();
  var to = $('#to_'+pid+'_'+tid).val();
  if(from!='' && to!='') {
    var day = '1/1/1970 '; // 1st January 1970
    var secs = (Date.parse(day + to) - Date.parse(day + from)) / 1000;
    var formatted = moment.utc(secs*1000).format('HH:mm');//using moment.js
    $('#total_'+pid+'_'+tid).val(formatted);
  }
}

function getExpensesList(expFor,edate) {
    $.ajax({
  		async:false,
	    url: burl+'/expensesList',
	    type: 'POST',
	    data: {expFor:expFor,edate:edate},
	    dataType: 'JSON',
	    success: function (res) {
	       $('#expenseList').html(res);
	    }
	});
	return true;
}
function loadExpenseWindow(expFor,proTitle=null) {
  if(proTitle!=null) {//expense for any project
     $("#projectID").val(expFor);
     $("#expenseTitle").html('Expense For <span>'+proTitle+'</span>');
  }else {//general expense
     $("#projectID").val(0);
     $("#expenseTitle").html('<span>General</span> Expense');
  }
  var edate = $("#expenseDate").val();
  getExpensesList(expFor,edate);//getting the expesnse list
  $('#ExpenseModalOpen').trigger('click');
}

function updateRowNo() {
  var i = 0;
   $('#expenseList tr').each(function(){
      $(this).find('.rowNo').text(++i);
   });
}

$('#addNewExpense').click(function(){
  var tr = $('#expenseList').find("tr:last");
  var lastSelectVal = tr.find('.expType').val();
  var lastAmtVal = tr.find('.expAmt').val();
  if(lastSelectVal=='') {
     ajaxModalAlert('error','Select a valid expense type for the last entry');return false;
  }
  if(lastAmtVal=='') {
     ajaxModalAlert('error','Enter a valid expense amount for the last entry');return false;
  }
  
  //after validation, create new row
  var clone = tr.clone();
  clone.find('input').val('');
  clone.find('select').val('');
  tr.after(clone);
  updateRowNo(); 
});

selectedExpTypes = [];

$(document).on('click','.deleteTimes',function(e) {
  var rowCount = $('#expenseList tr').length;
  if(rowCount>1){
    var selectedExp =  $(this).closest('tr').find('.expType').val();
    selectedExpTypes.splice($.inArray(selectedExp, selectedExpTypes), 1);
    $(this).closest('tr').remove();
    updateRowNo();
  }else {//if only one row
  	 $(this).closest('tr').find('.expType').val('');
  	 $(this).closest('tr').find('.expAmt').val('');
  }
});

$(document).on('change','.expType',function(e) {
    var expTyp = $(this).val();
    if(expTyp!=''){
      var expText = $(this).find('option:selected').text();

      $(this).val('');
      selectedExpTypes = $("select[name='expType[]']").map(function(){return $(this).val();}).get();
      if($.inArray(expTyp, selectedExpTypes) !== -1) {// in array
         ajaxModalAlert('error', expText+' already selected');return false;
      }else {
        $(this).val(expTyp);
        selectedExpTypes.push(expTyp);
      }
    }
});

$(document).on('change','#expenseDate',function(e) {
	var newExpFor = $("#projectID").val();
	var newExpDate = $(this).val();
    getExpensesList(newExpFor,newExpDate);
});

$(document).on('submit','#addExpense',function(e) {
  var projectID = $("#projectID").val();
  var expenseDate = $("#expenseDate").val();

  var expenseTypes = $("select[name='expType[]']").map(function(){return $(this).val();}).get();
  var expensesAmts = $("input[name='expAmount[]']").map(function(){return $(this).val();}).get();

  if(expenseDate=='') {
    ajaxModalAlert('error', 'Enter a valid date');return false;
  }
  
  var checks = $.grep(expensesAmts, function(amt){
    return isNaN(amt);
  });
  if(checks.length>0) {//some element is not a number
     ajaxModalAlert('error', 'Enter valid expense amounts');return false;
  }
  $.ajax({
      url: burl+'/expenses',
      type: 'POST',
      data: {projectID:projectID,expTypes:expenseTypes,expAmts:expensesAmts,expenseDate:expenseDate},
      dataType: 'JSON',
      beforeSend: function() {
      	 $("#Modalsuccess").hide();$("#Modalerror").hide();
         $("#addExpenseBtn").prop('disabled', true);
         $("#addExpenseBtn").html('<i class="fa fa-circle-o-notch fa-spin"></i> Saving');
      },
      success: function (res) {
          $("#addExpenseBtn").prop('disabled', false);
          $("#addExpenseBtn").html('Save');
          if(res==1) {
          	  if(getExpensesList(projectID,expenseDate)) {
          	  	ajaxModalAlert('success','Expense details updated successfully');
          	  }
              //Custombox.close();
              //ajaxAlert('success','Expense details updated successfully');
          }else if(res==2) {
              ajaxModalAlert('error','Nothing to update');
          }else {
              ajaxModalAlert('error','Something went wrong. Try again');
          }
      }
  });
});

$(".addForm").submit(function(){
  var pid = $(this).data('pid');
 
  var entrydate = $("#entrydate_"+pid).val();
  var workStatus = $("#workStatus_"+pid).val();

  var totals = $("input[name='totalTime_"+pid+"[]']").map(function(){return $(this).val();}).get();

  if(!nullValidate(entrydate,'entrydate_'+pid,'Select a valid date')) {
    return false;
  }
  if(!dateValidate(entrydate,'entrydate_'+pid,'Invalid date format given')) {
    return false;
  }
  if(!nullValidate(workStatus,'workStatus_'+pid,'Select a work status')) {
    return false;
  }
  function checkZero(total) {return total == '00:00';}
  if(totals.every(checkZero)) {
    notify("Enter atleast one time entry");return false;
  }
  
  return true;
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>