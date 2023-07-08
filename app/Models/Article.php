<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Storage;

/**
 * @property string $id
 * @property string $title
 * @property string $content
 * @property bool $is_published
 * @property string $image_url
 * @property string $image_path
 * @property string $author_id
 * @method static whereId(int $id)
 */
class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'is_published',
        'image_path',
        'author_id'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'image_url' => 'string'
    ];

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    /**
     * @return Attribute
     */
    public function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => url(Storage::url($this->image_path))
        );
    }
}
