<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WatchList extends Model
{

    protected $table = 'watch_list';

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    public function auctions(){
        return $this->hasMany('id_auctioneer');
    }

}   