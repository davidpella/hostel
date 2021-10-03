<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperAcademicYear
 */
class AcademicYear extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function semesters(): HasMany
    {
        return $this->hasMany(Semester::class);
    }

    public function invoices(): HasManyThrough
    {
        return $this->hasManyThrough(Invoice::class, Semester::class);
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
