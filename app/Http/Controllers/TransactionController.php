<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('supplier')->latest()->get();
        return view('transaction.index', compact('transactions'));
    }

    public function create()
    {
        $suppliers = Supplier::orderBy('supplier_name')->get();

        $productData = Product::orderBy('product_name')->get()->map(fn ($p) => [
            'id'   => $p->id,
            'name' => $p->product_name,
            'buy'  => $p->buy_price,
            'sell' => $p->sell_price,
        ])->values();

        return view('transaction.create', compact('suppliers', 'productData'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'supplier_id'          => 'required|exists:suppliers,id',
            'transaction_type'     => 'required|in:pembelian,penjualan',
            'items'                => 'required|array|min:1',
            'items.*.product_id'   => 'required|exists:products,id',
            'items.*.quantity'     => 'required|integer|min:1',
            'items.*.price'        => 'required|integer|min:0',
        ], [
            'items.required'             => 'Tambahkan minimal satu item.',
            'items.min'                  => 'Tambahkan minimal satu item.',
            'items.*.product_id.required' => 'Pilih produk untuk setiap item.',
            'items.*.quantity.required'   => 'Jumlah setiap item harus diisi.',
            'items.*.price.required'      => 'Harga setiap item harus diisi.',
        ]);

        $transaction = DB::transaction(function () use ($data) {
            $subtotal = collect($data['items'])
                ->sum(fn ($item) => $item['quantity'] * $item['price']);

            $transaction = Transaction::create([
                'invoice_number'   => 'INV-' . now()->format('Ymd-His') . '-' . random_int(100, 999),
                'supplier_id'      => $data['supplier_id'],
                'transaction_type' => $data['transaction_type'],
                'subtotal'         => $subtotal,
            ]);

            foreach ($data['items'] as $item) {
                $transaction->details()->create([
                    'product_id' => $item['product_id'],
                    'quantity'   => $item['quantity'],
                    'price'      => $item['price'],
                ]);
            }

            return $transaction;
        });

        return redirect()
            ->route('transactions.show', $transaction)
            ->with('success', 'Transaksi berhasil disimpan.');
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['supplier', 'details.product']);
        return view('transaction.show', compact('transaction'));
    }

    public function destroy(Transaction $transaction)
    {
        DB::transaction(function () use ($transaction) {
            $transaction->details()->delete();
            $transaction->delete();
        });

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }
}