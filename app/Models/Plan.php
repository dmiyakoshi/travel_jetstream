<?php

namespace App\Models;

use App\Consts\CompanyConst;
use App\Consts\PlanConst;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'description',
        'due_date',
        'hotel_id',
        'meal',
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

    public function scopeOrder(Builder $query, $params)
    {
        if ((empty($params['sort'])) ||
            (!empty($params['sort']) && $params['sort'] == PlanConst::SORT_NEW_ARRIVALS)
        ) {
            $query->latest();
        } elseif (!empty($params['sort']) && $params['sort'] == PlanConst::SORT_VIEW_RANK) {
            $query->withCount('planViews')
                ->orderBy('plan_views_count', 'desc');
        } else if ((!empty($params['sort'])) ||
            (!empty($params['sort']) && $params['sort'] == PlanConst::SORT_NEW_ARRIVALS)
        ) {
            $query->latest();
        } elseif (!empty($params['sort']) && $params['sort'] == PlanConst::SORT_VIEW_RANK) {
            $query->withCount('planViews')
                ->orderBy('plan_views_count', 'desc');
        }

        return $query;
    }

    public function scopeMyplan(Builder $query) {
        $company = Auth::guard(CompanyConst::GUARD)->user()->id;

        $query->where('company_id', $company);

        $myplan = [];
        foreach($query as $q) {
            if($q->hotel()->company_id == $company) {
                $myplan[] = $q;
            }
        }
        return $myplan;
    }

    public function scopeSearchStatus(Builder $query, $params)
    {
        if (isset($params['status'])) {
            $query->where('status', $params['status']);
        }

        return $query;
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function company() {
        return $this->belongsTo(Company::class);
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
