<div class="field">
    <label for="supplier_name">Nama Supplier</label>
    <input type="text" id="supplier_name" name="supplier_name"
           value="{{ old('supplier_name', $supplier->supplier_name ?? '') }}">
</div>
<div class="field">
    <label for="phone">No. Telepon</label>
    <input type="text" id="phone" name="phone"
           value="{{ old('phone', $supplier->phone ?? '') }}">
</div>
<div class="field">
    <label for="email">Email</label>
    <input type="email" id="email" name="email"
           value="{{ old('email', $supplier->email ?? '') }}">
</div>
<button type="submit" class="btn">Simpan</button>
<a class="btn btn-secondary" href="{{ route('suppliers.index') }}">Batal</a>