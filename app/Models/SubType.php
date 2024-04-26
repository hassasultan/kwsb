<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubType extends Model
{
    use HasFactory;
    protected $table = "sub_types";
    protected $fillable = [
        "type_id",
        "title",
    ];
    public function type()
    {
        return $this->belongsTo(ComplaintType::class,'type_id','id');
    }
    public function complaints()
    {
       return $this->hasMany(Complaints::class,'subtype_id','id');
    }
}
