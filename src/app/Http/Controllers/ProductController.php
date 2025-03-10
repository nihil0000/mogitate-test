<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Models\ProductSeason;


class ProductController extends Controller
{
    // Product List
    public function index()
    {
        $products = Product::all();
        return view('index', compact('products'));
    }

    // Product Details
    public function show($id)
    {
        $product = Product::with('seasons')->find($id);
        $seasons = Season::all();
        return view('show', compact('product', 'seasons'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        // If a file is uploaded
        if ($request->hasFile('image')) {
            $file = $request->image;
            $filename = $file->getClientOriginalName(); // Get the original filename of the uploaded file
            $file->storeAs('public/images', $filename); // Store the uploaded file
            $product->update(['image' => 'images/' . $filename]); // Update the file path in the database
        }

        $selectedSeasons = $request->input('seasons', []);
        $product->seasons()->sync($selectedSeasons);

        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('products.index');
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {

    }
}
