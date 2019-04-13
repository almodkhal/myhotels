@extends('layouts.common')

@section('content')
<section class="jumbotron text-center pb-2">
  <div class="container">
    <i class="page-icon fa fa-calendar-check-o"></i>
    <h1 class="jumbotron-heading mb-0">Bookings</h1>
    @if(isAdmin())
    <ol class="breadcrumb justify-content-center">
        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Bookings</li>                        
    </ol>
    @endif
  </div>
</section>

<div class="content-body text-muted">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-md-3 col-sm-12 mb-4">
                <select class="selectpicker" data-style="btn-light" id="bookingStatus">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="accepted">Accepted</option>
                    <option value="rejected">Rejected</option>
                    <option value="canceled">Canceled</option>
                    <option value="checkedin">CheckedIn</option>
                    <option value="checkedOut">CheckedOut</option>
                </select>
            </div>
            <div class="col-md-12 col-sm-12">
                <table class="table table-bordered mb-0 nowrap" id="bookingsTable" cellspacing="0" width="100%" role="grid" align="center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Booking ID</th>
                        <th>Customer</th>
                        <th>Email</th>
                        <th>Room</th>
                        <th class="text-center">CheckIn</th>
                        <th class="text-center">CheckOut</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            </div>
        </div>
    </div>
<script type="text/javascript">
function refreshTable(status=null) {
    var txt = status==null ? '' : status;
    $('#bookingsTable').dataTable().fnDestroy();
    $('#bookingsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            "url": burl+'/get-all-bookings',
            "type": "POST",
            "data": {status:status}
        },
        columns: [
            {data: 'index'},
            {data: 'bkdid'},
            {data: 'customer'},
            {data: 'email'},
            {data: 'room'},
            {data: 'checkin', className: 'text-center'},
            {data: 'checkout', className: 'text-center'},
            {data: 'status', className: 'text-center'},
            {data: 'actions', className: 'text-center'}
        ],
        language: {
          emptyTable: 'No '+txt+' bookings found',
          processing: '<i class="fa fa-circle-o-notch fa-spin"></i>'
        }
    });
}
$(document).ready(function() {
    refreshTable();
});
$("#bookingStatus").change(function(){
    var status = $(this).val();
    refreshTable(status);
});
//update booking status
function updateBookingStatus(newStatus,bkid) {
   swal({
    title: 'Change this booking status to '+newStatus.toUpperCase()+'?',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#4fa7f3',
    cancelButtonColor: '#d57171',
    confirmButtonText: 'Yes',
    cancelButtonText: 'No'
  }).then(function () {
       $.ajax({
            url: burl+'/bookings/update/',
            type: 'PATCH',
            data: {newStatus:newStatus,bkid:bkid},
            dataType: 'JSON',
            beforeSend: function() {
               $("#"+newStatus+"Btn_"+bkid).prop('disabled', true);
               $("#"+newStatus+"Btn_"+bkid).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
             },
            success: function (res) {
                if(res==1) {
                    refreshTable();
                    ajaxAlert('success','You have '+newStatus.toUpperCase()+' this booking successfully');
                }else {
                    ajaxAlert('error','Something went wrong. Try again');
                }
            }
        });
  });
}
</script>
@endsection