<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\ClientRequest;

class ClientController extends Controller
{
    public function index()
    {
        return Client::all();
    }

    public function store(ClientRequest $request)
    {
        return Client::create($request->validated());
    }

    public function show(Client $client)
    {
        return $client;
    }

    public function update(ClientRequest $request, Client $client)
    {
        $client->update($request->validated());
        return $client;
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return response()->json(null, 204);
    }
}
