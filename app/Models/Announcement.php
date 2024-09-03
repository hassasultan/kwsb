<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'image', 'description', 'status'];

    // Prevent deletion of records
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            return false;
        });
    }
}
