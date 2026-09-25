{{-- resources/views/leave-types/create.blade.php --}}
@extends('adminlte::page')

@section('title', 'Add Leave Type')

@section('content_header')
    <h1>Add Leave Type</h1>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-body">
            <form action="{{ route('leave-types.store') }}" method="POST">
                @csrf
                @include('leave-types.partials.form')
                <button type="submit" class="btn btn-primary mt-3">
                    <i class="fas fa-save"></i> Save Leave Type
                </button>
                <a href="{{ route('leave-types.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>
    </div>
@stop
