@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
    <div class="toolbar">
        <h2>Detail Produk</h2>
        <div class="actions">
            <a class="btn btn-secondary" href="{{ route('products.index') }}">Kembali</a>
            <a class="btn" href="{{ route('products.edit', $product) }}">Edit</a>
        </div>
    </div>

    <table class="detail">
        <tr><th>Barcode</th><td>{{ $product->barcode_number ?? '-' }}</td></tr>
        <tr><th>Nama Produk</th><td>{{ $product->product_name }}</td></tr>
        <tr><th>Harga Beli</th><td>Rp {{ number_format($product->buy_price, 0, ',', '.') }}</td></tr>
        <tr><th>Harga Jual</th><td>Rp {{ number_format($product->sell_price, 0, ',', '.') }}</td></tr>
        <tr><th>Margin</th><td>Rp {{ number_format($product->sell_price - $product->buy_price, 0, ',', '.') }}</td></tr>
        <tr><th>Supplier</th><td>{{ $product->supplier->supplier_name ?? '-' }}</td></tr>
        <tr><th>Dibuat</th><td>{{ $product->created_at?->format('d/m/Y H:i') }}</td></tr>
        <tr><th>Diperbarui</th><td>{{ $product->updated_at?->format('d/m/Y H:i') }}</td></tr>
    </table>
@endsection