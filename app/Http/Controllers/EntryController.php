<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntryController extends Controller
{
    /**
     * Handle the entry routing for each roles-masteradmin, groupadmin, user
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke()
    {
        return redirect()->route('groupadmin.dashboard');
        // $authenticatedUser = auth()->user();

        // if ($authenticatedUser->isMasterAdmin()) {
        //     return redirect()->route('masteradmin.dashboard');
        // } else if ($authenticatedUser->isGroupAdmin()) {
        //     return redirect()->route('groupadmin.dashboard');
        // } else if ($authenticatedUser->isUser()) {
        //     return redirect()->route('user.dashboard');
        // }
    }
}
