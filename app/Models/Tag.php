<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

/**
 * Summary of Tag
 * @package App\Models
 * @property int $int
 * @property string $name
 * @property-read \Illuminate\Support\Carbon $created_at
 * @property-read \Illuminate\Support\Carbon $updated_at
 * @property-read \Illuminate\Support\Carbon $deleted_at
 */
class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;
    use SoftDeletes;

    /**
     * Summary of fillable
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Summary of recipes
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany<Recipe, Tag>
     */
    public function recipes()
    {
        return $this->morphedByMany(Recipe::class, 'taggable');
    }
}
