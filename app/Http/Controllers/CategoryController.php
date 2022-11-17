<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  /**
   * Gets category by its id.
   *
   * @param  int  $id
   * @return Response
   */
  public static function getCategoryById($id){

    $category = Category::find($id);
    return $category;
  }

}