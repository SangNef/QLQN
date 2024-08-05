<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Suggestion;
use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class SuggestionController extends Controller
{
    //
    public function index(Request $request)
    {
        $userId = session('user')->id;
        $query = Suggestion::with('user.department');

        // Check and format start_date
        if ($request->has('start_date') && $request->input('start_date')) {
            $startDate = Carbon::parse($request->input('start_date'))->startOfDay();
            $query->where('date', '>=', $startDate);
        }

        // Check and format end_date
        if ($request->has('end_date') && $request->input('end_date')) {
            $endDate = Carbon::parse($request->input('end_date'))->endOfDay();
            $query->where('date', '<=', $endDate);
        }

        // Filter by department name
        if ($request->has('department') && $request->input('department')) {
            $query->whereHas('user.department', function ($query) use ($request) {
                $query->where('name', $request->input('department'));
            });
        }

        if ($request->has('status') && $request->input('status')) {
            $query->where('status', $request->input('status'));
        }

        // Apply pagination
        if (session('user')->role != 'user') {
            $suggestions = $query->orderBy('id', 'desc')->paginate(10);
        } else {
            $suggestions = $query->where('user_id', $userId)->orderBy('id', 'desc')->paginate(10);
        }

        // Fetch departments for the filter dropdown
        $departments = Department::all(); // Adjust this according to your requirement

        return view('pages.suggestions.index', compact('suggestions', 'departments'));
    }

    public function create()
    {
        if (session('user')->role != 'user') {
            return redirect()->route('suggestions.index');
        }
        return view('pages.suggestions.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'image' => 'required|image',
        ], [
            'description.required' => 'Nội dung đăng ký không được để trống',
            'image.required' => 'Ảnh không được để trống',
            'image.image' => 'Ảnh phải đúng định dạng',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Lưu ảnh vào thư mục public và lấy đường dẫn
        $imagePath = $request->file('image')->store('suggestions', 'public');

        // Lưu dữ liệu vào database
        $suggestion = new Suggestion();
        $suggestion->user_id = session('user')->id;
        $suggestion->date = now();
        $suggestion->description = $request->description;
        $suggestion->image = $imagePath;
        $suggestion->save();

        return redirect()->route('suggestions.index')->with('success', 'Thêm đề nghị thành công');
    }

    public function detail($id)
    {
        $suggestion = Suggestion::with('user')->find($id);
        return view('pages.suggestions.detail', compact('suggestion'));
    }

    public function update(Request $request, $id)
    {
        $suggestion = Suggestion::find($id);
        if ($request->has('note')) {
            $suggestion->note = $request->note;
        }
        if ($suggestion->status == 'pending') {
            $suggestion->status = 'approved';
        } elseif ($suggestion->status == 'approved') {
            $suggestion->status = 'completed';
        } else {
            return redirect()->back()->with('error', 'Trạng thái đã đạt tối đa');
        }
        $suggestion->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công');
        // dd($request->all());
    }

    public function destroy($id)
    {
        $suggestion = Suggestion::find($id);
        if ($suggestion->status !== 'pending') {
            return redirect()->back()->withErrors('Không thể xóa đề nghị đã được duyệt hoặc hoàn thành');
        }
        $suggestion->delete();

        return redirect()->route('suggestions.index')->with('success', 'Xóa đề nghị thành công');
    }
}
