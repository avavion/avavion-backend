<?php

namespace App\Models;

use App\Enums\ProjectSystemEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Project
 *
 * @property string $id
 * @property string $title
 * @property boolean $is_published
 * @property string $content
 * @property string $url
 * @property integer $stars
 * @property ProjectSystemEnum $system
 * @property string $instance_id
 * @property array $topics
 * @property string $created
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ProjectFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCreated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereInstanceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereStars($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereTopics($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUrl($value)
 * @mixin \Eloquent
 */
class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'is_published',
        'url',
        'content',
        'stars',
        'instance_id',
        'system',
        'topics',
        'created'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'stars' => 'integer',
        'instance_id' => 'string',
        'system' => ProjectSystemEnum::class,
        'topics' => 'array',
        'created' => 'datetime'
    ];
}
