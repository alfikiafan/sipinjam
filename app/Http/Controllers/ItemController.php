<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $perPage = 10;

        if ($user->can('unitadmin')) {
            $unitId = $user->unit_id;
            $items = Item::where('unit_id', $unitId);

            Item::where('unit_id', $unitId)
                ->where('quantity', 0)
                ->update(['status' => 'empty']);

            $status = $request->query('status');
            $search = $request->query('search');

            if ($status) {
                $items->where('status', $status);
            }

            if ($search) {
                $items->where(function ($query) use ($search) {
                    $query->where('id', 'LIKE', '%' . $search . '%')
                        ->orWhere('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('brand', 'LIKE', '%' . $search . '%')
                        ->orWhere('serial_number', 'LIKE', '%' . $search . '%')
                        ->orWhere('quantity', 'LIKE', '%' . $search . '%')
                        ->orWhere('status', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('category', function ($query) use ($search) {
                            $query->where('name', 'LIKE', '%' . $search . '%');
                        });
                });
            }

            $totalItems = $items->count();
            $totalCategories = $items->pluck('category_id')->unique()->count();
            $totalBrands = $items->pluck('brand')->unique()->count();

            $items = $items->paginate($perPage);
            $items->appends(['status' => $status, 'search' => $search]);

            return view('unitadmin.items.index', compact('items', 'status', 'totalItems', 'totalCategories', 'totalBrands'));
        }
        elseif ($user->can('borrower')) {

            Item::where('quantity', 0)
                ->update(['status' => 'empty']);

            $items = Item::where('status', 'available');
            $search = $request->query('search');

            if ($search) {
                $items->where(function ($query) use ($search) {
                    $query->where('id', 'LIKE', '%' . $search . '%')
                        ->orWhere('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('brand', 'LIKE', '%' . $search . '%')
                        ->orWhere('serial_number', 'LIKE', '%' . $search . '%')
                        ->orWhere('quantity', 'LIKE', '%' . $search . '%')
                        ->orWhere('status', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('category', function ($query) use ($search) {
                            $query->where('name', 'LIKE', '%' . $search . '%');
                        });
                });
            }

            $totalItems = $items->count();
            $totalCategories = $items->pluck('category_id')->unique()->count();
            $totalBrands = $items->pluck('brand')->unique()->count();

            $items = $items->paginate($perPage);

            return view('borrower.items.index', compact('items', 'totalItems', 'totalCategories', 'totalBrands'));
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

            if ($item->status !== 'available') {
                abort(403, 'Forbidden');
            }

            $unitId = $item->unit_id;
            $unitAdmins = User::where('unit_id', $unitId)->where('role', 'unitadmin')->get();

            return view('borrower.items.show', compact('item', 'unitAdmins'));
        } else {
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
            'description' => 'nullable',
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
            'description' => $validatedData['description'],
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
        $user = auth()->user();
        $categories = Category::all();
        $unitId = $user->unit_id;
            if ($item->unit_id !== $unitId) {
                abort(403, 'Forbidden');
            }
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
            'description' => 'nullable',
        ]);

        if ($request->has('serial_number') && $request->filled('serial_number') && $request->quantity != 0) {
            $request->merge(['quantity' => 1]);
        }

        if ($request->quantity == 0) {
            $request->merge(['status' => 'empty']);
        }
    
        $item->category_id = $validatedData['category_id'];
        $item->unit_id = $unitId;
        $item->name = $validatedData['name'];
        $item->brand = $validatedData['brand'];
        $item->description = $request->description;

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
