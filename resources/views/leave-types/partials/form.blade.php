{{-- resources/views/leave-types/partials/form.blade.php --}}
@php $lt = $leaveType ?? null; @endphp

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Leave Type Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $lt->name ?? '') }}" placeholder="e.g. Casual Leave" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Code <span class="text-danger">*</span></label>
        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
               value="{{ old('code', $lt->code ?? '') }}" placeholder="e.g. CL" required>
        @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Days Per Year <span class="text-danger">*</span></label>
        <input type="number" min="0" name="days_per_year" class="form-control @error('days_per_year') is-invalid @enderror"
               value="{{ old('days_per_year', $lt->days_per_year ?? 0) }}" required>
        @error('days_per_year') <div class="invalid-feedback">{{ $message }}</div> @enderror
        <small class="text-muted">
            বাংলাদেশ শ্রম আইন অনুযায়ী: Casual 10, Sick 14, Earned/Annual leave (কর্মদিবস অনুসারে হিসাব করা যেতে পারে)।
        </small>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label d-block">Is Paid Leave?</label>
        <div class="form-check form-switch">
            <input type="checkbox" name="is_paid" class="form-check-input" value="1"
                   @checked(old('is_paid', $lt->is_paid ?? true))>
            <label class="form-check-label">Paid</label>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="form-check form-switch">
            <input type="checkbox" name="is_active" class="form-check-input" value="1"
                   @checked(old('is_active', $lt->is_active ?? true))>
            <label class="form-check-label">Active</label>
        </div>
    </div>
</div>
