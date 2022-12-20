<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
  /**
   * Gets reviews by author id.
   *
   * @param  int  $id_user
   * @return array
   */
    public static function getAuthorReviews($id_user){
        $reviews = array();
        foreach(Review::all() as $review){
            if($review->author == $id_user){
                $reviews[] = $review;
            }
        }
        return $reviews;
    }

    /**
     * Gets reviews given to author
     * @param  int  $id_user
     * @return array
     */
    public static function getReceivedReviews($id_user){
        $reviews = array();
        foreach(Review::all() as $review){
            if(($review->author != $id_user) && ($review->id_bidder == $id_user || $review->id_auctioneer == $id_user)){
                $reviews[] = $review;
            }
        }
        return $reviews;
    }

    public static function create(Request $request){

        $request->validate(array(
          'comment' => 'required|string|max:255',
          'author' => 'required|numeric',
          'id_bidder' => 'required|numeric', 
          'id_auctioneer'=> 'required|numeric',
          'review_time' => 'required|date'
        ));
        $bid = NEW Review;
        
    }

}