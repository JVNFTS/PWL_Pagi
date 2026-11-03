@extends('layouts.app')

@section('title', 'Transaksi Baru')

@section('content')
    <h2>Transaksi Baru</h2>

    <form method="POST" action="{{ route('transactions.store') }}" class="card">
        @csrf

        <div class="form">
            <div class="field">
                <label for="type">Tipe Transaksi</label>
                <select id="type" name="transaction_type">
                    <option value="pembelian" @selected(old('transaction_type') === 'pembelian')>Pembelian</option>
                    <option value="penjualan" @selected(old('transaction_type') === 'penjualan')>Penjualan</option>
                </select>
            </div>
            <div class="field">
                <label for="supplier_id">Supplier</label>
                <select id="supplier_id" name="supplier_id">
                    <option value="">Pilih Supplier</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" @selected(old('supplier_id') == $supplier->id)>
                            {{ $supplier->supplier_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <h3>Item</h3>
        <table id="items">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th style="width:100px">Jumlah</th>
                    <th style="width:150px">Harga</th>
                    <th class="right" style="width:150px">Total</th>
                    <th style="width:80px"></th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="right"><strong>Subtotal</strong></td>
                    <td class="right"><strong id="subtotal">Rp 0</strong></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>

        <p><button type="button" class="btn btn-secondary" id="addRow">+ Tambah Item</button></p>

        <button type="submit" class="btn">Simpan Transaksi</button>
        <a class="btn btn-secondary" href="{{ route('transactions.index') }}">Batal</a>
    </form>
@endsection

@push('scripts')
<script>
    const products = @json($productData);
    const oldItems = @json(old('items', []));

    const tbody = document.querySelector('#items tbody');
    let idx = 0;

    const rupiah = n => 'Rp ' + Number(n || 0).toLocaleString('id-ID');
    const esc = s => String(s).replace(/[&<>"']/g, c => ({
        '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
    }[c]));

    function recalc() {
        let sum = 0;
        tbody.querySelectorAll('tr').forEach(tr => {
            const q = Number(tr.querySelector('.q').value) || 0;
            const p = Number(tr.querySelector('.pr').value) || 0;
            tr.querySelector('.t').textContent = rupiah(q * p);
            sum += q * p;
        });
        document.getElementById('subtotal').textContent = rupiah(sum);
    }

    function addRow(item = {}) {
        const i = idx++;
        const options = products.map(p =>
            `<option value="${p.id}" ${String(item.product_id) === String(p.id) ? 'selected' : ''}>${esc(p.name)}</option>`
        ).join('');

        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td><select name="items[${i}][product_id]" class="p"><option value="">Pilih Produk</option>${options}</select></td>
            <td><input type="number" name="items[${i}][quantity]" class="q" min="1" value="${item.quantity ?? 1}"></td>
            <td><input type="number" name="items[${i}][price]" class="pr" min="0" value="${item.price ?? ''}"></td>
            <td class="t right">Rp 0</td>
            <td><button type="button" class="btn btn-danger btn-sm rm">Hapus</button></td>`;
        tbody.appendChild(tr);
        recalc();
    }

    tbody.addEventListener('change', e => {
        if (e.target.classList.contains('p')) {
            const p = products.find(x => String(x.id) === e.target.value);
            if (p) {
                const isSale = document.getElementById('type').value === 'penjualan';
                e.target.closest('tr').querySelector('.pr').value = isSale ? p.sell : p.buy;
            }
        }
        recalc();
    });
    tbody.addEventListener('input', recalc);
    tbody.addEventListener('click', e => {
        if (e.target.classList.contains('rm')) {
            e.target.closest('tr').remove();
            recalc();
        }
    });
    document.getElementById('addRow').addEventListener('click', () => addRow());

    const restored = Object.values(oldItems);
    if (restored.length) {
        restored.forEach(addRow);
    } else {
        addRow();
    }
</script>
@endpush