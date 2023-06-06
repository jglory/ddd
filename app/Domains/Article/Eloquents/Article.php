<?php

namespace App\Domains\Article\Eloquents;

use App\Domains\Comment\Eloquents\Comment as CommentEloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * Article eloquent class
 *
 * @property int $id bigint
 * @property int $writerId bigint
 * @property string $title varchar(500)
 * @property string $content text
 * @property Carbon|null $created_at timestamp
 * @property Carbon|null $updated_at timestamp
 * @property Carbon|null $deleted_at timestamp
 * @property CommentEloquent[] $comments
 */
class Article extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'writer_id',
        'title',
        'content',
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

    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(CommentEloquent::class);
    }
}
