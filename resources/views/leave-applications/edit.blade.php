{{-- resources/views/leave-applications/edit.blade.php --}}
@extends('adminlte::page')

@section('title', 'Edit Leave Application')

@section('content_header')
    <h1>Edit Leave Application</h1>
@stop

@section('content')
    <div class="card card-outline card-warning">
        <div class="card-body">
            <form action="{{ route('leave-applications.update', $leave) }}" method="POST">
                @csrf
                @method('PUT')
                @include('leave-applications.partials.form')
                <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Update Application</button>
                <a href="{{ route('leave-applications.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@stop
