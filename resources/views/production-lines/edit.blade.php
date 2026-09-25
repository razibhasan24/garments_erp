{{-- resources/views/production-lines/edit.blade.php --}}
@extends('adminlte::page')

@section('title', 'Edit Production Line')

@section('content_header')
    <h1>Edit Production Line</h1>
@stop

@section('content')
    <div class="card card-outline card-warning">
        <div class="card-body">
            <form action="{{ route('production-lines.update', $line) }}" method="POST">
                @csrf
                @method('PUT')
                @include('production-lines.partials.form')
                <button type="submit" class="btn btn-warning mt-3">
                    <i class="fas fa-save"></i> Update Production Line
                </button>
                <a href="{{ route('production-lines.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>
    </div>
@stop
