<div class="field">
    <label for="barcode_number">Barcode</label>
    <input type="text" id="barcode_number" name="barcode_number"
           value="{{ old('barcode_number', $product->barcode_number ?? '') }}">
</div>
<div class="field">
    <label for="product_name">Nama Produk</label>
    <input type="text" id="product_name" name="product_name"
           value="{{ old('product_name', $product->product_name ?? '') }}">
</div>
<div class="field">
    <label for="buy_price">Harga Beli</label>
    <input type="number" id="buy_price" name="buy_price" min="0"
           value="{{ old('buy_price', $product->buy_price ?? '') }}">
</div>
<div class="field">
    <label for="sell_price">Harga Jual</label>
    <input type="number" id="sell_price" name="sell_price" min="0"
           value="{{ old('sell_price', $product->sell_price ?? '') }}">
</div>
<div class="field">
    <label for="supplier_id">Supplier</label>
    <select id="supplier_id" name="supplier_id">
        <option value="">Pilih Supplier</option>
        @foreach ($suppliers as $supplier)
            <option value="{{ $supplier->id }}"
                @selected(old('supplier_id', $product->supplier_id ?? '') == $supplier->id)>
                {{ $supplier->supplier_name }}
            </option>
        @endforeach
    </select>
</div>
<button type="submit" class="btn">Simpan</button>
<a class="btn btn-secondary" href="{{ route('products.index') }}">Batal</a>