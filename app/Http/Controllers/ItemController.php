<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    //

    public function index()
    {
        $items = Item::orderBy('id', 'desc')->paginate(10);
        return view('pages.items.index', compact('items'));
    }

    public function create()
    {
        $userId = session('user')->id;
        $user = User::with('department')->where('id', $userId)->first();
        // dd($user);
        return view('pages.items.create', compact('user'));
    }

    public function store(Request $request)
    {
        // hiển thị validate tiếng Việt
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type_1' => 'required',
            'type_2' => 'required',
            'type_3' => 'required',
            'type_4' => 'required',
        ], [
            'name.required' => 'Tên không được để trống',
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
        $item->type_1 = $request->type_1;
        $item->type_2 = $request->type_2;
        $item->type_3 = $request->type_3;
        $item->type_4 = $request->type_4;
        $item->save();

        return redirect()->route('items.index')
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
