@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
    <h2>Tambah Produk</h2>
    <form method="POST" action="{{ route('products.store') }}" class="card form">
        @csrf
        @include('product._form')
    </form>
@endsection