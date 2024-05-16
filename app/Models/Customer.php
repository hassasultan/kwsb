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
        "town_id",
        "sub_town_id",
        "address",
        "status",
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function town()
    {
        return $this->belongsTo(Town::class);
    }
    public function subtown()
    {
        return $this->belongsTo(SubTown::class);
    }
}
