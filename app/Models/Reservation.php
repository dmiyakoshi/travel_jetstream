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
        'reservation_date',
    ];

    public function plan() {
        return $this->belongsTo(Plan::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function hotel() {
        return $this->belongsTo(Hotel::class);
    }

    public function paied_plan() {
        return $this->hasOne(PaiedPlan::class);
    }
}
