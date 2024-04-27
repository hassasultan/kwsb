<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        "customer_id",
        "customer_name",
        "phone",
        "town",
        "sub_town",
        "address",
        "status",
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
