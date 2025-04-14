<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class logs extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'action',
        'action_id',
        'action_detail',
    ];
}
