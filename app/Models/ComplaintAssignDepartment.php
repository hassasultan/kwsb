<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintAssignDepartment extends Model
{
    use HasFactory;
    protected $table = "complaint_assign_department";
    protected $fillable = [
        "complaint_id",
        "user_id",
        "status",
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function complaints()
    {
        return $this->belongsTo(Complaints::class,'complaint_id','id');
    }
}
