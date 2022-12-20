<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model{

    protected $table = 'review';

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

}   