<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
