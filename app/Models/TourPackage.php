<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'location',
        'short_description',
        'price',
        'duration_days',
        'duration_nights',
        'max_capacity',
        'thumbnail',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'duration_days' => 'integer',
        'duration_nights' => 'integer',
        'max_capacity' => 'integer',
        'is_active' => 'boolean',
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'package_service');
    }
}