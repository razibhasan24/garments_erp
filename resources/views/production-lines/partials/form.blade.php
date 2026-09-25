{{-- resources/views/production-lines/partials/form.blade.php --}}
@php $l = $line ?? null; @endphp

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Floor <span class="text-danger">*</span></label>
        <select name="floor_id" class="form-select @error('floor_id') is-invalid @enderror" required>
            <option value="">-- Select Floor --</option>
            @foreach ($floors as $f)
                <option value="{{ $f->id }}" @selected(old('floor_id', $l->floor_id ?? '') == $f->id)>{{ $f->name }}</option>
            @endforeach
        </select>
        @error('floor_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Line Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $l->name ?? '') }}" placeholder="e.g. Line-01" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Line Code <span class="text-danger">*</span></label>
        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
               value="{{ old('code', $l->code ?? '') }}" placeholder="e.g. LN-01" required>
        @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Line Type <span class="text-danger">*</span></label>
        <select name="line_type" class="form-select @error('line_type') is-invalid @enderror" required>
            @foreach (['Sewing', 'Cutting', 'Finishing', 'Packing'] as $type)
                <option value="{{ $type }}" @selected(old('line_type', $l->line_type ?? 'Sewing') === $type)>{{ $type }}</option>
            @endforeach
        </select>
        @error('line_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Machine Capacity</label>
        <input type="number" min="0" name="machine_capacity" class="form-control @error('machine_capacity') is-invalid @enderror"
               value="{{ old('machine_capacity', $l->machine_capacity ?? 0) }}">
        @error('machine_capacity') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Manpower Capacity</label>
        <input type="number" min="0" name="manpower_capacity" class="form-control @error('manpower_capacity') is-invalid @enderror"
               value="{{ old('manpower_capacity', $l->manpower_capacity ?? 0) }}">
        @error('manpower_capacity') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <div class="form-check form-switch mt-4">
            <input type="checkbox" name="is_active" class="form-check-input" value="1"
                   @checked(old('is_active', $l->is_active ?? true))>
            <label class="form-check-label">Active</label>
        </div>
    </div>
</div>
