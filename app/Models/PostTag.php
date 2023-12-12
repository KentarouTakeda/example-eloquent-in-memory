<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\PostTag
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $post_id
 * @property int $tag_id
 * @property-read \App\Models\Post $post
 * @property-read \App\Models\Tag $tag
 * @method static \Database\Factories\PostTagFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTag query()
 * @mixin \Eloquent
 */
class PostTag extends Pivot
{
    use HasFactory;

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }
}
