<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Order;

class PagesController extends Controller
{
    public function showIndex()
    {
        return view('index');
    }

    public function showFreeConsult()
    {
        return view('pages.freeConsult');
    }

    public function showIndividualConsult()
    {
        return view('pages.individualConsult');
    }

    public function showMovingAssistance()
    {
        return view('pages.movingAssistance');
    }

    public function showBusinessMarketing()
    {
        return view('pages.businessMarketing');
    }

    public function showSellBuy()
    {
        return view('pages.sellBuy');
    }

    public function showAboutUs()
    {
        return view('pages.aboutUs');
    }

    public function showRent()
    {
//        return view('pages.rent');
        dd(auth());
    }

    public function showTermsofUse()
    {
        return view('pages.termsofUse');
    }

    public function showIconsultForm()
    {
        return view('form pages.individualConsultForm');
    }

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

    public function showMessage()
    {
        return view('functional pages.messagePage');
    }
}
