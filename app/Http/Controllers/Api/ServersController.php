<?php

namespace App\Http\Controllers\Api;

use Adams\Rcon\Exception;
use Adams\Rcon\Rcon;
use App\Http\Controllers\Controller;
use App\Models\Server;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use xPaw\MinecraftPing;
use xPaw\MinecraftPingException;

class ServersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws Exception
     */
    public function index(): array
    {
        $servers = Server::all();

        $responses = [];
        $servers->each(function($server, $key) use(&$responses) {
            $config = config('rcon.connections.rcon_'.$server->id);

            try {
                $Query = new MinecraftPing( $config['host'], $config['port'] );

                $responses[$key] = $Query->Query();
                $responses[$key]['name'] = $server->name;
                $responses[$key]['host'] = $config['host'];
                $responses[$key]['port'] = $config['port'];
            } catch( MinecraftPingException $e ) {
                $responses[] = $e->getMessage();
            }
        });

        return $responses;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Server $server)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Server $server)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Server $server)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Server $server)
    {
        //
    }
}
