<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory;
    use Searchable, Actionable;

    protected $casts = [
        'publish_at' => 'datetime',
        'publish_until' => 'datetime',
    ];

    protected $fillable = [
        'is_published',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

}