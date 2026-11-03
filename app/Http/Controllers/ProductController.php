<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private function rules(): array
    {
        return [
            'barcode_number' => 'nullable|string|max:255',
            'product_name'   => 'required|string|max:255',
            'buy_price'      => 'required|integer|min:0',
            'sell_price'     => 'required|integer|min:0',
            'supplier_id'    => 'required|exists:suppliers,id',
        ];
    }

    public function index()
    {
        $products = Product::with('supplier')->latest()->get();
        return view('product.index', compact('products'));
    }

    public function create()
    {
        $suppliers = Supplier::orderBy('supplier_name')->get();
        return view('product.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        Product::create($request->validate($this->rules()));

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil disimpan.');
    }

    public function show(Product $product)
    {
        $product->load('supplier');
        return view('product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $suppliers = Supplier::orderBy('supplier_name')->get();
        return view('product.edit', compact('product', 'suppliers'));
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->validate($this->rules()));

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->transactionDetails()->exists()) {
            return redirect()
                ->route('products.index')
                ->withErrors('Produk tidak bisa dihapus karena sudah dipakai di transaksi.');
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}