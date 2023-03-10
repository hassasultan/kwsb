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
        "prio_id",
        "customer_id",
        "title",
        "description",
        "customer_name",
        "phone",
        "email",
        "image",
        "status",
        "before_image",
        "after_image",
        "agent_description"
    ];
    public function town()
    {
       return $this->belongsTo(Town::class,'town_id','id');
    }
    public function customer()
    {
       return $this->belongsTo(Customer::class,'customer_id','id');
    }
    public function type()
    {
       return $this->belongsTo(ComplaintType::class,'type_id','id');
    }
    public function prio()
    {
       return $this->belongsTo(Priorities::class,'prio_id','id');
    }
}
