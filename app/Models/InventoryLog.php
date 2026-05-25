<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryLog extends Model
{
    //
    protected $fillable = [
        'medicine_id',
        'quantity',
        'type'
    ];
}
