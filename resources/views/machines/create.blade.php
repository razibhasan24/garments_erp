{{-- resources/views/machines/create.blade.php --}}
@extends('adminlte::page')

@section('title', 'Add Machine')

@section('content_header')
    <h1>Add Machine</h1>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-body">
            <form action="{{ route('machines.store') }}" method="POST">
                @csrf
                @include('machines.partials.form')
                <button type="submit" class="btn btn-primary mt-3">
                    <i class="fas fa-save"></i> Save Machine
                </button>
                <a href="{{ route('machines.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>
    </div>
@stop
