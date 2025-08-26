<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    /** @use HasFactory<\Database\Factories\FeatureFactory> */
    use HasFactory;

     protected $fillable = [
        'name',
        'description',
        'key',
        'status',
        'user_group',
        'schedule_from',
        'schedule_to'
    ];

      protected $casts = [
        'user_group' => 'array',
    ];


    protected static function booted()
{
    static::creating(function ($feature) {
        if (empty($feature->key) && !empty($feature->name)) {
            $feature->key = strtoupper(str_replace(' ', '_', $feature->name));
        }
    });
}
}
