{{-- resources/views/leave-types/index.blade.php --}}
@extends('adminlte::page')

@section('title', 'Leave Types')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Leave Types</h1>
        <a href="{{ route('leave-types.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Leave Type
        </a>
    </div>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-body">
            <table id="leave-types-table" class="table table-striped table-bordered w-100">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Days / Year</th>
                        <th>Paid</th>
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
            $('#leave-types-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('leave-types.index') }}",
                columns: [
                    { data: 'code', name: 'code' },
                    { data: 'name', name: 'name' },
                    { data: 'days_per_year', name: 'days_per_year' },
                    {
                        data: 'is_paid', name: 'is_paid', orderable: false, searchable: false,
                        render: function (data) {
                            return data
                                ? '<span class="badge bg-success">Paid</span>'
                                : '<span class="badge bg-secondary">Unpaid</span>';
                        }
                    },
                    {
                        data: 'is_active', name: 'is_active', orderable: false, searchable: false,
                        render: function (data) {
                            return data
                                ? '<span class="badge bg-success">Active</span>'
                                : '<span class="badge bg-secondary">Inactive</span>';
                        }
                    },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        });
    </script>
@stop
