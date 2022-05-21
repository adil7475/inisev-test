<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Website extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'websites';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * Subscribers
     * @return void
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class, 'website_user', 'user_id', 'website_id'
        );
    }

    /**
     * A website has many posts
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'post_id', 'id');
    }
}
