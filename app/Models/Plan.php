<?php

namespace App\Models;

use App\Consts\PlanConst;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'description',
        'due_date',
        'hotel_id',
        'status',
    ];

    public function scopeOpenData(Builder $query)
    {
        $query->where('status', true)
            ->where('due_date', '>=', now());

        return $query;
    }

    public function scopeSearch(Builder $query, $params)
    {
        if (!empty($params['prefecture'])) {
            $query->where('prefecture_id', $params['prefecture']);
        }

        return $query;
    }

    public function scopePrice(Builder $query) {

        return $query;
    }

    public function scopeOrder(Builder $query, $params)
    {
        if ((empty($params['sort'])) ||
                    (!empty($params['sort']) && $params['sort'] == PlanConst::SORT_NEW_ARRIVALS)) {
            $query->latest();
        } elseif (!empty($params['sort']) && $params['sort'] == PlanConst::SORT_VIEW_RANK) {
            $query->withCount('jobOfferViews')
                ->orderBy('job_offer_views_count', 'desc');
        }

        return $query;
    }

    public function hotels()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function planviews()
    {
        return $this->hasMany(PlanView::class);
    }
}
