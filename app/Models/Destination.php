<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'destination_name',
        'country',
        'city',
        'description',
        'travel_date',
        'budget',
        'tag',
        'status',
        'image',
    ];

    protected $casts = [
        'travel_date' => 'date',
        'budget' => 'decimal:2',
    ];

    /**
     * Get the user that owns the destination
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}