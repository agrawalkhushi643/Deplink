<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;

class Package extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'org', 'name',
    ];

    public function getFullNameAttribute()
    {
        return $this->attributes['org'] .'/'. $this->attributes['name'];
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public static function findBySlug($org, $name)
    {
        return self::where('org', $org)
            ->where('name', $name)
            ->firstOrFail();
    }
}
