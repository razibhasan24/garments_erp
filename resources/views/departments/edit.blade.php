{{-- resources/views/departments/edit.blade.php --}}
@extends('adminlte::page')

@section('title', 'Edit Department')

@section('content_header')
    <h1>Edit Department</h1>
@stop

@section('content')
    <div class="card card-outline card-warning">
        <div class="card-body">
            <form action="{{ route('departments.update', $department) }}" method="POST">
                @csrf
                @method('PUT')
                @include('departments.partials.form')
                <button type="submit" class="btn btn-warning mt-3">
                    <i class="fas fa-save"></i> Update Department
                </button>
                <a href="{{ route('departments.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>
    </div>
@stop
