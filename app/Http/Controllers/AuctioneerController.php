<?php

namespace App\Http\Controllers;

use App\Models\Auctioneer;
use Illuminate\Http\Request;

class AuctioneerController extends Controller
{
  /**
   * Gets auction by auction id.
   *
   * @param  int  $id_user
   * @return Response
   */
  public static function getAuctioneer($id)
  {
    $auctioneer = Auctioneer::find($id);
    return $auctioneer;
  }

  public static function create($id_user){
    $auctioneer = new Auctioneer;
    $auctioneer = $id_user;
    $auctioneer->save();
  }

}