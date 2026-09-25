{{-- resources/views/floors/partials/form.blade.php --}}
@php $f = $floor ?? null; @endphp

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Factory <span class="text-danger">*</span></label>
        <select name="factory_id" class="form-select @error('factory_id') is-invalid @enderror" required>
            <option value="">-- Select Factory --</option>
            @foreach ($factories as $fac)
                <option value="{{ $fac->id }}" @selected(old('factory_id', $f->factory_id ?? '') == $fac->id)>{{ $fac->name }}</option>
            @endforeach
        </select>
        @error('factory_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Floor Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $f->name ?? '') }}" placeholder="e.g. 3rd Floor - Sewing" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Floor Code <span class="text-danger">*</span></label>
        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
               value="{{ old('code', $f->code ?? '') }}" placeholder="e.g. FL-03" required>
        @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Total Area (sqft)</label>
        <input type="number" min="0" name="total_area_sqft" class="form-control @error('total_area_sqft') is-invalid @enderror"
               value="{{ old('total_area_sqft', $f->total_area_sqft ?? '') }}">
        @error('total_area_sqft') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <div class="form-check form-switch">
            <input type="checkbox" name="is_active" class="form-check-input" value="1"
                   @checked(old('is_active', $f->is_active ?? true))>
            <label class="form-check-label">Active</label>
        </div>
    </div>
</div>
