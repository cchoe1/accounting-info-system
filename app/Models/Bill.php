<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    //
    protected $table = "Bills";
    public $primaryKey = 'bill_id'; 
}
