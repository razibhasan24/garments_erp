{{-- resources/views/machines/index.blade.php --}}
@extends('adminlte::page')

@section('title', 'Machines')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Machines</h1>
        @can('create', App\Models\Machine::class)
            <a href="{{ route('machines.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Machine
            </a>
        @endcan
    </div>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-body">
            <table id="machines-table" class="table table-striped table-bordered w-100">
                <thead>
                    <tr>
                        <th>Asset Code</th>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Model No.</th>
                        <th>Floor</th>
                        <th>Line</th>
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
            $('#machines-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('machines.index') }}",
                columns: [
                    { data: 'asset_code', name: 'asset_code' },
                    { data: 'name', name: 'name' },
                    { data: 'brand', name: 'brand' },
                    { data: 'model_no', name: 'model_no' },
                    { data: 'floor', name: 'floor.name' },
                    { data: 'line', name: 'productionLine.name' },
                    { data: 'status_badge', name: 'status', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        });
    </script>
@stop
