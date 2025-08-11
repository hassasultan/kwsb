<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'data',
        'type',
        'status',
        'recipient_id',
        'recipient_type',
        'sender_id',
        'sent_at',
        'delivered_at',
        'error_message'
    ];

    protected $casts = [
        'data' => 'array',
        'sent_at' => 'datetime',
        'delivered_at' => 'datetime'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function recipient()
    {
        if ($this->recipient_type === 'agent') {
            return $this->belongsTo(MobileAgent::class, 'recipient_id');
        } elseif ($this->recipient_type === 'department') {
            return $this->belongsTo(Department::class, 'recipient_id');
        }
        return null;
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByRecipient($query, $recipientType, $recipientId = null)
    {
        $query->where('recipient_type', $recipientType);
        if ($recipientId) {
            $query->where('recipient_id', $recipientId);
        }
        return $query;
    }
}
