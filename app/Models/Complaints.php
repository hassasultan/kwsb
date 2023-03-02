<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaints extends Model
{
    use HasFactory;
    protected $table ="complaint";
    protected $fillable = [
        "town_id",
        "title",
        "description",
        "image",
        "status",
        "before_image",
        "after_image",
    ];
    public function town()
    {
       return $this->belongsTo(Town::class,'town_id','id');
    }
}
