<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tour_links extends Model
{
    use HasFactory;

    public function destinationPanorama()
    {
        return $this->belongsTo(panoramas::class, 'destination_panorama_id');
    }

    public function panorama()
    {
        return $this->belongsTo(panoramas::class);
    }

    public function sourcePanorama()
    {
        return $this->belongsTo(panoramas::class, 'source_panorama_id');
    }
}
