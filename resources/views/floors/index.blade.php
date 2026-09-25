{{-- resources/views/floors/index.blade.php --}}
@extends('adminlte::page')

@section('title', 'Floors')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Floors</h1>
        @can('create', App\Models\Floor::class)
            <a href="{{ route('floors.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Floor
            </a>
        @endcan
    </div>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-body">
            <table id="floors-table" class="table table-striped table-bordered w-100">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Area (sqft)</th>
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
            $('#floors-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('floors.index') }}",
                columns: [
                    { data: 'code', name: 'code' },
                    { data: 'name', name: 'name' },
                    { data: 'total_area_sqft', name: 'total_area_sqft' },
                    { data: 'status_badge', name: 'is_active', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        });
    </script>
@stop
