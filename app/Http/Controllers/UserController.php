<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        if (session('user')->role != 'superadmin') {
            return redirect()->route('suggestions.index');
        }

        // Initialize variables
        $search = $request->input('search');
        $departmentName = $request->input('department_name');

        $users = User::with('department')
            ->orderBy('id', 'desc');

        if ($search) {
            $users = $users->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('username', 'like', '%' . $search . '%');
            });
        }

        if ($departmentName) {
            $department = Department::where('name', $departmentName)->first();
            if ($department) {
                $users = $users->where('department_id', $department->id);
            }
        }

        $users = $users->paginate(10)->appends(['search' => $search, 'department_name' => $departmentName]);

        $departments = Department::all();
        return view('pages.account.list', compact('users', 'search', 'departmentName', 'departments'));
    }

    public function create()
    {
        $departments = Department::get();
        return view('pages.account.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
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
        $user->role = $request->role;
        if ($request->department_name && $request->role == 'user') {
            $department = Department::find('name', $request->department_name)->first();
            $user->department_id = $department->id;
        } else {
            $user->department_id = null;
        }
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
            return redirect()->route('suggestions.index');
        }

        return redirect()->route('login')->with('error', 'Tài khoản hoặc mật khẩu không đúng');
    }

    public function logout()
    {
        session()->forget('user');
        return redirect()->route('login');
    }

    public function changePassword()
    {
        return view('pages.account.change_password');
    }

    public function updatePassword(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'opassword' => 'required',
            'cpassword' => 'required|same:npassword',
        ], [
            'opassword.required' => 'Vui lòng nhập mật khẩu cũ.',
            'npassword.required' => 'Vui lòng nhập mật khẩu mới.',
            'cpassword.required' => 'Vui lòng nhập lại mật khẩu mới.',
            'cpassword.same' => 'Mật khẩu xác nhận không đúng.',
        ]);

        $user = User::find(session('user')->id);

        // Verify the old password
        if ($request->opassword != $user->password) {
            return redirect()->route('account.changePassword')
                ->withErrors(['opassword' => 'Mật khẩu cũ không đúng'])
                ->withInput();
        }
        if ($validator->fails()) {
            return redirect()->route('account.changePassword')
                ->withErrors($validator)
                ->withInput();
        }

        // Update the user's password
        $user->password = $request->npassword;
        $user->save();

        return redirect()->route('account.changePassword')->with('success', 'Đổi mật khẩu thành công');
    }

    public function banAccount($id)
    {
        $user = User::find($id);
        if ($user->is_deleted) {
            $user->is_deleted = false;
            $user->save();

            return redirect()->route('account.index')->with('success', 'Mở khóa tài khoản thành công');
        } else {
            if ($user->role == 'superadmin') {
                return redirect()->route('account.index')->with('error', 'Không thể khóa tài khoản này');
            }
            $user->is_deleted = true;
            $user->save();

            return redirect()->route('account.index')->with('success', 'Khóa tài khoản thành công');
        }
    }
}
