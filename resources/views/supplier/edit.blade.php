@extends('layouts.app')

@section('title', 'Edit Supplier')

@section('content')
    <h2>Edit Supplier</h2>
    <form method="POST" action="{{ route('suppliers.update', $supplier) }}" class="card form">
        @csrf
        @method('PUT')
        @include('supplier._form')
    </form>
@endsection