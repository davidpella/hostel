<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * @mixin IdeHelperRoom
 */
class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function hostel(): BelongsTo
    {
        return $this->belongsTo(Hostel::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

    public function scopeAvailable(Builder $builder, $id)
    {
        $builder->whereNotExists(function ($query) use ($id){
            $query->select(DB::raw('COUNT(*)'))
                ->from('invoices')
                ->where('semester_id', $id)
                ->groupBy('room_id')
                ->havingRaw(DB::raw('COUNT(*) = rooms.capacity'))
                ->whereColumn('invoices.room_id', 'rooms.id');
        });
    }

    public function scopeSearch(Builder $builder, $query)
    {
        collect(explode(' ', $query))
            ->map(function($token){
                return $token;
            })
            ->each(function($token) use ($builder){
                $builder->where("number", "LIKE", "%{$token}%");
            });
    }
}
