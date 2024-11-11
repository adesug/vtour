<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class panoramas extends Model
{
    use HasFactory;
    protected $fillable = ['tourist_spot_id', 'panorama_url','title','pitch','yaw'];

    public function tourLinks()
    {
        return $this->hasMany(tour_links::class, 'source_panorama_id');
    }
    public function touristSpot()
    {
        return $this->belongsTo(tourist_spots::class);
    }

    public function tour_links()
    {
        return $this->hasMany(tour_links::class);
    }

    public function sourceLinks()
    {
        return $this->hasMany(tour_links::class, 'source_panorama_id');
    }
    
    public function destinationLinks()
    {
        return $this->hasMany(tour_links::class, 'destination_panorama_id');
    }
    
}
