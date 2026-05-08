<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PotholeReport extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

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
