{{-- resources/views/attendance/create.blade.php --}}
@extends('adminlte::page')
@section('title', 'Mark Attendance')
@section('content_header')<h1>Mark Attendance</h1>@stop
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <form method="GET" class="form-inline d-flex gap-2">
            <input type="date" name="date" value="{{ $date }}" class="form-control" onchange="this.form.submit()">
        </form>
    </div>
    <div class="card-body">
        <form action="{{ route('attendance.store') }}" method="POST">
            @csrf
            <input type="hidden" name="attendance_date" value="{{ $date }}">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Emp ID</th><th>Name</th><th>Status</th><th>In Time</th><th>Out Time</th><th>OT (hrs)</th><th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $i => $emp)
                        @php $att = $existing[$emp->id] ?? null; @endphp
                        <tr>
                            <td>{{ $emp->employee_id }}
                                <input type="hidden" name="entries[{{ $i }}][employee_id]" value="{{ $emp->id }}">
                            </td>
                            <td>{{ $emp->name }}</td>
                            <td>
                                <select name="entries[{{ $i }}][status]" class="form-select form-select-sm">
                                    @foreach (['Present','Absent','Leave','Holiday','Weekend','Late'] as $s)
                                        <option value="{{ $s }}" @selected(($att->status ?? 'Present') === $s)>{{ $s }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="time" name="entries[{{ $i }}][in_time]" class="form-control form-control-sm" value="{{ $att->in_time ?? '' }}"></td>
                            <td><input type="time" name="entries[{{ $i }}][out_time]" class="form-control form-control-sm" value="{{ $att->out_time ?? '' }}"></td>
                            <td><input type="number" step="0.5" name="entries[{{ $i }}][overtime_hours]" class="form-control form-control-sm" value="{{ $att->overtime_hours ?? 0 }}"></td>
                            <td><input type="text" name="entries[{{ $i }}][remarks]" class="form-control form-control-sm" value="{{ $att->remarks ?? '' }}"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Attendance</button>
        </form>
    </div>
</div>
@stop
