{{-- resources/views/floors/edit.blade.php --}}
@extends('adminlte::page')

@section('title', 'Edit Floor')

@section('content_header')
    <h1>Edit Floor</h1>
@stop

@section('content')
    <div class="card card-outline card-warning">
        <div class="card-body">
            <form action="{{ route('floors.update', $floor) }}" method="POST">
                @csrf
                @method('PUT')
                @include('floors.partials.form')
                <button type="submit" class="btn btn-warning mt-3">
                    <i class="fas fa-save"></i> Update Floor
                </button>
                <a href="{{ route('floors.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>
    </div>
@stop
