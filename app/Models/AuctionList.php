<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuctionList extends Model
{

    protected $table = 'auction_list';

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    public function auctions(){
        return $this->hasMany('id_auctioneer');
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

}   