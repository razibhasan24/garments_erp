{{-- resources/views/departments/partials/form.blade.php --}}
@php $d = $department ?? null; @endphp

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Factory <span class="text-danger">*</span></label>
        <select name="factory_id" class="form-select @error('factory_id') is-invalid @enderror" required>
            <option value="">-- Select Factory --</option>
            @foreach (\App\Models\Factory::where('is_active', true)->get() as $f)
                <option value="{{ $f->id }}" @selected(old('factory_id', $d->factory_id ?? '') == $f->id)>{{ $f->name }}</option>
            @endforeach
        </select>
        @error('factory_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Department Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $d->name ?? '') }}" placeholder="e.g. Sewing" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Department Code <span class="text-danger">*</span></label>
        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
               value="{{ old('code', $d->code ?? '') }}" placeholder="e.g. DEPT-SEW" required>
        @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <div class="form-check form-switch mt-4">
            <input type="checkbox" name="is_active" class="form-check-input" value="1"
                   @checked(old('is_active', $d->is_active ?? true))>
            <label class="form-check-label">Active</label>
        </div>
    </div>
</div>
