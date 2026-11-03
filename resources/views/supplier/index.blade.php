@extends('layouts.app')

@section('title', 'Daftar Supplier')

@section('content')
    <div class="toolbar">
        <h2>Daftar Supplier</h2>
        <a class="btn" href="{{ route('suppliers.create') }}">+ Tambah Supplier</a>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Supplier</th>
            <th>Telepon</th>
            <th>Email</th>
            <th>Jumlah Produk</th>
            <th>Aksi</th>
        </tr>
        @forelse ($suppliers as $supplier)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $supplier->supplier_name }}</td>
                <td>{{ $supplier->phone }}</td>
                <td>{{ $supplier->email }}</td>
                <td>{{ $supplier->products_count }}</td>
                <td>
                    <div class="actions">
                        <a class="btn btn-sm" href="{{ route('suppliers.edit', $supplier) }}">Edit</a>
                        <form method="POST" action="{{ route('suppliers.destroy', $supplier) }}"
                              onsubmit="return confirm('Hapus supplier ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="empty">Belum ada supplier.</td></tr>
        @endforelse
    </table>
@endsection