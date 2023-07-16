<?php

namespace App\Domains\Customer\Eloquents;

use App\Domains\User\Eloquents\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Auth eloquent class
 *
 * @property int $id bigint
 * @property Carbon|null $created_at timestamp
 * @property Carbon|null $updated_at timestamp
 * @property Carbon|null $deleted_at timestamp
 */
class Customer extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
