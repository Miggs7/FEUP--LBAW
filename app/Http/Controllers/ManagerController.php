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

    $request->validate(array(
      'name' => 'nullable|string|max:255',
      'email' => 'nullable|string|email|max:255|unique:manager',
      'password' => 'nullable|string|min:6|confirmed',   
      'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
    ));


    $input = $request->input();
    $manager = Manager::find($input['id']);

    if($input['name']){
        $manager->name = $input['name'];
    }
    
    if($input['password']){
        $manager->password = bcrypt($input['password']);
    }

    if($input['email']){
        $manager->email = $input['email'];
    }
    $manager->save();
    
    return redirect('/manager/'.$manager->id);
  }

}
