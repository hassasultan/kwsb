<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $table = "department";
    protected $fillable = ['comp_type_id', 'name', 'description', 'status'];
    // public function assignedComplaints()
    // {
    //     return $this->hasMany(ComplaintAssignDepartment::class);
    // }
    public function users()
    {
        return $this->hasMany(User::class, 'department_id', 'id');
    }
    public function complaints()
    {
        return $this->hasManyThrough(
            Complaints::class,
            ComplaintAssignDepartment::class,
            'user_id',         // Foreign key on ComplaintAssignDepartment
            'id',              // Foreign key on Complaints model
            'id',              // Local key on Department
            'complaint_id'     // Local key on ComplaintAssignDepartment
        );
    }
}
