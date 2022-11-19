<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
  /**
   * Gets user by his id.
   *
   * @param  int  $id_user
   * @return Response
   */
  public static function getManagerById($id_manager)
  {
    $manager = Manager::find($id_manager);
    return $manager;
  }

    /**
   * Update user.
   *
   * @param  Request  $request
   * @return redirect
   */
  public static function updateManager(Request $request){

    $input = $request->input();
    $manager = Manager::find($input['id']);

    if($input['name']){
        $manager->name = $input['name'];
        $manager->save();
    }
    
    if($input['password']){
        $manager->password = bcrypt($input['password']);
        $manager->save();
    }

    if($input['email']){
        $manager->email = $input['email'];
        $manager->save();
    }
    
    return redirect('/manager/'.$manager->id);
  }

}
