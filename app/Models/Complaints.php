<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaints extends Model
{
    use HasFactory;
    protected $table ="complaint";
    protected $fillable = [
        "comp_num",
        "town_id",
        "sub_town_id",
        "type_id",
        "subtype_id",
        "prio_id",
        "customer_id",
        "customer_num",
        "customer_cnic",
        "business_nature",
        "residential_type",
        "shops_count",
        "title",
        "description",
        "customer_name",
        "phone",
        "email",
        "address",
        "landmark",
        "image",
        "image_two",
        "image_three",
        "lat",
        "lng",
        "source",
        "status",
        "before_image",
        "after_image",
        "agent_description"
    ];
    public function town()
    {
       return $this->belongsTo(Town::class,'town_id','id');
    }
    public function subtown()
    {
       return $this->belongsTo(SubTown::class,'sub_town_id','id');
    }
    public function customer()
    {
       return $this->belongsTo(Customer::class,'customer_id','id');
    }
    public function type()
    {
       return $this->belongsTo(ComplaintType::class,'type_id','id');
    }
    public function subtype()
    {
       return $this->belongsTo(SubType::class,'subtype_id','id');
    }
    public function prio()
    {
       return $this->belongsTo(Priorities::class,'prio_id','id');
    }
    public function assignedComplaints()
    {
       return $this->belongsTo(ComplaintAssignAgent::class,'id','complaint_id');
    }
}
