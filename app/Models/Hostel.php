<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperHostel
 */
class Hostel extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'has_floors' => 'boolean',
        'floor_count' => 'integer',
    ];

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function scopeSearch(Builder $builder, $query)
    {
        collect(explode(' ', $query))
            ->map(function($token){
                return $token;
            })
            ->each(function($token) use ($builder){
                $builder->where("name", "LIKE", "%{$token}%");
            });
    }
}
