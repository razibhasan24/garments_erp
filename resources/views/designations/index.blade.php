{{-- resources/views/designations/index.blade.php --}}
@extends('adminlte::page')

@section('title', 'Designations')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Designations</h1>
        @can('create', App\Models\Designation::class)
            <a href="{{ route('designations.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Designation
            </a>
        @endcan
    </div>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-body">
            <table id="designations-table" class="table table-striped table-bordered w-100">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Grade</th>
                        <th>Default Basic Salary</th>
                        <th>Status</th>
                        <th>Action</th>
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
            $('#designations-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('designations.index') }}",
                columns: [
                    { data: 'code', name: 'code' },
                    { data: 'name', name: 'name' },
                    { data: 'department', name: 'department.name' },
                    { data: 'grade_level', name: 'grade_level' },
                    { data: 'default_basic_salary', name: 'default_basic_salary' },
                    { data: 'status_badge', name: 'is_active', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        });
    </script>
@stop
