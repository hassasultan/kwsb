<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Town;
use App\Models\ComplaintType;
use App\Models\MobileAgent;
use App\Models\Department;
use App\Models\User;

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
        } elseif ($this->recipient_type === 'town') {
            return $this->belongsTo(Town::class, 'recipient_id');
        } elseif ($this->recipient_type === 'type') {
            return $this->belongsTo(ComplaintType::class, 'recipient_id');
        } elseif ($this->recipient_type === 'all') {
            // For 'all' type, create a conditional relationship that only loads when recipient_id exists
            return $this->belongsTo(User::class, 'recipient_id')
                ->when(!$this->recipient_id, function($query) {
                    return $query->whereRaw('1 = 0'); // This ensures no results when recipient_id is null
                });
        }

        // Fallback for any other types - return a safe relationship
        return $this->belongsTo(User::class, 'recipient_id')
            ->when(!$this->recipient_id, function($query) {
                return $query->whereRaw('1 = 0');
            });
    }

    /**
     * Get recipient information safely
     */
    public function getRecipientInfoAttribute()
    {
        if ($this->recipient_type === 'all') {
            return 'All Agents';
        }

        // Check if the recipient relationship is loaded and has data
        if ($this->relationLoaded('recipient') && $this->recipient && $this->recipient_id) {
            if ($this->recipient_type === 'agent') {
                return $this->recipient->user->name ?? 'Unknown Agent';
            } elseif ($this->recipient_type === 'town') {
                return $this->recipient->town ?? 'Unknown Town';
            } elseif ($this->recipient_type === 'type') {
                return $this->recipient->title ?? 'Unknown Type';
            } elseif ($this->recipient_type === 'department') {
                return $this->recipient->name ?? 'Unknown Department';
            }
        }

        // If relationship is not loaded or no recipient, return a descriptive message
        if ($this->recipient_type === 'agent') {
            return 'Agent ID: ' . ($this->recipient_id ?? 'N/A');
        } elseif ($this->recipient_type === 'town') {
            return 'Town ID: ' . ($this->recipient_id ?? 'N/A');
        } elseif ($this->recipient_type === 'type') {
            return 'Type ID: ' . ($this->recipient_id ?? 'N/A');
        } elseif ($this->recipient_type === 'department') {
            return 'Department ID: ' . ($this->recipient_id ?? 'N/A');
        }

        return 'Unknown Recipient';
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
