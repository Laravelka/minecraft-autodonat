<?php

namespace App\Providers;

use App\Models\Server;
use Illuminate\Support\ServiceProvider;

class RconSystemProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Server::all()->each(function ($server) {
            $this->app['config']['rcon.connections.rcon_'.$server->id] = [
                'host' => $server->ip,
                'port' => $server->port,
                'timeout' => 60,
                'password' => $server->password,
                'rcon_port' => $server->rcon_port
            ];
        });
    }
}
