{{-- resources/views/attendance/index.blade.php --}}
@extends('adminlte::page')
@section('title', 'Attendance')
@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>Attendance</h1>
    <div>
        <a href="{{ route('attendance.create') }}" class="btn btn-primary"><i class="fas fa-edit"></i> Mark Attendance</a>
        <a href="{{ route('attendance.import') }}" class="btn btn-secondary"><i class="fas fa-upload"></i> Import CSV</a>
    </div>
</div>
@stop
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <form method="GET" class="d-flex gap-2">
            <input type="date" name="date" value="{{ request('date', now()->toDateString()) }}" class="form-control" style="max-width:200px" onchange="table.ajax.reload()" id="filter-date">
        </form>
    </div>
    <div class="card-body">
        <table id="attendance-table" class="table table-striped table-bordered w-100">
            <thead><tr><th>Employee</th><th>In Time</th><th>Out Time</th><th>Working Hrs</th><th>OT Hrs</th><th>Status</th></tr></thead>
        </table>
    </div>
</div>
@stop
@section('css')<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">@stop
@section('js')
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
<script>
let table;
$(function () {
    table = $('#attendance-table').DataTable({
        processing: true, serverSide: true,
        ajax: {
            url: "{{ route('attendance.index') }}",
            data: function (d) { d.date = $('#filter-date').val(); }
        },
        columns: [
            { data: 'employee_name', name: 'employee.name' },
            { data: 'in_time', name: 'in_time' },
            { data: 'out_time', name: 'out_time' },
            { data: 'working_hours', name: 'working_hours' },
            { data: 'overtime_hours', name: 'overtime_hours' },
            { data: 'status_badge', name: 'status', orderable: false, searchable: false },
        ]
    });
});
</script>
@stop
