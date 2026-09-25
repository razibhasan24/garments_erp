{{-- resources/views/floors/create.blade.php --}}
@extends('adminlte::page')

@section('title', 'Add Floor')

@section('content_header')
    <h1>Add Floor</h1>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-body">
            <form action="{{ route('floors.store') }}" method="POST">
                @csrf
                @include('floors.partials.form')
                <button type="submit" class="btn btn-primary mt-3">
                    <i class="fas fa-save"></i> Save Floor
                </button>
                <a href="{{ route('floors.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>
    </div>
@stop
