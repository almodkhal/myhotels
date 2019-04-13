<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Datatables;
use Illuminate\Support\Collection;

class ManagerController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('managers.managers');
    }

    public function getAll() {
        $managers = User::where('role','manager')->orderBy('id','DESC')->get();
        $managersArr = new Collection;
        if($managers!='') {
            $i=1;
            foreach ($managers as $man) {
                $action = '<button type="button" class="btn btn-danger btn-sm" id="dltBtn_'.$man->id.'" onclick="deleteFn('.$man->id.')"><i class="fa fa-trash-o"></i></button></div>';
                $status = ($man->status==1) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
                $managersArr->push([
                    'index' => $i++,
                    'name' => ucwords($man->name),
                    'email' => $man->email,
                    'username' => $man->username,
                    'status' => $status,
                    'action' => $action
                ]);
            }
        }
        return Datatables::of($managersArr)->make(true);
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
    public function store(Request $request){
        $name = htmlspecialchars($request->input('name'));
        $email = htmlspecialchars($request->input('email'));
        $username = htmlspecialchars($request->input('username'));
        $password = htmlspecialchars($request->input('password'));
        $status = htmlspecialchars($request->input('status'));

        //server validation
        if($name=='' || $email=='' || !filter_var($email, FILTER_VALIDATE_EMAIL) || checkExist($email,'email') || $username=='' || checkExist($username,'username') || $password=='' || ($status!=0 && $status!=1) ) {
            return response()->json(0);
        }
        //now insert into database
        $cdate = date('Y-m-d H:i:s');
        $user = new User;

        $user->name = $name;
        $user->email = $email;
        $user->username = $username;
        $user->password = Hash::make($password);
        $user->role = 'manager';
        $user->status = $status;
        $user->created_at = $cdate;
        $user->updated_at = $cdate;

        $user->save();
        if($user->id) {//insert success
            return response()->json(1);
        }
        return response()->json(0);//some insertion failure
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $manager = User::find($id);
        if(count($manager->rooms)==0){//no rooms good to delete
            if($manager->delete()) {
                return response()->json(1);//deleted
            }
            return response()->json(0);//coudn't delete
        }
        return response()->json(2);//can't delete as there is a room creation
    }
}
