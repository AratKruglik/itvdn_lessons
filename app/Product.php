<?php

namespace App;

use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use FormAccessible, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = ['title', 'slug', 'description', 'price', 'barcode', 'stock', 'cover'];

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return HasOne
     */
    public function gallery(): HasOne
    {
        return $this->hasOne(Gallery::class);
    }
}
