<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class Feature extends Model
{
    /** @use HasFactory<\Database\Factories\FeatureFactory> */
    use HasFactory;

     protected $fillable = [
        'name',
        'description',
        'flag',
        'status',
        'user_group',
        'schedule_from',
        'schedule_to'
    ];

      protected $casts = [
        'user_group' => 'array',
    ];

    protected $appends = ['roles'];

    public function getRolesAttribute()
    {
        return Role::whereIn('id', $this->user_group ?? [])->get();
    }

    protected static function booted()
{
    static::creating(function ($feature) {
        if (empty($feature->flag) && !empty($feature->name)) {
            $feature->flag = strtoupper(str_replace(' ', '_', $feature->name));
        }
    });
}
}
