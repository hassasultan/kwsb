<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerFeedback extends Model
{
    use HasFactory;
    protected $table = "customer_feedback";
    protected $fillable =
    [
        'user_id',
        'rating',
        'message',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
