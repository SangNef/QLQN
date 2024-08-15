<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    //

    public function index(Request $request)
    {
        $routeName = $request->route()->getName();

        // Cấu hình cho các route
        $config = [
            'doanh-trai.co-dinh' => ['status' => 'co-dinh', 'type' => 'doanh-trai', 'title' => 'Danh sách vật chất doanh trại cố định'],
            'doanh-trai.cap-phat' => ['status' => 'cap-phat', 'type' => 'doanh-trai', 'title' => 'Danh sách vật chất doanh trại cấp phát'],
            'quan-nhu.co-dinh' => ['status' => 'co-dinh', 'type' => 'quan-nhu', 'title' => 'Danh sách vật chất quân nhu cố định'],
            'quan-nhu.cap-phat' => ['status' => 'cap-phat', 'type' => 'quan-nhu', 'title' => 'Danh sách vật chất quân nhu cấp phát'],
            'xang-xe.co-dinh' => ['status' => 'co-dinh', 'type' => 'xang-xe', 'title' => 'Danh sách vật chất xăng xe cố định'],
            'xang-xe.cap-phat' => ['status' => 'cap-phat', 'type' => 'xang-xe', 'title' => 'Danh sách vật chất xăng xe cấp phát'],
            'quan-y.co-dinh' => ['status' => 'co-dinh', 'type' => 'quan-y', 'title' => 'Danh sách vật chất quân y cố định'],
            'quan-y.cap-phat' => ['status' => 'cap-phat', 'type' => 'quan-y', 'title' => 'Danh sách vật chất quân y cấp phát'],
        ];

        if (array_key_exists($routeName, $config)) {
            $items = Item::where('status', $config[$routeName]['status'])
                ->where('type', $config[$routeName]['type'])
                ->orderBy('id', 'desc')
                ->paginate(10);

            $title = $config[$routeName]['title'];
            $status = $config[$routeName]['status'];
            $type = $config[$routeName]['type'];

            return view('pages.items.index', compact('items', 'title', 'status', 'type'));
        } else {
            abort(404);
        }
    }

    public function create(Request $request)
    {
        $defaultType = $request->type;
        $defaultStatus = $request->status;

        $userId = session('user')->id;
        $user = User::with('department')->where('id', $userId)->first();

        return view('pages.items.create', compact('user', 'defaultType', 'defaultStatus'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
            'status' => 'required',
            'type_1' => 'required',
            'type_2' => 'required',
            'type_3' => 'required',
            'type_4' => 'required',
        ], [
            'name.required' => 'Tên không được để trống',
            'type.required' => 'Phân loại không được để trống',
            'status.required' => 'Trạng thái không được để trống',
            'type_1.required' => 'Phân loại 1 không được để trống',
            'type_2.required' => 'Phân loại 2 không được để trống',
            'type_3.required' => 'Phân loại 3 không được để trống',
            'type_4.required' => 'Phân loại 4 không được để trống',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $item = new Item();
        $item->user_id = session('user')->id;
        $item->date = now();
        $item->name = $request->name;
        $item->status = $request->status;
        $item->type = $request->type;
        $item->type_1 = $request->type_1;
        $item->type_2 = $request->type_2;
        $item->type_3 = $request->type_3;
        $item->type_4 = $request->type_4;
        $item->save();

        // Xác định route cho việc chuyển hướng
        switch ($item->type) {
            case 'doanh-trai':
                $redirectRoute = $item->status == 'co-dinh' ? 'doanh-trai.co-dinh' : 'doanh-trai.cap-phat';
                break;
            case 'quan-nhu':
                $redirectRoute = $item->status == 'co-dinh' ? 'quan-nhu.co-dinh' : 'quan-nhu.cap-phat';
                break;
            case 'xang-xe':
                $redirectRoute = $item->status == 'co-dinh' ? 'xang-xe.co-dinh' : 'xang-xe.cap-phat';
                break;
            case 'quan-y':
                $redirectRoute = $item->status == 'co-dinh' ? 'quan-y.co-dinh' : 'quan-y.cap-phat';
                break;
            default:
                $redirectRoute = 'home'; // Hoặc bất kỳ route nào khác mặc định nếu không khớp
                break;
        }

        return redirect()->route($redirectRoute)
            ->with('success', 'Thêm vật chất thành công.');
    }

    public function edit(Item $item)
    {
        return view('pages.items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required',
            'type_1' => 'required',
            'type_2' => 'required',
            'type_3' => 'required',
            'type_4' => 'required',
        ]);

        $item->update($request->all());

        return redirect()->route('items.index')
            ->with('success', 'Item updated successfully');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')
            ->with('success', 'Item deleted successfully');
    }

    public function detail($id)
    {
        $item = Item::find($id);
        return view('pages.items.detail', compact('item'));
    }


}
