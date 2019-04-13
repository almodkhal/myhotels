<?php $__env->startSection('customcss'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/plugins/custombox/css/custombox.min.css')); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/plugins/bootstrap-select/css/bootstrap-select.min.css')); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 <!-- Start content -->
 <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">MANAGE ROLES</h4>
                    <div class="btn-group float-right">
                        <a href="<?php echo e(url('masters/permissions')); ?>" class="btn btn-primary btn-rounded waves-light waves-effect float-right"><i class="fa fa-file-text-o"></i> Permission List</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->

<div class="row justify-content-center">
    <div class="col-md-12 col-lg-8">
        <div class="card-box pt-0 mb-0 form">
            <h3><i class="fa fa-user headIcon"></i> New Role</h3>
            
            <form id="addNewRole" class="form-group" action="javascript:;" method="POST" autocomplete="off">
                <div class="row justify-content-center">
                    <div class="col-sm-10 col-8">
                        <label class="control-label mandatory">New Role</label>
                        <input type="text" class="form-control" id="newrole">
                    </div>
                    <div class="col-sm-2 col-4">
                        <label class="control-label">&nbsp;</label>
                        <button type="submit" id="addRoleBtn" class="btn btn-success w-100"><i class="fa fa-plus"></i> Add</button>
                    </div>
                </div>
            </form>
            
            <h3><i class="fa fa-users headIcon"></i> Available Roles</h3>
            <table class="table table-bordered mb-0 table-responsive-md" width="100%" id="permissionsTbl">
                <thead>
                    <tr>
                        <th width="10%">#</th>
                        <th width="60%">Roles</th>
                        <th width="15%" style="text-align: center;">Action</th>
                        <th width="15%" style="text-align: center;">Permissions</th>
                    </tr>
                </thead>
                <tbody id="rolesList">
                    <?php if($roles!=FALSE): ?>
                    <?php $i=1; ?>
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr id="rolesRow_<?php echo e($role->id); ?>">
                            <td><?php echo e($i++); ?></td>
                            <td class="editRole">
                                <input type="text" class="form-control d-no" id="roleEditInpt_<?php echo e($role->id); ?>" value="<?php echo e($role->role); ?>">
                                <span id="oldRole_<?php echo e($role->id); ?>"><?php echo e(ucwords($role->role)); ?></span>
                            </td>
                            <td align="center">
                                <?php if($role->editable==1): ?>
                                <div id="btns_<?php echo e($role->id); ?>">
                                    <div class="btn-group">
                                        <button type="button" id="editRoleBtn_<?php echo e($role->id); ?>" onclick="editRole(<?php echo e($role->id); ?>)" class="btn btn-info btn-rounded waves-light waves-effect"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-rounded waves-light waves-effect" id="dltRoleBtn_<?php echo e($role->id); ?>" onclick="deleteRole(<?php echo e($role->id); ?>)"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                </div>
                                <div class="d-no" id="editBtns_<?php echo e($role->id); ?>">
                                    <div class="btn-group">
                                        <button type="button" id="saveRole_<?php echo e($role->id); ?>" onclick="saveRole(<?php echo e($role->id); ?>)" class="btn btn-success btn-rounded waves-light waves-effect"><i class="fa fa-check white"></i></button>
                                        <button type="button" class="btn btn-danger btn-rounded waves-light waves-effect" onclick="cancelEdit(<?php echo e($role->id); ?>)"><i class="fa fa-times white"></i></button>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </td>
                            <td align="center">
                                <?php if($role->role!='admin'): ?>
                                <button type="button" onclick="showPermissions(<?php echo e($role->id); ?>)" class="btn btn-warning waves-light waves-effect" data-toggle="tooltip" data-placement="right" title="Edit Permissions"><i class="fa fa-key"></i></button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <tr><td colspan="4" align="center">No roles found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- end row -->
</div> <!-- container -->
</div> <!-- content -->
<a href="#permission-modal" id="permissionModalView" class="d-none" data-animation="scale" data-plugin="custommodal" data-overlaySpeed="1000" data-overlayColor="#36404a">Scale</a>

<a href="#edit-permission-modal" id="editPermissionModalView" class="d-none" data-animation="push" data-plugin="custommodal" data-overlaySpeed="1000" data-overlayColor="#36404a">Scale</a>

<!-- Permission add -->
<div id="permission-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">Modify Permissions for <span id="addedRole" style="color: #f9bc0b;"></span></h4>
    <div class="custom-modal-text">
       
        <form class="form" action="<?php echo e(url('masters/permissions')); ?>" method="POST" autocomplete="off">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="role_id" id="newRoleID" value="">
            <table class="table mb-0 col-12 table-responsive-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Forms</th>
                        <th style="text-align: center;">Create</th>
                        <th style="text-align: center;">Edit</th>
                        <th style="text-align: center;">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $j=1;$m=0; ?>
                    <?php $__currentLoopData = $forms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($j++); ?></td>
                        <td><?php echo e(ucwords($form->form)); ?></td>
                        <td style="text-align: center;">
                            <input type="hidden" name="form[]" value="<?php echo e($form->form); ?>">
                            <div>
                                <input type="hidden" name="new[<?php echo e($m); ?>]" value="0" />
                                <input type="checkbox" class="permissions" name="new[<?php echo e($m); ?>]" value="1" checked />
                                <span></span>
                            </div>
                        </td>
                        <td style="text-align: center;">
                            <input type="hidden" name="edit[<?php echo e($m); ?>]" value="0" />
                            <input type="checkbox" class="permissions" name="edit[<?php echo e($m); ?>]" value="1" checked />
                            <span></span>
                        </td>
                        <td style="text-align: center;">
                            <input type="hidden" name="destroy[<?php echo e($m); ?>]" value="0" />
                            <input type="checkbox" class="permissions" name="destroy[<?php echo e($m); ?>]" value="1" checked/>
                            <span></span>
                        </td>
                    </tr>
                    <?php $m++; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div class="mt-4 text-center">
                <button type="button" onclick="Custombox.close();" class="btn btn-light">Close</button>
                <button type="submit" id="permissionAddBtn" class="btn btn-primary">Update Permissions</button>
            </div>
        </form>
        
    </div>
</div>

<!-- Permission Update -->
<div id="edit-permission-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">Modify Permissions for <span id="edittingRole" style="color: #f9bc0b;"></span></h4>
    <div class="custom-modal-text">
       
        <form class="form" action="<?php echo e(url('masters/permissions')); ?>" method="POST" autocomplete="off">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="role_id" id="eRole_id" value="">
            <input type="hidden" name="edit" value="1">
            <table class="table mb-0 col-12 table-responsive-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Forms</th>
                        <th style="text-align: center;">Create</th>
                        <th style="text-align: center;">Edit</th>
                        <th style="text-align: center;">Delete</th>
                    </tr>
                </thead>
                <tbody id="permissionEditList">
                   
                </tbody>
            </table>
            <div class="mt-4 text-center">
                <button type="button" onclick="Custombox.close();" class="btn btn-light">Close</button>
                <button type="submit" id="permissionAddBtn" class="btn btn-primary">Update Permissions</button>
            </div>
        </form>
        
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('customjs'); ?>
<script src="<?php echo e(asset('/plugins/custombox/js/custombox.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('/plugins/custombox/js/legacy.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('/plugins/bootstrap-select/js/bootstrap-select.js')); ?>" type="text/javascript"></script>
<script type="text/javascript">
$("#addNewRole").submit(function(){
    var role = $("#newrole").val();
    if(!nullValidate(role,'newrole','Enter a role name')) {
        return false;
    }
    if(!alphaValidate(role,'newrole')) {
        return false;
    }
    if(!fieldExist(role,'newrole','role','roles','This role already exist')) {
        return false;
    }
    $.ajax({
        url: burl+'/masters/roles',
        type: 'POST',
        data: {role:role},
        dataType: 'JSON',
        beforeSend: function() {
           $("#addRoleBtn").prop('disabled', true);
           $("#addRoleBtn").html('<i class="fa fa-circle-o-notch fa-spin"></i> Adding');
        },
        success: function (res) {
            $("#newrole").val('');
            $("#addRoleBtn").prop('disabled', false);
            $("#addRoleBtn").html('<i class="fa fa-plus"></i> Add');
            if(res.msg!=0) {
                $("#rolesList").html(res.html);
                notify('New Role Added successfully. Now modify the permissions','success');
                $("#addedRole").text(res.role);
                $("#newRoleID").val(res.role_id);
                $("#permissionModalView").trigger("click");
            }else {
                notify('Something went wrong. Try again');
            }
        }
    });
});
function editRole(rid) {
    $('button[id^="editRoleBtn_"]').prop('disabled', true);
    $("#oldRole_"+rid).hide();
    $("#btns_"+rid).hide();
    $("#roleEditInpt_"+rid).show().focus();
    $("#editBtns_"+rid).show();
}
function cancelEdit(rid) {
    $('button[id^="editRoleBtn_"]').prop('disabled', false);
    $("#roleEditInpt_"+rid).hide();
    $("#editBtns_"+rid).hide();
    $("#oldRole_"+rid).show();
    $("#btns_"+rid).show();
}
function saveRole(rid) {
    var newrole = $("#roleEditInpt_"+rid).val();
    var field = 'roleEditInpt_'+rid;
    if(!nullValidate(newrole,field,'Enter a role name')) {
        return false;
    }
    if(!alphaValidate(newrole,field)) {
        return false;
    }
    if(!fieldExist(newrole,field,'role','roles','This role already exist','edit')) {
        return false;
    }
    $.ajax({
        url: burl+'/masters/roles/'+rid,
        type: 'PATCH',
        data: {newrole:newrole,role_id:rid},
        dataType: 'JSON',
        beforeSend: function() {
           $("#saveRole_"+rid).prop('disabled', true);
           $("#saveRole_"+rid).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
        },
        success: function (res) {
            $("#saveRole_"+rid).prop('disabled', false);
            $("#saveRole_"+rid).html('<i class="fa fa-plus"></i>');
            if(res.msg!=0) {
                $("#rolesList").html(res.html);
                notify('Role update successfully','success');
            }else {
                notify('Something went wrong. Try again');
            }
        }
    });
}
function showPermissions(rid) {
    $.ajax({
        async:false,
        url: burl+'/masters/permissions/'+rid+'/edit',
        type: 'GET',
        dataType: 'JSON',
        success: function (res) {
            $('#edittingRole').text(res.role);
            $('#eRole_id').val(res.role_id);
            $('#permissionEditList').html(res.permissions);
            //after creating the form elemetns, open the form in modal
            $("#editPermissionModalView").trigger("click");
        }
    });
}

//delete role
function deleteRole(id) {
   swal({
    title: 'Delete this Role?',
    text: 'This will remove the entire role details, set permissions, etc. associated with it.',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#4fa7f3',
    cancelButtonColor: '#d57171',
    confirmButtonText: 'Delete'
  }).then(function () {
       $.ajax({
            url: burl+'/masters/roles/'+id,
            type: 'DELETE',
            dataType: 'JSON',
            beforeSend: function() {
               $("#dltRoleBtn_"+id).prop('disabled', true);
               $("#dltRoleBtn_"+id).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
             },
            success: function (res) {
                $("#dltRoleBtn_"+id).prop('disabled', false);
                $("#dltRoleBtn_"+id).html('<i class="fa fa-trash-o"></i>');
                if(res!=0) {
                    $("#rolesList").html(res);
                    notify('Role deleted successfully','success');
                }else {
                    notify('Something went wrong. Try again');
                }
            }
        });
  });
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>