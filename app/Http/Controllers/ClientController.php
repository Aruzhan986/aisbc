<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // Display a listing of the clients.
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    // Show the form for creating a new client.
    public function create()
    {
        return view('clients.create');
    }

    // Store a newly created client in the database.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstName' => 'required|string|max:50',
            'lastName' => 'required|string|max:50',
        ]);

        Client::create($validated);
        return redirect()->route('clients.index')->with('success', 'Client created successfully!');
    }

    // Display the specified client.
    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    // Show the form for editing the specified client.
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    // Update the specified client in the database.
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'firstName' => 'required|string|max:50',
            'lastName' => 'required|string|max:50',
        ]);

        $client->update($validated);
        return redirect()->route('clients.index')->with('success', 'Client updated successfully!');
    }

    // Remove the specified client from the database.
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully!');
    }

    public function indexAjax() {
        return view('clients.partial_index');
    }
}
