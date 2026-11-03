@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
    <div class="toolbar">
        <h2>Invoice {{ $transaction->invoice_number }}</h2>
        <div class="actions">
            <a class="btn btn-secondary" href="{{ route('transactions.index') }}">Kembali</a>
            <form method="POST" action="{{ route('transactions.destroy', $transaction) }}"
                  onsubmit="return confirm('Hapus transaksi ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
    </div>

    <table class="detail">
        <tr><th>Tipe</th><td><span class="badge badge-{{ $transaction->transaction_type }}">{{ ucfirst($transaction->transaction_type) }}</span></td></tr>
        <tr><th>Supplier</th><td>{{ $transaction->supplier->supplier_name ?? '-' }}</td></tr>
        <tr><th>Tanggal</th><td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td></tr>
    </table>

    <h3>Item</h3>
    <table>
        <tr>
            <th>No</th>
            <th>Produk</th>
            <th class="right">Jumlah</th>
            <th class="right">Harga</th>
            <th class="right">Total</th>
        </tr>
        @foreach ($transaction->details as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->product->product_name ?? '(produk tidak ditemukan)' }}</td>
                <td class="right">{{ $d->quantity }}</td>
                <td class="right">Rp {{ number_format($d->price, 0, ',', '.') }}</td>
                <td class="right">Rp {{ number_format($d->quantity * $d->price, 0, ',', '.') }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4" class="right"><strong>Subtotal</strong></td>
            <td class="right"><strong>Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}</strong></td>
        </tr>
    </table>
@endsection