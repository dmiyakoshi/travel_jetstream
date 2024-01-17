<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefecture extends Model
{
    use HasFactory;

    protected $table = 'prefectures';

    protected $connection = 'mysql';

    protected $fillable = [
        'name',
        'region_id',
    ];

    public function region()
    {
        return $this->belongaTo(Region::class, 'region_id');
    }
}
