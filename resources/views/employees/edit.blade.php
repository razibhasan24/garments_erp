{{-- resources/views/employees/edit.blade.php --}}
@extends('adminlte::page')
@section('title', 'Edit Employee')
@section('content_header')<h1>Edit Employee</h1>@stop
@section('content')
<div class="card card-outline card-warning">
    <div class="card-body">
        <form action="{{ route('employees.update', $employee) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('employees.partials.form')
            <button type="submit" class="btn btn-warning mt-3"><i class="fas fa-save"></i> Update Employee</button>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary mt-3">Cancel</a>
        </form>
    </div>
</div>
@stop
