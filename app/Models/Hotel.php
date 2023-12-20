<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'adress',
        'phonenumber',
        'description',
        'prefecture_id',
    ];

    public function company() {
        return $this->belongTo(Company::class);
    }

    public function plans() {
        return $this->hasMany(Plan::class);
    }

    public function prefecture() {
        return $this->hasOne(Prefectures::class);
    }

}
