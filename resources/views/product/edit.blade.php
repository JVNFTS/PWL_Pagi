@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
    <h2>Edit Produk</h2>
    <form method="POST" action="{{ route('products.update', $product) }}" class="card form">
        @csrf
        @method('PUT')
        @include('product._form')
    </form>
@endsection