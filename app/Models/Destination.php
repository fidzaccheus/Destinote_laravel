<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'image',
        'image_type',
        'status',
    ];

    // Relationship: A destination belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}