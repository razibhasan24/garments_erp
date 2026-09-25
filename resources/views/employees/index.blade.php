{{-- resources/views/employees/index.blade.php --}}
@extends('adminlte::page')
@section('title', 'Employees')
@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>Employees</h1>
    @can('create', App\Models\Employee::class)
        <a href="{{ route('employees.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Employee</a>
    @endcan
</div>
@stop
@section('content')
<div class="card card-outline card-primary">
    <div class="card-body">
        <table id="employees-table" class="table table-striped table-bordered w-100">
            <thead>
                <tr>
                    <th>Emp ID</th><th>Name</th><th>Department</th><th>Designation</th>
                    <th>Phone</th><th>Joining Date</th><th>Status</th><th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@stop
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
@stop
@section('js')
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
<script>
$(function () {
    $('#employees-table').DataTable({
        processing: true, serverSide: true,
        ajax: "{{ route('employees.index') }}",
        columns: [
            { data: 'employee_id', name: 'employee_id' },
            { data: 'name', name: 'name' },
            { data: 'department', name: 'department' },
            { data: 'designation', name: 'designation' },
            { data: 'phone', name: 'phone' },
            { data: 'joining_date', name: 'joining_date' },
            { data: 'status_badge', name: 'status', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });
});
</script>
@stop
