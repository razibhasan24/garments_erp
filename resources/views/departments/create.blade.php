{{-- resources/views/departments/create.blade.php --}}
@extends('adminlte::page')

@section('title', 'Add Department')

@section('content_header')
    <h1>Add Department</h1>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-body">
            <form action="{{ route('departments.store') }}" method="POST">
                @csrf
                @include('departments.partials.form')
                <button type="submit" class="btn btn-primary mt-3">
                    <i class="fas fa-save"></i> Save Department
                </button>
                <a href="{{ route('departments.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>
    </div>
@stop
