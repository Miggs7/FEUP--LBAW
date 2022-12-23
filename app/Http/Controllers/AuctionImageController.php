<?php

namespace App\Http\Controllers;

use App\Models\AuctionImage;
use Illuminate\Http\Request;

class AuctionImageController extends Controller
{
  /**
   * Gets auction by auction id.
   *
   * @param  int  $id_user
   * @return Response
   */
  public static function getAuctionImage($id_auction)
  {
    foreach(AuctionImage::all() as $image){
      if($image->id_auction == $id_auction)
        return $image;
    }
  }

  public static function create($link,$id_auction){
    $image = new AuctionImage;
    $image->link = $link;
    $image->id_auction = $id_auction;
    $image->save();
  }

}