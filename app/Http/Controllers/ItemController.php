<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

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
        return view('items.create');
    }

    public function store(Request $request)
    {
        // Validasi inputan form

        $item = new Item([
            'categories_id' => $request->categories_id,
            'unit_id' => $request->unit_id,
            'name' => $request->name,
            'brand' => $request->brand,
            'serial_number' => $request->serial_number,
            'photo' => $request->photo,
            'quantity' => $request->quantity,
            'status' => $request->status,
        ]);

        $item->save();

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        // Validasi inputan form

        $item->categories_id = $request->categories_id;
        $item->unit_id = $request->unit_id;
        $item->name = $request->name;
        $item->brand = $request->brand;
        $item->serial_number = $request->serial_number;
        $item->photo = $request->photo;
        $item->quantity = $request->quantity;
        $item->status = $request->status;
        $item->save();

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}
