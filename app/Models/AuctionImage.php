<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuctionImage extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  protected $table = 'auction_image';

  /**
   * The user this card belongs to
   */
  public function auction() {
    return $this->belongsTo('App\Models\Auction');
  }
}
