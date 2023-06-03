<?php

namespace App\Events;

use App\Models\Star;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StarEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Star $star;

    /**
     * Create a new event instance.
     */
    public function __construct(Star $star)
    {
        $this->star = $star;
    }
}

