{{-- resources/views/attendance/import.blade.php --}}
@extends('adminlte::page')
@section('title', 'Import Attendance')
@section('content_header')<h1>Import Attendance (Biometric CSV)</h1>@stop
@section('content')
<div class="card card-outline card-primary">
    <div class="card-body">
        <p class="text-muted">CSV must contain columns: <code>employee_id,attendance_date,in_time,out_time</code></p>
        <form action="{{ route('attendance.import.process') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <input type="file" name="csv_file" class="form-control" accept=".csv" required>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Import</button>
        </form>
    </div>
</div>
@stop
