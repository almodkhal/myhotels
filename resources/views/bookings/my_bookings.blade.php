@extends('layouts.common')

@section('content')
<section class="jumbotron text-center">
  <div class="container">
    <i class="page-icon fa fa-calendar-check-o"></i>
    <h1 class="jumbotron-heading mb-0">My Bookings</h1>
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
            <div class="col-sm-12">
                <table class="table table-bordered mb-0 nowrap" id="bookingsTable" cellspacing="0" width="100%" role="grid">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Booking ID</th>
                        <th>Room</th>
                        <th class="text-center">Amount</th>
                        <th class="text-center">CheckIn</th>
                        <th class="text-center">CheckOut</th>
                        <th class="text-center">Status</th>
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
            {data: 'room'},
            {data: 'amount', className: 'text-center'},
            {data: 'checkin', className: 'text-center'},
            {data: 'checkout', className: 'text-center'},
            {data: 'status', className: 'text-center'}
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
</script>
@endsection