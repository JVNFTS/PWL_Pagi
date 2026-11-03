@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <h2>Beranda</h2>

    <div class="stats">
        <div class="stat">
            <div class="num">{{ $productCount }}</div>
            <div class="label">Produk</div>
            <p><a href="{{ route('products.index') }}">Lihat produk</a></p>
        </div>
        <div class="stat">
            <div class="num">{{ $supplierCount }}</div>
            <div class="label">Supplier</div>
            <p><a href="{{ route('suppliers.index') }}">Lihat supplier</a></p>
        </div>
        <div class="stat">
            <div class="num">{{ $transactionCount }}</div>
            <div class="label">Transaksi</div>
            <p><a href="{{ route('transactions.index') }}">Lihat transaksi</a></p>
        </div>
    </div>

    <div class="toolbar">
        <h2>Transaksi Terakhir</h2>
        <a class="btn" href="{{ route('transactions.create') }}">+ Transaksi Baru</a>
    </div>

    <table>
        <tr>
            <th>Invoice</th>
            <th>Tipe</th>
            <th>Supplier</th>
            <th class="right">Subtotal</th>
            <th>Tanggal</th>
        </tr>
        @forelse ($latest as $t)
            <tr>
                <td><a href="{{ route('transactions.show', $t) }}">{{ $t->invoice_number }}</a></td>
                <td><span class="badge badge-{{ $t->transaction_type }}">{{ ucfirst($t->transaction_type) }}</span></td>
                <td>{{ $t->supplier->supplier_name ?? '-' }}</td>
                <td class="right">Rp {{ number_format($t->subtotal, 0, ',', '.') }}</td>
                <td>{{ $t->created_at->format('d/m/Y H:i') }}</td>
            </tr>
        @empty
            <tr><td colspan="5" class="empty">Belum ada transaksi.</td></tr>
        @endforelse
    </table>
@endsection