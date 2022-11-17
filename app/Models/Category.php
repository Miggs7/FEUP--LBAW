<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  // Don't add create and update timestamps in database.
  protected $table = 'category';
  public $timestamps  = false;

  public function auctions() {
    return $this->hasMany('App\Models\Auction');
  }
}