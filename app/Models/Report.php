<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Report extends Model
{
    /** @use HasFactory<\Database\Factories\ReportFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'date_of_incident',
        'time_of_incident',
        'damage_severity',
        'estimated_cost',
        'photos',
        'status',
    ];

     protected $casts = [
        'photos' => 'array'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
