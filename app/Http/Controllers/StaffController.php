<?php

namespace App\Http\Controllers;

use App\Http\Requests\Form\UpdateRequest;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function showCrm()
    {
        $clients = Client::all()->sortByDesc('id');

        return view('crm', [
            'clients' => $clients,
        ]);
    }

    public function showClientProfile(Client $clientId)
    {
//        $client = Client::findOrFail($clientId);

        return view('pages.clientProfile', [
            'client' => $clientId
        ]);
    }

    public function editClientProfile(Client $clientId)
    {
//        $client = Client::findOrFail($clientId);

        return view('functional pages.editClientProfile', [
            'client' => $clientId
        ]);
    }

    public function updateClient(UpdateRequest $request, Client $clientId): RedirectResponse
    {
        $clientId->update([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email')
        ]);

        return redirect()->route('clientProfile', $clientId);
    }

    public function deleteClient(Client $clientId): RedirectResponse
    {
        $clientId->delete();
        return redirect()->route('crm');
    }
}
