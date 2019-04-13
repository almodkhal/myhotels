<?php $__env->startSection('content'); ?>
<section class="jumbotron text-center">
  <div class="container">
    <i class="page-icon fa fa-user-md"></i>
    <h1 class="jumbotron-heading mb-0">Managers</h1>
    <ol class="breadcrumb justify-content-center">
        <li class="breadcrumb-item"><a href="<?php echo e(url('dashboard')); ?>">Dashboard</a></li>
        <li class="breadcrumb-item active">Managers</li>                        
    </ol>
  </div>
</section>

<div class="content-body text-muted">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-12 text-right form-group">
                <button type="button" class="btn btn-primary btn-rounded waves-light waves-effect" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Add New</button>
            </div>
            <div class="col-md-8 col-sm-12">
                <table class="table table-bordered mb-0 nowrap" id="managerTable" cellspacing="0" width="100%" role="grid">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            </div>
        </div>
    </div>
<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="somthing" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New Manager</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <i class="fa fa-times"></i>
        </button>
      </div>
    <form id="addForm" class="form" action="javascript:;" method="POST" autocomplete="off">
      <div class="modal-body">
           <div class="row justify-content-center">
            <div class="col-md-12">
                <section>
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-12 form-group">
                            <label class="control-label mandatory">Name</label>
                            <input type="text" class="form-control" id="name">
                        </div>
                        <div class="col-md-6 col-12 form-group">
                            <label class="control-label mandatory">Email</label>
                            <input type="text" class="form-control" id="email">
                        </div>
                        <div class="col-md-6 col-12 form-group">
                            <label class="control-label mandatory">Username</label>
                            <input type="text" class="form-control" id="username">
                        </div>
                        <div class="col-md-6 col-12 form-group">
                            <label class="control-label mandatory">Password</label>
                            <input type="text" class="form-control" id="password">
                        </div>
                        <div class="col-md-7 col-12 form-group">
                            <label class="control-label mandatory">Status</label>
                            <select class="form-control" id="status">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </section>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" id="addBtn" class="btn btn-primary btn-sm">Add Manager</button>
      </div>
    </form>
    </div>
  </div>
</div>

<script type="text/javascript">
function refreshTable() {//get the manufacturer data over ajax
    $('#managerTable').dataTable().fnDestroy();
    $('#managerTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: burl+'/get-all-managers',
        columns: [
            {data: 'index'},
            {data: 'name'},
            {data: 'email'},
            {data: 'username'},
            {data: 'status'},
            {data: 'action'}
        ],
        language: {
          emptyTable: 'No managers found. Add New',
          processing: '<i class="fa fa-circle-o-notch fa-spin"></i>'
        }
    });
}
$(document).ready(function() {
    refreshTable();
});
//delete manager
function deleteFn(id) {
   swal({
    title: 'Delete this Manager?',
    text: 'This will remove the entire manager details',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#4fa7f3',
    cancelButtonColor: '#d57171',
    confirmButtonText: 'Delete'
  }).then(function () {
       $.ajax({
            url: burl+'/managers/'+id,
            type: 'DELETE',
            dataType: 'JSON',
            beforeSend: function() {
               $("#dltBtn_"+id).prop('disabled', true);
               $("#dltBtn_"+id).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
             },
            success: function (res) {
                if(res==1) {
                    refreshTable();
                    ajaxAlert('success','This manager has been deleted successfully');
                }else {
                    ajaxAlert('error','Something went wrong. Try again');
                }
            }
        });
  });
}

$("#addForm").submit(function(){
    var name = $("#name").val();
    var email = $("#email").val();
    var username = $("#username").val();
    var password = $("#password").val();
    var status = $("#status").val();
    if(!nullValidate(name,'name','Enter a manager name')) {
        return false;
    }
    if(!nullValidate(email,'email','Enter an email')) {
        return false;
    }
    if(!emailValidate(email,'email')) {
        return false;
    }
     //value,inputField,dbColumn,table,message
    if(!fieldExist(email,'email','email','This Email already exist. Use different one')) {
        return false;
    }
    if(!nullValidate(username,'username','Enter an username')) {
        return false;
    }
     //value,inputField,dbColumn,message
    if(!fieldExist(username,'username','username','This Username already exist. Use different one')) {
        return false;
    }
    if(!nullValidate(password,'password','Enter a password')) {
        return false;
    }
    $.ajax({
        url: burl+'/managers',
        type: 'POST',
        data: {name:name,email:email,username:username,password:password,status:status},
        dataType: 'JSON',
        beforeSend: function() {
           $("#addBtn").prop('disabled', true);
           $("#addBtn").html('<i class="fa fa-circle-o-notch fa-spin"></i> Adding');
        },
        success: function (res) {
            if(res==1) {
                refreshTable();
                ajaxAlert('success','New Manager added successfully');
            }else if(res==2) {
                ajaxAlert('error',"Couldn't complete the action as this Manager has been assigned something");
            }else {
               ajaxAlert('error','Something went wrong. Try again');
            }
            $("#addBtn").prop('disabled', false);
            $("#addBtn").html('Add Manager');
            $('#addForm')[0].reset();
            $('#addModal').modal('hide');
        }
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>