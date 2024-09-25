<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
        return view('pages.rent');
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
        $users = User::all()->sortByDesc('id');

        return view('crm', [
            'users' => $users,
        ]);
    }

    public function showUserProfile(User $userId)
    {
//        $user = User::findOrFail($userId);

        return view('pages.userProfile', [
            'user' => $userId
        ]);
    }

    public function editUserProfile(User $userId)
    {
//        $user = User::findOrFail($userId);

        return view('functional pages.editUserProfile', [
            'user' => $userId
        ]);
    }
}
