<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Auth;
use Carbon\Carbon;
class RoomController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {//for amanagement
        $data['rooms'] = Room::getRooms();
        return view('rooms.management_rooms')->with($data);
    }

    public function showRooms(Request $request) {//for users and guests
        if($request->isMethod('post')) {//requesting for the rooms data
            $checkin = htmlspecialchars($request->input('checkin'));
            $checkout = htmlspecialchars($request->input('checkout'));

            $roomsList = '';
            $rooms = Room::getRooms();
            if($rooms!=FALSE) {
                foreach ($rooms as $room) {
                    $currAvailability = $room->availability - $room->alreadytaken($checkin,$checkout);
                    if($currAvailability==0) {continue;}

                    $imgs = '';
                    foreach(explode(',', $room->gallery) as $img) {
                        $url = asset('/storage/uploads/rooms/'.$img);
                        $imgs .='<div class="item" style="background-image: url(\''.$url.'\');"></div>';
                    }

                    $bookBtn = (isGuest()) ? '<button type="button" class="btn btn-dark" data-toggle="modal" data-target="#accountModal">Book Now</button>' : '<button type="button" id="bookBtn_'.$room->id.'" class="btn btn-dark" onclick = "bookRoom('.$room->id.')">Book Now</button>';

                    $roomsList .= '<div class="col-md-4 col-sm-6 col-12 form-group"><div class="card"><div class="overlay">'.$bookBtn.'</div><div class="owl-carousel owl-theme room-image">'.$imgs.'</div><h4 class="room-title">'.$room->title.'</h4><h6 class="room-details">INR '.$room->rate.'/Day <span class="float-right">'.$currAvailability.' Rooms Left</span></h6><p><i class="fa fa-map-marker"></i> '.ucwords($room->location).'</p></div></div>';
                }
            }else {
                $roomsList .= '<h6>No Rooms available as of now.</h6>';
            }
            return response()->json($roomsList);

        }else {//just load the view
            $data['rooms'] = Room::getRooms();
            return view('rooms.rooms_list')->with($data);
        }
    }

    public function getRoomDetails(Request $request) {//for users and guests
        $rid = htmlspecialchars($request->input('rid'));
        $checkin = htmlspecialchars($request->input('checkin'));
        $checkout = htmlspecialchars($request->input('checkout'));

        $gallery = ''; $roomDetail = '';

        $room = Room::find($rid);//getting the request room detail
        //making the carousel gallery
        $gallery .= '<div class="owl-carousel owl-theme detail-image">';
        foreach(explode(',', $room->gallery) as $img) {
            $url = asset('/storage/uploads/rooms/'.$img);
            $gallery .='<div class="item" style="background-image: url(\''.$url.'\');"></div>';
        }
        $gallery .= '</div>';
        //calculating no of days of booking
        $d1 = Carbon::parse($checkin);
        $d2 = Carbon::parse($checkout);
        $noOfDays = $d2->diffInDays($d1);
        $totalCost = number_format(($room->rate*$noOfDays),2);
        //making the right side detail section
        $roomDetail .= '<h5 class="text-center mb-3">Book Room</h5><h4 class="mb-0">'.strtoupper($room->title).'</h4><p><i class="fa fa-map-marker"></i> '.ucwords($room->location).'</p><div class="row"><div class="col-md-6 col-12 form-group"><label class="control-label">CheckIn:</label><h6><i class="fa fa-calendar labelicon"></i> '.$checkin.'</h6></div><div class="col-md-6 col-12 form-group"><label class="control-label">CheckOut:</label><h6><i class="fa fa-calendar labelicon"></i> '.$checkout.'</h6></div><div class="col-md-12 form-group"><label class="control-label" style="margin-bottom: -5px;">Payment Amount:</label><h6><i class="fa fa-inr labelicon"></i> '.$room->rate.'/night x '.$noOfDays.' = <span class="totalamount">'.$totalCost.'/- only</span></h6></div><div class="col-md-12 text-right"><button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button><button type="button" onclick = confirmBooking('.$room->id.',\''.$totalCost.'\',\''.$checkin.'\',\''.$checkout.'\') class="btn btn-login" id="confirmBtn_'.$room->id.'">Book Now</button></div></div>';

            return response()->json(['gallery' => $gallery, 'details' => $roomDetail]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $destPath = storage_path('app/public/uploads/rooms');

        $title = htmlspecialchars($request->input('roomTitle'));
        $location = htmlspecialchars($request->input('roomLocation'));
        $rate = htmlspecialchars($request->input('roomRate'));
        $availability = htmlspecialchars($request->input('roomAvailability'));
        $status = htmlspecialchars($request->input('roomStatus'));
        $attachments = $request->file('attachments');

        //server validation
        if($title=='' || $location=='' || $rate=='' || $availability=='') {
            return redirect()->back()->with('update_error', config('constants.someWrong'));
        }

        $slug = create_slug($title);
        
        if($attachments!='' && count($attachments)>0) {
            $fileNames = array();
            foreach ($attachments as $file) {
                $ext = strtolower($file->getClientOriginalExtension());
                //server validation for each image
                $allowed_files = ["jpg", "jpeg", "png"];
                if($file =='' || !in_array($ext, $allowed_files)) {
                  return redirect()->back()->with('update_error', 'Invalid file type choosen for gallery');
                }
                $fname = strtolower($slug.'_'.count($fileNames).'_'.time().'.'.$ext);
                $file->move($destPath, $fname);
                $fileNames[] = $fname;
            }
        }else {
            $fileNames = array('default.jpg');
        }
        //now insert into databse
        $cdate = date('Y-m-d H:i:s');

        $room = new Room;
        $room->title = $title;
        $room->rate = $rate;
        $room->location = $location;
        $room->availability = $availability;
        $room->gallery = implode(',', $fileNames);
        $room->added_by = Auth::id();
        $room->status = $status;
        $room->created_at = $cdate;
        $room->updated_at = $cdate;
        
        $room->save();
        if($room->id) {
            return redirect('rooms')->with('update_success', 'Room added successfully');
        }
        //some insertion failure
        return redirect('rooms')->with('update_error', config('constants.someWrong'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $room = Room::find($id);
        $images = explode(',', $room->gallery);
        $imageLists = '';
        foreach ($images as $file) {
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            $bgImg = asset('/storage/uploads/rooms/'.$file);

            $imageLists .= '<div class="fileSelectors col-md-4" style="background-image:url(\''.$bgImg.'\')"><div class="row justify-content-center"><div class="col-10"><button type="button" class="btn btn-success btn-sm w-100 updBtn">Change File</button></div><div class="col-2 removeImgCol"><button type="button" class="btn btn-danger btn-sm w-100 removeBtn"><i class="fa fa-times"></i></button></div><input type="file" class="d-none updInput" name="attachments[]"><input type="hidden" class="selectedFiles" name="selectedFiles[]" value="'.$file.'"></div></div>';
        }
        return response()->json($imageLists);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $destPath = storage_path('app/public/uploads/rooms');

        $rid = htmlspecialchars($request->input('roomID'));
        $title = htmlspecialchars($request->input('roomTitle'));
        $location = htmlspecialchars($request->input('roomLocation'));
        $rate = htmlspecialchars($request->input('roomRate'));
        $availability = htmlspecialchars($request->input('roomAvailability'));
        $status = htmlspecialchars($request->input('roomStatus'));
        $attachments = $request->file('attachments');
        $selectedFiles = $request->input('selectedFiles');

        //server validation
        if($rid=='' || $title=='' || $location=='' || $rate=='' || $availability=='') {
            return redirect()->back()->with('update_error', config('constants.someWrong'));
        }

        $slug = create_slug($title);
        if($selectedFiles!='') {
            $fileNames = array_diff($selectedFiles, ["1", ""]);//extracting only the filenames
        }else {
            $fileNames = array();
        }

        $oldData = Room::find($rid);
        //remove not selected images
        $oldFiles = $oldData->gallery;

        $oldFiles = explode(',', $oldFiles);
        $filesToRemove = array_diff($oldFiles,$fileNames);
        foreach ($filesToRemove as $rmFile) {
            if(file_exists($destPath.'/'.$rmFile)) {//deleting old gallery image
               @unlink($destPath.'/'.$rmFile);
            }
        }
        //upload the new images
        if($attachments!='' && count($attachments)>0) {
            foreach ($attachments as $file) {
                $ext = strtolower($file->getClientOriginalExtension());
                //server validation for each image
                $allowed_files = ["jpg", "jpeg", "png"];
                if($file =='' || !in_array($ext, $allowed_files)) {
                    return redirect()->back()->with('update_error', 'Invalid file type choosen for gallery image');
                }
                $fname = strtolower($slug.'_'.count($fileNames).'_'.time().'.'.$ext);
                $file->move($destPath, $fname);
                $fileNames[] = $fname;
            }
        }
        if(count($fileNames)==0) {//if no images selected while editting
            $fileNames = array('default.jpg');
        }
        //now update into databse
        $cdate = date('Y-m-d H:i:s');

        $room = Room::find($rid);
        $room->title = $title;
        $room->rate = $rate;
        $room->location = $location;
        $room->availability = $availability;
        $room->gallery = implode(',', $fileNames);
        $room->status = $status;
        $room->updated_at = $cdate;
        if($room->save()) {
            return redirect('rooms')->with('update_success', 'Room updated successfully');
        }
        //some insertion failure
        return redirect('rooms')->with('update_error', config('constants.someWrong'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $room = Room::find($id);
        if(count($manager->rooms)==0){//no rooms good to delete
            if($manager->delete()) {
                return response()->json(1);//deleted
            }
            return response()->json(0);//coudn't delete
        }
        return response()->json(2);//can't delete as there is a room creation
    }
}
