@extends('layouts.common')
@section('content')
<section class="jumbotron text-center">
  <div class="container">
    <i class="page-icon fa fa-bed"></i>
    <h1 class="jumbotron-heading mb-0">Rooms</h1>
    @if(isAdmin())
    <ol class="breadcrumb justify-content-center mb-2">
        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Rooms</li>                      
    </ol>
    @endif
    <button type="button" class="btn btn-primary btn-rounded waves-light waves-effect" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Add Room</button>
  </div>
</section>

<div class="content-body text-muted">
    <div class="container">
        <div class="row justify-content-center">
            @if($rooms!=FALSE)
              @foreach($rooms as $room)
                <div class="col-md-4 col-sm-6 col-12 form-group">
                    <div class="card">
                        @if(isAdmin())
                        <div class="btn-group">
                            <button type="button" id="dltBtn_{{$room->id}}" class="btn btn-danger" onclick="removeRoom('{{$room->id}}')"><i class="fa fa-trash"></i></button>
                            <button type="button" class="btn btn-info" onclick="editRoom('{{$room->id}}','{!!ucwords($room->title)!!}','{!!$room->title!!}','{!!$room->location!!}','{{$room->rate}}','{{$room->availability}}','{{$room->status}}')"><i class="fa fa-edit"></i></button>
                        </div>
                        @endif
                        <div class="owl-carousel owl-theme room-image">
                            @foreach(explode(',', $room->gallery) as $img)
                            <div class="item" style="background-image: url('{{ asset('/storage/uploads/rooms/'.$img) }}');"></div>
                            @endforeach
                        </div>
                        <h4 class="room-title">{!!$room->title!!}</h4>
                        <h6 class="room-details">INR {{$room->rate}}/Day 
                            <span class="float-right">{{$room->availability}} Rooms</span></h6>
                        <p><i class="fa fa-map-marker"></i> {!!$room->location!!} 
                            <span class="float-right">
                                @if($room->status==1)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </span></p>
                    </div>
                </div>
              @endforeach
            @else
             <h6>No Rooms available. <a href="javascript:;" data-toggle="modal" data-target="#addModal">Add Now</a></h6>
            @endif
        </div>
    </div>
<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="somthig" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New Room</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <i class="fa fa-times"></i>
        </button>
      </div>
    <form id="addForm" method="POST" action="{{ url('rooms') }}" enctype="multipart/form-data">
      @csrf
      <div class="modal-body">
           <div class="row justify-content-center">
            <div class="col-md-12">
                <section>
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-12 form-group">
                            <label class="control-label mandatory">Room Title</label>
                            <input type="text" class="form-control" id="roomTitle" name="roomTitle">
                        </div>
                        <div class="col-md-8 col-12 form-group">
                            <label class="control-label mandatory">Location</label>
                            <input type="text" class="form-control" id="roomLocation" name="roomLocation">
                        </div>
                        <div class="col-md-4 col-12 form-group">
                            <label class="control-label mandatory">Rate(Per Night)</label>
                            <input type="number" class="form-control" id="roomRate" name="roomRate">
                        </div>
                        <div class="col-md-6 col-12 form-group">
                            <label class="control-label mandatory">Availability (No.s)</label>
                            <input type="number" class="form-control" id="roomAvailability" name="roomAvailability">
                        </div>
                        <div class="col-md-6 col-12 form-group">
                            <label class="control-label mandatory">Status</label>
                            <select class="form-control" name="roomStatus">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="control-label d-block">Images (png, jpg, jpeg) <a class="float-right" id="addAttachmentBtn" href="javascript:;"><i class="fa fa-link"></i> Add Images</a> </label> 
                            <span class="" id="filesList">
                                <!-- Attachement list via Jquery -->
                            </span>
                        </div>
                    </div>
                </section>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" id="addBtn" class="btn btn-primary btn-sm">Add Room</button>
      </div>
    </form>
    </div>
  </div>
</div>
@if(isAdmin())
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="someOtherModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <i class="fa fa-times"></i>
        </button>
      </div>
    <form id="editForm" action="{{ url('rooms/update') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <input type="hidden" name="roomID" id="roomID" value="">
      <div class="modal-body">
           <div class="row justify-content-center">
                <div class="col-md-12">
                    <section>
                        <div class="row justify-content-center">
                            <div class="col-md-12 col-12 form-group">
                                <label class="control-label mandatory">Room Title</label>
                                <input type="text" class="form-control" id="editRoomTitle" name="roomTitle">
                            </div>
                            <div class="col-md-8 col-12 form-group">
                                <label class="control-label mandatory">Location</label>
                                <input type="text" class="form-control" id="editRoomLocation" name="roomLocation">
                            </div>
                            <div class="col-md-4 col-12 form-group">
                                <label class="control-label mandatory">Rate(Per Night)</label>
                                <input type="number" class="form-control" id="editRoomRate" name="roomRate">
                            </div>
                            <div class="col-md-6 col-12 form-group">
                                <label class="control-label mandatory">Availability (No.s)</label>
                                <input type="number" class="form-control" id="editRoomAvailability" name="roomAvailability">
                            </div>
                            <div class="col-md-6 col-12 form-group">
                                <label class="control-label mandatory">Status</label>
                                <select class="form-control" id="editRoomStatus" name="roomStatus">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="control-label d-block">Images (png, jpg, jpeg) <a class="float-right" id="editAttachmentBtn" href="javascript:;"><i class="fa fa-link"></i> Add Images</a> </label> 
                                <span id="editfilesList">
                                    <!-- Attachement list via Jquery -->
                                </span>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" id="editBtn" class="btn btn-primary btn-sm">Update Room</button>
      </div>
    </form>
    </div>
  </div>
</div>
@endif
<script type="text/javascript">
//delete room
@if(isAdmin())
function removeRoom(id) {
   swal({
    title: 'Delete this Room?',
    text: 'This will remove the room',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#4fa7f3',
    cancelButtonColor: '#d57171',
    confirmButtonText: 'Delete'
  }).then(function () {
       $.ajax({
            url: burl+'/rooms/'+id,
            type: 'DELETE',
            dataType: 'JSON',
            beforeSend: function() {
               $("#dltBtn_"+id).prop('disabled', true);
               $("#dltBtn_"+id).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
             },
            success: function (res) {
                if(res==1) {
                    refreshTable();
                    ajaxAlert('success','This Room has been deleted successfully');
                }else {
                    ajaxAlert('error','Something went wrong. Try again');
                }
            }
        });
  });
}
@endif
$("#addAttachmentBtn").click(function(){
    $('#filesList .fileSelectors:last-child').css('borderColor','#fff');
    var last = $('#filesList .fileSelectors:last-child').find('input.updInput').val();
    if(last==undefined || (last!=undefined && last!='')) {
        var updInpForm = '<div class="fileSelectors col-md-4"><div class="row justify-content-center"><div class="col-10"><button type="button" class="btn btn-success btn-sm w-100 updBtn">Choose File</button></div><div class="col-2 removeImgCol"><button type="button" class="btn btn-danger btn-sm w-100 removeBtn"><i class="fa fa-times"></i></button></div><input type="file" class="d-none updInput" name="attachments[]" accept="image/*"></div></div>';
        $("#filesList").append(updInpForm);
    }else {
        notify('Utilise this option first');
        $('#filesList .fileSelectors:last-child').css('borderColor','#e83c4d');
    }
});
$(document).on('click','.updBtn',function(e) {
    var thisParent = $(this).closest('.fileSelectors');
    thisParent.css('borderColor','#fff');
    thisParent.find('input.updInput').trigger('click');
});
$(document).on('click','.removeBtn',function(e) {
    var thisParent = $(this).closest('.fileSelectors').remove();
});
//display selected img prior upload
$(document).on('change','.updInput',function(e) {
    var fname = this.files[0].name;
    var fileType = (fname.substr((fname.lastIndexOf('.') + 1))).toLowerCase();

    var thisParent = $(this).closest('.fileSelectors');
    if(this.files && this.files[0]) {
      var validTypes = ["jpg", "jpeg", "png"];
      if($.inArray(fileType, validTypes) < 0) {//unsupported
         notify('Only jpeg, jpg, png files allowed');
         thisParent.remove();
      }
      else {//image file is supported
        thisParent.css('borderColor','#fff');
      }
      var reader = new FileReader();
      reader.onload = function(e) {
        if(fileType=='jpg' || fileType=='jpeg' || fileType=='png') {
            thisParent.css("background-image", "url("+e.target.result+")");  
        }else {
            thisParent.css("background-image", "");
        }
      }
      reader.readAsDataURL(this.files[0]);
    }
    thisParent.find('.updBtn').html('Change File');
    thisParent.find('.selectedFiles').val('1');
});
$("#addForm").submit(function(){
  var roomTitle = $("#roomTitle").val();
  var roomLocation = $("#roomLocation").val();
  var roomRate = $("#roomRate").val();
  var roomAvailability = $("#roomAvailability").val();
  if(!nullValidate(roomTitle,'roomTitle','Enter a title or name for the new room')) {
    return false;
  }
  if(!nullValidate(roomLocation,'roomLocation','Enter the locaiton or city')) {
    return false;
  }
  if(!nullValidate(roomRate,'roomRate','Type in a price for the room per night (INR)')) {
    return false;
  }
  if(!nullValidate(roomAvailability,'roomAvailability','How many such rooms available?')) {
    return false;
  }
  return true;
});
//edit section
@if(isAdmin())
function editRoom(rid,rTitle,title,location,rate,availability,status) {
    $('#editfilesList').html('');
    $('#roomID').val(rid);
    $('#editModalTitle').html('Edit Room <span>'+rTitle+'</span>');
    $('#editRoomTitle').val(title);
    $('#editRoomLocation').val(location);
    $('#editRoomRate').val(rate);
    $('#editRoomAvailability').val(availability);
    $('#editRoomStatus').val(status);
    //getting the images lists
    $.ajax({
        aysnc:false,
        url: burl+'/rooms/'+rid+'/edit',
        type: 'GET',
        dataType: 'JSON',
        success: function (res) {
            $('#editfilesList').html(res);
        }
    });
    $('#editModal').modal('show');
}
$(document).on('click','#editAttachmentBtn',function(e) {
    $('#editfilesList .fileSelectors:last-child').css('borderColor','#fff');
    var last = $('#editfilesList .fileSelectors:last-child').find('input.selectedFiles').val();
    if(last==undefined || (last!=undefined && last!='')) {
        var updInpForm = '<div class="fileSelectors col-md-4"><div class="row justify-content-center"><div class="col-10"><button type="button" class="btn btn-success btn-sm w-100 updBtn">Choose File</button></div><div class="col-2 removeImgCol"><button type="button" class="btn btn-danger btn-sm w-100 removeBtn"><i class="fa fa-times"></i></button></div><input type="file" class="d-none updInput" name="attachments[]"><input type="hidden" class="selectedFiles" name="selectedFiles[]" value=""></div></div>';
        $("#editfilesList").append(updInpForm);
    }else {
        notify('Utilise this option first');
        $('#editfilesList .fileSelectors:last-child').css('borderColor','#e83c4d');
    }
});

$("#editForm").submit(function(){
  var roomTitle = $("#editRoomTitle").val();
  var roomLocation = $("#editRoomLocation").val();
  var roomRate = $("#editRoomRate").val();
  var roomAvailability = $("#editRoomAvailability").val();
  if(!nullValidate(roomTitle,'editRoomTitle','Enter a title or name for the new room')) {
    return false;
  }
  if(!nullValidate(roomLocation,'editRoomLocation','Enter the locaiton or city')) {
    return false;
  }
  if(!nullValidate(roomRate,'editRoomRate','Type in a price for the room per night (INR)')) {
    return false;
  }
  if(!nullValidate(roomAvailability,'editRoomAvailability','How many such rooms available?')) {
    return false;
  }
  return true;
});
@endif
</script>
@endsection