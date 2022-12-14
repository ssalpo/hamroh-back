<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    public const STATUS_UNDER_CONSIDERATION = 1;
    public const STATUS_CONFIRMED = 2;
    public const STATUS_CANCEL_BY_PASSENGER = 3;
    public const STATUS_CANCEL_BY_DRIVER = 4;

    protected $fillable = [
        'route_id',
        'user_id',
        'number_of_seats',
        'status',
    ];

    public function scopeForUser($q, $userId = null): void
    {
        $q->where('user_id', $userId ?? auth()->id());
    }

    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
