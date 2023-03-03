<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
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

    public function showLogInPage()
    {
        return view('login');
    }


    public function loginProcess(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (Auth::attempt($request->only(['password', 'email']))) {
            Auth::login($user, true);
            return redirect()->route('index')->with(['message' => 'ログインしました']);
        }

        return back()->with(['message' => 'メールアドレスまたはパスワードが正しくありません']);
    }

    public function logoutProcess()
    {
        Auth::logout();
        return redirect()->route('index');
    }
}
