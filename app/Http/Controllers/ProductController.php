<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('user')->get();
        return view('product.index', compact('products'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'qty' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        Product::create([
            'name' => $validated['name'],
            'qty' => $validated['qty'],
            'price' => $validated['price'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('product.index')
            ->with('success', 'Product created successfully.');
    }


    public function export()
    {
        return 'Export berhasil (hanya admin yang bisa akses)';
    }

    public function show($id)
    {
        $product = Product::with('user')->findOrFail($id);
        return view('product.view', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        if (Gate::denies('update', $product)) {
            abort(403);
        }

        return view('product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if (Gate::denies('update', $product)) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'qty' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $product->update([
            'name' => $validated['name'],
            'qty' => $validated['qty'],
            'price' => $validated['price'],
        ]);

        return redirect()->route('product.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if (Gate::denies('delete', $product)) {
            abort(403);
        }

        $product->delete();

        return redirect()->route('product.index')
            ->with('success', 'Product berhasil dihapus');
    }
}