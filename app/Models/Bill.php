<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    /** @use HasFactory<\Database\Factories\BillFactory> */
    use HasFactory;
    protected $fillable = [
        'billOwner',
        'waterBill',
        'electricBill',
        'houseRentBill',
        'totalBill'
    ];

    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
