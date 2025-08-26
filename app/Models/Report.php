<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
