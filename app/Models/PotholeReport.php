<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PotholeReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'location_id',
        'street_name',
        'severity',
        'status',
        'description'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
