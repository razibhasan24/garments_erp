{{-- resources/views/machines/edit.blade.php --}}
@extends('adminlte::page')

@section('title', 'Edit Machine')

@section('content_header')
    <h1>Edit Machine</h1>
@stop

@section('content')
    <div class="card card-outline card-warning">
        <div class="card-body">
            <form action="{{ route('machines.update', $machine) }}" method="POST">
                @csrf
                @method('PUT')
                @include('machines.partials.form')
                <button type="submit" class="btn btn-warning mt-3">
                    <i class="fas fa-save"></i> Update Machine
                </button>
                <a href="{{ route('machines.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>
    </div>
@stop
