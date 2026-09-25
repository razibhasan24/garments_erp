{{-- resources/views/buyers/index.blade.php --}}
@extends('adminlte::page')

@section('title', 'Buyers')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Buyers</h1>
        @can('create', App\Models\Buyer::class)
            <a href="{{ route('buyers.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Buyer
            </a>
        @endcan
    </div>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-body">
            <table id="buyers-table" class="table table-striped table-bordered w-100">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Country</th>
                        <th>Type</th>
                        <th>Contact Person</th>
                        <th>Phone</th>
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
            $('#buyers-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('buyers.index') }}",
                columns: [
                    { data: 'code', name: 'code' },
                    { data: 'name', name: 'name' },
                    { data: 'country', name: 'country' },
                    { data: 'buyer_type', name: 'buyer_type' },
                    { data: 'contact_person', name: 'contact_person' },
                    { data: 'phone', name: 'phone' },
                    { data: 'status_badge', name: 'is_active', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        });
    </script>
@stop
