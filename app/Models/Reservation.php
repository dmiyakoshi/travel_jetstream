<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'plan_id',
        'hotel_id',
    ];

    public function plan() {
        return $this->belongTo(Plan::class);
    }

    public function user() {
        return $this->belongTo(User::class);
    }

    public function hotel() {
        return $this->belongTo(Hotel::class);
    }
}
