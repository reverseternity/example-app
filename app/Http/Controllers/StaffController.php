<?php

namespace App\Http\Controllers;

use App\Models\Client;
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
}
