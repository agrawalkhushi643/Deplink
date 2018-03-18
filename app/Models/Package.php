<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute(): string
    {
        return $this->attributes['org'] . '/' . $this->attributes['name'];
    }

    /**
     * @param Builder $builder
     * @param string $org
     * @param string $name
     * @return Model
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function scopeFindBySlug(Builder $builder, $org, $name): Package
    {
        return $builder->where('org', $org)
            ->where('name', $name)
            ->firstOrFail();
    }

    public function getDistDir()
    {
        return "packages/{$this->full_name}";
    }
}
