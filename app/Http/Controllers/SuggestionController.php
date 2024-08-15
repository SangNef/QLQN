<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Notification;
use App\Models\Suggestion;
use App\Models\SuggestionFile;
use App\Models\SuggestionImage;
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
        return view('pages.suggestions.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'image' => 'sometimes|array',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'file' => 'sometimes|array',
            'file.*' => 'file|mimes:pdf,doc,docx|max:5120',
        ], [
            'description.required' => 'Nội dung đăng ký không được để trống',
            'image.*.image' => 'File ảnh phải là định dạng hình ảnh',
            'image.*.mimes' => 'Ảnh phải là các định dạng: jpeg, png, jpg, gif',
            'image.*.max' => 'Ảnh không được lớn hơn 2MB',
            'file.*.file' => 'Tệp phải là một file hợp lệ',
            'file.*.mimes' => 'Tệp đơn đề nghị phải có định dạng: pdf, doc, hoặc docx',
            'file.*.max' => 'Tệp đơn đề nghị không được lớn hơn 5MB',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Lưu suggestion
        $suggestion = new Suggestion();
        $suggestion->user_id = session('user')->id;
        $suggestion->date = now();
        $suggestion->description = $request->description;
        $suggestion->save();

        // Lưu hình ảnh
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/suggestions'), $imageName);

                $suggestionImage = new SuggestionImage();
                $suggestionImage->suggestion_id = $suggestion->id;
                $suggestionImage->image = $imageName;
                $suggestionImage->save();
            }
        }

        // Lưu các file đơn đề nghị
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('files/suggestions'), $fileName);

                $suggestionFile = new SuggestionFile();
                $suggestionFile->suggestion_id = $suggestion->id;
                $suggestionFile->file = $fileName;
                $suggestionFile->save();
            }
        }

        // Gửi thông báo cho admin
        $admins = User::whereIn('role_id', [1, 2, 3])->get();
        foreach ($admins as $admin) {
            $notification = new Notification();
            $notification->title = 'Đề nghị mới';
            $notification->content = 'Đề nghị mới từ ' . session('user')->name;
            $notification->user_id = $admin->id;
            $notification->save();
        }

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

        $notification = new Notification();
        $notification->title = 'Đề nghị đã được cập nhật';
        $notification->content = 'Đề nghị của bạn đã được cập nhật';
        $notification->user_id = $suggestion->user_id;
        $notification->save();

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
