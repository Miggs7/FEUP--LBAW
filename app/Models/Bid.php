<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{

    protected $table = 'bid';

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

}   