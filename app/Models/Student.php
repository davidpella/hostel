<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperStudent
 */
class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function account(): MorphOne
    {
        return $this->morphOne(User::class, 'account');
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
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
