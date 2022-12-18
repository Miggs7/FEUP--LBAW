<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model{

    protected $table = 'payment';

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

}   