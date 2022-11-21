<?php

namespace App\Http\Controllers;

use App\Models\AuctionCategory;
use Illuminate\Http\Request;

class AuctionCategoryController extends Controller
{
  /**
   * Gets auction by auction id.
   *
   * @param  int  $id_user
   * @return Response
   */
  public static function getAuctionCategoryId($id_auction)
  {
    $category = AuctionCategory::find($id_auction);
    return $category->id_category;
  }

  public static function create($id_category,$id_auction){
    $auction_category = new AuctionCategory;
    $auction_category->id_auction = $id_auction;
    $auction_category->id_category = $id_category;
    $auction_category->save();
  }

}