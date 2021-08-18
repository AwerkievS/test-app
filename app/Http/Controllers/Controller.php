<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function loginPage()
    {
        return response()->json(['status' => false])->setStatusCode(Response::HTTP_FORBIDDEN);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->get('email'))->firstOrFail();
        if (Hash::check($request->get('password'), $user->password)) {
            return $user->createToken('token-name')->plainTextToken;
        }
        return response()->json(['status' => false])->setStatusCode(Response::HTTP_FORBIDDEN);
    }
}
