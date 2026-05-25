<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    //
    protected $fillable = [
        'medicine_name',
        'stock_quantity',
        'expiration_date',
        'unit'
    ];
    public function inventoryLogs()
    {
        return $this->hasMany(InventoryLog::class);
    }
}
