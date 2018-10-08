<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ADMIN_ROLE_SLUG = 'administrator';
    const USER_ROLE_SLUG = 'user';

    protected $fillable = ['name', 'slug'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
