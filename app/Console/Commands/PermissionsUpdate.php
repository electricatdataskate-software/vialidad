<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PermissionsUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('db:seed', [
            '--class' => 'RoleAndPermissionSeed',
            '--force' => true,
        ]);
        $this->info('Permisos actualizados correctamente.');
    }
}
