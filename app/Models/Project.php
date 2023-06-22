<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $title
 * @property boolean $is_published
 * @property string $content
 * @property string $github_url
 * @property integer $stars
 */
class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'is_published',
        'github_url',
        'content',
        'stars'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'stars' => 'integer'
    ];
}
