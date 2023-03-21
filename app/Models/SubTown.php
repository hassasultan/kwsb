<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTown extends Model
{
    use HasFactory;
    protected $table = "subtown";
    protected $fillable = [
        "town_id",
        "title",
        "status",
    ];
    public function town()
    {
        return $this->belongsTo(Town::class,'town_id','id');
    }
}
