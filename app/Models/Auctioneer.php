<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auctioneer extends Model
{

    protected $table = 'auctioneer';

    // Don't add create and update timestamps in database.
    public $timestamps  = false;
}