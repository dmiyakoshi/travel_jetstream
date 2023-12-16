<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'price',
        'description',
        'due_date',
        'hotel_id'
    ];

    public function hotels() {
        return $this->belongsTo(Hotel::class);
    }

    public function reservations() {
        return $this->hasMany(Reservation::class);
    }
}
