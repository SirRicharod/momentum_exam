<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = ['name', 'postal_code'];

    public function reports()
    {
        return $this->hasMany(PotholeReport::class);
    }
}
