<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{

    protected $table = 'auction';

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','description','starting_bid','current_bid'
    ];

    /**
     * The cards this user owns.
     */
     public function item() {
      return $this->hasOne('App\Models\Item');
    }
}