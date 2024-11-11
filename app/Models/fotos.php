<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fotos extends Model
{
    use HasFactory;
    public function touristSpot()
    {
        return $this->belongsTo(tourist_spots::class);
    }
}
