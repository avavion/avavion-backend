<?php

namespace App\Models;

use App\Enums\ProjectSystemEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $title
 * @property boolean $is_published
 * @property string $content
 * @property string $url
 * @property integer $stars
 * @property ProjectSystemEnum $system
 * @property string $instanceId
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
        'system'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'stars' => 'integer',
        'instance_id' => 'string',
        'system' => ProjectSystemEnum::class
    ];
}
