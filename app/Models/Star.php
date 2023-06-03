<?php

namespace App\Models;

use App\Events\StarEvent;
use Illuminate\Database\Eloquent\Model;

class Star extends Model
{
    protected $guarded = [];
    protected $dispatchesEvents = [
        'created' => StarEvent::class
    ];

    public function star_count()
    {
        return $this->hasOne(StarCount::class, 'stars_id', 'id');
    }
}
