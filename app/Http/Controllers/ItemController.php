<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->can('unitadmin')) {
            $unitId = $user->unit_id;
            $items = Item::where('unit_id', $unitId)->get();
            return view('unitadmin.items.index', compact('items'));
        } elseif ($user->can('borrower')) {
            return view('borrower.items.index');
        } else {
            abort(403, 'Forbidden');
        }
    }

    public function create()
    {
        $user = auth()->user();
        $categories = Category::all();
        if ($user->can('unitadmin')) {
            return view('unitadmin.items.create', compact('categories'));
        } else {
            abort(403, 'Forbidden');
        }
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'categories_id' => 'required',
            'name' => 'required',
            'brand' => 'required',
            'serial_number' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'quantity' => 'required|integer',
            'status' => 'required|in:available,not on loan',
        ]);

        $unitId = auth()->user()->unit_id;

        $photoPath = $request->file('photo')->store('public/img/items');

        $item = new Item([
            'categories_id' => $request->categories_id,
            'unit_id' => $unitId,
            'name' => $request->name,
            'brand' => $request->brand,
            'serial_number' => $request->serial_number,
            'photo' => Storage::url($photoPath),
            'quantity' => $request->quantity,
            'status' => $request->status,
        ]);

        $success = $item->save();

        if ($success) {
            return redirect('/items')->with('success', 'Item created successfully.');
        } else {
            return redirect('/items')->with('error', 'Item failed to create.');
        }
    }

    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('unitadmin.items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, Item $item)
    {
        $user = auth()->user();
        $unitId = $user->unit_id;
    
        // Validasi input
        $validatedData = $request->validate([
            'categories_id' => 'required',
            'name' => 'required',
            'brand' => 'required',
            'serial_number' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'quantity' => 'required|integer',
            'status' => 'required',
        ]);
    
        // Mengupdate data item
        $item->categories_id = $validatedData['categories_id'];
        $item->unit_id = $unitId;
        $item->name = $validatedData['name'];
        $item->brand = $validatedData['brand'];
        $item->serial_number = $validatedData['serial_number'];
    
        // Upload foto baru jika ada
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('public/img/items');
            $item->photo = Storage::url($photoPath);
        }
    
        $item->quantity = $validatedData['quantity'];
        $item->status = $validatedData['status'];
        $item->save();
    
        return redirect('/items')->with('success', 'Item updated successfully.');
    }    

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect('/items')->with('success', 'Item deleted successfully.');
    }
}
