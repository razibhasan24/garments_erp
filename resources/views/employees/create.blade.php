{{-- resources/views/employees/create.blade.php --}}
@extends('adminlte::page')

@section('title', 'Add Employee')

@section('content_header')
    <h1>Add Employee</h1>
@stop

@section('content')
<div class="card card-outline card-primary">
    <div class="card-body">
        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('employees.partials.form')
            <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-save"></i> Save Employee</button>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary mt-3">Cancel</a>
        </form>
    </div>
</div>
@stop
