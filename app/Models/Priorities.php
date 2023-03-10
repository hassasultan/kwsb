<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Priorities extends Model
{
    use HasFactory;
    protected $table ="priorities";
    protected $fillable = [
        "title",
        "status",
    ];
    public function complaints()
    {
       return $this->hasMany(Complaints::class,'prio_id','id');
    }
}
