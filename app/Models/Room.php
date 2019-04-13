<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model {
    static function getRooms() {
        if(isGuest() || isUser()) {//users
            $rooms = self::where('status', 1)->orderBy('id', 'DESC')->get();
        }else{//admin or manager
            $rooms = self::orderBy('id', 'DESC')->get();
        }

	    if($rooms->count()>0) {
	    	return $rooms;
	    }
	    return FALSE;
	}

    public function bookings(){
        return $this->hasMany('App\Models\Booking');
    }

    public function alreadytaken($checkin,$checkout){
        $takenStatus = ['pending', 'accepted', 'checkedin'];
        return $this->hasMany('App\Models\Booking')->whereIn('booking_status', $takenStatus)->whereRaw('(checkin_at <= ? AND checkout_at >= ?)', [$checkin, $checkout])->count();

    }
}
