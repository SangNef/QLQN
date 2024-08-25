<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Role;
use App\Models\Storage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        if (session('user')->role_id === 5) {
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
        $roles = Role::all();
        return view('pages.account.list', compact('users', 'search', 'departmentName', 'departments', 'roles'));
    }

    public function create()
    {
        $roles = Role::get();
        $departments = Department::get();
        $storages = Storage::get();
        return view('pages.account.create', compact('departments', 'roles', 'storages'));
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
        $user->role_id = $request->role_id;
        // if ($request->department_name) {
        //     $department = Department::where('name', $request->department_name)->first();
        //     $user->department_id = $department->id;
        // } else {
        //     $user->department_id = null;
        // }
        // if ($request->storage_id) {
        //     $user->storage_id = $request->storage_id;
        //     $department = Department::where('name', 'Ban Hậu cần')->first();
        //     $user->department_id = $department->id;
        // } else {
        //     $user->storage_id = null;
        // }
        if ($request->role_id == 1 || $request->role_id == 2 || $request->role_id == 3 || $request->role_id == 4) {
            $user->department_id = null;
            $user->storage_id = null;
        }
        if ($request->role_id == 5) {
            $department = Department::where('name', $request->department_name)->first();
            $user->department_id = $department->id;
            $user->storage_id = null;
        }
        if ($request->role_id == 6) {
            $department = Department::where('name', 'Ban Hậu cần')->first();
            $user->department_id = $department->id;
            $user->storage_id = $request->storage_id;
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
            'device_fingerprint' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('username', $request->username)
            ->where('password', $request->password)
            ->first();

        if ($user && $user->is_deleted) {
            return redirect()->route('login')->with('error', 'Tài khoản đã bị khóa, vui lòng liên hệ quản trị viên');
        }

        if ($user) {
            // Kiểm tra fingerprint
            if ($user->device_fingerprint && $user->device_fingerprint !== $request->device_fingerprint) {
                return redirect()->route('login')->with('error', 'Bạn không được phép đăng nhập trên thiết bị này');
            }

            // Lưu fingerprint nếu lần đăng nhập đầu tiên
            if (!$user->device_fingerprint) {
                $user->device_fingerprint = $request->device_fingerprint;
                $user->save();
            }

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
            if ($user->role_id == 1) {
                return redirect()->route('account.index')->with('error', 'Không thể khóa tài khoản này');
            }
            $user->is_deleted = true;
            $user->save();

            return redirect()->route('account.index')->with('success', 'Khóa tài khoản thành công');
        }
    }

    public function update(Request $request, $id)
    {
        if (($request->user_role == 'ban') || ($request->user_role == 'unban')) {
            return $this->banAccount($id);
        }
        $user = User::find($id);
        $user->role_id = $request->user_role;
        $user->save();
        return redirect()->route('account.index')->with('success', 'Cập nhật tài khoản thành công');
    }

    public function clearDeviceFingerprint($id)
    {
        $user = User::find($id);
        $user->device_fingerprint = null;
        $user->save();
        return redirect()->route('account.index')->with('success', 'Xóa thiết bị cho tài khoản thành công');
    }
}
