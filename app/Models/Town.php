<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    use HasFactory;
    protected $table = "towns";
    protected $fillable = [
        "town",
        "subtown",
        "status",
    ];
    public function agents()
    {
        return $this->hasMany(MobileAgent::class,'town_id','id');
    }
    public function complaints()
    {
        return $this->hasMany(Complaints::class,'town_id','id');
    }
}
