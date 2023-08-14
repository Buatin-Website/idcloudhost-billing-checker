<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;

class AccountThresholdReachedEvent
{
    use Dispatchable;

    public function __construct(
        public array $accounts,
    )
    {
    }
}
