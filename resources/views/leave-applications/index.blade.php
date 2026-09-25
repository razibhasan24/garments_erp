{{-- resources/views/leave-applications/index.blade.php --}}
@extends('adminlte::page')

@section('title', 'Leave Applications')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Leave Applications</h1>
        <a href="{{ route('leave-applications.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Apply Leave
        </a>
    </div>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <ul class="nav nav-pills" id="status-filter">
                <li class="nav-item">
                    <a class="nav-link active" href="#" data-status="">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-status="Pending">Pending</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-status="Approved">Approved</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-status="Rejected">Rejected</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <table id="leave-applications-table" class="table table-striped table-bordered w-100">
                <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Leave Type</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Total Days</th>
                        <th>Reason</th>
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
    <style>
        #status-filter .nav-link { cursor: pointer; }
    </style>
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(function () {
            let currentStatus = '';

            let table = $('#leave-applications-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('leave-applications.index') }}",
                    data: function (d) {
                        d.status = currentStatus;
                    }
                },
                columns: [
                    { data: 'employee_name', name: 'employee.name' },
                    { data: 'leave_type', name: 'leaveType.name' },
                    { data: 'from_date', name: 'from_date' },
                    { data: 'to_date', name: 'to_date' },
                    { data: 'total_days', name: 'total_days' },
                    { data: 'reason', name: 'reason' },
                    { data: 'status_badge', name: 'status', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });

            $('#status-filter .nav-link').on('click', function (e) {
                e.preventDefault();
                $('#status-filter .nav-link').removeClass('active');
                $(this).addClass('active');
                currentStatus = $(this).data('status');
                table.ajax.reload();
            });
        });
    </script>
@stop
