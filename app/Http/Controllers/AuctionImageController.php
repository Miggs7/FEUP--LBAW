<?php

namespace App\Http\Controllers;

use App\Models\AuctionImage;

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
    $image = AuctionImage::find($id_auction);
    return $image;
  }

}