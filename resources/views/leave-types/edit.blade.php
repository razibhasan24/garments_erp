{{-- resources/views/leave-types/edit.blade.php --}}
@extends('adminlte::page')

@section('title', 'Edit Leave Type')

@section('content_header')
    <h1>Edit Leave Type</h1>
@stop

@section('content')
    <div class="card card-outline card-warning">
        <div class="card-body">
            <form action="{{ route('leave-types.update', $leaveType) }}" method="POST">
                @csrf
                @method('PUT')
                @include('leave-types.partials.form')
                <button type="submit" class="btn btn-warning mt-3">
                    <i class="fas fa-save"></i> Update Leave Type
                </button>
                <a href="{{ route('leave-types.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>
    </div>
@stop
