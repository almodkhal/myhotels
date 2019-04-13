<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Booking extends Model {

	static function getBookings($status=null) {
    	if(!isUser()){//admin or manager
    		if($status==null){
	    		$bookings = self::orderBy('id', 'DESC')->get();
    		}else {
    			$bookings = self::where('booking_status',$status)->orderBy('id', 'DESC')->get();
    		}
    	}else {//users => my_bookings+
            if($status==null){
                $bookings = self::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();
            }else {
                $bookings = self::where('user_id', Auth::id())->where('booking_status',$status)->orderBy('id', 'DESC')->get();
            }
    	}
	    if($bookings->count()>0) {
	    	return $bookings;
	    }
	    return FALSE;
	}
    
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function room() {
        return $this->belongsTo('App\Models\Room');
    }
}
