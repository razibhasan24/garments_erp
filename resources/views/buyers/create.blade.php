{{-- resources/views/buyers/create.blade.php --}}
@extends('adminlte::page')

@section('title', 'Add Buyer')

@section('content_header')
    <h1>Add Buyer</h1>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-body">
            <form action="{{ route('buyers.store') }}" method="POST">
                @csrf
                @include('buyers.partials.form')
                <button type="submit" class="btn btn-primary mt-3">
                    <i class="fas fa-save"></i> Save Buyer
                </button>
                <a href="{{ route('buyers.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>
    </div>
@stop
