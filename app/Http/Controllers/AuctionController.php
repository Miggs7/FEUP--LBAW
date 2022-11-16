<?php

namespace App\Http\Controllers;

use App\Models\Auction;

class AuctionController extends Controller
{
  /**
   * Gets auction by it's id.
   *
   * @param  int  $id_user
   * @return Response
   */
  public static function getAuction($id_user)
  {
    $auction = Auction::find($id_user);
    return $auction;
  }
}