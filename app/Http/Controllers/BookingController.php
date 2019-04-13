<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Datatables;
use Illuminate\Support\Collection;
use Auth;

class BookingController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $view = (isUser()) ? 'bookings.my_bookings' : 'bookings.management_bookings';
        return view($view);
    }

    public function getAll(Request $request) {
        $status = htmlspecialchars($request->status);
        $bookings = Booking::getBookings($status);
        $resArr = new Collection;
        if($bookings!=FALSE) {
            $i=1;
            foreach ($bookings as $book) {
                if(!isUser()) {
                    $action = '<div class="btn-group">';
                    if($book->booking_status=='pending') {
                      $action .= '<button data-toggle="tooltip" data-placement="top" title="Accept" type="button" class="btn btn-success btn-sm" id="acceptedBtn_'.$book->id.'" onclick="updateBookingStatus(\'accepted\','.$book->id.')"><i class="fa fa-check"></i></button><button data-toggle="tooltip" data-placement="top" title="Reject" type="button" class="btn btn-warning btn-sm" id="rejectedBtn_'.$book->id.'" onclick="updateBookingStatus(\'rejected\','.$book->id.')"><i class="fa fa-times"></i></button>';
                    }
                    if($book->booking_status=='accepted') {
                        $action .= '<button data-toggle="tooltip" data-placement="top" title="CheckIn" type="button" class="btn btn-info btn-sm" id="checkedinBtn_'.$book->id.'" onclick="updateBookingStatus(\'checkedin\','.$book->id.')"><i class="fa fa-sign-in"></i></button>';
                    }
                    if($book->booking_status=='checkedin') {
                        $action .= '<button data-toggle="tooltip" data-placement="top" title="CheckOut" type="button" class="btn btn-success btn-sm" id="checkedoutBtn_'.$book->id.'" onclick="updateBookingStatus(\'checkedout\','.$book->id.')"><i class="fa fa-thumbs-o-up"></i></button>';
                    }
                    if(isAdmin()) {
                        if($book->booking_status!='canceled') {
                          $action .='<button data-toggle="tooltip" data-placement="top" title="Cancel" type="button" class="btn btn-danger btn-sm" id="canceledBtn_'.$book->id.'" onclick="updateBookingStatus(\'canceled\','.$book->id.')"><i class="fa fa-ban"></i></button>';
                        }
                    }
                    $action .= '</div>';
                }

                if($book->booking_status=='pending') {
                    $date = 'Requested on: '.date('Y-m-d', strtotime($book->updated_at));
                }else {
                    $date = ucwords($book->booking_status).' on: '.date('Y-m-d', strtotime($book->updated_at));
                }
                
                $status = '<span class="badge badge-'.getLabel($book->booking_status).'">'.ucwords($book->booking_status).'</span><span class="d-block" style="font-size:12px;">'.$date.'</span>';

                if(!isUser()) {//admin or manager bookings list
                    $resArr->push([
                        'index' => $i++,
                        'bkdid' => ucwords($book->bookingID),
                        'customer' => ucwords($book->user->name),
                        'email' => $book->user->email,
                        'room' => ucwords($book->room->title),
                        'checkin' => $book->checkin_at,
                        'checkout' => $book->checkout_at,
                        'status' => $status,
                        'actions' => $action,
                    ]);
                }else {//users booking list with my_bookings
                    $resArr->push([
                        'index' => $i++,
                        'bkdid' => ucwords($book->bookingID),
                        'room' => ucwords($book->room->title),
                        'amount' => '<i class="fa fa-inr"></i> '.$book->payment_amount,
                        'checkin' => $book->checkin_at,
                        'checkout' => $book->checkout_at,
                        'status' => $status
                    ]);
                }
            }
        }
        return Datatables::of($resArr)->make(true);
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
    public function confirmBooking(Request $request){
        $room_id = htmlspecialchars($request->rid);
        $totalCost = htmlspecialchars($request->totalCost);
        $checkin = htmlspecialchars($request->checkin);
        $checkout = htmlspecialchars($request->checkout);
        //now insert into DB
        $cdate = date('Y-m-d H:i:s');
        $booking = new Booking;

        $booking->user_id = Auth::id();
        $booking->room_id = $room_id;
        $booking->checkin_at = $checkin;
        $booking->checkout_at = $checkout;
        $booking->payment_amount = $totalCost;
        $booking->created_at = $cdate;
        $booking->updated_at = $cdate;

        $booking->save();
        if($booking->id) {
            $zeroPrefix = str_repeat("0", (4 - strlen($booking->id)));
            $bkID = 'BKID-'.$zeroPrefix.$booking->id;

            $newbooking = Booking::find($booking->id);
            $newbooking->bookingID = $bkID;
            $newbooking->save();
            \Session::flash('update_success', "Congratulations! Your booking request has been sent successfully. We will get it touch with you soon");
            return response()->json(1);
        }
        //some insertion failure
         \Session::flash('update_error', "Something went wrong. Please try again");
        return response()->json(0);

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
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $bkid = htmlspecialchars($request->bkid);
        $status = htmlspecialchars($request->newStatus);

        $booking = Booking::find($bkid);
        $booking->booking_status = $status;
        $booking->updated_at = date('Y-m-d H:i:s');

        if($booking->save()) {
            return response()->json(1);
        }
        return response()->json(0);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
