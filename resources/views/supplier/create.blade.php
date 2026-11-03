@extends('layouts.app')

@section('title', 'Tambah Supplier')

@section('content')
    <h2>Tambah Supplier</h2>
    <form method="POST" action="{{ route('suppliers.store') }}" class="card form">
        @csrf
        @include('supplier._form')
    </form>
@endsection