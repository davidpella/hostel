<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @mixin IdeHelperUser
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function accounts(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeStaff(Builder $builder)
    {
        $builder->whereNull('account_type');
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
