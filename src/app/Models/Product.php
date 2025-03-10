<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
    ];

    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'product_season', 'product_id', 'season_id');
    }

    /**
     * Scope to search by name based on keyword
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|null $keyword Search keyword
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchByName($query, $keyword)
    {
        if (!empty($keyword)) {
            return $query->where('name', 'like', "%$keyword%");
            };

        return $query;
    }

    public function scopeSortByPrice($query, $order)
    {
        if (in_array($order, ['asc', 'desc'])) {
            return $query->orderBy('price', $order);
        }

        return $query;
    }
}
