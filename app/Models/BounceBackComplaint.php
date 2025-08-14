<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BounceBackComplaint extends Model
{
    use HasFactory;

    protected $table = "bounce_back_complaint";

    protected $fillable = [
        "complaint_id",
        "type", // 'department' or 'agent'
        "agent_id", // mobile_agent id or department user_id
        "status",
        "reason",
        "bounced_by",
        "bounced_at"
    ];

    protected $casts = [
        'bounced_at' => 'datetime',
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaints::class, 'complaint_id', 'id');
    }

    public function mobileAgent()
    {
        return $this->belongsTo(MobileAgent::class, 'agent_id', 'id');
    }

    public function departmentUser()
    {
        return $this->belongsTo(User::class, 'agent_id', 'id');
    }

    public function bouncedByUser()
    {
        return $this->belongsTo(User::class, 'bounced_by', 'id');
    }
}
