<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

/**
 * Summary of Recipe
 * @class Recipe
 * @package App\Models
 * @property int $int
 * @property string $title
 * @property string $description
 * @property string $ingredients
 * @property string $preparation
 * @property string $image
 * @property \Illuminate\Support\Carbon $published_at
 * @property string $slug
 * @property int $user_id
 * @property int $category_id
 * @property-read \Illuminate\Support\Carbon $created_at
 * @property-read \Illuminate\Support\Carbon $updated_at
 * @property-read \Illuminate\Support\Carbon $deleted_at
 * @property-read User $user
 * @property-read Category $category
 */
class Recipe extends Model
{
    /** @use HasFactory<\Database\Factories\RecipeFactory> */
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'ingredients',
        'preparation',
        'image',
        'published_at',
        'slug',
        'user_id',
        'category_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Summary of user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, Recipe>
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Summary of category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Category, Recipe>
     */
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Summary of tags
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany<Tag, Recipe>
     */
    public function tags(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
