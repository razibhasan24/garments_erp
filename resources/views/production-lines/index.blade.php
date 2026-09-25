{{-- resources/views/production-lines/index.blade.php --}}
@extends('adminlte::page')

@section('title', 'Production Lines')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Production Lines</h1>
        @can('create', App\Models\ProductionLine::class)
            <a href="{{ route('production-lines.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Production Line
            </a>
        @endcan
    </div>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-body">
            <table id="lines-table" class="table table-striped table-bordered w-100">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Floor</th>
                        <th>Type</th>
                        <th>Machine Cap.</th>
                        <th>Manpower Cap.</th>
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
            $('#lines-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('production-lines.index') }}",
                columns: [
                    { data: 'code', name: 'code' },
                    { data: 'name', name: 'name' },
                    { data: 'floor', name: 'floor.name' },
                    { data: 'line_type', name: 'line_type' },
                    { data: 'machine_capacity', name: 'machine_capacity' },
                    { data: 'manpower_capacity', name: 'manpower_capacity' },
                    { data: 'status_badge', name: 'is_active', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        });
    </script>
@stop
