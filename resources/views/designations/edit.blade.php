{{-- resources/views/designations/edit.blade.php --}}
@extends('adminlte::page')

@section('title', 'Edit Designation')

@section('content_header')
    <h1>Edit Designation</h1>
@stop

@section('content')
    <div class="card card-outline card-warning">
        <div class="card-body">
            <form action="{{ route('designations.update', $designation) }}" method="POST">
                @csrf
                @method('PUT')
                @include('designations.partials.form')
                <button type="submit" class="btn btn-warning mt-3">
                    <i class="fas fa-save"></i> Update Designation
                </button>
                <a href="{{ route('designations.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>
    </div>
@stop
