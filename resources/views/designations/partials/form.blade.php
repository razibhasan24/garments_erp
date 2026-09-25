{{-- resources/views/designations/partials/form.blade.php --}}
@php $d = $designation ?? null; @endphp

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Department</label>
        <select name="department_id" class="form-select @error('department_id') is-invalid @enderror">
            <option value="">-- None --</option>
            @foreach ($departments as $dept)
                <option value="{{ $dept->id }}" @selected(old('department_id', $d->department_id ?? '') == $dept->id)>{{ $dept->name }}</option>
            @endforeach
        </select>
        @error('department_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Designation Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $d->name ?? '') }}" placeholder="e.g. Sewing Operator" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Designation Code <span class="text-danger">*</span></label>
        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
               value="{{ old('code', $d->code ?? '') }}" placeholder="e.g. DESG-OP" required>
        @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Grade Level (1-7)</label>
        <input type="number" min="1" max="7" name="grade_level" class="form-control @error('grade_level') is-invalid @enderror"
               value="{{ old('grade_level', $d->grade_level ?? '') }}">
        @error('grade_level') <div class="invalid-feedback">{{ $message }}</div> @enderror
        <small class="text-muted">বাংলাদেশ RMG সেক্টরের গ্রেড অনুযায়ী (Grade 1 = সর্বোচ্চ)</small>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Default Basic Salary</label>
        <input type="number" step="0.01" min="0" name="default_basic_salary" class="form-control @error('default_basic_salary') is-invalid @enderror"
               value="{{ old('default_basic_salary', $d->default_basic_salary ?? '') }}">
        @error('default_basic_salary') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <div class="form-check form-switch">
            <input type="checkbox" name="is_active" class="form-check-input" value="1"
                   @checked(old('is_active', $d->is_active ?? true))>
            <label class="form-check-label">Active</label>
        </div>
    </div>
</div>
