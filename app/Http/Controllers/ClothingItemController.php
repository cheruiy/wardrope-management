<?php

namespace App\Http\Controllers;

use App\Models\ClothingItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ClothingItemController extends Controller {
    public function index() {
        return ClothingItem::where('user_id', Auth::id())->get();
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('images', 'public') : null;

        $item = ClothingItem::create([
            'name' => $request->name,
            'category' => $request->category,
            'image' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        return response()->json($item, 201);
    }

    public function destroy($id) {
        $item = ClothingItem::where('user_id', Auth::id())->findOrFail($id);
        
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();

        return response()->json(['message' => 'Item deleted successfully']);
    }
}
