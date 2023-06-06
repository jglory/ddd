<?php

namespace App\Domains\Comment\Eloquents;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Article eloquent class
 *
 * @property int $id bigint
 * @property int $article_id bigint
 * @property string $comment varchar(1000)
 * @property Carbon|null $created_at timestamp
 * @property Carbon|null $updated_at timestamp
 * @property Carbon|null $deleted_at timestamp
 */
class Comment extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'article_id',
        'comment',
    ];

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
}
