@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
    <div class="toolbar">
        <h2>Daftar Produk</h2>
        <a class="btn" href="{{ route('products.create') }}">+ Tambah Produk</a>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Barcode</th>
            <th>Nama Produk</th>
            <th class="right">Harga Beli</th>
            <th class="right">Harga Jual</th>
            <th>Supplier</th>
            <th>Aksi</th>
        </tr>
        @forelse ($products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $product->barcode_number ?? '-' }}</td>
                <td>{{ $product->product_name }}</td>
                <td class="right">Rp {{ number_format($product->buy_price, 0, ',', '.') }}</td>
                <td class="right">Rp {{ number_format($product->sell_price, 0, ',', '.') }}</td>
                <td>{{ $product->supplier->supplier_name ?? '-' }}</td>
                <td>
                    <div class="actions">
                        <a class="btn btn-secondary btn-sm" href="{{ route('products.show', $product) }}">Detail</a>
                        <a class="btn btn-sm" href="{{ route('products.edit', $product) }}">Edit</a>
                        <form method="POST" action="{{ route('products.destroy', $product) }}"
                              onsubmit="return confirm('Hapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr><td colspan="7" class="empty">Belum ada produk.</td></tr>
        @endforelse
    </table>
@endsection