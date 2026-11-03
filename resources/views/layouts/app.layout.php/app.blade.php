<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'PWL 2026')</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: system-ui, Arial, sans-serif; margin: 0; background: #f4f5f7; color: #1f2937; }
        nav { background: #1f2937; padding: 0 24px; display: flex; flex-wrap: wrap; align-items: center; gap: 4px; }
        nav .brand { color: #fff; font-weight: 700; margin-right: 16px; }
        nav a { color: #d1d5db; text-decoration: none; padding: 14px 12px; display: inline-block; }
        nav a:hover, nav a.active { color: #fff; background: #374151; }
        main { max-width: 1000px; margin: 24px auto; padding: 0 16px; }
        h2 { margin: 0 0 16px; }
        h3 { margin: 24px 0 8px; }
        a { color: #2563eb; }
        .card { background: #fff; border-radius: 8px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,.08); }
        .form { max-width: 520px; }
        table { width: 100%; border-collapse: collapse; background: #fff; }
        th, td { padding: 10px 12px; border-bottom: 1px solid #e5e7eb; text-align: left; vertical-align: middle; }
        th { background: #f9fafb; font-size: 12px; text-transform: uppercase; letter-spacing: .04em; color: #6b7280; }
        .right { text-align: right; }
        .empty { text-align: center; color: #6b7280; }
        .actions { display: flex; gap: 6px; flex-wrap: wrap; }
        .actions form { margin: 0; }
        .toolbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
        .toolbar h2 { margin: 0; }
        .btn { display: inline-block; background: #2563eb; color: #fff; border: 0; border-radius: 6px; padding: 8px 14px; font-size: 14px; cursor: pointer; text-decoration: none; }
        .btn:hover { opacity: .9; }
        .btn-secondary { background: #6b7280; }
        .btn-danger { background: #dc2626; }
        .btn-sm { padding: 5px 10px; font-size: 13px; }
        .field { margin-bottom: 14px; }
        .field label { display: block; font-weight: 600; margin-bottom: 4px; }
        input, select { width: 100%; padding: 8px 10px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px; background: #fff; }
        .alert { padding: 10px 14px; border-radius: 6px; margin-bottom: 16px; }
        .alert ul { margin: 0; padding-left: 18px; }
        .alert-ok { background: #dcfce7; color: #166534; }
        .alert-err { background: #fee2e2; color: #991b1b; }
        .stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 24px; }
        .stat { background: #fff; border-radius: 8px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,.08); }
        .stat .num { font-size: 32px; font-weight: 700; }
        .stat .label { color: #6b7280; }
        .detail th { width: 200px; background: #f9fafb; }
        .badge { padding: 2px 8px; border-radius: 999px; font-size: 12px; background: #e5e7eb; }
        .badge-pembelian { background: #dbeafe; color: #1e40af; }
        .badge-penjualan { background: #dcfce7; color: #166534; }
    </style>
</head>
<body>
<nav>
    <span class="brand">PWL 2026</span>
    <a href="{{ route('home') }}" @class(['active' => request()->routeIs('home')])>Beranda</a>
    <a href="{{ route('products.index') }}" @class(['active' => request()->routeIs('products.*')])>Produk</a>
    <a href="{{ route('suppliers.index') }}" @class(['active' => request()->routeIs('suppliers.*')])>Supplier</a>
    <a href="{{ route('transactions.index') }}" @class(['active' => request()->routeIs('transactions.*')])>Transaksi</a>
</nav>

<main>
    @if (session('success'))
        <div class="alert alert-ok">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-err">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</main>

@stack('scripts')
</body>
</html>