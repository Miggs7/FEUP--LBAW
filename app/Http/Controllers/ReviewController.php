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

    public static function checkReviewed($id_bidder,$id_auctioneer){
        
        foreach(Review::all() as $review){
            if($review->author == $id_bidder && $review->id_bidder == $id_bidder && $review->id_auctioneer = $id_auctioneer){
                return true;
            }
        }
        return false;
    }

    public static function averageScore($id_user){
        $avg = 0;
        $received_reviews = ReviewController::getReceivedReviews($id_user);

        foreach($received_reviews as $reviews){
            $avg += $reviews->rating;
        }

        if(count($received_reviews) == 0) return 0;
        
        return $avg/count($received_reviews);
    }

    public static function create(Request $request){

        $request->validate(array(
          'comment' => 'required|string|max:255',
          'author' => 'required|numeric',
          'id_bidder' => 'required|numeric', 
          'id_auctioneer'=> 'required|numeric',
          'rating' => 'required|numeric',
        ));
        $review = NEW Review;
        $review->author = $request['author'];
        $review->comment = $request['comment'];
        $review->id_bidder = $request['id_bidder'];
        $review->id_auctioneer = $request['id_auctioneer'];
        $review->rating = $request['rating'];
        $review->save();
        return response()->json(['author'=>$request['author'],'comment'=>$request['comment'],'id_auctioneer'=>$request['id_auctioneer'],'rating'=>$request['rating']],200);
    }

    /*public static function update(Request $request){

        $request->validate(array(
          'comment' => 'nullable|string|max:255',
          'author' => 'required|numeric',
          'id_bidder' => 'required|numeric', 
          'id_auctioneer'=> 'required|numeric',
          'rating' => 'nullable|numeric',
        ));
        $review = NEW Review;
        $review->author = $request['author'];
        $review->comment = $request['comment'];
        $review->id_bidder = $request['id_bidder'];
        $review->id_auctioneer = $request['id_auctioneer'];
        $review->rating = $request['rating'];
        $review->save();
        return response()->json(['author'=>$request['author'],'comment'=>$request['comment'],'id_auctioneer'=>$request['id_auctioneer'],'rating'=>$request['rating']],200);
    }

    public static function delete(Request $request){

        $request->validate(array(
          'comment' => 'required|string|max:255',
          'author' => 'required|numeric',
          'id_bidder' => 'required|numeric', 
          'id_auctioneer'=> 'required|numeric',
          'rating' => 'required|numeric',
        ));
        $review = NEW Review;
        $review->author = $request['author'];
        $review->comment = $request['comment'];
        $review->id_bidder = $request['id_bidder'];
        $review->id_auctioneer = $request['id_auctioneer'];
        $review->rating = $request['rating'];
        $review->save();
        return response()->json(['author'=>$request['author'],'comment'=>$request['comment'],'id_auctioneer'=>$request['id_auctioneer'],'rating'=>$request['rating']],200);
    }*/

}