{{-- resources/views/buyers/partials/form.blade.php --}}
@php $buyer = $buyer ?? null; @endphp

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Buyer Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $buyer->name ?? '') }}" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Buyer Code <span class="text-danger">*</span></label>
        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
               value="{{ old('code', $buyer->code ?? '') }}" required>
        @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Country</label>
        <input type="text" name="country" class="form-control" value="{{ old('country', $buyer->country ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Buyer Type <span class="text-danger">*</span></label>
        <select name="buyer_type" class="form-select" required>
            @foreach (['Direct', 'Buying House'] as $type)
                <option value="{{ $type }}" @selected(old('buyer_type', $buyer->buyer_type ?? '') === $type)>{{ $type }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Contact Person</label>
        <input type="text" name="contact_person" class="form-control" value="{{ old('contact_person', $buyer->contact_person ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $buyer->email ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone', $buyer->phone ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Payment Terms</label>
        <input type="text" name="payment_terms" class="form-control" placeholder="e.g. LC at sight"
               value="{{ old('payment_terms', $buyer->payment_terms ?? '') }}">
    </div>
    <div class="col-md-12 mb-3">
        <label class="form-label">Address</label>
        <textarea name="address" class="form-control" rows="2">{{ old('address', $buyer->address ?? '') }}</textarea>
    </div>
    <div class="col-md-6 mb-3">
        <div class="form-check form-switch">
            <input type="checkbox" name="is_active" class="form-check-input" value="1"
                   @checked(old('is_active', $buyer->is_active ?? true))>
            <label class="form-check-label">Active</label>
        </div>
    </div>
</div>
