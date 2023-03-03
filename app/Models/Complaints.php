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
        "type_id",
        "title",
        "description",
        "customer_name",
        "phone",
        "email",
        "image",
        "status",
        "before_image",
        "after_image",
    ];
    public function town()
    {
       return $this->belongsTo(Town::class,'town_id','id');
    }
    public function type()
    {
       return $this->belongsTo(ComplaintType::class,'type_id','id');
    }
}
