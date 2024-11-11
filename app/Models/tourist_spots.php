<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tourist_spots extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'deskription', 'address','category'];

    public function panoramas()
    {
        return $this->hasMany(panoramas::class, 'tourist_spot_id');
    }
    public function fotos()
    {
        return $this->hasMany(fotos::class, 'tourist_spot_id');
    }
    
}
