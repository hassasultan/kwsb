<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileAgent extends Model
{
    use HasFactory;
    protected $table = "mobile_agent";
    protected $fillable = [
        "user_id",
        "town_id",
        "type_id",
        "avatar",
        "description",
        "address",
        "status",
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function town()
    {
        return $this->belongsTo(Town::class,'town_id','id');
    }
    public function complaint_type()
    {
        return $this->belongsTo(ComplaintType::class,'type_id','id');
    }
    public function assignedComplaints()
    {
        return $this->hasMany(ComplaintAssignAgent::class,'agent_id','id');
    }
}
