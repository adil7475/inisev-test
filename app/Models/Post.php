<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'posts';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * A Post belongs to a website
     * @return BelongsTo
     */
    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class,'website_id', 'id');
    }
}
