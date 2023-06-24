<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        if ($user->can('unitadmin')) {
            $unitId = $user->unit_id;
            $items = Item::where('unit_id', $unitId);

            $status = $request->query('status');

            if ($status) {
                $items->where('status', $status);
            }

            $items = $items->get();

            return view('unitadmin.items.index', compact('items', 'status'));
        }
        elseif ($user->can('borrower')) {
            $status = $request->query('status');

            $items = Item::where('status', 'available')->get();

            return view('borrower.items.index', compact('items'));
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

    public function show(Item $item) {
        $user = auth()->user();
        if($user->can('unitadmin')) {
            $unitId = $user->unit_id;
            if ($item->unit_id !== $unitId) {
                abort(403, 'Forbidden');
            }
            return view('unitadmin.items.show', compact('item'));
        } elseif($user->can('borrower')){
            return view('borrower.items.show', compact('item'));
        }else {
            abort(403, 'Forbidden');
        }
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $validatedData = $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'brand' => 'required',
            'quantity' => 'required|integer|min:1',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:available,not available',
        ]);

        if ($request->has('serial_number') && $request->filled('serial_number')) {
            $request->merge(['quantity' => 1]);
        }

        if ($request->quantity == 0) {
            $request->merge(['status' => 'empty']);
        }

        $unitId = auth()->user()->unit_id;

        $photoPath = $request->file('photo')->store('public/img/items');

        $item = new Item([
            'category_id' => $validatedData['category_id'],
            'unit_id' => $unitId,
            'name' => $validatedData['name'],
            'brand' => $validatedData['brand'],
            'serial_number' => $request->serial_number,
            'photo' => Storage::url($photoPath),
            'quantity' => $request->quantity,
            'status' => $validatedData['status'],
        ]);

        $success = $item->save();

        if ($success) {
            return redirect()->route('items.index')->with('success', 'Item has been created.');
        } else {
            return redirect()->route('items.index')->with('error', 'Item failed to create.');
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
    
        $validatedData = $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'brand' => 'required',
            'quantity' => 'required|integer',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:available,not available,empty',
        ]);

        if ($request->has('serial_number') && $request->filled('serial_number')) {
            $request->merge(['quantity' => 1]);
        }

        if ($request->quantity == 0) {
            $request->merge(['status' => 'empty']);
        }
    
        $item->category_id = $validatedData['category_id'];
        $item->unit_id = $unitId;
        $item->name = $validatedData['name'];
        $item->brand = $validatedData['brand'];

        if ($request->has('serial_number')) {
            $item->serial_number = $request->serial_number;
        }
    
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('public/img/items');
            $item->photo = Storage::url($photoPath);
        }
    
        $item->quantity = $request->quantity;
        $item->status = $request->status;
        $item->save();
    
        return redirect('/items')->with('success', 'Item updated successfully.');
    }    

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect('/items')->with('success', 'Item deleted successfully.');
    }
}
