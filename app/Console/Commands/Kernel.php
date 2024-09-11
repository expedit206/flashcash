<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Les commandes Artisan disponibles pour l'application.
     *
     * @var array
     */
    protected $commands = [
        // Les commandes Artisan que tu souhaites enregistrer
        \App\Console\Commands\IncrementSolde::class,
    ];

    /**
     * Définir les tâches planifiées pour l'application.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Planifie l'exécution de la commande tous les jours à minuit
        $schedule->command('solde:increment')->daily();
    }

    /**
     * Enregistre les commandes dans l'application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
