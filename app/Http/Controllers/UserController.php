<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  /**
   * Gets user by his id.
   *
   * @param  int  $id_user
   * @return Response
   */
  public static function getUserById($id_user)
  {
    $user = User::find($id_user);
    return $user;
  }

  

    /**
   * Update user.
   *
   * @param  Request  $request
   * @param int $id
   * @return redirect
   */
  public static function update(Request $request){

    $request->validate(array(
      'name' => 'nullable|string|max:255',
      'email' => 'nullable|string|email|max:255|unique:_user',
      'username' => 'nullable|string|max:255|unique:_user',  
      'password' => 'nullable|string|min:6|confirmed',   
      'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
    ));

    
    $user = self::getUserById($request->id);

    //Move image to public folder
    if($request->image){
      $imageName = 'user'.$request->id.'.'.$request->image->extension();
      $request->image->move(public_path('images/profile/'), $imageName);
      $img_path = '/images/profile/'.$imageName;
      $user->profile_picture = $img_path;
    }

    
    if($request->name)$user->name = ($request->name);
    if($request->email)$user->email = ($request->email);
    if($request->username)$user->username = ($request->username);
    if($request->password)$user->password = bcrypt($request->password);
    
    $user->save();
    
    return redirect('/user/'.$user->id);
  }

  public static function ban(Request $request){
    $input = $request->input();
    $user = User::find($input['id']);
    $user->is_banned = $input['ban'];
    $user->save();

    return redirect('/user/'.$user->id);
  }

  public static function checkIfBanned($id){
    $user = User::find($id);
    return $user->is_banned;
  }

      /**
   * Delete user's personal info.
   *
   * @param  Request  $request
   * @param int $id
   * @return redirect
   */
  public static function delete(Request $request){
    $user = User::find($request->id);
    $user->name = "user".$request->id;
    $user->email = "user".$request->id;
    $user->username = "user".$request->id;

    $character = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for ($i = 0; $i < 10; $i++) {
      $index = rand(0, strlen($character) - 1);
      $password .= $character[$index];
    }
    $user->password = bcrypt($password);
    $user->save();

    return redirect('logout');

  }

}
