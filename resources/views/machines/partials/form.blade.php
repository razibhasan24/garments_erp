{{-- resources/views/machines/partials/form.blade.php --}}
@php $m = $machine ?? null; @endphp

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Floor <span class="text-danger">*</span></label>
        <select name="floor_id" id="floor_id" class="form-select @error('floor_id') is-invalid @enderror" required>
            <option value="">-- Select Floor --</option>
            @foreach ($floors as $f)
                <option value="{{ $f->id }}" @selected(old('floor_id', $m->floor_id ?? '') == $f->id)>{{ $f->name }}</option>
            @endforeach
        </select>
        @error('floor_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Production Line</label>
        <select name="production_line_id" class="form-select @error('production_line_id') is-invalid @enderror">
            <option value="">-- None --</option>
            @foreach ($lines as $l)
                <option value="{{ $l->id }}" data-floor="{{ $l->floor_id }}"
                        @selected(old('production_line_id', $m->production_line_id ?? '') == $l->id)>{{ $l->name }}</option>
            @endforeach
        </select>
        @error('production_line_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Machine Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $m->name ?? '') }}" placeholder="e.g. Plain Machine" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Asset Code <span class="text-danger">*</span></label>
        <input type="text" name="asset_code" class="form-control @error('asset_code') is-invalid @enderror"
               value="{{ old('asset_code', $m->asset_code ?? '') }}" placeholder="e.g. MC-000123" required>
        @error('asset_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Brand</label>
        <input type="text" name="brand" class="form-control" placeholder="e.g. Juki, Brother"
               value="{{ old('brand', $m->brand ?? '') }}">
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Model No.</label>
        <input type="text" name="model_no" class="form-control" value="{{ old('model_no', $m->model_no ?? '') }}">
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Status <span class="text-danger">*</span></label>
        <select name="status" class="form-select" required>
            @foreach (['Running', 'Idle', 'Under Maintenance', 'Scrapped'] as $s)
                <option value="{{ $s }}" @selected(old('status', $m->status ?? 'Running') === $s)>{{ $s }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Purchase Date</label>
        <input type="date" name="purchase_date" class="form-control"
               value="{{ old('purchase_date', $m?->purchase_date?->format('Y-m-d')) }}">
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Purchase Price</label>
        <input type="number" step="0.01" min="0" name="purchase_price" class="form-control"
               value="{{ old('purchase_price', $m->purchase_price ?? '') }}">
    </div>
</div>

@push('js')
<script>
    // Filter production line dropdown based on selected floor (optional UX enhancement)
    document.getElementById('floor_id')?.addEventListener('change', function () {
        const floorId = this.value;
        document.querySelectorAll('select[name="production_line_id"] option').forEach(opt => {
            if (!opt.value) return;
            opt.hidden = floorId && opt.dataset.floor !== floorId;
        });
    });
</script>
@endpush
