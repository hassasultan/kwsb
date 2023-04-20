<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;


class ComplaintType extends Model
{
    use HasFactory;
    protected $table ="complaint_types";
    protected $fillable = [
        "title",
        "description",
        "status",
    ];
    public function complaints()
    {
       return $this->hasMany(Complaints::class,'type_id','id');
    }
    public function complaintsLatest($date,$type_id)
    {
        $created_at = explode(' ',$date);
        $created_at = $created_at[0];
        // dd($created_at);
        $compCount = Complaints::whereDate('created_at',$created_at)->where('type_id',$type_id)->count();
       return $compCount;
    }
}
