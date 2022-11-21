<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuctionCategory extends Model
{

    protected $table = 'auction_category';

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*protected $fillable = [
        'name','description','starting_bid','current_bid'
    ];*/
}