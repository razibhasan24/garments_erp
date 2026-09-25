{{-- resources/views/production-lines/create.blade.php --}}
@extends('adminlte::page')

@section('title', 'Add Production Line')

@section('content_header')
    <h1>Add Production Line</h1>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-body">
            <form action="{{ route('production-lines.store') }}" method="POST">
                @csrf
                @include('production-lines.partials.form')
                <button type="submit" class="btn btn-primary mt-3">
                    <i class="fas fa-save"></i> Save Production Line
                </button>
                <a href="{{ route('production-lines.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>
    </div>
@stop
