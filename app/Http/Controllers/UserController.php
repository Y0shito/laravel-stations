<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function showSignInPage()
    {
        return view('signin');
    }

    public function userRegister(UserRequest $request, User $value)
    {
        $user = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ];

        $value->userStoreOnModel($user);

        try {
            return redirect()
                ->route('index')
                ->with(['message' => 'ユーザー登録が完了しました']);
        } catch (Exception $e) {
            return redirect()
                ->route('index')
                ->with(['message' => 'ユーザー登録が出来ませんでした']);
        }
    }
}
