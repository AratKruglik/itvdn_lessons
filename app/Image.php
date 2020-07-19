<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['path', 'gallery_id'];

    /**
     * @return BelongsTo
     */
    public function gallery(): BelongsTo
    {
        return $this->belongsTo(Gallery::class);
    }
}
