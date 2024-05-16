<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    use HasFactory;
    protected $table = "towns";
    protected $fillable = [
        "district_id",
        "town",
        "subtown",
        "status",
    ];
    public function agents()
    {
        return $this->hasMany(MobileAgent::class,'town_id','id');
    }
    public function district()
    {
        return $this->belongsTo(District::class,'district_id','id');
    }
    public function complaints()
    {
        return $this->hasMany(Complaints::class,'town_id','id');
    }
    public function comp_type()
    {
        return $this->belongsToMany(
            ComplaintType::class,
            Complaints::class,
            'town_id',
            'type_id',
        );
    //    return $this->hasMany(Complaints::class,'type_id','id');
    }
}
