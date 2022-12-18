<?php

namespace App\Http\Controllers;

use App\Models\WatchList;
use Illuminate\Http\Request;

class WatchListController extends Controller
{
  /**
   * Get all auctions watched by the bidder.
   *
   * @param  int  $id_bidder
   * @return array
   */
  public static function getBidderWatchList($id_bidder)
  {
    $watch_list = array();
    foreach(WatchList::all() as $auctions){
        if($auctions->id_bidder == $id_bidder){
            $watch_list[] = $auctions;
        }
    }
    return $watch_list;
  }

   /**
   * Add auctions to be watchedwatched by the bidder.
   *
   * @param  int  $id_auction
   * @param int $id_bidder
   * @return Response
   */
  public static function addToWatchList(Request $r){

    $r->validate(array(
      'id_bidder' => 'required|numeric',
    ));

    $input = $r->all();
    $watch_list = new WatchList;
    $watch_list->id_auction = $input['id_auction'];
    $watch_list->id_bidder = $input['id_bidder'];
    $watch_list->save();
    return redirect('/auction/'.$input['id_auction']);
  }

     /**
   * Add auctions to be watchedwatched by the bidder.
   *
   * @param  int  $id_auction
   * @param int $id_bidder
   * @return Redirect
   */
  public static function removeFromWatchList(Request $r){
    $input = $r->all();
    $id_auction = $input['id_auction'];
    $id_bidder = $input['id_bidder'];
    foreach(WatchList::all() as $auction){
        if($auction->id_auction == $id_auction && $auction->id_bidder == $id_bidder){
            $auction->delete();
        }
    }
    return redirect('/auction/'.$input['id_auction']);
  }

    /**
   * Check if auction is on WatchList
   *
   * @param  int  $id_auction
   * @param int $id_bidder
   * @return boolean
   */
  public static function isOnWatchList($id_auction,$id_bidder){
    foreach(WatchList::all() as $auction){
        if($auction->id_auction == $id_auction && $auction->id_bidder == $id_bidder){
            return true;
        }
    }
    return false;
  }
  
}