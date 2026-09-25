{{-- resources/views/leave-applications/create.blade.php --}}
@extends('adminlte::page')
@section('title', 'Apply Leave')
@section('content_header')<h1>Apply for Leave</h1>@stop
@section('content')
<div class="card card-outline card-primary">
    <div class="card-body">
        <form action="{{ route('leave-applications.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Employee <span class="text-danger">*</span></label>
                    <select name="employee_id" class="form-select" required>
                        @foreach ($employees as $emp)
                            <option value="{{ $emp->id }}">{{ $emp->name }} ({{ $emp->employee_id }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Leave Type <span class="text-danger">*</span></label>
                    <select name="leave_type_id" class="form-select" required>
                        @foreach ($leaveTypes as $lt)
                            <option value="{{ $lt->id }}">{{ $lt->name }} ({{ $lt->days_per_year }} days/year)</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">From Date <span class="text-danger">*</span></label>
                    <input type="date" name="from_date" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">To Date <span class="text-danger">*</span></label>
                    <input type="date" name="to_date" class="form-control" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Reason</label>
                    <textarea name="reason" class="form-control" rows="2"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit Application</button>
            <a href="{{ route('leave-applications.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@stop
