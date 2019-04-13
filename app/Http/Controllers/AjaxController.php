<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller {

    public function checkExist(Request $request){
    	$value = htmlspecialchars($request->value);
    	$field = htmlspecialchars($request->field);
      
      if(checkExist($value,$field)){
         $exist = 1;
		  }else {
         $exist = 0;
      }
    	return response()->json($exist);
   }
}
