{{-- resources/views/attendance/edit.blade.php --}}
@extends('adminlte::page')

@section('title', 'Edit Attendance')

@section('content_header')
    <h1>Edit Attendance Record</h1>
@stop

@section('content')
    <div class="card card-outline card-warning">
        <div class="card-header">
            <strong>{{ $attendance->employee->name }}</strong> ({{ $attendance->employee->employee_id }}) —
            {{ $attendance->attendance_date->format('d M, Y') }}
        </div>
        <div class="card-body">
            <form action="{{ route('attendance.update', $attendance) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            @foreach (['Present', 'Absent', 'Leave', 'Holiday', 'Weekend', 'Late'] as $s)
                                <option value="{{ $s }}" @selected(old('status', $attendance->status) === $s)>{{ $s }}</option>
                            @endforeach
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">In Time</label>
                        <input type="time" name="in_time" class="form-control @error('in_time') is-invalid @enderror"
                               value="{{ old('in_time', $attendance->in_time) }}">
                        @error('in_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Out Time</label>
                        <input type="time" name="out_time" class="form-control @error('out_time') is-invalid @enderror"
                               value="{{ old('out_time', $attendance->out_time) }}">
                        @error('out_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Overtime Hours</label>
                        <input type="number" step="0.5" min="0" max="12" name="overtime_hours"
                               class="form-control @error('overtime_hours') is-invalid @enderror"
                               value="{{ old('overtime_hours', $attendance->overtime_hours) }}">
                        @error('overtime_hours') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Remarks</label>
                        <textarea name="remarks" class="form-control" rows="2">{{ old('remarks', $attendance->remarks) }}</textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Update Attendance</button>
                <a href="{{ route('attendance.index', ['date' => $attendance->attendance_date->toDateString()]) }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@stop
