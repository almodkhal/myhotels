<?php $__env->startSection('content'); ?>
<section class="jumbotron text-center">
  <div class="container">
    <i class="page-icon fa fa-bed"></i>
    <h1 class="jumbotron-heading mb-0">Welcome to MyHotels</h1>
    <p>Exclusive Deals, Central Locations! Search & Book Cheap Hotels Online. Travel Guides. No Cancellation Fees. Price Guarantee. Photos & Reviews. Guest Reviews. Luxury Hotels.</p>
  </div>
</section>

<div class="content-body text-muted">
    <div class="container">
        <form id="searchRoomForm" method="POST" action="javascript:;" autocomplete="off">
        <div class="row justify-content-start form-group" style="background: #f1b504;padding: 10px;">
            <div class="col-md-4 col-6 sameLine">
                <label class="control-label">CheckIn:</label>
                <input type="text" class="form-control datepicker" id="checkinDate" value="<?php echo e(date('Y-m-d')); ?>">
            </div>
            <div class="col-md-4 col-6 sameLine">
                <label class="control-label">CheckOut:</label>
                <input type="text" class="form-control datepicker" id="checkoutDate" value="<?php echo e(date('Y-m-d', strtotime('tomorrow'))); ?>">
            </div>
            <div class="col-md-4 col-6">
                <button type="submit"  id="searchBtn" class="btn btn-light">Search <i class="fa fa-search"></i></button>
            </div>
        </div>
        </form>
        <div class="row justify-content-center" id="roomsList">
           
        </div>
    </div>
<?php if(isUser()): ?>
<!-- Room Booking Modal -->
<div class="modal fade bd-example-modal-lg bigModal" id="bookModal" tabindex="-1" role="dialog" aria-labelledby="somthing" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <i class="fa fa-times-circle"></i>
      </button>
   <div class="row login-page">
        <div class="col-md-6 m-c p-0" id="leftGallery">
          
        </div>
        <div class="col-md-6 login-right m-c" style="padding:30px 15px; ">
            
            <div class="alert alert-success modalAlrt" id="Modalsuccess"></div>
            <div class="alert alert-error modalAlrt" id="Modalerror"></div>

            <div class="login-section book-section" id="rightDetails">
              <!-- room details from AJAX -->
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
<script src="<?php echo e(asset('/plugins/moment/moment.js')); ?>" type="text/javascript"></script>
<script type="text/javascript">
function bookRoom(rid){
    var checkin = $('#checkinDate').val();
    var checkout = $('#checkoutDate').val();
    $.ajax({
        async:false,
        url: burl+'/get-room-details',
        type: 'POST',
        data:{rid:rid,checkin:checkin,checkout:checkout},
        dataType: 'JSON',
        beforeSend: function() {
           $("#bookBtn_"+rid).html('<i class="fa fa-circle-o-notch fa-spin"></i> Loading Details');
        },
        success: function (res) {
          $("#leftGallery").html(res.gallery);
          $('.detail-image').owlCarousel({center: true,items:1,loop:true,margin:10,nav:false,dots:false,    autoplay:true,autoplayTimeout:3000});
          $("#rightDetails").html(res.details);
          $("#bookBtn_"+rid).html('Book Now');
          $('#bookModal').modal('show');
        }
    });
}

function confirmBooking(rid,totalCost,checkin,checkout){
    $.ajax({
        async:false,
        url: burl+'/confirm-booking',
        type: 'POST',
        data:{rid:rid,totalCost:totalCost,checkin:checkin,checkout:checkout},
        dataType: 'JSON',
        beforeSend: function() {
            $("#confirmBtn_"+rid).prop('disabled', true);
            $("#confirmBtn_"+rid).html('<i class="fa fa-circle-o-notch fa-spin"></i> Booking');
        },
        success: function (res) {
           if(res==1) {
              $("#confirmBtn_"+rid).html('<i class="fa fa-check"></i> Booking Confirmed');
              setTimeout(function(){
                 window.location.href = burl+'/my-bookings';
              }, 1000);
           }else {
              window.location.href = burl;
           }
        }
    });
}

$(".datepicker").datepicker({  minDate: new Date() });

function refreshRoomsList() {//get the manufacturer data over ajax
    $('#roomsList').html('');
    var checkin = $('#checkinDate').val();
    var checkout = $('#checkoutDate').val();
    $.ajax({
        url: burl+'/',
        type: 'POST',
        data:{checkin:checkin,checkout:checkout},
        dataType: 'JSON',
        beforeSend: function() {
           $("#roomsList").html('<div><i class="fa fa-circle-o-notch fa-spin"></i> Loading Rooms...</div>');
        },
        success: function (res) {
            $("#roomsList").html(res);
            $('.room-image').owlCarousel({center: true,items:1,loop:true,margin:10,nav:false,dots:false,    autoplay:true,autoplayTimeout:3000});
        }
    });
}
$(document).ready(function() {
    refreshRoomsList();
});
$("#searchRoomForm").submit(function(){
  var from = $('#checkinDate').val();
  var to = $("#checkoutDate").val();
  if(from!='' && to!='') {
    var startDate = moment(from, "YYYY.MM.DD");
    var endDate = moment(to, "YYYY.MM.DD");
    var diffs = parseInt(endDate.diff(startDate, 'days'));
    if(diffs<0) {
        notify('CheckOut date should be larger than Checkin date');
        $('#checkinDate').focus();
        return false;
    }else {
      refreshRoomsList();
    }
  }else {
    notify('Enter both CheckIn and CheckOut dates');return false;
  }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>