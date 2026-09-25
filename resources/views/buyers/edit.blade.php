{{-- resources/views/buyers/edit.blade.php --}}
@extends('adminlte::page')

@section('title', 'Edit Buyer')

@section('content_header')
    <h1>Edit Buyer</h1>
@stop

@section('content')
    <div class="card card-outline card-warning">
        <div class="card-body">
            <form action="{{ route('buyers.update', $buyer) }}" method="POST">
                @csrf
                @method('PUT')
                @include('buyers.partials.form')
                <button type="submit" class="btn btn-warning mt-3">
                    <i class="fas fa-save"></i> Update Buyer
                </button>
                <a href="{{ route('buyers.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>
    </div>
@stop
