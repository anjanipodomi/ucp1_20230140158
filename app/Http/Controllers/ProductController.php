<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

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

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

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

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        if (Gate::denies('update', $product)) {
            abort(403);
        }

        $validated = $request->validated();

        // 🔥 CEK PERUBAHAN
        if (
            $product->name == $validated['name'] &&
            $product->qty == $validated['qty'] &&
            $product->price == $validated['price']
        ) {
            return back()->with('error', 'Tidak ada perubahan data');
        }

        $product->update($validated);

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