<?php

declare(strict_types=1);

namespace App\Domain\Intervention\Events;

use App\Domain\Intervention\Models\DemandeTravaux;
use Illuminate\Foundation\Events\Dispatchable;

final readonly class DemandeSoumise
{
    use Dispatchable;

    public function __construct(public DemandeTravaux $demande) {}
}
