<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintAssignAgent extends Model
{
    use HasFactory;
    protected $table ="complaint_assign_agent";
    protected $fillable = [
        "complaint_id",
        "agent_id",
        "status",
    ];
    public function agents()
    {
        return $this->hasMany(MobileAgent::class,'id','agent_id');
    }
    public function complaints()
    {
        return $this->belongsTo(Complaints::class,'complaint_id','id');
    }

}
