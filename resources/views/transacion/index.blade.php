@extends('layouts.app')

@section('title', 'Daftar Transaksi')

@section('content')
    <div class="toolbar">
        <h2>Daftar Transaksi</h2>
        <a class="btn" href="{{ route('transactions.create') }}">+ Transaksi Baru</a>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Invoice</th>
            <th>Tipe</th>
            <th>Supplier</th>
            <th class="right">Subtotal</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
        @forelse ($transactions as $t)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $t->invoice_number }}</td>
                <td><span class="badge badge-{{ $t->transaction_type }}">{{ ucfirst($t->transaction_type) }}</span></td>
                <td>{{ $t->supplier->supplier_name ?? '-' }}</td>
                <td class="right">Rp {{ number_format($t->subtotal, 0, ',', '.') }}</td>
                <td>{{ $t->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <div class="actions">
                        <a class="btn btn-secondary btn-sm" href="{{ route('transactions.show', $t) }}">Detail</a>
                        <form method="POST" action="{{ route('transactions.destroy', $t) }}"
                              onsubmit="return confirm('Hapus transaksi ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr><td colspan="7" class="empty">Belum ada transaksi.</td></tr>
        @endforelse
    </table>
@endsection