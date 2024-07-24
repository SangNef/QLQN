<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::paginate(10);
        return view('pages.account.index', compact('users'));
    }

    public function create()
    {
        return view('pages.account.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'position' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('account.create')
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->position = $request->position;
        $user->save();

        return redirect()->route('account.index')->with('success', 'Thêm tài khoản thành công');
    }

    public function login()
    {
        return view('pages.auth.login');
    }

    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('username', $request->username)->where('password', $request->password)->first();
        if ($user) {
            session(['user' => $user]);
            return redirect()->route('suggestion.index');
        }

        return redirect()->route('login')->with('error', 'Tài khoản hoặc mật khẩu không đúng');
    }

    public function logout()
    {
        session()->forget('user');
        return redirect()->route('login');
    }
}
