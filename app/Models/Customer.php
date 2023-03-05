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
        "town",
        "sub_town",
        "address",
        "status",
    ];
}
