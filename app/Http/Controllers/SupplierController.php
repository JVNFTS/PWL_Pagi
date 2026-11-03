<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::withCount('products')->orderBy('supplier_name')->get();
        return view('supplier.index', compact('suppliers'));
    }

    public function create()
    {
        return view('supplier.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'phone'         => 'required|string|max:30',
            'email'         => 'required|email|max:255',
        ]);

        Supplier::create($data);

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier berhasil disimpan.');
    }

    public function show(Supplier $supplier)
    {
        return redirect()->route('suppliers.edit', $supplier);
    }

    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $data = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'phone'         => 'required|string|max:30',
            'email'         => 'required|email|max:255',
        ]);

        $supplier->update($data);

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier berhasil diperbarui.');
    }

    public function destroy(Supplier $supplier)
    {
        if ($supplier->products()->exists()) {
            return redirect()
                ->route('suppliers.index')
                ->withErrors('Supplier tidak bisa dihapus karena masih dipakai oleh produk.');
        }

        $supplier->delete();

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier berhasil dihapus.');
    }
}
