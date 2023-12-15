<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    public function hotels() {
        return $this->belongsTo(Hotel::class);
    }

    public function prefecture() {
        return $this->hasOne(Prefectures::class);
    }

    public function reservations() {
        return $this->hasMany(Reservation::class);
    }
}
