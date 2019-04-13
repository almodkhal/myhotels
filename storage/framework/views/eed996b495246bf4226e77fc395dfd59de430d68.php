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
                    <h4 class="page-title float-left">Create Invoice</h4>
                    <a href="<?php echo e(url('invoices')); ?>" class="btn btn-primary btn-rounded waves-light waves-effect float-right"><i class="mdi mdi-cloud-print"></i> Invoice List</a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row justify-content-center" id="showTaskDetails">
            <div class="col-md-12">
                <div class="card-box pt-0">
                    <form id="addForm" class="form" action="<?php echo e(url('invoices')); ?>" method="POST" autocomplete="off">
                        <?php echo csrf_field(); ?>
                        <h3 class="mt-0"><i class="fa fa-search headIcon"></i> Select Company & Client</h3>
                        <section>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="row">
                                   <div class="col-12 form-group">
                                       <select class="selectpicker" data-live-search="true" data-style="btn-light" id="company" name="company">
                                        <option value="">Select Company</option>
                                        <?php if($companies!=FALSE): ?>
                                            <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($comp->id); ?>"><?php echo e(ucwords($comp->cid.' '.$comp->cname)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                      </select>
                                   </div>
                                   <div class="col-12 form-group d-no" id="companyInfo">
                                      <h4 class="header-title">CVS Info Solutions</h4>
                                      <div class="row">
                                         <div class="col-6">
                                           <address class="line-h-24 mb-0">
                                              Stanley Jones<br>
                                              795 Folsom Ave, Suite 600<br>
                                              San Francisco, CA 94107<br>
                                              P: (123) 456-7890
                                          </address>
                                         </div>
                                         <div class="col-6">
                                           <ul style="list-style: none;padding: 0;margin-bottom: 0;">
                                              <li>TRN No: <strong>00158451248454</strong></li>
                                              <li><i class="fa fa-phone pr-2"></i> <strong>+4176 575585555</strong></li>
                                              <li><i class="fa fa-globe pr-2"></i> <strong>www.sadsad.com</strong></li>
                                            </ul>
                                         </div>
                                      </div>
                                   </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="row">
                                    <div class="col-12 form-group">
                                        <select class="selectpicker" data-live-search="true" data-style="btn-light" id="client" name="client">
                                          <option value="">Select Client</option>
                                          <?php if($clients!=FALSE): ?>
                                              <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cli): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                  <option value="<?php echo e($cli->id); ?>"><?php echo e(ucwords($cli->clientCode.' '.$cli->client)); ?></option>
                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                          <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="col-12 form-group d-no" id="clientInfo">
                                        <h4 class="header-title">CVS Info Solutions</h4>
                                        <div class="row">
                                           <div class="col-6">
                                             <address class="line-h-24 mb-0">
                                                Stanley Jones<br>
                                                795 Folsom Ave, Suite 600<br>
                                                San Francisco, CA 94107<br>
                                                P: (123) 456-7890
                                            </address>
                                           </div>
                                           <div class="col-6">
                                             <ul style="list-style: none;padding: 0;margin-bottom: 0;">
                                                <li>TRN No: <strong>00158451248454</strong></li>
                                                <li><i class="fa fa-phone pr-2"></i> <strong>+4176 575585555</strong></li>
                                                <li><i class="fa fa-globe pr-2"></i> <strong>www.sadsad.com</strong></li>
                                              </ul>
                                           </div>
                                        </div>
                                    </div>
                                 </div>
                              </div>
                            </div>
                        </section>
                        <h3 class="mt-0"><i class="fa fa-eye headIcon"></i> Basic Details</h3>
                        <section>
                            <div class="row">
                                <div class="col-md-3 col-sm-12 form-group">
                                    <label class="control-label mandatory">Invoice ID</label>
                                    <input type="text" class="form-control" id="invoiceID" name="invoiceID" value="" readonly>
                                </div>
                                <div class="col-md-3 col-sm-12 form-group">
                                    <label class="control-label mandatory">Invoice Date</label>
                                    <input type="text" class="form-control datepicker" id="creationDate" name="creationDate" value="<?php echo e(date('Y-m-d')); ?>">
                                </div>
                                <div class="col-md-3 col-sm-12 form-group">
                                    <label class="control-label">Terms</label>
                                    <input type="text" class="form-control" id="terms" name="terms" value="Due on Receipt">
                                </div>
                                <div class="col-md-3 col-sm-12 form-group">
                                    <label class="control-label mandatory">Due Date</label>
                                    <input type="text" class="form-control datepicker" id="dueDate" name="dueDate">
                                </div>
                            </div>
                        </section>
                        <h3 class="mt-0"><i class="fa fa-list headIcon"></i> Particulars</h3>
                        <section>
                          <div class="row justify-content-center">
                             <div class="col-lg-5 col-md-3 form-group pl-1 pr-1">
                                 <label class="control-label">Item & Description</label>
                                 <input type="text" class="form-control" id="particular">
                             </div>
                             <div class="col-lg-2 col-md-3 form-group pl-1 pr-1">
                              <label class="control-label">Quantity</label>
                                 <input type="number" class="form-control" min="0" id="quantity">
                             </div>
                             <div class="col-lg-2 col-md-3 form-group pl-1 pr-1">
                              <label class="control-label">Rate</label>
                                 <input type="number" class="form-control" min="0" id="rate">
                             </div>
                             <div class="col-lg-2 col-md-3 form-group pl-1 pr-1">
                              <label class="control-label">Tax</label>
                                <select class="selectpicker" data-style="btn-light" id="tax">
                                    <option value="0">No Tax</option>
                                    <?php if($taxes!=FALSE): ?>
                                        <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($tax->tax_percent); ?>" <?php if($tax->tax_percent==5): ?><?php echo e('selected'); ?><?php endif; ?>><?php echo e($tax->tax_percent); ?>% Tax</option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                             </div>
                             <div class="col-lg-1 col-md-3 form-group pl-1 pr-1">
                              <label class="control-label">&nbsp;</label>
                                 <button type="button" id="addParticular" class="btn btn-info w-100"><i class="fa fa-plus"></i></button>
                             </div>
                              <div class="col-12 pl-1 pr-1">
                                  <table class="table table-bordered">
                                      <thead class="thead-dark">
                                         <th width="5%">#</th>
                                         <th width="40%">Item & Description</th>
                                         <th width="10%">Qty</th>
                                         <th width="15%">Rate</th>
                                         <th width="10%">Tax</th>
                                         <th width="15%">Amount</th>
                                         <th width="5%"></th>
                                      </thead>
                                      <tbody id="particularList">
                                          <tr id="noParticulars">
                                            <td colspan="7" align="center">No particulars added yet</td>
                                          </tr>
                                      </tbody>
                                  </table>
                                  <table class="table">
                                    <thead>
                                    <tr>
                                       <th colspan="4" width="70%" style="text-align: right;">Sub Total:</th>
                                       <th width="10%" id="totalAmt">0.00</th>
                                       <th width="20%" id="totalAmt">0.00</th>
                                    </tr>
                                    </thead>
                                  </table>
                              </div>
                          </div>
                        </section>
                        <section>
                            <div class="row mt-4">
                                <div class="col-lg-3 col-md-4 col-sm-4 col-12 statuscheck form-group">
                                    <label class="control-label">Status:</label>
                                    <select class="form-control statusSelect" name="status" id="status">
                                        <option value="created" selected>Created</option>
                                        <option value="send">Sent</option>
                                        <option value="pending">Payment Pending</option>
                                        <option value="rejected">Rejected</option>
                                        <option value="received">Payment Received</option>
                                        <option value="verified">Verified</option>
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


<?php $__env->stopSection(); ?>

<?php $__env->startSection('customjs'); ?>

<script src="<?php echo e(asset('/plugins/bootstrap-select/js/bootstrap-select.js')); ?>" type="text/javascript"></script>
<script type="text/javascript">
$(document).on('change','#company',function(e) {
  var cid = $(this).val();
  if(cid!=''){
    alert(cid);
  }
});

$("#addParticular").click(function(){
  var particular = $("#particular").val();
  var quantity = $("#quantity").val();
  var rate = $("#rate").val();
  var tax = $("#tax").val();
  if(!nullValidate(particular,'particular','Enter Item & Description')) {
    return false;
  }
  if(!nullValidate(quantity,'quantity','Enter some Quantity')) {
    return false;
  }
  if(!nullValidate(rate,'rate','Enter some Unit Rate')) {
    return false;
  }
  //add this to the table as a row
  var taxAmt = (parseFloat(quantity)*parseFloat(rate)*parseFloat(tax))/100;
  var totalAmt = (parseFloat(quantity)*parseFloat(rate)) + parseFloat(taxAmt);
  var tr = "<tr><td class='rowNo'></td><td>"+particular+"<input type='hidden' name='particulars[]' value='"+particular+"' /></td><td>"+quantity+"<input type='hidden' name='quantities[]' value='"+quantity+"' /></td><td>"+rate+"<input type='hidden' name='rates[]' value='"+rate+"' /></td><td>"+taxAmt+"<span class='d-block'>"+tax+"% Tax</span><input type='hidden' name='taxes[]' value='"+taxAmt+"' /></td><td>"+totalAmt+"<input type='hidden' name='totals[]' value='"+totalAmt+"' /></td><td><i class='fa fa-times-circle' onclick='del()'></i></td></tr>";

  $("#noParticulars").remove();
  $("#particularList").append(tr);
  $("#particular").val('');$("#quantity").val('');$("#rate").val('');$("#tax").val('');
});

$("#task").change(function(){
   var seltask = $(this).val();
   if(seltask!='') {
       $.ajax({
            url: burl+'/get-clientTask-details',
            type: 'POST',
            data: {task_id:seltask},
            dataType: 'JSON',
            success: function (res) {
               $("#taskAndClientInfo").html(res.details).slideDown();
            }
        });
   }else {
      $("#taskAndClientInfo").slideUp().html('');
   }
});

$("#addForm").submit(function(){
  var task = $("#task").val();
  var sel_client_id = $("#sel_client_id").val();
  var creationDate = $("#creationDate").val();
  var status = $("#status").val();

  if(!nullValidate(creationDate,'creationDate','Choose a date for invoice generation')) {
    return false;
  }
  if(!dateValidate(creationDate,'creationDate','Invalid date format given for Invoice generation date')) {
    return false;
  }
  if(!nullValidate(task,'task','Select a task')) {
    return false;
  }
  if(!nullValidate(sel_client_id,'sel_client_id','Select an task')) {
    return false;
  }
  if(partiArr.length==0 || amtArr.length==0) {
    $("#particular").css('borderColor',errColor);$("#amount").css('borderColor',errColor);
    $("#particular").focus();notify("Enter alteast one particular and amount to generate an invoice");return false;
  }
  if(!nullValidate(status,'status','Select a status')) {
    return false;
  }
  return true;
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>