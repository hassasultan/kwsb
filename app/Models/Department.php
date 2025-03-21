<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $table = "department";
    protected $fillable = ['comp_type_id', 'name', 'description', 'status'];
    public function assignedComplaints()
    {
        return $this->hasMany(ComplaintAssignDepartment::class);
    }

}
