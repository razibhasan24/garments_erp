{{-- resources/views/leave-applications/partials/form.blade.php --}}
@php $l = $leave ?? null; @endphp

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Employee <span class="text-danger">*</span></label>
        <select name="employee_id" class="form-select @error('employee_id') is-invalid @enderror" required>
            <option value="">-- Select Employee --</option>
            @foreach ($employees as $emp)
                <option value="{{ $emp->id }}" @selected(old('employee_id', $l->employee_id ?? '') == $emp->id)>
                    {{ $emp->name }} ({{ $emp->employee_id }})
                </option>
            @endforeach
        </select>
        @error('employee_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Leave Type <span class="text-danger">*</span></label>
        <select name="leave_type_id" class="form-select @error('leave_type_id') is-invalid @enderror" required>
            <option value="">-- Select Leave Type --</option>
            @foreach ($leaveTypes as $lt)
                <option value="{{ $lt->id }}" @selected(old('leave_type_id', $l->leave_type_id ?? '') == $lt->id)>
                    {{ $lt->name }} ({{ $lt->days_per_year }} days/year)
                </option>
            @endforeach
        </select>
        @error('leave_type_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">From Date <span class="text-danger">*</span></label>
        <input type="date" name="from_date" class="form-control @error('from_date') is-invalid @enderror"
               value="{{ old('from_date', $l?->from_date?->format('Y-m-d')) }}" required>
        @error('from_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">To Date <span class="text-danger">*</span></label>
        <input type="date" name="to_date" class="form-control @error('to_date') is-invalid @enderror"
               value="{{ old('to_date', $l?->to_date?->format('Y-m-d')) }}" required>
        @error('to_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label">Reason</label>
        <textarea name="reason" class="form-control" rows="2">{{ old('reason', $l->reason ?? '') }}</textarea>
    </div>
</div>
