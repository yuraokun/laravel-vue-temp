<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\Admin;

class VerifyEmailController extends Controller
{


    public function __invoke(Request $request): RedirectResponse
    {

        $type = $_GET['type'];
        if($type == "user") {
            $user = User::find($request->route('id'));
        } else if ($type == "admin") {
            $user = Admin::find($request->route('id'));
        }

        // $user = User::find($request->route('id'));
       
        if ($user->hasVerifiedEmail()) {
            return redirect(env('FRONT_URL') . '/');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect(env('FRONT_URL') . '/');
    }
}