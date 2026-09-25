{{-- resources/views/designations/create.blade.php --}}
@extends('adminlte::page')

@section('title', 'Add Designation')

@section('content_header')
    <h1>Add Designation</h1>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-body">
            <form action="{{ route('designations.store') }}" method="POST">
                @csrf
                @include('designations.partials.form')
                <button type="submit" class="btn btn-primary mt-3">
                    <i class="fas fa-save"></i> Save Designation
                </button>
                <a href="{{ route('designations.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>
    </div>
@stop
