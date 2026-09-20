<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Domain\Intervention\Events\DemandeAcceptee;
use App\Notifications\DemandeTravauxAcceptee;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifierLocataireAcceptation implements ShouldQueue
{
    public function handle(DemandeAcceptee $event): void
    {
        $event->demande->auteur->notify(
            new DemandeTravauxAcceptee($event->demande)
        );
    }
}
